<div class="col-xs-12">
   <div class="container">
   <div class="row no-padding">
   <div class="col-sm-12 col-xs-12 store_listing ">
   <div class="product-filter product_mobile" style="border-top:dotted 1px #CCC; border-bottom:dotted 1px #CCC;">

   <div class="product-compare">
   <a id="compare-total" href="">Favourite Stores (<?php echo ($total != 0)? $total: '0';?>)</a></div>
       <form action="<?php echo base_url('favourites');?>" method="get" id="frm_filter">
       <div class="limit">Show:  
       <select onchange="$('#frm_filter').submit()" name="count"> 
               <option value="15"<?php if ($this->input->get('count') == '15') echo 'selected="selected"'; ?>>15</option>
               <option value="50"<?php if ($this->input->get('count') == '50') echo 'selected="selected"'; ?>>50</option>
               <option value="75"<?php if ($this->input->get('count') == '75') echo 'selected="selected"'; ?>>75</option>
               <option value="100"<?php if ($this->input->get('count') == '100') echo 'selected="selected"'; ?>>100</option>
     </select>
   </div>

       <div class="sort pull-right">Sort By:
                    <select onchange="$('#frm_filter').submit()" name="sort_by">
                               <option selected="selected" value="">Default</option>
                               <option value="name_asc" <?php if ($this->input->get('sort_by') == 'name_asc') echo 'selected="selected"'; ?>>Name (A - Z)</option>
                               <option value="name_desc" <?php if ($this->input->get('sort_by') == 'name_desc') echo 'selected="selected"'; ?>>Name (Z - A)</option>
                     </select>
   </div>
           </form>
       <div class="clear5"></div>
        <?php if(isset($errors)){?><div class="alert alert-danger" style="font-size:16px; margin-top:10px;"> <?php print_r($errors); ?></div><?php }?>
       <?php if(isset($success)){?><div class="alert alert-success" style="font-size:16px; margin-top:10px;"> <?php print_r($success); ?></div><?php }?>

 </div>

      <?php
      
             if($result) {
                 //image_url
             for($i=0; $i< count($result); $i++){ ?>
                <div class="product-col list clearfix">

                    <div class="image col-sm-2">
                        <?php if($result[$i]['image_url'] !=''){
                          $img = base_url('uploads/img_gallery/store_images').'/'.$result[$i]['image_url'];   
                         } else {
                          $img = base_url('uploads/img_gallery/store_images/default-store-350x350.jpg');   

                         }?>
                        <img class="img-responsive" alt="store" src="<?php echo $img; ?>">

                    </div>

                    <div class="caption">
                        <h4><?php echo $result[$i]['name']; ?></h4>
                        <div class="description limit-store-thumb-desc">
                        <?php echo $result[$i]['short_description']; ?></div>
  
                       
                        <div class="cart-button button-group">
<a href="<?php echo base_url('remove_favourites').'/'.encode_url($result[$i]['favorite_id']);?>" class="btn btn-cart" title="Remove">

                                Remove
                            </a>									
<a class="btn btn-cart" type="button" target="_blank" href="<?php echo base_url('stores/site_redirect') . "/" . encode_url($result[$i]['store_id']); ?>" title="Visit Store's Website">
                                 쇼핑하기
                                 <i class="fa fa-shopping-cart"></i>
                             </a>
                        </div>
                        

                    </div>

                </div>

                <div class="clear10"></div>
            <?php    }
             } 
        
             else {
 echo '<div class="alert alert-danger">No Favourite found</div>';   
}
             ?>    
       
       
   <!--    
<div class="product-col list clearfix">

<div class="image">

        <img class="img-responsive" alt="product" src="<?php echo base_url('assets/frontend/img/2.jpg');?>">

</div>

<div class="caption">

        <h4>Fashion Garments</h4>

        <div class="description">

                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.

        </div>

        <div class="price">

                <p class="price-tax"><strong>Ex Tax: &nbsp; $279.99</strong></p>

                <span class="price-new"><strong>$199.50</strong></span> 


        </div>

        <div class="cart-button button-group">




                <button class="btn btn-cart" type="button">

                        Remove

                </button>									

        </div>

</div>

</div>

<div class="clear10"></div>


<div class="product-col list clearfix">

                                <div class="image">

                                        <img class="img-responsive" alt="product" src="<?php echo base_url('assets/frontend/img/2.jpg');?>">

                                </div>

                                <div class="caption">

                                        <h4>Fashion Garments</h4>

                                        <div class="description">

                                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.

                                        </div>

                                        <div class="price">

                                                <p class="price-tax"><strong>Ex Tax: &nbsp; $279.99</strong></p>

                                                <span class="price-new"><strong>$199.50</strong></span> 

                                        </div>

                                        <div class="cart-button button-group">




                                                <button class="btn btn-cart" type="button">

                                                    Remove

                                                </button>									

                                        </div>

                                </div>

                        </div>

<div class="clear10"></div>


<div class="product-col list clearfix">

                                <div class="image">

                                    <img class="img-responsive" alt="product" src="<?php echo base_url('assets/frontend/img/2.jpg');?>">

                                </div>

                                <div class="caption">

                                        <h4>Fashion Garments</h4>

                                        <div class="description">

                                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.

                                        </div>

                                        <div class="price">

                                                <p class="price-tax"><strong>Ex Tax: &nbsp; $279.99</strong></p>

                                                <span class="price-new"><strong>$199.50</strong></span> 

                                        </div>

                                        <div class="cart-button button-group">




                                                <button class="btn btn-cart" type="button">

                                                        Remove

                                                </button>									

                                        </div>

                                </div>

                        </div>

-->

</div>



    </div> </div>
</div>