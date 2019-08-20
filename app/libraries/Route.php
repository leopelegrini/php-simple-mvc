<?php

class Route
{
	private static $validRoutes = array();
	private static $pathNotFound = null;

	public static function set($route, $controller_name, $controller_method){

		self::$validRoutes[] = $route;

		$url = ( isset($_GET['url']) ) ? $_GET['url'] : '/';

		if($url == $route){
			if(file_exists('../app/controllers/' . $controller_name . '.php')){

				require_once '../app/controllers/' . $controller_name . '.php';

				$controller_instance = new $controller_name;

				if(!method_exists($controller_instance, $controller_method)){
					die('Method "' . $controller_method . '" does not exists in controller ' . $controller_name);
				}

				call_user_func(array($controller_instance, $controller_method));
			}
			else {
				die('Controller '.$controller_name.' not found');
			}
		}
	}
}
