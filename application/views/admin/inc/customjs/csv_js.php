<script>
$(document).ready(function(){

    $('#import_csv').on('submit', function(event){
        event.preventDefault();
        $.ajax({
            url:"<?php echo base_url(); ?>admin/import",
            method:"POST",
            data:new FormData(this),
            contentType:false,
            cache:false,
            processData:false,
            beforeSend:function(){
                $('#import_csv_btn').html('Importing...');
            },
            success:function(data)
            {
                $('#import_csv')[0].reset();
                $('#import_csv_btn').attr('disabled', false);
                $('#import_csv_btn').html('Import Done');
                
                $('#imported_csv_data').html(data);
            }
        })
    });
 
});
</script>