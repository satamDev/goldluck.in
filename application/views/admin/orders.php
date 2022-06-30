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
                                    <h6 class="m-0 font-weight-bold text-primary">Orders</h6>
                                    <p>Total Order : <?=count($orders)?></p> 
                                </div>                                
                                <!-- Card Body -->
                                <div class="card-body" id="d">
		                            <div class="table-responsive">
		                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
										    <thead>
										        <tr>
										            <th>OrderID</th>
										            <th>Date</th>
										            <th>Customer Name</th>
										            <th>Contacts</th>										            
										            <th>Grand Total</th>
										            <th>Payment Status</th>
										            <th>Order Status</th>										            
										        </tr>
										    </thead>
										    <tfoot>
		                                        <tr>
		                                            <th>OrderID</th>
										            <th>Date</th>
										            <th>Customer Name</th>
										            <th>Contacts</th>										            
										            <th>Grand Total</th>
										            <th>Payment Status</th>
										            <th>Order Status</th>
		                                        </tr>
		                                    </tfoot>
		                                    <tbody>
		                                    	<?php
		                                    	/*
		                                    	echo "<pre>";
		                                    	print_r($orders);
		                                    	echo "</pre>";*/
		                                    	foreach ($orders as $key => $value) {
		                                    		$payment_class = "danger";
		                                    		$payment_text = "Pending";
		                                    		if($value['payment_status'] == 1){
		                                    			$payment_class = "success";
		                                    			$payment_text = "Paid";
		                                    		}
		                                    		echo '<tr>
			                                            <td>'.$value['uid'].'</td>
			                                            <td>'.$value['created_at'].'</td>
			                                            <td>'.$value['fname']. ' '. $value['lname'] .'</td>
			                                            <td>'.$value['email']. '<br>'.$value['phone'].'</td>
			                                            <td>'.$value['grand_total'].'</td>
			                                            <td><span class="badge badge-'.$payment_class.'">'.$payment_text.'</span></td>
			                                            <td>
			                                            	<select class="form-control" onchange="update_delivery_status(\''.$value['uid'].'\',\''.$value['userid'].'\')">
			                                            		<option value="p">Processing</option>
			                                            		<option value="s">Shipping</option>
			                                            		<option value="d">Delivered</option>
			                                            	</select>
			                                            </td>
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