
<aside>
    <div id="sidebar" class="nav-collapse ">
        <!--sidebar menu start-->
        <ul class="sidebar-menu" id="nav-accordion">

            <li>
                <a <?php if ($page == "dashboard") echo 'class="active"'; ?> href="<?php echo base_url('admin/'); ?>">
                    <i class="fa fa-dashboard"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <?php if (in_array(17, $this->session->userdata('admin_rights'))) { ?>
                <li class="sub-menu">
                    <a href="javascript:;" <?php if (strpos($view_path, "users")) {
                        echo 'class="active"';
                    } ?> >
                        <i class="fa fa-users"></i>
                        <span>Manage Users</span>
                    </a>
                    <ul class="sub" <?php if (strpos($view_path, "users")) { ?> style="display: block;" <?php } ?>>
                        <li <?php if (strpos($view_path, "users") && $page == "" || $page == "index") echo 'class="active"'; ?>>
                            <a href="<?php echo base_url('admin/users'); ?>">Manage Users</a></li>
                        <?php if (in_array(16, $this->session->userdata('admin_rights'))) { ?>
                            <li <?php if (strpos($view_path, "users") && $page == "add") echo 'class="active"'; ?>><a
                                    href="<?php echo base_url('admin/users/add'); ?>">Create User</a></li>
                        <?php } ?>
                    </ul>
                </li>
            <?php } ?>

<?php if (in_array(8, $this->session->userdata('admin_rights'))) { ?>
                <!--<li class="sub-menu">
                    <a href="javascript:;" <?php if (strpos($view_path, "stores")) {
                        echo 'class="active"';
                    } ?> >
                        <i class="fa fa-building"></i>
                        <span>Manage Stores</span>
                    </a>
                    <ul class="sub" <?php if (strpos($view_path, "stores")) { ?> style="display: block;" <?php } ?>>
                        <li <?php if (strpos($view_path, "stores") && $page == "" || $page == "index") echo 'class="active"'; ?>>
                            <a href="<?php echo base_url('admin/stores'); ?>">Manage Stores</a></li>
                        <?php if (in_array(7, $this->session->userdata('admin_rights'))) { ?>
                            <li <?php if (strpos($view_path, "stores") && $page == "add") echo 'class="active"'; ?>><a
                                    href="<?php echo base_url('admin/stores/add'); ?>">Create Store</a></li>
                        <?php } ?>
                    </ul>
                </li>-->
            <?php } ?>
            <?php if (in_array(4, $this->session->userdata('admin_rights'))) { ?>
                <li class="sub-menu">
                    <a href="javascript:;" <?php if (strpos($view_path, "categories")) {
                        echo 'class="active"';
                    } ?> >
                        <i class="fa fa-tags"></i>
                        <span>Manage Categories</span>
                    </a>
                    <ul class="sub" <?php if (strpos($view_path, "categories")) { ?> style="display: block;" <?php } ?>>
                        <li <?php if (strpos($view_path, "categories") !== -1 && $page == "" || $page == "index") echo 'class="active"'; ?>>
                            <a href="<?php echo base_url('admin/categories'); ?>">Manage Categories</a></li>
                        <?php if (in_array(3, $this->session->userdata('admin_rights'))) { ?>

                            <li <?php if (strpos($view_path, "categories") && $page == "add") echo 'class="active"'; ?>>
                                <a
                                    href="<?php echo base_url('admin/categories/add'); ?>">Create Category</a></li>
                        <?php } ?>
                    </ul>
                </li>
            <?php } ?>

            <?php if (in_array(6, $this->session->userdata('admin_rights'))) { ?>
                <li class="sub-menu">
                    <a href="javascript:;" <?php if (strpos($view_path, "products")) {
                        echo 'class="active"';
                    } ?> >
                        <i class="fa fa-cart-plus"></i>
                        <span>Manage Books</span>
                    </a>
                    <ul class="sub" <?php if (strpos($view_path, "products")) { ?> style="display: block;" <?php } ?>>
                        <li <?php if (strpos($view_path, "products") && $page == "" || $page == "index") echo 'class="active"'; ?>>
                            <a href="<?php echo base_url('admin/products'); ?>">Manage Books</a></li>
                        <?php if (in_array(5, $this->session->userdata('admin_rights'))) { ?>
                            <li <?php if (strpos($view_path, "products") && $page == "add") echo 'class="active"'; ?>><a
                                    href="<?php echo base_url('admin/products/add'); ?>">Create Book</a></li>
                        <?php } ?>
                         <li <?php if (strpos($view_path, "products") && $page == "upload_products") echo 'class="active"'; ?>><a
                                    href="<?php echo base_url('admin/products/upload'); ?>">Upload Books</a></li>
                                    
                         
                           <li <?php if (strpos($view_path, "products") && $page == "seller_rejections") echo 'class="active"'; ?>><a
                                    href="<?php echo base_url('admin/products/seller_rejections'); ?>">Failed Uploads</a></li>           
                                    
                                    
                    </ul>
                </li>
            <?php } ?>





 <?php if (in_array(6, $this->session->userdata('admin_rights'))) { ?>
                <li class="sub-menu">
                    <a href="javascript:;" <?php if (strpos($view_path, "orders")) {
                        echo 'class="active"';
                    } ?> >
                        <i class="fa fa-cart-plus"></i>
                        <span>Manage Orders</span>
                    </a>
                    <ul class="sub" <?php if (strpos($view_path, "orders")) { ?> style="display: block;" <?php } ?>>
                        <li <?php if (strpos($view_path, "orders") && $page == "" || $page == "index") echo 'class="active"'; ?>>
                            <a href="<?php echo base_url('admin/orders'); ?>">Manage Orders</a></li>


                    </ul>
                </li>
            <?php } ?>
            
            
            <?php if (in_array(6, $this->session->userdata('admin_rights'))) { ?>
                <li class="sub-menu">
                    <a href="javascript:;" <?php if (strpos($view_path, "view_payment_summary")) {
                        echo 'class="active"';
                    } ?> >
                        <i class="fa fa-cart-plus"></i>
                        <span>Manage Payments</span>
                    </a>
                    <ul class="sub" <?php if (strpos($view_path, "view_payment_summary")) { ?> style="display: block;" <?php } ?>>
                        <li <?php if (strpos($view_path, "view_payment_summary") && $page == "" || $page == "index") echo 'class="active"'; ?>>
                            <a href="<?php echo base_url('admin/users/view_payment_summary'); ?>">Payment Summary</a></li>


                    </ul>
                </li>
            <?php } ?>
            
            



            

            <?php if (in_array(10, $this->session->userdata('admin_rights'))) { ?>
                <li class="sub-menu">
                    <a href="javascript:;" <?php if (strpos($view_path, "pages")) {
                        echo 'class="active"';
                    } ?> >
                        <i class="fa fa-file"></i>
                        <span>Manage Pages</span>
                    </a>
                    <ul class="sub" <?php if (strpos($view_path, "pages")) { ?> style="display: block;" <?php } ?>>
                        <li <?php if (strpos($view_path, "pages") && $page == "" || $page == "index") echo 'class="active"'; ?>>
                            <a href="<?php echo base_url('admin/pages'); ?>">Manage Pages</a></li>
                        <?php if (in_array(9, $this->session->userdata('admin_rights'))) { ?>
                            <li <?php if (strpos($view_path, "pages") && $page == "add") echo 'class="active"'; ?>><a
                                    href="<?php echo base_url('admin/pages/add'); ?>">Create Page</a></li>

                        <?php } ?>
                    </ul>
                </li>
            <?php } ?>



        <?php if (in_array(10, $this->session->userdata('admin_rights'))) { ?>
                <li class="sub-menu">
                    <a href="javascript:;" <?php if (strpos($view_path, "coupon")) {
                        echo 'class="active"';
                    } ?> >
                        <i class="fa fa-file"></i>
                        <span>Manage Coupons</span>
                    </a>
                    <ul class="sub" <?php if (strpos($view_path, "pages")) { ?> style="display: block;" <?php } ?>>
                        <li <?php if (strpos($view_path, "coupon") && $page == "" || $page == "index") echo 'class="active"'; ?>>
                            <a href="<?php echo base_url('admin/coupon'); ?>">Manage Coupons</a></li>
                        <?php if (in_array(9, $this->session->userdata('admin_rights'))) { ?>
                            <li <?php if (strpos($view_path, "coupon") && $page == "add") echo 'class="active"'; ?>><a
                                    href="<?php echo base_url('admin/coupon/add'); ?>">Create Coupon</a></li>

                        <?php } ?>
                    </ul>
                </li>
            <?php } ?>



        <?php if (in_array(10, $this->session->userdata('admin_rights'))) { ?>
                <li class="sub-menu">
                    <a href="javascript:;" <?php if (strpos($view_path, "ratings")) {
                        echo 'class="active"';
                    } ?> >
                        <i class="fa fa-file"></i>
                        <span>Manage Ratings</span>
                    </a>
                    <ul class="sub" <?php if (strpos($view_path, "pages")) { ?> style="display: block;" <?php } ?>>
                        <li <?php if (strpos($view_path, "ratings") && $page == "" || $page == "index") echo 'class="active"'; ?>>
                            <a href="<?php echo base_url('admin/ratings'); ?>">Manage Ratings</a></li>
                       
                    </ul>
                </li>
            <?php } ?>


       <?php if (in_array(10, $this->session->userdata('admin_rights'))) { ?>
                <li class="sub-menu">
                    <a href="javascript:;" <?php if (strpos($view_path, "ratings")) {
                        echo 'class="active"';
                    } ?> >
                        <i class="fa fa-file"></i>
                        <span>Manage Author</span>
                    </a>
                    <ul class="sub" <?php if (strpos($view_path, "pages")) { ?> style="display: block;" <?php } ?>>
                        <li <?php if (strpos($view_path, "author") && $page == "" || $page == "index") echo 'class="active"'; ?>>
                            <a href="<?php echo base_url('admin/author'); ?>">Author</a></li>
                            <?php if (in_array(5, $this->session->userdata('admin_rights'))) { ?>
                            <li <?php if (strpos($view_path, "products") && $page == "add") echo 'class="active"'; ?>><a
                                    href="<?php echo base_url('author_add'); ?>">Create Author</a></li>
                        <?php } ?>                       
                    </ul>
                </li>
            <?php } ?>   

          
            
            
            

            

            <!--multi level menu end-->
        </ul>


        <!-- sidebar menu end-->
    </div>
</aside>
