<?php if(isset($details['title'])){?>
<section class="py-5 mb-md-5">
    <div class="container">
         <div class="row align-items-center">
             <div class="col-12 col-md-6 col-lg-5 mx-auto">
                 <div class="ptoduct-slider">    

                    <?php
                        foreach ($details['images'] as $key => $value) {
                    ?>
                    <div>           
                        <a href="<?=base_url().'assets/images/products/'.$value['path']?>" class="glrythmb" data-fancybox="gallery">
                            <img src="<?=base_url().'assets/images/products/'.$value['path']?>" alt="" class="img-fluid">
                        </a>
                    </div>  

                    <?php
                        }
                    ?>                    

                 </div>
                 <div class="ptoduct-slider-nav mt-2">
                    <?php
                        foreach ($details['images'] as $key => $value) {
                    ?>
                    <img src="<?=base_url().'assets/images/products/'.$value['path']?>" alt="" width="50px" >                    
                    <?php
                        }
                    ?>  
                 </div>
             </div>
             <div class="col-12 col-md-6 col-lg-6 ">
                 <div class="ProdcutInnerDetails">
                     <h1><?=$details['title']?></h1>
                     <div class="Innerpricesec">
                         <div class="Dbadge">
                            <?php
                                if($this->session->has_userdata('retailer_discount_percentage') && !empty($this->session->userdata('retailer_discount_percentage'))){
                                    $overall_discount_percentage = $details['discount_percentage'] + $this->session->userdata('retailer_discount_percentage');
                                    echo $overall_discount_percentage;
                                }else{
                                    $overall_discount_percentage =  $details['discount_percentage'];
                                    echo $overall_discount_percentage;
                                }
                                ?>
                            %
                        </div> 
                         <div class="PInnerPrice">
                            &#x20b9; 
                            <?php 
                                $discounted_price = $details['price'] - (($overall_discount_percentage / 100) * $details['price']);
                                echo $discounted_price;
                            ?> <!-- Percentage Calculation -->
                        </div>
                         <div class="PlinethroughtPrice">&#x20b9; <?=$details['price']?></div>
                     </div>
                     <div class="innerpgstock">Availability: <span>
                        <?=($details['quantity'] > 0)? ($details['quantity'] > 0 && $details['quantity'] <= 10)? 'Hurry Up Only '.$details['quantity']. " left in stock" : 'Only '.$details['quantity']. " left in stock" : '<span class="text-danger">Out of Stock</span>'?>
                    </span></div>
                    <p class="contentDetails"><?=$details['short_description']?></p>

                    <div class="d-flex align-items-center ">
                        <!-- <div class="quantity buttons_added">
                            <input type="button" value="-" class="minus"><input type="number" step="1" min="1" max="" name="quantity" value="1" title="Qty" class="input-text qty text" size="4" pattern="" inputmode=""><input type="button" value="+" class="plus">
                        </div> -->
                        <div class="inneraddtocar ml-2"><span onclick="add_to_cart(<?=($this->session->has_userdata('userId'))? "'".$this->session->userdata('userId')."'":'0'?>,'<?=$details['uid']?>', '<?=$details['title']?>', '<?=$details['price']?>', '<?=$discounted_price?>', 1)" class="btn1" href="#" style="cursor: pointer;">ADD TO CART</span></div>
                    </div>
                    
                    <div class="inneraddwishlist">
                        <span style="cursor:pointer;" onclick="add_to_wishlist(<?=($this->session->has_userdata('userId'))? "'".$this->session->userdata('userId')."'":'0'?>,'<?=$details['uid']?>', <?=$details['wishlist']?>)"> 
                            <i class="fas fa-heart" style="color: <?=($details['wishlist'] == 1)?'red':''?>"></i>
                            <span class="ml-2"> <?=($details['wishlist'] == 0)? 'ADD TO ' : 'DELETE FROM '?>WISHLIST</span>
                        </span>
                    </div>

                    <div class="product_meta">
                        <div class="sku_wrapper mr-3">SKU: <span class="sku"><?=$details['sku']?></span></div>
                        <div class="posted_in mr-3">Category: 
                            <a href="<?=base_url()?>products/" rel="tag"><?=ucwords($details['category'])?></a></div>
                        <!-- <div class="tagged_as">Tags: <a href="" rel="tag">gold</a>, <a href="" rel="tag">man</a>, <a href="" rel="tag">ring</a></div>                    -->
                </div>
                   
                 </div>
             </div>

             <div class="col-12 col-md-12 col-lg-11 mx-auto">
                 <div class="ProdcutDescriptionTab">
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Description</a>
                        <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Additional Information</a>                  
                      </div>
                      <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab"><?=$details['long_description']?></div>
                        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                            <table class="table table-hover">                              
                                <tbody>
                                    <tr>
                                        <th scope="col" style="border: 0;">Height</th>
                                        <td scope="row" style="border: 0;"><?=$details['height']?> mm</td>
                                    </tr>
                                    <tr>
                                        <th scope="col">Width</th>
                                        <td scope="row"><?=$details['width']?> mm</td>
                                    </tr>
                                    <tr>
                                        <th scope="col">Manufacture</th>
                                        <td scope="row"><?=$details['manufacture']?></td>
                                    </tr>
                                    <tr>
                                        <th scope="col">Origin</th>
                                        <td scope="row"><?=$details['origin']?></td>
                                    </tr>
                                    <tr>
                                        <th scope="col">Setting Type</th>
                                        <td scope="row"><?=$details['setting_type']?></td>
                                    </tr>
                                    <tr>
                                        <th scope="col">Weight</th>
                                        <td scope="row"><?=$details['weight']?> gm</td>
                                    </tr>
                                    <tr>
                                        <th scope="col">Size</th>
                                        <td scope="row"><?=$details['size']?> mm</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>                     
                      </div>
                 </div>           
            </div>
         </div>
    </div>
</section>
<?php } ?>
