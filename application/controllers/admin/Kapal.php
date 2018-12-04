<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Kapal extends CI_Controller{
 
    public function __construct()
    {
        parent::__construct();
        //kita load model yang dibutuhkan, yaitu model kapal
        $this->load->model(array('model_kapal'));
        $this->load->helper('url');
        $this->load->library('form_validation');
    }
 
    function index()
    {
        $data = array('content' => 'admin/formkapal',//kita buat file formkapal di dalam folder views/admin
        'itemkapal'=>$this->model_kapal->getAll());
        $this->load->view('templates/template-admin', $data);
    }

    function create(){
        if (!$this->input->is_ajax_request()) {
            show_404();
        }else{
            //kita validasi inputnya dulu
            $this->form_validation->set_rules('namakapal', 'Nama Kapal', 'trim|required');
            $this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required');
            if ($this->form_validation->run()==false) {
                $status = 'error';
                $msg = validation_errors();
            }else{
                if ($this->model_kapal->create()) {
                    $status = 'success';
                    $msg = "Data kapal berhasil disimpan";
                }else{
                    $status = 'error';
                    $msg = "terjadi kesalahan saat menyimpan data kapal";
                }
            }
            $this->output->set_content_type('application/json')->set_output(json_encode(array('status'=>$status,'msg'=>$msg)));
        }
    }

    function edit(){
        if (!$this->input->is_ajax_request()) {
            show_404();
        }else{
            //kita validasi inputnya dulu
            $this->form_validation->set_rules('id_kapal', 'ID Kapal', 'trim|required');
            if ($this->form_validation->run()==false) {
                $status = 'error';
                $msg = validation_errors();
            }else{
                $id = $this->input->post('id_kapal');
                if ($this->model_kapal->read($id)->num_rows()!=null) {
                    $status = 'success';
                    $msg = $this->model_kapal->read($id)->result();
                }else{
                    $status = 'error';
                    $msg = "Data kapal tidak ditemukan";
                }
            }
            $this->output->set_content_type('application/json')->set_output(json_encode(array('status'=>$status,'msg'=>$msg)));
        }
    }

    function update(){
        if (!$this->input->is_ajax_request()) {
            show_404();
        }else{
            //kita validasi inputnya dulu
            $this->form_validation->set_rules('namakapal', 'Nama Kapal', 'trim|required');
            $this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required');
            $this->form_validation->set_rules('id_kapal', 'ID Kapal', 'trim|required');
            if ($this->form_validation->run()==false) {
                $status = 'error';
                $msg = validation_errors();
            }else{
                $id = $this->input->post('id_kapal');
                if ($this->model_kapal->update($id)) {
                    $status = 'success';
                    $msg = "Data kapal berhasil diupdate";
                }else{
                    $status = 'error';
                    $msg = "terjadi kesalahan saat mengupdate data kapal";
                }
            }
            $this->output->set_content_type('application/json')->set_output(json_encode(array('status'=>$status,'msg'=>$msg)));
        }
    }

    function delete(){
        if (!$this->input->is_ajax_request()) {
            show_404();
        }else{
            //kita validasi inputnya dulu
            $this->form_validation->set_rules('id_kapal', 'ID Kapal', 'trim|required');
            if ($this->form_validation->run()==false) {
                $status = 'error';
                $msg = validation_errors();
            }else{
                $id = $this->input->post('id_kapal');
                if ($this->model_kapal->delete($id)) {
                    $status = 'success';
                    $msg = "Data kapal berhasil dihapus";
                }else{
                    $status = 'error';
                    $msg = "terjadi kesalahan saat menghapus data kapal";
                }
            }
            $this->output->set_content_type('application/json')->set_output(json_encode(array('status'=>$status,'msg'=>$msg)));
        }
    }

}