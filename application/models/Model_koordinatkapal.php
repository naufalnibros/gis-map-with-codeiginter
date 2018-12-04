<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Model_koordinatkapal extends CI_Model {
 
    public function create(){
        $data = array('id_kapal' => $this->input->post('id_kapal'),
            'latitude'=>$this->input->post('latitude'),
            'longitude'=>$this->input->post('longitude'));
        $query = $this->db->insert('koordinatkapal', $data);
        return $query;
    }
    public function getAll(){
        $query = $this->db->get('koordinatkapal');//mengambil semua data koordinat kapal
        return $query;
    }
    public function getbyidkapal($id){
        $this->db->where('id_kapal', $id);
        $query = $this->db->get('koordinatkapal');
        return $query;
    }
    public function read($id){
        $this->db->where('id_koordinatkapal', $id);//mengambil data koordinat kapal berdasarkan id_koordinatkapal
        $query = $this->db->get('koordinatkapal');
        return $query;
    }
    public function update(){
        $data = array('id_kapal'=>$this->input->post('id_kapal'),
            'latitude'=>$this->input->post('latitude'),
            'longitude'=>$this->input->post('longitude'));
        $this->db->where('id_koordinatkapal', $this->input->post('id_koordinatkapal'));//mengupdate berdasarkan id_koordinatkapal
        $query = $this->db->update('koordinatkapal', $data);
        return $query;
    }
    public function delete(){
        $this->db->where('id_koordinatkapal', $this->input->post('id_koordinatkapal'));//menghapus berdasarkan id_koordinatkapal
        $query = $this->db->delete('koordinatkapal');
        return $query;
    }
    public function deletebyidkapal($id){
        $this->db->where('id_kapal', $id);
        $query = $this->db->delete('koordinatkapal');
        return $query;
    }
 
}
 
/* End of file model_koordinatkapal.php */
/* Location: ./application/models/model_koordinatkapal.php */