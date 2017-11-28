<?php
/**
 * Created by PhpStorm.
 * User: shanequaid
 * Date: 27/11/2017
 * Time: 19:04
 */

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
		$this->load->model(array('BeerFavourite'));
		$id_user = $this->getLoggedInUser();
		$this->BeerFavourite->create($id_user, $_POST['beer_name'], $_POST['beer_code']);
	}

}