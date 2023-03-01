<style>
/*  SECTIONS  */
.section {
	clear: both;
	padding: 0px;
	margin: 0px;
	background-color: #999;
}
/*  COLUMN SETUP  */
.col {
	display: block;
	float: left;
	margin: 1% 0 1% 1.6%;
}
.col:first-child {
	margin-left: 0;
}
/*  GROUPING  */
.group:before, .group:after {
	content: "";
	display: table;
}
.group:after {
	clear: both;
}
.group {
	zoom: 1; /* For IE 6/7 */
}
/*  GRID OF SEVEN  */
.span_7_of_7 {
	width: 100%;
}
.span_6_of_7 {
	width: 85.48%;
}
.span_5_of_7 {
	width: 70.97%;
}
.span_4_of_7 {
	width: 56.45%;
}
.span_3_of_7 {
	width: 16.91%;
}
.span_2_of_7 {
	width: 50.42%;
}
.span_1_of_7 {
	width: 4.91%;
}
.span_0_of_7 {
	width: 2.91%;
}
.invenchkbox{
	 display: inline;
    float: left;
    width: 20px;
}
.invenbokimg{
 float: left;
    max-height: 140px;
    min-height: 57px;
    width: 117px;
}
@media screen and (min-device-width: 320px) and (max-device-width: 900px) { 
.tble_ovlow
{
width: 100%;
    overflow: scroll;
}
}
/*  GO FULL WIDTH BELOW 480 PIXELS */
@media only screen and (max-width: 480px) {
.col {
	margin: 1% 0 1% 0%;
}
.span_1_of_7, .span_2_of_7, .span_3_of_7, .span_4_of_7, .span_5_of_7, .span_6_of_7, .span_7_of_7 {
	width: 100%;
}
}
.clear20
{
	clear:both;
	height:20px;
}
.p0
{
	padding:0px !important;
}
input
{
	/*text-align:center !important;
	padding:4px 4px !important;*/
}
.table > tbody > tr > td, .table > tbody > tr > th, .table > tfoot > tr > td, .table > tfoot > tr > th, .table > thead > tr > td, .table > thead > tr > th
{
	padding:5px !important;
}
.btn{
  border-radius:2px !important;
}

input#update_all 
{
  background: #bb9870 !important;
	color: rgb(255, 255, 255) !important;
  transition: all 0.5s;
  
}
input#update_all:hover{
background: #323232 !important ;
  color:#fff !important;
}

input#updateprices_all{
 background: #bb9870 !important;
  color: rgb(255, 255, 255) !important;
  transition: all 0.5s;
}

input#updateprices_all:hover{
  background: #323232 !important ;
  color:#fff !important;
 
} 

input#delete_all
{
  background: #323232 !important ;
  color:#fff !important;
  transition: all 0.5s;

}

input#delete_all:hover
{
  background: #bb9870 !important;
	color: rgb(255, 255, 255) !important;

}

.btn_remove_new
{
	font-size:11px;
	padding:5px 10px;
	min-width: 69px;
  background: #bb9870;
  color:#fff;
  transition: all 0.5s;
}

.btn_remove_new:hover
{
	color: rgb(255, 255, 255) !important;
    background: #323232 !important;

}
a.bk-title{
  color: #000;
 font-weight:600;
}

a.bk-title:hover{
color: #bb9870;
}

.pri-setting{
color: #969696;
}

.pri-setting:hover{
color: #bb9870;
}

textarea
{
	 resize: none;
}
.align_center
{
	text-align:center !important;
}

</style>

<input type="hidden" name="current_product_id" id="current_product_id" value="" />
<input type="hidden" name="min_updated_price" id="min_updated_price" value="" />
<div class="col-xs-12">
  <div class="container product-listing-cont">
    <div class="row no-padding product_responsive">
    <div class="clear20"></div>
      <?php if ($this->input->get('cat')) {
                getCategoriesNavigation(($this->input->get('cat') ));
            } ?>
      <h3 class="section-heading">Edit Inventory</h3>
      <?php if (isset($errors)) { ?>
        <div class="alert alert-danger"> <?php print_r($errors); ?></div>
        <?php } ?>
      <?php if (isset($success)) { ?>
        <div class="alert alert-success"> <?php print_r($success); ?></div>
        <?php } ?>
    </div>
    <div class="col-sm-12 col-xs-12 p0">
      <form acrtion="<?php echo base_url('edit_inventory'); ?>" method="get" id="frm_filter">
        <input type="hidden" id="listing" name="listing" value="yes"/>
        <input type="hidden" id="condition" name="condition"
                           value="<?php echo ($this->input->get('condition')) ? $this->input->get('condition') : ''; ?>"/>
        <input type="hidden" name="cat" id="cat_id"
                           value="<?php echo ($this->input->get('cat')) ? $this->input->get('cat') : ''; ?>"/>
        <input type="hidden" name="type" id="type"
                           value="<?php echo ($this->input->get('type')) ? $this->input->get('type') : ''; ?>"/>
        <div>
        <div class="product-filter">
          <div class="product-compare col-xs-4" style="padding-left:0px;"><a id="compare-total" href="">My Inventory Listing
            (<?php echo $total_products; ?>)</a></div>
          <div class="col-xs-12 col-lg-8 pull-right no-padding product_mobile">
            <div class="limit" title="Show"><?php echo getlanguage('show'); ?>:
              <select onchange="$('#frm_filter').submit();" name="count">
                <option selected="selected" value="15" selected="selected">
                
                15
                
                </option>
                <option
                                            value="25" <?php if ($this->input->get('count') == '25') echo 'selected="selected"'; ?>> 25 </option>
                <option
                                            value="50" <?php if ($this->input->get('count') == '50') echo 'selected="selected"'; ?>> 50 </option>
                <option
                                            value="75" <?php if ($this->input->get('count') == '75') echo 'selected="selected"'; ?>> 75 </option>
                <option
                                            value="100"<?php if ($this->input->get('count') == '100') echo 'selected="selected"'; ?>> 100 </option>
              </select>
            </div>
            <div class="sort pull-right margin-left-10"
                                     title="Sort By">Sort By:
              <select onchange="$('#frm_filter').submit();" name="sort_by">
                <option selected="selected" value="">Default</option>
                <option
                                            value="name" <?php if ($this->input->get('sort_by') == 'name') echo 'selected="selected"'; ?>> brand alphabetic (A - Z) </option>
                <option
                                            value="price_low" <?php if ($this->input->get('sort_by') == 'price_low') echo 'selected="selected"'; ?>> Price (Low &gt; High) </option>
                <option
                                            value="price_high" <?php if ($this->input->get('sort_by') == 'price_high') echo 'selected="selected"'; ?>> Price (High &gt; Low) </option>
                <option
                                            value="most_viewed" <?php if ($this->input->get('sort_by') == 'most_viewed') echo 'selected="selected"'; ?>> Most Viewed </option>
              </select>
            </div>
            <div class="input-group">
              <input type="text" name="title" class="form-control product-name-filter-input" style="text-align:left !important;"
                                           placeholder="Search by title/isbn10/isbn13..."
                                           value="<?php echo ($this->input->get('title')) ? $this->input->get('title') : ''; ?>">
              <span class="input-group-btn btn_search">
              <button class="btn btn-info btn-sm btn-mini-custom" type="submit"> <i class="glyphicon glyphicon-search"></i> </button>
              </span> </div>
          </div>
        </div>
      </form>
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 p0">
        <div class="prod-data-cont">
          <?php
						
						
						
                        if ($allProducts) {  ?>
          <form name="inventoryPdtsF" id="inventoryPdtsF" method="post" action="<?php echo base_url('edit_inventory')?>" >
           
<div style="float:right;margin-bottom:32px;"> 
            <span style="margin-right:30px;">
              <input class="btn btn-cart" onClick="AllProducts('updateprices')"  type="button" name="updateprices_all" id="updateprices_all" value="Update All Prices">
              </span>
              
              
            
            <span style="margin-right:30px;">
              <input class="btn btn-cart" onClick="AllProducts('update')"  type="button" name="update_all" id="update_all" value="Update All">
              </span> <span style="margin-right:0px;">
              
              <input class="btn btn-cart" onClick="AllProducts('delete')"  type="button" name="delete_all" id="delete_all" value="Delete All">
              </span> </div>
<div class="col-xs-12 col-sm-12 p0">
<div class="container p0">
<div class="tble_ovlow">
<table class="table table-hover table-responsive">
    <thead>
      <tr>
        <th width="1%" ><input type="checkbox" name="select_all" id="select_all" /></th>
        <th width="8%" >Product <br>Image</th>
        <th width="10%">SKU
        <br >
<span style="font-size:12px; color:#000;font-family: Lato, Arial, sans-serif !important;">Condition</span></th>
          <th width="24%" >Product Name  <br >
<span style="font-size:12px;    color: #000;font-family: Lato, Arial, sans-serif !important; ">ISBN / Details</span></th>
            <th >Product <br>Type</th>       
       <th>Product <br>Quantity</th>
         <th>Comments<br >
         <span style="font-size:12px;color: #000 !important;">(Maximum of 500 Charcters) </span>
          </th>
           <th> Product <br>Price</th>
           <th>  Lowest<br> Price </th>
             <th style="vertical-align:top !important;">Action</th>
     
      </tr>
    </thead>
    <tbody>
      
          </div>
        
    



            
            
              
              
            <?php foreach ($allProducts as $product) { 
							
							$seller_details = $this->comman_model->get("user",array("user_id"=>$product['user_id']));
		
				$min_new_price = $this->product_model->min_product_price("seller_products",false,array('product_id'=>$product['product_id']));
							//echo '<pre>';print_r();exit;
							$min_used_price = $this->product_model->min_product_price("seller_products",array("Like New","Very Good","Good","Acceptable"),array('product_id'=>$product['product_id']));
				
				
				
				
							
							 ?>
                             
                             
                             
          <tr>
        <td><input  type="checkbox" name="update_select[]" id="delete_select_<?php echo $product['id']; ?>" value="<?php echo $product['id']; ?>" /></td>
        <td><a href="<?php echo base_url('product/detail') . "/" . encode_url($product['product_id']); ?>"> 
                <img class="img-responsive" style="height:140px; width:94px" alt="product" src="<?php echo base_url().$product['image'];?>">
              </a></td>
        <td><input type="text"  class="form-control align_center"  size="3" name="new_sku[<?php echo $product['id']; ?>]" id="new_sku_<?php echo $product['id']; ?>" value="<?php echo $product['sku']; ?>"  style="padding:0px 0px; margin-bottom:3px;border-radius:1px !important; border:1px solid #323232 !important " />
        
<select  name="new_book_condition[<?php echo $product['id']; ?>]" id="new_condition_<?php echo $product['id']; ?>">
                    <option <?php if($product['book_condition'] == 'New') {?> selected <?php } ?> value="New">New</option>
                    <option <?php if($product['book_condition'] == 'Like New') {?> selected <?php } ?> value="Like New">Like New</option>
                    <option <?php if($product['book_condition'] == 'Very Good') {?> selected <?php } ?> value="Very Good">Very Good</option>
                    <option <?php if($product['book_condition'] == 'Good') {?> selected <?php } ?> value="Good">Good</option>
                    <option <?php if($product['book_condition'] == 'Acceptable') {?> selected <?php } ?> value="Acceptable">Acceptable</option>
                  </select>
</td>
          <td><a class="bk-title" href="<?php echo base_url('product/detail') . "/" . encode_url($product['product_id']); ?>"> <?php echo $product['title']?></a>
          <br>


<div>
            
            <strong style="color: #000 !important;"> Author:</strong><span style="color: rgb(187, 152, 112);"><?php echo $product['author']?></span> <br>
            <strong> ISBN-10:</strong><span><?php echo $product['isbn']?></span> <br>
            <strong> ISBN-13:</strong><span><?php echo $product['isbn13']?></span> <br>

        </div>
          </td>
        <td> <select style="    padding:0px 5px;font-size: 11px;font-weight: bold;" type="text" name="new_book_type[<?php echo $product['id']; ?>]" id="new_type_<?php echo $product['id'];?>" class="form-control" required>
                    <option <?php if($product['book_type'] == 'Normal') {?> selected <?php } ?> value="Normal">Normal</option>
                    <option <?php if($product['book_type'] == 'Internation Edition') {?> selected <?php } ?>  value="Internation Edition">Internation Edition</option>
                    <option <?php if($product['book_type'] == 'Teachers Edition') {?> selected <?php } ?>  value="Teachers Edition">Teachers Edition</option>
                    <option <?php if($product['book_type'] == 'Study Guide') {?> selected <?php } ?> value="Study Guide">Study Guide</option>
                    <option <?php if($product['book_type'] == 'Work Book') {?> selected <?php } ?> value="Work Book">Work Book</option>
                    <option <?php if($product['book_type'] == 'Library Copy') {?> selected <?php } ?> value="Library Copy">Library Copy</option>
                  </select></td>
        <td> <input type="text"  class="form-control align_center"  maxlength="5" size="3" name="new_qty[<?php echo $product['id']; ?>]" id="new_qty_<?php echo $product['id']; ?>" value="<?php echo $product['quantity']; ?>"  style="width:50px;padding:0px 0px;border:1px solid #323232 !important ;" /></td>
          <td> <textarea rows="2" cols="20" class="form-control" name="new_comments[<?php echo $product['id']; ?>]" style="height:60px;" id="new_comments_<?php echo $product['id']; ?>"><?php echo $product['comments']; ?></textarea>
      
         <span style="font-size:12px;color: #000 !important;"><strong>(Maximum of 500 Charcters)</strong> </span>
          </td>
        <td>
        <input type="hidden"  class="form-control"  maxlength="5" size="3" name="new_minprice[<?php echo $product['id']; ?>]" id="new_minprice_<?php echo $product['id']; ?>" value="<?php echo $min_new_price[0]['price']; ?>"  style="width:50px;padding:0px 0px;" />
        
        
        
        <div>
                  
                  
                  <span style="color: #ab9271 !important; font-size: 16px; font-weight:bold;"  id="min_new_price_<?php echo $product['id']; ?>">$<?php if($min_new_price[0]['price']) echo $min_new_price[0]['price']; else echo '0'; ?>
                  </span> &nbsp;&nbsp; </div>
                  
                  </td>
        <td><a class="pri-setting" href="javascript:;" style="font-size:11px; padding-left:3px;" onClick="SetMyPrice(<?php echo $product['id']; ?>,<?=$min_new_price[0]['price']?>,'new')">Set minimum price</a> 
                 
                   <span  style="float:left; display:inline;">
                  <input type="text"  class="form-control align_center"   size="3" name="new_price[<?php echo $product['id']; ?>]" id="new_price_<?php echo $product['id']; ?>" value="<?php echo $product['price']; ?>"  style="width:50px;" />
                  </span></td>
          <td> <a href="javascript:;" onClick="DeletePdt(<?php echo $product['id']?>)" class="btn btn-cart btn_remove_new" type="button">Remove</a> <br>
                
                <div style="color:#060" id="result_<?php echo $product['id']; ?>"></div>
                <a href="javascript:;" class="btn btn-cart btn_remove_new"  style="margin-top:4px;"  onClick="UpdateProductPdtNew('<?php echo $product['id']; ?>','<?php echo $product['quantity']; ?>','<?php echo $product['price']; ?>')" >Update</a> </td>
     
      </tr>                   
                             
            
            <?php }
							
							
							?>
          </form>
          
          
          </tbody>
  </table>
</div>
</div>
          <?php
                        } else {
                            echo '<div class="alert alert-danger">Sorry ! No product found</div>';
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
function DeletePdt(id){
		
			var r = confirm("Are you sure you want to delete product?");
			if (r == true) {
				
					$.ajax({
					type: "POST",
					url: '<?php echo base_url("frontend/products/delete_inventory");?>',
					data: {id: id},
					success: function(data){
						alert(data);
						location.reload();
					}
					});
				
			} 
	}
    $(document).ready(function () {
        $("body").on('click', '.filter-toggler', function (e) {
            var ctrl = $(this);
            var parentCtrl = ctrl.parent();
            var filter_block = parentCtrl.find('.filter-block');
            filter_block.toggle();
        });
    });
	
	
	
function SetMyPrice(id,price,ptype){
	
	
	

		
			var r = confirm("Are you sure you want to take this minimum price?");
			if (r == true) {
			$("#current_product_id").val(id);
			$("#min_updated_price").val(price);
						$.ajax({
					type: "POST",
					url: '<?php echo base_url('update_inventory_price'); ?>',
            data: {'id': id,
			'price':price},
					success: function(data){
						
					//alert(data);
						var product_id = $("#current_product_id").val();
                    $('#result_'+product_id).html(data);
			
				if(data == 'Price updated successfully.')	{
					
						$('#new_price_'+product_id).val($("#min_updated_price").val());
				}
					
					
					
						
						
					}
					});
				
			} 
	
	
	
	




	
	}	
function UpdateProductPdtNew(id,org_qty,org_price){
	

		
			var r = confirm("Are you sure you want to update product?");
			if (r == true) {
			$("#current_product_id").val(id);
	var new_qty = $("#new_qty_"+id).val();
	var new_price = $("#new_price_"+id).val();
	var new_condition = $("#new_condition_"+id).val();
	var new_type = $("#new_type_"+id).val();
	var new_sku = $("#new_sku_"+id).val();
	var new_comments = $("#new_comments_"+id).val();			
					$.ajax({
					type: "POST",
					url: '<?php echo base_url('update_inventory'); ?>',
            data: {'id': id,
			'org_qty':org_qty,
			'new_qty':new_qty,
			'org_price':org_price,
			'new_price':new_price,
			'new_sku':new_sku,
			'new_condition':new_condition,
			'new_type':new_type,
			'new_comments':new_comments},
					success: function(data){
						
					alert(data);
						var product_id = $("#current_product_id").val();
                    $('#result_'+product_id).html(data);
			
				if(data == 'Seller item updated successfully.')	
						$('#btn_update_pdt_'+product_id).hide();
					
					
					
						
						
					}
					});
				
			} 
	
	
	
	

}

function AllProducts(action){
	
	//$("#inventoryPdtsF").attr("action"); //Will retrieve it
if(action =='update'){
$("#inventoryPdtsF").attr("action", "<?php echo base_url("edit_inventory/update");?>"); //Will set it	
$("#inventoryPdtsF").submit();
}else
if(action =='delete'){
	
	var r = confirm("Are you sure you want to delete these books?");
			if (r == true) {
				
$("#inventoryPdtsF").attr("action", "<?php echo base_url("edit_inventory/delete");?>");
$("#inventoryPdtsF").submit();
			}
}else
if(action =='updateprices'){
	
	var r = confirm("Are you sure you want to update all prices?");
			if (r == true) {
				
$("#inventoryPdtsF").attr("action", "<?php echo base_url("edit_inventory/updateprices");?>");
$("#inventoryPdtsF").submit();
			}
}
	}
	$('#select_all').click(function(event) {
  if(this.checked) {
      // Iterate each checkbox
      $(':checkbox').each(function() {
          this.checked = true;
      });
  }
  else {
    $(':checkbox').each(function() {
          this.checked = false;
      });
  }
});			
	
</script> 