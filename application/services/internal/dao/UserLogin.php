<?php

class UserLogin extends CI_Model
{
	public $first_name;
	public $last_name;
	public $password;
	public $email;

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function create()
	{
		$this->id_user    = 'Test'; // please read the below note
		$this->email  = 't'.rand(1,100).'@gmail.com';
		$this->password  = 'something';
		$this->db->insert('user', $this);
	}

	public function get_entry():int
	{
		$this->db->where('email', $_POST['username']);
		$this->db->where('password', $_POST['password']);
		return $this->db->count_all_results('user', FALSE);
	}

	public function get()
	{
		return $query = $this->db->get('user');
	}


}