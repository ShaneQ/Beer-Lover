<?php
namespace library\api;

class BreweryDB
{
	const api_key = 'ba654829e49344f3bb6a76d465c9a485';
	const base_url = 'http://api.brewerydb.com/v2/';
	private $api;


	public function __construct()
	{
		$this->api = new \Pintlabs_Service_Brewerydb(static::api_key,static::base_url);
		$this->api->setFormat('PHP');
	}

	/*
	 * Creating object using factory method, also using tail end recursion to meet spec requirements that random beers must have a description
	 * yet i put a limit on it to guarantee api calls are minimised
	 * Also using code ignighters error display functions when encountering an unavoidable errors
	 */

	public function request(string $type, string $end_point, array $params, int $remaining_attempts, bool $has_img_and_desc)
	{

		$remaining_attempts--;

		/*
		This is the code for caching the results in the seeion, i had difficulty with the frameworks session configuration so i decided to move past this
		section, but the below code is what i would use to make sure data was cached to save api calls and speed up session calls
		checks cache to see if it exists already except if random as that will never need to be cached/

		$key = str_replace('/','_', $end_point). implode('_', $params);
		session_start();
		if($end_point !== 'beer/random' ){
			if(array_key_exists($key, $_SESSION)){
				$result = $_SESSION[$key];
			}else{
				$result = $this->api->request($end_point, $params, 'GET');
				$_SESSION[$key] = $result;
			}
		}else {
			$result = $this->api->request($end_point, $params, 'GET');
		}
		*/
		$result = $this->api->request($end_point, $params, 'GET');

		if($result['status'] === 'success'){

			$breweryFactory = new BreweryDPFactory($type, $result['data'] ?? array() );
			$item = $breweryFactory->create();
			if($remaining_attempts > 0 && $type === 'beer' && !$item->isDisplayable() ) {
				return $this->request($type, $end_point,  $params, $remaining_attempts, $has_img_and_desc);
			}
			return $item;
		}else{
			if($result['errorMessage'] === 'You have hit your API limit for the day (400 Requests Per Day)'){
				show_error('We seem to have maxed out our api and need to wait for it to cool down, please check back later', 400, $heading = 'Api Error');
			}else{
				show_error('Even happens to google, will be fixed when Jira raised', 400, $heading = 'Technical Difficulties');
			}
		}
	}

}