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
       <div><svg width="100px" height="100px" fill="#dc3545" viewBox="0 0 14 14" xmlns="http://www.w3.org/2000/svg"><g fill-rule="evenodd"><path d="M0 7a7 7 0 1 1 14 0A7 7 0 0 1 0 7z"/><path d="M13 7A6 6 0 1 0 1 7a6 6 0 0 0 12 0z" fill="#FFF" style="fill: var(--svg-status-bg, #fff);"/><path d="M7 5.969L5.599 4.568a.29.29 0 0 0-.413.004l-.614.614a.294.294 0 0 0-.004.413L5.968 7l-1.4 1.401a.29.29 0 0 0 .004.413l.614.614c.113.114.3.117.413.004L7 8.032l1.401 1.4a.29.29 0 0 0 .413-.004l.614-.614a.294.294 0 0 0 .004-.413L8.032 7l1.4-1.401a.29.29 0 0 0-.004-.413l-.614-.614a.294.294 0 0 0-.413-.004L7 5.968z"/></g></svg></div>
   <div class="my-3"><h3>Payment Failed!</h3></div>

    <div><b>Transaction  ID:</b> <?=$this->session->flashdata('razorpay_payment_id')?></div>
   <div class="mt-2 mb-3"><b>Order  ID:</b></div><?=$this->session->flashdata('merchant_order_id')?></div>

   <a href="#"><button class="btn1 btn-lg px-4" type="button" style="font-size:16px;">RETRY PAYMENT</button></a>

   </section>
  
  
<script src="<?=base_url()?>assets/js/jquery.min.js"></script>
<script src="<?=base_url()?>assets/js/bootstrap.min.js"></script>
  <script src="<?=base_url()?>assets/js/slick.min.js"></script>
  <script src="<?=base_url()?>assets/js/jquery.fancybox.min.js"></script>
  <script src="<?=base_url()?>assets/js/custom.js"></script>
</body>
</html>