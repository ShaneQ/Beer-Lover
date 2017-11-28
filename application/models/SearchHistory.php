<?php

class SearchHistory extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function create(int $id_user, string $search, int $count):int
	{
		$sql = "INSERT INTO search_history (id_user, search, results) VALUES (?,?,?)";
		$this->db->query($sql, array($id_user, $search, $count));
		return $this->db->insert_id();
	}

}