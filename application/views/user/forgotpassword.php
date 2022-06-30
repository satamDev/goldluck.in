<section class="py-5 mb-md-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-8 mx-auto ">
                <div class="login">
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
                    <div id="CustomerLoginForm">
                        <form method="post" action="<?=base_url()?>forgetPassword">
                            <div class="login-form-container">
                                <div class="login-text">
                                    <h2>Reset Your Password</h2>
                                    <p>We will send you an email to reset your password. </p>
                                </div>
                                <div class="login-form">
                                    <input type="email" name="email" class="input-full" placeholder="Email">  
                                    <div class="login-toggle-btn">
                                        <div class="account-optional-action">
                                            <button type="submit" class="btn1">Submit</button>
                                            <a href="<?=base_url('/')?>">Cancel</a>
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