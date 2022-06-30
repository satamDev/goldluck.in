<?php
defined("BASEPATH") or exit("No direct script access allowed");
?>

<script type="text/javascript">
	$(document).ready(function(){
		var filter = "";
		$("#table-filter").show();
		$('#inputFilterOptions').on("change",function () {
	        filter = $(this).find('option:selected').val();
	        $("#filter_menu_name").html(filter);
	        if(filter == 0){
	        	$("#add_btn").attr('disabled', true);
	        	alert('choose filter option first');
	        }else{
		        $.ajax({
		            url: "<?=base_url('admin/getFilterMenuOptions') ?>" ,
		            type: "POST",
		            data: "filter_menu_name=" + filter,
		            success: function (response) {
		            	$("#table-filter").show();
		                $("#table_body").html(response);
		                $("#add_btn").removeAttr('disabled');
		            },
		        });
		    }
	    });

	    $('#btn-filter-item-add').click(function() {
			var filter_name = filter;
			var item_value = $("#filter_item").val();
			var alldata = {'filter_name' : filter_name, 'item_value' : item_value}
			if(item_value === ""){
				alert('Give Data Here');
			}else{
				$.ajax({
		            url: "<?=base_url('admin/setFilterMenuOptions') ?>" ,
		            type: "POST",
		            data: alldata,
		            success: function (response) {	            	
		                // console.log(response);
		                if(response == 1){
		                	alert('Data Successfully Inserted');
		                	$("#table-filter").hide();
		                	$('#AddFilterOptionModel').modal('hide');
		                	$('select[id^="inputFilterOptions"] option[value="0"]').attr("selected","selected");
		                }else{
		                	alert('Data Insertion Failed');
		                }
		            },
			    });
			}
	    });

	    $('#btn-filter-item-update').click(function() {
			var filter_name = filter;

			var item = $("#update_filter_option_id").val();
			var item_value = $("#update_filter_option").val();

			var alldata = {'filter_name' : filter_name,'item' : item, 'item_value' : item_value}

			if(item_value === ""){
				alert('Give Data Here');
			}else{
				$.ajax({
		            url: "<?=base_url('admin/updateFilterMenuOptions') ?>" ,
		            type: "POST",
		            data: alldata,
		            success: function (response) {
		                if(response == 1){
		                	$('select[id^="inputFilterOptions"] option[value="0"]').attr("selected","selected");
		                	alert('Data Successfully Updated');
		                	$("#table-filter").hide();
		                	$('#updateFilterOptionModel').modal('hide');		                	
		                }else{
		                	alert('Data Updatation Failed');
		                }
		            },
			    });
			}
	    });

	});



	function do_delete(item){
		let delete_conformation = confirm("Are you want to delete this item?");
		if(delete_conformation){

			var filter_option = $("#filter_menu_name").text();
			var alldata = {'filter_option' : filter_option, 'item' : item}
			$.ajax({
	            url: "<?=base_url('admin/deleteFilterMenuOptions') ?>" ,
	            type: "POST",
	            data: alldata,
	            success: function (response) {
	                if(response == 1){
	                	alert('Data Successfully Deleted');
	                	$("#table-filter").hide();
	                	$('select[id^="inputFilterOptions"] option[value="0"]').attr("selected","selected");
	                }else{
	                	alert('Data Deletion Failed');
	                }
	            },
		    });
		}else{

		}
	}


	function do_edit(item, name){
		$("#update_filter_option").val(name);
		$("#update_filter_option_id").val(item);
		$('#updateFilterOptionModel').modal('show');
	}	
	
</script>