<?php

class Premium extends MY_Controller
{
	public function home(){
		$this->shouldBeLoggedIn();
		$beerAPI = new \library\api\Beer();
		$beer = $beerAPI->getRandom();
		$this->load->view('brewery_premium', $data = array('beer' => $beer));
	}

	public function profileSettings(){
		$this->shouldBeLoggedIn();
		$this->load->view('profile_settings');
	}

	public function saveBeer(){
		$this->shouldBeLoggedIn();
		$this->load->model(array('BeerFavourite'));
		$id_user = $this->getLoggedInUser();
		$this->BeerFavourite->create($id_user, $_POST['beer_name'], $_POST['beer_code']);
	}

	public function searchHistory(){
		$this->shouldBeLoggedIn();
		$id_user = $this->getLoggedInUser();

		$this->load->model(array('SearchHistory'));
		$searches = $this->SearchHistory->getUserSearches($id_user);
		$this->load->view('search_history', $data = array('results' => $searches));
	}

	public function deleteSpecificHistory(){
		$this->shouldBeLoggedIn();
		$id_user = $this->getLoggedInUser();
		$this->load->model(array('SearchHistory'));
		$this->SearchHistory->delete($id_user, $_POST['id_search_history']);
		$this->searchHistory();

	}

	public function viewFavouriteBeerList(){
		$this->shouldBeLoggedIn();
		$id_user = $this->getLoggedInUser();
		$this->load->model(array('BeerFavourite'));
		$beers = $this->BeerFavourite->getBeers($id_user);
		$this->load->view('favourite_beers', $data = array('results' => $beers));

	}

	public function deleteSpecificFavouriteBeer(){
		$this->shouldBeLoggedIn();
		$id_user = $this->getLoggedInUser();
		$this->load->model(array('BeerFavourite'));
		$beers = $this->BeerFavourite->delete($id_user, $_POST['id_beer_favourite']);
		$this->viewFavouriteBeerList();

	}

	public function specificBeer(){
		$this->shouldBeLoggedIn();
		$id_user = $this->getLoggedInUser();
		$beerAPI = new \library\api\Beer();
		$beer = $beerAPI->getBeerById($_POST['code']);
		$this->load->model(array('BeerFavourite'));
		$beers = $this->BeerFavourite->getBeers($id_user);
		$this->load->view('favourite_beers', $data = array('results' => $beers,'beer' => $beer));

	}

	public function search(){
		$this->shouldBeLoggedIn();
		$this->load->view('search_view', $data = array());
	}
	public function searchSpecificBeer(){
		$this->shouldBeLoggedIn();
		if($_POST['search_type'] == 1){
			$this->load->view('search_view', $data = array('search_beer' =>$_POST['search_term']));
		}else{
			$this->load->view('search_view', $data = array('search_brewery' =>$_POST['search_term']));
		}

	}





}