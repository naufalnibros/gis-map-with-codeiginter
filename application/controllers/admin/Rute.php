<?php
defined('BASEPATH')OR exit("No direct script access allowed");

class Rute extends CI_Controller{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('model_rute'));
		 $this->load->helper('url');
       
	}
	
	function index()
	{
		$data = array('content' => 'admin/formrute', 'itemrute'=>$this->model_rute->getAll());
		$this->load->view('templates/template-admin', $data);
	}
	function create(){
        if (!$this->input->is_ajax_request()) {
            show_404();
        }else{
            //kita validasi inputnya dulu
            $this->form_validation->set_rules('namarute', 'Nama Rute', 'trim|required');
            $this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required');
            if ($this->form_validation->run()==false) {
                $status = 'error';
                $msg = validation_errors();
            }else{
                if ($this->model_rute->create()) {
                    $status = 'success';
                    $msg = "Data rute berhasil disimpan";
                }else{
                    $status = 'error';
                    $msg = "terjadi kesalahan saat menyimpan data rute";
                }
            }
            $this->output->set_content_type('application/json')->set_output(json_encode(array('status'=>$status,'msg'=>$msg)));
        }
    }
}