<?php
/**
 * Created by PhpStorm.
 * User: shanequaid
 * Date: 12/11/2017
 * Time: 23:18
 */

namespace library\api;

use library\models\Brewery;
use PHPUnit\Framework\TestCase;
use library\models\Beer;
use library\api\BreweryDPFactory;

class BreweryDPFactoryTest extends TestCase
{
	public static function breweriesTestArray()
	{
		return array(
			0 => array(
				'id'          => 'id0',
				'name'        => 'name0',
				'description' => 'description0'
			),
			1 => array(
				'id'          => 'id1',
				'name'        => 'name1',
				'description' => 'description1'
			),
		);
	}

	public static function beersTestArray()
	{
		return array(
			0 => array(
				'id'          => 'id0',
				'name'        => 'name0',
				'description' => 'description0'
			),
			1 => array(
				'id'          => 'id1',
				'name'        => 'name1',
				'description' => 'description1'
			),
		);
	}

	public function test_create_beer()
	{
		$data = self::beersTestArray()[0];
		$brewery_dp_factory = new BreweryDPFactory('beer', $data);
		$beer = $brewery_dp_factory->create();
		self::assertInstanceOf(Beer::class, $beer);
	}

	public function test_create_brewery_list()
	{
		$data = self::breweriesTestArray();
		$brewery_dp_factory = new BreweryDPFactory('brewery_list', $data);
		$list = $brewery_dp_factory->create();
		self::assertTrue(is_array($list));
		foreach($list as $brewery) {
			self::assertInstanceOf(Brewery::class, $brewery);
		}
	}

	public function test_create_beer_list()
	{
		$data = self::beersTestArray();
		$brewery_dp_factory = new BreweryDPFactory('beer_list', $data);
		$list = $brewery_dp_factory->create();
		self::assertTrue(is_array($list));
		foreach($list as $brewery) {
			self::assertInstanceOf(Beer::class, $brewery);
		}
	}

	public function test_parseBeer()
	{
		$data = self::beersTestArray()[0];
		$private_method = self::getMethod('parseBeer');
		$brewery_dp_factory = new BreweryDPFactory('beer', $data);
		$beer = $private_method->invokeArgs($brewery_dp_factory, array($data));
		self::assertInstanceOf(Beer::class, $beer);
	}

	public function test_parseBrewery()
	{
		$data = self::breweriesTestArray()[0];
		$private_method = self::getMethod('parseBrewery');
		$brewery_dp_factory = new BreweryDPFactory('brewery_list', $data);
		$brewery = $private_method->invokeArgs($brewery_dp_factory, array($data));
		self::assertInstanceOf(Brewery::class, $brewery);
	}

	protected static function getMethod($name)
	{
		$class = new \ReflectionClass('library\api\BreweryDPFactory');
		$method = $class->getMethod($name);
		$method->setAccessible(true);

		return $method;
	}

	public function test_parseBreweryList()
	{
		$data = self::breweriesTestArray();
		$private_method = self::getMethod('parseBreweryList');
		$brewery_dp_factory = new BreweryDPFactory('brewery_list', $data);
		$list = $private_method->invokeArgs($brewery_dp_factory, array($data));

		self::assertTrue(is_array($list));
		foreach($list as $brewery) {
			self::assertInstanceOf(Brewery::class, $brewery);
		}
	}

	public function test_parseBeerList()
	{
		$data = self::beersTestArray();
		$private_method = self::getMethod('parseBeerList');
		$brewery_dp_factory = new BreweryDPFactory('beer_list', $data);
		$list = $private_method->invokeArgs($brewery_dp_factory, array($data));

		self::assertTrue(is_array($list));
		foreach($list as $beer) {
			self::assertInstanceOf(Beer::class, $beer);
		}
	}

}
