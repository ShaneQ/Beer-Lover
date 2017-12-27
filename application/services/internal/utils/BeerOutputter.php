<?php

namespace library\utils;

use library\models\Beer;

class BeerOutputter
{
	private $beer;
	
	public function __construct(Beer $beer)
	{
		$this->beer = $beer;
	}
	public function JSON(){
		return json_encode($this->beer->toArray());
	}

}