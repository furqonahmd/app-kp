<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Container\Container;

class Orm
{
	protected $_CI;
	
	function __construct()
	{
		$this->_CI =& get_instance();
		$capsule = new Capsule;
		$capsule->addConnection([
			'driver' => 'mysql',
			'host' => 'localhost',
			'database'  => 'kelas',
			'username' => 'root',
			'password' => '',
		]);
		$capsule->setAsGlobal();
		$capsule->bootEloquent();
	}
}