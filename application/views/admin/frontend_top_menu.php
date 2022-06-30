            <!-- Begin Page Content -->
            <div class="container-fluid">               
                <form method="post" action="<?=base_url('admin/updateFrontEndData') ?>" enctype="multipart/form-data">
                    <div class="row">

                        <div class="col-xl-6 col-lg-12">
                            <div class="card shadow mb-4 h-100">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Site Top Menu Management - Pages</h6>                                    
                                </div>

                                 <div class="card-body">
                                    
                                    <?php foreach ($pages as $key => $value) {
                                        if($value->title != 'login' && $value->title != 'signup' && $value->title != 'my_account' && $value->title != 'forget_password' && $value->title != 'cart' && $value->title != 'wishlist'){
                                    ?>
                                        <div class="form-row">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="page<?=$value->id?>" onclick="do_change_state_page(<?=$value->uid?>, <?=$value->has_top_menu?>)" <?=($value->has_top_menu == 1)?'checked':''?>>
                                                <label class="form-check-label" for="page<?=$value->id?>"><?=ucwords($value->title)?></label>
                                            </div>
                                        </div>
                                    <?php 
                                            }
                                        } 
                                    ?> 
                                    
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-12">
                            <div class="card shadow mb-4 h-100">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Site Top Menu Management - Category</h6>                                    
                                </div>

                                 <div class="card-body">
                                    
                                    <?php foreach ($category as $key => $value) {                                        
                                    ?>
                                        <div class="form-row">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="category<?=$value->id?>" onclick="do_change_state_category(<?=$value->id?>, <?=$value->has_top_menu?>)" <?=($value->has_top_menu == 1)?'checked':''?>>
                                                <label class="form-check-label" for="category<?=$value->id?>"><?=ucwords($value->name)?></label>
                                            </div>
                                        </div>
                                    <?php                                             
                                        } 
                                    ?> 
                                    
                                </div>
                            </div>
                        </div>

                    </div>
                </form>
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
    .form-check-label{
        padding-top: 3px;
    }
    .form-check{
        display: block;
    }
    
</style>

