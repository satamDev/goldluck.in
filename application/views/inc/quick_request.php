<!-- Button trigger modal -->
<button class="btn-hover color-1" data-toggle="modal" data-target="#QuickRequest"><span class="mr-1">Quick Request</span>  <i class="fas fa-plus"></i></button>
  
<!-- Modal -->
<div class="modal QuickrderMdl fade" id="QuickRequest" tabindex="-1" role="dialog" aria-labelledby="QuickRequestTitle" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLongTitle">Quick Request</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
        <div class="orderreqstfrm">
            <form action="<?=base_url()?>addQuickRequest" method="post" id="frm">
              <div class="row">
                <div class="col-md-6 ">
                    <div class="form-group">
                       <label>First name <span>*</span> </label>
                       <input type="text" class="form-control" name="fname" placeholder="Enter First Name" required>                           
                    </div>
                </div>

                <div class="col-md-6 ">
                    <div class="form-group">
                       <label>Last name <span>*</span> </label>
                       <input type="text" class="form-control" name="lname" placeholder="Enter Last Name" required>                           
                    </div>
                </div>

                <div class="col-md-6 ">
                    <div class="form-group">
                       <label> Phone Number <span>*</span> </label>
                       <input type="text" class="form-control" name="phone" placeholder="Enter Phone Number" required>                           
                    </div>
                </div>

                <div class="col-md-6 ">
                    <div class="form-group">
                       <label>Email  </label>
                       <input type="email" class="form-control" name="email" placeholder="Enter Email">                           
                    </div>
                </div>

                <div class="col-12 ">
                    <div class="form-group">
                       <label>Address <span>*</span> </label>
                       <input type="text" class="form-control" name="address" placeholder="Enter Address" required>                           
                    </div>
                </div>

                <div class="col-md-4 ">
                    <div class="form-group">
                       <label>Gross Weight<span>*</span> </label>
                       <input type="text" class="form-control" name="gross_weight" placeholder="Gross Weight" required>                           
                    </div>
                </div>


                <div class="col-md-4 ">
                    <div class="form-group">
                       <label>Quality <span>*</span> </label>
                       <select class="form-control" name="quality" required>
                           <option>22k</option>
                           <option>24k</option>
                       </select>                           
                    </div>
                </div>

                <div class="col-md-4 ">
                    <div class="form-group">
                       <label>Product Image <span>*</span> </label>
                       <input type="file" class="form-control-file" name="quick_request_images[]" required>                           
                    </div>
                </div>

                <div class="col-md-12 ">
                    <div class="form-group">
                       <label>Message  </label>
                       <textarea class="form-control" name="message" rows="3" placeholder="Type Message"></textarea>                       
                    </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn1">
                    <span class="please_wait" style="display: none;">Please Wait...</span>
                    <span class="submit">Submit Now</span>
                </button>
            </div>
              
            </form>
        </div>
    </div>
    
  </div>
</div>
</div>
<div class="loaderbg">
    <div><img src="<?=base_url()?>assets/images/1488.gif" alt=""></div>
</div>

<style type="text/css">
    .loaderbg {
      width: 100%;
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      position: fixed;
      z-index: 9999;
      /*background-color: #fff;*/
      top: 0;
      left: 0;
    }
</style>