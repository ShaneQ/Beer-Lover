<?php

use Respect\Validation\Validator as v;

class Login extends CI_Controller
{
	public function index()
	{
		$this->load->view('login');
	}

	public function login_now()
	{
		$_POST['login_failure'] = false;
		$this->load->helper(array(
			                    'form',
			                    'url'
		                    ));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'User name', 'required');
		$this->form_validation->set_rules('username', 'Username', 'required|min_length[8]|max_length[25]', array(
			                                            'required' => 'You have not provided %s.',
			                                            'min_length' => 'Something different.'
		                                            ));

		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');
		if($this->form_validation->run() == false) {
			$this->load->model('User');
			$this->load->view('login');
		}
		else {
			$this->load->model('User');
			if($this->User->get_entry()) {
				$this->load->view('landing');
			}
			else {
				$_POST['login_failure'] = true;
				$this->load->view('login');
			}

		}
	}


}