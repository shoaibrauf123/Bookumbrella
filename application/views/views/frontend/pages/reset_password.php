<div class="container">
<div class="reset_pass">
<h2> Reset Password </h2>
     
      <div class="col-md-12 col-lg-12  home_bg">
	<div class="row">
      <form role="form" action="<?php echo base_url('change_password').'/'.$this->uri->segment(2); ?>" method="post" id="reset_password">
      
      <?php $this->load->view('errors'); ?> 
        <div class="form-group">
          <label for="Password">Password</label>
          <input type="password" class="form-control" name="password" id="password"/>
        </div>
        <div class="form-group">
          <label for="confirm_password">Confirm Password</label>
          <input type="password" class="form-control" name="password_confirm" id="password_confirmation"/>
        </div>
        <input type="hidden" name="activation_code" value="{{ $activation_code }}"/>
        <footer class="panel-footer footer_contact reset_btn">
        <button type="submit" class="btn btn-primary pull-right ">Reset Password</button>
        </footer>
      </form>
      </div>
</div>
<div>
</div>
</div>
</div>
<div class="clearfix"></div>