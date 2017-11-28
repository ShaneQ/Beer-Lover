<?php
use library\utils;
use Respect\Validation\Validator as v;
class Login extends MY_Controller
{

	public function index()
	{
		$this->load->view('login/login');

	}


	public function logins(){
		$this->load->view('login/login');
	}

	public function login_now()
	{
		$_POST['login_failure'] = false;
		$this->load->helper(array(
			                    'form',
			                    'url'
		                    ));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'Username', 'required|min_length[8]|max_length[25]', array(
			                                            'required' => 'You have not provided %s.',
			                                            'min_length' => 'Something different.'
		                                            ));

		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');
		if($this->form_validation->run() == false) {
			$this->load->model('User');
			$this->load->view('login/login');
		}
		else {
			$this->load->model(array('User', 'UserLogin'));
			$id_user = $this->User->get_entry($_POST['username'], $_POST['password']);
			if($id_user > 0) {
				$this->UserLogin->delete($id_user);
				$user_key = $this->UserLogin->create($id_user);
				utils\Session::setUserKey($user_key);
				redirect('Premium/home');
			}
			else {
				$_POST['login_failure'] = true;
				$this->load->view('login/login');
			}

		}
	}

	public function register(){
		$this->load->view('login/register');
	}


}