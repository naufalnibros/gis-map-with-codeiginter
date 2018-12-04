<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_user extends CI_Model{
  public function login($params){
    $params['password'] = sha1($params['password']);
    $models = $this->db->get_where('user', array('username' => $params['username'], 'password' => $params['password']))->row();
    return $models;
  }
}
