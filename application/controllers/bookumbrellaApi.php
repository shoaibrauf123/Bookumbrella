<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class BookumbrellaApi extends CI_Controller
{
	
	public  function __construct(){
		parent::__construct();
		$this->load->model("api_model");
	}
	public function index(){
		echo "hello";
	}

	public function update_profile_byer(){


		$response_msg = 'Required fields are missing or have some invalid information';
		$status = 0;
		$havePassword = 0;
		$isPasswordSuccessful = 0;
		$isUpdated = 0;

		$user_id = $this->input->post('user_id') ? $this->input->post('user_id') :''; //line_remember
		$email = $this->input->post('email') ? $this->input->post('email') :'';
		$country = $this->input->post('country') ? $this->input->post('country') :'';         
		$current_pass = $this->input->post('current_password') ? $this->input->post('current_password') : '';
		$new_password = $this->input->post('new_password') ? $this->input->post('new_password') :'';
		$password_confirm = $this->input->post('password_confirm') ? $this->input->post('password_confirm') :'';
		//$profile_image = $this->input->post('avatar') ? $this->input->post('avatar') :'';
		$profile_image = $_FILES['avatar']["tmp_name"];

     	if(!empty($profile_image)){
			$config['upload_path'] = './uploads/img_gallery/user_images/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size'] = '1000';
			$config['max_width']  = '1024';
			$config['max_height']  = '768';
			$config['overwrite'] = TRUE;
			$config['encrypt_name'] = FALSE;
			$config['remove_spaces'] = TRUE;

			//if(!is_dir($config['upload_path']) ) die("THE UPLOAD DIRECTORY DOES NOT EXIST");
			$this->load->library('upload', $config);
			if($this->upload->do_upload('avatar')) {
				$res =  $this->upload->data();
				
       			$fileName = $res['raw_name'].$res['file_ext'];
       		
			}
      	}

      if($user_id){

         $updated_data = array(
             'email' => $email,
             'country' => $country,
             'date_updated' => date("Y-m-d H:i:s"),
             
         );

         if($current_pass || $new_password || $password_confirm){

            $havePassword = 1;
            $user_data = $this->api_model->getUserData($user_id);
            

            if($current_pass){
            	if(md5($current_pass) == $user_data['password']){
                  if(!$new_password){
                     $response_msg = 'New password field is empty or have some invalid information !';
                  }else if(!$password_confirm){
               	   $response_msg = 'Confirmation password field is empty or have some invalid information !';
                  }else if($new_password != $password_confirm){
                     $response_msg = 'Confirmation password does not match with your new password !';
                  }else{
                     if(strlen($new_password) >= 6){
                        $isPasswordSuccessful = 1;
                        $updated_data = array_merge($updated_data,array('password'=>md5($new_password)));
                     }else {
                        $response_msg = 'Password length should not be less than 6 !';
                     }
                  }
               }else{
                  $response_msg = 'Invalid current password ! Please enter your current password to update it.';
               }
            }else{
               $response_msg = 'Current password field is empty or have some invalid information !';
            }
         }
         /////////////////// File Image Code //////////////////////////////
         if(!empty($fileName)){
         	$updated_data = array_merge($updated_data,array('avatar'=>$fileName));
         }else{
         	$updated_data = array_merge($updated_data,array('avatar'=>$user_data['avatar']));
         }

         
                        

            if($havePassword && $isPasswordSuccessful || !$havePassword && !$isPasswordSuccessful ){
                $isUpdated = $this->api_model->updateUserProfile('user',$updated_data,array( 'user_id' => $user_id));
            }           


            if($isUpdated){
                //$this->session->set_userdata(array('email'=>$email));
                $response_msg = 'Profile information successfully updated !';
                $status = 1;
            }
       }

        if($status==1){
            echo json_encode(Array('status'=> true, 'message' => 'Successfully Updated'));

        }else{
            echo json_encode(Array('status'=> true, 'message' => 'Not Updated'));
        }
        //echo json_encode($response); exit;
   }

	public function getCategory_record(){
		$category_record = $this->api_model->getCategory();
		if ($category_record) {
            echo json_encode(Array('status'=> true, 'message' => 'Success', 'Categories' => $category_record));
        }else{
           echo json_encode(Array('status'=> false, 'message' => 'Categories Not Found'));
        }
	}

	public function getProduct_record(){
		$product_record = $this->api_model->getProduct();
		if ($product_record) {
            echo json_encode(Array('status'=> true, 'message' => 'Success', 'Product' => $product_record));
        }else{
           echo json_encode(Array('status'=> false, 'message' => 'Products Not Found'));
        }
	}

	public function getProduct_detail($id){
		$product_detail = $this->api_model->getProductDetail($id);
		if ($product_detail) {
            echo json_encode(Array('status'=> true, 'message' => 'Success', 'Product_detail' => $product_detail));
        }else{
           echo json_encode(Array('status'=> false, 'message' => 'Product Detail Not Found'));
        }
	}

	public function checkOut(){
		
		//$cartData = $this->session->userdata("cartData");
		//echo "<pre>"; print_r($cartData);die;
			//if($cartData){	
				$data['cart_row_id'] = $this->input->post('cart_row_id');
				$data['seller_id'] = $this->input->post('seller_id');
				$data['id'] = $this->input->post('id');
				$data['product_id'] = $this->input->post('product_id');
				$data['price'] = $this->input->post('price');
				$data['qty'] = $this->input->post('qty');
				$data['shipping_type'] = $this->input->post('shipping_type');
				$data['shipping_amount'] =$this->input->post('shipping_amount');
				//echo "<pre>"; print_r($data);die;
				$inserted_ids = $this->api_model->save("cart_table",$data);
				if($inserted_ids){
      			echo json_encode(Array('status'=> true, 'message' => 'Success', 'card_detail' => $inserted_ids));
      		}else{
      			echo json_encode(Array('status'=> false, 'message' => 'Card Detail Not Found'));
      		}
      		die;
		
		// if($cartData){	
		// 	foreach($cartData as $key=>$val){
		// 		$data['cart_row_id'] = $val['cart_row_id'];
		// 		$data['seller_id'] = $val['seller_id'];
		// 		$data['id'] = $val['id'];
		// 		$data['product_id'] = $val['product_id'];
		// 		$data['price'] = $val['price'];
		// 		$data['qty'] = $val['qty'];
		// 		$data['shipping_type'] = $val['shipping_type'];
		// 		$data['shipping_amount'] =$val['shipping_amount'];
				
		// 		$inserted_ids = $this->api_model->save("cart_table",$data);
		// 	}		
		
		// 	// $cartData = $this->api_model->getRecentinserted("cart_table",implode(",",$inserted_ids));
		// 	// if($cartData!=0){
			
		// 		// $this->_data['inserted_ids']   = 	implode(",",$inserted_ids);		
		// 		//$this->session->set_userdata('cartData', $cartData);
            
		// 	// }		
		// }
		//$card_accounts = $this->api_model->get("pm_card",array("user_id"=>getCurrentUserId()));
      // if($card_accounts){
      // 	echo json_encode(Array('status'=> true, 'message' => 'Success', 'card_detail' => $card_accounts));
      // }else{
      // 	echo json_encode(Array('status'=> false, 'message' => 'Card Detail Not Found'));
      // }


   }

   public function purchase(){

   	$data = array(
		   'discount_code'=>$this->input->post('discount_code'),
         'discount_aplied'=>$this->input->post('discount_aplied'),
         'discount_amount'=>$this->input->post('discount_amount'),

         'user_id' => $this->input->post('user_id'),
			'payment_method_type'=>$this->input->post('payment_method_type'),

			'card_id'=>$this->input->post('card_id'),
			'card_title'=>$this->input->post('card_title'),
			'card_no'=>$this->input->post('card_no'),
			'card_expiry_month'=>$this->input->post('card_expiry_month'),
			'card_expiry_year'=>$this->input->post('card_expiry_year'),
			
			'address_country'=>$this->input->post('address_country'),
			'address_name'=>$this->input->post('address_name'),
			'address_street_address'=>$this->input->post('address_street_address'),
			'address_city'=>$this->input->post('address_city'),
			'address_state'=>$this->input->post('address_state'),
			'address_zip'=>$this->input->post('address_zip'),
			'address_phone_number'=>$this->input->post('address_phone_number'),
			'sku'=>$this->input->post('sku'),
			'book_condition' => $this->input->post('book_condition'),
			'book_title' => $this->input->post('book_title'),
			'isbn'=>$this->input->post('isbn'),
			'isbn13'=>$this->input->post('isbn13'),
			'product_id' => $this->input->post('product_id'),
			'qty' => $this->input->post('qty'),
			'seller_id'=>$this->input->post('seller_id'),
			'cart_row_id'=>$this->input->post('cart_row_id'),
			'shipping_type'=>$this->input->post('shipping_type'),
			'shipping_value'=>$this->input->post('shipping_value'),
			'final_value_on_product'=>$this->input->post('final_value_on_product'),
			'seller_products_id'=>$this->input->post('seller_products_id'),
			'price'=>$this->input->post('price'),
			'order_status'=>$this->input->post('order_status'),
			'payment_status'=>$this->input->post('payment_status'),
			'unique_order_id'=>$this->input->post('unique_order_id'),
			'same_order'=>$this->input->post('same_order'),
			'order_id'=>$this->input->post('order_id') 
      );
      //print_r($data);exit;
      $purchase_detail = $this->api_model->save('purchase', $data);
      if($purchase_detail){
         echo json_encode(Array('status'=> true, 'message' => 'Success', 'perchase_detail' => $purchase_detail));
      }else{
        	echo json_encode(Array('status'=> false, 'message' => 'Perchasing Not Found.'));
      } 
			
      // $address_id = $this->uri->segment(2);
		// $card_id = $this->uri->segment(3);

		// //echo "<pre>"; print_r($address_id);die;


     	// // if($this->session->userdata('logged_in') == TRUE) {
      // //    $cartData = $this->session->userdata("cartData");
      // //    if($cartData){

		// 		$address = $this->api_model->get("addresses",array("id"=>$address_id));
      //       if($address[0]["is_default"]=='no'){
      //         	$this->api_model->update("addresses",array("user_id"=>getCurrentUserId()),array("is_default"=>"no"));
		// 			$this->api_model->update("addresses",array("id"=>$address_id),array("is_default"=>"yes"));
      //       }
		// 		$address_country = $address[0]["country"];
		// 		$address_name = $address[0]["name"];
		// 		$address_street_address = $address[0]["street_address"];
		// 		$address_city =  $address[0]["city"];
		// 		$address_state =  $address[0]["state"];
		// 		$address_zip = $address[0]["zip"];
		// 		$address_phone_number =  $address[0]["phone_number"];

		// 		if($card_id == 'paypal'){
		// 			if(isset($_POST['txn_id'])){
		// 				$payment_method_type = 'PayPal';
		// 				$order_id = $_POST['txn_id'];

		// 			   $card_id = '';
		// 				$card_title = '';
		// 				$card_no = '';
		// 				$card_expiry_month = '';
		// 				$card_expiry_year = '';
		// 			}				
		// 		}else{
		// 			$card = $this->api_model->get("pm_card",array("id"=>$card_id));
		// 			$payment_method_type = 'Credit Card';
		// 			echo "<pre>"; print_r($card);die;

		// 			$card_id = $card_id;
		// 			$card_title = $card[0]["title"];
		// 			$card_no = $card[0]["card_no"];
		// 			$card_expiry_month = $card[0]["expiry_month"];
		// 			$card_expiry_year = $card[0]["expiry_year"];
		// 			$order_id = NumericrandomKey(5);
		// 		}
				
		// 		$total_products = array();
		// 		$buyer_msg = '';
		// 		$buyer_total = 0;
		// 		$final_value_on_product = $this->api_model->print_value("setting",array('slug'=>'final_value_on_product'),'value');
      //           //echo '<pre>';print_r($cartData);exit;
      //       $same_order_id = NumericrandomKey(20);
      //       foreach ($cartData  as $key => $value) {
		// 			$unique_order_id = NumericrandomKey(5);
      //          $seller_product = getSingleRecord('seller_products', array('id'=>$value['id']));

		// 			$product = getSingleRecord('products', array('product_id'=>$value['product_id']));
      //               $seller_detail = getSingleRecord('user', array('user_id'=>$value['seller_id']));
      //          $discount_code = '';
      //          $discount_aplied = 0;
      //          $discount_amount = 0;
      //          if($this->session->userdata("coupon_code")){
      //             $discount_code = $this->session->userdata("coupon_code");
      //          }
      //          if($this->session->userdata("discount")){
      //             $discount_aplied = $this->session->userdata("discount");
      //             $discount_amount = ($final_value_on_product/100)*$this->session->userdata("discount");
      //          }
		// 			$data = array(
		// 			   'discount_code'=>$discount_code,
      //             'discount_aplied'=>$discount_aplied,
      //             'discount_amount'=>$discount_amount,

      //             'user_id' => $this->session->userdata('user_id'),
		// 				'payment_method_type'=>$payment_method_type,

		// 				'card_id'=>$card_id,
		// 				'card_title'=>$card_title,
		// 				'card_no'=>$card_no,
		// 				'card_expiry_month'=>$card_expiry_month,
		// 				'card_expiry_year'=>$card_expiry_year,
						
		// 				'address_country'=>$address_country,
		// 				'address_name'=>$address_name,
		// 				'address_street_address'=>$address_street_address,
		// 				'address_city'=>$address_city,
		// 				'address_state'=>$address_state,
		// 				'address_zip'=>$address_zip,
		// 				'address_phone_number'=>$address_phone_number,
      //             'sku'=>$product['sku'],
      //             'book_condition' => $seller_product['book_condition'],
      //             'book_title' => $product['title'],
		// 				'isbn'=>$product['isbn'],
		// 				'isbn13'=>$product['isbn13'],
		// 				'product_id' => $value['product_id'],
		// 				'qty' => $value['qty'],
		// 				'seller_id'=>$value['seller_id'],
		// 				'cart_row_id'=>$value['cart_row_id'],
		// 				'shipping_type'=>$value['shipping_type'],
		// 				'shipping_value'=>$value['shipping_amount'],
		// 				'final_value_on_product'=>$final_value_on_product,
		// 				'seller_products_id'=>$value['id'],
		// 				'price'=>$value['price']-$discount_amount,
		// 				'order_status'=>'Received',
		// 				'payment_status'=>'Paid',
		// 				'unique_order_id'=>$unique_order_id,
		// 				'same_order'=>$same_order_id,
		// 				'order_id'=>$order_id  
      //          );
      //          //echo '<pre>';print_r($data);exit;               
      //          $savedPrice = $value['price']-$discount_amount;
      //          $earnings = ($savedPrice+$value['shipping_amount'])-$final_value_on_product;

      //          $purchase_detail = $this->api_model->save('purchase', $data);
               	
      //          if($purchase_detail){
      //          	echo json_encode(Array('status'=> true, 'message' => 'Success', 'perchase_detail' => $purchase_detail));
      //          }else{
      //          	echo json_encode(Array('status'=> false, 'message' => 'Perchasing Not Found.'));
      //          } 
      //       }

	         /*$admin_email = getUserEmail('user', array('role_id'=>1));
	         $buyer_email = $this->session->userdata('email');
	         $seller_subject = 'Bookumbrella Order: Organic Chemistry As a Second Language'.$product['title'];
	         $buyer_subject = 'Order for produts has been submitted.';
	         $admin_subject = 'New Order Placed.';
	         $msg = '';

            foreach ($total_products as $seller_id => $products) {
               $total_price = 0;
               $msg = '<html><body bgcolor="#EDEDEE">';
               $email_notifications = $this->api_model->get("email_notifications",array("user_id"=>$seller_id));
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


            redirect('product/payment_success');*/
         // }else{
         //    	$this->session->set_flashdata('errors','Cart data not found!');
         //       redirect('product/checkout'); 
         //    }
      // }else {
      //       	redirect('login');
      //       }
   }


   public function productCategory(){
   	$product_category_record = $this->api_model->productCategoryRecord();
   	if ($product_category_record) {
            echo json_encode(Array('status'=> true, 'message' => 'Success', 'Product_by_category' => $product_category_record));
        }else{
           echo json_encode(Array('status'=> false, 'message' => 'Product Category Not Found'));
        }
   }

   public function productByCategory($category_id){
   	$product_by_category = $this->api_model->product_by_category($category_id);
   	if ($product_by_category) {
            echo json_encode(Array('status'=> true, 'message' => 'Success', 'Product_by_category' => $product_by_category));
        }else{
           echo json_encode(Array('status'=> false, 'message' => 'Product Category Not Found'));
        }
   }

   public function orderHistory(){
   	$order_record = $this->api_model->orderHistoryRecord();
   	
   	if ($order_record) {
            echo json_encode(Array('status'=> true, 'message' => 'Success', 'order_histroy' => $order_record));
        }else{
           echo json_encode(Array('status'=> false, 'message' => 'Order History Not Found'));
        }
   }

   /////////////////////////////////// Refund Payment //////////////////////////////////////

   public function refundPayment(){

   	$id = $this->input->post('id');
		$where = array('id'=>$this->input->post('id'));
		$refund_reason = $this->input->post('refund_reason');
		$itemData = array('refund_reason'=>$refund_reason,'order_status'=>'Refunded','payment_status'=>'Refunded');
	
		if($this->input->post('id')>0){
			$refund_order = $this->api_model->update('purchase', $where, $itemData);

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
         //do_email($this->session->userdata('email'), getAdminEmail(), $subject, $message);
         do_email("shoaibrauf302@gmail.com", getAdminEmail(), $subject, $message);

         ////////////////buyer email end //////////////////
         ////////////////seller email//////////////////
         $email_notifications = $this->comman_model->get("email_notifications", array("user_id" => $seller_id));
         $seller_email = $seller_details[0]['email'];

         if ($email_notifications != 0) {
            $seller_email = $email_notifications[0]['order_notification'];
         }
         do_email($seller_email, getAdminEmail(), $subject, $message);
			
			if ($refund_order) {
            echo json_encode(Array('status'=> true, 'message' => 'Success'));
        }else{
           echo json_encode(Array('status'=> false, 'message' => 'Payment  Has Not Refund'));
        }
		}
   }

    /////////////////////////////////// Cancel Payment //////////////////////////////////////

   public function cancelOrder(){

   	$id = $this->input->post('id');
		$reason_cancel = $this->input->post('reason_cancel');
		$data = array(
			'reason_cancel'=>$this->input->post('reason_cancel'),
			'order_status'=>'Cancelled',
			'updated_on'=>date("d-m-Y H:i:s",time())
		);

		$cancel_order = $this->comman_model->update('purchase',array('id'=>$id), $data);

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

      //do_email($this->session->userdata('email'), getAdminEmail(), $subject, $message);
      do_email("shoaibrauf302@gmail.com", getAdminEmail(), $subject, $message);

      ////////////////buyer email end //////////////////
      ////////////////seller email//////////////////

      $email_notifications = $this->comman_model->get("email_notifications", array("user_id" => $seller_id));
      $seller_email = $seller_details[0]['email'];

      if ($email_notifications != 0) {
         $seller_email = $email_notifications[0]['order_notification'];
      }
      
      do_email($seller_email, getAdminEmail(), $subject, $message);
      
      ////////////////seller email end //////////////////
      
		
				
		if($cancel_order){
			 echo json_encode(Array('status'=> true, 'message' => 'Successfull Order Cancelled.'));
		}else{
			 echo json_encode(Array('status'=> true, 'message' => 'Order Not Cancelled.'));
		}
   }
   /////////////////////////////////// book condition /////////////////////////////
   function book_condition(){
   		$data = [];
		$select_all = $this->input->get("select_all");
   		$filter = $this->input->get("book_condition");
   		if($filter == "Used"){
   			$data = ["Like New","Very Good","Good","Acceptable"];
   		}elseif($filter){
			$data = [$filter];
		}elseif($select_all == "all_select"){
			$data = ["New","Like New","Very Good","Good","Acceptable"];
		}
		
   		$filter = $this->api_model->filter_condition("seller_products",$data);
   		if($filter){
   			echo json_encode(Array('status'=> true, 'message' => 'Success', 'book_condition' => $filter));
   		}else{
   			echo json_encode(Array('status'=> false, 'message' => '404 Error'));
   		}
   }
   /////////////////////////////// book type /////////////////////
   public function book_type(){
		$data = [];
	   	$select_all = $this->input->get("select_all");
   		$book_type = $this->input->get("book_type");

		if(!empty($select_all == "all_select")){
			$data = ["Internation Edition","Teachers Edition","Work Book","Library Copy","Study Guide"];
		}elseif($book_type){
			$data = [$book_type];	
		}
		
		
   		$book_type = $this->api_model->book_type("seller_products",$data);
	 
   		if($book_type){
   			echo json_encode(Array('status'=> true, 'message' => 'Success', 'book_type' => $book_type));
   		}else{
   			echo json_encode(Array('status'=> false, 'message' => '404 Error'));
   		}
   	}

   /////////////////////////// book Isbn ///////////////////////////

    public function book_isbn(){
		$data = [];
		$book_isbn = $this->input->get("book_isbn");

		if(!empty($book_isbn)){
			$data = [$book_isbn];
		}
   		$book_isbn = $this->api_model->book_isbn("seller_products",$data);
		if($book_isbn){
			echo json_encode(Array('status'=> true, 'message' => 'Success', 'book_isbn' => $book_isbn));
		}else{
			echo json_encode(Array('status'=> false, 'message' => '404 Error'));
		}
   }

   public function search(){
		$or_where = [];
		$search = trim($this->input->get("search"));
		$category = $this->input->get('cat');

   		if ($search != '') {
		            
			if($category=='keyword'){
				$or_where['advertiser_name'] = $search;
				$or_where['isbn'] = $search;
				$or_where['isbn13'] = $search;
				$or_where['author_name'] = $search;
				$or_where['title'] = $search;
			}
			if($category=='publisher'){
				$or_where['advertiser_name'] = $search;	
			}
			if($category=='isbn'){
				$or_where['isbn'] = $search;
				$or_where['isbn13'] = $search;
				
			}
			if($category=='title'){
				$or_where['title'] = $search;	
			}
			if($category=='author'){
				$or_where['author_name'] = $search;	
			}
		        
		}
		$search_record = $this->api_model->search('seller_products',$or_where);
		if($search_record){
   			echo json_encode(Array('status'=> true, 'message' => 'Success', 'search' => $search_record));
   		}else{
   			echo json_encode(Array('status'=> false, 'message' => '404 Error'));
   		}
   	
   }
   	public function social_login(){
		$google_id = $this->input->post("google_id"); 
		$facebook_id = $this->input->post("fb_user_id");
		if($google_id){
			$google_response_data = $this->api_model->google_login($google_id);
			if($google_response_data){
				echo  json_encode(['status'=> true, 'message' => 'Success', 'user' => $google_response_data]);
			}else{
				$first_name = $this->input->post("firs_name");
				$last_name = $this->input->post("last_name");
				$email = $this->input->post("email");
				$gender = $this->input->post("gender");
				$dob = $this->input->post("dob");
				$phone = $this->input->post("phone");
				$address = $this->input->post("address");
				$address2 = $this->input->post("address2");
				$postal_code = $this->input->post("postal_code");
				$interests = $this->input->post("interests");
				$city = $this->input->post("city");
				$country = $this->input->post("country");
				$state = $this->input->post("state");

				$profile_image = $_FILES['avatar']["tmp_name"];
				if(!empty($profile_image)){
					$config['upload_path'] = './uploads/img_gallery/user_images/';
					$config['allowed_types'] = 'gif|jpg|png|jpeg';
					$config['max_size'] = '1000';
					$config['max_width']  = '1024';
					$config['max_height']  = '768';
					$config['overwrite'] = TRUE;
					$config['encrypt_name'] = FALSE;
					$config['remove_spaces'] = TRUE;
		
					$this->load->library('upload', $config);
					if($this->upload->do_upload('avatar')) {
						$res =  $this->upload->data();
						
						$fileName = $res['raw_name'].$res['file_ext'];
						
					}
				}
				 
				$google_data = [
					"first_name" => $first_name,
					"last_name" => $last_name,
					"email" => $email,
					"phone" => $phone,
					"dob" => $dob,
					"gender" => $gender,
					"address" => $address,
					"address2" => $address2,
					"postal_code" => $postal_code,
					"interests" => $interests,
					"city" => $city,
					"state" => $state,
					"country" => $country,
					"avatar" => $fileName,
					"google_id" => $google_id,
				];
				$goog_response = $this->api_model->custom_google_login($google_data);
				if($goog_response){
					$google_response_data = $this->api_model->social_record($goog_response);
					echo json_encode(["status"=>"Successfull","message"=>"Successfully Inserted.","user"=>$google_response_data]);
				}else{
					echo json_encode(["status"=>"No Success","message"=>"404 Error"]);
				}
			}

		}
		elseif($facebook_id){
			$facebook_response_data = $this->api_model->facebook_login($facebook_id);
			if($facebook_response_data){
				echo  json_encode(['status'=> true, 'message' => 'Success', 'user' =>$facebook_response_data]);
			}else{
				$first_name = $this->input->post("firs_name");
				$last_name = $this->input->post("last_name");
				$email = $this->input->post("email");
				$gender = $this->input->post("gender");
				$dob = $this->input->post("dob");
				$phone = $this->input->post("phone");
				$address = $this->input->post("address");
				$address2 = $this->input->post("address2");
				$postal_code = $this->input->post("postal_code");
				$interests = $this->input->post("interests");
				$city = $this->input->post("city");
				$country = $this->input->post("country");
				$state = $this->input->post("state");

				$profile_image = $_FILES['avatar']["tmp_name"];
				if(!empty($profile_image)){
					$config['upload_path'] = './uploads/img_gallery/user_images/';
					$config['allowed_types'] = 'gif|jpg|png|jpeg';
					$config['max_size'] = '1000';
					$config['max_width']  = '1024';
					$config['max_height']  = '768';
					$config['overwrite'] = TRUE;
					$config['encrypt_name'] = FALSE;
					$config['remove_spaces'] = TRUE;
		
					//if(!is_dir($config['upload_path']) ) die("THE UPLOAD DIRECTORY DOES NOT EXIST");
					$this->load->library('upload', $config);
					if($this->upload->do_upload('avatar')) {
						$res =  $this->upload->data();
						$fileName = $res['raw_name'].$res['file_ext'];
						
					}
				}
				
				$facebook_data = [
					"first_name" => $first_name,
					"last_name" => $last_name,
					"email" => $email,
					"phone" => $phone,
					"dob" => $dob,
					"gender" => $gender,
					"address" => $address,
					"address2" => $address2,
					"postal_code" => $postal_code,
					"interests" => $interests,
					"city" => $city,
					"state" => $state,
					"country" => $country,
					"avatar" => $fileName,
					"fb_user_id" => $facebook_id,
				];

				$fb_response = $this->api_model->custom_facebook_login($facebook_data);
				if($fb_response){
					
					$user = $this->api_model->social_record($fb_response);
					echo json_encode(["status"=>"Successfull","message"=>"Successfully Inserted.","user"=>$user]);
				}else{
					echo json_encode(["status"=>"No Success","message"=>"404 Error"]);
				}
			}
		}else{
			echo json_encode(['status'=> false, 'message' => 'Social Has been Required']);
		}
   }

   


}
	
?>