<?php
    $currentUserData = getUserData(getCurrentUserId());
    $countries = $this->comman_model->get('countries');
?>

<style>
	.importdbookstbl{
	
    padding: 9px !important;
    text-align: left !important;
    text-indent: 4px;
    vertical-align: middle !important;
    width: 180px;	
	}
	.myacuntblock{
	
    margin: 0 2px 10px;
    min-height: 250px;
    padding: 0 0 8px;
	}
	.my-account-tab-btns ul h2 {
  background:#4B2354;
    color: #ffffff !important;
    font-size: 18px;
    font-weight: 600;
    margin:0 0 2px;
    padding: 20px 0;
    text-align: center;
    text-shadow: 2px 2px 7px #000000;
	}
.my-account-tab-btns ul li {

    padding: 2px 0;
    
}
.my-account-tab-btns ul li a {
 background: #f9f9f9 none repeat scroll 0 0;
    border-radius: 0;
    color: #857d7d !important;
    padding: 20px 15px;
    text-shadow: 2px 3px 3px #b5b5b5;
	 

}
.my-account-tab-btns ul li i {

display: inline-block;
    float: left;
    font-size: 33px;
    text-align: left;
    
}
.my-account-tab-btns ul li h3 {
   display: inline-block;
    font-size: 13px;
    margin: 12px 5px 3px 0;
    text-align: left;
	line-height:20px;
    
}
</style>

<div class="col-xs-12">
    <div class="frontend-dashboard-cont">
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
                            
                            
                          
                            
                            
                            
                            asdfasdfasdf

                            <div class="clearfix"></div>
          	
            <div class="row">
                                <div class="col-lg-12 co-md-12 col-sm-12">
                                    <div class="order_table">
                                        <h2>View Payment Summary<?php //echo getlanguage('cash_outs'); ?></h2>
                                        <div class="order_content">
                                            <div class="col-lg-12 co-md-12 col-sm-12">
                                                <table class="table history-table scrollable-table-head margin0">
                                                    <thead class="padding-right-20">
                                                    
                                                    <tr>
                                                        <th  class="importdbookstbl">Title<?php //echo getlanguage('cashout-id'); ?></th>
                                                        <th  class="importdbookstbl">ISBN<?php //echo getlanguage('requested-at'); ?></th>
                                                        <th  class="importdbookstbl">SKU<?php //echo getlanguage('approval-at'); ?></th>
                                                        <th  class="importdbookstbl">Price<?php //echo getlanguage('get-paid-at'); ?></th>
                                                        <th  class="importdbookstbl">Quantity<?php //echo getlanguage('cashback'); ?></th>
                                                        <th  class="importdbookstbl">Condition<?php //echo getlanguage('status'); ?></th>
                                                    </tr>
                                                    
                                                    
                                                    </thead>
                                                </table>
                                                <?php if($my_orders) { ?>
                                                    <div class="scrollable-table-body-cont margin-bottom-20">
                                                        <table class="table history-table scrollable-table-body table-hover">
                                                            <tbody>
                                                                <?php 
																foreach ($my_orders as $row) { 
																//$product = $this->comman_model->get("products",array("product_id"=>$row['product_id']));
																?>
                                                                 <tr>
                                                                                <td class="importdbookstbl">dddd</td>
                                                                                <td class="importdbookstbl">rterttert</td>
                                                                                <td class="importdbookstbl">asdgfafadfads
                                                                                 </td>
                                                                                <td class="importdbookstbl">$333</td>
                                                                                <td class="importdbookstbl">
                                                                                    $dsfasdfas
                                                                                </td>
                                                                                
                                                                                 <td class="importdbookstbl">
                                                                                    kjaskdjf
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