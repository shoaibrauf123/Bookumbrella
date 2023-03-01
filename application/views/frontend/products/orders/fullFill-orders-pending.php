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
    padding: 10px 3px 10px 6px;
}
.detailarea{
padding: 5px 0px 0 10px !important;
}
.detailarea h4{
    font-weight:bold;
    font-size:21px;
    line-height:32px;
    margin-top:0px !important;
    margin-bottom:0px !important;
}
.detailarea a{
    font-weight:500;
    font-size:17px;
    color:#bb9870;
}

.detailarea strong{
    font-size:18px;
    margin:10px 0px !important;
}
.detailarea span{
    font-size:17px;
}
.detailarearight{
	 padding: 10px 0 0 10px;
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
/* .product-col.list .image img{
    border-radius: 2px;
    box-shadow: inset 0px 0px 2px 2px #ccc, 3px 3px 5px 0px #eee;
    padding: 8px;
    display: table-cell;
    text-align: center;
    vertical-align: middle;
} */

.order_table {
 box-shadow: none;
}

input.cancel_order {
    color: #fff;
    background: #323232 !important;
    transition: all 0.5s;
}
input.cancel_order:hover {
    color: #fff;
    background: #bb9870 !important;
    transition: all 0.5s;
}
input.btn.btn-primary.cancel_order {
    border:1px solid #bb9870 !important;
     color: #fff;
    background: #323232 !important;
    transition: all 0.5s;
}
input.btn.btn-primary.cancel_order:hover {
    color: #fff;
    border:1px solid  #bb9870 !important;
    background: #bb9870 !important;
    transition: all 0.5s;
}

input[type="checkbox"] {
    margin: 0px 0px 0px 10px !important;
    accent-color: #bb9870;
    width: 15px;
    height: 17px;
    }
@media screen and (min-device-width: 320px) and (max-device-width: 767px) { 
.detailfilter
{
overflow-x: auto;

}
}
</style>
<div class="col-xs-12">
    <div class="container frontend-dashboard-cont  ">
        <div class="row no-padding">
            <div class="col-sm-12 col-xs-12">

                <section style="padding-bottom: 50px; padding-top: 50px;">

                    <?php if (isset($errors)) { ?>
                        <div class="alert alert-danger"> <?php print_r($errors); ?></div><?php } ?>
                    <?php if (isset($success)) { ?>
                        <div class="alert alert-success"> <?php print_r($success); ?></div><?php } ?>

                    <!--dashbord start-->
                    <div class="dashbord_inno">
                        <div class="container">
                            
                        
                            
                            
                            
                             <div class="row">
                            <div class=" detailfilter" >
                           
                            <form name="search" action="<?php echo base_url('fullFill_orders_pending');?>" method="post">
                            <table cellpadding="0" cellspacing="0" style="margin-bottom:10px;" >
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
                            <td align="left" style="padding-top:18px;">
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
                                        <h2>
                                        <a href="javascript:void(0)" class="toggle_orders active_btn" id="my_orders">New Orders(<?=$total_my_orders?>)</a>
                                        
                                        
                                        <div class="form-group" style="float:right; padding-left:10px; padding-right:10px; font-size:14px !important; margin-top:0px;">
                                                
                                                <input type="submit"  class="btn btn-primary" name="submit" onClick="AllOrders('tracking')" value="Update All" />
                                                &nbsp;
                                                <input type="submit"  class="btn btn-primary cancel_order" name="submit"  onClick="AllOrders('cancel')"  value="Cancel All" />
												Select All<input type="checkbox"  style="margin-left:5px;" name="select_all" id="select_all" /></div>
                                        <a href="javascript:void(0)" class="btn btn-cart pull-right" id="export_refund_sales" onclick="export_orders()">Export <i class="fa-solid fa-download"></i></a>
                                        
                                        	
                                        
                                        </h2>
                                        <div class="order_content my_orders">
                                            <div class="col-lg-12 co-md-12 col-sm-12" style="padding:0;">
                                                
                                                <?php if($my_orders) {
												?>
												
												<form name="FulfillPendingOrdersF" id="FulfillPendingOrdersF" action="<?php echo base_url();?>" method="post" />
												<?php
												$same_order_check = '';
												foreach($my_orders as $row){
												    
												    
												    
												//echo '<pre>';print_r($row);exit;
												$user = $this->comman_model->get('user',array('user_id'=>$row['user_id']));
												$seller = $this->comman_model->get('user',array('user_id'=>$row['seller_id']));
												$product = $this->comman_model->get('products',array('product_id'=>$row['product_id']));
												//echo '<pre>';print_r($row);
												//echo '<pre>';print_r($product);
													 ?>
                                                        
                                                        
                                                        
                                                        
                                                        <div class="product-col list clearfix col-sm-12" <?php if($same_order_check!=$row['same_order']) { ?> style="border-bottom:1px dotted #bb9870;" <?php } ?> >
                                                            
                                                            <?php 
                                                            $same_order_check = $row['same_order'];
                                                            ?>
          <div class="image col-sm-1">
            <a href="<?php echo base_url("product_detail")."/"?><?php echo encode_url($product[0]['product_id'])?>">
            <img class="img-responsive" alt="product" style="width:94px; height:150px;" src="<?php echo base_url()?><?php echo $product[0]['image']?>"> </a></div>
            
            
          <div class="col-xs-12 col-sm-6 detailarea">
			<div>
                <h4><?php echo $product[0]['title']?></h4>
                <strong style="color:#000;"> Author:</strong><span style="color:#bb9870;"><?php echo $product[0]['author']; ?></span> <br>
                <strong> ISBN-10:</strong><span><?php echo $row['isbn']?></span><strong> ISBN-13:</strong><span><?php echo $row['isbn13']?></span>
                <strong> SKU:</strong><span><?php echo $row['sku']?></span> <br>
                
                <strong> Quantity:</strong><span><?php echo $row['qty']?></span> | <strong> Format:</strong><span><?php echo $product[0]['format']?></span><br>
                <strong> Condition:</strong><span><?php echo $product[0]['book_condition']?></span> | <strong> Type:</strong><span><?php echo $product[0]['book_type']?></span>
              <?php
              if($row["payment_method_type"]=='paypal' || $row["payment_method_type"]=='amazon'){
				  echo '<br /><strong>Payment Method:</strong>';
				  echo $row["payment_method_type"];
				  }else{
					  ?>
					  
					  <?php
					  
					  
					  }
			  ?>
                
                     <br>



 <a href="javascript:;" id="<?php echo $row['id']?>" onClick="ShowContactBuyerModal_<?php echo $row['id']?>(<?php echo $row['id']?>)"  >Contact Buyer</a> | <a href="javascript:;" onClick="ShowAddressDetailModal_<?php echo $row['id']?>(<?php echo $row['id']?>)">Shipping Address</a>




<script>
function ShowContactBuyerModal_<?php echo $row['id']?>(id){	
$('#ContactBuyerModal_'+id).modal('show');

}


</script>
<div id="ContactBuyerModal_<?php echo $row['id']?>" class="modal fade" role="dialog" style="z-index:999999">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="color:#0C0; font-weight:bold;" >Send Message</h4>
      </div>
      <div class="modal-body">
      <div class="product-filter product_mobile" style="border:0 none;">
        <div class="product-compare" style="color:#666; width:100%;">
        	

        	                                        <div class="form-group">
                                            <label for="title">Subject</label>
                                            <input id="message_subject_<?php echo $row["id"]?>" class="form-control" name="title" type="text">
                                        </div>

        	                                                                                

        	                            <div class="form-group">
                                            <label for="message">Message</label>
                                            <textarea class="form-control" name="message" id="body_message_<?php echo $row["id"]?>"></textarea>
                                             <strong style="color:blue">(Maximum of 500 Charcters)</strong>
                                        </div>                                        
	                                
                          
         
         
         
        <input type="hidden" name="seller_id" id="seller_id" value="<?php echo $row["seller_id"]?>" />        
        <input type="hidden" name="message_by" id="message_by" value="seller" />
                                                                            
                                                                            
        <input type="button" class="btn btn-primary" onClick="SendMessage(<?php echo $row["user_id"]?>,<?php echo $row["id"]?>)" name="submit" id="submit" value="Send" />                                                                            
        </div>
        

        </div>
        
        
        
      </div>
      
      
      
   
    </div>

  </div>
</div>




















<br>

<script>
function ShowAddressDetailModal_<?php echo $row['id']?>(id){	
$('#AddressDetailModal_'+id).modal('show');

}

</script>
<div id="AddressDetailModal_<?php echo $row['id']?>" class="modal fade" role="dialog" style="z-index:999999">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="color:#0C0; font-weight:bold;" >Buyer Address Details</h4>
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
                <strong> Order Id: </strong><span><?php echo $row['unique_order_id']; ?></span> <br>
                <strong> Order Date: </strong><span><?php echo $row['created_on']; ?></span> <br>
                 

                <?php 
				if($row['order_status'] == 'Cancelled'){
				?>
				<strong> Cancel Reason: </strong><span><?php echo $row['reason_cancel']; ?></span></br>
				<?php	
					
					}
				?>
                

                <strong> Product Price: </strong><span><?php echo $row['price']; ?></span>
                <strong> Shipping: </strong><span>$<?php echo $row['shipping_value']; ?>(<?php echo $row['shipping_type']; ?>)</span>
				<strong> Order Total: </strong><span><?php echo $row['price']  + $row['shipping_value']; ?></span> <br>

                <?php
                			if($row['order_status']!='Refunded' && $row['order_status']!='Cancelled') {
				?>
                <a href="<?php echo base_url('refund');?>/<?php echo encode_url($row['id']); ?>">
                <input class="btn btn-cart"   type="button" name="refund" id="refund" style="margin-bottom:5px;" value="Refund"></a>
                <?php }
				if($row['order_status']=='Refunded') {
					?>
					<strong> Refunded Amount: </strong><span>$<?php echo $row['refund_amount_to_buyer']; ?></span> &nbsp;&nbsp;
                    <strong> Refund Reason: </strong><span><?php echo $row['refund_reason']; ?></span>
                     <br>
					<strong> Refund Message: </strong><span><?php echo $row['message_to_buyer']; ?></span>
                    <br>

					<?php
					}
				 ?>
                <br>

<?php //if(($row['order_status']=='Paid' || $row['order_status']=='Received') && $row['tracking_id']==''){ 


if($row['order_status']!=''){
?>
               
               
                <input class="form-control" type="text" value="<?php echo $row['tracking_id']; ?>" placeholder="Tracking Id" style="width:120px; float:left; margin-right:5px;" size="10" id="tracking_id_<?php echo $row['id']; ?>" name="tracking_id_<?php echo $row['id']; ?>" >
                
                <select  style="display:inline;width:95px; float:left;" name="carrier_<?php echo $row['id']?>" id="carrier_<?php echo $row['id']?>"  class="form-control">
                	<option <?php if($row['carrier'] == 'UPS') { ?> selected <?php } ?> value="UPS">UPS</option>
                    <option <?php if($row['carrier'] == 'FEDEX') { ?> selected <?php } ?> value="FEDEX">FEDEX</option>
                    <option <?php if($row['carrier'] == 'USPS') { ?> selected <?php } ?> value="USPS">USPS</option>
                    <option <?php if($row['carrier'] == 'DHL') { ?> selected <?php } ?> value="DHL" >DHL</option>
                    <option <?php if($row['carrier'] == 'Newgistics') { ?> selected <?php } ?> value="Newgistics">Newgistics</option>
                    <option <?php if($row['carrier'] == 'OnTrac') { ?> selected <?php } ?> value="OnTrac">OnTrac</option>
                    <option <?php if($row['carrier'] == 'UPS-MI') { ?> selected <?php } ?> value="UPS-MI">UPS-MI</option>
                    <option <?php if($row['carrier'] == 'DHL-GM') { ?> selected <?php } ?> value="DHL-GM">DHL-GM</option>
                </select>
              
                
					<input class="btn btn-cart"  style="float:left; margin-right:5px; margin-left:10px;" size="10"  type="button" onClick="UpdateTracking(<?php echo $row['id']; ?>)" name="update_tracking" id="update_tracking" value="Update">
                    
                    
<input class="btn btn-cart cancel_order" type="button" name="cancel_order" onClick="CancelOrder(<?php echo $row['id']; ?>)" id="cancel_order" value="Cancel">

<div id="block_reasons_cancel_<?php echo $row['id']; ?>"  name="block_reasons_cancel_<?php echo $row['id']; ?>" style="display:none;">
<select class="form-control" style="    margin-top: 12px;
    width: 80%;
    float: left;
    margin-right: 5px;" id="reasons_cancel_<?php echo $row['id']; ?>" name="reasons_cancel_<?php echo $row['id']; ?>">
	<option value="">Select Reason</option>
    <option value="Wrong Book">Wrong Book</option>
    <option value="Low Quality">Low Quality</option>
    <option value="Late Deliver">Late Deliver</option>
</select>
<input class="btn btn-cart" style="margin-top: 10px;"   type="button" name="save_cancel_order" onClick="SaveCancelOrder(<?php echo $row['id']; ?>)" id="save_cancel_order" value="Save">
</div>
               
                
                 <?php
				} if($row['order_status']=='Delivered' && $row['tracking_id']!=''){
				 ?>
    <div class="clearfix"></div>
                  <strong> Tracking id : </strong><span><?php echo $row['tracking_id']; ?></span>
                 <strong> Carrier : </strong><span><?php echo $row['carrier']; ?></span>
                 
                 <?php /*?><input class="btn btn-cart"  type="button" name="confirm_order" id="confirm_order" value="Confirm"><?php */?>
                 
                 <?php } 
				 if($row['order_status']=='Confirmed') {?>
                  <strong> Tracking id : </strong><span><?php echo $row['tracking_id']; ?></span>
                  
                <strong> Carrier : </strong><span><?php echo $row['carrier']; ?></span>
 				
 
                <?php } 
				
				if($row['order_status']=='Pending' && $row['tracking_id']=='') {
				
				?>
				
				<?php	
				}?>
                
             

 
 
                <?php 
					?>
					
                    
					<?php
					
					
					?>
                
             
             
            
            
           
              
				<input style="display:inline;width:15px; float:right;" align="right" type="checkbox" name="order_id[]" id="order_id" value="<?php echo $row['id']?>" />  
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
                                        



												<div class="form-group" style="float:right; padding-left:10px; padding-right:10px;">
                                                
                                                <input type="submit"  class="btn btn-primary" name="submit" onClick="AllOrders('tracking')" value="Update All" />
                                                &nbsp;
                                                <input type="submit"  class="btn btn-primary cancel_order" name="submit"  onClick="AllOrders('cancel')"  value="Cancel All" />
												Select All<input type="checkbox"  style="margin-left:5px;" name="select_all" id="select_all" /></div>
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
    $('#created_on').val('<?php echo $this->input->get('created_on'); ?>');
    $('#created_on').datepicker({});

    $('.toggle_orders').click(function(){
        var cls = $(this).attr('id');
        $('.order_content').hide();
        $('.'+cls).show();
        $('.toggle_orders').removeClass('active_btn');
        $(this).addClass('active_btn');
    })
  });
    

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
			$("#block_reasons_cancel_"+id).toggle();
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
$("#FulfillPendingOrdersF").attr("action", "<?php echo base_url("fullFill_orders_pending/update");?>"); //Will set it	
$("#FulfillPendingOrdersF").submit();
}else
if(action =='cancel'){
	
	var r = confirm("Are you sure you want to cancel the orders?");
			if (r == true) {
				
$("#FulfillPendingOrdersF").attr("action", "<?php echo base_url("fullFill_orders_pending/cancel");?>");
$("#FulfillPendingOrdersF").submit();
			}
}
	}	
	

function UpdateTracking(id){
	
	var carrier = $("#carrier_"+id).val();
	var tracking_id = $("#tracking_id_"+id).val();
	
	if(tracking_id==''){
		alert("Please enter tracking id.");return false;
		}
	
		jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url('frontend/products/ajax_updateTracking'); ?>",
            data: {"id":id,"carrier": carrier,"tracking_id": tracking_id},
           
            success: function (response) {
				
                if (response=='success'){
					alert("Tracking updated successfully.");
					location.reload();
				}else{
			        alert('There is an error.Try Again');
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

        window.location.href = '<?php echo base_url('fullFill_orders_pending'); ?>'+query_str;
    }
	
	
  function export_orders(){
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

        window.location.href = '<?php echo base_url('export_sales_refunds'); ?>'+query_str;
    }
	
function SendMessage(buyer_id,id){
		
			var r = confirm("Are you sure you want to send message?");
			
			if (r == true) {
			 var title = $("#message_subject_"+id).val();	
			 var category = $("#category_"+id).val();
				
			 var message = $("#body_message_"+id).val();
			
			
					$.ajax({
					type: "POST",
					url: '<?php echo base_url("frontend/users/sendMessage");?>',
					data: {order_id: id,buyer_id:buyer_id,title:title,message:message,category:category,message_by:"Seller"},
					success: function(data){
						alert(data);
						
						if(data == 'success'){
						alert("Message has been sent successfully.");
						location.reload();
						}
						
						
					}
					});
				
			} 
	
		
}


	
</script> 