<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	class Product_model extends CI_Model {
		
		private function unique_id_generator(){
			$random_six_digit_number = random_int(100000, 999999);
			$charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";

			$final_string = substr(str_shuffle($charset), 0, 6) . $random_six_digit_number;
    		return $final_string;
		}

		private function decimal_two_digit($digit){
	        return number_format((float)$digit, 2, '.', '');
	    }

		public function getDataFromTable($tableName){
			$this->db->select(['id', 'name']);
			$query = $this->db->get($tableName);
			return $query->result();
		}

		public function getAllCategory(){
			$this->db->select(['id', 'name', 'has_top_menu']);
			$query = $this->db->get('category');
			return $query->result();
		}

		public function getAllSubCategory($category_id){
			$this->db->select(['id', 'name']);
			$query = $this->db->get_where('sub_category', ['category_id' => $category_id]);
			return $query;
		}

		public function setDataToFilerTable($item_value, $filter_table){
			$this->db->insert($filter_table,["name" => $item_value]);
			return ($this->db->affected_rows() == 1) ? true : false;
		}

		public function deleteDataToFilerTable($item_id, $filter_table){
			$this->db->where('id', $item_id);
    		$this->db->delete($filter_table);
    		return ($this->db->affected_rows() == 1) ? true : false;
		}
		
		public function updateDataToFilerTable($option_id, $option_value, $filter_table){
			$this->db->where('id', $option_id);
        	$this->db->update($filter_table, [ 'name' =>$option_value]);
        	return ($this->db->affected_rows() == 1) ? true : false;
		}

		public function uploadProducts($data, $uid){
			$title = $data['title'];
			$code = $data['code'];
			$sku = $data['sku'];
			$category = $data['category'];
			$sub_category = $data['sub_category'];
			$quantity = $data['quantity'];
			$price = $data['price'];
			$discount_percentage = $data['discount_percentage'];
			$height = $data['height'];
			$width = $data['width'];
			$manufacture = $data['manufacture'];
			$origin = $data['origin'];
			$setting_type = $data['setting_type'];
			$weight = $data['weight'];
			$size = $data['size'];
			$short_description = $data['short_description'];
			$long_description = $data['long_description'];

			$style = "";
			$gender = "";
			$no_of_stone = "";
			$occasion = "";
			$delivery_time = "";
			$design = "";
			$collections = "";
			$stone_shape = "";
			$stone_color = "";
			$type = "";
			$metal = "";
			$purity = "";


			if(isset($data['style'])) 			$style 			= implode(",", $data['style']);
			if(isset($data['gender'])) 			$gender 		= implode(",", $data['gender']);
			if(isset($data['no_of_stone'])) 	$no_of_stone 	= implode(",", $data['no_of_stone']);
			if(isset($data['occasion'])) 		$occasion 		= implode(",", $data['occasion']);
			if(isset($data['delivery_time'])) 	$delivery_time 	= implode(",", $data['delivery_time']);
			if(isset($data['design'])) 			$design 		= implode(",", $data['design']);
			if(isset($data['collections'])) 	$collections 	= implode(",", $data['collections']);
			if(isset($data['stone_shape'])) 	$stone_shape 	= implode(",", $data['stone_shape']);
			if(isset($data['stone_color'])) 	$stone_color 	= implode(",", $data['stone_color']);
			if(isset($data['type'])) 			$type 			= implode(",", $data['type']);
			if(isset($data['metal'])) 			$metal 			= implode(",", $data['metal']);
			if(isset($data['purity'])) 			$purity 		= implode(",", $data['purity']);

			$data = [
				'title' => $title,
				'uid' => $uid,
				'code' => $code,
				'sku' => $sku,
				'category_id' => $category,
				'sub_category_id' => $sub_category,
				'quantity' => $quantity,
				'price' => $price,
				'discount_percentage' => $discount_percentage,
				'height' => $height,
				'width' => $width,
				'manufacture' => $manufacture,	
				'origin' => $origin,
				'setting_type' => $setting_type,
				'weight' => $weight,
				'size' => $size,
				'short_description' => $short_description,
				'long_description' => $long_description,
				'style' => $style,
				'gender' => $gender,
				'no_of_stone' => $no_of_stone,
				'occasion' => $occasion,
				'delivery_time' => $delivery_time,
				'design' => $design,
				'collections' => $collections,
				'stone_shape' => $stone_shape,
				'stone_color' => $stone_color,
				'type' => $type,
				'metal' => $metal,
				'purity' => $purity
			];
			
			$this->db->insert('product',$data);
			return ($this->db->affected_rows() == 1) ? true : false;
		}
		

		public function fetchAllData(){		
			$this->db->select('a.uid, a.title, a.code, a.sku, a.price, a.discount_percentage, a.quantity, b.name as `category_name`, c.name as `sub_category_name`');
			$this->db->from('product a'); 
			$this->db->join('category b', 'b.id=a.category_id', 'left');
    		$this->db->join('sub_category c', 'c.id=a.sub_category_id', 'left');
			$query = $this->db->get();
			return $query->result_array();
		}

		public function uploadProductImages($image = array(), $product_id, $path){
			foreach ($image as $key => $value) {
				$image_name = $value['images'];
				$image_total = $path . $image_name;
				$data = [
					'uid' => $this->unique_id_generator(),
					'product_uid' => $product_id,
					'image_path' => $image_total
				];
				$this->db->insert('images_of_products', $data);
			}
			return true;
		}

		public function getOrders(){
			$this->db->select('u.uid as userid, u.fname, u.lname, u.email, u.phone, o.uid, o.grand_total, o.payment_status, o.created_at');
			$this->db->from('orders o');
			$this->db->join('users u', 'o.user_id = u.uid', 'left');
			$query = $this->db->get();
			return $query->result_array();
		}

		private function getTotalOrderForAPerticularUser($user_id){
			$query = $this->db->query("SELECT count(uid) AS orders FROM `orders` WHERE user_id = '$user_id' AND payment_status = 1");
			return $query->result_array();
		}

		public function getUsers(){
			$query = $this->db->get('users');
			$query = $query->result_array();
			foreach ($query as $key => $value) {
				$user_id = $value['uid'];
				$order_count = $this->getTotalOrderForAPerticularUser($user_id);
				$query[$key]['total_orders'] = $order_count[0]['orders'];
			}
			return $query;
		}

		public function setGoldPriceFromApiData($price){

			$karat_rate_24 = $price;   		   	// Convert 24 Karat, 24/24= 1
			$karat_rate_22 = $this->decimal_two_digit($price * 0.916);	// Convert 22 Karat, 22/24= 0.916
			$karat_rate_21 = $this->decimal_two_digit($price * 0.875);  	// Convert 21 Karat, 21/24= 0.875
			$karat_rate_18 = $this->decimal_two_digit($price * 0.750); 	// Convert 18 Karat, 18/24= 0.750
			$karat_rate_16 = $this->decimal_two_digit($price * 0.666);  	// Convert 18 Karat, 16/24= 0.666
			$karat_rate_14 = $this->decimal_two_digit($price * 0.5833);  // Convert 18 Karat, 14/24= 0.5833 

			$data = array(
		        'uid'   => $this->unique_id_generator(),
		        'price_24_karet'=> $karat_rate_24,
		        'price_22_karet'=> $karat_rate_22,
		        'price_21_karet'=> $karat_rate_21,
		        'price_18_karet'=> $karat_rate_18,
		        'price_16_karet'=> $karat_rate_16,
		        'price_14_karet'=> $karat_rate_14,
		        'created_at'	=> date("Y-m-d H:i:s")
			);

			$this->db->insert('gold_price_from_api', $data);
			return ($this->db->affected_rows() != 1) ? false : true;
		}

		public function insert_csv_products($file_data){			
			if($this->db->insert_batch('product', $file_data))
				return true;
			else
				return false;
		}

		public function getCategoryId($category){
			$this->db->select('id');
			$this->db->from('category');
			$this->db->where('name', $category);
			$query = $this->db->get();
			$query = $query->result_array();
			return (!empty($query)) ? $query[0]['id'] : 0;
		}
		
		public function getSubCategoryId($sub_category){
			$this->db->select('id');
			$this->db->from('sub_category');
			$this->db->where('name', $sub_category);
			$query = $this->db->get();
			$query = $query->result_array();
			return (!empty($query)) ? $query[0]['id'] : 0;
		}

		public function getFilterOptionId($filter_value, $table_name){
			$this->db->select('id');
			$this->db->where('name', $filter_value);
			$query = $this->db->get($table_name);
			// return ($this->db->affected_rows() > 0)?true:false;
			$query = $query->result_array();
			if(!(empty($query)))
				return $query[0]['id'];
			else
				return 0;
		}

		public function check_product_using_product_code($product_code){
			$this->db->where('code', $product_code);
			$query = $this->db->get('product');
			return ($this->db->affected_rows() > 0)?true:false;
		}
	}

?>