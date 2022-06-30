            <!-- Begin Page Content -->
            <div class="container-fluid">
                <div class="row">
                    <!-- Product filter choose section -->
                    <div class="col-xl-12 col-lg-12">
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
                        <div class="card shadow mb-4 h-100">
                            <!-- Card Header - Dropdown -->
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">Banners</h6> 
                                <button class="btn btn-primary" data-toggle="modal" data-target="#AddBannerModel"><i class="fas fa-plus-circle">Add New Banner</i></button>
                            </div>
                            <!-- Card Body -->
                            <div class="card-body">
                                <table class="table">  
                                    <thead>
                                        <tr>
                                            <th scope="col">Banner Images</th>
                                            <th scope="col">Heading</th>
                                            <th scope="col">Paragraph</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>          
                                    <tbody>
                                        <?php foreach ($banners as $key => $value) {  ?>
                                        <tr>
                                            <th><img src="<?=base_url().$value->image_path?>" width="100%"></th>
                                            <td><?=$value->heading?></td>
                                            <td><?=$value->paragraph?></td>
                                            <td><button class="btn btn-danger" onclick="do_delete(<?=$value->id?>)">Delete</button></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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

<!-- Add Filter Option Modal-->
<div class="modal fade" id="AddBannerModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Banner <span id="filter_menu_name" class="text-success text-capitalize"></span></h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">  
                <form method="post" action="<?=base_url('admin/action_banner')?>"  enctype="multipart/form-data">  
                <input type="hidden" name="purpose" value="add">           
                <div class="form-group">
                    <label class="col-form-label">Heading :</label>
                    <input type="text" class="form-control" name="heading" placeholder="Enter Model Heading" required>
                </div>
                 <div class="form-group">
                    <label class="col-form-label">Paragraph :</label>
                    <textarea class="form-control" name="paragraph"></textarea>
                </div>
                <div class="form-group">
                    <label class="col-form-label">Choose Banner Image :</label>
                    <!-- <input type="file" class="form-control" name="model_image"> -->
                    <input type="file" class="form-control-file" id="myfile" name="model_image">
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <input class="btn btn-primary" id="btn-filter-item-add" type="submit">               
            </div>
            </form>
        </div>
    </div>
</div>

<style type="text/css">
    table{
        font-size: small;
    }
</style>
