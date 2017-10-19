<?php 
namespace Library;
class Main extends Controller
{
	public $Request;
	function __construct()
	{
		parent::__construct();
		$this->Request = \Library\Request::create();
		
	}
}
 ?>