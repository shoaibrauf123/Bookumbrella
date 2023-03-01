<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('upload_video')) {
    function upload_video($input_name, $path = "default_bio_video_path")
    {
        if ($path == "default_bio_video_path")
            $config['upload_path'] = FCPATH . '/uploads/videos/';
        else
            $config['upload_path'] = $path;
        $config['allowed_types'] = 'flv|mp4|3gp';
        $config['max_size'] = '25600';
        $config['max_filename'] = '255';
        $config['remove_spaces'] = TRUE;
        $config['overwrite'] = FALSE;
        $CI = &get_instance();
        $CI->load->library('upload');
        $CI->upload->initialize($config);
        if (!$CI->upload->do_upload($input_name)) {
            return array('error' => $CI->upload->display_errors());
        } else {
            return $CI->upload->data();
        }
    }
}

if (!function_exists('upload_document')) {
    function upload_document($input_name, $path = "default_bio_video_path", $output_name = "document")
    {
        if ($path == "default_bio_video_path")
            $config['upload_path'] = FCPATH . '/uploads/videos/';
        else
            $config['upload_path'] = $path;
        $config['allowed_types'] = 'txt|pdf|docx|doc';
        $config['file_name'] = $output_name;
        $config['max_size'] = '25600';
        $config['max_filename'] = '255';
        $config['remove_spaces'] = TRUE;
        $config['overwrite'] = FALSE;
        $CI = &get_instance();
        $CI->load->library('upload');
        $CI->upload->initialize($config);
        if (!$CI->upload->do_upload($input_name)) {
            return array('error' => $CI->upload->display_errors());
        } else {
            return $CI->upload->data();
        }
    }
}

if (!function_exists('upload_image')) {
    function upload_image($input_name, $path)
    {

        if(!file_exists($path)){
            mkdir($path,0777,true);
        }

        $config['upload_path'] = $path;
        $config['allowed_types'] = 'ico|jpg|png|gif|jpeg';
        $config['max_size'] = '50600';
        $config['max_filename'] = '255';
        $config['file_name'] = time();
        $config['remove_spaces'] = TRUE;
        $config['overwrite'] = TRUE;
        $CI = &get_instance();
        $CI->load->library('upload');
        $CI->upload->initialize($config);

        if (!$CI->upload->do_upload($input_name)) {
            return array('error' => $CI->upload->display_errors());
        } else {
            return $CI->upload->data();
        }
    }
}

if (!function_exists('upload_multi_image')) {
    function upload_multi_image($input_name, $path)
    {
        $config['upload_path'] = $path;
        $config['allowed_types'] = 'jpg|png|gif|jpeg';
        $config['max_size'] = '50600';
        $config['max_filename'] = '255';
        $config['file_name'] = time();
        $config['remove_spaces'] = TRUE;
        $config['overwrite'] = TRUE;
        $CI = &get_instance();
        $CI->load->library('upload');
        $CI->upload->initialize($config);

        if (!$CI->upload->do_upload($input_name)) {
            return array('error' => $CI->upload->display_errors());
        } else {
            return $CI->upload->data();
        }
    }
}


if (!function_exists('resize_image')) {
    function resize_image($upload_data, $thumb_size = array(array(300, 225)))
    {
        $CI = &get_instance();
        $CI->load->library('image_lib');

        $i = 0;
        foreach ($thumb_size as $dimentions) {
            $config['image_library'] = 'gd2';
            $config['source_image'] = $upload_data['full_path'];
            $config['maintain_ratio'] = FALSE;
            $config['new_image'] = $upload_data['file_path'] . $upload_data['raw_name'] . '_' . $dimentions[0] . 'x' . $dimentions[1] . $upload_data['file_ext'];
            $config['width'] = $dimentions[0];
            $config['height'] = $dimentions[1];
            $CI->image_lib->initialize($config);
            $CI->image_lib->resize();
            $CI->image_lib->clear();
            $upload_data["thumb_$i"] = $upload_data['raw_name'] . '_' . $dimentions[0] . 'x' . $dimentions[1] . $upload_data['file_ext'];
            ++$i;
        }
        if ($i != 0) {
            return $upload_data;
        } else {
            return array('error' => $CI->image_lib->display_errors());
        }
    }
}

?>
