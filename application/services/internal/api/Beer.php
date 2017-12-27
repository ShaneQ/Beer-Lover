<?php

namespace library\api;

use library\models\Beer as BeerModel;
class Beer extends BreweryDB
{
	public function __construct()
	{
		parent::__construct();
	}

	public function getByBrewery(array $ids_brewery, bool $has_img_and_desc):array
	{

		$list = array();
		foreach($ids_brewery as $id_brewery) {
			$beers = parent::request('beer_list',"brewery/$id_brewery/beers", array(), false, $has_img_and_desc);
			$list = array_merge($list,$beers);
		}
		return $list;
	}

	public function getRandom():BeerModel
	{
		$param = array(
			'hasLabels'     => 'Y',
			'withBreweries' => 'Y'
		);
		return parent::request('beer',"beer/random", $param, 5, true);

	}





}