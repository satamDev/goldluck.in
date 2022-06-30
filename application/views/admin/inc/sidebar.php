<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?=base_url()?>admin/dashboard"> 
                <div class="sidebar-brand-text mx-3">GoldLuck.in <sup>Admin Panel</sup></div>
            </a>
            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            <!-- Nav Item - Dashboard -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities_frontend"
                    aria-expanded="true" aria-controls="collapseUtilities_frontend">
                    <!-- <i class="fas fa-fw fa-wrench"></i> -->
                    <i class="fab fa-product-hunt"></i>
                    <span>Front End Data</span>
                </a>
                <div id="collapseUtilities_frontend" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">  
                         <a class="collapse-item" href="<?=base_url()?>admin/top_menu">Top Menu</a>
                        <a class="collapse-item" href="<?=base_url()?>admin/site_data">Site Data</a>
                        <a class="collapse-item" href="<?=base_url()?>admin/banner">Banner</a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <!-- <i class="fas fa-fw fa-wrench"></i> -->
                    <i class="fab fa-product-hunt"></i>
                    <span>Products</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Products:</h6>
                        <a class="collapse-item" href="<?=base_url()?>admin/products_main">Products Listing</a>
                        <a class="collapse-item" href="<?=base_url()?>admin/products">Add Products</a>
                        <a class="collapse-item" href="<?=base_url()?>admin/bulk_products">Bulk Upload Products</a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="<?=base_url()?>admin/filter_options">
                    <i class="fas fa-filter"></i>
                    <span>Filter Options</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="<?=base_url()?>admin/quick_request">
                    <i class="fas fa-comment-alt"></i>
                    <span>Quick Request</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="<?=base_url()?>admin/orders">
                    <i class="fas fa-store-alt"></i>
                    <span>Orders</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="<?=base_url()?>admin/customers">
                    <i class="fas fa-users"></i>
                    <span>Customers</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="<?=base_url()?>admin/email_management">
                    <i class="fas fa-at"></i>
                    <span>Email</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="<?=base_url()?>admin/dashboard">
                    <i class="fas fa-file-alt"></i>
                    <span>Reports</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="<?=base_url()?>admin/retailer">
                    <i class="fas fa-store"></i>
                    <span>Retailer</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">
            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div> 
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                    <?= ( $this->session->has_userdata('name') )? $this->session->userdata('name'):'' ?>
                                </span>
                                <img class="img-profile rounded-circle" src="<?=base_url()?>assets/admin/img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <!-- <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
 -->                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>

                                <!-- <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a> -->
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->