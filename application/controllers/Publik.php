<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Publik extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('Publik_model');
        $this->load->model('Mymodel');
        $this->load->helper("url");
    }


    //akses siswa public

    public function histori()
   
    {
        $data['title'] = 'Transaksi';
       

        $keyword    =   $this->input->post('keyword');
        $data['results']    =   $this->Mymodel->search($keyword);
     

        $this->load->view('templates/header', $data);
        $this->load->view('public/transaksi', $data);
        $this->load->view('templates/footer', $data);
    }

    function search_keyword()
    {
        $keyword    =   $this->input->post('keyword');
        $data['results']    =   $this->Mymodel->search($keyword);
        $this->load->view('Public/transaksi',$data);
    }

}
