<?php

class SearchHistory extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function create(int $id_user, string $search, int $type, int $count):int
	{
		$sql = "INSERT INTO search_history (id_user, search, type, results) VALUES (?,?,?,?)";
		$this->db->query($sql, array($id_user, $search, $type, $count));
		return $this->db->insert_id();
	}

	public function getUserSearches(int $id_user):array
	{
		$sql = "SELECT * FROM search_history WHERE id_user =? ORDER BY id DESC";
		$query = $this->db->query($sql, array($id_user));
		return $query->result_array();
	}

	public function delete(int $id_user, int $id_search_result)
	{
		$sql = "DELETE FROM search_history WHERE id_user =?  AND id=?";
		$this->db->query($sql, array($id_user, $id_search_result));
	}

}