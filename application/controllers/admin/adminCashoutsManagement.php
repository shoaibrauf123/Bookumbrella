<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class AdminCashoutsManagement extends CI_Controller
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

        $where = array('cashout_id  !=' => 0);
        $total = $this->comman_model->get_total('cashout', $where);
        $per_page = 10;
        $num_links = 4;
        $uri_segment = 3;

        $this->_data['pagination'] = paginate(base_url() . 'admin/cashouts/', $total, $per_page, $num_links, $uri_segment);
        $this->_data['results'] = $this->comman_model->get_all_limited('cashout', $per_page, $start_from, $where);
        $this->_data['page'] = "index";
        $this->_data['view_path'] = 'admin/cashouts/index';

        $this->__loadView();
    }

    function add()
    {

        $this->_data['view_path'] = "admin/cashouts/add";
        $this->_data['page'] = "add";

        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $this->form_validation->set_rules('title', 'Cashout Title', 'trim|required');
            $this->form_validation->set_rules('description', 'Cashout Description', 'trim|required');

            if ($this->form_validation->run() !== FALSE) {
                $saved = $this->comman_model->save('cashout',
                    array(
                        'title' => $this->input->post('title'),
                        'description' => $this->input->post('description'),
                        'slug' => create_slug($this->input->post('title')),
                        'user_id' => getCurrentUserId()
                    )
                );
                if ($saved) {
                    $this->session->set_flashdata('success', 'Cashout Created successfully.');
                    redirect('admin/cashouts');
                } else {
                    $this->_data['errors'] = 'Unable to save cashout. Review information and try again !';
                }
            } else {
                $this->_data['errors'] = validation_errors();
            }
        }

        $this->__loadView();
    }

    function edit() {

        $cashout_id = decode_uri($this->uri->segment(5));

        $this->_data['view_path'] = "admin/cashouts/edit";
        $this->_data['page'] = "edit";
        $cashout_data = $this->comman_model->get('cashout',array('cashout_id' => $cashout_id));

        if(!$cashout_data){
            $this->_data['errors'] = 'An error occurred, try later';
            redirect('admin/cashouts/'.$this->uri->segment(4));
        }else{
            $this->_data['page_data'] = $cashout_data[0];
        }

        if ($this->input->server('REQUEST_METHOD') === 'POST'){
            $this->form_validation->set_rules('title', 'Cashout Title', 'trim|required');
            $this->form_validation->set_rules('description', 'Cashout Description', 'trim|required');

            if ($this->form_validation->run() !== FALSE) {
                $where = array('cashout_id' => $cashout_id);
                $cashoutsData = array(
                    'title' => $this->input->post('title'),
                    'description' => $this->input->post('description'),
                    'slug' => create_slug($this->input->post('title')),
                    'date_updated' => date('Y-m-d H:i:s')
                );
                $updated = $this->comman_model->update('cashout',$where,$cashoutsData);
                if ($updated) {
                    $this->session->set_flashdata('success','Cashout Updated successfully.');
                    redirect('admin/cashouts/'.$this->uri->segment(4));
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

        $cashout_id = decode_uri($this->uri->segment(5));
        $status_code = decode_uri($this->uri->segment(6));
        $update_vals = array();

        $status_text = array(
            1 => 'Approved',
            2 => 'Failed',
            3 => 'Pending',
            4 => 'Paid'
        );

        if($status_code == 1 || $status_code == 4){
            if($status_code == 1){
                $update_vals = array_merge($update_vals,array('approval_datetime' => date('Y-m-d h:i:s')));
            } else if($status_code == 4){
                $update_vals = array_merge($update_vals,array('payment_date' => date('Y-m-d h:i:s')));
            }
        }

        $update_vals = array_merge($update_vals,array('status' => $status_text[$status_code]));

        $updated = $this->comman_model->update('cashout', array('cashout_id' => $cashout_id), $update_vals );

        if ($updated) {

            if($status_code == 1 || $status_code == 4){
                $this->comman_model->update('cashback', array('cashout_id' => $cashout_id), array('updated_status' => $status_text[$status_code]));
            }

            $msg = 'Cashout status successfully updated to '.$status_text[$status_code]." !";
            $this->session->set_flashdata('success', $msg);
        } else {
            $this->session->set_flashdata('errors', 'Requested cashout not found, please try later !');
        }

        redirect('admin/cashouts/'.$this->uri->segment(4));
    }

    function delete(){

        $cashout_id = decode_uri($this->uri->segment(5));
        $cashout_data = getSingleRecord('cashout',array('cashout_id' => $cashout_id));

        $where = array('cashout_id' => $cashout_id);
        $deleted = $this->comman_model->delete('cashout',$where);

        if($deleted){
            $this->comman_model->delete('exit_click',array('exit_click_id' => $cashout_data['exit_click_id']));

            $this->session->set_flashdata('success','Cashout Deleted Successfully.');
        } else {
            $this->session->set_flashdata('errors','Requested page not found, please try later !');
        }
        redirect('admin/cashouts/'.$this->uri->segment(4));
    }
    
}