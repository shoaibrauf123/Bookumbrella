<style>
    .product-col .cart-button a.btn.btn-cart {

    background: #bb9870 !important;

    color: white;

    padding: 9px 20px;


    border-radius: 0;
    transition:all .5s;
    }


    .product-col .cart-button a.btn.btn-cart:hover {

    background: #323232 !important;

    color: #fff;

}

</style>

<?php // print_r(get('store',  array('status'=>1))); ?>
<div class="col-xs-12">
    <div class="container store_listing">
        <div class="row no-padding">
            <div class="col-sm-12 col-xs-12">

                <?php if(isset($errors)){?><div class="alert alert-danger" style="font-size:16px; margin-top:10px;"> <?php print_r($errors); ?></div><?php }?>
                <?php if(isset($success)){?><div class="alert alert-success" style="font-size:16px; margin-top:10px;"> <?php print_r($success); ?></div><?php }?>

                

                <div class="product-filter product_mobile">
                    <form action="<?php echo base_url('stores');?>" method="get" id="frm_filter">
                        <div class="alpha-filter-cont text-center">
                    <ul>
                        <li class="alpha <?php echo ($this->input->get('alpha_search'))=='A'? 'active' : '';?>"><a href="javascript:void(0)">A</a></li>
                        <li  class="alpha <?php echo ($this->input->get('alpha_search'))=='B'? 'active' : '';?>"><a href="javascript:void(0)">B</a></li>
                        <li class="alpha <?php echo ($this->input->get('alpha_search'))=='C'? 'active' : '';?>"><a href="javascript:void(0)">C</a></li>
                        <li class="alpha <?php echo ($this->input->get('alpha_search'))=='D'? 'active' : '';?>"><a href="javascript:void(0)">D</a></li>
                        <li class="alpha <?php echo ($this->input->get('alpha_search'))=='E'? 'active' : '';?>"><a href="javascript:void(0)">E</a></li>
                        <li class="alpha <?php echo ($this->input->get('alpha_search'))=='F'? 'active' : '';?>"><a href="javascript:void(0)">F</a></li>
                        <li class="alpha <?php echo ($this->input->get('alpha_search'))=='G'? 'active' : '';?>"><a href="javascript:void(0)">G</a></li>
                        <li class="alpha <?php echo ($this->input->get('alpha_search'))=='H'? 'active' : '';?>"><a href="javascript:void(0)">H</a></li>
                        <li class="alpha <?php echo ($this->input->get('alpha_search'))=='I'? 'active' : '';?>"><a href="javascript:void(0)">I</a></li>
                        <li class="alpha <?php echo ($this->input->get('alpha_search'))=='J'? 'active' : '';?>"><a href="javascript:void(0)">J</a></li>
                        <li class="alpha <?php echo ($this->input->get('alpha_search'))=='K'? 'active' : '';?>"><a href="javascript:void(0)">K</a></li>
                        <li class="alpha <?php echo ($this->input->get('alpha_search'))=='L'? 'active' : '';?>"><a href="javascript:void(0)">L</a></li>
                        <li class="alpha <?php echo ($this->input->get('alpha_search'))=='M'? 'active' : '';?>"><a href="javascript:void(0)">M</a></li>
                        <li class="alpha <?php echo ($this->input->get('alpha_search'))=='N'? 'active' : '';?>"><a href="javascript:void(0)">N</a></li>
                        <li class="alpha <?php echo ($this->input->get('alpha_search'))=='O'? 'active' : '';?>"><a href="javascript:void(0)">O</a></li>
                        <li class="alpha <?php echo ($this->input->get('alpha_search'))=='P'? 'active' : '';?>"><a href="javascript:void(0)">P</a></li>
                        <li class="alpha <?php echo ($this->input->get('alpha_search'))=='Q'? 'active' : '';?>"><a href="javascript:void(0)">Q</a></li>
                        <li class="alpha <?php echo ($this->input->get('alpha_search'))=='R'? 'active' : '';?>"><a href="javascript:void(0)">R</a></li>
                        <li class="alpha <?php echo ($this->input->get('alpha_search'))=='S'? 'active' : '';?>"><a href="javascript:void(0)">S</a></li>
                        <li class="alpha <?php echo ($this->input->get('alpha_search'))=='T'? 'active' : '';?>"><a href="javascript:void(0)">T</a></li>
                        <li class="alpha <?php echo ($this->input->get('alpha_search'))=='U'? 'active' : '';?>"><a href="javascript:void(0)">U</a></li>
                        <li class="alpha <?php echo ($this->input->get('alpha_search'))=='V'? 'active' : '';?>"><a href="javascript:void(0)">V</a></li>
                        <li class="alpha <?php echo ($this->input->get('alpha_search'))=='W'? 'active' : '';?>"><a href="javascript:void(0)">W</a></li>
                        <li class="alpha <?php echo ($this->input->get('alpha_search'))=='X'? 'active' : '';?>"><a href="javascript:void(0)">X</a></li>
                        <li class="alpha <?php echo ($this->input->get('alpha_search'))=='Y'? 'active' : '';?>"><a href="javascript:void(0)">Y</a></li>
                        <li class="alpha <?php echo ($this->input->get('alpha_search'))=='Z'? 'active' : '';?>"><a href="javascript:void(0)">Z</a></li>
                        <li class="alpha <?php echo ($this->input->get('alpha_search'))=='0-9'? 'active' : '';?>"><a href="javascript:void(0)">0-9</a></li>
                        <li class="alpha <?php echo ($this->input->get('alpha_search'))==''? 'active' : '';?>"><a href="javascript:void(0)">All</a></li>
                    </ul>
                   <input type="hidden" id="alpha_search" name="alpha_search" class="hidden" value="<?php echo ($this->input->get('alpha_search'))? $this->input->get('alpha_search') :'';?>">          
                </div>
                    <div class="product-compare">
                        <a id="compare-total" href="">Store Listing (<?php echo (($total) > 0)? $total: '0';?>)</a>
                    </div>
                        <div class="limit" title="Show"> <?php echo getlanguage('show');?>:
                        <select onchange="$('#frm_filter').submit()" name="count">
                            <option selected="selected" value="">15</option>
                            <option value="50" <?php if ($this->input->get('count') == '50') echo 'selected="selected"'; ?>>50</option>
                            <option value="75" <?php if ($this->input->get('count') == '75') echo 'selected="selected"'; ?>>75</option>
                            <option value="100" <?php if ($this->input->get('count') == '100') echo 'selected="selected"'; ?>>100</option>
                        </select>
                    </div>

                        <div class="sort pull-right" title="Sort By"><?php echo getlanguage('sort_by');?>:
                        <select onchange="$('#frm_filter').submit()" name="sort_by">
                            <option selected="selected" value="">Default</option>
                            <option value="name_asc" <?php if ($this->input->get('sort_by') == 'name_asc') echo 'selected="selected"'; ?>>Name (A - Z)</option>
                            <option value="name_desc" <?php if ($this->input->get('sort_by') == 'name_desc') echo 'selected="selected"'; ?>>Name (Z - A)</option>
                        </select>
                    </div>
                        <input type="hidden" name="search" value="<?php echo ($this->input->get('search'))?$this->input->get('search'):'';?>" />
                        </form>
                </div>

       <?php if($store_data) {
             for($i=0; $i< count($store_data); $i++){ ?>

                 <div class="product-col list clearfix col-sm-12">

                     <div class="image col-sm-2">
                         <?php if($store_data[$i]['image_url'] !=''){
                          $img = base_url('uploads/img_gallery/store_images').'/'.$store_data[$i]['image_url'];   
                         } else {
                          $img = base_url('uploads/img_gallery/store_images/store_3.jpg');   

                         }?>
                         <img class="img-responsive" alt="product" src="<?php echo $img; ?>">

                     </div>

                     <div class="caption col-sm-10">

                         <h4 style="font-weight:bold;">
                         <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-shop" viewBox="0 0 16 16">
  <path d="M2.97 1.35A1 1 0 0 1 3.73 1h8.54a1 1 0 0 1 .76.35l2.609 3.044A1.5 1.5 0 0 1 16 5.37v.255a2.375 2.375 0 0 1-4.25 1.458A2.371 2.371 0 0 1 9.875 8 2.37 2.37 0 0 1 8 7.083 2.37 2.37 0 0 1 6.125 8a2.37 2.37 0 0 1-1.875-.917A2.375 2.375 0 0 1 0 5.625V5.37a1.5 1.5 0 0 1 .361-.976l2.61-3.045zm1.78 4.275a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 1 0 2.75 0V5.37a.5.5 0 0 0-.12-.325L12.27 2H3.73L1.12 5.045A.5.5 0 0 0 1 5.37v.255a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0zM1.5 8.5A.5.5 0 0 1 2 9v6h1v-5a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v5h6V9a.5.5 0 0 1 1 0v6h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1V9a.5.5 0 0 1 .5-.5zM4 15h3v-5H4v5zm5-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1v-3zm3 0h-2v3h2v-3z"/>
</svg>
                         &nbsp;
                         Seller: <b style="color:#bb9870;font-weight:bold;"><?php echo $store_data[$i]['name']; ?></b></h4>

                         <strong style="font-size:18px;color:#000 !important;" >
                         <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-pin-map-fill" viewBox="0 0 16 16">
                         <path fill-rule="evenodd" d="M3.1 11.2a.5.5 0 0 1 .4-.2H6a.5.5 0 0 1 0 1H3.75L1.5 15h13l-2.25-3H10a.5.5 0 0 1 0-1h2.5a.5.5 0 0 1 .4.2l3 4a.5.5 0 0 1-.4.8H.5a.5.5 0 0 1-.4-.8l3-4z"/>
                         <path fill-rule="evenodd" d="M4 4a4 4 0 1 1 4.5 3.969V13.5a.5.5 0 0 1-1 0V7.97A4 4 0 0 1 4 3.999z"/>
                        </svg>
                         &nbsp; State,</strong>
						<span style="font-size:16px;  font-family:Open Sans;#bb9870!important; font-weight:500;">United State</span>

                         <div class="description limit-store-thumb-desc"><?php echo $store_data[$i]['short_description']; ?></div>


                         <div class="cart-button button-group">

                             

                             <a class="btn btn-cart" type="button" target="_blank" href="<?php echo base_url('products')."?user_id=".$store_data[$i]['user_id']; ?>" title="Visit Store's Books">
                                 View Books
                                 
                             </a>

                         </div>

                     </div>

                 </div>

                 <div class="listing-block-separator"></div>
            <?php
             } ?>
              <div class="col-lg-10 col-md-9 col-sm-12 col-xs-12 margin-bottom-30">
              <?php  echo $pagination; ?>
               </div>
             <?php }
             else {
                 echo '<div class="alert alert-danger">No Store found</div>';
             }
             ?>
            </div>

        </div> </div>
</div>
<script>
$('.alpha').on('click',function(){
    var a = $(this).text(); 
    if(a=='All') 
        $('#alpha_search').val('');
     else 
    $('#alpha_search').val(a);
    $('#frm_filter').submit();
     
});
</script>