<?php
/**
 * Created by PhpStorm.
 * User: shanequaid
 * Date: 13/11/2017
 * Time: 00:06
 */

namespace library\models;

use PHPUnit\Framework\TestCase;
use library\models\Beer;

class BeerTest extends TestCase
{
	public static function beerTestArray()
	{
		return array(
			0 => array(
				'id'          => 'id0',
				'name'        => 'name0',
				'description' => 'description0',
				'labels'      => array(
					'icon' => 'test1',
					'large' => 'test2',
					'medium' => 'test3'
				),
				'breweries'   => array(1)
			),
			1 => array(
				'id'          => 'Newid0',
				'name'        => 'Newname0',
				'description' => 'Newdescription0',
				'labels'      => array(
					'icon' => 'Newtest1',
					'large' => 'Newtest2',
					'medium' => 'Newtest3'
				),
				'breweries'   => array(2)
			),
		);
	}

	public function test_getters()
	{
		$data = self::beerTestArray()[0];
		$beer = new Beer($data);
		self::assertEquals($data['id'], $beer->getId());
		self::assertEquals($data['name'], $beer->getName());
		self::assertEquals($data['description'], $beer->getDescription());
		self::assertEquals($data['labels']['icon'], $beer->getImage('icon'));
		self::assertEquals($data['labels']['medium'], $beer->getImage('medium'));
		self::assertEquals($data['labels']['large'], $beer->getImage('large'));
		self::assertEquals($data['labels'], $beer->getImages());
		self::assertEquals($data['breweries'], $beer->getBreweries());
	}

	public function test_hasDescription_true(){
		$data = self::beerTestArray()[0];
		$beer = new Beer($data);
		self::assertTrue($beer->hasDescription());
	}

	public function test_fail_hasDescription_false(){
		$data = self::beerTestArray()[0];
		$private_method = self::getMethod('setDescription');
		$beer = new Beer($data);
		$private_method->invokeArgs($beer, array(''));

		self::assertFalse($beer->hasDescription());
	}

	public function test_isDisplayable_true(){
		$data = self::beerTestArray()[0];
		$beer = new Beer($data);
		self::assertTrue($beer->isDisplayable());
	}

	public function test_isDisplayable_false_1(){
		$data = self::beerTestArray()[0];
		$private_method = self::getMethod('setDescription');
		$beer = new Beer($data);
		$private_method->invokeArgs($beer, array(''));
		self::assertFalse($beer->isDisplayable());
	}
	public function test_isDisplayable_false_2(){
		$data = self::beerTestArray()[0];
		$private_method = self::getMethod('setImages');
		$beer = new Beer($data);
		$private_method->invokeArgs($beer, array(array()));
		self::assertFalse($beer->isDisplayable());
	}
	public function test_isDisplayable_false_3(){
		$data = self::beerTestArray()[0];
		$beer = new Beer($data);
		$private_method = self::getMethod('setImages');
		$private_method->invokeArgs($beer, array(array()));

		$private_method = self::getMethod('setDescription');
		$private_method->invokeArgs($beer, array(''));

		self::assertFalse($beer->isDisplayable());
	}

	public function test_setters()
	{
		$data = self::beerTestArray()[0];
		$data_new = self::beerTestArray()[1];

		$private_method = self::getMethod('setId');
		$beer = new Beer($data);
		$private_method->invokeArgs($beer, array($data_new['id']));
		self::assertEquals($data_new['id'], $beer->getId());

		$private_method = self::getMethod('setName');
		$beer = new Beer($data);
		$private_method->invokeArgs($beer, array($data_new['name']));
		self::assertEquals($data_new['name'], $beer->getName());

		$private_method = self::getMethod('setDescription');
		$beer = new Beer($data);
		$private_method->invokeArgs($beer, array($data_new['description']));
		self::assertEquals($data_new['description'], $beer->getDescription());

		$private_method = self::getMethod('setDescription');
		$beer = new Beer($data);
		$private_method->invokeArgs($beer, array($data_new['description']));
		self::assertEquals($data_new['description'], $beer->getDescription());

		$private_method = self::getMethod('setBreweries');
		$beer = new Beer($data);
		$private_method->invokeArgs($beer, array($data_new['breweries']));
		self::assertEquals($data_new['breweries'], $beer->getBreweries());

		$private_method = self::getMethod('setImages');
		$beer = new Beer($data);
		$private_method->invokeArgs($beer, array($data_new['labels']));
		self::assertEquals($data_new['labels'], $beer->getImages());

	}

	protected static function getMethod($name)
	{
		$class = new \ReflectionClass('library\models\Beer');
		$method = $class->getMethod($name);
		$method->setAccessible(true);

		return $method;
	}

}
