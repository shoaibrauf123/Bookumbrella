<?php //print_r(getSellersCountries($this->uri->segment(3))); die; ?>
<div class="container">

<style>
  span , strong{
  font-family: Helvetica !important;
  }
.container
{
	width:100%;
}
.nagitive_bar {
  position: relative;
  width: 100%;
  height: 10px;
  background-color: #ddd;
  margin-bottom: 5px;
}
.cd-accordion-menu-cont .section-title
{
	background:#fff !important;
	color:#000;
	margin-top:2px;
	padding-top:6px !important;
}
.positive_bar {
  position: absolute;
  width: 0%;
  height: 100%;
  background-color: #4CAF50;a
}

img.img-responsive.center-block.center-block-1 {
    border-radius: 2px;
    box-shadow: inset 0px 0px 2px 2px #ccc, 3px 3px 5px 0px #eee;
    padding: 8px;
    display: table-cell;
    text-align: center;
    vertical-align: middle;
}
.col-md-2.clear-padding {
    padding-right: 10px !important;
}

.product-detail-page {
   margin-top:18px;
    padding-left: 12px;
}
.detail-page-add-cart {
    
  padding: 30px 20px;
    
}
.detail-page-add-cart span, p, select {
font-family: "Libre Baskerville" !important;
/* font-size:20px !important ; */

}
select#shipping_aplied_75 {
    font-size: 18px;
}
.product-detail-page .nav-tabs li.active a {
  border: none;
  background: rgb(187, 152, 112) !important;
	color:#fff !important;
	font-weight:bold;
	font-size:22px !important;
}
.product-detail-page .nav-tabs li a
{
  font-family: "Libre Baskerville" !important;
  border: none;
  background: #ffff none repeat scroll 0 0;
	color: #000 !important;
	font-weight:bold;
	font-size:22px !important;

}
.PDP_itemList tr th
{
	background:#fff;
	font-size:14px !important;
	color:#000;
}
.main-header
{
  font-family: "Libre Baskerville" !important;
  font-size:32px;
	padding-left: 15px;
  margin-top: 20px;
	font-weight:bold !important;
	color:#000 !important;
}
.well

{
	background-color:transparent !important;
	background-image:inherit !important;
	border:none !important;
	margin:0px !important;
	padding:0px !important;
}
.well {
border-color: #dcdcdc !important;
    box-shadow: none !important;
}

.PDP_itemList tr th, .PDP_itemList tr td
{
	height: 38px !important;
    padding: 6px 5px 6px 10px !important;
}
.carousel-inner>.item>a>img, .carousel-inner>.item>img, .img-responsive, .thumbnail a>img, .thumbnail>img
{
	height:150px;
}
.table-hover > tbody > tr:hover
{
	background-color: #fff;
}
.PDP_itemPrice {
color: #000 !important;
}
label
{
	margin-bottom:0px;
}

.btn-default {
  background: #323232 !important;
  color: white !important;
  padding: 10px 20px !important;
  font-weight:500;
  border-radius:3px !important;

}
.btn-default:hover {
  color: #ffffff !important;
  background: #ab9271 !important;
}

.btn-primary{

  color: #ffffff !important;
  background: #ab9271 !important;
  padding: 7px 20px !important;
  font-weight:500;
  border-radius:2px !important;
  border:none !important;

}

.btn-primary:hover{

  color: rgb(255, 255, 255) !important;
  background: #323232 !important;

}

.add-to-cart-btn {
  font-family: "Libre Baskerville" !important;
  color: #ffffff !important;
  background: #ab9271 !important;
  padding: 9px 20px !important;
  font-size:18px;
  font-weight:600;
  border-radius:0px !important;
}

.add-to-cart-btn:hover {
  color: rgb(255, 255, 255) !important;
  background: #323232 !important;
}

/* .add-to-cart-btn::before {
 content: "\f217";
    font-family: 'Font Awesome 5 Free';
    font-weight: 900;
    font-size: 16px;
    padding-right: 15px
} */


.innoCustomScrollBar
{
	background-color: #fff !important;
}
.cd-accordion-menu label
{
	padding-left:0px !important;
	left:0px !important;
}
.cd-accordion-menu label::before, .cd-accordion-menu label
.cd-accordion-menu label::before, .cd-accordion-menu label::after
{
	background-image:inherit !important;
}
.product-detail-page .nav-tabs li a:hover
{
	background:#fff;
	border:solid 1px #ff5b53;
}
.product-detail-page .nav-tabs li a
{
	border:solid 1px #000 !important;
}
.product-detail-page .nav-tabs li.active a
{
	background:#fff;
	border:solid 1px #ff5b53;
}
.product-detail-page .nav-tabs{
	background:transparent!important;
}
.level-2
{
	margin-left:21px !important;
}
.PDP_itemList tr th, .PDP_itemList tr td

{
}
.section-title
{
 color: #323232;

}
.product-detail-page .nav-tabs li.active a span
{
	height:66px;
}
.col-sm-12.no-padding.bottom-ptop-sec {
    margin-bottom: 15px;
}
.label_price
{
	font-size:14px;  font-family:Lato, Arial, sans-serif; margin-top:-2px;  color:rgb(187, 152, 112) !important; font-weight:bold;
}
.padding_p0 p
{
	padding:0px !important;
	font-size:17px !important;
	font-family:Lato, Arial, sans-serif !important;
	margin:0px !important;
	font-family:Lato, Arial, sans-serif;
}
.padding_p0 label
{
	padding:0px !important;
  margin-top:11px;
	font-size:19px !important;
	font-family:Lato, Arial, sans-serif !important;
}

/* bj-css */

.form-group-pr-0{
  padding-right:0px;
}

.well-overflow .well{
  width: 970px;
}
.well-overflow{
  overflow-x: auto;
}


/* ======= responsive ====== */
@media only screen and (max-width: 1199px) {
  .navi_top li a {
    padding-left: 9px;
    padding-right: 9px;
    color: #999 !important;
}
}
@media only screen and (max-width: 991px) {
  .center-block.center-block-1{
    margin-left: auto;
    padding:0px;
  }
.list-price-1{
  padding-left: 15px;
}
.form-group-pr-0{
  padding-left:0px!important;
  margin-top:15px;
}
.header-input{
  display:block;
}
.btnaddcart {
    padding-right: 0px !important;
}

}



@media only screen and (max-width: 767px) {
  .well-overflow .well {
    width: 970px!important;
}

.finalprice.pull-left{
  width: fit-content!important;
    margin-bottom: 10px;
}
.header .header-mobile-flex{
  display:flex!important;
}
.social.logo , .col-toogle{
  width:50%!important;
}




}
@media only screen and (max-width: 575px) {
  .product-detail-page{
    display: block;
    padding-right: 12px;
    padding-top: 8px;
  }
  .center-block.center-block-1 {
    margin-left: auto;
}


}




</style>
            <?php
            
$standard_shipping = $this->comman_model->print_value("setting",array('slug'=>'standard_shipping'),'value');
                  $expedited_shipping = $this->comman_model->print_value("setting",array('slug'=>'expedited_shipping'),'value');
                  $second_day = $this->comman_model->print_value("setting",array('slug'=>'second_day'),'value');
                  $next_day = $this->comman_model->print_value("setting",array('slug'=>'next_day'),'value');
      //echo '<pre>';print_r($actual_product);exit;
       //echo '<pre>'; print_r($sellerProductData); echo '</pre>'; ?>

              <form acrtion="<?php echo base_url('product/detail/'.$this->uri->segment(3).''); ?>" method="get" id="detail_filter" >
                    <input type="hidden" id="listing" name="listing" value="yes"/>
                    <input type="hidden" id="condition" name="condition"
                           value="<?php echo ($this->input->get('condition')) ? $this->input->get('condition') : ''; ?>"/>
                   
                    <input type="hidden" name="type" id="type"
                           value="<?php echo ($this->input->get('type')) ? $this->input->get('type') : ''; ?>"/>
                    <input type="hidden" name="country" id="country"
                           value="<?php echo ($this->input->get('country')) ? $this->input->get('country') : ''; ?>"/>
                    <input type="hidden" name="srating" id="srating"
                           value="<?php echo ($this->input->get('srating')) ? $this->input->get('srating') : ''; ?>"/>

                        
            </form> 
            <div class="main-header" itemprop="name"><?php echo $actual_product['title']; ?>, <?php echo $actual_product['edition']; ?>:<?php echo $actual_product['format']; ?>
            
           <a style="font-size:20px; color: #000;display:block;"> by <?php echo $actual_product['author'] ?> </a>
            </div>
            
            <div class="col-sm-12 no-padding bottom-ptop-sec">
              <div class="col-xs-12 col-md-2 clear-padding">
                <div class="row">

                    <img alt="book cover" style=" width:200px; height:100%;padding-right:10px;"  class="img-responsive center-block center-block-1" src="<?php echo base_url().$actual_product['image']; ?>">
                    <section class="col-md-12 col-xs-7 product-detail-heading">
                        <h2 class="hidden-md hidden-lg author-mobile weight-normal">

                            by <a itemprop="author" href="javascript:;" style="color:blue"><u><?php echo $actual_product['author']?>
                           </u></a>

                        </h2>
                    </section>
                </div>
        </div>
        <div class="col-xs-12 col-md-3 padding_p0" style="padding-left:37px;">
        <div class="row">
      
      <span class="list-price-1"  style="font-size:14px; line-height:normal !important; padding-bottom:0px !important;">
            <label nowrap style="float: left; margin-top:-2.5px;">List Price:</label>
             <p  style="color:#000;font-weight:bold"> $<?php echo $actual_product['buy_price']?>     </p> 
           <div class="clearfix"></div>
        <label>Format:</label><p style="display:inline; "><?php echo $actual_product['format']?>        </p>
       <br>
       <label>Publisher:</label><p style="display:inline;"><?php echo $actual_product['publisher']?> </p>
       <br>
             <label>Grade:</label><p style="display:inline;"><?php echo $actual_product['grade']?> </p>
       <br>
             <label>Edition:</label><p style="display:inline;"><?php echo $actual_product['edition']?> </p>
       <br>             
             <label>Language:</label><p style="display:inline;"><?php echo $actual_product['language']?> </p>
       <br>
           <label>ISBN-10:</label><p style="display:inline;"><?php echo $actual_product['isbn']?> </p>
       <br>            
	    <label>ISBN-13:</label><p style="display:inline;"><?php echo $actual_product['isbn13']?> </p>
      </span>
       
      </div>
      </div>
            <div class="col-xs-12 col-md-7">
            <div class="row">
                 <div class="col-xs-12 col-md-12 form-group form-group-pr-0">
                    <div class="product-detail-page">
                       <!-- Nav tabs -->
                       <ul class="nav nav-tabs" role="tablist">
                         <?php
                         //echo 'asdfasdfasdfasfd1';exit;
                              $min_new_price = $this->product_model->min_product_price("seller_products",array("New"),array('product_id'=>$actual_product['product_id'],'pause_listing'=>'no'));
              //echo '<pre>';print_r();exit;
              
if($min_new_price){
		
		$upper_min_new_seller_shippings = $this->comman_model->get('seller_shippings',array("seller_id"=>$min_new_price[0]['user_id'])); 
             
		}
		
    
        
		$min_used_price = $this->product_model->min_product_price("seller_products",array("Like New","Very Good","Good","Acceptable"),array('product_id'=>$actual_product['product_id'],'pause_listing'=>'no'));
        //echo '<pre>';print_r($min_used_price);exit;
		if($min_used_price){
		
		$upper_min_used_seller_shippings = $this->comman_model->get('seller_shippings',array("seller_id"=>$min_used_price[0]['user_id']));             
		}
		?>
                  <?php if($min_new_price[0]['price'] != 0 && $min_used_price[0]['price'] != 0){ ?>
               <li  class="active" role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab" style="padding-top:5px !important;padding-bottom:5px !important; ">New Books <div style="font-size:14px;">from $<?php if($min_new_price[0]['price']) echo $min_new_price[0]['price']; else echo '0'; ?></div><span class="detail-arrow"></span></a></li>
                            <li role="presentation">
                      
                                 <a href="#home" aria-controls="home" role="tab" data-toggle="tab"  style=" padding-top:5px !important;padding-bottom:5px !important;">
                                  Used Books<div style="font-size:14px;">from $<?php if($min_used_price[0]['price']) echo $min_used_price[0]['price']; else echo '0'; ?></div>
                                  <span class="detail-arrow"></span>
                                 </a>
                            </li>

                       <?php }elseif($min_used_price[0]['price'] != 0){ ?>
                         <li role="presentation" class="active" >
                      
                           <a href="#home" aria-controls="home" role="tab" data-toggle="tab"  style=" padding-top:5px !important;padding-bottom:5px !important;">
                            Used Books<div style="font-size:14px;">from $<?php if($min_used_price[0]['price']) echo $min_used_price[0]['price']; else echo '0'; ?></div>
                            <span class="detail-arrow"></span>
                           </a>
                         </li>
                       <?php }elseif($min_new_price[0]['price'] != 0){ ?>
                              <li  class="active" role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab" style="padding-top:5px !important;padding-bottom:5px !important; ">New Books <div style="font-size:14px;">from $<?php if($min_new_price[0]['price']) echo $min_new_price[0]['price']; else echo '0'; ?></div><span class="detail-arrow"></span></a></li>
                       <?php } ?>
                       
                       </ul>
  <!-- Tab panes -->
  <div class="tab-content">
    <?php if($min_new_price[0]['price'] != 0 && $min_used_price[0]['price'] != 0){ ?>
    <div role="tabpanel" class="tab-pane active" id="profile">
        <div class="detail-page-add-cart">
            <p style="font-size:23px;  font-family:Open Sans; display:block; line-height:20px; color:#bb9870 !important; font-weight:bold; float:left;">$
              <?php if($min_new_price[0]['price']) echo $min_new_price[0]['price']; else echo '0';                    
                  if($upper_min_used_seller_shippings[0]['expedited'] == 'active' || $upper_min_used_seller_shippings[0]['second_day'] == 'active' || 
          $upper_min_used_seller_shippings[0]['next_day'] == 'active'){ ?>
              <span style="color:#000;"> + </span><span style="color:#000; font-size:25px;"> Shipping</span>
            </p> 
            <br>

            <p style="font-size:14px; color:#CCC; display:block; margin-top:8px; clear:both; width:100%;">

              <select  name="shipping_aplied" id="shipping_aplied_<?=$min_new_price[0]['id']?>" class="form-control" style="color:#000; width:45%;padding:5px 10px; float:left; font-weight:bold; font-size:20px;">
                  <option value="standard-<?php echo $standard_shipping;?>" selected>$<?php if($standard_shipping) echo $standard_shipping; else echo '0';?> Standard </option>
              <?php if($upper_min_new_seller_shippings[0]['expedited'] == 'active'){ ?>
                <option value="expedited_shipping-<?php echo $expedited_shipping;?>">$<?php if($expedited_shipping) echo $expedited_shipping; else echo '0';?> Expedited </option>
                  <?php } ?>
              <?php if($upper_min_new_seller_shippings[0]['second_day'] == 'active'){ ?>
                <option value="second_day-<?php echo $second_day;?>">$<?php if($second_day) echo $second_day; else echo '0';?> Second day </option>
                  <?php } ?>
                  
              <?php if($upper_min_new_seller_shippings[0]['next_day'] == 'active'){ ?>
            
                <option value="next_day-<?php echo $next_day;?>">$<?php if($next_day) echo $next_day; else echo '0';?> Next day</option>
                  <?php } ?>
                  
                  
              </select>
                <?php if($min_new_price[0]['price']>0){ ?>
                  <button class="btn btn-primary add-to-cart-btn pull-right" id="<?=$min_used_price[0]['id']?>" style="font-size:18px;">
                      <i class="fa fa-cart-plus" aria-hidden="true"></i> &nbsp; &nbsp; Add to Cart
                  </button>
                
                <?php }
                  }else{?>
                    <input type="hidden" name="shipping_aplied_<?=$min_new_price[0]['id']?>" id="shipping_aplied_<?=$min_new_price[0]['id']?>" value="standard-<?php echo $standard_shipping;?>" />
                      <span style="color:#000;font-size:18px;">
                      +
                      </span>
                      <span style="color:#000;font-size:18px;">$<?php 
                  
                    if($standard_shipping) echo $standard_shipping; else echo '0';?> Shipping </span>
              </p>
              <button class="btn btn-primary add-to-cart-btn pull-right" id="<?=$min_new_price[0]['id']?>" style="font-size:18px;">
                <i class="fa fa-cart-plus" aria-hidden="true"></i> &nbsp; &nbsp; Add to Cart
              </button>
                <?php } ?>
            </p>                         
        </div>
                                   
      </div>
      <div role="tabpanel" class="tab-pane" id="home">
     <div class="detail-page-add-cart">
        <p style="font-size:23px;  font-family:Open Sans; display:block; line-height:20px; color:#bb9870 !important; font-weight:bold; float:left;">
              $<?php if($min_used_price[0]['price'])echo $min_used_price[0]['price'];else echo'0';                 
                if($upper_min_used_seller_shippings[0]['expedited'] == 'active' || $upper_min_used_seller_shippings[0]['second_day'] == 'active' || 
                  $upper_min_used_seller_shippings[0]['next_day'] == 'active'){?>
                <span style="color:#000;"> + </span><span style="color:#000; font-size:25px !important;"> Shipping</span>
        </p>  
        <br>

          <p style="font-size:14px; color:#CCC; display:block; margin-top:8px; clear:both; width:100%;">
             <div>
                <select  name="shipping_aplied" id="shipping_aplied_<?=$min_used_price[0]['id']?>" class="form-control" style="color:#000; font-weight:bold; font-size:20px; width:45%;padding:5px 10px; float:left;">
                  <option value="standard-<?php echo $standard_shipping;?>" selected>$<?php if($standard_shipping) echo $standard_shipping; else echo '0';?> Standard </option>
                    <?php if($upper_min_used_seller_shippings[0]['expedited'] == 'active'){ ?>
                  <option value="expedited_shipping-<?php echo $expedited_shipping;?>">$<?php if($expedited_shipping) echo $expedited_shipping; else echo '0';?> Expedited </option>
                    <?php } ?>
                    <?php if($upper_min_used_seller_shippings[0]['second_day'] == 'active'){ ?>
                  <option value="second_day-<?php echo $second_day;?>">$<?php if($second_day) echo $second_day; else echo '0';?> Second day </option>
                    <?php } ?>
                  
                    <?php if($upper_min_used_seller_shippings[0]['next_day'] == 'active'){ ?>
            
                  <option value="next_day-<?php echo $next_day;?>">$<?php if($next_day) echo $next_day; else echo '0';?> Next day</option>
                    <?php } ?>
                          
                          
                </select>
              </div> 
                <?php if($min_used_price[0]['price']>0){ ?>
                <button class="btn btn-primary add-to-cart-btn pull-right" id="<?=$min_used_price[0]['id']?>" style="font-size:18px;">
                    <i class="fas fa-cart-plus" aria-hidden="true"></i> &nbsp; &nbsp; Add to Cart
                </button>
              <?php }  
             }else{ ?>
                <input type="hidden" class="pull-right" name="shipping_aplied_<?=$min_used_price[0]['id']?>" id="shipping_aplied_<?=$min_used_price[0]['id']?>" value="standard-<?php echo $standard_shipping;?>" />
                                   

                <span style="color:#000;font-size:18px;">+</span>
                                   <span style="color:#000;font-size:18px;">$<?php 
                                    if($standard_shipping) echo $standard_shipping; else echo '0';?> Shipping </span>
          </p>
          <button class="btn btn-primary add-to-cart-btn pull-right" id="<?=$min_used_price[0]['id']?>" style="font-size:18px;">
            <i class="fas fa-cart-plus" aria-hidden="true"></i> &nbsp; &nbsp; Add to Cart
          </button><?php } ?>
                      </p>
    
  
  
                         
      </div>                   
    </div>
      <?php }elseif($min_used_price[0]['price'] != 0 ){ ?>

    <div role="tabpanel" class="tab-pane active" id="home">
     <div class="detail-page-add-cart">
				<p style="font-size:23px;  font-family:Open Sans; display:block; line-height:20px; color:#bb9870 !important; font-weight:bold; float:left;">
						  $<?php if($min_used_price[0]['price'])echo $min_used_price[0]['price'];else echo'0';                 
                if($upper_min_used_seller_shippings[0]['expedited'] == 'active' || $upper_min_used_seller_shippings[0]['second_day'] == 'active' || 
				          $upper_min_used_seller_shippings[0]['next_day'] == 'active'){?>
                <span style="color:#000;"> + </span><span style="color:#000; font-size:25px !important;"> Shipping</span>
        </p>  
        <br>

          <p style="font-size:14px; color:#CCC; display:block; margin-top:8px; clear:both; width:100%;">
             <div>
                <select  name="shipping_aplied" id="shipping_aplied_<?=$min_used_price[0]['id']?>" class="form-control" style="color:#000; font-weight:bold; font-size:20px; width:45%;padding:5px 10px; float:left;">
                  <option value="standard-<?php echo $standard_shipping;?>" selected>$<?php if($standard_shipping) echo $standard_shipping; else echo '0';?> Standard </option>
                    <?php if($upper_min_used_seller_shippings[0]['expedited'] == 'active'){ ?>
                  <option value="expedited_shipping-<?php echo $expedited_shipping;?>">$<?php if($expedited_shipping) echo $expedited_shipping; else echo '0';?> Expedited </option>
                    <?php } ?>
                    <?php if($upper_min_used_seller_shippings[0]['second_day'] == 'active'){ ?>
                  <option value="second_day-<?php echo $second_day;?>">$<?php if($second_day) echo $second_day; else echo '0';?> Second day </option>
                    <?php } ?>
                  
                    <?php if($upper_min_used_seller_shippings[0]['next_day'] == 'active'){ ?>
            
                  <option value="next_day-<?php echo $next_day;?>">$<?php if($next_day) echo $next_day; else echo '0';?> Next day</option>
                    <?php } ?>
                          
                          
                </select>
              </div> 
                <?php if($min_used_price[0]['price']>0){ ?>
                <button class="btn btn-primary add-to-cart-btn pull-right" id="<?=$min_used_price[0]['id']?>" style="font-size:18px;">
                    <i class="fas fa-cart-plus" aria-hidden="true"></i> &nbsp; &nbsp; Add to Cart
                </button>
              <?php }  
             }else{ ?>
                <input type="hidden" class="pull-right" name="shipping_aplied_<?=$min_used_price[0]['id']?>" id="shipping_aplied_<?=$min_used_price[0]['id']?>" value="standard-<?php echo $standard_shipping;?>" />
                                   

                <span style="color:#000;font-size:18px;">+</span>
                                   <span style="color:#000;font-size:18px;">$<?php 
                                    if($standard_shipping) echo $standard_shipping; else echo '0';?> Shipping </span>
          </p>
				  <button class="btn btn-primary add-to-cart-btn pull-right" id="<?=$min_used_price[0]['id']?>" style="font-size:18px;">
            <i class="fas fa-cart-plus" aria-hidden="true"></i> &nbsp; &nbsp; Add to Cart
          </button><?php } ?>
                      </p>
    
	
	
                         
      </div>                   
    </div>
  <?php }elseif($min_new_price[0]['price'] != 0){ ?>
          <div role="tabpanel" class="tab-pane active" id="profile">
        <div class="detail-page-add-cart">
            <p style="font-size:23px;  font-family:Open Sans; display:block; line-height:20px; color:#bb9870 !important; font-weight:bold; float:left;">$
              <?php if($min_new_price[0]['price']) echo $min_new_price[0]['price']; else echo '0';                    
                  if($upper_min_used_seller_shippings[0]['expedited'] == 'active' || $upper_min_used_seller_shippings[0]['second_day'] == 'active' || 
          $upper_min_used_seller_shippings[0]['next_day'] == 'active'){ ?>
              <span style="color:#000;"> + </span><span style="color:#000; font-size:25px;"> Shipping</span>
            </p> 
            <br>

            <p style="font-size:14px; color:#CCC; display:block; margin-top:8px; clear:both; width:100%;">

              <select  name="shipping_aplied" id="shipping_aplied_<?=$min_new_price[0]['id']?>" class="form-control" style="color:#000; width:45%;padding:5px 10px; float:left; font-weight:bold; font-size:20px;">
                  <option value="standard-<?php echo $standard_shipping;?>" selected>$<?php if($standard_shipping) echo $standard_shipping; else echo '0';?> Standard </option>
              <?php if($upper_min_new_seller_shippings[0]['expedited'] == 'active'){ ?>
                <option value="expedited_shipping-<?php echo $expedited_shipping;?>">$<?php if($expedited_shipping) echo $expedited_shipping; else echo '0';?> Expedited </option>
                  <?php } ?>
              <?php if($upper_min_new_seller_shippings[0]['second_day'] == 'active'){ ?>
                <option value="second_day-<?php echo $second_day;?>">$<?php if($second_day) echo $second_day; else echo '0';?> Second day </option>
                  <?php } ?>
                  
              <?php if($upper_min_new_seller_shippings[0]['next_day'] == 'active'){ ?>
            
                <option value="next_day-<?php echo $next_day;?>">$<?php if($next_day) echo $next_day; else echo '0';?> Next day</option>
                  <?php } ?>
                  
                  
              </select>
                <?php if($min_new_price[0]['price']>0){ ?>
                  <button class="btn btn-primary add-to-cart-btn pull-right" id="<?=$min_used_price[0]['id']?>" style="font-size:18px;">
                      <i class="fa fa-cart-plus" aria-hidden="true"></i> &nbsp; &nbsp; Add to Cart
                  </button>
                
                <?php }
                  }else{?>
                    <input type="hidden" name="shipping_aplied_<?=$min_new_price[0]['id']?>" id="shipping_aplied_<?=$min_new_price[0]['id']?>" value="standard-<?php echo $standard_shipping;?>" />
                      <span style="color:#000;font-size:18px;">
                      +
                      </span>
                      <span style="color:#000;font-size:18px;">$<?php 
                  
                    if($standard_shipping) echo $standard_shipping; else echo '0';?> Shipping </span>
              </p>
              <button class="btn btn-primary add-to-cart-btn pull-right" id="<?=$min_new_price[0]['id']?>" style="font-size:18px;">
                <i class="fa fa-cart-plus" aria-hidden="true"></i> &nbsp; &nbsp; Add to Cart
              </button>
                <?php } ?>
            </p>                         
        </div>
                                   
      </div>

      
        <?php } ?>
  </div>
                     </div>

                 </div>
                 </div>
                
              
                
            </div>
            
            
            </div>
            
            
            
            
            <div class="row">
            <div class="col-lg-2 col-md-3 col-sm-12 col-xs-12">
                            <div class="row">

                                <?php $this->load->view('frontend/includes/product_sidebar'); ?>

                            </div>
                        </div>
          
            
           
            

            <div class="col-xs-12 col-sm-12 col-md-9 col-lg-10">
<div class="well-overflow">
                <div class="well sub-overflow">
                    
                    
                    <div id="myTabContent" class="tab-content">
                        <div class="tab-pane active in" id="home">

                          
                            
                          
                                  
                                  <div class="col-xs-12 col-sm-12 form-group">
                                <div class="row">
								<div class="table-responsive">
                            <table width="100%"  class="PDP_itemList table  table-hover" cellspacing="10" cellpadding="10">
                                <tbody><tr bgcolor="#ff5b53" style="color:blue !important; background:#fff !important;">
                                        <th class="PDP_col_price" width="10%">Quantity</th>
                                        
                                        <th class="PDP_col_deliveredBy" width="20%">Type</th>
                                        <th class="PDP_col_deliveredBy" width="15%">Condition</th>
                                        <th class="PDP_col_sellerName" width="20%">Seller Details</th>
                                        <th class="PDP_col_comments" width="20%">Rating</th>
                                        <th class="PDP_col_comments" width="15%">Price & Shipping</th>
                                    </tr>
                                <?php 
                   $rating_array = array();
                  if($this->input->get('srating'))
                      $rating_array = explode(',', $this->input->get('srating'));
                
                $where['product_id'] = $sellerProductData['product_id'];
                $where['pause_listing'] = 'no';
                /*if($this->input->get('condition')!='')
                $where['book_condition'] = $this->input->get('condition');*/
                if($this->input->get('country')!='')
                $where['country'] = $this->input->get('country');
               
                $book_condition = false;
                if($this->input->get('condition')!=''){
                  $book_condition = explode(',', $this->input->get('condition'));
                }
                $book_type = false;
                if($this->input->get('type')!=''){
                  $book_type = explode(',', $this->input->get('type'));
                }
                                
								
                $other_sellers = $this->comman_model->get_sellers("seller_products",$where,$book_type,$book_condition,'*',array('price'=>'ASC'));
                if($other_sellers){
					
                  
                  
                  //echo '<pre>';print_r($sellerProductData);exit;
                  foreach($other_sellers as $row){
                  $seller_details = $this->comman_model->get("user",array("user_id"=>$row['user_id']));
				  $seller_shippings = $this->comman_model->get('seller_shippings',array("seller_id"=>$row['user_id'])); 
                /*echo "<pre>";
                print_r($seller_details);
                die;*/
                  $ratings = getRating($row['user_id'],$rating_array);
                  if(!$ratings)
                    continue;
                  ?>
                                <tr class="tr-border" bg-color="#FFFFFF">
                                  <td nowrap>
                                    <!-- <span class="PDP_itemPrice" style="font-weight:bold;">InStock:</span> -->
                                    <span style="font-size:16px;color: #323232; font-family:Open Sans;"><?php echo $row["quantity"];?></span>
                                  </td>
                                    <td style=" color:#000 !important; font-weight:bold;"><?php echo $row["book_type"];?></td>
                                    <td style="color:#000 !important; font-weight:bold;"><?php echo $row["book_condition"];?></td>
                                    <td style="color:#000 !important;">
                                    <!-- <strong>Seller:</strong> -->
                                     <span style="font-size:16px;  font-family:Open Sans;color: #bb9870; !important; font-weight:bold;"> <?php echo $seller_details[0]['username'];?></span>
                                    <br>

                                     <!-- <strong style="color:#000 !important;">Country :</strong> -->

									                   <span style="font-size:16px;  font-family:Open Sans;#bb9870!important; font-weight:500;"><?php echo $seller_details[0]['city'].','.$seller_details[0]['state'].','.$seller_details[0]['country'];?></span>
                                    
                                     <br>
                                        
                                        
                                     <label style=" color:#000 !important;">Comments:</label><p style="display:inline;color:#000 !important;"> <?php echo $row['comments'];?> </p>
                                    
                                    </td>
                                    <td>
                                        <a href="<?php echo base_url("ratings_and_feedbacks")?>/<?php echo $seller_details[0]['user_id'];?>">
                                        <div class="rateit bigstars"
                                            data-rateit-value="<?php echo $ratings['total_rating']; ?>" 
                                            data-rateit-step="1" 
                                            data-rateit-resetable="false"
                                            data-rateit-readonly="true" 
                                            data-rateit-starwidth="32" 
                                            data-rateit-starheight="32">
                                        </div>
                                        <!-- <?php echo $ratings['total_rating']; ?> -->
                                        </a>
                                        
                                        
                                        <div><strong style=" color:#000;">Feedback:</strong> <span id="total_votes"><?php echo $ratings['total_votes']; ?></span></div>
                                    </td>        
                                    <td>
                                      <?php if($row["price"]>0){ ?>
                                      <button class="btn btn-primary add-to-cart-btn" id="<?=$row['id']?>" ><i class="fa fa-cart-plus" aria-hidden="true"></i> &nbsp; &nbsp;  Add to Cart</button>
                                      <?php } ?>  
                                     <br>
                                     
                                     
                  <p class="finalprice pull-left" style="margin-right:5px;color: #000 !important; font-size:23px;"> $<?php echo $row["price"];?></p>
                  <p class="finalpricetshp" style="    color: #323232; !important; margin-top:10px; font-size:18px">+ 
                                    
                                    <?php 
                  
                   
                   
                   
                if($seller_shippings[0]['expedited'] == 'active' || $seller_shippings[0]['second_day'] == 'active' || 
				$seller_shippings[0]['next_day'] == 'active'){
                
                
              ?>
                Shipping
                            <select  name="shipping_aplied" id="shipping_aplied_<?=$row['id']?>" class="form-control" style="color:#000">
                                <option value="standard-<?php echo $standard_shipping;?>" selected>$<?php if($standard_shipping) echo $standard_shipping; else echo '0';?> Standard </option>
                            <?php if($seller_shippings[0]['expedited'] == 'active'){ ?>
                              <option value="expedited_shipping-<?php echo $expedited_shipping;?>">$<?php if($expedited_shipping) echo $expedited_shipping; else echo '0';?> Expedited </option>
                                <?php } ?>
                            <?php if($seller_shippings[0]['second_day'] == 'active'){ ?>
                              <option value="second_day-<?php echo $second_day;?>">$<?php if($second_day) echo $second_day; else echo '0';?> Second day </option>
                                <?php } ?>
                                
                            <?php if($seller_shippings[0]['next_day'] == 'active'){ ?>
                          
                              <option value="next_day-<?php echo $next_day;?>">$<?php if($next_day) echo $next_day; else echo '0';?> Next day</option>
                                <?php } ?>
                                
                                
                            </select>
              
              <?php
  
             }else{
   
   ?>
   <input type="hidden" name="shipping_aplied_<?=$row['id']?>" id="shipping_aplied_<?=$row['id']?>" value="standard-<?php echo $standard_shipping;?>" />
                                   $<?php 
                  
   
   
                  
                  if($standard_shipping) echo $standard_shipping; else echo '0';?> Shipping </p>
                                    <?php } ?>
                                    
                                    </td>
                                </tr>
                <?php }}?>
                                </tbody></table>
                            </div></div>
                            </div>
                            
                        </div>
                        
                    </div>

                    <div class="clear" style="clear:both; height: 10px;"></div>

                </div>
              </div>

            </div>
            </div>    
        </div>
        <?php //echo '<pre>';print_r($this->session->userdata('cartData'));?>
<script type="text/javascript">
$(document).ready(function () {

    $('.add-to-cart-btn').click(function(){
   
  var id = this.id;
  var shipping = $("#shipping_aplied_"+id).val();
  //alert(shipping);return false;
  
        jQuery.ajax({
            type: "POST",
            url: '<?php echo base_url('cart/add-to-cart'); ?>',
            data: {'id': id,'shipping':shipping},
            dataType: 'json',
            error: function (request, error) {
                alert('There is an error.Try Again');
                //jQuery('#eventError').html('There is an error.Try Again').show();
              },
            success: function (response) {
        //alert(response);return false;
		
		
		
        if (response.success) {
                    $('#totalCartItems').html('('+response.totalCartItems+')');
          
          $('#totalCartValue').html('('+response.total+')');
          $('#total').html('('+response.total+')');
                    $('#totalitems').html(response.totalCartItems+' item in cart.');
                    $('#cartModal').modal('show');
                } else if(response.ownproduct){
			alert("Sorry! you can not buy your own book.");return false;
			}else{
                    alert('There is an error.Try Again');
                }
            }
        });//End ajax
    })
});


function filter_condition(obj) {
        var checkbox = $(obj).find('.f_condition');
        if($(checkbox).is(':checked')){

          $(checkbox).prop('checked', false);
        }else{
          $(checkbox).prop('checked', true);
        }
        //alert(obj.id);
        condition_value = $('.f_condition').map(
        function(){
            if($(this).is(':checked')){

                return $(this).val();
            }  
          }
        ).get().join(',');
		
		//alert(condition_value);
    if ($("#"+obj.id).is(':checked')) {

    }else{
        //alert("not checekd");
        if(obj.id=='Used'){
           var condition_value =  condition_value.replace('Like New,Very Good,Good,Acceptable','');
        }
    }
    //alert(condition_value);
        if(condition_value == 'Used'){
			condition_value = "Used,Like New,Very Good,Good,Acceptable";
			}
		$('#condition').val(condition_value);
		//alert($('#condition').val());
        $("#detail_filter").submit();
    }
    function filter_type(obj) {
      var checkbox = $(obj).find('.f_type');
      if($(checkbox).is(':checked')){
        $(checkbox).prop('checked', false);
      }else{
        $(checkbox).prop('checked', true);
      }
      
      type_value = $('.f_type').map(
        function(){
          if($(this).is(':checked')){
            return $(this).val();
          }  
        }
      ).get().join(',');
      $('#type').val(type_value);
      $("#detail_filter").submit();
    }

    function filter_country(country_value) {
        $('#country').val(country_value);
        $("#detail_filter").submit();
    }
    function filter_rating(obj) {
      var checkbox = $(obj).find('.f_rating');
      if($(checkbox).is(':checked')){
        $(checkbox).prop('checked', false);
      }else{
        $(checkbox).prop('checked', true);
      }
      rating_value = $('.f_rating').map(
        function(){
            if($(this).is(':checked')){
              return $(this).val();
            }  
          }
        ).get().join(',');
        $('#srating').val(rating_value);
        $("#detail_filter").submit();
    }
</script>