<?php
defined("BASEPATH") or exit("No direct script access allowed");
?>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script type="text/javascript">
    var toast = new Toasty(); 
    $(document).ready(function(){
        $(".loaderbg").hide();
    });
    function setOrder() {
        if( $("#agree").is(':checked') ){
            $(".loaderbg").show();
            $.ajax({
                url: "<?=base_url('placeOrder')?>",
                type: "POST",
                success: function (response) {
                    const response_data = JSON.parse(response);
                    if(response_data.msg == 'success'){
                        //pass request to payment getway
                        // toast.success('All good');
                        $("#razorpay-form").attr("action", response_data.data.callback_url)
                        $("#merchant_order_id").val(response_data.data.merchant_order_id);
                        $("#merchant_trans_id").val(response_data.data.txnid);
                        $("#merchant_product_info_id").val(response_data.data.description);
                        $("#merchant_surl_id").val(response_data.data.surl);
                        $("#merchant_furl_id").val(response_data.data.furl);
                        $("#card_holder_name_id").val(response_data.data.card_holder_name);
                        $("#merchant_total").val(response_data.data.total);
                        $("#merchant_amount").val(response_data.data.amount);
                        $(".loaderbg").hide();

                        var options = {
                            key:            response_data.data.key_id,
                            amount:         response_data.data.total,
                            name:           response_data.data.name,
                            description:    response_data.data.merchant_order_id,
                            netbanking:     true,
                            currency:       response_data.data.currency_code,
                            prefill: {
                                name:       response_data.data.name,
                                email:      response_data.data.email,
                                contact:    response_data.data.phone,
                            },
                            notes: {
                                soolegal_order_id: response_data.data.merchant_order_id,
                            },
                            handler: function (transaction) {
                                console.log(transaction);
                                document.getElementById('razorpay_payment_id').value = transaction.razorpay_payment_id;
                                document.getElementById('razorpay-form').submit();
                            },
                            "modal": {
                                "ondismiss": function(){
                                    location.reload()
                                }
                            }
                        };
                        if(typeof Razorpay == 'undefined') {
                            toast.error('Please Try After Sometime...');
                        }else{
                            var instance = new Razorpay(options);
                            instance.open();
                        }
                    }else{
                        toast.error('Something Went Wrong, Please Try After Some Time');
                    }
                },
            });
        }else{
            toast.error('Please Agree Terms And Conditions');
        }
    }
</script>