<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller{

	public function __construct(){
		parent::__construct();
    $this->load->model(['model_user']);
    $this->load->library(['form_validation']);
    $this->load->helper('url');
	}

	function index(){
    $this->load->view('admin/login');
	}

  function login_user(){
    $login = $this->model_user->login($this->input->post());
    if (empty($login)) {
      redirect('/', 'refresh');
    } else {
      $this->session->set_userdata('logged_in', ['username' => $login->username]);
      redirect('/admin/rute', 'refresh');
    }
  }

  function logout_user(){
    $this->session->unset_userdata('logged_in', []);
    redirect('/', 'refresh');
  }

}
