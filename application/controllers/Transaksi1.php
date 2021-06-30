<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi1 extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
      

        $this->load->model('m_transaksi');
        $this->load->helper('url');
    }


    public function index()
    {
        $data['title'] = 'Data Pembayaran SPP Siswa';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data1['siswa'] = $this->m_transaksi->tampil_data()->result();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('transaksi1/index', $data1);
        $this->load->view('templates/footer');
    }

    public function detail($id_bayar)
    {
        $data['id_transaksi'] = $this->m_transaksi->id_transaksi();
        $data['tgl_bayar'] = date("Y-m-d");
        $data['title'] = 'Data Pembayaran SPP Siswa';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $where1 = array('id_bayar' => $id_bayar);
        $data1['siswa'] = $this->m_transaksi->tampil_detail($where1)->result();
        $data2['trans'] = $this->m_transaksi->tampil_transaksi($where1)->result();
        $data2['xtrans'] = $this->m_transaksi->tampil_xtrans($where1)->result();
        $data2['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $query = $this->db->query('SELECT * FROM tahun_aktif 
				WHERE id_bayar =' . $id_bayar . '');

        if ($query->num_rows() == 0) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('transaksi1/detail', $data1);
            $this->load->view('templates/footer');
        } else {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('transaksi1/detail', $data1);
            $this->load->view('transaksi1/detail_transaksi', $data2);
            $this->load->view('transaksi1/transaksi_hapus', $data2);
            $this->load->view('templates/footer');
        }
    }

    function tambah_aksi()
    {

        $id_bayar = $this->input->post('id_bayar');
        $id = $this->input->post('id');
        $id_transaksi = $this->input->post('id_transaksi');
        $tgl_bayar = $this->input->post('tgl_bayar');
        $id_bulan = $this->input->post('bulan');
        $id_tahun = $this->input->post('tahun_masuk');

        $data = array(
            'id_transaksi' => $id_transaksi,
            'id_bayar' => $id_bayar,
            'id_bulan' => $id_bulan,
            'id_tahun' => $id_tahun,
            'tanggal_bayar' => $tgl_bayar,
            'id' => $id,
        );

        $query = $this->db->query('SELECT * FROM transaksi1 
				WHERE id_bulan =' . $id_bulan . ' 
				AND id_tahun=' . $id_tahun . ' AND id_bayar=' . $id_bayar . '');

        if ($query->num_rows() > 0) {
            redirect('transaksi1/detail/' . $id_bayar, '');
        } else {
            $this->m_transaksi->input_data($data, 'transaksi1');
            redirect('transaksi1/kurang_tunggakan/' . $id_bayar . '/' . $id_tahun, '');
        }
    }

    function hapus($id_transaksi, $id_bayar, $id_tahun)
    {

        $where = $id_transaksi;
        $where2 = array('id_transaksi' => $id_transaksi);
        $this->m_transaksi->copy_input($where);
        $this->m_transaksi->hapus_data($where2, 'transaksi1');
        redirect('transaksi1/tambah_tunggakan/' . $id_bayar . '/' . $id_tahun, '');
    }

    function tambah_tunggakan($id_bayar, $id_tahun)
    {

        foreach ($this->db->query('SELECT tunggakan.tunggakan, tahun_masuk.besar_spp FROM tahun_masuk JOIN tunggakan ON tahun_masuk.id_tahun = tunggakan.id_tahun WHERE tunggakan.id_tahun=' . $id_tahun . '')->result() as $res); {

            $b_spp = $res->besar_spp;
            $totunggak = $res->tunggakan + $b_spp;
        }

        $data = array(
            'tunggakan' => $totunggak,
        );

        $where = array('id_bayar' => $id_bayar, 'id_tahun' => $id_tahun);
        $this->m_transaksi->update_tunggakan($where, $data, 'tunggakan');
        redirect('transaksi1/detail/' . $id_bayar, '');
    }

    function kurang_tunggakan($id_bayar, $id_tahun)
    {

        foreach ($this->db->query('SELECT tunggakan.tunggakan, tahun_masuk.besar_spp FROM tahun_masuk JOIN tunggakan ON tahun_masuk.id_tahun = tunggakan.id_tahun WHERE tunggakan.id_tahun=' . $id_tahun . '')->result() as $res); {

            $b_spp = $res->besar_spp;
            $totunggak = $res->tunggakan - $b_spp;
        }

        $data = array(
            'tunggakan' => $totunggak,
        );

        $where = array('id_bayar' => $id_bayar, 'id_tahun' => $id_tahun);
        $this->m_transaksi->update_tunggakan($where, $data, 'tunggakan');
        redirect('transaksi1/detail/' . $id_bayar, '');
    }
    /*LAPORAN TRANSAKSI*/

    function laporan()
    {

        if (isset($_GET['filter']) && !empty($_GET['filter'])) {

            $filter = $_GET['filter'];

            if ($filter == '1') {
                $tanggal1 = $_GET['tanggal'];
                $tanggal2 = $_GET['tanggal2'];
                $ket = 'Data Transaksi dari Tanggal ' . date('d-m-y', strtotime($tanggal1)) . ' - ' . date('d-m-y', strtotime($tanggal2));
                $url_cetak = 'transaksi1/cetak1?tanggal1=' . $tanggal1 . '&tanggal2=' . $tanggal2 . '';
                $transaksi = $this->m_transaksi->view_by_date($tanggal1, $tanggal2)->result();
            } else if ($filter == '2') {
                $id_bayar = $_GET['id_bayar'];
                $ket = 'Data Transaksi dari Siswa dengan Nomor Induk ' . $id_bayar;
                $url_cetak = 'transaksi1/cetak2?&id_bayar=' . $id_bayar;
                $transaksi = $this->m_transaksi->view_by_idbayar($id_bayar)->result();
            } else {
                $tahun = $_GET['tahun'];
                $ket = 'Data Transaksi Tahun Ajaran ' . $tahun;
                $url_cetak = 'transaksi1/cetak4?&tahun=' . $tahun;
                $transaksi = $this->m_transaksi->view_by_year($tahun)->result();
            }
        } else {

            $ket = 'Semua Data Transaksi';
            $url_cetak = 'transaksi1/cetak';
            $transaksi = $this->m_transaksi->view_all();
        }

        $data['ket'] = $ket;
        $data['url_cetak'] = base_url($url_cetak);
        $data['transaksi'] = $transaksi;
        $data['id_bayar'] = $this->m_transaksi->id_bayar();
        $data['tahun'] = $this->m_transaksi->tahun();


        $data['title'] = 'Laporan Data Pembayaran SPP Siswa';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('transaksi1/laporan', $data);
        $this->load->view('templates/footer');
    }

    public function cetak()
    {

        $ket = 'Semua Data Transaksi';

        ob_start();
        require('assets/pdf/fpdf.php');
        $data['transaksi'] = $this->m_transaksi->view_all();
        $data['ket'] = $ket;
        $this->load->view('transaksi1/preview', $data);
    }

    public function cetak1()
    {

        $tanggal1 = $_GET['tanggal1'];
        $tanggal2 = $_GET['tanggal2'];
        $ket = 'Data Transaksi dari Tanggal ' . date('d-m-y', strtotime($tanggal1)) . ' s/d ' . date('d-m-y', strtotime($tanggal2));

        ob_start();
        require('assets/pdf/fpdf.php');
        $data['transaksi'] = $this->m_transaksi->view_by_date($tanggal1, $tanggal2)->result();
        $data['ket'] = $ket;
        $this->load->view('transaksi1/preview', $data);
    }

    public function cetak2()
    {

        $id_bayar = $_GET['id_bayar'];
        $ket = 'Data Transaksi dari Siswa dengan Nomor Induk ' . $id_bayar;

        ob_start();
        require('assets/pdf/fpdf.php');
        $data['transaksi'] = $this->m_transaksi->view_by_idbayar($id_bayar)->result();
        $data['ket'] = $ket;
        $this->load->view('transaksi1/preview', $data);
    }

    public function cetak3()
    {

        $kelas = $_GET['kelas'];
        $tahun = $_GET['tahun'];
        $ket = 'Data Transaksi Kelas ' . $kelas . ' Tahun Ajaran' . $tahun;

        ob_start();
        require('assets/pdf/fpdf.php');
        $data['transaksi'] = $this->m_transaksi->view_by_kelas($kelas, $tahun)->result();
        $data['ket'] = $ket;
        $this->load->view('transaksi1/preview', $data);
    }

    public function cetak4()
    {

        $tahun = $_GET['tahun'];
        $ket = 'Data Transaksi Tahun Ajaran ' . $tahun;

        ob_start();
        require('assets/pdf/fpdf.php');
        $data['transaksi'] = $this->m_transaksi->view_by_year($tahun)->result();
        $data['ket'] = $ket;
        $this->load->view('transaksi1/preview', $data);
    }
}
