
<style>
    .seller
{
  margin-top:10px;
  float:right;
  text-decoration:none;
  color:black;
}
.list-group-item .seller a
{
 padding:10px 20px ;
 color:#fff !important;
 background:#bb9870; 
 text-decoration:none;
 border-radius:3px;
 transition:all 0.3s;
}
.list-group-item .seller a:hover
{
 background:#323232; 
}
</style> 
<div class="col-md-12 col-lg-12 col-sm-12-col-xs-12 ">
<div class="login_form">
<form action="<?php echo base_url('frontend/users/sell_login'); ?>" method="post" data-parsley-namespace="data-parsley-" data-parsley-validate>
  
        <div class="list-group">
            <div class="list-group-item">
            <p class="seller"> <a href="<?php echo base_url('frontend/users/seller_registration'); ?>">Sign up as a seller</a></p>
                <h4 class="">Seller's Login</h4>
                <?php if(isset($errors)){?><div class="alert alert-danger" style="font-size:16px; margin-top:10px;"> <?php print_r($errors); ?></div><?php }?>
                    <?php if(isset($success)){?><div class="alert alert-success" style="font-size:16px; margin-top:10px;"> <?php print_r($success); ?></div><?php }?>
                    <div class="form-group">
                    <input type="hidden" class="form-control" name="Seller" value="Seller">
                    </div>
                 <div class="form-group">
                    <label>Email <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" placeholder="Email" name="email" value="<?php echo set_value('email');?>">
                </div>
                <div class="form-group">
                    <label>Password <span class="text-danger">*</span></label>
                    <input type="password" class="form-control" placeholder="Choose a Password" name="password">
                </div>
                    <a href="<?php echo base_url('forgot_password');?>">Forgot Password</a>
             </div>
        <footer class="panel-footer text-right">
          <button type="submit" class="btn btn-success">Login</button>
        </footer>
    </div>
</form>
</div>
</div>
</div>