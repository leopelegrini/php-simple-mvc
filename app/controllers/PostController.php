<?php

require_once('../app/models/Post.php');

class PostController extends Controller {

	private $postModel;

	public function __construct()
	{
		if(!isLogged()){
			redirect('users/login');
		}

		$this->postModel = new Post;
	}

	public function index()
	{
		$posts = $this->postModel->all();

		$data = [
			'posts' => $posts
		];

		$this->view('posts/index', $data);
	}

	public function create()
	{
		if($_SERVER['REQUEST_METHOD'] == 'GET'){
			$data = [
				'title' => '',
				'body' => ''
			];

			$this->view('posts/create', $data);
		}
		elseif($_SERVER['REQUEST_METHOD'] == 'POST'){
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

			$data = [
				'title' => trim($_POST['title']),
				'body' => trim($_POST['body']),
				'user_id' => $_SESSION['user_id'],
				'title_error' => '',
				'body_error' => ''
			];

			$valid = true;

			if(empty($data['title'])){
				$valid = false;
				$data['title_error'] = 'Please enter the post title';
			}

			if(empty($data['body'])){
				$valid = false;
				$data['body_error'] = 'Please enter the post text';
			}

			if($valid){
				if($this->postModel->create($data)){
					flash('post_message', 'Post enviado com sucesso', 'success');
					redirect('posts');
				}
				else {
					die('Post submission failed');
				}
			}
			else {
				// load view with errors
				$this->view('posts/create', $data);
			}
		}
	}

	public function show()
	{
		$post = $this->postModel->find($_GET['post_id']);

		$data = [
			'post' => $post
		];

		$this->view('posts/show', $data);
	}

	public function edit()
	{
		if($_SERVER['REQUEST_METHOD'] == 'GET'){
			$post = $this->postModel->find($_GET['post_id']);

			$data = [
				'post_id' => $_GET['post_id'],
				'title' => $post->title,
				'body' => $post->body
            ];

			$this->view('posts/edit', $data);
		}
		elseif($_SERVER['REQUEST_METHOD'] == 'POST'){

			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

			$data = [
				'post_id' => $_GET['post_id'],
				'title' => trim($_POST['title']),
				'body' => trim($_POST['body']),
				'user_id' => $_SESSION['user_id'],
				'title_error' => '',
				'body_error' => ''
			];

			$valid = true;

			if(empty($data['title'])){
				$valid = false;
				$data['title_error'] = 'Please enter the post title';
			}

			if(empty($data['body'])){
				$valid = false;
				$data['body_error'] = 'Please enter the post text';
			}

			if($valid){
				if($this->postModel->update($data)){
					flash('post_message', 'Post atualizado com sucesso', 'success');
					redirect('posts');
				}
				else {
					die('Post submission failed');
				}
			}
			else {
				// load view with errors
				$this->view('posts/edit?post_id='.$data['post_id'], $data);
			}
		}
	}

	public function delete()
	{
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			if($this->postModel->delete($_GET['post_id'])){
				flash('post_message', 'Post deleted', 'warning');
				redirect('posts');
			} else {
				die('Post delete failed');
			}
		}
		else {
			redirect('posts');
		}
	}

}