<?php

if (!function_exists('get_pages'))
{
    function get_pages() 
    {
        $CI = & get_instance();
		$query = $CI->db->select()->from('pages')
		         ->where('status','1')
				 ->where('is_deleted','0')->get();
		if($query->num_rows() > 0)
		return $query->result_array();		 
	}
}