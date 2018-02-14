<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Template
{
  protected $_CI;

	public function __construct()
	{
        $this->_CI =& get_instance();
	}

    function view($template,$data=null){
        $data['_navbar']=$this->_CI->load->view('templates/main/mainnav',$data,true);
        
        $data['_sidebar']=$this->_CI->load->view('templates/main/wali/waliside',$data,true);
        
        $data['_content']=$this->_CI->load->view($template,$data,true);
               
        $this->_CI->load->view('templates/main/tmain',$data);
    }
    
}