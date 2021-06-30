<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Asia/Jakarta");
        $this->load->library('form_validation');
        $this->load->model('Siswas_model');
        //is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Laporan Kas';
        $data['user'] =  $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['jurnal'] = $this->db->query
        ("SELECT a.id, a.id_transaksi, a.keterangan, a.tgl_transaksi, kredit, debit 
        FROM jurnal a 
        LEFT JOIN jurnal_detail b on a.id = b.id_jurnal 
        order by a.tgl_transaksi asc")->result_array();

        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required');
        $this->form_validation->set_rules('nominal', 'Nominal', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('laporan/bukukasumum', $data);
            $this->load->view('templates/footer');
        } else {

            redirect('laporan/bukukasumum');
        }
    }

    public function bukukasumum()
    {
        $data['title'] = 'Laporan Kas';
        $data['user'] =  $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['jurnal'] = $this->db->query
        ("SELECT a.id, a.id_transaksi, a.keterangan, a.tgl_transaksi, kredit, debit 
        FROM jurnal a 
        LEFT JOIN jurnal_detail b on a.id = b.id_jurnal 
        order by a.tgl_transaksi asc")->result_array();

        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required');
        $this->form_validation->set_rules('nominal', 'Nominal', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('laporan/bukukasumum', $data);
            $this->load->view('templates/footer');
        } else {

            redirect('laporan/bukukasumum');
        }
    }

    public function search()
    {
        $data['title'] = 'Laporan Kas';
        $data['user'] =  $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $tgl_awal = $this->input->post('tanggal_awal');
        $tgl_akhir = $this->input->post('tanggal_akhir');


        $saldo_awal = "SELECT a.id,a.id_transaksi,a.keterangan,a.tgl_transaksi,kredit,debit FROM jurnal a 
        LEFT JOIN jurnal_detail b on a.id = b.id_jurnal where date(tgl_transaksi) < '$tgl_awal' order by a.tgl_transaksi asc";

        $query = "SELECT a.id,a.id_transaksi,a.keterangan,a.tgl_transaksi,kredit,debit FROM jurnal a 
        LEFT JOIN jurnal_detail b on a.id = b.id_jurnal where date(tgl_transaksi)  between '$tgl_awal' and '$tgl_akhir'  order by a.tgl_transaksi asc";

        $data['saldo_awal'] = $this->db->query($saldo_awal)->result_array();
        $data['jurnal'] = $this->db->query($query)->result_array();

        $this->session->set_flashdata('tglawal', $tgl_awal);
        $this->session->set_flashdata('tglakhir', $tgl_akhir);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('laporan/search', $data);
        $this->load->view('templates/footer');
    }

    public function cetak()
    {
        $type = $this->input->get('p');
        $tgl_awal = $this->input->get('tglawal');
        $tgl_akhir = $this->input->get('tglakhir');
        $data['user'] =  $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        if ($type = 'excel') {
            if ($tgl_akhir == null && $tgl_awal == null) {
                $saldo_awal = "SELECT a.id,a.id_transaksi,a.keterangan,a.tgl_transaksi,kredit,debit FROM jurnal a
                LEFT JOIN jurnal_detail b on a.id = b.id_jurnal where date(tgl_transaksi) < '$tgl_awal' order by a.tgl_transaksi asc";

                $query = "SELECT a.id,a.id_transaksi,a.keterangan,a.tgl_transaksi,kredit,debit FROM jurnal a 
               LEFT JOIN jurnal_detail b on a.id = b.id_jurnal  order by a.tgl_transaksi asc";
            } else {
                $saldo_awal = "SELECT a.id,a.id_transaksi,a.keterangan,a.tgl_transaksi,kredit,debit FROM jurnal a
                LEFT JOIN jurnal_detail b on a.id = b.id_jurnal where date(tgl_transaksi) < '$tgl_awal' order by a.tgl_transaksi asc";

                $query = "SELECT a.id,a.id_transaksi,a.keterangan,a.tgl_transaksi,kredit,debit FROM jurnal a 
               LEFT JOIN jurnal_detail b on a.id = b.id_jurnal where date(tgl_transaksi)  between '$tgl_awal' and '$tgl_akhir'  order by a.tgl_transaksi asc";
            }

            $data['saldo_awal'] = $this->db->query($saldo_awal)->result_array();
            $data['jurnal'] = $this->db->query($query)->result_array();

            $this->session->set_flashdata('tglawal', $tgl_awal);
            $this->session->set_flashdata('tglakhir', $tgl_akhir);

            $this->load->view('cetak/excel', $data);
        } else {
            #
        }
    }
}
