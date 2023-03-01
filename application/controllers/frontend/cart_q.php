<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cart extends CI_Controller
{
    private $_data;

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('common_helper');
		$this->load->model('comman_model');
        $this->load->model('product_model');
    }

    private function __loadView()
    {
        if ($this->session->flashdata('success') != "")
            $this->_data['success'] = $this->session->flashdata('success');
        if ($this->session->flashdata('errors') != "")
            $this->_data['errors'] = $this->session->flashdata('errors');

        $this->load->view('frontend/home_template', $this->_data);
    }
function updateQtyProduct(){
	
	$data['success'] = true;
	$cartData = $this->session->userdata("cartData");
	$total = 0;
        //print_r($cartData); die;
        if(!$cartData) {
            $cartData = array();
        }
$totalCartItems= 0;		
		if(isset($_POST['cart_row_id']) && $_POST['cart_row_id'] != ''){
			
			foreach($cartData as $key=>$value){
				
				
				if($_POST['cart_row_id'] == $value['cart_row_id']){				
				
				$totalCartItems =  $_POST['new_qty'] + $totalCartItems;
				$cartData[$key]['qty'] = $_POST['new_qty'];
				$total = $total + ($value['price']*$_POST['new_qty']);
				//$cartData[] = array('cart_row_id'=>$value['cart_row_id'],'seller_id'=>$value['seller_id'],'id'=>$value['id'],'product_id'=>$value['product_id'],'price'=> $value['price'], 'qty' => $_POST['new_qty']);
			
			
			
				}else{
					$total = $total + $value['price'];
					$totalCartItems =  $value['qty'] + $totalCartItems;
					//$cartData[] = array('cart_row_id'=>$value['cart_row_id'],'seller_id'=>$value['seller_id'],'id'=>$value['id'],'product_id'=>$value['product_id'],'price'=> $value['price'], 'qty' => $value['qty']);
					}
			
			
			
			 
			
			
			}
			
				
				
				
				
				
				
						$data['totalCartItems']=$totalCartItems ;
			
				
				
				
				
				$data['total'] =$total;
				
				$this->session->set_userdata('cartData', $cartData);
				$this->session->set_userdata('totalCartItems', $totalCartItems);
				$this->session->set_userdata('total', $total);




		}
	
	
	
	echo json_encode($data);
	
	}
    function addToCart(){
		//echo 'ddddddddddd';exit;
		
        $data['success'] = true;
        


		
		$cartData = $this->session->userdata("cartData");
        //print_r($cartData); die;
        if(!$cartData) {
            $cartData = array();
        }

$totalCartItems = 0;
$total = 0;

if(isset($_POST['id']) && $_POST['id'] != ''){
         
		 
		
		    
			$seller_products_row = $this->comman_model->get("seller_products",array('id'=>$_POST['id']));
			$seller_products_row = $seller_products_row[0];
		 	
		
		if(count($cartData) > 0){
		$totalCartItems = 0;	
		//$totalCartItems = count($cartData);
		$total = $seller_products_row['price'];
		
			
			//echo json_encode($cartData['qty']);exit;
			
			$cntrl = count($cartData)+1;	
			foreach($cartData as $key=>$value){
				$totalCartItems =  $value['qty'] + $totalCartItems;
				$total = $total + $value['price'];
			}
			
			 array_push($cartData, array('cart_row_id'=>$cntrl,'seller_id'=>$seller_products_row['user_id'],'id'=>$seller_products_row['id'],'product_id'=>$seller_products_row['product_id'],'price'=> $seller_products_row['price'], 'qty' => 1));
			
			
			//$cartData[] = array('cart_id'=>$cntrl,'seller_id'=>$seller_products_row['user_id'],'id'=>$seller_products_row['id'],'product_id'=>$seller_products_row['product_id'],'price'=> $seller_products_row['price'], 'qty' => 1);  
			//$cartData[] = $cartData;
			
            $data['totalCartItems']=$totalCartItems + 1 ;
			
			$data['total'] =$total;
            $this->session->set_userdata('cartData', $cartData);
            $this->session->set_userdata('totalCartItems', $totalCartItems);
            $this->session->set_userdata('total', $total);
			
			
            
			
			 
			}else{


$cartData[] = array('cart_row_id'=>1,'seller_id'=>$seller_products_row['user_id'],'id'=>$seller_products_row['id'],'product_id'=>$seller_products_row['product_id'],'price'=> $seller_products_row['price'], 'qty' => 1); 
 

			$data['cartData']       = $cartData;
            $data['totalCartItems']=$totalCartItems = 1;
			$data['total'] =$total= $seller_products_row['price'];
			
            //echo json_encode($data);exit;
			$this->session->set_userdata('cartData', $cartData);
            $this->session->set_userdata('totalCartItems', $totalCartItems);
            $this->session->set_userdata('total', $total);






			 }
		
		
		
		
		
		
		
		
		
			      
        
		
		
		
		}
		 
       
        
        echo json_encode($data);
    }
    
    function remove(){
		
		
		/*$this->session->set_userdata('cartData', array());
            $this->session->set_userdata('totalCartItems', 0);
            $this->session->set_userdata('total', 0);
			exit;*/
		
        $productId = $this->uri->segment(3);
        $cartData = $this->session->userdata("cartData");
        if(isset($cartData[$productId])) {
            unset($cartData[$productId]);
        }
        $totalCartItems = 0;
        $total = 0;
        if(count($cartData) > 0){
            foreach ($cartData as $value) {
                $totalCartItems = $totalCartItems + $value['qty'];
                $total = $total + $value['price'];
            }
            $data['cartData']       = $cartData;
            $data['totalCartItems'] = $totalCartItems;
            $data['total'] = $total;
            $this->session->set_userdata('cartData', $cartData);
            $this->session->set_userdata('totalCartItems', $totalCartItems);
            $this->session->set_userdata('total', $total);
        }else{
            $data['success'] = false;
            $this->session->unset_userdata('cartData');
            $this->session->unset_userdata('totalCartItems');
            $this->session->unset_userdata('total');
        }
        redirect('product/checkout');
    }
    
    function purchase(){
        if ($this->session->userdata('logged_in') == TRUE) {
            $cartData = $this->session->userdata("cartData");
            if($cartData){
				$order_id = randomKey(40);
                foreach ($cartData  as $key => $value) {
                    //echo '<pre>';print_r($value);exit;
					//echo randomKey(20);
					$data = array(
                            'user_id' => $this->session->userdata('user_id'),
							'product_id' => $value['product_id'],
							'qty' => $value['qty'],
							'seller_id'=>$value['seller_id'],
							'cart_row_id'=>$value['cart_row_id'],
							
							'seller_products_id'=>$value['id'],
							'price'=>$value['price'],
							'order_status'=>'Pending',
							'payment_status'=>'Not Paid',
							'order_id'=>$order_id
                            
                            
                        );
                    $this->comman_model->save('purchase', $data);
                }
                $this->session->unset_userdata('cartData');
                $this->session->unset_userdata('totalCartItems');
                $this->session->unset_userdata('total');
                $this->session->set_flashdata('success','Payment success !');
                redirect('product/checkout');
            }else{
                $this->session->set_flashdata('errors','Cart data not found!');
                redirect('product/checkout'); 
            }
        }else {
                redirect('login');
            }
    }
}