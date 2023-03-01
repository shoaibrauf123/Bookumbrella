<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">

            <header class="panel-heading">
                <label for="menu_label">Create Coupon</label>
            </header>

            <div class="panel-body">
                <div class="row col-md-offset-1">
                    <div class="col-md-12">
                        <?php $this->load->view('errors'); ?>

                        <form action="<?php echo base_url('admin/coupon/add'); ?>" id="create_user" role="form" method="post" enctype="multipart/form-data">
                            <div class="form-group col-md-8">
                                <label for="name">Coupon *</label>
                                <input type="text" value="<?php echo set_value('coupon') ?>" class="form-control" placeholder="Discount Coupon" id="coupon" name="coupon" required>
                                <span class="error_signup"><?php echo form_error('coupon'); ?></span>
                            </div>

                            <div class="form-group col-md-8">
                                <label for="name">Percentage *</label>
                                <input type="text" value="<?php echo set_value('percentage') ?>" class="form-control" placeholder="Discont percentage" id="percentage" name="percentage" required>
                                <span class="error_signup"><?php echo form_error('percentage'); ?></span>
                            </div>

                            <div class="col-md-8">
                                <input type="submit" class="btn btn-shadow btn-primary" value="Create Coupon">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!-- page end-->
    </section>
</section>