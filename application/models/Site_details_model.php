<?php defined("BASEPATH") or exit("No direct script access allowed");

	class Site_details_model extends CI_Model{

		public function getSiteBasicDetails(){
			$query = $this->db->get('frontend_data');
			return $query->result();
		}
		
		public function getBanners(){
			$query = $this->db->get('frontend_banner');
			return $query->result();
		}

		public function getTopPages(){
			$this->db->where('has_top_menu', 1);
			$query = $this->db->get('urls_page');
			return $query->result();
		}

		public function getTopPageCategories(){
			$this->db->where('has_top_menu', 1);
			$query = $this->db->get('category');
			return $query->result();
		}

		public function getSubCategories($categoryId){
			$this->db->where('category_id', $categoryId);
			$query = $this->db->get('sub_category');
			return $query->result();
		}
	}

?>