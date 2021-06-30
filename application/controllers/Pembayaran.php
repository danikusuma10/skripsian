<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pembayaran extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

        $this->load->database();
        $this->load->helper('url');
        $params = array('server_key' => 'SB-Mid-server-agj15d5qnNn06ZuKmkPA785C', 'production' => false);
        $this->load->library('veritrans');
        $this->veritrans->config($params);
        $this->load->model('Pembayaran_model');
    }

    public function data_tranksaksi()
    {

        $data['title'] = 'Transaksi Masuk';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['tranksaksi'] = $this->Pembayaran_model->getAllTranksaksi();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('pembayaran/data_tranksaksi', $data);
        $this->load->view('templates/footer');
    }
    public function hapusTransaksi($order_id)
    {
        $this->Pembayaran_model->hapusTransaksi($order_id);
    }
}
