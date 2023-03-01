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
	
	
	
    function registration()
    {
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
            //$this->form_validation->set_rules('first_name','First Name','trim|required');
            //$this->form_validation->set_rules('last_name','Last Name','trim|required');
            //$this->form_validation->set_rules('username','User Name','trim|required');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[user.email]|max_length[255]');
            //$this->form_validation->set_rules('gender','Gender','trim|requiredil');
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|max_length[32]');
            $this->form_validation->set_rules('confirm_password', 'Confirm password', 'required|matches[password]|min_length[6]|max_length[32]');
            if ($this->form_validation->run() == true) {
                $activation_hash = $this->generate_hash();

                $user_data = array(
                    'referred_by' => $this->session->userdata('ref_by'),
                    'email' => $this->input->post('email'),
					'username' => $this->input->post('user_name'),
					'user_type' => $this->input->post('user_type'),
                    'password' => md5($this->input->post('password')),
                    'date_created' => date("Y-m-d H:i:s"),
                    'activation_hash' => $activation_hash,
                    'role_id' => 3,
                    'status' => 0
                );
                $is_register = $this->comman_model->save($this->table_name(), $user_data);
                if ($is_register) {
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
                       <p><div align="center" style="color:#303E49"><h1>YOU HAVE SUCCESSFULLY REGISTERED</h1></div></p>
                       <p><div align="center" style="margin-top:15px; margin-bottom:50px;"><img src="' . base_url('assets/frontend/images/logo.png') . '" class="img-responsive" style="width:auto;"  /><div></p>
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
                    $this->session->set_flashdata('success', 'Your account has been successfully created ! Please check your inbox to activate your account.');
                    redirect('registration');
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

    function profile()
    {
        if ($this->session->userdata('logged_in') == TRUE) {
            $this->_data['user_data'] = $this->session->all_userdata();
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
	

function OrderTracking(){
	

        if ($this->session->userdata('logged_in') == TRUE) {

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
            
			
			$my_orders = $this->comman_model->getgrouped_orders('purchase', $where,'id,tracking_id,career,SUM(qty) as qty,created_on,updated_on,seller_id,SUM(price) as price,order_status,payment_status,order_id',array('created_on'=>'DESC'),array('seller_id'=>''));
			$this->_data['my_orders'] = $my_orders;
	//		echo '<pre>';print_r($my_orders);exit;	
            $this->_data['layouts'] = $layouts_data;
            $this->_data['main_content'] = 'frontend/products/orders/order_tracking';
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
        $current_pass = $_POST['current_password'] ? $_POST['current_password']:'';
        $new_password = $_POST['password'] ? $_POST['password']:'';
        $password_confirm = $_POST['password_confirm'] ? $_POST['password_confirm']:'';

        if($user_id){
            $updated_data = array(
                'email' => $email,
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
            }


            if($isUpdated){
                $this->session->set_userdata(array('email'=>$email));
                $response_msg = 'Profile information successfully updated !';
                $status = 1;
            }
        }

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
                    redirect('my_account');;
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

    public function refer_friend()
    {
        if ($this->session->userdata('logged_in') != TRUE)
            redirect();
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|max_length[255]');
            $this->form_validation->set_rules('message', 'message', 'trim|required');
            if ($this->form_validation->run() == TRUE) {
                $hash = $this->generate_hash();
                $name = 'User - bookumbrella.com';
                $subject = 'Welcome to bookumbrella.com - Email refer confrimation';
                $message = '<html>
                       <body bgcolor="#EDEDEE">
                       <p><div align="center" style="color:#303E49"><h1>YOU ARE REFERRED ' . $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name') . '</h1></div></p>
                       <p><div align="center" style="margin-top:15px; margin-bottom:50px;"><img src="' . base_url('assets/frontend/img/logo.png') . '" class="img-responsive" style="width:auto;"  /><div></p>
                       <p><strong> Dear !</strong></p>
                       <p>Welcome to bookumbrella.com.</p>
                       <p>Please keep your username and password safe.</p>
                       <p style="margin-top:20px;">Click the link below to create bookumbrella.com account:<br><p style="margin-top:15px; margin-bottom:15px; font-size:16px;">'
                    . anchor(base_url('registration?ref=' . $hash), "Create Account") . '</p></p>
                       <p>Regards<p>
                       <p>Team <strong>bookumbrella.com</strong><p>
                       </body>
                       </html>';
                $email = trim($this->input->post('email'));
                if (do_email($this->input->post('email'), $this->session->userdata('email'), $subject, $message)) {
                    $data = array(
                        'user_id' => $this->session->userdata('user_id'),
                        'activation_hash' => $hash
                    );
                    $this->comman_model->save('refer_link', $data);
                    $this->session->set_flashdata('success', 'Refer email has been send successfully !.');
                } else {
                    //$this->session->set_flashdata('errors', 'Sorry refer email has not been send !');
                }
                  $this->session->set_flashdata('success', 'Refer email has been send successfully !.');
                redirect('refer_friend');
            } else {
                $this->_data['errors'] = validation_errors();
                $this->_data['main_content'] = 'frontend/pages/refer_friend';
                $this->__loadView();
            }
        } else {
            $this->_data['main_content'] = 'frontend/pages/refer_friend';
            $this->__loadView();
        }
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

    function requestCashout(){

        if ($this->session->userdata('logged_in') == TRUE){

            $saved = $this->user_model->addConfirmedCashbacksToCashouts();

            $where = array('updated_status' => 'Confirmed','user_id' => getCurrentUserId());
            $settingVal = array('updated_status' => 'Requested');
            $this->comman_model->update('cashback',$where,$settingVal);

            if($saved){
                $this->session->set_flashdata('success','Request for Cashout successfully submitted !');
            } else {
                $this->session->set_flashdata('errors','Unable to send Cashout request');
            }

            redirect('my_account');;

        } else {
            redirect();
        }
    }

    function setGuestLayout(){
        $layout_id = $this->uri->segment(2);

        if($layout_id){
            setcookie('innostart_selected_layout',$layout_id,31556952000,"/");
        }

        redirect();
    }

    function addPaymentMethod()
    {
		
		
		if($this->uri->segment(2)=='delete' && $this->uri->segment(4)!=''){
			
				$paypal_accounts = $this->comman_model->delete($this->uri->segment(3),array("id"=>$this->uri->segment(4)));		
				$this->session->set_flashdata('success', "Record has been deleted successfully.");
				redirect(base_url("payment_method"));
			
			}
		
        $user_id = getCurrentUserId();
		
		 
		$paypal_accounts = $this->comman_model->get("pm_paypal",array("user_id"=>$user_id));
		$this->_data['paypal_accounts'] = $paypal_accounts;

		$bank_accounts = $this->comman_model->get("pm_bank",array("user_id"=>$user_id));
		$this->_data['bank_accounts'] = $bank_accounts;



		$this->_data['main_content'] = "frontend/users/add_payment_method";
        $this->_data['page'] = "add_payment_method";

        $redirect_url = base_url('request_cashout');

       
		
        $user_data = $this->comman_model->get('user',array('user_id' => $user_id));
		
        if($user_data){

            if ($this->input->server('REQUEST_METHOD') === 'POST'){

                $payment_method = $this->input->post('pm');
				
                if($payment_method == 'paypal'){

                    $this->form_validation->set_rules('email', 'Paypal Email', 'trim|required');

                } else if($payment_method == 'bank'){

                    $this->form_validation->set_rules('account_no', 'Account Number', 'trim|required');
                    $this->form_validation->set_rules('account_title', 'Account Title', 'trim|required');
                    $this->form_validation->set_rules('swift_code', 'Swift Code', 'trim|required');
                    $this->form_validation->set_rules('bank_name', 'Bank Name', 'trim|required');
                    $this->form_validation->set_rules('bank_branch', 'Bank Branch Name', 'trim|required');
                }

                if ($this->form_validation->run() !== FALSE) {
				
                    $saved = $this->comman_model->save('payment_method',
                        array(
                            'billing_address' => $this->input->post('billing_address'),
                            'selected_pm' => $payment_method,
                            'user_id' => $user_id
                        )
                    );

                    if ($saved) {
                        if($payment_method == 'paypal'){
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
                                    'swift_code' => $this->input->post('swift_code'),
                                    'bank_name' => $this->input->post('bank_name'),
                                    'bank_branch' => $this->input->post('bank_branch'),
                                    'pm_id' => $saved,
                                    'user_id' => $user_id
                                )
                            );
                        }

                        redirect($redirect_url);
                    } else {
                        $this->_data['errors'] = 'Unable to save payment method information. Please review your input data !';
                    }

                } else {
                    $this->_data['errors'] = validation_errors();
                }
            }

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


}
