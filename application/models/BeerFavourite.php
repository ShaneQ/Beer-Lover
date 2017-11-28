<?php

class BeerFavourite extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function create(int $id_user, string $name, string $code):int
	{
		$sql = "INSERT INTO beer_favourite (id_user, name, code) VALUES (?,?,?)";
		$this->db->query($sql, array($id_user, $name, $code));
		return $this->db->insert_id();
	}

}