<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class purchase_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function query($query)
    {
        $row = $this->db->query($query);

        if ($row->num_rows() > 0)
            return $row->result_array();

        return 0;
    }

    function save($table,$data){
        $this->db->insert($table, $data);
        if ($this->db->insert_id() > 0){
            return $this->db->insert_id();
        } else{
            return FALSE;
        }
    }
    function save_batch($table,$data){
        $this->db->insert_batch($table, $data);
        if ($this->db->insert_id() > 0){
            return TRUE;
        } else{
            return FALSE;
        }
    }

    function get_total($table,$where = false,$group_by = false) {
        
        $this->db->select()->from($table);
        if($where){
            $this->db->where($where);
        }
			if($group_by){
			
			
			foreach ($group_by as $key =>$val) 
            
			    $this->db->group_by($key);
			}
            
  		
        $query = $this->db->get();
        if($query->num_rows() > 0)
            return $query->num_rows();

        return 0;
    }

    function get($table,$where = false,$fields = '*',$order=false)
    {
        $this->db->select($fields)->from($table);

        if($where){
            $this->db->where($where);
        }

        if($order){
            foreach ($order as $key => $value) {
                $this->db->order_by($key,$value);
            }
        }
        
        $query = $this->db->get();
		//if($group_by)
        //{echo $this->db->last_query();die;}
		if($query->num_rows() > 0)
           
		   
		    return $query->result_array();

        return 0;
    }


    function getgrouped_orders($table,$where = false,$fields = '*',$order=false,$group_by=false)
    {
        $this->db->select($fields)->from($table);

        if($where){
            $this->db->where($where);
        }

        if($order){
            foreach ($order as $key => $value) {
                $this->db->order_by($key,$value);
            }
        }
        if($group_by){
			
			//$this->db->group_by($group_by);
			
			foreach ($group_by as $key =>$val) {
            
			    $this->db->group_by($key);
			}
            
  
  
			
			}
        $query = $this->db->get();
		//if($group_by)
        //echo $this->db->last_query();die;
		if($query->num_rows() > 0)
           
		   
		    return $query->result_array();

        return 0;
    }


 function getLike($table,$title = '',$fields = '*',$order=false)
    {
        $this->db->select($fields)->from($table);

   
if($title){
          $this->db->like('title',$title);
       }


        if($order){
            foreach ($order as $key => $value) {
                $this->db->order_by($key,$value);
            }
        }
        
        $query = $this->db->get();
        //echo $this->db->last_query();die;
		if($query->num_rows() > 0)
           
		   
		    return $query->result_array();

        return 0;
    }





    function get_all_limited($table,$per_page=10, $start_from=0,$where = false,$fields = '*',$order=false,$group_by=false) {
       $this->db->select($fields)->from($table);
       if($where){
            $this->db->where($where);
       }
       if($order){
            foreach ($order as $key => $value) {
                $this->db->order_by($key,$value);
            }
        }
      if($group_by){
			
			
			foreach ($group_by as $key =>$val) 
            
			    $this->db->group_by($key);
			}
             
       $query = $this->db->limit($per_page, $start_from)->get();
           //echo $this->db->last_query();die;

       if($query->num_rows() > 0)
            return $query->result_array();
       return false;
    }

    function update($table,$where,$data){
        $this->db->update($table, $data, $where);
             //echo $this->db->last_query();die;

        if ($this->db->affected_rows() == 1){
            return true;
        } else {
            return false;
        }
    }

    function delete($table,$where){
    	$this->db->where($where)->delete($table);
        //echo $this->db->last_query();die;
        if ($this->db->affected_rows()==1)
            return TRUE;
        return FALSE;
    }
    
    function print_value($table,$where,$field){
       $query = $this->db->select($field)->from($table)->where($where)->get();
        if($query->num_rows() > 0){
            $results = $query->result_array();
            return $results[0][$field];
        }
        return false; 
    }

    function getNetworkId($arg){

        if(isset($arg['cat_id'])){
            $this->db->select('network_id');
            $this->db->from('category');
            $this->db->where(array('category_id'=>$arg['cat_id']));
        }

        if(isset($arg['product_id'])){
            $this->db->select('c.network_id');
            $this->db->from('category c');
            $this->db->join('products p ','c.category_id = p.category_id','inner');
            $this->db->where(array('p.product_id'=>$arg['product_id']));
        }

        if(isset($arg['store_id'])){
            $this->db->select('network_id');
            $this->db->from('store');
            $this->db->where(array('store_id'=>$arg['store_id']));
        }

        $query  = $this->db->get();
        $result = $query->result_array();

        if ($result) {
            $result = $result[0]['network_id'];
            return $result;
        } else {
            return 0;
        }
    }

    function getPopularStores(){

        $query = "SELECT s.name, s.image_url, s.short_description, s.store_id FROM store s
            inner join cashback c
            on c.resource_id = s.store_id
            where c.resource_type ='store'
            GROUP BY c.resource_id
            order by SUM(c.cashback_value) desc
            limit 5
        ";

        $query_data = $this->db->query($query);
        $result = $query_data->result_array();

        if ($result) {
            return $result;
        } else {
            return 0;
        }
    }

}