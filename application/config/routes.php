<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['login'] = 'home/signin';
$route['signup'] = 'home/signup';
$route['forget_password'] = 'home/forgetPassword';
$route['account'] = 'home/my_account';
$route['cart'] = 'home/cart';
$route['offers'] = 'home/offer';
$route['company'] = 'home/company';
$route['wishlist'] = 'home/wishlist';
$route['checkout'] = 'home/checkout';


$route['auth'] = 'home/user_login';
$route['registration'] = 'home/user_signup';
$route['otpverification'] = 'home/verify_otp_mail';
$route['logout'] = 'home/logout';
$route['forgetPassword'] = 'home/forget_password';
$route['updateAddress'] = 'home/update_address';
$route['addToCart'] = 'home/add_to_cart';
$route['cartItems'] = 'home/all_cart_items';
$route['removeSingleCart'] = 'home/remove_single_product_from_cart';
$route['increseSingleCart'] = 'home/increse_single_cart';
$route['decreseSingleCart'] = 'home/decrese_single_cart';
$route['clearCart'] = 'home/clear_cart';
$route['addToWishlist'] = 'home/add_to_wishlist';
$route['wishlistItems'] = 'home/get_wishlist';
$route['removeSingleWishlist'] = 'home/remove_single_product_from_wishlist';
$route['changepassword'] = 'home/change_password';
$route['placeOrder'] = 'home/place_order';
$route['addQuickRequest'] = 'home/add_quick_request';
$route['addRetailerRegistrationRequest'] = 'home/add_retailer_registration_request';
$route['loginRetailer'] = 'home/loginRetailer';
$route['getOrders'] = 'home/getUserOrders';

$route['admin'] = 'admin/admin';
$route['admin/products'] = 'admin/admin/products';
$route['admin/login'] = 'admin/admin/login';
$route['admin/logout'] = 'admin/admin/logout';
$route['admin/dashboard'] = 'admin/admin/dashboard';
$route['admin/products_main'] = 'admin/admin/products_listing';
$route['admin/quick_request'] = 'admin/admin/quick_request';
$route['admin/orders'] = 'admin/admin/orders';
$route['admin/customers'] = 'admin/admin/customers';
$route['admin/email_management'] = 'admin/admin/email_management';
$route['admin/retailer'] = 'admin/admin/retailer';
$route['admin/bulk_products'] = 'admin/admin/CSV';

$route['admin/import'] = 'admin/admin/import';

$route['admin/fetch_quick_request_images'] = 'admin/admin/fetch_quick_request_images';
$route['admin/update_retailer_status'] = 'admin/admin/update_retailer_status';


$route['admin/getFilterMenuOptions'] = 'admin/admin/getFilterMenuOptions';
$route['admin/setFilterMenuOptions'] = 'admin/admin/setFilterMenuOptions';
$route['admin/deleteFilterMenuOptions'] = 'admin/admin/deleteFilterMenuOptions';
$route['admin/updateFilterMenuOptions'] = 'admin/admin/updateFilterMenuOptions';

$route['admin/product_upload'] = 'admin/admin/add_product';
$route['admin/getSubCategory'] = 'admin/admin/getSubCategory';
$route['admin/filter_options'] = 'admin/admin/filter_options';

$route['admin/fetchProducts'] = 'admin/admin/fetchProductDatafromDatabase';

$route['admin/site_data'] = 'admin/frontend_data/view_Frontend_data';
$route['admin/banner'] = 'admin/frontend_data/view_banner';
$route['admin/top_menu'] = 'admin/frontend_data/top_menu';
$route['admin/action_banner'] = 'admin/frontend_data/banner';

$route['admin/getMailContent'] = 'admin/admin/getMailContent';

$route['admin/changeStatePage'] = 'admin/frontend_data/changeStatePage';
$route['admin/changeStateCategory'] = 'admin/frontend_data/changeStateCategory';

$route['admin/updateFrontEndData'] = 'admin/frontend_data/updateFrontEndData';

$route['products/(:any)'] = 'home/all_products/$1/'; //fetch product category wise
$route['products/(:any)/(:any)'] = 'home/all_products/$1/$2';
$route['products'] = 'home/all_products';
// $route['products/(:num)'] = 'home/all_products';
$route['details/(:any)/(:any)'] = 'home/product_details/$1/$2';

$route['products_all'] = 'home/show_all_products';


$route['setFilterSection'] = 'home/setFilterSection';
