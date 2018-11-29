<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Model_koordinatrute extends CI_Model{
 
    public function create($rute,$latitude,$longitude){
        $data = array('rute_id' => $rute,
        'latitude'=>$latitude,
        'longitude'=>$longitude);
        $query = $this->db->insert('koordinatrute', $data);
        return $query;
    }
    public function getAll(){
        $this->db->select('*');
        $this->db->from('koordinatrute');
        $this->db->join('rute', 'rute.id_rute = koordinatrute.rute_id');
        $query = $this->db->get();
        return $query;
    }
    public function read($id){
        $this->db->select('*');
        $this->db->from('koordinatrute');
        $this->db->join('rute', 'rute.id_rute = koordinatrute.rute_id');
        $this->db->where('id_koordinatrute', $id);
        $query = $this->db->get();
        return $query;
    }
    public function update($rute,$latitude,$longitude,$id){
        $data = array('rute_id' => $rute,
        'latitude'=>$latitude,
        'longitude'=>$longitude);
        $this->db->where('id_koordinatrute', $id);
        $query = $this->db->update('koordinatrute',$data);
        return $query;
    }
    public function delete($id){
        $this->db->where('id_koordinatrute', $id);
        $query = $this->db->delete('koordinatrute');
        return $query;
    }
 
}