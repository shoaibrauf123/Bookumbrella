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
|	https://codeigniter.com/user_guide/general/routing.html
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
|		    my-controller/my-method	-> my_controller/my_method
*/

$route['default_controller'] = "home";
$route['404_override'] = '';

//=================================================================================================================
//=================================================================================================================
//================================================ Frontend Routing ===============================================
//=================================================================================================================
//=================================================================================================================
require_once( BASEPATH .'database/DB.php' );
$db =& DB();
$query = $db->select('businessname')->where('role_id',2)->get( 'user' );
$result = $query->result();
foreach( $result as $row )
{
    $route[ $row->businessname.'-biz' ] = 'home';
}
/* pages routes */
$route['home'] = "home";
$route['contact_us'] = "home/contact_us";
$route['pages/(:any)'] = "home/pages_description";
$route['test'] = "home/test";
$route['author'] = "home/author";

$route['import_shopstyle_data'] = "frontend/products/importShopStyleData";

$route['update_inventory'] = "frontend/products/updateInventory";
$route['update_inventory_price'] = "frontend/products/updateInventoryPrice";

$route['update_pricing'] = "frontend/products/updatePricing";

/* User routes */
$route['registration'] = "frontend/users/registration";
$route['seller_update'] = "frontend/users/seller_update";
$route['seller_registration'] = "frontend/users/seller_registration";
$route['registration/(:any)'] = "frontend/users/registration";
$route['login'] = "frontend/users/login";
$route['activate_account/(:any)/(:any)'] = "frontend/users/activate_account";
$route['logout'] = "frontend/users/logout";
$route['forgot_password'] = "frontend/users/forget_password";
$route['reset_password/(:any)'] = "frontend/users/reset_password";
$route['change_password/(:any)'] = "frontend/users/change_password";
$route['update_user_profile'] = "frontend/users/update_user_profile";
$route['update_user_security_profile'] = "frontend/users/update_user_security_profile";
$route['upload_user_pic'] = "frontend/users/upload_user_pic";
$route['refer_friend'] = "frontend/users/refer_friend";
$route['reffered_friend'] = "frontend/users/reffered_friend";
$route['my_account'] = "frontend/users/myAccount";
$route['profile'] = "frontend/users/Profile";
$route['security_profile'] = "frontend/users/security_profile";

$route['ajax_addresses'] = "frontend/users/ajax_addresses";
$route['ajax_card'] = "frontend/users/ajax_card";
$route['addresses'] = "frontend/users/addresses";

$route['addresses/(:any)'] = "frontend/users/addresses";



$route['seller_payment_method'] = "frontend/users/addSellerPaymentMethod";
$route['seller_payment_method/(:any)'] = "frontend/users/addSellerPaymentMethod";

$route['payment_method'] = "frontend/users/addPaymentMethod";

$route['payment_method/(:any)'] = "frontend/users/addPaymentMethod";




$route['my_orders'] = "frontend/users/myOrders";
$route['view_payment_summary'] = "frontend/products/ViewPaymentSummary";
$route['upload_tracking'] = "frontend/products/uploadTracking";

$route['fullFill_orders_pending'] = "frontend/products/fullFillOrdersPending";

$route['fullFill_orders_pending/(:any)'] = "frontend/products/fullFillOrdersPending";

$route['orders_listing'] = "frontend/products/orders_listing";

$route['orders_listing/(:any)'] = "frontend/products/orders_listing";




$route['ratings_and_feedbacks'] = "frontend/users/ViewRatingsFeedbacks";
$route['ratings_and_feedbacks/(:any)'] = "frontend/users/ViewRatingsFeedbacks";


$route['view_sales_refunds'] = "frontend/users/viewSalesRefunds";
$route['export_sales_refunds'] = "frontend/users/exportSalesRefunds";
$route['export_my_orders'] = "frontend/users/exportMyOrders";
$route['export_feedbacks'] = "frontend/users/export_feedbacks";


$route['print_order/(:any)'] = "frontend/users/printOrder";

$route['payment_summary'] = "frontend/users/paymentSummary";
$route['payment_details'] = "frontend/users/paymentDetails";

$route['order_tracking'] = "frontend/products/OrderTracking";

$route['my_orderdetails/(:any)'] = "frontend/users/myOrdersDetails";


$route['my_trackingtails/(:any)'] = "frontend/users/OrderTrackingDetails";


//$route['books_upload'] = "frontend/users/uploadInventory";

$route['update_active_layout/(:any)'] = "frontend/users/setActiveLayout";
$route['request_cashout'] = "frontend/users/requestCashout";
$route['set_layout/(:any)'] = "frontend/users/setGuestLayout";

$route['email_notifications'] = "frontend/users/EmailNotifications";
$route['pricing_rules'] = "frontend/products/PricingRules";
$route['assign_pricing/(:any)'] = "frontend/products/assign_pricing";

$route['pricing_rules/(:num)'] = "frontend/products/PricingRules";


$route['apply_pricing_rules/(:num)'] = "frontend/products/ApplyPricingRules";


//$route['pricing_rules/(:num)'] = "frontend/users/PricingRules";

$route['add_skus/(:num)'] = "frontend/users/add_skus";





$route['add_store'] = "frontend/users/addStore";



/* stores routes */
$route['stores'] = "frontend/stores";
$route['stores/(:num)'] = "frontend/stores";
$route['stores/site_redirect/(:any)'] = "frontend/stores/storeLinkRedirect";

/* products routes */
$route['suggestion-search-ajax'] = "frontend/products/getSearchSuggestionResult";
$route['products'] = "frontend/products/index";

$route['products/(:num)'] = "frontend/products/index";
$route['products/retailer_redirect/(:any)'] = "frontend/products/loadRetailer";
$route['product/detail/(:any)'] = "frontend/products/productDetail";

$route['product/checkout'] = "frontend/products/checkOut";
$route['product/addRatings'] = "frontend/products/addRatings";
$route['product/payment_success'] = "frontend/cart/payment_success";

$route['add_inventory'] = "frontend/products/addInventory";
$route['upload_inventory'] = "frontend/products/uploadInventory";


$route['seller_inventory'] = "frontend/products/SellerInventory";
$route['edit_inventory'] = "frontend/products/editInventory";
$route['edit_inventory/(:any)'] = "frontend/products/editInventory";

$route['export_inventory'] = "frontend/products/exportInventory";

$route['update_all_inventory'] = "frontend/products/updateAllInventory";

$route['delete_all_inventory'] = "frontend/products/deleteAllInventory";


$route['refund'] = "frontend/cart/Refund";
$route['ajax_cancel_order'] = "frontend/cart/CancelOrder";


$route['refund/(:any)'] = "frontend/cart/Refund";

$route['load_sell_item'] = "frontend/products/loadSellItem";
$route['add_seller_product'] = "frontend/products/addSellerProduct";
$route['ajax_add_seller_product'] = "frontend/products/AjaxaddSellerProduct";


$route['add_seller_product/(:num)'] = "frontend/products/addSellerProduct";



$route['cart/update-qty-product'] = "frontend/cart/updateQtyProduct";
$route['cart/add-to-cart'] = "frontend/cart/addToCart";
$route['cart/remove/(:num)'] = "frontend/cart/remove";
$route['cart/purchase'] = "frontend/cart/purchase";
$route['cart/purchase/(:any)/(:any)'] = "frontend/cart/purchase";

$route['cart/update_coupon'] = "frontend/cart/updateCoupon";




//=================================================================================================================
//=================================================================================================================
//============================================== Admin Panel Routing ==============================================
//=================================================================================================================
//=================================================================================================================

/* Admin routes */
$route['admin'] = 'admin/admin_logins/index';
$route['admin/dashboard'] = "admin/admin";
$route['admin/do_login'] = "admin/admin_logins/admin_portal";
$route['admin/admin_logout'] = "admin/admin/admin_logout";
$route['admin/profile'] = "admin/admin/profile";
$route['admin/forgot_password'] = "admin/admin/forgot_password";
$route['admin/reset_password/(:any)'] = "admin/admin/reset";
$route['admin/confirm_password'] = "admin/admin/confirm_pass";
$route["admin/author"] = "admin/admin/author";
$route["author_add"] = "admin/admin/author_add";
$route["author_create"] = "admin/admin/author_create";
$route["edit_author/(:any)"] = "admin/admin/edit_auth/$1";
$route["author_update"] = "admin/admin/update_auth";
$route["delete_author/(:any)"] = "admin/admin/delete_author/$1";

/* Manage Settings */
$route['admin/settings'] = "admin/adminSettingsManagement/index";

/* Manage Users */
$route['admin/users'] = "admin/adminUserManagement";
$route['admin/users/index'] = "admin/adminUserManagement/index";
$route['admin/users/(:num)'] = "admin/adminUserManagement/index";
$route['admin/users/add'] = "admin/adminUserManagement/add"; 
$route['admin/users/edit/(:num)/(:any)'] = "admin/adminUserManagement/edit";

$route['admin/users/BlockSellerListing/(:any)/(:any)/(:any)'] = "admin/adminUserManagement/BlockSellerListing";
$route['admin/users/UnBlockSellerListing/(:any)/(:any)/(:any)'] = "admin/adminUserManagement/UnBlockSellerListing";


$route['admin/users/delete/(:num)/(:any)'] = "admin/adminUserManagement/delete";
$route['admin/users/update_status/(:num)/(:any)/(:num)'] = "admin/adminUserManagement/updateStatus";
$route['admin/users/access_rights/(:num)/(:any)'] = "admin/adminUserManagement/accessRights";
$route['admin/users/validate_businessname'] = "admin/adminUserManagement/validateBusinessname";
$route['admin/users/view_payment_summary'] = "admin/adminUserManagement/view_payment_summary";
$route['admin/users/export_sales_refunds'] = "admin/adminUserManagement/exportSalesRefunds";

/* Manage Categories */
$route['admin/categories'] = "admin/adminCategoryManagement";
$route['admin/categories/index'] = "admin/adminCategoryManagement/index";
$route['admin/categories/(:num)'] = "admin/adminCategoryManagement/index";
$route['admin/categories/add'] = "admin/adminCategoryManagement/add";
$route['admin/categories/edit/(:num)/(:any)'] = "admin/adminCategoryManagement/edit";
$route['admin/categories/delete/(:num)/(:any)'] = "admin/adminCategoryManagement/delete";
$route['admin/categories/update_status/(:num)/(:any)/(:num)'] = "admin/adminCategoryManagement/updateStatus";

/* Manage Products */
$route['admin/products'] = "admin/adminProductsManagement";
$route['admin/products/index'] = "admin/adminProductsManagement/index";
$route['admin/products/(:num)'] = "admin/adminProductsManagement/index";
$route['admin/products/add'] = "admin/adminProductsManagement/add";


$route['admin/products/seller_rejections'] = "admin/adminProductsManagement/sellerRejections";
$route['admin/products/seller_rejections/(:num)'] = "admin/adminProductsManagement/sellerRejections";


$route['admin/products/upload'] = "admin/adminProductsManagement/upload_products";


$route['admin/products/edit/(:num)/(:any)'] = "admin/adminProductsManagement/edit";
$route['admin/products/delete/(:num)/(:any)'] = "admin/adminProductsManagement/delete";
$route['admin/products/update_status/(:num)/(:any)/(:num)'] = "admin/adminProductsManagement/updateStatus";
$route['admin/products/import_products'] = "admin/adminProductsManagement/importProducts";

















$route['admin/orders'] = "admin/adminOrdersManagement";
$route['admin/orders/index'] = "admin/adminOrdersManagement/index";
$route['admin/orders/(:num)'] = "admin/adminOrdersManagement/index";
$route['admin/orders/add'] = "admin/adminOrdersManagement/add";

$route['admin/orders/upload'] = "admin/adminOrdersManagement/upload_orders";


$route['admin/orders/edit/(:num)/(:any)'] = "admin/adminOrdersManagement/edit";
$route['admin/orders/delete/(:num)/(:any)'] = "admin/adminOrdersManagement/delete";
$route['admin/orders/update_status/(:num)/(:any)/(:num)'] = "admin/adminOrdersManagement/updateStatus";









/* Manage Pages */
$route['admin/pages'] = "admin/adminPagesManagement";
$route['admin/pages/index'] = "admin/adminPagesManagement/index";
$route['admin/pages/(:num)'] = "admin/adminPagesManagement/index";
$route['admin/pages/add'] = "admin/adminPagesManagement/add";
$route['admin/pages/edit/(:num)/(:any)'] = "admin/adminPagesManagement/edit";
$route['admin/pages/delete/(:num)/(:any)'] = "admin/adminPagesManagement/delete";
$route['admin/pages/update_status/(:num)/(:any)/(:num)'] = "admin/adminPagesManagement/updateStatus";
$route['admin/pages/change_page_slug'] = "admin/adminPagesManagement/changePageSlug";

/* Manage Layouts */
$route['admin/layouts'] = "admin/adminLayoutsManagement";
$route['admin/layouts/index'] = "admin/adminLayoutsManagement/index";
$route['admin/layouts/(:num)'] = "admin/adminLayoutsManagement/index";
$route['admin/layouts/add'] = "admin/adminLayoutsManagement/add";
$route['admin/layouts/edit/(:num)/(:any)'] = "admin/adminLayoutsManagement/edit";
$route['admin/layouts/delete/(:num)/(:any)'] = "admin/adminLayoutsManagement/delete";

/* Manage Api */
$route['admin/api'] = "admin/adminApiManagement";
$route['admin/api/index'] = "admin/adminApiManagement/index";
$route['admin/api/(:num)'] = "admin/adminApiManagement/index";
$route['admin/api/add'] = "admin/adminApiManagement/add";
$route['admin/api/edit/(:num)/(:any)'] = "admin/adminApiManagement/edit";
$route['admin/api/delete/(:num)/(:any)'] = "admin/adminApiManagement/delete";
$route['admin/api/update_status/(:num)/(:any)/(:num)'] = "admin/adminApiManagement/updateStatus";

/* vouchers Routes */
$route['admin/language_variables'] = "admin/adminLanguageManagement/index";
$route['admin/language_variables/(:num)'] = "admin/adminLanguageManagement/index";
$route['admin/language_variables/add'] = "admin/adminLanguageManagement/add";
$route['admin/language_variables/edit/(:num)/(:any)'] = "admin/adminLanguageManagement/edit";


/* Coupon Routes */
$route['admin/coupon'] = "admin/adminCouponManagement/index";
$route['admin/coupon/(:num)'] = "admin/adminCouponManagement/index";
$route['admin/coupon/add'] = "admin/adminCouponManagement/create";
$route['admin/coupon/edit/(:num)/(:any)'] = "admin/adminCouponManagement/edit";
$route['admin/coupon/delete/(:num)/(:any)'] = "admin/adminCouponManagement/delete";


$route['admin/ratings'] = "admin/adminRatingsManagement/index";
$route['admin/ratings/(:num)'] = "admin/adminRatingsManagement/index";

$route['admin/ratings/edit/(:num)/(:any)'] = "admin/adminRatingsManagement/edit";
$route['admin/ratings/delete/(:num)/(:any)'] = "admin/adminRatingsManagement/delete";


//////////////////////////// author sorting /////////////////
$route["sort_record"] = "home/sort_record";
$route["get_category"] = "getCategory/getCategory_record";


//////////////////////////////////// Get API Bookumbrella /////////////////////////

$route["update_profile_byer"] = "bookumbrellaApi/update_profile_byer";
$route["get_category"] = "bookumbrellaApi/getCategory_record";
$route["get_product"] = "bookumbrellaApi/getProduct_record";
$route["get_product_detail/(:any)"] = "bookumbrellaApi/getProduct_detail/$1";
$route['checkout'] = "bookumbrellaApi/checkOut";
$route['save_order'] = "bookumbrellaApi/purchase";
$route['save_order/(:any)/(:any)'] = "bookumbrellaApi/purchase";
$route['product_category'] = "bookumbrellaApi/productCategory";
$route['product_by_category/(:any)'] = "bookumbrellaApi/productByCategory/$1";
$route['order_history'] = "bookumbrellaApi/orderHistory";
$route["refund"] = "bookumbrellaApi/refundPayment";
$route["cancel_order"] = "bookumbrellaApi/cancelOrder";
$route["book_condition"] = "bookumbrellaApi/book_condition";
$route["book_type"] = "bookumbrellaApi/book_type";
$route["book_isbn"] = "bookumbrellaApi/book_isbn";
$route["search"] = "bookumbrellaApi/search";
$route["social_login"] = "bookumbrellaApi/social_login";
