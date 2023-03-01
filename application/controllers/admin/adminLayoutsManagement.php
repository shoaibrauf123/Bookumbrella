<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class AdminLayoutsManagement extends CI_Controller
{

    private $_data;

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('upload_helper');
        check_is_login(13);
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

        $where = array('id  !=' => 0);
        $total = $this->comman_model->get_total('layouts', $where);
        $per_page = 10;
        $num_links = 4;
        $uri_segment = 3;

        $this->_data['pagination'] = paginate(base_url() . 'admin/layouts/', $total, $per_page, $num_links, $uri_segment);
        $this->_data['results'] = $this->comman_model->get_all_limited('layouts', $per_page, $start_from, $where);
        $this->_data['page'] = "index";
        $this->_data['view_path'] = 'admin/layouts/index';

        $this->__loadView();
    }

    function add()
    {
        check_is_login(12);
        $this->_data['view_path'] = "admin/layouts/add";
        $this->_data['page'] = "add";

        if ($this->input->server('REQUEST_METHOD') === 'POST') {

            $this->form_validation->set_rules('title', 'Layout Title', 'trim|required');
            $this->form_validation->set_rules('main_color', 'Main Color', 'trim|required');
            $this->form_validation->set_rules('secondary_color', 'Secondary Color', 'trim|required');
            $this->form_validation->set_rules('hover_color', 'Hover Color', 'trim|required');
            $this->form_validation->set_rules('static_color', 'Static Color', 'trim|required');
            $this->form_validation->set_rules('main_bg_color', 'Main Background Color', 'trim|required');
            $this->form_validation->set_rules('secondary_bg_color', 'Secondary Background Color', 'trim|required');
            $this->form_validation->set_rules('main_border_color', 'Main Border Color', 'trim|required');
            $this->form_validation->set_rules('secondary_border_color', 'Secondary Border Color', 'trim|required');
            $this->form_validation->set_rules('btn_bg_color', 'Button Background Color', 'trim|required');
            $this->form_validation->set_rules('btn_hover_color', 'Button Hover Color', 'trim|required');
            $this->form_validation->set_rules('header_top_text_color', 'Header Top Text Color', 'trim|required');
            $this->form_validation->set_rules('header_top_lnks_color', 'Header Top Links Color', 'trim|required');
            $this->form_validation->set_rules('header_menu_link_text_color', 'Header Menu Link Text Color', 'trim|required');
            $this->form_validation->set_rules('content_text_color', 'Content Text Color', 'trim|required');
            $this->form_validation->set_rules('content_head_text_color', 'Content Head Text Color', 'trim|required');
            $this->form_validation->set_rules('content_bolded_text_color', 'Content Bolded Text Color', 'trim|required');
            $this->form_validation->set_rules('content_link_color', 'Content Link Text Color', 'trim|required');
            $this->form_validation->set_rules('footer_navigation_links_color', 'Footer Navigation Links Color', 'trim|required');
            $this->form_validation->set_rules('footer_text_color', 'Footer Text Color', 'trim|required');
            $this->form_validation->set_rules('footer_head_text_color', 'Footer Head Text Color', 'trim|required');
            $this->form_validation->set_rules('footer_bottom_text_color', 'Footer Bottom Text Color', 'trim|required');
            $this->form_validation->set_rules('footer_bottom_links_color', 'Footer Bottom Link Color', 'trim|required');

            if ($this->form_validation->run() !== FALSE) {
                $layoutsData = array();

                if (count($_FILES) > 0) {

                    foreach ($_FILES as $field_name => $field_data) {

                        if (isset($_FILES[$field_name]['name']) && $_FILES[$field_name]['name'] != "") {

                            $layout_img = upload_image($field_name, 'uploads/layout_gallery');

                            if (isset($layout_img['error'])) {
                                $this->_data['errors'] = $layout_img['error'];
                            } else {
                                $layoutsData = array_merge($layoutsData, array(
                                    $field_name => $layout_img['file_name']
                                ));
                            }
                        }
                    }
                }

                $layoutsData = array_merge($layoutsData, array(
                    'title' => $this->input->post('title'),
                    'slug' => create_slug($this->input->post('title')),
                    'main_color' => $this->input->post('main_color'),
                    'secondary_color' => $this->input->post('secondary_color'),
                    'hover_color' => $this->input->post('hover_color'),
                    'static_color' => $this->input->post('static_color'),
                    'main_bg_color' => $this->input->post('main_bg_color'),
                    'secondary_bg_color' => $this->input->post('secondary_bg_color'),
                    'main_border_color' => $this->input->post('main_border_color'),
                    'secondary_border_color' => $this->input->post('secondary_border_color'),
                    'btn_bg_color' => $this->input->post('btn_bg_color'),
                    'btn_hover_color' => $this->input->post('btn_hover_color'),
                    'header_top_text_color' => $this->input->post('header_top_text_color'),
                    'header_top_lnks_color' => $this->input->post('header_top_lnks_color'),
                    'header_menu_link_text_color' => $this->input->post('header_menu_link_text_color'),
                    'content_text_color' => $this->input->post('content_text_color'),
                    'content_head_text_color' => $this->input->post('content_head_text_color'),
                    'content_bolded_text_color' => $this->input->post('content_bolded_text_color'),
                    'content_link_color' => $this->input->post('content_link_color'),
                    'footer_text_color' => $this->input->post('footer_text_color'),
                    'footer_navigation_links_color' => $this->input->post('footer_navigation_links_color'),
                    'footer_head_text_color' => $this->input->post('footer_head_text_color'),
                    'footer_bottom_text_color' => $this->input->post('footer_bottom_text_color'),
                    'footer_bottom_links_color' => $this->input->post('footer_bottom_links_color'),
                    'created_by' => getCurrentUserId()
                ));

                $saved = $this->comman_model->save('layouts', $layoutsData);
                if ($saved) {
                    $this->session->set_flashdata('success', 'Layout Created successfully.');
                    redirect('admin/layouts');
                } else {
                    $this->_data['errors'] = 'Unable to save page. Review information and try again !';
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

        $this->_data['view_path'] = "admin/layouts/edit";
        $this->_data['page'] = "edit";
        $layout_data = $this->comman_model->get('layouts', array('id' => $id));

        if (!$layout_data) {
            $this->_data['errors'] = 'An error occurred, try later';
            redirect('admin/layouts/' . $this->uri->segment(4));
        } else {
            $this->_data['layout_data'] = $layout_data[0];
        }

        if ($this->input->server('REQUEST_METHOD') === 'POST') {

            $this->form_validation->set_rules('title', 'Layout Title', 'trim|required');
            $this->form_validation->set_rules('main_color', 'Main Color', 'trim|required');
            $this->form_validation->set_rules('secondary_color', 'Secondary Color', 'trim|required');
            $this->form_validation->set_rules('hover_color', 'Hover Color', 'trim|required');
            $this->form_validation->set_rules('static_color', 'Static Color', 'trim|required');
            $this->form_validation->set_rules('main_bg_color', 'Main Background Color', 'trim|required');
            $this->form_validation->set_rules('secondary_bg_color', 'Secondary Background Color', 'trim|required');
            $this->form_validation->set_rules('main_border_color', 'Main Border Color', 'trim|required');
            $this->form_validation->set_rules('secondary_border_color', 'Secondary Border Color', 'trim|required');
            $this->form_validation->set_rules('btn_bg_color', 'Button Background Color', 'trim|required');
            $this->form_validation->set_rules('btn_hover_color', 'Button Hover Color', 'trim|required');
            $this->form_validation->set_rules('header_top_text_color', 'Header Top Text Color', 'trim|required');
            $this->form_validation->set_rules('header_top_lnks_color', 'Header Top Links Color', 'trim|required');
            $this->form_validation->set_rules('header_menu_link_text_color', 'Header Menu Link Text Color', 'trim|required');
            $this->form_validation->set_rules('content_text_color', 'Content Text Color', 'trim|required');
            $this->form_validation->set_rules('content_head_text_color', 'Content Head Text Color', 'trim|required');
            $this->form_validation->set_rules('content_bolded_text_color', 'Content Bolded Text Color', 'trim|required');
            $this->form_validation->set_rules('content_link_color', 'Content Link Text Color', 'trim|required');
            $this->form_validation->set_rules('footer_navigation_links_color', 'Footer Navigation Links Color', 'trim|required');
            $this->form_validation->set_rules('footer_text_color', 'Footer Text Color', 'trim|required');
            $this->form_validation->set_rules('footer_head_text_color', 'Footer Head Text Color', 'trim|required');
            $this->form_validation->set_rules('footer_bottom_text_color', 'Footer Bottom Text Color', 'trim|required');
            $this->form_validation->set_rules('footer_bottom_links_color', 'Footer Bottom Link Color', 'trim|required');

            if ($this->form_validation->run() !== FALSE) {
                $layoutsData = array();

                if (count($_FILES) > 0) {

                    foreach ($_FILES as $field_name => $field_data) {

                        if (isset($_FILES[$field_name]['name']) && $_FILES[$field_name]['name'] != "") {

                            $layout_img = upload_image($field_name, 'uploads/layout_gallery');

                            if (isset($layout_img['error'])) {
                                $this->_data['errors'] = $layout_img['error'];
                            } else {
                                $layoutsData = array_merge($layoutsData, array(
                                    $field_name => $layout_img['file_name']
                                ));
                            }
                        }
                    }
                }

                $where = array('id' => $id);

                $layoutsData = array_merge($layoutsData,array(
                    'title' => $this->input->post('title'),
                    'slug' => create_slug($this->input->post('title')),
                    'main_color' => $this->input->post('main_color'),
                    'secondary_color' => $this->input->post('secondary_color'),
                    'hover_color' => $this->input->post('hover_color'),
                    'static_color' => $this->input->post('static_color'),
                    'main_bg_color' => $this->input->post('main_bg_color'),
                    'secondary_bg_color' => $this->input->post('secondary_bg_color'),
                    'main_border_color' => $this->input->post('main_border_color'),
                    'secondary_border_color' => $this->input->post('secondary_border_color'),
                    'btn_bg_color' => $this->input->post('btn_bg_color'),
                    'btn_hover_color' => $this->input->post('btn_hover_color'),
                    'header_top_text_color' => $this->input->post('header_top_text_color'),
                    'header_top_lnks_color' => $this->input->post('header_top_lnks_color'),
                    'header_menu_link_text_color' => $this->input->post('header_menu_link_text_color'),
                    'content_text_color' => $this->input->post('content_text_color'),
                    'content_head_text_color' => $this->input->post('content_head_text_color'),
                    'content_bolded_text_color' => $this->input->post('content_bolded_text_color'),
                    'content_link_color' => $this->input->post('content_link_color'),
                    'footer_text_color' => $this->input->post('footer_text_color'),
                    'footer_navigation_links_color' => $this->input->post('footer_navigation_links_color'),
                    'footer_head_text_color' => $this->input->post('footer_head_text_color'),
                    'footer_bottom_text_color' => $this->input->post('footer_bottom_text_color'),
                    'footer_bottom_links_color' => $this->input->post('footer_bottom_links_color'),
                    'date_updated' => date('Y-m-d H:i:s')
                ));
                $updated = $this->comman_model->update('layouts', $where, $layoutsData);
                if ($updated) {
                    $this->session->set_flashdata('success', 'Layout Updated successfully.');
                    redirect('admin/layouts/' . $this->uri->segment(4));
                } else {
                    $this->_data['errors'] = 'An error occurred, try later';
                }
            } else {
                $this->_data['errors'] = validation_errors();
            }
        }

        $this->__loadView();
    }

    function delete()
    {

        $id = decode_uri($this->uri->segment(5));
        $where = array('id' => $id);
        $deleted = $this->comman_model->delete('layouts', $where);

        if ($deleted) {
            $this->session->set_flashdata('success', 'Layout Deleted Successfully.');
        } else {
            $this->session->set_flashdata('errors', 'Requested layout  not found, please try later !');
        }
        redirect('admin/layouts/' . $this->uri->segment(4));
    }
}