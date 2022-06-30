            <div class="loaderbg">
                <div>
                    <img src="<?=base_url()?>assets/images/1488.gif" alt="">
                    <div class="md-2">Please Wait</div>
                </div>
            </div>
            <!-- Begin Page Content -->
            <div class="container-fluid">
                <!-- Page Heading -->
                <!-- <h1 class="h3 mb-4 text-gray-800">Product Upload</h1> -->

                <form method="post" id="frm" action="<?=base_url('admin/product_upload') ?>" enctype="multipart/form-data">
                    <?=validation_errors()?>
                    <div class="row">
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
                        <!-- Product Upload Form -->
                        <div class="col-xl-8 col-lg-7">
                            <div class="card shadow mb-4 h-100">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Product Upload</h6>                                    
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label for="inputProductTitle">Product Title</label>
                                            <input type="text" name="title" class="form-control" id="inputProductTitle" placeholder="Enter Product Title" value="<?=set_value('title')?>" required>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="inputProductCode">Product Code</label>
                                            <input type="text" name="code" class="form-control" id="inputProductCode" placeholder="Enter Product Code" value="<?=set_value('code')?>" required>
                                        </div>

                                         <div class="form-group col-md-6">
                                            <label for="inputSKU">SKU</label>
                                            <input type="number" name="sku" class="form-control" id="inputSKU"  placeholder="Enter SKU" value="<?=set_value('sku')?>" required>
                                        </div>
                                       
                                        <div class="form-group col-md-6">
                                            <label for="inputCategory">Category</label>
                                            <select id="inputCategory" name="category" class="form-control" required>
                                                <option value="0">Select Catgory</option>
                                                 <?php
                                                    foreach($category as $val){
                                                        echo "<option value=".$val->id.">" . ucwords($val->name) ."</option>";
                                                    }
                                                ?>
                                            </select>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="inputCategory">Sub-Category</label>
                                            <select id="inputSubCategory" name="sub_category" class="form-control" required>
                                                <option value="0">Select Category First</option>
                                            </select>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="inputQuantity">Quantity</label>
                                            <input type="number" name="quantity" class="form-control" id="inputQuantity" placeholder="Enter Quantity" value="<?=set_value('quantity')?>" required>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="inputPrice">Price</label>
                                            <input type="number" name="price" class="form-control" id="inputPrice"  placeholder="Enter Price" value="<?=set_value('price')?>" required>
                                        </div>

                                       

                                        <div class="form-group col-md-6">
                                            <label for="inputDisPer">Discount Percentage(%)</label>
                                            <input type="number" name="discount_percentage" class="form-control" id="inputDisPer"  placeholder="Enter Discount Percentage(%)" value="<?=set_value('discount_percentage')?>">
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="inputHeight">Height(mm)</label>
                                            <input type="number" name="height" class="form-control" id="inputHeight"  placeholder="Enter Height" value="<?=set_value('height')?>" required>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="inputWidth">Width(mm)</label>
                                            <input type="number" name="width" class="form-control" id="inputWidth"  placeholder="Enter Width" value="<?=set_value('width')?>" required>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="inputManufecture">Manufacture</label>
                                            <input type="text" name="manufacture" class="form-control" id="inputManufecture"  placeholder="Enter Manufecture" value="<?=set_value('manufecture')?>" required>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="inputOrigin">Country of Origin</label>
                                            <input type="text" name="origin" class="form-control" id="inputOrigin"  placeholder="Enter Country of Origin" value="<?=set_value('origin')?>" required>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="inputSettingType">Setting Type</label>
                                            <input type="text" name="setting_type" class="form-control" id="inputSettingType"  placeholder="Enter Setting Type" value="<?=set_value('setting_type')?>">
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="inputWeight">Weight(gm)</label>
                                            <input type="number" name="weight" class="form-control" id="inputWeight"  placeholder="Enter Weight" value="<?=set_value('weight')?>" required>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="inputSize">Size</label>
                                            <input type="number" name="size" class="form-control" id="inputSize"  placeholder="Enter Size" value="<?=set_value('size')?>" required>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="inputShortDesc">Short Description</label>
                                            <textarea class="form-control" name="short_description" id="inputShortDesc" rows="3"><?=set_value('short_description')?></textarea>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="inputLongDesc">Long Description</label>
                                            <textarea name="long_description" class="form-control" id="inputLongDesc" rows="3"><?=set_value('long_description')?></textarea>
                                        </div>

                                      </div>

                                      <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label for="inputUploadProductImages">Upload Product Images</label>
                                            
                                            <!-- image loader code written here if that works perfecly -->

                                            
                                            <!-- This line is for image drag and drop section open-->
                                            <div class="input-images"></div>
                                            <!-- This line is for image drag and drop section close-->

                                        </div>                              
                                    </div>

                                </div>
                            </div>
                        </div>


                        <!-- Product filter choose section -->
                        <div class="col-xl-4 col-lg-5">
                            <div class="card shadow mb-4 h-100">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Product Filter Options</h6>                                    
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="sidbrdetailsbox">
                                        <ul id="accordion">

                                            <?php 
                                                $i = 1;
                                                foreach ($filter_data as $key => $data){ ?>  
                                            <li>                                                
                                                <div id="ProdtsHeading<?=$i?>" class="prdtsdbrhdr" data-toggle="collapse" data-target="#Prodts<?=$i?>" aria-expanded="true" aria-controls="ProdtsOne"><?=ucwords($key) ?></div>

                                                <div id="Prodts<?=$i?>" class="collapse <?=($i == 1)?'show':''?>" aria-labelledby="ProdtsHeading<?=$i?>" data-parent="#accordion">
                                                    <div class="prodts-body">                                                       
                                                        <div class="prdtchkbxcstm">
                                                            <?php foreach ($data as $val){ ?>
                                                            <label for="<?=$val['name'] ?>">
                                                                <input type="checkbox" id="<?=$val['name'] ?>" name="<?=$key ?>[]" value="<?=$val['id'] ?>">
                                                                <span><?=$val['name'] ?></span>
                                                            </label> 
                                                            <?php
                                                                } 
                                                            $i++; ?>                                         
                                                        </div>
                                                    </div>
                                                </div>                                                
                                            </li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button form="frm" type="submit" class="btn btn-primary btn-block m-5">Add Product</button>
                    </div>
                </form>
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- End of Main Content -->
    </div>
    <!-- End of Content Wrapper -->
</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<style type="text/css">
    form{
        font-size: small;
    }
    .form-control{
        font-size: small;
    }
</style>

<style type="text/css">
    /*css code for loading gif*/
    .loaderbg {
        width: 100%;
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        position: fixed;
        z-index: 9999;
        top: 0;
        left: 0;
        flex-direction: column;
        text-align: center;
    }
 
</style>

