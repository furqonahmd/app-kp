<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

if (! function_exists('segment')) {
	function segment($data) 
	{
		$CI =& get_instance();
		return $CI->uri->segment($data);
	}
}

if (! function_exists('fullname')) {
	function fullname()
	{
		$f = \Faker\Factory::create('id_ID');
		return $f->firstName . ' ' . $f->lastName;
	}
}

if (! function_exists('phone')) {
	function phone()
	{
		return substr(collect(['085', '081', '089', '088', '083', '087', '082'])->random() . str_shuffle('1234567890'), 0, 12);
	}
}

if (! function_exists('carbon')) {
	function carbon()
	{
		return Carbon\Carbon::now();
	}
}

if (! function_exists('flash')) {
	function flash($data = null)
	{
		$CI =& get_instance();
		return $CI->session->flashdata($data);
	}
}

if (! function_exists('auth')) {
	function auth()
	{
		if (isset($_SESSION['logged_in'])) {
			if ($_SESSION['logged_in'] == true) {
				return true; 
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
}
