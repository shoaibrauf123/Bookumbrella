<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Stores extends CI_Controller
{
    private $_data;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('comman_model');
		if($this->session->userdata('admin_role_id')){
			redirect('admin');
			}

    }

    private function __loadView()
    {
        if ($this->session->flashdata('success') != "")
            $this->_data['success'] = $this->session->flashdata('success');
        if ($this->session->flashdata('errors') != "")
            $this->_data['errors'] = $this->session->flashdata('errors');

        $this->load->view('frontend/home_template', $this->_data);
    }

    function table_name()
    {
        return 'store';
    }

    function index()
    {
        $where = array();
        $search = $this->input->get('search');
        if($search !=''){
         $s = '%'.$search.'%';
        $where['name like'] = $s;
        }
        
        $alpha_search = $this->input->get('alpha_search');
        if($alpha_search !=''){
         if($alpha_search=='0-9'){
             $where['name REGEXP'] = '[0-9]';
         } else if($alpha_search=='All'){
            // $where['name like'] = '';
         } else {
          $alphabit = $alpha_search.'%';
          $where['name like'] = $alphabit;
        }
        
         }
        $where['store.status'] = 1;
        
       $start_from = $this->input->get('per_page');
        if (!is_numeric($start_from))
            $start_from = 0;

        //show number of product on page
        $per_page = $this->input->get('count');
        if (!is_numeric($per_page))
            $per_page = 15;
        if ($this->input->get('sort_by') != '') {
            $sort_by = $this->input->get('sort_by');
            if ($sort_by == 'name_desc') {
                $order = array('name' => 'DESC');
            } else if ($sort_by == 'name_asc') {

                $order = array('name' => 'ASC');
            }
        } else {
            $order = FALSE;
        }

       //print_r($where);die;
        $get = $_GET;
        unset($get['per_page']);

        $suffix = '&' . http_build_query($get, '', "&");
        $config['page_query_string'] = TRUE;
        $config['base_url'] = base_url('stores') . '?';
        $config['suffix'] = $suffix;
        $config['first_url'] = base_url('stores') . '?' . $suffix;
        $config['total_rows'] = $this->comman_model->get_total($this->table_name(), $where);

        $this->_data['total'] = $config['total_rows'];
        $config['per_page'] = $per_page;
        $config['anchor_class'] = 'class="btn btn-primary width_auto"';
        $config['uri_segment'] = 3;
        $config['cur_tag_open'] = '&nbsp;<a class="btn btn-primary width_auto active">';
        $config['cur_tag_close'] = '</a>';

        $this->pagination->initialize($config);

        $this->_data['pagination'] = $this->pagination->create_links();
        $this->_data['store_data'] = $this->comman_model->get_all_limited($this->table_name(), $per_page, $start_from, $where, $order);
        
        $this->_data['main_content'] = 'frontend/stores/listing';

        $this->__loadView();
    }

    function storeLinkRedirect()
    {

        $store_id = decode_uri($this->uri->segment(3));
        $storeData = get('store', array('store_id' => $store_id));

        if ($storeData) {

            $storeData = $storeData[0];
            $clicking_user_id = getCurrentUserId();
            $clicking_user_id = $clicking_user_id ? $clicking_user_id : getSuperAdminId();

            $exit_click = $this->comman_model->save('exit_click',
                array(
                    'redirect_link' => $storeData['store_link_url'],
                    'user_id' => $clicking_user_id,
                    'ip_address' => get_client_ip(),
                )
            );

            if ($exit_click) {
                $this->comman_model->save('cashback',
                    array(
                        'user_id' => $clicking_user_id,
                        'network_id' => $storeData['network_id'],
                        'cashback_value' => getCashBackValue(array('network_id' => $storeData['network_id'])),
                        'exit_click_id' => $exit_click,
                        'updated_status' => 'Pending',
                        'resource_id' => $storeData['store_id'],
                        'resource_type' => 'store',
                    )
                );
            }

            $this->_data['footer_text_content'] = 'Forwarding to Store\'s website...';
            $this->_data['redirect_url'] = $storeData['store_link_url'];

            $this->_data['main_content'] = 'frontend/pages/innostartRedirect';
            $this->load->view('frontend/blank_template', $this->_data);

        } else {
            redirect(base_url());
        }
    }
}