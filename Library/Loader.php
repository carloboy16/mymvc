<?php 	
namespace Library;
class Loader Extends DB
{
	function __construct(){
		parent::__construct();
	}
	function check_route($r){
	extract($r);
	$r = explode("/",$url);
		Global $_Route;
		foreach ($_Route as $rt => $v) {
				if(strpos($rt,$url)){
					return true;
				}else{
					return false;
				}
		}	
	}
	public function load_controller(&$request){
		extract($request);
		
		$url = explode('/', $url);
		$onroute = $this->check_route($request);
	    // var_dump($onroute);
		$param = array();

		if(!file_exists("controller/".$url[0]."Controller.php")){
			echo 'Controller Doesnt Exist';
			return false;
		}
		$function = 'index';
		foreach ($url as $i =>$v) {
			if($i == 0 ){
				$controller = 'controller\\'.$v.'Controller';
				$controller =  $controller::create();
			}
			elseif($i  == 1){
				$function = $v;

			}
			else{
				$param[$i] = $v;
			}
		}

		call_user_func_array(array($controller,$function), $param);

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