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
    .padding-right-20 {
    padding-right: 10px;
    }
    .importdbookstbl a{
        color:#323232;
        text-decoration-color:#bb9870 !important;

    }
	
</style>

<div class="col-xs-12">
    <div class="frontend-dashboard-cont">
        <div class="row no-padding">
            <div class="col-sm-12 col-xs-12">

                <section style="padding-bottom: 50px; padding-top: 50px;">

                   

                    <!--dashbord start-->
                    <div class="dashbord_inno">
                        <div class="container">
                           

                            
                          
                            
                            
                            <div style="clear:both; height:30px;"></div>
                            

                            <div class="clearfix"></div>
          	
            
                            <div class="row">
                                <div class="col-lg-12 co-md-12 col-sm-12">
                                    <div class="order_table">
                                        <h2>My Messages
										
										<?php //echo getlanguage('cash_outs'); ?></h2>
                                        <div class="order_content">
                                            <div class="col-lg-12 co-md-12 col-sm-12">
                                                <table class="table history-table scrollable-table-head margin0">
                                                    <thead class="padding-right-20">
                                                    
                                                    <tr>
                                                        <th  class="importdbookstbl">Serial<?php //echo getlanguage('cashout-id'); ?></th>
                                                        <th  class="importdbookstbl">Order Id<?php //echo getlanguage('status'); ?></th>
                                                        <th  class="importdbookstbl">From<?php //echo getlanguage('requested-at'); ?></th>
                                                        <th  class="importdbookstbl">To<?php //echo getlanguage('approval-at'); ?></th>
                                                        <th  class="importdbookstbl">Title<?php //echo getlanguage('get-paid-at'); ?></th>
                                                        <th  class="importdbookstbl">Message<?php //echo getlanguage('cashback'); ?></th>
                                                        
                                                        <th  class="importdbookstbl">Date<?php //echo getlanguage('status'); ?></th>
                                                    </tr>
                                                    
                                                    
                                                    </thead>
                                                </table>
                                                <?php if($my_messages) { ?>
                                                    <div class="scrollable-table-body-cont margin-bottom-20">
                                                        <table class="table history-table scrollable-table-body table-hover">
                                                            <tbody>
                                                                <?php
																$i=0; 
																foreach ($my_messages as $row) {

																$i++;
																//print_r($row);
																$user_from = $this->comman_model->get("user",array("user_id"=>$row['user_id_from']));
																$user_to = $this->comman_model->get("user",array("user_id"=>$row['user_id_to']));
                                                                 // echo '<pre>';  print_r($user_to);
																?>
                                                                 <tr>
                                                                 <td class="importdbookstbl">
                                                                                    <?php echo $i; ?>
                                                                                </td>
                                                                                <td class="importdbookstbl" style="max-width: 180px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;"><?php echo $row['unique_order_id'];
																				
																				 ?></td>
                                                                                <td class="importdbookstbl"><?php echo $user_from[0]['username']; ?></td>
                                                                                
                                                                                <td class="importdbookstbl"><?php echo $user_to[0]['username']; ?></td>
                                                                                <td class="importdbookstbl"><?php echo $row['title']; ?></td>
                                                                                <td class="importdbookstbl">
                                                                                    <a href="<?php echo base_url('frontend/users/message_reply').'/'.encode_url($row['id']); ?>">
																					<?php echo $row['message']; ?>
                                       </a>                                             
                                                                                </td>
                                                                                
                                                                                 <td class="importdbookstbl">
                                                                                    <?php echo $row['created_on']; ?>
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

 function export_feedbacks(){
        var query_str = '';
        
		
        
        window.location.href = '<?php echo base_url('export_feedbacks'); ?>'+query_str;
    }



	
</script>