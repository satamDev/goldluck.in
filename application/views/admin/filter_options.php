 <!-- Begin Page Content -->
    <div class="container-fluid">
            <div class="row">
                <!-- Product filter choose section -->
                <div class="col-xl-12 col-lg-12">
                    <div class="card shadow mb-4 h-100">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Product Filter Options</h6>                                    
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="sidbrdetailsbox">
                                <ul id="accordion">
                                    <div class="form-row">
                                        <div class="form-group col-md-10">
                                            <label for="inputFilterOptions">Choose Filter Options</label>
                                            <select id="inputFilterOptions" name="FilterOptions" class="form-control">
                                                <option value="0">Choose Filter Options</option>
                                                 <?php
                                                    foreach($filter_data as $key => $data){
                                                        echo "<option value='". $data ."'>" . ucwords($data) ."</option>";
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <br>
                                            <button type="button" id="add_btn" class="btn btn-success btn-block mt-2" disabled data-toggle="modal" data-target="#AddFilterOptionModel">Add New</button>
                                        </div>
                                    </div>


                                    <div class="table-responsive" id="table-filter">
                                        <table class="table table-bordered" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th width="85%">Name</th>
                                                    <th>Modifications</th>
                                                </tr>
                                            </thead>
                                            
                                            <tbody id="table_body">

                                            </tbody>
                                        </table>
                                    </div>
                                   
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>                
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
    td, th, .form-control{
        font-size: small;
    }
</style>


<!-- Add Filter Option Modal-->
<div class="modal fade" id="AddFilterOptionModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Filter Option In <span id="filter_menu_name" class="text-success text-capitalize"></span></h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">               
                    <div class="form-group">
                        <label for="filter_option-name" class="col-form-label">Option :</label>
                        <input type="text" class="form-control" id="filter_item" placeholder="Enter Option Name">
                    </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <button class="btn btn-primary" id="btn-filter-item-add" href="">Add</button>
            </div>
        </div>
    </div>
</div>

<!-- update Filter Option Modal-->
<div class="modal fade" id="updateFilterOptionModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Filter Option In <span id="filter_menu_name" class="text-success text-capitalize"></span></h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">               
                    <div class="form-group">
                        <label for="filter_option-name" class="col-form-label">Option :</label>
                        <input type="hidden" class="form-control" id="update_filter_option_id">
                        <input type="text" class="form-control" id="update_filter_option" placeholder="Enter Option Name">
                    </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <button class="btn btn-primary" id="btn-filter-item-update" href="#">Update</button>
            </div>
        </div>
    </div>
</div>
