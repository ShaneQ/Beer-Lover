<?php

namespace library\utils;


class ListOutputter
{
	private $list;
	
	public function __construct(array $list)
	{
		$this->list = $list;
	}
	public function JSON(){
		$json = array();
		foreach($this->list as $model){
			array_push($json, $model->toArray());
		}
		return json_encode($json);
	}

}