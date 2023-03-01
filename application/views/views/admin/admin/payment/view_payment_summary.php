<?php
    $uri = 0;
    if($this->uri->segment(3) != ''){
        $uri = $this->uri->segment(3);
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
 
    <td height="50" width="10%" class="body1">
        Seller:
    </td>
    <td width="30%" class="body1">
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
    <script type="text/javascript">
$(document).ready(function() {
  $(".js-example-basic-single").select2();
});
</script>


    </td>
    <td width="10%" align="left"></td>
    <td width="50%" height="3" align="right">   </td>
</tr>
<tr>
 
    <td height="50" width="10%" class="body1">
        <input type="radio" name="PaymentType" value="Status" <?php if($this->input->get('PaymentType')=="Status") {?> checked="true" <?php }?>>
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
  <input type="radio" name="PaymentType" <?php if($this->input->get('PaymentType')=="Period" || $this->input->get('PaymentType')=="") {?> checked="true" <?php }?> value="Period" >
  Payment Period: 
</td>
<td class="body1"><select name="PaymentID" id="2016" class="body1 form-control">
  <option value="01/01/15 - 01/15/16">01/01/15 - 01/15/15</option>
  <option value="01/16/15 - 01/31/16">01/16/15 - 01/31/15</option>
  <option value="02/01/15 - 02/15/16">02/01/15 - 02/15/15</option>
  <option value="02/01/15 - 02/15/16">02/01/15 - 02/15/15</option>
  <option value="03/01/15 - 03/15/16">03/01/15 - 03/15/15</option>
  <option value="03/16/15 - 03/31/16">03/16/15 - 03/31/15</option>
  <option value="04/01/15 - 04/15/16">04/01/15 - 04/15/15</option>
  <option value="04/16/15 - 04/30/16">04/16/15 - 04/30/15</option>
  <option value="05/01/15 - 05/15/16">05/01/15 - 05/15/15</option>
  <option value="05/16/15 - 05/31/16">05/16/15 - 05/31/15</option>
  <option value="06/01/15 - 06/15/16">06/01/15 - 06/15/15</option>
  <option value="06/16/15 - 06/30/16">06/16/15 - 06/30/15</option>
  <option value="07/01/15 - 07/15/16">07/01/15 - 07/15/15</option>
  <option value="07/16/15 - 07/31/16">07/16/15 - 07/31/15</option>
  <option value="08/01/15 - 08/15/16">08/01/15 - 08/15/15</option>
  <option value="08/16/15 - 08/31/16">08/16/15 - 08/31/15</option>
  <option value="09/01/15 - 09/15/16">09/01/15 - 09/15/15</option>
  <option value="09/16/15 - 09/30/16">09/16/15 - 09/30/15</option>
  <option value="10/01/15 - 10/15/16">10/01/15 - 10/15/15</option>
  <option value="10/16/15 - 10/31/16">10/16/15 - 10/31/15</option>
  <option value="11/01/15 - 11/15/16">11/01/15 - 11/15/15</option>
  <option value="11/16/15 - 11/30/16">11/16/15 - 11/30/15</option>
  <option value="11/16/15 - 11/30/16">12/01/15 - 12/15/15</option>
  <option value="01/01/14 - 01/15/16">01/01/14 - 01/15/14</option>
  <option value="01/16/14 - 01/31/16">01/16/14 - 01/31/14</option>
  <option value="02/01/14 - 02/15/16">02/01/14 - 02/15/14</option>
  <option value="02/01/14 - 02/15/16">02/01/14 - 02/15/14</option>
  <option value="03/01/14 - 03/15/16">03/01/14 - 03/15/14</option>
  <option value="03/16/14 - 03/31/16">03/16/14 - 03/31/14</option>
  <option value="04/01/14 - 04/15/16">04/01/14 - 04/15/14</option>
  <option value="04/16/14 - 04/30/16">04/16/14 - 04/30/14</option>
  <option value="05/01/14 - 05/15/16">05/01/14 - 05/15/14</option>
  <option value="05/16/14 - 05/31/16">05/16/14 - 05/31/14</option>
  <option value="06/01/14 - 06/15/16">06/01/14 - 06/15/14</option>
  <option value="06/16/14 - 06/30/16">06/16/14 - 06/30/14</option>
  <option value="07/01/14 - 07/15/16">07/01/14 - 07/15/14</option>
  <option value="07/16/14 - 07/31/16">07/16/14 - 07/31/14</option>
  <option value="08/01/14 - 08/15/16">08/01/14 - 08/15/14</option>
  <option value="08/16/14 - 08/31/16">08/16/14 - 08/31/14</option>
  <option value="09/01/14 - 09/15/16">09/01/14 - 09/15/14</option>
  <option value="09/16/14 - 09/30/16">09/16/14 - 09/30/14</option>
  <option value="10/01/14 - 10/15/16">10/01/14 - 10/15/14</option>
  <option value="10/16/14 - 10/31/16">10/16/14 - 10/31/14</option>
  <option value="11/01/14 - 11/15/16">11/01/14 - 11/15/14</option>
  <option value="11/16/14 - 11/30/16">11/16/14 - 11/30/14</option>
  <option value="11/16/14 - 11/30/16">12/01/14 - 12/15/14</option>
  <option value="01/01/13 - 01/15/16">01/01/13 - 01/15/13</option>
  <option value="01/16/13 - 01/31/16">01/16/13 - 01/31/13</option>
  <option value="02/01/13 - 02/15/16">02/01/13 - 02/15/13</option>
  <option value="02/01/13 - 02/15/16">02/01/13 - 02/15/13</option>
  <option value="03/01/13 - 03/15/16">03/01/13 - 03/15/13</option>
  <option value="03/16/13 - 03/31/16">03/16/13 - 03/31/13</option>
  <option value="04/01/13 - 04/15/16">04/01/13 - 04/15/13</option>
  <option value="04/16/13 - 04/30/16">04/16/13 - 04/30/13</option>
  <option value="05/01/13 - 05/15/16">05/01/13 - 05/15/13</option>
  <option value="05/16/13 - 05/31/16">05/16/13 - 05/31/13</option>
  <option value="06/01/13 - 06/15/16">06/01/13 - 06/15/13</option>
  <option value="06/16/13 - 06/30/16">06/16/13 - 06/30/13</option>
  <option value="07/01/13 - 07/15/16">07/01/13 - 07/15/13</option>
  <option value="07/16/13 - 07/31/16">07/16/13 - 07/31/13</option>
  <option value="08/01/13 - 08/15/16">08/01/13 - 08/15/13</option>
  <option value="08/16/13 - 08/31/16">08/16/13 - 08/31/13</option>
  <option value="09/01/13 - 09/15/16">09/01/13 - 09/15/13</option>
  <option value="09/16/13 - 09/30/16">09/16/13 - 09/30/13</option>
  <option value="10/01/13 - 10/15/16">10/01/13 - 10/15/13</option>
  <option value="10/16/13 - 10/31/16">10/16/13 - 10/31/13</option>
  <option value="11/01/13 - 11/15/16">11/01/13 - 11/15/13</option>
  <option value="11/16/13 - 11/30/16">11/16/13 - 11/30/13</option>
  <option value="11/16/13 - 11/30/16">12/01/13 - 12/15/13</option>
  <option value="01/01/16 - 01/15/16">01/01/16 - 01/15/16</option>
  <option value="01/16/16 - 01/31/16">01/16/16 - 01/31/16</option>
  <option value="02/01/16 - 02/15/16">02/01/16 - 02/15/16</option>
  <option value="02/01/16 - 02/15/16">02/01/16 - 02/15/16</option>
  <option value="03/01/16 - 03/15/16">03/01/16 - 03/15/16</option>
  <option value="03/16/16 - 03/31/16">03/16/16 - 03/31/16</option>
  <option value="04/01/16 - 04/15/16">04/01/16 - 04/15/16</option>
  <option value="04/16/16 - 04/30/16">04/16/16 - 04/30/16</option>
  <option value="05/01/16 - 05/15/16">05/01/16 - 05/15/16</option>
  <option value="05/16/16 - 05/31/16">05/16/16 - 05/31/16</option>
  <option value="06/01/16 - 06/15/16">06/01/16 - 06/15/16</option>
  <option value="06/16/16 - 06/30/16">06/16/16 - 06/30/16</option>
  <option value="07/01/16 - 07/15/16">07/01/16 - 07/15/16</option>
  <option value="07/16/16 - 07/31/16">07/16/16 - 07/31/16</option>
  <option value="08/01/16 - 08/15/16">08/01/16 - 08/15/16</option>
  <option value="08/16/16 - 08/31/16">08/16/16 - 08/31/16</option>
  <option value="09/01/16 - 09/15/16">09/01/16 - 09/15/16</option>
  <option value="09/16/16 - 09/30/16">09/16/16 - 09/30/16</option>
  <option value="10/01/16 - 10/15/16">10/01/16 - 10/15/16</option>
  <option value="10/16/16 - 10/31/16">10/16/16 - 10/31/16</option>
  <option value="11/01/16 - 11/15/16">11/01/16 - 11/15/16</option>
  <option value="11/16/16 - 11/30/16">11/16/16 - 11/30/16</option>
  <option value="11/16/16 - 11/30/16">12/01/16 - 12/15/16</option>
  <option value="01/01/17 - 01/15/17">01/01/17 - 01/15/17</option>
  <option value="01/16/17 - 01/31/17">01/16/17 - 01/31/17</option>
  <option value="02/01/17 - 02/15/17">02/01/17 - 02/15/17</option>
  <option value="02/01/17 - 02/15/17">02/01/17 - 02/15/17</option>
  <option value="03/01/17 - 03/15/17">03/01/17 - 03/15/17</option>
  <option value="03/16/17 - 03/31/17">03/16/17 - 03/31/17</option>
  <option value="04/01/17 - 04/15/17">04/01/17 - 04/15/17</option>
  <option value="04/16/17 - 04/31/17">04/16/17 - 04/31/17</option>
  <option value="05/01/17 - 05/15/17">05/01/17 - 05/15/17</option>
  <option value="05/16/17 - 05/31/17">05/16/17 - 05/31/17</option>
  <option value="06/01/17 - 06/15/17">06/01/17 - 06/15/17</option>
  <option value="06/16/17 - 06/31/17">06/16/17 - 06/31/17</option>
  <option value="07/01/17 - 07/15/17">07/01/17 - 07/15/17</option>
  <option value="07/16/17 - 07/31/17">07/16/17 - 07/31/17</option>
</select></td>
<td align="left" style="padding-left:5px; padding-right:5px;"><span class="body1">
  <select name="years" id="years" class=" form-control">
    <option value="2017" selected>2017</option>
    <option value="2016" >2016</option>
    <option value="2015">2015</option>
    <option value="2014">2014</option>
    <option value="2013">2013</option>
  </select>
</span></td>
<td align="left"></td>
</tr>

<tr>

    <td height="50" width="10%" class="body1">
        <input type="radio" name="PaymentType" value="Days" <?php if($this->input->get('PaymentType')=="Days") {?> checked="true" <?php }?> >
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
    <td align="center"><input type="submit" class="btn btn-primary pull-right" name="Go" value="Go"></td>
    <td  align="right" colspan="3"></td>
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