<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	private $number_of_product_per_page = 30;
	private $site_image_path = 'assets/images/quick_request/';

	public function __construct(){
		parent::__construct();
		$this->load->library('cart');
	}

	private function init_Site_details_model(){
		$this->load->model('site_details_model');
	}

	private function init_user_model(){
		$this->load->model('user_model');
	}

	private function init_product_model(){
		$this->load->model("Product_model");
	}

	private function init_quick_request_model(){
		$this->load->model("Quick_request");
	}

	private function init_retailer_model(){
		$this->load->model('Retailer');
	}

	private function do_upload($path,$send_img){
        $config['upload_path']   = './'.$path;
        $config['allowed_types'] = 'jpg|jpeg|png'; 
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        return (!$this->upload->do_upload($send_img)) ? false : true;
    } 	

	private function valid_access(){//Check admin is logged in or not
        if( !$this->session->has_userdata('userId') )
            return false;
        return true;
    } 

	private function getSiteBasicData(){
		$this->init_Site_details_model();
		$result = $this->site_details_model->getSiteBasicDetails();
		$result = (array)$result[0];
		return $result;
	}

	private function getBanner(){
		$this->init_Site_details_model();
		$result = $this->site_details_model->getBanners();
		return $result;
	}

	private function user_exist_by_email($email){
		$this->init_user_model();
		$result = $this->user_model->user_exist($email);
		return ($result) ? true : false;
	}

	private function newotp(){
        return rand(1000,9999);
    }

	private function do_mail($info, $otp){
        $this->load->library('email');

        $mail_config['smtp_host'] = 'instanthealth.in';
        $mail_config['smtp_port'] = '465';
        $mail_config['smtp_user'] = 'info@instanthealth.in';
        $mail_config['_smtp_auth'] = TRUE;
        $mail_config['smtp_pass'] = ']k|^3(cbs4_j';
        $mail_config['smtp_crypto'] = 'ssl';
        $mail_config['protocol'] = 'smtp';
        $mail_config['mailtype'] = 'html';
        $mail_config['send_multipart'] = FALSE;
        $mail_config['charset'] = 'utf-8';
        $mail_config['wordwrap'] = TRUE;

        $this->email->initialize($mail_config);
        $this->email->set_newline("\r\n");              
        $this->email->from('info@instanthealth.in', 'SATAM');

        $this->email->to($info['email']);

        $this->email->subject('Email Verification Code');       
        
        $this->email->message('Hi ,'. $info['name'] .'
        We received a request to reset your Account password.
        Enter the following password reset code:'.$otp);
       
        if($this->email->send()){
        	return true;
        }else{
        	return false;
        }
    }

	private function getCategoryWiseSubCategory(){
		$this->init_Site_details_model();
		$result = $this->site_details_model->getTopPageCategories();
		$arr = [];
		$i = 0;
		
		foreach ($result as $key => $value) {
			$result_subcategory = $this->site_details_model->getSubCategories($value->id);
			$ar = [];
			$j = 0;
			foreach($result_subcategory as $key1 => $value1){
				$ar[$j++] = ['id'=>$value1->id, 'name'=>$value1->name];
			}
			$arr[$i++][$value->name] = $ar;
		}

		return $arr;
	}

	public function index(){ //User Home Page View
		$this->init_Site_details_model();
		$data = [
			'title' => title_home,
			'site_details' => $this->getSiteBasicData(),
			'home_menu_category' => $this->getCategoryWiseSubCategory(),
			'home_menu_pages' => $this->site_details_model->getTopPages()
		];
		
		$data_for_home = [
			'banner' => $this->getBanner(),
			'featured_products' => $this->fetch_featured_products()
		];

		$this->load->view('inc/header', $data);
		$this->load->view('inc/header_menu', $data);
		$this->load->view('user/home',$data_for_home);
		$this->load->view('inc/footer', $data);
		$this->load->view('inc/quick_request');
		$this->load->view('inc/customjs/quick_request_js');
		$this->load->view('inc/customjs/cart_js');
		$this->load->view('inc/customjs/wishlist_js');
	}

	public function offer(){ //Offer Page View
		$this->init_Site_details_model();
		$data = [
			'title' => 'Offer',
			'site_details' => $this->getSiteBasicData(),
			'home_menu_category' => $this->getCategoryWiseSubCategory(),
			'home_menu_pages' => $this->site_details_model->getTopPages()
		];
		

		$this->load->view('inc/header', $data);
		$this->load->view('inc/header_menu', $data);
		$this->load->view('inc/footer', $data);
	}

	public function company(){ //company Page View
		$this->init_Site_details_model();
		$data = [
			'title' => 'Company',
			'site_details' => $this->getSiteBasicData(),
			'home_menu_category' => $this->getCategoryWiseSubCategory(),
			'home_menu_pages' => $this->site_details_model->getTopPages()
		];
		

		$this->load->view('inc/header', $data);
		$this->load->view('inc/header_menu', $data);
		$this->load->view('inc/footer', $data);
	}

	public function signin(){ //User Signin Page View
		if($this->valid_access()) redirect('account');
		$this->init_Site_details_model();
		$data = [
			'title' => "Login",
			'site_details' => $this->getSiteBasicData(),
			'home_menu_category' => $this->getCategoryWiseSubCategory(),
			'home_menu_pages' => $this->site_details_model->getTopPages()
		];
		$this->load->view('inc/header', $data);
		$this->load->view('inc/header_menu', $data);
		$this->load->view('user/login');
		$this->load->view('inc/footer');
	}

	public function signup(){ //User SignUp Page View
		if($this->valid_access()) redirect('account');
		$data = [
			'title' => "SignUp",
			'site_details' => $this->getSiteBasicData(),
			'home_menu_category' => $this->getCategoryWiseSubCategory(),
			'home_menu_pages' => $this->site_details_model->getTopPages()
		];
		$this->load->view('inc/header', $data);
		$this->load->view('inc/header_menu', $data);
		$this->load->view('user/signup');
		$this->load->view('inc/footer');
	}

	public function forgetPassword(){ //forget password page view
		$data = [
			'title' => "Forget Password",
			'site_details' => $this->getSiteBasicData(),
			'home_menu_category' => $this->getCategoryWiseSubCategory(),
			'home_menu_pages' => $this->site_details_model->getTopPages()
		];
		$this->load->view('inc/header', $data);
		$this->load->view('inc/header_menu', $data);
		$this->load->view('user/forgotpassword');
		$this->load->view('inc/footer');
	}

	public function forget_password(){	//forget password logic section
		if($this->valid_access()) redirect('account');
		$this->load->library("form_validation");
		$this->form_validation->set_rules('email','Email','trim|required|valid_email|xss_clean');

		if($this->form_validation->run() == false){
        	redirect('forget_password');
    	}else{
    		$email = $this->input->post('email');
    		$this->init_user_model();
    		if(!$this->user_model->user_exist($email)){
    			$this->session->set_flashdata('error', 'Email ID not registered with us');
    			redirect('forget_password');
    		}else{
    			$result = $this->user_model->getUserDataByEmail($email);
    			$otp = $this->newotp();
    			$info = [
					'name' => $result[0]['fname'] . " " . $result[0]['lname'],
					'email' => $email,
				];
				$this->do_mail($info, $otp);
		    	$this->session->set_flashdata('success', 'We sent an OTP to your email address please verify with otp');
		    	$this->session->set_userdata('otp_for', 'forget_password');
		    	$this->session->set_userdata('userid', $result[0]['uid']);
		    	$result = $this->user_model->setOtpForForgetPassword($email, $otp);
		    	if($result)
		    		$this->otp_verification();
		    	else{
		    		redirect('forget_password');
		    	}
    		}
    	}
	}

	public function new_password_generation(){ //new_password_generation page view
		$data = [
			'title' => "Change Password"			
		];
		$this->load->view('inc/header', $data);
		$this->load->view('user/new_password_generation');
	}

	public function otp_verification(){ //Otp verification page view
		$data = [
			'title' => "Otp Verification"			
		];
		$this->load->view('inc/header', $data);
		$this->load->view('user/otp_verification');
	}

	public function my_account(){	//My Account Page View
		if(!$this->valid_access()) redirect('login');
		$this->init_Site_details_model();
		$this->init_user_model();
		$title = ( $this->session->has_userdata('fname') )? ucwords($this->session->userdata('fname')):'';
		$address = [];
		
		$this->init_retailer_model();

		if($this->session->userdata('addressId') != "0"){			
			$address = $this->user_model->getUserAddress($this->session->userdata('userId'));
		}

		$data = [
			'title' => $title . " | Account",
			'site_details' => $this->getSiteBasicData(),
			'home_menu_category' => $this->getCategoryWiseSubCategory(),
			'home_menu_pages' => $this->site_details_model->getTopPages()
		];
		
		$data_user = [];
		if($this->session->has_userdata('type') && $this->session->has_userdata('type') == 'retailer'){
			$result = $this->Retailer->getRetailerEmailAndPhone($this->session->userdata('userId'));
			$data_user = [
				'email' => $result[0]['email'],
				'phone' => $result[0]['phone'],
				'store_name' => $result[0]['store_name'],
				'gst_no' => $result[0]['gst_no'],
				'address' => $address
			];
		}else{
			$result = $this->user_model->getUserEmailAndPhone($this->session->userdata('userId'));
			$data_user = [
				'email' => $result[0]['email'],
				'phone' => $result[0]['phone'],
				'address' => $address
			];
		}
		
		
		$this->load->view('inc/header', $data);
		$this->load->view('inc/header_menu', $data);
		$this->load->view('user/my_account', $data_user);
		$this->load->view('inc/footer');
		$this->load->view('inc/customjs/orders_js');
	}

	public function cart(){ //cart page view
		// if(!$this->valid_access()) redirect('login');
		$this->init_Site_details_model();
		$data = [
			'title' => "Cart",
			'site_details' => $this->getSiteBasicData(),
			'home_menu_category' => $this->getCategoryWiseSubCategory(),
			'home_menu_pages' => $this->site_details_model->getTopPages()
		];
		$this->load->view('inc/header', $data);
		$this->load->view('inc/header_menu', $data);
		$this->load->view('user/cart');
		$this->load->view('inc/footer');
		$this->load->view('inc/customjs/cart_js');
	}

	public function user_signup(){
		$this->load->library("form_validation");
		$this->form_validation->set_rules('fname','First Name','trim|required|min_length[1]|xss_clean');
		$this->form_validation->set_rules('lname','Last Name','trim|required|min_length[1]|xss_clean');
		$this->form_validation->set_rules('phone','Phone Number','trim|required|min_length[10]|max_length[10]|xss_clean');
		$this->form_validation->set_rules('email','Email','trim|required|valid_email|xss_clean');
	    $this->form_validation->set_rules('password','Password','trim|required|min_length[4]|max_length[40]|xss_clean');

	    if($this->form_validation->run() == false){
	        $this->signup();
	    }else{
	    	if(!$this->user_exist_by_email($this->input->post('email'))){
		    	$this->init_user_model();
		    	$otp = $this->newotp();
		    	$userid = $this->user_model->setUserData($this->input->post(), $otp);
		    	if($userid != ""){
		    		$name = $this->input->post('fname');
		    		$email = $this->input->post('email');
					$info = [
						'name' => $name,
						'email' => $email,
					];
					$this->do_mail($info, $otp);
			    	$this->session->set_flashdata('success', 'We sent an OTP to your email address please verify with otp');
			    	$this->session->set_flashdata('userid', $userid);
			    	$this->otp_verification();
		    	}else{
		    		$this->session->set_flashdata('error', 'Something Went Wrong');
		    		$this->signup();
		    	}		    	
		    }else{
		    	$this->session->set_flashdata('error', 'Email Id Already Exist');
		    	redirect('signup');
		    }
	    }
	}

	public function verify_otp_mail(){
		if($this->input->post('for') == 'forget_password'){ //otp verification for forget password 
			$userid = $this->input->post('user');
			if($userid != "" or $userid != null){
				$otp = $this->input->post('otp');
				$this->init_user_model();
				if($this->user_model->verify_user_with_otp($otp, $userid, 1)){	
					//successfully otp verified
					$this->new_password_generation();
				}else{
					//otp verification error

				}
			}else{
				$this->session->set_flashdata('error', 'Unauthorised Access');
				$this->otp_verification();
			}
		}else{	 //otp verification for email verification
			$userid = $this->input->post('user');
			if($userid != "" or $userid != null){
				$otp = $this->input->post('otp');
				$this->init_user_model();
				if($this->user_model->verify_user_with_otp($otp, $userid, 1)){
					if($this->user_model->verify_user_with_otp($otp, $userid, 2)){
						$this->session->set_flashdata('success', 'Email Id Successfully verified');
						redirect('login');
					}else{
						$this->session->set_flashdata('error', 'Otp is Wrong');
						$this->session->set_flashdata('userid', $userid);
						$this->otp_verification();
					}
				}else{
					$this->session->set_flashdata('error', 'Otp is Wrong');
					$this->session->set_flashdata('userid', $userid);
					$this->otp_verification();
				}
			}else{
				$this->session->set_flashdata('error', 'Unauthorised Access');
				$this->otp_verification();
			}
		}
	}

	public function change_password(){ //generate new password logical part
		$this->load->library("form_validation");
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]');
		$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|matches[password]');
		if($this->form_validation->run() == false){
	        $this->new_password_generation();
	    }else{
	    	$password = $this->input->post('password');
	    	$password = md5($password);
	    	$userid = $this->input->post('user');

	    	$this->init_user_model();
	    	$result = $this->user_model->updatePassword($userid, $password);
	    	if($result){
	    		$this->session->set_flashdata('success', 'Password Updated Successfully');
	    		redirect('login');
	    	}else{
	    		$this->session->set_flashdata('error', 'Password Updatation Failed');
	    		redirect('home/new_password_generation');
	    	}
	    }
	}

	public function user_login(){
		$this->load->library("form_validation");
		$this->form_validation->set_rules('email','Email','trim|required|valid_email|xss_clean');
	    $this->form_validation->set_rules('password','Password','trim|required|min_length[4]|max_length[40]|xss_clean');

	    if($this->form_validation->run() == false){
	        $this->signin();
	    }else{
	    	$email = $this->input->post('email');
	    	$password = $this->input->post('password');

	    	if($this->user_exist_by_email($email)){
	    		$this->init_user_model();
	    		$result = $this->user_model->login($email, $password);
	    		$result = $result->result_array();
	    		if(count($result) < 1){
	    			$this->session->set_flashdata('error', 'Email Id or Password is Wrong, Try Again');
					redirect('login');
	    		}
	    		$sessionArray = array(
                    'userId'=> $result[0]['uid'],                    
                    'fname' => $result[0]['fname'],
                    'lname' => $result[0]['lname'],
                    'addressId' => $result[0]['address_id'],
                    'verifiedEmail' => $result[0]['is_email_validate']
                );	
                $this->session->set_userdata($sessionArray);
                $this->session->set_flashdata('success', 'Successfully Logged In');
                redirect('/');
	    	}else{
	    		$this->session->set_flashdata('error', 'Email Id not registered');
				redirect('login');
	    	}
	    }
	}

	public function logout(){
		$this->session->unset_userdata('userId');
        $this->session->unset_userdata('fname');
        $this->session->unset_userdata('lname');
        $this->session->unset_userdata('addressId');
        $this->session->unset_userdata('verifiedEmail');
        if($this->session->has_userdata('type')){
        	$this->session->unset_userdata('type');
        	$this->session->unset_userdata('retailer_discount_percentage');
        }
        $this->session->set_flashdata('success', 'Successfully Logged Out'); 
        redirect('login');
	}

	public function update_address(){
		// this time if user address is 0 then change
		$userid = $this->session->userdata('userId');
		$address_id = $this->session->userdata('addressId');;
		$this->init_user_model();
		$result = $this->user_model->update_user_address($this->input->post(), $userid, $address_id);
		if($result){
			//successfully updated address
			$this->session->set_flashdata('success', "successfully Address Updated");
			redirect('account');
		}else{
			// print_r($result);
			$this->session->set_flashdata('error', "Address Updatation Failed");
			redirect('account');
		}
	}

	public function all_products($category_and_pagination_no = null, $sub_category = null){	// products page view
		$this->init_product_model();
		$this->load->library("pagination");
		$config = array();

		$short_by = null;
		if(isset($_GET['shortby']))
			$short_by = $_GET['shortby'];

		if($category_and_pagination_no == null && $sub_category == null){

			$config["base_url"] = base_url() . "products";
			$config["total_rows"] = $this->Product_model->record_count();
			$config["uri_segment"] = 2;
			$page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;

		}else if(is_numeric($category_and_pagination_no) && $sub_category == null){

			$config["base_url"] = base_url() . "products";
			$config["total_rows"] = $this->Product_model->record_count();
			$config["uri_segment"] = 2;
			$page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;

		}else if($category_and_pagination_no != null && $sub_category == null){

			$category = str_replace('-', ' ', $category_and_pagination_no);
			$config["base_url"] = base_url() . "products/" . $category_and_pagination_no;
			$config["total_rows"] = $this->Product_model->record_count($category);
			$config["uri_segment"] = 3;
			$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

		}else if($category_and_pagination_no != null && is_numeric($sub_category)){
			//this block is for pagination based on category
			$category = str_replace('-', ' ', $category_and_pagination_no);
			$config["base_url"] = base_url() . "products/" . $category_and_pagination_no;
			$config["total_rows"] = $this->Product_model->record_count($category);
			$config["uri_segment"] = 3;
			$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

		}else if($category_and_pagination_no != null && $sub_category != null){

			$category = str_replace('-', ' ', $category_and_pagination_no);
			$sub_category = str_replace('-', ' ', $sub_category);
			$config["base_url"] = base_url() . "products/". $category_and_pagination_no . "/" . $sub_category;
			$config["total_rows"] = $this->Product_model->record_count($category, $sub_category);
			$config["uri_segment"] = 4;
			$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;			
		}


		
		$config["per_page"] = $this->number_of_product_per_page;

		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['attributes'] = ['class' => 'page-link'];
		$config['first_link'] = false;
		$config['last_link'] = false;
		$config['first_tag_open'] = '<li class="page-item">';
		$config['first_tag_close'] = '</li>';
		$config['prev_link'] = '&laquo';
		$config['prev_tag_open'] = '<li class="page-item">';
		$config['prev_tag_close'] = '</li>';
		$config['next_link'] = '&raquo';
		$config['next_tag_open'] = '<li class="page-item">';
		$config['next_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li class="page-item">';
		$config['last_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="page-item active"><a href="#" class="page-link">';
		$config['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>';
		$config['num_tag_open'] = '<li class="page-item">';
		$config['num_tag_close'] = '</li>';

		$this->pagination->initialize($config);
		
		if($category_and_pagination_no == null && $sub_category == null){			
			$data1["results"] = $this->Product_model->fetch_products($config["per_page"], $page, null, null, $short_by);
		}else if(is_numeric($category_and_pagination_no) && $sub_category == null){
			$data1["results"] = $this->Product_model->fetch_products($config["per_page"], $page, null, null, $short_by);
		}else if($category_and_pagination_no != null && $sub_category == null){
			$category = str_replace('-', ' ', $category_and_pagination_no);
			$category_result = $this->Product_model->getIdOfCategory($category);

			if( isset($category_result[0]['id'] ) ) {
				$category_id = $category_result[0]['id'];
				$data1["results"] = $this->Product_model->fetch_products($config["per_page"], $page, $category_id, null, $short_by);
			}
		}else if($category_and_pagination_no != null && is_numeric($sub_category)){
			//Code for - if we have to show product based on category
			$category = str_replace('-', ' ', $category_and_pagination_no);
			$category_result = $this->Product_model->getIdOfCategory($category);

			if( isset($category_result[0]['id'] ) ) {
				$category_id = $category_result[0]['id'];
				$data1["results"] = $this->Product_model->fetch_products($config["per_page"], $page, $category_id, null, $short_by);
			}
		}else if($category_and_pagination_no != null && $sub_category != null){
			//Code for - if we have to show product based on category and sub category
			$category = str_replace('-', ' ', $category_and_pagination_no);
			$category_result = $this->Product_model->getIdOfCategory($category);
			
			if(!empty($category_result)){
				$category_id = $category_result[0]['id'];
				$sub_category_result = $this->Product_model->getIdOfSubCategoryByCategoryId($category_id, $sub_category);
	       		$sub_category_id = $sub_category_result[0]['id'];
	       		$data1["results"] = $this->Product_model->fetch_products($config["per_page"], $page, $category_id, $sub_category_id, $short_by);
			}
		}

		
		$data1["links"] = $this->pagination->create_links();

		$this->init_Site_details_model();
		$data = [
			'title' => 'Products',
			'site_details' => $this->getSiteBasicData(),
			'home_menu_category' => $this->getCategoryWiseSubCategory(),
			'home_menu_pages' => $this->site_details_model->getTopPages()
		];
		$this->load->view('inc/header', $data);
		$this->load->view('inc/header_menu', $data);
		if(!empty($data1['results']))
			$this->load->view("inc/product_filter_section");
		$this->load->view("user/products", $data1);
		$this->load->view('inc/footer', $data);
		$this->load->view('inc/customjs/cart_js');
		$this->load->view('inc/customjs/wishlist_js');
		$this->load->view('inc/customjs/product_filter_js');
	}

	public function product_details($product_id){	//product details page view
		$this->init_Site_details_model();
		$this->init_product_model();

		$result = $this->Product_model->get_single_product($product_id);

		$data = [
			'title' => "Details",
			'site_details' => $this->getSiteBasicData(),
			'home_menu_category' => $this->getCategoryWiseSubCategory(),
			'home_menu_pages' => $this->site_details_model->getTopPages()
		];

		$product_details = [
			'details' => $result
		];
		$this->load->view('inc/header', $data);
		$this->load->view('inc/header_menu', $data);
		$this->load->view('user/product_inner', $product_details);
		$this->load->view('inc/footer');
		$this->load->view('inc/customjs/cart_js');
		$this->load->view('inc/customjs/wishlist_js');
	}

	private function get_product_in_cart(){
		$item = 0;
		$data = $this->cart->contents();

		foreach($data as $value){
			$item++;
		}

		return $item;
	}

	public function all_cart_items(){

        $cart_check = $this->cart->contents();
        // If cart is empty, this will show below message.
        if(empty($cart_check)) {
            echo '<tr><th colspan = "5">Your Cart Is Empty</th></tr>';
        }else{    
        	if ($cart = $this->cart->contents()){             
                $grand_total = 0;
                foreach ($cart as $item){
                    $grand_total += $item['subtotal'];
      				echo '<tr>'.
        					'<td class="pro-title">'.
        					'<a href="'.base_url().'details/'.$item['id'].'">'.$item['name'].'</span>'.
        					'</td>'.
        					'<td class="pro-price"><span class="amount"><span class="money">&#8377; '.number_format($item['price'], 2).'</span></span></td>'.
        					'<td class="pro-quantity">'.
	        					'<div class="quantity buttons_added">'.
		            				'<input type="button" value="-" class="minus" onclick="decrese_single_product_quantity_cart(\''.$item['rowid'].'\', \''. $item['qty'] .'\')">'.
		            				'<input type="number" disabled step="1" min="1" max="" name="quantity" value="'.$item['qty'].'" title="Qty" class="input-text qty text" size="4" pattern="" inputmode="">'.
		            				'<input type="button" value="+" class="plus" onclick="increse_single_product_quantity_cart(\''.$item['rowid'].'\', \''.$item['qty'].'\')">'.
		        				'</div>'.
	        				'</td>'.
	        				'<td class="pro-subtotal"><span class="money">&#8377; '.$item['subtotal'] .'</span></td>'.
    						'<td class="pro-remove"><span onclick="remove_single_product_cart(\''.$item['rowid'].'\')" style="cursor: pointer;"><i class="fas fa-trash"></i></span></td>'.
          				'</tr>';          						
        		}
        		echo '<tr>'.
  					'<td colspan="3" class="text-right">Overall Amount</td>'.
  					'<td>&#8377; '.$grand_total.'</td>'.
  					'<td></td>'.
  				'</tr>'.
  				'<tr>'.
  					'<td></td>'.
  					'<td colspan="2" class="text-right">'.
  						'<button class="btn1 w-100" onclick="clear_cart()">Clear Cart</button>'.
  					'</td>'.
  					'<td colspan="2" class="text-right">'.
  						'<a href="'.base_url().'checkout" class="btn1 w-100" name="checkout">Proceed to Checkout</a>'.
  					'</td>'.
  				'</tr>';
        	}
        }
	}

	public function add_to_cart(){
		$userid = $this->input->post('userid');
		$productid = $this->input->post('productid');
		$name = $this->input->post('name');
		$original_price = $this->input->post('original_price');
		$discounted_price = $this->input->post('discounted_price');
		$qty = $this->input->post('quantity');

		$data = array(
	        'id'      => $productid,
	        'qty'     => $qty,
	        'price'   => $discounted_price,
	        'name'    => $name,
		);

		$this->cart->insert($data);
		$data['msg'] = 1;
		$data['item'] = $this->get_product_in_cart();
		echo json_encode($data);
	}

	public function remove_single_product_from_cart(){
		$row_id = $this->input->post('rowid');
		$data = array(
			'rowid'  => $row_id,
			'qty'  => 0
		);
		$this->cart->update($data);
		$data['msg'] = 1;
		$data['item'] = $this->cart->total_items();
		echo json_encode($data);
	}

	public function increse_single_cart(){
		$row_id = $this->input->post('rowid');
		$previous_quantity = $this->input->post('prev_qty');
		$updated_quantity = $previous_quantity + 1;
		$data = array(
			'rowid'  => $row_id,
			'qty'  => $updated_quantity
		);
		$this->cart->update($data);
		$data['msg'] = 1;
		$data['item'] = $this->get_product_in_cart();
		echo json_encode($data);
	}

	public function decrese_single_cart(){
		$row_id = $this->input->post('rowid');
		$previous_quantity = $this->input->post('prev_qty');
		$updated_quantity = $previous_quantity - 1;
		$data = array(
			'rowid'  => $row_id,
			'qty'  => $updated_quantity
		);
		$this->cart->update($data);
		$data['msg'] = 1;
		$data['item'] = $this->get_product_in_cart();
		echo json_encode($data);
	}

	public function clear_cart(){
		$this->cart->destroy();
		$data['msg'] = 1;
		$data['item'] = $this->get_product_in_cart();
		echo json_encode($data);
	}

	public function wishlist(){ //Wishlist View Page
		$this->init_Site_details_model();
		$data = [
			'title' => 'Wishlist',
			'site_details' => $this->getSiteBasicData(),
			'home_menu_category' => $this->getCategoryWiseSubCategory(),
			'home_menu_pages' => $this->site_details_model->getTopPages()
		];
		

		$this->load->view('inc/header', $data);
		$this->load->view('inc/header_menu', $data);
		$this->load->view('user/wishlist');
		$this->load->view('inc/footer', $data);
		$this->load->view('inc/customjs/cart_js');
		$this->load->view('inc/customjs/wishlist_js');
	}

	public function add_to_wishlist(){
		$userid = $this->input->post('user');
		$productid = $this->input->post('product');

		$this->init_product_model();
		
		if($userid == '0' || $userid == null ){
			$data['code'] = 0;
			$data['msg'] = 'Unauthorised Access';			
			echo json_encode($data);
		}else{
			if($this->Product_model->product_exist_in_wishlist($userid, $productid) > 0){
				//product already exist in wishlist for a perticular user
				$data['code'] = 0;
				$data['msg'] = 'Product already in your wishlist';
				echo json_encode($data);
			}else{
				//product add to wishlist
				$result = $this->Product_model->set_to_wishlist($userid, $productid);
				if($result){
					$data['code'] = 1;
					$data['msg'] = 'Product added to your wishlist';
					echo json_encode($data);
				}else{
					$data['code'] = 0;
					$data['msg'] = 'Something Went Wrong';
					echo json_encode($data);
				}
			}
		}		
	}

	public function get_wishlist(){
		// if(!$this->valid_access()) redirect('login');
		$this->init_product_model();
		$userid = $this->session->userdata('userId');
		$result = $this->Product_model->get_wishlist($userid);
		$count = count($result);
		if($count > 0){
			foreach($result as $key => $value){
				$discounted_price = $value['price'] - (($value['discount_percentage'] / 100) * $value['price']);  //Percentage Calculation
				$quantity = $value['quantity'];

				$quantity_message = "";
				$text_class = "";

				if($quantity > 0){
					$quantity_message = "In Stock";
					$text_class = "text-success";
				}else{
					$quantity_message = "Out Of Stock";
					$text_class = "text-danger";
				}
				// print_r($value);
				echo '<tr>
	                <td class="pro-remove2">
	                    <span style="cursor:pointer" onclick="remove_from_wishlist(\''.$userid.'\',\''.$value['product_id'].'\')"><i class="fas fa-trash"></i></span>
	                </td>

	                <td class="pro-title">
	                    '.$value['title'].'
	                </td>

	                <td class="pro-price">
	                    <span class="amount"><span class="money">&#x20b9; '.$discounted_price.'</span></span>
	                </td>

	                <td class="pro-quantity">
	                    <span class="'.$text_class.'">'.$quantity_message.'</span>
	                </td>

	                <td class="pro-subtotal"><button onclick="add_to_cart(\''.$userid.'\',\''.$value['product_id'].'\', \''.$value['title'].'\',\''.$value['price'].'\',\''.$discounted_price.'\', 1)" class="btn1">Add To Cart</button></td>
	            </tr> ';
			}
		}else{
			echo '<tr>
				<th colspan="5">No Products Are Available In Your Wishlist</th>
			</tr>';
		}
	}

	public function remove_single_product_from_wishlist(){
		$userid = $this->input->post('user');
		$productid = $this->input->post('product');

		$this->init_product_model();
		$result = $this->Product_model->delete_single_from_wishlist($userid, $productid);
		if($result){
			$data['code'] = 1;
			$data['msg'] = 'Product Successfully Removed From Your Wishlist';
			echo json_encode($data);
		}else{
			$data['code'] = 0;
			$data['msg'] = 'Something Went Wrong';
			echo json_encode($data);
		}
	}

	public function checkout(){	//checkout view page
		if(!$this->valid_access()) redirect('login');

		$this->init_Site_details_model();
		$this->init_user_model();
		$data = [
			'title' => 'Checkout',
			'site_details' => $this->getSiteBasicData(),
			'home_menu_category' => $this->getCategoryWiseSubCategory(),
			'home_menu_pages' => $this->site_details_model->getTopPages()
		];

		if($this->session->userdata('addressId') != "0"){
			$address = $this->user_model->getUserAddress($this->session->userdata('userId'));
		}

		$result = $this->user_model->getUserEmailAndPhone($this->session->userdata('userId'));
		
		$data_user = [
			'email' => $result[0]['email'],
			'phone' => $result[0]['phone'],
			'address' => $address
		];
		

		$this->load->view('inc/header', $data);
		$this->load->view('inc/header_menu', $data);
		$this->load->view('user/checkout', $data_user);
		$this->load->view('inc/footer', $data);
		$this->load->view('inc/customjs/checkout_js');
		// $this->load->view('inc/customjs/wishlist_js');
	}

	public function place_order(){
		// if(!$this->valid_access()) redirect('login');
		// At the time of place_order save cart data to databse
		// table 1 -> orders
		// table 2 -> order_items
		// then checkout page loades
		$userid = ($this->session->has_userdata('userId'))?$this->session->userdata('userId'):null;
		$data_order = [
			'msg' 	=> 'error',
			'data' 	=> []
		];
		if($userid != null or $userid != ""){
			$this->init_product_model(); //initialise product Model
			
			$order_id_after_insert_order_table = $this->Product_model->setOrders($userid);

			if($order_id_after_insert_order_table != '0'){
				// Insert cart items in order_items table
				$data_for_place_order = $this->Product_model->setOrderItems($order_id_after_insert_order_table);
				if(!empty($data_for_place_order)){					
					$data_order = [
						'msg' 	=> 'success',
						'data' 	=> $data_for_place_order
					];
				}else{
					$data_order = [
						'msg' 	=> 'error',
						'data' 	=> $data_for_place_order
					];
				}
			}
			echo json_encode($data_order);
		}else{
			echo json_encode($data_order);
		}
	}

	public function add_quick_request(){
		$this->init_quick_request_model();

		$first_name = $this->input->post('fname');
		$last_name = $this->input->post('lname');
		$phone = $this->input->post('phone');
		$email = $this->input->post('email');
		$address = $this->input->post('address');
		$gross_weight = $this->input->post('gross_weight');
		$quality = $this->input->post('quality');
		$messages = $this->input->post('message');

		$quick_request_uid = $this->Quick_request->uploadItems($first_name, $last_name, $phone, $email, $address, $gross_weight, $quality, $messages);

		if($quick_request_uid != '0'){
			//here we write code for image upload
			$path = $this->site_image_path;
            if (!file_exists($path . $quick_request_uid)) {
                mkdir($path . $quick_request_uid, 0777, true);
            }
            $path = $path . $quick_request_uid."/";

            $image = array();
            $ImageCount = count($_FILES['quick_request_images']['name']);

            for($i = 0; $i < $ImageCount; $i++){
                $_FILES['file']['name']       = $_FILES['quick_request_images']['name'][$i];
                $_FILES['file']['type']       = $_FILES['quick_request_images']['type'][$i];
                $_FILES['file']['tmp_name']   = $_FILES['quick_request_images']['tmp_name'][$i];
                $_FILES['file']['error']      = $_FILES['quick_request_images']['error'][$i];
                $_FILES['file']['size']       = $_FILES['quick_request_images']['size'][$i];

                $config['upload_path'] = $path;
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['encrypt_name'] = TRUE;

                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if($this->upload->do_upload('file')){
                    // Uploaded file data
                    $imageData = $this->upload->data();
                    $uploadImgData[$i]['quick_request_images'] = $imageData['file_name'];
                }
            }
            if(!empty($uploadImgData)){
                // Insert files data into the database
                $res = $this->Quick_request->uploadQuickRequestImages($uploadImgData, $quick_request_uid, $path);
                if($res){
                    $success['msg'] = 1;
                    echo json_encode($success);
                }              
            }
		}
	}

	public function getUserOrders(){
		$userid = $this->session->userdata('userId');
		$this->init_product_model();

		$year = $this->input->post('year');
		if($year != "")
			$orders = $this->Product_model->getAllUserOrders($userid, $year);
		else
			$orders = $this->Product_model->getAllUserOrders($userid);

		if(empty($orders)){
			echo '<div class="bg-secondary text-white odersecbox p-3">
                    <div class="oderboxlft">
                        <div><span>No Order Available</span></div>
                    </div>
                </div>';
		}else{
			$fname = $this->session->userdata('fname');
			$lname = $this->session->userdata('lname');
			$full_name = $fname . " " . $lname;
			echo '<div style="text-align:end;font-weight:bold">Total Number of Orders '.count($orders).'</div>';
		// This line will be inside oderboxrht this class after orderid
		// <div><a href="#"> View order details</a>  &nbsp; | &nbsp;  <a href="#">Invoice </a></div>
			foreach ($orders as $key => $value) {
				echo '<div class="bg-secondary text-white odersecbox p-3">
	                    <div class="oderboxlft">
	                        <div>ORDER PLACED <span>'.$value['time'].'</span></div>
	                        <div class="ml-lg-5">TOTAL <span> ₹ '.$value['grand_total'].'</span></div>
	                        <div class="ml-lg-5"> SHIP TO  <span>'.ucwords($full_name).' </span></div>
	                    </div>
	                    <div class="oderboxrht">
	                        <div>'.$value['orderId'].'</div>
	                    </div>
	                </div>
	                <div class="p-3 pt-0">
	                    <div class="row">
	                ';

	                foreach($value['items'] as $item_key => $item_value){
		                echo '<div class="col-md-6 mt-3">
	                            <div class="order_products">
	                                <div><img src="'.base_url() . $item_value['image_path'].'" alt="Product Images"></div>
	                                <div class="ml-2 mt-2 mt-lg-0">
	                                    <span>'.$item_value['title'].'</span>
	                                    <div class="d-flex align-items-center mt-2 order_productsdtls">
	                                        <div>Price: ₹ '.$item_value['single_price'].'</div>
	                                        <div class="ml-3">Quantity: '.$item_value['quantity'].'</div>
	                                    </div>
	                                </div>
	                            </div>
	                        </div>';
		            }

		            echo '</div>                   
		                </div>';
	        }
	    }
	}

	public function add_retailer_registration_request(){
		$first_name = $this->input->post('fname');
		$last_name = $this->input->post('lname');
		$phone = $this->input->post('phone');
		$store_name = $this->input->post('store_name');
		$gst_no = $this->input->post('gst_no');
		$email = $this->input->post('email');
		$password = $this->input->post('password');

		$this->init_retailer_model();

		$response = [
			'status' => false,
			'message' => ""
		];

		if($this->Retailer->retailerExistByStoreName($store_name)){
			$response = [
				'status' => false,
				'message' => "Store name already exist"
			];
		}else{
			if($this->Retailer->retailerExistByEmail($email)){
				$response = [
					'status' => false,
					'message' => "Email already exist"
				];
			}else{
				if($this->Retailer->retailerExistByGSTNo($gst_no)){
					$response = [
						'status' => false,
						'message' => "GST No already exist"
					];
				}else{
					if($this->Retailer->retailerExistByPhoneNo($phone)){
						$response = [
							'status' => false,
							'message' => "Phone number already exist"
						];
					}else{
						$add_retailer = $this->Retailer->set_retailer_data($first_name, $last_name, $phone, $store_name, $gst_no, $email, $password);
						if($add_retailer){
							$response = [
								'status' => true,
								'message' => "Your request successfully send..."
							];			            
						}
					}
				}
			}
		}
		echo json_encode($response);
	}

	public function loginRetailer(){
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$this->init_retailer_model();

		$response = [
			'status' => false,
			'message' => ""
		];

		if(!$this->Retailer->retailerExistByEmail($email)){
			$response = [
				'status' => false,
				'message' => "Email not exist"
			];
		}else{
			$retailerData = $this->Retailer->check_retailer_for_login($email, $password);
			if(!empty($retailerData)){
				$response = [
					'status' => true,
					'message' => "Successfully logged in"
				];
				$sessionArray = array(
                    'userId'=> $retailerData[0]['uid'],                    
                    'fname' => $retailerData[0]['first_name'],
                    'lname' => $retailerData[0]['last_name'],
                    'addressId' => $retailerData[0]['address_id'],
                    'type' => 'retailer',
                    'retailer_discount_percentage' => $this->Retailer->getRetailerDiscountPercentage()
                );	
                $this->session->set_userdata($sessionArray);
			}else{
				$response = [
					'status' => false,
					'message' => "Wait for approval or Password is wrong..."
				];
			}
		}
		echo json_encode($response);
	}

	public function fetch_featured_products(){
		$this->init_product_model();
		$featured_products = $this->Product_model->get_featured_products();		
		return $featured_products;
	}

}
