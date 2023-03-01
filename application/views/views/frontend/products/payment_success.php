<?php // print_r(get('store',  array('status'=>1))); ?>

<div class="col-xs-12">
  <div class="container store_listing">
    <div class="row no-padding">
      <div class="col-sm-12 col-xs-12">
        
        <?php if(isset($errors)){?>
        <div class="alert alert-danger" style="font-size:16px; margin-top:10px;"> <?php print_r($errors); ?></div>
        <?php }?>
        <?php if(isset($success)){?>
        <div class="alert alert-success" style="font-size:16px; margin-top:10px;"> <?php print_r($success); ?></div>
        <?php }?>
        <div class="product-filter product_mobile">
          <div class="product-compare"> You have <span id="total_cart_items" style="color:#ff5b53;" ><?php echo ($this->session->userdata('totalCartItems') != '')? $this->session->userdata('totalCartItems') : 0; ?></span> items for a total of <span style="color:#ff5b53;font-weight: bold;" id="checkout_top_sub_total">US$ <?php echo ($this->session->userdata('totalCartItems') != '')? $this->session->userdata('total') : 0; ?></span> in your basket<span style="color:#ff5b53;" >(Excluding all shipping)</span>. </div>
        </div>
        
<?php
$this->session->unset_userdata('totalCartItems');
$this->session->unset_userdata('total');
?>
      
    </div>
  </div>
</div>
</div>