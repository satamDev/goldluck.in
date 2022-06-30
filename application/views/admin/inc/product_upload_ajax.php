<script type="text/javascript">

	$(function() {
		var frm = $('#frm');
      	frm.submit(function (e) {
      		e.preventDefault();
      		$('.loaderbg').show();
			var data = new FormData(this);
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
					// console.log(data.msg);
					if(data.msg == 1){
						//loader hide
						$('.loaderbg').hide();
						alert('Product Successfuly Uploaded');
					}else{
						//error in uploading
					}
				}
			});
      	});
    });

    $(document).ready(function(){
    	///////////////////////////////////////////////
    	$('.input-images').imageUploader();//for image drag and drop plugin
    	///////////////////////////////////////////////
    	$('.loaderbg').hide();

	    $('#inputCategory').on("change",function () {
	        var categoryId = $(this).find('option:selected').val();
	        if(categoryId === 0) alert('Select Category');
	        else{
		        $.ajax({
		            url: "<?=base_url('index.php/admin/getSubCategory') ?>" ,
		            type: "POST",
		            data: "categoryId=" + categoryId,
		            success: function (response) {
		                // console.log(response);
		                $("#inputSubCategory").html(response);
		            },
		        });
		    }
	    }); 
	});



</script>