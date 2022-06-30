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
                                    <h6 class="m-0 font-weight-bold text-primary">Customers</h6>
                                    <p>Total Customers : <?=count($users)?></p> 
                                </div>                                
                                <!-- Card Body -->
                                <div class="card-body" id="d">
		                            <div class="table-responsive">
		                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
										    <thead>
										        <tr>
										            <th>Name</th>
										            <th>Registration Date</th>										            
										            <th>Contacts</th>
										            <th>Total Orders</th>									            
										        </tr>
										    </thead>
										    <tfoot>
		                                        <tr>
		                                            <th>Name</th>
										            <th>Registration Date</th>										            
										            <th>Contacts</th>
										            <th>Total Orders</th>
		                                        </tr>
		                                    </tfoot>
		                                    <tbody>
		                                    	<?php
		                                    	foreach ($users as $key => $value) {
		                                    		echo '<tr>
			                                            <td>'.$value['fname'].' '. $value['lname'].'</td>
			                                            <td>'.$value['registered_at'].'</td>          
			                                            <td>'.$value['email']. '<br>'.$value['phone'].'</td>
			                                            <td>'.$value['total_orders'].'</td>
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