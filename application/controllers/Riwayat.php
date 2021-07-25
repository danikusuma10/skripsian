<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Riwayat extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Methods: PUT, GET, POST");
		header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
        
        $this->load->helper('url');
        $this->load->database();
        $params = array('server_key' => 'SB-Mid-server-agj15d5qnNn06ZuKmkPA785C', 'production' => false);
        $this->load->library('veritrans');
        $this->veritrans->config($params);
        $this->load->model('Pembayaran_model');
         $this->load->model('Riwayat_model');
    }
  

    public function index()
    {
        $data['title'] 	= 'Data Pembayaran SPP Siswa';
        $data['user'] 	= $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data1['siswa'] = $this->Riwayat_model->tampil_data()->result();


        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbare', $data);
        $this->load->view('riwayat/index', $data1);
    }
    public function getData()
    {
        $where  = $this->input->post('id_bayar');
    	$ambil 	= $this->Riwayat_model->tampil_datasw($where); // Ambil data dari model
        //var_dump($where);die();
    	$data 	= array(); //Buat nanti nampilin datanya
    	if(!empty($ambil)){ // Check kalo $ambil ga kosong
    		foreach($ambil as $tarik){ // Looping isi data $ambil
    			
    			$row 	= array(); // Buat Table
    			$row[]	= $tarik->id_bayar;
    			$row[] 	= anchor('riwayat/detail/' . $tarik->id_bayar, '<input type=reset class="btn btn-info" value=\'Detail\'>');
    			$data[] = $row;
    		}
    	}
    	$output		= array(
    		"draw"	=> $this->input->post('draw'),
    		"data"	=> $data
    	);
    	echo json_encode($output);
        
    }


    public function detail($id_bayar)
    {
        $data['id_transaksi'] = $this->Riwayat_model->id_transaksi();
        $data['tgl_bayar'] = date("Y-m-d");
        $data['title'] = 'Data Pembayaran SPP Siswa';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $where1 = array('id_bayar' => $id_bayar);
        $data1['siswa'] = $this->Riwayat_model->tampil_detail($where1)->result();
        $data['tahunmasuk'] = $this->Riwayat_model->getAllbayar();
        $data2['trans'] = $this->Riwayat_model->tampil_transaksi($where1)->result();
        $data2['xtrans'] = $this->Riwayat_model->tampil_xtrans($where1)->result();
        $data2['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $query = $this->db->query('SELECT * FROM tahun_aktif 
				WHERE id_bayar =' . $id_bayar . '');

        if ($query->num_rows() == 0) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbare', $data);
            $this->load->view('riwayat/detail', $data1);
            $this->load->view('templates/footer');
        } else {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbare', $data);
            $this->load->view('riwayat/detail', $data1);
            $this->load->view('riwayat/detail_transaksi', $data2);
            $this->load->view('riwayat/transaksi_hapus', $data2);
            $this->load->view('templates/footer');
        }
    }

    

    public function cektransaksi()
    {

        $this->load->view('pembayaran/transaction');
    }
    public function status($order_id)
    {
        echo 'test get status </br>';

        print_r($this->veritrans->status($order_id));



        $response = $this->veritrans->status(($order_id));
        $transaction_status = $response->transaction_status;
        $settlement_time = $response->settlement_time;



        $update = $this->db->query("update tbl_requesttransaksi set transaction_status='$transaction_status', settlement_time='$settlement_time'   where order_id='$order_id' ");
        if ($update) {
            echo "status tranksaksi berhasil di update";
        } else {
            echo "status tarnksaksi gagal di update";
        }
    }

    
}
