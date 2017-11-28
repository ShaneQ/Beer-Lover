<?php

class UserLogin extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function create(int $id_user):string
	{
		$this->delete($id_user);
		$user_key = $this->generateRandomString(10);
		$sql = "INSERT INTO user_login (id_user, user_key) VALUES (?,?)";
		$this->db->query($sql, array($id_user, $user_key));
		return $user_key;
	}

	public function get_entry(string $user_key):int
	{
		$sql = "SELECT id_user FROM user_login WHERE user_key = ?";
		$query = $this->db->query($sql, array( $user_key));
		return  $query->row(0)->id_user ?? 0;
	}


	public function delete(int $id_user)
	{
		$sql = "DELETE FROM user_login WHERE id_user = ?";
		$this->db->query($sql, array($id_user));
	}

	/*
	 * https://stackoverflow.com/questions/4356289/php-random-string-generator
	 */
	function generateRandomString($length = 10):string
	{
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}


}