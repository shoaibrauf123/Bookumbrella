<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

error_reporting(1);

include(APPPATH . "libraries/ShopStyle/API.php");
include(APPPATH . "libraries/ShopStyle/Query/IQuery.php");
include(APPPATH . "libraries/ShopStyle/Query/BasicQuery.php");

class Products extends CI_Controller
{
    private $_data;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('comman_model');
        $this->load->model('product_model');
        $this->load->library('PHPExcel');
		if($this->session->userdata('admin_role_id')){
			redirect('admin');
			}

	}

    private function __loadView()
    {
        if ($this->session->flashdata('success') != "")
            $this->_data['success'] = $this->session->flashdata('success');
        if ($this->session->flashdata('errors') != "")
            $this->_data['errors'] = $this->session->flashdata('errors');

        $this->load->view('frontend/home_template', $this->_data);
    }

    function table_name()
    {
        return 'products';
    }

    function index(){

        $where = array();
        $or_where = array();
		$start_from = $this->input->get('per_page');
        if (!is_numeric($start_from))
            $start_from = 0;
			
			

        //show number of product on page
        $per_page = $this->input->get('count');
        if (!is_numeric($per_page))
            $per_page = 16;
        if ($this->input->get('sort_by') != '') {
            $sort_by = $this->input->get('sort_by');
            if ($sort_by == 'name') {
                $order = array('title' => 'ASC');
            } else if ($sort_by == 'price_low') {

                $order = array('buy_price' => 'ASC');

            } else if ($sort_by == 'price_high') {

                $order = array('buy_price' => ' DESC');

            } else if ($sort_by == 'most_viewed') {

                $order = array('views' => ' DESC');

            }
        } else {
            $order = FALSE;
        }

		$listing = $this->input->get('listing');
		if($listing=='yes'){
				$title = $this->input->get('title');				
				if($title)
				{
					$or_where['title'] = trim($title);
                    $or_where['isbn'] = trim($title);
                    $or_where['isbn13'] = trim($title);
				}
		}
		
		//print_r($or_where);exit;
        //show product cagtegoty wise
		
        $searchtop = trim($this->input->get('search'));
		
		$category = $this->input->get('cat');
        if ($category !='Select Category' && $category !='') {
           // $where['category_id'] = $category ;
			
        } 

		$book_condition = $this->input->get('condition');
		$book_type = $this->input->get('type');

		if($book_condition!='')
			$where['book_condition'] = $book_condition;
		if($book_type!='')
			$where['book_type'] = $book_type;

				if ($searchtop != '') {
		            
					if($category=='keyword'){
					$or_where['advertiser_name'] = $searchtop ;
					$or_where['isbn'] = $searchtop ;
		                $or_where['isbn13'] = $searchtop ;
					$or_where['author'] = $searchtop ;
					$or_where['title'] = $searchtop ;
					}
					if($category=='publisher'){
						$or_where['advertiser_name'] = $searchtop ;	
					}
					if($category=='isbn'){
						$or_where['isbn'] = $searchtop ;
						$or_where['isbn13'] = $searchtop ;
						
					}
					if($category=='title'){
						$or_where['title'] = $searchtop ;	
					}
					if($category=='author'){
						$or_where['author'] = $searchtop ;	
					}
		        
				} 
		
	        $store = $this->input->get('store');
	        if ($store) {
	            if ($store != 'all') {
	                $where['store_id'] = $store;
	            }
	        }
	       // print_r($where);


       
        $get = $_GET;
        unset($get['per_page']);

        $suffix = '&' . http_build_query($get, '', "&");
        $config['page_query_string'] = TRUE;
        $config['base_url'] = base_url('products') . '?';
        $config['suffix'] = $suffix;
        $config['first_url'] = base_url('products') . '?' . $suffix;

		if($this->input->get('user_id')!=''){
			$where['user_id'] = $this->input->get('user_id');
			}
       $config['total_rows'] =$total_rows= $this->product_model->get_total_products('seller_products', $or_where,$where); 		 
        $this->_data['total_products'] = $config['total_rows'];
        $config['per_page'] = $per_page;
        $config['num_links'] = 6;
        $config['anchor_class'] = 'class="btn btn-primary width_auto"';
        $config['uri_segment'] = 3;
        $config['cur_tag_open'] = '&nbsp;<a class="btn btn-primary width_auto active">';
        $config['cur_tag_close'] = '</a>';

        $this->pagination->initialize($config);
        $this->_data['pagination'] = $this->pagination->create_links();
	
		$this->_data['allProducts'] = $allProducts = $this->product_model->search_products('seller_products', $per_page, $start_from,$or_where, $where, $order,$title,$or_where); 

      
        $this->load->model("admin_login");
        $this->_data["author"] = $this->admin_login->author_get();
        $this->_data['main_category'] = $this->product_model->get_main_category();
        $this->_data['stors'] = $this->comman_model->get('store', array('status' => 1));
        $this->_data['manufacture'] = $this->product_model->get_manufacture();
        $this->_data['colors'] = $this->product_model->get_colors();
       
        $this->_data['price_range'] = $this->product_model->get_price_range();
        $this->_data['main_content'] = 'frontend/products/listing';
        $this->__loadView();
    }

    function addInventory()
    {


        if ($this->session->userdata('logged_in') == TRUE) {

            $layouts_data = $this->comman_model->get('layouts');


            $this->_data['layouts'] = $layouts_data;

            $this->_data['main_content'] = 'frontend/products/add-inventory';
            $this->__loadView();

        } else {
            redirect('login');
        }


    }


    function assign_pricing()
    {


        if ($this->session->userdata('logged_in') == TRUE) {
			
			
			$action = $this->uri->segment(2);
			
			if($action == 'updateprices' &&  is_array($_POST['update_select'])){
			//echo '<pre>';print_r($_POST);exit;
			
			
					foreach($_POST['update_select'] as $key=>$val){
			
			$seller_products_id = $val;
			
			$stay_below_price = $_POST['stay_below_price'][$val];
			$stay_above_price = $_POST['stay_above_price'][$val];
			$pricing_rules_id = $_POST["pricing_rules_id"];
			$user_id = getCurrentUserId();
			
$where = array("seller_products_id"=>$seller_products_id,"pricing_rules_id"=>$pricing_rules_id);			
$already  = $this->comman_model->get('pricing_rules_products', $where);
$pricing_rules = $this->comman_model->get('pricing_rules', array("id"=>$pricing_rules_id));
			
$pricing_amount_type = $pricing_rules[0]['pricing_amount_type'];
$pricing_amount = $pricing_rules[0]['amount'];
if($already){
			
			//print_r($where);exit;
			
			
		
			$updated = $this->comman_model->delete('pricing_rules_products', $where);
			
			
}

	
			
			
			$product_detail = $this->comman_model->get("seller_products",array("id"=>$seller_products_id));
			//echo '<pre>';print_r($product_detail);exit;
			$my_old_price = $product_detail[0]['price'];
			$min_max_price = $this->product_model->getMinMax('seller_products','price',array("product_id"=>$product_detail[0]['product_id'],"id <> "=>$seller_products_id));
			
			$max_available_price = $min_max_price[0]['MAX(price)'];
			$min_available_price = $min_max_price[0]['MIN(price)'];
			
			$middle_available_value = ($max_available_price+$min_available_price)/2;
			
			$middle_choice_value = ($stay_below_price+$stay_above_price)/2;
			
			
		if($middle_available_value>=$middle_choice_value){	
			$itemData = array(
                
                
                'stay_below_price' => $stay_below_price,
                'stay_above_price' => $stay_above_price,
                'seller_products_id' => $seller_products_id,
				'pricing_rules_id' => $pricing_rules_id,
				'user_id' => $user_id,
                'date_created' => date("Y-m-d H:i:s")
            );
	
	
			
		
			
			if($pricing_amount_type == 'fixed'){
				$my_new_price = $min_available_price -  $pricing_amount;
				}else{
				
				$decrease_amount = ($min_available_price/100)*$pricing_amount;
				$my_new_price = $min_available_price -  $decrease_amount;
				
				}
			
			
			
			if($my_new_price<$stay_above_price){
				
				$my_new_price = $stay_above_price;
				
				
			}
		}else{
			$itemData = array(
			    'stay_below_price' => $stay_below_price,
                'stay_above_price' => $stay_above_price,
                'seller_products_id' => $seller_products_id,
				'pricing_rules_id' => $pricing_rules_id,
				'user_id' => $user_id,
                'date_created' => date("Y-m-d H:i:s")
            );
	
	
			
		
			
			if($pricing_amount_type == 'fixed'){
				$my_new_price = $max_available_price -  $pricing_amount;
				}else{
				
				$decrease_amount = ($max_available_price/100)*$pricing_amount;
				$my_new_price = $max_available_price -  $decrease_amount;
				
				}
			
			
			
			if($my_new_price>=$stay_below_price){
				
				$my_new_price = $stay_below_price;
				
				
			}
			}
		
			
			
			
			$this->comman_model->update('seller_products', array("id"=>$seller_products_id),array('price'=>$my_new_price));	
			$this->comman_model->save('pricing_rules_products', $itemData);
	
	
	

			
			
			
   			 //redirect("edit_inventory");
	
	
	
			
			
		}
		
		$this->session->set_flashdata('success', 'Pricing has been updated successfully.');
				
				redirect("assign_pricing/".$pricing_rules_id);
				
				}
			if($action == 'delete' &&  is_array($_POST['update_select'])){
				///echo 'dddddd';exit;
					foreach($_POST['update_select'] as $key=>$val){
			
			$seller_products_id = $val;
			
			$pricing_rules_id = $_POST["pricing_rules_id"];
			
			
			
			
			$where = array("seller_products_id"=>$seller_products_id,"pricing_rules_id"=>$pricing_rules_id);
			//print_r($where);exit;
			
			
			
			$updated = $this->comman_model->delete('pricing_rules_products', $where);
			
			
			
			
   			 //redirect("edit_inventory");
	
	
	
			
			
		}
		$this->session->set_flashdata('success', 'Pricing has been deleted successfully.');
		
		
		redirect("assign_pricing/".$pricing_rules_id);
				
				}
				
			
			
			

            $layouts_data = $this->comman_model->get('layouts');
            $this->_data['layouts'] = $layouts_data;

            //$inventory_id = $this->uri->segment(2);
            
				
				    $where = array('sp.user_id' => $this->session->userdata('user_id'));
        $or_where = array();
		$start_from = $this->input->get('per_page');
        if (!is_numeric($start_from))
            $start_from = 0;

        //show number of product on page
        $per_page = $this->input->get('count');
        if (!is_numeric($per_page))
            $per_page = 16;
        if ($this->input->get('sort_by') != '') {
            $sort_by = $this->input->get('sort_by');
            if ($sort_by == 'name') {
                $order = array('title' => 'ASC');
            } else if ($sort_by == 'price_low') {

                $order = array('buy_price' => 'ASC');

            } else if ($sort_by == 'price_high') {

                $order = array('buy_price' => ' DESC');

            } else if ($sort_by == 'most_viewed') {

                $order = array('views' => ' DESC');

            }
        } else {
            $order = FALSE;
        }
$listing = $this->input->get('listing');
		if($listing=='yes'){
				$title = $this->input->get('title');				
				if($title)
				{
					$or_where['title'] = $title;

                    $or_where['isbn'] = trim($title);
                    $or_where['isbn13'] = trim($title);
				}
		}
		
		//print_r($or_where);exit;
        //show product cagtegoty wise
		
        $searchtop = $this->input->get('search');
		
		$category = $this->input->get('cat');
        if ($category !='Select Category' && $category !='') {
            $where['category_id'] = $category ;
        } 

$book_condition = $this->input->get('condition');
$book_type = $this->input->get('type');

if($book_condition!='')
	$where['book_condition'] = $book_condition;
if($book_type!='')
	$where['book_type'] = $book_type;

		if ($searchtop != '') {
            
			$or_where['isbn'] = $searchtop ;
			$or_where['author'] = $searchtop ;
			$or_where['title'] = $searchtop ;
        
		} 
		
		//print_r($or_where);exit;
		//echo $where['category_id']; die;


        //show product by manufacture
        
        //show product by store
        $store = $this->input->get('store');
        if ($store) {
            if ($store != 'all') {
                $where['store_id'] = $store;
            }
        }

		


        //show product color wise



        //filter value range by slider
/*        $price = $this->input->get('price');
        if ($price) {
            $price_range = explode(',', $price);
            $p_min = $price_range[0];
            $p_max = $price_range[1];
            $where['price >='] = "$p_min";
            $where['price <='] = "$p_max";
        }*/


        //echo '<pre>'; print_r($where);die;
        $get = $_GET;
        unset($get['per_page']);

        $suffix = '&' . http_build_query($get, '', "&");
        $config['page_query_string'] = TRUE;
        $config['base_url'] = base_url('edit_inventory') . '?';
        $config['suffix'] = $suffix;
        $config['first_url'] = base_url('edit_inventory') . '?' . $suffix;
        //$config['total_rows'] = $this->product_model->get_total_products('products', $or_where,$where);

$config['total_rows'] = $this->product_model->get_seller_total_products('seller_products',$where, $or_where);

        $this->_data['total_products'] = $config['total_rows'];
        $config['per_page'] = $per_page;
		$config['start_from'] = $start_from;
        $config['num_links'] = 6;
        $config['anchor_class'] = 'class="btn btn-primary width_auto"';
        $config['uri_segment'] = 3;
        $config['cur_tag_open'] = '&nbsp;<a class="btn btn-primary width_auto active">';
        $config['cur_tag_close'] = '</a>';

        $this->pagination->initialize($config);
		//echo $start_from;
        $this->_data['pagination'] = $this->pagination->create_links();

		 $where['pause_listing'] = 'no';
        $this->_data['allProducts'] = $this->product_model->get_seller_products('seller_products',$where, $or_where,$per_page, $start_from,  $order);
		
				
				
				
				
				
				
				
				
				
				
                //$this->_data['allSellerProducts'] = $this->product_model->get_seller_products('seller_products', array('sp.user_id' => $this->session->userdata('user_id')));
				
				
				
                $this->_data['main_content'] = 'frontend/products/pricing/assign-pricing';
             
			
            $this->__loadView();

        } else {
            redirect('login');
        }


    }
	
	
	

    function editInventory()
    {


        if ($this->session->userdata('logged_in') == TRUE) {
			
			
			$action = $this->uri->segment(2);
			
			if($action == 'update' &&  is_array($_POST['update_select'])){
				///echo 'dddddd';exit;
					foreach($_POST['update_select'] as $key=>$val){
			
			$id = $val;
			$quantity = $_POST['new_qty'][$val];
			$price = $_POST['new_price'][$val];
			$sku = $_POST['new_sku'][$val];
			$comments = $_POST['new_comments'][$val];
			$book_condition = $_POST['new_book_condition'][$val];
			$book_type = $_POST['new_book_type'][$val];
			
//			echo $val."<br />";
//			echo '<strong>New quantity is : '. $_POST['new_qty'][$val]."</strong><br />";
			//$id = $this->input->post('id');
			
			$where = array("user_id"=>getCurrentUserId(),"id"=>$id);
			//print_r($where);exit;
			
			
			$itemData = array(
                
                'book_condition' => $book_condition,
                'quantity' => $quantity,
                'price' => $price,
                'sku' => $sku,
                'book_type' => $book_type,
				
                'comments' => $comments
            );
			//print_r($itemData);exit;
			$updated = $this->comman_model->update('seller_products', $where, $itemData);
			
			
			if($updated){
			$seller_product_details = $this->comman_model->get('seller_products', array("id"=>$id));
			$product = $this->comman_model->get('products', array("product_id"=>$seller_product_details[0]["product_id"]));
				
			$subject = 'Book details have been updated.';
                    $message = '<html>
                       <body bgcolor="#EDEDEE">
                       <p><div align="center" style="color:#303E49"><h1>YOU HAVE SUCCESSFULLY UPDATED BOOK: '.$product[0]['isbn'].'</h1></div></p>
                       <p><div align="center" style="margin-top:15px; margin-bottom:50px;"><img src="' . base_url('assets/frontend/images/logo.png') . '" class="img-responsive" style="width:auto;"  /><div></p>
                       <p><strong> Dear ' . $this->session->userdata('first_name') . ' ' . $this->session->userdata('first_name') . '!</strong></p>
                       <p>You have updated following book.</p>
					   <p><strong>ISBN:</strong> '.$product[0]['title'].'</p>
                       <p><strong>Book Condition:</strong> '.$book_condition.'</p>
					   <p><strong>Quantity:</strong> '.$quantity.'</p>
					   <p><strong>Price:</strong> '.$price.'</p>
					   <p><strong>Sku:</strong> '.$sku.'</p>
					   <p><strong>Book Type:</strong> '.$book_type.'</p>
					   <p><strong>Comments:</strong> '.$comments.'</p>
					   
                       <p>Regards<p>
                       <p>Team <strong>bookumbrella.com</strong><p>
                       </body>
                       </html>';


                $email_notifications = $this->comman_model->get("email_notifications",array("user_id"=>$this->session->userdata('email')));
                $email = trim($this->session->userdata('email'));
                if($email_notifications!=0){
                    $email = $email_notifications[0]['inventory_load_confirmation'];
                }






                    do_email($email, getAdminEmail(), $subject, $message);
			}
					
					
			
			
			
   			 //redirect("edit_inventory");
	
	
	
			
			
		}
		
		$this->session->set_flashdata('success', 'Inventory has been updated successfully.');
				
				}
			if($action == 'delete' &&  is_array($_POST['update_select'])){
				///echo 'dddddd';exit;
					foreach($_POST['update_select'] as $key=>$val){
			
			$id = $val;
			
			
			$where = array("user_id"=>getCurrentUserId(),"id"=>$id);
			//print_r($where);exit;
			
			
			
			
			$deleted = $this->comman_model->delete('seller_products', $where);
			
			if($deleted){
				$seller_product_details = $this->comman_model->get('seller_products', array("id"=>$id));
			$product = $this->comman_model->get('products', array("product_id"=>$seller_product_details[0]["product_id"]));
				
			$subject = 'Book has been deleted.';
                    $message = '<html>
                       <body bgcolor="#EDEDEE">
                       <p><div align="center" style="color:#303E49"><h1>YOU HAVE DELETED THE BOOK: '.$product[0]['isbn'].'</h1></div></p>
                       <p><div align="center" style="margin-top:15px; margin-bottom:50px;"><img src="' . base_url('assets/frontend/images/logo.png') . '" class="img-responsive" style="width:auto;"  /><div></p>
                       <p><strong> Dear ' . $this->session->userdata('first_name') . ' ' . $this->session->userdata('first_name') . '!</strong></p>
                       <p>You have updated following book.</p>
					   <p><strong>ISBN:</strong> '.$product[0]['title'].'</p>
                       <p><strong>Book Condition:</strong> '.$product[0]['book_condition'].'</p>
					   <p><strong>Quantity:</strong> '.$product[0]['quantity'].'</p>
					   <p><strong>Price:</strong> '.$product[0]['price'].'</p>
					   <p><strong>Sku:</strong> '.$product[0]['sku'].'</p>
					   <p><strong>Book Type:</strong> '.$product[0]['book_type'].'</p>
					   <p><strong>Comments:</strong> '.$product[0]['comments'].'</p>
					   
                       <p>Regards<p>
                       <p>Team <strong>bookumbrella.com</strong><p>
                       </body>
                       </html>';
                    $email = trim($this->session->userdata('email'));
                    do_email($email, getAdminEmail(), $subject, $message);
					
					
				}
			
			
   			 //redirect("edit_inventory");
	
	
	
			
			
		}
		$this->session->set_flashdata('success', 'Inventory has been deleted successfully.');
		
		
		
				
				}
				
			
			
			

            $layouts_data = $this->comman_model->get('layouts');
            $this->_data['layouts'] = $layouts_data;

            //$inventory_id = $this->uri->segment(2);
            
				
				    $where = array('sp.user_id' => $this->session->userdata('user_id'));
        $or_where = array();
		$start_from = $this->input->get('per_page');
        if (!is_numeric($start_from))
            $start_from = 0;

        //show number of product on page
        $per_page = $this->input->get('count');
        if (!is_numeric($per_page))
            $per_page = 16;
        if ($this->input->get('sort_by') != '') {
            $sort_by = $this->input->get('sort_by');
            if ($sort_by == 'name') {
                $order = array('title' => 'ASC');
            } else if ($sort_by == 'price_low') {

                $order = array('buy_price' => 'ASC');

            } else if ($sort_by == 'price_high') {

                $order = array('buy_price' => ' DESC');

            } else if ($sort_by == 'most_viewed') {

                $order = array('views' => ' DESC');

            }
        } else {
            $order = FALSE;
        }
$listing = $this->input->get('listing');
		if($listing=='yes'){
				$title = $this->input->get('title');				
				if($title)
				{
					$or_where['title'] = $title;
                    $or_where['isbn'] = trim($title);
                    $or_where['isbn13'] = trim($title);
					
				}
		}
		
		//print_r($or_where);exit;
        //show product cagtegoty wise
		
        $searchtop = $this->input->get('search');
		
		$category = $this->input->get('cat');
        if ($category !='Select Category' && $category !='') {
            $where['category_id'] = $category ;
        } 

$book_condition = $this->input->get('condition');
$book_type = $this->input->get('type');

if($book_condition!='')
	$where['book_condition'] = $book_condition;
if($book_type!='')
	$where['book_type'] = $book_type;

		if ($searchtop != '') {
            
			$or_where['isbn'] = $searchtop ;
			$or_where['author'] = $searchtop ;
			$or_where['title'] = $searchtop ;
        
		} 
		
		//print_r($or_where);exit;
		//echo $where['category_id']; die;


        //show product by manufacture
        
        //show product by store
        $store = $this->input->get('store');
        if ($store) {
            if ($store != 'all') {
                $where['store_id'] = $store;
            }
        }

		


        //show product color wise



        //filter value range by slider
/*        $price = $this->input->get('price');
        if ($price) {
            $price_range = explode(',', $price);
            $p_min = $price_range[0];
            $p_max = $price_range[1];
            $where['price >='] = "$p_min";
            $where['price <='] = "$p_max";
        }*/


        //echo '<pre>'; print_r($where);die;
        $get = $_GET;
        unset($get['per_page']);

        $suffix = '&' . http_build_query($get, '', "&");
        $config['page_query_string'] = TRUE;
        $config['base_url'] = base_url('edit_inventory') . '?';
        $config['suffix'] = $suffix;
        $config['first_url'] = base_url('edit_inventory') . '?' . $suffix;
        //$config['total_rows'] = $this->product_model->get_total_products('products', $or_where,$where);
 $where['pause_listing'] = 'no';
$config['total_rows'] = $this->product_model->get_seller_total_products('seller_products',$where, $or_where);

        $this->_data['total_products'] = $config['total_rows'];
        $config['per_page'] = $per_page;
		$config['start_from'] = $start_from;
        $config['num_links'] = 6;
        $config['anchor_class'] = 'class="btn btn-primary width_auto"';
        $config['uri_segment'] = 3;
        $config['cur_tag_open'] = '&nbsp;<a class="btn btn-primary width_auto active">';
        $config['cur_tag_close'] = '</a>';

        $this->pagination->initialize($config);
		//echo $start_from;
        $this->_data['pagination'] = $this->pagination->create_links();


        $this->_data['allProducts'] = $this->product_model->get_seller_products('seller_products',$where, $or_where,$per_page, $start_from,  $order);
		
				
				
				
				
				
				
				
				
				
				
                //$this->_data['allSellerProducts'] = $this->product_model->get_seller_products('seller_products', array('sp.user_id' => $this->session->userdata('user_id')));
				
				
				
                    $this->_data['main_content'] = 'frontend/products/edit-inventory';
             
			
            $this->__loadView();

        } else {
            redirect('login');
        }


    }
function delete_inventory(){
	
	
	
	if($this->input->post('id')!=''){
	$deleted_seller_products = $this->comman_model->delete('seller_products',array('id'=>$this->input->post('id')));
	
	if($deleted_seller_products)
	echo 'Product has been deleted successfully.';
	else
	echo 'There is some error and product can not be deleted.';
	}
	
	
	
	}
    function SellerInventory()
    {


        if ($this->session->userdata('logged_in') == TRUE) {

            $layouts_data = $this->comman_model->get('layouts');
            $this->_data['layouts'] = $layouts_data;

            $inventory_id = $this->uri->segment(2);
            if ($inventory_id == '') {
				 
				 
                $this->_data['allSellerProducts'] = $this->product_model->get_seller_products('seller_products', array('sp.pause_listing'=>'no','sp.user_id' => $this->session->userdata('user_id')));
                $this->_data['main_content'] = 'frontend/products/seller-inventory';
            } else {
                $sellerItem = $this->product_model->get_seller_products('seller_products', array('sp.pause_listing'=>'no','sp.id' => $inventory_id, 'sp.user_id' => $this->session->userdata('user_id')));

                $this->_data['productData'] = $sellerItem[0];
                $this->_data['main_content'] = 'frontend/products/seller-inventory';
            }
            $this->__loadView();

        } else {
            redirect('login');
        }


    }

    function loadSellItem()
    {
        
		
		$data['success'] = false;
		$data['number_check'] = '';
		$title = $this->input->post('title');
		$isbn = $this->input->post('isbn');
		$length_isbn = strlen($isbn);
		
		if($title!='' && $isbn!= ''){
			$data['number_check'] = "Please enter either ISBN or book title.Both fields are not allowed.";	
			}
			
		
		if($length_isbn!=10 && $length_isbn!= 13 && $length_isbn!=''){
			$data['number_check'] = "ISBN of length 10 or 13 is allowed.";	
			}
		if(is_numeric($isbn) && $length_isbn!=''){
			$float_check = explode(".",$isbn);
		
		if(sizeof($float_check)==2)	
		$data['number_check'] = "Please enter only numeric ISBN.";
		
		}else if($length_isbn!=''){
		$data['number_check'] = "Please enter only numeric ISBN. ";	
			}
		
		
		
		
		
		
		if($isbn!=''){
        $data['view'] = '<span>Product not found</span>';

        $productData = get('products', array('isbn' => $isbn));
		
		
        if ($productData) {
            $view_data['productData'] = $productData[0];
            $data['success'] = true;
            $data['view'] = $this->load->view('frontend/products/sell_item_form', $view_data, true);
        }
		}
		else if($title!=''){
		
		$order = array('title' => 'DESC');
		
		$or_where['title'] = $title;
		$or_where['isbn'] = $title;
		$or_where['isbn13'] = $title;
		$or_where['author'] = $title;
		$or_where['advertiser_name'] = $title;
		    
			   //$productsData = $this->comman_model->getLike('products', $title); =>before live feedback
			   
			   $productsData = $this->product_model->search_products('products', 50000, 0,$or_where, false, $order,false); 
			   
			   //$order = array('title' => 'ASC');
			   //$productsData = $this->product_model->search_products('products', 10, 0, array(), $order, $title);
			   
				$view_data['productsData'] = $productsData;
				$data['success'] = true;
			 //$data['view'] = 'Show me';
            	$data['view'] = $this->load->view('frontend/products/sell_item_form', $view_data, true);
				
			//$data['success'] = sizeof($productData[0]);echo json_encode($data);exit;
		    if ($productsData) {
            $view_data['productsData'] = $productsData;
			
			
            $data['success'] = true;
			 //$data['view'] = 'Show me';
            $data['view'] = $this->load->view('frontend/products/sell_item_form', $view_data, true);
        }
		
		}


		
		
        echo json_encode($data);
    }

    function AjaxaddSellerProduct()
    {
			
        if ($this->input->post("product_id")!='') {
			
			
		//	echo '<pre>';print_r($_POST);exit;
				$already = $this->comman_model->get('seller_products', array("product_id"=>$this->input->post("product_id"),"book_condition"=>$this->input->post("book_condition"),"book_type"=>$this->input->post("book_type")));
					
				if($already)		{
					echo 'This book is already added. Please add new.';exit;
					}else{
						$product = $this->comman_model->get('products', array("product_id"=>$this->input->post("product_id")));

					$itemData = array(	
					'product_id'=>$this->input->post("product_id"),
					'user_id'=>$this->session->userdata('user_id'),

					'book_condition'=>$this->input->post("book_condition"),
					'quantity'=>$this->input->post("quantity"),
					'price'=>$this->input->post("price"),
					'sku'=>$this->input->post("sku"),
					'book_type'=>$this->input->post("book_type"),
					'country'=>$this->session->userdata('country'),
					'pause_listing'=>'no',
					'isbn13'=>$product[0]['isbn13'],
					'isbn'=>$product[0]['isbn'],
					'advertiser_name'=>$product[0]['advertiser_name'],
					'author'=>$product[0]['author'],
					'title'=>$product[0]['title'],
					'comments'=>$this->input->post("comments")
					);
			
			
			
			//echo print_r($itemData);exit;
			
					
                $saved = $this->comman_model->save('seller_products', $itemData);
                
            	if ($saved) {
			
					
			
					$name = 'Administrator - bookumbrella.com';
                    $subject = 'New book has been listed.';
                    $message = '<html>
                       <body bgcolor="#EDEDEE">
                       <p><div align="center" style="color:#303E49"><h1>YOU HAVE SUCCESSFULLY LISTED NEW BOOK</h1></div></p>
                       <p><div align="center" style="margin-top:15px; margin-bottom:50px;"><img src="' . base_url('assets/frontend/images/logo.png') . '" class="img-responsive" style="width:auto;"  /><div></p>
                       <p><strong> Dear ' . $this->session->userdata('first_name') . ' ' . $this->session->userdata('first_name') . '!</strong></p>
                       <p>Thank you for listing a book at bookumbrella.com.</p>
                       <p>You have listed following book.</p>
					   <p><strong>ISBN-10:</strong> '.$product[0]['isbn'].'</p>
					   <p><strong>ISBN-13:</strong> '.$product[0]['isbn13'].'</p>
                       <p><strong>Book Conditions</strong> '.$this->input->post("book_condition").'</p>
					   <p><strong>Quantity:</strong> '.$this->input->post("quantity").'</p>
					   <p><strong>Price:</strong> '.$this->input->post("price").'</p>
					   <p><strong>Sku:</strong> '.$this->input->post("sku").'</p>
					   <p><strong>Book Type:</strong> '.$this->input->post("book_type").'</p>
					   <p><strong>Comments:</strong> '.$this->input->post("comments").'</p>
					   
                       <p>Regards<p>
                       <p>Team <strong>bookumbrella.com</strong><p>
                       </body>
                       </html>';

                    $email_notifications = $this->comman_model->get("email_notifications",array("user_id"=>$this->session->userdata('email')));
                    $email = trim($this->session->userdata('email'));
                    if($email_notifications!=0){
                        $email = $email_notifications[0]['inventory_load_confirmation'];
                    }



                    do_email($email, getAdminEmail(), $subject, $message);
					


					
					
			
			
					echo 'Your item is listed successfully.';
					}else
					{
						echo 'Failed to save list the item. Please try later.';
						}
				}
				
				        
            
				
		
		
		
		
		
		} 
    }
	
	
    function addSellerProduct()
    {
		
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
			
			
			
			
		//echo '<pre>';print_r($_POST);exit;	
			
			
		if($this->input->post('items_multiple') == 'save'){
			
			
					//echo sizeof($val)."<br />";
					
				$total_inserted = 0;		
				for($i=0;$i<sizeof($this->input->post('product_id'));$i++){
					$itemData = array(	
					'product_id'=>$_POST['product_id'][$i],
					'user_id'=>getCurrentUserId(),
					'book_condition'=>$_POST['book_condition'][$i],
					'quantity'=>$_POST['quantity'][$i],
					'price'=>$_POST['price'][$i],
					'sku'=>$_POST['sku'][$i],
					'book_type'=>$_POST['book_type'][$i],
					'country'=>$this->session->userdata('country'),
					'pause_listing'=>'no',
					'comments'=>$_POST['comments'][$i]
					);
					
			//echo print_r($itemData);exit;
			
					
                $saved = $this->comman_model->save('seller_products', $itemData);
                if ($saved) 
            	$total_inserted++;		
			    
				}
				        $this->session->set_flashdata('success', 'Total <strong>'.$total_inserted.'</strong> Seller item(s) Created successfully.');
            
			redirect('add_inventory');
            
					
			     }
					
			{	
			
			
			
            $itemData = array(
                'product_id' => $this->input->post('product_id'),
                'user_id' => $this->session->userdata('user_id'),
                'book_condition' => $this->input->post('book_condition'),
                'quantity' => $this->input->post('quantity'),
                'price' => $this->input->post('price'),
                'sku' => $this->input->post('sku'),
                'book_type' => $this->input->post('book_type'),
				'country'=>$this->session->userdata('country'),
				'pause_listing'=>'no',
                'comments' => $this->input->post('comments'),
            );
            $inventory_id = $this->uri->segment(2);
            if ($inventory_id == '') {
                $saved = $this->comman_model->save('seller_products', $itemData);
                if ($saved) {
                    $this->session->set_flashdata('success', 'Seller item Created successfully.');
                    redirect('add_inventory');
                } else {
                    $this->session->set_flashdata('errors', 'Unable to save seller item. Review information and try again !');
                    redirect('add_inventory');
                }
            } else {
                $where = array('id' => $inventory_id, 'user_id' => $this->session->userdata('user_id'));
                $updated = $this->comman_model->update('seller_products', $where, $itemData);
                if ($updated) {
                    $this->session->set_flashdata('success', 'Seller item updated successfully.');
                    redirect('edit_inventory');
                } else {
                    $this->session->set_flashdata('errors', 'Unable to update seller item. Review information and try again !');
                    redirect('edit_inventory');
                }
            }

        
		
		
		}
		
		
		
		
		
		} else {
            $this->session->set_flashdata('errors', 'Invalid Method');
            redirect('add_inventory');
        }
    }

    function checkOut()
    {
		
		$cartData = $this->session->userdata("cartData");
		//echo '<pre>';print_r($cartData);exit;
	if($cartData){	
		foreach($cartData as $key=>$val){
			
		
				
				$data['cart_row_id'] = $val['cart_row_id'];
				$data['seller_id'] = $val['seller_id'];
				$data['id'] = $val['id'];
				$data['product_id'] = $val['product_id'];
				$data['price'] = $val['price'];
				$data['qty'] = $val['qty'];
				$data['shipping_type'] = $val['shipping_type'];
				$data['shipping_amount'] =$val['shipping_amount'];
				
				$inserted_ids[] = $this->comman_model->save("cart_table",$data);
			
			}		
		
		$cartData = $this->comman_model->getRecentinserted("cart_table",implode(",",$inserted_ids));
		
		
		if($cartData!=0){
			
		$this->_data['inserted_ids']   = 	implode(",",$inserted_ids);
		
		
		
		
		$this->session->set_userdata('cartData', $cartData);
			
            
		}
		
		
	}
	$card_accounts = $this->comman_model->get("pm_card",array("user_id"=>getCurrentUserId()));
		$this->_data['card_accounts'] = $card_accounts;
	
		
		$this->_data['main_content'] = 'frontend/products/checkout';
        $this->__loadView();


    }

    function productDetail()
    {

       $productId = decode_uri($this->uri->segment(3));
      // print_r($productId);
		$sellerProductData = $this->product_model->get_seller_products('seller_products', array('p.product_id' => $productId));
		
        
            $product_id = $productId;
            $actual_product = $this->comman_model->get('products', array('product_id' => $product_id));
            $this->_data['actual_product'] = $actual_product[0];
            //print_r($this->_data['actual_product']);exit;
			$this->_data['sellerProductData'] = false;
			if($sellerProductData)
            $this->_data['sellerProductData'] = $sellerProductData[0];
            $this->_data['main_content'] = 'frontend/products/product_detail';
            $this->__loadView();
         
    }

    function loadRetailer()
    {

        $productId = decode_uri($this->uri->segment(3));
        $productData = get('products', array('product_id' => $productId));

        if ($productData) {

            $productData = $productData[0];
            $clicking_user_id = getCurrentUserId();
            $clicking_user_id = $clicking_user_id ? $clicking_user_id : getSuperAdminId();

            $exit_click = $this->comman_model->save('exit_click',
                array(
                    'redirect_link' => $productData['buy_url'],
                    'user_id' => $clicking_user_id,
                    'ip_address' => get_client_ip(),
                )
            );

            if ($exit_click) {
                $this->comman_model->save('cashback',
                    array(
                        'user_id' => $clicking_user_id,
                        'network_id' => getNetworkId(array('cat_id' => $productData['category_id'])),
                        'cashback_value' => getCashBackValue(array('cat_id' => $productData['category_id'])),
                        'exit_click_id' => $exit_click,
                        'updated_status' => 'Pending',
                        'resource_id' => $productData['product_id'],
                        'resource_type' => 'product',
                    )
                );
                $this->comman_model->update('products',
                    array('product_id' => $productData['product_id']),
                    array('views' => intval($productData['views']) + 1)
                );
            }

            $this->_data['redirect_url'] = $productData['buy_url'];
            $this->_data['footer_text_content'] = 'Forwarding to Vendor\'s website...';

            $this->_data['main_content'] = 'frontend/pages/innostartRedirect';
            $this->load->view('frontend/blank_template', $this->_data);

        } else {
            redirect(base_url());
        }
    }

    function importShopStyleData()
    {

        $shopstyle = new ShopStyle\API('uid1476-33577926-16');
        $dummyArr = array();

        $method = isset($_GET["method"]) ? $_GET["method"] : '';

        if ($method == 'products') {
            $category = $_GET["cat"];

            $increment = 50;
            $offset = 0;

            for ($i = 0; $i < 20; $i++) {
                $result = $shopstyle->getProducts(100, $offset, array('cat' => $category));

                foreach ($result->products as $product) {
                    $dummyArr[] = $this->product_model->insertShopStyleProducts($product);
                }
                $offset += $increment;
            }

            echo "Imported products !";

        } else if ($method == 'categories') {

            $result = $shopstyle->getCategories('clothes-shoes-and-jewelry');
            $result = $result->categories;

            foreach ($result as $cat) {
                $dummyArr[] = $this->comman_model->save('category', array(
                    'shopstyle_id' => $cat->id,
                    'title' => $cat->shortName,
                    'fullName' => $cat->fullName,
                    'slug' => create_slug($cat->fullName),
                    'network_id' => 1,
                    'parent_id' => $cat->parentId,
                    'user_id' => 1,
                ));
            }

            echo "Imported Categories !";
        } else {
            echo "!";
        }

        echo "<pre>";
        print_r($dummyArr);
        echo "</pre>";
        die;
    }

    // www.results.com/product_details
    function getSearchSuggestionResult(){

        $key = isset($_GET['key']) ? $_GET['key']:'';
		$key = trim($key);
        $cat = isset($_GET['cat']) ? 'category_id='.$_GET['cat'].' AND':'';
        $response_data = array();

        if($key){
            $search_query = "select * from products where $cat  isbn13 LIKE '%{$key}%' or isbn LIKE '%{$key}%' or title LIKE '%{$key}%' or author LIKE '%{$key}%' order by title asc";
            $search_result = $this->comman_model->query($search_query);

            $i = 0;
            foreach($search_result as $result) {
				/*
				if(strlen($key)==13)
				$response_data[$i]['name'] = "Title:<strong>".$result['title']."</strong>  Author:<strong>".$result['author']. "</strong> ISBN13:<strong>" . $result['isbn13'].'</strong>';	
				else
                $response_data[$i]['name'] = "Title:<strong>".$result['title']."</strong>  Author:<strong>".$result['author']. "</strong> ISBN:<strong>" . $result['isbn'].'</strong>';
                
				*/
                
                if(strlen($key)==13){
                	$response_data[$i]['title_label'] = "Title: ";
                	$response_data[$i]['title_value'] = $result['title'];
                	$response_data[$i]['author_label'] = "AUTHOR: ";
                	$response_data[$i]['author_value'] = $result['author'];
                	$response_data[$i]['isbn_label'] = "ISBN: ";
                	$response_data[$i]['isbn_value'] = $result['isbn13'];

				$response_data[$i]['name'] = " AUTHOR:".$result['author']. "-- ISBN:" . $result['isbn13'];
				}	
				else{
					$response_data[$i]['title_label'] = "Title: ";
                	$response_data[$i]['title_value'] = $result['title'];
                	$response_data[$i]['author_label'] = "AUTHOR: ";
                	$response_data[$i]['author_value'] = $result['author'];
                	$response_data[$i]['isbn_label'] = "ISBN: ";
                	$response_data[$i]['isbn_value'] = $result['isbn'];
                $response_data[$i]['name'] = "Title: ".$result['title']."-- AUTHOR:".$result['author']. "-- ISBN:" . $result['isbn'];	
                }
                
                                
                
				$product_id = encode_url($result['product_id']);
                $response_data[$i]['link'] = "".base_url('product/detail')."/{$product_id}";
                $i++;
            }
        }

        echo json_encode($response_data);exit;
    }
	 function	uploadInventory(){
	 

        if ($this->session->userdata('logged_in') == TRUE) {
if ($this->input->server('REQUEST_METHOD') == 'POST') {

            $ext = pathinfo($_FILES['import_pay_file']['name'], PATHINFO_EXTENSION);

            if (in_array($ext, array('csv')) || in_array($ext, array('xls')) || in_array($ext, array('xlsx'))) {

                try {
//print_r($_FILES);exit;


                    $objPHPExcel = PHPExcel_IOFactory::load($_FILES['import_pay_file']['tmp_name']);
                    $invoice_import_data = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);

                    $invoice_import_data = array_filter($invoice_import_data);

                    if ($invoice_import_data) {
					$total_inserts=0;
					$total_udpates=0;

$total_seller_inserts = 0;
$total_seller_updates = 0;
$total_seller_deletes = 0;
$total_products_rejected = 0;

                        for ($i = 2; $i < count($invoice_import_data) + 1; $i++) {
							$invoice_row_data = $invoice_import_data[$i];
							$invalid_code = '';
//echo '<pre>';print_r($invoice_row_data);exit;

                            
							
							//echo '<pre>';print_r($invoice_row_data);exit;
						if($invoice_row_data['B'] == 1)
						$invalid_code  = validateISBN($invoice_row_data['C']);
						else if($invoice_row_data['B'] == 2)
						$invalid_code  = validateUPC($invoice_row_data['C']);
						else
						$invalid_code  = 'yes';
						
						
					if($invalid_code==''){	
						if($invoice_row_data['A'] =='A')
						$seller_action_type = 'Add';
						if($invoice_row_data['A'] =='M')
						$seller_action_type = 'Modify';
						if($invoice_row_data['A'] =='D')
						$seller_action_type = 'Delete';						
						
						//echo "----".$invalid_code;exit;
							
                            $code_type = $invoice_row_data['B'];
                            $isbn = $invoice_row_data['C'];

							$price = $invoice_row_data['D'];
							
							$book_condition = $invoice_row_data['E'];
							$book_type = $invoice_row_data['F'];
							$sku = $invoice_row_data['G'];
							$comments = $invoice_row_data['H'];
                            $quantity = $invoice_row_data['I'];
                            $product_data = $this->comman_model->CheckProductAvailable($isbn);
                        $already =  $this->comman_model->get('seller_products', array('product_code' => $isbn,"book_condition"=>$invoice_row_data['E']));
//echo $product_data."--".$already;exit;


                            if ($product_data>0 && $already==0) {
                                //echo '<pre>';print_r($product_data);exit;
                                if($invoice_row_data['A'] =='A'){
								$save_seller_products = $this->comman_model->save('seller_products', array('quantity'=>$quantity,'product_id'=>$product_data[0]['product_id'],'code_type'=>$code_type,'price'=>$price,'book_condition' => $book_condition,'book_type'=>$book_type,'sku' => $sku,'product_code' => $isbn,'comments' => $comments,'user_id' => getCurrentUserId()));
									if($save_seller_products)
										$total_seller_inserts++;
										
								}else if($invoice_row_data['A'] =='M'){
								//echo $product_data[0]['product_id']. "- " .$sku. "--".  getCurrentUserId();
								$product_data = $this->comman_model->get('seller_products', array('sku' => $sku,'product_id' => $product_data[0]['product_id'],'user_id' => getCurrentUserId()));			
								//echo '<pre>';print_r($product_data);exit;
								if($product_data){
									
									$update_seller_products = $this->comman_model->update('seller_products', array('sku' => $sku,'product_id' => $product_data[0]['product_id'],'user_id' => getCurrentUserId()),array('price'=>$price,'book_type'=>$book_type,'book_condition'=>$book_condition,'comments'=>$comments));				
									
									if($update_seller_products)
									$total_seller_updates++;
									}
									}
								else if($invoice_row_data['A'] =='D'){
								$product_data = $this->comman_model->get('seller_products', array('sku' => $sku,'product_id' => $product_data[0]['product_id'],'user_id' => getCurrentUserId()));			
								if($product_data){
									
									$deleted_seller_products = $this->comman_model->delete('seller_products', array('sku' => $sku,'product_id' => $product_data[0]['product_id'],'user_id' => getCurrentUserId()));			
									if($deleted_seller_products)
										$total_seller_deletes++;	
									
									}
									}	
								
								
								
								}
							else{
								
							$seller_rejects = $this->comman_model->save('seller_tried_books',array(
                            "seller_action_type"=>$seller_action_type,
							"code_type" => $invoice_row_data['B'],
							"isbn" => $invoice_row_data['C'],
							
							"price" => $invoice_row_data['D'],
							"book_condition" => $invoice_row_data['E'],
							"book_type" => $invoice_row_data['F'],
							"sku" => $invoice_row_data['G'],
							"comments" => $invoice_row_data['H'],
							"seller_id" => getCurrentUserId()
                                ));
                            
							if($seller_rejects)
								$total_products_rejected++;
							//$product_data = $this->comman_model->save('seller_tried_books', array('isbn' => $isbn));	
								
								
								}
								
						}
								
                        }

                        $this->_data['success'] = "<strong>Total Rejected Records:</strong> ".$total_products_rejected."<br /> <strong>Total Inserted Records:</strong> ".$total_seller_inserts."<br /><strong>Total Updated Records: </strong>".$total_seller_updates."<br /><strong>Total Deleted Records: </strong>".$total_seller_deletes. '';
                        if($total_seller_inserts>0){

                            $subject = 'New Inventory has been uploaded';
                            $message = '<html>
                       <body bgcolor="#EDEDEE">
                       <p><div align="center" style="color:#303E49"><h1>Som new invenotry has been uploaded.</h1></div></p>
                       <p><div align="center" style="margin-top:15px; margin-bottom:50px;"><img src="' . base_url('assets/frontend/images/logo.png') . '" class="img-responsive" style="width:auto;"  /><div></p>
                       <p><strong> Dear ' . $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name') . '!</strong></p>
                      <p>'. $total_seller_inserts . ' products have been inserted</p>
                      
                       <p>Regards<p>
                       <p>Team <strong>bookumbrella.com</strong><p>
                       </body>
                       </html>';

                            $email_notifications = $this->comman_model->get("email_notifications",array("user_id"=>$this->session->userdata('id')));
                            $email = trim($this->session->userdata('email'));
                            if($email_notifications!=0){
                                $email = $email_notifications[0]['inventory_load_confirmation'];
                            }



                            do_email($email, getAdminEmail(), $subject, $message);


                        }

                    } else {
                        $this->_data['errors'] = 'Selected file has not valid data and no record imported !';
                    }
                } catch (Exception $e) {
                    $this->_data['errors'] = $e->getMessage();
                }
            } else {
                $this->_data['errors'] = lang('wrong_import_file_format');
            }
        }
            $layouts_data = $this->comman_model->get('layouts');


 			
		
			
        
            $this->_data['layouts'] = $layouts_data;
            //echo '<pre>';print_r($this->_data['my_products']);exit;
			$this->_data['main_content'] = 'frontend/products/upload-inventory';
            $this->__loadView();
			
        } else {
            redirect('login');
        }
    
	
	
	
	 }
	 
	 

	
	 
    function selling_options()
    {




if ($this->input->server('REQUEST_METHOD') == 'POST') {
	
		//echo '<pre>';print_r($_POST);
		$selling_options = array(
		'standard'=>$this->input->post('standard'),
		'expedited'=>$this->input->post('expedited'),
		'second_day'=>$this->input->post('second_day'),
		'next_day'=>$this->input->post('next_day'),
		'pause_listing'=>$this->input->post('pause_listing'),
		'date_modified'=>date("Y-m-d H:i:s"),
		
		);
		
				
				//$selling_options
				if($this->input->post('pause_listing') == 'yes')
				$this->comman_model->update('seller_products',array('user_id'=>getCurrentUserId()), array("pause_listing"=>'yes'));
				else
				$this->comman_model->update('seller_products',array('user_id'=>getCurrentUserId()), array("pause_listing"=>'no'));
				
				$updated = $this->comman_model->update('seller_shippings',array('seller_id'=>getCurrentUserId()), $selling_options);
				
				if($updated){
				if($this->input->post('pause_listing') == 'yes'){



                    $subject = 'Listing Disabled';
                    $message = '<html>
                       <body bgcolor="#EDEDEE">
                       
                       <p><div align="center" style="margin-top:15px; margin-bottom:50px;"><img src="' . base_url('assets/frontend/img/logo.png') . '" class="img-responsive" style="width:auto;"  /><div></p>
                       <p><strong> Dear ' . $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name') . '!</strong></p>
                       <p>Your listing has been paused. </p>
                        <p>Regards<p>
                       <p>Team <strong>bookumbrella.com</strong><p>
                       </body>
                       </html>';




					$status = 'inactive';

					$this->comman_model->update('seller_products',array('user_id'=>getCurrentUserId()), array('status'=>$status));

					$this->comman_model->update('seller_shippings',array('seller_id'=>getCurrentUserId()), array('pause_listing'=>'yes'));
					
					}else{
                    $subject = 'Listing Enabled';
                    $message = '<html>
                       <body bgcolor="#EDEDEE">
                       
                       <p><div align="center" style="margin-top:15px; margin-bottom:50px;"><img src="' . base_url('assets/frontend/img/logo.png') . '" class="img-responsive" style="width:auto;"  /><div></p>
                       <p><strong> Dear ' . $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name') . '!</strong></p>
                       <p>Your listing has been enabled. </p>
                        <p>Regards<p>
                       <p>Team <strong>bookumbrella.com</strong><p>
                       </body>
                       </html>';



					$status = 'active';
					$this->comman_model->update('seller_products',array('user_id'=>getCurrentUserId()), array('status'=>$status));
                    $this->comman_model->update('seller_shippings',array('seller_id'=>getCurrentUserId()), array('pause_listing'=>'no'));
						
						
						}

                    do_email($this->session->userdata('email'), getAdminEmail(), $subject, $message);

				$this->session->set_flashdata('success', 'Information has been updated successfully !');
				}else{
				$this->session->set_flashdata('errors', 'Unable to udpate. Review information and try again !');			
				}
	}

$selling_options = $this->comman_model->get("seller_shippings",array('seller_id'=>getCurrentUserId()));
//echo '<pre>';print_r($selling_options);exit;
$this->_data['selling_options'] = $selling_options[0];
        
            $layouts_data = $this->comman_model->get('layouts');


            $this->_data['layouts'] = $layouts_data;

            $this->_data['main_content'] = 'frontend/products/selling_options';
            $this->__loadView();

        


    }
		
	function addRatings(){
		
		
        $response = array('success' => false,'already_voted' => false);
        if ($this->session->userdata('logged_in') == TRUE) {
            $response = array('success' => true,'already_voted' => false);
            $table = 'rating';
            $where = array('seller_product_id' => $this->input->post('seller_product_id'),'seller_id' => $this->input->post('seller_id'),'product_id' => $this->input->post('product_id'),'user_id' => $this->session->userdata('user_id'),'unique_order_id' => $this->input->post('unique_order_id'));
			$already_voted = $this->comman_model->get($table,$where);
            if($already_voted){
               $response['already_voted'] = true;
            }
            elseif($this->input->server('REQUEST_METHOD') === 'POST'){
                $ratingData = array(
                  'user_id' => $this->session->userdata('user_id'),
                  'seller_product_id' => $this->input->post('seller_product_id'),
				  'unique_order_id' => $this->input->post('unique_order_id'),
				  'order_id' => $this->input->post('unique_order_id'),
                  'seller_id' => $this->input->post('seller_id'),
                  'product_id' => $this->input->post('product_id'),
                  'no_stars' => $this->input->post('no_stars'),
				  'comments' => $this->input->post('comments'),
                  'item_arrived_due_time' => $this->input->post('item_arrived_due_time'),
                  'item_was_as_described' => $this->input->post('item_was_as_described'),
                  'prompt_courtesy' => $this->input->post('prompt_courtesy')
                );
               if(!$this->comman_model->get($table,$where) ){
				   //echo json_encode($ratingData,true); die;
                    $saved = $this->comman_model->save($table,$ratingData);
					
					 $seller_details = $this->comman_model->get("user",array("user_id"=>$this->input->post('seller_id')));
					 $product_details = $this->comman_model->get("products",array("product_id"=>$this->input->post('product_id')));						
					 $subject = 'Feedback Received';
                    $message = '<html>
                       <body bgcolor="#EDEDEE">
                       <p><div align="center" style="color:#303E49"><h1>Feedback has been received.</h1></div></p>
                       <p><div align="center" style="margin-top:15px; margin-bottom:50px;"><img src="' . base_url('assets/frontend/images/logo.png') . '" class="img-responsive" style="width:auto;"  /><div></p>
                       <p><strong> Dear ' . $seller_details[0]['first_name'] . ' ' . $seller_details[0]['last_name'] . '!</strong></p>
                       <p>'.$this->session->userdata('first_name')." ".$this->session->userdata('last_name').' has given you following feedback</p>
                       <p><strong>Order Id:</strong>'.$this->input->post('unique_order_id').'</p>
                       <p><strong>Book Title:</strong>'.$product_details[0]['title'].'</p>
					   <p><strong>Rating:</strong>'.$this->input->post('no_stars').'</p>
					    <p><strong>Comments:</strong>'.$this->input->post('comments').'</p></p></p>
                       <p>Regards<p>
                       <p>Team <strong>bookumbrella.com</strong><p>
                       </body>
                       </html>';
                    $email = trim($seller_details[0]['email']);
                     do_email($email, getAdminEmail(), $subject, $message);
					
               }
            }
            $where = array('seller_product_id' => $this->input->post('seller_product_id'),'seller_id' => $this->input->post('seller_id'),'product_id' => $this->input->post('product_id'));
            $total_rating = 0;
            $total_vots = $this->comman_model->get_total($table,$where);
            $ratings = $this->comman_model->get($table,$where,'no_stars');
            $item_arrived_due_time = $this->comman_model->get_total($table,array('seller_product_id' => $this->input->post('seller_product_id'), 'item_arrived_due_time'=>'Yes'));
            $item_was_as_described = $this->comman_model->get_total($table,array('seller_product_id' => $this->input->post('seller_product_id'), 'item_was_as_described'=>'Yes'));
            $prompt_courtesy = $this->comman_model->get_total($table,array('seller_product_id' => $this->input->post('seller_product_id'), 'prompt_courtesy'=>'Yes'));
            if($ratings){
                    foreach ($ratings as $rating) {
                        $total_rating += $rating['no_stars'];
                    }

                    $rating = round($total_rating/$total_vots,1);
                    $floor_rating = floor($total_rating/$total_vots);
                    if(($floor_rating + .5) == $rating){
                        $total_rating = $rating;
                    }
                    else if(($floor_rating + .5) < $rating){
                        $total_rating = $floor_rating + .5; 
                    }else{
                        $total_rating = $floor_rating;
                    }        
            }
            $response['item_arrived_due_time'] = ($item_arrived_due_time/$total_vots)*100;
            $response['item_was_as_described'] = ($item_was_as_described/$total_vots)*100;
            $response['prompt_courtesy'] = ($prompt_courtesy/$total_vots)*100;
            $response['total_votes'] = $total_vots;
            $response['ratings'] = $total_rating;
        }
        echo json_encode($response,true);
    }
	
	
function OrderTracking(){
	

        if ($this->session->userdata('logged_in') == TRUE) {
			
			
			if($this->input->post('submit')=='Update'){
				
				$orders = $this->input->post('order_id');
				foreach($orders as $id){
				
				
				
				$this->comman_model->update("purchase",array('id'=>$id),array('tracking_id'=>$this->input->post("tracking_id_".$id),'carrier'=>$this->input->post("carrier_".$id)));
					
				
				}
				$this->session->set_flashdata('success', 'Tracking updated successfully.');
				
				}
			
			

            $layouts_data = $this->comman_model->get('layouts');

            $where = array('user_id' => getCurrentUserId());
            if($this->input->get('order_status') != ''){
                $where['order_status'] = $this->input->get('order_status');
            }

            if($this->input->get('payment_status') != ''){
                $where['payment_status'] = $this->input->get('payment_status');
            }
            if($this->input->get('tracking_id') != ''){
                $where['tracking_id'] = $this->input->get('tracking_id');
            }
//echo date('Y-m-d 00:00:00', (strtotime($this->input->get('created_on'))+86400)); die;
            if($this->input->get('created_on') != ''){
                $where['created_on >'] = date('Y-m-d 00:00:00', strtotime($this->input->get('created_on')));
                $where['created_on <'] = date('Y-m-d 00:00:00', (strtotime($this->input->get('created_on')) + +86400));
            }elseif($this->input->get('orders_of') != ''){
                if($this->input->get('orders_of') == 'Today'){
                    $start_date = date('Y-m-d 00:00:00');
                    $end_date = date('Y-m-d 00:00:00', strtotime('+1 days'));
                }
                if($this->input->get('orders_of') == 'Yesterday'){
                    $start_date = date('Y-m-d 00:00:00', strtotime('-1 days'));
                    $end_date = date('Y-m-d 00:00:00');
                }
                if($this->input->get('orders_of') == 'This Week'){
                    $day = date('w');
                    $start_date = date('Y-m-d 00:00:00', strtotime('-'.($day-1).' days'));
                    $end_date = date('Y-m-d 00:00:00', strtotime('+'.(6-$day+1).' days'));
                }
                if($this->input->get('orders_of') == 'This Month'){
                    $start_date = $this_month_start = date('Y-m-01 00:00:00');
                    $days_of_this_month = date('t', strtotime($this_month_start))-1;
                    $end_date =  date('Y-m-d 00:00:00', (strtotime($this_month_start)+(60*60*25*$days_of_this_month)));
                }
                $where['created_on >'] = $start_date;
                $where['created_on <'] = $end_date;
            }
            
			
			//$my_orders = $this->comman_model->getgrouped_orders('purchase', $where,'id,SUM(qty) as qty,created_on,updated_on,seller_id,SUM(price) as price,order_status,payment_status,order_id',array('created_on'=>'DESC'),array('seller_id'=>''));
			
			/*if($this->session->userdata('user_type')=='Buyer'){
			$where = array('user_id'=>getCurrentUserId());
			$or_where = false;
			}else{
			$where = false;
			    $or_where['user_id'] = getCurrentUserId();
			    $or_where['seller_id'] = getCurrentUserId();	
			}*/
			$order = array("id"=>'DESC');
			$where['user_id'] = getCurrentUserId();
            $my_orders =  $this->product_model->search_products('purchase', 500, 0,false, $where, $order,false);

            unset($where['user_id']);
            $where['seller_id'] = getCurrentUserId();
            $received_orders =  $this->product_model->search_products('purchase', 500, 0,false, $where, $order,false);
			///echo '<pre>';print_r($received_orders);exit;
			
			
			$this->_data['my_orders'] = $my_orders;
			$this->_data['received_orders'] = $received_orders;
			
	//		echo '<pre>';print_r($my_orders);exit;	
            $this->_data['layouts'] = $layouts_data;
            $this->_data['main_content'] = 'frontend/products/orders/order_tracking';
            $this->__loadView();

        } else {
            redirect('login');
        }
    
	
	
	
	}	
function ViewPaymentSummary(){
	

        if ($this->session->userdata('logged_in') == TRUE) {
			
			
			
			

            $layouts_data = $this->comman_model->get('layouts');

            $where = array('user_id' => getCurrentUserId());
			
	if($this->input->get('PaymentType')){		
          //echo '<pre>';print_r($_GET);exit;
		  $Range = $this->input->post('Range');
		  $RangeMonth = $this->input->post('RangeMonth');
		  $RangeDay = $this->input->post('RangeDay');
		  $RangeYear = $this->input->post('RangeYear');
		  
		  $TimeSpanMonth = $this->input->post('TimeSpanMonth');
		  $TimeSpanDay = $this->input->post('TimeSpanDay');
		  $TimeSpanYear = $this->input->post('TimeSpanYear');
		  
		  $TimeSpanMonth2 = $this->input->post('TimeSpanMonth2');
		  $TimeSpanDay2 = $this->input->post('TimeSpanDay2');
		  $TimeSpanYear2 = $this->input->post('TimeSpanYear2');
		  
		  $PaymentID = $this->input->post('PaymentID');
		  
		  
		    if($this->input->get('order_status') != ''){
                $where['order_status'] = $this->input->get('order_status');
            }

            if($this->input->get('payment_status') != ''){
                $where['payment_status'] = $this->input->get('payment_status');
            }
//echo date('Y-m-d 00:00:00', (strtotime($this->input->get('created_on'))+86400)); die;
           // echo '<pre>';print_r($_REQUEST);exit;
		if($this->input->get('PaymentType')=='ID' || $this->input->get('PaymentType')=='Period'){
		    
			$arr_PaymentID = explode("-",$this->input->get('PaymentID'));
			$from = $arr_PaymentID[0];
			$to = $arr_PaymentID[1];
			$arr_first_date = explode("/",$arr_PaymentID[0]);
			$arr_second_date = explode("/",$arr_PaymentID[1]);
			$start_date =trim($arr_first_date[2])."-".trim($arr_first_date[0])."-".trim($arr_first_date[1])." 00:00:00";
			$end_date = trim($arr_second_date[2])."-".trim($arr_second_date[0])."-".trim($arr_second_date[1])." 23:59:59";
			
				$where['created_on >'] = $start_date;
                $where['created_on <'] = $end_date;
			//print_r($where);exit;	
		}
		if($this->input->get('PaymentType')=='TimeSpan'){
		}
		if($this->input->get('PaymentType')=='Range'){
		}
			
			if($this->input->get('created_on') != ''){
			    
                $where['created_on >'] = date('Y-m-d 00:00:00', strtotime($this->input->get('created_on')));
                $where['created_on <'] = date('Y-m-d 00:00:00', (strtotime($this->input->get('created_on')) + +86400));
                
            }elseif($this->input->get('orders_of') != '' && $this->input->get('PaymentType') == 'Days'){
                
                if($this->input->get('orders_of') == 'Today'){
                    $start_date = date('Y-m-d 00:00:00');
                    $end_date = date('Y-m-d 00:00:00', strtotime('+1 days'));
                }
                if($this->input->get('orders_of') == 'Yesterday'){
                    $start_date = date('Y-m-d 00:00:00', strtotime('-1 days'));
                    $end_date = date('Y-m-d 00:00:00');
                }
                if($this->input->get('orders_of') == 'This Week'){
                    $day = date('w');
                    $start_date = date('Y-m-d 00:00:00', strtotime('-'.($day-1).' days'));
                    $end_date = date('Y-m-d 00:00:00', strtotime('+'.(6-$day+1).' days'));
                }
                if($this->input->get('orders_of') == 'This Month'){
                    $start_date = $this_month_start = date('Y-m-01 00:00:00');
                    $days_of_this_month = date('t', strtotime($this_month_start))-1;
                    $end_date =  date('Y-m-d 00:00:00', (strtotime($this_month_start)+(60*60*25*$days_of_this_month)));
                }else{
                	$days = $this->input->get('orders_of');
                	$start_date = date('Y-m-d 00:00:00', strtotime("-$days days"));
                    $end_date = date('Y-m-d 00:00:00');
                }
                $where['created_on >'] = $start_date;
                $where['created_on <'] = $end_date;
            }
            
	}
			
			$order = array("id"=>'DESC');
			//$where['user_id'] = getCurrentUserId();
            //print_r($where);exit;
			//$my_orders =  $this->product_model->search_products('purchase', 500, 0,false, $where, $order,false);

            unset($where['user_id']);
            $where['seller_id'] = getCurrentUserId();
            //echo $this->session->userdata('user_id');
             //echo '<pre>';print_r($_REQUEST);
            
            
            $received_orders =  $this->product_model->search_products('purchase', 500, 0,false, $where, $order,false);
			//echo '<pre>';print_r($my_orders);exit;
			
			
			$this->_data['my_orders'] = $my_orders;
			$this->_data['received_orders'] = $received_orders;
			
	//		echo '<pre>';print_r($my_orders);exit;	
            $this->_data['layouts'] = $layouts_data;
            $this->_data['main_content'] = 'frontend/products/orders/view_payment_summary';
            $this->__loadView();

        } else {
            redirect('login');
        }
    
	
	
	
	}
	function listedDates(){

        $this->_data['year']= $this->input->post('year');

            $this->load->view('frontend/products/orders/listedDates',$this->_data);
    }
function ajax_updateTracking(){
	
	//print_r($_POST);exit;
	if ($this->session->userdata('logged_in') == TRUE) {
	$id = $this->input->post("id");
	$updated = $this->comman_model->update("purchase",array('id'=>$id),array('tracking_id'=>$this->input->post("tracking_id"),'carrier'=>$this->input->post("carrier"),"order_status"=>'Delivered'));
	
	/*$subject = 'Product has been shipped';
                    $message = '<html>
                       <body bgcolor="#EDEDEE">
                       <p><div align="center" style="color:#303E49"><h1>Following order tracking has been updated.</h1></div></p>
                       
                       
					    
					     <p><strong>Tracking Id:</strong>'.$this->input->post("tracking_id").'</p></p></p>
					     <p><strong>Shipping Service:</strong>'.$this->input->post("carrier").'</p></p></p>
                       <p>Regards<p>
                       <p>Team <strong>bookumbrella.com</strong><p>
                       </body>
                       </html>';


     do_email($this->session->userdata('email'), 'stepinnsolution@gmail.com', $subject, $message);*/




	if($updated){
		echo 'success';exit;
		}
	}else {
            redirect('login');
    }
		
	}

function uploadTracking(){
	

        if ($this->session->userdata('logged_in') == TRUE) {
			
			
			if($this->input->post('submit')=='Update'){
				
				$orders = $this->input->post('order_id');
				foreach($orders as $id){
				
				
				
				$this->comman_model->update("purchase",array('id'=>$id),array('tracking_id'=>$this->input->post("tracking_id_".$id),'carrier'=>$this->input->post("carrier_".$id)));
					
				
				}
				$this->session->set_flashdata('success', 'Tracking updated successfully.');
				
				}
			
			

            $layouts_data = $this->comman_model->get('layouts');

            $where = array('user_id' => getCurrentUserId());
            if($this->input->get('order_status') != ''){
                $where['order_status'] = $this->input->get('order_status');
            }

            if($this->input->get('payment_status') != ''){
                $where['payment_status'] = $this->input->get('payment_status');
            }
//echo date('Y-m-d 00:00:00', (strtotime($this->input->get('created_on'))+86400)); die;
            if($this->input->get('created_on') != ''){
                $where['created_on >'] = date('Y-m-d 00:00:00', strtotime($this->input->get('created_on')));
                $where['created_on <'] = date('Y-m-d 00:00:00', (strtotime($this->input->get('created_on')) + +86400));
            }elseif($this->input->get('orders_of') != ''){
                if($this->input->get('orders_of') == 'Today'){
                    $start_date = date('Y-m-d 00:00:00');
                    $end_date = date('Y-m-d 00:00:00', strtotime('+1 days'));
                }
                if($this->input->get('orders_of') == 'Yesterday'){
                    $start_date = date('Y-m-d 00:00:00', strtotime('-1 days'));
                    $end_date = date('Y-m-d 00:00:00');
                }
                if($this->input->get('orders_of') == 'This Week'){
                    $day = date('w');
                    $start_date = date('Y-m-d 00:00:00', strtotime('-'.($day-1).' days'));
                    $end_date = date('Y-m-d 00:00:00', strtotime('+'.(6-$day+1).' days'));
                }
                if($this->input->get('orders_of') == 'This Month'){
                    $start_date = $this_month_start = date('Y-m-01 00:00:00');
                    $days_of_this_month = date('t', strtotime($this_month_start))-1;
                    $end_date =  date('Y-m-d 00:00:00', (strtotime($this_month_start)+(60*60*25*$days_of_this_month)));
                }
                $where['created_on >'] = $start_date;
                $where['created_on <'] = $end_date;
            }
            
			
			//$my_orders = $this->comman_model->getgrouped_orders('purchase', $where,'id,SUM(qty) as qty,created_on,updated_on,seller_id,SUM(price) as price,order_status,payment_status,order_id',array('created_on'=>'DESC'),array('seller_id'=>''));
			
			/*if($this->session->userdata('user_type')=='Buyer'){
			$where = array('user_id'=>getCurrentUserId());
			$or_where = false;
			}else{
			$where = false;
			    $or_where['user_id'] = getCurrentUserId();
			    $or_where['seller_id'] = getCurrentUserId();	
			}*/
			$order = array("id"=>'DESC');
			$where['user_id'] = getCurrentUserId();
            $my_orders =  $this->product_model->search_products('purchase', 500, 0,false, $where, $order,false);

            unset($where['user_id']);
            $where['seller_id'] = getCurrentUserId();
            $received_orders =  $this->product_model->search_products('purchase', 500, 0,false, $where, $order,false);
			//echo '<pre>';print_r($my_orders);exit;
			
			
			$this->_data['my_orders'] = $my_orders;
			$this->_data['received_orders'] = $received_orders;
			
	//		echo '<pre>';print_r($my_orders);exit;	
            $this->_data['layouts'] = $layouts_data;
            $this->_data['main_content'] = 'frontend/products/orders/upload-tracking';
            $this->__loadView();

        } else {
            redirect('login');
        }
    
	
	
	
	}
function orders_listing(){
	

        if ($this->session->userdata('logged_in') == TRUE) {
			
			
			if($this->input->post('submit')=='Cancel All' ){
				//echo '<pre>';print_r($_POST['order_id']);
				//echo '<pre>';print_r($_POST);exit;
				
				foreach($_POST['order_id'] as $val){
					$id = $val;
					$reason_cancel = $_POST['reasons_cancel_'.$id];
					
					$this->comman_model->update("purchase",array('id'=>$id),array('order_status'=>'Cancelled','reason_cancel'=>$reason_cancel));
					}
				
				
				$this->session->set_flashdata('success', 'Orders cancelled successfully.');
				
				
				
					
				
				}
				else if( $this->input->post('submit')=='Update All'){
				//echo '<pre>';print_r($_POST['order_id']);
				//echo '<pre>';print_r($_POST);
				
				foreach($_POST['order_id'] as $val){
					$id = $val;
					
					$tracking_id = $_POST['tracking_id_'.$id];
					$this->comman_model->update("purchase",array('id'=>$id),array('tracking_id'=>$tracking_id));
					}
				
				
				$this->session->set_flashdata('success', 'Tracking updated successfully.');
				
				
				
					
				
				}
				
				
			
			
			if($this->input->post('submit')=='Update Status'){
				
				$orders = $this->input->post('order_id');
				foreach($orders as $id){
				
				
				
				$this->comman_model->update("purchase",array('id'=>$id),array('order_status'=>$this->input->post("order_status_".$id)));
					
				
				}
				$this->session->set_flashdata('success', 'Tracking updated successfully.');
				
				}
			
            $layouts_data = $this->comman_model->get('layouts');

            $where = array('user_id' => getCurrentUserId());
            if($this->input->get('order_status') != ''){
                $where['order_status'] = $this->input->get('order_status');
            }

//echo date('Y-m-d 00:00:00', (strtotime($this->input->get('created_on'))+86400)); die;
            
			/*if($this->input->get('created_on') != ''){
                $where['created_on >'] = date('Y-m-d 00:00:00', strtotime($this->input->get('created_on')));
                $where['created_on <'] = date('Y-m-d 00:00:00', (strtotime($this->input->get('created_on')) + +86400));
            }
			*/
			if($this->input->get('orders_of') != ''){
				
				if($this->input->get('orders_of') == 'Today'){
                    $start_date = date('Y-m-d 00:00:00');
                    $end_date = date('Y-m-d 00:00:00', strtotime('+1 days'));
                    $where['created_on >'] = $start_date;
                    $where['created_on <'] = $end_date;
				}
                if($this->input->get('orders_of') == 'Yesterday'){
                    $start_date = date('Y-m-d 00:00:00', strtotime('-1 days'));
                    $end_date = date('Y-m-d 00:00:00');
                    $where['created_on >'] = $start_date;
                    $where['created_on <'] = $end_date;
				}
                if($this->input->get('orders_of') == 'This Week'){
                    $day = date('w');
                    $start_date = date('Y-m-d 00:00:00', strtotime('-'.($day-1).' days'));
                    $end_date = date('Y-m-d 00:00:00', strtotime('+'.(6-$day+1).' days'));
                    $where['created_on >'] = $start_date;
                    $where['created_on <'] = $end_date;
                }
                if($this->input->get('orders_of') == 'This Month'){

					
					
					$start_date = date('Y')."-".date('m')."-01 00:00:00";
					$end_date = date('Y')."-".date('m')."-".date("d")." 23:59:59";
                    $where['created_on >'] = $start_date;
                    $where['created_on <'] = $end_date;
					
				}
				if($this->input->get('orders_of') == 'Last 6 Month'){
                    
					
					$m = 6;
                    $y = 1;
					$month =  date('m',strtotime('-'.$m.' Month', strtotime(date('Y-m-01'))));
					
					$year = date('Y',strtotime('-'.$y.' Year', strtotime(date('Y-m-01'))));
					
					$day = date("d");
					$start_date = $year . "-" . $month . "-" . $day . " 00:00:00";
					
					//echo $start_date;exit;
					$end_date = date('Y')."-".date('m')."-".date("d")." 23:59:59";


                    $where['created_on >'] = $start_date;
                    $where['created_on <'] = $end_date;
                }
                if($this->input->get('orders_of') == '2016' || $this->input->get('orders_of') == '2017' || $this->input->get('orders_of') == '2015' || $this->input->get('orders_of') == '2014' || $this->input->get('orders_of') == '2013') {
                    $where['YEAR(created_on)'] = $this->input->get('orders_of');
				}



                }
            
			
			
			$order = array("id"=>'DESC');
			$where['user_id'] = getCurrentUserId();
            if($this->input->get('unique_order_id')!=''){
				
			if($this->input->get('search_by') == 'isbn')	
				$or_where['isbn'] = trim($this->input->get('unique_order_id'));
				
			if($this->input->get('search_by') == 'isbn13')
				$or_where['isbn13'] = trim($this->input->get('unique_order_id'));
			if($this->input->get('search_by') == 'unique_order_id')	
				$or_where['unique_order_id'] = trim($this->input->get('unique_order_id'));
			}
			
			//print_r($or_where);exit;
			if($or_where){}else{
			$or_where = false;	
				}
			//print_r($where);exit;	
			$my_orders =  $this->product_model->search_products('purchase', 500, 0,$or_where, $where, $order,false);

            unset($where['user_id']);
            $where['seller_id'] = getCurrentUserId();
            $received_orders =  $this->product_model->search_products('purchase', 500, 0,$or_where, $where, $order,false);
			//echo '<pre>';print_r($my_orders);exit;
			$this->_data['total_my_orders'] = 0;
			if($my_orders){
			$this->_data['total_my_orders'] = count($my_orders);
			}
			$this->_data['my_orders'] = $my_orders;
			$this->_data['received_orders'] = $received_orders;
			
	//		echo '<pre>';print_r($my_orders);exit;	
            $this->_data['layouts'] = $layouts_data;
            $this->_data['main_content'] = 'frontend/products/orders/orders-listing';
            $this->__loadView();

        } else {
            redirect('login');
        }
    
	
	
	
	}
function listing(){
	

        if ($this->session->userdata('logged_in') == TRUE) {
			
			
			if($this->input->post('submit')=='Cancel All' ){
				//echo '<pre>';print_r($_POST['order_id']);
				//echo '<pre>';print_r($_POST);exit;
				
				foreach($_POST['order_id'] as $val){
					$id = $val;
					$reason_cancel = $_POST['reasons_cancel_'.$id];
					
					$this->comman_model->update("purchase",array('id'=>$id),array('order_status'=>'Cancelled','reason_cancel'=>$reason_cancel));
					}
				
				
				$this->session->set_flashdata('success', 'Orders cancelled successfully.');
				
				
				
					
				
				}
				else if( $this->input->post('submit')=='Update All'){
				//echo '<pre>';print_r($_POST['order_id']);
				//echo '<pre>';print_r($_POST);
				
				foreach($_POST['order_id'] as $val){
					$id = $val;
					
					$tracking_id = $_POST['tracking_id_'.$id];
					$this->comman_model->update("purchase",array('id'=>$id),array('tracking_id'=>$tracking_id));
					}
				
				
				$this->session->set_flashdata('success', 'Tracking updated successfully.');
				
				
				
					
				
				}
				
				
			
			
			if($this->input->post('submit')=='Update Status'){
				
				$orders = $this->input->post('order_id');
				foreach($orders as $id){
				
				
				
				$this->comman_model->update("purchase",array('id'=>$id),array('order_status'=>$this->input->post("order_status_".$id)));
					
				
				}
				$this->session->set_flashdata('success', 'Tracking updated successfully.');
				
				}
			
			

            $layouts_data = $this->comman_model->get('layouts');

            $where = array('user_id' => getCurrentUserId());
            if($this->input->get('order_status') != ''){
                $where['order_status'] = $this->input->get('order_status');
            }

            if($this->input->get('payment_status') != ''){
                //$where['payment_status'] = $this->input->get('payment_status');
            }
//echo date('Y-m-d 00:00:00', (strtotime($this->input->get('created_on'))+86400)); die;
            if($this->input->get('created_on') != ''){
                $where['created_on >'] = date('Y-m-d 00:00:00', strtotime($this->input->get('created_on')));
                $where['created_on <'] = date('Y-m-d 00:00:00', (strtotime($this->input->get('created_on')) + +86400));
            }elseif($this->input->get('orders_of') != ''){
                if($this->input->get('orders_of') == 'Today'){
                    $start_date = date('Y-m-d 00:00:00');
                    $end_date = date('Y-m-d 00:00:00', strtotime('+1 days'));
                }
                if($this->input->get('orders_of') == 'Yesterday'){
                    $start_date = date('Y-m-d 00:00:00', strtotime('-1 days'));
                    $end_date = date('Y-m-d 00:00:00');
                }
                if($this->input->get('orders_of') == 'This Week'){
                    $day = date('w');
                    $start_date = date('Y-m-d 00:00:00', strtotime('-'.($day-1).' days'));
                    $end_date = date('Y-m-d 00:00:00', strtotime('+'.(6-$day+1).' days'));
                }
                if($this->input->get('orders_of') == 'This Month'){
                    $start_date = $this_month_start = date('Y-m-01 00:00:00');
                    $days_of_this_month = date('t', strtotime($this_month_start))-1;
                    $end_date =  date('Y-m-d 00:00:00', (strtotime($this_month_start)+(60*60*25*$days_of_this_month)));
                }
                $where['created_on >'] = $start_date;
                $where['created_on <'] = $end_date;
            }
            
			
			
			$order = array("id"=>'DESC');
			$or_where['user_id'] = getCurrentUserId();
            $or_where['seller_id'] = getCurrentUserId();
			//print_r($where);exit;
			$my_orders =  $this->product_model->search_products('purchase', 500, 0,$or_where, false, $order,false);

            unset($where['user_id']);
            $where['seller_id'] = getCurrentUserId();
            $received_orders =  $this->product_model->search_products('purchase', 500, 0,false, $where, $order,false);
			//echo '<pre>';print_r($my_orders);exit;
			
			
			$this->_data['my_orders'] = $my_orders;
			$this->_data['received_orders'] = $received_orders;
			
	//		echo '<pre>';print_r($my_orders);exit;	
            $this->_data['layouts'] = $layouts_data;
            $this->_data['main_content'] = 'frontend/products/orders/listing';
            $this->__loadView();

        } else {
            redirect('login');
        }
    
	
	
	
	}
		
function fullFillOrdersPending(){
	

        if ($this->session->userdata('logged_in') == TRUE) {
			
			
			if($this->input->post('submit')=='Cancel All' ){
				//echo '<pre>';print_r($_POST['order_id']);
				//echo '<pre>';print_r($_POST);exit;
				
				foreach($_POST['order_id'] as $val){
					$id = $val;
					$reason_cancel = $_POST['reasons_cancel_'.$id];
					
					$this->comman_model->update("purchase",array('id'=>$id),array('order_status'=>'Cancelled','reason_cancel'=>$reason_cancel));
					}
				
				
				$this->session->set_flashdata('success', 'Orders cancelled successfully.');
				
				
				
					
				
				}
				else if( $this->input->post('submit')=='Update All'){
				//echo '<pre>';print_r($_POST['order_id']);
				//echo '<pre>';print_r($_POST);
                    $cntrl = 0;
				foreach($_POST['order_id'] as $val){
				    $cntrl++;
					$id = $val;
					
					$tracking_id = $_POST['tracking_id_'.$id];
					$this->comman_model->update("purchase",array('id'=>$id),array('tracking_id'=>$tracking_id));


                    $purchase = $this->comman_model->get("purchase",array("id"=>$id));
                    $unique_order_id = $purchase[0]['unique_order_id'];
                    $seller_id = $purchase[0]['seller_id'];
                    $seller_details = $this->comman_model->get("user",array("user_id"=>$seller_id));

                    $user_id = $purchase[0]['user_id'];
                    ////////////////buyer email//////////////////
                    $subject = 'Tracking Id updated';
                    $message = '<html>
                       <body bgcolor="#EDEDEE">
                       <p><div align="center" style="color:#303E49"><h1>Following order tracking has been updated.</h1></div></p>
                       
                       
					    <p><strong>Order Id:</strong>'.$unique_order_id.'</p></p></p>
					     <p><strong>Tracking Id:</strong>'.$tracking_id.'</p></p></p>
                       <p>Regards<p>
                       <p>Team <strong>bookumbrella.com</strong><p>
                       </body>
                       </html>';


                    do_email($this->session->userdata('email'), getAdminEmail(), $subject, $message);

                    ////////////////buyer email end //////////////////
                    ////////////////seller email//////////////////
                    $email_notifications = $this->comman_model->get("email_notifications", array("user_id" => $seller_id));
                    $seller_email = $seller_details[0]['email'];


                    if ($email_notifications != 0) {
                        $seller_email = $email_notifications[0]['order_notification'];
                    }
                    do_email($seller_email, getAdminEmail(), $subject, $message);
                    ////////////////seller email end //////////////////


					}
				if($cntrl>0){
                }
				
				$this->session->set_flashdata('success', 'Tracking updated successfully.');
				
				
				
					
				
				}
				
				
			
			
			if($this->input->post('submit')=='Update Status'){
				
				$orders = $this->input->post('order_id');
				foreach($orders as $id){
				
				
				
				$this->comman_model->update("purchase",array('id'=>$id),array('order_status'=>$this->input->post("order_status_".$id)));
					
				
				}
				$this->session->set_flashdata('success', 'Tracking updated successfully.');
				
				}
			
			

            $layouts_data = $this->comman_model->get('layouts');

            $where = array('seller_id' => getCurrentUserId());
            $pending_where = array('seller_id' => getCurrentUserId());
            $pending_where['order_status'] = 'Received';
            if($this->input->get('order_status') != ''){
                $where['order_status'] = $this->input->get('order_status');
                $pending_where['order_status'] = $this->input->get('order_status');
            }

            if($this->input->get('payment_status') != ''){
                $where['payment_status'] = $this->input->get('payment_status');
            }
//echo date('Y-m-d 00:00:00', (strtotime($this->input->get('created_on'))+86400)); die;
            if($this->input->get('created_on') != ''){
                $where['created_on >'] = date('Y-m-d 00:00:00', strtotime($this->input->get('created_on')));
                $where['created_on <'] = date('Y-m-d 00:00:00', (strtotime($this->input->get('created_on')) + +86400));
            }
            elseif($this->input->get('orders_of') != ''){
                if($this->input->get('orders_of') == 'Today'){
                    $start_date = date('Y-m-d 00:00:00');
                    $end_date = date('Y-m-d 00:00:00', strtotime('+1 days'));
                }
                if($this->input->get('orders_of') == 'Yesterday'){
                    $start_date = date('Y-m-d 00:00:00', strtotime('-1 days'));
                    $end_date = date('Y-m-d 00:00:00');
                }
                if($this->input->get('orders_of') == 'This Week'){
                    $day = date('w');
                    $start_date = date('Y-m-d 00:00:00', strtotime('-'.($day-1).' days'));
                    $end_date = date('Y-m-d 00:00:00', strtotime('+'.(6-$day+1).' days'));
                }
                if($this->input->get('orders_of') == 'This Month'){
                    $start_date = $this_month_start = date('Y-m-01 00:00:00');
                    $days_of_this_month = date('t', strtotime($this_month_start))-1;
                    $end_date =  date('Y-m-d 00:00:00', (strtotime($this_month_start)+(60*60*25*$days_of_this_month)));
                }
                $where['created_on >'] = $start_date;
                $where['created_on <'] = $end_date;
            }
            
			
			
			$order = array("id"=>'DESC');
			//$or_where['user_id'] = getCurrentUserId();
           // $where['seller_id'] = getCurrentUserId();
			   if($this->input->get('unique_order_id')!=''){
				
			if($this->input->get('search_by') == 'isbn')	
				$or_where['isbn'] = trim($this->input->get('unique_order_id'));
				
			if($this->input->get('search_by') == 'isbn13')
				$or_where['isbn13'] = trim($this->input->get('unique_order_id'));
			if($this->input->get('search_by') == 'unique_order_id')	
				$or_where['unique_order_id'] = trim($this->input->get('unique_order_id'));
			}
			
			//print_r($or_where);exit;
			if($or_where){}else{
			$or_where = false;	
				}
			
			
			//print_r($where);exit;
			$my_orders =  $this->product_model->search_products('purchase', 500, 0,$or_where, $where, $order,false);

            $pending_orders = $this->product_model->search_products_pending('purchase', 500, 0,$or_where, $pending_where, $order,false);
$this->_data['total_my_orders'] = 0;
			if($pending_orders){
			$this->_data['total_my_orders'] = count($pending_orders);
			}
			
			
            unset($where['user_id']);
            $where['seller_id'] = getCurrentUserId();
            $received_orders =  $this->product_model->search_products('purchase', 500, 0,false, $where, $order,false);
			//echo '<pre>';print_r($my_orders);exit;
			
			
			$this->_data['my_orders'] = $my_orders;
			$this->_data['received_orders'] = $received_orders;
			
	//		echo '<pre>';print_r($my_orders);exit;	
            $this->_data['layouts'] = $layouts_data;
			
            $this->_data['main_content'] = 'frontend/products/orders/fullFill-orders-pending';
            $this->__loadView();

        } else {
            redirect('login');
        }
    
	
	
	
	}

		
			 
function refund(){
	
	$msg = 'There is some error and order is not updated.';
	$id = $this->input->post('id');
	$where = array('id'=>$this->input->post('id'));
	$refund_reason = $this->input->post('refund_reason');
	$itemData = array('refund_reason'=>$refund_reason,'order_status'=>'Refunded','payment_status'=>'Refunded');
	
	if($this->input->post('id')>0){
	$updated = $this->comman_model->update('purchase', $where, $itemData);
                if ($updated) {

                    $purchase = $this->comman_model->get("purchase",array("id"=>$id));
                    $unique_order_id = $purchase[0]['unique_order_id'];
                    $seller_id = $purchase[0]['seller_id'];
                    $seller_details = $this->comman_model->get("user",array("user_id"=>$seller_id));

                    $user_id = $purchase[0]['user_id'];
                    ////////////////buyer email//////////////////
                    $subject = 'Order has been refunded';
                    $message = '<html>
                       <body bgcolor="#EDEDEE">
                       <p><div align="center" style="color:#303E49"><h1>Following order has been refunded.</h1></div></p>
                       
                       
					    <p><strong>Order Id:</strong>'.$unique_order_id.'</p></p></p>
					     <p><strong>Refund Reason:</strong>'.$this->input->post('refund_reason').'</p></p></p>
                       <p>Regards<p>
                       <p>Team <strong>bookumbrella.com</strong><p>
                       </body>
                       </html>';


                    do_email($this->session->userdata('email'), getAdminEmail(), $subject, $message);

                    ////////////////buyer email end //////////////////
                    ////////////////seller email//////////////////
                    $email_notifications = $this->comman_model->get("email_notifications", array("user_id" => $seller_id));
                    $seller_email = $seller_details[0]['email'];


                    if ($email_notifications != 0) {
                        $seller_email = $email_notifications[0]['order_notification'];
                    }
                    do_email($seller_email, getAdminEmail(), $subject, $message);
                    ////////////////seller email end //////////////////



                    $msg = 'Order refunded successfully.';
                    //redirect('edit_inventory');
                } 
	}
echo $msg;
	}	 
function updateAllInventory(){
	/*echo '<pre>';print_r($_POST['update_select']);
	echo '<pre>';print_r($_POST);
	exit;*/

	
	
	
	exit;
	
	}
function deleteAllInventory(){
	
	print_r($_POST);exit;
	}
function updateInventory(){
	//print_r($_POST);exit;
	$data['success']= 'Seller item updated successfully.';
                  
	$itemData = array(
                
                'book_condition' => $this->input->post('new_condition'),
                'quantity' => $this->input->post('new_qty'),
                'price' => $this->input->post('new_price'),
                'sku' => $this->input->post('new_sku'),
                'book_type' => $this->input->post('new_type'),

                'comments' => $this->input->post('new_comments'),
            );
            $id = $this->input->post('id');
			
			$where = array("user_id"=>getCurrentUserId(),"id"=>$id);
			//print_r($where);exit;
			$updated = $this->comman_model->update('seller_products', $where, $itemData);
			if ($updated) {
                  $data['success']= 'Seller item updated successfully.';
    					//redirect('edit_inventory');
                } else {
                   $data['success']= 'There is some error.';
				   
                }
		echo $data['success'];
	}

function updateInventoryPrice(){
	
	$data['success']= 'Price updated successfully.';
                  
	$itemData = array(
                
                'price' => $this->input->post('price')
            );
            $id = $this->input->post('id');
			
			$where = array("user_id"=>getCurrentUserId(),"id"=>$id);
			//print_r($where);exit;
			$updated = $this->comman_model->update('seller_products', $where, $itemData);
			if ($updated) {
                  $data['success']= 'Price updated successfully.';
    					//redirect('edit_inventory');
                } else {
                   $data['success']= 'There is some error.';
				   
                }
		echo $data['success'];
	
		
	
	}
function PricingRules(){
	
	
	
	//echo 'dfdfdfd';exit;
	
	
		$edit_id = $this->uri->segment(2);
		
		/*if($this->uri->segment(2)=='delete' && $this->uri->segment(4)!=''){
			
				$paypal_accounts = $this->comman_model->delete($this->uri->segment(3),array("id"=>$this->uri->segment(4)));		
				$this->session->set_flashdata('success', "Record has been deleted successfully.");
				
			
			}*/
			
		
		
        $user_id = getCurrentUserId();
		
		 
		/*$paypal_accounts = $this->comman_model->get("pm_paypal",array("user_id"=>$user_id));
		$this->_data['paypal_accounts'] = $paypal_accounts;

		$bank_accounts = $this->comman_model->get("pm_bank",array("user_id"=>$user_id));
		$this->_data['bank_accounts'] = $bank_accounts;


*/


      //  $redirect_url = base_url('add_pricing');

       
		
        $user_data = $this->comman_model->get('user',array('user_id' => $user_id));
		
        if($user_data){

            if ($this->input->server('REQUEST_METHOD') === 'POST'){

              
				
                    $this->form_validation->set_rules('amount', 'Amount', 'trim|required');
				    $this->form_validation->set_rules('name', 'Name', 'trim|required');
                    $this->form_validation->set_rules('pricing_amount_type', 'Pricing Amount Type', 'trim|required');
					
                if ($this->form_validation->run() !== FALSE) {
					
					if($this->input->post('id')!=''){
						
						    $updated = $this->comman_model->update('pricing_rules',array('id'=>$this->input->post('id')),
                        array(
                            'name' => $this->input->post('name'),
							'amount' => $this->input->post('amount'),
                           'pricing_amount_type' => $this->input->post('pricing_amount_type'),
							'date_created' => date("Y-m-Y H:i:s"),
							'status' => $this->input->post('status')
                            
                        )
                    );

                    if ($updated) {
						$this->_data['success'] = 'Pricing rule is updated successfully !';
						} else {
                        $this->_data['errors'] = 'Unable to update pricing information. Please review your input data !';
                    }

                
						}else{
						
						
				
                    $saved = $this->comman_model->save('pricing_rules',
                        array(
                            'name' => $this->input->post('name'),
							'amount' => $this->input->post('amount'),
                            'pricing_amount_type' => $this->input->post('pricing_amount_type'),
							'date_created' => date("Y-m-Y H:i:s"),
							'status' => 'In-Active',
                            'user_id' => $user_id
                        )
                    );

                    if ($saved) {
						
						redirect('assign_pricing/'.$saved);
						
						$this->_data['success'] = 'Pricing rule is saved successfully !';
						} else {
                        $this->_data['errors'] = 'Unable to save pricing rule. Please review your input data !';
                    }

                
						
						}
					
					
					} else {
                    $this->_data['errors'] = validation_errors();
                }
            }
			
			
			
			
	$pricing_actions = $this->comman_model->get('pricing_actions',false);		
			

//print_r($pricing_actions);exit;

$this->_data['pricing_actions'] =  $pricing_actions ;

$this->_data['pricing_rule'] =  0;
	if($edit_id!=''){
			$pricing_rule = $this->comman_model->get('pricing_rules',array('user_id'=>$user_id,'id'=>$edit_id));

$this->_data['pricing_rule'] =  $pricing_rule;
		}
		
		$pricing_rules = $this->comman_model->get('pricing_rules',array('user_id'=>$user_id));
			$this->_data['pricing_rules'] =  $pricing_rules ;







		$this->_data['main_content'] = "frontend/products/pricing/add_pricing";
        $this->_data['page'] = "add_pricing";
		
		
		
		

            $this->__loadView();

        } else {
            redirect();
        }


    
	
	}	
		
function ApplyPricingRules(){
	
	
	
	
	
	//echo 'dfdfdfd';exit;
	
	
		$edit_id = $this->uri->segment(2);			
		
		
        $user_id = getCurrentUserId();
		
       
		
        $user_data = $this->comman_model->get('user',array('user_id' => $user_id));
		
        if($user_data){

            
              
				
            
					if($edit_id!=''){
						//echo 'dd';exit;
							$this->_data['success'] = 'Pricing rule is implemented on all your products successfully !';
							redirect('pricing_rules');
						
						
						
						$pricing_rule = $this->comman_model->get('pricing_rules',array('user_id'=>$user_id,'id'=>$edit_id));
						$pricing_action = 'stayabove';
						if($pricing_rule[0]['pricing_actions_id'] == 1)
						$pricing_action = 'staybelow';
						
						
						$seller_products = $this->comman_model->get('seller_products',array('user_id'=>$user_id));
						
						
						
						    $updated = $this->comman_model->update('seller_products',array('user_id'=>$user_id),
                        array(
                            'name' => $this->input->post('name'),
                            'pricing_actions_id' => $this->input->post('pricing_actions_id'),
							'pricing_amount_type' => $this->input->post('pricing_amount_type'),
							'amount' => $this->input->post('amount'),
							'min_price' => $this->input->post('min_price'),
							'max_price' => $this->input->post('max_price'),
							'date_created' => date("Y-m-Y H:i:s"),
							'status' => $this->input->post('status')
                            
                        )
                    );

                    if ($updated) {
						
						
						
			$subject = 'Pricing has been updated.';
                    $message = '<html>
                       <body bgcolor="#EDEDEE">
                       <p><div align="center" style="color:#303E49"><h1>PRICING HAS BEEN IMPLEMENTED SUCCESSFULLY.</h1></div></p>
                       <p><div align="center" style="margin-top:15px; margin-bottom:50px;"><img src="' . base_url('assets/frontend/images/logo.png') . '" class="img-responsive" style="width:auto;"  /><div></p>
                       <p><strong> Dear ' . $this->session->userdata('first_name') . ' ' . $this->session->userdata('first_name') . '!</strong></p>
                       <p>Pricing implemented.</p>
					  
					   
                       <p>Regards<p>
                       <p>Team <strong>bookumbrella.com</strong><p>
                       </body>
                       </html>';
                    $email = trim($this->session->userdata('email'));
                    do_email($email, getAdminEmail(), $subject, $message);
					
					
					
					
						$this->_data['success'] = 'Pricing rule is implemented on all your products successfully !';
						} else {
                        $this->_data['errors'] = 'Unable to implement pricing rule. Please review your input data !';
                    }
					redirect();
					

                
						}
			
        } else {
            redirect();
        }


    
	
	
	
	
	
}

function exportInventory()
    {
        if ($this->session->userdata('logged_in') == TRUE) {
            $filename = "inventries.csv";
			$fp = fopen('php://output', 'w');
			$header = array('Product', 'Book Condition', 'Book Type','Date','Quantity','Sku','Price');
			header('Content-type: application/csv');
			header('Content-Disposition: attachment; filename='.$filename);
			fputcsv($fp, $header);
            $allSellerProducts = $this->product_model->get_seller_products('seller_products', array('sp.user_id' => $this->session->userdata('user_id')));
            //echo '<pre>'; print_r($allSellerProducts); echo '</pre>';
            if($allSellerProducts){
            	foreach ($allSellerProducts as $product) {
            		$productData = get('products', array('product_id' => $product['product_id']));
            		$data = array($productData[0]['title'],$product['book_condition'],$product['book_type'],$product['created_on'],$product['quantity'],$product['sku'],'$'.$product['price']);
            		fputcsv($fp, $data);
            	}
            }
            exit;
                
        } else {
            redirect('login');
        }


    }


}