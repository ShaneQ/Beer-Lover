<?php
use Respect\Validation\Validator as v;
use logic\Test;
class Layout extends CI_Controller
{

	public function list(){
		$data = array('list'=>'HELLLO');
		$this->load->view('Layout/list', $data);
	}

	public function addForm(){
		Test::test();
		$this->load->view('Layout/add');
	}

	public function add(){
		echo'<pre>';print_r($_POST);echo'</pre>';
		v::alnum('-')->validate($_POST['layout']);
		foreach($_POST['section'] as $section){
			v::alnum('-')->validate($section['name']);
			v::numeric()->validate($section['size']);
		}

	}


}