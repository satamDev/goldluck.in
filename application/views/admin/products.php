<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// print_r($data);
?>

 			<!-- Begin Page Content -->
            <div class="container-fluid">
                <!-- Page Heading -->               
                    <div class="row">
                    	
                        <!-- Product Form -->
                        <div class="col-xl-12 col-lg-12">
                            <div class="card shadow mb-4 h-100">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Products</h6> 
                                </div>                                
                                <!-- Card Body -->
                                <div class="card-body" id="d">
                                	<!-- Start of Table div -->
                                	<div class="table-responsive">
		                                <table id="example1" class="display table" width="100%">
										    <thead>
										        <tr>
										            <th>Title</th>
										            <th>Product Code</th>
										            <th>SKU</th>
										            <th>Category</th>
										            <th>Sub Category</th>
										            <th>Price</th>
										            <th>Discount(%)</th>
										            <th>Quantity</th>
										            <th>Actions</th>
										        </tr>
										    </thead>
										</table>
		                            </div>
		                            <!-- End of Table div -->
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
	table{
		font-size: small;
	}
	.form-control{
		font-size: 10px;
	}
	a{
		cursor: pointer;
	}
</style>