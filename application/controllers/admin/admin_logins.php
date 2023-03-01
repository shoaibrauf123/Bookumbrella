<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_logins extends CI_Controller
{
    private $_data;

    function __construct()
    {
        parent::__construct();
        check_is_login(0);

        $this->load->model('admin_login');
    }

    function index()
    {

        if ($this->session->flashdata('success') != "")
            $this->_data['success'] = $this->session->flashdata('success');
        if ($this->session->flashdata('errors') != "")
            $this->_data['errors'] = $this->session->flashdata('errors');

        $this->load->view('admin/admin/admin_login', $this->_data);
    }

    function admin_portal()
    {
		
		//echo '<pre>';print_r($_POST);exit;
        if ($_POST) {
            $result = $this->admin_login->login();
            
			if (sizeof($result) > 0) {
                $rights = $this->admin_login->get_rights(array('user_id'=>$result[0]['user_id']));
                //echo '<pre>';print_r($rights);exit;
				$this->session->set_userdata('admin_rights',$rights);
               // print_r($this->session->userdata('admin_rights')); die();
                foreach ($result[0] as $key => $value) {
                    $adminData['admin_' . $key] = $value;
                }
				
				//echo '<pre>';print_r($adminData);exit;
                unset($result[0]);

                $this->session->set_userdata(array('admin_logged_in' => TRUE));
                $this->session->set_userdata($adminData);
				//echo '<pre>';print_r($this->session->all_userdata()); 
				///echo '--------------------------------------<br />';exit;
				//echo $this->session->userdata('admin_role_id');exit;
                redirect('admin/dashboard');
            } else {
                $this->session->set_flashdata('errors', 'Invalid Email ID/Password');
            }
        }

        redirect('admin');
    }

}
