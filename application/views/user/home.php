<section class="homeslider"> 
    <?php foreach ($banner as $key => $value) {
        // print_r($value);
    ?>
        <div class="">
            <div class="homebanner" style="background:url(<?=base_url()?><?=$value->image_path?>">
                <div class="hmbnrcap">
                    <div class="container">
                        <div class="bnrmidtxt">
                            <h2><?=$value->heading?></h2>
                            <p><?=$value->paragraph?></p>
                            <!-- <a href="contact-us.html" class="btn1">Quick Order</a>  -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>

</section>


<section class=" mb-lg-4 pt-4 pb-5 whychosesec text-center">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-lg-3 mt-3 whychosseBox">
                <div >
                    <div><img src="<?=base_url()?>/assets/images/certificate.png" alt=""></div>
                    <div class="whychosesecTitle">100% Certified <br> Jewellery</div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 mt-3 whychosseBox">
                <div >
                    <div><img src="<?=base_url()?>/assets/images/money-back.png" alt=""></div>
                    <div class="whychosesecTitle">100% <br> Refund</div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 mt-3 whychosseBox">                <div >

                    <div><img src="<?=base_url()?>/assets/images/exchange.png" alt=""></div>
                    <div class="whychosesecTitle">Lifetime Exchange  <br>   & Buyback</div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 mt-3 whychosseBox">
                <div >
                    <div><img src="<?=base_url()?>/assets/images/shipping.png" alt=""></div>
                    <div class="whychosesecTitle">Free Shipping <br> & Insurance</div>
                </div>
            </div>
        </div>
    </div>
</section>   

<section class="py-5 Featuresec">
    <div class="container">
        <div class="titsec mb-4 text-center">
            <h2>Featured Collections</h2>
            <p>Let's take a glimpse of our trending collections before diving in!</p>
        </div>

        <div class="row">
            <div class="col-md-7 col-lg-8 px-2 mt-2">
               <div class="Featurebx p-5 bg-light">
                <div><h3>Latest & Unique Jewellery Collection </h3></div> 
                <div><img src="<?=base_url()?>/assets/images/banden.png" alt="" class="w-100"></div> 
               </div>
            </div>


            <div class="col-md-5 col-lg-4 px-2 mt-2">
                <div class="Featurebx2 p-5 bg-light">
                 <div><h3>New Collection </h3></div>  
                 <div><img src="<?=base_url()?>/assets/images/diamond_ring.png" alt="" class="w-100"></div> 
                </div>
            </div>


            <div class="col-md-5 col-lg-4 px-2 mt-2">
                <div class="Featurebx2 p-5 bg-light">
                 <div><h3>New Collection </h3></div>  
                 <div><img src="<?=base_url()?>/assets/images/diamond_ring.png" alt="" class="w-100"></div>
                </div>
            </div>

             <div class="col-md-7 col-lg-8 px-2 mt-2">
                <div class="Featurebx p-5 bg-light">
                 <div><h3>Latest & Unique Jewellery Collection </h3></div> 
                 <div><img src="<?=base_url()?>/assets/images/banden.png" alt="" class="w-100"></div>        
                </div>
             </div>
        </div>
    </div>
</section>   

<section class=" mt-5 py-5 bg-light ftrePrtssec">
    <div class="container pb-lg-5 pt-lg-4">      
        <div class="row">
            <div class="col-md-4 col-lg-3 mt-3">
                <div class="titsec mb-4 ">
                    <h3 >Discover Our Features Designs</h3>
                    <p>Our most loved designs deserve a worthy mention and here they are!</p>
                    <a class="btn1 mt-4" href="#">View All Featured Products</a>
                </div> 
            </div>

            <?php            
                if(!empty($featured_products)){
                    foreach($featured_products as $data) {
                        $data = (array)$data;
                        if($this->session->has_userdata('retailer_discount_percentage') && !empty($this->session->userdata('retailer_discount_percentage'))){
                            $overall_discount_percentage = $data['discount_percentage'] + $this->session->userdata('retailer_discount_percentage');                            
                        }else{
                            $overall_discount_percentage =  $data['discount_percentage'];                            
                        }
                        $discounted_price = $data['price'] - (($overall_discount_percentage / 100) * $data['price']);  //Percentage Calculation
            ?>
            <div class="col-md-4 col-lg-3 mt-3 text-center">
                <div class="ProductBox">
                    <a href="<?=base_url()?>details/<?=$data['product_id']?>"><div><img src="<?=base_url().'assets/images/products/'.$data['cover_image']?>" alt="" width="100%"></div></a> 
                    <div class="wishlist" onclick="add_to_wishlist(<?=($this->session->has_userdata('userId'))? "'".$this->session->userdata('userId')."'":'0'?>,'<?=$data['product_id']?>', <?=(isset($data['wishlist']))?$data['wishlist']:'0'?>)"><i class="fas fa-heart" style="color: <?=(isset($data['wishlist']))?($data['wishlist'] == 1)?'red':'' : ''?>"></i></a> </div>
                    <div class="ProductButton">
                       <span class="pcart"  onclick="add_to_cart(<?=($this->session->has_userdata('userId'))? "'".$this->session->userdata('userId')."'":'0'?>,'<?=$data['product_id']?>', '<?=$data['title']?>', '<?=$data['price']?>', '<?=$discounted_price?>', 1)"><i class="fas fa-shopping-cart"></i></span>
                       <a class="pview" href="<?=base_url()?>details/<?=$data['product_id']?>"><i class="fas fa-eye"></i></a>
                    </div>  
                </div>
            </div>
            <?php } } ?>
        </div>
    </div>
</section>    


<section class="ofrsec text-center">
    <div class="container">
        <div class="ofrbox">
            <div><strong>GET SPECIAL PRICE ONLY THIS WEEK</strong> </div>
            <h2 class="my-3">Custom Your Jewellry Now</h2>
            <p>d tagna aliqua. Quis iuspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis. </p>
            <button class="btn1" data-toggle="modal" data-target="#QuickRequest">Ouick Order</button>
        </div>
    </div>
</section>  