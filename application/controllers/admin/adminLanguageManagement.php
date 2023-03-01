<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class AdminLanguageManagement extends CI_Controller
{

    private $_data;

    public function __construct()
    {
        parent::__construct();
        check_is_login(22);
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

        $total = $this->comman_model->get_total('language_variable', FALSE);
        $per_page = 10;
        $num_links = 4;
        $uri_segment = 3;

        $this->_data['pagination'] = paginate(base_url() . 'admin/language_variables/', $total, $per_page, $num_links, $uri_segment);
        $this->_data['results'] = $this->comman_model->get_all_limited('language_variable', $per_page, $start_from, FALSE);
         
        $this->_data['page'] = "index";
        $this->_data['view_path'] = 'admin/languages/index';

        $this->__loadView();
    }

    function add()
    {
        check_is_login(21);
        $this->_data['view_path'] = "admin/languages/add";
        $this->_data['page'] = "add";

        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            
            $this->form_validation->set_rules('variable_name', 'Variable Name', 'trim|required|is_unique[language_variable.variable_name]');
            $this->form_validation->set_rules('value', 'Value', 'trim|required');
            $this->form_validation->set_rules('language_id', 'Language', 'trim|required');

            if ($this->form_validation->run() !== FALSE) {
                $data = array(
                        'variable_name' => $this->input->post('variable_name'),
                        'value' => $this->input->post('value'),
                        'language_id' => $this->input->post('language_id'),
                        'label' => create_slug($this->input->post('variable_name'))
                    );
                //print_r($data);die;
                $saved = $this->comman_model->save('language_variable',$data);
                if ($saved) {
                    $this->session->set_flashdata('success', 'Language Created successfully.');
                    redirect('admin/language_variables');
                } else {
                    $this->_data['errors'] = 'Unable to save language. Review information and try again !';
                }
            } else {
                $this->_data['errors'] = validation_errors();
            }
        }

        $this->__loadView();
    }

    function edit()
    {
        $id = decode_uri($this->uri->segment(5));

        $this->_data['view_path'] = "admin/languages/edit";
        $this->_data['page'] = "edit";
       $this->_data['language_data'] = $this->comman_model->get('language_variable', array('id' => $id));

        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            
            $this->form_validation->set_rules('variable_name', 'Variable Name', 'trim|required');
            $this->form_validation->set_rules('value', 'Value', 'trim|required');
            $this->form_validation->set_rules('language_id', 'Language', 'trim|required');

            if ($this->form_validation->run() !== FALSE) {
                $where = array('id' => $id);
                 $data = array(
                        'variable_name' => $this->input->post('variable_name'),
                        'value' => $this->input->post('value'),
                        'language_id' => create_slug($this->input->post('language_id')),
                        'label' => url_title($this->input->post('variable_name'))
                    );
                $updated = $this->comman_model->update('language_variable', $where, $data);
                if ($updated) {
                    $this->session->set_flashdata('success', 'Language Updated successfully.');
                    redirect('admin/language_variables');
                } else {
                    $this->session->set_flashdata('errors', 'Nothing update.');
                    redirect('admin/language_variables');
                }
            } else {
                $this->_data['errors'] = validation_errors();
            }
        }
        $this->__loadView();
    }

    
  
}