<?php
	defined("BASEPATH") or exit("No direct script access allowed");
?>

<script type="text/javascript">
	function fetch_images(quick_request){			
		var alldata = {'quick_request' : quick_request}
		$.ajax({
            url: "<?=base_url('admin/fetch_quick_request_images') ?>" ,
            type: "POST",
            data: alldata,
            success: function (response) {            	
            	$("#quick_request_images").html('');
            	const data = JSON.parse(response);
            	
            	$.each(data, function(key,val) {
            		$("#quick_request_images").append('<a href="<?=base_url()?>'+ val.image_path +'" download><img class="img-fluid" style="width:23rem" src="<?=base_url()?>'+ val.image_path +'" ></a>');
		        })
            	$('#exampleModalCenter').modal('show');
            },
	    });		
	}
</script>