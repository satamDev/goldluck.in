<footer class="footer">
        <div class="container">
           <div class="row">
               <div class="col-md-12 col-lg-3 mt-3">
                 <div class="mb-3"><a href="<?=base_url();?>"><img src="<?=base_url()?><?=$site_details['logo_path']?>" alt="logo"></a></div>  
                   <p><?=$site_details['footer_paragraph']?></p>
                   <div class="Scllnks">
                       <ul>
                           <li><a href="<?=$site_details['facebook_url']?>" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                           <li><a href="<?=$site_details['twitter_url']?>" target="_blank"><i class="fab fa-twitter"></i></a></li>
                           <li><a href="<?=$site_details['linkedin_url']?>" target="_blank"><i class="fab fa-linkedin-in"></i></a></li>
                           <li><a href="<?=$site_details['instagram_url']?>" target="_blank"><i class="fab fa-instagram"></i></a></li> 
                       </ul>
                   </div>

                   <?php if($this->session->has_userdata('type') && $this->session->userdata('type') == 'retailer'){}else{ ?>
                   <div class="mt-2"><i class="fas fa-store"></i> Are You a Retailer? <br>
                        <span class="text-white" style="cursor: pointer;" data-toggle="modal" data-target="#retailerRegistration"> Register </span>
                        <span class="text-white ml-2" style="cursor: pointer;" data-toggle="modal" data-target="#retailerLogin"> Login</span>
                    </div>
                    <?php } ?>
               </div>

               <div class="col-md-12 col-lg-3 mt-3">
               <h4>Categories</h4>
                <div class="ftrlnks">
                    <ul>
                        <li><a href="#">For Men</a></li>
                        <li><a href="#">For Women</a></li>
                        <li><a href="#">Accessories</a></li>
                        <li><a href="#">Collection</a></li>
                        <li><a href="#">Others</a></li>
                    </ul>
                </div>
              </div>

              <div class="col-md-12 col-lg-2 mt-3 brdrright">
                <h4>Categories</h4>
                <div class="ftrlnks">
                    <ul>
                        <li><a href="#">For Men</a></li>
                        <li><a href="#">For Women</a></li>
                        <li><a href="#">Accessories</a></li>
                        <li><a href="#">Collection</a></li>
                        <li><a href="#">Others</a></li>
                    </ul>
                </div>
             </div>

             <div class="col-md-12 col-lg-4 pl-lg-5 mt-3">
                <h4>News Letter</h4>
                 <p class="mb-3">Subscribe to the weekly newsletter <br> for all the latest updates</p>
                 <div class="Subbox">
                    <form action="#" style="display: flex;">
                        <input type="email" placeholder="Your Email..">
                        <input type="submit" class="btn1" value="Subscribe">
                    </form>
                 </div>
             </div>
           </div>
        </div>
    </footer>         

    <footer class="footer2">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-12 col-lg-8 mb-3 mb-lg-0"> © Copyright, Rohit Chain, All Rights Reserved.</div>
                <div class="col-md-12 col-lg-4">
                    <img src="<?=base_url()?>/assets/images/cards.png" alt="">
                </div>
            </div>  
        </div>
    </footer> 


    <!-- Retailer Registration Modal -->

<!-- Retailer Registration Modal -->
<div class="modal QuickrderMdl fade" id="retailerRegistration" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Retailer Registration</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="orderreqstfrm">
                <form action="<?=base_url()?>addRetailerRegistrationRequest" method="post" id="frm_retailer">
                  <div class="row">
                    <div class="col-md-6 ">
                        <div class="form-group">
                           <label>First Name <span>*</span> </label>
                           <input type="text" class="form-control" name="fname" placeholder="Enter First Name" required>                           
                        </div>
                    </div>
    
                    <div class="col-md-6 ">
                        <div class="form-group">
                           <label>Last name <span>*</span> </label>
                           <input type="text" class="form-control" name="lname" placeholder="Enter Last Name" required>                           
                        </div>
                    </div>
    
                    <div class="col-12 ">
                        <div class="form-group">
                           <label>Store Name <span>*</span> </label>
                           <input type="text" class="form-control" name="store_name" placeholder="Enter Store Name" required>                           
                        </div>
                    </div>
    
                    <div class="col-md-12 ">
                        <div class="form-group">
                           <label>Contact Number <span>*</span> </label>
                           <input id="retailer_number" type="number" class="form-control" name="phone" placeholder="Enter Contact Number" required>                           
                        </div>
                    </div>
    
                    <div class="col-md-12 ">
                        <div class="form-group">
                           <label>Email <span>*</span> </label>
                           <input type="email" class="form-control" name="email" placeholder="Enter Email ID" required>                           
                        </div>
                    </div>
    
                    <div class="col-md-12 ">
                        <div class="form-group">
                           <label>Password <span>*</span> </label>
                           <input type="text" class="form-control" name="password" placeholder="Enter Password" required>                           
                        </div>
                    </div>
    
                    <div class="col-md-12">
                        <div class="form-group">
                           <label>GST No.  <span>*</span> </label>
                           <input type="text" class="form-control" name="gst_no" placeholder="Enter GST No." required>                           
                        </div>
                    </div>
                                    
                  <div class="modal-footer">
                    <button type="submit" class="btn1">
                        <span class="please_wait" style="display: none;">Please Wait...</span>
                        <span class="submit">Register</span>
                    </button>
                </div>
                </div>
                  
                </form>
            </div>
      </div>
     
    </div>
  </div>
</div>

<!-- Retailer Login Modal -->
<div class="modal QuickrderMdl fade" id="retailerLogin" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Retailer Login</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="orderreqstfrm">
                <form action="<?=base_url()?>loginRetailer" method="post" id="frm_retailer_login">
                  <div class="row">                   
    
                    <div class="col-md-12 ">
                        <div class="form-group">
                           <label>Email <span>*</span> </label>
                           <input type="email" class="form-control" name="email" placeholder="Enter Email ID" required>                           
                        </div>
                    </div>
    
                    <div class="col-md-12 ">
                        <div class="form-group">
                           <label>Password <span>*</span> </label>
                           <input type="text" class="form-control" name="password" placeholder="Enter Password" required>                           
                        </div>
                    </div>
    
                                    
                  <div class="modal-footer">
                    <button type="submit" class="btn1">
                        <span class="please_wait" style="display: none;">Please Wait...</span>
                        <span class="submit">Login</span>
                    </button>
                </div>
                </div>
                  
                </form>
            </div>
      </div>
    </div>
  </div>
</div>


    <!-- <script src="<?=base_url()?>assets/js/jquery.min.js"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="<?=base_url()?>assets/js/bootstrap.min.js"></script>

    <script src="<?=base_url()?>assets/js/slick.min.js"></script>
    <script src="<?=base_url()?>assets/js/jquery.fancybox.min.js"></script>
    
    <script src="<?=base_url()?>assets/js/toasty.min.js"></script>
    <script src="<?=base_url()?>assets/js/custom.js"></script>

</body>
</html>



<div class="loaderbg">
    <div><img src="<?=base_url()?>assets/images/1488.gif" alt=""></div>
</div>

<style type="text/css">
    .loaderbg {
      width: 100%;
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      position: fixed;
      z-index: 9999;
      /*background-color: #fff;*/
      top: 0;
      left: 0;
    }
</style> 

<script type="text/javascript">
    $(document).ready(function(){
        $('.loaderbg').hide();
    });
    var toast = new Toasty(); 
    $(function() {
        var frm = $('#frm_retailer');
        frm.submit(function (e) {
            e.preventDefault();
            $('.loaderbg').show();
            var data = new FormData(this);
            if( $("#retailer_number").val().toString().length < 10 || $("#retailer_number").val().toString().length > 10){
                $('.loaderbg').hide();
                toast.error('Give 10 digit mobile number...', 10000);
            }else{
                $.ajax({
                    type: frm.attr('method'),
                    url: frm.attr('action'),
                    data: data,
                    processData:false,
                    contentType:false,
                    cache:false,
                    async:true,
                    success: function(response){
                        console.log(response)
                        const data = JSON.parse(response);
                        if(data.status){
                            //loader hide
                            $('.loaderbg').hide();
                            toast.success(data.message, 10000);
                            $('#retailerRegistration').modal('hide');
                        }else{
                            //error in uploading
                            $('.loaderbg').hide();
                            toast.error(data.message, 10000);
                            // $('#retailerRegistration').modal('hide');
                        }
                    }
                });
            }
        });
    });

    $(function() {
        var frm = $('#frm_retailer_login');
        frm.submit(function (e) {
            e.preventDefault();
            $('.loaderbg').show();
            var data = new FormData(this);
            $.ajax({
                type: frm.attr('method'),
                url: frm.attr('action'),
                data: data,
                processData:false,
                contentType:false,
                cache:false,
                async:true,
                success: function(response){
                    const data = JSON.parse(response);
                    if(data.status){
                        //loader hide
                        $('.loaderbg').hide();
                        toast.success(data.message, 10000);
                        $('#retailerLogin').modal('hide');
                        setTimeout(function () {
                            window.location.replace('<?=base_url()?>');
                         }, 3000);                        
                    }else{
                        //error in uploading
                        $('.loaderbg').hide();
                        toast.error(data.message, 10000);
                        // $('#retailerLogin').modal('hide');
                    }
                }
            });
            
        });
    });
</script>