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
$route['import_shopstyle_data'] = "frontend/products/importShopStyleData";

/* User routes */
$route['registration'] = "frontend/users/registration";
$route['registration/(:any)'] = "frontend/users/registration";
$route['login'] = "frontend/users/login";
$route['activate_account/(:any)/(:any)'] = "frontend/users/activate_account";
$route['logout'] = "frontend/users/logout";
$route['forgot_password'] = "frontend/users/forget_password";
$route['reset_password/(:any)'] = "frontend/users/reset_password";
$route['change_password/(:any)'] = "frontend/users/change_password";
$route['update_user_profile'] = "frontend/users/update_user_profile";
$route['upload_user_pic'] = "frontend/users/upload_user_pic";
$route['refer_friend'] = "frontend/users/refer_friend";
$route['reffered_friend'] = "frontend/users/reffered_friend";
$route['my_account'] = "frontend/users/myAccount";

$route['books_upload'] = "frontend/users/uploadInventory";

$route['update_active_layout/(:any)'] = "frontend/users/setActiveLayout";
$route['request_cashout'] = "frontend/users/requestCashout";
$route['set_layout/(:any)'] = "frontend/users/setGuestLayout";
$route['payment_method/(:any)'] = "frontend/users/addPaymentMethod";

/* favourites routes */
$route['favourites/(:any)'] = "frontend/favourites/add_favourites";
$route['favourites'] = "frontend/favourites/add_favourites";
$route['remove_favourites/(:any)'] = "frontend/favourites/remove_favourites";
$route['remove_favourites'] = "frontend/favourites/remove_favourites";

/* stores routes */
$route['stores'] = "frontend/stores";
$route['stores/(:num)'] = "frontend/stores";
$route['stores/site_redirect/(:any)'] = "frontend/stores/storeLinkRedirect";

/* products routes */
$route['products'] = "frontend/products/index";

$route['products/(:num)'] = "frontend/products/index";
$route['products/retailer_redirect/(:any)'] = "frontend/products/loadRetailer";
$route['product/detail/(:any)'] = "frontend/products/productDetail";
$route['add_inventory'] = "frontend/products/addInventory";
$route['edit_inventory'] = "frontend/products/editInventory";
$route['edit_inventory/(:num)'] = "frontend/products/editInventory";
$route['load_sell_item'] = "frontend/products/loadSellItem";
$route['add_seller_product'] = "frontend/products/addSellerProduct";
$route['add_seller_product/(:num)'] = "frontend/products/addSellerProduct";

$route['cart/add-to-cart'] = "frontend/cart/addToCart";




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

/* Manage Settings */
$route['admin/settings'] = "admin/adminSettingsManagement/index";

/* Manage Users */
$route['admin/users'] = "admin/adminUserManagement";
$route['admin/users/index'] = "admin/adminUserManagement/index";
$route['admin/users/(:num)'] = "admin/adminUserManagement/index";
$route['admin/users/add'] = "admin/adminUserManagement/add";
$route['admin/users/edit/(:num)/(:any)'] = "admin/adminUserManagement/edit";
$route['admin/users/delete/(:num)/(:any)'] = "admin/adminUserManagement/delete";
$route['admin/users/update_status/(:num)/(:any)/(:num)'] = "admin/adminUserManagement/updateStatus";
$route['admin/users/access_rights/(:num)/(:any)'] = "admin/adminUserManagement/accessRights";
$route['admin/users/validate_businessname'] = "admin/adminUserManagement/validateBusinessname";

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


$route['admin/products/upload'] = "admin/adminProductsManagement/upload_products";


$route['admin/products/edit/(:num)/(:any)'] = "admin/adminProductsManagement/edit";
$route['admin/products/delete/(:num)/(:any)'] = "admin/adminProductsManagement/delete";
$route['admin/products/update_status/(:num)/(:any)/(:num)'] = "admin/adminProductsManagement/updateStatus";
$route['admin/products/import_products'] = "admin/adminProductsManagement/importProducts";

/* Manage Stores */
$route['admin/stores'] = "admin/adminStoresManagement";
$route['admin/stores/add'] = "admin/adminStoresManagement/add";
$route['admin/stores/delete/(:num)/(:any)'] = "admin/adminStoresManagement/delete";
$route['admin/stores/(:num)'] = "admin/adminStoresManagement/index";
$route['admin/stores/index'] = "admin/adminStoresManagement/index";
$route['admin/stores/edit/(:num)/(:any)'] = "admin/adminStoresManagement/edit";
$route['admin/stores/update_status/(:num)/(:any)/(:num)'] = "admin/adminStoresManagement/updateStatus";

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

/* Manage Cashback */
$route['admin/cashbacks'] = "admin/adminCashbacksManagement";
$route['admin/cashbacks/index'] = "admin/adminCashbacksManagement/index";
$route['admin/cashbacks/(:num)'] = "admin/adminCashbacksManagement/index";
$route['admin/cashbacks/add'] = "admin/adminCashbacksManagement/add";
$route['admin/cashbacks/edit/(:num)/(:any)'] = "admin/adminCashbacksManagement/edit";
$route['admin/cashbacks/delete/(:num)/(:any)'] = "admin/adminCashbacksManagement/delete";
$route['admin/cashbacks/update_status/(:num)/(:any)/(:any)'] = "admin/adminCashbacksManagement/updateStatus";

/* Manage Cashout */
$route['admin/cashouts'] = "admin/adminCashoutsManagement";
$route['admin/cashouts/index'] = "admin/adminCashoutsManagement/index";
$route['admin/cashouts/(:num)'] = "admin/adminCashoutsManagement/index";
$route['admin/cashouts/add'] = "admin/adminCashoutsManagement/add";
$route['admin/cashouts/edit/(:num)/(:any)'] = "admin/adminCashoutsManagement/edit";
$route['admin/cashouts/delete/(:num)/(:any)'] = "admin/adminCashoutsManagement/delete";
$route['admin/cashouts/status/(:num)/(:any)/(:any)'] = "admin/adminCashoutsManagement/updateStatus";

/* Manage Messages */
$route['admin/contect_messages'] = "admin/adminContectMessagesManagement";
$route['admin/contect_messages/(:num)'] = "admin/adminContectMessagesManagement";
$route['admin/contact_us_reply'] = "admin/adminContectMessagesManagement/contact_us_reply";

/* vouchers Routes */
$route['admin/vouchers'] = "admin/adminVoucherManagement/index";
$route['admin/vouchers/(:num)'] = "admin/adminVoucherManagement/index";
$route['admin/export/vouchers'] = "admin/adminVoucherManagement/export_excel";
$route['admin/vouchers/delete/(:num)/(:any)'] = "admin/adminVoucherManagement/delete";

/* vouchers Routes */
$route['admin/language_variables'] = "admin/adminLanguageManagement/index";
$route['admin/language_variables/(:num)'] = "admin/adminLanguageManagement/index";
$route['admin/language_variables/add'] = "admin/adminLanguageManagement/add";
$route['admin/language_variables/edit/(:num)/(:any)'] = "admin/adminLanguageManagement/edit";