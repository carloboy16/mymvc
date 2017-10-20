<?php 
namespace controller;
use Library\DB as DB;
use Library\Main as Main;
use model\user as  user;
class adminController  extends Main
{
	protected $db;
	public  $header_tpl,$footer_tpl;

	function __construct(){
			$this->header_tpl = 'admin/tpl/header';
			$this->footer_tpl = 'admin/tpl/footer';
	}
	function index(){
		$this->db = new DB;
		$userdb =new user();
		$userdb->delete()->where('username = ?','lucky')->run();

		$a['user'] = $userdb->fetchQuery($userdb->select('email'));

		$a['test'] = $this->db->fetchQuery($this->db->select('user')->where('user_id = ?','1'));
		if(isset($_GET['useradmin'])){

		}else{
			header('location:/admin/login');
		}
	}
	public function login($id = null){
		// var_dump($id);
		$req = array('request' => $_POST);
		$this->render($this->header_tpl);
		$this->render('admin/login',$req);	
		$this->render($this->footer_tpl);


	}
	public function create(){
		return new self();
	}

}

 ?>

