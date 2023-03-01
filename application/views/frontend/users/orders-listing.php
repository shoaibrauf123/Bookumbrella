<?php
   
    $currentUserData = getUserData(getCurrentUserId());
?>






<style type="text/css">
    .ui-widget-header {
    border: 1px solid #4b2354;
    background: #4b2354 url(image/ui-bg_gloss-wave_35_f6a828_500x100.png) 50% 50% repeat-x;
    color: #ffffff;
    font-weight: bold;
}
.toggle_orders{
    padding: 0 5px;
    border-radius: 5px;
}
.active_btn {
    background: #fff none repeat scroll 0 0;
    color: #000 !important;
}
.product-col.list .image {
    float: left;
    padding: 10px 10px 10px 0;
}
.detailarea{
	    padding: 10px 0 0 0;
}
.detailarea h4{
    margin-top:0px !important;
    margin-bottom:0px !important;

}
.detailarearight{
	 padding: 10px 0 0 10px;
}
.product-col:hover{
	background-color:transparent !important;	
}
td, th {
    padding: 0 6px;
}
.detailfilter{
padding: 15px;
z-index:9999;
position:relative;
border: 1px solid #ddd;
  
    
}
.order_table {
 
    box-shadow: none;

}
@media screen and (min-device-width: 320px) and (max-device-width: 767px) { 
.detailfilter
{
overflow-x: auto;

}
}
</style>
<style>
.nagitive_bar {
  position: relative;
  width: 100%;
  height: 10px;
  background-color: #ddd;
  margin-bottom: 5px;
}

.positive_bar {
  position: absolute;
  width: 0%;
  height: 100%;
  background-color: #4CAF50;
}
.p0
{
	padding:0px !important;
}
@media screen and (min-device-width: 320px) and (max-device-width: 767px) { 
.label_sm
{
	font-size:18px;
}
.btn-primary
{
	margin-bottom:3px;
}
.mrg_left_up
{
	padding-left:18px;
}
section
{
	padding:0px !important;
}
}
</style>



<div class="col-xs-12 ">
    <div class="container frontend-dashboard-cont  p0">
        <div class="row no-padding">
            <div class="col-sm-12 col-xs-12 p0">

                <section style="padding-bottom: 50px; padding-top: 50px; padding:0px;">

                    <?php if (isset($errors)) { ?>
                        <div class="alert alert-danger"> <?php print_r($errors); ?></div><?php } ?>
                    <?php if (isset($success)) { ?>
                        <div class="alert alert-success"> <?php print_r($success); ?></div><?php } ?>

                    <!--dashbord start-->
                    <div class="dashbord_inno">
                        <div class="container">
                            
                        
                            
                            
                            
                             <div class="row">
                            <div class=" detailfilter" >
                           
                            <form name="search" action="<?php echo base_url('orders_listing');?>" method="post">
                            <table cellpadding="0" cellspacing="0" style="margin-top:15px;" >
                            <tr>
                            

                            <td align="left"><strong>Order Status:</strong>
                               
                            </td>
                            
                            
                            
                             
                         
                            
 							<td align="left">
                             <select class="form-control" onChange="filter_orders()" name="order_status"  id="order_status">
                                    <option value="">All Orders</option>
                                    <option  <?php if($this->input->get('orders_of')=='Pending') { ?> selected <?php } ?> value="Pending">Open Orders</option>
                                    
                                    <option <?php if($this->input->get('orders_of')=='Refunded') { ?> selected <?php } ?> value="Refunded">Refunded Orders</option>
                                    <option  <?php if($this->input->get('orders_of')=='Delivered') { ?> selected <?php } ?> value="Delivered">Delivered Orders</option>
                                    <option  <?php if($this->input->get('orders_of')=='Cancelled') { ?> selected <?php } ?> value="Cancelled">Cancelled Orders</option>
                                </select>

                            </td>
                            
                            
                             <td align="left">
                             <strong>Orders of:</strong>
							
                            </td>
                            
                            <td align="left">
                            <select class="form-control" onChange="filter_orders()" name="orders_of"  id="orders_of">
                            
                            	<option value="" selected>All</option>
                              <option  <?php if($this->input->get('orders_of')=='Today') { ?> selected <?php } ?> value="Today">Today</option>
                                <option  <?php if($this->input->get('orders_of')=='This Month') { ?> selected <?php } ?> value="This Month">This Month</option>
                                <option  <?php if($this->input->get('orders_of')=='Last 6 Month') { ?> selected <?php } ?> value="Last 6 Month">Last 6 Month</option>
                                <option  <?php if($this->input->get('orders_of')=='2017') { ?> selected <?php } ?> value="2017">2017</option>
                                <option  <?php if($this->input->get('orders_of')=='2016') { ?> selected <?php } ?> value="2016">2016</option>
                                <option  <?php if($this->input->get('orders_of')=='2015') { ?> selected <?php } ?>  value="2015">2015</option>
                                <option  <?php if($this->input->get('orders_of')=='2014') { ?> selected <?php } ?>  value="2014">2014</option>
                                <option  <?php if($this->input->get('orders_of')=='2013') { ?> selected <?php } ?> value="2013">2013</option>
                                
                                
                            </select>
                            
                            </td>
                            
                            </tr>
                            
                            <tr >
                            

                            
                            
                            
                             <td  align="left"><strong>Order Id/ISBN:</strong>
							
                                
								
                            </td>
                            
                            <td align="left">
                           
                            <input value="<?=$this->input->get('unique_order_id');?>" class="form-control" type="text" id="unique_order_id" />
                            </td>
                            <td align="left" style="padding-top:20px;">
                               <select class="form-control" name="search_by"  id="search_by">
                                    <option <?php if($this->input->get('search_by')=='isbn') { ?> selected <?php } ?> value="isbn">ISBN-10</option>
                                    <option <?php if($this->input->get('search_by')=='isbn13') { ?> selected <?php } ?> value="isbn13">ISBN13</option>
                                    <option <?php if($this->input->get('search_by')=='unique_order_id') { ?> selected <?php } ?> value="unique_order_id">Order Id</option>
                                </select>&nbsp; 
                            </td>
                            
                            
                            
                             
                         
                            
 							<td align="left">
							
                             <input class="btn btn-cart"   type="button" name="search" onClick="filter_orders()" id="search" value="Search">

                            </td>
                            </tr>
                            
                            
                            </table>
                            </form>
</div>
                         </div>
                            <div class="clearfix"></div>

                            <div class="row">
                                <div class="col-lg-12 co-md-12 col-sm-12" style="padding:0;">	
                                    <div class="order_table">
                                        <h2><a href="javascript:void(0)" class="toggle_orders active_btn label_sm" id="my_orders">Orders List