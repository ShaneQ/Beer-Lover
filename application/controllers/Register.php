<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use library\utils;
class Register extends MY_Controller
{
    public function index()
    {

        $this->load->view('login/register');
    }

    public function registerIt()
    {
        $this->load->library('form_validation');
	    $this->load->model(array('User', 'UserLogin'));
        $this->form_validation->set_rules('first_name', 'First name', 'required|min_length[1]|max_length[35]');
        $this->form_validation->set_rules('last_name', 'Last Name', 'required|min_length[1]|max_length[35]');
        $this->form_validation->set_rules('email_one', 'Email', 'required|valid_email|max_length[50]');
        $this->form_validation->set_rules('email_two', 'Email confirmation', 'required|valid_email|matches[email_one]|max_length[50]');
        $this->form_validation->set_rules('password', 'password', 'required|min_length[8]|max_length[12]');

        if ($this->form_validation->run() == FALSE) {
           $this->index();
        } else {
	        $email_check =  $this->User->getUserId($_POST['email_one']);
	        if(!$email_check){
		        $id_user = $this->User->insert_entry($_POST['first_name'], $_POST['last_name'],$_POST['email_one'],$_POST['password']);
		        if($id_user > 0) {
			        $this->UserLogin->delete($id_user);
			        $user_key = $this->UserLogin->create($id_user);
			        utils\Session::setUserKey($user_key);
			        redirect('Premium/home');
		        }
	        }else{
		        $data["email_exists"] = 'Email currently exists';
		        $this->load->view('login/register', $data);
	        }

        }
    }

    public function updatePassword(){
    	$this->shouldBeLoggedIn();

	    $this->load->model('User');
	    $this->load->library('form_validation');
	    $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
	    $this->form_validation->set_rules('password_old', 'old password', 'required|min_length[8]|max_length[12]');
	    $this->form_validation->set_rules('password_one', 'password', 'required|min_length[5]|max_length[12]');
	    $this->form_validation->set_rules('password_two', 'new password', 'required|min_length[8]|max_length[12]');
	    $this->form_validation->set_rules('password_one', 'old password', 'differs[old_password]',
	                                      array('differs'=>'New password should not match old'));
	    $this->form_validation->set_rules('password_one', 'retyped password', 'matches[password_two]',
	                                      array('matches'=>'Passwords not matching'));
	    $this->form_validation->set_rules('password_two', 'retyped password', 'matches[password_one]',
	                                      array('matches'=>'Passwords not matching'));

	    $this->load->library('form_validation');

	    if ($this->form_validation->run() == FALSE) {
		    $this->load->view('profile_settings');
	    } else {
		    $id_user = $this->getLoggedInUser();
		    $password_check =  $this->User->checkPassword($id_user,$_POST['password_old']);
		    $data["old_password_matching"]='';
		    if(!$password_check){
			    $data["old_password_matching"] = 'Old password did not match';
			    $this->load->view('profile_settings', $data);
		    }else{
			    $this->User->updatePassword($id_user,$_POST['password_one']);
			    $this->load->view('profile_settings_success');
		    }
	    }
    }

/*    public function login(){
	    $this->load->view('login/header');
	    $this->load->view('login/login');
    }*/
}