<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

error_reporting(0);
include APPPATH."libraries/CjClient.php";

class adminOrdersManagement extends CI_Controller
{

    private $_data;

    public function __construct()
    {
        parent::__construct();
//        check_is_login(6);
		$this->load->library('PHPExcel');
        $this->load->model('product_model');
		$this->load->model('purchase_model');
    }

    private function __loadView()
    {

        if ($this->session->flashdata('success') != "")
            $this->_data['success'] = $this->session->flashdata('success');
        if ($this->session->flashdata('errors') != "")
            $this->_data['errors'] = $this->session->flashdata('errors');

        $this->load->view('admin/admin_template', $this->_data);
    }

    function index()
    {

        $start_from = $this->uri->segment(3);
        if (!is_numeric($start_from)) {
            $start_from = 0;
        }

        $where = array('id  !=' => 0);
        if($this->session->userdata('admin_role_id') == 2){
            $where['user_id'] = $this->session->userdata('admin_user_id');
        }
		
        $total = $this->purchase_model->get_total('purchase', $where);
        $per_page = 10;
        $num_links = 4;
        $uri_segment = 3;

        $this->_data['pagination'] = paginate(base_url() . 'admin/orders/', $total, $per_page, $num_links, $uri_segment);
        $this->_data['results'] = $this->purchase_model->get_all_limited('purchase', $per_page, $start_from, $where,'id,user_id,qty,created_on,updated_on,seller_id,price,order_status,payment_status,order_id,product_id,unique_order_id,shipping_value,shipping_type,isbn,isbn13,address_country,address_name,address_street_address,address_city,address_state,address_zip,address_phone_number',false);
        
		//echo '<pre>';print_r($this->_data['pagination']);exit;
		
		$this->_data['page'] = "index";
        $this->_data['view_path'] = 'admin/orders/index';

        $this->__loadView();
    }


function upload_products()
    {

        $start_from = $this->uri->segment(3);
        if (!is_numeric($start_from)) {
            $start_from = 0;
        }

        if ($this->input->server('REQUEST_METHOD') == 'POST') {

            $ext = pathinfo($_FILES['import_pay_file']['name'], PATHINFO_EXTENSION);

            if (in_array($ext, array('csv')) || in_array($ext, array('xls')) || in_array($ext, array('xlsx'))) {

                try {

                    $objPHPExcel = PHPExcel_IOFactory::load($_FILES['import_pay_file']['tmp_name']);
                    $invoice_import_data = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);

                    $invoice_import_data = array_filter($invoice_import_data);

                    if ($invoice_import_data) {
                        for ($i = 2; $i < count($invoice_import_data) + 1; $i++) {

                            $invoice_row_data = $invoice_import_data[$i];

                            $title = $invoice_row_data['A'];
                            $buy_price = $invoice_row_data['B'];
                            $rent_price = $invoice_row_data['C'];
							$description = $invoice_row_data['D'];
							$isbn = $invoice_row_data['E'];
							$book_condition = $invoice_row_data['F'];
							$book_type = $invoice_row_data['G'];
							$sku = $invoice_row_data['H'];
							$author = $invoice_row_data['I'];
							$format = $invoice_row_data['J'];
							$publisher_id = $invoice_row_data['K'];
							$publisher_name = $invoice_row_data['L'];
							$edition = $invoice_row_data['M'];
							$language = $invoice_row_data['N'];
							$grade = $invoice_row_data['O'];

                            $product_data = $this->comman_model->get('products', array('isbn' => $isbn));
$total_inserts=0;
$total_udpates=0;
                            if ($product_data) {
                                $product_data = $product_data[0];
                                

                               $this->comman_model->update('products',array('isbn' => $isbn), array(
                                   "title" => $invoice_row_data['A'],
                            "buy_price" => $invoice_row_data['B'],
                            "rent_price" => $invoice_row_data['C'],
							"description" => $invoice_row_data['D'],
							"isbn" => $invoice_row_data['E'],
							"book_condition" => $invoice_row_data['F'],
							"book_type" => $invoice_row_data['G'],
							"sku" => $invoice_row_data['H'],
							"author" => $invoice_row_data['I'],
							"format" => $invoice_row_data['J'],
							"publisher_id" => $invoice_row_data['K'],
							"publisher_name" => $invoice_row_data['L'],
							"edition" => $invoice_row_data['M'],
							"language" => $invoice_row_data['N'],
							"grade" => $invoice_row_data['O'],
							"image"=>"/uploads/img_gallery/product_images/".$invoice_row_data['E'].".jpg",
							"user_id" => getCurrentUserId()
                                ));
                                 
                                    $total_udpates++;
                                        
                                    
                              
                            }else{
								
								if ($this->comman_model->save('products', array(
                                   "title" => $invoice_row_data['A'],
                            "buy_price" => $invoice_row_data['B'],
                            "rent_price" => $invoice_row_data['C'],
							"description" => $invoice_row_data['D'],
							"isbn" => $invoice_row_data['E'],
							"book_condition" => $invoice_row_data['F'],
							"book_type" => $invoice_row_data['G'],
							"sku" => $invoice_row_data['H'],
							"author" => $invoice_row_data['I'],
							"format" => $invoice_row_data['J'],
							"publisher_id" => $invoice_row_data['K'],
							"publisher_name" => $invoice_row_data['L'],
							"edition" => $invoice_row_data['M'],
							"language" => $invoice_row_data['N'],
							"grade" => $invoice_row_data['O'],
							"image"=>"/uploads/img_gallery/product_images/".$invoice_row_data['E'].".jpg",
                             "user_id" => getCurrentUserId()   
								))
                                ){
									$total_inserts++;
									}
								
								}
                        }
                        $this->_data['success'] = 'Imported books successfully completed!';
                    } else {
                        $this->_data['errors'] = 'Selected file is empty or have some invalid data !';
                    }
                } catch (Exception $e) {
                    $this->_data['errors'] = $e->getMessage();
                }
            } else {
                $this->_data['errors'] = lang('wrong_import_file_format');
            }
        }
		
		
		
        $this->_data['page'] = "upload_products";
        $this->_data['view_path'] = 'admin/products/upload';

        $this->__loadView();
    }
	
	
	
	



    function add()
    {
       //echo 'd';exit; //check_is_login(5);
        $this->_data['categories'] = $this->comman_model->get('category');
        $this->_data['view_path'] = "admin/products/add";
        $this->_data['page'] = "add";

        if ($this->input->server('REQUEST_METHOD') === 'POST') {

            $this->form_validation->set_rules('title', 'Product Title', 'trim|required');
            $this->form_validation->set_rules('buy_price', 'Buy Price', 'trim|required');
			
            $this->form_validation->set_rules('sku', 'SKU', 'trim|required');
			$this->form_validation->set_rules('book_condition', 'Book Condition', 'trim|required');
			$this->form_validation->set_rules('book_type', 'Book Type', 'trim|required');
//            $this->form_validation->set_rules('buy_url', 'Purchase Url', 'trim|required');
            $this->form_validation->set_rules('category_id', 'Category', 'trim|required');
            $this->form_validation->set_rules('description', 'Description', 'trim|required');

            if ($this->form_validation->run() !== FALSE) {

                $this->load->helper('upload_helper');
                $productData = array();
                $hasImage = 0;
                $isImageUploaded = 0;

                $productNameAlreadyExists = $this->comman_model->get_total('products', array('title' => trim($this->input->post('title'))));
                $productNameAlreadyExists = $productNameAlreadyExists > 0 ? 1 : 0;

                if (!$productNameAlreadyExists) {
                    if (isset($_FILES['image']['name']) && trim($_FILES['image']['name']) != "") {

                        $hasImage = 1;
                        $product_img = upload_image('image', 'uploads/img_gallery/product_images');

                        if (isset($product_img['error'])) {
                            $this->_data['errors'] = $product_img['error'];
                        } else {
                            $imageSizes = imageSizes();
                            $thumb_data = resize_image($product_img, $imageSizes['thumbnail']);
                            $isImageUploaded = 1;
                        }

                        $productData = array(
                            'image' => $product_img['file_name']
                        );
                    }

                    // If Display image is selected
                    if ($hasImage) {

                        $productData = array_merge($productData, array(
                            'title' => $this->input->post('title'),
							 'book_type' => $this->input->post('book_type'),
							  'book_condition' => $this->input->post('book_condition'),
                            'buy_price' => $this->input->post('buy_price'),
                            'rent_price' => $this->input->post('rent_price'),
                            'isbn' => $this->input->post('isbn'),
							
							'author' => $this->input->post('author'),
							'format' => $this->input->post('format'),
							'edition' => $this->input->post('edition'),
							'language' => $this->input->post('language'),
							'grade' => $this->input->post('grade'),
							
							
                            'sku' => $this->input->post('sku'),
                            'slug' => create_slug($this->input->post('title')),
//                          'buy_url' => $this->input->post('buy_url'),
                            'advertiser_id' => $this->input->post('advertiser_id'),
                            'advertiser_name' => $this->input->post('advertiser_name'),
                            'manufacturer_sku' => $this->input->post('manufacturer_sku'),
                            'manufacturer_name' => $this->input->post('manufacturer_name'),
                            'category_id' => $this->input->post('category_id'),
                            'description' => $this->input->post('description'),
                            'user_id' => getCurrentUserId()
                        ));

                        // If Display image uploaded successfully
                        if ($isImageUploaded) {

                            $saved = $this->comman_model->save('products', $productData);

                            if ($saved) {
                                $this->session->set_flashdata('success', 'Product Created successfully.');
                                redirect('admin/products');
                            } else {
                                $this->_data['errors'] = 'Unable to save product. Review information and try again !';
                            }
                        } else {
                            $this->_data['errors'] = 'Unable to upload product display image, please try again !';
                        }
                    } else {
                        $this->_data['errors'] = 'Display Image not found !';
                    }
                } else {
                    $this->_data['errors'] = 'Product with same name already exists !';
                }

            } else {
                $this->_data['errors'] = validation_errors();
            }
        }

        $this->__loadView();
    }

    function edit()
    {

        $order_id = $this->uri->segment(5);
        $where = array('id' => $order_id);
        /*if (!$product_data) {
            $this->_data['errors'] = 'An error occurred, try later';
            redirect('admin/products/' . $this->uri->segment(4));
        } else {
            $this->_data['product_data'] = $product_data[0];
        }*/

        if ($this->input->server('REQUEST_METHOD') === 'POST') {
			
			
			//echo '<pre>';print_r($_POST);exit;

            $this->form_validation->set_rules('payment_status', 'Payment Status', 'trim|required');
            $this->form_validation->set_rules('order_status', 'Order Status', 'trim|required');
            $this->form_validation->set_rules('order_id', 'Order Id', 'trim|required');

            if ($this->form_validation->run() !== FALSE) {

                $this->load->helper('upload_helper');
                $orderData = array();
               
				$where = array('id'=>$this->input->post('order_id'));
                //$product_title = $this->input->post('title');

                $orderData =  array(
                    'order_status' => $this->input->post('order_status'),
                    'payment_status' => $this->input->post('payment_status'),
					'tracking_id' => $this->input->post('tracking_id'),
					'career' => $this->input->post('career'),                    
                    'updated_on' => date('Y-m-d H:i:s')
                );

                $updated = $this->comman_model->update('purchase', $where, $orderData);

                    if ($updated) {
                        $this->session->set_flashdata('success', 'Order Updated successfully.');
                        $this->emailOnOrderUpdate($this->input->post('order_id'));

                    } else {
                        $this->_data['success'] = 'Order Updated successfully.';
                        $this->emailOnOrderUpdate($this->input->post('order_id'));
                    }

            } else {
                $this->_data['errors'] = validation_errors();
            }
        }

        $this->_data['results'] = $this->purchase_model->get_all_limited('purchase', 1000, 0, $where,'*',false,false);
        
		//echo '<pre>';print_r($this->_data['results']);exit;
		
		$this->_data['order_id'] = $order_id;
		$this->_data['page'] = "index";
        $this->_data['view_path'] = 'admin/orders/order_detail';

        $this->__loadView();
		
		
    }

    function delete()
    {

        $id = decode_uri($this->uri->segment(5));
        $where = array('id' => $id);
        if($this->session->userdata('admin_role_id') == 2){
            $where['user_id'] = $this->session->userdata('admin_user_id');
        }
        $deleted = $this->comman_model->delete('purchase', $where);

        if ($deleted) {
            $this->session->set_flashdata('success', 'Order Deleted Successfully.');
        } else {
            $this->session->set_flashdata('errors', 'Requested order not found, please try later !');
        }
        redirect('admin/orders/' . $this->uri->segment(4));
    }

    function updateStatus()
    {

        $id = decode_uri($this->uri->segment(5));
        $status = $this->uri->segment(6);
        $where = array('id' => $id);
        if($this->session->userdata('admin_role_id') == 2){
            $where['user_id'] = $this->session->userdata('admin_user_id');
        }
        $ordersData = array('order_status' => $status);
        $updated = $this->comman_model->update('purchase', $where, $ordersData);

        if ($updated) {
            $msg = ($status == 1) ? 'Order Activated Successfully.' : 'Order Deactivated Successfully.';
            $this->session->set_flashdata('success', $msg);
        } else {
            $this->session->set_flashdata('errors', 'Requested order not found, please try later !');
        }
        redirect('admin/orders/' . $this->uri->segment(4));
    }

    function importProducts()
    {
        $insertCounter = 0;
        $status = 2;
        $cj_result_attrs = array();

        $response_msg_arr = array(
            'success' => 'Product information successfully imported !',
            'warning' => 'No record found for your selected choice or your product list is already update-to-dated !',
            'error' => 'Invalid information provided !'
        );
        $status_arr = array(1 => 'success', 2 => 'warning', 3 => 'error');

        if ($this->input->server('REQUEST_METHOD') === 'POST') {

            $cat_id = $this->input->post('cat_id');

            if ($cat_id) {
                $cat_data = get('category', array('category_id' => $cat_id));

                if ($cat_data) {
                    $cat_data = $cat_data[0];
                    
                    $network_data = get('network',array('api_id'=>'commision_junction'));
                    
                    $cj = new CjClient($network_data[0]['key']);

                    $cj_params = array(
                        'website-id' => $network_data[0]['website_id'],//config_item('cj_website_id'),
                        'low-price' => '1',
                        'records-per-page' => config_item('default_import_count'),
                        'sort-by' => 'name',
                        'sort-order' => 'asc',
                        'keywords' => rawurlencode($cat_data['slug']),
                    );

                    $searchResultObject = $cj->productSearch($cj_params);

                    if ($searchResultObject) {

                        $searchResultProducts = $searchResultObject['products'];
                        $cj_result_attrs = $searchResultProducts['@attributes'];
                        $cj_result_prods = $searchResultProducts['product'];

                        if ($cj_result_prods) {
                            foreach ($cj_result_prods as $cj_product) {
                                if ($this->product_model->insertCjProduct($cj_product, $cat_id, getCurrentUserId())) {
                                    $insertCounter++;
                                }
                            }
                            if ($insertCounter > 0) {
                                $status = 1;
                            }
                        }
                    }
                }
            } else {
                $status = 3;
            }
        } else {
            $status = 3;
        }

        $response = array(
            'msg' => $response_msg_arr[$status_arr[$status]],
            'status' => $status_arr[$status],
            'product_attr' => $cj_result_attrs
        );

        $response = json_encode($response);
        echo $response; die;
    }

    function emailOnOrderUpdate($orderId){
        $total_sellers = array();
        $orders = $this->purchase_model->get_all_limited('purchase', 1000, 0, array('order_id'=>$orderId),'*',false,false);
        
        $seller_subject = 'Received order status.';
        $buyer_subject = 'Submitted order status.';
        $msg = '
        <html><body bgcolor="#EDEDEE">
        <div class="product-col list clearfix col-sm-12">
                        <strong> Order ID:</strong> <span>'.$orders[0]['order_id'].'</span><br>
                        <strong> Order Status:</strong> <span>'.$orders[0]['order_status'].'</span><br> 
                        <strong> Payment Status:</strong> <span>'.$orders[0]['payment_status'].'</span><br>
                        <strong> Tracking ID:</strong> <span>'.$orders[0]['tracking_id'].'</span><br>
                        <strong> Career:</strong> <span>'.$orders[0]['career'].'</span><br>                     
                    </div>
        </body></html>';
        $admin_email = getUserEmail('user', array('role_id'=>1));
        $buyer_email = getUserEmail('user', array('user_id'=>$orders[0]['user_id']));
        do_email($buyer_email,$admin_email,  $buyer_subject, $msg);
        $seller_id = $orders[0]['seller_id'];
        $seller_email = getUserEmail('user', array('user_id'=>$seller_id));
        do_email($seller_email,$admin_email, $seller_subject, $msg);
        foreach ($orders  as $key => $value) {
            if($seller_id == $value['seller_id']){
                continue;
            }
            
            $seller_id = $value['seller_id'];
            $seller_email = getUserEmail('user', array('user_id'=>$seller_id));
            do_email($seller_email,$admin_email,  $seller_subject, $msg);
            
        }
        return true;  
    }
}