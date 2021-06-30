<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Th_ajaran extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('email')) {
            redirect(base_url("auth"));
        }
        $this->load->model('m_thajaran');
        $this->load->helper('url');
    }


    public function index()
    {
        $data['title'] = 'Data Tahun Iuran';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data1['tahun_masuk'] = $this->m_thajaran->tampil_data()->result();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('thajaran/index', $data1);
        $this->load->view('templates/footer');
    }

    function tambah()
    {
        $data['title'] = 'Data Tahun Iuran';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('thajaran/tambah_thajaran');
        $this->load->view('templates/footer');
    }
    function tambah_aksi()
    {

        $id_tahun = $this->input->post('id_tahun');
        $tahun_masuk = $this->input->post('tahun_masuk');
        $besar_spp = $this->input->post('besar_spp');

        $data = array(
            'id_tahun' => $id_tahun,
            'tahun_masuk' => $tahun_masuk,
            'besar_spp' => $besar_spp
        );

        $this->m_thajaran->input_data($data, 'tahun_masuk');
        redirect('th_ajaran');
    }

    function edit($id_tahun)
    {
        $data['title'] = 'Data Tahun Iuran';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $where1 = array('id_tahun' => $id_tahun);
        $data1['tahun_masuk'] = $this->m_thajaran->edit_data($where1, 'tahun_masuk')->result();
        $this->load->view('template/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('thajarans/edit_thajaran', $data1);
        $this->load->view('templates/footer');
    }

    function update()
    {
        $id_tahun = $this->input->post('id_tahun');
        $tahun_masuk = $this->input->post('tahun_masuk');
        $besar_spp = $this->input->post('besar_spp');
        $data = array(
            'id_tahun' => $id_tahun,
            'tahun_masuk' => $tahun_masuk,
            'besar_spp' => $besar_spp
        );
        $where = array('id_tahun' => $id_tahun);

        $this->m_thajaran->update_data($where, $data, 'tahun_masuk');
        redirect('th_ajaran');
    }
    public function deleteAjaran()
    {
        $id_tahun = $this->input->get('id_tahun');
        $this->db->delete('tahun_masuk', array('id_tahun' => $id_tahun));
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Hapus Berhasil!
          </div>');
        redirect('th_ajaran');
    }
}
