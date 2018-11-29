<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Model_kapal extends CI_Model{
 
    public function create(){
        $data = array('namakapal' => $this->input->post('namakapal'),
        'keterangan'=>$this->input->post('keterangan'));
        $query = $this->db->insert('kapal', $data);
        return $query;
    }
    public function getAll(){
        $query = $this->db->get('kapal');
        return $query;
    }
    public function read($id){
        $this->db->where('id_kapal', $id);
        $query = $this->db->get('kapal');
        return $query;
    }
    public function delete($id){
        $this->db->where('id_kapal', $id);
        $query = $this->db->delete('kapal');
        return $query;
    }
    public function update($id){
        $data = array('namakapal' => $this->input->post('namakapal'),
        'keterangan'=>$this->input->post('keterangan'));
        $this->db->where('id_kapal', $id);
        $query = $this->db->update('kapal', $data);
        return $query;
    }
 
}