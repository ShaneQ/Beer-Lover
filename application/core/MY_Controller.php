<?php
use library\utils\Session;
class MY_Controller extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function is_logged_in()
	{
		if($this->getLoggedInUser() >0 ){
			return true;
		}else{
			return false;
		}
	}

	public function getLoggedInUser():int
	{
		$this->load->model(array( 'UserLogin'));
		return $check = $this->UserLogin->get_entry(Session::getUserKey());
	}

	public function shouldBeLoggedIn(){
		$check = $this->is_logged_in();
		if(!$check){
			redirect('login/logout');
		}
	}
	public function shouldBeLoggedOut(){
		$check = $this->is_logged_in();
		if($check){
			redirect('login/');
		}
	}
	public function logout(){
		Session::remove();
		$this->load->view('login/login');
	}


}