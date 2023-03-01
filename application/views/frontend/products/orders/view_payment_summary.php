<?php
    $currentUserData = getUserData(getCurrentUserId());
    $countries = $this->comman_model->get('countries');
?>

<style>
	.importdbookstbl{
    text-align: left !important;
    text-indent: 4px;
    vertical-align: middle !important;
	}
    th, td{
    padding:8px 4px !important;
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
.td1_width
{
	 max-width:40px !important;
    min-width: 100px !important;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}
.importdbookstbl a{
    color:#323232;
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
                            
                            
                          
                            <div><h3>PAYMENT DETAIL</h3></div>
                            
              <form name="searchF" id="searchF" action="" method="get" >              
                           <table width="100%" class="table history-table scrollable-table-head margin0">
                           



<tr>
<td>
<table width="100%" cellpadding="2" cellspacing="2">
<tbody>
<tr>
 
    <td height="50" width="10%" class="body1">
        <input type="radio" name="PaymentType" value="Status" <?php if($this->input->get('PaymentType')=="Status") {?> checked="true" <? }?>>
        Status:

    


    </td>
    <td width="30%" class="body1">
    <select name="order_status"  id="order_status" class="body1 form-control">

            <option value="">All</option>
            <option value="Refunded">Refunded</option>
            <option value="Cancelled">Cancelled</option>
            <option value="Paid">Paid</option>


        </select>
    </td>
    <td width="10%" align="left"></td>
    <td width="50%" height="3" align="right">   </td>
</tr>

<tr>
<td class="body1">
  <input type="radio" name="PaymentType" <?php if($this->input->get('PaymentType')=="Period" || $this->input->get('PaymentType')=="") {?> checked="true" <? }?> value="Period" >
  Payment Period: 
  
  
</td>
<td class="body1" id="listedDates">
    <?
    $year = date('Y');
    $option = '<select name="PaymentID" id="2016" class="body1 form-control">';

    for($month=1;$month<=12;$month++){
        $list=array();

        $month_end = strtotime('last day of this month', strtotime($year.'-'.$month.'-'.'1'));
        $day = date('d', $month_end).'<br/>';


        $time=mktime(12, 0, 0, $month, 1, $year);
        if (date('m', $time)==$month)
            $a1=date('m/d/Y', $time);

        $time=mktime(12, 0, 0, $month, 15, $year);
        if (date('m', $time)==$month)
            $b1=date('m/d/Y', $time);
        $option .= '<option value="'.$a1.' - '.$b1.'">'.$a1.' - '.$b1.'</option>';
        $time=mktime(12, 0, 0, $month, 16, $year);
        if (date('m', $time)==$month)
            $a2=date('m/d/Y', $time);


        $time=mktime(12, 0, 0, $month, $day, $year);
        if (date('m', $time)==$month)
            $b2=date('m/d/Y', $time);


        $option .= '<option value="'.$a2.' - '.$b2.'">'.$a2.' - '.$b2.'</option>';

    }
    $option .= '</select>';
    echo $option;
    ?>

</td>
<td align="left" style="padding-left:5px; padding-right:5px;"><span class="body1">
  <select name="years" id="years" onchange="PopulateDates()" class=" form-control">
  <?php 
  		$current_year = date("Y");
  		$result = ""; 
  		for ($i=$current_year; $i>='2013'; $i--){
  			$result .= "<option value='$i' "; 
  			if($i == $current_year){
  					$result .= "selected ";
  			}	
  			$result .= ">$i</option>";
  		}
  		echo $result;
  ?>
  </select>
</span></td>
    <?php  echo date("Y");?>
<td align="left"></td>

</tr>

<tr>

    <td height="50" width="10%" class="body1">
        <input type="radio" name="PaymentType" value="Days" <?php if($this->input->get('PaymentType')=="Days") {?> checked="true" <? }?> >
        Number of Days:




    </td>
    <td width="30%" class="body1">
        <select name="orders_of" id="orders_of" class="body1 form-control">

            <option value="">All</option>
            <option value="1">1</option>
            <option value="15">15</option>
            <option value="45">45</option>
            <option value="60">60</option>
            <option value="90">90</option>
            <option value="120">120</option>
            <option value="150">150</option>
            <option value="180">180</option>
            <option value="365">365</option>
            <?php
            /*for($d=1;$d<=180;$d++){
                ?>
                <option <?php if($this->input->get('orders_of')==$d) {?> selected <? }?> value="<?=$d?>"><?=$d?></option>
                <?php
            }*/
            ?>



        </select>
    </td>
    <td width="10%" align="left"></td>
    <td width="50%" height="3" align="right">   </td>
</tr>

<tr>
    <td></td>
    <td align="center"><input type="submit" class="btn btn-cart" name="Go" value="Go"></td>
    <td  align="right" colspan="3"> <a href="javascript:void(0)" class="btn btn-cart pull-right" id="export_refund_sales" onclick="export_orders()">Export <i class="fa-solid fa-download"></i></a></td>
</tr>




</tbody></table>
</td>
</tr>
                            
                            
                   </table>
                         </form>   

                            <div class="clearfix"></div>
          	
            <div class="row">
                                <div class="col-lg-12 co-md-12 col-sm-12" style="padding:0px;">
                                    <div class="order_table">
                                        <div style="padding-top:10px;padding-left:10px; border-bottom:solid 1px #ccc;"><h4 >View Payment Summary<?php //echo getlanguage('cash_outs'); ?></h4></div>
                                        <div class="order_content">
                                            <div class="col-lg-12 co-md-12 col-sm-12">
                                                <table class="" style="width:100%;">
                                                    <thead class="padding-right-20">
                                                    
                                                    <tr>
                                                        <th width="12%"  class="importdbookstbl">Order#<?php //echo getlanguage('cashout-id'); ?></th>
                                                    <th width="12%" align="left"  class="importdbookstbl">Order Date<?php //echo getlanguage('requested-at'); ?></th>
                                                      <th width="13%" align="left"  class="importdbookstbl">Book Title<?php //echo getlanguage('approval-at'); ?></th>
                                                      <th width="7%" align="left"  class="importdbookstbl">Type<?php //echo getlanguage('approval-at'); ?></th>
                                                      <th width="7%" align="left"  class="importdbookstbl">Condition<?php //echo getlanguage('approval-at'); ?></th>
                                                      <th width="7%" align="left"  class="importdbookstbl">ISBN<?php //echo getlanguage('approval-at'); ?></th>
                                                      <th width="7%" align="left"  class="importdbookstbl">SKU<?php //echo getlanguage('approval-at'); ?></th>
                                                      <th width="7%" align="left"  class="importdbookstbl">Status<?php //echo getlanguage('get-paid-at'); ?></th>
                                                      <th width="7%" align="left"  class="importdbookstbl">Price<?php //echo getlanguage('cashback'); ?></th>
                                                      <th width="7%" align="left"  class="importdbookstbl">Shipping<?php //echo getlanguage('status'); ?></th>
                                                      <th width="7%" align="left"  class="importdbookstbl">Comission<?php //echo getlanguage('status'); ?></th>
                                                      <th width="7%" align="left"  class="importdbookstbl">Earning<?php //echo getlanguage('status'); ?></th>
                                                        
                                                    </tr>
                                                    
                                                    
                                                    </thead>
                                                </table>
                                                <?php if($received_orders) { ?>
                                                    <div class="-table-body-cont margin-bottom-20">
                                                        <table width="100%" class="table history-table scrollable-table-body table-hover">
                                                            <tbody>
                                                                <?php
                                                                $total_shipping = 0;
                                                                $total_price = 0;
                                                                $total_comission = 0;
                                                                $total_earnings = 0;
																foreach ($received_orders as $row) { 
																$product = $this->comman_model->get("products",array("product_id"=>$row['product_id']));
																?>
                                                                 <tr>
                                                                                <td width="12%" valign="top" class="importdbookstbl td1_width"><?php echo $row['unique_order_id']?></td>
                                                                   <td width="12%" align="left" valign="top" class="importdbookstbl"><?php echo $row['created_on']?></td>
                                                                                <td width="13%" align="left" valign="top">
                                                                             
                  <span class="importdbookstbl">
                  <a target="_blank" href="<?php echo base_url('product/detail') . "/" . encode_url($row['product_id']); ?>">
								   <?php echo $product[0]['title']?>
                  </a>
                  </span><br />
                  <!-- <strong > Type:<?php //echo $row['book_type']?></strong><span><br /></span> -->
                  <!-- <strong  style="float:left; display:inline;">Condition:</strong><span><?php //echo $row['book_condition']?> </span> <br> -->
                  <!-- <strong > ISBN:</strong><span><?php //echo $row['isbn']?></span> &nbsp 
                  <strong  style="float:left; display:inline;"> SKU:</strong><span><?php //echo $row['sku']?> </span> <br> -->
                                                                                
                                                                                
                                                                                
                                                                                
                                                                                
                                                                   </td>
                                                                                <td width="7%" align="left" valign="top" class="importdbookstbl"><?php echo $product[0]['book_type']?></td>
                                                                                <td width="7%" align="left" valign="top" class="importdbookstbl"><?php echo $product[0]['book_condition']?></td>
                                                                                <td width="7%" align="left" valign="top" class="importdbookstbl"><?php echo $product[0]['isbn']?></td>
                                                                                <td width="7%" align="left" valign="top" class="importdbookstbl"><?php echo $product[0]['sku']?></td>
                                                                                <td width="7%" align="left" valign="top" class="importdbookstbl"><?php echo $row['order_status']?></td>
                                                                                <td width="7%" align="left" valign="top" class="importdbookstbl">
                                                                                    <?php echo $row['price'];
                                                                                    $total_price = $total_price + $row['price'];
                                                                                    ?>
                                                                                </td>
                                                                                
                                                                                 <td width="7%" align="left" valign="top" class="importdbookstbl">
                                                                                    <?php echo $row['shipping_value'];
                                                                                    $total_shipping = $total_shipping + $row['shipping_value'];
                                                                                    ?>
                                                                                </td>
                                                                                
                                                                                <td width="7%" align="left" valign="top" class="importdbookstbl">
                                                                                   <?php echo $row['final_value_on_product'];
                                                                                   $total_comission = $total_comission + $row['final_value_on_product'];
                                                                                   ?>
                                                                                </td>
                                                                                
                                                                                 <td width="7%" align="left" valign="top" class="importdbookstbl">
                                                                                    <?php
                                                                                    $earnings = ($row['price']+$row['shipping_value'])-$row['final_value_on_product'];
                                                                                    echo $earnings;
                                                                                    $total_earnings = $total_earnings + $earnings;
                                                                                    ?>
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
                                          <div style="clear:both;"></div>
                                        </div>
                                          <div style="clear:both;"></div>
                                    </div>
                                
                                
                                </div>
                          </div>
                          <div style="clear:both; height:20px;"></div>
                                            
                                            <div>
                                            <table width="35%" border="0" align="right" cellpadding="0" cellspacing="0">
  <tr>
    <td width="5%" align="center"><strong>Bookprice</strong></td>
   <td width="5%" align="center"><strong>+shipping</strong></td>
    <td width="5%" align="center"><strong>Commision</strong></td>
  <td width="5%" align="center"><strong>Total earning</strong></td>
  </tr>
  <tr>
    <td align="center">US $<?=$total_price?></td>
   <td align="center">US $<?php echo $total_shipping;?></td>
    <td align="center">$<?=$total_comission?></td>
  <td align="center">US $<?=($total_price+$total_shipping)-$total_comission?></td>
  </tr>
</table>
</div>

   <div style="clear:both; height:20px;"></div>
                            
                            
                        </div>
                    </div>
                    <!--dashbord end-->
                </section>
            </div>
        </div>
    </div>
</div>

<script type="application/javascript">
    function PopulateDates(){
        var year = $("#years").val();
        $.ajax({
            type: "POST",
            url: '<?php echo base_url("frontend/products/listedDates");?>',
            data: {year: year},
            success: function(data){
                $("#listedDates").html(data);



            }
        });
    }



    $('#orders_of').val('<?php echo $this->input->get('orders_of'); ?>');


    function resetProfileUpdateResponse(){
        var responseMsgCont = $('.update-prof-response-cont');
        var loaderObj = $('.profile-update-loader');

        loaderObj.show();
        responseMsgCont.hide();

        responseMsgCont.find('.alert').removeClass('alert-danger alert-success');
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
</script>		