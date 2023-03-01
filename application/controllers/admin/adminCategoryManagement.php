<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class AdminCategoryManagement extends CI_Controller
{

    private $_data;

    public function __construct()
    {
        parent::__construct();
        //check_is_login(4);
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

        $where = array('category_id !=' => 0);

        if($this->session->userdata('admin_role_id') == 2){
            $where['user_id'] = $this->session->userdata('admin_user_id');
        }
       
        $total = $this->comman_model->get_total('category', $where);
        $per_page = 10;
        $num_links = 4;
        $uri_segment = 3;

        $this->_data['pagination'] = paginate(base_url() . 'admin/categories/', $total, $per_page, $num_links, $uri_segment);
        $this->_data['results'] = $this->comman_model->get_all_limited('category', $per_page, $start_from, $where);
        $this->_data['page'] = "index";
        $this->_data['view_path'] = 'admin/categories/index';

        $this->__loadView();
    }

    function add()
    {
        
       // check_is_login(3);
      
        $where = array('category_id !=' => 0);
        
        if($this->session->userdata('admin_role_id') == 2){
            $where['user_id'] = $this->session->userdata('admin_user_id');
        }


        $this->_data['parent_categories'] = $this->comman_model->get('category',$where);
        $this->_data['view_path'] = "admin/categories/add";
        $this->_data['page'] = "add";

        $config['upload_path'] = './uploads/img_gallery/admin_categories/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = '1000';
        $config['max_width']  = '1024';
        $config['max_height']  = '768';
        $config['overwrite'] = TRUE;
        $config['encrypt_name'] = FALSE;
        $config['remove_spaces'] = TRUE;

        if ( ! is_dir($config['upload_path']) ) die("THE UPLOAD DIRECTORY DOES NOT EXIST");
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('image_upload')) {
                $data =  $this->upload->data();

              $file_path = $data["raw_name"]."".$data["file_ext"];
            }                 

        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            
            $this->form_validation->set_rules('title', 'Category Title', 'trim|required');
            $this->form_validation->set_rules('status', 'Category Status', 'trim|required');
            $this->form_validation->set_rules('description', 'Category Description', 'trim|required');
            //$this->form_validation->set_rules('image_upload', 'image Upload', 'trim|required');          

            if ($this->form_validation->run() !== FALSE) {
                
                $saved = $this->comman_model->save('category',
                    array(
                        'parent_id' => $this->input->post('parent_id'),
                        'title' => $this->input->post('title'),
                        'slug' => create_slug($this->input->post('title')),
                        'status' => $this->input->post('status'),
                        'network_id' => $this->input->post('network_id'),
                        'description' => $this->input->post('description'),
                        'user_id' => getCurrentUserId(),
                        "image" => $file_path,
                        'top_lavel' => ($this->input->post('top_lavel'))? 1 : 0
                    )
                   
                );
                if ($saved) {
                    $this->session->set_flashdata('success', 'Category Created successfully.');
                    redirect('admin/categories');
                } else {
                    $this->_data['errors'] = 'Unable to save category. Review information and try again !';
                }
            } else {
                $this->_data['errors'] = validation_errors();
            }
        }

        $this->__loadView();
    }

    function edit()
    {


        $category_id = decode_uri($this->uri->segment(5));
       
        $this->_data['parent_categories'] = $this->comman_model->get('category', array('category_id !=' => $category_id));


        $this->_data['view_path'] = "admin/categories/edit";
        $this->_data['page'] = "edit";
        $category_data = $this->comman_model->get('category', array('category_id' => $category_id));
       
        if (!$category_data) {
            $this->_data['errors'] = 'An error occurred, try later';
            redirect('admin/categories/' . $this->uri->segment(4));
        } else {
            $this->_data['category_data'] = $category_data[0];
        }
        $config['upload_path'] = './uploads/img_gallery/admin_categories/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = '1000';
        $config['max_width']  = '1024';
        $config['max_height']  = '768';
        $config['overwrite'] = TRUE;
        $config['encrypt_name'] = FALSE;
        $config['remove_spaces'] = TRUE;

        if ( ! is_dir($config['upload_path']) ) die("THE UPLOAD DIRECTORY DOES NOT EXIST");
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('image_upload')) {
                $data =  $this->upload->data();

                $file_path = $data["raw_name"]."".$data["file_ext"];
            }else{
                $file_path = $category_data[0]["image"];
            }

        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $this->form_validation->set_rules('title', 'Category Title', 'trim|required');
            $this->form_validation->set_rules('status', 'Category Status', 'trim|required');
            $this->form_validation->set_rules('description', 'Category Description', 'trim|required');
  

            if ($this->form_validation->run() !== FALSE) {
                $where = array('category_id' => $category_id);
                if($this->session->userdata('admin_role_id') == 2){
                    $where['user_id'] = $this->session->userdata('admin_user_id');
                }
                $categoryData = array(
                    'parent_id' => $this->input->post('parent_id'),
                    'title' => $this->input->post('title'),
                    'slug' => create_slug($this->input->post('title')),
                    'status' => $this->input->post('status'),
                    'network_id' => $this->input->post('network_id'),
                    'description' => $this->input->post('description'),
                    'date_updated' => date('Y-m-d H:i:s'),
                    'top_lavel' => ($this->input->post('top_lavel'))? 1 : 0,
                    "image" => $file_path,
                );
                
                $updated = $this->comman_model->update('category', $where, $categoryData);
                if ($updated) {
                    $this->session->set_flashdata('success', 'Category Updated successfully.');
                    redirect('admin/categories/' . $this->uri->segment(4));
                } else {
                    $this->_data['errors'] = 'Unable to update user information !';
                }
            } else {
                $this->_data['errors'] = validation_errors();
            }
        }

        $this->__loadView();
    }

    function delete()
    {

        $category_id = decode_uri($this->uri->segment(5));
        $where = array('category_id' => $category_id);
        if($this->session->userdata('admin_role_id') == 2){
            $where['user_id'] = $this->session->userdata('admin_user_id');
        }
        $total = $this->comman_model->get_total('products', $where);
        if ($total > 0) {
            $this->session->set_flashdata('errors', 'Requested category can\'t be delete!');
            redirect('admin/categories/' . $this->uri->segment(4));
        } else {
            $deleted = $this->comman_model->delete('category', $where);

            if ($deleted) {
                $this->session->set_flashdata('success', 'Category Deleted Successfully.');
            } else {
                $this->session->set_flashdata('errors', 'Requested category not found, please try later !');
            }
        }
        redirect('admin/categories/' . $this->uri->segment(4));
    }

    function updateStatus()
    {

        $category_id = decode_uri($this->uri->segment(5));
        $status = $this->uri->segment(6);
        $where = array('category_id' => $category_id);
        if($this->session->userdata('admin_role_id') == 2){
            $where['user_id'] = $this->session->userdata('admin_user_id');
        }
        $categoryData = array('status' => $status);
        $updated = $this->comman_model->update('category', $where, $categoryData);

        if ($updated) {
            $msg = ($status == 1) ? 'Category Activated Successfully.' : 'Category Deactivated Successfully.';
            $this->session->set_flashdata('success', $msg);
        } else {
            $this->session->set_flashdata('errors', 'Requested category not found, please try later !');
        }

        redirect('admin/categories/' . $this->uri->segment(4));
    }
}