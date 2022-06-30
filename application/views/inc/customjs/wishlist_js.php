<?php
defined("BASEPATH") or exit("No direct script access allowed");
?>
<script type="text/javascript">
    var toast = new Toasty(); 

    $(document).ready(function(){
        get_all_wishlist();
    });

    function get_all_wishlist(){
        $.ajax({
            url: "<?=base_url('wishlistItems')?>",
            type: "POST",
            success: function (response) {
                $("#wishlist_all").html(response);
                // console.log(response);
            },
        });
    }

    function add_to_wishlist(user, product, parameter){ //parameter = 1 for remove from wishlist 
        if(parameter == 1){
            remove_from_wishlist(user, product);
            location.reload();
        }else if(parameter == 0){
            if(user == '0'){            
                toast.error("Please Login To Add Products In Wishlist");
            }else{
                 $.ajax({
                    url: "<?=base_url('addToWishlist')?>",
                    type: "POST",
                    data: {"user": user, "product": product},
                    success: function (response) {
                        const data = JSON.parse(response);
                        if(data.code == 1){  
                            toast.success(data.msg);
                            location.reload();
                        }else{
                            toast.error(data.msg);
                        }
                    },
                });
            }
        }
    }

    function remove_from_wishlist(user, product){
        let text = "Are you want to remove this product from your wishlist\nPress Ok to delete";
        if (confirm(text) == true) {
           $.ajax({
                url: "<?=base_url('removeSingleWishlist')?>",
                type: "POST",
                data: {"user": user, "product" : product},
                success: function (response) {
                    const data = JSON.parse(response);
                    if(data.code == 1){
                        get_all_wishlist();
                        toast.success(data.msg);
                    }else{
                        toast.error(data.msg);
                    }
                },
            });        
        }
    }



</script>