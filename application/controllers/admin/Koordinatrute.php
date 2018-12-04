<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Koordinatrute extends CI_Controller{
 
    public function __construct()
    {
        parent::__construct();
        //kita load model yang dibutuhkan, yaitu model rute
        $this->load->model(array('model_rute','model_koordinatrute'));
        $this->load->helper('url');
        $this->load->library('form_validation');
    }

    function index()
    {
        $data = array('content' => 'admin/formkoordinatrute',//kita buat file formrute di dalam folder views/admin
        'itemrute'=>$this->model_rute->getAll()),
        'itemkoordinat'=>$this->model_koordinatrute->getAll());
        $this->load->view('templates/template-admin', $data);
    }

    public function koordinatrute(){
        $data = array('content' => 'admin/koordinatruteform',
            'itemdatarute'=>$this->model_rute->getAll(),
            'itemkoordinatrute'=>$this->model_koordinatrute->getAll());
        $this->load->view('templates/template', $data, FALSE);
    }
    function tambahkoordinatrute()
    {
        if(!$this->input->is_ajax_request())
        {
            show_404();
        }else
        {
            if($this->cart->contents()==null){
                $data = array(
                'id'      => 1,
                'qty'     => 1,
                'price'   => 1,
                'jenis'      => 'rute',
                'name'    => 1,
                'latitude'=> $this->input->post('latitude'),
                'longitude'=> $this->input->post('longitude')
                );
 
                $this->cart->insert($data);
                $status = "success";
                $msg = "<div class='alert alert-success'>Data berhasil disimpan</div>";
            }else{
                $urut = 0;
                foreach ($this->cart->contents() as $rute) {
                    $urut +=1;
                }
                $data = array(
                        'id'      => $urut + 1,
                        'qty'     => 1,
                        'price'   => 1,
                        'jenis'      => 'rute',
                        'name'    => $urut + 1,
                        'latitude'=> $this->input->post('latitude'),
                        'longitude'=> $this->input->post('longitude')
                    );
 
                $this->cart->insert($data);
                $status = "success";
                $msg = "<div class='alert alert-success'>Data berhasil disimpan</div>";
            }
            $this->output->set_content_type('application/json')->set_output(json_encode(array('status'=>$status,'msg'=>$msg)));
        }
    }
    function hapusdaftarkoordinatrute(){
        if (!$this->input->is_ajax_request()) {
            show_404();
        }else{
            $hapus = $this->cart->destroy();
            $status = 'success';
            $msg = 'data koordinat berhasil dihapus';
 
            $this->output->set_content_type('application/json')->set_output(json_encode(array('status'=>$status,'msg'=>$msg)));
        }
    }
    function simpandaftarkoordinatrute(){
        if (!$this->input->is_ajax_request()) {
            show_404();
        }else{
            $this->load->library('form_validation');
            $this->form_validation->set_rules('id_rute', 'Data rute', 'trim|required');
            if ($this->form_validation->run()==false) {
                $status = 'error';
                $msg = validation_errors();
            }else{
                if ($this->model_koordinatrute->getbyidrute($this->input->post('id_rute'))->num_rows()!=null) {
                    $status = 'error';
                    $msg = 'polyline rute yang bersangkutan sudah ada, hapus terlebih dahulu';
                }else{
                    if ($this->model_koordinatrute->create()) {
                        $status = 'success';
                        $msg = 'data berhasil disimpan';
                        $this->cart->destroy();
                    }else{
                        $status = 'error';
                        $msg = 'terjadi kesalahan saat menyimpan koordinat';
                    }
                }
            }
            $this->output->set_content_type('application/json')->set_output(json_encode(array('status'=>$status,'msg'=>$msg)));
        }
    }
    function hapuspolylinerute(){
        if (!$this->input->is_ajax_request()) {
            show_404();
        }else{
            if ($this->model_koordinatrute->deletebyidrute($this->input->post('id_rute'))) {
                $status = 'success';
                $msg = 'data berhasil dihapus';
            }else{
                $status = 'error';
                $msg = 'terjadi kesalahan saat menghapus data';
            }
            $this->output->set_content_type('application/json')->set_output(json_encode(array('status'=>$status,'msg'=>$msg)));
        }
    }
    function viewpolylinerute(){
        if (!$this->input->is_ajax_request()) {
            show_404();
        }else{
            if ($this->model_koordinatrute->getbyidrute($this->input->post('id_rute'))->num_rows()!=null){
                $status = 'success';
                $msg = $this->model_koordinatrute->getbyidrute($this->input->post('id_rute'))->result();
                $datarute = $this->model_rute->read($this->input->post('id_rute'))->result();
            }else{
                $status = 'error';
                $msg = 'data tidak ditemukan';
                $datarute = null;
            }
            $this->output->set_content_type('application/json')->set_output(json_encode(array('status'=>$status,'msg'=>$msg,'datarute'=>$datarute)));
        }
    }
}