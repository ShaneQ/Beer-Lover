<?php

/**
 * Created by PhpStorm.
 * User: shane
 * Date: 15/06/2017
 * Time: 23:41
 */
class User extends CI_Model
{
    public $first_name;
    public $last_name;
    public $password;
    public $email;

    public function __construct()
    {
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