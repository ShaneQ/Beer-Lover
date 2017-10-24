<?php
use Respect\Validation\Validator as v;
use logic\Test;
class Layout extends CI_Controller
{

	public function index(){
		$data = array('list'=>'HELLLO');
		$this->load->view('Layout/list', $data);
	}

	public function list(){
		$data = array('list'=>'HELLLO');
		$this->load->view('Layout/list', $data);
	}

	public function addForm(){

		$this->load->view('Layout/add');
	}

	public function add(){


		foreach($_POST['section'] as $section)
		{

			$name  = $section['name'];
			$size = $section['size'];
			$this->load->view('Layout/add');
			//$this->form_validation->set_rules('section[0][name]', "name", "max_length[10]");
		}
		$this->load->view('Layout/add');
		/*if ($this->form_validation->run() === FALSE)
		{

		}else{
			$this->load->view('Layout/add');
		}*/

	}


}