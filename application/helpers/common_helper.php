<?php

if (!function_exists('get')) {
    function get($table, $where = false, $fields = '*', $order = false)
    {
        $CI = &get_instance();
        $CI->load->model('comman_model');
        $result = $CI->comman_model->get($table, $where, $fields, $order);
        if ($result) {
            return $result;
        } else {
            return FALSE;
        }
    }
}



if (!function_exists('NumericrandomKey')) {
    function NumericrandomKey($length) {
        $pool = array_merge(range(0,9));
        $key = '';
        for($i=0; $i < $length; $i++) {
            $key .= $pool[mt_rand(0, count($pool) - 1)];
        }
        return $key;
    }
}

if (!function_exists('randomKey')) {
function randomKey($length) {
    $pool = array_merge(range(0,9), range('a', 'z'),range('A', 'Z'));
    $key = '';
    for($i=0; $i < $length; $i++) {
        $key .= $pool[mt_rand(0, count($pool) - 1)];
    }
    return $key;
}
}


if (!function_exists('validateUPC')) {
function validateUPC($code){
	$length_code = strlen($code);
		$result = '';
			
		
		if($length_code!=12 && $length_code!=''){
			$result = "Only UPC of length 12 is allowed.";	
			}
		if(is_numeric($code) && $length_code!=''){
			$float_check = explode(".",$code);
		
		if(sizeof($float_check)==2)	
		$result = "Please enter only numeric UPC.";
		
		}else if($length_code!=''){
		$result = "Please enter only numeric UPC. ";	
			}
		
	return $result;
	}
}




if (!function_exists('validateISBN')) {
function validateISBN($code){
	$length_code = strlen($code);
		$result = '';
			
		
		if($length_code!=10 && $length_code!= 13 && $length_code!=''){
			$result = "ISBN of length 10 or 13 is allowed.";	
			}
		if(is_numeric($code) && $length_code!=''){
			$float_check = explode(".",$code);
		
		if(sizeof($float_check)==2)	
		$result = "Please enter only numeric ISBN.";
		
		}else if($length_code!=''){
		$result = "Please enter only numeric ISBN. ";	
			}
		
	return $result;
	}
}





if (!function_exists('validateISBN10')) {
function validateISBN10($code){
	$length_code = strlen($code);
		$result = '';
			
		
		if( $length_code!= 10){
			$result = "ISBN of length  10 is allowed.";	
			}
		if(is_numeric($code) && $length_code!=''){
			$float_check = explode(".",$code);
		
		if(sizeof($float_check)==2)	
		$result = "Please enter only numeric ISBN.";
		
		}else if($length_code!=''){
		$result = "Please enter only numeric ISBN. ";	
			}
		
	return $result;
	}
}


if (!function_exists('validateISBN13')) {
function validateISBN13($code){
	$length_code = strlen($code);
		$result = '';
			
		
		if( $length_code!= 13){
			$result = "ISBN of length  13 is allowed.";	
			}
		else if(is_numeric($code) && $length_code!=''){
			$float_check = explode(".",$code);
		
		if(sizeof($float_check)==2)	
		$result = "Please enter only numeric ISBN.";
		
		}else if($length_code!=''){
		
		$result = "Please enter only numeric ISBN. ";	
		
			}
		
	return $result;
	}
}




if (!function_exists('getRating'))
{
    function getRating($id,$rating_array = array())
    {
        $CI = & get_instance();
        $CI->load->model('comman_model');
        $total_rating = 0;
        //$result = array('rating' => 0, 'votes' => 0);
        $where = array('seller_id' => $id);
        $result['total_votes']= $total_vots = $CI->comman_model->get_total('rating',$where);
        $ratings = $CI->comman_model->get('rating',$where,'no_stars');
        $item_arrived_due_time = $CI->comman_model->get_total('rating',array('seller_product_id' => $id, 'item_arrived_due_time'=>'Yes'));
        $item_was_as_described = $CI->comman_model->get_total('rating',array('seller_product_id' => $id, 'item_was_as_described'=>'Yes'));
        $prompt_courtesy = $CI->comman_model->get_total('rating',array('seller_product_id' => $id, 'prompt_courtesy'=>'Yes'));
        if($ratings){
                foreach ($ratings as $rating) {
                    $total_rating += $rating['no_stars'];
                }
                $rating = round($total_rating/$total_vots,1);
                $floor_rating = floor($total_rating/$total_vots);
                if($rating_array){
                    if(!in_array($floor_rating, $rating_array))
                        return false;
                }
                if(($floor_rating + .5) == $rating){
                    $total_rating = $rating;
                }
                else if(($floor_rating + .5) < $rating){
                    $total_rating = $floor_rating + .5; 
                }else{
                    $total_rating = $floor_rating;
                }
            $result['item_arrived_due_time'] = ($item_arrived_due_time/$total_vots)*100;
            $result['item_was_as_described'] = ($item_was_as_described/$total_vots)*100;
            $result['prompt_courtesy'] = ($prompt_courtesy/$total_vots)*100;
            $result['total_rating']=$total_rating;        
        }else{
            $result['item_arrived_due_time'] = 0;
            $result['item_was_as_described'] = 0;
            $result['prompt_courtesy'] = 0;
            $result['total_rating']= 0;
        }

        if($rating_array && $total_rating==0){
            return false;
        }
        
        
        
        return $result;  
      
        
    }
}

if (!function_exists('getSellersCountries'))
{
    function getSellersCountries($id)
    {
        $CI = & get_instance();
        $CI->load->model('comman_model');
        $id = decode_uri($id);
        $result = $total_vots = $CI->comman_model->getSellersCountries($id);

        return $result;       
    }
}


if (!function_exists('getSingleRecord')) {
    function getSingleRecord($table, $where = false, $fields = '*', $order = false)
    {
        $CI = &get_instance();
        $CI->load->model('comman_model');
        $result = $CI->comman_model->get($table, $where, $fields, $order);
        if ($result) {
            return $result[0];
        } else {
            return FALSE;
        }
    }
}

if (!function_exists('get_total')) {
    function get_total($table, $where = false)
    {
        $CI = &get_instance();
        $CI->load->model('comman_model');
        $result = $CI->comman_model->get_total($table, $where);
        if ($result) {
            return $result;
        } else {
            return 0;
        }
    }
}

if (!function_exists('debug')) {
    function debug($data, $stop = 0)
    {
        echo "<pre>";
        print_r($data);
        echo "</pre>";

        if ($stop) {
            die;
        }
    }
}

if (!function_exists('getCurrentUserId')) {
    function getCurrentUserId()
    {
        $CI = &get_instance();
        $CI->load->library('session');
        $sessionUserData = $CI->session->all_userdata();

        if (isset($sessionUserData['admin_user_id'])) {
            return $sessionUserData['admin_user_id'];
        } else {
            if(isset($sessionUserData['user_id'])){
                return $sessionUserData['user_id'];
            } else {
                return 0;
            }
        }
    }
}

if (!function_exists('getUserEmail')) {
    function getUserEmail($table, $where = false)
    {
        $CI = &get_instance();
        $CI->load->model('comman_model');
        $result = $CI->comman_model->get($table, $where);
        if ($result) {
            return $result[0]['email'];
        } else {
            return FALSE;
        }
    }
}

if (!function_exists('getUserCountry')) {
    function getUserCountry()
    {
        $CI = &get_instance();
        $CI->load->model('comman_model');
        $result = $CI->comman_model->get('user', array('user_id' => $CI->session->userdata('user_id')));
        if ($result) {
            return $result[0]['country'];
        } else {
            return FALSE;
        }
    }
}


if (!function_exists('adminRecordNotFoundMsg')) {
    function adminRecordNotFoundMsg()
    {
        $notFoundHtml =
            '<div class="alert alert-warning margin-top-15"> ' .
            'Record not found... !' .
            '</div>';
        echo $notFoundHtml;
    }
}

if (!function_exists('getSettings')) {
    function getSettings($name)
    {
        $CI = &get_instance();
        $CI->load->model('comman_model');
        $result = $CI->comman_model->get('setting', array('slug' => $name));

        if ($result) {
            return $result[0];
        } else {
            return FALSE;
        }
    }
}

if (!function_exists('getSuperAdminId')) {
    function getSuperAdminId()
    {
        $CI = &get_instance();
        $CI->load->model('comman_model');
        $result = $CI->comman_model->get('user',array('role_id' => 1),array('user_id'));

        if ($result) {
            return $result[0]['user_id'];
        } else {
            return FALSE;
        }
    }
}

if (!function_exists('getUserData')) {
    function getUserData($user_id)
    {
        $CI = &get_instance();
        $CI->load->model('comman_model');
        $result = $CI->comman_model->get('user',array('user_id' => $user_id));

        if ($result) {
            return $result[0];
        } else {
            return FALSE;
        }
    }
}

if (!function_exists('getUserDataByEmail')) {
    function getUserDataByEmail($email)
    {
        $CI = &get_instance();
        $CI->load->model('comman_model');
        $result = $CI->comman_model->get('user',array('email' => $email));

        if ($result) {
            return $result[0];
        } else {
            return FALSE;
        }
    }
}

if (!function_exists('getUsername')) {
    function getUsername($user_id,$full_name = false)
    {
        $CI = &get_instance();
        $CI->load->model('comman_model');
        $result = $CI->comman_model->get('user',array('user_id' => $user_id));

        if ($result) {
            if($full_name){
                return $result[0]['first_name']." ".$result[0]['last_name'];
            } else {
                return $result[0]['username'];
            }
        } else {
            return 'N/A';
        }
    }
}

if (!function_exists('getSettingValue')) {
    function getSettingValue($name)
    {
        $CI = &get_instance();
        $CI->load->model('comman_model');
        $result = $CI->comman_model->get('setting', array('slug' => $name));

        if ($result) {
            return $result[0]['value'];
        } else {
            return FALSE;
        }
    }
}

if (!function_exists('getAdminEmail')) {
    function getAdminEmail()
    {
        $CI = &get_instance();
        $CI->load->model('comman_model');
        $result = $CI->comman_model->get('user', array('user_id' => 1));

        if ($result) {
            return $result[0]['email'];
        } else {
            return FALSE;
        }
    }
}

if (!function_exists('getRoleName')) {
    function getRoleName($role_id)
    {
        $CI = &get_instance();
        $CI->load->model('comman_model');
        $result = $CI->comman_model->get('user_roles', array('role_id' => $role_id));

        if ($result) {
            return $result[0]['title'];
        } else {
            return 'N/A';
        }
    }
}

if (!function_exists('create_slug')) {
    function create_slug($string)
    {
        $slug = trim($string);
        $slug = strtolower($slug);
        $slug = str_replace(' ', '_', $slug);

        return $slug;
    }
}

if (!function_exists('slugToTitle')) {
    function slugToTitle($slug)
    {
        $string = trim($slug);
        $string = strtolower($string);
        $string = str_replace('_', ' ', $string);
        $string = ucwords($string);

        return $string;
    }
}

if (!function_exists('check_is_login')) {
    function check_is_login($madule_id)
    { 
	
	
        $CI = &get_instance();
        $CI->load->library('session');

        $CI_uri = &get_instance();
		
        if ($CI->session->userdata('admin_role_id') != (1 || 2) || $CI->session->userdata('admin_role_id') == '') {
            
			if ($CI_uri->uri->segment(1) == 'admin' && $CI_uri->uri->segment(2) != '' && $CI_uri->uri->segment(2) != 'do_login' && $CI_uri->uri->segment(2) != 'changePageSlug') {
                redirect('admin');
            }
        } else {

            if ($CI_uri->uri->segment(1) == 'admin' && $CI_uri->uri->segment(2) == '') {

                if ($CI->session->userdata('admin_role_id') == (1 || 2) && $CI->session->userdata('admin_role_id') != '') {
                    redirect('admin/dashboard');
                }
            }
            
            if($madule_id && !in_array($madule_id, $CI->session->userdata('admin_rights'))){
                    redirect('admin/dashboard');
            }
        }
    }
}

if (!function_exists('get_admin_avatar')) {
    function get_admin_avatar()
    {
        $CI = &get_instance();
        $CI->load->library('session');
        $admin_pic = $CI->session->userdata('admin_avatar');
        $admin_image_url = "";

        if ($admin_pic) {
            $admin_image_url = base_url('uploads/img_gallery/admin_images') . "/" . $admin_pic;
        } else {
            $admin_image_url = base_url('assets/frontend/img/avatar.png');
        }

        return $admin_image_url;
    }
}

if (!function_exists('get_user_avatar')) {
    function get_user_avatar()
    {
        $CI = &get_instance();
        $CI->load->library('session');
        $user_pic = $CI->session->userdata('avatar');
        $user_image_url = base_url('assets/frontend/img/avatar.png');

        if ($user_pic) {
            $user_image_url = base_url('uploads/img_gallery/user_images') . "/" . $user_pic;
        }

        return $user_image_url;
    }
}

if (!function_exists('imageSizes')) {
    function imageSizes()
    {
        $imageSizes = array(
            'thumbnail' => array(
                array(377, 287)
            )
        );

        return $imageSizes;
    }
}

if (!function_exists('getProductImage')) {
    function getProductImage($product_id, $size = '', $productImage = '')
    {
        $CI = &get_instance();
        $CI->load->model('comman_model');

        $product_data = array();

        if(!$productImage){
            $product_data = $CI->comman_model->get('products', array('product_id' => $product_id));
        }

        $prod_img_base = base_url('uploads/img_gallery/product_images') . "/";
        $image_url = base_url('assets/frontend/img/default-cart.jpg');

        if ($product_data || $productImage) {

            if(!$productImage){
                $product_data = $product_data[0];
                $productImage = $product_data['image'];
            }

            if ($productImage) {
                $isOnlineImg = strpos($productImage, 'http') === false ? 0 : 1;

                if (!$isOnlineImg) {
                    if ($size != '') {
                        if ($size == 'thumbnail') {
                            $image_url = $prod_img_base . getResizeImageName($productImage);
                        }
                    } else {
                        $image_url = $prod_img_base . $productImage;
                    }
                } else {
                    $image_url = $productImage;
                }
            }
        }

        return $image_url;
    }
}

if (!function_exists('getStoreImage')) {
    function getStoreImage($store_id, $size = '', $storeImage='')
    {
        $CI = &get_instance();
        $CI->load->model('comman_model');

        $store_data = array();

        if(!$storeImage){
            $store_data = $CI->comman_model->get('store', array('store_id' => $store_id));
        }

        $store_img_base = base_url('uploads/img_gallery/store_images') . "/";
        $image_url = base_url('assets/frontend/img/default-store.jpg');

        if ($store_data || $storeImage) {

            if(!$storeImage){
                $store_data = $store_data[0];
                $storeImage = $store_data['image_url'];
            }

            if ($storeImage) {
                $isOnlineImg = strpos($storeImage, 'http') === false ? 0 : 1;

                if (!$isOnlineImg) {
                    if ($size != '') {
                        if ($size == 'thumbnail') {
                            $image_url = $store_img_base . getResizeImageName($storeImage);
                        }
                    } else {
                        $image_url = $store_img_base . $storeImage;
                    }
                } else {
                    $image_url = $storeImage;
                }
            }
        }

        return $image_url;
    }
}

if (!function_exists('getSettingsImage')) {
    function getSettingsImage($image)
    {
        $CI = &get_instance();

        $prod_img_base = base_url('uploads/settings_gallery') . "/";
        $image_url = base_url('assets/frontend/img/avatar.png');

        if ($image) {
            $image_url = $prod_img_base . $image;
        }

        return $image_url;
    }
}

if (!function_exists('getResizeImageName')) {
    function getResizeImageName($image_name, $size = 'thumbnail')
    {
        $imageCustomName = '';

        if ($image_name) {
            $fileInfo = pathinfo($image_name);
            $imageSizes = imageSizes();

            if ($size == 'thumbnail') {
                $thumbnailDimensionsString = $imageSizes['thumbnail'][0][0] . 'x' . $imageSizes['thumbnail'][0][1];
                $imageCustomName = $fileInfo['filename'] . '_' . $thumbnailDimensionsString . '.' . $fileInfo['extension'];
            }

        } else {
            $imageCustomName = $image_name;
        }

        return $imageCustomName;
    }
}

if (!function_exists('getWebsiteLogo')) {
    function getWebsiteLogo()
    {
        return getSettingsImage(getSettingValue('upload_logo'));
    }
}

if (!function_exists('getWebsiteFavicon')) {
    function getWebsiteFavicon()
    {
        return getSettingsImage(getSettingValue('upload_favicon'));
    }
}

if (!function_exists('getSelectedLayout')) {
    function getSelectedLayout()
    {
        $getSelectedLayout = getSettingValue('active_layout');

        if(isset($_COOKIE['innostart_selected_layout'])) {
            $getSelectedLayout = $_COOKIE['innostart_selected_layout'];
        }

        if(!$getSelectedLayout){
            $getSelectedLayout = 1;
        }

        return $getSelectedLayout;
    }
}

if (!function_exists('getLayoutBannerImg')) {
    function getLayoutBannerImg($activeLayoutData = array())
    {
        $layoutImg = '';
        $defaultImg = base_url().'assets/frontend/img/top-default-banner.jpg';

        if(!$activeLayoutData){
            $activeLayoutData = getActiveLayoutStyles();
        }

        if($activeLayoutData) {
            $banner_img = $activeLayoutData['banner_image'];

            if($banner_img){
                $layoutImg = base_url('uploads/layout_gallery/'.$activeLayoutData['banner_image']);
            }
        }

        if(!$layoutImg) {
            $layoutImg = $defaultImg;
        }

        return $layoutImg;
    }
}

if (!function_exists('getActiveLayoutStyles')) {
    function getActiveLayoutStyles()
    {
        $CI = &get_instance();
        $CI->load->model('comman_model');

        $activeLayoutId = getSelectedLayout();

        $stylesList = get('layouts', array('id' => $activeLayoutId));

        if ($stylesList) {
            $stylesList = $stylesList[0];
        } else {
            $stylesList = array();
        }

        return $stylesList;
    }
}

if (!function_exists('get_client_ip')) {
    function get_client_ip()
    {
        $ip_address = '';

        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ip_address = $_SERVER['HTTP_CLIENT_IP'];
        else if (isset($_SERVER['REMOTE_ADDR']))
            $ip_address = $_SERVER['REMOTE_ADDR'];
        else if (isset($_SERVER['HTTP_FORWARDED']))
            $ip_address = $_SERVER['HTTP_FORWARDED'];
        else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ip_address = $_SERVER['HTTP_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_X_FORWARDED']))
            $ip_address = $_SERVER['HTTP_X_FORWARDED'];
        else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else
            $ip_address = 'UNKNOWN';

        return $ip_address;
    }
}

/*
 * $arg is array of arguments contains id's to get network_id
 * Available args: cat_id, product_id, store_id
 */
if (!function_exists('getNetworkId')) {
    function getNetworkId($arg)
    {
        $CI = &get_instance();
        $CI->load->model('comman_model');
        return $CI->comman_model->getNetworkId($arg);
    }
}

if (!function_exists('getCashBackValue')) {
    function getCashBackValue($arg)
    {
        $CI = &get_instance();
        $CI->load->model('comman_model');

        $network_id = 0;
        $result = array();

        if($arg){
            if(isset($arg['network_id'])){
                $network_id = $arg['network_id'];
            } else {
                $network_id = getNetworkId($arg);
            }

            $result = $CI->comman_model->get('network',array('network_id'=>$network_id));
        }

        if ($result) {
            $result = $result[0]['cashback'];
            return $result ? $result:0;
        } else {
            return 0;
        }
    }
}

if (!function_exists('getLayouts')) {
    function getLayouts()
    {

        $layouts_data = get('layouts');

        if ($layouts_data) {
            return $layouts_data ? $layouts_data:0;
        } else {
            return array();
        }
    }
}

if (!function_exists('getlanguage')) {
    function getlanguage($label)
    {
        $CI = &get_instance();
        $CI->load->model('comman_model');
        $result = $CI->comman_model->get('language_variable', array('label' => $label));
        if ($result) {
            return $result[0]['value'];
        } else {
            return ucwords(str_replace('-', ' ', $label));
        }
    }
}

if (!function_exists('getRequestCashoutUrl')) {
    function getRequestCashoutUrl($user_id)
    {
        $havePaymentMethod = havePaymentMethodInfo($user_id);

        if($havePaymentMethod){
            $requestCashbackUrl = base_url('request_cashout');
        } else {
            $requestCashbackUrl = base_url('payment_method').'/'.encode_url($user_id);
        }

        return $requestCashbackUrl;
    }
}

if (!function_exists('havePaymentMethodInfo')) {
    function havePaymentMethodInfo($user_id)
    {
        $paymentMethod = getSingleRecord('payment_method');
        $response = 0;

        if($paymentMethod){
            $selectedPm = $paymentMethod['selected_pm'];

            if(strlen(trim($selectedPm)) > 0){
                $response = 1;
            }
        }

        return $response;
    }
}

if (!function_exists('getCategoriesNavigation')) {
    function getCategoriesNavigation($id)
    {
        $CI = &get_instance();
        $title4 = $title3 = $title2 = $title1 = false;
        $basic = $title1 = $CI->comman_model->get('category',array('category_id'=>$id));
        if($title1[0]['parent_id'] > 0){
            $title2 = $title1;
            $title1 = $CI->comman_model->get('category',array('category_id'=>$title1[0]['parent_id']));
                             }
        if($title1[0]['parent_id'] > 0){
            $title3 = $title2;
            $title2 = $title1;
            $title1 = $CI->comman_model->get('category',array('category_id'=>$title1[0]['parent_id']));
                             }
        if($title1[0]['parent_id'] > 0){
            $title4 = $title3;
            $title3 = $title2;
            $title2 = $title1;
            $title1 = $CI->comman_model->get('category',array('category_id'=>$title1[0]['parent_id']));
            }
        
        $html = '<div class="listing_header"><h2>'.$basic[0]['title'].'</h2><h5>';
        /*if($title1){
         $html.='<span><a href="#">'.$title1[0]['title'].' </a></span>';   
        }*/
        if($title2){
            $id1 = $title1[0]['category_id'] * 999;
            $id2 = $title2[0]['category_id'] * 999;
         $html.='<span><a href="javascript:void(0)" onclick="set_cat('.$id1.');">'.$title1[0]['title'].' </a></span><i class="fa fa-angle-right"></i> <span><a href="javascript:void(0)" onclick="set_cat('.$id2.');">'.$title2[0]['title'].' </a></span>';   
        }

        if($title3){
            $id3 = $title1[0]['category_id'] * 999;
         $html.='<i class="fa fa-angle-right"></i> <span><a href="javascript:void(0)" onclick="set_cat('.$id3.');">'.$title3[0]['title'].' </a></span>';   
        }
        if($title4){
            $id4 = $title1[0]['category_id'] * 999;
         $html.='<i class="fa fa-angle-right"></i> <span><a href="javascript:void(0)" onclick="set_cat('.$id4.');">'.$title4[0]['title'].' </a></span>';   
        }
        
        $html.= '</h5></div>';
        
        echo $html;
    }
}

if (!function_exists('isRated')) {
    function isRated($seller_product_id, $seller_id, $product_id, $user_id,$unique_order_id)
    {
        $CI = &get_instance();
        $CI->load->model('comman_model');
        $table = 'rating';
        $where = array('seller_product_id' => $seller_product_id,'seller_id' => $seller_id,'product_id' => $product_id,'user_id' => $user_id,'unique_order_id' => $unique_order_id);
        $already_voted = $CI->comman_model->get($table,$where);
        if($already_voted){
               return true;
        }else{
            return false;
        }
        
    }
}

if (!function_exists('listPaymentPeriod')) {
    function listPaymentPeriod()
    {
        $year = date('Y');
        $month = date('m');
        $day = date('d');
        $end_year = $year-4;
        $listPaymentPeriod = array();

        while ($year >= $end_year) {
            $days_in_current_month = cal_days_in_month(CAL_GREGORIAN, $month, $year);
            $start_payment_period = date($month.'/01/'.$year);
            $end_payment_period = date($month.'/15/'.$year);
            if($day>15){
              $start_payment_period = date($month.'/16/'.$year);
              $end_payment_period = date($month.'/'.$days_in_current_month.'/'.$year);
              $day = $day-16;
            }else{
                $day = $day-15;
                $month = $month-1;
                $day = cal_days_in_month(CAL_GREGORIAN, $month, $year);
            }
            if($month==0){
                $month=12;
                $day=31;
                $year--;
            }
            
            $period = date('m/d/y', strtotime($start_payment_period)).' - '.date('m/d/y', strtotime($end_payment_period));
            $listPaymentPeriod[] =$period;
            
        }
        return array_reverse($listPaymentPeriod);
    }
}
?>