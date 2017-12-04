<?php

class BeerFavourite extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function create(int $id_user, string $name, string $code): int
	{
		if(!$this->getIdFromCode($id_user, $code)) {
			$sql = "INSERT INTO beer_favourite (id_user, name, code) VALUES (?,?,?)";
			$this->db->query($sql, array(
				$id_user,
				$name,
				$code
			));

			return $this->db->insert_id();
		}
		return 0;

	}

	public function getBeers(int $id_user): array
	{
		$sql = "SELECT * FROM beer_favourite WHERE id_user =? ORDER BY id DESC";
		$query = $this->db->query($sql, array($id_user));

		return $query->result_array();
	}

	public function delete(int $id_user, int $id_beer_favourite)
	{
		$sql = "DELETE FROM beer_favourite WHERE id_user =?  AND id=?";
		$this->db->query($sql, array(
			$id_user,
			$id_beer_favourite
		));
	}

	public function getIdFromCode(int $id_user, string $code): int
	{
		$sql = "SELECT id FROM beer_favourite WHERE id_user =? AND code=?";
		$query = $this->db->query($sql, array(
			$id_user,
			$code
		));

		return $query->row(0)->id ?? 0;
	}

}