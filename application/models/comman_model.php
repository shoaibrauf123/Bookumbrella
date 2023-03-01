<?php



if (!defined('BASEPATH'))

    exit('No direct script access allowed');



class comman_model extends CI_Model {



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

         if($table == "products"){
            $this->db->where("month_of_the_book",1);
            $this->db->update($table,["month_of_the_book"=>0]);
        }


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



    function get_total($table,$where = false) {

        

        $this->db->select()->from($table);

        if($where){

            $this->db->where($where);

        }

        $query = $this->db->get();

        if($query->num_rows() > 0)

            return $query->num_rows();



        return 0;

    }

    function get2($table,$where = false,$or_where = false,$fields = '*',$order=false)

    {

        $this->db->select($fields)->from($table);



        if($where){

            $this->db->where($where);

        }

		if($or_where){

            $this->db->or_like($or_where);

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
	
	
function MainMessages($table,$options = array())

    {
		
        $query = "SELECT * FROM messages where parent_id = 0 AND (user_id_to = ".$options['user_id_to']." OR user_id_from = ".$options['user_id_from'].")";



        $query_data = $this->db->query($query);

        $result = $query_data->result_array();



        if ($result) {

            return $result;

        } else {

            return 0;

        }

		
    }
	
	
	
    function get($table,$where = false,$fields = '*',$order=false)

    {
       
        $this->db->select($fields)->from($table);
        /*if($table == "user"){
            $this->db->join("store","store.user_id = user.user_id");
        }*/


        if($where){

            $this->db->where($where);

        }



        if($order){

            foreach ($order as $key => $value) {

                $this->db->order_by($key,$value);

            }

        }

        

        $query = $this->db->get();

		if($query->num_rows() > 0)

           

		   

		    return $query->result_array();



        return 0;

    }
    public function getStore($table,$user_id){
        $this->db->select("*");
        $this->db->from($table);
        $this->db->where("store.user_id",$user_id);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }
    }
    function get_sellers($table,$where = false,$type = false,$condition = false,$fields = '*',$order=false)

    {

        $this->db->select($fields)->from($table);



        if($where){

            $this->db->where($where);

        }
        if($type){
            $this->db->where_in('book_type',$type);
        }
        if($condition){
            $this->db->where_in('book_condition',$condition);
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

    function get_all_limited($table,$per_page=10, $start_from=0,$where = false,$order=false) {


        //echo "<pre>";print_r($where);die;
       $this->db->select("*")->from($table);
       if($table == "store"){
            $this->db->join("user","store.user_id = user.user_id");
            //$this->db->where("store.status = 1");
       }


       if(!empty($where)){
            $this->db->where($where);
       }

       if($order){

            foreach ($order as $key => $value) {

                $this->db->order_by($key,$value);

            }

        }

       

       $query = $this->db->limit($per_page, $start_from)->get();

           //echo $this->db->last_query();die;



       if($query->num_rows() > 0)

            return $query->result_array();

       return false;

    }

    



    function update($table,$where,$data){

    if($table == "products"){    
            $this->db->where("month_of_the_book",1);
            $this->db->update($table,["month_of_the_book"=>0]);
    }



		$this->db->update($table, $data, $where);

          



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



        $query = "SELECT * FROM store limit 5";



        $query_data = $this->db->query($query);

        $result = $query_data->result_array();



        if ($result) {

            return $result;

        } else {

            return 0;

        }

    }



    function getSellersCountries($id){

        $this->db->select('country')->from('seller_products');

        //$this->db->join('user as u','u.user_id = sp.user_id');

        $this->db->where(array('product_id'=>$id));

        $this->db->group_by('country');

        $query = $this->db->get();

        // echo $this->db->last_query();exit;

        if($query->num_rows() > 0)

            return $query->result_array();

        return false;

    }
function CheckProductAvailable($isbn){
    $query = "SELECT * FROM products 
         WHERE isbn = '".$isbn."' OR  isbn13 = '".$isbn."'";



    $query = $this->db->query($query);

  // echo $this->db->last_query();die;



    if($query->num_rows() > 0)

        return $query->result_array();

    return 'nothing';


}
function getRecentinserted($table,$inserted_ids){
	
	 $query = "SELECT * FROM ".$table." 
         WHERE cart_table_id IN (".$inserted_ids.") order by seller_id ASC";



        $query_data = $this->db->query($query);

        $result = $query_data->result_array();



        if ($result) {

            return $result;

        } else {

            return 0;

        }
		
		
		
	
	}
	
	
function getSellerTotalProducts($table,$inserted_ids,$seller_id){
	
	 $query = "SELECT * FROM ".$table." 
         WHERE cart_table_id IN (".$inserted_ids.") AND seller_id =".$seller_id."";



        $query_data = $this->db->query($query);

    



      return $query_data->num_rows();
		
		
		
	
	}
function deleteRecentinserted($table,$inserted_ids){
	
	 $query = "delete FROM ".$table." 
         WHERE cart_table_id IN (".$inserted_ids.")";


        $query_data = $this->db->query($query);
	
	}


		
}