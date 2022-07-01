<?php
defined("BASEPATH") or exit("No direct script access allowed");

class Admin extends CI_Controller{
    
    private $site_image_path = 'assets/images/products/';

    private $filter_menu = [
        "style",
        "gender",
        "no of stone",
        "occasion",
        "delivery time",
        "design",
        "collections",
        "stone shape",
        "stone color",
        "type",
        "metal",
        "purity",
    ];

	function __construct() {
        parent::__construct();  
        date_default_timezone_set("Asia/Calcutta");      
    }

    private function new_uid(){
        return (bin2hex(openssl_random_pseudo_bytes(16)) . time());
    }

    private function httpGet($url,$apiKey){ 
        $ch = curl_init();   
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
       //curl_setopt($ch,CURLOPT_HEADER, false); 
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'X-API-KEY: ' . $apiKey
        )); 
        $output=curl_exec($ch); 
        curl_close($ch);
        return $output;
    }

    public function index(){
        $this->isLoggedIn();
    }

    private function valid_access(){//Check admin is logged in or not
        if( !$this->session->has_userdata('admin_id') )
            return false;
        return true;
    } 

    private function init_product_model(){
        $this->load->model("admin/Product_model");
    }

    private function init_login_model(){
        $this->load->model("admin/Login_model");
    } 

    private function init_quick_request_model(){
        $this->load->model("admin/Quick_request");
    } 

    private function init_mail_management_model(){
        $this->load->model("admin/Mail_management");
    }

    private function init_retailer_model(){
        $this->load->model("admin/Retailer");
    }

    private function do_upload($path,$send_img){
        $config['upload_path']   = './'.$path;
        $config['allowed_types'] = 'jpg|jpeg|png'; 
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        return (!$this->upload->do_upload($send_img)) ? false : true;
    } 

    private function filter_menu(){ //Filter menu generate on product upload page
        $filter_menu = $this->filter_menu;

        $i = 0;
        $filter_menu_1 = [];
        foreach ($filter_menu as $filter_option) {
            $filter_option = "product_" . str_replace(" ", "_", $filter_option);
            $filter_menu_1[$i++] = $filter_option;
        }
        $i = 0;
        $new_arr = [];
        foreach ($filter_menu_1 as $filter_option) {  
            $this->init_product_model();          
            $results = $this->Product_model->getDataFromTable($filter_option);
            $j = 0;
            foreach ($results as $result) {
                $new_arr[$filter_menu[$i]][$j++] = [
                    "id" => $result->id,
                    "name" => $result->name,
                ];
            }
            $i++;
        }
        return $new_arr;
    }

    private function getCategory(){
        $this->init_product_model();   
        $results = $this->Product_model->getAllCategory();
        return $results;
    } 

    public function getSubCategory(){
        $categoryId = $this->input->post('categoryId');
        if($categoryId != 0){
            $this->init_product_model();   
            $results = $this->Product_model->getAllSubCategory($categoryId);
            
            if($results->num_rows() > 0){
                echo "<option value='0'>Choose Sub-Category</option>";
                foreach($results->result() as $val)
                    echo "<option value=".$val->id.">" . ucwords($val->name) ."</option>";
            }else{
                echo "<option value='0'>No Data Found</option>";
            }
        }        
    }   

    public function products(){ //Product page view

        if(!$this->valid_access()) redirect('admin/login');

        $data = [
            "title" => "Admin | Products",
        ];

        $filter_data = [
            "filter_data" => $this->filter_menu(),
            "category" => $this->getCategory()
        ];

        $this->load->view("admin/inc/header", $data);
        // $this->load->view('admin/inc/image_upload_header');
        $this->load->view("admin/inc/sidebar");
        $this->load->view("admin/product_add", $filter_data);
        $this->load->view("admin/inc/footer");
        $this->load->view("admin/inc/logout");
        $this->load->view('admin/inc/image_upload_footer');
        $this->load->view("admin/inc/product_upload_ajax");
    }

    public function dashboard(){ //Dashboard page view
        if(!$this->valid_access()) redirect('admin/login');
        $data = [
            "title" => "Admin | Dashboard",
        ];
        $this->load->view("admin/inc/header", $data);
        $this->load->view("admin/inc/sidebar");
        $this->load->view("admin/dashboard");
        $this->load->view("admin/inc/footer");
        $this->load->view("admin/inc/logout");
    }

    public function products_listing(){ //Product Listing page view
        if(!$this->valid_access()) redirect('admin/login');

        $this->init_product_model();
        // $product_data = [
        //     'data' => $this->Product_model->getAllProduct(),
        //     "category" => $this->getCategory()
        // ];

        $data = [
            "title" => title_admin_products_page,
        ];


        $this->load->view("admin/inc/header", $data);
        $this->load->view("admin/inc/sidebar");
        $this->load->view("admin/products");
        $this->load->view("admin/inc/footer");
        $this->load->view("admin/inc/footer_datatable");
        $this->load->view("admin/inc/customjs/product_listing_js");
        $this->load->view("admin/inc/logout");
    }

    public function fetchProductDatafromDatabase(){
        $this->init_product_model();
        $resultList = $this->Product_model->fetchAllData();
        
        $result = array();
        $button = '';
        $i = 1;
        // print_r($resultList);
        foreach ($resultList as $key => $value) {
            $value = (array) $value;
            $button = '<a class="btn-sm btn-success text-light" onclick="addQuantity('.$value['uid'].')" data-toggle="tooltip" data-placement="top" title="Add Quantity"><i class="fas fa-plus-circle"></i></a> ';

            $button .= '<a class="btn-sm btn-danger text-light" onclick="addQuantity('.$value['uid'].')" data-toggle="tooltip" data-placement="top" title="Disable Product"><i class="fas fa-ban"></i></a> ';
            // $button .= ' <a class="btn-sm btn-danger text-light" onclick="deleteFun('.$value['uid'].')" href="#"> Delete</a>';

            $result['data'][] = array(
                $value['title'],
                $value['code'],
                $value['sku'],
                $value['category_name'],
                $value['sub_category_name'],
                $value['price'],
                $value['discount_percentage'],
                $value['quantity'],
                $button
            );
        }
        echo json_encode($result);
    }

    public function add_product(){
        $this->load->library("form_validation");

        $this->form_validation->set_rules("title", "Title", "trim|required|min_length[3]");
        $this->form_validation->set_rules("code", "Code", "trim|required");
        $this->form_validation->set_rules("category", "Category", "required");
        $this->form_validation->set_rules("sub_category","Sub Category","required");
        $this->form_validation->set_rules("quantity","Quantity","trim|required|numeric");
        $this->form_validation->set_rules("price","Price","trim|required|numeric");
        $this->form_validation->set_rules("sku", "SKU", "trim|required");

        if ($this->form_validation->run() == false) {
            print_r($this->form_validation->error_array());
        }

        $this->init_product_model();
        $product_id = $this->new_uid();
        $result = $this->Product_model->uploadProducts($this->input->post(), $product_id);

        if($result){
            //successfully added product

            //here we write code for image upload
            $path = $this->site_image_path;
            if (!file_exists($path . $product_id)) {
                mkdir($path . $product_id, 0777, true);
            }
            $path = $path . $product_id."/";

            $image = array();
            $ImageCount = count($_FILES['images']['name']);

            for($i = 0; $i < $ImageCount; $i++){
                $_FILES['file']['name']       = $_FILES['images']['name'][$i];
                $_FILES['file']['type']       = $_FILES['images']['type'][$i];
                $_FILES['file']['tmp_name']   = $_FILES['images']['tmp_name'][$i];
                $_FILES['file']['error']      = $_FILES['images']['error'][$i];
                $_FILES['file']['size']       = $_FILES['images']['size'][$i];

                $config['upload_path'] = $path;
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['encrypt_name'] = TRUE;

                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if($this->upload->do_upload('file')){
                    // Uploaded file data
                    $imageData = $this->upload->data();
                    $uploadImgData[$i]['images'] = $imageData['file_name'];
                }
            }
            if(!empty($uploadImgData)){
                // Insert files data into the database
                $res = $this->Product_model->uploadProductImages($uploadImgData, $product_id, $path);
                if($res){
                    // $this->session->set_flashdata('success', 'Product Uploaded Successfully');
                    // redirect('admin/products');
                    $success['msg'] = 1;
                    echo json_encode($success);
                }              
            }

        }else{
            //code for if product upload failed
        }
    }

    public function isLoggedIn(){ //Login page view
        $isLoggedIn = $this->session->userdata('isLoggedInAsAdmin');
        
        if(!isset($isLoggedIn) || $isLoggedIn != TRUE){
            $data = [
                "title" => "Admin | Login",
            ];
            $this->load->view("admin/inc/header", $data);            
            $this->load->view('admin/login');
            $this->load->view("admin/inc/footer");
        }else{
            redirect('admin/dashboard');
        }
    }

    public function login(){ //Login

        if($this->valid_access()) redirect('admin/dashboard');

        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|max_length[128]|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[2]|max_length[32]');
        
        if($this->form_validation->run() == FALSE){
            $this->index();
        }else{
            $email = strtolower($this->security->xss_clean($this->input->post('email')));
            $password = $this->input->post('password');
            
            $this->init_login_model();
            $result = $this->Login_model->loginMe($email, $password);
            
            if(!empty($result)){
                $lastLogin = $this->Login_model->lastLoginInfo($result->uid);

                $sessionArray = array(
                    'admin_id'=>$result->uid,                    
                    'role'=>$result->roleId,
                    'roleText'=>$result->role,
                    'name'=>$result->name,                    
                    'lastLogin'=> $lastLogin->createdDtm,
                    'isLoggedInAsAdmin' => TRUE
                );

                $this->session->set_userdata($sessionArray);

                unset($sessionArray['admin_id'], $sessionArray['isLoggedIn'], $sessionArray['lastLogin']);

                $loginInfo = array(
                    "admin_id"=>$result->uid, 
                    "session_data" => json_encode($sessionArray), 
                    "machine_ip"=>$_SERVER['REMOTE_ADDR']                    
                );

                $this->Login_model->lastLogin($loginInfo);
                
                redirect('admin/dashboard');
            }
            else{
                $this->session->set_flashdata('error', 'Email or Password Mismatch');                
                $this->index();
            }
        }
    }

    public function logout(){ //Logout
        $this->session->unset_userdata('admin_id');
        $this->session->unset_userdata('role');
        $this->session->unset_userdata('roleText');
        $this->session->unset_userdata('name');
        $this->session->unset_userdata('lastLogin');
        $this->session->unset_userdata('isLoggedInAsAdmin');
        $this->session->set_flashdata('success', 'You Are Successfully Logged Out'); 
        redirect('admin/admin');
    }

    public function filter_options(){ //Filter Option Page view
        if(!$this->valid_access()) redirect('admin/login');
        $data = [
            "title" => "Admin | Fiilter Options",
        ];

        $filter_data = [
            "filter_data" => $this->filter_menu
        ];

        $this->load->view("admin/inc/header", $data);
        $this->load->view("admin/inc/sidebar");
        $this->load->view("admin/filter_options", $filter_data);
        $this->load->view("admin/inc/footer");        
        $this->load->view("admin/inc/customjs/filter_options_js");
        $this->load->view("admin/inc/logout");
    }

    public function getFilterMenuOptions(){
        $data = $this->input->post('filter_menu_name');
        
        $filter_option = "product_" . str_replace(" ", "_", $data);

        $this->init_product_model();          
        $results = $this->Product_model->getDataFromTable($filter_option);
        
        foreach($results as $key => $val){
            echo "<tr>
                    <td>".ucwords($val->name)."</td>
                    <td>
                        <button class='btn btn-primary btn-circle btn-sm' onclick='do_edit($val->id,\"$val->name\")'><i class='fas fa-marker' data-toggle='tooltip' title='Update'></i></button>
                        <button class='btn btn-danger btn-circle btn-sm' onclick='do_delete($val->id)' data-toggle='tooltip' title='Delete'><i class='fas fa-trash'></i></button>
                    </td>
                </tr>";
        }
    }

    public function setFilterMenuOptions(){
        $filter_option = $this->input->post('filter_name');
        $filter_table = "product_" . str_replace(" ", "_", $filter_option);

        $item_value = $this->input->post('item_value');

        $this->init_product_model();          
        $results = $this->Product_model->setDataToFilerTable($item_value, $filter_table);

        echo ($results)?1:0;
    }

    public function deleteFilterMenuOptions(){
        $filter_option = $this->input->post('filter_option');
        $filter_table = "product_" . str_replace(" ", "_", $filter_option);

        $item_id = $this->input->post('item');

        $this->init_product_model();          
        $results = $this->Product_model->deleteDataToFilerTable($item_id, $filter_table);

        echo ($results)?1:0;
    }

    public function updateFilterMenuOptions(){
        $filter_option = $this->input->post('filter_name');
        $filter_table = "product_" . str_replace(" ", "_", $filter_option);

        $option_id = $this->input->post('item');
        $option_value = $this->input->post('item_value');

        $this->init_product_model();
        $results = $this->Product_model->updateDataToFilerTable($option_id, $option_value, $filter_table);

        echo ($results)?1:0;
    }

    public function quick_request(){ //Quick Request Page View
        if(!$this->valid_access()) redirect('admin/login');
        $data = [
            "title" => "Admin | Quick Request",
        ];

        $this->init_quick_request_model();

        $data_quick_request = [
            'quick_request' => $this->Quick_request->get_quick_request_data()
        ];

        $this->load->view("admin/inc/header", $data);
        $this->load->view("admin/inc/sidebar");
        $this->load->view("admin/quick_request", $data_quick_request);
        $this->load->view("admin/inc/footer");
        $this->load->view("admin/inc/footer_datatable");
        $this->load->view("admin/inc/customjs/quick_request_images_model_js");
        $this->load->view("admin/inc/logout");
    }

    public function fetch_quick_request_images(){
        $this->init_quick_request_model();
        $quick_request_id = $this->input->post('quick_request');
        $quick_request_data = $this->Quick_request->get_quick_request_images($quick_request_id);
        echo json_encode($quick_request_data);
    }

    public function orders(){ //all orders page view
        if(!$this->valid_access()) redirect('admin/login');
        $data = [
            "title" => "Admin | Orders",
        ];

        $this->init_product_model();

        $data_orders = [
            'orders' => $this->Product_model->getOrders()
        ];

        $this->load->view("admin/inc/header", $data);
        $this->load->view("admin/inc/sidebar");
        $this->load->view("admin/orders", $data_orders);
        $this->load->view("admin/inc/footer");
        $this->load->view("admin/inc/footer_datatable");
        $this->load->view("admin/inc/customjs/order_js");
        $this->load->view("admin/inc/logout");
    }

    public function customers(){ //all customers page view
        if(!$this->valid_access()) redirect('admin/login');
        $data = [
            "title" => "Admin | Customers",
        ];

        $this->init_product_model();
        $data_users = [
            'users' => $this->Product_model->getUsers()
        ];

        $this->load->view("admin/inc/header", $data);
        $this->load->view("admin/inc/sidebar");
        $this->load->view("admin/users", $data_users);
        $this->load->view("admin/inc/footer");
        $this->load->view("admin/inc/footer_datatable");
        $this->load->view("admin/inc/logout");
    }

    public function email_management(){ //mail management page view
        if(!$this->valid_access()) redirect('admin/login');
        $data = [
            "title" => "Admin | Mail Management",
        ];

        $this->init_mail_management_model();
        $data_mail = [
            'mail_management' => $this->Mail_management->getMailSettings()
        ];

        $this->load->view("admin/inc/header", $data);
        $this->load->view("admin/inc/sidebar");
        $this->load->view("admin/mail_management", $data_mail);
        $this->load->view("admin/inc/footer");
        $this->load->view("admin/inc/customjs/mail_management_js");
        $this->load->view("admin/inc/logout");
    }

    public function getMailContent(){
        $mail_service_id = $this->input->post('mail_management_id');
        $mail_for = $this->input->post('mail_for');

        // echo $mail_service_id . " " . $mail_for;
        $this->init_mail_management_model();
        $content = $this->Mail_management->getMailContent($mail_service_id, $mail_for);
        $content = $content[0];

        $new_arr = [];
        $i = 1;
        foreach($content as $key => $val){
            if($i == 1)$new_arr['subject'] = $val;
            if($i == 2)$new_arr['message'] = $val;
            $i++;
        }
        
        echo json_encode($new_arr);

    }

    private function fetch_gold_price_from_api(){
        $currency_code = strtolower(gold_api_currency_code);
        $unit_type = strtolower(gold_api_unit_type);

        $URL = "http://goldpricez.com/api/rates/currency/".$currency_code."/measure/".$unit_type; 
        $apiKey = goldpricez_API_KEY;

        $URL=strtolower($URL);

        // Call API via CURL
        $result=$this->httpGet($URL,$apiKey);

        $array1 = json_decode($result, true);
        $result = json_decode($array1, true);

        $current_gold_price = $result[$unit_type.'_in_'.$currency_code]; 

        $gmt_datetime_gold_updated = $result['gmt_ounce_price_usd_updated'];                        
                        
        $currency_rate = 1;
        $gmt_datetime_currency_updated = $gmt_datetime_gold_updated;
        if($currency_code !='usd'){
            $currency_rate =$result['usd_to_'.$currency_code]; 
            
            $gmt_datetime_currency_updated=$result['gmt_'.$currency_code.'_updated']; 
        }
        
        $gold_price_per_gram = number_format((float)$result['gram_in_inr'], 2, '.', '');
        return $gold_price_per_gram;
    }

    public function update_product_price(){
        $gold_price_per_gram = $this->fetch_gold_price_from_api();
        $this->init_product_model();
        $this->Product_model->setGoldPriceFromApiData($gold_price_per_gram);
    }

    public function retailer(){ //Retailer page view
        if(!$this->valid_access()) redirect('admin/login');
        $data = [
            "title" => "Admin | Retailer",
        ];

        $this->init_retailer_model();

        $data_retailers = [
            'retailers' => $this->Retailer->get_retailers_data()
        ];

        $this->load->view("admin/inc/header", $data);
        $this->load->view("admin/inc/sidebar");
        $this->load->view("admin/retailers", $data_retailers);
        $this->load->view("admin/inc/footer");
        $this->load->view("admin/inc/footer_datatable");
        $this->load->view("admin/inc/customjs/retailers_js");
        $this->load->view("admin/inc/logout");
    }

    public function update_retailer_status(){
        $retailer_id = $this->input->post('retailer_id');
        $status = $this->input->post('status');
        $this->init_retailer_model();
        $update_status = $this->Retailer->update_retailer_status($retailer_id, $status);        
    }

    public function CSV(){ //Retailer page view
        if(!$this->valid_access()) redirect('admin/login');
        $data = [
            "title" => "Admin | CSV Upload",
        ];

        // $this->init_retailer_model();

        $data_retailers = [
            // 'retailers' => $this->Retailer->get_retailers_data()
        ];

        $this->load->view("admin/inc/header", $data);
        $this->load->view("admin/inc/sidebar");
        $this->load->view("admin/csv_upload");
        $this->load->view("admin/inc/footer");
        $this->load->view("admin/inc/footer_datatable");
        $this->load->view("admin/inc/customjs/csv_js");
        $this->load->view("admin/inc/logout");
    }

    public function import(){
        $message = "";

        $error = 0;

        $this->init_product_model();
        $this->load->library('csvimport');
        $file_data = $this->csvimport->get_array($_FILES["csv_file"]["tmp_name"]);

        // $i = 0;
        // foreach($file_data as $row){
        //     if(array_key_exists("", $row)){
        //         unset($row[""]);
        //     }
        //     $file_data[$i] = $row;
        //     $i++;
        // }
        // echo "<pre>";
        // print_r($file_data);
        // echo "</pre>";
        // exit;

        $filter_menu = $this->filter_menu;
        $filter_menu_1 = [];
        $i = 0;
        foreach ($filter_menu as $filter_option) {
            $filter_option = str_replace(" ", "_", $filter_option);
            $filter_menu_1[$i++] = $filter_option;
        }


        $i = 0;
        foreach($file_data as $row){
            if(array_key_exists("", $row)){
                unset($row[""]);
            }

            $exist_product_code = $this->Product_model->check_product_using_product_code($row['code']);

            if($exist_product_code){
                $error = 1;
                $message = "<span style='color:red'>Product <b>".$row['title']. " </b> already exist...</span>";
                break;
            }else{

                $category = $row['category'];
                $sub_category = $row['sub_category'];

                $row['category_id'] = $this->Product_model->getCategoryId($row['category']);
                $row['sub_category_id'] = $this->Product_model->getSubCategoryId($row['sub_category']);

                unset($row['category']);
                unset($row['sub_category']);
                $row['uid'] = $this->new_uid();
                $row['created_at'] = date("Y-m-d H:m:s");

                foreach($row as $key => $val){
                    if(in_array($key, $filter_menu_1)){                    
                        if(!empty($val)){               
                            $values = explode(",",$val);
                            $new_values = "";
                            foreach($values as $value_key => $value_val){
                                
                                $filter_id = $this->Product_model->getFilterOptionId($value_val, "product_".$key); 

                                if($filter_id != 0){
                                    $new_values .= $filter_id.",";                                
                                }else{                                
                                    $error = 1;
                                    $message = "<span style='color:red'><b>".$value_val . "</b> is not present in <b>". $key . "</b> in product <b>".$row['title']."</b> ,Please try again...</span>";
                                }
                                $row[$key] = $new_values; 
                            }
                        }
                    }
                }
                $file_data[$i] = $row;
                $i++;
            }
        }

        // $error = 1;
        if($error != 1){
            if($this->Product_model->insert_csv_products($file_data))
                echo "<span style='color:green'>Successfully All Product Added...</span>";
            else
                echo "<span style='color:red'>Failed</span>";
        }else{
            echo $message;
        }
    }
}
