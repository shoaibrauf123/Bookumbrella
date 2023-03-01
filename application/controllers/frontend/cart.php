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
		if($this->session->userdata('admin_role_id')){
			redirect('admin');
			}
    }

    private function __loadView()
    {
        if ($this->session->flashdata('success') != "")
            $this->_data['success'] = $this->session->flashdata('success');
        if ($this->session->flashdata('errors') != "")
            $this->_data['errors'] = $this->session->flashdata('errors');

        $this->load->view('frontend/home_template', $this->_data);
    }

function updateCoupon(){
	$data['success'] = true;
	if(isset($_POST['coupon_code']) && $_POST['coupon_code'] != ''){
		$coupon_code = $this->comman_model->get('coupon',array('coupon' => $_POST['coupon_code']));
		if($coupon_code){
			$this->session->set_userdata("coupon_code",$coupon_code[0]['coupon']);
			$this->session->set_userdata("coupon_code_valid",1);
			$this->session->set_userdata("discount",$coupon_code[0]['percentage']);
		}else{
			$this->session->set_userdata("coupon_code",$_POST['coupon_code']);
			$this->session->unset_userdata("coupon_code_valid");
			$this->session->unset_userdata("discount");
		}
	}else{
		$this->session->unset_userdata("coupon_code");
		$this->session->unset_userdata("coupon_code_valid");
		$this->session->unset_userdata("discount");
	}
	echo json_encode($data);
}

function updateQtyProduct(){
	
	$data['success'] = true;
	$cartData = $this->session->userdata("cartData");
	$arr_shipping = explode("-",$this->input->post('shipping'));
			$shipping_type = $arr_shipping[0];	
			$shipping_amount = $arr_shipping[1];
			
			
	
	$total = 0;
        //print_r($cartData); die;
        if(!$cartData) {
            $cartData = array();
        }
$totalCartItems= 0;		
		if(isset($_POST['cart_row_id']) && $_POST['cart_row_id'] != ''){
			
			foreach($cartData as $key=>$value){
				
				
				if($_POST['cart_row_id'] == $value['cart_row_id']){
					
				
							//echo $key. "--" .$cartData[$key]['shipping_type'];exit;		
				
				$totalCartItems =  $_POST['new_qty'] + $totalCartItems;
				$cartData[$key]['qty'] = $_POST['new_qty'];
				
				$cartData[$key]['shipping_type'] = $shipping_type;
				$cartData[$key]['shipping_amount'] = $shipping_amount;
				
				$total = $total + ($value['price']*$_POST['new_qty']);
				//$cartData[] = array('cart_row_id'=>$value['cart_row_id'],'seller_id'=>$value['seller_id'],'id'=>$value['id'],'product_id'=>$value['product_id'],'price'=> $value['price'], 'qty' => $_POST['new_qty']);
			
			
			
				}else{
					$total = $total + $value['price'];
					$totalCartItems =  $value['qty'] + $totalCartItems;
					//$cartData[] = array('cart_row_id'=>$value['cart_row_id'],'seller_id'=>$value['seller_id'],'id'=>$value['id'],'product_id'=>$value['product_id'],'price'=> $value['price'], 'qty' => $value['qty']);
					}
			
			
			
			 
			
			
			}
			
				
				
		//print_r($cartData);exit;		
				
				
				
						$data['totalCartItems']=$totalCartItems ;
			
				
				
				
				
				$data['total'] =$total;
				
				$this->session->set_userdata('cartData', $cartData);
				$this->session->set_userdata('totalCartItems', $totalCartItems);
				$this->session->set_userdata('total', $total);




		}
	
	
	
	echo json_encode($data);
	
	}
    function addToCart(){
		
		
        $data['success'] = true;
        $dataerror['ownproduct'] = true;
		$cartData = $this->session->userdata("cartData");
        //print_r($_POST); 
		//print_r($cartData); die;
        if(!$cartData) {
            $cartData = array();
        }

		$totalCartItems = 0;
		$total = 0;

		if(isset($_POST['id']) && $_POST['id'] != ''){
         
		    
			$arr_shipping = explode("-",$this->input->post('shipping'));
			$shipping_type = $arr_shipping[0];	
			$shipping_amount = $arr_shipping[1];	
		    
			$seller_products_row = $this->comman_model->get("seller_products",array('id'=>$_POST['id']));
			$seller_products_row = $seller_products_row[0];
		 	
			if($seller_products_row['user_id'] == getCurrentUserId()){
				echo json_encode($dataerror);exit;
				
				}
			
		
		if(count($cartData) > 0){
			
			
		$totalCartItems = 0;	
		
			
			$cntrl = count($cartData)+1;	
			
			$new_ar = array('cart_row_id'=>$cntrl,'seller_id'=>$seller_products_row['user_id'],'id'=>$seller_products_row['id'],'product_id'=>$seller_products_row['product_id'],'price'=> $seller_products_row['price'], 'qty' => 1, 'shipping_type' => $shipping_type, 'shipping_amount' => $shipping_amount);
			
			 array_push($cartData, $new_ar);
			
			
			foreach($cartData as $key=>$value){
				$totalCartItems =  $value['qty'] + $totalCartItems;
				$total = $total + $value['price'];
			}
			$data['totalCartItems']=$totalCartItems;
			
			
			//$cartData = $this->array_sort_by_column($cartData, 'seller_id');
			
			$data['total'] =$total;
            $this->session->set_userdata('cartData', $cartData);
            $this->session->set_userdata('totalCartItems', $totalCartItems);
            $this->session->set_userdata('total', $total);
			
			
            
			
			 
			}else{


			$cartData[] = array('cart_row_id'=>1,'seller_id'=>$seller_products_row['user_id'],'id'=>$seller_products_row['id'],'product_id'=>$seller_products_row['product_id'],'price'=> $seller_products_row['price'], 'qty' => 1, 'shipping_type' => $shipping_type, 'shipping_amount' => $shipping_amount); 
 

			$data['cartData']       = $cartData;
            $data['totalCartItems']=$totalCartItems = 1;
			$data['total'] =$total= $seller_products_row['price'];
			
            //echo json_encode($data);exit;
			$this->session->set_userdata('cartData', $cartData);
            $this->session->set_userdata('totalCartItems', $totalCartItems);
            $this->session->set_userdata('total', $total);


		}
		//print_r($this->session->userdata('cartData'));exit;
		
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
		//echo $this->uri->segment(3);exit;
        $address_id = $this->uri->segment(3);
		$card_id = $this->uri->segment(4);

		//echo 'kjksajfkadkf';exit;
        if ($this->session->userdata('logged_in') == TRUE) {
            $cartData = $this->session->userdata("cartData");
            if($cartData){


				$address = $this->comman_model->get("addresses",array("id"=>$address_id));
                if($address[0]["is_default"]=='no'){
                	$this->comman_model->update("addresses",array("user_id"=>getCurrentUserId()),array("is_default"=>"no"));
					$this->comman_model->update("addresses",array("id"=>$address_id),array("is_default"=>"yes"));
                }
				$address_country = $address[0]["country"];
				$address_name = $address[0]["name"];
				$address_street_address = $address[0]["street_address"];
				$address_city =  $address[0]["city"];
				$address_state =  $address[0]["state"];
				$address_zip = $address[0]["zip"];
				$address_phone_number =  $address[0]["phone_number"];

				if($card_id == 'paypal'){
					if(isset($_POST['txn_id'])){
						$payment_method_type = 'PayPal';
						$order_id = $_POST['txn_id'];

						//$payer_email   = $_POST['payer_email'];
					    //$payer_id      = $_POST['payer_id'];
					    //$payer_status  = $_POST['payer_status'];
					    //$first_name    = $_POST['first_name'];
					    //$last_name     = $_POST['last_name'];
					    //$address_name   = $_POST['address_name'];
					    //$address_street = $_POST['address_street'];
					    //$address_city   = $_POST['address_city'];
					    //$address_state  = $_POST['address_state'];
					    //$address_country_code = $_POST['address_country_code'];
					    //$address_zip          = $_POST['address_zip'];
					    //$residence_country    = $_POST['residence_country'];
					    //$mc_currency          = $_POST['mc_currency'];
					    //$mc_fee = $_POST['mc_fee'];
					    //$mc_gross = $_POST['mc_gross'];
					    //$protection_eligibility = $_POST['protection_eligibility'];
					    //$payment_fee = $_POST['payment_fee'];
					    //$payment_gross = $_POST['payment_gross'];
					    //$payment_status = $_POST['payment_status'];
					    //$payment_type = $_POST['payment_type'];
					    //$item_name = $_POST['item_name'];
					    //$item_number = $_POST['item_number'];
					    //$quantity = $_POST['quantity'];
					    //$txn_type = $_POST['txn_type'];
					    //$payment_date = $_POST['payment_date'];
					    //$business = $_POST['business'];
					    //$receiver_id = $_POST['receiver_id'];
					    //$notify_version = $_POST['notify_version'];
					    //$verify_sign = $_POST['verify_sign'];

					    $card_id = '';
						$card_title = '';
						$card_no = '';
						$card_expiry_month = '';
						$card_expiry_year = '';
					}
					
				
				}else{
					$card = $this->comman_model->get("pm_card",array("id"=>$card_id));
					$payment_method_type = 'Credit Card';

					$card_id = $card_id;
					$card_title = $card[0]["title"];
					$card_no = $card[0]["card_no"];
					$card_expiry_month = $card[0]["expiry_month"];
					$card_expiry_year = $card[0]["expiry_year"];
					$order_id = NumericrandomKey(5);
				}
				
				
				
				//echo '<pre>';print_r($address);exit;
				
				$total_products = array();
				$buyer_msg = '';
				$buyer_total = 0;
				$final_value_on_product = $this->comman_model->print_value("setting",array('slug'=>'final_value_on_product'),'value');
                //echo '<pre>';print_r($cartData);exit;
                $same_order_id = NumericrandomKey(20);
                foreach ($cartData  as $key => $value) {
					$unique_order_id = NumericrandomKey(5);
					//echo '<pre>';print_r($value);exit;
                    $seller_product = getSingleRecord('seller_products', array('id'=>$value['id']));

					$product = getSingleRecord('products', array('product_id'=>$value['product_id']));
                    $seller_detail = getSingleRecord('user', array('user_id'=>$value['seller_id']));



//echo '<pre>';print_r($product);exit;
                    $discount_code = '';
                    $discount_aplied = 0;
                    $discount_amount = 0;
                    if($this->session->userdata("coupon_code")){
                    $discount_code = $this->session->userdata("coupon_code");
                    }
                    if($this->session->userdata("discount")){
                        $discount_aplied = $this->session->userdata("discount");
                        $discount_amount = ($final_value_on_product/100)*$this->session->userdata("discount");
                    }


					
					$data = array(
					    'discount_code'=>$discount_code,
                        'discount_aplied'=>$discount_aplied,
                        'discount_amount'=>$discount_amount,

                        'user_id' => $this->session->userdata('user_id'),
						'payment_method_type'=>$payment_method_type,

						'card_id'=>$card_id,
						'card_title'=>$card_title,
						'card_no'=>$card_no,
						'card_expiry_month'=>$card_expiry_month,
						'card_expiry_year'=>$card_expiry_year,
						
						'address_country'=>$address_country,
						'address_name'=>$address_name,
						'address_street_address'=>$address_street_address,
						'address_city'=>$address_city,
						'address_state'=>$address_state,
						'address_zip'=>$address_zip,
						'address_phone_number'=>$address_phone_number,
                        'sku'=>$product['sku'],
                        'book_condition' => $seller_product['book_condition'],
                        'book_title' => $product['title'],
						'isbn'=>$product['isbn'],
						'isbn13'=>$product['isbn13'],
						'product_id' => $value['product_id'],
						'qty' => $value['qty'],
						'seller_id'=>$value['seller_id'],
						'cart_row_id'=>$value['cart_row_id'],
						'shipping_type'=>$value['shipping_type'],
						'shipping_value'=>$value['shipping_amount'],
						'final_value_on_product'=>$final_value_on_product,
						'seller_products_id'=>$value['id'],
						'price'=>$value['price']-$discount_amount,
						'order_status'=>'Received',
						'payment_status'=>'Paid',
						'unique_order_id'=>$unique_order_id,
						'same_order'=>$same_order_id,
						'order_id'=>$order_id  
                    );
                    //echo '<pre>';print_r($data);exit;
                    $savedPrice = $value['price']-$discount_amount;
                    $earnings = ($savedPrice+$value['shipping_amount'])-$final_value_on_product;

                    $save = $this->comman_model->save('purchase', $data);
                    if($save){
                        $unique_order_id = $save.$order_id;
                        $unique_order_id = $save.$unique_order_id;
                        $this->comman_model->update("purchase",array("id"=>$save),array("order_id"=>$save.$order_id,"unique_order_id"=>$save.$unique_order_id));
                    	$price_total = $value['price']*$value['qty'];
                    	$buyer_total = $buyer_total+$price_total;


$creationDate  = date("");
$sellerusername  = $seller_detail['username'];
$total_products[$value['seller_id']][$key]['detail'] = '<table width="100%" border="0" align="center" cellpadding="2" cellspacing="2" style="font-size:14px; font-family:Arial, Helvetica, sans-serif">
  <tr>
    <td align="left" style="font-size:24px; font-weight:bold; color:#000;">Bookumbrella Customer Inquiry: order # ' .$unique_order_id. '
</td>
  </tr>
  <tr>
    <td align="left">&nbsp;</td>
  </tr>
  
  
  <tr>
    <td align="left">Dear '.$sellerusername.' ,	
</td>
  </tr>
  
  <tr>
    <td align="left">&nbsp;</td>
  </tr>
  <tr>
    <td align="left"><table border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td>Congratulations!	</td>
      </tr>
      <tr>
        <td>You recieved an order on Bookumbrella.com </td>
      </tr>
        <tr>
    <td align="left">&nbsp;</td>
  </tr>
   <tr>
        <td>Please ship this order and update the tracking information.
 </td>
      </tr>
      
       <tr>
        <td><strong>Order Id:</strong> '.$unique_order_id.' 	
</td>
      </tr>
      <tr>
        <td><strong>Order date:</strong> '.date("d/m/Y").' 	
</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td align="left">&nbsp;</td>
  </tr>
  <tr>
    <td align="left"><table width="100%" border="0" cellspacing="2" cellpadding="2">
      <tr>
        <td align="left"><strong>Item:</strong> '.$product['title'].' </td>
      </tr>
      <tr>
        <td align="left"><strong>Condition:</strong> '.$seller_product['book_condition'].' </td>
      </tr>
      <tr>
        <td align="left"><strong>SKU:</strong> '.$product['sku'].'   </td>
      </tr>
      <tr>
        <td align="left">Quantity: '.$value['qty'].'	
</td>
      </tr>
      <tr>
        <td align="left"><strong>Price: </strong>$'.$value['price'].' </td>
      </tr>
      <tr>
        <td align="left"><strong>Shipping: </strong>$'.$value['shipping_amount'].'  </td>
      </tr>
      <tr>
        <td align="left"><strong>Bookumbrella fees:</strong> -$'.$final_value_on_product.'  </td>
      </tr>
      <tr>
        <td align="left"><strong>Your earnings: $'.$earnings.'</strong>	
</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td align="left">&nbsp;</td>
  </tr>
  <tr>
    <td align="left"><table width="100%" border="0" cellspacing="2" cellpadding="2">
      <tr>
        <td align="left">Buyer Shipping address:-	
</td>
      </tr>
      <tr>
        <td align="left"> '.$address_street_address.' 	
</td>
      </tr>
      <tr>
        <td align="left"> '.$address_city . ' ' . $address_state . ' ' . $address_zip    .'	
</td>
      </tr>
      <tr>
        <td align="left">'.$address_country.'	
</td>
      </tr>
      <tr>
        <td align="left"><strong>Phone:</strong> '.$address_phone_number.'  </td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td align="left">&nbsp;</td>
  </tr>
  
  
    <tr>
        <td>Seller online Help </td>
      </tr>
      <tr>
        <td><a href="www.bookumbrella.com/Help" >www.bookumbrella.com/Help </a></td>
      </tr>
      
  <tr>
    <td align="left">&nbsp;</td>
  </tr>      
      
         <tr>
        <td>Thank you for selling with us. </td>
      </tr>
      
      
  <tr>
    <td align="left">&nbsp;</td>
  </tr>  
  
      
         <tr>
        <td>Sincerely, </td>
      </tr>
                  
         <tr>
        <td>Bookumbrella Team </td>
      </tr>
        <tr>
        <td><a href="www.bookumbrella.com" >www.bookumbrella.com </a></td>
      </tr>
          
        <tr>
        <td><a href="www.bookumbrella.co.uk" >www.bookumbrella.co.uk</a></td>
      </tr>
        <tr>
        <td><a href="www.bookumbrella.ca" >www.bookumbrella.ca </a></td>
      </tr>
        <tr>
        <td><a href="www.bookumbrella.in" >www.bookumbrella.in </a></td>
      </tr>
      
        <tr>
    <td align="left">&nbsp;</td>
  </tr>
  
  
  
  
  <tr>
    <td align="left"><strong>Thank you,	
    </strong></td>
  </tr>
  <tr>
    <td align="left">Your AbeBooks Team	
</td>
  </tr>
</table>';
					    
					    $total_products[$value['seller_id']][$key]['price'] = $price_total;
					    
					    $buyer_msg .= '<div class="product-col list clearfix col-sm-12">
							         
							          <div class="col-xs-12 col-sm-7">
										<div>
							            <h3>Order Id: '.$unique_order_id.'</h3>
							            <h4>'.$product['title'].'</h4>
							            <strong> ISBN-10:</strong><span>'.$product['isbn'].'</span><strong> ISBN-13:</strong><span>'.$product['isbn13'].'</span><br>
							            <strong> Publisher:</strong><span>'.$product['publisher'].'</span><strong> Type:</strong><span>'.$seller_product['book_type'].'</span><br>
							           
							            <strong> Quantity:</strong><span>'.$value['qty'].'</span> <strong> Price:</strong><span>'.$value['price'].'</span> <br>
							            <strong> Total:</strong><span>'.$price_total.'</span>
							            <strong> Phone No.:</strong><span>'.$address_phone_number.'</span>
							            </div><br>
							            
							            
							          
							        </div>
							        <div class="col-xs-12 col-sm-2 pull-right">
							            <div class="cart-button button-group">
							            <a href="'.base_url('product/detail') . "/" . encode_url($product['product_id']).'" class="btn btn-cart btn-block" type="button">Detail</a>  
							            </div>
							          </div>
							      </div><hr>';
                    }
                }




                $admin_email = getUserEmail('user', array('role_id'=>1));
                $buyer_email = $this->session->userdata('email');
                $seller_subject = 'Bookumbrella Order: Organic Chemistry As a Second Language'.$product['title'];
                $buyer_subject = 'Order for produts has been submitted.';
                $admin_subject = 'New Order Placed.';
                $msg = '';



                foreach ($total_products as $seller_id => $products) {
                	$total_price = 0;
                	$msg = '<html><body bgcolor="#EDEDEE">';

                    $email_notifications = $this->comman_model->get("email_notifications",array("user_id"=>$seller_id));
                    $seller_email = getUserEmail('user', array('user_id'=>$seller_id));
                        if($email_notifications!=0){
                            $seller_email = $email_notifications[0]['order_notification'];
                    }




                	foreach ($products as $product) {
                		$msg .= $product['detail'];
                		$total_price += $product['price'];
                	}
                	$msg .= '</body></html>';
                	do_email($seller_email, $buyer_email, $seller_subject, $msg);
                }
                $buyer_msg = '<html><body bgcolor="#EDEDEE">'.$buyer_msg.'</body></html>';
                do_email($buyer_email,$admin_email,  $buyer_subject, $buyer_msg);
                do_email($admin_email, $admin_email,  $admin_subject, $buyer_msg);

                $this->session->unset_userdata('cartData');
                //$this->session->unset_userdata('totalCartItems');
                //$this->session->unset_userdata('total');
                $this->session->set_flashdata('success','You have successfully made the payment for the item.!');

                $this->session->unset_userdata("coupon_code");
                $this->session->unset_userdata("coupon_code_valid");
                $this->session->unset_userdata("discount");


                redirect('product/payment_success');
            }else{
                $this->session->set_flashdata('errors','Cart data not found!');
                redirect('product/checkout'); 
            }
        }else {
                redirect('login');
            }
    }
    
    function payment_success(){
    	//$this->_data['totalCartItems'] = $this->session->userdata('totalCartItems');
        //$this->_data['total'] = $this->session->userdata('total');
        //$this->session->unset_userdata('totalCartItems');
        //$this->session->unset_userdata('total');
    	$this->_data['main_content'] = 'frontend/products/payment_success';
        $this->__loadView();
    }

	function Refund(){
		
	$id = decode_uri($this->uri->segment(2));

        if ($this->session->userdata('logged_in') == TRUE) {
			
			if ($this->input->server('REQUEST_METHOD') == 'POST') {
				//echo '<pre>';print_r($_POST);exit;
				$id = $this->input->post('id');
				$data = array(
				'refund_reason'=>$this->input->post('refund_reason'),
				'refund_type'=>$this->input->post('refund_type'),
				'refund_amount_to_buyer'=>$this->input->post('refund_amount_to_buyer'),
				'message_to_buyer'=>$this->input->post('message_to_buyer'),
				'date_refunded'=>date("d-m-Y H:i:s",time()),
				'order_status'=>'Refunded'
				);
				
				
				$updated = $this->comman_model->update('purchase',array('id'=>$id), $data);
				
				if($updated){


                    $purchase = $this->comman_model->get("purchase",array("id"=>$id));
                    $unique_order_id = $purchase[0]['unique_order_id'];
                    $seller_id = $purchase[0]['seller_id'];
                    $user_id = $purchase[0]['user_id'];
                    $seller_details = $this->comman_model->get("user",array("user_id"=>$seller_id));
                    $seller_details = $this->comman_model->get("user",array("user_id"=>$seller_id));
                    $user_id = $purchase[0]['user_id'];
                    ////////////////buyer email//////////////////
                    $subject = 'Order has been refunded';
                    $message = '<html>
                       <body bgcolor="#EDEDEE">
                       <p><div align="center" style="color:#303E49"><h1>Following order has been refunded.</h1></div></p>
                       
                       
					    <p><strong>Order Id:</strong>'.$unique_order_id.'</p></p></p>
					     <p><strong>Refund Reason:</strong>'.$this->input->post('refund_reason').'</p></p></p>
                       <p>Regards<p>
                       <p>Team <strong>bookumbrella.com</strong><p>
                       </body>
                       </html>';


                    do_email($this->session->userdata('email'), getAdminEmail(), $subject, $message);

                    ////////////////buyer email end //////////////////
                    ////////////////seller email//////////////////
                    $email_notifications = $this->comman_model->get("email_notifications", array("user_id" => $seller_id));
                    $seller_email = $seller_details[0]['email'];


                    if ($email_notifications != 0) {
                        $seller_email = $email_notifications[0]['order_notification'];
                    }
                    do_email($seller_email, getAdminEmail(), $subject, $message);
                    ////////////////seller email end //////////////////
                    //
                    //

				$this->session->set_flashdata('success', 'Amount has been refunded succcessfully !');
				redirect('my_account');
				}else{
				$this->session->set_flashdata('errors', 'Unable to do the refund. Review information and try again !');			
				}
				
				
				}
			
			
			

            $layouts_data = $this->comman_model->get('layouts');
			$this->_data['id'] = $id;
          	$order = $this->comman_model->get('purchase',array('id'=>$id));
		  	$this->_data['order'] = $order;
            $this->_data['layouts'] = $layouts_data;
            $this->_data['main_content'] = 'frontend/products/refund';
            $this->__loadView();

        } else {
            redirect('login');
        }
    
	
	
	
	
	
	
		
		
		}
		
		function CancelOrder(){
			
					$id = $this->input->post('id');
					$reason_cancel = $this->input->post('reason_cancel');
				$data = array(
				'reason_cancel'=>$this->input->post('reason_cancel'),
				
				'order_status'=>'Cancelled',
				'updated_on'=>date("d-m-Y H:i:s",time())
				);

				$purchase = $this->comman_model->get("purchase",array("id"=>$id));
				$unique_order_id = $purchase[0]['unique_order_id'];
                $seller_id = $purchase[0]['seller_id'];
                $seller_details = $this->comman_model->get("user",array("user_id"=>$seller_id));

                $user_id = $purchase[0]['user_id'];
                ////////////////buyer email//////////////////
            $subject = 'Order has been cancelled';
            $message = '<html>
                       <body bgcolor="#EDEDEE">
                       <p><div align="center" style="color:#303E49"><h1>Following order has been cancelled.</h1></div></p>
                       
                       
					    <p><strong>Order Id:</strong>'.$unique_order_id.'</p></p></p>
					     <p><strong>Cancel Reason:</strong>'.$this->input->post('reason_cancel').'</p></p></p>
                       <p>Regards<p>
                       <p>Team <strong>bookumbrella.com</strong><p>
                       </body>
                       </html>';


            do_email($this->session->userdata('email'), getAdminEmail(), $subject, $message);

                ////////////////buyer email end //////////////////
            ////////////////seller email//////////////////
            $email_notifications = $this->comman_model->get("email_notifications", array("user_id" => $seller_id));
            $seller_email = $seller_details[0]['email'];


            if ($email_notifications != 0) {
                $seller_email = $email_notifications[0]['order_notification'];
            }
            do_email($seller_email, getAdminEmail(), $subject, $message);
            ////////////////seller email end //////////////////
            //print_r($data);exit;
				$updated = $this->comman_model->update('purchase',array('id'=>$id), $data);
				
				if($updated){
				return 'Order has been cancelled.';
				}else{
				return 'There is some error. Please try later.';
				}
			
			
			}
function array_sort_by_column(&$arr, $col, $dir = SORT_ASC) {
    $sort_col = array();
    foreach ($arr as $key=> $row) {
        $sort_col[$key] = $row[$col];
    }

    return array_multisort($sort_col, $dir, $arr);
}

}