<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class AdminRatingsManagement extends CI_Controller {
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
           
        $this->_data['results'] = $this->comman_model->get('rating',$where);
        $total = $this->comman_model->get_total('rating', $where);
        $per_page = 10;
        $num_links = 4;
        $uri_segment = 3;

        $this->_data['pagination'] = paginate(base_url() . 'admin/ratings/', $total, $per_page, $num_links, $uri_segment);
        
        $this->_data['page'] = "index";
        $this->_data['view_path'] = 'admin/ratings/index';

        $this->__loadView();
    }



      function edit() {
        $id = decode_uri($this->uri->segment(5));
        $result = $this->comman_model->get('rating',array('id' => $id));
        if($result){
          if ($this->input->server('REQUEST_METHOD') === 'POST'){
              $data =   array(
                'no_stars' => $this->input->post('no_stars'),
                'comments' => $this->input->post('comments'),
				'date_modified' => date("Y-m-d H:i:s")
              );
              
              $is_saved = $this->comman_model->update('rating',array('id' => $id),$data);  
              if($is_saved){
                $this->session->set_flashdata('success','rating update successfully');
              } else {
                $this->session->set_flashdata('errors','Sorry ! rating not updated');
              }
              redirect('admin/ratings');
          } else {
            $this->_data['result'] = $result[0];
            $this->_data['page'] = "edit";
            $this->_data['view_path'] = 'admin/ratings/edit';
            $this->__loadView();
          }
      }else{
        $this->session->set_flashdata('errors','Sorry ! rating not saved');
        redirect('admin/ratings');
      }
    }
    function delete()
    {

        $coupan_id = decode_uri($this->uri->segment(5));
        $where = array('id' => $coupan_id);
        $deleted = $this->comman_model->delete('rating', $where);
        if ($deleted) {
            $this->session->set_flashdata('success', 'Rating Deleted Successfully.');
        } else {
            $this->session->set_flashdata('errors', 'Requested rating not found, please try later !');
        }
        redirect('admin/ratings');
    }


}