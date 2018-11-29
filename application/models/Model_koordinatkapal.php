<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Model_koordinatkapal extends CI_Model{
 
    public function create($kapal,$latitude,$longitude){
        $data = array('kapal_id' => $kapal,
        'latitude'=>$latitude,
        'longitude'=>$longitude);
        $query = $this->db->insert('koordinatkapal', $data);
        return $query;
    }
    public function getAll(){
        $this->db->select('*');
        $this->db->from('koordinatkapal');
        $this->db->join('kapal', 'kapal.id_kapal = koordinatkapal.kapal_id');
        $query = $this->db->get();
        return $query;
    }
    public function read($id){
        $this->db->select('*');
        $this->db->from('koordinatkapal');
        $this->db->join('kapal', 'kapal.id_kapal = koordinatkapal.kapal_id');
        $this->db->where('id_koordinatkapal', $id);
        $query = $this->db->get();
        return $query;
    }
    public function update($kapal,$latitude,$longitude,$id){
        $data = array('kapal_id' => $kapal,
        'latitude'=>$latitude,
        'longitude'=>$longitude);
        $this->db->where('id_koordinatkapal', $id);
        $query = $this->db->update('koordinatkapal',$data);
        return $query;
    }
    public function delete($id){
        $this->db->where('id_koordinatkapal', $id);
        $query = $this->db->delete('koordinatkapal');
        return $query;
    }
 
}
