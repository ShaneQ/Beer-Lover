<?php

class Register extends MY_Controller
{
    public function index()
    {
	    $this->load->view('login/header');
        $this->load->view('login/register');
    }

    public function registerIt()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('first_name', 'First name', 'required|min_length[5]|max_length[12]');
        $this->form_validation->set_rules('last_name', 'Last Name', 'required|min_length[5]|max_length[12]');
        $this->form_validation->set_rules('email_one', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('email_two', 'Email confirmation', 'required|valid_email|matches[email_one]');
        $this->form_validation->set_rules('password', 'password', 'required|min_length[5]|max_length[12]');


        $this->load->library('form_validation');

        if ($this->form_validation->run() == FALSE) {
           $this->index();
        } else {
            $this->load->model('User');
            $this->User->insert_entry();
            $this->load->view('formsuccess');
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
		    $old_password_db =  $this->User->checkPassword($id_user,$_POST['password_old']);
		    $data["old_password_matching"]='';
		    if($_POST['password_old'] !== $old_password_db){
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