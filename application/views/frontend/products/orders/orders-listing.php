<?php
   
    $currentUserData = getUserData(getCurrentUserId());
?>






<style type="text/css">
    .ui-widget-header {
    border: 1px solid #4b2354;
    background: #4b2354 url(image/ui-bg_gloss-wave_35_f6a828_500x100.png) 50% 50% repeat-x;
    color: #ffffff;
    font-weight: bold;
}
.toggle_orders{
    padding: 0 5px;
    border-radius: 5px;
}
.active_btn {
    background: #fff none repeat scroll 0 0;
    color: #000 !important;
}
.product-col.list .image {
    float: left;
    padding: 10px 0px 10px 10px;
}
.detailarea{
	    padding: 10px 0 0 10px !important;
}
.detailarearight{
	 padding: 10px 0 0 10px !important;
}
.detailarea h4{
    margin-top:0px !important;
    margin-bottom:0px !important;
}
.product-col:hover{
	background-color:#f5f5f5;	
}
td, th {
    padding: 0 6px;
}
.detailfilter{
padding: 15px;
z-index:9999;
position:relative;
border: 1px solid #ddd;
  
    
}
.detailarea a{
    color:#bb9870 !important;
    text-decoration-color:#bb9870;
}
.order_table {
 
    box-shadow: none;

}
.refnd{
    color:white;
    background:#bb9870 !important;
    transition:.3s;
    border:1px solid #bb9870 !important;
}
.refnd:hover{
    background:#323232 !important;
    border:1px solid #323232 !important;

}
 
.print{
    color:white;
    background:#bb9870 !important;
    transition:.3s;
    border:1px solid #bb9870 !important;
    

}

.print:hover{
    background:#323232 !important;
    border:1px solid #323232 !important;

}
input.btn.btn-primary.cncl_btn{
 background:#323232 !important;
 border:1px solid #323232 !important;   
}
input.btn.btn-primary.cncl_btn:hover{
 background:#bb9870 !important;
 border:1px solid #bb9870 !important;   
}

input[type=checkbox], input[type=radio] {
    margin-right: 13px !important;
    accent-color:#bb9870;
    height:15px;
}
@media screen and (min-device-width: 320px) and (max-device-width: 767px) { 
.detailfilter
{
overflow-x: auto;

}
}
</style>
<style>
.nagitive_bar {
  position: relative;
  width: 100%;
  height: 10px;
  background-color: #ddd;
  margin-bottom: 5px;
}

.positive_bar {
  position: absolute;
  width: 0%;
  height: 100%;
  background-color: #4CAF50;
}
.p0
{
	padding:0px !important;
}
a#export_refund_sales {
    background: #bb9870 !important;
    color: #fff;
    border-radius: 2px;
}
a#export_refund_sales:hover {
background: #323232 !important; 

}

input#search {
    background: #bb9870 !important;
    color: #fff;
    border-radius: 2px;
}
input#search:hover {
   background: #323232 !important; 

}
@media screen and (min-device-width: 320px) and (max-device-width: 767px) { 
.label_sm
{
	font-size:18px;
}
.btn-primary
{
	margin-bottom:3px;
}
.mrg_left_up
{
	padding-left:18px;
}
section
{
	padding:0px !important;
}
}
</style>



<div class="col-xs-12 ">
    <div class="container frontend-dashboard-cont  p0">
        <div class="row no-padding">
            <div class="col-sm-12 col-xs-12 p0">

                <section style="padding-bottom: 50px; padding-top: 50px; padding:0px;">

                    <?php if (isset($errors)) { ?>
                        <div class="alert alert-danger"> <?php print_r($errors); ?></div><?php } ?>
                    <?php if (isset($success)) { ?>
                        <div class="alert alert-success"> <?php print_r($success); ?></div><?php } ?>

                    <!--dashbord start-->
                    <div class="dashbord_inno">
                        <div class="container">
                            
                        
                            
                            
                            
                             <div class="row">
                            <div class=" detailfilter" >
                           
                            <form name="search" action="<?php echo base_url('orders_listing');?>" method="post">
                            <table cellpadding="0" cellspacing="0" style="margin-top:15px;" >
                            <tr>
                            

                            <td align="left"><strong>Order Status:</strong>
                               
                            </td>
                            
                            
                            
                             
                         
                            
 							<td align="left">
                             <select class="form-control" onChange="filter_orders()" name="order_status"  id="order_status">
                                    <option value="">All Orders</option>
                                    <option  <?php if($this->input->get('orders_of')=='Pending') { ?> selected <?php } ?> value="Pending">Open Orders</option>
                                    
                                    <option <?php if($this->input->get('orders_of')=='Refunded') { ?> selected <?php } ?> value="Refunded">Refunded Orders</option>
                                    <option  <?php if($this->input->get('orders_of')=='Delivered') { ?> selected <?php } ?> value="Delivered">Delivered Orders</option>
                                    <option  <?php if($this->input->get('orders_of')=='Cancelled') { ?> selected <?php } ?> value="Cancelled">Cancelled Orders</option>
                                </select>

                            </td>
                            
                            
                             <td align="left">
                             <strong>Orders of:</strong>
							
                            </td>
                            
                            <td align="left">
                            <select class="form-control" onChange="filter_orders()" name="orders_of"  id="orders_of">
                            
                            	<option value="" selected>All</option>
                              <option  <?php if($this->input->get('orders_of')=='Today') { ?> selected <?php } ?> value="Today">Today</option>
                                <option  <?php if($this->input->get('orders_of')=='This Month') { ?> selected <?php } ?> value="This Month">This Month</option>
                                <option  <?php if($this->input->get('orders_of')=='Last 6 Month') { ?> selected <?php } ?> value="Last 6 Month">Last 6 Month</option>

                                <option  <?php if($this->input->get('orders_of')=='2016') { ?> selected <?php } ?> value="2016">2016</option>
                                <option  <?php if($this->input->get('orders_of')=='2015') { ?> selected <?php } ?>  value="2015">2015</option>
                                <option  <?php if($this->input->get('orders_of')=='2014') { ?> selected <?php } ?>  value="2014">2014</option>
                                <option  <?php if($this->input->get('orders_of')=='2013') { ?> selected <?php } ?> value="2013">2013</option>
                                
                                
                            </select>
                            
                            </td>
                            
                            </tr>
                            
                            <tr >
                            

                            
                            
                            
                             <td  align="left"><strong>Order Id/ISBN:</strong>
							
                                
								
                            </td>
                            
                            <td align="left">
                           
                            <input value="<?=$this->input->get('unique_order_id');?>" class="form-control" type="text" id="unique_order_id" />
                            </td>
                            <td align="left" style="padding-top:20px;">
                               <select class="form-control" name="search_by"  id="search_by">
                                    <option <?php if($this->input->get('search_by')=='isbn') { ?> selected <?php } ?> value="isbn">ISBN-10</option>
                                    <option <?php if($this->input->get('search_by')=='isbn13') { ?> selected <?php } ?> value="isbn13">ISBN13</option>
                                    <option <?php if($this->input->get('search_by')=='unique_order_id') { ?> selected <?php } ?> value="unique_order_id">Order Id</option>
                                </select>&nbsp; 
                            </td>
                            
                            
                            
                             
                         
                            
 							<td align="left">
							
                             <input class="btn btn-cart"   type="button" name="search" onClick="filter_orders()" id="search" value="Search">

                            </td>
                            </tr>
                            
                            
                            </table>
                            </form>
</div>
                         </div>
                            <div class="clearfix"></div>

                            <div class="row">
                                <div class="col-lg-12 co-md-12 col-sm-12" style="padding:0;">	
                                    <div class="order_table">
                                        <h2><a href="javascript:void(0)" class="toggle_orders active_btn label_sm" id="my_orders">Orders Listing (<?=$total_my_orders?>)</a> 
                                           <a href="javascript:void(0)" class="btn btn-cart pull-right" id="export_refund_sales" onclick="export_orders()">Export</a>
                                           
                                        </h2>
                                        <div class="order_content my_orders">
                                            <div class="col-lg-12 co-md-12 col-sm-12" style="padding:0;">
                                                
                                                <?php if($my_orders) {
												?>
												
												<form name="FulfillPendingOrdersF" id="FulfillPendingOrdersF" action="<?php echo base_url();?>" method="post" />
												<?php
												foreach($my_orders as $row){	
												//echo '<pre>';print_r($row);exit;
												$user = $this->comman_model->get('user',array('user_id'=>$row['user_id']));
												$seller = $this->comman_model->get('user',array('user_id'=>$row['seller_id']));
												$product = $this->comman_model->get('products',array('product_id'=>$row['product_id']));
												$ratings = getRating($row['seller_id']);
												
												//echo '<pre>';print_r($row);
												//echo '<pre>';print_r($product);
													 ?>
                                                        
                                                        
                                                        
                                                        
                                                        <div class="product-col list clearfix col-sm-12" style="border-bottom:1px dotted #bb9870;">
          <div class="image col-sm-1">
            <a href="<?php echo base_url("product/detail")."/"?><?php echo encode_url($product[0]['product_id'])?>">
            <img class="img-responsive" style="width:94px; height:140px;" alt="product" src="<?php echo base_url()?><?php echo $product[0]['image']?>"> </a></div>
            
            
          <div class="col-xs-12 col-sm-6 detailarea">
			<div>
                <h4 style="margin-bottom:0px; font-weight:bold;"><?php echo $product[0]['title']?></h4>
                <strong style="color:#000"> Author:</strong><span style="color:#bb9870;"><?php echo $product[0]['author']?></span></span> <br>
                <strong> ISBN-10:</strong><span><?php echo $product[0]['isbn']?></span><strong> ISBN-13:</strong><span><?php echo $product[0]['isbn13']?></span><br>
                <strong> Quantity:</strong><span><?php echo $row['qty']?></span> <strong> Formate:</strong><span><?php echo $product[0]['format']?></span> | <strong> Edition:</strong><span><?php echo $product[0]['edition']?></span><br>
                <strong> Condition:</strong><span><?php echo $product[0]['book_condition']?></span> <strong> Type:</strong><span><?php echo $product[0]['book_type']?></span><br>
                <strong style="color:#000"> Seller:</strong><span style="color:#bb9870"><?php echo $seller[0]['username']?></span></span> <br>

<?php //echo '<pre>';print_r($row);?>
<a href="javascript:;" id="<?php echo $row['id']?>" onClick="ShowContactSellerModal_<?php echo $row['id']?>(<?php echo $row['id']?>)" >Contact Seller</a> | 
<a href="javascript:;" onClick="ShowAddressDetailModal_<?php echo $row['id']?>(<?php echo $row['id']?>)" >Shipping Address</a>
<br>

<!-- <strong>Seller: </strong><span><?php echo $seller[0]['username'];?></span> -->


         
            
            
<script>
    function ShowContactSellerModal_<?php echo $row['id']?>(id){
$('#ContactSellerModal_'+id).modal('show');

}
function ShowAddressDetailModal_<?php echo $row['id']?>(id){	
$('#AddressDetailModal_'+id).modal('show');

}

</script>
<div id="ContactSellerModal_<?php echo $row['id']?>" class="modal fade" role="dialog" style="z-index:999999">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="color:#0C0; font-weight:bold;" >Send Message</h4>
      </div>
      <div class="modal-body">
      <div class="product-filter product_mobile" style="border:0 none;">
        <div class="product-compare" style="color:#666;">
        	

        	                                        <div class="form-group">
                                            <label for="title">Subject</label>
                                            <input id="message_subject_<?php echo $row["id"]?>" class="form-control" name="title" type="text">
                                        </div>

        	                                        <div class="form-group">
                                            <label for="category">Category</label>
                                            <select id="category_<?php echo $row["id"]?>" class="form-control" name="category">
                                            	<option value="Unhappy">Unhappy</option>
                                                <option value="Defected Book">Defected Book</option>
                                            </select>
                                        </div>                                        

        	                            <div class="form-group">
                                            <label for="message">Message</label>
                                            <textarea class="form-control" name="message" id="body_message_<?php echo $row["id"]?>"></textarea>
                                        </div>                                        
	                                
                          
         
         
         
        <input type="hidden" name="seller_id" id="seller_id" value="<?php echo $row["seller_id"]?>" />
        <input type="hidden" name="message_by" id="message_by" value="seller" />                                                                            
                                                                            
        <input type="button" class="btn btn-primary" onClick="SendMessage(<?php echo $row["seller_id"]?>,<?php echo $row["id"]?>)" name="submit" id="submit" value="Send" />                                                                            
        </div>
        

        </div>
        
        
        
      </div>
      
      
      
   
    </div>

  </div>
</div>


<div id="AddressDetailModal_<?php echo $row['id']?>" class="modal fade" role="dialog" style="z-index:999999">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="color:#0C0; font-weight:bold;" >My Address Details</h4>
      </div>
      <div class="modal-body">
      <div class="product-filter product_mobile" style="border:0 none;">
        <div class="product-compare" style="color:#666;">
          <strong style="color:#000;">Country:</strong><?php echo $row["address_country"];?><br>

          
         
         

                                            <strong style="color:#000;">Full Name:</strong>
                                            
											<?php echo $row["address_name"];?><br>

                                            <strong style="color:#000;">Street Address:</strong>
                                            <?php echo $row["address_street_address"];?><br>

                                            <strong style="color:#000;">City: </strong>
                                            <?php echo $row["address_city"];?><br>

                                            <strong style="color:#000;">State/Province/Region:</strong>
                                      <?php echo $row["address_state"];?><br>

                                            <strong style="color:#000;">Zip:</strong>
                                            <?php echo $row["address_zip"];?><br>

                                            <strong style="color:#000;">Phone Number:</strong>
											<?php echo $row["address_phone_number"];?>
                                        
                          
         
         
         
                                                                            
                                                                            
        </div>
        </div>
        
        
        
      </div>
      
      
      
   
    </div>

  </div>
</div>


               
               


 
                
                
            </div>
       
                
          
        </div>
        <div class="col-xs-12 col-sm-5 detailarearight" style="border-left: 1px solid #ddd;">
            <div>
                <strong> Order Id: </strong><span><?php echo $row['unique_order_id']; ?></span><br>
                <strong> Order Date: </strong><span><?php echo $row['created_on']; ?></span> <br>
                <strong> Product Price: </strong><span><?php echo $row['price']; ?></span>&nbsp;
                <strong> Shipping: </strong><span>$<?php echo $row['shipping_value']; ?>(<?php echo $row['shipping_type']; ?>)</span>&nbsp;
                <strong > Order Total: </strong><span><?php echo $row['price'] + $row['shipping_value']; ?></span>
                <br>
                <strong> Order Status: </strong><span><?php echo $row['order_status']; ?></span>             <strong> Payment Status: </strong><span><?php echo $row['payment_status']; ?></span> <br>
                <?php 
				if($row['order_status'] == 'Cancelled'){
				?>
				<strong> Cancel Reason: </strong><span><?php echo $row['reason_cancel']; ?></span></br>
				<?php	
					
					}
				?>
                <?php 

                  if(($row['order_status']=='Paid' || $row['order_status']=='Received') && $row['tracking_id']==''){ ?>
                      <strong> Tracking Id: </strong><span>N/A</span>
                      <strong> Carrier: </strong><span>N/A</span> 
                      <br>
                      <?php
                    
                          }
                      ?>


                <?php
                if($row['order_status']=='Delivered') { ?>
                  <strong> Tracking id : </strong><span><?php echo $row['tracking_id']; ?></span>
                  <strong> Carrier : </strong><span><?php echo $row['carrier']; ?></span>
                  <br>
                <?php }

                ?>

                <?php $areadyRated = isRated($row['seller_products_id'], $row['seller_id'], $row['product_id'], $this->session->userdata('user_id'),$row['id']);
                if($areadyRated || $row['order_status']!='Delivered'){ ?>
                <div style="float: left; font-size: 20px; margin-top: 3px;">  <strong>Leave Feedback</strong></div>
                <div class="rateit bigstars" style="margin-top:0px;"
                     data-sellerProductId="<?php echo $row['seller_products_id'];?>"
                     data-uniqueOrderId="<?php echo $row['id'];?>"
                     data-productId="<?php echo $row['product_id'];?>"
                     data-sellerId="<?php echo $row['seller_id'];?>"
                     data-rateit-value="<?php echo $ratings['total_rating']; ?>"
                     data-rateit-step="1"
                     data-rateit-resetable="false"
                     data-rateit-starwidth="32"
                     data-rateit-starheight="32" data-rateit-readonly="true">
                    </div><?php echo $ratings['total_rating']; ?>
                <?php }else{ ?>
                  <div style="float: left; font-size: 20px; margin-top: 3px;">  <strong>Leave Feedback</strong></div>
                <div class="rateit bigstars addrating" style="margin-top:0px;"
                     data-sellerProductId="<?php echo $row['seller_products_id'];?>"
                     data-uniqueOrderId="<?php echo $row['id'];?>"
                     data-productId="<?php echo $row['product_id'];?>"
                     data-sellerId="<?php echo $row['seller_id'];?>"
                     data-rateit-value="<?php echo $ratings['total_rating']; ?>"
                     data-rateit-step="1"
                     data-rateit-resetable="false"
                     data-rateit-starwidth="32"
                     data-rateit-starheight="32">
                    </div><?php echo $ratings['total_rating']; ?>
                <?php }
                ?>
                <br>

                <?php 

                  if(($row['order_status']=='Paid' || $row['order_status']=='Received') && $row['tracking_id']==''){ ?>
                      <input class="btn btn-cart" type="button" name="cancel_order" onClick="CancelOrder(<?php echo $row['id']; ?>)" id="cancel_order" value="Cancel">
                      <?php
                    
                          }
                      ?>
<?php 
if($row['order_status']!='Refunded' && $row['order_status']!='Cancelled') {  
	?>
	<a href="javascript:;"  onClick="RefundOrder(<?php echo $row['id']?>)" class="btn btn-primary refnd">Refund</a>
	<?php
				}
?>
                    <?php
                    if( $row['order_status']=='Cancelled'){

                    }else{
                        ?>
                        <a href="<?php echo base_url('print_order').'/'.$row['order_id']; ?>"  target="_blank" class="btn btn-primary print" >Print</a>
                        
                        <?php
                    }
                    ?>
                
<div id="block_reasons_cancel_<?php echo $row['id']; ?>"  name="block_reasons_cancel_<?php echo $row['id']; ?>" style="display:none;">
                      <select class="form-control" style="margin-top: 12px;
                          width: 80%;
                          float: left;
                          margin-right: 5px;" id="reasons_cancel_<?php echo $row['id']; ?>" name="reasons_cancel_<?php echo $row['id']; ?>">
                        <option value="">Select Reason</option>
                          <option value="Wrong Book">Wrong Book2</option>
                          <option value="Low Quality">Low Quality</option>
                          <option value="Late Deliver">Late Deliver</option>
                      </select>
                      <input class="btn btn-cart" style="margin-top: 10px;"   type="button" name="save_cancel_order" onClick="SaveCancelOrder(<?php echo $row['id']; ?>)" id="save_cancel_order" value="Save">
                      </div>

                <div id="block_reasons_refund_<?php echo $row['id']; ?>"  name="block_reasons_refund_<?php echo $row['id']; ?>" style="display:none;">
                    <select class="form-control" style="    margin-top: 12px;
    width: 80%;
    float: left;
    margin-right: 5px;" id="reason_refund_<?php echo $row['id']; ?>" name="reason_refund_<?php echo $row['id']; ?>">
                        <option value="">Select Reason</option>
                        <option value="Wrong Book">Wrong Book1</option>
                        <option value="Low Quality">Low Quality</option>
                        <option value="Late Deliver">Late Deliver</option>
                    </select>
                    <input class="btn btn-cart" style="margin-top: 10px;"   type="button" name="save_refund_order" onClick="SaveRefundOrder(<?php echo $row['id']; ?>)" id="save_refund_order" value="Save">

                </div>

<?php



				?>





                <?php
					?>


					<?php
					$adre = '<strong>City:</strong>';

					?>

               
               
               
            



               
               
        
        
        
                
             <br>
             
            
           
              
				<input style="display:inline;width:18px; float:right; margin-top:-112px !important;" align="right" type="checkbox" name="order_id[]" id="order_id" value="<?php echo $row['id']?>" />  
                <br>

                
               
                </div>
                
               
            <div class="cart-button button-group"> 
            
                <?php /*?><a class="btn btn-cart" type="button" href="http://localhost/bookumbrella/product/detail/do21Fc7vXd2827017281161498EOD8NAVV" title="View Detail">
                                 View Detail
                                 
                             </a><?php */?>
                             
                             
           
            </div>
          </div>
      </div>
                                                        
                                                        
                                                <?php 
												}
												?>
                                                <div style="clear:both; height:12px;"></div>
                                        



												<div class="form-group mrg_left_up" style="float:right;">
                                                
                                                <input type="submit"  class="btn btn-primary" name="submit" onClick="AllOrders('tracking')" value="Update All" />
                                                &nbsp;
                                                <input type="submit"  class="btn btn-primary cncl_btn" name="submit"  onClick="AllOrders('cancel')"  value="Cancel All" />
												Select All<input type="checkbox" style="margin-right:10px; margin-left:5px;" name="select_all" id="select_all" /></div>
                                                </form>
												<?php
												} else { ?>
                                                    <?php echo adminRecordNotFoundMsg(); ?>
                                                <?php } ?>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>

<!-- ============= -->
                                        
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!--dashbord end-->
                </section>
            </div>
        </div>
    </div>
</div>

<script type="application/javascript">
  $(document).ready(function(){
    $('#order_status').val('<?php echo $this->input->get('order_status'); ?>');
    $('#payment_status').val('<?php echo $this->input->get('payment_status'); ?>');
    $('#orders_of').val('<?php echo $this->input->get('orders_of'); ?>');
    //$('#created_on').val('<?php echo $this->input->get('created_on'); ?>');
    $('#created_on').datepicker({});

    $('.toggle_orders').click(function(){
        var cls = $(this).attr('id');
        $('.order_content').hide();
        $('.'+cls).show();
        $('.toggle_orders').removeClass('active_btn');
        $(this).addClass('active_btn');
    })
  
  
    var rating;

    $(".addrating").click(function () {
        rating = $(this);
        var stars = rating.rateit('value');
        $('#no_stars').val(stars);
        //alert(rating.attr('data-sellerProductId'));
        //if(already_rated(rating)){
        //    alert('You already rate this palce.');
        //}else{
        //  $('#ratingtModal').modal('show');  
        //}
        $('#ratingtModal').modal('show'); 
        rating.rateit('reset');
    });

/*$(".addrating").click(function () {
        rating = $(this);
        var stars = rating.rateit('value');
        $('#no_stars').val(stars);
        
        jQuery.ajax({
            type: "POST",
            url: '<?php echo base_url('product/alreadyRated'); ?>',
            data:   {   'seller_product_id': rating.attr('data-sellerProductId'),
                        'product_id': rating.attr('data-ProductId'),
                        'seller_id': rating.attr('data-sellerId'),
                        'no_stars': $('#no_stars').val(),
                        'comments': $('#comments').val(),
                        'item_arrived_due_time': $('#item_arrived_due_time').val(),
                        'item_was_as_described': $('#item_was_as_described').val(),
                        'prompt_courtesy': $('#prompt_courtesy').val()
                    },
            dataType: 'json',
            error: function (request, error) {
                rating.rateit('reset');
                alert('There is an error.Try Again');
                //jQuery('#eventError').html('There is an error.Try Again').show();
              },
            success: function (response) {
                //alert(response.);return false;
                if (response.success) {
                    if(response.already_voted){
                        alert('You already rate this palce.');
                    }else{
                        $('#ratingtModal').modal('show'); 
                    }
                
                }else{
                    rating.rateit('reset');
                    alert('Please login to rate this seller.');
                }
            }
        });//End ajax
        
        rating.rateit('reset');
});*/

  $('.add-rating-btn').click(function(){
        jQuery.ajax({
            type: "POST",
            url: '<?php echo base_url('product/addRatings'); ?>',
            data:   {   'seller_product_id': rating.attr('data-sellerProductId'),
			'unique_order_id': rating.attr('data-uniqueOrderId'),
                        'product_id': rating.attr('data-ProductId'),
                        'seller_id': rating.attr('data-sellerId'),
                        'no_stars': $('#no_stars').val(),
						'comments': $('#comments').val(),
                        'item_arrived_due_time': $('#item_arrived_due_time').val(),
                        'item_was_as_described': $('#item_was_as_described').val(),
                        'prompt_courtesy': $('#prompt_courtesy').val()
                    },
            dataType: 'json',
            error: function (request, error) {
                rating.rateit('reset');
                alert('There is an error.Try Again');
                //jQuery('#eventError').html('There is an error.Try Again').show();
              },
            success: function (response) {
               // console.log(response);
                if (response.success) {
                    if(response.already_voted){
                        rating.rateit('reset');
                        alert('You already rate this palce.');
                    }else{
                        rating.rateit('value', response.ratings);
                        $('#total_votes').html(response.total_votes);
                        rating.siblings('.item_arrived_due_time_nagitive').find('.item_arrived_due_time_positive').css( "width", response.item_arrived_due_time+"%" );
                        rating.siblings('.item_was_as_described_nagitive').find('.item_was_as_described_positive').css( "width", response.item_was_as_described+"%" );
                        rating.siblings('.prompt_courtesy_nagitive').find('.prompt_courtesy_positive').css( "width", response.prompt_courtesy+"%" );
                        $('#ratingtModal').modal('hide');
                        location.reload();
                    }
                
				}else{
                    rating.rateit('reset');
                    alert('Please login to rate this seller.');
                }
            }
        });//End ajax
    })
	
	
	
  });

function already_rated(rating){
    jQuery.ajax({
            type: "POST",
            url: '<?php echo base_url('product/alreadyRated'); ?>',
            data:   {   'seller_product_id': rating.attr('data-sellerProductId'),
                        'product_id': rating.attr('data-ProductId'),
                        'seller_id': rating.attr('data-sellerId'),
                        'no_stars': $('#no_stars').val(),
                        'comments': $('#comments').val(),
                        'item_arrived_due_time': $('#item_arrived_due_time').val(),
                        'item_was_as_described': $('#item_was_as_described').val(),
                        'prompt_courtesy': $('#prompt_courtesy').val()
                    },
            dataType: 'json',
            error: function (request, error) {
                rating.rateit('reset');
                alert('There is an error.Try Again');
                //jQuery('#eventError').html('There is an error.Try Again').show();
              },
            success: function (response) {
                //alert(response.);return false;
                if (response.success) {
                    if(response.already_voted){
                        return true;
                    }else{
                        return false;
                    }
                
                }else{
                    rating.rateit('reset');
                    alert('Please login to rate this seller.');
                }
            }
        });//End ajax
}

	function filter_orders(obj){
        var query_str = '';
		
		if($('#unique_order_id').val()!=''){
          query_str += '&unique_order_id='+$('#unique_order_id').val();
		  
		  query_str += '&search_by='+$('#search_by').val();
		  
        }
        
        if($('#order_status').val() != ''){
            query_str += '&order_status='+$('#order_status').val();
        }
        if($('#payment_status').val() != ''){
            //query_str += '&payment_status='+$('#payment_status').val();
        }
       
        if($('#orders_of').val() != ''){
            query_str += '&orders_of='+$('#orders_of').val();
        }
        if(query_str!=''){
          query_str = encodeURI('?'+query_str);  
        }
        
        window.location.href = '<?php echo base_url('orders_listing'); ?>'+query_str;
    }

    $('body').on('submit','#dashboard-update-profile',function(e){

        e.preventDefault();

        var actionUrl = '<?php echo base_url('update_user_profile');?>';
        var formData = $(this).serializeArray();
        var loaderObj = $('.profile-update-loader');
        var responseMsgCont = $('.update-prof-response-cont');

        resetProfileUpdateResponse();

        $.ajax({
            url:actionUrl,
            type:'post',
            data:formData,
            success:function(response){
//                console.log(response);return;

                var decodedResponse = $.parseJSON(response);
                var dialogueDisplayTime = 7000;

                loaderObj.hide();
                responseMsgCont.show();

                if(decodedResponse){
                    var respMsg = decodedResponse['msg'];
                    var respStatus = decodedResponse['status'];

                    responseMsgCont.show();
                    responseMsgCont.find('.alert').text(respMsg);

                    if(respStatus){
                        responseMsgCont.find('.alert').addClass('alert-success');
                        $('#dashboard-update-profile').find('input[name="current_password"]').val('');
                        $('#dashboard-update-profile').find('input[name="password"]').val('');
                        $('#dashboard-update-profile').find('input[name="password_confirm"]').val('');
                    } else {
                        responseMsgCont.find('.alert').addClass('alert-danger');
                    }

                    setTimeout(function(){
                        responseMsgCont.hide('medium');
                    }, dialogueDisplayTime);
                }
            }
        });
    });

    function resetProfileUpdateResponse(){
        var responseMsgCont = $('.update-prof-response-cont');
        var loaderObj = $('.profile-update-loader');

        loaderObj.show();
        responseMsgCont.hide();

        responseMsgCont.find('.alert').removeClass('alert-danger alert-success');
    }
	function CancelOrder(id){
        $("#block_reasons_refund_"+id).hide();
			$("#block_reasons_cancel_"+id).toggle();
		}
function RefundOrder(id){
	    //alert("aksjdf");
    $("#block_reasons_cancel_"+id).hide();
			$("#block_reasons_refund_"+id).toggle();
            
		}

function SaveCancelOrder(id){
	


if($("#reasons_cancel_"+id).val() == "")//day
{

 alert("Please choose cancel reason");
  return false;
}


var reason_cancel =$("#reasons_cancel_"+id).val();








	var dataString = "reason_cancel=" + reason_cancel+"&id=" + id; 
 
 //alert(dataString);
 
 
    $.ajax({
        type: "POST",
		
        url: "<?php echo base_url('ajax_cancel_order');?>",
        data: dataString,
        success: function (data) {
			alert(data);
			location.reload();
			
			
			
        }
    });



	
	
	
	}
		
	$('#select_all').click(function(event) {
  if(this.checked) {
      // Iterate each checkbox
      $(':checkbox').each(function() {
          this.checked = true;
      });
  }
  else {
    $(':checkbox').each(function() {
          this.checked = false;
      });
  }
});			
	

function AllOrders(action){
	
	//$("#inventoryPdtsF").attr("action"); //Will retrieve it
if(action =='tracking'){
$("#FulfillPendingOrdersF").attr("action", "<?php echo base_url("orders_listing/update");?>"); //Will set it	
$("#FulfillPendingOrdersF").submit();
}else
if(action =='cancel'){
	
	var r = confirm("Are you sure you want to cancel the orders?");
			if (r == true) {
				
$("#FulfillPendingOrdersF").attr("action", "<?php echo base_url("orders_listing/cancel");?>");
$("#FulfillPendingOrdersF").submit();
			}
}
	}	
function SendMessage(seller_id,id){
		
			var r = confirm("Are you sure you want to send message?");
			
			if (r == true) {
			var title = $("#message_subject_"+id).val();	
			var category = $("#category_"+id).val();
			
			var message = $("#body_message_"+id).val();
			
			
					$.ajax({
					type: "POST",
					url: '<?php echo base_url("frontend/users/sendMessage");?>',
					data: {order_id: id,seller_id:seller_id,title:title,message:message,category:category,message_by:"Buyer"},
					success: function(data){
						//alert(data);
						
						if(data == 'success'){
						alert("Message has been sent successfully.");
						location.reload();
						}
						
						
					}
					});
				
			} 
	
		
}
		
		
		
	
function SaveRefundOrder(id){
		
		
			var r = confirm("Are you sure you want to refund?");
			if (r == true) {
				

if($("#reason_refund_"+id).val() == "")//day
{

 alert("Please choose cancel reason");
  return false;
}


var reason_refund =$("#reason_refund_"+id).val();








	var dataString = "reason_refund=" + reason_refund+"&id=" + id; 
	
	
	alert(dataString);
					
				
				
					$.ajax({
					type: "POST",
					url: '<?php echo base_url("frontend/products/refund");?>',
					data: {id: id},
					success: function(data){
						//alert(data);
						
						if(data == 'Order refunded successfully.')
						location.reload();
						
						
					}
					});
				
			} 
	
		
		}
		
function export_orders(){
        var query_str = '';
        if($('#order_status').val() != ''){
            query_str += '&order_status='+$('#order_status').val();
        }
        if($('#payment_status').val() != ''){
            //query_str += '&payment_status='+$('#payment_status').val();
        }
        /*if($('#created_on').val() != ''){
            query_str += '&created_on='+$('#created_on').val();
        }*/
        if($('#orders_of').val() != ''){
            query_str += '&orders_of='+$('#orders_of').val();
        }
        if(query_str!=''){
          query_str = encodeURI('?'+query_str);  
        }
        
        window.location.href = '<?php echo base_url('export_my_orders'); ?>'+query_str;
    }			
</script> 