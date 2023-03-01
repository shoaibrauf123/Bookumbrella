<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class AdminSettingsManagement extends CI_Controller
{
    private $_data;
    private $data;

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('upload_helper');
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

//        check_is_login(0);

        $this->_data['view_path'] = 'admin/settings/index';
        $this->_data['page'] = 'settings';

        if ($this->input->server('REQUEST_METHOD') === 'POST') {

            $settingsForValidation = $this->comman_model->get('setting');

            /* Form Validation for Dynamic Fields */
//            foreach($settingsForValidation as $eachSetting){
//                $this->form_validation->set_rules($eachSetting['slug'], ucwords(slugToTitle($eachSetting['slug'])), 'trim|required');
//            }

            $settingsPostData = $_POST;
            $isUpdated = 0;

            if (count($_FILES) > 0) {

                foreach ($_FILES as $field_name => $field_data) {

                    if (isset($_FILES[$field_name]['name']) && $_FILES[$field_name]['name'] != "") {

                        $settings_img = upload_image($field_name, 'uploads/settings_gallery');

                        if (isset($settings_img['error'])) {
                            $this->_data['errors'] = $settings_img['error'];
                        } else {
                            $settingsPostData = array_merge($settingsPostData, array(
                                $field_name => $settings_img['file_name']
                            ));
                        }
                    }
                }
            }

            if (!isset($this->_data['errors'])) {

                foreach ($settingsPostData as $settingName => $setting) {

                    $where = array('slug' => $settingName);
                    $settings = array(
                        'value' => $setting
                    );

                    $this->comman_model->update('setting', $where, $settings);
                    $isUpdated = 1;
                }

                if ($isUpdated) {
                    $this->_data['success'] = 'Settings Successfully updated';
                } else {
                    $this->_data['errors'] = 'An Error occurred while updating information. Try again !';
                }
            }

        }

        $layouts_data = $this->comman_model->get('layouts');
        $this->_data['layouts'] = $layouts_data;

        $this->__loadView();
    }

}