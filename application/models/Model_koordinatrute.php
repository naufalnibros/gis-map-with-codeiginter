<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Model_koordinatrute extends CI_Model {
 
    public function create(){
        foreach ($this->cart->contents() as $koordinat) {
            $data = array('id_rute' => $this->input->post('id_rute'),
                'latitude'=>$koordinat['latitude'],
                'longitude'=>$koordinat['longitude']);
            $query = $this->db->insert('koordinatrute', $data);
        }
        return $query;
    }
    public function getAll(){
        $query = $this->db->get('koordinatrute');//mengambil semua data koordinat rute
        return $query;
    }
    public function getbyidrute($id){
        $this->db->where('id_rute', $id);
        $query = $this->db->get('koordinatrute');//mengambil semua data koordinat rute
        return $query;
    }
    public function read($id){
        $this->db->where('id_koordinatrute', $id);//mengambil data koordinat rute berdasarkan id_koordinatrute
        $query = $this->db->get('koordinatrute');
        return $query;
    }
    public function update(){
        $data = array('id_rute'=>$this->input->post('id_rute'),
            'latitude'=>$this->input->post('latitude'),
            'longitude'=>$this->input->post('longitude'));
        $this->db->where('id_koordinatrute', $this->input->post('id_koordinatrute'));//mengupdate berdasarkan id_koordinatrute
        $query = $this->db->update('koordinatrute', $data);
        return $query;
    }
    public function delete(){
        $this->db->where('id_koordinatrute', $this->input->post('id_koordinatrute'));//menghapus berdasarkan id_koordinatrute
        $query = $this->db->delete('koordinatrute');
        return $query;
    }
    public function deletebyidrute($id){
        $this->db->where('id_rute', $id);//menghapus berdasarkan id_koordinatrute
        $query = $this->db->delete('koordinatrutee');
        return $query;
    }
 
}
 
/* End of file model_koordinatrute.php */
/* Location: ./application/models/model_koordinatrute.php */