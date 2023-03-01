<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Favourite_model extends CI_Model {
 
    public function __construct() {
        parent::__construct();
    }
    public function get_my_favourites($per_page,$start_from,$order=FALSE){
         $this->db->select();
                $this->db->from('favorites as f');
                $this->db->join('user as u','u.user_id=f.user_id');
                $this->db->join('store as s','f.store_id=s.store_id');
                $this->db->where('f.user_id',$this->session->userdata('user_id'));
                if($order){
                        foreach ($order as $key => $value) {
                             $this->db->order_by($key,$value);
                        }
                 }
                $query = $this->db->limit($per_page, $start_from); 
                //echo $this->db->last_query();die;
               $query =  $this->db->get();
        //echo $query->num_rows();die('sfas');
      if($query->num_rows()> 0)
           return $query->result_array();
       else 
           return 0;
    }
    
   public function is_store_exist($id){
       $query = $this->db->select()->from('store')->where('store_id',$id)->get();
             if($query->num_rows()>0)
                 return true;
             else 
                 return false;
   } 
}