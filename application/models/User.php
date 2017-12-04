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

	public function insert_entry($first_name, $last_name, $email, $password): int
	{
		$this->first_name = $first_name; // please read the below note
		$this->last_name = $last_name;
		$this->email = $email;
		$this->password = self::encryptPassword($email, $password);
		$this->db->insert('user', $this);

		return $this->db->insert_id() ?? 0;
	}

	public function loginCheck(string $email, string $password): int
	{
		$id_user = $this->getUserId($email);
		if($id_user) {
			if(!$this->checkPassword($id_user, $password)) {
				return false;
			}
		}

		return $id_user;
	}

	public function updatePassword(int $id_user, string $password)
	{
		$email = $this->getEmail($id_user);
		$password = self::encryptPassword($email, $password);
		$sql = "UPDATE user SET password=? WHERE id=?";
		$this->db->query($sql, array(
			$password,
			$id_user
		));
	}

	public function checkPassword(int $id_user, string $password): bool
	{
		$sql = "SELECT password FROM user WHERE id=?";
		$query = $this->db->query($sql, array($id_user));
		$password_db = $query->row(0)->password;
		$check = $this->checkPasswordMatch($password_db, $password);

		return $check;
	}

	public function getUserId(string $email): int
	{
		$sql = "SELECT id FROM user WHERE email=?";
		$query = $this->db->query($sql, array($email));

		return $query->row(0)->id ?? 0;
	}

	public function getEmail(int $id_user): string
	{
		$sql = "SELECT email FROM user WHERE id=?";
		$query = $this->db->query($sql, array($id_user));

		return $query->row(0)->email ?? "";
	}

	public static function checkPasswordMatch(string $passwordDB, string $passwordLogin): bool
	{
		$salt = substr($passwordDB, 0, 64);
		$hash = $salt.$passwordLogin;
		for($i = 0; $i < 100000; $i++) {
			$hash = hash('sha256', $hash);
		}
		$hash = $salt.$hash;
		if($hash === $passwordDB) {
			return true;
		}
		else {
			return false;
		}
	}

	public static function encryptPassword(string $email, string $password): string
	{
		$salt = hash('sha256', uniqid(mt_rand(), true).'as time goes by'.strtolower($email));
		$hash = $salt.$password;
		for($i = 0; $i < 100000; $i++) {
			$hash = hash('sha256', $hash);
		}
		$hash = $salt.$hash;

		return $hash;
	}

}