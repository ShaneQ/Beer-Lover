<?php
/**
 * Created by PhpStorm.
 * User: shanequaid
 * Date: 11/11/2017
 * Time: 20:52
 */

namespace library\models;

interface Displayable
{
	public function toArray():array ;
	public function isDisplayable():bool;

}