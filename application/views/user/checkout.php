<?php 
    $fname = $this->session->userdata('fname');
    $lname = $this->session->userdata('lname');
    $full_name = $fname . " " . $lname;
    $addressId = $this->session->userdata('addressId');

    $address_array = array(
        'AN' => 'Andaman and Nicobar Islands',
        'AP' => 'Andhra Pradesh',
        'AR' => 'Arunachal Pradesh',
        'AS' => 'Assam',
        'BR' => 'Bihar',
        'CH' => 'Chandigarh',
        'CT' => 'Chhattisgarh',
        'DN' => 'Dadra and Nagar Haveli',
        'DD' => 'Daman and Diu',
        'DL' => 'Delhi',
        'GA' => 'Goa',
        'GJ' => 'Gujarat',
        'HR' => 'Haryana',
        'HP' => 'Himachal Pradesh',
        'JK' => 'Jammu and Kashmir',
        'JH' => 'Jharkhand',
        'KA' => 'Karnataka',
        'KL' => 'Kerala',
        'LA' => 'Ladakh',
        'LD' => 'Lakshadweep',
        'MP' => 'Madhya Pradesh',
        'MH' => 'Maharashtra',
        'MN' => 'Manipur',
        'ML' => 'Meghalaya',
        'MZ' => 'Mizoram',
        'NL' => 'Nagaland',
        'OR' => 'Odisha',
        'PY' => 'Puducherry',
        'PB' => 'Punjab',
        'RJ' => 'Rajasthan',
        'SK' => 'Sikkim',
        'TN' => 'Tamil Nadu',
        'TG' => 'Telangana',
        'TR' => 'Tripura',
        'UP' => 'Uttar Pradesh',
        'UT' => 'Uttarakhand',
        'WB' => 'West Bengal'
    );
    
?>
<style type="text/css">
    .loaderbg {
        width: 100%;
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        position: fixed;
        z-index: 9999;
        top: 0;
        left: 0;
    }
</style>
<section class="py-5 mb-md-5">
    <div class="container">
         <div class="row">
             <div class="col-12 col-md-12 col-lg-7">
                <div class="loaderbg">
                    <img src="<?=base_url()?>assets/images/loader/preloader.gif">
                </div>
                 <div class="CheckoutBox">
                     <h3 class="mb-3">Billing Details</h3>
                     <form action="#">
                        <div class="row">
                            <?php
                                if($addressId=="0")
                                    echo '<div class="col-md-12 text-danger text-center">Please Add Your Complete Address In Account Section</div>';
                                else{
                            ?>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <table>
                                        <tr>                                            
                                            <th><?=ucwords($full_name)?></th>
                                        </tr>
                                        <tr>                                            
                                            <td><?=$email?></td>
                                        </tr>
                                        <tr>                                            
                                            <td><?=$phone?></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <?=($addressId != "0")? $address[0]['address'] :''?>, 
                                                <?=($addressId != "0")? $address_array[$address[0]['state']] :''?>, 
                                                <?=($addressId != "0")? $address[0]['pincode'] :''?>,
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <?=($addressId != "0")? $address[0]['address_note'] :''?>
                                            </td>
                                        </tr>
                                    </table>                 
                                </div>
                            </div>
                        <?php } //if address exist close ?>
                        </div>
                    </form>
                 </div>
             </div>


             <div class="col-12 col-md-12 col-lg-5">
                <div class="CheckoutBoxside">
                    <div class="p-4">
                        <!-- <h5 class="mb-3">Coupon code</h5>
                        <form class="Subbox" action="#">
                            <input type="email" placeholder="Cupon Code">
                            <input type="submit" class="btn1" value="Apply Cupon">
                        </form> -->
                        <h5 class="mt-4">Your Order</h5>
                    
                    
                    <table class="c-cart__totals-table shop_table woocommerce-checkout-review-order-table" >
                        <tbody>
                                <?php
                                    $cart = $this->cart->contents();
                                    $grand_total = 0;
                                    foreach ($cart as $item){
                                        $grand_total += $item['subtotal'];

                                ?>
                                <tr>
                                    <td colspan="2" class="c-cart__totals-product-space"></td>
                                </tr>
                                <tr class="c-cart__totals-product cart_item">
                                    <td class="c-cart__totals-product-name">
                                        <?=$item['name']?>&nbsp;
                                    </td>
                                    <td class="c-cart__totals-product-name">
                                        <strong class="c-cart__totals-product-quantity product-quantity">×&nbsp; <?=$item['qty']?></strong>
                                    </td>
                                    <td class="c-cart__totals-price" style="width: 26%;">
                                        <span class="woocommerce-Price-amount amount">
                                           <bdi><span class="woocommerce-Price-currencySymbol">&#8377; </span><?=$item['subtotal']?></bdi>
                                        </span>						
                                     </td>
                                 </tr>

                                 <?php
                                    }
                                 ?>
                                      
                        </tbody>
                    </table>
                </div>
                <div class="subtotalwrap">      
                    <table class="w-100">
                        <tbody >
                            <tr class="subtotalPrice">
                                <td class="subpname"> Subtotal </td>
                                <td class="subpprice text-right"><bdi><span class="woocommerce-Price-currencySymbol">&#8377;</span><?=$grand_total?></bdi></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                     
               

                <!-- <div class="subtotalwrap">      
                    <table class="w-100">
                        <tbody>
                            <tr class="subtotalPrice">
                                <td class="subpname"> Total </td>
                                <td class="subpprice text-right"><bdi><span class="woocommerce-Price-currencySymbol">$</span>1,250</bdi></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
 -->
                <div class="p-4 paymentmSec">
                    <h5 class="mb-3">Payment Method </h5>
                    <div class="w-100">
                        <input type="radio" type="checkbox" id="Online" checked class="cursor-pointer">
                        <label for="Online" class="cursor-pointer"> Online Payment </label> <br>
                        <!-- <small>Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order will not be shipped until the funds have cleared in our account.
                        </small> -->
                    </div>
                   
                     <span class="d-block mt-3"></span>
                     <div class="w-100">
                        
                    <!-- <input type="radio" type="checkbox" id="Cash" name="Cash" value="Cash ">                    
                    <label for="Cash">Cash on delivery </label> <br>
                    <small>Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order will not be shipped until the funds have cleared in our account.
                    </small>
                    </div> -->

                    <div class="mt-3 w-100">
                        <input type="checkbox" id="agree" name="agree" class="cursor-pointer" >
                        <label for="agree" class="cursor-pointer"> * I have read and agree to the website terms and conditions</label>
                    </div>
                        <button onclick="setOrder()" class="btn1 btn-lg w-100">
                            <span>Place Order</span>
                        </button>
                </div>
                </div>
                </div>
            </div>

         </div>
    </div>
</section>

<form name="razorpay-form" id="razorpay-form" method="POST">
    <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id" />
    <input type="hidden" name="merchant_order_id" id="merchant_order_id"/>
    <input type="hidden" name="merchant_trans_id" id="merchant_trans_id"/>
    <input type="hidden" name="merchant_product_info_id" id="merchant_product_info_id"/>
    <input type="hidden" name="merchant_surl_id" id="merchant_surl_id"/>
    <input type="hidden" name="merchant_furl_id" id="merchant_furl_id"/>
    <input type="hidden" name="card_holder_name_id" id="card_holder_name_id"/>
    <input type="hidden" name="merchant_total" id="merchant_total"/>
    <input type="hidden" name="merchant_amount" id="merchant_amount"/>
</form>

<style type="text/css">
    .cursor-pointer{
        cursor: pointer;
    }
</style>