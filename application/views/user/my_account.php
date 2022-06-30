<?php 
    $fname = $this->session->userdata('fname');
    $lname = $this->session->userdata('lname');
    $full_name = $fname . " " . $lname;
    $addressId = $this->session->userdata('addressId');
    
?>
 <?php                   
    $error = $this->session->flashdata('error');
    if($error){
?>
    <div class="alert alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <?php echo $error; ?>                    
    </div>
<?php 
    }
    $success = $this->session->flashdata('success');
    if($success){
?>
    <div class="alert alert-success alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <?php echo $success; ?>                    
    </div>
<?php
    } 
?>
<section class="py-5 mb-md-5">
    <div class="container">
        <div class="tab">
            <button class="tablinks active" onclick="openCity(event, 'Dashboard1')" id="defaultOpen">Dashboard</button>
            <button class="tablinks" onclick="openCity(event, 'Orders1')">Orders</button>
            <button class="tablinks" onclick="openCity(event, 'Downloads1')">Downloads</button>
            <button class="tablinks" onclick="openCity(event, 'Addresses1')">Addresses</button>
            <button class="tablinks" onclick="openCity(event, 'AccountDetails1')">Account Details</button>
        </div>

        <div id="Dashboard1" class="tabcontent AccountBox" style="display: block;">
            <div class="AccountTitle">Dashboard</div>
            <p>From your account dashboard you can view your recent orders, manage your shipping and billing addresses, and edit your password and account details. </p>
        </div>

        <div id="Orders1" class="tabcontent AccountBox" style="display: block;">
            <div class="d-flex align-items-center mb-3">
                <div class="AccountTitle mb-0 mr-2">Order placed in</div>        
                <form>
                <select class="form-control pr-5" name="years" id="order-years" style="cursor: pointer;">
                    <option value="0">Choose Year</option>
                    <option value="<?=date("Y",strtotime("now"))?>"><?=date("Y",strtotime("now"))?></option>
                    <option value="<?=date("Y",strtotime("-1 year"))?>"><?=date("Y",strtotime("-1 year"))?></option>
                    <option value="<?=date("Y",strtotime("-2 year"))?>"><?=date("Y",strtotime("-2 year"))?></option>
                    <option value="<?=date("Y",strtotime("-3 year"))?>"><?=date("Y",strtotime("-3 year"))?></option>
                    <option value="<?=date("Y",strtotime("-4 year"))?>"><?=date("Y",strtotime("-4 year"))?></option>
                </select>
                </form>
            </div>
           
             
            <div class="border orders_all">
                <!-- all orders view here -->
            </div>
        </div>

        <div id="Downloads1" class="tabcontent AccountBox" style="display: block;">
            <div class="AccountTitle">Downloads</div>
                <p>No order has been made yet.</p>
                <div ><a href="#"><u>Browse products</u></a></div>
        </div>
        <div id="Addresses1" class="tabcontent AccountBox" style="display: block;">
            <div class="AccountTitle">Addresses <?=($addressId=="0")?'<span class="text-danger">(Please Submit Your Complete Address)</span>':''?></div>
            
            <p>The following addresses will be used on the checkout page by default. </p>
            <div class="CheckoutBox">
                <h5 class="mb-3">Edit Billing Details</h5>
                <form action="updateAddress" id="address_form" method="post">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Address <span>*</span> </label>
                                <input type="text" name="address" class="form-control" placeholder="House number and street name" required value="<?=($addressId != "0")? $address[0]['address'] :''?>">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>State <span>*</span> </label>
                                <!--- India states -->
                                <select id="country-state" class="form-control" name="state">
                                    <option value="AN" <?=($addressId != "0")? ($address[0]['state'] == 'AN')? 'selected': '' :''?>>Andaman and Nicobar Islands</option>
                                    <option value="AP" <?=($addressId != "0")? ($address[0]['state'] == 'AP')? 'selected': '' :''?>>Andhra Pradesh</option>
                                    <option value="AR" <?=($addressId != "0")? ($address[0]['state'] == 'AR')? 'selected': '' :''?>>Arunachal Pradesh</option>
                                    <option value="AS" <?=($addressId != "0")? ($address[0]['state'] == 'AS')? 'selected': '' :''?>>Assam</option>
                                    <option value="BR" <?=($addressId != "0")? ($address[0]['state'] == 'BR')? 'selected': '' :''?>>Bihar</option>
                                    <option value="CH" <?=($addressId != "0")? ($address[0]['state'] == 'CH')? 'selected': '' :''?>>Chandigarh</option>
                                    <option value="CT" <?=($addressId != "0")? ($address[0]['state'] == 'CT')? 'selected': '' :''?>>Chhattisgarh</option>
                                    <option value="DN" <?=($addressId != "0")? ($address[0]['state'] == 'DN')? 'selected': '' :''?>>Dadra and Nagar Haveli</option>
                                    <option value="DD" <?=($addressId != "0")? ($address[0]['state'] == 'DD')? 'selected': '' :''?>>Daman and Diu</option>
                                    <option value="DL" <?=($addressId != "0")? ($address[0]['state'] == 'DL')? 'selected': '' :''?>>Delhi</option>
                                    <option value="GA" <?=($addressId != "0")? ($address[0]['state'] == 'GA')? 'selected': '' :''?>>Goa</option>
                                    <option value="GJ" <?=($addressId != "0")? ($address[0]['state'] == 'GJ')? 'selected': '' :''?>>Gujarat</option>
                                    <option value="HR" <?=($addressId != "0")? ($address[0]['state'] == 'HR')? 'selected': '' :''?>>Haryana</option>
                                    <option value="HP" <?=($addressId != "0")? ($address[0]['state'] == 'HP')? 'selected': '' :''?>>Himachal Pradesh</option>
                                    <option value="JK" <?=($addressId != "0")? ($address[0]['state'] == 'JK')? 'selected': '' :''?>>Jammu and Kashmir</option>
                                    <option value="JH" <?=($addressId != "0")? ($address[0]['state'] == 'JH')? 'selected': '' :''?>>Jharkhand</option>
                                    <option value="KA" <?=($addressId != "0")? ($address[0]['state'] == 'KA')? 'selected': '' :''?>>Karnataka</option>
                                    <option value="KL" <?=($addressId != "0")? ($address[0]['state'] == 'KL')? 'selected': '' :''?>>Kerala</option>
                                    <option value="LA" <?=($addressId != "0")? ($address[0]['state'] == 'LA')? 'selected': '' :''?>>Ladakh</option>
                                    <option value="LD" <?=($addressId != "0")? ($address[0]['state'] == 'LD')? 'selected': '' :''?>>Lakshadweep</option>
                                    <option value="MP" <?=($addressId != "0")? ($address[0]['state'] == 'MP')? 'selected': '' :''?>>Madhya Pradesh</option>
                                    <option value="MH" <?=($addressId != "0")? ($address[0]['state'] == 'MH')? 'selected': '' :''?>>Maharashtra</option>
                                    <option value="MN" <?=($addressId != "0")? ($address[0]['state'] == 'MN')? 'selected': '' :''?>>Manipur</option>
                                    <option value="ML" <?=($addressId != "0")? ($address[0]['state'] == 'ML')? 'selected': '' :''?>>Meghalaya</option>
                                    <option value="MZ" <?=($addressId != "0")? ($address[0]['state'] == 'MZ')? 'selected': '' :''?>>Mizoram</option>
                                    <option value="NL" <?=($addressId != "0")? ($address[0]['state'] == 'NL')? 'selected': '' :''?>>Nagaland</option>
                                    <option value="OR" <?=($addressId != "0")? ($address[0]['state'] == 'OR')? 'selected': '' :''?>>Odisha</option>
                                    <option value="PY" <?=($addressId != "0")? ($address[0]['state'] == 'PY')? 'selected': '' :''?>>Puducherry</option>
                                    <option value="PB" <?=($addressId != "0")? ($address[0]['state'] == 'PB')? 'selected': '' :''?>>Punjab</option>
                                    <option value="RJ" <?=($addressId != "0")? ($address[0]['state'] == 'RJ')? 'selected': '' :''?>>Rajasthan</option>
                                    <option value="SK" <?=($addressId != "0")? ($address[0]['state'] == 'SK')? 'selected': '' :''?>>Sikkim</option>
                                    <option value="TN" <?=($addressId != "0")? ($address[0]['state'] == 'TN')? 'selected': '' :''?>>Tamil Nadu</option>
                                    <option value="TG" <?=($addressId != "0")? ($address[0]['state'] == 'TG')? 'selected': '' :''?>>Telangana</option>
                                    <option value="TR" <?=($addressId != "0")? ($address[0]['state'] == 'TR')? 'selected': '' :''?>>Tripura</option>
                                    <option value="UP" <?=($addressId != "0")? ($address[0]['state'] == 'UP')? 'selected': '' :''?>>Uttar Pradesh</option>
                                    <option value="UT" <?=($addressId != "0")? ($address[0]['state'] == 'UT')? 'selected': '' :''?>>Uttarakhand</option>
                                    <option value="WB" <?=($addressId != "0")? ($address[0]['state'] == 'WB')? 'selected': '' :''?>>West Bengal</option>
                                </select>                        
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Pincode <span>*</span> </label>
                                <input type="text" name="pincode" class="form-control" required value="<?=($addressId != "0")? $address[0]['pincode'] :''?>">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Order notes (optional) </label>
                                <textarea class="form-control" name="order_notes" rows="4" placeholder="Notes about your order, e.g. special notes for delivery." required><?=($addressId != "0")? $address[0]['address_note'] :''?></textarea>                     
                            </div>
                        </div>

                        <div class="col-md-12 text-centert">
                            <div class="form-group">
                                <input type="submit" class="btn1 w-100" value="Save Changes">                 
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div id="AccountDetails1" class="tabcontent AccountBox" style="display: block;">
            <div class="AccountTitle">Account Details</div>
                <div>
                <div class="CheckoutBox">
                    <h5 class="mb-3">Edit Profile  Details</h5>
                    <form action="#">
                        <div class="row">
                            <div class="col-md-6 ">
                                <div class="form-group">
                                    <label>First name <span>*</span> </label>
                                    <input type="text" class="form-control" placeholder="First Name" value="<?=$fname?>">                           
                                </div>
                            </div>

                            <div class="col-md-6 ">
                                <div class="form-group">
                                   <label>Last name <span>*</span> </label>
                                   <input type="text" class="form-control" id="" placeholder="Last Name" value="<?=$lname?>">
                                </div>
                            </div>

                            <div class="col-md-6 ">
                                <div class="form-group">
                                   <label>Display name <span>*</span> </label>
                                   <input type="text" class="form-control" placeholder="Display Name" value="<?=$full_name?>"><small>This will be how your name will be displayed in the account section and in reviews
                                </small>                           
                             </div>
                            </div>

                            <div class="col-md-6 ">
                                <div class="form-group">
                                   <label>Email Address</label>
                                   <span class="form-control"><?=$email?></span>                    
                             </div>
                            </div>

                            <div class="col-md-6 ">
                                <div class="form-group">
                                   <label>Phone<span>*</span> </label>
                                   <input type="text" class="form-control" id="" placeholder="Phone Number" value="<?=$phone?>">                           
                                </div>
                            </div>

                            <?php if($this->session->has_userdata('type') && $this->session->userdata('type') == 'retailer'){ ?>
                            <div class="col-md-6 ">
                                <div class="form-group">
                                   <label>Store Name<span>*</span> </label>
                                   <span class="form-control"><?=$store_name?></span>                         
                                </div>
                            </div>

                            <div class="col-md-6 ">
                                <div class="form-group">
                                   <label>GST No.<span>*</span> </label>
                                   <span class="form-control"><?=$gst_no?></span>
                                </div>
                            </div>
                            <?php } ?>
                            <!-- <div class="col-md-12 ">
                                <h5 class="mb-3">Password Change</h5>
                            </div>

                             <div class="col-md-6 ">
                                <div class="form-group">
                                   <label>Current password (leave blank to leave unchanged)<span>*</span> </label>
                                  <input type="password" value="" class="form-control" name="customer[password]" id="CustomerPassword" class="input-full" placeholder="Password">                         
                             </div>
                            </div>

                            <div class="col-md-6 ">
                                <div class="form-group">
                                   <label>New password (leave blank to leave unchanged) <span>*</span> </label>
                                  <input type="password" value="" class="form-control" name="customer[password]" id="CustomerPassword" class="input-full" placeholder="Password">                         
                             </div>
                            </div>


                            <div class="col-md-12 ">
                                <div class="form-group">
                                   <label>Confirm new password <span>*</span> </label>
                                  <input type="password" value="" class="form-control" name="customer[password]" id="CustomerPassword" class="input-full" placeholder="Password">                         
                             </div>
                            </div> -->

                            <div class="col-md-12 text-centert">
                                <div class="form-group">
                                   <input type="submit" class="btn1 w-100" value="Save Changes">                 
                             </div>
                            </div>

                        </div>
        </div>
    </div>
</section>