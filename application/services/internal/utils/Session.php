<?php

namespace library\utils;

abstract class Session
{

	public static function start(){
		if (session_status() != PHP_SESSION_ACTIVE) {
			session_start();
		}

	}
	public static function getUserKey()
	{
		self::start();
		if(array_key_exists('user_key', $_SESSION)){
			return $_SESSION['user_key'];
		}else{
			return 'nopes';
		}

	}

	public static function print()
	{
		self::start();
		echo'<pre>';print_r($_SESSION);echo'</pre>';
	}

	public static function setUserKey(string $user_key)
	{
		self:self::start();
		$_SESSION['user_key'] = $user_key;
	}

	public static function remove(){
		self::start();
		session_unset();
		session_destroy();
	}
}