<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Search_model extends CI_Model {
 
    public function __construct() {
        parent::__construct();
    }
    public function searching($search_data){
       $query =  $this->db->select()
                ->from('store as s')
                ->like('s.name',$search_data)
                ->where('s.status',1)
                ->get();
      if($query->num_rows()> 0)
           return $query->result_array();
       else 
           return 0;
    }
    
    public function searching_total($search_data){
       $query =  $this->db->select()
                ->from('store as s')
                ->like('s.name',$search_data)
                ->where('s.status',1)
                ->get();
      if($query->num_rows()> 0)
           return $query->num_rows();
       else 
           return 0;
    }
    
     public function searching_limited($search_data,$per_page=10, $start_from=0,$where = false,$order=false){
      
       $this->db->select()->from('store as s');
       $this->db->like('s.name',$search_data);
       $this->db->where('s.status',1);
       
        if($order){
            foreach ($order as $key => $value) {
                $this->db->order_by($key,$value);
            }
        }
      $query = $this->db->limit($per_page, $start_from)->get();
      // echo $this->db->last_query();die;
       if($query->num_rows() > 0)
            return $query->result_array();
       return false;
    }
}