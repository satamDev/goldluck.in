<?php defined("BASEPATH") or exit("No direct script access allowed");

	class Product_model extends CI_Model{

		public function __construct() {
	       parent::__construct();
	       date_default_timezone_set(time_zone);
	   	}

	   	private function unique_id_generator($text){
			return $text . "-" . random_int(100000, 999999);
		}

		private function decimal_two_digit($digit){
	        return number_format((float)$digit, 2, '.', '');
	    }

		public function record_count($category = null, $sub_category = null) {

			if($category != null){
				$category_result = $this->getIdOfCategory($category);
				// print_r($category);
				if(!empty($category_result))
	       			$category_id = $category_result[0]['id'];
			}

	       	if($category == null && $sub_category == null)
	       		return $this->db->count_all("product");
	       	else if($category != null && $sub_category == null){	       		
	       		return (isset($category_id))?$this->db->where('category_id', $category_id)->count_all_results("product") : 0;
	       	}else if($category != null && $sub_category != null){
	       		if(isset($category_id)){
		       		$sub_category_result = $this->getIdOfSubCategoryByCategoryId($category_id, $sub_category);
		       		$sub_category_id = $sub_category_result[0]['id'];
		       	}
	       		return (isset($category_id))?$this->db->where('category_id', $category_id)->where('sub_category_id', $sub_category_id)->count_all_results("product"):0;
	       	}
	   	}

	   	private function get_user_email_phone($userid){
	   		$this->db->select('email, phone');
	   		$this->db->where('uid', $userid);
	   		$query = $this->db->get('users');
	   		return $query->result_array();
	   	}

	   	private function get_gold_price(){
	   		$this->db->select('price_24_karet, price_22_karet, price_21_karet, price_18_karet, price_16_karet, price_14_karet');
	   		$this->db->limit(1);
	   		$this->db->order_by('created_at', 'DESC');
	   		$query = $this->db->get('gold_price_from_api');
	   		$query = $query->result_array();
	   		return $query[0];
	   	}	   	

	   	public function fetch_products($limit, $start, $category_id = null, $sub_category_id = null, $short_by = null) {
			$this->db->limit($limit, $start);

			// $this->db->select('p.uid as product_id, p.title, p.price, p.discount_percentage, p.weight, i.image_path');
			$this->db->select('p.uid as product_id, p.title, p.price, p.discount_percentage, p.weight, p.cover_image');
			
			$this->db->from('product p');
			// $this->db->join('images_of_products i', 'p.uid=i.product_uid', 'left');
			
			if($category_id != null && $sub_category_id == null)
				$this->db->where('category_id', $category_id);

			if($category_id != null && $sub_category_id != null){
				$this->db->where('category_id', $category_id);
				$this->db->where('sub_category_id', $sub_category_id);
			}


			if($short_by != null){
				if($short_by == 'whatsnew')
					$this->db->order_by("created_at", "desc");
				else if($short_by == 'price_hign_to_low'){
					$this->db->order_by("weight", "desc");
				}
				else if($short_by == 'price_low_to_high'){
					$this->db->order_by("weight", "asc");
				}
				else if($short_by == 'discount')
					$this->db->order_by("discount_percentage", "desc");
			}

			$this->db->where('p.status', 1);
			
			// $this->db->where('i.cover_image', 1);
			$query = $this->db->get();
			// echo $this->db->last_query();

			$gold_rate = $this->get_gold_price();

			if($this->session->has_userdata('userId')){
				// user logged in
				// wishlist enabled while logged in
				if ($query->num_rows() > 0) {
					foreach ($query->result() as $row) {
						$row->price = $this->decimal_two_digit((float)$row->weight * $gold_rate['price_24_karet']);
						$product_id = $row->product_id;
						$user_id = $this->session->userdata('userId');
						$has_wishlist = $this->product_exist_in_wishlist($user_id, $product_id);
						if($has_wishlist == '1'){
							$row->wishlist = 1;
						}else{
							$row->wishlist = 0;
						}	
						$data[] = $row;					
					}
					return $data;
				}
			}else{
				if ($query->num_rows() > 0) {
					foreach ($query->result() as $row) {
						$row->price = $this->decimal_two_digit((float)$row->weight * $gold_rate['price_24_karet']);
						$data[] = $row;
					}
					return $data;
				}
			}
			return false;
		}

		public function get_featured_products(){
			$limit = 20;
			$start = 0;
			$this->db->limit($limit, $start);

			$this->db->select('p.uid as product_id, p.title, p.discount_percentage, p.weight , p.cover_image');
			
			$this->db->from('product p'); 
			// $this->db->join('images_of_products i', 'p.uid=i.product_uid', 'left');
			$this->db->where('p.status', 1);
			$this->db->where('p.featured_products', 1);
			// $this->db->where('i.cover_image', 1);
			$query = $this->db->get();

			$gold_rate = $this->get_gold_price();

			if($this->session->has_userdata('userId')){
				// user logged in
				// wishlist enabled while logged in
				if ($query->num_rows() > 0) {
					foreach ($query->result() as $row) {
						$row->price = $this->decimal_two_digit((float)$row->weight * $gold_rate['price_24_karet']);
						$product_id = $row->product_id;
						$user_id = $this->session->userdata('userId');
						$has_wishlist = $this->product_exist_in_wishlist($user_id, $product_id);
						if($has_wishlist == '1'){
							$row->wishlist = 1;
						}else{
							$row->wishlist = 0;
						}	
						$data[] = $row;					
					}
				}
			}else{
				if ($query->num_rows() > 0) {
					foreach ($query->result() as $row) {
						$row->price = $this->decimal_two_digit((float)$row->weight * $gold_rate['price_24_karet']);
						$data[] = $row;
					}
				}
			}
			return $data;
		}

		// Depreciated //

		// public function get_product_images($product_id){
		// 	$this->db->where('product_uid', $product_id);
		// 	$query_get_product_images = $this->db->get('images_of_products');
		// 	$query_get_product_images = $query_get_product_images->result_array();
		// 	return $query_get_product_images;
		// }

		public function get_single_product($product_id){
			if($product_id != null OR $product_id != ""){
				$this->db->select('p.*, c.name as category');
				$this->db->where('p.uid', $product_id);
				$this->db->from('product p');
				$this->db->join('category c', 'p.category_id = c.id', 'left');
				$query = $this->db->get();
				$result = $query->result_array();
				$gold_rate = $this->get_gold_price();
				if ($query->num_rows() > 0) {
					$result = $result[0];

					// $images = $this->get_product_images($product_id);
					
					$images = explode(",", $result['other_images']);					

					$image_array = [];
					$i = 0;
					foreach($images as $key => $value){
						// $image_array[$i++] = ["path"=>$value['image_path'], "cover_image"=>$value['cover_image']];
						$image_array[$i++] = ["path" => $value];
					}

					$result['images'] = $image_array;

					// user logged in
					// wishlist enabled while logged in
					$user_id = $this->session->userdata('userId');
					$has_wishlist = $this->product_exist_in_wishlist($user_id, $product_id);
					if($has_wishlist == '1'){
						$result['wishlist'] = 1;
					}else{
						$result['wishlist'] = 0;
					}
					$result['price'] = $this->decimal_two_digit((float)$result['weight'] * $gold_rate['price_24_karet']);	
				}
				return $result;
			}
		}

		public function product_exist_in_wishlist($user_id, $product_id){
			$this->db->where('user_uid', $user_id);
			$this->db->where('product_uid', $product_id);
			$this->db->get("wishlist");

			return $this->db->affected_rows();
		}

		public function set_to_wishlist($user_id, $product_id){
			$data = array(
		        'product_uid'   => $product_id,
		        'user_uid'		=> $user_id,
		        'created_at'	=> date("Y-m-d H:i:s")
			);

			$this->db->insert('wishlist', $data);
			return ($this->db->affected_rows() != 1) ? false : true;
		}

		public function get_wishlist($user_id){
			$this->db->select('p.title, p.price, p.discount_percentage, p.uid as product_id, p.quantity');
			$this->db->from('product p');
			$this->db->join('wishlist w', 'p.uid = w.product_uid');
			$this->db->where('user_uid', $user_id);
			$query = $this->db->get();
			return $query->result_array();
		}

		public function delete_single_from_wishlist($user_id, $product_id){
			if($this->product_exist_in_wishlist($user_id, $product_id) > 0){
				$this->db->where('user_uid', $user_id);
				$this->db->where('product_uid', $product_id);
				$this->db->delete('wishlist');
				return ($this->db->affected_rows() != 1) ? false : true;
			}else return false;
		}

		public function getIdOfCategory($category){
			$this->db->select('id');
			$this->db->where('name', $category);
			$query = $this->db->get('category');
			return $query->result_array();
		}

		public function getIdOfSubCategoryByCategoryId($category_id, $sub_category){
			$this->db->select('id');
			$this->db->where('category_id ', $category_id);
			$this->db->where('name', $sub_category);
			$query = $this->db->get('sub_category');
			return $query->result_array();
		}

		public function setOrders($userid){
			//inser data to orders table
			$order_id = $this->unique_id_generator("ORDERS-".date("ymd"));
			$data = [
				'uid' 			=> $order_id,
				'user_id' 		=> $userid,
				'grand_total' 	=> $this->cart->format_number($this->cart->total()),
				'created_at'	=> date("Y-m-d H:i:sa")
			];
			$this->db->insert('orders', $data);
			return ($this->db->affected_rows() == 1) ? $order_id : '0';
		}

		public function setOrderItems($order_id){
			//inser data to order_items table
			$cart = $this->cart->contents();
			foreach ($cart as $item){
				$order_item_id = $this->unique_id_generator("ORDER_ITEMS-".date("ymd"));
				$data = [
					'uid' 			=> $order_item_id,
					'order_id'		=> $order_id,
					'product_id' 	=> $item['id'],
					'quantity'		=> $item['qty'],
					'single_price'	=> $item['price'],
					'sub_total'		=> $item['subtotal']
				];
				$this->db->insert('order_items', $data);
			}

			if($this->db->affected_rows() != 0){
				$fname = $this->session->userdata('fname');
			    $lname = $this->session->userdata('lname');
			    $full_name = $fname . " " . $lname;

			    $email_phone_result = $this->get_user_email_phone($this->session->userdata('userId'));
			    $email = $email_phone_result[0]['email'];
			    $phone = $email_phone_result[0]['phone'];

			    $total = $this->cart->total();

				$data=[
					'description' 		=> 'GoldLuck Payment',
					'key_id'			=> RAZORPAY_API_KEY_ID,
					'currency_code'		=> 'INR',
					'merchant_order_id'	=> $order_id,
					'card_holder_name'	=> $full_name,
					'email'             => $email,
				    'phone'             => $phone,
				    'name'              => "GoldLuck Payment",
				    'total'				=> ($total * 100),
				    'amount'			=> $total,
				    'txnid'				=> date("YmdHis"),
				    'callback_url'      => base_url().'Razorpay/callback',
			        'surl'              => base_url().'Razorpay/success',
			        'furl'              => base_url().'Razorpay/failed',
				];
				return $data;
			}else{
				return [];
			}
		}

		public function updatePaymentStatusForAPerticularOrder($order_id){
			$data = [
				'payment_status' => true
			];
			$this->db->where('uid', $order_id);
			$this->db->update('orders', $data);
			return ($this->db->affected_rows() == 1) ? true : false;
		}

		public function setPaymentStatus($data){
			foreach($data as $key => $value){
				if(is_array($value)){
					$data[$key] = serialize($value);
				}
				if($key == 'amount'){
					$data[$key] = (float)($value / 100);
				}
			}
			$this->db->insert('payment_details', $data);
			return ($this->db->affected_rows() == 1) ? true : false;
		}

		private function get_all_order_items($order_id){
			$this->db->select('oi.*, p.title, i.image_path');
			$this->db->from('order_items oi');
			$this->db->join('images_of_products i', 'oi.product_id = i.product_uid', 'left');
			$this->db->join('product p', 'oi.product_id = p.uid');
			$this->db->where('oi.order_id', $order_id);
			$this->db->where('i.cover_image', 1);
			$query = $this->db->get();
			return $query->result_array();
		}

		public function getAllUserOrders($userid, $year = ""){
			$this->db->select('o.uid as orderId, o.grand_total, o.payment_status, o.created_at as time');
			$this->db->where('o.user_id', $userid); 
			if($year != "")
			 	$this->db->like('o.created_at', $year, 'after'); 
			$this->db->from('orders o');
			$query = $this->db->get();
			$query = $query->result_array();
			foreach ($query as $key => $value) {
				$order_id = $value['orderId'];
				$query[$key]['items'] = $this->get_all_order_items($order_id);
			}
			return $query;
		}

		public function getDataFromTable($tableName){
			$this->db->select(['id', 'name']);
			$query = $this->db->get($tableName);
			return $query->result();
		}

	}


?>