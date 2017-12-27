<?php

namespace library\api;
use library\models\Beer as BeerModel;
use library\models\Brewery as BreweryModel;

class BreweryDPFactory
{
	private $data;
	private $type;

	/*
	 * Returns either a beer object or an array of beer or breweries
	 * In this function it decides which object to create
	 */

	public function __construct(string $type, array $data = array())
	{
		$this->type = $type;
		$this->data = $data;

	}

	public function create()
	{
		switch (strtolower($this->type)) {
			case "beer":
				return self::parseBeer($this->data);
			case "beer_list":
				return self::parseBeerList($this->data);
			case "brewery_list":
				return self::parseBreweryList($this->data);
			default:
				throw new \RuntimeException("Type not recognised");
				break;
		}
	}

	private function parseBeer(array $data):BeerModel
	{
		$parsed_data = array(
			'id' => $data['id'],
			'name' => $data['name'],
			'description' => $data['description'] ?? '',
			'labels' => $data['labels'] ?? array(),
			'breweries' => array()
		);

		if(array_key_exists('breweries', $data)){ //may not have
			foreach($data['breweries'] as $brewery){
				array_push($parsed_data['breweries'], $brewery['id']);
			}
		}
		return new BeerModel($parsed_data);

	}

	private function parseBeerList(array $results):array
	{
		$beer_list = array();
		foreach($results as $result){
			array_push($beer_list, self::parseBeer($result));
		}
		return $beer_list;
	}

	private function parseBreweryList(array $results):array
	{
		$beer_list = array();
		foreach($results as $result){
			array_push($beer_list, self::parseBrewery($result));
		}
		return $beer_list;
	}

	private function parseBrewery($data):BreweryModel
	{
		$parsed_data = array(
			'id' => $data['id'],
			'name' => $data['name'],
			'description' => $data['description'] ?? '',
			'images' =>  $data['images'] ?? array(),
			'website' => $data['website'] ?? ''
		);
		return new BreweryModel($parsed_data);

	}

}