<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Model_rute extends CI_Model{
 
    public function create(){
        $data = array('namarute' => $this->input->post('namarute'),
        'keterangan'=>$this->input->post('keterangan'));
        $query = $this->db->insert('rute', $data);
        return $query;
    }
    public function getAll(){
        $query = $this->db->get('rute');
        return $query;
    }
    public function read($id){
        $this->db->where('id_rute', $id);
        $query = $this->db->get('rute');
        return $query;
    }
    public function delete($id){
        $this->db->where('id_rute', $id);
        $query = $this->db->delete('rute');
        return $query;
    }
    public function update($id){
        $data = array('namarute' => $this->input->post('namarute'),
        'keterangan'=>$this->input->post('keterangan'));
        $this->db->where('id_rute', $id);
        $query = $this->db->update('rute', $data);
        return $query;
    }
 
}