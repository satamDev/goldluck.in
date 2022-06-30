<script type="text/javascript">
	$(document).ready(function(){
		$('.loaderbg').hide();
	});
	var toast = new Toasty(); 
	$(function() {		
		var frm = $('#frm');
      	frm.submit(function (e) {
      		e.preventDefault();
      		$('.loaderbg').show();
			var data = new FormData(this);
			// console.log(data);
			$.ajax({
				type: frm.attr('method'),
            	url: frm.attr('action'),
				data: data,
				processData:false,
				contentType:false,
				cache:false,
				async:true,
				success: function(response){
					const data = JSON.parse(response);
					if(data.msg == 1){
						//loader hide
						$('.loaderbg').hide();
						toast.success('Your Request Successfuly Sent...', 10000);
						$('#QuickRequest').modal('hide');
					}else{
						//error in uploading
						$('.loaderbg').hide();
						toast.error('Please Try After Sometime...', 10000);
						$('#QuickRequest').modal('hide');
					}
				}
			});
      	});
    });
</script>