<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class AdminContectMessagesManagement extends CI_Controller {

    private $_data;

    public function __construct() {
        parent::__construct();
        check_is_login(19);
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

       // $where = array('user_id !=' => 0,'role_id !=' => 1);
        $total = $this->comman_model->get_total('contect_messages');
        $per_page = 10;
        $num_links = 4;
        $uri_segment = 3;

        $this->_data['pagination'] = paginate(base_url() . 'admin/contect_messages/', $total, $per_page, $num_links, $uri_segment);
        $this->_data['results'] = $this->comman_model->get_all_limited('contect_messages',$per_page, $start_from,FALSE,array('created_on' =>'DESC'));
        $this->_data['page'] = "index";
        $this->_data['view_path'] = 'admin/contect_messages/index';

        $this->__loadView();
    }
	
	function contact_us_reply()
    { 
        
        if ($this->input->server('REQUEST_METHOD') === 'POST') {

            //$this->form_validation->set_rules('email', 'Email Address', 'trim|required|valid_email|xss_clean');
            $this->form_validation->set_rules('message', 'Message', 'required|trim|xss_clean');
            $this->form_validation->set_rules('subject', 'Subject', 'required|trim|xss_clean');
            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata ('errors',validation_errors());
                redirect('admin/contect_messages');

            } else {
                $message = '<html>
                    <body bgcolor="#EDEDEE">
                    <p><strong> Dear Admin!</strong></p>
                     <p>Below is the message sent by a user</p>
                     <p>' . $this->input->post('message') . '</p>
                     <p>Regards<p>
                     <p><strong>' . $this->input->post('name') . '</strong><p>
                  </body>
                  </html>';
                $where = array('msg_id'=>$this->input->post('messsage_id'));
                $email = $this->comman_model->get('contect_messages',$where,'sender_email');
                //echo $email[0][' sender_email']; die();
                $admin_email = $this->session->userdata('admin_email');
                $headers = "From: $admin_email" . "\r\n";
                $headers .= 'X-Mailer: PHP/' . phpversion();
                $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
                $send = mail($email[0]['sender_email'], $this->input->post('subject'), $message, $headers);
               
                    
                $this->comman_model->update('contect_messages',$where,array('reply'=>1));
                
                $this->session->set_flashdata('success', 'Email sent successfully.');
                redirect('admin/contect_messages');

            }
        } else {
            redirect('admin/contect_messages');
        }

    }

    
}