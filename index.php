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
$c = new Library\Main();
if(isset($_GET['url'])){
	
	if($c->load_controller($_GET)){
		
	};
}else{
	$default = array('url'=>'index');
	$c->load_controller($default);
}


 ?>