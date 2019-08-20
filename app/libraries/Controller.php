<?php

class Controller {

	// load view
	public function view($view, $data = [])
	{
		if((strpos($view, "?")) !== FALSE){ 
			$view = strtok($view, '?');
		}

		// check view file
		if(file_exists('../app/views/' . $view . '.php')){
			require_once '../app/views/' . $view . '.php';
		}
		else {
			die('View '.$view.' not found');
		}
	}
}
