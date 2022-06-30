<?php
	defined("BASEPATH") or exit("No direct script access allowed");
?>

<script type="text/javascript">
	function do_delete(item){
		let delete_conformation = confirm("Are you want to delete this item?");
		if(delete_conformation){			
			var alldata = {'model' : item, 'purpose' : 'delete'}
			$.ajax({
	            url: "<?=base_url('admin/action_banner') ?>" ,
	            type: "POST",
	            data: alldata,
	            success: function (response) {
	            	console.log(response);
	                if(response == 1){
	                	location.reload();            	
	                }else{
	                	alert('Data Deletion Failed');
	                }
	            },
		    });
		}else{

		}
	}
</script>