<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 紀錄SESSION
*/
class session
{
	private static $_sess ;
	
	public function __construct()
	{
		self::$_sess = & get_instance()->session ;
	}

}
?>