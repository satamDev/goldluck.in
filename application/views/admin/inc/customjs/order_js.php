<script type="text/javascript">
	function update_delivery_status(order_id, customer_id){
		$.ajax({
			type:'get',
			data:{'order_id':order_id, 'customer_id':customer_id},
			url: '<?=base_url()?>update_order_status',
			cache:false,
			success:function(response){
				console.log(response);
			}
		});
	}
</script>