            <!-- Begin Page Content -->
            <div class="container-fluid">               
                <form method="post" action="<?=base_url('admin/updateFrontEndData') ?>" enctype="multipart/form-data">
                    <div class="row">
                        <!-- Product Upload Form -->
                        <div class="col-xl-12 col-lg-12">
                            <div class="card shadow mb-4 h-100">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Front End Data</h6>                                    
                                </div>
                                <!-- Card Body -->

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

                                <div class="card-body">
                                    <input type="hidden" name="data" value="<?=$data[0]->id?>">
                                    <div class="form-row">
                                        <div class="form-group col-md-8">
                                            <label for="inputCompanyName">Company Name</label>
                                            <input type="text" name="name" class="form-control" id="inputCompanyName" value="<?=$data[0]->name?>" required>
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label for="inputWhatsappNumber">Whatsapp Number</label>
                                            <input type="text" name="whatsapp_no" class="form-control" id="inputWhatsappNumber" value="<?=$data[0]->whatsapp_number?>" required>
                                        </div>

                                        <div class="form-group col-md-8">
                                            <label for="inputProductTitle">Logo</label><br>
                                            <img src="<?=base_url()?><?=$data[0]->logo_path?>"  class="img-thumbnail">
                                            Change Logo? 
                                            <input type="file" name="file-input" class="custom"  accept="image/*" />
                                                                       
                                        </div>                                        
                                        
                                         <div class="form-group col-md-4">
                                            <label for="inputStoreLocation">Store Location Link</label>
                                            <textarea class="form-control" id="inputStoreLocation" name="store_location" rows="3"><?=$data[0]->store_location?></textarea>
                                        </div>

                                        <div class="form-group col-md-12">
                                            <label for="inputFooterParagraph">Footer Paragraph</label>
                                            <textarea class="form-control" id="inputFooterParagraph" name="footer_paragraph" rows="3"><?=$data[0]->footer_paragraph?></textarea>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="inputFacebookUrl">Facebook Link</label>
                                            <input type="text" name="facebook_url" class="form-control" id="inputFacebookUrl" value="<?=$data[0]->facebook_url?>">
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="inputTwitterUrl">Twitter Link</label>
                                            <input type="text" name="twitter_url" class="form-control" id="inputTwitterUrl" value="<?=$data[0]->twitter_url?>">
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="inputLinkedinUrl">Linkedin Link</label>
                                            <input type="text" name="linkedin_url" class="form-control" id="inputLinkedinUrl" value="<?=$data[0]->linkedin_url?>">
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="inputInstagramUrl">Instagram Link</label>
                                            <input type="text" name="instagram_url" class="form-control" id="inputInstagramUrl" value="<?=$data[0]->instagram_url?>">
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label for="inputOTMtoF">Monday - Friday Opening Time</label>
                                            <input type="text" name="inputOTMtoF" class="form-control" id="inputOTMtoF" value="<?=$data[0]->openingtime_m_to_f?>" required>
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label for="inputCTMtoF">Monday - Friday Closing Time</label>
                                            <input type="text" name="inputCTMtoF" class="form-control" id="inputCTMtoF" value="<?=$data[0]->closingtime_m_to_f?>" required>
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label for="inputOTMtoF">Saturday Opening Time</label>
                                            <input type="text" name="inputOTS" class="form-control" id="inputOTS" value="<?=$data[0]->openingtime_saturday?>" required>
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label for="inputCTS">Saturday Closing Time</label>
                                            <input type="text" name="inputCTS" class="form-control" id="inputCTS" value="<?=$data[0]->closingtime_saturday?>" required>
                                        </div>

                                      </div>
                                </div>
                            </div>
                        </div>


                        <button type="submit" class="btn btn-primary btn-block m-5">Update Details</button>
                    </div>
                </form>
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- End of Main Content -->
    </div>
    <!-- End of Content Wrapper -->
</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<style type="text/css">
    form{
        font-size: small;
    }
    .form-control{
        font-size: small;
    }
    label{
        font-weight: bold;
    }
    
</style>