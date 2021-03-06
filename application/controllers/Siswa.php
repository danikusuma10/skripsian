<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Siswa extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();

        $this->load->model('Siswas_model');
        $this->load->helper(array('form', 'url'));
        $this->load->helper(array('url','string'));
    }

    public function index()
    {
        $data['title'] = 'Data Siswa';
        $data1['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['siswa'] = $this->Siswas_model->getAllSiswa();

        $data['kelas'] = $this->Siswas_model->getAllKelas();


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data1);
        $this->load->view('siswa/index', $data);
        $this->load->view('templates/footer', $data);
    }


    public function tambahSiswa()
    {
        $data['title'] = 'Tambah Siswa';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['kelas'] = $this->Siswas_model->getAllKelas();


        $this->form_validation->set_rules(
            'id_bayar', 'ID Bayar', 'required|trim|numeric|integer|is_unique[siswa.id_bayar]', [
            'required' => 'ID Bayar tidak Boleh Kosong!',
            'numeric'  => 'ID Bayar berupa angka!',
            'integer'  => 'ID Bayar hanya berupa bilangan bulat',
            'is_unique' => 'ID Bayar sudah terdaftar',
            
        ]);

        $this->form_validation->set_rules('emailwalimurid', 'Email', 'required|valid_email|is_unique[siswa.emailwalimurid]',[
            'required' => 'Email Tidak Boleh Kosong',
            'valid_email' => 'Email tidak Valid',
            'is_unique' => 'Email Sudah Terdaftar'
        ]);
        $this->form_validation->set_rules('nama_siswa', 'Nama Siswa', 'required|alpha|callback_nama_cek',[
            'required' => 'Nama Siswa Tidak Boleh Kosong',
            'alpha' => 'Nama Siswa berupa Huruf saja'


        ]);
        
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required', [
            'required' => 'Jenis Kelamin Harus dipilih'
        ]);
        $this->form_validation->set_rules('kelas_id', 'ID Kelas', 'required',[
            'required' => 'ID Kelas Harus dipilih'
        ]);
        $this->form_validation->set_rules('no_hp_siswa', 'No Hp Siswa', 'required|numeric|integer',[
            'required' => 'No Hp Siswa Tidak Boleh Kosong',
            'numeric' => 'No Hp Siswa Berupa Angka',
            'integer' => 'No Hp Siswa Hanya Berupa Bilangan Bulat'
        ]);
        $this->form_validation->set_rules('is_active','Status Akun', 'required',[
            'required' => 'Status Akun harus dipilih'
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

    public function nama_cek($str)
    {
            if ($str == '@')
            {
                    $this->form_validation->set_message('nama_cek', ' {field} Tidak boleh berupa symbol "@"');
                    return FALSE;
            }
            else if ($str == '!')
            {
                    $this->form_validation->set_message('nama_cek', '{field} Tidak boleh berupa symbol "!"');
                    return FALSE;
            }
            else if ($str == '#')
            {
                    $this->form_validation->set_message('nama_cek', ' {field} Tidak boleh berupa symbol "#"');
                    return FALSE;
            }
            else if ($str == '$')
            {
                    $this->form_validation->set_message('nama_cek', ' {field} Tidak boleh berupa symbol "$"');
                    return FALSE;
            }
            else if ($str == '%')
            {
                    $this->form_validation->set_message('nama_cek', ' {field} Tidak boleh berupa symbol "%"');
                    return FALSE;
            }
            else if ($str == '*')
            {
                    $this->form_validation->set_message('nama_cek', ' {field} Tidak boleh berupa symbol "*"');
                    return FALSE;
            
            }else if ($str == '&')
            {
                    $this->form_validation->set_message('nama_cek', ' {field} Tidak boleh berupa symbol "&"');
                    return FALSE;
            }else if ($str == '(')
            {
                    $this->form_validation->set_message('nama_cek', ' {field} Tidak boleh berupa symbol "("');
                    return FALSE;
            }else if ($str == ')')
            {
                    $this->form_validation->set_message('nama_cek', ' {field} Tidak boleh berupa symbol ")"');
                    return FALSE;
            }else if ($str == '^')
            {
                    $this->form_validation->set_message('nama_cek', ' {field} Tidak boleh berupa symbol "^"');
                    return FALSE;
            }

            else
            {
                    return TRUE;
            }
    }

    public function hapussiswa($id_bayar)
    {
        $this->Siswas_model->hapusSiswa($id_bayar);
    }


    public function edit()
    {
        $id_bayar = $this->input->post('id_bayar');
        $nama_siswa = $this->input->post('nama_siswa');
        $kelas_id = $this->input->post('kelas_id');
        $emailwalimurid = $this->input->post('emailwalimurid');
        $no_hp_siswa = $this->input->post('no_hp_siswa');
        $role_id = $this->input->post('role_id');
        $is_active = $this->input->post('is_active');
        $data = array(
            'id_bayar' => $id_bayar,
            'nama_siswa' => $nama_siswa,
            'kelas_id' => $kelas_id,
            'emailwalimurid' => $emailwalimurid,
            'no_hp_siswa' => $no_hp_siswa,
            'role_id' => $role_id,
            'is_active' => $is_active,
        );
        $where = array('id_bayar' => $id_bayar);

        $this->Siswas_model->update_data($where, $data, 'siswa');
        redirect('siswa');
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
