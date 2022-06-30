<?php
defined("BASEPATH") or exit("No direct script access allowed");
?>
<script type="text/javascript">
    var toast = new Toasty(); 
    $(document).ready(function(){
        get_orders();

        $('#order-years').on('change', function() {
            var option_value = this.value;
            if(option_value != '0'){
                get_orders(option_value);
            }
        }); 
    });

    function get_orders(year = ""){
        if(year == ""){
            data = {"year": year}
        }else{
            data = {"year": year}
        }
    	$.ajax({
            url: "<?=base_url('getOrders')?>",
            data : data,
            type: "POST",
            success: function (response) {
            	$(".orders_all").html(response);
            }
        });
    }

    



</script>