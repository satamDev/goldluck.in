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
                                    <h6 class="m-0 font-weight-bold text-primary">Mail Management</h6>
                                </div>                                
                                <!-- Card Body -->
                                <div class="card-body">
		                            <div class="accordion" id="accordionExample">
		                            	<?php
		                            		$i = 1;
		                            		foreach ($mail_management as $key => $value) {
		                            			echo '<div class="card">
													    <div class="card-header" id="heading">
													      <h2 class="mb-0">
													        <button class="btn btn-link btn-block text-left btn-collapse" type="button" data-toggle="collapse" data-target="#collapseOne'.$i.'" aria-expanded="false" aria-controls="collapseOne'.$i.'">
													          '.ucwords($value['name']).'
													        </button>
													      </h2>
													    </div>

													    <div id="collapseOne'.$i.'" class="collapse " aria-labelledby="heading" data-parent="#accordionExample">
													      	<div class="card-body">';													
															$mail_for = explode(',', $value['mail_for']);
															$j = 1;
															foreach($mail_for as $mail_for_key => $mail_for_value){
																if($j == 1)
																	echo '<button type="button" onclick="fetch_mail_content(\''.$value['uid'].'\',\''.$mail_for_value.'\')" class="btn btn-outline-primary pl-5 pr-5">'.ucwords($mail_for_value).'</button>';
																else
																	echo '<button type="button" onclick="fetch_mail_content(\''.$value['uid'].'\',\''.$mail_for_value.'\')" class="btn btn-outline-primary ml-5 pl-5 pr-5">'.ucwords($mail_for_value).'</button>';
																$j++;
															}
													    echo '</div>
													    </div>
													  </div>';
												$i++;
		                            		}
		                            	?>
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
	.btn-collapse{
		text-decoration: none !important;
	}
	.ck-file-dialog-button{
		display: none;
	}
</style>

<script src="<?=base_url()?>assets/css/ckeditor.css"></script>
<script src="<?=base_url()?>assets/js/ckeditor.js"></script>
<script>
    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .then(editor => {window.editor = editor})
        .catch( error => {
            console.error( error );
        } );
</script>
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="mail_modal">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Mail Management</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
		  <div class="form-group">
		    <label for="">Mail Subject</label>
		    <input type="text"
		    id="mail_subject" class="form-control" placeholder="Enter Mail Subject">
		  </div>
		  <div class="form-group">
		    <label for="exampleInputPassword1">Mail Content</label>
		        <textarea name="content" id="editor"></textarea>
			    
		  </div>
		</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
