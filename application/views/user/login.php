<section class="py-5 mb-md-5">
    <div class="container">
        <div>
            <div class="col-lg-6 col-md-8 mx-auto ">
                <div class="login">
                    <div id="CustomerLoginForm">
                        <form method="post" action="<?=base_url()?>auth">
                            <div class="login-form-container">
                                <div class="login-text">
                                    <h2>Login</h2><p>Please login using account detail bellow.</p>
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
                                        <script type="text/javascript">
                                            do_redirect();
                                            function do_redirect(){
                                                window.setTimeout(window.location.href = "<?=base_url('/')?>",5000);
                                            }
                                        </script>
                                    <?php
                                        } 
                                    ?>
                                    <input type="email" name="email" class="input-full" placeholder="Email ID">
                                    <input type="password" name="password" class="input-full" placeholder="Password">  
                                    <div class="login-toggle-btn">
                                        <div class="form-action-button">
                                            <button type="submit" class="btn1 w-100">Log In</button>
                                        </div>

                                        <div class="account-optional-action">
                                            <a href="<?=base_url()?>signup">Create account</a>
                                            <a href="<?=base_url()?>forget_password">Forgot your password?</a>
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