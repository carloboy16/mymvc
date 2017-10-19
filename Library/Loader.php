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
			echo 'Controller Doesnt Exist';
			return false;
		}

			

		if(isset($url[1]) && $url[1] != ""){

			include_once("controller/".$url[0]."Controller.php");
			$c = "controller\\".$url[0].'Controller';
			$this->controller = $c::create();
			if(count($url)>=3){
			for($a = 0;$a<count($url);$a++){
				
				if($a>=2){
						$d[] = $url[$a];
				}
			}

			if(count($d)>0){
				$this->controller->$url[1]($d);
				return;
			}
			}

			$this->controller->$url[1]();
		}else{
			$c = "";

			include_once("controller/".$url[0]."Controller.php");
			$c = "controller\\".$url[0].'Controller';
			$this->controller = $c::create();
			$this->controller->index();
		}
	}
	function checkifroute($a,$b){
		foreach ($a as $a) {
			$d = (strpos($a->route,$b));
		}
		return $d ;
	}
	function render($file,$data= null){
		$file = "view/".$file.'.php';
		$data = (array) $data;
		if(isset($data)){
			if(count($data)==0){

			}else{
				extract($data);
			}
		}
		ob_start();
		  include($file);
		echo ob_get_clean();




	}
	
}
 ?>