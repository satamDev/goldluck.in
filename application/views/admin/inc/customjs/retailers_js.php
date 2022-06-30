<?php
	defined("BASEPATH") or exit("No direct script access allowed");
?>

<script type="text/javascript">

	function change_retailer_status(retailer_id, v){
		$.ajax({
            url: "<?=base_url('admin/update_retailer_status') ?>" ,
            type: "POST",
            data:{'retailer_id' : retailer_id, 'status' : v.value},
            success: function (response) { 
            	// console.log(response);
            	// location.reload();
            },
	    });		
	}
</script>