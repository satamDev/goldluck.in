<?php
defined("BASEPATH") or exit("No direct script access allowed");
?>
<script type="text/javascript">
    $(document).ready(function(){
        $('#shortby_form select').on('change', function(){
            var val = $("#shortby").val();
            $('#shortby_form').attr('action', '<?=current_url()?>shortby='.val);
            console.log(val);
            $(this).closest('form').submit();
        });
    });
</script>