<?php
    $uri = 0;
    if($this->uri->segment(3) != ''){
        $uri = $this->uri->segment(3);
    }

  ?>
<?php  
    $days_in_current_month = cal_days_in_month(CAL_GREGORIAN, date('m'), date('Y'));
    $selected_payment_period = date('m/01/y').' - '.date('m/15/y');
    if(date('d')>15){
      $selected_payment_period = date('m/16/y').' - '.date('m/'.$days_in_current_month.'/y');
    }
?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<section id="main-content">
    <section class="wrapper site-min-height">
        <section class="panel">
            <header class="panel-heading">
                Payment Summary
            </header>
<form name="searchF" id="searchF" action="" method="get" >  
<table width="100%" cellpadding="2" cellspacing="2">
<tbody>
<tr>
 
    <td height="50" width="15%" class="body1">
        Seller:
    </td>
    <td width="25%" class="body1">
    <select name="seller"  id="seller" class="body1 form-control js-example-basic-single">
        <option value="">All</option>
        <?php 
        $sellers = $this->comman_model->get('user',array('user_type'=>'Seller'));
        if($sellers){
            foreach ($sellers as $seller) {
                $selected = ($this->input->get('seller')==$seller['user_id'])? 'selected="selected"' : '';
                echo '<option value="'.$seller['user_id'].'" '.$selected.'>'.$seller['username'].'</option>';
            }
        }
        ?>
    </select>


    </td>
    <td width="10%" align="left"></td>
    <td width="50%" height="3" align="right">   </td>
</tr>
<tr>
 
    <td height="50" width="15%" class="body1">
        <input type="radio" name="PaymentType" value="Status" <?php if($this->input->get('PaymentType')=="Status") {?> checked="true" <?php }?>>
        Status:

    </td>
    <td width="25%" class="body1">
    <select name="order_status"  id="order_status" class="body1 form-control js-example-basic-single">

            <option value="">All</option>
            <option value="Refunded" <?php if($this->input->get('order_status')=="Refunded") {?> selected="selected" <?php }?>>Refunded</option>
            <option value="Cancelled" <?php if($this->input->get('order_status')=="Cancelled") {?> selected="selected" <?php }?>>Cancelled</option>
            <option value="Paid" <?php if($this->input->get('order_status')=="Paid") {?> selected="selected" <?php }?>>Paid</option>


        </select>
    </td>
    <td width="10%" align="left"></td>
    <td width="50%" height="3" align="right">   </td>
</tr>

<tr>
<td class="body1">
  <input type="radio" name="PaymentType" <?php if($this->input->get('PaymentType')=="Period" || $this->input->get('PaymentType')=="") {?> checked="true" <?php }?> value="Period" >
  Payment Period: 
</td>
<td class="body1">
<select name="PaymentID" id="payment_period" class="body1 form-control js-example-basic-single">
<?php 
$paymentPeriods = listPaymentPeriod();
foreach ($paymentPeriods as $paymentPeriod) {
  echo "<option value='$paymentPeriod'>$paymentPeriod</option>";
}

?>
</select>
</td>
<td class="body1" align="left" style="padding-left:5px; padding-right:5px;">
  <select name="years" id="years" class="body1 form-control js-example-basic-single">
    <?php $years = $this->input->get('years');
    $current_year = date('Y'); 
    for ($i=$current_year; $i >= $current_year-10; $i--) {
      $selected = ($years==$i)? 'selected="selected"' : '';
      echo '<option value="'.$i.'" '.$selected.'>'.$i.'</option>';
    }
    ?>
  </select>
</td>
<td align="left"></td>
</tr>

<tr>

    <td height="50" width="10%" class="body1">
        <input type="radio" name="PaymentType" value="Days" <?php if($this->input->get('PaymentType')=="Days") {?> checked="true" <?php }?> >
        Number of Days:
    </td>
    <td width="30%" class="body1">
        <select name="orders_of" id="orders_of" class="body1 form-control js-example-basic-single">
<?php $orders_of= $this->input->get('orders_of'); ?>
            <option value="">All</option>
            <option value="1" <?php echo ($orders_of=="1")? 'selected="selected"' : ''?>>1</option>
            <option value="15" <?php echo ($orders_of=="15")? 'selected="selected"' : ''?>>15</option>
            <option value="45" <?php echo ($orders_of=="45")? 'selected="selected"' : ''?>>45</option>
            <option value="60" <?php echo ($orders_of=="60")? 'selected="selected"' : ''?>>60</option>
            <option value="90" <?php echo ($orders_of=="90")? 'selected="selected"' : ''?>>90</option>
            <option value="120" <?php echo ($orders_of=="120")? 'selected="selected"' : ''?>>120</option>
            <option value="150" <?php echo ($orders_of=="150")? 'selected="selected"' : ''?>>150</option>
            <option value="180" <?php echo ($orders_of=="180")? 'selected="selected"' : ''?>>180</option>
            <option value="365" <?php echo ($orders_of=="365")? 'selected="selected"' : ''?>>365</option>
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
    <td align="center"><input type="submit" class="btn btn-primary pull-right" name="Go" value="Go"></td>
    <td  align="right" colspan="3"> <a href="javascript:void(0)" class="btn btn btn-primary pull-right" id="export_refund_sales" onclick="export_orders()">Export</a></td>
</tr>




</tbody>
</table>
</form>  
            <?php $this->load->view('errors'); ?>
            <?php if($received_orders){ ?>
                <table class="table table-striped table-advance table-hover" id="admin_manage_listing">
                    <thead>
                        <tr>
                            <th width="12%">Order#</th>
                            <th width="8%">Seller</th>
                            <th width="8%">Date</th>
                            <th  width="10%">Book Title</th>
                            <th width="5%">Type</th>
                            <th width="8%">Condition</th>
                            <th width="8%">ISBN</th>
                            <th width="7%">SKU</th>
                            <th width="7%">Status</th>
                            <th width="5%">Price</th>
                            <th width="7%">Shipping</th>
                            <th width="8%">Comission</th>
                            <th width="7%">Earning</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $total_shipping = 0;
                        $total_price = 0;
                        $total_comission = 0;
                        $total_earnings = 0;
                        foreach ($received_orders as $row) {
                            $product = $this->comman_model->get("products",array("product_id"=>$row['product_id']));
                            $sellerData = $this->comman_model->get("user",array("user_id"=>$row['seller_id']));
                        ?>
                            <tr>
                                <td width="12%"><?php echo $row['unique_order_id']?></td>
                                <td width="8%"><?php echo $sellerData[0]['username']; ?></td>
                                <td width="8%"><?php echo $row['created_on']?></td>
                                <td  width="10%">
                                  <span class="importdbookstbl">
                                    <a target="_blank" href="<?php echo base_url('product/detail') . "/" . encode_url($row['product_id']); ?>">
                                    <?php echo $product[0]['title']?>
                                    </a>
                                    </span><br />
                                </td>
                                <td width="5%"><?php echo $product[0]['book_type']?></td>
                                <td width="8%"><?php echo $product[0]['book_condition']?></td>
                                <td width="8%"><?php echo $product[0]['isbn']?></td>
                                <td width="7%"><?php echo $product[0]['sku']?></td>
                                <td width="7%"><?php echo $row['order_status']?></td>
                                <td width="5%">
                                    <?php echo $row['price'];
                                    $total_price = $total_price + $row['price'];
                                    ?>
                                </td>
                                                                                
                                <td width="7%">
                                    <?php echo $row['shipping_value'];
                                        $total_shipping = $total_shipping + $row['shipping_value'];
                                ?>
                                </td>
                                                                                
                                <td width="8%">
                                    <?php echo $row['final_value_on_product'];
                                    $total_comission = $total_comission + $row['final_value_on_product'];
                                    ?>
                                </td>
                                                                                
                                <td width="7%">
                                    <?php
                                    $earnings = ($row['price']+$row['shipping_value'])-$row['final_value_on_product'];
                                    echo $earnings;
                                    $total_earnings = $total_earnings + $earnings;
                                    ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <div>
<div style="clear: both; padding-top: 10px;">
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
</div>
                <?php //echo $pagination; ?>
            <?php }else{
                adminRecordNotFoundMsg();
            } ?>
        </section>
    </section>
</section>

<script type="text/javascript">

  $(document).ready(function(){
    $('#payment_period').val('<?php echo $selected_payment_period; ?>');
    <?php if($this->input->get('PaymentID')!=''){ ?>
      $('#payment_period').val('<?php echo $this->input->get('PaymentID'); ?>');
    <?php } ?>

    $(".js-example-basic-single").select2();
  });

  function export_orders(){
         var query_str = '';

        if($('#seller').val()!=''){
          query_str += '&seller='+$('#seller').val();
        }

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
        window.location.href = '<?php echo base_url('admin/users/export_sales_refunds'); ?>'+query_str;
    }
</script>