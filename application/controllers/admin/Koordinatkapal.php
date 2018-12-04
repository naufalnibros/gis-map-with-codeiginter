<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Koordinatkapal extends CI_Controller{
 
    public function __construct()
    {
        parent::__construct();
        //kita load model yang dibutuhkan, yaitu model kapal
        $this->load->model(array('model_kapal','model_koordinatkapal'));
        $this->load->helper('url');
        $this->load->library('form_validation');
    }

    function index()
    {
        $data = array('content' => 'admin/formkoordinatkapal',//kita buat file formkapal di dalam folder views/admin
        'itemkapal'=>$this->model_kapal->getAll()),
        'itemkoordinat'=>$this->model_koordinatkapal->getAll());
        $this->load->view('templates/template-admin', $data);
    }

    public function koordinatkapal(){
        $data = array('content' => 'admin/koordinatkapalform',
            'itemdatakapal'=>$this->model_kapal->getAll(),
            'itemkoordinatkapal'=>$this->model_koordinatkapal->getAll());
        $this->load->view('templates/template', $data, FALSE);
    }
    function simpandaftarkoordinatkapal(){
        if (!$this->input->is_ajax_request()) {
            show_404();
        }else{
            $this->load->library('form_validation');
            $this->form_validation->set_rules('id_kapal', 'Data kapal', 'trim|required');
            if ($this->form_validation->run()==false) {
                $status = 'error';
                $msg = validation_errors();
            }else{
                if ($this->model_koordinatkapal->getbyidkapal($this->input->post('id_kapal'))->num_rows()!=null) {
                    $status = 'error';
                    $msg = 'marker kapal yang bersangkutan sudah ada, hapus terlebih dahulu';
                }else{
                    if ($this->model_koordinatkapal->create()) {
                        $status = 'success';
                        $msg = 'data berhasil disimpan';
                    }else{
                        $status = 'error';
                        $msg = 'terjadi kesalahan saat menyimpan koordinat';
                    }
                }
            }
            $this->output->set_content_type('application/json')->set_output(json_encode(array('status'=>$status,'msg'=>$msg)));
        }
    }
    function hapusmarkerkapal(){
        if (!$this->input->is_ajax_request()) {
            show_404();
        }else{
            if ($this->model_koordinatkapal->deletebyidkapal($this->input->post('id_kapal'))) {
                $status = 'success';
                $msg = 'data berhasil dihapus';
            }else{
                $status = 'error';
                $msg = 'terjadi kesalahan saat menghapus data';
            }
            $this->output->set_content_type('application/json')->set_output(json_encode(array('status'=>$status,'msg'=>$msg)));
        }
    }
    function viewmarkerkapal(){
        if (!$this->input->is_ajax_request()) {
            show_404();
        }else{
            if ($this->model_koordinatkapal->getbyidkapal($this->input->post('id_kapal'))->num_rows()!=null){
                $status = 'success';
                $msg = $this->model_koordinatkapal->getbyidkapal($this->input->post('id_kapal'))->result();
                $datakapal = $this->model_kapal->read($this->input->post('id_kapal'))->result();
            }else{
                $status = 'error';
                $msg = 'data tidak ditemukan';
                $datakapal = null;
            }
            $this->output->set_content_type('application/json')->set_output(json_encode(array('status'=>$status,'msg'=>$msg,'datakapal'=>$datakapal)));
        }
    }
    //end crud koordinat kapal
}