<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class AdminUserManagement extends CI_Controller {

    private $_data;

    public function __construct() {
        parent::__construct();
        $this->load->model('product_model');
        check_is_login(17);
    }

    private function __loadView() {

        if ($this->session->flashdata('success') != "")
            $this->_data['success'] = $this->session->flashdata ('success');
        if ($this->session->flashdata('errors') != "")
            $this->_data['errors'] = $this->session->flashdata ('errors');

        $this->load->view('admin/admin_template', $this->_data);
    }

    function index() {

        $start_from = $this->uri->segment(3);
        if (!is_numeric($start_from)){
            $start_from = 0;
        }

        $where = array('user_id !=' => 0,'role_id !=' => 1);
        $total = $this->comman_model->get_total('user',$where);
        $per_page = 10;
        $num_links = 4;
        $uri_segment = 3;

        $this->_data['pagination'] = paginate(base_url() . 'admin/users/', $total, $per_page, $num_links, $uri_segment);
        $this->_data['results'] = $this->comman_model->get_all_limited('user',$per_page, $start_from,$where);
        $this->_data['page'] = "index";
        $this->_data['view_path'] = 'admin/users/index';

        $this->__loadView();
    }

    function add() {
        check_is_login(16);
        $this->_data['user_roles'] = $this->comman_model->get('user_roles',array('role_id !=' => 1));
        $this->_data['view_path'] = "admin/users/add";
        $this->_data['page'] = "add";

        if ($this->input->server('REQUEST_METHOD') === 'POST'){

            $this->form_validation->set_rules('first_name', 'First Name', 'trim|required|max_length[45]');
            $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|max_length[45]');
            $this->form_validation->set_rules('username', 'Username', 'trim|required|max_length[45]');
            $this->form_validation->set_rules('businessname', 'Businessname', 'trim|required|max_length[45]|callback_validate_businessname["false"]');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[user.email]|max_length[255]');
            $this->form_validation->set_rules('gender', 'Gender', 'trim|required');
            $this->form_validation->set_rules('role_id', 'Role', 'trim|required');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|matches[password_confirm]|min_length[6]|max_length[32]');
            $this->form_validation->set_rules('password_confirm', 'Password Confirm', 'trim|required');

            if ($this->form_validation->run() !== FALSE) {
                $saved = $this->comman_model->save('user',
                    array(
                        'first_name' => $this->input->post('first_name'),
                        'last_name' => $this->input->post('last_name'),
                        'username' => $this->input->post('username'),
                        'email' => $this->input->post('email'),
                        'gender' => $this->input->post('gender'),
                        'role_id' => $this->input->post('role_id'),
                        'businessname' => $this->input->post('businessname'),
                        'status' => 1,
                        'password' => md5($this->input->post('password'))
                    ));

                if ($saved) {
                    $this->session->set_flashdata('success','User Created successfully.');
                    redirect('admin/users');
                } else {
                    $this->_data['errors'] = 'Unable to save user. Review information and try again !';
                }
            }else {
                $this->_data['errors'] = validation_errors();
            }
        }

        $this->__loadView();
    }

    function edit() {

        $user_id = decode_uri($this->uri->segment(5));
        $user_data = $this->comman_model->get('user',array('user_id' => $user_id,'role_id !=' => 1));
		
		
		
		
		
        if ($user_data) {
			$paypal_accounts = $this->comman_model->get("pm_paypal",array("user_id"=>$user_id));
		    $this->_data['paypal_accounts'] = $paypal_accounts;
			
			$bank_accounts = $this->comman_model->get("pm_bank",array("user_id"=>$user_id));
			$this->_data['bank_accounts'] = $bank_accounts;



			
			
            $this->_data['user_data'] = $user_data[0];
            $this->_data['user_roles'] = $this->comman_model->get('user_roles',array('role_id !=' => 1));
            $this->_data['view_path'] = "admin/users/edit";
            $this->_data['page'] = "edit";

            if ($this->input->server('REQUEST_METHOD') === 'POST'){

                $this->form_validation->set_rules('first_name', 'First Name', 'trim|required|max_length[45]');
                $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|max_length[45]');
                $this->form_validation->set_rules('username', 'Username', 'trim|required|max_length[45]');
                $this->form_validation->set_rules('businessname', 'Businessname', 'trim|required|max_length[45]|callback_validate_businessname[$user_id]');
                $this->form_validation->set_rules('gender', 'Gender', 'trim|required');
                $this->form_validation->set_rules('role_id', 'Role', 'trim|required');

                if ($this->form_validation->run() == FALSE) {
                    $this->_data['errors'] = validation_errors();
                }
                else{
                    $where = array('user_id' => $user_id);
                    $userData = array(
                        'first_name' => $this->input->post('first_name'),
                        'last_name' => $this->input->post('last_name'),
                        'username' => $this->input->post('username'),
                        'gender' => $this->input->post('gender'),
                        'role_id' => $this->input->post('role_id'),
                        'businessname' => $this->input->post('businessname'),
                        'date_updated' => date('Y-m-d H:i:s')
                    );
                    $updated = $this->comman_model->update('user',$where,$userData);
                    if ($updated){
                        $this->session->set_flashdata('success', "User Updated Successfully.");
                        redirect('admin/users');
                    }else {
                        $this->_data['errors'] = 'Unable to update user information !';
                    }
                }
            }

            $this->__loadView();
        }else {
            $this->session->set_flashdata('errors', 'User not found.');
            redirect('admin/users');
        }
    }

    function accessRights() {

        $user_id = decode_uri($this->uri->segment(5));

        $user_data = $this->comman_model->get('user',array('user_id' => $user_id,'role_id !=' => 1));

        $modules_list = $this->comman_model->get('modules');
        if($modules_list){
            $except_list = array(15,16,17,18);
            foreach($modules_list as $d_key => $d_module){
                if(in_array($d_module['id'],$except_list)){
                    unset($modules_list[$d_key]);
                }
            }
        } else {
            $modules_list = array();
        }

        $user_allowed_modules = $this->comman_model->get('modules_access_rights',array('user_id' => $user_id),array('module_id'));
        if($user_allowed_modules){
            foreach($user_allowed_modules as $key => $module){
                $user_allowed_modules[$key] = $module['module_id'];
            }
        } else {
            $user_allowed_modules = array();
        }

        if ($user_data) {

            $this->_data['user_allowed_modules'] = $user_allowed_modules;
            $this->_data['modules_list'] = $modules_list;
            $this->_data['user_data'] = $user_data[0];
            $this->_data['view_path'] = "admin/users/access_rights";
            $this->_data['page'] = "access_right";

            if ($this->input->server('REQUEST_METHOD') === 'POST'){

                $this->comman_model->delete('modules_access_rights',array('user_id' => $user_id));
                $selectedModules = $this->input->post('module_id');

                foreach($selectedModules as $s_module){
                    $this->comman_model->save('modules_access_rights', array(
                        'user_id' => $user_id,
                        'module_id' => $s_module
                    ));
                }

                if (1){
                    $this->session->set_flashdata('success', "User Rights updated successfully.");
                    redirect('admin/users');
                }else {
                    $this->_data['errors'] = 'Unable to update user rights !';
                }
            }

            $this->__loadView();
        }else {
            $this->session->set_flashdata('errors', 'User not found.');
            redirect('admin/users');
        }
    }

    function delete(){

        $user_id = decode_uri($this->uri->segment(5));
        $where = array('user_id' => $user_id);
        $deleted = $this->comman_model->delete('user',$where);

        if($deleted){
            $this->session->set_flashdata('success','User Deleted Successfully.');
        } else {
            $this->session->set_flashdata('errors','Requested user not found, please try later !');
        }
        redirect('admin/users/'.$this->uri->segment(4));
    }

    function updateStatus(){

        $user_id = decode_uri($this->uri->segment(5));
        $status = $this->uri->segment(6);
        $where = array('user_id' => $user_id);
        $userData = array('status' => $status);
        $updated = $this->comman_model->update('user',$where,$userData);

        if($updated){
            $msg = ($status == 1)? 'User Activated Successfully.' : 'User Deactivated Successfully.';
            $this->session->set_flashdata('success',$msg);
        } else {
            $this->session->set_flashdata('errors','Requested user not found, please try later !');
        }
        redirect('admin/users/'.$this->uri->segment(4));
    }

    function BlockSellerListing(){

        $user_id = decode_uri($this->uri->segment(5));
        $status = $this->uri->segment(6);
        $where = array('user_id' => $user_id);
        
        $status = 'yes';	
					
					$msg = 'User Listing paused Successfully.';

        $this->comman_model->update('seller_products',$where,array("pause_listing"=>'yes',"status"=>'inactive'));
        $where = array('seller_id' => $user_id);

        $this->comman_model->update('seller_shippings',$where,array("pause_listing"=>'yes'));
					
				
				
            $this->session->set_flashdata('success',$msg);
        
		
        redirect('admin/users/'.$this->uri->segment(4));
    }

	function UnBlockSellerListing(){

        $user_id = decode_uri($this->uri->segment(5));
        $status = $this->uri->segment(6);
        $where = array('user_id' => $user_id);
        

					$msg = 'User Listing un paused Successfully.';
        $this->comman_model->update('seller_products',$where,array("pause_listing"=>'no',"status"=>'active'));
        $where = array('seller_id' => $user_id);

        $this->comman_model->update('seller_shippings',$where,array("pause_listing"=>'no'));





        $this->session->set_flashdata('success',$msg);
        
		
        redirect('admin/users/'.$this->uri->segment(4));


		}

    
    public function validate_businessname($businessname,$user_id){
        $where = array('businessname'=>$businessname);
        if($user_id != false){
            $where['user_id !='] = $user_id;   
        }
        $businessname = $this->comman_model->get('user',$where);
        if ($businessname){
            $this->form_validation->set_message('validate_businessname', "Businessname Already exist, Please try another.");
            return FALSE;
        }else{
            return TRUE;
        }
    }

    function view_payment_summary(){

        $where = array('user_id !=' => getCurrentUserId());

        if($this->input->get('seller')){
            $where['seller_id'] = $this->input->get('seller');
        }

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
            
        if($this->input->get('PaymentType')=='Period'){
            $arr_PaymentID = explode("-",$this->input->get('PaymentID'));
            $from = $arr_PaymentID[0];
            $to = $arr_PaymentID[1];
            $arr_first_date = explode("/",$arr_PaymentID[0]);
            $arr_second_date = explode("/",$arr_PaymentID[1]);
            $start_date = "20".trim($arr_first_date[2])."-".trim($arr_first_date[0])."-".trim($arr_first_date[1])." 00:00:00";
            $end_date = "20".trim($arr_second_date[2])."-".trim($arr_second_date[0])."-".trim($arr_second_date[1])." 23:59:59";
            
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

            //unset($where['user_id']);
        //$where['seller_id'] = getCurrentUserId();
        $received_orders =  $this->product_model->search_products('purchase', 500, 0,false, $where, $order,false);
        //echo '<pre>';print_r($received_orders);exit;    
            
        //$this->_data['my_orders'] = $my_orders;
        $this->_data['received_orders'] = $received_orders;
        $this->_data['view_path'] = "admin/payment/view_payment_summary";
        $this->_data['page'] = "view_payment_summary";
        $this->__loadView();
    }

    
    function exportSalesRefunds(){

        $or_where =array();
        $where = array('user_id !=' => getCurrentUserId());

        if($this->input->get('seller')){
            $where['seller_id'] = $this->input->get('seller');
        }
        
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
    
    }
}