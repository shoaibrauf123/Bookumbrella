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
</style>
<div class="col-xs-12">
    <div class="container frontend-dashboard-cont">
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
                            
                        
                            
                            
                            
                            
                            <div style="    background-color: #ddd;
    padding: 15px;
    margin-bottom: 5px;">
                            <form name="search" action="<?php echo base_url('order_tracking');?>" method="post">
                            <table cellpadding="0" cellspacing="0" style="margin-bottom:10px;" >
                            <tr>
                            

                            <td align="left"><strong>Order Status:</strong>
                                <select name="order_status" onchange="filter_orders()" id="order_status">
                                    <option value="">Select Order Status</option>
                                    <option  value="Pending">Pending</option>
                                    <option value="Received">Received</option>
                                    <option  value="Delivered">Delivered</option>
                                    <option  value="Receiver Confirmed">Receiver Confirmed</option>
                                    <option  value="Cancelled">Cancelled</option>
                                </select>
                            </td>
                            
                            <td align="left"><strong>Payment Status:</strong>
                                <select name="payment_status"  onchange="filter_orders()" id="payment_status">
                                    <option value="">Select Payment Status</option>
                                    <option value="Not Paid">Not Paid</option>
                                    <option value="Client Paid">Client Paid</option>
                                    <option value="Admin Confirmed">Admin Confirmed</option>
                                </select>
                            </td>
                            
                             
                            <td align="left"><strong>Creation Date:</strong>
							
                                <input type="text" id="created_on" onchange="filter_orders()" />

                            </td>
                            
 							<td align="left"><strong>Orders of:</strong>
							<select name="orders_of" onchange="filter_orders()" id="orders_of">
                            
                            	<option value="">All</option>
                            	<option value="Today">Today</option>
                                <option value="Yesterday">Yesterday</option>
                                <option value="This Week">This Week</option>
                                <option value="This Month">This Month</option>
                            </select>
                            

                            </td>
                            
                             
                            <td align="left"><strong>Tracking Id</strong>
							
                                <input type="text" id="tracking_id" onchange="filter_orders()" />

                            </td>
                            
                            
                            </tr>
                            
                            
                            
                            </table>
                            </form>

                         </div>
                            <div class="clearfix"></div>

                            <div class="row">
                                <div class="col-lg-12 co-md-12 col-sm-12">	
                                    <div class="order_table">
                                        <h2><a href="javascript:void(0)" class="toggle_orders active_btn" id="my_orders">Order Tracking</a> </h2>
                                        <div class="order_content my_orders">
                                            <div class="col-lg-12 co-md-12 col-sm-12">
                                                
                                                <?php if($my_orders) {
												?>
												
												
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
            
            
          <div class="col-xs-12 col-sm-7">
			<div>
                <h4><?php echo $product[0]['title']?></h4>
            
                <strong> ISBN:</strong><span><?php echo $product[0]['isbn']?></span><strong> SKU:</strong><span><?php echo $row['sku']?></span> <br>
                <strong> Format:</strong><span><?php echo $product[0]['format']?></span><strong> Advertiser:</strong><span><?php echo $product[0]['advertiser_name']?></span> <br>
                <strong> Quantity:</strong><span><?php echo $row['qty']?></span> <strong> Author:</strong><span><?php echo $product[0]['format']?></span><br>
                <strong> Condition:</strong><span><?php echo $product[0]['book_condition']?></span> <strong> Type:</strong><span><?php echo $product[0]['book_type']?></span>
            </div><br>
            
             <strong>Carrier</strong>
                <?php echo $row['carrier'];?>
                &nbsp;
                <strong>Tracking ID</strong>
                <?php echo $row['tracking_id'];?>
                <br>

                
                
          
        </div>
        <div class="col-xs-12 col-sm-3" style="border-left: 1px solid #ddd;">
            <div>
                
                <strong> Order Status: </strong><span><?php echo $row['order_status']; ?></span></br>
                <strong> Payment Status: </strong><span><?php echo $row['payment_status']; ?></span> <br>
                <strong> Product Price: </strong><span><?php echo $row['price']; ?></span> <br>
                <strong> Shipping: </strong><span>$<?php echo $row['shipping_value']; ?>(<?php echo $row['shipping_type']; ?>)</span> <br>
                <strong> Admin Value : </strong><span><?php echo $row['final_value_on_product']; ?></span> <br>
                
                <strong> Order Total: </strong><span><?php echo $row['price'] + $row['final_value_on_product'] + $row['shipping_value']; ?></span> <br>
          
                </div><br>
            <div class="cart-button button-group"> 
            
                <?php /*?><a class="btn btn-cart" type="button" href="http://localhost/bookumbrella/product/detail/do21Fc7vXd2827017281161498EOD8NAVV" title="View Detail">
                                 View Detail
                                 
                             </a><?php */?>
                             
                             
              <br>
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
                                                
                                               
												</div>
                                                
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
        if($('#tracking_id').val() != ''){
            query_str += '&tracking_id='+$('#tracking_id').val();
        }
        if(query_str!=''){
          query_str = encodeURI('?'+query_str);  
        }
        
        window.location.href = '<?php echo base_url('order_tracking'); ?>'+query_str;
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