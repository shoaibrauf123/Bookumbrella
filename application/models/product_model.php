<?php

if (!defined('BASEPATH'))

    exit('No direct script access allowed');



class product_model extends CI_Model

{



    public function __construct()

    {

        parent::__construct();

        $this->load->model('comman_model');

    }



    function tableName()

    {

        return 'products';

    }



    function insertCjProduct($product,$cat_id,$user_id){



        $skuCode = $product['sku'];

        $skuCode = trim($skuCode);



        $skuExistCount = $this->comman_model->get_total($this->tableName(),array('sku'=>$skuCode));



        if($skuExistCount <= 0){



            $productDataArr = array(

                'title' => $product['name'],

                'slug' => create_slug($product['name']),

                'sku' => $product['sku'],

                'image' => $product['image-url'] ? $product['image-url']:'',

                'price' => $product['price'],

                'retail_price' => $product['retail-price'] ? $product['retail-price']:0,

                'sale_price' => $product['sale-price'] ? $product['sale-price']:0,

                'buy_url' => $product['buy-url'],

                'description' => $product['description'] ? $product['description']:'',

                'advertiser_id' => $product['advertiser-id'] ? $product['advertiser-id']:0,

                'advertiser_name' => $product['advertiser-name'] ? $product['advertiser-name']:'',

                'manufacturer_name' => $product['manufacturer-name'] ? $product['manufacturer-name']:'',

                'manufacturer_sku' => $product['manufacturer-sku'] ? $product['manufacturer-sku']:0,

                'category_id' => $cat_id,

                'user_id' => $user_id,

            );



            return $this->comman_model->save($this->tableName(),$productDataArr);

        } else {

            return false;

        }

    }



    function insertShopStyleProducts($product){



        $prodExistCount = $this->comman_model->get_total($this->tableName(),array('shopstyle_id'=>$product->id));



        if($prodExistCount <= 0){



            $categoriesListArray = $product->categories;

            $categoriesIdsList = array();

            $categoriesList = "";



            if(count($categoriesListArray) > 0){

                foreach($categoriesListArray as $category){

                    $categoriesIdsList[] = $category->id;

                }



                $categoriesList = implode(',',$categoriesIdsList);

            }



            $productData = array(

                'shopstyle_id' => $product->id,

                'title' => $product->name,

                'price' => $product->price,

                'instock' => $product->inStock,

                'retailer_id' => $product->retailer ? $product->retailer->id:0,

                'brand_id' => $product->brand ? $product->brand->id:0,

                'description' => $product->description,

                'buy_url' => $product->clickUrl,

                'impression_url' => $product->pageUrl,

                'image' => $product->image->sizes->Large->url,

                'shopstyle_categories' => $categoriesList,

                'canonical_color_id' => $product->colors ? $product->colors[0]->canonicalColors[0]->id:0,

                'user_id' => 1,

            );

            return $saved = $this->comman_model->save('products', $productData);

        } else {

            return false;

        }

    }

    

    function get_price_range(){

        $this->db->select_max('price','max_price');

        $this->db->select_min('price','min_price');      

        $query = $this->db->get($this->tableName());

        return $query->result_array();

    }

    

    function  get_main_category(){

        $query = $this->db->select()

                ->from('category')

                ->where('parent_id',0)

                ->where('status',1)

                ->get();

        if($query->num_rows() > 0)

            return $query->result_array();

        else 

            return false;

    }

    function  get_manufacture(){

        $this->db->distinct();

        $this->db->select('manufacturer_name');

        $this->db->where('manufacturer_name !=','');

        

        $query = $this->db->get($this->tableName());

       //echo $this->db->last_query();die;

        if($query->num_rows() > 0)

            return $query->result_array();

        else 

            return false;

    }



    function  get_colors(){

        $this->db->distinct();

        $this->db->select('color');

        $this->db->where('color !=','');

        

        $query = $this->db->get($this->tableName());

       //echo $this->db->last_query();die;

        if($query->num_rows() > 0)

            return $query->result_array();

        else 

            return false;

    }



    function get_total_products($table,$or_where = false,$where = false) {


        $this->db->select()->from($table);

        if($where){	
		  $this->db->where($where);
        }/*else{
            $this->db->where($where);
        }*/



        if($or_where){
            $this->db->or_like($or_where);
        }

        $query = $this->db->get();		
		if($query->num_rows() > 0)
            return $query->num_rows();
        return 0;

    }


    function search_products_pending($table,$per_page=10, $start_from=0,$or_where = false,$where = false,$order=false,$title = false){
        $this->db->select()->from($table);

        if($where){

            $this->db->where($where);

        }

        if($or_where){

            $this->db->or_like($or_where);

        }



        if($title){

            //$this->db->like('title',$title);

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
    function search_products($table,$per_page=10, $start_from=0,$or_where = false,$where = false,$order=false,$title = false) {		
   

        $this->db->select("*")->from($table);
       if($where){              
             $this->db->where($where);
        }
        
       


       if($or_where){
            $this->db->or_like($or_where);
        }   

        $this->db->group_by('product_id');    


       $query = $this->db->limit($per_page, $start_from)->get();

       if($query->num_rows() > 0)
            return $query->result_array();
       return false;
    }
    

    function seller_book_condition($price){
        $this->db->select("book_condition,product_id,user_id,price");
        $this->db->where('price',$price);
        $query = $this->db->get("seller_products");
        if($query->num_rows() > 0){
            return $query->result_array();
            return false;
        }

    }

/*    function get_seller_products($table,$where = false,$order=false, $per_page=10, $start_from=0) {  

       $this->db->select('sp.*,p.title,p.isbn')->from($table .' as sp');

       $this->db->join('products as p','p.product_id = sp.product_id');

       if($where){

            $this->db->where(-/$where);

       }

       if($order){

            foreach ($order as $key => $value) {

                $this->db->order_by($key,$value);

            }

        }

       if($per_page && $start_from){

            $this->db->limit($per_page, $start_from);

       }

       

       $query = $this->db->get();

       echo $this->db->last_query();exit;

       if($query->num_rows() > 0)

            return $query->result_array();

       return false;

    }*/



    function get_most_sold() {

        $query = "SELECT purchase.product_id,SUM(purchase.qty) as total_qty,products.title,products.author,products.buy_price,products.image FROM `purchase` INNER JOIN products on purchase.product_id = products.product_id group by purchase.product_id order by sum(purchase.qty) DESC limit 14";



        $query = $this->db->query($query);

         //echo $this->db->last_query();die;



        if($query->num_rows() > 0)

            return $query->result_array();

        return 'nothing';

    }






    function get_seller_products($table,$where = false,$or_where = false,  $per_page=10, $start_from=0,$order=false) {  

	  // print_r($table);exit;

       $this->db->select('sp.*,p.title,p.isbn,p.isbn13,p.author,p.publisher,p.format,p.edition,p.image')->from($table .' as sp');

       $this->db->join('products as p','p.product_id = sp.product_id');

         if($where){

            $this->db->where($where);

       }

       if($or_where){

            $this->db->or_like($or_where);

       }

       if($title){

          $this->db->like('title',$title);

       }

       if($order){

            foreach ($order as $key => $value) {

                $this->db->order_by($key,$value);

            }

        }
		

       if($per_page && $start_from){

            $this->db->limit($per_page, $start_from);

       }

       

       $query = $this->db->get();

      // echo $this->db->last_query();exit;

       if($query->num_rows() > 0)

            return $query->result_array();

       return false;

    }	

    function get_seller_total_products($table,$where = false,$or_where = false,  $per_page=10, $start_from=0,$order=false) {  

	//print_r($where);exit;

       $this->db->select('sp.*,p.title,p.isbn,p.image')->from($table .' as sp');

       $this->db->join('products as p','p.product_id = sp.product_id');

         if($where){

            $this->db->where($where);

       }

       if($or_where){

            $this->db->or_like($or_where);

       }

       if($title){

          $this->db->like('title',$title);

       }

       if($order){

            foreach ($order as $key => $value) {

                $this->db->order_by($key,$value);

            }

        }

		

		

		

		

       if($per_page && $start_from){

            $this->db->limit($per_page, $start_from);

       }

       

       $query = $this->db->get();

//       echo $this->db->last_query();exit;

       if($query->num_rows() > 0)

            return $query->num_rows();

       return 0;

    }	

function total_sellers_for_condition($table,$where_in=false,$where=false){

			
    
    

       
		$this->db->select('id');
        $this->db->where($where);
		$this->db->where_in('book_condition', $where_in);
        

        $query = $this->db->get($table);

       //echo $this->db->last_query();die;

        if($query->num_rows() > 0)

            return $query->num_rows();

        else 

            return 0;

    	
	
	}
	
	
	
function min_product_price($table,$where_in=false,$where=false){

			

    

        $this->db->select_min('price');
		$this->db->select('id,product_id,user_id,book_condition');
        $this->db->where($where);
		$this->db->where_in('book_condition', $where_in);
        

        $query = $this->db->get($table);

       //echo $this->db->last_query();die;

        if($query->num_rows() > 0)

            return $query->result_array();

        else 

            return false;

    	
	
	}	
function getMinMax($table,$column=false,$where=false){
	
	$this->db->select('MAX('.$column.'), MIN('.$column.')');
	$this->db->where($where);
	
$query = $this->db->get($table);

return $query->result_array();
	
	}
}