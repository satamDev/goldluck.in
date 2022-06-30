<?php defined("BASEPATH") or exit("No direct script access allowed");

	class Frontend_model extends CI_Model{

		public function getSiteDetails(){
			$this->db->limit(1);
			$query = $this->db->get('frontend_data');
			return $query->result();
		}

		public function getPages(){
			$query = $this->db->get('urls_page');
			return $query->result();
		}

		public function uploadSiteDetails($data, $img = ""){
			$id 			= trim(xss_clean($data['data']));
			$name 			= trim(xss_clean($data['name']));
			$w_no 			= trim(xss_clean($data['whatsapp_no']));
			$footer_para 	= trim(xss_clean($data['footer_paragraph']));
			$f_url			= trim(xss_clean($data['facebook_url']));
			$t_url 			= trim(xss_clean($data['twitter_url']));
			$l_url 			= trim(xss_clean($data['linkedin_url']));
			$i_url 			= trim(xss_clean($data['instagram_url']));
			$o_m 			= trim(xss_clean($data['inputOTMtoF']));
			$c_m 			= trim(xss_clean($data['inputCTMtoF']));
			$o_s 			= trim(xss_clean($data['inputOTS']));
			$c_s 			= trim(xss_clean($data['inputCTS']));
			$store_location = trim(xss_clean($data['store_location']));

			if($img==""){
				$data = [
					'name' => $name,
					'whatsapp_number' => $w_no,
					'footer_paragraph' => $footer_para,
					'facebook_url' => $f_url,
					'twitter_url' => $t_url,
					'linkedin_url' => $l_url,
					'instagram_url' => $i_url,
					'openingtime_m_to_f' => $o_m,
					'closingtime_m_to_f' => $c_m,
					'openingtime_saturday' => $o_s,
					'closingtime_saturday' => $c_s,
					'store_location'		=>$store_location
				];
				$this->db->where('id', $id);
				$this->db->update('frontend_data',$data);
			}else{
				$data = [
					'name' => $name,
					'whatsapp_number' => $w_no,
					'footer_paragraph' => $footer_para,
					'facebook_url' => $f_url,
					'twitter_url' => $t_url,
					'linkedin_url' => $l_url,
					'instagram_url' => $i_url,
					'openingtime_m_to_f' => $o_m,
					'closingtime_m_to_f' => $c_m,
					'openingtime_saturday' => $o_s,
					'closingtime_saturday' => $c_s,
					'logo_path' => $img,
					'store_location'		=>$store_location
				];
				$this->db->where('id', $id);
				$this->db->update('frontend_data',$data);
			}
    		return ($this->db->affected_rows() != 1) ? false : true;
		}

		public function updateFrontendTopMenuStatePage($pageid, $value){
			if($value == 1)$value = 0;
			else $value = 1;
			$data = [
				'has_top_menu' => $value,
			];
			$this->db->where('uid', $pageid);
			$this->db->update('urls_page', $data);
			return ($this->db->affected_rows() != 1) ? false : true;
		}

		public function updateFrontendTopMenuStateCategory($categoryid, $value){
			if($value == 1)$value = 0;
			else $value = 1;
			$data = [
				'has_top_menu' => $value,
			];
			$this->db->where('id', $categoryid);
			$this->db->update('category', $data);
			return ($this->db->affected_rows() != 1) ? false : true;
		}

		public function getBanners(){
			$query = $this->db->get('frontend_banner');
			return $query->result();
		}

		public function deleteModel($id){
			$this->db->where('id', $id);
    		$this->db->delete('frontend_banner');
			return ($this->db->affected_rows() != 1) ? false : true;
		}
		
		public function uploadBanner($heading, $paragraph, $img){
			$data = [
				'heading' => $heading,
				'paragraph' => $paragraph,
				'image_path' => $img,
			];
			$this->db->insert('frontend_banner', $data);
			return ($this->db->affected_rows() != 1) ? false : true;
		}
	}

?>