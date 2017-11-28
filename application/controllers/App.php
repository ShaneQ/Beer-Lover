<?php
header('Access-Control-Allow-Origin: *');
defined('BASEPATH') OR exit('No direct script access allowed');
use Respect\Validation\Validator as v;
class App extends MY_Controller {



	public function index()
	{
		$beerAPI = new \library\api\Beer();
		$beer = $beerAPI->getRandom();
		if($this->is_logged_in()){
			$this->load->view('brewery_premium', $data = array('beer' => $beer));
		}else{
			$this->load->view('brewery_basic', $data = array('beer' => $beer));
		}
	}
	/*
	 * Returns http error when handed an invalid request
	 * Both beer and brewery have an interface searchable so we know they will both have function search
	 *
	 */

	public function search()
	{
		$query_validator = v::alnum('-');
		$query_type_validator = v::numeric()->between(1,2);
		if(!$query_validator->validate($_POST['query']) || !$query_type_validator->validate($_POST['query_type'])){
			header('HTTP/1.0 400 Bad Request');
			return;
		}
		$types = array(
			1=>'beer',
			2=>'brewery'
		);
		$id_user = $this->getLoggedInUser();


		$search = new \library\api\Search();
		$list = $search->execute($types[$_POST['query_type']], $_POST['query'],false);
		if($id_user && $_POST['query_type'] == 1){
			$this->load->model('SearchHistory');
			$this->SearchHistory->create($id_user, $_POST['query'], count($list));
		}
		$outputter = new \library\utils\ListOutputter($list);
		echo $outputter->JSON();

	}

	public function randomBeer()
	{
		$beerApi = new \library\api\Beer();
		$beer = $beerApi->getRandom();
		$outputter = new \library\utils\BeerOutputter($beer);
		echo $outputter->JSON();
	}

	public function beerByBrewery()
	{
		$queryValidator = v::alnum(',');
		if(!$queryValidator->validate($_POST['breweries'])){
			header('HTTP/1.0 400 Bad Request');
			return;
		}
		$ids = explode(',', $_POST['breweries']);
		$beerApi = new \library\api\Beer();
		$beers =  $beerApi->getByBrewery($ids, false);
		$outputter = new \library\utils\ListOutputter($beers);
		echo $outputter->JSON();

	}
}
