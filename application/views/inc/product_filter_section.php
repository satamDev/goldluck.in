<section class="filrtersec mb-4">
    <div class="container">
        <div style="width:100%; height: 1px; background-color: #ddd; margin-bottom: 20px;"></div>
         <div class="row align-items-center align-items-md-start  flex-lg-row-reverse">
            <div class="col-7 col-md-6 col-lg-3">
                <div class="shortybybox">
                    <div class="show-brw filtrttle">SORT BY </div>
                    <!-- <div class="show-mob filtrttle">SORT BY </div> -->
                      <div class="shorbyfrm">
                          <form id="shortby_form">
                              <select class="form-control" name="shortby" id="shortby">
                                  <!-- <option value="popular" <?=(isset($_GET['shortby']))?($_GET['shortby'] == 'popular')?'selected':'':''?> >Popular</option> -->
                                  <option value="0">Selelct Option</option>
                                  <option value="whatsnew" <?=(isset($_GET['shortby']))?($_GET['shortby'] == 'whatsnew')?'selected':'':''?>>What's New</option>
                                  <option value="price_hign_to_low" <?=(isset($_GET['shortby']))?($_GET['shortby'] == 'price_hign_to_low')?'selected':'':''?>>Price High to Low</option>
                                  <option value="price_low_to_high" <?=(isset($_GET['shortby']))?($_GET['shortby'] == 'price_low_to_high')?'selected':'':''?>>Price Low to High</option>   
                                  <option value="discount" <?=(isset($_GET['shortby']))?($_GET['shortby'] == 'discount')?'discount':'':''?>>Discount</option>
                              </select>
                          </form>
                      </div>
                </div>
            </div>
            <!-- <div class="col-5 col-md-6 col-lg-9 filterdsbl"> -->
            <div class="col-5 col-md-6 col-lg-9">    
                <div class="filterbybox">
                    <div class="show-brw filtrttle">FILTER BY</div>
                    <div id="filterbarCollapse" class="show-mob filtrttle">FILTER BY <svg stroke="#666" width="20px"  height="20px" fill="#c4995e" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" version="1.1" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g id="Layer_1"/><g id="Layer_2"><g><g><path class="st0" d="M160.4,356.49h-24.7V43.5c0-8.84-7.16-16-16-16s-16,7.16-16,16v312.99H78.99c-9.8,0-18.67,3.97-25.09,10.39     c-6.43,6.43-10.4,15.3-10.4,25.1c0,19.6,15.89,35.49,35.49,35.49h24.71v0v41.03c0,8.84,7.16,16,16,16s16-7.16,16-16v-41.03v0     h24.7c9.8,0,18.67-3.97,25.1-10.39c6.42-6.43,10.39-15.3,10.39-25.1C195.89,372.38,180,356.49,160.4,356.49z"/></g><g><path class="st0" d="M332.2,148.4c0-19.6-15.89-35.49-35.49-35.49H272V43.5c0-8.84-7.16-16-16-16s-16,7.16-16,16v69.41h-24.71     c-9.8,0-18.67,3.97-25.09,10.39c-6.43,6.43-10.4,15.3-10.4,25.1c0,19.6,15.89,35.49,35.49,35.49H240V468.5c0,8.84,7.16,16,16,16     s16-7.16,16-16V183.89h24.71c9.8,0,18.67-3.97,25.09-10.39C328.23,167.07,332.2,158.2,332.2,148.4z"/></g><g><path class="st0" d="M433.01,356.49H408.3V43.5c0-8.84-7.16-16-16-16s-16,7.16-16,16v312.99h-24.7c-9.8,0-18.67,3.97-25.1,10.39     c-6.42,6.43-10.39,15.3-10.39,25.1c0,19.6,15.89,35.49,35.49,35.49h24.7v0v41.03c0,8.84,7.16,16,16,16s16-7.16,16-16v-41.03v0     h24.71c9.8,0,18.67-3.97,25.09-10.39c6.43-6.43,10.4-15.3,10.4-25.1C468.5,372.38,452.61,356.49,433.01,356.49z"/></g></g></g></svg></div>
                    <div id="filterbar">
                      
                    <ul id="accordion">


                        <?php
                            $i = 0;
                            foreach($filter_menu as $key => $data){
                                if($i <= 5){
                                ?>
                                    <li class="shwmshover">
                                        <div class="collapsed filtrhead" id="<?=$key?>" data-toggle="collapse" data-target="#<?=$key.'_'.$i?>" aria-expanded="false" aria-controls="collapseOne"><?=$key?></div>
                                        <div id="<?=$key.'_'.$i?>" class="fltbody collapse " aria-labelledby="heading<?=$i?>" data-parent="#accordion">
                                            <div>
                                                <ul>
                                                    <?php foreach($data as $val){?>
                                                        <li><a href="javascript:addURL('<?=$key?>','<?=$val['name']?>')"><?=$val['name']?></a></li>
                                                    <?php
                                                        } 
                                                    $i++; ?> 
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                <?php
                                }
                            }
                        ?>

                        <!--   <li class="shwmshover">
                          <div class="collapsed filtrhead" id="prcId" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                              Price
                          </div>

                          <div id="collapseOne" class="fltbody collapse " aria-labelledby="headingOne" data-parent="#accordion">
                            <div>
                               <ul>
                                   <li><a href="#">Below Rs. 10,000 (40)</a></li>
                                   <li><a href="#">Rs. 10,000 - Rs. 20,000 (176)</a></li>
                                   <li><a href="#">Rs. 20,000 - Rs. 30,000 (189)</a></li>
                                   <li><a href="#">Rs. 30,000 - Rs. 40,000 (174)</a></li>
                                   <li><a href="#">Rs. 40,000 - Rs. 50,000 (127)</a></li>
                                   <li><a href="#">Rs. 50,000 and Above (201) </a></li>
                               </ul>
                            </div>
                          </div>

                        </li> -->
                        <!-- <li class="shwmshover">
                          <div class="filtrhead collapsed" id="DlryTime" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                             Delivery Time
                          </div>

                          <div id="collapseTwo" class="fltbody collapse" aria-labelledby="headingThree" data-parent="#accordion">
                            <div >
                                <div>
                                    <ul>
                                        <li><a href="javascript:addURL('delivery_time','next_day_delivery')"> Next Day Delivery (8)</a></li>                                       
                                    </ul>
                                 </div>
                            </div>
                          </div>
                          </li>

                          <li class="shwmshover">
                            <div class="filtrhead collapsed" id="DlryTime" data-toggle="collapse" data-target="#Metl" aria-expanded="false" aria-controls="collapseThree">
                               Metal
                            </div>
  
                            <div id="Metl" class="fltbody collapse" aria-labelledby="headingThree" data-parent="#accordion">
                              <div>
                                <ul>
                                    <li><a href="#">Gold (907)</a></li>
                                    <li><a href="#">White Gold (126)</a></li>
                                    <li><a href="#">Rose Gold (58)</a></li>
                                    <li><a href="#">Plain Gold/Platinum (28)</a></li>
                                    <li><a href="#">Platinum (10)</a></li>
                                    
                                </ul>
                              </div>
                            </div>
                            </li>



                            <li class="shwmshover">
                                <div class="filtrhead collapsed" id="DlryTime" data-toggle="collapse" data-target="#GoldPurity" aria-expanded="false" aria-controls="collapseFour">
                                    Gold Purity
                                </div>
      
                                <div id="GoldPurity" class="fltbody collapse" aria-labelledby="headingFour" data-parent="#accordion">
                                    <div>
                                        <ul>
                                            <li><a href="#">Gold (907)</a></li>
                                            <li><a href="#">White Gold (126)</a></li>
                                            <li><a href="#">Rose Gold (58)</a></li>
                                            <li><a href="#">Plain Gold/Platinum (28)</a></li>
                                            <li><a href="#">Platinum (10)</a></li>
                                            
                                        </ul>
                                      </div>
                                </div>
                                </li>


                                <li class="shwmshover">
                                    <div class="filtrhead collapsed" id="DlryTime" data-toggle="collapse" data-target="#Stns" aria-expanded="false" aria-controls="collapseFive">
                                        Stones
                                    </div>
          
                                    <div id="Stns" class="fltbody collapse" aria-labelledby="headingFive" data-parent="#accordion">
                                        <div>
                                            <ul>
                                                <li><a href="#">Gold (907)</a></li>
                                                <li><a href="#">White Gold (126)</a></li>
                                                <li><a href="#">Rose Gold (58)</a></li>
                                                <li><a href="#">Plain Gold/Platinum (28)</a></li>
                                                <li><a href="#">Platinum (10)</a></li>
                                                
                                            </ul>
                                          </div>
                                    </div>
                                    </li>

                                    <li class="shwmshover">
                                        <div class="filtrhead collapsed" id="DlryTime" data-toggle="collapse" data-target="#Ofrs" aria-expanded="false" aria-controls="collapseSix">
                                            Offers
                                        </div>
              
                                        <div id="Ofrs" class="fltbody collapse" aria-labelledby="headingSix" data-parent="#accordion">
                                            <div>
                                                <ul>
                                                    <li><a href="#">Gold (907)</a></li>
                                                    <li><a href="#">White Gold (126)</a></li>
                                                    <li><a href="#">Rose Gold (58)</a></li>
                                                    <li><a href="#">Plain Gold/Platinum (28)</a></li>
                                                    <li><a href="#">Platinum (10)</a></li>
                                                    
                                                </ul>
                                              </div>
                                        </div>
                                        </li> -->


                                        <li>
                                            <div class="MoreFilterbtn" data-toggle="modal" data-target="#MorFltrs1">
                                                More Filters 
                                            </div>
                  
                                           
                                            </li>
                      </ul>

                     

                  

                    <div class="filterdbybox ">
                        <div class="mr-3">FILTERED BY</div>
                        <ul>
                            <?php 
                                // print_r($_GET)
                                foreach($_GET as $key => $val){
                                    if($key != 'shortby'){
                                        $val = ucwords(str_replace("_", " ", $val));
                                        echo '<li onclick="removeParamTest(\''.$key.'\')">'.$val.' 
                                            <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="8px" height="8px" viewBox="0 0 94.926 94.926" style="enable-background:new 0 0 94.926 94.926;" xml:space="preserve">
                                                <g>
                                                    <path d="M55.931,47.463L94.306,9.09c0.826-0.827,0.826-2.167,0-2.994L88.833,0.62C88.436,0.224,87.896,0,87.335,0c-0.562,0-1.101,0.224-1.498,0.62L47.463,38.994L9.089,0.62c-0.795-0.795-2.202-0.794-2.995,0L0.622,6.096c-0.827,0.827-0.827,2.167,0,2.994l38.374,38.373L0.622,85.836c-0.827,0.827-0.827,2.167,0,2.994l5.473,5.476c0.397,0.396,0.936,0.62,1.498,0.62s1.1-0.224,1.497-0.62l38.374-38.374l38.374,38.374c0.397,0.396,0.937,0.62,1.498,0.62s1.101-0.224,1.498-0.62l5.473-5.476c0.826-0.827,0.826-2.167,0-2.994L55.931,47.463z"/>
                                            </svg>
                                        </li>';
                                    }
                                }
                            ?>


                           <!--  <li>Studs <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                width="8px" height="8px"  viewBox="0 0 94.926 94.926" style="enable-background:new 0 0 94.926 94.926;"
                                xml:space="preserve">
                           <g>
                               <path d="M55.931,47.463L94.306,9.09c0.826-0.827,0.826-2.167,0-2.994L88.833,0.62C88.436,0.224,87.896,0,87.335,0
                                   c-0.562,0-1.101,0.224-1.498,0.62L47.463,38.994L9.089,0.62c-0.795-0.795-2.202-0.794-2.995,0L0.622,6.096
                                   c-0.827,0.827-0.827,2.167,0,2.994l38.374,38.373L0.622,85.836c-0.827,0.827-0.827,2.167,0,2.994l5.473,5.476
                                   c0.397,0.396,0.936,0.62,1.498,0.62s1.1-0.224,1.497-0.62l38.374-38.374l38.374,38.374c0.397,0.396,0.937,0.62,1.498,0.62
                                   s1.101-0.224,1.498-0.62l5.473-5.476c0.826-0.827,0.826-2.167,0-2.994L55.931,47.463z"/></svg></li>
                            <li>Earrings <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                width="8px" height="8px"  viewBox="0 0 94.926 94.926" style="enable-background:new 0 0 94.926 94.926;"
                                xml:space="preserve">
                           <g>
                               <path d="M55.931,47.463L94.306,9.09c0.826-0.827,0.826-2.167,0-2.994L88.833,0.62C88.436,0.224,87.896,0,87.335,0
                                   c-0.562,0-1.101,0.224-1.498,0.62L47.463,38.994L9.089,0.62c-0.795-0.795-2.202-0.794-2.995,0L0.622,6.096
                                   c-0.827,0.827-0.827,2.167,0,2.994l38.374,38.373L0.622,85.836c-0.827,0.827-0.827,2.167,0,2.994l5.473,5.476
                                   c0.397,0.396,0.936,0.62,1.498,0.62s1.1-0.224,1.497-0.62l38.374-38.374l38.374,38.374c0.397,0.396,0.937,0.62,1.498,0.62
                                   s1.101-0.224,1.498-0.62l5.473-5.476c0.826-0.827,0.826-2.167,0-2.994L55.931,47.463z"/></svg></li>
                            <li>Rs. 20,000 - Rs. 30,000 <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                width="8px" height="8px"  viewBox="0 0 94.926 94.926" style="enable-background:new 0 0 94.926 94.926;"
                                xml:space="preserve">
                           <g>
                               <path d="M55.931,47.463L94.306,9.09c0.826-0.827,0.826-2.167,0-2.994L88.833,0.62C88.436,0.224,87.896,0,87.335,0
                                   c-0.562,0-1.101,0.224-1.498,0.62L47.463,38.994L9.089,0.62c-0.795-0.795-2.202-0.794-2.995,0L0.622,6.096
                                   c-0.827,0.827-0.827,2.167,0,2.994l38.374,38.373L0.622,85.836c-0.827,0.827-0.827,2.167,0,2.994l5.473,5.476
                                   c0.397,0.396,0.936,0.62,1.498,0.62s1.1-0.224,1.497-0.62l38.374-38.374l38.374,38.374c0.397,0.396,0.937,0.62,1.498,0.62
                                   s1.101-0.224,1.498-0.62l5.473-5.476c0.826-0.827,0.826-2.167,0-2.994L55.931,47.463z"/></svg></li> -->
                        </ul>

                        <div class="fltrbtns  w-100 ">
                            <div class="d-flex align-items-center jutify-content-between">
                                <button id="applyclose" type="button" class="btn1 mt-4 px-0 w-100">Apply Now</button>
                                <button type="button" class="btn1 mt-4 px-0 ml-3 w-100">Reset</button>
                                <button id="filterbarCollapse2" type="button" class="btn1 mt-4 ml-3 w-100 px-0">Close</button>
                            </div>
                        </div>
                        
                        
                    </div>
                </div>
                </div>
            </div>
         </div>
    </div>
</section>
<!-- <button onclick="removeParamTest('delivery_time')">Change URL</button> -->




  <!-- More Filter Modal -->
  <div class="modal filtrmodalbx fade" id="MorFltrs1" tabindex="-1" aria-labelledby="More Filters" aria-hidden="true" >
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="More Filters">More Filters</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
           <div class="row row2">
                <?php
                    $i = 0;
                    foreach($filter_menu as $key => $data){
                        // if($i <= 5){
                ?>
               <div class="col-md-3 col-lg-2">
                   <div class="mrfltrbox">
                      <div class="mrfltrboxTtl"><?=$key?></div>
                      <ul class="mt-1">
                        <?php foreach($data as $val){?>
                            <li><a href="#"><?=$val['name']?></a></li>
                        <?php
                            } 
                        $i++; ?> 
                      </ul>
                   </div>
               </div>
                <?php
                        // }
                    }
                ?>

               <!-- <div class="col-md-3 col-lg-2">
                <div class="mrfltrbox">
                   <div class="mrfltrboxTtl">Occassion</div>
                   <ul class="mt-1">
                       <li><a href="#">Weekend <span>(916)</span> </a></li>
                       <li><a href="#">Vacation <span> (763)</span></a></li>
                       <li><a href="#">Workwear  <span>(698)</span></a></li>
                       <li><a href="#">Party <span>(472)</span> </a></li>
                       <li><a href="#">Akshaya Tritiya <span> (447)</span></a></li>
                       <li><a href="#">Festive <span> (363)</span></a></li>
                   </ul>
                </div>
            </div>

            <div class="col-md-3 col-lg-2">
                <div class="mrfltrbox">
                   <div class="mrfltrboxTtl">Occassion</div>
                   <ul class="mt-1">
                       <li><a href="#">Weekend <span>(916)</span> </a></li>
                       <li><a href="#">Vacation <span> (763)</span></a></li>
                       <li><a href="#">Workwear  <span>(698)</span></a></li>
                       <li><a href="#">Party <span>(472)</span> </a></li>
                       <li><a href="#">Akshaya Tritiya <span> (447)</span></a></li>
                       <li><a href="#">Festive <span> (363)</span></a></li>
                   </ul>
                </div>
            </div>

            <div class="col-md-3 col-lg-2">
                <div class="mrfltrbox">
                   <div class="mrfltrboxTtl">Occassion</div>
                   <ul class="mt-1">
                       <li><a href="#">Weekend <span>(916)</span> </a></li>
                       <li><a href="#">Vacation <span> (763)</span></a></li>
                       <li><a href="#">Workwear  <span>(698)</span></a></li>
                       <li><a href="#">Party <span>(472)</span> </a></li>
                       <li><a href="#">Akshaya Tritiya <span> (447)</span></a></li>
                       <li><a href="#">Festive <span> (363)</span></a></li>
                   </ul>
                </div>
            </div>

            <div class="col-md-3 col-lg-2">
                <div class="mrfltrbox">
                   <div class="mrfltrboxTtl">Occassion</div>
                   <ul class="mt-1">
                       <li><a href="#">Weekend <span>(916)</span> </a></li>
                       <li><a href="#">Vacation <span> (763)</span></a></li>
                       <li><a href="#">Workwear  <span>(698)</span></a></li>
                       <li><a href="#">Party <span>(472)</span> </a></li>
                       <li><a href="#">Akshaya Tritiya <span> (447)</span></a></li>
                       <li><a href="#">Festive <span> (363)</span></a></li>
                   </ul>
                </div>
            </div>

            <div class="col-md-3 col-lg-2">
                <div class="mrfltrbox">
                   <div class="mrfltrboxTtl">Occassion</div>
                   <ul class="mt-1">
                       <li><a href="#">Weekend <span>(916)</span> </a></li>
                       <li><a href="#">Vacation <span> (763)</span></a></li>
                       <li><a href="#">Workwear  <span>(698)</span></a></li>
                       <li><a href="#">Party <span>(472)</span> </a></li>
                       <li><a href="#">Akshaya Tritiya <span> (447)</span></a></li>
                       <li><a href="#">Festive <span> (363)</span></a></li>
                   </ul>
                </div>
            </div>

            <div class="col-md-3 col-lg-2">
                <div class="mrfltrbox">
                   <div class="mrfltrboxTtl">Occassion</div>
                   <ul class="mt-1">
                       <li><a href="#">Weekend <span>(916)</span> </a></li>
                       <li><a href="#">Vacation <span> (763)</span></a></li>
                       <li><a href="#">Workwear  <span>(698)</span></a></li>
                       <li><a href="#">Party <span>(472)</span> </a></li>
                       <li><a href="#">Akshaya Tritiya <span> (447)</span></a></li>
                       <li><a href="#">Festive <span> (363)</span></a></li>
                   </ul>
                </div>
            </div>


            <div class="col-md-3 col-lg-2">
                <div class="mrfltrbox">
                   <div class="mrfltrboxTtl">Occassion</div>
                   <ul class="mt-1">
                       <li><a href="#">Weekend <span>(916)</span> </a></li>
                       <li><a href="#">Vacation <span> (763)</span></a></li>
                       <li><a href="#">Workwear  <span>(698)</span></a></li>
                       <li><a href="#">Party <span>(472)</span> </a></li>
                       <li><a href="#">Akshaya Tritiya <span> (447)</span></a></li>
                       <li><a href="#">Festive <span> (363)</span></a></li>
                   </ul>
                </div>
            </div>

            <div class="col-md-3 col-lg-2">
                <div class="mrfltrbox">
                   <div class="mrfltrboxTtl">Occassion</div>
                   <ul class="mt-1">
                       <li><a href="#">Weekend <span>(916)</span> </a></li>
                       <li><a href="#">Vacation <span> (763)</span></a></li>
                       <li><a href="#">Workwear  <span>(698)</span></a></li>
                       <li><a href="#">Party <span>(472)</span> </a></li>
                       <li><a href="#">Akshaya Tritiya <span> (447)</span></a></li>
                       <li><a href="#">Festive <span> (363)</span></a></li>
                   </ul>
                </div>
            </div>

            <div class="col-md-3 col-lg-2">
                <div class="mrfltrbox">
                   <div class="mrfltrboxTtl">Occassion</div>
                   <ul class="mt-1">
                       <li><a href="#">Weekend <span>(916)</span> </a></li>
                       <li><a href="#">Vacation <span> (763)</span></a></li>
                       <li><a href="#">Workwear  <span>(698)</span></a></li>
                       <li><a href="#">Party <span>(472)</span> </a></li>
                       <li><a href="#">Akshaya Tritiya <span> (447)</span></a></li>
                       <li><a href="#">Festive <span> (363)</span></a></li>
                   </ul>
                </div>
            </div>

            <div class="col-md-3 col-lg-2">
                <div class="mrfltrbox">
                   <div class="mrfltrboxTtl">Occassion</div>
                   <ul class="mt-1">
                       <li><a href="#">Weekend <span>(916)</span> </a></li>
                       <li><a href="#">Vacation <span> (763)</span></a></li>
                       <li><a href="#">Workwear  <span>(698)</span></a></li>
                       <li><a href="#">Party <span>(472)</span> </a></li>
                       <li><a href="#">Akshaya Tritiya <span> (447)</span></a></li>
                       <li><a href="#">Festive <span> (363)</span></a></li>
                   </ul>
                </div>
            </div>

            <div class="col-md-3 col-lg-2">
                <div class="mrfltrbox">
                   <div class="mrfltrboxTtl">Occassion</div>
                   <ul class="mt-1">
                       <li><a href="#">Weekend <span>(916)</span> </a></li>
                       <li><a href="#">Vacation <span> (763)</span></a></li>
                       <li><a href="#">Workwear  <span>(698)</span></a></li>
                       <li><a href="#">Party <span>(472)</span> </a></li>
                       <li><a href="#">Akshaya Tritiya <span> (447)</span></a></li>
                       <li><a href="#">Festive <span> (363)</span></a></li>
                   </ul>
                </div>
            </div> -->
           </div>
        </div>
        
      </div>
    </div>
  </div>
  

  <style>
        .filterdsbl {
            position: relative;
        }
        .filterdsbl::before {
            content: "Under Development this Portion";
            position: absolute;
            width: 100%;
            height: 100%;
            background-color: #fff;
            opacity: 0.6;
            z-index: 9;
            left: 0;
            top: 0;
            text-align: center;
            font-weight: bold;
            color: red;
            border: 1px solid;
        }
  </style>

  <script>
    function addURL(key, value){
        var data=window.location+"&"+key+"="+value;
        window.location.href = data;

        // var sourceURL=window.location.href;

        // var rtn = sourceURL.split("?")[0],
        //     param,
        //     params_arr = [],
        //     queryString = (sourceURL.indexOf("?") !== -1) ? sourceURL.split("?")[1] : "";
        //     if (queryString !== "") {
        //         params_arr = queryString.split("&");
        //         for (var i = params_arr.length - 1; i >= 0; i -= 1) {
        //             param = params_arr[i].split("=")[0];
        //             if (param === key) {
        //                 // params_arr.splice(i, 1);
        //                 // params_arr[i].split("=")[0].push(value);
        //                 params_arr[i] = params_arr[i] + "," + value;
        //                 // console.log(params_arr);
        //             }
        //             else if(param != key){
        //                 // params_arr.push(key+"="+value);
        //                 // console.log(params_arr);
        //             }
        //         }
        //         if (params_arr.length) rtn = rtn + "?" + params_arr.join("&");
        //     }
        //     console.log(rtn);
        //     window.location.href = rtn;
    }

    function removeParam(key, sourceURL) {
        var rtn = sourceURL.split("?")[0],
            param,
            params_arr = [],
            queryString = (sourceURL.indexOf("?") !== -1) ? sourceURL.split("?")[1] : "";
            if (queryString !== "") {
                params_arr = queryString.split("&");
                for (var i = params_arr.length - 1; i >= 0; i -= 1) {
                    param = params_arr[i].split("=")[0];
                    if (param === key) {
                        params_arr.splice(i, 1);
                    }
                }
                if (params_arr.length) rtn = rtn + "?" + params_arr.join("&");
            }
        return rtn;
    }

    function removeParamTest(key){
        var originalURL = window.location.href;        
        var alteredURL = removeParam(key, originalURL);
        window.location.href = alteredURL;
    }
</script>