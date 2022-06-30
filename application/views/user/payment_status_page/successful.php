<?php
defined("BASEPATH") or exit("No direct script access allowed");
if(empty($this->session->flashdata('razorpay_payment_id'))){
    redirect(base_url());
}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
      <link href="<?=base_url()?>assets/css/font-awesome.css" rel="stylesheet">
      <link href="<?=base_url()?>assets/css/custom_style.css" rel="stylesheet">

    <title><?=$title?></title>
  </head>
  <body>

   <section class="p-3 w-100 text-center d-flex align-items-center justify-content-center flex-column" style="height:100vh;">
       <div><svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
        viewBox="0 0 512 512" width="100px" height="100px" fill="#198754" style="enable-background:new 0 0 512 512;" xml:space="preserve">
   <g>
       <g>
           <g>
               <path d="M437.016,74.984c-99.979-99.979-262.075-99.979-362.033,0.002c-99.978,99.978-99.978,262.073,0.004,362.031
                   c99.954,99.978,262.05,99.978,362.029-0.002C536.995,337.059,536.995,174.964,437.016,74.984z M406.848,406.844
                   c-83.318,83.318-218.396,83.318-301.691,0.004c-83.318-83.299-83.318-218.377-0.002-301.693
                   c83.297-83.317,218.375-83.317,301.691,0S490.162,323.549,406.848,406.844z"/>
               <path d="M368.911,155.586L234.663,289.834l-70.248-70.248c-8.331-8.331-21.839-8.331-30.17,0s-8.331,21.839,0,30.17
                   l85.333,85.333c8.331,8.331,21.839,8.331,30.17,0l149.333-149.333c8.331-8.331,8.331-21.839,0-30.17
                   S377.242,147.255,368.911,155.586z"/>
           </g>
       </g>
   </g>

   </svg></div>
   <div class="my-3"><h3>Your transaction is successful</h3></div>
   <div><b>Transaction  ID:</b> <?=$this->session->flashdata('razorpay_payment_id')?></div>
   <div class="mt-2 mb-3"><b>Order  ID:</b><?=$this->session->flashdata('merchant_order_id')?></div></div>
   
   <div class="d-flex align-items-center justify-content-center">
       <a  href="<?=base_url()?>"><button class="btn1 btn-lg px-4" type="button" style="font-size:16px;">GO BACK TO HOME</button></a>
       <a  href="<?=base_url()?>account"><button class="ml-2 btn1 btn-lg px-4" type="button" style="font-size:16px;">Account</button></a>
    </div>
   </section>
  
  
<script src="<?=base_url()?>assets/js/jquery.min.js"></script>
<script src="<?=base_url()?>assets/js/bootstrap.min.js"></script>
  <script src="<?=base_url()?>assets/js/slick.min.js"></script>
  <script src="<?=base_url()?>assets/js/jquery.fancybox.min.js"></script>
  <script src="<?=base_url()?>assets/js/custom.js"></script>
</body>
</html>