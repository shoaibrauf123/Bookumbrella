<?php //print_r($buyer_stats); ?>
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
  /*  box-shadow: 0 2px 8px #555;*/
    
}
.order_table {
 
    box-shadow: none;

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
                            
                        
                            
                            
                            
               <div class=" detailfilter" >
                            <form name="search" action="<?php echo base_url('my_orders');?>" method="post">
                            <table cellpadding="0" cellspacing="0" style="margin-bottom:10px;" >
                            <tr>
                            
                             
                            <td align="left"><strong>Start Date:</strong>
							
                                <input class="form-control" type="text" id="start_date" onchange="filter_orders()" value="<?php echo date('m/d/Y'); ?>" />

                            </td>

                            <td align="left"><strong>End Date:</strong>
							
                                <input class="form-control" type="text" id="end_date" onchange="filter_orders()" value="<?php echo date('m/d/Y'); ?>"/>

                            </td>
                            
                            
                            
                            </tr>
                            
                            
                            
                            </table>
                            </form>

                         </div>
                            <div class="clearfix"></div>

                            <div class="row">
                                <div class="col-lg-12 co-md-12 col-sm-12">	
                                    <div class="order_table">
                                        <h2><a href="javascript:void(0)" class="toggle_orders active_btn" id="my_orders">Payment Statistics</a>  </h2>
                                        <div class="order_content my_orders">
                                            <div class="product-col list clearfix col-sm-12 test __web-inspector-hide-shortcut__" style="border-bottom:1px dotted #ff5b53;">
         
									          <div class="col-xs-12 col-sm-12">
									            <div>
									            
									            <strong> Total Amount:</strong><?php echo ($buyer_stats[0]['total_amount'] == '')? 0 : $buyer_stats[0]['total_amount'];?><span></span> <br>
									            <strong> Total Shiping:</strong><span><?php echo ($buyer_stats[0]['total_shiping'] == '')? 0 : $buyer_stats[0]['total_shiping'];?></span> <br>
									            <strong> Total Commission:</strong><span><?php echo ($buyer_stats[0]['total_commission'] == '')? 0 : $buyer_stats[0]['total_commission'];?></span> <br>
									            
									          
									        </div>
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
    $('#start_date').val('<?php echo $this->input->get('start_date'); ?>');
    $('#start_date').datepicker({});
    
    $('#end_date').val('<?php echo $this->input->get('end_date'); ?>');
    $('#end_date').datepicker({});

  });
    function filter_orders(obj){
        var query_str = '';
        if($('#start_date').val() != ''){
            query_str += '&start_date='+$('#start_date').val();
        }
        if($('#end_date').val() != ''){
            query_str += '&end_date='+$('#end_date').val();
        }
        if(query_str!=''){
          query_str = encodeURI('?'+query_str);  
        }
        
        window.location.href = '<?php echo base_url('payment_stats'); ?>'+query_str;
    }   
</script>