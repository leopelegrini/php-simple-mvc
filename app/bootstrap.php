<?php

require_once 'config/config.php';

require_once 'helpers/helpers.php';
require_once 'helpers/session.php';

spl_autoload_register(function($className){
	require_once 'libraries/' . $className . '.php';
});

require_once 'routes/web.php';