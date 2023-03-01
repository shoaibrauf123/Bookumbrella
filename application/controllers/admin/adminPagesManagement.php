<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class AdminPagesManagement extends CI_Controller {
    private $_data;
    public function __construct() {
        parent::__construct();
//        check_is_login(10);
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

        $where = array('page_id  !=' => 0);
        if($this->session->userdata('admin_role_id') == 2){
            $where['user_id'] = $this->session->userdata('admin_user_id');
        }
        $total = $this->comman_model->get_total('static_page',$where);
        $per_page = 10;
        $num_links = 4;
        $uri_segment = 3;

        $this->_data['pagination'] = paginate(base_url() . 'admin/pages/', $total, $per_page, $num_links, $uri_segment);
        $this->_data['results'] = $this->comman_model->get_all_limited('static_page',$per_page, $start_from,$where);
        $this->_data['page'] = "index";
        $this->_data['view_path'] = 'admin/pages/index';

        $this->__loadView();
    }

    function add() {
        //check_is_login(9);
        $this->_data['view_path'] = "admin/pages/add";
        $this->_data['page'] = "add";

        if ($this->input->server('REQUEST_METHOD') === 'POST'){
            $this->form_validation->set_rules('title', 'Page Title', 'trim|required');
            $this->form_validation->set_rules('description', 'Page Description', 'trim|required');

            if ($this->form_validation->run() !== FALSE) {
                $saved = $this->comman_model->save('static_page',
                    array(
                        'title' => $this->input->post('title'),
                        'description' => $this->input->post('description'),
                        'slug' => create_slug($this->input->post('title')),
                        'user_id' => getCurrentUserId()
                    )
                );
                if ($saved) {
                    $this->session->set_flashdata('success','Page Created successfully.');
                    redirect('admin/pages');
                } else {
                    $this->_data['errors'] = 'Unable to save page. Review information and try again !';
                }
            } else {
                $this->_data['errors'] = validation_errors();
            }
        }

        $this->__loadView();
    }

    function edit() {

        $page_id = decode_uri($this->uri->segment(5));

        $this->_data['view_path'] = "admin/pages/edit";
        $this->_data['page'] = "edit";
        $page_data = $this->comman_model->get('static_page',array('page_id' => $page_id));

        if(!$page_data){
            $this->_data['errors'] = 'An error occurred, try later';
            redirect('admin/pages/'.$this->uri->segment(4));
        }else{
            $this->_data['page_data'] = $page_data[0];
        }

        if ($this->input->server('REQUEST_METHOD') === 'POST'){
            $this->form_validation->set_rules('title', 'Page Title', 'trim|required');
            $this->form_validation->set_rules('description', 'Page Description', 'trim|required');

            if ($this->form_validation->run() !== FALSE) {
                $where = array('page_id' => $page_id);
                if($this->session->userdata('admin_role_id') == 2){
                    $where['user_id'] = $this->session->userdata('admin_user_id');
                }
                $pagesData = array(
                    'title' => $this->input->post('title'),
                    'description' => $this->input->post('description'),
                    'date_updated' => date('Y-m-d H:i:s'),
                    'updated_by' => getCurrentUserId()
                );
                $updated = $this->comman_model->update('static_page',$where,$pagesData);
                if ($updated) {
                    $this->session->set_flashdata('success','Page Updated successfully.');
                    redirect('admin/pages/'.$this->uri->segment(4));
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
        $where = array('page_id' => $page_id);
        if($this->session->userdata('admin_role_id') == 2){
            $where['user_id'] = $this->session->userdata('admin_user_id');
        }
        $deleted = $this->comman_model->delete('static_page',$where);

        if($deleted){
            $this->session->set_flashdata('success','Page Deleted Successfully.');
        } else {
            $this->session->set_flashdata('errors','Requested page not found, please try later !');
        }
        redirect('admin/pages/'.$this->uri->segment(4));
    }

    function updateStatus(){

        $page_id = decode_uri($this->uri->segment(5));
        $status = $this->uri->segment(6);
        $where = array('page_id' => $page_id);
        if($this->session->userdata('admin_role_id') == 2){
            $where['user_id'] = $this->session->userdata('admin_user_id');
        }
        $pagesData = array('status' => $status);
        $updated = $this->comman_model->update('static_page',$where,$pagesData);

        if($updated){
            $msg = ($status == 1)? 'Page Activated Successfully.' : 'Page Deactivated Successfully.';
            $this->session->set_flashdata('success',$msg);
        } else {
            $this->session->set_flashdata('errors','Requested page not found, please try later !');
        }
        redirect('admin/pages/'.$this->uri->segment(4));
    }

    function changePageSlug()
    {
        $response = false;

        $page_id = $this->input->post('page_id');
        $newSlugVal = $this->input->post('slug');

        $where = array('page_id' => $page_id);
        $pagesData = array(
            'slug' => $newSlugVal
        );
        $response = $this->comman_model->update('static_page',$where,$pagesData);

        echo $response; exit;
    }

}