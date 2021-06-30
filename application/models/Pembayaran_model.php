<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pembayaran_model extends CI_Model
{

   
    public function getAllTranksaksi()
    {
        return $this->db->get('tbl_requesttransaksi')->result_array();
    }

   
    public function hapusTransaksi($order_id)
    {
        $result = $this->db->get_where('tbl_requesttransaksi', ['order_id' => $order_id])->row_array();

       
            $this->db->where('order_id', $order_id);
            $this->db->delete('tbl_requesttransaksi');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Data Request Berhasil dihapus!</div>
                ');
            redirect('Pembayaran/data_tranksaksi');
        
    }
}
