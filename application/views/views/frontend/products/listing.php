<?php /*echo "<pre>";
    print_r($price_range);
    die;*/

 ?>


<style>
    a.btn.btn-cart.pull-right {
    background: #bb9870;
    color: #fff;
    border-radius: 0px;
    transition:.3s;
}
 a.btn.btn-cart.pull-right:hover {
       background: #323232;
}
.align-options {
    display: flex;
    justify-content: center;
    align-items: flex-start;
    flex-direction: column;
}
      /* <======== Right-box ========> */
      .right {
        width: 149px;
        float: right;
        font-size: 11px;
    
      }
      .right .callout {
        margin-top: 0px;
        text-align: center;
        padding: 0px;
        font-size: 14px;
        border: 1px solid #bb9870;
      }
      .right .callout h5 {
        margin: 0px;
        color: #fff;
        font-weight: normal;
        background-color: #bb9870;
        font-size: 18px;
        padding: 4px;
        margin-bottom: 5px;
      }
      .right .callout-inner {
        line-height: 1.5;
      }
      .right .callout-inner .price {
        font-size: 24px;

      }
      span.price {
        font-weight: bold;
        font-family: arial, helvetica;
        color: black;
      }
      .right .callout-inner p {
        line-height: 1.5;
        text-transform: capitalize;
        font-family: arial, helvetica;
        font-size: 16px;
      }
      .right .callout-inner a {
        display:none;
        color: #bb9870;
        font-family: arial, helvetica;
        font-size: 12px;
        text-transform: capitalize;
      }
      .right .callout.corner4 button {
        margin-left: 0px;
      }
      .right .callout button {
        font-family: "Libre Baskerville" !important;
        padding: 4px 15px;
        margin: 8px 0px 8px 0;
        font-size: 16px;
        max-width: 158px;
        color: #fff;
        border-radius: 0px;
      }
      .right .callout button {
        background:#bb9870 ;
        transition:all .3s;
      }
      .right .callout button:hover {
        background:#323232 ;
      }
      .ship-flag {
        margin: 5px 0px !important;
        height: 28px;
      }
      li .right {
        width: 145px;
        float: right;
        font-size: 11px;
        margin-right: 4px;
      }
      /* <========End: Right-box ========> */

    
</style>
<div class="col-xs-12">
    <div class="container product-listing-cont">
        <div class="row no-padding product_responsive">
            <?php if ($this->input->get('cat')) {
                getCategoriesNavigation(($this->input->get('cat') / 999));
            } ?>

            <div class="col-sm-12 col-xs-12">
                <form action="<?php echo base_url('products'); ?>" method="get" id="frm_filter">
                    <input type="hidden" id="listing" name="listing" value="yes"/>
                    <input type="hidden" id="condition" name="condition"
                           value="<?php echo ($this->input->get('condition')) ? $this->input->get('condition') : ''; ?>"/>
                    <input type="hidden" name="cat" id="cat_id"
                           value="<?php echo ($this->input->get('cat')) ? $this->input->get('cat') : ''; ?>"/>
                    <input type="hidden" name="type" id="type"
                           value="<?php echo ($this->input->get('type')) ? $this->input->get('type') : ''; ?>"/>

                    <div>
                        <div class="product-filter">

                            <div class="product-compare col-xs-3"><a id="compare-total" href="">Product Listing
                                    (<?php echo $total_products; ?>)</a></div>
                            <div class="col-xs-12 col-lg-9 pull-right no-padding product_mobile">

                                <div class="limit" title="Show"><?php echo getlanguage('show'); ?>:
                                    <select onchange="$('#frm_filter').submit();" name="count">
                                        <option selected="selected" value="15" selected="selected">15</option>
                                        <option value="25" <?php if ($this->input->get('count') == '25') echo 'selected="selected"'; ?>> 25  </option>
                                        <option value="50" <?php if ($this->input->get('count') == '50') echo 'selected="selected"'; ?>>50 </option>
                                        <option value="75" <?php if ($this->input->get('count') == '75') echo 'selected="selected"'; ?>>75</option>
                                        <option value="100"<?php if ($this->input->get('count') == '100') echo 'selected="selected"'; ?>> 100 </option>
                                    </select>
                                </div>
                                <div class="sort pull-right margin-left-10"
                                     title="Sort By">Sort By:
                                    <select onchange="$('#frm_filter').submit();" name="sort_by">
                                        <option selected="selected" value="">Default</option>
                                        <option value="name" <?php if ($this->input->get('sort_by') == 'name') echo 'selected="selected"'; ?>> brand alphabetic (A - Z)</option>
                                        <option value="price_low" <?php if ($this->input->get('sort_by') == 'price_low') echo 'selected="selected"'; ?>>Price (Low &gt; High)</option>
                                        <option value="price_high" <?php if ($this->input->get('sort_by') == 'price_high') echo 'selected="selected"'; ?>>Price (High &gt; Low)</option>
                                        <option value="most_viewed" <?php if ($this->input->get('sort_by') == 'most_viewed') echo 'selected="selected"'; ?>> Most Viewed</option>

                                    </select>
                                </div>

                                <div class="input-group">
                                    <input type="text" name="title" class="form-control product-name-filter-input" placeholder="Search by title/isbn10/isbn13..." value="<?php echo ($this->input->get('title')) ? $this->input->get('title') : ''; ?>">
                                    <span class="input-group-btn btn_search" style="border-top-right-radius:5px; border-bottom-right-radius:5px; ">
                                        <button class="btn btn-info btn-sm btn-mini-custom" style="border-top-right-radius:5px; border-bottom-right-radius:5px; " type="submit">
                                            <i class="glyphicon glyphicon-search"></i>
                                        </button>
                                    </span>
                                </div>


                            </div>
                        </div>
                        
                </form>

              <!-- ----------- -->
                <!-- sidebar -->
              <!-- ----------- -->
                
                <div class="col-lg-2 col-md-3 col-sm-12 col-xs-12 ">
                            <div class="row">

    <style>
    .level-1 li > label {
        padding-left: 15px !important;
    }

    .level-1 li a {
        padding-left: 15px !important;
    }

    .level-2 li > label {
        padding-left: 25px !important;
    }

    .level-2 li a {
        padding-left: 25px !important;
    }

    .level-3 li > label {
        padding-left: 35px !important;
    }

    .level-3 li a {
        padding-left: 35px !important;
    }

    .level-4 li > label {
        padding-left: 45px !important;
    }

    .level-4 li a {
        padding-left: 45px !important;
    }

    .fa-circle::before {
        content: "";
        font-size: 8px;
    }

    .cat_active {
        font-weight: 700;
        font-style: italic;
        /*font-size: 15px;*/
		margin-right:5px !important;
    }
    .f_condition
	{
		margin-right:5px !important;
	}
	.rateit-range-2
	{
		margin-left:5px !important;
	}

    .cd-accordion-menu-cont .section-title {
    font-family: "Libre Baskerville" !important;
    background: #fff !important;
    color: #000;
    margin-top: 2px;
    padding: 10px 0;
    margin: 0 0 13px;
    font-size: 20px;
    /* padding-top: 6px !important; */
    /* border-top: 1px solid #666 !important; */

}
.cd-accordion-menu-cont ul {
    list-style: none;
    padding: 0;
        display: block;

}
.cd-accordion-menu-cont .section-title {
    background: #fff !important;
    color: #000;
    margin-top: 2px;
    padding-top: 6px !important;
}
.mCSB_container {
    overflow: hidden;
    width: auto;
    height: auto;
}
.mCSB_container.mCS_no_scrollbar_y.mCS_y_hidden {
    margin-right: 0;
}
.mCSB_scrollTools .mCSB_draggerContainer {
    position: absolute;
    top: 0;
    left: 0;
    bottom: 0;
    right: 0;
    height: auto;
    display:none;
}

.innoCustomScrollBar {
    background-color: #fff;
}

.mCSB_scrollTools .mCSB_draggerRail {
    width: 0px;
    height:0%;
    margin: 0 auto;
    -webkit-border-radius: 16px;
    -moz-border-radius: 16px;
    border-radius: 16px;
}
ul.level-2 {
    margin: 0px 20px;
}
 .cd-accordion-menu label, .cd-accordion-menu a {
    padding: 4% 15% 4% 0% !important;
    font-size: 1.5rem;
}
.cd-accordion-menu label::before, .cd-accordion-menu label::after {
    background-image: none;
    background-repeat: no-repeat;
}
.col-lg-2.col-md-3.col-sm-12.col-xs-12 {
    margin-top: 15px;
    margin-right:15px;
}
.cd-accordion-menu label {
    padding-left: 0px !important;
    left: 0px !important;
}

/* star rating */

/* span#rateit-range-11 {
    width: 0px !important;
}
span.rateit-selected {
    width: 0px !important;
} */

li.has-children {
    border: 2px solid #e6e6e6;
    font-size: 15px;
    margin-bottom: 40px;
    background: #fff;
    padding: 10px 25px 15px;
}
#mCSB_2_container li{
    padding:3px 0px;
}
#mCSB_2_container li span{
font-family: Helvetica !important;
}

#mCSB_1_container li span{
font-family: Helvetica !important;  
}
.cd-accordion-menu-cont .section-title::before{
    content: "";
    width: 50px;
    height: 3px;
    top:39px;
    left: 0px;
    background: #000;
    bottom: -1px;
    position: absolute;
}

.section-title li span{
    font-family:"roboto" !important;
}



</style>
<!-- search sidebar start here -->
<div class="cd-accordion-menu-cont">
    <ul class="cd-accordion-menu animated">
        <li class="has-children">
            <?php
        
           $condition_array = array();
           if($this->input->get('condition'))
                $condition_array = explode(',', $this->input->get('condition'));
        ?>
                    <input type="checkbox" class="menu-label" checked="checked" id="brands">
                    <label class="section-title">Condition</label>
            
                <ul class="scroll innoCustomScrollBar mCustomScrollbar _mCS_1 mCS_no_scrollbar"><div id="mCSB_1" class="mCustomScrollBox mCS-inset-dark mCSB_vertical mCSB_inside" style="max-height: none;" tabindex="0"><div id="mCSB_1_container" class="mCSB_container mCS_y_hidden mCS_no_scrollbar_y" style="position:relative; top:0; left:0;" dir="ltr">
                    <li >
                        <span>
                            <input onclick="filter_condition(this)" type="checkbox" class="f_condition" value="New" id="New" type="checkbox" <?php echo (in_array('New', $condition_array))? 'checked="checked"' : ''; ?> />
                            <span <?php echo (in_array('New', $condition_array)) ? 'class="cat_active"' : ''; ?>>New
                            </span>
                        </span>
                    </li>
                    <li>
                        <span >
                            <input onclick="filter_condition(this)" class="f_condition" type="checkbox" <?php echo (in_array('Used', $condition_array))? 'checked="checked"' : ''; ?> id="Used" value="Used"><span <?php echo (in_array('Used', $condition_array)) ? 'class="cat_active"' : ''; ?> style="padding-left:3px;">Used</span>
                        </span>
                        <ul class="level-2" style="display:block;">
                            <li>
                                <span  >
                                    <input type="checkbox" onclick="filter_condition(this)" class="f_condition"  id="Like New" value="Like New" type="checkbox" <?php echo (in_array('Like New', $condition_array))? 'checked="checked"' : ''; ?> /><span <?php echo (in_array('Like New', $condition_array)) ? 'class="cat_active"' : ''; ?>>Like New</span> 
                                </span>
                            </li>
                            <li>
                                <span >
                                    <input onclick="filter_condition(this)" type="checkbox" class="f_condition" id="Very Good" value="Very Good" type="checkbox" <?php echo (in_array('Very Good', $condition_array))? 'checked="checked"' : ''; ?> /><span <?php echo (in_array('Very Good', $condition_array)) ? 'class="cat_active"' : ''; ?>>Very Good</span> 
                                </span>
                            </li>
                            <li>
                                <span >
                                    <input type="checkbox" onclick="filter_condition(this)" class="f_condition" id="Good"   value="Good" type="checkbox" <?php echo (in_array('Good', $condition_array))? 'checked="checked"' : ''; ?> /><span <?php echo (in_array('Good', $condition_array)) ? 'class="cat_active"' : ''; ?>>Good</span> 
                                </span>
                            </li>
                            <li>
                                <span  >
                                    <input onclick="filter_condition(this)" type="checkbox" class="f_condition" value="Acceptable"  id="Acceptable" <?php echo (in_array('Acceptable', $condition_array))? 'checked="checked"' : ''; ?> /><span <?php echo (in_array('Acceptable', $condition_array)) ? 'class="cat_active"' : ''; ?>>Acceptable</span> 
                                </span>
                            </li>
                        </ul>
                    </li>


                    
                </div><div id="mCSB_1_scrollbar_vertical" class="mCSB_scrollTools mCSB_1_scrollbar mCS-inset-dark mCSB_scrollTools_vertical" style="display: none;"><div class="mCSB_draggerContainer"><div id="mCSB_1_dragger_vertical" class="mCSB_dragger" style="position: absolute; min-height: 30px; height: 0px; top: 0px;" oncontextmenu="return false;"><div class="mCSB_dragger_bar" style="line-height: 30px;"></div></div><div class="mCSB_draggerRail"></div></div></div></div></ul>
            
        </li><!--CONDITION END-->

         <li class="has-children">
             <?php
                    $type_array = array();
                    if($this->input->get('type'))
                        $type_array = explode(',', $this->input->get('type'));
                ?>
                        <input class="menu-label" type="checkbox" checked="checked" id="f-type">
                    <label class="section-title">Type</label>
                <ul class="scroll innoCustomScrollBar mCustomScrollbar _mCS_2 mCS_no_scrollbar"><div id="mCSB_2" class="mCustomScrollBox mCS-inset-dark mCSB_vertical mCSB_inside" style="max-height: none;" tabindex="0"><div id="mCSB_2_container" class="mCSB_container mCS_y_hidden mCS_no_scrollbar_y" style="position:relative; top:0; left:0;" dir="ltr">
                     <li>
                        <span>
                            <input onclick="filter_type(this)" class="f_type" value="Normal" type="checkbox" <?php echo (in_array('Normal', $type_array)) ? 'checked="chacked"' : ''; ?>><span <?php echo (in_array('Normal', $type_array)) ? 'class="cat_active"' : ''; ?>> Normal 
                        </span>
                    </li>
                    <li>
                        <span >
                            <input onclick="filter_type(this)" class="f_type" value="International Edition" type="checkbox" <?php echo (in_array('International Edition', $type_array)) ? 'checked="chacked"' : ''; ?>>
                            <span <?php echo (in_array('International Edition', $type_array)) ? 'class="cat_active"' : ''; ?>> International Edition</span> 
                        </span>
                    </li>
                    <li>
                        <span >
                            <input  onclick="filter_type(this)" class="f_type" value="Teachers Edition" type="checkbox" <?php echo (in_array('Teachers Edition', $type_array)) ? 'checked="checked"' : ''; ?>><span <?php echo (in_array('Teachers Edition', $type_array)) ? 'class="cat_active"' : ''; ?>> Teachers Edition</span> 
                        </span>
                    </li>
                    <li>
                        <span  >
                            <input onclick="filter_type(this)" class="f_type" value="Study Guide" type="checkbox" <?php echo (in_array('Study Guide', $type_array)) ? 'checked="chacked"' : ''; ?>><span <?php echo (in_array('Study Guide', $type_array)) ? 'class="cat_active"' : ''; ?>> Study Guide</span> 
                        </span>
                    </li>
                    <li>
                        <span  >
                            <input onclick="filter_type(this)" class="f_type" value="Work Book" type="checkbox" <?php echo (in_array('Work Book', $type_array)) ? 'checked="chacked"' : ''; ?>><span <?php echo (in_array('Work Book', $type_array)) ? 'class="cat_active"' : ''; ?>> Work Book </span>
                        </span>
                        </li>
                    <li>
                        <span >
                            <input onclick="filter_type(this)" class="f_type" value="Library Copy" type="checkbox" <?php echo (in_array('Library Copy', $type_array)) ? 'checked="chacked"' : ''; ?>><span <?php echo (in_array('Library Copy', $type_array)) ? 'class="cat_active"' : ''; ?>> Library Copy</span> 
                        </span>
                    </li>        
                </div><div id="mCSB_2_scrollbar_vertical" class="mCSB_scrollTools mCSB_2_scrollbar mCS-inset-dark mCSB_scrollTools_vertical" style="display: none;"><div class="mCSB_draggerContainer"><div id="mCSB_2_dragger_vertical" class="mCSB_dragger" style="position: absolute; min-height: 30px; height: 0px; top: 0px;" oncontextmenu="return false;"><div class="mCSB_dragger_bar" style="line-height: 30px;"></div></div><div class="mCSB_draggerRail"></div></div></div></div></ul>
            
        </li><!--TYPE END-->
            

                    <!-- <li class="has-children">
            <input class="menu-label" type="checkbox" checked="checked" id="f-country">
                <label class="section-title">Country</label>
                 
                <select onchange="filter_country(this.value)" class="country form-control" style="font-weight:bold; margin-top:10px;">
                    <option value="">Select Country</option>
                    <option value="United States">United States</option></select>
            
            </li> -->   <!-- Country END --> 

               <!--  <li class="has-children">
                     <?php
                        $rating_array = array();
                        if($this->input->get('srating'))
                        $rating_array = explode(',', $this->input->get('srating'));
                    ?>
                        <input type="checkbox" class="menu-label" checked="checked" id="f-rating">
                <label class="section-title" style="border-bottom:solid 1px #666; margin-bottom:20px; padding-bottom:6px;">Rating</label>
            
                <ul class="scroll innoCustomScrollBar">
                    <li><span  > <input onclick="filter_rating(this)" class="f_rating" value="1" type="checkbox" <?php echo (in_array(1, $rating_array)) ? 'checked="chacked"' : ''; ?>><span class="rateit_filter" data-rateit-value="1"></span> </span></li>
                    <li><span > <input onclick="filter_rating(this)" class="f_rating" value="2" type="checkbox" <?php echo (in_array(2, $rating_array)) ? 'checked="chacked"' : ''; ?>><span class="rateit_filter" data-rateit-value="2"></span> </span></li>
                    <li><span > <input onclick="filter_rating(this)" class="f_rating" value="3" type="checkbox" <?php echo (in_array(3, $rating_array)) ? 'checked="chacked"' : ''; ?>><span class="rateit_filter" data-rateit-value="3"></span> </span></li>
                    <li><span > <input onclick="filter_rating(this)" class="f_rating" value="4" type="checkbox" <?php echo (in_array(4, $rating_array)) ? 'checked="chacked"' : ''; ?>><span class="rateit_filter" data-rateit-value="4"></span> </span></li>
                    <li><span > <input onclick="filter_rating(this)"    class="f_rating" value="5" type="checkbox" <?php echo (in_array(5, $rating_array)) ? 'checked="chacked"' : ''; ?>><span class="rateit_filter" data-rateit-value="5"></span> </span></li>     
                </ul>
            
        </li> --><!--Country END-->




       
    </ul>
    <div class="clearfix"></div>
</div>
<!--End search sidebar here -->

<script type="text/javascript" charset="utf-8">
    $(function () {
        $('.country').val('');
        $("#slider-3").slider({
            range: true,
            min: 0,
            max: 0,
            values: [, ],

            slide: function (event, ui) {
                $(".ui-slider").val(ui.values[0] + "," + ui.values[1]);
                $("#min_price").html("$" + ui.values[0]);
                $("#max_price").html("$" + ui.values[1]);

            },
            change: function (event, ui) {
                setTimeout(function () {
                    $("#frm_filter").submit();
                }, 1000);
            }
        });
        
        $( "#slider" ).slider({
            range: "max",
            min: 0,
            max: 70,
            value: 0,
            slide: function (event, ui) {
               //$( "#amount" ).val( ui.value );
            }
        });

        $('.rateit_filter').rateit({
            step: 1,
            readonly:true,
            resetable:false
        });
    });
</script>
                </div>
            </div>
                

            <!-- ----------- -->
                <!-- sidebar end  -->
                <!-- ---------------- -->



                <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12  no-padding" style="width:82.02%;">
                    <div class="prod-data-cont">
                
                        <?php
						

						if($isbn_products){
							$product = $isbn_products;
							print_r($product);exit;
							?>
							
							 <a target="_blank"
                                   href="<?php echo base_url('product/detail') . "/" . encode_url($product['product_id']); ?>">
                            <div class="product-col list clearfix col-sm-3 product_col_sepration">
                                <div class="image col-sm-12 image_product">
                                <img class="img-responsive" alt="product" src="<?php echo base_url().$product['image']; ?>">
                                
                                
                                </div>
                                <div class="clearfix"></div>
                                <div class="caption col-sm-12">
                                    <h4><?php echo $product['title']; ?></h4>

                                    <div class="price no-padding" style="margin:0; padding:0px;">
                                    
                                        <p class="price-tax" style="margin:0;"><span
                                                class="price">$<?php echo $product['sale_price'] ? $product['sale_price'] : $product['price']; ?></span>
                                        </p>
                                    </div>
                            <div class="price no-padding" style="margin:0; padding:0px;">
                            <a class="btn btn-cart" type="button" href="<?php echo base_url("product/detail");?>/<?php echo encode_url($product['product_id'])?>" title="View Detail">
                                 View Detail1
                                 
                             </a>
                             </div>
                             
                                </div>
                            </div>
                        </a>
							
							<?php
							
							}else{
						
						
                        if ($allProducts) {  ?>
                            <?php foreach ($allProducts as $product) { 
                                
							    $actual_product = $this->comman_model->get('products', array('product_id' => $product['product_id']));
                           
                                $actual_product = $actual_product[0];
							    $min_new_price = $this->product_model->min_product_price("seller_products",array("New"),array('product_id'=>$product['product_id'],'pause_listing'=>'no'));
							
							    $min_used_price = $this->product_model->min_product_price("seller_products",array("Like New","Very Good","Good","Acceptable"),array('product_id'=>$product['product_id'],'pause_listing'=>'no'));							
							    $total_sellers_for_new = $this->product_model->total_sellers_for_condition("seller_products",array("New"),array('product_id'=>$product['product_id'],'pause_listing'=>'no'));
                            
							    $total_sellers_for_used = $this->product_model->total_sellers_for_condition("seller_products",array("Like New","Very Good","Good","Acceptable"),array('product_id'=>$product['product_id'],'pause_listing'=>'no'));
							   // echo '<pre>';print_r($total_sellers_for_used);exit;                           
							?>


                            <div class="product-col list clearfix col-sm-12 no-padding" style="border-bottom:1px dotted #bb9870;padding-bottom:10px;">
                                <div class="image col-sm-2">
                                    <a href="<?php echo base_url('product/detail') . "/" . encode_url($product['product_id']); ?>">
                                    <img class="" style="width:125px; height:190px;" alt="product" src="<?php echo base_url().$actual_product['image'];?>">
                                </div>
                                </a>
                                <div class="col-xs-12 col-sm-6">
                    			<div>
                                <h4 style="margin-bottom:0px; margin-top:7px; font-size:21px;"><?php echo $product['title']?></h4>
                                <strong style="color:#000 ;font-size:18px;"> Author:</strong><span style="color: rgb(187, 152, 112) !important;font-size:18px;"><?php if(!empty($author)){ foreach ($author as $aut){
                                                          if($aut->id == $product["author"]){echo "<a href='products?search=$aut->author_name&cat=keyword'>".$aut->author_name."</a>";}}}?></span></span> <br>
                                <strong> ISBN-10:</strong><span><?php echo $product['isbn']?></span></span>
                                    <strong> ISBN-13:</strong><span><?php echo $product['isbn13']?></span></span> <br>
                                     <!--==== Deatail_btn==== -->

                                                <div class="cart-button button-group pull-right" style="width:100%; text-align:left"> 
                                
                                <!-- <div style="text-align: center; font-size: 20px;"><strong>Buying Options</strong></div> -->
                                <div class="clear10"></div>
                                <div class="align-options">

           <?php 
           
           if($min_new_price[0]['price'] || $min_used_price[0]['price']){
            ?>         
             <a class="btn btn-cart pull-right" style="font-family:Libre Baskerville !important;font-size:17px;" type="button" href="<?php echo base_url("product/detail");?>/<?php echo encode_url($product['product_id'])?>" title="View Detail" >
                 <b>View All</b>  from <b>$<?php if(min($min_used_price[0]['price'],$min_new_price[0]["price"])){
                        echo min($min_used_price[0]['price'],$min_new_price[0]["price"]);
                 }else{
                    echo max($min_used_price[0]['price'],$min_new_price[0]["price"]);
                 }?> </b> 
                </a>

           <?php 
           }
            ?>                         
              <p style="line-height:24px; margin-bottom:10px; clear:both;"></p>

            <div class="new_used_price" >
                <?php if($min_new_price[0]['price'] && $min_new_price[0]['price']>0) { ?>
                  <span  style="font-size:14px; margin-right:10px;">
                    <span style="font-size:18px;font-weight:600;color:#000;">
                    <?=$total_sellers_for_new?> New </span> from <span style="color:#bb9870;font-size:18px;">
        <strong>$<?php if($min_new_price[0]['price']) echo round($min_new_price[0]['price'],2); else echo '0'; ?></strong>
                </span> 
                </span>
               <?php } 
if($min_used_price[0]['price'] && $min_used_price[0]['price']>0) {
               ?>
                  <span  style="font-size:14px;"><span style="font-size:18px; font-weight:600;color: #000"><?=$total_sellers_for_used?> Used </span> from <span style="color:rgb(187, 152, 112) !important;font-size:18px;"><strong>$<?php if($min_used_price[0]['price']) echo round($min_used_price[0]['price'],2); else echo '0';?></strong></span></span>
              <?php } ?>
            
            </div>
 
              <?php /*?> <p style="line-height:31px; color:#999; display: inline;">Quantity</p>
               <input type="text" class="form-control" maxlength="5" size="3" name="new_qty" id="new_qty_1" value="1" style="width:68px; margin-bottom:16px; float:right;">
               <br><?php */?>
               
              
            </div>
            </div>




            <!-- <strong> Format:</strong><span><?php echo $product['format']?></span> <br>
            <strong> Publisher:</strong><span><?php echo $product['publisher']?></span> <br>
                <strong> Edition:</strong><span><?php echo $product['edition']?></span> <br> -->
            
            </div><br>
            
          
        </div>
        <div class="col-xs-12 col-sm-3 pull-right no-padding">

            <div class="right">
        <div class="callout corner4">
          <h5>Affordable Copy</h5>
          <div class="callout-inner">
            <span class="price">$<?php if(min($min_used_price[0]['price'],$min_new_price[0]["price"])){
                        echo min($min_used_price[0]['price'],$min_new_price[0]["price"]);
                 }else{
                   echo max($min_used_price[0]['price'],$min_new_price[0]["price"]);
                 }?></span>
            <p><?php //foreach ($product_record as $prod) {
                    if(min($min_used_price[0]['price'],$min_new_price[0]["price"])){
                        $record = min($min_used_price[0]['price'],$min_new_price[0]["price"]);
                        $seller = $this->product_model->seller_book_condition($record);
                        echo $seller[0]['book_condition'];
                    }elseif(max($min_used_price[0]['price'],$min_new_price[0]["price"])){
                        $record = max($min_used_price[0]['price'],$min_new_price[0]["price"]);
                        $seller = $this->product_model->seller_book_condition($record);
                        echo $seller[0]['book_condition'];
                    }
                    
                //}
                ?>
                    
            </p>
            <a href="#">More details</a>
            <button class="btn btn-main add-cart" id="btn-main-add-to-cart">Add to Cart</button>
            <div class="ship-flag">
              <img
                src="/assets/frontend/img/easy_pocket.png"
                alt=""
                title=""
                height="27px"
                width="110px"
              />
            </div>
          </div>
        </div>
      </div>
 
          </div>
      </div>
                            <?php }
                        } else {
                            echo '<div class="alert alert-danger">Sorry ! No product found</div>';
                        }
						}
                        ?>
                    </div>


                    <!--accordian-->
                    <div class="col-lg-10 col-md-9 col-sm-12 col-xs-12"> <?php echo $pagination; ?></div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="clear35"></div>
<!--<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js?ver=3.4.2'></script> -->


<script>
    $(document).ready(function () {
        $("body").on('click', '.filter-toggler', function (e) {
            var ctrl = $(this);
            var parentCtrl = ctrl.parent();
            var filter_block = parentCtrl.find('.filter-block');
            filter_block.toggle();
        });
    });
</script>
<script>
    $(function () {
        $('.button-checkbox').each(function () {

            // Settings
            var $widget = $(this),
                $button = $widget.find('button'),
                $checkbox = $widget.find('input:checkbox'),
                color = $button.data('color'),
                settings = {
                    on: {
                        icon: 'glyphicon glyphicon-check'
                    },
                    off: {
                        icon: 'glyphicon glyphicon-unchecked'
                    }
                };

            // Event Handlers
            $button.on('click', function () {
                $checkbox.prop('checked', !$checkbox.is(':checked'));
                $checkbox.triggerHandler('change');
                updateDisplay();
            });
            $checkbox.on('change', function () {
                updateDisplay();
            });

            // Actions
            function updateDisplay() {
                var isChecked = $checkbox.is(':checked');

                // Set the button's state
                $button.data('state', (isChecked) ? "on" : "off");

                // Set the button's icon
                $button.find('.state-icon')
                    .removeClass()
                    .addClass('state-icon ' + settings[$button.data('state')].icon);

                // Update the button's color
                if (isChecked) {
                    $button
                        .removeClass('btn-default')
                        .addClass('btn-' + color + ' active');
                }
                else {
                    $button
                        .removeClass('btn-' + color + ' active')
                        .addClass('btn-default');
                }
            }

            // Initialization
            function init() {

                updateDisplay();

                // Inject the icon if applicable
                if ($button.find('.state-icon').length == 0) {
                    $button.prepend('<i class="state-icon ' + settings[$button.data('state')].icon + '"></i> ');
                }
            }

            init();
        });
    });


</script>

<script>


    function set_cat(cat) {
        $('#cat_id').val(cat);
        $("#frm_filter").submit();
    }
    function set_color(color) {
        $('#product_color').val(color);
        $("#frm_filter").submit();
    }

    function set_deals(deal) {
        //$('#cat_id').val(cat);

        var $checkbox = $('#' + deal);
        //alert(checkbox);
        $checkbox.attr('checked', !$checkbox[0].checked);
        $("#frm_filter").submit();
    }

    function filter_condition(obj) {
        var checkbox = $(obj).find('.f_condition');
       
        if($(checkbox).is(':checked')){
               
          $(checkbox).prop('checked', false);
        }else{
          $(checkbox).prop('checked', true);
        }
       // alert(obj.id);
        condition_value = $('.f_condition').map(
        function(){
            if($(this).is(':checked')){

                return $(this).val();
            }  
          }
        ).get().join(',');
    if ($("#"+obj.id).is(':checked')) {

    }else{
        
        if(obj.id=='Used'){
           var condition_value =  condition_value.replace('Like New,Very Good,Good,Acceptable','');
        }
    }
        if(condition_value == 'Used'){
            condition_value = "Used,Like New,Very Good,Good,Acceptable";
            }
        $('#condition').val(condition_value);
        $("#frm_filter").submit();

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
      
      $("#frm_filter").submit();
    }

    /*function filter_rating(obj) {
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
        $("#frm_filter").submit();
    }*/

</script>
<style>
@media screen and (min-device-width: 320px) and (max-device-width: 767px) { 
.btn-cart
{
	margin-bottom:5px;
}
}

.main-content-cont h1, .main-content-cont h2, .main-content-cont h3, .main-content-cont h4
{
	font-weight:bold !important;
}

</style>