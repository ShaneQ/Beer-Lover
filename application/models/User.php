<?php

class User extends CI_Model
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

	public function insert_entry()
    {
        $this->first_name    = 'Test'; // please read the below note
        $this->last_name  = 'Person';
        $this->email  = 't'.rand(1,100).'@gmail.com';
        $this->password  = 'something';
        $this->db->insert('user', $this);
    }

    public function get_entry(string $email, string $password):int
    {
    	$sql = "SELECT id FROM user WHERE email=? AND password=?  LIMIT 1;";
	    $query = $this->db->query($sql, array($email, $password));
	    return  $query->row(0)->id ?? 0;
    }

	public function get()
	{
		return $query = $this->db->get('user');
	}

	public function updatePassword(int $id_user, string $password)
	{
		$sql = "Update user SET password=? WHERE id=?";
		$this->db->query($sql, array($password, $id_user));
	}

	public function checkPassword(int $id_user, string $password){
		$sql = "SELECT password FROM user WHERE id=?";
		$query = $this->db->query($sql, array( $id_user));
		return  $query->row(0)->password ?? 'nope';
	}


}