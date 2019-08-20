<?php

require_once('../app/models/User.php');

class UserController extends Controller
{
	private $userModel;

	public function __construct()
	{
		$this->userModel = new User;
	}

	public function create()
	{
		// check for POST
		if($_SERVER['REQUEST_METHOD'] == 'POST'){

			// process form

			// sanitize POST data
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

			$data = [
				'name' => trim($_POST['name']),
				'email' => trim($_POST['email']),
				'password' => trim($_POST['password']),
				'confirm_password' => trim($_POST['confirm_password']),
				'name_error' => '',
				'email_error' => '',
				'password_error' => '',
				'confirm_password_error' => ''
			];

			// validation
			if(empty($data['name'])){
				$data['name_error'] = 'Please enter your name';
			}

			if(empty($data['email'])){
				$data['email_error'] = 'Please enter your email';
			}
			else {
				if($this->userModel->emailExists($data['email'])){
					$data['email_error'] = 'Email already registered';
				}
			}

			if(empty($data['password'])){
				$data['password_error'] = 'Please enter your password';
			}
			elseif(strlen($data['password']) < 6){
				$data['password_error'] = 'Password must be at least 6 characters';
			}

			if(empty($data['confirm_password'])){
				$data['confirm_password_error'] = 'Please confirm your password';
			}
			else {
				if($data['password'] != $data['confirm_password']){
					$data['confirm_password_error'] = 'Passwords do not match';
				}
			}

			// make sure errors are empty
			if(
				empty($data['email_error']) && 
				empty($data['name_error']) && 
				empty($data['password_error']) &&
				empty($data['confirm_password_error'])
			){
				// hash
				$data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

				// register user
				if($this->userModel->create($data)){
					flash('register_success', 'Usuário registrado com sucesso', 'success');
					redirect('users/login');
				}
				else {
					die('Register failed');
				}
			}
			else {
				// load view with errors
				$this->view('users/register', $data);
			}

		}
		else {
			// init data
			$data = [
				'name' => '',
				'email' => '',
				'password' => '',
				'confirm_password' => '',
				'name_error' => '',
				'email_error' => '',
				'password_error' => '',
				'confirm_password_error' => ''
			];

			$this->view('users/register', $data);
		}
	}

	public function login()
	{
		// check for POST
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			// process form
			$data = [
				'email' => trim($_POST['email']),
				'password' => trim($_POST['password']),
				'email_error' => '',
				'password_error' => ''
			];

			if(empty($data['email'])){
				$data['email_error'] = 'Please enter your email';
			}

			if(empty($data['password'])){
				$data['password_error'] = 'Please enter your password';
			}

			// check for user/email
			if($this->userModel->emailExists($data['email'])){
				// user found
			} else {
				$data['email_error'] = 'User not found';
			}

			// make sure errors are empty
			if(
				empty($data['email_error']) &&
				empty($data['password_error'])
			){
				// check and set logged in user
				$loggedUser = $this->userModel->login($data['email'], $data['password']);

				if($loggedUser){
					// create session
					$this->createUserSession($loggedUser);
				} else {
					$data['password_error'] = 'Password incorrect';
					$this->view('users/login', $data);
				}
			}
			else {
				// load view with errors
				$this->view('users/login', $data);
			}

		}
		else {
			// init data
			$data = [
				'email' => '',
				'password' => '',
				'name_error' => '',
				'email_error' => '',
				'password_error' => ''
			];

			$this->view('users/login', $data);
		}
	}

	public function createUserSession($user)
	{
		$_SESSION['user_id'] = $user->id;
		$_SESSION['user_email'] = $user->email;
		$_SESSION['user_name'] = $user->name;
		
		redirect('posts');
	}

	public function logout()
	{
		unset($_SESSION['user_id']);
		unset($_SESSION['user_email']);
		unset($_SESSION['user_name']);
		session_destroy();
		redirect('users/login');
	}
}