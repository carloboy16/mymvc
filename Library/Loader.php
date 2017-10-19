<?php 	
namespace Library;
class Loader Extends DB
{
	function __construct(){
		parent::__construct();
	}
	public function load_controller(&$request){
		extract($request);
		$url = explode('/', $url);
		if(!file_exists("controller/".$url[0]."Controller.php")){
			return false;
		}
		if(isset($url[1]) && $url[1] != ""){
			include_once("controller/".$url[0]."Controller.php");
			$c = "controller\\".$url[0].'Controller';
			$this->controller = $c::create();
			$this->controller->$url[1]();
		}else{
			$c = "";
			include_once("controller/".$url[0]."Controller.php");
			$c = "controller\\".$url[0].'Controller';
			$this->controller = $c::create();
			$this->controller->index();
		}
	}
	function render($file,$data= null){
		$file = "view/".$file.'.php';
		extract($data);
		ob_start();
		  include($file);
		echo ob_get_clean();




	}
	
}
 ?>