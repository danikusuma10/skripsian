<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notifications extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */


	public function __construct()
    {
        parent::__construct();
        $params = array('server_key' => 'SB-Mid-server-agj15d5qnNn06ZuKmkPA785C', 'production' => false);
		$this->load->library('veritrans');
		$this->veritrans->config($params);
		$this->load->helper('url');
		
    }

	public function index()
	{
		echo 'test notification handler';
		$json_result = file_get_contents('php://input');
		$result = json_decode($json_result);

		if($result){
		$notif = $this->veritrans->status($result->order_id);
		}

		error_log(print_r($result,TRUE));

		//notification handler sample
		

		$transaction = $notif->transaction_status;
		$transactiontime = $notif->settlement_time;
		$type = $notif->payment_type;
		$order_id = $notif->order_id;

		
		 if ($transaction == 'settlement'){
			$this->db->query("update tbl_requesttransaksi set transaction_status='$transaction', settlement_time='$transactiontime' ,payment_type='$type'  where order_id='$order_id' ");
		  echo "Transaction order_id: " . $order_id ." successfully transfered using " . $type;
		  } 
		  else if($transaction == 'pending'){
			$this->db->query("update tbl_requesttransaksi set transaction_status='$transaction', settlement_time='$transactiontime' ,payment_type='$type'  where order_id='$order_id' ");
		  echo "Waiting customer to finish transaction order_id: " . $order_id . " using " . $type;
		  } 
		  else if ($transaction == 'deny') {
			$this->db->query("update tbl_requesttransaksi set transaction_status='$transaction', settlement_time='$transactiontime' ,payment_type='$type'  where order_id='$order_id' ");
		  echo "Payment using " . $type . " for transaction order_id: " . $order_id . " is denied.";
		}

	}
}
