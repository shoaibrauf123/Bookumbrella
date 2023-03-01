<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Search extends CI_Controller
{
    private $_data;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('search_model');
    }

    private function __loadView()
    {
        if ($this->session->flashdata('success') != "")
            $this->_data['success'] = $this->session->flashdata('success');
        if ($this->session->flashdata('errors') != "")
            $this->_data['errors'] = $this->session->flashdata('errors');
        $this->load->view('frontend/home_template', $this->_data);
    }

    public function search_store()
    {
        $start_from = $this->uri->segment(2);
        if (!is_numeric($start_from))
            $start_from = 0;
        $per_page = 10;
        $num_links = 10;
        $segment = 2;

        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $search_data = $this->input->post('search');
            if ($search_data) {
                $this->session->set_userdata('set_filter', $search_data);
                $total = $this->search_model->searching_total($search_data);
                $this->_data['total'] = $total;

                $this->_data['pagination'] = paginate(base_url() . 'browse/', $total, $per_page, $num_links, $segment);
                $this->_data["store_data"] = $this->search_model->searching_limited($search_data, $per_page, $start_from);

            } else {
                $total = $this->search_model->searching_total($this->session->userdata('set_filter'));
                $this->_data['total'] = $total;
                $this->_data['pagination'] = paginate(base_url() . 'browse/', $total, $per_page, $num_links, $segment);
                $this->_data['store_data'] = $this->search_model->search_model->searching($this->session->userdata('set_filter'));
            }
        } else {
            $total = $this->search_model->searching_total($this->session->userdata('set_filter'));
            $this->_data['total'] = $total;
            $this->_data['pagination'] = paginate(base_url() . 'browse/', $total, $per_page, $num_links, $segment);
            $this->_data["store_data"] = $this->search_model->searching_limited($this->session->userdata('set_filter'), $per_page, $start_from);
        }

        $this->_data['main_content'] = 'frontend/stores/listing';
        $this->__loadView();
    }

}