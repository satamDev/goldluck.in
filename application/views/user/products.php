<section class=" mb-md-5">
    <div class="container">
        <div class="row">           
            <?php
            
            if(!empty($results)){
                foreach($results as $data) {
                    if($this->session->has_userdata('retailer_discount_percentage') && !empty($this->session->userdata('retailer_discount_percentage'))){
                        $overall_discount_percentage = $data->discount_percentage + $this->session->userdata('retailer_discount_percentage');
                        // echo $overall_discount_percentage;
                    }else{
                        $overall_discount_percentage =  $data->discount_percentage;
                        // echo $overall_discount_percentage;
                    }
                    $discounted_price = $data->price - (($overall_discount_percentage / 100) * $data->price);  //Percentage Calculation
                    // echo "Price = ".$data->price;
            ?>
            <div class="col-md-4 col-lg-3 mt-3 text-center">
                <div class="ProductBox">
                    <a href="<?=base_url()?>details/<?=$data->product_id?>">
                        <div>
                            <img src="<?=base_url().'assets/images/products/'.$data->cover_image?>" alt="" style="width: 100%;height: 210px;">
                        </div>
                    </a> 

                    <div class="wishlist">
                        <span onclick="add_to_wishlist(<?=($this->session->has_userdata('userId'))? "'".$this->session->userdata('userId')."'":'0'?>,'<?=$data->product_id?>', <?=(isset($data->wishlist))?$data->wishlist:'0'?>)"><i class="fas fa-heart" style="color: <?=(isset($data->wishlist))?($data->wishlist == 1)?'red':'' : ''?>"></i></span>
                    </div>

                    <div class="ProductButton">
                        <span class="pcart" onclick="add_to_cart(<?=($this->session->has_userdata('userId'))? "'".$this->session->userdata('userId')."'":'0'?>,'<?=$data->product_id?>', '<?=$data->title?>', '<?=$data->price?>', '<?=$discounted_price?>', 1)">
                            <i class="fas fa-shopping-cart"></i>
                        </span>
                        <a class="pview" href="<?=base_url()?>details/<?=$data->product_id?>">
                            <i class="fas fa-eye"></i>
                        </a>
                    </div>        
                </div>
                <a href="<?=base_url()?>details/<?=$data->product_id?>"> <div class="product-title"><?=$data->title?></div></a>
                <div class="product-price">&#x20b9; 
                    <?=number_format($discounted_price, 2) ?>
                </div>
            </div>

           <?php
                } //foreach loop close
            } // $result empty checking close
            else{
                ?>
                 <div class="col-md-12 col-lg-12 mt-5 mb-5 text-center">
                    <!-- <h2>Featured Collections</h2> -->
                    <p>No Product Availavle</p>
                </div>
                <?php
            }
           ?>
           
        </div>
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                <li class="page-item"><?php echo $links; ?></li>
           </ul>
       </nav>
    </div>
</section>