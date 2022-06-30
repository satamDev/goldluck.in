<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	class Retailer extends CI_Model {

		public function get_retailers_data(){
			$this->db->select('r.*');
			$this->db->from('retailer r');
			$query = $this->db->get();
			$query = $query->result_array();
			return $query;
		}

		public function update_retailer_status($retailer_id, $status){
			$this->db->update('retailer', ['status' => $status]);
			$this->db->where('uid', $retailer_id);
			return ($this->db->affected_rows() == 1)?true:false;
		}
	}
?>