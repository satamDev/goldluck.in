<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	class Quick_request extends CI_Model {

		public function get_quick_request_images($quick_request_id){
			$this->db->where('quick_request_id', $quick_request_id);
			$query = $this->db->get('quick_request_images');
			return $query->result_array();
		}

		public function get_quick_request_data(){			
			$this->db->select('q.*');
			$this->db->from('quick_request q');
			$query = $this->db->get();
			$query = $query->result_array();
			return $query;
		}
	}
?>