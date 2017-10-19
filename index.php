<?php 
include_once('config/config.php');
function __autoload($class)
{
	if(!is_array($class)){
		$class = array($class);
	}
	foreach ($class as $c) {
		$path = __dir__.'\\'."{$c}.php";
		if(file_exists($path)){
			include_once($path);
		}else{
			echo 'class not found';
		}
	}
}

if(isset($_GET['url'])){
	$c = new Library\Main();
	if($c->load_controller($_GET)){
		
	};
}


 ?>