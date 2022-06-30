<section class="py-5 mb-md-5">
    <div class="container">            
            <div class="col-lg-6 col-md-8 mx-auto ">
                <div class="login">
                    <div id="CustomerLoginForm">
                        <form method="post" action="<?=base_url()?>registration"> 
                            <div class="login-form-container">
                                <div class="login-text">
                                    <h2>Create Account</h2><p>Please Register using account detail bellow.</p>
                                </div>
                          
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
                                    <input type="text" name="fname" class="input-full" placeholder="First Name" value=<?= set_value('field_name'); ?>>
                                    <input type="text" name="lname" class="input-full" placeholder="Last Name" >
                                    <input type="text" name="phone" class="input-full" placeholder="Phone">
                                    <input type="email" name="email" class="input-full" placeholder="Email">
                                    <input type="password" name="password" class="input-full" placeholder="Password">
                                    <div class="login-toggle-btn">
                                        <div class="form-action-button">
                                            <button type="submit" class="btn1 w-100">Create Account</button>
                                        </div>
                                        <div class="account-optional-action">
                                            <a href="<?=base_url()?>login">Login</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div> 
                </div>
            </div>
            
    </div>
</section>