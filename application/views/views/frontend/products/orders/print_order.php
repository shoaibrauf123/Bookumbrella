<?php
//echo '<pre>'; print_r($orders); echo '</pre>';
?>
<style type="text/css">
table {
    border-collapse: collapse;
    font-size: 24px;
}

table, th, td {
    border: 1px solid black;
    padding: 8px;
}
@page {
    size: auto;   /* auto is the initial value */
    margin: 0;  /* this affects the margin in the printer settings */
}
.header{
	text-align: center;
}
.header_top{
  width: 100%;
    padding: 20px;
}
.header_logo{
  width: 25%;
    text-align: center;
    font-size: 28px;
    font-weight: bold;
    padding: 20px;
}
.header_text{
  /*margin-top: -60px;*/
    /*width: 75%;*/
    text-align: center;
    font-size: 40px;
    font-weight: bold;
    padding: 20px 50px;
    color: #ef9816;
}
</style>
<?php foreach ($orders as $row) { 
      $user = $this->comman_model->get('user',array('user_id'=>$row['user_id']));
    $seller = $this->comman_model->get('user',array('user_id'=>$row['seller_id']));
    $product = $this->comman_model->get('products',array('product_id'=>$row['product_id']));
    ?>
<!-- <div style="width:25%; padding:20px; background:#00489a;"><img src="<?php echo base_url(); ?>assets/frontend/img/logo.png" style="margin-left:50px;" alt=""></div>-->
<div class="header_top">
<span class="header_logo">Bookumbrella</span>
<span class="header_text">Detail For Order# <?php echo $row['order_id']; ?></span>
</div>
<!-- <div class="header"><h2>Bookumbrella</h2></div>   -->      
<table width="100%" border="0" cellspacing="0" cellpadding="0">
         
  	<tr>
    <!-- <td>
    	<img  width="100px" height="100px" src="<?php echo base_url()?><?php echo $product[0]['image']?>">
   	</td> -->
   	<td>
    	<h2 style="margin-bottom: 0px;"><?php echo $product[0]['title']?></h2>
      <strong style="color:blue;"> Author:</strong><span style="color:blue;"><?php echo $product[0]['author']?></span><br>
        <strong> ISBN-10:</strong><span><?php echo $product[0]['isbn']?></span><strong> ISBN-13:</strong><span><?php echo $product[0]['isbn13']?></span> <br>
        <strong> Quantity:</strong><span><?php echo $row['qty']?></span><strong> Format:</strong><span><?php echo $product[0]['format']?></span> | <strong> Edition:</strong><span><?php echo $product[0]['edition']?></span> <br>
        <strong> Author:</strong><span><?php echo $product[0]['format']?></span><br>
        <strong> Condition:</strong><span><?php echo $product[0]['book_condition']?></span> <strong> Type:</strong><span><?php echo $product[0]['book_type']?></span><br>
        <strong>SELLER: </strong><span><?php echo $seller[0]['username'];?></span>

        <h3 style="margin-bottom: 2px;">Shipping Address</h3>
        <span><?php echo $row['address_name']?></span><br>
        <span><?php echo $row['address_street_address']?></span><br>
        <span><?php echo $row['address_city']?></span><br>
        <span><?php echo $row['address_state']?></span><br> 
        <span><?php echo $row['address_zip']?></span><br>
        <span><?php echo $row['address_country']?></span><br>
        <!-- <span><?php echo $row['address_phone_number']?></span> --> 
        
   	</td>
   	<td>
        <strong> Order Placed : </strong><span><?php echo date('F d, Y', strtotime($row['created_on'])); ?></span> <br>
       	<strong> Order Id: </strong><span><?php echo $row['unique_order_id']; ?></span></br>
        <strong> Product Price: </strong><span>$<?php echo number_format($row['price'],2); ?></span> <br>
        <strong> Shipping: </strong><span>$<?php echo $row['shipping_value']; ?>(<?php echo $row['shipping_type']; ?>)</span> <br>
          <?php $order_total = $row['price'] + $row['shipping_value']; ?>      
        <strong> Order Total: </strong><span>$<?php echo number_format($order_total,2); ?></span> <br>
        <strong> Order Status: </strong><span><?php echo $row['order_status']; ?></span></br>
        <strong> Payment Status: </strong><span><?php echo $row['payment_status']; ?></span> <br>
   	</td>
    </tr>
  
  
</table>
<br>
<br>
<div class="header_top" style="text-align: center;">
  <h2 style="color:blue;">Print invoice your Records</h2>
</div>
<?php } ?>