<?php

namespace library\models;

class Beer implements Displayable
{
	private $name;
	private $description;
	private $images;
	private $id;
	private $breweries = array();

	public function __construct(array $data)
	{
		$this->setName($data['name']);
		$this->setId($data['id']);
		$this->setImages($data['labels']);
		$this->setDescription($data['description']);
		$this->setBreweries($data['breweries']);
	}

	public function getBreweries():array
	{
		return $this->breweries;
	}

	private function setBreweries(array $breweries)
	{
		$this->breweries = $breweries;
	}

	public function getId(): string
	{
		return $this->id;
	}

	private function setId(string $id)
	{
		$this->id = $id;
	}

	public function getName(): string
	{
		return $this->name;
	}

	private function setName(string $name)
	{
		$this->name = $name;
	}
	//returns a default string if none found should have implemented this on the front end instead but have ran out of time
	public function getDescription(): string
	{
		if($this->hasDescription()){
			return $this->description;
		}else{
			return 'No description found';
		}
	}

	private function setDescription(string $description)
	{
		$this->description = $description;
	}

	public function getImages(): array
	{
		return $this->images ?? array();
	}

	private function setImages(array $images)
	{
		$this->images = $images;
	}

	public function isDisplayable():bool
	{
		if(isset($this->getImages()['icon']) && $this->hasDescription()){
			return true;
		}else{
			return false;
		}
	}
	//returns a default image if none found should have implemented this on the front end instead but have ran out of time
	public function getImage(string $id):string
	{
		return $this->getImages()[$id] ?? "http://commoncdn.entrata.com/images/jquery/galleria/image-not-found.png";
	}

	public function hasDescription():bool
	{
		if(strlen($this->description) > 1){
			return true;
		}else{
			return false;
		}
	}

	public function toArray():array
	{
		$arr = array(
			'id'=>$this->getId(),
			'name'=>$this->getName(),
			'description'=>$this->getDescription(),
			'image'=>$this->getImage('icon'),
			'breweries'=>$this->getBreweries()
		);
		return $arr;
	}


}