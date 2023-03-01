<?php
if (!function_exists('do_email')) {
    function do_email($to, $from, $subject, $message)
    {
        $config = array(
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'wordwrap' => TRUE
        );
        $CI = &get_instance();
        $CI->load->library('Email', $config);
        $headers = 'From: ' . $from . "\r\n";
        $headers .= 'X-Mailer: PHP/' . phpversion();
        $headers  = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=utf-8\r\n";
         
        //$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
        if (mail($to, $subject, $message, $headers)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}
?>