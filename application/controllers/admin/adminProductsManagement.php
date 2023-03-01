<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

error_reporting(0);
include APPPATH."libraries/CjClient.php";

class adminProductsManagement extends CI_Controller
{

    private $_data;

    public function __construct()
    {
        parent::__construct();
//        check_is_login(6);
		$this->load->library('PHPExcel');
        $this->load->model('product_model');
		$this->load->model('comman_model');
$this->load->helper('upload_helper');
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

        $where = array('product_id  !=' => 0);
        if($this->session->userdata('admin_role_id') == 2){
            $where['user_id'] = $this->session->userdata('admin_user_id');
        }
        $total = $this->comman_model->get_total('products', $where);
        $per_page = 10;
        $num_links = 4;
        $uri_segment = 3;

        $this->_data['pagination'] = paginate(base_url() . 'admin/products/', $total, $per_page, $num_links, $uri_segment);
        $this->_data['results'] = $this->comman_model->get_all_limited('products', $per_page, $start_from, $where,array("product_id"=>"DESC"));
        $this->_data['page'] = "index";
        $this->_data['view_path'] = 'admin/products/index';

        $this->__loadView();
    }


function upload_products()
    {

        $start_from = $this->uri->segment(3);
        if (!is_numeric($start_from)) {
            $start_from = 0;
        }

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
			//print_r($_FILES);exit;
$total_inserts=0;
$total_udpates=0;
            $total_failed = 0;
             $ext = pathinfo($_FILES['import_pay_file']['name'], PATHINFO_EXTENSION);

            if (in_array($ext, array('csv')) || in_array($ext, array('xls')) || in_array($ext, array('xlsx'))) {

                try {

                    $objPHPExcel = PHPExcel_IOFactory::load($_FILES['import_pay_file']['tmp_name']);
                    $invoice_import_data = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
					
                    $invoice_import_data = array_filter($invoice_import_data);


                    if ($invoice_import_data) {
                        for ($i = 2; $i < count($invoice_import_data) + 1; $i++) {
						//echo '<pre>';print_r($invoice_import_data);exit;
						$invoice_row_data = $invoice_import_data[$i];
						
						$invalid_code  = 'yes';
						$invalid_code_upc  = 'yes';

						//if($invoice_row_data['R'] == 1)
						    $invalid_code  = validateISBN($invoice_row_data['E']);

						//if($invoice_row_data['R'] == 2)

						    $invalid_code_upc  = validateUPC($invoice_row_data['U']);
						
						//echo '<pre>';echo count($invoice_row_data);exit;
						$invalid_category = 'yes';
						$category = $this->comman_model->get("category",array('category_id'=>$invoice_row_data['S']));
						//echo $category;exit;
						if($category)
						$invalid_category = '';
					//	print_r($category);exit;
					$invoice_row_data = $invoice_import_data[$i];
				
				//echo "code : ". $invalid_code. "---category : " . $invalid_category."<br />";
				
				if($invalid_code_upc == '' && $invalid_code=='' && $invalid_category=='' && $invoice_row_data['A']!=''){
						
                            

                            $title = $invoice_row_data['A'];
                            $buy_price = $invoice_row_data['B'];
                            $used_price = $invoice_row_data['C'];
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
							$category_id = $invoice_row_data['S'];
                    $isbn13 = $invoice_row_data['T'];

                            $product_data = $this->comman_model->get('products', array('isbn' => $isbn));

                            if ($product_data) {
                                $product_data = $product_data[0];
								                            

                               $updated = $this->comman_model->update('products',array('isbn' => $isbn), array(
                                   "title" => $invoice_row_data['A'],
                            "buy_price" => $invoice_row_data['B'],
                            "used_price" => $invoice_row_data['C'],
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
							"category_id" => $invoice_row_data['S'],
                                   "isbn13" => $invoice_row_data['T'],
                                   "upc" => $invoice_row_data['U'],
							"image"=>$invoice_row_data['P'].".".$invoice_row_data['Q'],
							"user_id" => getCurrentUserId()
                                ));
                                 
                                  if($updated)  $total_udpates++;
                                        
                                    
                              
                            }else{
								
								if ($this->comman_model->save('products', array(
                                   "title" => $invoice_row_data['A'],
                            "buy_price" => $invoice_row_data['B'],
                            "used_price" => $invoice_row_data['C'],
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
							"category_id" => $invoice_row_data['S'],
                                    "isbn13" => $invoice_row_data['T'],
                                    "upc" => $invoice_row_data['U'],
							"image"=>$invoice_row_data['P'].".".$invoice_row_data['Q'],
                             "user_id" => getCurrentUserId()   
								))
                                ){
									$total_inserts++;
									}
								
								}
						}else{
				    $total_failed++;

                }
						}
                        $this->_data['success'] = 'Imported books successfully completed! <strong>Total Inserted books are : '.$total_inserts.' <strong>Total updated books are : '.$total_udpates . "<strong> Total Failed are :</strong>".$total_failed;
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
        $this->load->model("admin_login");
        $this->_data['author'] = $this->admin_login->author_get();
       //echo 'd';exit; //check_is_login(5);
        $this->_data['categories'] = $this->comman_model->get('category');
        $this->_data['view_path'] = "admin/products/add";
        $this->_data['page'] = "add";

        if ($this->input->server('REQUEST_METHOD') === 'POST') {

            $this->form_validation->set_rules('title', 'Product Title', 'trim|required');
     
	 
	 if($this->input->post('isbn')!=''){
			$this->form_validation->set_rules('isbn', 'ISBN 10', 'trim|required|xss_clean|min_length[10]|max_length[10]');	
				}
				
				
	 
	 		if($this->input->post('isbn13')==''){
			$this->form_validation->set_rules('isbn13', 'ISBN 13', 'trim|required');	
				}else{


			  $invalid_code13  = validateISBN13($this->input->post('isbn13'));
			if($invalid_code13!='')
              $this->form_validation->set_rules('isbn13', 'ISBN 13', 'trim|required|xss_clean|min_length[13]|max_length[13]');
			}
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
                            'image' => 'uploads/img_gallery/product_images/'.$product_img['file_name']
                        );
                    }else{
						$isImageUploaded = 1;
						$hasImage = 1;
						$productData = array(
                            'image' => 'assets/frontend/img/default-store.jpg'
                        );
						
								
						
						}

                    // If Display image is selected
                    if ($hasImage) {
						//echo $productData['image'];exit;
						
						//$image = 'uploads/img_gallery/product_images/'.$productData['image'];
					
                        $productData = array_merge($productData, array(
                            'title' => $this->input->post('title'),
							
                            'buy_price' => $this->input->post('buy_price'),
                            'used_price' => 100,
                            'isbn' => $this->input->post('isbn'),
							'isbn13' => $this->input->post('isbn13'),
							'author' => $this->input->post('author'),
							'format' => $this->input->post('format'),
							'edition' => $this->input->post('edition'),
							'language' => $this->input->post('language'),
							'grade' => $this->input->post('grade'),
							'pages' => $this->input->post('pages'),
							'weight' => $this->input->post('weight'),
							'dimensions' => $this->input->post('dimensions'),
                            'month_of_the_book' => $this->input->post('month_of_the_book'),
							
							
                            'sku' => $this->input->post('sku'),
                            'slug' => create_slug($this->input->post('title')),
//                          'buy_url' => $this->input->post('buy_url'),
                            'advertiser_id' => $this->input->post('advertiser_id'),
                            'advertiser_name' => $this->input->post('advertiser_name'),
                            'publisher' => $this->input->post('advertiser_name'),
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
        
        $this->load->model("admin_login");
        $this->_data['author'] = $this->admin_login->author_get();
        $product_id = decode_uri($this->uri->segment(5));
        $product_data = $this->comman_model->get('products', array('product_id' => $product_id));

        $this->_data['categories'] = $this->comman_model->get('category');
        $this->_data['view_path'] = "admin/products/edit";
        $this->_data['page'] = "edit";

        if (!$product_data) {
            $this->_data['errors'] = 'An error occurred, try later';
            redirect('admin/products/' . $this->uri->segment(4));
        } else {
            $this->_data['product_data'] = $product_data[0];
        }

        if ($this->input->server('REQUEST_METHOD') === 'POST') {

            $this->form_validation->set_rules('title', 'Product Title', 'trim|required');


	 
	 if($this->input->post('isbn')!=''){
			$this->form_validation->set_rules('isbn', 'ISBN 10', 'trim|required|xss_clean|min_length[10]|max_length[10]');	
				}
				
				
	 
	 		if($this->input->post('isbn13')==''){
			$this->form_validation->set_rules('isbn13', 'ISBN 13', 'trim|required');	
				}else{


			  $invalid_code13  = validateISBN13($this->input->post('isbn13'));
			if($invalid_code13!='')
              $this->form_validation->set_rules('isbn13', 'ISBN 13', 'trim|required|xss_clean|min_length[13]|max_length[13]');
			}
			
			
			
			






            if ($this->form_validation->run() !== FALSE) {

                $this->load->helper('upload_helper');
                $productData = array();
                $isImageSelected = isset($_FILES['image']['name']) ? (trim($_FILES['image']['name']) != "" ? 1 : 0) : 0;
                $isImageUploaded = 0;

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
                       'image' => 'uploads/img_gallery/product_images/'.$product_img['file_name']
                    );
                }
                $product_title = $this->input->post('title');

if($isImageUploaded==1){
    $productData = array_merge($productData, array(
        'title' => $product_title,
        'price' => $this->input->post('price'),
        'used_price' => $this->input->post('used_price'),
        'author' => $this->input->post('author'),
        'sku' => $this->input->post('sku'),
        'isbn' => $this->input->post('isbn'),
        'isbn13' => $this->input->post('isbn13'),
        'pages' => $this->input->post('pages'),
        'weight' => $this->input->post('weight'),
        'dimensions' => $this->input->post('dimensions'),
        'month_of_the_book' => $this->input->post('month_of_the_book'),




        'format' => $this->input->post('format'),
        'edition' => $this->input->post('edition'),
        'language' => $this->input->post('language'),
        'grade' => $this->input->post('grade'),




        'slug' => create_slug($product_title),
//                    'buy_url' => $this->input->post('buy_url'),
        'advertiser_id' => $this->input->post('advertiser_id'),
        'advertiser_name' => $this->input->post('advertiser_name'),
        'publisher' => $this->input->post('advertiser_name'),
        'manufacturer_sku' => $this->input->post('manufacturer_sku'),
        'manufacturer_name' => $this->input->post('manufacturer_name'),
        'category_id' => $this->input->post('category_id'),
        'description' => $this->input->post('description'),
        'date_updated' => date('Y-m-d H:i:s')
    ));

}else{
    $productData = array(
        'title' => $product_title,
        'price' => $this->input->post('price'),
        'used_price' => $this->input->post('used_price'),
        'author' => $this->input->post('author'),
        'sku' => $this->input->post('sku'),
        'isbn' => $this->input->post('isbn'),
        'isbn13' => $this->input->post('isbn13'),
        'pages' => $this->input->post('pages'),
        'weight' => $this->input->post('weight'),
        'dimensions' => $this->input->post('dimensions'),
        'month_of_the_book' => $this->input->post('month_of_the_book'),




        'format' => $this->input->post('format'),
        'edition' => $this->input->post('edition'),
        'language' => $this->input->post('language'),
        'grade' => $this->input->post('grade'),




        'slug' => create_slug($product_title),
//                    'buy_url' => $this->input->post('buy_url'),
        'advertiser_id' => $this->input->post('advertiser_id'),
        'advertiser_name' => $this->input->post('advertiser_name'),
        'publisher' => $this->input->post('advertiser_name'),
        'manufacturer_sku' => $this->input->post('manufacturer_sku'),
        'manufacturer_name' => $this->input->post('manufacturer_name'),
        'category_id' => $this->input->post('category_id'),
        'description' => $this->input->post('description'),
        'date_updated' => date('Y-m-d H:i:s')
    );

}

                if (!$isImageSelected || $isImageUploaded && $isImageSelected) {

                    $where = array('product_id' => $product_id);
                    if($this->session->userdata('admin_role_id') == 2){
                        $where['user_id'] = $this->session->userdata('admin_user_id');
                    }
                    $saved = $this->comman_model->update('products', $where, $productData);

                    if ($saved) {
                        $this->session->set_flashdata('success', 'Product Updated successfully.');
                        redirect('admin/products');
                    } else {
                        $this->_data['errors'] = 'Unable to save product. Review information and try again !';
                    }
                } else {
                    $this->_data['errors'] = 'Unable to upload product display image, please try again !';
                }

            } else {
                $this->_data['errors'] = validation_errors();
            }
        }

        $this->__loadView();
    }

    function delete()
    {

        $product_id = decode_uri($this->uri->segment(5));
        $where = array('product_id' => $product_id);
        if($this->session->userdata('admin_role_id') == 2){
            $where['user_id'] = $this->session->userdata('admin_user_id');
        }
        $deleted = $this->comman_model->delete('products', $where);

        if ($deleted) {
            $this->session->set_flashdata('success', 'Product Deleted Successfully.');
        } else {
            $this->session->set_flashdata('errors', 'Requested product not found, please try later !');
        }
        redirect('admin/products/' . $this->uri->segment(4));
    }

    function updateStatus()
    {

        $product_id = decode_uri($this->uri->segment(5));
        $status = $this->uri->segment(6);
        $where = array('product_id' => $product_id);
        if($this->session->userdata('admin_role_id') == 2){
            $where['user_id'] = $this->session->userdata('admin_user_id');
        }
        $productsData = array('status' => $status);
        $updated = $this->comman_model->update('products', $where, $productsData);

        if ($updated) {
            $msg = ($status == 1) ? 'Product Activated Successfully.' : 'Product Deactivated Successfully.';
            $this->session->set_flashdata('success', $msg);
        } else {
            $this->session->set_flashdata('errors', 'Requested product not found, please try later !');
        }
        redirect('admin/products/' . $this->uri->segment(4));
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
	
	function sellerRejections()
    {

        $start_from = $this->uri->segment(4);
        if (!is_numeric($start_from)) {
            $start_from = 0;
        }

        $where = array('id !=' => 0);

        if($this->session->userdata('admin_role_id') == 2){
            $where['user_id'] = $this->session->userdata('admin_user_id');
        }
       
        $total = $this->comman_model->get_total('seller_tried_books', $where);
        $per_page = 10;
        $num_links = 4;
        $uri_segment = 3;

        $this->_data['pagination'] = paginate(base_url() . 'admin/products/seller_rejections/', $total, $per_page, $num_links, $uri_segment);
        $this->_data['results'] = $this->comman_model->get_all_limited('seller_tried_books', $per_page, $start_from, $where);
        $this->_data['page'] = "index";
        $this->_data['view_path'] = 'admin/products/seller_rejections';

        $this->__loadView();
    }
	
	
	
	
	
}