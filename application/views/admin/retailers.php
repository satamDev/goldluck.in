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
                                    <h6 class="m-0 font-weight-bold text-primary">Retailers</h6> 
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
										            <th>Store Name</th>
										            <th>GST No</th>
										            <th>Status</th>									            
										        </tr>
										    </thead>
										    <tfoot>
		                                        <tr>
		                                            <th>Name</th>
										            <th>Phone</th>
										            <th>Email</th>
										            <th>Store Name</th>
										            <th>GST No</th>
										            <th>Status</th>
		                                        </tr>
		                                    </tfoot>
		                                    <tbody>
		                                    	<?php
		                                    	foreach ($retailers as $key => $value) {
		                                    		?>
		                                    		<tr>
			                                            <td><?=$value['first_name']?> <?=$value['last_name']?></td>
			                                            <td><?=$value['phone']?></td>
			                                            <td><?=$value['email']?></td>
			                                            <td><?=$value['store_name']?></td>
			                                            <td><?=$value['gst_no']?></td>
			                                            <td>
			                                            	<select class="form-control" onchange="change_retailer_status('<?=$value["uid"]?>', this)">
			                                            		<option value="0" <?=($value['status'] == 0)?'selected':''?>>Not Approved</option>
			                                            		<option value="1" <?=($value['status'] == 1)?'selected':''?>>Approved</option>
			                                            	</select>
			                                            </td>	             
			                                        </tr>
			                                        <?php
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