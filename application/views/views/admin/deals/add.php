<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">

            <header class="panel-heading">
                <label for="menu_label">Create User</label>
            </header>

            <div class="panel-body">
                <div class="row col-md-offset-1">
                    <div class="col-md-12">
                        <?php $this->load->view('errors'); ?>

                        <form action="<?php echo base_url('admin/users/add'); ?>" id="create_user" role="form" method="post" enctype="multipart/form-data">
                            <div class="form-group col-md-8">
                                <label for="name">First Name *</label>
                                <input type="text" value="<?php echo set_value('first_name') ?>" class="form-control" placeholder="First Name" id="first_name" name="first_name" required>
                                <span class="error_signup"><?php echo form_error('first_name'); ?></span>
                            </div>

                            <div class="form-group col-md-8">
                                <label for="name">Last Name *</label>
                                <input type="text" value="<?php echo set_value('last_name') ?>" class="form-control" placeholder="Last Name" id="last_name" name="last_name" required>
                                <span class="error_signup"><?php echo form_error('last_name'); ?></span>
                            </div>

                            <div class="form-group col-md-8">
                                <label for="name">Username *</label>
                                <input type="text" value="<?php echo set_value('username') ?>" class="form-control" placeholder="Username" id="username" name="username" required>
                                <span class="error_signup"><?php echo form_error('username'); ?></span>
                            </div>

                            <div class="form-group col-md-8">
                                <label for="email">Email *</label>
                                <input type="email" value="<?php echo set_value('email'); ?>" class="form-control"  placeholder="Enter Email Address" id="email" name="email" required>
                                <span class="error_signup"><?php echo form_error('email'); ?></span>
                            </div>

                            <div class="form-group col-md-8">
                                <label for="gender">Gender *</label>
                                <select class="form-control" name="gender" id="gender" required>
                                    <option value="">Select Gender</option>
                                    <option value="male" <?php echo (set_value('gender') == 'male')? 'selected="selected"' : ''; ?>>Male</option>
                                    <option value="female" <?php echo (set_value('gender') == 'female')? 'selected="selected"' : ''; ?>>Female</option>
                                </select>
                                <span class="error_signup"><?php echo form_error('gender'); ?></span>
                            </div>

                            <div class="form-group col-md-8">
                                <label for="gender">Role *</label>
                                <select class="form-control" name="role_id" id="role_id" required>
                                    <option value="">Select Role</option>
                                    <?php if($user_roles){ foreach($user_roles as $role){ ?>
                                        <option <?php echo (set_value('role_id') == $role['role_id'])? 'selected="selected"' : ''; ?> value="<?php echo $role['role_id']; ?>"><?php echo $role['title']; ?></option>
                                    <?php } } ?>
                                </select>
                                <span class="error_signup"><?php echo form_error('role_id'); ?></span>
                            </div>

                            <div class="form-group col-md-8">
                                <label for="password">Password *</label>
                                <input type="password" class="form-control" id="password" placeholder="Enter Password" name="password" required>
                                <span class="error_signup"><?php echo form_error('password'); ?></span>
                            </div>

                            <div class="form-group col-md-8">
                                <label for="password_confirm">Repeat Password *</label>
                                <input id="password_confirm" type="password" class="form-control"  placeholder="Repeat Password" name="password_confirm" required>
                                <span class="error_signup"><?php echo form_error('password_confirm'); ?></span>
                            </div>

                            <div class="col-md-8">
                                <input type="submit" class="btn btn-shadow btn-primary" value="Create User">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!-- page end-->
    </section>
</section>