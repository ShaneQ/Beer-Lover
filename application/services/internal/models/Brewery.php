<?php

namespace library\models;

class Brewery implements Displayable
{

	private $id;
	private $name;
	private $website;
	private $description;
	private $images;

	public function __construct(array $data)
	{
		$this->setId($data['id']);
		$this->setName($data['name']);
		$this->setImages($data['images']);
		$this->setDescription($data['description']);
		$this->setWebsite($data['website']);

	}


	public function getId():string
	{
		return $this->id;
	}


	public function getDescription():string
	{
		return $this->description;
	}


	public function setDescription(string $description)
	{
		$this->description = $description;
	}


	public function setId(string $id)
	{
		$this->id = $id;
	}


	public function getName():string
	{
		return $this->name ?? '';
	}


	public function setName(string $name)
	{
		$this->name = $name;
	}


	public function getWebsite():string
	{
		return $this->website;
	}


	public function setWebsite(string $website)
	{
		$this->website = $website;
	}


	public function getImages():array
	{
		return $this->images;
	}

	public function setImages(array $images)
	{
		$this->images = $images;
	}

	//returns a default image if none found should have implemented this on the front end instead but have ran out of time
	public function getImg(string $img_id):string
	{
		return $this->images[$img_id] ?? "http://commoncdn.entrata.com/images/jquery/galleria/image-not-found.png";
	}

	public function toString(){
		return $this->getId().' '. $this->getName();
	}

	public function toArray():array
	{
		$arr = array(
			'id'=>$this->getId(),
			'name'=>$this->getName(),
			'description'=>$this->getDescription(),
			'image'=>$this->getImg('medium')
		);
		return $arr;
	}

	public function isDisplayable():bool
	{
		if(isset($this->getImages()['icon']) && strlen($this->getDescription()) > 1){
			return true;
		}else{
			return false;
		}
	}



}