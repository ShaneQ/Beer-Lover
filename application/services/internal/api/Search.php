<?php

namespace library\api;

class Search extends BreweryDB
{

	public function __construct()
	{
		parent::__construct();
	}

	public function execute(string $type, string $query, bool $has_img_and_desc):array
	{
		$param = array(
			'q'    => $query,
			'type' => $type,
		);
		return parent::request($type."_list","search/", $param, 0, $has_img_and_desc);
	}
}