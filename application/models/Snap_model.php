<?php if (!defined('BASEPATH'))  exit('No direct script access allowed');

class Snap_model extends CI_Model
{
    public $table = 'tbl_requesttransaksi';
    public $primaryKey = 'id';

    public function __construct(){
        parent::__construct();
    }

    public function insert($data){
        return $this->db->insert($this->table, $data);}

}