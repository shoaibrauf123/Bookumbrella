<style>
.form-control
{
	background: #f3f3f3;
    border: solid 1px #ccc;
    box-shadow: none;
	height:35px;
}
.reg_hdg
{
	font-weight:bold;
	font-size:25px;
}
.form-control:focus
{
	border-color: #e77600;
    box-shadow: 0 0 3px 2px rgba(228,121,17,.5);
    transition:all .2s;
}
.btn:hover, .btn:focus, .btn-success:hover, .btn-success:focus, .btn-warning:hover, .btn-cart:hover
{
  border:1px solid #323232 !important;
	background:#323232 !important;
	color:#fff !important;
}
.seller
{
  margin-top:20px;
  float:right;
  text-decoration:none;
  color:black;
}
.seller a
{
 padding:10px 20px ;
 color:#fff;
 background:#bb9870; 
 text-decoration:none;
 transition:all 0.3s;
 border-radius:3px ;
}
.seller a:hover
{
 padding:10px 20px ;
 background:#323232; 
}
input[type=checkbox], input[type=radio] {
    accent-color:#bb9870;
    margin: 4px 0 0;
    margin-top: 1px\9;
    line-height: normal;
}
</style>

<p class="seller"> <a href="<?php echo base_url('seller_registration'); ?>">Register as a Seller</a></p>
<div class="col-md-12 col-lg-12 col-sm-12-col-xs-12 " style="margin-top:30px; margin-bottom:30px;">
  <div class="login_form"  style="box-shadow: 3px 3px 5px #ccc">
    <form action="<?php echo base_url('registration'); ?>" method="post" data-parsley-namespace="data-parsley-" data-parsley-validate>
      <div class="">
        <div class="">
          <div class="list-group-item">
            <h4 class="reg_hdg"> Buyer's Registration</h4>
            <div class="clear20"></div>
            <?php if(isset($errors)){?>
            <div class="alert alert-danger" style="font-size:16px; margin-top:10px;"> <?php print_r($errors); ?></div>
            <?php }?>
            <?php if(isset($success)){?>
            <div class="alert alert-success" style="font-size:16px; margin-top:10px;"> <?php print_r($success); ?></div>
            <?php }?>
            <div class="form-group">
              <label>Username <span class="text-danger">*</span></label>
              <input type="text" class="form-control" placeholder="User Name" name="user_name" value="<?php echo set_value('user_name');?>" required>
            </div>
            <div class="form-group">
              <label>Email <span class="text-danger">*</span></label>
              <input type="text" class="form-control" placeholder="Email" name="email" value="<?php echo set_value('email');?>" required>
            </div>
            <input type="hidden" name="user_type" value="buyer">          
            <div class="form-group">
              <label>Select Country</label>
              <?php
              $countries = $this->comman_model->get('countries');
			  ?>
              <div class="form-group">
                                                                            <label title=""><?php echo getlanguage('country');?> <span class="text-danger">*</span></label>
                                                                            <select id="dashboard-user-country" class="form-control" name="country">
                                                                                <option value="">Select Country</option>
                                                                                <?php if($countries){
                                                                                    foreach ($countries as $country) {
                                                                                        $selected = '';
                                                                                        if($currentUserData['country'] == $country['country_name'])
                                                                                            $selected = 'selected="selected"';
                                                                                        echo '<option '.$selected.' value="'.$country['country_name'].'">'.$country['country_name'].'</option>';
                                                                                    }
                                                                                }
                                                                                ?>
                                                                            </select>
                                                                        </div>
              
            </div>
            <div class="form-group">
              <label>Password <span class="text-danger">*</span></label>
              <input type="password" class="form-control" placeholder="Choose a Password" data-parsley-required="true" name="password"  required="required">
              <span style="font-size:8; color:#999;">Min:6 Max:32</span>
            </div>
            <div class="form-group">
              <label>Confirm Password<span class="text-danger">*</span></label>
              <input type="password" class="form-control" placeholder="Confirm Password" data-parsley-required="true" name="confirm_password" required>
            </div>

            <div class="seller_address">
              <div class="form-group">
                <label>Address<span class="text-danger">*</span></label>
                <textarea style="overflow:auto;resize:none;" rows='2' class="form-control" placeholder="Address" name="address"></textarea>
              </div>
            </div>
            
            <div class="form-group">

           
            <label id="div_seller">

                <input type="checkbox"  data-parsley-required="true" name="terms_and_conditions" >
                <a href="<?php echo base_url("pages/seller-terms");?>" target="_blank">Terms and Conditions (Yearly Fee: $99.99)</a>
                <span class="text-danger">*</span>
            </label>

            <label id="div_buyer">

                <input type="checkbox"  data-parsley-required="true" name="terms_and_conditions" >
                <a href="<?php echo base_url("pages/buyer-terms");?>" target="_blank">Terms and Conditions</a>
                <span class="text-danger">*</span>
            </label>


            

            
            
            </div>
            
            
            
          </div>
        </div>
        <footer class="panel-footer text-right">
          <button type="submit" class="btn btn-success">Register</button>
        </footer>
      </div>
    </form>
  </div>
</div>
<script>
  ControlTerms();
    function ControlTerms(){
        var user_type = $("#user_type").val();
        if(user_type == 'Seller'){
            $("#div_buyer").hide();
            $(".seller_address").show();
            $("#div_seller").show();
        }else{
            $("#div_seller").hide();
            $(".seller_address").hide();
            $("#div_buyer").show();
        }
    }
</script>