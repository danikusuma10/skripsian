<?php
defined('BASEPATH') or exit('No direct script access allowed');

class th_aktif extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('email')) {
            redirect(base_url("auth"));
        }
        $this->load->model('m_thaktif');
        $this->load->helper('url');
    }


    public function index()
    {
        $data['title'] = 'Data tahun aktif';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data1['tahun_aktif'] = $this->m_thaktif->tampil_data();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('thaktif/index', $data1);
        $this->load->view('templates/footer');
    }

    function tambah()
    {
        $data['title'] = 'Data tahun aktif';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('thaktif/tambah_thaktif');
        $this->load->view('templates/footer');
    }

    function tambah_aksi()
    {

        $id = $this->input->post('id');
        $id_bayar = $this->input->post('id_bayar');
        $id_tahun = $this->input->post('id_tahun');

        $data = array(
            'id' => $id,
            'id_bayar' => $id_bayar,
            'id_tahun' => $id_tahun
        );

        $query = $this->db->query('SELECT * FROM tahun_aktif 
				WHERE id_bayar =' . $id_bayar . ' AND id_tahun=' . $id_tahun . '');

        if ($query->num_rows() > 0) {
            redirect('th_aktif/tambah');
        } else {
            $this->m_thaktif->input_data($data, 'tahun_aktif');
            redirect('th_aktif/tambah_tunggakan/' . $id_bayar . '/' . $id_tahun, '');
        }
    }
    public function deleteTahunaktif()
    {
        $id_bayar = $this->input->get('id_bayar');
        $this->db->delete('tahun_aktif', array('id_bayar' => $id_bayar));
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Hapus Berhasil!
          </div>');
        redirect('th_aktif');
    }


    function hapus_tunggakan($id_bayar, $id_tahun)
    {

        $where = array('id_bayar' => $id_bayar, 'id_tahun' => $id_tahun);
        $this->m_thaktif->hapus_data($where, 'tunggakan');
        redirect('th_aktif');
    }

    function tambah_tunggakan($id_bayar, $id_tahun)
    {

        foreach ($this->db->query('SELECT * FROM tahun_masuk WHERE id_tahun=' . $id_tahun . '')->result() as $res); {

            $b_spp = $res->besar_spp;

            $tunggakan = $b_spp * 12;
        }

        $data = array(
            'id' => '',
            'id_bayar' => $id_bayar,
            'id_tahun' => $id_tahun,
            'tunggakan' => $tunggakan
        );

        $this->m_thaktif->input_data_tunggakan($data, 'tunggakan');
        redirect('th_aktif');
    }
}
