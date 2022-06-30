<?php defined("BASEPATH") or exit("No direct script access allowed");

	class Quick_request extends CI_Model{

		public function __construct() {
	       parent::__construct();
	       date_default_timezone_set(time_zone);
	   	}

	   	private function unique_id_generator($text){
			return $text . "-" . random_int(100000, 999999);
		}

		public function uploadItems($first_name, $last_name, $phone, $email, $address, $gross_weight, $quality, $messages){
			$uid = $this->unique_id_generator("QUICK-REQUEST-".date("ymd"));
			// echo $first_name;
			$data = [
				'uid'		=> $uid,
				'first_name' => $first_name,
				'last_name' => $last_name,
				'phone' => $phone,
				'email' => $email,
				'address' => $address,
				'gross_weight' => $gross_weight,
				'quality' => $quality,
				'messages' => $messages,
				'created_at' => date("Y-m-d H:i:s")
			];

			$this->db->insert('quick_request', $data);
			return ($this->db->affected_rows() == 1) ? $uid : '0';
		}

		public function uploadQuickRequestImages($image = array(), $quick_request_uid, $path){
			foreach ($image as $key => $value) {
				$image_name = $value['quick_request_images'];
				$image_total = $path . $image_name;
				$data = [
					'uid' => $this->unique_id_generator("QUICK-REQUEST-IMAGE-".date("ymd")),
					'quick_request_id' => $quick_request_uid,
					'image_path' => $image_total
				];
				$this->db->insert('quick_request_images', $data);
			}
			return true;
		}
	}

?>