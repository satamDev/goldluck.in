<?php
defined("BASEPATH") or exit("No direct script access allowed");
?>
<script type="text/javascript">
	    function do_change_state_page(page, value){
	        $.ajax({
	            url: "<?=base_url('admin/changeStatePage') ?>" ,
	            type: "POST",
	            data: {"page": page, "value": value},
	            success: function (response) {
	            	location.reload();
	            },
	        });
	    }
	    function do_change_state_category(category, value){
	        $.ajax({
	            url: "<?=base_url('admin/changeStateCategory') ?>" ,
	            type: "POST",
	            data: {"category": category, "value": value},
	            success: function (response) {
	            	location.reload();
	            },
	        });
	    }
</script>
