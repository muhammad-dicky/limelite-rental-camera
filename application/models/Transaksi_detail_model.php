<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Transaksi_detail_model extends CI_Model{

	public $table = 'transaksi';
	public $id = 'id_trans';
	public $id_transaksi_detail = 'id_transdet';


	
function get_by_transaksi_id( $id_transaksi_detail){

	$this->db->where('trans_id', $id_transaksi_detail);
	return $query = $this->db->get('transaksi_detail')->result();
}
	

	function get_jam_mulai_terpakai($tanggal, $kamera_id){
		$this->db->select('jam_mulai, durasi, jumlah, jam_selesai');
		$this->db->where('tanggal', $tanggal);
		$this->db->where('kamera_id', $kamera_id);
		return $query = $this->db->get('transaksi_detail')->result();

		// $sql = "
		// 		SELECT
		// 			jam_mulai, durasi, jam_selesai
		// 		FROM kamera_transaksi_detail
		// 		where
		// 			tanggal = ? and kamera_id = ?
		// 		";
		// $query = $this->db->query($sql, array($tanggal, $kamera_id));
		//
		// return $query->result();
	}



	function del_by_id($id){
		$this->db->where($this->id, $id);
		$this->db->delete($this->table);
	}
}
