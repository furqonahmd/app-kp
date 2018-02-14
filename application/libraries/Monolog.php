<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Monolog
{
	protected $_CI;
	
	function __construct()
	{
		$this->_CI =& get_instance();
		$log = new Monolog\Logger('Codeigniter');
		$log->pushHandler(new Monolog\Handler\StreamHandler(__DIR__ . '/../logs/app.log', Monolog\Logger::DEBUG));
		$this->log = $log;
	}

	function debug($message, $context = [])
	{
		$this->log->debug($message, $context);
	}

	function info($message, $context = [])
	{
		$this->log->info($message, $context);
	}

	function warning($message, $context = [])
	{
		$this->log->warning($message, $context);
	}

	function error($message, $context = [])
	{
		$this->log->error($message, $context);
	}

	function critical($message, $context = [])
	{
		$this->log->critical($message, $context);
	}

	function alert($message, $context = [])
	{
		$this->log->alert($message, $context);
	}

	function emergency($message, $context = [])
	{
		$this->log->emergency($message, $context);
	}
}