<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class AdminApiManagement extends CI_Controller {
    private $_data;
    public function __construct() {
        parent::__construct();
        check_is_login(11);
    }
    private function __loadView() {
        if ($this->session->flashdata('success')!="")
            $this->_data['success'] = $this->session->flashdata ('success');
        if ($this->session->flashdata('errors')!="")
            $this->_data['errors'] = $this->session->flashdata ('errors');

        $this->load->view('admin/admin_template', $this->_data);
    }

    function index() {
        $start_from = $this->uri->segment(3);
        if (!is_numeric($start_from)){
            $start_from = 0;
        }

        $where = array('network_id  !=' => 0);
        $total = $this->comman_model->get_total('network',$where);
        $per_page = 10;
        $num_links = 4;
        $uri_segment = 3;

        $this->_data['pagination'] = paginate(base_url() . 'admin/api/', $total, $per_page, $num_links, $uri_segment);
        $this->_data['results'] = $this->comman_model->get_all_limited('network',$per_page, $start_from,$where);
        $this->_data['page'] = "index";
        $this->_data['view_path'] = 'admin/apis/index';

        $this->__loadView();
    }

    function add() {

        $this->_data['view_path'] = "admin/apis/add";
        $this->_data['page'] = "add";

        if ($this->input->server('REQUEST_METHOD') === 'POST'){
            $this->form_validation->set_rules('title', 'Api Title', 'trim|required|is_unique[network.title]');
            $this->form_validation->set_rules('key', 'Api key', 'trim|required');

            if ($this->form_validation->run() !== FALSE) {
                $data  = array(
                        'title' => $this->input->post('title'),
                        'key' => $this->input->post('key'),
                        'website_id' => $this->input->post('website_id'),
                        'api_id' => create_slug($this->input->post('title')),
                        'date_created'=>date('Y-m-d H:i:s')
                    );
                $saved = $this->comman_model->save('network',$data);
                if ($saved) {
                    $this->session->set_flashdata('success','Api Created successfully.');
                    redirect('admin/api');
                } else {
                    $this->_data['errors'] = 'Unable to save aPI. Review information and try again !';
                }
            } else {
                $this->_data['errors'] = validation_errors();
            }
        }

        $this->__loadView();
    }

    function edit() {

        $page_id = decode_uri($this->uri->segment(5));

        $this->_data['view_path'] = "admin/apis/edit";
        $this->_data['page'] = "edit";
        $page_data = $this->comman_model->get('network',array('network_id' => $page_id));

        if(!$page_data){
            $this->_data['errors'] = 'An error occurred, try later';
            redirect('admin/pages/'.$this->uri->segment(4));
        }else{
            $this->_data['page_data'] = $page_data[0];
        }

        if ($this->input->server('REQUEST_METHOD') === 'POST'){
           $this->form_validation->set_rules('title', 'Api Title', 'trim|required|callback_validate_title');
            $this->form_validation->set_rules('key', 'Api key', 'trim|required');
            $this->form_validation->set_rules('cashback', 'Cashback value', 'trim|required');

            if ($this->form_validation->run() !== FALSE) {
                $where = array('network_id' => $page_id);
               
                  $updatedata  = array(
                        'title' => $this->input->post('title'),
                        'key' => $this->input->post('key'),
                        'website_id' => $this->input->post('website_id'),
                        'cashback' => $this->input->post('cashback'),
                        'api_id' => create_slug($this->input->post('title')),
                        'date_updated'=>date('Y-m-d H:i:s')
                    );
                  // print_r($updatedata);die;
                $updated = $this->comman_model->update('network',$where,$updatedata);
                if ($updated) {
                    $this->session->set_flashdata('success','Api Updated successfully.');
                    redirect('admin/api/'.$this->uri->segment(4));
                } else {
                    $this->_data['errors'] = 'An error occurred, try later';
                }
            }else {
                $this->_data['errors'] = validation_errors();
            }
        }

        $this->__loadView();
    }

    function delete(){

        $page_id = decode_uri($this->uri->segment(5));
        $where = array('network_id' => $page_id);
        $deleted = $this->comman_model->delete('network',$where);

        if($deleted){
            $this->session->set_flashdata('success','Api Deleted Successfully.');
        } else {
            $this->session->set_flashdata('errors','Requested page not found, please try later !');
        }
        redirect('admin/api/'.$this->uri->segment(4));
    }
   function validate_title($id){
       $page_id=  $this->input->post('id');
       $title =  $this->input->post('title');
       $validate_data = $this->comman_model->get('network',array('network_id !=' => $page_id,'title'=>$title));
   if($validate_data){
        $this->form_validation->set_message('validate_title', 'Title already exist.Try another');
        return false;
   } else {
       return true;
   }
       
   } 
}