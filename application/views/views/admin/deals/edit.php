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

                            <div class="col-md-8">
                                <input type="submit" class="btn btn-shadow btn-primary" value="Update User">
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!-- page end-->
    </section>
</section>