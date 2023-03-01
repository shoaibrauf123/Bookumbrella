<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users extends CI_Controller
{
    private $_data;

    public function __construct()
    {
        parent::__construct();
		$this->load->library('PHPExcel');
        $this->load->model('comman_model');
		$this->load->helper('common_helper');
        $this->load->model('user_model');
		 $this->load->model('product_model');
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
        return 'user';
    }
    function table_name2()
    {
        return 'store';
    }

    function index()
    {

    }
 	

 function pay_file()
    {

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

                            $invoice_no = $invoice_row_data['A'];
                            $amount = $invoice_row_data['B'];
                            $invoice_status = $invoice_row_data['C'];

                            $invoice_data = $this->comman_model->get('invoices', array('invoice_number' => $invoice_no));

                            if ($invoice_data) {
                                $invoice_data = $invoice_data[0];
                                $inv_calc_status = strtolower($invoice_status) == 'paid' ? 1 : 0;

                                if ($this->comman_model->save('pay_file', array(
                                    'invoice_no' => $invoice_no,
                                    'amount' => $amount,
                                    'invoice_status' => $invoice_status,
                                    'updated_by' => login_user_id(),
                                    'client_id' => $invoice_data['client_id']
                                ))
                                ) {
                                    if ($inv_calc_status) {
                                        $this->comman_model->update('invoices', array('invoice_number' => $invoice_no), array('payment_status' => $inv_calc_status));
                                    }
                                }
                            }
                        }
                        $this->data['success'] = 'Imported information successfully updated invoice payments !';
                    } else {
                        $this->data['errors'] = 'Selected file is empty or have some invalid data !';
                    }
                } catch (Exception $e) {
                    $this->data['errors'] = $e->getMessage();
                }
            } else {
                $this->data['errors'] = lang('wrong_import_file_format');
            }
        }

        $this->data['view_path'] = 'admin/invoices/import_pay_file';
        $this->data['page'] = 'pay_file';
        $this->__loadView();
    }
	
	function seller_registration()
    {
        $this->_data['main_content'] = 'frontend/pages/seller_registration';
                $this->__loadView();
    }
	
    function registration()
    {
       // echo 'i am registration';exit;
        if ($this->session->userdata('logged_in') == TRUE)
            redirect();
        if (isset($_GET['ref']) && $this->input->get('ref') != '') {
            $ref_id = $this->input->get('ref');
            if (strlen($ref_id) == 32) {
                $data = $this->comman_model->get('refer_link', array('activation_hash' => $ref_id));
                if ($data) {
                    $this->session->set_userdata('ref_by', $data[0]['user_id']);
                    $this->session->set_userdata('ref_id', $data[0]['id']);
                    //print_r($this->session->all_userdata());die;
                    redirect('registration');
                } else {
                    $this->session->set_flashdata('errors', 'Invalid link');
                    redirect('registration');

                }
            } else {
                $this->session->set_flashdata('errors', 'Invalid link');
                redirect('registration');
            }
        }
        if ($this->input->server('REQUEST_METHOD') == 'POST') {

            if($this->input->post('address') != ""){
                $seller_address = $this->input->post('seller_address');
            }else{
                $seller_address = "";
            }


            if($this->input->post('user_type')=='seller'){
                $this->form_validation->set_rules('terms_and_conditions','Check Terms and Conditions','trim|required');
            }


            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[user.email]|max_length[255]');
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|max_length[32]');
            $this->form_validation->set_rules('confirm_password', 'Confirm password', 'required|matches[password]|min_length[6]|max_length[32]');
            if ($this->form_validation->run() == true) {
                $activation_hash = $this->generate_hash();
                $user_data = array(
                    'referred_by' => $this->session->userdata('ref_by'),
                    'email' => $this->input->post('email'),
					'country' => $this->input->post('country'),
                    'username' => $this->input->post('user_name'),
					'address' => $seller_address,
					'user_type' => $this->input->post('user_type'),
                    'state' => $this->input->post('state_name'),
                    'city' => $this->input->post('city_name'),
                    'postal_code' => $this->input->post('zip_code'),
                    'tax_id' => $this->input->post('tax_id'),
                    'tax_type' => $this->input->post('tax_id_type'),
                    'password' => md5($this->input->post('password')),
                    'date_created' => date("Y-m-d H:i:s"),
                    'activation_hash' => $activation_hash,
                    'role_id' => 3,
                    'status' => 0
                );
               
                $is_register = $this->comman_model->save($this->table_name(), $user_data);
         
                if ($is_register) {
                    //echo '';print_r($this->session->all_userdata());
                    //echo '<pre>';print_r($_POST);exit;
                    if($this->input->post('user_type')=='seller'){

                        $selling_options = array(
                            'seller_id'=>$is_register,
                            'standard'=>'active',
                            'date_created'=>date("Y-m-d H:i:s"),

                        );
                        //$selling_options

                        $updated = $this->comman_model->save('seller_shippings', $selling_options);
                        
          
                        $seller_store = array(
                            'user_id'=>$is_register,
                            'name'=>$this->input->post('store_name'),
                            'address'=>$this->input->post('store_address'),
                            'date_created'=>date("Y-m-d H:i:s"),

                        );
                        //$selling_options
//echo 'ajskldfasf';exit;
                        $updated = $this->comman_model->save('store', $seller_store );
                    }                       
          





                    if ($this->session->userdata('ref_by') != '') {
                        $cashback_data = array(
                            'user_id' => $this->session->userdata('ref_by'),
                            'cashback_value' => getSettingValue('signup_bonus'),
                            'referred_user_id' => $is_register,
                            'unique_code' => $this->generate_hash(),
                            'date_created' => date('Y-m-d H:i:s')
                        );
                        $this->comman_model->save('cashback', $cashback_data);
                    }

                    $this->comman_model->delete('refer_link', array('id' => $this->session->userdata('ref_id')));
                    $this->session->unset_userdata('ref_id');
                    $this->session->unset_userdata('ref_by');
                    $name = 'Administrator - bookumbrella.com';
                    $subject = 'Welcome to bookumbrella.com - Email account confrimation required';
                    $message = '<html>
                       <body bgcolor="#EDEDEE">
                       <p><div align="center" style="c  olor:#303E49"><h1>YOU HAVE SUCCESSFULLY REGISTERED</h1></div></p>
                       <p><div align="center" style="margin-top:15px; margin-bottom:50px;"><img src="' . base_url('assets/frontend/img/logo.png') . '" class="img-responsive" style="width:auto;"  /><div></p>
                       <p><strong> Dear ' . $this->input->post('first_name') . ' ' . $this->input->post('last_name') . '!</strong></p>
                       <p>Thank you for registering at bookumbrella.com.</p>
                       <p>Please keep your username and password safe.</p>
                       <p style="margin-top:20px;">Click the link below to activate bookumbrella.com account:<br><p style="margin-top:15px; margin-bottom:15px; font-size:16px;">'
                        . anchor(base_url('activate_account/' . $activation_hash . '/' . urlencode($this->input->post('email'))), "Activate Account") . '</p></p>
                       <p>Regards<p>
                       <p>Team <strong>bookumbrella.com</strong><p>
                       </body>
                       </html>';
                    $email = trim($this->input->post('email'));
                    do_email($email, getAdminEmail(), $subject, $message);
                    if($this->input->post('user_type')=='seller')
                    {
                    $this->session->set_flashdata('success', 'Your account has been successfully created as a Seller ! Please check your inbox to activate your account.');
                    redirect('seller_registration');
                    }
                    else if($this->input->post('user_type')=='buyer')
                    {
                        $this->session->set_flashdata('success', 'Your account has been successfully created  created as a Buyer ! Please check your inbox to activate your account.');
                        redirect('registration');
                    }
                } else {
                    $this->session->set_flashdata('errors', 'An error occurred, try later');
                    redirect('registration');

                }

            } else {
                //$this->session->set_flashdata('errors',validation_errors());
                $this->_data['errors'] = validation_errors();
                $this->_data['main_content'] = 'frontend/pages/registration';
                $this->__loadView();

            }
        } else {
            $this->_data['main_content'] = 'frontend/pages/registration';
            $this->__loadView();
        }
    
}

   
    function login()
    {
       

        if ($this->session->userdata('logged_in') == TRUE)
            redirect();
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $this->form_validation->set_rules('email', 'Email', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');
            if ($this->form_validation->run() == true) {
                ;
                $login_details = array(
                    'email' => $this->input->post('email'),
                    'password' => md5($this->input->post('password')),
                    'role_id' => 3
                );
                $user_data = $this->user_model->verify_user($login_details);
                if (!$user_data) {
                    $this->_data['errors'] = 'Invalid username or password';
                } else if ($user_data[0]['status'] != 1) {
                    $this->_data['errors'] = 'account deactivated by admin.';
                } else {
                    $this->session->set_userdata('logged_in', TRUE);
                    $this->session->set_userdata($user_data[0]);
                    redirect('my_account');;
                }
            } else {
                $this->session->set_flashdata('errors', validation_errors());
                redirect('login');
            }
        }
        $this->_data['main_content'] = 'frontend/pages/login';
        $this->__loadView();
    }



    function Profile()
    {

        if ($this->session->userdata('logged_in') == TRUE) {


			
			$my_products = $this->product_model->search_products('seller_products',500,0,false, array('user_id' => getCurrentUserId()),array('id' => 'ASC'),false);
			$this->_data['my_products'] = $my_products;

            $this->_data['main_content'] = 'frontend/pages/profile';
            $this->__loadView();

        } else {
            redirect('login');
        }
    }
	
	
    function myAccount()
    {

        if ($this->session->userdata('logged_in') == TRUE) {

            $layouts_data = $this->comman_model->get('layouts');

            $cashback_data = $this->comman_model->get('cashback',array('user_id'=>getCurrentUserId()),'*',array('cashback_id'=>'desc'));
            $cashout_data = $this->comman_model->get('cashout',array('user_id'=>getCurrentUserId()),'*',array('cashout_id'=>'desc'));
//            debug($cashout_data,1);

            $totalExitClicks = get_total('exit_click',array('user_id'=>getCurrentUserId()));

            $confirmedCashbackValue = $this->user_model->get_confirmed_cashback_value();
            $pendingCashbackValue = $this->user_model->get_pending_cashback_value();
			
			$my_products = $this->product_model->search_products('seller_products',500,0,false, array('user_id' => getCurrentUserId()),array('id' => 'ASC'),false);
			$this->_data['my_products'] = $my_products;
            $this->_data['cashbacks']['record'] = $cashback_data;
            $this->_data['cashouts']['record'] = $cashout_data;
            $this->_data['total_exit_clicks'] = $totalExitClicks;
            $this->_data['confirmed_cashback_value'] = $confirmedCashbackValue;
            $this->_data['pending_cashback_value'] = $pendingCashbackValue;

            $this->_data['layouts'] = $layouts_data;
            $this->_data['main_content'] = 'frontend/pages/my-account';
            $this->__loadView();

        } else {
            redirect('login');
        }
    }
function myOrders(){
	

        if ($this->session->userdata('logged_in') == TRUE) {

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
            $this->_data['main_content'] = 'frontend/products/orders/listing';
            $this->__loadView();

        } else {
            redirect('login');
        }
    
	
	
	
	}
	

function paymentSummary(){
	

        if ($this->session->userdata('logged_in') == TRUE) {

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
            $this->_data['main_content'] = 'frontend/products/orders/payment-summary';
            $this->__loadView();

        } else {
            redirect('login');
        }
    
	
	
	
	}
	
function paymentDetails(){
	

        if ($this->session->userdata('logged_in') == TRUE) {

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
            $this->_data['main_content'] = 'frontend/products/orders/payment-details';
            $this->__loadView();

        } else {
            redirect('login');
        }
    
	
	
	
	}	
		
	
	
function myOrdersDetails(){
	
//echo $this->uri->segment(2);exit;
        if ($this->session->userdata('logged_in') == TRUE) {

            $layouts_data = $this->comman_model->get('layouts');

            
			
			$my_orders = $this->comman_model->getgrouped_orders('purchase', array('user_id' => getCurrentUserId(),'order_id'=>$this->uri->segment(2)),'*',array('created_on'=>'DESC'));
			$this->_data['my_orders'] = $my_orders;
			//echo '<pre>';print_r($my_orders);exit;	
            $this->_data['layouts'] = $layouts_data;
            $this->_data['main_content'] = 'frontend/products/orders/listing-details';
            $this->__loadView();

        } else {
            redirect('login');
        }
    
	
	
	
	}
	


	

	
function OrderTrackingDetails(){
	
//echo $this->uri->segment(2);exit;
        if ($this->session->userdata('logged_in') == TRUE) {

            $layouts_data = $this->comman_model->get('layouts');

            
			
			$my_orders = $this->comman_model->getgrouped_orders('purchase', array('user_id' => getCurrentUserId(),'order_id'=>$this->uri->segment(2)),'*',array('created_on'=>'DESC'));
			$this->_data['my_orders'] = $my_orders;
			//echo '<pre>';print_r($my_orders);exit;	
            $this->_data['layouts'] = $layouts_data;
            $this->_data['main_content'] = 'frontend/products/orders/tracking-details';
            $this->__loadView();

        } else {
            redirect('login');
        }
    
	
	
	
	}
	
		
		
		
	
	
	
    function activate_account()
    {
        if ($this->uri->segment(2) != "" && $this->uri->segment(3) != "") {
            $hash = $this->uri->segment(2);
            $email = urldecode($this->uri->segment(3));

            $hash = $this->uri->segment(2);
            $email = urldecode($this->uri->segment(3));
            if (strlen($hash) == 32 && filter_var($email, FILTER_VALIDATE_EMAIL) != "") {
                $activated = $this->user_model->activate_user_account(array
                    (
                        'activation_hash' => $hash,
                        'email' => $email
                    )
                );
                if (!$activated) {
                    $this->session->set_flashdata('errors', "Invalid activation link");
                } else {
                    $this->session->set_flashdata('success', "Email account confirmed. Your account has been activated successfully.");
                }
            } else {
                $this->session->set_flashdata('errors', 'Activation link is not valid');
            }
        }
        redirect('login');
    }
function forget_password()
    {
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $this->form_validation->set_rules('email', 'Email', 'trim|required');
            if ($this->form_validation->run() == true) {
                $user_email = array('email' => $this->input->post('email'));
                $user_data = $this->user_model->verify_user($user_email);
                if ($user_data) {
                    $reset_hash = $this->generate_hash();
                    // send password reset email
                    $name = 'Administrator - bookumbrella.com';
                    $subject = 'bookumbrella.com - Reset password link';
                    $message = '<html><body><strong>Hi</strong>' .
                        '<br>Click the link below to reset your password:<br>' . anchor(base_url('reset_password/' . $reset_hash), "Reset Password") .
                        '<br><p>Regards</p>
                                <p>Team <strong>bookumbrella.com</strong></p>
                                </body></html>';
                    if (do_email($user_data[0]['email'], getAdminEmail(), $subject, $message)) {
                        $updated = $this->user_model->updateUserProfile(array('password_reset_hash' => $reset_hash),
                            array('user_id' => $user_data[0]['user_id']));
                        if ($updated) {
                            $this->session->set_flashdata('success', 'Password reset email sent successfully, check your inbox.');
                            redirect('forgot_password');
                        } else {
                            $this->session->set_flashdata('errors', 'An error occurred, try again');
                            redirect('forgot_password');
                        }
                    } else {
                        $this->session->set_flashdata('errors', 'Could not send email, try later.');
                        redirect('forgot_password');
                    }
                } else {
                    $this->session->set_flashdata('errors', 'User does not exist');
                    redirect('forgot_password');
                }
            } else {
                $this->session->set_flashdata('errors', validation_errors());
                redirect('forgot_password');
            }
        }
        $this->_data['main_content'] = 'frontend/pages/forgot_password';
        $this->__loadView();
    }

    function reset_password()
    {
        if (!$this->session->userdata('logged_in')) {
            if (strlen($this->uri->segment(2)) == 32) {
                $user_data = $this->user_model->verify_user(array('password_reset_hash' => $this->uri->segment(2)));
                if ($user_data) {
                    $this->_data['main_content'] = 'frontend/pages/reset_password';
                    $this->__loadView();
                    return;
                }
            } else {
                $this->session->set_flashdata('errors', 'Invalid rest link');
            }
            redirect();
        } else {
            redirect();
        }
    }

    function change_password()
    {

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|max_length[32]');
            $this->form_validation->set_rules('password_confirm', 'Repeat Password', 'trim|required|matches[password]');
            $hash = $this->uri->segment(2);
            if ($this->form_validation->run() == true) {
                $user_data = array('password_reset_hash' => '',
                    'password' => md5($this->input->post('password')));
                $updated = $this->user_model->updateUserProfile($user_data, array('password_reset_hash' => $hash));
                if ($updated) {
                    $this->session->set_flashdata('success', 'Your password rest successfully');
                    redirect();
                } else {
                    $this->session->set_flashdata('errors', 'invalid reset link');
                }
            } else {
                $this->session->set_flashdata('errors', validation_errors());
            }
            redirect('change_password/' . $hash);
        } else {
            redirect();
        }
    }


    

    public function update_user_profile()
    {

        $response_msg = 'Required fields are missing or have some invalid information';
        $status = 0;
        $havePassword = 0;
        $isPasswordSuccessful = 0;
        $isUpdated = 0;

        $user_id = $_POST['user_id'] ? $_POST['user_id']:'';
        $email = $_POST['email'] ? $_POST['email']:'';
        $country = $_POST['country'] ? $_POST['country']:'';
        $current_pass = $_POST['current_password'] ? $_POST['current_password']:'';
        $new_password = $_POST['password'] ? $_POST['password']:'';
        $password_confirm = $_POST['password_confirm'] ? $_POST['password_confirm']:'';

        if($user_id){
            $updated_data = array(
                'email' => $email,
                'country' => $country,
                'date_updated' => date("Y-m-d H:i:s")
            );

            if($current_pass || $new_password || $password_confirm){

                $havePassword = 1;
                $user_data = getUserData($user_id);

                if($current_pass){
                    if(md5($current_pass) == $user_data['password']){
                        if(!$new_password){
                            $response_msg = 'New password field is empty or have some invalid information !';
                        } else if(!$password_confirm){
                            $response_msg = 'Confirmation password field is empty or have some invalid information !';
                        } else if($new_password != $password_confirm){
                            $response_msg = 'Confirmation password does not match with your new password !';
                        } else {
                            if(strlen($new_password) >= 6){
                                $isPasswordSuccessful = 1;
                                $updated_data = array_merge($updated_data,array('password'=>md5($new_password)));
                            } else {
                                $response_msg = 'Password length should not be less than 6 !';
                            }
                        }
                    } else {
                        $response_msg = 'Invalid current password ! Please enter your current password to update it.';
                    }
                } else {
                    $response_msg = 'Current password field is empty or have some invalid information !';
                }
            }

            if($havePassword && $isPasswordSuccessful || !$havePassword && !$isPasswordSuccessful ){
                $isUpdated = $this->user_model->updateUserProfile(
                    $updated_data,
                    array( 'user_id' => $this->session->userdata('user_id') )
                );


                if($this->session->userdata('user_type')=='Seller') {
                    $subject = 'Your profile has been updated';
                    $message = '<html>
                       <body bgcolor="#EDEDEE">
                       
                       <p><div align="center" style="margin-top:15px; margin-bottom:50px;"><img src="' . base_url('assets/frontend/img/logo.png') . '" class="img-responsive" style="width:auto;"  /><div></p>
                       <p><strong> Dear ' . $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name') . '!</strong></p>
                       <br />
                       <p><div align="center" style="color:#303E49"><h1>YOU HAVE SUCCESSFULLY UPDATED YOUR PROFILE</h1></div></p>
                       <br />
                       <p>Regards<p>
                       <p>Team <strong>bookumbrella.com</strong><p>
                       </body>
                       </html>';
               $email_notifications = $this->comman_model->get("email_notifications",array("user_id"=>getCurrentUserId()));
                    $email = $this->session->userdata('email');
               if($email_notifications!=0){
                   $email = $email_notifications[0]['account_notification'];
               }


                    do_email($email, getAdminEmail(), $subject, $message);
                }



            }


            if($isUpdated){
                $this->session->set_userdata(array('email'=>$email));
                $response_msg = 'Profile information successfully updated !';
                $status = 1;
            }
        }

        if($status==1){
            $this->session->set_flashdata('success', $response_msg);

        }else{
            $this->session->set_flashdata('errors', $response_msg);
        }

        redirect('profile');

        $response = array(
            'msg' => $response_msg,
            'status' => $status
        );

        echo json_encode($response); exit;
    }

    public function update_user_profile_dummy()
    {

        if ($this->input->server('REQUEST_METHOD') === 'POST' && $this->session->userdata('logged_in') == TRUE) {

            $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean');
            //echo $this->session->user_id;die;
            if ($this->session->userdata('user_id')) {
                if ($this->form_validation->run() == FALSE) {
                    $this->session->set_flashdata('errors', validation_errors());
                    redirect('my_account');
                } else {

                    $updated_data = array(
                        'email' => $this->input->post('email')
                    );
                    $update = $this->user_model->updateUserProfile($updated_data, array('user_id' => $this->session->userdata('user_id')));
                    if ($update == 1) {
                        $this->session->set_userdata($updated_data);
                        $this->session->set_flashdata('success', 'Updated successfully.');
                        redirect('my_account');;
                    } else if ($update == 0) {
                        $this->session->set_flashdata('errors', 'Nothing updated. You did not updated anything.');
                        redirect('my_account');;
                    } else {
                        $this->session->set_flashdata('errors', 'An error occurred, try later');
                        redirect('my_account');;
                    }
                }
            } else {
                $this->session->set_flashdata('errors', 'Bad Request');
                redirect('my_account');;
            }
        } else {
            $this->session->set_flashdata('errors', 'Bad Request');
            redirect('my_account');;
        }
    }

    function validate_password($current_password)
    {
        if (md5($current_password) === $this->session->userdata('password')) {
            return TRUE;
        } else {
            $this->form_validation->set_message('validate_password', 'The %s field do not match your old password.');
            return FALSE;
        }
    }

    function update_my_password()
    {
        if ($this->input->server('REQUEST_METHOD') === 'POST' && $this->session->userdata('logged_in') === TRUE) {
            $this->form_validation->set_rules('current_password', 'Current Password', 'trim|required|callback_validate_password|xss_clean');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|max_length[32]|xss_clean');
            $this->form_validation->set_rules('password_confirm', 'Repeat Password', 'trim|required|matches[password]|xss_clean');
            if ($this->form_validation->run() == TRUE) {
                $update = $this->user_model->updateUserProfile(array(
                    'password' => md5($this->input->post('password')),
                    'date_updated' => date("Y-m-d H:i:s")
                ), array(
                    'user_id' => $this->session->userdata('user_id')
                ));
                if ($update) {
                    $this->session->set_flashdata('success', 'Password changed successfully! <br> Login with your new password.');
                } else {
                    $this->session->set_flashdata('errors', 'An error occurred, try again');
                }
            } else {
                $this->session->set_flashdata('errors', validation_errors());
            }
        }
        redirect('my_account');;
    }


    function generate_hash()
    {
        $this->load->helper('string');
        return random_string('unique');
    }

    public function upload_user_pic()
    {
        $results = array();
        $uploadPath = FCPATH . 'uploads/img_gallery/user_images/';
        
        if ($this->input->server('REQUEST_METHOD') === 'POST' && $this->session->userdata('logged_in') == TRUE) {
          $uploaded = $this->_uplaod_pic('profile_pic', $uploadPath);
            if ($uploaded) {
                $updated_data = array(
                    'avatar' => $this->session->userdata('avatar')
                );
                $update = $this->user_model->updateUserProfile($updated_data,array('user_id'=>$this->session->userdata('user_id')));
                if ($update == 1) {
                    $results['success'] = 'ok';
                    $results['message'] = '<p style="color:green; margin-left:5px;">Updated successfully.</p>';
                    $results['user_profile_pic'] = str_replace('.', '_200x200.', $this->session->userdata('avatar'));
                } else {
                    $results['success'] = 'no';
                    $results['message'] = 'Nothing updated. You did not updated anything.';
                }
            } else {
                $results['success'] = 'no';
                $results['message'] = $uploaded;
            }

            echo json_encode($results);
        }
    }

    private function _uplaod_pic($fileName, $path)
    {  
        $profile_pic = array();
        $updated = FALSE;
        if (isset($_FILES[$fileName]['name']) && trim($_FILES[$fileName]['name']) != "") {
            $profile_pic = upload_image($fileName, $path);
            if (isset($profile_pic['error'])) {
                if ($profile_pic['error'] < 0) {
                    $updated = $profile_pic['error'];
                }
            } else {
                $thumb_sizes = array(
                    array(200, 200)
                );
                $thumb_data = resize_image($profile_pic, $thumb_sizes);
                
                if (isset($thumb_data['error'])) {
                    $updated = $thumb_data['error'];
                } else {
                    $this->session->set_userdata('avatar', $profile_pic['file_name']);
                    $updated = TRUE;
                }
            }
        }
        return $updated;
    }

    public function seller_information()
    {
        if ($this->session->userdata('logged_in') != TRUE)
            redirect();
        $seller = $this->comman_model->get("store",array("user_id"=>$this->session->userdata('user_id')));

        $this->_data['store'] = $seller[0];
        $this->_data['main_content'] = 'frontend/products/seller_information';
        $this->__loadView();
    }

    public function reffered_friend()
    {
        if ($this->session->userdata('logged_in') != TRUE)
            redirect();
        $this->_data['result'] = $this->comman_model->get('user', array('referred_by' => $this->session->userdata('user_id')));
        $this->_data['main_content'] = 'frontend/pages/reffered_friend';
        $this->__loadView();
    }

    public function logout()
    {
        if ($this->session->userdata('logged_in') == TRUE)
            $this->session->sess_destroy();
        $this->session->userdata('logged_in', FALSE);
        redirect();
    }

    function setActiveLayout(){

        if ($this->session->userdata('logged_in') == TRUE){

            $layout_id = decode_uri($this->uri->segment(2));

            $where = array('slug' => 'active_layout');
            $settingVal = array('value' => $layout_id);
            $updated = $this->comman_model->update('setting',$where,$settingVal);

            if($updated){
                $this->session->set_flashdata('success','Layout settings updated successfully !');
            } else {
                $this->session->set_flashdata('errors','Unable to update layout settings !');
            }

            redirect('my_account');;

        } else {
            redirect();
        }
    }

    function addSellerPaymentMethod()
    {
        if($this->session->userdata('user_type')=='Buyer'){
            redirect('payment_method');
        }

		
		if($this->uri->segment(2)=='delete' && $this->uri->segment(4)!=''){
			
				$paypal_accounts = $this->comman_model->delete($this->uri->segment(3),array("id"=>$this->uri->segment(4)));		
				$this->session->set_flashdata('success', "Record has been deleted successfully.");
				redirect(base_url("payment_method"));
			
			}
		
        $user_id = getCurrentUserId();
		
		 
		

        

       
		
        $user_data = $this->comman_model->get('user',array('user_id' => $user_id));
		
        if($user_data){

            if ($this->input->server('REQUEST_METHOD') === 'POST'){
				

                $payment_method = $this->input->post('pm');
				if($payment_method == 'cc'){

                    $this->form_validation->set_rules('title', 'Title', 'trim|required');
					$this->form_validation->set_rules('card_no', 'Card Number', 'trim|required');
					 $this->form_validation->set_rules('expiry_month', 'Expiry Month', 'trim|required');
					  $this->form_validation->set_rules('expiry_year', 'Expiry Year', 'trim|required');
            
			
			
                }
                else if($payment_method == 'amazon'){

                    $this->form_validation->set_rules('username', 'Username', 'trim|required');
					$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|max_length[32]');
            		$this->form_validation->set_rules('confirm_password', 'Confirm password', 'required|matches[password]|min_length[6]|max_length[32]');
            
			
			
                }else if($payment_method == 'paypal'){

                    $this->form_validation->set_rules('email', 'Paypal Email', 'trim|required');

                } else if($payment_method == 'bank'){
					//echo '<pre>';print_r($_POST);exit;
					if($this->input->post('country') == 'Pakistan'){
                    $this->form_validation->set_rules('account_no', 'Account Number');
                    $this->form_validation->set_rules('account_title', 'Account Title');
                    $this->form_validation->set_rules('swift_code', 'Swift Code');
                    $this->form_validation->set_rules('bank_name', 'Bank Name');
                    
					
                    }
                    else if($this->input->post('country') == 'India'){
                        
						 $this->form_validation->set_rules('account_title', 'Account Title');
						 $this->form_validation->set_rules('ifsc', 'Indian Financial System Code(IFSC)');
						 $this->form_validation->set_rules('account_no', 'Account Number');
						 
						
                    }else if($this->input->post('country') == 'Australia'){

						$this->form_validation->set_rules('account_title', 'Account Title');
						$this->form_validation->set_rules('bank_branch', 'Bank State Branch Code');
						$this->form_validation->set_rules('account_no', 'Account Number');

                    }else if($this->input->post('country') == 'Canada'){
                        $this->form_validation->set_rules('institution_number', 'Institution Number');
						$this->form_validation->set_rules('account_title', 'Account Title');
						$this->form_validation->set_rules('transit_number', 'Transit Number');
						$this->form_validation->set_rules('account_no', 'Account Number');
						
						
                    }else if(
                        $this->input->post('country') == 'Germany' ||
                        $this->input->post('country') == 'Belgium' ||
                        $this->input->post('country') == 'Bulgaria' ||
                        $this->input->post('country') == 'Croatia' ||
                        $this->input->post('country') == 'CzechRepublic' ||
                        $this->input->post('country') == 'Denmark' ||
                        $this->input->post('country') == 'Estonia' ||
                        $this->input->post('country') == 'Finland' ||
                        $this->input->post('country') == 'France' ||
                        $this->input->post('country') == 'Germany' ||
                        $this->input->post('country') == 'Greece' ||
                        $this->input->post('country') == 'Hungry' ||
                        $this->input->post('country') == 'Hungry' ||
                        $this->input->post('country') == 'Italy' ||
                        $this->input->post('country') == 'Poland' ||
                        $this->input->post('country') == 'Romania' ||
                        $this->input->post('country') == 'Portugal' ||
                        $this->input->post('country') == 'Spain'  ){
                         $this->form_validation->set_rules('iban', 'IBAN');
						$this->form_validation->set_rules('account_title', 'Account Title');
						$this->form_validation->set_rules('bic', 'BIC');
						
						
						
                    }else if($this->input->post('country') == 'HongKong'){
                    $this->form_validation->set_rules('account_no', 'Account Number');
                    $this->form_validation->set_rules('account_title', 'Account Title');
                    $this->form_validation->set_rules('clearing_code', 'Clearing Code');
                    $this->form_validation->set_rules('bank_branch', 'Branch Code');
					
                    }else if($this->input->post('country') == 'Singapore'){
                    $this->form_validation->set_rules('account_no', 'Account Number');
                    $this->form_validation->set_rules('account_title', 'Account Title');
                    $this->form_validation->set_rules('bank_name', 'Bank Code');
					$this->form_validation->set_rules('bank_branch', 'Branch Code');									
					
                    }else if($this->input->post('country') == 'UnitedKingdom'){
                   $this->form_validation->set_rules('account_no', 'Account Number');
                    $this->form_validation->set_rules('account_title', 'Account Title');
                    $this->form_validation->set_rules('bank_sort_code1', 'Bank Sort Code First Box');
                    $this->form_validation->set_rules('bank_sort_code2', 'Bank Sort Code Second Box');
                    $this->form_validation->set_rules('bank_sort_code3', 'Bank Sort Code Third Box');	
                    }
                    
                    
                }

                if ($this->form_validation->run() !== FALSE) {
					//echo 'here not false.';exit;
				
                    $saved = $this->comman_model->save('payment_method',
                        array(
                            'billing_address' => $this->input->post('billing_address'),
                            'selected_pm' => $payment_method,
                            'user_id' => $user_id
                        )
                    );

                    if ($saved) {
                        if($payment_method == 'cc'){
                            $this->comman_model->save('pm_card',
                                array(
                                    'title' => $this->input->post('title'),
									'card_no' => $this->input->post('card_no'),
									'expiry_month' => $this->input->post('expiry_month'),
									'expiry_year' => $this->input->post('expiry_year'),
										
                                    'pm_id' => $saved,
                                    'user_id' => $user_id
                                )
                            );
                        }
						else if($payment_method == 'amazon'){
                            $this->comman_model->save('pm_amazon',
                                array(
                                    'username' => $this->input->post('username'),
									'password' => md5($this->input->post('password')),
                                    'pm_id' => $saved,
                                    'user_id' => $user_id
                                )
                            );
                        }else if($payment_method == 'paypal'){
                            $this->comman_model->save('pm_paypal',
                                array(
                                    'email' => $this->input->post('email'),
                                    'pm_id' => $saved,
                                    'user_id' => $user_id
                                )
                            );
                        } else if($payment_method == 'bank'){
							
                            $this->comman_model->save('pm_bank',
                                array(
                                    'account_no' => $this->input->post('account_no'),
                                    'account_title' => $this->input->post('account_title'),
									'account_type' => $this->input->post('account_type'),
                                    'swift_code' => $this->input->post('swift_code'),
                                    'bank_name' => $this->input->post('bank_name'),
									'ifsc' => $this->input->post('ifsc'),
									'bank_branch' => $this->input->post('bank_branch'),
                                    'bank_state_branch_code' => $this->input->post('bank_state_branch_code'),
									'institution_number' => $this->input->post('institution_number'),
									'transit_number' => $this->input->post('transit_number'),
									'iban' => $this->input->post('iban'),
									'bic' => $this->input->post('bic'),
									'country' => $this->input->post('country'),
									'clearing_code' => $this->input->post('clearing_code'),
									
									'pm_id' => $saved,
                                    'user_id' => $user_id
                                )
                            );
							
							echo 'success';exit;
							
                        }

                        //redirect($redirect_url);
                    } else {
                        $this->_data['errors'] = 'Unable to save payment method information. Please review your input data !';
                    }

                } else {
					
					if($payment_method == 'paypal'){
                    $this->_data['errors'] = validation_errors();
					}else{
						echo 'here error';exit;
						$arr[] = str_replace("<p>","",validation_errors());
						echo $arr[] = str_replace("</p>","",$arr);exit;
						exit;
						
						
						}
					
					
                }
            }
			
			
		$paypal_accounts = $this->comman_model->get("pm_paypal",array("user_id"=>$user_id));
		$this->_data['paypal_accounts'] = $paypal_accounts;
		$amazon_accounts = $this->comman_model->get("pm_amazon",array("user_id"=>$user_id));
		$this->_data['amazon_accounts'] = $amazon_accounts;
		$card_accounts = $this->comman_model->get("pm_card",array("user_id"=>$user_id));
		$this->_data['card_accounts'] = $card_accounts;
		
		$bank_accounts = $this->comman_model->get("pm_bank",array("user_id"=>$user_id));
		$this->_data['bank_accounts'] = $bank_accounts;



		$this->_data['main_content'] = "frontend/users/add_seller_payment_method";
        $this->_data['page'] = "add_seller_payment_method";

            $this->__loadView();

        } else {
            redirect();
        }


    }
	
	
	

    function addPaymentMethod()
    {


        if ($this->session->userdata('logged_in') == TRUE) {

            if($this->session->userdata('user_type')=='Seller'){
                //redirect('seller_payment_method');
            }

            if ($this->uri->segment(2) == 'delete' && $this->uri->segment(4) != '') {

                $paypal_accounts = $this->comman_model->delete($this->uri->segment(3), array("id" => $this->uri->segment(4)));
                $this->session->set_flashdata('success', "Record has been deleted successfully.");
                redirect(base_url("payment_method"));

            }

            $user_id = getCurrentUserId();


            $user_data = $this->comman_model->get('user', array('user_id' => $user_id));

            if ($user_data) {

                if ($this->input->server('REQUEST_METHOD') === 'POST') {

//print_r($_POST);exit;
                    $payment_method = $this->input->post('pm');
                    if ($payment_method == 'cc') {

                        $this->form_validation->set_rules('title', 'Title', 'trim|required');
                        $this->form_validation->set_rules('card_no', 'Card Number', 'trim|required');
                        $this->form_validation->set_rules('expiry_month', 'Expiry Month', 'trim|required');
                        $this->form_validation->set_rules('expiry_year', 'Expiry Year', 'trim|required');


                    } else if ($payment_method == 'amazon') {

                        $this->form_validation->set_rules('username', 'Username', 'trim|required');
                        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|max_length[32]');
                        $this->form_validation->set_rules('confirm_password', 'Confirm password', 'required|matches[password]|min_length[6]|max_length[32]');


                    } else if ($payment_method == 'paypal') {

                        $this->form_validation->set_rules('email', 'Paypal Email', 'trim|required');

                    } else if ($payment_method == 'bank') {
                        //echo '<pre>';print_r($_POST);exit;
                        if ($this->input->post('country') == 'Pakistan') {
                            $this->form_validation->set_rules('account_no', 'Account Number', 'trim|required');
                            $this->form_validation->set_rules('account_title', 'Account Title', 'trim|required');
                            $this->form_validation->set_rules('swift_code', 'Swift Code', 'trim|required');
                            $this->form_validation->set_rules('bank_name', 'Bank Name', 'trim|required');


                        } else if ($this->input->post('country') == 'India') {

                            $this->form_validation->set_rules('account_title', 'Account Title', 'trim|required');
                            $this->form_validation->set_rules('ifsc', 'Indian Financial System Code(IFSC)', 'trim|required');
                            $this->form_validation->set_rules('account_no', 'Account Number', 'trim|required');


                        } else if ($this->input->post('country') == 'Australia') {

                            $this->form_validation->set_rules('account_title', 'Account Title', 'trim|required');
                            $this->form_validation->set_rules('bank_branch', 'Bank State Branch Code', 'trim|required');
                            $this->form_validation->set_rules('account_no', 'Account Number', 'trim|required');

                        } else if ($this->input->post('country') == 'Canada') {
                            $this->form_validation->set_rules('institution_number', 'Institution Number', 'trim|required');
                            $this->form_validation->set_rules('account_title', 'Account Title', 'trim|required');
                            $this->form_validation->set_rules('transit_number', 'Transit Number', 'trim|required');
                            $this->form_validation->set_rules('account_no', 'Account Number', 'trim|required');


                        } else if (
                            $this->input->post('country') == 'Germany' ||
                            $this->input->post('country') == 'Austria' ||
                            $this->input->post('country') == 'Belgium' ||
                            $this->input->post('country') == 'Bulgaria' ||
                            $this->input->post('country') == 'Croatia' ||
                            $this->input->post('country') == 'Cyprus' ||
                            $this->input->post('country') == 'CzechRepublic' ||
                            $this->input->post('country') == 'Denmark' ||
                            $this->input->post('country') == 'Estonia' ||
                            $this->input->post('country') == 'Finland' ||
                            $this->input->post('country') == 'France' ||
                            $this->input->post('country') == 'Greece' ||
                            $this->input->post('country') == 'Hungry' ||
                            $this->input->post('country') == 'Ireland' ||
                            $this->input->post('country') == 'Italy' ||
                            $this->input->post('country') == 'Poland' ||
                            $this->input->post('country') == 'Romania' ||
                            $this->input->post('country') == 'Portugal' ||
                            $this->input->post('country') == 'Greece' ||

                            $this->input->post('country') == 'Spain'

                        ) {
                            $this->form_validation->set_rules('iban', 'IBAN', 'trim|required');
                            $this->form_validation->set_rules('account_title', 'Account Title', 'trim|required');
                            $this->form_validation->set_rules('bic', 'BIC', 'trim|required');


                        } else if ($this->input->post('country') == 'HongKong') {
                            $this->form_validation->set_rules('account_no', 'Account Number', 'trim|required');
                            $this->form_validation->set_rules('account_title', 'Account Title', 'trim|required');
                            $this->form_validation->set_rules('clearing_code', 'Clearing Code', 'trim|required');
                            $this->form_validation->set_rules('bank_branch', 'Branch Code', 'trim|required');

                        } else if ($this->input->post('country') == 'Singapore') {
                            $this->form_validation->set_rules('account_no', 'Account Number', 'trim|required');
                            $this->form_validation->set_rules('account_title', 'Account Title', 'trim|required');
                            $this->form_validation->set_rules('bank_name', 'Bank Code', 'trim|required');
                            $this->form_validation->set_rules('bank_branch', 'Branch Code', 'trim|required');

                        } else if ($this->input->post('country') == 'UnitedKingdom') {
                            $this->form_validation->set_rules('account_no', 'Account Number', 'trim|required');
                            $this->form_validation->set_rules('re_account_no', 'Re-Account Numer', 'required|matches[account_no]');

                            $this->form_validation->set_rules('account_title', 'Account Title', 'trim|required');

                            $this->form_validation->set_rules('bank_sort_code1', 'Bank Sort Code First Box', 'trim|required');
                            $this->form_validation->set_rules('bank_sort_code2', 'Bank Sort Code Second Box', 'trim|required');
                            $this->form_validation->set_rules('bank_sort_code3', 'Bank Sort Code Third Box', 'trim|required');
                        } else if ($this->input->post('country') == 'UnitedStates') {

                            $this->form_validation->set_rules('account_no', 'Account Number', 'trim|required');
                            $this->form_validation->set_rules('re_account_no', 'Re-Account Numer', 'required|matches[account_no]|min_length[9]|max_length[9]');

                            $this->form_validation->set_rules('account_title', 'Account Title', 'trim|required');
                            $this->form_validation->set_rules('9_digit_routing_number', '9 Digit Account Number', 'trim|required');


                        }


                    }

                    if ($this->form_validation->run() !== FALSE) {
                        //echo 'here not false.';exit;

                        $saved = $this->comman_model->save('payment_method',
                            array(
                                'billing_address' => $this->input->post('billing_address'),
                                'selected_pm' => $payment_method,
                                'user_id' => $user_id
                            )
                        );

                        if ($saved) {
                            $userdetails = getSingleRecord('user', array('user_id'=>$user_id));
                            $name = 'Administrator - bookumbrella.com';
                            $subject = 'New Payment Method Added';
                            $strpaymentmethod=$payment_method;
                            if($payment_method = 'cc')
                                $strpaymentmethod= 'Credit Card';
                                $message = '<html>
                       <body bgcolor="#EDEDEE">
                       
                       <p><div align="center" style="margin-top:15px; margin-bottom:50px;"><img src="' . base_url('assets/frontend/img/logo.png') . '" class="img-responsive" style="width:auto;"  /><div></p>
                       <p><strong> Dear ' . $userdetails['first_name'] . ' ' . $userdetails['last_name'] . '!</strong></p>
                       <p>You have successfully added new payment method of '.$strpaymentmethod.' </p>
                        <p>Regards<p>
                       <p>Team <strong>bookumbrella.com</strong><p>
                       </body>
                       </html>';

                            do_email($userdetails['email'], getAdminEmail(), $subject, $message);






                            if ($payment_method == 'cc') {
                                $this->comman_model->save('pm_card',
                                    array(
                                        'title' => $this->input->post('title'),
                                        'card_no' => $this->input->post('card_no'),
                                        'expiry_month' => $this->input->post('expiry_month'),
                                        'expiry_year' => $this->input->post('expiry_year'),

                                        'pm_id' => $saved,
                                        'user_id' => $user_id
                                    )
                                );
                            } else if ($payment_method == 'amazon') {
                                $this->comman_model->save('pm_amazon',
                                    array(
                                        'username' => $this->input->post('username'),
                                        'password' => md5($this->input->post('password')),
                                        'pm_id' => $saved,
                                        'user_id' => $user_id
                                    )
                                );
                            } else if ($payment_method == 'paypal') {
                                $this->comman_model->save('pm_paypal',
                                    array(
                                        'email' => $this->input->post('email'),
                                        'pm_id' => $saved,
                                        'user_id' => $user_id
                                    )
                                );
                            }
                            else if ($payment_method == 'bank') {
                                //print_r($_POST);
                                //echo 'sdfdasfasdf';exit;
                                $saved = $this->comman_model->save('pm_bank',
                                    array(
                                        'account_no' => $this->input->post('account_no'),
                                        'account_title' => $this->input->post('account_title'),
                                        'account_type' => $this->input->post('account_type'),
                                        'swift_code' => $this->input->post('swift_code'),
                                        'bank_name' => $this->input->post('bank_name'),
                                        'ifsc' => $this->input->post('ifsc'),
                                        'bank_branch' => $this->input->post('bank_branch'),
                                        'bank_state_branch_code' => $this->input->post('bank_state_branch_code'),
                                        'institution_number' => $this->input->post('institution_number'),
                                        'transit_number' => $this->input->post('transit_number'),
                                        'iban' => $this->input->post('iban'),
                                        'bic' => $this->input->post('bic'),
                                        'country' => $this->input->post('country'),
                                        'clearing_code' => $this->input->post('clearing_code'),

                                        'pm_id' => $saved,
                                        'user_id' => $user_id
                                    )
                                );

                                echo 'success';
                                exit;

                            }

                            //redirect($redirect_url);
                        } else {
                            $this->_data['errors'] = 'Unable to save payment method information. Please review your input data !';
                        }

                    } else {

                        if ($payment_method == 'paypal') {
                            $this->_data['errors'] = validation_errors();
                        } else {
                            echo 'here error';
                            exit;
                            $arr[] = str_replace("<p>", "", validation_errors());
                            echo $arr[] = str_replace("</p>", "", $arr);
                            exit;
                            exit;


                        }


                    }
                }


                $paypal_accounts = $this->comman_model->get("pm_paypal", array("user_id" => $user_id));
                $this->_data['paypal_accounts'] = $paypal_accounts;
                $amazon_accounts = $this->comman_model->get("pm_amazon", array("user_id" => $user_id));
                $this->_data['amazon_accounts'] = $amazon_accounts;
                $card_accounts = $this->comman_model->get("pm_card", array("user_id" => $user_id));
                $this->_data['card_accounts'] = $card_accounts;

                $bank_accounts = $this->comman_model->get("pm_bank", array("user_id" => $user_id));
                $this->_data['bank_accounts'] = $bank_accounts;


                $this->_data['main_content'] = "frontend/users/add_payment_method";
                $this->_data['page'] = "add_payment_method";

                $this->__loadView();

            } else {
                redirect();
            }
        }else{
            redirect('login');
        }


    }
function ajax_card()
    {
	//print_r($_POST);exit;	
	
	if($this->input->post('title')!=''){
		
		
		$pm_id = $this->comman_model->save('payment_method',
                        array(
						
                            'selected_pm' => 'cc',
                            'user_id' => getCurrentUserId()
                        )
                    );
					
					
					
	$saved =   $this->comman_model->save('pm_card',
                                array(
                                    'title' => $this->input->post('title'),
									'card_no' => $this->input->post('card_no'),
									'expiry_month' => $this->input->post('expiry_month'),
									'expiry_year' => $this->input->post('expiry_year'),
										
                                    'pm_id' => $pm_id,
                                    'user_id' => getCurrentUserId()
									
                                )
                            );
							
	if($saved){
		
		
		$this->comman_model->update("pm_card",array("user_id"=>getCurrentUserId()),array("is_default"=>"no"));
	
		$updated = $this->comman_model->update("pm_card",array("id"=>$saved),array("is_default"=>"yes"));
	
	
	
		echo 'success';exit;
		}
		else{
		echo 'failed';exit;
			}
	}else{
		
		}
	
							
	}
	
	
	
	
function ajax_addresses()
    {
	//print_r($_POST);exit;	
	
	if($this->input->post('name')!=''){
	$saved =  $this->comman_model->save('addresses',
                                array(
                                    'country' => $this->input->post('country'),
                                    'name' => $this->input->post('name'),
									'street_address' => $this->input->post('street_address'),
									'city' => $this->input->post('city'),
									'state' => $this->input->post('state'),
									'zip' => $this->input->post('zip'),
									'phone_number' => $this->input->post('phone_number'),
									
									'created_on' => date("Y-m-d H:i:s"),
                                    'user_id' => getCurrentUserId()
                                )
                            );
							
	if($saved){
		
		
		$this->comman_model->update("addresses",array("user_id"=>getCurrentUserId()),array("is_default"=>"no"));
	
		$updated = $this->comman_model->update("addresses",array("id"=>$saved),array("is_default"=>"yes"));
	
	
	
		echo 'success';exit;
		}
		else{
		echo 'failed';exit;
			}
	}else{
		
		}
	
							
	}
    function addresses()
    {
					$this->_data['edit_id'] = '';		
			$this->_data['name'] = $this->input->post("name");		
			$this->_data['country'] = $this->input->post("country");		
			$this->_data['street_address'] = $this->input->post("street_address");		
			$this->_data['city'] = $this->input->post("city");		
			$this->_data['state'] = $this->input->post("state");		
			$this->_data['zip'] = $this->input->post("zip");		
			$this->_data['phone_number'] = $this->input->post("phone_number");
		
		if($this->uri->segment(2)=='delete' && $this->uri->segment(4)!=''){
			
				$paypal_accounts = $this->comman_model->delete($this->uri->segment(3),array("id"=>$this->uri->segment(4)));		
				$this->session->set_flashdata('success', "Record has been deleted successfully.");
				redirect(base_url("addresses"));
			
			}
		
        $user_id = getCurrentUserId();
		
		
		
		if($this->uri->segment(2)=='edit' && $this->uri->segment(3)!='')
		{
			
			$edit_address = $this->comman_model->get("addresses",array("id"=>$this->uri->segment(3)));


			$this->_data['edit_id'] = $edit_address[0]['id'];		
			$this->_data['name'] = $edit_address[0]['name'];		
			$this->_data['country'] = $edit_address[0]['country'];		
			$this->_data['street_address'] = $edit_address[0]['street_address'];		
			$this->_data['city'] = $edit_address[0]['city'];		
			$this->_data['state'] = $edit_address[0]['state'];		
			$this->_data['zip'] = $edit_address[0]['zip'];		
			$this->_data['phone_number'] = $edit_address[0]['phone_number'];
		
		}
		 
		
       

       
		
        $user_data = $this->comman_model->get('user',array('user_id' => $user_id));
		
        if($user_data){

            if ($this->input->server('REQUEST_METHOD') === 'POST'){
				
$this->form_validation->set_rules('country', 'Country ', 'trim|required');
				

                if ($this->form_validation->run() !== FALSE) {
				
				if($this->input->post("edit_id")!=''){
				
                            $this->comman_model->update('addresses',array("id"=>$this->input->post('edit_id')),
                                array(
                                    'country' => $this->input->post('country'),
                                    'name' => $this->input->post('name'),
									'street_address' => $this->input->post('street_address'),
									'city' => $this->input->post('city'),
									'state' => $this->input->post('state'),
									'zip' => $this->input->post('zip'),
									'phone_number' => $this->input->post('phone_number'),
									
									'created_on' => date("Y-m-d H:i:s"),
                                    'user_id' => $user_id
                                )
                            );
				}else{
					
				            $this->comman_model->save('addresses',
                                array(
                                    'country' => $this->input->post('country'),
                                    'name' => $this->input->post('name'),
									'street_address' => $this->input->post('street_address'),
									'city' => $this->input->post('city'),
									'state' => $this->input->post('state'),
									'zip' => $this->input->post('zip'),
									'phone_number' => $this->input->post('phone_number'),
									
									'created_on' => date("Y-m-d H:i:s"),
                                    'user_id' => $user_id
                                )
                            );
				
				
					
					}
							
                        
						
						
						

                } else {
					
					$this->_data['errors'] = validation_errors();
				
				}
            }


		$records = $this->comman_model->get("addresses",array("user_id"=>$user_id));
		$this->_data['records'] = $records;

		


		
		$this->_data['main_content'] = "frontend/users/addresses";
        $this->_data['page'] = "addresses";




            $this->__loadView();

        } else {
            redirect();
        }
		
		
		
		
		}	


    function EmailNotifications()
    {
		
		
		
        $user_id = getCurrentUserId();
		
		 
		 
		 
		 
            if ($this->input->server('REQUEST_METHOD') === 'POST'){
			if($this->input->post('add')=='yes'){
			
				 $this->form_validation->set_rules('account_notification', 'Account Notification Email', 'trim|required');
           		 $this->form_validation->set_rules('inventory_load_confirmation', 'Inventory load confirmationStore id', 'trim|required');
				 $this->form_validation->set_rules('order_notification', 'Order Notification Email', 'trim|required');
           		 $this->form_validation->set_rules('seller_questions', 'Seller Questions Email', 'trim|required');
				 $this->form_validation->set_rules('billing_notifications', 'Billing Notifications', 'trim|required');
           
			
							            
										if ($this->form_validation->run() !== FALSE) {
										
											
											
                	$email_notificationsData = array();

                    // If Display image is selected
                         $email_notificationsData = array_merge($email_notificationsData, array(
                            'account_notification' => $this->input->post('account_notification'),
                            'inventory_load_confirmation' => $this->input->post('inventory_load_confirmation'),
                          
                            'order_notification' => $this->input->post('order_notification'),
							'seller_questions' => $this->input->post('seller_questions'),
                            'billing_notifications' => $this->input->post('billing_notifications'),
                            'user_id' => getCurrentUserId()
                                 )
                                 );
                     // If Display image uploaded successfully
                         $is_saved = $this->comman_model->save('email_notifications',$email_notificationsData);
                      if($is_saved){
                            $this->session->set_flashdata('success','Email notifications creaed successfully.');
                            redirect('email_notifications');
                        } else {
                            $this->session->set_flashdata('errors','Sorry ! Error occur try again');
                             redirect('email_notifications');
                        }       
                        
                    
                
										
										} else {
             							   $this->_data['errors'] = validation_errors();
            }
			
			
				
				
			}
			else if($this->input->post('update')=='yes'){
				
			
			
			
				 $this->form_validation->set_rules('account_notification', 'Account Notification Email', 'trim|required');
           		 $this->form_validation->set_rules('inventory_load_confirmation', 'Inventory load confirmationStore id', 'trim|required');
				 $this->form_validation->set_rules('order_notification', 'Order Notification Email', 'trim|required');
           		 $this->form_validation->set_rules('seller_questions', 'Seller Questions Email', 'trim|required');
				 $this->form_validation->set_rules('billing_notifications', 'Billing Notifications', 'trim|required');
           
			
			
			
				 
				if ($this->form_validation->run() !== FALSE) {
                //image upload function
                
                $email_notificationsData = array();



$email_notificationsData = array_merge($email_notificationsData, array(
                            'account_notification' => $this->input->post('account_notification'),
                            'inventory_load_confirmation' => $this->input->post('inventory_load_confirmation'),
                          
                            'order_notification' => $this->input->post('order_notification'),
							'seller_questions' => $this->input->post('seller_questions'),
                            'billing_notifications' => $this->input->post('billing_notifications')    )
                                 );
								 
								 
                
                $where = array('id' => $this->input->post('id'));
                    
               //echo $store_id;exit;
                $saved = $this->comman_model->update('email_notifications',$where,$email_notificationsData);

                if ($saved) {
                    $this->session->set_flashdata('success','Email notifications Updated successfully.');
                    redirect('email_notifications');
                } else {
                    $this->_data['errors'] = 'Unable to save Email notifications. Review information and try again !';
                                    redirect('email_notifications');
                }
             
            }else {
                $this->_data['errors'] = validation_errors();
            }
				
				}
				}		 
		 
		 
		 
		$email_notifications = $this->comman_model->get("email_notifications",array("user_id"=>$user_id));
		
		//echo '<pre>';print_r($store);exit;
		
		$this->_data['email_notifications'] = $email_notifications;



		$this->_data['main_content'] = "frontend/users/emailnotifications";
        $this->_data['page'] = "email_notifications";
        $this->__loadView();
      


    }

function viewSalesRefunds(){
	

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
			$or_where = false;
			//$or_where['user_id'] = getCurrentUserId();
           $where['seller_id'] = getCurrentUserId();
			
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
			
			$my_orders =  $this->product_model->search_products('purchase', 500, 0,$or_where, false, $order,false);
$this->_data['total_my_orders'] = 0;
			if($my_orders){
			$this->_data['total_my_orders'] = count($my_orders);
			}
            unset($where['user_id']);
            $where['seller_id'] = getCurrentUserId();
         
		    $received_orders =  $this->product_model->search_products('purchase', 500, 0,false, $where, $order,false);
			//echo '<pre>';print_r($my_orders);exit;
			
			
			$this->_data['my_orders'] = $my_orders;
			$this->_data['received_orders'] = $received_orders;
			
	//		echo '<pre>';print_r($my_orders);exit;	
            $this->_data['layouts'] = $layouts_data;
            $this->_data['main_content'] = 'frontend/products/orders/view-sales-refunds';
            $this->__loadView();

        } else {
            redirect('login');
        }
    
	
	
	
	}
function export_feedbacks(){
    

        if ($this->session->userdata('logged_in') == TRUE) {
            

           
            



          $my_ratings = $this->comman_model->get('rating', array('seller_id' => getCurrentUserId()));

          

            $filename = "my_feedbacks_ratings.csv";
            $fp = fopen('php://output', 'w');
            $header = array('Serial', 'isbn', 'Title','User','Rating','Comments','Date');
            header('Content-type: application/csv');
            header('Content-Disposition: attachment; filename='.$filename);
            fputcsv($fp, $header);
            
            //echo '<pre>'; print_r($allSellerProducts); echo '</pre>';
            if($my_ratings){
				$i=0;
                foreach ($my_ratings as $row) {
					$i++;
                    $product = $this->comman_model->get("products",array("product_id"=>$row['product_id']));
					$user = $this->comman_model->get("user",array("user_id"=>$row['user_id']));
																
																
					$data = array(
                        $i,
                        $product[0]['isbn'],
                        $product[0]['title'],
                        $user[0]['first_name']." ".$user[0]['last_name'],
                        $row['no_stars'],
                        $row['comments'],
                        $row['date_created']
                      

                        );
                    fputcsv($fp, $data);
                }
            }
            exit;


        } else {
            redirect('login');
        }
    
    
    
    
    }
	
	
    function exportSalesRefunds(){

        $or_where =array();

        if ($this->session->userdata('logged_in') == TRUE) {

            $where = array('seller_id' => getCurrentUserId());
//echo '<pre>';print_r($_GET);exit;
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

            unset($where['user_id']);
            $where['seller_id'] = getCurrentUserId();
            $received_orders =  $this->product_model->search_products('purchase', 500, 0,false, $where, $order,false);
            //echo '<pre>';print_r($my_orders);exit;
            
            
            $this->_data['my_orders'] = $my_orders;
            $this->_data['received_orders'] = $received_orders;

            $filename = "my_orders.csv";
            $fp = fopen('php://output', 'w');
            $header = array('Order Id','Tracking Id','Order Date','Product', 'Author', 'isbn', 'Sku','Formate','Quantity','Condition','Type','Order status','Payment Status','Price','Shipping Value','Shipping Type','Order Tatal','Address Title','Street Address','State','Zip','City','Phone','Country','Payment Method',"Refund Amount to Buyer","Refund Type","Refund Reason","Refund Date");
            header('Content-type: application/csv');
            header('Content-Disposition: attachment; filename='.$filename);
            fputcsv($fp, $header);
            
           
            if($my_orders){
                foreach ($my_orders as $row) {
                    $user = $this->comman_model->get('user',array('user_id'=>$row['user_id']));
                    $seller = $this->comman_model->get('user',array('user_id'=>$row['seller_id']));
                    $product = $this->comman_model->get('products',array('product_id'=>$row['product_id']));
                    $data = array(
                        $row['unique_order_id'],
						$row['tracking_id'],
						$row['created_on'],
                        $product[0]['title'],
						$product[0]['author'],
                        $product[0]['isbn'],
                        $product[0]['sku'],
                        $product[0]['format'],
                        //$product[0]['advertiser_name'],
                        $row['qty'],
                        $product[0]['book_condition'],
                        $product[0]['book_type'],
                        $row['order_status'],
                        $row['payment_status'],
                        $row['price'],
                        $row['shipping_value'],
                        $row['shipping_type'],
                        $row['price']+ $row['shipping_value'],
						
						
						$row['address_name'],
						$row['address_street_address'],
						$row['address_state'],
						$row['address_zip'],
						$row['address_city'],
						$row['address_phone_number'],
						$row['address_country'],
						
						
						$row['payment_method_type'],
						
						$row['refund_amount_to_buyer'],
						$row['refund_type'],
						$row['refund_reason'],
						$row['date_refunded'],
						//$row['message_to_buyer']
						

                        );
                    fputcsv($fp, $data);
                }
            }
            exit;


        } else {
            redirect('login');
        }
    
    
    
    
    }

    function exportMyOrders(){

        $or_where =array();

        if ($this->session->userdata('logged_in') == TRUE) {

            $where = array('user_id' => getCurrentUserId());
//echo '<pre>';print_r($_GET);exit;
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

            unset($where['user_id']);
            $where['seller_id'] = getCurrentUserId();
            $received_orders =  $this->product_model->search_products('purchase', 500, 0,false, $where, $order,false);
            //echo '<pre>';print_r($my_orders);exit;
            
            
            $this->_data['my_orders'] = $my_orders;
            $this->_data['received_orders'] = $received_orders;

            $filename = "my_orders.csv";
            $fp = fopen('php://output', 'w');
            $header = array('Order Id','Tracking Id','Order Date','Product', 'Author', 'isbn10', 'isbn13','Formate','Quantity','Condition','Type','Order status','Payment Status','Price','Shipping Value','Shipping Type','Order Tatal','Address Title','Street Address','State','Zip','City','Phone','Country','Payment Method',"Refund Amount to Buyer","Refund Type","Refund Reason","Refund Date");
            header('Content-type: application/csv');
            header('Content-Disposition: attachment; filename='.$filename);
            fputcsv($fp, $header);
            
           
            if($my_orders){
                foreach ($my_orders as $row) {
                    $user = $this->comman_model->get('user',array('user_id'=>$row['user_id']));
                    $seller = $this->comman_model->get('user',array('user_id'=>$row['seller_id']));
                    $product = $this->comman_model->get('products',array('product_id'=>$row['product_id']));
                    $data = array(
                        $row['unique_order_id'],
                        $row['tracking_id'],
                        $row['created_on'],
                        $product[0]['title'],
                        $product[0]['author'],
                        $product[0]['isbn'],
                        $product[0]['isbn13'],
                        //$product[0]['sku'],
                        $product[0]['format'],
                        //$product[0]['advertiser_name'],
                        $row['qty'],
                        $product[0]['book_condition'],
                        $product[0]['book_type'],
                        $row['order_status'],
                        $row['payment_status'],
                        $row['price'],
                        $row['shipping_value'],
                        $row['shipping_type'],
                        $row['price']+ $row['shipping_value'],
                        
                        
                        $row['address_name'],
                        $row['address_street_address'],
                        $row['address_state'],
                        $row['address_zip'],
                        $row['address_city'],
                        $row['address_phone_number'],
                        $row['address_country'],
                        
                        
                        $row['payment_method_type'],
                        
                        $row['refund_amount_to_buyer'],
                        $row['refund_type'],
                        $row['refund_reason'],
                        $row['date_refunded'],
                        //$row['message_to_buyer']
                        

                        );
                    fputcsv($fp, $data);
                }
            }
            exit;


        } else {
            redirect('login');
        }
    
    
    
    
    }

    function addStore()
    {
		
		
		
        $user_id = getCurrentUserId();
		
		 
		 
		 
		 
            if ($this->input->server('REQUEST_METHOD') === 'POST'){
			if($this->input->post('add')=='yes'){
			
				 $this->form_validation->set_rules('name', 'Store Name', 'trim|required');


			
							            
										if ($this->form_validation->run() !== FALSE) {
										
											
											
                /*
                 * start image code
                 */
				 //echo '<pre>';print_r($_POST);exit;
                $storeData = array();
                $hasImage = 0;
                $isImageUploaded = 0;
                $storeNameAlreadyExists = $this->comman_model->get_total('store', array('name' => trim($this->input->post('name'))));
                $storeNameAlreadyExists = $storeNameAlreadyExists > 0 ? 1 : 0;
                if (!$storeNameAlreadyExists) {
					
                    if (isset($_FILES['image']['name']) && trim($_FILES['image']['name']) != "") {

                        $hasImage = 1;
                        $store_img = upload_image('image', 'uploads/img_gallery/store_images');

                        if (isset($store_img['error'])) {
                            $this->_data['errors'] = $store_img['error'];
                        } else {
                            $imageSizes = imageSizes();
                            $thumb_data = resize_image($store_img, $imageSizes['thumbnail']);
                            $isImageUploaded = 1;
                        }

                        $storeData = array(
                            'image_url' => $store_img['file_name'],
                            'image_upload'=>1
                                
                        );
                    }

                    // If Display image is selected
                    if ($hasImage) {
                         $storeData = array_merge($storeData, array(
                            'name' => $this->input->post('name'),
                            'network_store_id' => $this->input->post('network_store_id'),
                          
                            'store_link_url' => $this->input->post('store_link_url'),
                            'status'=>1,
                            'user_id' => getCurrentUserId(),
                            'date_created' => date("Y-m-d H:i:s")
                                 )
                                 );
                     // If Display image uploaded successfully
                      if ($isImageUploaded) {
                         $is_saved = $this->comman_model->save('store',$storeData);
                      
					  	$this->comman_model->update('user',array('user_id'=>getCurrentUserId()),array('user_type'=>'Seller'));
							
						$selling_options = array(
						'seller_id'=>getCurrentUserId(),
						'standard'=>'active',
						'date_created'=>date("Y-m-d H:i:s"),
						
						);
		
				
				//$selling_options
				
				$updated = $this->comman_model->save('seller_shippings', $selling_options);
				
					
							
							
							$this->session->set_userdata('user_type', 'Seller');
                            
							
							
					  if($is_saved){
						 $this->session->set_flashdata('success','Store creaed successfully.');
						 
						 	$subject = 'Successfully became seller';
                    $message = '<html>
                       <body bgcolor="#EDEDEE">
                       <p><div align="center" style="color:#303E49"><h1>YOU HAVE SUCCESSFULLY BECOME A SELLER</h1></div></p>
                       <p><div align="center" style="margin-top:15px; margin-bottom:50px;"><img src="' . base_url('assets/frontend/images/logo.png') . '" class="img-responsive" style="width:auto;"  /><div></p>
                       <p><strong> Dear ' . $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name') . '!</strong></p>
                       <p>Thank you for registering your store('.$this->input->post('name').')  at bookumbrella.com.</p>
                       
                       
                       <p>Regards<p>
                       <p>Team <strong>bookumbrella.com</strong><p>
                       </body>
                       </html>';
                    $email = trim($this->session->userdata('email'));
                    do_email($email, getAdminEmail(), $subject, $message);
					
					
					
					
					
						 
                            redirect('my_account');
                        } else {
                            $this->session->set_flashdata('errors','Sorry ! Error occur try again');
                             redirect('add_store');
                        }       
                        
                    }
                   } else {
                        $this->_data['errors'] = 'Display Image not found !';
                    }
                }  else {
                    $this->_data['errors'] = 'Store with same name already exists !';
                }
            
										
										} else {
             							   $this->_data['errors'] = validation_errors();
            }
			
			
				
				
			}
			else if($this->input->post('update')=='yes'){
				
				 $this->form_validation->set_rules('name', 'Store Name', 'trim|required');


				if ($this->form_validation->run() !== FALSE) {
                //image upload function
                
                $storeData = array();
                $isImageSelected = isset($_FILES['image']['name']) ? (trim($_FILES['image']['name']) != "" ? 1 : 0) : 0;
                $isImageUploaded = 0;

                if (isset($_FILES['image']['name']) && trim($_FILES['image']['name']) != "") {

                    $hasImage = 1;
                    $store_img = upload_image('image', 'uploads/img_gallery/store_images');

                    if (isset($store_img['error'])) {
                        $this->_data['errors'] = $store_img['error'];
                    } else {
                        $imageSizes = imageSizes();
                        $thumb_data = resize_image($store_img, $imageSizes['thumbnail']);
                        $isImageUploaded = 1;
                    }

                    $storeData = array(
                        'image_url' => $store_img['file_name']
                    );
                }
				//echo 'ddfdfd';exit;
                //end image upload function
                $storeData = array_merge($storeData, array(
                             'name' => $this->input->post('name'),
                            'network_store_id' => $this->input->post('network_store_id'),
                          
                            'store_link_url' => $this->input->post('store_link_url'),
							'status'=>1,
							
                          'date_updated' => date("Y-m-d H:i:s")
                                 )
                                 );
                
                $where = array('store_id' => $this->input->post('store_id'));
                    
               //echo $store_id;exit;
                $saved = $this->comman_model->update('store',$where,$storeData);
				


                if ($saved) {
					
					//$this->comman_model->update('user',array('user_id'=>getCurrentUserId()),array('user_type'=>'Seller'));
							
						//	$this->session->set_userdata('user_type', 'Seller');
                            
							
					
					$this->session->set_flashdata('success','Store Updated successfully.');
                    redirect('my_account');
                } else {
                    $this->_data['errors'] = 'Unable to save Store. Review information and try again !';
                                    redirect('add_store');
                }
             
            }else {
                $this->_data['errors'] = validation_errors();
            }
				
				}
				}		 
		 
		 
		 
		$store = $this->comman_model->get("store",array("user_id"=>$user_id));
		
		//echo '<pre>';print_r($store);exit;
		
		$this->_data['mystore'] = $store;



            $this->_data['main_content'] = "frontend/users/add_store";
        $this->_data['page'] = "add_store";
 $this->__loadView();
      


    }
	
function setDefault(){
	
	$this->comman_model->update("addresses",array("user_id"=>getCurrentUserId()),array("is_default"=>"no"));
	
	$updated = $this->comman_model->update("addresses",array("id"=>$this->input->post("id")),array("is_default"=>"yes"));
	if($updated){
		echo 'success';exit;
		}else{
		echo 'error';exit;	
			}
	}	
  function ViewRatingsFeedbacks(){
	  
	  

        if ($this->session->userdata('logged_in') == TRUE) {
		$current_user_id = getCurrentUserId();

} else {
            $current_user_id = getCurrentUserId();
        }
    
            $layouts_data = $this->comman_model->get('layouts');

            $where = array('seller_id' => $current_user_id);
            if($this->input->get('months') !=''){
                $months = $this->input->get('months');
                
                $start_date = date('Y-m-d');
                $end_date = date("Y-m-d",strtotime("-$months Months"));
                $where['date_created <='] = $start_date;
                $where['date_created >='] = $end_date;
                //echo $start_date.'======'.$end_date; die;
            }

			$my_ratings = $this->comman_model->get('rating', $where);
			$this->_data['my_ratings'] = $my_ratings;
           

            $this->_data['layouts'] = $layouts_data;
            $this->_data['main_content'] = 'frontend/users/ratings-feedback';
            $this->__loadView();

        
	
	
	  
	  }
  function messages(){
	  
	  

        if ($this->session->userdata('logged_in') == TRUE) {
		


 			 $current_user_id = getCurrentUserId();  
            $layouts_data = $this->comman_model->get('layouts');

           
			$my_messages = $this->comman_model->MainMessages('messages',array("parent_id"=>0,"user_id_to"=>$current_user_id,'user_id_from' => $current_user_id));
			$this->_data['my_messages'] = $my_messages;
           

            $this->_data['layouts'] = $layouts_data;
            $this->_data['main_content'] = 'frontend/users/my-messages';
            $this->__loadView();

        
	
	} else{
		redirect('login');
		}
	  
	  }
function seller_messages(){
	  
	  

        if ($this->session->userdata('logged_in') == TRUE) {
		


 			 $current_user_id = getCurrentUserId();  
            $layouts_data = $this->comman_model->get('layouts');

           
			$my_messages = $this->comman_model->get2('messages',array("parent_id"=>0,"inbox"=>'Seller'), array('user_id_from' => $current_user_id,'user_id_to' => $current_user_id));
			$this->_data['my_messages'] = $my_messages;
           

            $this->_data['layouts'] = $layouts_data;
            $this->_data['main_content'] = 'frontend/users/my-messages';
            $this->__loadView();

        
	
	} else{
		redirect('login');
		}
	  
	  }
	  	  
	  
  function message_reply(){
	  
	  

        if ($this->session->userdata('logged_in') == TRUE) {
		

			$id = decode_uri($this->uri->segment(4));
 			 $current_user_id = getCurrentUserId();  
            $layouts_data = $this->comman_model->get('layouts');

           
		    $parent_message_details = $this->comman_model->get('messages',array("id"=>$id));
			$this->_data['parent_message_details'] = $parent_message_details[0];
			
			$my_replies = $this->comman_model->get2('messages',array("parent_id"=>$id));
			$this->_data['my_replies'] = $my_replies;
           

            $this->_data['layouts'] = $layouts_data;
            $this->_data['main_content'] = 'frontend/users/message-reply';
            $this->__loadView();

        
	
	} else{
		redirect('login');
		}
	  
	  }	  	  
	  
  function printOrder(){
        if ($this->session->userdata('logged_in') == TRUE) {
            $order_id = $this->uri->segment(2);
            $where = array('order_id'=>$order_id);
            $order = array("cart_row_id"=>'ASC');
            $orders =  $this->product_model->search_products('purchase', 500, 0,false, $where, $order,false);
            if($orders){
                $data['orders'] = $orders;
                $output_html = $this->load->view('frontend/products/orders/print_order',$data,true);
                echo "<html><head></head><body>" . $output_html . "<script type='application/javascript'>window.onload=function(){window.print()}</script></body></html>";
            }else{

                $output_html = '<p>Invalid Order ID.</p>';
                echo "<html><head></head><body>" . $output_html . "<script type='application/javascript'>window.onload=function(){window.print()}</script></body></html>";
            }
            
        }else {
            redirect('login');
        }
    }
function sendMessage(){
			if ($this->session->userdata('logged_in') == TRUE) {
				
if($this->input->post("order_id")!='' && $this->input->post("order_id")>0){
				$order_id = $this->input->post("order_id");
				$order_details = $this->comman_model->get("purchase",array("id"=>$order_id));
				$unique_order_id = $order_details[0]["unique_order_id"];
}else{
	
	$unique_order_id = $this->input->post("unique_order_id");
	}

				
				if($this->input->post("message_by")=='Buyer'){
				$user_id_to = $this->input->post("seller_id");
				$user_id_from = getCurrentUserId();
				$inbox = 'Seller';
				}
				else{
				$user_id_to = $this->input->post("buyer_id");
				$user_id_from = getCurrentUserId();
				$inbox = 'Buyer';	
					}
				
				$title = $this->input->post("title");
				$category = $this->input->post("category");
				$message = $this->input->post("message");
				$data = array(
				'order_id'=>$order_id,
				'inbox'=>$inbox,
				'unique_order_id'=>$unique_order_id,
				'user_id_to'=>$user_id_to,
				'user_id_from'=>$user_id_from,
				'title'=>$title,
				'category'=>$category,
			
				'message'=>$message,
				
				'created_on'=>date("Y-m-d H:i:s")
				
				);
				//print_r($data);exit;
				$saved = $this->comman_model->save("messages",$data);
				if($saved){
					
					$user_to = $this->comman_model->get("user",array("user_id"=>$user_id_to));

                    if($this->input->post("message_by")=='Buyer'){
                       // $order_detail = getSingleRecord('purchase', array('id'=>$order_id));

                        $sellerusername  = $user_to[0]['username'];
                        $subject = 'Bookumbrella Customer Inquiry: order # '.$unique_order_id.'';
                        $created_on =  $order_details[0]['created_on'];

                        $savedPrice = $order_details[0]['price']-$order_details[0]['discount_amount'];
                        $earnings = ($savedPrice+$order_details[0]['shipping_value'])-$order_details[0]['final_value_on_product'];

                        $message = '<table width="100%" border="0" align="center" cellpadding="2" cellspacing="2" style="font-size:14px; font-family:Arial, Helvetica, sans-serif">
  <tr>
    <td align="left" style="font-size:24px; font-weight:bold; color:#000;">Bookumbrella Customer Inquiry: order # ' .$unique_order_id. '
</td>
  </tr>
  <tr>
    <td align="left">&nbsp;</td>
  </tr>
  <tr>
    <td align="left">Bookumbrella has received the inquiry for the Order Id/;' .$unique_order_id. '.Please respond the following query within 2 business days.
	
</td>
  </tr>
  <tr>
    <td align="left">&nbsp;</td>
  </tr>
  
  <tr>
    <td align="left">Dear '.$sellerusername.' ,	
</td>
  </tr>
  
  <tr>
    <td align="left">&nbsp;</td>
  </tr>
  <tr>
    <td align="left"><table border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td>Item Information:	</td>
      </tr>
      <tr>
        <td><strong>Order ID:</strong> ' .$unique_order_id. '	</td>
      </tr>
      <tr>
        <td><strong>Order date:</strong> '.$created_on.' 	
</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td align="left">&nbsp;</td>
  </tr>
  <tr>
    <td align="left"><table width="100%" border="0" cellspacing="2" cellpadding="2">
      <tr>
        <td align="left"><strong>Item:</strong> '.$order_details[0]['book_title'].' </td>
      </tr>
      <tr>
        <td align="left"><strong>Condition:</strong> '.$order_details[0]['book_condition'].' </td>
      </tr>
      <tr>
        <td align="left"><strong>SKU:</strong> '.$order_details[0]['sku'].'   </td>
      </tr>
      <tr>
        <td align="left">Quantity: '.$order_details[0]['qty'].'	
</td>
      </tr>
      <tr>
        <td align="left"><strong>Price: </strong>$'.$order_details[0]['price'].' </td>
      </tr>
      <tr>
        <td align="left"><strong>Shipping: </strong>$'.$order_details[0]['shipping_value'].'  </td>
      </tr>
      <tr>
        <td align="left"><strong>Bookumbrella fees:</strong> -$'.$order_details[0]['final_value_on_product'].'  </td>
      </tr>
      <tr>
        <td align="left"><strong>Your earnings: $'.$earnings.'</strong>	
</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td align="left">&nbsp;</td>
  </tr>
  <tr>
    <td align="left"><table width="100%" border="0" cellspacing="2" cellpadding="2">
      <tr>
        <td align="left">Buyer Shipping address:-	
</td>
      </tr>
      <tr>
        <td align="left"> '.$order_details[0]['address_street_address'].' 	
</td>
      </tr>
      <tr>
        <td align="left"> '.$order_details[0]['address_city'] . ' ' . $order_details[0]['address_state'] . ' ' . $order_details[0]['address_zip']    .'  	
</td>
      </tr>
      <tr>
        <td align="left">'.$order_details[0]['address_country'].'	
</td>
      </tr>
      <tr>
        <td align="left"><strong>Phone:</strong> '.$order_details[0]['address_phone_number'].'  </td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td align="left">&nbsp;</td>
  </tr>
  <tr>
    <td align="left"><strong>Thank you,	
    </strong></td>
  </tr>
  <tr>
    <td align="left">Your AbeBooks Team	
</td>
  </tr>
</table>';


                    }else{
                        $subject = 'New Message Received';
                        $message = '<html>
                       <body bgcolor="#EDEDEE">
                       <p><div align="center" style="color:#303E49"><h1>Following new message has been received.</h1></div></p>
                       <p><div align="center" style="margin-top:15px; margin-bottom:50px;"><img src="' . base_url('assets/frontend/images/logo.png') . '" class="img-responsive" style="width:auto;"  /><div></p>
                       <p><strong> Dear ' . $user_to[0]['first_name'] . ' ' . $user_to[0]['last_name'] . '!</strong></p>
                       <p>'.$this->session->userdata('first_name')." ".$this->session->userdata('last_name').' has sent you following message for <strong>order id '.$unique_order_id.'</strong></p>
                       <p><strong>Title:</strong>'.$title.'</p>
					   <p><strong>Topic/Category:</strong>'.$category.'</p>
					    <p><strong>Message:</strong>'.$message.'</p></p></p>
                       <p>Regards<p>
                       <p>Team <strong>bookumbrella.com</strong><p>
                       </body>
                       </html>';
                    }


                    $email_notifications = $this->comman_model->get("email_notifications",array("user_id"=>$user_to[0]['user_id']));
                    $email = trim($user_to[0]['email']);
                    //$email = 'stepinnsolution@gmail.com';
                    if($email_notifications!=0){
                        $email = $email_notifications[0]['seller_questions'];
                    }
                    $email = 'stepinnsolution@gmail.com';


                    do_email($email, getAdminEmail(), $subject, $message);
					
					
					
					
					
					echo 'success';
					}
				}else{
				
				
				}
						
	}
public function SendReply(){
	        if ($this->session->userdata('logged_in') == TRUE){
	   $data = array(
	   "user_id_to"=>$this->input->post("user_id_to"),
	   "user_id_from"=>getCurrentUserId(),
	   "parent_id"=>$this->input->post("id"),
	   "message"=>$this->input->post("message"),
	   "created_on"=>date("Y-m-d H:i:s")
	   
	   );
	   $saved = $this->comman_model->save("messages",$data);
		if($saved)
			{
                $subject = 'A Message Reply Received';
                $message = '<html>
                       <body bgcolor="#EDEDEE">
                       <p><div align="center" style="color:#303E49"><h1>Following new message reply has been received.</h1></div></p>
                       
                       
					    <p><strong>Message:</strong>'.$this->input->post("message").'</p></p></p>
                       <p>Regards<p>
                       <p>Team <strong>bookumbrella.com</strong><p>
                       </body>
                       </html>';



                $user_to = $this->comman_model->get("user",array('user_id'=>$this->input->post("user_id_to")));
                $email = $user_to[0]['email'];
                if($this->session->userdata('user_type')=='Buyer') {
                    $email_notifications = $this->comman_model->get("email_notifications", array("user_id" => $this->input->post("user_id_to")));



                    if ($email_notifications != 0) {
                        $email = $email_notifications[0]['seller_questions'];
                    }

                }
                do_email($email, getAdminEmail(), $subject, $message);
				echo 'success';exit;
				}else{
					echo 'error';exit;
					}
				
				}else{
				redirect("login");
				}
	}
}
	

