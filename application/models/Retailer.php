<?php defined("BASEPATH") or exit("No direct script access allowed");

	class Retailer extends CI_Model{

		public function __construct(){
			parent::__construct();
			date_default_timezone_set('Asia/Kolkata');
		}

		private function unique_id_generator(){
			$random_six_digit_number = random_int(100000, 999999);
			$charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";

			$final_string = substr(str_shuffle($charset), 0, 6) . $random_six_digit_number;
    		return $final_string;
		}

		public function retailerExistByStoreName($store){
			$this->db->where('store_name', $store);
			$this->db->limit(1);
			$query = $this->db->get('retailer');
			return ($this->db->affected_rows() == 1)?true:false;
		}

		public function retailerExistByEmail($email){
			$this->db->where('email', $email);
			$this->db->limit(1);
			$query = $this->db->get('retailer');
			return ($this->db->affected_rows() == 1)?true:false;
		}

		public function retailerExistByPhoneNo($phone_no){
			$this->db->where('phone', $phone_no);
			$this->db->limit(1);
			$query = $this->db->get('retailer');
			return ($this->db->affected_rows() == 1)?true:false;
		}

		public function retailerExistByGSTNo($gst_no){
			$this->db->where('gst_no', $gst_no);
			$this->db->limit(1);
			$query = $this->db->get('retailer');
			return ($this->db->affected_rows() == 1)?true:false;
		}

		public function set_retailer_data($first_name, $last_name, $phone, $store_name, $gst_no, $email, $password){

			$data = [
				'uid' => $this->unique_id_generator(),
				'first_name' => $first_name,
				'last_name' => $last_name,
				'phone' => $phone,
				'store_name' => $store_name,
				'gst_no' => $gst_no,
				'email' => $email,
				'password' => md5($password),
				'created_at' => date("Y-m-d H:i:s"),
			];

			$this->db->insert('retailer', $data);
			return ($this->db->affected_rows() == 1) ? true : false;
		}

		public function getRetailerDiscountPercentage(){
			$this->db->select('product_price_related_static_stuffs.retailer_discount_percentage');
			$query = $this->db->get('product_price_related_static_stuffs', 1);
			$query = $query->result_array();
			return $query[0]['retailer_discount_percentage'];
		}

		public function check_retailer_for_login($email, $password){
			$this->db->select('retailer.*');
			$this->db->where('email', $email);
			$this->db->where('password', md5($password));
			$this->db->where('status', 1);
			$this->db->limit(1);
			$query = $this->db->get('retailer');
			$query = $query->result_array();
			if($this->db->affected_rows()==1){
				return $query;
			}else{
				return [];
			}			
		}

		public function getRetailerEmailAndPhone($uid){
			$this->db->select('phone, email, store_name, gst_no');
			$this->db->where('uid', $uid);
			$query = $this->db->get('retailer');
			return $query->result_array();
		}
	}
?>