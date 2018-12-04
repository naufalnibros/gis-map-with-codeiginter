<?php
defined('BASEPATH')OR exit("No direct script access allowed");

class Rute extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model(array('model_rute'));
		$this->load->helper('url');
		if (empty($this->session->userdata['logged_in'])) {
			redirect('/', 'refresh');
		}
	}

	function index(){
		$data = array('content' => 'admin/formrute', 'itemrute'=>$this->model_rute->getAll());
		$this->load->view('templates/template-admin', $data);
	}

	function create() {
		if (!$this->input->is_ajax_request()) {
			show_404();
		} else {
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

	function edit(){
        if (!$this->input->is_ajax_request()) {
            show_404();
        }else{
            //kita validasi inputnya dulu
            $this->form_validation->set_rules('id_rute', 'ID Rute', 'trim|required');
            if ($this->form_validation->run()==false) {
                $status = 'error';
                $msg = validation_errors();
            }else{
                $id = $this->input->post('id_rute');
                if ($this->model_rute->read($id)->num_rows()!=null) {
                    $status = 'success';
                    $msg = $this->model_rute->read($id)->result();
                }else{
                    $status = 'error';
                    $msg = "Data rute tidak ditemukan";
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
            $this->form_validation->set_rules('namarute', 'Nama Rute', 'trim|required');
            $this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required');
            $this->form_validation->set_rules('id_rute', 'ID Rute', 'trim|required');
            if ($this->form_validation->run()==false) {
                $status = 'error';
                $msg = validation_errors();
            }else{
                $id = $this->input->post('id_rute');
                if ($this->model_rute->update($id)) {
                    $status = 'success';
                    $msg = "Data rute berhasil diupdate";
                }else{
                    $status = 'error';
                    $msg = "terjadi kesalahan saat mengupdate data rute";
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
            $this->form_validation->set_rules('id_rute', 'ID Rute', 'trim|required');
            if ($this->form_validation->run()==false) {
                $status = 'error';
                $msg = validation_errors();
            }else{
                $id = $this->input->post('id_rute');
                if ($this->model_rute->delete($id)) {
                    $status = 'success';
                    $msg = "Data rute berhasil dihapus";
                }else{
                    $status = 'error';
                    $msg = "terjadi kesalahan saat menghapus data rute";
                }
            }
            $this->output->set_content_type('application/json')->set_output(json_encode(array('status'=>$status,'msg'=>$msg)));
        }
    }

}
