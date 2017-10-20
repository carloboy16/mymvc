<?php 
namespace Library;
class Main extends Controller
{
	public $Request;
	public $Json;
	function __construct()
	{
		parent::__construct();
		$this->Request = \Library\Request::create();
		$this->Json = \Library\Json::create();
	}
}
 ?>