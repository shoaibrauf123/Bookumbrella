<div class="col-md-12 col-lg-12 col-sm-12-col-xs-12 ">
<div class="login_form">
<form action="<?php echo base_url('forgot_password'); ?>" method="post" data-parsley-namespace="data-parsley-" data-parsley-validate>
    <div class="panel panel-default panel-block">
        <div class="list-group">
            <div class="list-group-item">
                <h4 class="section-title">Recover Password</h4>
                <?php if(isset($errors)){?><div class="alert alert-danger" style="font-size:16px; margin-top:10px;"> <?php print_r($errors); ?></div><?php }?>
                    <?php if(isset($success)){?><div class="alert alert-success" style="font-size:16px; margin-top:10px;"> <?php print_r($success); ?></div><?php }?>
 
                 <div class="form-group">
                    <label>Email <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" placeholder="Email" data-parsley-type="email" data-parsley-required="true" name="email">
                </div>
               </div>
        <footer class="panel-footer text-right">
          <button type="submit" class="btn btn-success">send</button>
        </footer>
    </div>

</div>
    </form>
    </div>
</div>