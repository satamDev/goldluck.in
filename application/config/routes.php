<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
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
$route['details/(:any)'] = 'home/product_details/$1';

