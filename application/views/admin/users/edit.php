<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">

            <header class="panel-heading">
                <label for="menu_label">Update User</label>
            </header>

            <div class="panel-body">
                <div class="row col-md-offset-1">
                    <div class="col-md-12">
                        <?php $this->load->view('errors'); ?>

                        <form action="<?php echo base_url('admin/users/edit').'/'.$this->uri->segment(4).'/'.encode_url($user_data['user_id']); ?>" id="edit_user" role="form" method="post" enctype="multipart/form-data">

                            <div class="form-group col-md-8">
                                <label for="name">First Name *</label>
                                <input type="text" value="<?php echo $user_data['first_name']; ?>" class="form-control" placeholder="First Name" id="first_name" name="first_name" required>
                                <span class="error_signup"><?php echo form_error('first_name'); ?></span>
                            </div>

                            <div class="form-group col-md-8">
                                <label for="name">Last Name *</label>
                                <input type="text" value="<?php echo $user_data['last_name']; ?>" class="form-control" placeholder="Last Name" id="last_name" name="last_name" required>
                                <span class="error_signup"><?php echo form_error('last_name'); ?></span>
                            </div>

                            <div class="form-group col-md-8">
                                <label for="name">Username *</label>
                                <input type="text" value="<?php echo $user_data['username']; ?>" class="form-control" placeholder="Username" id="username" name="username" required>
                                <span class="error_signup"><?php echo form_error('username'); ?></span>
                            </div>


                            <div class="form-group col-md-8">
                                <label for="gender">Gender *</label>
                                <select class="form-control" name="gender" id="gender" required>
                                    <option value="">Select Gender</option>
                                    <option value="male" <?php echo ($user_data['gender'] == 'male')? 'selected="selected"' : ''; ?>>Male</option>
                                    <option value="female" <?php echo ($user_data['gender'] == 'female')? 'selected="selected"' : ''; ?>>Female</option>
                                </select>
                                <span class="error_signup"><?php echo form_error('gender'); ?></span>
                            </div>

                            <div class="form-group col-md-8">
                                <label for="gender">Role *</label>
                                <select class="form-control" name="role_id" id="role_id" required>
                                    <option value="">Select Role</option>
                                    <?php if($user_roles){ foreach($user_roles as $role){ ?>
                                        <option <?php echo ($user_data['role_id'] == $role['role_id'])? 'selected="selected"' : ''; ?> value="<?php echo $role['role_id']; ?>"><?php echo $role['title']; ?></option>
                                    <?php } } ?>
                                </select>
                                <span class="error_signup"><?php echo form_error('role_id'); ?></span>
                            </div>

                            <div class="form-group col-md-8" <?php echo ($user_data['role_id'] == $role['role_id'])? 'style="display:none;"' : ''; ?> >
                                <label for="name">Business Name *</label>
                                <input type="text" value="<?php echo $user_data['businessname']; ?>" class="form-control" placeholder="Business name" id="businessname" name="businessname" required>
                                <span class="error_signup"><?php echo form_error('businessname'); ?></span>
                                <p class="margin-top-10">URL:<i><?php echo base_url().$user_data['businessname'].'-biz'; ?></i></p>
                            </div>

                            <div class="col-md-8">
                                <input type="submit" class="btn btn-shadow btn-primary" value="Update User">
                            </div>

                        </form>
                        
                    </div>
                </div>
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
       <div class="row">
                                <div class="col-lg-12 co-md-12 col-sm-12">
                                    <div class="order_table">
                                        <h2>Previous Paypal Accounts<?php //echo getlanguage('cash_outs'); ?></h2>
                                        <div class="order_content">
                                            <div class="col-lg-12 co-md-12 col-sm-12">
                                                <table class="table history-table scrollable-table-head margin0">
                                                    <thead class="padding-right-20">
                                                    
                                                    <tr>
                                                        <th  class="col-xs-1 col-sm-1 col-md-1">Serial#</th>
                                                        <th class="col-xs-1 col-sm-1 col-md-4">Email</th>
                                                         
                                                    </tr>
                                                    
                                                    
                                                    </thead>
                                                </table>
                                                <?php if($paypal_accounts) { 
												$i=0;
												?>
                                                    <div class="scrollable-table-body-cont margin-bottom-20">
                                                        <table class="table history-table scrollable-table-body">
                                                            <tbody>
                                                                <?php foreach ($paypal_accounts as $row) {
																	$i++;
																	
																	 ?>
                                                                 <tr>
<td class="col-xs-1 col-sm-1 col-md-1"><?php echo $i; ?></td>

<td class="col-xs-1 col-sm-1 col-md-4"><?php echo $row['email']; ?></td>
                                                                               
                                                                                
                                                                                
                                                                            </tr>  
                                                                   
                                                                <?php }?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                <?php } else { ?>
                                                    <?php echo adminRecordNotFoundMsg(); ?>
                                                <?php } ?>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>         
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
      
                            <div class="clearfix"></div>

                            <div class="row">
                                <div class="col-lg-12 co-md-12 col-sm-12">
                                    <div class="order_table">
                                        <h2>Previous Bank Accounts<?php //echo getlanguage('cash_outs'); ?></h2>
                                        <div class="order_content">
                                            <div class="col-lg-12 co-md-12 col-sm-12">
                                                <table class="table history-table scrollable-table-head margin0">
                                                    <thead class="padding-right-20">
                                                    
                                                    <tr>
                                                        <th class="col-xs-1 col-sm-1 col-md-1">Serial#</th>
                                                        <th class="col-xs-1 col-sm-1 col-md-1">Account Number</th>
                                                        <th class="col-xs-1 col-sm-1 col-md-1">Account Title</th>
                                                        <th class="col-xs-1 col-sm-1 col-md-1">Swift Code</th>
                                                        <th class="col-xs-1 col-sm-1 col-md-1">Bank Name</th>
                                                        <th class="col-xs-1 col-sm-1 col-md-1">Bank Branch</th>
                                                        
                                                        
                                                         
                                                    </tr>
                                                    
                                                    
                                                    </thead>
                                                </table>
                                                <?php if($bank_accounts) { 
												$i=0;
												?>
                                                    <div class="scrollable-table-body-cont margin-bottom-20">
                                                        <table class="table history-table scrollable-table-body">
                                                            <tbody>
                                                                <?php foreach ($bank_accounts as $row) {
																	$i++;
																	
																	 ?>
                                                                 <tr>
<td class="col-xs-1 col-sm-1 col-md-1"><?php echo $i; ?></td>

<td class="col-xs-1 col-sm-1 col-md-1"><?php echo $row['account_no']; ?></td>
<td class="col-xs-1 col-sm-1 col-md-1"><?php echo $row['account_title']; ?></td>
<td class="col-xs-1 col-sm-1 col-md-1"><?php echo $row['swift_code']; ?></td>
<td class="col-xs-1 col-sm-1 col-md-1"><?php echo $row['bank_name']; ?></td>
<td class="col-xs-1 col-sm-1 col-md-1"><?php echo $row['bank_branch']; ?></td>
<td class="col-xs-1 col-sm-1 col-md-1"><?php echo $row['date_created']; ?></td>
                                                                               
                                                                                
                                                                                
                                                                            </tr>  
                                                                   
                                                                <?php }?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                <?php } else { ?>
                                                    <?php echo adminRecordNotFoundMsg(); ?>
                                                <?php } ?>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>          
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
            </div>
        </section>
        <!-- page end-->
    </section>
</section>
<script type="text/javascript">
    function show_business_field(role){
        if($(role).val() == 2){
            $('#businessname_div').show();
        }else{
            $('#businessname_div').hide();
        }
    }
</script>