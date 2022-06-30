<?php defined("BASEPATH") or exit("No direct script access allowed");

	class User_model extends CI_Model{

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

		public function setUserData($data, $otp){
			date_default_timezone_set(time_zone);

			$uid = $this->unique_id_generator();
			$fname = $this->input->post('fname');
			$lname = $this->input->post('lname');
			$phone = $this->input->post('phone');
			$email = $this->input->post('email');
			$password = md5($this->input->post('password'));

			$data = [
				'uid' => $uid,
				'fname' => $fname,
				'lname' => $lname,
				'phone' => $phone,
				'email' => $email,
				'password' => $password,
				'registered_at' => date("Y-m-d H:i:s"),
				'validation_otp' => $otp
			];

			$this->db->insert('users',$data);
			$count = $this->db->affected_rows();

			if($count == 1)
				return $uid;
			else
				return "";
		}

		public function user_exist($email){
			$this->db->where('email', $email);
			$this->db->get('users');
			return ($this->db->affected_rows() == 1) ? true : false;
		}

		public function verify_user_with_otp($otp, $userid, $step){
			//step 1 for checking he verification otp exist
			if($step == 1){
				$this->db->where('uid', $userid);
				$this->db->where('validation_otp', $otp);
				$this->db->get('users');
				return ($this->db->affected_rows() == 1)? true:false;
			}else if($step == 2){
				$data = [
					'is_email_validate' => 1
				];
				$this->db->where('uid', $userid);
				$this->db->where('validation_otp', $otp);
				$this->db->update('users', $data);
				return ($this->db->affected_rows() == 1)? true:false;
			}
		}

		public function login($email, $password){
			$password = md5($password);
			$this->db->select('uid, fname, lname, address_id, is_email_validate');
			$this->db->where('email', $email);
			$this->db->where('password', $password);
			$query = $this->db->get('users');
			return $query;
		}

		public function getUserEmailAndPhone($uid){
			$this->db->select('phone, email');
			$this->db->where('uid', $uid);
			$query = $this->db->get('users');
			return $query->result_array();
		}

		public function update_user_address($address_data, $userid, $address_id){
			$uid = $this->unique_id_generator();		

			if($address_id == "0"){
				$data = [
					'uid' 			=> $uid,
					'user_id' 		=> $userid,
					'address' 		=> $address_data['address'],
					'state'			=> $address_data['state'],
					'pincode'		=> $address_data['pincode'],
					'address_note' 	=> $address_data['order_notes'],
					'created_at'	=> date("Y-m-d H:i:s")
				];
				//insert address if address not present
				$this->db->insert('user_address', $data);

				if($this->db->affected_rows() == 1){
					//update address_id field in users table
					$data = [
						'address_id' => $uid
					];
					$this->db->where('uid', $userid);
					$this->db->update('users', $data);
					$_SESSION['addressId'] = $uid;
					return ($this->db->affected_rows() == 1)? true:false;
				}else{
					return false;
				}
			}else{
				// print_r($address_id);
				$data = [					
					'address' 		=> $address_data['address'],
					'state'			=> $address_data['state'],
					'pincode'		=> $address_data['pincode'],
					'address_note' 	=> $address_data['order_notes'],
					'created_at'	=> date("Y-m-d H:i:s")
				];
				//olny update address
				$this->db->where('uid', $address_id);
				$this->db->update('user_address', $data);				
				return ($this->db->affected_rows() == 1)? true:false;
			}
		}

		public function getUserAddress($userid){
			$this->db->select('address, state, pincode, address_note');
			$this->db->where('user_id', $userid);
			$query = $this->db->get('user_address');
			return $query->result_array();
		}

		public function getUserDataByEmail($email){
			$this->db->select('uid, fname, lname');	
			$this->db->where('email', $email);
			$query = $this->db->get('users');
			return $query->result_array();
		}

		public function setOtpForForgetPassword($email, $otp){
			$data = [
				'validation_otp' => $otp
			];
			$this->db->where('email', $email);
			$this->db->update('users', $data);
			return ($this->db->affected_rows() == 1)? true:false;
		}

		public function updatePassword($userid, $password){
			$data = [
				'password' => $password
			];
			$this->db->where('uid', $userid);
			$this->db->update('users', $data);
			return ($this->db->affected_rows() == 1)? true:false;
		}
		
	}
?>