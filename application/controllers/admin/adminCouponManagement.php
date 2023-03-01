<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class AdminCouponManagement extends CI_Controller {
    private $_data;
    public function __construct() {
        parent::__construct();
        check_is_login(20);
    }
    private function __loadView() {
        if ($this->session->flashdata('success')!="")
            $this->_data['success'] = $this->session->flashdata ('success');
        if ($this->session->flashdata('errors')!="")
            $this->_data['errors'] = $this->session->flashdata ('errors');

        $this->load->view('admin/admin_template', $this->_data);
    }

    function index() {
        $where=FALSE;
           
        $this->_data['results'] = $this->comman_model->get('coupon',$where);
        $total = $this->comman_model->get_total('coupon', $where);
        $per_page = 10;
        $num_links = 4;
        $uri_segment = 3;

        $this->_data['pagination'] = paginate(base_url() . 'admin/coupon/', $total, $per_page, $num_links, $uri_segment);
        
        $this->_data['page'] = "index";
        $this->_data['view_path'] = 'admin/coupon/index';

        $this->__loadView();
    }

      function create() {
        
        if ($this->input->server('REQUEST_METHOD') === 'POST'){
            $data =   array(
              'coupon' => $this->input->post('coupon'),
              'percentage' => $this->input->post('percentage')
            );
            
            $is_saved = $this->comman_model->save('coupon',$data);  
            if($is_saved){
              $this->session->set_flashdata('success','coupon saved successfully');
            } else {
              $this->session->set_flashdata('errors','Sorry ! coupon not saved');
            }
            redirect('admin/coupon');
        } else {
          $this->_data['page'] = "create";
          $this->_data['view_path'] = 'admin/coupon/add';
          $this->__loadView();
        }
    }

      function edit() {
        $id = decode_uri($this->uri->segment(5));
        $result = $this->comman_model->get('coupon',array('coupon_id' => $id));
        if($result){
          if ($this->input->server('REQUEST_METHOD') === 'POST'){
              $data =   array(
                'coupon' => $this->input->post('coupon'),
                'percentage' => $this->input->post('percentage')
              );
              
              $is_saved = $this->comman_model->update('coupon',array('coupon_id' => $id),$data);  
              if($is_saved){
                $this->session->set_flashdata('success','coupon update successfully');
              } else {
                $this->session->set_flashdata('errors','Sorry ! coupon not updated');
              }
              redirect('admin/coupon');
          } else {
            $this->_data['result'] = $result[0];
            $this->_data['page'] = "edit";
            $this->_data['view_path'] = 'admin/coupon/edit';
            $this->__loadView();
          }
      }else{
        $this->session->set_flashdata('errors','Sorry ! coupan not saved');
        redirect('admin/coupan');
      }
    }
    function delete()
    {

        $coupan_id = decode_uri($this->uri->segment(5));
        $where = array('coupon_id' => $coupan_id);
        $deleted = $this->comman_model->delete('coupon', $where);
        if ($deleted) {
            $this->session->set_flashdata('success', 'Coupon Deleted Successfully.');
        } else {
            $this->session->set_flashdata('errors', 'Requested coupon not found, please try later !');
        }
        redirect('admin/coupon');
    }


}