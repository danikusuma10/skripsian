<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Siswas_model extends CI_Model
{

    public function getAllSiswa()
    {
        $query = "SELECT *
                    FROM `kelas` JOIN `siswa`
                      ON `kelas`.`id` = `siswa`.`kelas_id`
        ";

        return $this->db->query($query)->result_array();
    }




    public function getAllKelas()
    {
        return $this->db->get('kelas')->result_array();
    }

    public function getSiswaByIdbayar($id_bayar)
    {
        return $this->db->get_where('siswa', ['id_bayar' => $id_bayar])->row_array();
    }



    public function tambahSiswa()
    {
        $data = [
            'id_bayar'              => $this->input->post('id_bayar', true),
            'nama_siswa'              => $this->input->post('nama_siswa', true),
            'jenis_kelamin'       => $this->input->post('jenis_kelamin', true),
            'kelas_id'    => $this->input->post('kelas_id', true),
            'emailwalimurid'         => $this->input->post('emailwalimurid', true),
            'no_hp_siswa'        => $this->input->post('no_hp_siswa', true),
            'role_id'        => 2,
            'is_active'        => $this->input->post('is_active', true)


        ];

        $this->db->insert('siswa', $data);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Selamat! data siswa berhasil di tambah</div>
            ');
        redirect('siswa');
    }




    public function editSiswa($id_bayar)
    {
        $data = [
            'id_bayar'         => $this->input->post('id_bayar', true),
            'nama_siswa'       => $this->input->post('nama_siswa', true),
            'jenis_kelamin'    => $this->input->post('jenis_kelamin', true),
            'kelas_id'         => $this->input->post('kelas_id', true),
            'emailwalimurid'   => $this->input->post('emailwalimurid', true),
            'no_hp_siswa'      => $this->input->post('no_hp_siswa', true)


        ];

        $this->db->set($data);
        $this->db->where('id_bayar', $id_bayar);
        $this->db->update('siswa', $data);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            data siswa berhasil di ubah</div>
            ');
        redirect('siswa');
    }

    public function hapusSiswa($id_bayar)
    {
        $result = $this->db->get_where('siswa', ['id_bayar' => $id_bayar])->row_array();

        if (!$result) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Data siswa gagal dihapus! data tidak ditemukan</div>
                ');
            redirect('siswa');
        } else {
            $this->db->where('id_bayar', $id_bayar);
            $this->db->delete('siswa');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Data Siswa Berhasil dihapus!</div>
                ');
            redirect('siswa');
        }
    }
}
