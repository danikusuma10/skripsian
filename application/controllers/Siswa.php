<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Siswa extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();

        $this->load->model('Siswas_model');
    }

    public function index()
    {
        $data['title'] = 'Data Siswa';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['siswa'] = $this->Siswas_model->getAllSiswa();

        $data['kelas'] = $this->Siswas_model->getAllKelas();


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('siswa/index', $data);
        $this->load->view('templates/footer', $data);
    }


    public function tambahSiswa()
    {
        $data['title'] = 'Tambah Siswa';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['kelas'] = $this->Siswas_model->getAllKelas();


        $this->form_validation->set_rules('id_bayar', 'ID Bayar', 'required|trim|numeric|integer|is_unique[siswa.id_bayar]', [
            'required' => 'ID Bayar tidak Boleh Kosong!',
            'numeric'  => 'ID Bayar berupa angka!',
            'integer'  => 'ID Bayar hanya berupa bilangan bulat',
            'is_unique' => 'ID Bayar sudah terdaftar'
        ]);




        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('siswa/tambahsiswa', $data);
            $this->load->view('templates/footer', $data);
        } else {
            //insert data siswa
            $this->Siswas_model->tambahSiswa();
        }
    }


    public function hapussiswa($id_bayar)
    {
        $this->Siswas_model->hapusSiswa($id_bayar);
    }

    public function transaksi()
    {
        $data['title'] = 'Transaksi';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['transaksi'] = $this->Siswas_model->getAllTransaksi();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('siswa/transaksi', $data);
        $this->load->view('templates/footer', $data);
    }


    public function editSiswa()
    {
        $id_bayar = $this->input->post('id_bayar');
        $result = $this->Siswas_model->getSiswaByIdbayar($id_bayar);

        if ($result) {
            // jika data ada

            $data['title'] = 'Edit Data Siswa';
            $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
            $data['siswa'] = $result;
            $data['kelas'] = $this->Siswas_model->getAllKelas();


            $this->form_validation->set_rules('id_bayar', 'NO KK', 'required|trim|numeric');
            $this->form_validation->set_rules('nama_siswa', 'Nama Siswa', 'required|trim');
            $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required|trim');
            $this->form_validation->set_rules('kelas_id', 'Kelas', 'required|trim');
            $this->form_validation->set_rules('emailwalimurid', 'Email', 'trim|required|valid_email');
            $this->form_validation->set_rules('no_hp_siswa', 'NoHp', 'required|numeric|trim');
            $this->form_validation->set_rules('id_tahun', 'Nama Ibu', 'required|trim');

            if ($this->form_validation->run() == false) {

                $this->load->view('templates/header', $data);
                $this->load->view('templates/sidebar', $data);
                $this->load->view('templates/topbar', $data);
                $this->load->view('siswa/editsiswa', $data);
                $this->load->view('templates/footer', $data);
            } else {
                // Edit Data Siswa
                $this->Siswas_model->editSiswa($id_bayar);
            }
        } else {
            // jika data tidak ada
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Data Siswa gagal diupdate!, data siswa tidak ditemukan</div>
            ');
            redirect('siswa');
        }
    }
}
