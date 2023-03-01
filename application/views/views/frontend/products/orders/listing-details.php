<?php
   
    $currentUserData = getUserData(getCurrentUserId());
?>

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
                            
                        
                            
                            
                            
                            
                            
                           <!--  <form name="search" action="<?php echo base_url('my_orders');?>" method="post">
                            <table cellpadding="0" cellspacing="0" style="margin-bottom:10px;" >
                            <tr>
                            <td align="left"><strong>Order Status:</strong>
                            <select name="order_status">
                            
                            	<option value="">Select Order Status</option>
                            	<option value="Pending">Pending</option>
                                <option value="Rejected">Rejected</option>
                                <option value="Confirmed">Confirmed</option>
                            </select>
                            </td>
                            
                            <td align="left"><strong>Payment Status:</strong>
                            <select name="order_status">
                            
                            	<option value="">Select Payment Status</option>
                            	<option value="Paid">Paid</option>
                                <option value="Not Paid">Not Paid</option>
                                <option value="Rejected">Rejected</option>
                            </select>
                            </td>
                            
                             
                            <td align="left"><strong>Creation Date:</strong>
							<input type="text" name="created_on" id="created_on" >

                            </td>
                            
 							<td align="left"><strong>Orders of:</strong>
							<select name="orders_of">
                            
                            	<option value="">All</option>
                            	<option value="Today">Today</option>
                                <option value="Yesterday">Yesterday</option>
                                <option value="This Week">This Week</option>
                                <option value="This Month">This Month</option>
                            </select>
                            

                            </td>
                            
                            
                            
                            </tr>
                            </table>
                            </form> -->

                            <div class="clearfix"></div>

                            <div class="row">
                                <div class="col-lg-12 co-md-12 col-sm-12">
                                    <div class="order_table">
                                        <h2>My Orders<?php //echo getlanguage('cash_outs'); ?></h2>
                                        <div class="order_content">
                                            <div class="col-lg-12 co-md-12 col-sm-12">
                                                <table class="table history-table scrollable-table-head margin0">
                                                    <thead class="padding-right-20">
                                                    
                                                    <tr>
                                                        <th class="col-xs-1 col-sm-1 col-md-1">Image<?php //echo getlanguage('cashout-id'); ?></th>
                                                        <th class="col-xs-1 col-sm-1 col-md-1">Product<?php //echo getlanguage('requested-at'); ?></th>
                                                        <th class="col-xs-1 col-sm-1 col-md-1">Seller<?php //echo getlanguage('approval-at'); ?></th>
                                                        <th class="col-xs-1 col-sm-1 col-md-1">Quantity<?php //echo getlanguage('approval-at'); ?></th>
                                                        
                                                        <th class="col-xs-1 col-sm-1 col-md-1">Price<?php //echo getlanguage('cashback'); ?></th>
                                                        <th class="col-xs-1 col-sm-1 col-md-1">Date<?php //echo getlanguage('get-paid-at'); ?></th>
                                                        <th class="col-xs-1 col-sm-1 col-md-1">Order Status<?php //echo getlanguage('status'); ?></th>
                                                         <th class="col-xs-1 col-sm-1 col-md-1">Payment Status<?php //echo getlanguage('status'); ?></th>
                                                    </tr>
                                                    
                                                    
                                                    </thead>
                                                </table>
                                                <?php if($my_orders) { ?>
                                                    <div class="scrollable-table-body-cont margin-bottom-20">
                                                        <table class="table history-table scrollable-table-body">
                                                            <tbody>
                                                                <?php foreach ($my_orders as $row) {
																	//echo '<pre>';print_r($row);
																	//$productData = get('products', array('product_id' => $row['product_id']));
																	$userData = get('user', array('user_id' => $row['seller_id']));
																	$productData = get('products', array('product_id' => $row['product_id']));
																	
																	
																	 ?>
                                                                 <tr>
                                                                 
<td class="col-xs-1 col-sm-1 col-md-1">
<img class="img-responsive" alt="product" src="<?php echo base_url(''); ?><?php echo $productData[0]['image'] ?>">
</td>

<td class="col-xs-1 col-sm-1 col-md-1"><?php echo $productData[0]['title']; ?></td>

<td class="col-xs-1 col-sm-1 col-md-1"><?php echo $userData[0]['first_name']. " " .$userData[0]['last_name'];  ?></td>
                                                                                <td class="col-xs-1 col-sm-1 col-md-1"><?php echo $row['qty']; ?></td>
                                                                                <td class="col-xs-1 col-sm-1 col-md-1">
                                                                                    <?php echo $row['price']; ?>
                                                                                </td>
                                                                                
                                                                                <td class="col-xs-1 col-sm-1 col-md-1"><?php echo $row['created_on']; ?></td>
                                                                                 <td class="col-xs-1 col-sm-1 col-md-1">
                                                                                    <?php echo $row['order_status']; ?>
                                                                                </td>
                                                                                <td class="col-xs-1 col-sm-1 col-md-1">
                                                                                    <?php echo $row['payment_status']; ?>
                                                                                </td>
                                                                                
                                                                            </tr>  
                                                                   
                                                                <?php }?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                <?php } else { ?>
                                                    <?php echo adminRecordNotFoundMsg(); ?>
                                                <?php } ?>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
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