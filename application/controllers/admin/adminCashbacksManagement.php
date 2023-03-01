<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class AdminCashbacksManagement extends CI_Controller
{
    private $_data;

    public function __construct()
    {
        parent::__construct();
        check_is_login(14);
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

        $where = array('cashback_id  !=' => 0);
        $total = $this->comman_model->get_total('cashback', $where);
        $per_page = 10;
        $num_links = 4;
        $uri_segment = 3;

        $this->_data['pagination'] = paginate(base_url() . 'admin/cashbacks/', $total, $per_page, $num_links, $uri_segment);
        $this->_data['results'] = $this->comman_model->get_all_limited('cashback', $per_page, $start_from, $where);
        $this->_data['page'] = "index";
        $this->_data['view_path'] = 'admin/cashbacks/index';

        $this->__loadView();
    }

    function add()
    {

        $this->_data['view_path'] = "admin/cashbacks/add";
        $this->_data['page'] = "add";

        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $this->form_validation->set_rules('title', 'Cashback Title', 'trim|required');
            $this->form_validation->set_rules('description', 'Cashback Description', 'trim|required');

            if ($this->form_validation->run() !== FALSE) {
                $saved = $this->comman_model->save('cashback',
                    array(
                        'title' => $this->input->post('title'),
                        'description' => $this->input->post('description'),
                        'slug' => create_slug($this->input->post('title')),
                        'user_id' => getCurrentUserId()
                    )
                );
                if ($saved) {
                    $this->session->set_flashdata('success', 'Cashback Created successfully.');
                    redirect('admin/cashbacks');
                } else {
                    $this->_data['errors'] = 'Unable to save cashback. Review information and try again !';
                }
            } else {
                $this->_data['errors'] = validation_errors();
            }
        }

        $this->__loadView();
    }

    function edit() {

        $cashback_id = decode_uri($this->uri->segment(5));

        $this->_data['view_path'] = "admin/cashbacks/edit";
        $this->_data['page'] = "edit";
        $cashback_data = $this->comman_model->get('cashback',array('cashback_id' => $cashback_id));

        if(!$cashback_data){
            $this->_data['errors'] = 'An error occurred, try later';
            redirect('admin/cashbacks/'.$this->uri->segment(4));
        }else{
            $this->_data['page_data'] = $cashback_data[0];
        }

        if ($this->input->server('REQUEST_METHOD') === 'POST'){
            $this->form_validation->set_rules('title', 'Cashback Title', 'trim|required');
            $this->form_validation->set_rules('description', 'Cashback Description', 'trim|required');

            if ($this->form_validation->run() !== FALSE) {
                $where = array('cashback_id' => $cashback_id);
                $cashbacksData = array(
                    'title' => $this->input->post('title'),
                    'description' => $this->input->post('description'),
                    'slug' => create_slug($this->input->post('title')),
                    'date_updated' => date('Y-m-d H:i:s')
                );
                $updated = $this->comman_model->update('cashback',$where,$cashbacksData);
                if ($updated) {
                    $this->session->set_flashdata('success','Cashback Updated successfully.');
                    redirect('admin/cashbacks/'.$this->uri->segment(4));
                } else {
                    $this->_data['errors'] = 'An error occurred, try later';
                }
            }else {
                $this->_data['errors'] = validation_errors();
            }
        }

        $this->__loadView();
    }

    function updateStatus()
    {

        $cashback_id = decode_uri($this->uri->segment(5));
        $status_code = decode_uri($this->uri->segment(6));
        $status_text = array(
            1 => 'Confirmed',
            2 => 'Failed',
            3 => 'Pending'
        );

        $where = array('cashback_id' => $cashback_id);
        $categoryData = array('updated_status' => $status_text[$status_code]);
        $updated = $this->comman_model->update('cashback', $where, $categoryData);

        if ($updated) {
            $msg = 'Cashback status successfully updated to '.$status_text[$status_code]." !";
            $this->session->set_flashdata('success', $msg);
        } else {
            $this->session->set_flashdata('errors', 'Requested cashback not found, please try later !');
        }

        redirect('admin/cashbacks/'.$this->uri->segment(4));
    }

    function delete(){

        $cashback_id = decode_uri($this->uri->segment(5));
        $cashback_data = getSingleRecord('cashback',array('cashback_id' => $cashback_id));

        $where = array('cashback_id' => $cashback_id);
        $deleted = $this->comman_model->delete('cashback',$where);

        if($deleted){
            $this->comman_model->delete('exit_click',array('exit_click_id' => $cashback_data['exit_click_id']));

            $this->session->set_flashdata('success','Cashback Deleted Successfully.');
        } else {
            $this->session->set_flashdata('errors','Requested page not found, please try later !');
        }
        redirect('admin/cashbacks/'.$this->uri->segment(4));
    }
    
}