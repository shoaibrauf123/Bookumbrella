<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class AdminStoresManagement extends CI_Controller {

    private $_data;

    public function __construct() {
        parent::__construct();
        check_is_login(8);
        $this->load->helper('upload_helper');
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

        $where = array('store_id  !=' => 0);
        if($this->session->userdata('admin_role_id') == 2){
            $where['user_id'] = $this->session->userdata('admin_user_id');
        }
        $total = $this->comman_model->get_total('store',$where);
        $per_page = 10;
        $num_links = 4;
        $uri_segment = 3;

        $this->_data['pagination'] = paginate(base_url() . 'admin/stores/', $total, $per_page, $num_links, $uri_segment);
        $this->_data['results'] = $this->comman_model->get_all_limited('store',$per_page, $start_from,$where);
        $this->_data['page'] = "index";
        $this->_data['view_path'] = 'admin/stores/index';

        $this->__loadView();
    }

    function add() {
        check_is_login(7);
        $this->_data['networks'] = $this->comman_model->get('network');
        $this->_data['view_path'] = "admin/stores/add";
        $this->_data['page'] = "add";

        if ($this->input->server('REQUEST_METHOD') === 'POST'){
            $this->form_validation->set_rules('name', 'Store Name', 'trim|required');
            $this->form_validation->set_rules('network_store_id', 'Network Store id', 'trim|required');
            $this->form_validation->set_rules('url_key', 'Url Key', 'trim|required');
            $this->form_validation->set_rules('short_description', 'Short Description', 'trim|required');
            $this->form_validation->set_rules('long_description', 'Long Description', 'trim|required');
            $this->form_validation->set_rules('network_id', 'Network', 'trim|required');
            $this->form_validation->set_rules('keywords', 'keywords', 'trim|required');
            $this->form_validation->set_rules('store_link_url', 'Store Url', 'trim|required');
            $this->form_validation->set_rules('address', 'Address', 'trim|required');
            $this->form_validation->set_rules('status', 'Status', 'trim|required');

            if ($this->form_validation->run() !== FALSE) {
                /*
                 * start image code
                 */
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
                            'url_key' => $this->input->post('url_key'),
                            'short_description' => $this->input->post('short_description'),
                            'long_description' => $this->input->post('long_description'),
                            'network_id' => $this->input->post('network_id'),
                            'store_link_url' => $this->input->post('store_link_url'),
                            'address' => $this->input->post('address'),
                            'status' => $this->input->post('status'),
                            'keywords' => $this->input->post('keywords'),
                            'user_id' => getCurrentUserId(),
                            'date_created' => date("Y-m-d H:i:s")
                                 )
                                 );
                     // If Display image uploaded successfully
                      if ($isImageUploaded) {
                         $is_saved = $this->comman_model->save('store',$storeData);
                      if($is_saved){
                            $this->session->set_flashdata('success','Store creaed successfully.');
                            redirect('admin/stores/add');
                        } else {
                            $this->session->set_flashdata('errors','Sorry ! Error occur try again');
                             redirect('admin/stores/add');
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
                /*
                 * edit code
                 */
        $this->__loadView();
    }

    function edit() {

        $store_id = decode_uri($this->uri->segment(5));

        $store_data = $this->comman_model->get('store',array('store_id' => $store_id));
        
        $this->_data['networks'] = $this->comman_model->get('network');
        $this->_data['view_path'] = "admin/stores/edit";
        $this->_data['page'] = "edit";

        if(!$store_data){
            $this->_data['errors'] = 'An error occurred, try later';
            redirect('admin/stores/'.$this->uri->segment(4));
        }else{
            $this->_data['store_data'] = $store_data[0];
        }

        if ($this->input->server('REQUEST_METHOD') === 'POST'){

            $this->form_validation->set_rules('name', 'Store Name', 'trim|required');
            $this->form_validation->set_rules('network_store_id', 'Network Store id', 'trim|required');
            $this->form_validation->set_rules('url_key', 'Url Key', 'trim|required');
            $this->form_validation->set_rules('short_description', 'Short Description', 'trim|required');
            $this->form_validation->set_rules('long_description', 'Long Description', 'trim|required');
            $this->form_validation->set_rules('network_id', 'Network', 'trim|required');
            $this->form_validation->set_rules('keywords', 'keywords', 'trim|required');
            $this->form_validation->set_rules('address', 'Address', 'trim|required');
            $this->form_validation->set_rules('status', 'Status', 'trim|required');

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
                //end image upload function
                $storeData = array_merge($storeData, array(
                            'name' => $this->input->post('name'),
                            'network_store_id' => $this->input->post('network_store_id'),
                            'url_key' => $this->input->post('url_key'),
                            'short_description' => $this->input->post('short_description'),
                            'long_description' => $this->input->post('long_description'),
                            'network_id' => $this->input->post('network_id'),
                            'store_link_url' => $this->input->post('store_link_url'),
                            'address' => $this->input->post('address'),
                            'status' => $this->input->post('status'),
                          'keywords' => $this->input->post('keywords'),
                          'date_updated' => date("Y-m-d H:i:s")
                                 )
                                 );
                
                $where = array('store_id' => $store_id);
                if($this->session->userdata('admin_role_id') == 2){
                    $where['user_id'] = $this->session->userdata('admin_user_id');
                }
                $saved = $this->comman_model->update('store',$where,$storeData);

                if ($saved) {
                    $this->session->set_flashdata('success','Store Updated successfully.');
                    redirect('admin/stores');
                } else {
                    $this->_data['errors'] = 'Unable to save Store. Review information and try again !';
                                    redirect('admin/stores');
                }
             
            }else {
                $this->_data['errors'] = validation_errors();
            }
        }

        $this->__loadView();
    }

    function delete(){

        $store_id = decode_uri($this->uri->segment(5));
        $where = array('store_id' => $store_id);
        if($this->session->userdata('admin_role_id') == 2){
            $where['user_id'] = $this->session->userdata('admin_user_id');
        }
        $deleted = $this->comman_model->delete('store',$where);

        if($deleted){
            $this->session->set_flashdata('success','Store Deleted Successfully.');
        } else {
            $this->session->set_flashdata('errors','Requested store not found, please try later !');
        }
        redirect('admin/stores/'.$this->uri->segment(4));
    }

    function updateStatus(){

        $store_id = decode_uri($this->uri->segment(5));
        $status = $this->uri->segment(6);
        $where = array('store_id' => $store_id);
        if($this->session->userdata('admin_role_id') == 2){
            $where['user_id'] = $this->session->userdata('admin_user_id');
        }
        $storeData = array('status' => $status);
        $updated = $this->comman_model->update('store',$where,$storeData);

        if($updated){
            $msg = ($status == 1)? 'Store Activated Successfully.' : 'Store Deactivated Successfully.';
            $this->session->set_flashdata('success',$msg);
        } else {
            $this->session->set_flashdata('errors','Requested Store not found, please try later !');
        }
        redirect('admin/stores/'.$this->uri->segment(4));
    }
}