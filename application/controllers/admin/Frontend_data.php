<?php
defined("BASEPATH") or exit("No direct script access allowed");

	class Frontend_data extends CI_Controller{

		private $site_image_path = 'assets/images/';

		function __construct() {
	        parent::__construct();        
	    }

	    private function do_upload($path,$send_img){
	        $config['upload_path']   = './'.$path;
	        $config['allowed_types'] = 'jpg|jpeg|png'; 
	        $config['encrypt_name'] = TRUE;

	        $this->load->library('upload', $config);
	        $this->upload->initialize($config);

	        return (!$this->upload->do_upload($send_img)) ? false : true;
	    }

	    private function init_frontend_model(){
	        $this->load->model("admin/Frontend_model");
	    }

	    private function init_product_model(){
	        $this->load->model("admin/Product_model");
	    }

	    private function valid_access(){//Check admin is logged in or not
	        if( !$this->session->has_userdata('admin_id') )
	            return false;
	        return true;
	    }

	    private function getCategory(){
	        $this->init_product_model();   
	        $results = $this->Product_model->getAllCategory();
	        return $results;
	    }

	    public function view_Frontend_data(){
	    	if(!$this->valid_access()) redirect('admin/login');
	    	
	    	$this->init_frontend_model();

	    	$data = [
	            "title" => title_admin_frontend_data_page,
	        ];

	        $data_details = [
	        	"data" => $this->Frontend_model->getSiteDetails(),
	        ];
	        $this->load->view("admin/inc/header", $data);
	        $this->load->view("admin/inc/sidebar");
	        $this->load->view("admin/frontend_data", $data_details);
	        $this->load->view("admin/inc/footer");
	        $this->load->view("admin/inc/logout");
	    }

	    public function view_banner(){
	    	if(!$this->valid_access()) redirect('admin/login');
	    	$this->init_frontend_model();
	    	$data = [
	            "title" => title_admin_frontend_banner_page,
	        ];
	        $data_banner = [
	        	"banners" => $this->Frontend_model->getBanners()
	        ];
	        $this->load->view("admin/inc/header", $data);
	        $this->load->view("admin/inc/sidebar");
	        $this->load->view("admin/frontend_banner_data", $data_banner);
	        $this->load->view("admin/inc/footer");
	        $this->load->view("admin/inc/customjs/model_js");
	        $this->load->view("admin/inc/logout");
	    }

	    public function top_menu(){
	    	if(!$this->valid_access()) redirect('admin/login');
	    	$this->init_frontend_model();
	    	$data = [
	            "title" => title_admin_frontend_menu_page,
	            "pages" => $this->Frontend_model->getPages(),
	            "category" => $this->getCategory()
	        ];
	        $this->load->view("admin/inc/header", $data);
	        $this->load->view("admin/inc/sidebar");
	        $this->load->view("admin/frontend_top_menu", $data);
	        $this->load->view("admin/inc/footer");
	        $this->load->view("admin/inc/customjs/top_menu_js");
	        $this->load->view("admin/inc/logout");
	    }

	    public function updateFrontEndData(){//update site settings
	    	$this->init_frontend_model();
	    	$img = "";
	    	if($_FILES['file-input']['name'] != ""){

	    		$path = $this->site_image_path;

	    		if($this->do_upload($path, 'file-input')){
                    $img = $path . $this->upload->data('file_name');
                }
                $result = $this->Frontend_model->uploadSiteDetails($this->input->post(), $img);
	    	}else{
	    		$result = $this->Frontend_model->uploadSiteDetails($this->input->post(), $img);
	    	}
	    	if($result){
	    		//code for logo upload
	    		$this->session->set_flashdata('success', 'Updataion Successful');	    		
	    	}else{	    		
	    		$this->session->set_flashdata('error', 'Updataion Failed');
	    	}
	    	redirect('admin/site_data');
	    }

	    public function Banner(){
	    	$purpose = $this->input->post('purpose');
	    	$this->init_frontend_model();
	    	if($purpose == 'add'){
	    		$heading = $this->input->post('heading');
	    		$paragraph = $this->input->post('paragraph');

	    		// print_r($heading . " " .$paragraph);
	    		// print_r($_FILES);

	    		if($_FILES['model_image']['name'] != ""){

		    		$path = $this->site_image_path;

		    		if($this->do_upload($path, 'model_image')){
	                    $img = $path . $this->upload->data('file_name');
	                }
	                $result = $this->Frontend_model->uploadBanner($heading, $paragraph, $img);
	                if($result){
	                	$this->session->set_flashdata('success', 'Insertion Successful');
	                }else{
	                	$this->session->set_flashdata('error', 'Insertion Failed');
	                }
		    	}else{
		    		$this->session->set_flashdata('error', 'Insertion Failed');
		    	}
		    	redirect('admin/banner');
	    	}elseif($purpose == 'delete'){
	    		$id = $this->input->post('model');
	    		if($this->Frontend_model->deleteModel($id)){
	    			echo 1;
				}else{
					echo 0;
				}
	    	}
	    }

	    public function changeStatePage(){
	    	$pageid = $this->input->post('page');
	    	$value = $this->input->post('value');
	    	$this->init_frontend_model();
	    	if($this->Frontend_model->updateFrontendTopMenuStatePage($pageid, $value))
	    		echo 1;
	    	else
	    		echo $value;
	    }

	    public function changeStateCategory(){
	    	$categoryid = $this->input->post('category');
	    	$value = $this->input->post('value');
	    	$this->init_frontend_model();
	    	if($this->Frontend_model->updateFrontendTopMenuStateCategory($categoryid, $value))
	    		echo 1;
	    	else
	    		echo 0;
	    }

	}

?>