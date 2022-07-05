<?php
defined("BASEPATH") or exit("No direct script access allowed");
?>
<script type="text/javascript">
    $(document).ready(function(){
        $("#load_more").hide();
        get_all_products();
    });

    var product_count = 0;

    function get_all_products(){        
        let page_no = $("#pageNo").val();
        
        let data_all = {
            'page_no':page_no,
            'category' : $("#category").val(),
            'sub_category' : $("#sub-category").val(),
            'shortby' : $("#shortby").val(),
        }

        $.ajax({
            url: "<?=base_url('products_all')?>",
            type: "GET",
            data: data_all,
            success: function (response) {
                // console.log(response);

                var data = JSON.parse(response);
                // console.log(data);
                let color = "";
                $.each(data.results, function (i) {
                    if(data.results[i].wishlist == 1) color = 'red';
                    $('#products_listing').append('<div class="col-md-4 col-lg-3 mt-3 text-center">'+
                            '<div class="ProductBox">'+
                                '<a href="'+data.results[i].productDetailsUrl+'">'+
                                    '<div>'+
                                        '<img src="'+data.results[i].cover_image+'" alt="" style="width: 100%;height:100%;min-height: 255px;">'+
                                    '</div>'+
                                '</a>'+
                                '<div class="wishlist">'+
                                    '<span onclick="add_to_wishlist(\''+data.results[i].userId+'\',\''+data.results[i].product_id+'\', \''+data.results[i].wishlist+'\')"><i class="fas fa-heart" style="color: '+color+'"></i></span>'+
                                '</div>'+

                                '<div class="ProductButton">'+
                                    '<span class="pcart" onclick="add_to_cart(\''+data.results[i].userId+'\',\''+data.results[i].product_id+'\',\''+data.results[i].title+'\', \''+data.results[i].price+'\',  \''+data.results[i].discounted_price+'\', 1)">'+
                                        '<i class="fas fa-shopping-cart"></i>'+
                                    '</span>'+
                                    '<a class="pview" href="'+data.results[i].productDetailsUrl+'">'+
                                        '<i class="fas fa-eye"></i>'+
                                    '</a>'+
                                '</div>'+        
                            '</div>'+
                            '<a href="'+data.results[i].productDetailsUrl+'"> <div class="product-title">'+data.results[i].title+'</div></a>'+
                            '<div class="product-price">&#x20b9; '+data.results[i].discounted_price+'</div>'+
                        '</div>');
                    product_count++;
                    $("#pageNo").val(Number(page_no)+1);
                });

                // console.log(data.totalCount + " - " + product_count);
                if( data.totalCount != product_count){
                    $("#load_more").show();
                }else{
                    $("#load_more").hide();
                }
            },
        });
    }
</script>