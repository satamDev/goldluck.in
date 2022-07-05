<?php if($this->session->has_userdata('filter_array')) $this->session->unset_userdata('filter_array'); ?>
<section class=" mb-md-5">
    <div class="container">
        <div class="row" id="products_listing">           
            
           
        </div>
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                <li class="page-item"><?php //echo $links; ?></li>
           </ul>
       </nav>
    </div>
</section>
<?php
    // echo "<pre>";
    // print_r($_SESSION);
    // echo "</pre>";
?>

<input type="hidden" id="pageNo" value="0">
<input type="hidden" id="category" value="<?=$this->uri->segment(2)?>">
<input type="hidden" id="sub-category" value="<?=$this->uri->segment(3)?>">
<input type="hidden" id="shortby" value="<?=isset($_GET['shortby'])?$_GET['shortby'] : ''?>">
<center>
    <button class="btn btn-primary btn-sm mb-5" id="load_more" onclick="get_all_products()">Load More</button>
</center>