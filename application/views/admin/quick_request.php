<?php
defined('BASEPATH') OR exit('No direct script access allowed');
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
                                    <h6 class="m-0 font-weight-bold text-primary">Quick Requests</h6> 
                                </div>                                
                                <!-- Card Body -->
                                <div class="card-body" id="d">
                                	<?php //echo "<pre>"; print_r($quick_request); echo "</pre>";?>
                                	<!-- Start of Table div -->
                                	<!-- <div class="card-body"> -->
		                            <div class="table-responsive">
		                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
										    <thead>
										        <tr>
										            <th>Name</th>
										            <th>Phone</th>
										            <th>Email</th>
										            <th>Gross Weight</th>
										            <th>Quality</th>
										            <th>Message</th>
										            <th>View Images</th>										            
										        </tr>
										    </thead>
										    <tfoot>
		                                        <tr>
		                                            <th>Name</th>
										            <th>Phone</th>
										            <th>Email</th>
										            <th>Gross Weight</th>
										            <th>Quality</th>
										            <th>Message</th>
										            <th>View Images</th>
		                                        </tr>
		                                    </tfoot>
		                                    <tbody>
		                                    	<?php
		                                    	foreach ($quick_request as $key => $value) {
		                                    		echo '<tr>
			                                            <td>'.$value['first_name']. ' '. $value['last_name'] .'</td>
			                                            <td>'.$value['phone'].'</td>
			                                            <td>'.$value['email'].'</td>
			                                            <td>'.$value['gross_weight'].'</td>
			                                            <td>'.$value['quality'].'</td>
			                                            <td>'.$value['messages'].'</td>
			                                            <td><button class="btn btn-sm btn-outline-success" onclick="fetch_images(\''.$value['uid'].'\')">Show Images</button></td>
			                                        </tr>';
		                                    	}
		                                    	?>
		                                    </tbody>
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

<div class="modal fade bd-example-modal-lg" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Images</h5>
        <p class="text-primary pt-1">(Click on a image to download)</p>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="quick_request_images">
        
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> -->
    </div>
  </div>
</div>