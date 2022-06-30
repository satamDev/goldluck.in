<section class="py-5 mb-md-5">
    <div class="container">
         <div>
            <div class="col-lg-6 col-md-8 mx-auto" style="margin-top: 7%;">
                <div class="login">
                  <div id="CustomerLoginForm">
                    <form method="post" action="<?=base_url()?>changepassword">
                    <div class="login-form-container">
                      <div class="login-text">
                        <?php
                            if($this->session->has_userdata('userid')) $userid = $this->session->userdata('userid');
                        ?>
                        <h2>New Password Generation</h2></div>
                      <div class="login-form">
                        <?php echo validation_errors(); ?>
                        <?php                            
                            $error = $this->session->flashdata('error');
                            if($error){
                        ?>
                            <div class="alert alert-danger alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <?php echo $error; ?>                    
                            </div>
                        <?php 
                            }
                            $success = $this->session->flashdata('success');
                            if($success){
                                
                        ?>
                            <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <?php echo $success; ?>                    
                            </div>
                        <?php
                            } 
                        ?>
                        <input type="hidden" name="user" value="<?= isset($userid)?$userid:''?>">
                        <input type="password" name="password" class="input-full" placeholder="Enter New Password">
                        <input type="password" name="confirm_password" class="input-full" placeholder="Confirm Password">
                        <input type="hidden" name="for" value="<?=($this->session->has_userdata('otp_for')?$this->session->userdata('otp_for') :'' )?>">
                        <div class="login-toggle-btn">
                          <div class="form-action-button">
                           <button type="submit" class="btn1 w-100">Change Password</button>                        
                          </div>
                          <div class="account-optional-action">
                            <a href="<?=base_url()?>">Click Here Go To Home Page</a>  
                          </div>
                        </div>
                      </div>
                    </div>
                    </form>
                  </div>  
                </div>
              </div>
         </div>
    </div>
</section>