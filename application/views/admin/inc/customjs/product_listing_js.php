<?php
defined("BASEPATH") or exit("No direct script access allowed");
?>
<script type="text/javascript">

	$(document).ready(function(){
		loadDatatableAjax();
	});

	//function for loading products
	function loadDatatableAjax(){
		$('#example1').DataTable({
			"bDestroy" : true,
			"ajax" : "<?php echo base_url('admin/fetchProducts'); ?>",
			"initComplete" : function(){
				var notApplyFilterOnColumn = [0,1,2,5,8];
				var inputFilterOnColumn = [0];
				var showFilterBox = 'afterHeading'; //beforeHeading, afterHeading
				$('.gtp-dt-filter-row').remove();
				var theadSecondRow = '<tr class="gtp-dt-filter-row">';
				$(this).find('thead tr th').each(function(index){
					theadSecondRow += '<td class="gtp-dt-select-filter-' + index + '"></td>';
				});
				theadSecondRow += '</tr>';

				if(showFilterBox === 'beforeHeading'){
					$(this).find('thead').prepend(theadSecondRow);
				}else if(showFilterBox === 'afterHeading'){
					$(theadSecondRow).insertAfter($(this).find('thead tr'));
				}

				this.api().columns().every( function (index) {
					var column = this;

					if(inputFilterOnColumn.indexOf(index) >= 0 && notApplyFilterOnColumn.indexOf(index) < 0){
						$('td.gtp-dt-select-filter-' + index).html('<input type="text" class="gtp-dt-input-filter form-control">');
		                $( 'td input.gtp-dt-input-filter').on( 'keyup change clear', function () {
		                    if ( column.search() !== this.value ) {
		                        column
		                            .search( this.value )
		                            .draw();
		                    }
		                } );
					}else if(notApplyFilterOnColumn.indexOf(index) < 0){
						var select = $('<select class="form-control"><option value="">Select</option></select>')
		                    .on( 'change', function () {
		                        var val = $.fn.dataTable.util.escapeRegex(
		                            $(this).val()
		                        );
		 
		                        column
		                            .search( val ? '^'+val+'$' : '', true, false )
		                            .draw();
		                    } );
		                $('td.gtp-dt-select-filter-' + index).html(select);
		                column.data().unique().sort().each( function ( d, j ) {
		                    select.append( '<option value="'+d+'">'+d+'</option>' )
		                } );
					}
				});
			}
		});
	}

</script>
