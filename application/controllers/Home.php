<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller{

	public function __construct()
	{
		parent::__construct();
		//Codeigniter : write less do more
	}
	
	function index()
	{
		//echo "Hai... Welcome to Aplikasi Trayek";
		$this->load->view('homepage');
	}
	
}