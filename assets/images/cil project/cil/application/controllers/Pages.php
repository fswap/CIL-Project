<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 
   class Pages extends CI_Controller
   {  
   	public function index()
	{    
		$this->load->view('templates/header');
		$this->load->view('pages/mainpage');
		$this->load->view('templates/footer');
	}
   } 
?>