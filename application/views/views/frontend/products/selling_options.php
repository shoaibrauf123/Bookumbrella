<?php
    $cashback_data = $cashbacks;
    $currentUserData = getUserData(getCurrentUserId());
?>
<style type="text/css">
    .sell_item_container{
        border: 1px solid #000;
    }
    .sell_item_header{
        background-color: #eeeeee;
        font-size: 18px;
        font-weight: bold;
        padding: 10px;
    }
    .sell_item_detail{
        padding: 10px;
    }
    .btn-warning{
    color: #ffffff !important;
    background: #ab9271 !important;
    padding: 7px 20px;
    border:none !important;
    font-weight: 500;
    border-radius: 0px !important;
    transition:all 0.5s;
    }

    .btn-warning:hover{
     color: rgb(255, 255, 255) !important;
    background: #323232 !important;
    }

    input[type="checkbox"] {
     margin: 2px 0 0 !important;
    accent-color: #bb9870;
    width: 15px;
    height: 17px;
    }
</style>
<div class="col-xs-12">
    <div class="container frontend-dashboard-cont">
        <div class="row no-padding">
            <div class="col-sm-12 col-xs-12">

                <section style="padding-bottom: 50px; padding-top: 50px;">

                    <?php if (isset($errors)) { ?>
                        <div class="alert alert-danger"> <?php print_r($errors); ?></div><?php } ?>
                    <?php if (isset($success)) { ?>
                        <div class="alert alert-success"> <?php print_r($success); ?></div><?php } ?>

                    <!--dashbord start-->
                    <div class="dashbord_inno">
                        <div class="container"> 
                            <div class="dashbord_inno_form">
                              <h3 class="pull-left">Selling Options</h3>  
                              <div class="clearfix"></div>
                               
                               <div class="col-xs-12 col-sm-12">
                               
                               <form id="selling-options-update" method="post">
                               
                               <div class="row">
                               <div class="col-xs-12 col-sm-12 form-group">
                                 <div class="col-xs-6 col-sm-6 form-group"> 
                              
                      <table class="table table-hover table-bordered form-group table-responsive">
                      <thead style="background-color:#fff;">
                      <tr>
                      <th colspan="2"> Shipping Methods</th>
                      </tr>
                      </thead>
    <?php
    $standard_shipping = $this->comman_model->print_value("setting",array('slug'=>'standard_shipping'),'value');
    $expedited_shipping = $this->comman_model->print_value("setting",array('slug'=>'expedited_shipping'),'value');
    $second_day = $this->comman_model->print_value("setting",array('slug'=>'second_day'),'value');
    $next_day = $this->comman_model->print_value("setting",array('slug'=>'next_day'),'value');

    ?>
    <tbody>
      <tr>
        <td style="width:20px;"><input type="checkbox" name="standard" value="active" checked disabled ></td>
        <td>Standard<span style="margin-left:10px;"><strong>(Shipping-<span style=" color: #bb9870 !important; !important;">$<?=$standard_shipping?></span>)</strong></span></td>
   
      </tr>
      <tr>
        <td style="width:20px;"><input type="checkbox" <?php if($selling_options['expedited'] == 'active') {?> checked  <?php } ?> name="expedited" value="active" ></td>
        <td>Expedited <span style="margin-left:10px;"><strong>(Shipping-<span style="color: #bb9870 !important; !important;">$<?=$expedited_shipping?></span>)</strong></span></td>
   
      </tr>
      <tr>
        <td style="width:20px;"><input type="checkbox" <?php if($selling_options['second_day'] == 'active') {?> checked  <?php } ?>  name="second_day" value="active"></td>
        <td>Second Day<span style="margin-left:10px;"><strong>(Shipping-<span style="color: #bb9870 !important;">$<?=$second_day?></span>)</strong></span></td>
   
      </tr>
      <tr>
        <td style="width:20px;"><input type="checkbox" <?php if($selling_options['next_day'] == 'active') {?> checked  <?php } ?>  name="next_day" value="active" ></td>
        <td>Next Day<span style="margin-left:10px;"><strong>(Shipping-<span style="color: #bb9870 !important;">$<?=$next_day?></span>)</strong></span></td>
   
      </tr>
    </tbody>
  </table>
                      </div>

                      
                      
                              
                              
                               </div>
                               
                             <div class="col-xs-12 col-sm-12 form-group">
                             <div class="col-xs-6 col-sm-6 form-group">   
                             <table class="table table-hover table-bordered form-group table-responsive">
                      <thead style="background-color:#fff;">
                      <tr>
                      <th colspan="2"> Vacation Settings(Put your items on vacation)</th>
                      </tr>
                      </thead>
    
    <tbody>
      <tr>
        <td style="width:20px;"><input type="checkbox" <?php if($selling_options['pause_listing'] == 'yes') {?> checked  <?php } ?>  name="pause_listing" value="yes" ></td>
        <td>Pause Listings</td>
   
      </tr>
   
    </tbody>
  </table>
                             
                             </div>

                              
                              
                               
                              
                              </div> 
                               
                               
                               </div>
                               
                               
                               
                               
                               <input type="submit" class="btn btn-warning profile_mobile" value="Update"/>
                               
                               </form>
                               </div>
                               
                                <div class="clearfix"></div>
                              </div>
                            <div class="row">
                                <div id="loadView"></div>
                            </div>
                            <div class="clearfix"></div>

                        </div>
                    </div>
                    <!--dashbord end-->
                </section>
            </div>
        </div>
    </div>
</div>


