<?php

require_once('../app/models/Task.php');

class TaskController extends Controller {

	private $model;

	public function __construct()
	{
		if(!isLogged()){
			redirect('users/login');
		}

		$this->model = new Task;
	}

	public function index()
	{
		$tasks = $this->model->all();

		$data = [
			'tasks' => $tasks
		];

		$this->view('tasks/index', $data);
	}

	public function create()
	{
		if($_SERVER['REQUEST_METHOD'] == 'GET'){
			$data = [
				'description' => ''
			];

			$this->view('tasks/create', $data);
		}
		elseif($_SERVER['REQUEST_METHOD'] == 'POST'){
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

			$data = [
				'description' => trim($_POST['description']),
				'description_error' => '',
				'user_id' => $_SESSION['user_id']
			];

			$valid = true;

			if(empty($data['description'])){
				$valid = false;
				$data['description_error'] = 'Preencha o texto da tarefa';
			}

			if($valid){
				if($this->model->create($data)){
					flash('task_message', 'Tarefa adicionada com sucesso', 'success');
					redirect('tasks');
				}
				else {
					die('Não foi possível salvar a tarefa');
				}
			}
			else {
				// load view with errors
				$this->view('tasks/create', $data);
			}
		}
	}

	public function show()
	{
		$task = $this->model->find($_GET['task_id']);

		$data = [
			'task' => $task
		];

		$this->view('tasks/show', $data);
	}

	public function edit()
	{
		if($_SERVER['REQUEST_METHOD'] == 'GET'){
			$post = $this->model->find($_GET['post_id']);

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
				if($this->model->update($data)){
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
			if($this->model->delete($_GET['post_id'])){
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