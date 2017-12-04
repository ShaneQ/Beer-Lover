<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Respect\Validation\Validator as v;
class Premium extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->shouldBeLoggedIn();
	}

	public function home()
	{
		$beerAPI = new \library\api\Beer();
		$beer = $beerAPI->getRandom();
		$this->load->view('brewery_premium', $data = array('beer' => $beer));
	}

	public function profileSettings()
	{
		$this->load->view('profile_settings');
	}

	public function saveBeer()
	{
		$this->load->library('form_validation');
		$this->load->model(array('BeerFavourite'));

		$this->form_validation->set_rules('beer_name', 'beer_name', 'required');
		$this->form_validation->set_rules('beer_code', 'beer_code', 'required|exact_length[6]|alpha_numeric');
		if($this->form_validation->run()) {
			$id_user = $this->getLoggedInUser();
			$this->BeerFavourite->create($id_user, $_POST['beer_name'], $_POST['beer_code']);
		}
	}

	public function searchHistory()
	{
		$id_user = $this->getLoggedInUser();
		$this->load->model(array('SearchHistory'));
		$searches = $this->SearchHistory->getUserSearches($id_user);
		$this->load->view('search_history', $data = array('results' => $searches));
	}

	public function deleteSpecificHistory()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('id_search_history', 'id_search_history', 'required|numeric');
		if($this->form_validation->run()) {
			$this->load->model(array('SearchHistory'));
			$id_user = $this->getLoggedInUser();
			$this->SearchHistory->delete($id_user, $_POST['id_search_history']);
		}
		$this->searchHistory();

	}

	public function viewFavouriteBeerList()
	{
		$id_user = $this->getLoggedInUser();
		$this->load->model(array('BeerFavourite'));
		$beers = $this->BeerFavourite->getBeers($id_user);
		$this->load->view('favourite_beers', $data = array('results' => $beers));
	}

	public function deleteSpecificFavouriteBeer()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('id_beer_favourite', 'id_beer_favourite', 'required|numeric');
		if($this->form_validation->run()) {
			$id_user = $this->getLoggedInUser();
			$this->load->model(array('BeerFavourite'));
			$this->BeerFavourite->delete($id_user, $_POST['id_beer_favourite']);
		}
		$this->viewFavouriteBeerList();
	}

	public function specificBeer()
	{
		$this->load->model(array('BeerFavourite'));
		$data = array();
		$id_user = $this->getLoggedInUser();
		$this->load->library('form_validation');
		$this->form_validation->set_rules('code', 'code', 'required|exact_length[6]|alpha_numeric');
		if($this->form_validation->run()) {
			$beerAPI = new \library\api\Beer();
			$data['beer'] = $beerAPI->getBeerById(htmlspecialchars($_POST['code']));
		}
		$data['results'] = $this->BeerFavourite->getBeers($id_user);
		$this->load->view('favourite_beers', $data);
	}

	public function search()
	{
		$this->load->view('search_view', $data = array());
	}

	public function searchSpecificBeer()
	{
		$query_validator = v::alnum('-');
		$query_type_validator = v::numeric()->between(1,2);
		if(!$query_validator->validate($_POST['search_term']) || !$query_type_validator->validate($_POST['search_type'])){
			$this->searchHistory();
		}else{
			if($_POST['search_type'] == 1) {
				$this->load->view('search_view', $data = array('search_beer' => $_POST['search_term']));
			}
			else {
				$this->load->view('search_view', $data = array('search_brewery' => $_POST['search_term']));
			}
		}
	}

}