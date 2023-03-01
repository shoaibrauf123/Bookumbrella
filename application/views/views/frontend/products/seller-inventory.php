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
                            
                        
                            
                            
                            
                            
                            
                            <form name="search" action="<?php echo base_url('seller_inventory');?>" method="post">
                            <table cellpadding="0" cellspacing="0" style="margin-bottom:10px;" >
                            <tr>
                            <td align="left"><strong>Book Type:</strong>
                            <select type="text" name="book_type" id="book_type" class="form-control" required>
                                                                    <option value="Normal">Normal</option>
                                                                    <option value="Internation Edition">Internation Edition</option>
                                                                    <option value="Teachers Edition">Teachers Edition</option>
                                                                    <option value="Study Guide">Study Guide</option>
                                                                    <option value="Work Book">Work Book</option>
                                                                    <option value="Library Copy">Library Copy</option>
                                                                </select>
                            </td>
                            
                            <td align="left"><strong>Payment Status:</strong>
<select type="text" name="book_condition" id="book_condition" class="form-control" required>
                                                                    <option value="New">New</option>
                                                                    <option value="Like New">Like New</option>
                                                                    <option value="Very Good">Very Good</option>
                                                                    <option value="Good">Good</option>
                                                                    <option value="Acceptable">Acceptable</option>
                                                                       
                                                                </select>
                            </td>
                            
                             
                            <td align="left"><strong>Creation Date:</strong>
							<input type="text" name="created_on" id="created_on" >

                            </td>
                            
 							 <td align="left"><strong>Sku:</strong>
							<input type="text" name="sku" id="sku" >

                            </td>
                            
 							 <td align="left"><strong>Price:</strong>
							<input type="text" name="price" id="price" >

                            </td>
                            
 							 <td align="left"><strong>Quantity:</strong>
							<input type="text" name="qty" id="qty" >

                            </td>
                            
                            </tr>
                            </table>
                            </form>

                            <div class="clearfix"></div>

                            <div class="row">
                                <div class="col-lg-12 co-md-12 col-sm-12">
                                    <div class="order_table">
                                        <h2>My Inventory<?php //echo getlanguage('cash_outs'); ?></h2>
                                        <div class="order_content">
                                            <div class="col-lg-12 co-md-12 col-sm-12">
                                                <table class="table history-table scrollable-table-head margin0">
                                                    <thead class="padding-right-20">
                                                    
                                                    <tr>
                                                        <th class="col-xs-1 col-sm-1 col-md-1">Product<?php //echo getlanguage('cashout-id'); ?></th>
                                                        <th class="col-xs-1 col-sm-1 col-md-1">Book Condition<?php //echo getlanguage('requested-at'); ?></th>
                                                        <th class="col-xs-1 col-sm-1 col-md-1">Book Type<?php //echo getlanguage('approval-at'); ?></th>
                                                        <th class="col-xs-1 col-sm-1 col-md-1">Date<?php //echo getlanguage('get-paid-at'); ?></th>
                                                        <th class="col-xs-1 col-sm-1 col-md-1">Quantity<?php //echo getlanguage('cashback'); ?></th>
                                                        <th class="col-xs-1 col-sm-1 col-md-1">Sku<?php //echo getlanguage('status'); ?></th>
                                                         <th class="col-xs-1 col-sm-1 col-md-1">Price<?php //echo getlanguage('status'); ?></th>
                                                    </tr>
                                                    
                                                    
                                                    </thead>
                                                </table>
                                                <?php if($allSellerProducts) {
													
													 ?>
                                                    <div class="scrollable-table-body-cont margin-bottom-20">
                                                        <table class="table history-table scrollable-table-body">
                                                            <tbody>
                                                                <?php foreach ($allSellerProducts as $row) {
																	$productData = get('products', array('product_id' => $row['product_id']));
																	//$userData = get('user', array('user_id' => $row['user_id']));
																	
																	 ?>
                                                                 <tr>
<td class="col-xs-1 col-sm-1 col-md-1">
<a href="<?php echo base_url('edit_inventory') . "/" . $row['id']; ?>">
<?php echo $productData[0]['title']; ?>

</td>

<td class="col-xs-1 col-sm-1 col-md-1"><?php echo $row['book_condition']; ?></td>
                                                                                <td class="col-xs-1 col-sm-1 col-md-1"><?php echo $row['book_type']; ?></td>
                                                                                <td class="col-xs-1 col-sm-1 col-md-1">$<?php echo $row['created_on']; ?></td>
                                                                                <td class="col-xs-1 col-sm-1 col-md-1">
                                                                                    <?php echo $row['quantity']; ?>
                                                                                </td>
                                                                                
                                                                                 <td class="col-xs-1 col-sm-1 col-md-1">
                                                                                    <?php echo $row['sku']; ?>
                                                                                </td>
                                                                                <td class="col-xs-1 col-sm-1 col-md-1">
                                                                                    <?php echo $row['price']; ?>
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