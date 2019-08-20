<?php

class HomeController extends Controller
{
	public function index()
	{
		if(isLogged()){
			redirect('posts');
		}

		$data = [
			'title' => 'Welcome'
		];

		return $this->view('pages/index', $data);
	}
}