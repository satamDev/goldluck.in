<script type="text/javascript">
	function fetch_mail_content(mail_management_id, mail_for){
		// console.log(mail_management_id + ' ' + mail_for);
		alldata = {'mail_management_id': mail_management_id, 'mail_for':mail_for}; 
		$.ajax({
            url: "<?=base_url('admin/getMailContent') ?>" ,
            type: "POST",
            data: alldata,
            success: function (response) {
            	const data = JSON.parse(response);            	
            	if(data.subject == "" && data.message == ""){
            		$("#mail_subject").val("");            	
	            	editor.data.set("");
            		$('#mail_modal').modal('show')
            	}else{
	            	$("#mail_subject").val(data.subject);            	
	            	editor.data.set(data.message);
	            	$('#mail_modal').modal('show')
	            }
            },
	    });
	}
</script>
