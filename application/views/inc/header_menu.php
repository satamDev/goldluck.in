  <body>
      <div id="dvLoading"></div>
      <section class="ovrsrchsec">
        <div class="ovrsrchsecinr">
            <form class="srchform" role="search" method="get" action="">
                <div class="input-group">
                    <input type="search" class="form-control" placeholder="Search Here" value="" name="s" title="" />
                    <span class="input-group-append">
                        <button class="btn btn-light" type="submit">
                            <svg fill="#000000" height="30px" width="30px" version="1.1" xmlns="https://www.w3.org/2000/svg" viewBox="0 0 129 129" xmlns:xlink="https://www.w3.org/1999/xlink" enable-background="new 0 0 129 129">
                                <path d="M51.6,96.7c11,0,21-3.9,28.8-10.5l35,35c0.8,0.8,1.8,1.2,2.9,1.2s2.1-0.4,2.9-1.2c1.6-1.6,1.6-4.2,0-5.8l-35-35   c6.5-7.8,10.5-17.9,10.5-28.8c0-24.9-20.2-45.1-45.1-45.1C26.8,6.5,6.5,26.8,6.5,51.6C6.5,76.5,26.8,96.7,51.6,96.7z M51.6,14.7   c20.4,0,36.9,16.6,36.9,36.9C88.5,72,72,88.5,51.6,88.5c-20.4,0-36.9-16.6-36.9-36.9C14.7,31.3,31.3,14.7,51.6,14.7z"/>   
                            </svg>
                        </button>
                        <button class="btn btn-info srchcls" type="button">
                            <svg fill="#ffffff" height="30px" width="30px" xmlns="https://www.w3.org/2000/svg" data-name="Layer 1" viewBox="0 0 64 64">
                                <line x1="9.37" x2="54.63" y1="9.37" y2="54.63" fill="none" stroke="#ffffff" stroke-miterlimit="10" stroke-width="4"/>
                                <line x1="9.37" x2="54.63" y1="54.63" y2="9.37" fill="none" stroke="#ffffff" stroke-miterlimit="10" stroke-width="4"/>
                            </svg>
                        </button> 
                    </span>
                </div>
            </form>
        </div>
    </section>


<header class="header">
    <section class="hdrtop" style="margin-bottom: 0px;">
        <div class="container">
            <div class="d-flex align-items-center">
                <div class="hdrml">
                    <ul>
                        <li><a href="<?=$site_details['store_location']?>" target="_blank"><i class="fas fa-map-marker-alt"></i><span>Store Location</span></a></li>
                    </ul> 
                </div>
                <div class="htprightdtls ml-auto">
                    <ul>
                        <li><a href="//api.whatsapp.com/send?phone=91<?=$site_details['whatsapp_number']?>&text=Hi"><i class="fab fa-whatsapp"></i><span><?=$site_details['whatsapp_number']?></span></a></li>
                        
                        <?php if( !$this->session->has_userdata('userId') ){ ?>
                            <li><a href="<?=base_url();?>login"><i class="fas fa-user-circle"></i><span>Login</span></a></li>
                            <li><a href="<?=base_url();?>signup"><i class="fas fa-user"></i><span>Register</span></a></li>
                        <?php }else{ ?>
                            <li><a href="<?=base_url();?>account"><i class="fas fa-user-circle"></i><span>My Account</span></a></li>
                            <li><a href="<?=base_url();?>logout"><span>Logout</span></a></li>
                        <?php } ?>                        
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="hdrbtm"> 
        <div class="container">
            <div class="d-flex align-items-center">
                <a href="JavaScript:Void(0);" class="mnutog2">    
<svg id="Layer_1" fill="#666" width="20px" height="20px" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 29.96 122.88"><defs><style>.cls-1{fill-rule:evenodd;}</style></defs><title>3-vertical-dots</title><path class="cls-1" d="M15,0A15,15,0,1,1,0,15,15,15,0,0,1,15,0Zm0,92.93a15,15,0,1,1-15,15,15,15,0,0,1,15-15Zm0-46.47a15,15,0,1,1-15,15,15,15,0,0,1,15-15Z"/></svg>
                </a>
                <a class="logo" href="<?=base_url();?>" rel="home">
                    <img src="<?=base_url();?><?=$site_details['logo_path']?>" alt="">
                </a>
               
                <?php $url = $this->uri->segment(1);?>
                <div class="ml-auto">
                    <div class="d-flex align-items-center mnuwrp">
                        <nav class="nav">
                            <div class="menu-main-menu-container">
                                <ul class="primary-menu">
                                    <!-- only home page -->
                                     <?php
                                        foreach ($home_menu_pages as $key => $value) {
                                            $value = (array)$value;
                                            if($value['title']=='home'){
                                                ?>
                                                <li class="<?=($url == '')?'current-menu-item':''?>">
                                                        <a href="<?=base_url($value['url'])?>"><?=ucwords($value["title"])?></a>
                                                    </li>
                                                <?php
                                            }
                                        }
                                    ?>

                                    <!-- Category section in menu -->
                                    <?php                                    
                                        foreach ($home_menu_category as $key => $value) {
                                            foreach($value as $k => $v){
                                    ?>
                                        <li <?=($url == $k)?'current-menu-item':''?>>
                                            <a href="<?=base_url().'products/'.str_replace(' ', '-', $k)?>"><?=ucwords($k)?></a>
                                            <ul class="primary-menu d-lg-flex align-items-center">
                                                <?php
                                                    foreach($v as $key1 => $val1){
                                                ?>
                                                <li>
                                                    <a href="<?=base_url().'products/'.str_replace(' ', '-', $k).'/'.str_replace(' ', '-', $val1['name'])?>"><?=ucwords($val1['name'])?></a>
                                                </li>
                                               <? } ?>
                                            </ul>
                                        </li>
                                    <?php
                                            }
                                        }
                                    ?>

                                    <!-- exclude home page all pages -->
                                    <?php
                                        foreach ($home_menu_pages as $key => $value) {
                                            $value = (array)$value;
                                            if($value['title']!='home'){
                                                ?>
                                                <li class="<?=($url == $value["title"])?'current-menu-item':''?>">
                                                    <a href="<?=base_url($value["url"])?>"><?=ucwords($value["title"])?></a>
                                                </li>
                                                <?php
                                            }
                                        }
                                    ?>
                                </ul>
                            </div>
                            <div class="mnucls"></div>   
                        </nav>
                        <div class="htprightdtls">
                            <ul>
                               <li class="ml-3">
    <a href="JavaScript:Void(0);" class="srchtog">
        <svg height="32" version="1.1" viewBox="0 0 32 32" width="32" xmlns="http://www.w3.org/2000/svg" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns" xmlns:xlink="http://www.w3.org/1999/xlink"><g fill="none" fill-rule="evenodd" id="Page-1" stroke="none" stroke-width="1"><g fill="#929292" id="icon-111-search"><path d="M19.4271164,20.4271164 C18.0372495,21.4174803 16.3366522,22 14.5,22 C9.80557939,22 6,18.1944206 6,13.5 C6,8.80557939 9.80557939,5 14.5,5 C19.1944206,5 23,8.80557939 23,13.5 C23,15.8472103 22.0486052,17.9722103 20.5104077,19.5104077 L26.5077736,25.5077736 C26.782828,25.782828 26.7761424,26.2238576 26.5,26.5 C26.2219324,26.7780676 25.7796227,26.7796227 25.5077736,26.5077736 L19.4271164,20.4271164 L19.4271164,20.4271164 Z M14.5,21 C18.6421358,21 22,17.6421358 22,13.5 C22,9.35786417 18.6421358,6 14.5,6 C10.3578642,6 7,9.35786417 7,13.5 C7,17.6421358 10.3578642,21 14.5,21 L14.5,21 Z" id="search"/></g></g></svg>
    </a>
</li>
                                <li><a href="<?=base_url()?>wishlist"><svg fill="#666" width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd"><path d="M12 21.593c-5.63-5.539-11-10.297-11-14.402 0-3.791 3.068-5.191 5.281-5.191 1.312 0 4.151.501 5.719 4.457 1.59-3.968 4.464-4.447 5.726-4.447 2.54 0 5.274 1.621 5.274 5.181 0 4.069-5.136 8.625-11 14.402m5.726-20.583c-2.203 0-4.446 1.042-5.726 3.238-1.285-2.206-3.522-3.248-5.719-3.248-3.183 0-6.281 2.187-6.281 6.191 0 4.661 5.571 9.429 12 15.809 6.43-6.38 12-11.148 12-15.809 0-4.011-3.095-6.181-6.274-6.181"/></svg></a></li>

                                <li><a class="crticn" href="<?=base_url()?>cart"><svg version="1.1" id="Layer_1" fill="#666"  width="24" height="24" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 122.9 107.5" style="enable-background:new 0 0 122.9 107.5" xml:space="preserve"><g><path d="M3.9,7.9C1.8,7.9,0,6.1,0,3.9C0,1.8,1.8,0,3.9,0h10.2c0.1,0,0.3,0,0.4,0c3.6,0.1,6.8,0.8,9.5,2.5c3,1.9,5.2,4.8,6.4,9.1 c0,0.1,0,0.2,0.1,0.3l1,4H119c2.2,0,3.9,1.8,3.9,3.9c0,0.4-0.1,0.8-0.2,1.2l-10.2,41.1c-0.4,1.8-2,3-3.8,3v0H44.7 c1.4,5.2,2.8,8,4.7,9.3c2.3,1.5,6.3,1.6,13,1.5h0.1v0h45.2c2.2,0,3.9,1.8,3.9,3.9c0,2.2-1.8,3.9-3.9,3.9H62.5v0 c-8.3,0.1-13.4-0.1-17.5-2.8c-4.2-2.8-6.4-7.6-8.6-16.3l0,0L23,13.9c0-0.1,0-0.1-0.1-0.2c-0.6-2.2-1.6-3.7-3-4.5 c-1.4-0.9-3.3-1.3-5.5-1.3c-0.1,0-0.2,0-0.3,0H3.9L3.9,7.9z M96,88.3c5.3,0,9.6,4.3,9.6,9.6c0,5.3-4.3,9.6-9.6,9.6 c-5.3,0-9.6-4.3-9.6-9.6C86.4,92.6,90.7,88.3,96,88.3L96,88.3z M53.9,88.3c5.3,0,9.6,4.3,9.6,9.6c0,5.3-4.3,9.6-9.6,9.6 c-5.3,0-9.6-4.3-9.6-9.6C44.3,92.6,48.6,88.3,53.9,88.3L53.9,88.3z M33.7,23.7l8.9,33.5h63.1l8.3-33.5H33.7L33.7,23.7z"/></g></svg><span id="cart_number"><?php
                                    $item = 0;
                                    $data = $this->cart->contents();

                                    foreach($data as $value){
                                        $item++;
                                    }

                                    echo $item;
                                ?></span></a></li>  
                            </ul>
                        </div>

                        <a href="JavaScript:Void(0);" class="mnutog">
                            <svg width="24" height="24" fill="#333" version="1.1" id="lni_lni-menu" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 64 64" style="enable-background:new 0 0 64 64;" xml:space="preserve">
                                <path d="M61,30.3H3c-1,0-1.8,0.8-1.8,1.8S2,33.8,3,33.8h58c1,0,1.8-0.8,1.8-1.8S62,30.3,61,30.3z"/>
                                <path d="M61,47.9H3c-1,0-1.8,0.8-1.8,1.8S2,51.4,3,51.4h58c1,0,1.8-0.8,1.8-1.8S62,47.9,61,47.9z"/>
                                <path d="M3,16.1h58c1,0,1.8-0.8,1.8-1.8S62,12.6,61,12.6H3c-1,0-1.8,0.8-1.8,1.8S2,16.1,3,16.1z"/>
                            </svg>
                        </a>

                        <div id="myOverlay" class="overlay">
                            <span class="closebtn" onclick="closeSearch()" title="Close Overlay">×</span>
                            <div class="overlay-content">
                              <form action="/action_page.php">
                                <input type="text" placeholder="Search.." name="search">
                                <button type="submit"><i class="fa fa-search"></i></button>
                              </form>
                            </div>
                          </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- <section class="hdrbtm2"> 
        <div class="container">
            <div class="d-flex align-items-center">
                <div class="mx-auto">
                    <div class="d-flex align-items-center mnuwrp">
                        <nav class="nav2">
                            <div class="menu-main-menu-container">
                                <ul class="primary-menu">
                                    <li>
                                        <a href="#">Trending</a>
                                    </li>

                                    <li>
                                        <a href="rings.html">Rings</a>
                                    </li>

                                    <li>
                                        <a href="#">Earings</a>
                                    </li>

                                    <li>
                                        <a href="#">Pendents</a>
                                    </li>

                                    <li>
                                        <a href="#">Chains</a>
                                    </li>

                                    <li>
                                        <a href="#">Necklace</a>
                                    </li>

                                    <li>
                                        <a href="#">Bangles</a>
                                    </li>

                                    <li>
                                        <a href="#">Bracelate</a>
                                    </li>

                                    <li>
                                        <a href="#">Mangalsutra</a>
                                    </li>

                                    <li>
                                        <a href="#"> Mangtika/Nath/Nath-tana</a>
                                    </li>

                                    <li>
                                        <a href="#">Dholna</a>
                                    </li> 
                                </ul>
                            </div>
                            <div class="mnucls2"></div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section> -->
</header>   


<style type="text/css">
    .hdrbtm2{
        display: none;
    }
    .has_submenu:hover + .hdrbtm2{
         display: block;
    }
</style>