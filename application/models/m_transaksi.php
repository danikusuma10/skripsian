<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class M_transaksi extends CI_Model
{
	

	function tampil_transaksi($where1)
	{
		$this->db->select('*');
		$this->db->from('transaksi1');
		$this->db->join('bulan', 'transaksi1.id_bulan = bulan.id_bulan');
		$this->db->join('tahun_masuk', 'transaksi1.id_tahun = tahun_masuk.id_tahun');
		$this->db->join('user', 'transaksi1.id = user.id');
		$this->db->where_in('id_bayar', $where1);
		$this->db->order_by('transaksi1.id_tahun,transaksi1.id_bulan', 'ASC');
		return $query = $this->db->get();
	}

	function tampil_xtrans($where1)
	{
		$this->db->select('*');
		$this->db->from('hapus_transaksi');
		$this->db->join('bulan', 'hapus_transaksi.id_bulan = bulan.id_bulan');
		$this->db->join('tahun_masuk', 'hapus_transaksi.id_tahun = tahun_masuk.id_tahun');
		$this->db->join('user', 'hapus_transaksi.id = user.id');
		$this->db->where_in('id_bayar', $where1);
		return $query = $this->db->get();
	}

	public function id_transaksi()
	{
		$q = $this->db->query("SELECT MAX(RIGHT(id_transaksi,3)) AS kd_max FROM transaksi1 WHERE DATE(tanggal_bayar)=CURDATE()");
		$kd = "";
		if ($q->num_rows() > 0) {
			foreach ($q->result() as $k) {
				$tmp = ((int) $k->kd_max) + 1;
				$kd = sprintf("%03s", $tmp);
			}
		} else {
			$kd = "001";
		}
		$kode = "SPP";
		date_default_timezone_set('Asia/Jakarta');
		return $kode . date('dmy') . $kd;
	}

	/*LAPORAN TRANSAKSI*/

	public function view_by_date($tanggal1, $tanggal2)
	{
		$this->db->select('*');
		$this->db->from('transaksi1');
		$this->db->join('siswa', 'transaksi1.id_bayar = siswa.id_bayar');
		$this->db->join('bulan', 'transaksi1.id_bulan = bulan.id_bulan');
		$this->db->join('tahun_masuk', 'tahun_masuk.id_tahun = transaksi1.id_tahun');
		$this->db->join('user', 'transaksi1.id = user.id');
		$this->db->where('tanggal_bayar BETWEEN"' . date('Y-m-d', strtotime($tanggal1)) . '"and"' . date('Y-m-d', strtotime($tanggal2)) . '"');
		$this->db->order_by('tanggal_bayar');
		return $query = $this->db->get(); // Tampilkan data transaksi sesuai tanggal yang diinput oleh user pada filter  
	}

	public function id_bayar()
	{
		$this->db->select('*');
		$this->db->from('siswa');
		return $query = $this->db->get()->result();
	}

	public function tahun()
	{
		$this->db->select('*');
		$this->db->from('tahun_masuk');
		return $query = $this->db->get()->result();
	}

	public function view_by_idbayar($id_bayar)
	{
		$this->db->select('*');
		$this->db->from('transaksi1');
		$this->db->join('siswa', 'transaksi1.id_bayar = siswa.id_bayar');
		$this->db->join('bulan', 'transaksi1.id_bulan = bulan.id_bulan');
		$this->db->join('tahun_masuk', 'tahun_masuk.id_tahun = transaksi1.id_tahun');
		$this->db->join('user', 'transaksi1.id = user.id');
		$this->db->where('transaksi1.id_bayar', $id_bayar);
		$this->db->order_by('transaksi1.id_tahun');
		return $query = $this->db->get(); // Tampilkan data transaksi sesuai tanggal yang diinput oleh user pada filter  
	}

	public function view_by_year($tahun)
	{
		$this->db->select('*');
		$this->db->from('transaksi1');
		$this->db->join('siswa', 'transaksi1.id_bayar = siswa.id_bayar');
		$this->db->join('bulan', 'transaksi1.id_bulan = bulan.id_bulan');
		$this->db->join('tahun_masuk', 'tahun_masuk.id_tahun = transaksi1.id_tahun');
		$this->db->join('user', 'transaksi1.id = user.id');
		$this->db->where('transaksi1.id_tahun="' . $tahun . '"');
		$this->db->order_by('transaksi1.id_tahun');
		return $query = $this->db->get();
	}

	function view_all()
	{

		$this->db->select('*');
		$this->db->from('transaksi1');
		$this->db->join('siswa', 'siswa.id_bayar = transaksi1.id_bayar');
		$this->db->join('bulan', 'transaksi1.id_bulan = bulan.id_bulan');
		$this->db->join('tahun_masuk', 'tahun_masuk.id_tahun = transaksi1.id_tahun');
		$this->db->join('user', 'transaksi1.id = user.id');
		$this->db->order_by('id_transaksi');
		return $this->db->get()->result();
	}

	function update_tunggakan($where, $data, $table)
	{
		$this->db->where($where);
		$this->db->update($table, $data);
	}
}
