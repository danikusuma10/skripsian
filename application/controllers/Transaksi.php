<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //is_logged_in();
        $this->load->library('form_validation');
    }



    public function kaskeluar()
    {
        $data['title'] = 'Kas Keluar';
        $data['user'] =  $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');
        $this->form_validation->set_rules('nominal', 'Nominal', 'required');



        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('transaksi/kaskeluar', $data);
            $this->load->view('templates/footer');
        } else {
            $idtransaksi = date("dmY") . '-' . rand(0000, 9999);
            $kas =  $this->db->get_where('kas', ['id_transaksi' => $idtransaksi])->row_array();
            if ($kas) {
                $idtransaksi = date("dmY") . '-' . rand(0000, 9999);
            }
            $data = [
                'id_transaksi' => $idtransaksi,
                'tipe_kas' => 'keluar',
                'keterangan' => $this->input->post('keterangan'),
                'tgl_transaksi' => $this->input->post('tanggal'),
                'nominal' => preg_replace('/[^0-9]/', '', $this->input->post('nominal'))
            ];

            $this->db->insert('kas', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Kas Keluar berhasil ditambah!
          </div>');
            redirect('transaksi/kaskeluar');
        }
    }

    public function kasmasuk()
    {
        $data['title'] = 'Kas Masuk';
        $data['user'] =  $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();


        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required|alpha',[
            'required' => 'Keterangan Tidak Boleh Kosong!',
            'alpha' => 'Keterangan Berupa huruf! '
          
        ]);
        $this->form_validation->set_rules('date', 'Date', 'required',[
            'required' => 'Tanggal Tidak Boleh Kosong!'
          
        ]);
        $this->form_validation->set_rules('nominal', 'Nominal', 'required|numeric',[
            'required' => 'Keterangan Tidak Boleh Kosong!',
            'numeric' => 'Nominal Berupa angka! '
          
        ]);
        
        $this->form_validation->set_rules('nominal', 'Nominal', 'required|numeric');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('transaksi/kasmasuk', $data);
            $this->load->view('templates/footer');
        } else {
            $idtransaksi = date("dmY") . '-' . rand(0000, 9999);
            $kas =  $this->db->get_where('kas', ['id_transaksi' => $idtransaksi])->row_array();
            if ($kas) {
                $idtransaksi = date("dmY") . '-' . rand(0000, 9999);
            }
            $data = [
                'id_transaksi' => $idtransaksi,
                'tipe_kas' => 'masuk',
                'keterangan' => $this->input->post('keterangan'),
                'tgl_transaksi' => $this->input->post('tanggal'),
                'nominal' => preg_replace('/[^0-9]/', '', $this->input->post('nominal'))
            ];
            $this->db->insert('kas', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Kas Masuk berhasil ditambah!
          </div>');
            redirect('transaksi/kasmasuk');
        }
    }

}
