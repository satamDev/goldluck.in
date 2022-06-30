<?php
defined("BASEPATH") or exit("No direct script access allowed");
?>
<script type="text/javascript">
    var toast = new Toasty(); 
    $(document).ready(function(){
        get_all_cart();
    });
    function get_all_cart(){
        $.ajax({
            url: "<?=base_url('cartItems')?>",
            type: "POST",
            success: function (response) {
                $("#cart_all").html(response);
            },
        });
    }


    function add_to_cart(userid, productid, name, original_price, discounted_price, qty){
        // if(userid == '0'){            
        //     toast.error("Please Login To Add Products In Cart");
        // }
        // else{
            $.ajax({
                url: "<?=base_url('addToCart')?>",
                type: "POST",
                data: {"userid": userid, "productid": productid, "name" : name, "original_price":original_price, "discounted_price": discounted_price, "quantity":qty},
                success: function (response) {
                    const data = JSON.parse(response);
                    if(data.msg == 1){
                        $("#cart_number").text(data.item);
                        // get_all_cart();
                        toast.success("Product Successfully Added To Cart");
                    }
                },
            });
        //}
    }

    function remove_single_product_cart(cart_row_id){
        let text = "Are you want to remove this product from your cart\nPress Ok to delete";
        if (confirm(text) == true) {
           $.ajax({
                url: "<?=base_url('removeSingleCart')?>",
                type: "POST",
                data: {"rowid": cart_row_id},
                success: function (response) {
                    const data = JSON.parse(response);
                    if(data.msg == 1){
                        $("#cart_number").text(data.item);
                        get_all_cart();
                        toast.success("Product Successfully Removed From Cart");
                    }
                },
            });        
        }
    }
         

    function increse_single_product_quantity_cart(cart_row_id, prev_qty){   
         $.ajax({
            url: "<?=base_url('increseSingleCart')?>",
            type: "POST",
            data: {"rowid": cart_row_id, "prev_qty" : prev_qty},
            success: function (response) {
                const data = JSON.parse(response);
                if(data.msg == 1){
                    $("#cart_number").text(data.item);
                    get_all_cart();
                    toast.success("Quantity Added To Your Cart");
                }
            },
        });
    }

    function decrese_single_product_quantity_cart(cart_row_id, prev_qty){   
        $.ajax({
            url: "<?=base_url('decreseSingleCart')?>",
            type: "POST",
            data: {"rowid": cart_row_id , "prev_qty" : prev_qty},
            success: function (response) {
                const data = JSON.parse(response);
                if(data.msg == 1){
                    $("#cart_number").text(data.item);
                    get_all_cart();
                    toast.success("Quantity Deleted From Your Cart");
                }
            },
        });
    }

    function clear_cart(){  
        $.ajax({
            url: "<?=base_url('clearCart')?>",
            type: "POST",
            success: function (response) {
                const data = JSON.parse(response);
                if(data.msg == 1){
                    $("#cart_number").text(data.item);
                    get_all_cart();
                    toast.success("All Items Removed From Cart");
                }
            },
        });
    }
</script>