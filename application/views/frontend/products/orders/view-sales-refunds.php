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
    padding: 30px 20px 10px 0;
}
.detailarea{
	    padding: 30px 0 0 0;
}
.detailarearight{
	 padding: 30px 0 0 30px;
}
.product-col:hover{
	background-color:#f5f5f5;	
}
td, th {
    padding: 0 6px;
}
.detailfilter{
background-color: #ddd; padding: 15px;
z-index:9999;
position:relative;
border: 1px solid #ddd;
  
    
}
.order_table {
 
    box-shadow: none;

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
                           
                            <form name="search" action="<?php echo base_url('my_orders');?>" method="post">
                            <table cellpadding="0" cellspacing="0" style="margin-bottom:10px;" >
                            <tr>
                            

                            <td align="left"><strong>Order Status:</strong>
                                <select class="form-control" name="order_status"  id="order_status">
                                    <option value="">Show All</option>
                                    <option  value="Pending">Orders Pending</option>
                                    <option value="Received">Received</option>
                                    <option  value="Delivered">Orders Delivered</option>
                                    <option  value="Cancelled">Orders Cancelled</option>
                                </select>
                            </td>
                            
                           <?php /*?> <td align="left"><strong>Payment Status:</strong>
                                <select class="form-control" name="payment_status"   id="payment_status">
                                    <option value="">Select Payment Status</option>
                                    <option value="Not Paid">Not Paid</option>
                                    <option value="Client Paid">Client Paid</option>
                                    <option value="Admin Confirmed">Admin Confirmed</option>
                                </select>
                            </td><?php */?>
                            
                             
                            <td align="left"><strong>Creation Date:</strong>
							
                                <input class="form-control" type="text" id="created_on"  />

                            </td>
                            
 							<td align="left"><strong>Orders of:</strong>
							<select class="form-control" name="orders_of"  id="orders_of">
                            
                            	<option value="">All</option>
                            	<option value="Today">Today</option>
                                <option value="Yesterday">Yesterday</option>
                                <option value="This Week">This Week</option>
                                <option value="This Month">This Month</option>
                                <option value="Last Year">Last Year</option>
                                <option value="Last 2 Years">Last 2 Years</option>
                                <option value="Last 3 Years">Last 3 Years</option>
                                <option value="Last 4 Years">Last 4 Years</option>
                            </select>
                            

                            </td>
                            
                             <td align="left"><strong>Order Id/ISBN:</strong>
							
                                <input  class="form-control" type="text" id="unique_order_id" />
								<select class="form-control" name="search_by"  id="search_by">
                                	<option value="isbn">ISBN</option>
                                    <option value="isbn13">ISBN13</option>
                                    <option value="unique_order_id">Order Id</option>
                                </select>
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
                                            <a href="javascript:void(0)" class="toggle_orders active_btn" id="my_orders">View Sales(<?=$total_my_orders?>)</a> 
                                            <a href="javascript:void(0)" class="active_btn" id="export_refund_sales" onclick="export_orders()">Export</a>
                                        </h2>

                                        <div class="order_content my_orders">
                                            <div class="col-lg-12 co-md-12 col-sm-12" style="padding:0;">
                                                
                                                <?php if($my_orders) {
												?>
												
												<form name="ViewSalesAndRefundF" id="ViewSalesAndRefundF" method="post" />
												<?php
												foreach($my_orders as $row){	
												//echo '<pre>';print_r($row);exit;
												$user = $this->comman_model->get('user',array('user_id'=>$row['user_id']));
												$seller = $this->comman_model->get('user',array('user_id'=>$row['seller_id']));
												$product = $this->comman_model->get('products',array('product_id'=>$row['product_id']));
												//echo '<pre>';print_r($row);
												//echo '<pre>';print_r($product);
													 ?>
                                                        
                                                        
                                                        
                                                        
                                                        <div class="product-col list clearfix col-sm-12" style="border-bottom:1px dotted #ff5b53;">
          <div class="image col-sm-2">
            <a href="<?php echo base_url("product_detail")."/"?><?php echo encode_url($product[0]['product_id'])?>">
            <img class="img-responsive" alt="product" src="<?php echo base_url()?><?php echo $product[0]['image']?>"> </a></div>
            
            
          <div class="col-xs-12 col-sm-7 detailarea">
			<div>
                <h4><?php echo $product[0]['title']?></h4>
            
                <strong> ISBN:</strong><span><?php echo $product[0]['isbn']?></span><strong> SKU:</strong><span><?php echo $row['sku']?></span> <br>
                <strong> Format:</strong><span><?php echo $product[0]['format']?></span><strong> Advertiser:</strong><span><?php echo $product[0]['advertiser_name']?></span> <br>
                <strong> Quantity:</strong><span><?php echo $row['qty']?></span> <strong> Author:</strong><span><?php echo $product[0]['format']?></span><br>
                <strong> Condition:</strong><span><?php echo $product[0]['book_condition']?></span> <strong> Type:</strong><span><?php echo $product[0]['book_type']?></span>
            </div>
       
                
          
        </div>
        <div class="col-xs-12 col-sm-3 detailarearight" style="border-left: 1px solid #ddd;">
            <div>
                <strong> Order Id: </strong><span><?php echo $row['unique_order_id']; ?></span> <br>
                <strong> Order Date: </strong><span><?php echo $row['created_on']; ?></span> <br>
                <strong> Order Status: </strong><span><?php echo $row['order_status']; ?></span></br>
                <?php 
				if($row['order_status'] == 'Cancelled'){
				?>
				<strong> Cancel Reason: </strong><span><?php echo $row['reason_cancel']; ?></span></br>
				<?php	
					
					}
				?>
                
                <strong> Payment Status: </strong><span><?php echo $row['payment_status']; ?></span> <br>
                <strong> Product Price: </strong><span><?php echo $row['price']; ?></span> <br>
                <strong> Shipping: </strong><span>$<?php echo $row['shipping_value']; ?>(<?php echo $row['shipping_type']; ?>)</span> <br>
                  
                <strong> Order Total: </strong><span><?php echo $row['price']  + $row['shipping_value']; ?></span> <br>
             
             
            
                 
               				<a href="<?php echo base_url('refund');?>/<?php echo encode_url($row['id']); ?>"><input class="btn btn-cart"   type="button" name="refund" id="refund" value="Refund"></a>
 
            <a href="<?php echo base_url('print_order').'/'.$row['order_id']; ?>"  target="_blank" class="btn btn-primary" >Print</a>
                <input style="display:inline;width:15px; float:right;" align="right" type="checkbox" name="order_id[]" id="order_id" value="<?php echo $row['id']?>" />  
                <br>

                
               
                </div>
                
                <br>
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
                                                <div class="clearfix"></div>
                                                <br>
<br>

												<div class="form-group" style="float:right;">
                                                
                                                <input type="submit"  class="btn btn-primary" name="submit" value="Confirm Refund" />
												</div>
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
    function filter_orders(obj){
        var query_str = '';
        if($('#unique_order_id').val()!=''){
          query_str += '&unique_order_id='+$('#unique_order_id').val();
		  
		  query_str += '&search_by='+$('#search_by').val();
		  
        }if($('#order_status').val() != ''){
            query_str += '&order_status='+$('#order_status').val();
        }
        if($('#payment_status').val() != ''){
            query_str += '&payment_status='+$('#payment_status').val();
        }
        if($('#created_on').val() != ''){
            query_str += '&created_on='+$('#created_on').val();
        }
        if($('#orders_of').val() != ''){
            query_str += '&orders_of='+$('#orders_of').val();
        }
        if(query_str!=''){
          query_str = encodeURI('?'+query_str);  
        }
        
        window.location.href = '<?php echo base_url('view_sales_refunds'); ?>'+query_str;
    }

    function export_orders(){
        var query_str = '';
        if($('#order_status').val() != ''){
            query_str += '&order_status='+$('#order_status').val();
        }
        if($('#payment_status').val() != ''){
            query_str += '&payment_status='+$('#payment_status').val();
        }
        if($('#created_on').val() != ''){
            query_str += '&created_on='+$('#created_on').val();
        }
        if($('#orders_of').val() != ''){
            query_str += '&orders_of='+$('#orders_of').val();
        }
        if(query_str!=''){
          query_str = encodeURI('?'+query_str);  
        }
        
        window.location.href = '<?php echo base_url('export_sales_refunds'); ?>'+query_str;
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
	
</script>