<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	class Razorpay extends CI_Controller {

		public function __construct(){
			parent::__construct();
			$this->load->library('cart');
		}

		private function init_product_model(){
			$this->load->model("Product_model");
		}

		// initialized cURL Request
	    private function curl_handler($payment_id, $amount)  {
	        $url            = 'https://api.razorpay.com/v1/payments/'.$payment_id.'/capture';
	        $key_id         = RAZORPAY_API_KEY_ID;
	        $key_secret     = RAZORPAY_KEY_SECRET;
	        $fields_string  = "amount=$amount";
	        //cURL Request
	        $ch = curl_init();
	        //set the url, number of POST vars, POST data
	        curl_setopt($ch, CURLOPT_URL, $url);
	        curl_setopt($ch, CURLOPT_USERPWD, $key_id.':'.$key_secret);
	        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
	        curl_setopt($ch, CURLOPT_POST, 1);
	        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
	        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
	        return $ch;
	    }   
	        
	    // callback method
	    public function callback() {
	        if (!empty($this->input->post('razorpay_payment_id')) && !empty($this->input->post('merchant_order_id'))) {
	            $razorpay_payment_id = $this->input->post('razorpay_payment_id');
	            $merchant_order_id = $this->input->post('merchant_order_id');
	            
	            $this->session->set_flashdata('razorpay_payment_id', $this->input->post('razorpay_payment_id'));
	            $this->session->set_flashdata('merchant_order_id', $this->input->post('merchant_order_id'));
	            $currency_code = 'INR';
	            $amount = $this->input->post('merchant_total');
	            $success = false;
	            $error = '';
	            try {                
	                $ch = $this->curl_handler($razorpay_payment_id, $amount);
	                //execute post
	                $result = curl_exec($ch);
	                $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	                if ($result === false) {
	                    $success = false;
	                    $error = 'Curl error: '.curl_error($ch);
	                } else {
	                    $response_array = json_decode($result, true);
	                        //Check success response
	                        if ($http_status === 200 and isset($response_array['error']) === false) {
	                            $success = true;
	                        } else {
	                            $success = false;
	                            if (!empty($response_array['error']['code'])) {
	                                $error = $response_array['error']['code'].':'.$response_array['error']['description'];
	                            } else {
	                                $error = 'RAZORPAY_ERROR:Invalid Response <br/>'.$result;
	                            }
	                        }
	                }
	                //close curl connection
	                curl_close($ch);
	            } catch (Exception $e) {
	                $success = false;
	                $error = 'Request to Razorpay Failed';
	            }

	            if ($success === true) {
	                if(!empty($this->session->userdata('ci_subscription_keys'))) {
	                    $this->session->unset_userdata('ci_subscription_keys');
	                }
	                //destroy cart when payment successfull
	                $this->cart->destroy();
	                $this->init_product_model();
	                if($this->Product_model->updatePaymentStatusForAPerticularOrder($merchant_order_id)){
	                	if($this->Product_model->setPaymentStatus($response_array))
	                		 redirect($this->input->post('merchant_surl_id'));
	                }
	            } else {
	            	if($this->Product_model->updatePaymentStatusForAPerticularOrder($merchant_order_id)){
	                	if($this->Product_model->setPaymentStatus($response_array))
	                		 redirect($this->input->post('merchant_furl_id'));
	                }
	            }
	        } else {
	            echo 'An error occured. Contact site administrator, please!';
	        }
	    }

	    public function success() {
	        $data['title'] = 'Razorpay Success';
	        $this->load->view('user/payment_status_page/successful', $data);
	    }
	    
	    public function failed() {
	        $data['title'] = 'Razorpay Failed';  
	        $this->load->view('user/payment_status_page/failed', $data);
	    }
	}
?>