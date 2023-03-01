<?php 


class Api_model extends CI_Model
{
	
	function __construct(){
         parent::__construct();
    }

    public function getCategory(){
    	$this->db->select("*");
    	$this->db->from("category");
        $this->db->order_by("category_id","desc");
    	$query = $this->db->get();
    	return $query->result();
    }
    public function getProduct(){
    	$this->db->select("*");
    	$this->db->from("products");
        $this->db->order_by("product_id","desc");
    	$query = $this->db->get();
    	return $query->result();
    }
    public function getProductDetail($id){
        $this->db->select("*");
        $this->db->from("products");
        $this->db->where("product_id",$id);
        $query = $this->db->get();
        if($query->num_rows()>0){
            return $query->row_array();
        }else{
            return false;
        }
        
    }

    public function getUserData($user_id){
        $this->db->select('*');
        $this->db->from("user");
        $this->db->where('user_id',$user_id);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->row_array();
        }else{
            return false;
        }
    }

    function updateUserProfile($table,$data, $where)
    {
        $this->db->update($table,$data, $where);
        //echo $this->db->last_query();die;
        if ($this->db->affected_rows() == 1)
            return 1;
        else if ($this->db->affected_rows() == 0)
            return 0;
        else
            return -1;
    }

    public function save($table,$data){

        if($table == "products"){
            $this->db->where("month_of_the_book",1);
            $this->db->update($table,["month_of_the_book"=>0]);
        }

        $this->db->insert($table, $data);
        if($this->db->insert_id() > 0){
            return $this->db->insert_id();
        } else{
            return FALSE;
        }

    }

    public function getRecentinserted($table,$inserted_ids){
    
        $query = "SELECT * FROM ".$table." WHERE cart_table_id IN (".$inserted_ids.") order by seller_id ASC";
        $query_data = $this->db->query($query);
        $result = $query_data->result_array();
        if ($result) {
            return $result;
        } else {
            return 0;
        }    
    }

    function get($table,$where = false,$fields = '*',$order=false){

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
        if($query->num_rows() > 0)
            return $query->result_array();
            return 0;
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

    public function productCategoryRecord(){
        $this->db->select('*');
        $this->db->from('category as cate');
        $this->db->join("products as pro","pro.category_id = cate.category_id");
        $query = $this->db->get();
        if($query->num_rows()>0){
            return $query->result();
        }else{
            return false;
        }

    }

    public function product_by_category($category_id){
        $this->db->select('*');
        $this->db->from('category as cate');
        $this->db->join("products as pro","pro.category_id = cate.category_id");
        $this->db->where("cate.category_id",$category_id);
        $query = $this->db->get();
        if($query->num_rows()>0){
            return $query->result();
        }else{
            return false;
        }
    }

    public function orderHistoryRecord(){
        $this->db->select("purchase.* , buy.first_name as buyer_first_name,buy.last_name as buyer_last_name,sel.first_name as seller_first_name,sel.last_name as seller_last_name");
        $this->db->from("purchase");
        $this->db->join("products","purchase.product_id = products.product_id");
        $this->db->join("user as buy","purchase.user_id = buy.user_id");
        $this->db->join("user as sel",'purchase.seller_id = sel.user_id');
        $this->db->join("seller_products","purchase.seller_products_id = seller_products.id");
        $this->db->join("cart_table","purchase.cart_row_id = cart_table.cart_table_id");
        $this->db->join("pm_card","purchase.card_id = pm_card.id");
        $query = $this->db->get();
        
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return false;
        }
    }
    ////////////////////////////// Book Condition //////////////////////////
    public function filter_condition($table,$data){
        /*print_r($data);die;*/
        $this->db->select("*");
        $this->db->from($table);
        if($table == "seller_products"){
            $this->db->join("products as p" , "seller_products.product_id = p.product_id");
        }
        $this->db->where_in("seller_products.book_condition",$data);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return false;
        }
    }

    ////////////////////////////// Book Type //////////////////////////////////////////

    public function book_type($table,$data){
        $this->db->select("*");
        $this->db->from($table);
        if($table == "seller_products"){
            $this->db->join("products as p" , "seller_products.product_id = p.product_id");
        }       
        $this->db->where_in("seller_products.book_type",$data);
        
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return false;
        }
    }

    ////////////////////////////////////////////// ISBN //////////////////////////////

    public function book_isbn($table,$data){

        $this->db->select('*');
        $this->db->from($table);
        if(strlen($data[0]) == 10){    
            $this->db->where_in('seller_products.isbn',$data);
        }elseif(strlen($data[0]) == 13){
           $this->db->where_in('seller_products.isbn13',$data);
        }
        if($table == "seller_products"){
            $this->db->join("products as p" , "seller_products.product_id = p.product_id");
        }
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return false;
        }
    }

    public function search($table,$or_where){
        

        $this->db->select("seller_products.*")->from($table);
        if($table == "seller_products"){
            $this->db->join("author","seller_products.author = author.id");
           // $this->db->join("products as p" , "seller_products.product_id = p.product_id");
        }

        if($or_where){
            $this->db->or_like($or_where);
        }
        
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return false;
        }
    }

    ///////////////////////////////// User Google Record /////////////////////////////////////////

    public function google_login($social_id){
        $this->db->select("*");
        $this->db->from("user");
        $this->db->where("google_id",$social_id);
        $query = $this->db->get();
        if($query){
            return $query->row_array();
        }else{
            return false;
        }
    }
    public function custom_google_login($data){
        $this->db->insert("user",$data);
        if($this->db->insert_id() > 0){
            return $this->db->insert_id();
        } else{
            return FALSE;
        }
    }
    ///////////////////////////////////////// User Facebook Record ////////////////////////////////
    public function facebook_login($social_id){
        $this->db->select("*");
        $this->db->from("user");
        $this->db->where("fb_user_id",$social_id);
        $query = $this->db->get();
        if($query){
            return $query->row_array();
        }else{
            return false;
        }
    }

    public function custom_facebook_login($data){
        $this->db->insert("user",$data);
        if($this->db->insert_id() > 0){
            return $this->db->insert_id();
        } else{
            return FALSE;
        }
    }
    public function social_record($social_id){
        $this->db->select("*");
        $this->db->from("user");
        $this->db->where("user_id",$social_id);
        $query = $this->db->get();
        if($query){
            return $query->row_array();
        }else{
            return false;
        }
    }
    public function get_all_address($id){
        $this->db->select("*");
        $this->db->from("addresses");
        $this->db->where("user_id",$id);
        $query = $this->db->get();
        if($query){
            return $query->result();
        }else{
            return false;
        }
    }




}

