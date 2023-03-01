<!--footer start-->
<footer class="site-footer">
    <div class="text-center">
        &COPY; All Rights Reserved
        <a href="#" class="go-top">
            <i class="fa fa-angle-up"></i>
        </a>
    </div>

</footer>
<!--footer end-->
</section>

<div class="loading-overlay products-import-loader-cont hide-content">
    <div class="products-import-loading-content">
        <img class="loader-img" src="<?php echo base_url('assets/admin/img/mega-loader.gif') ?>">
        <img class="success-img hide-content" src="<?php echo base_url('assets/admin/img/success-mark.png') ?>">
        <img class="warning-img hide-content" src="<?php echo base_url('assets/admin/img/warning-mark.png') ?>">
        <img class="error-img hide-content" src="<?php echo base_url('assets/admin/img/error-mark.png') ?>">
        <p class="content-loading-msg">Importing products, please wait a moment...</p>
    </div>
</div>

<!-- js placed at the end of the document so the pages load faster -->
<script src="<?php echo base_url('assets/admin'); ?>/js/bootstrap.min.js"></script>
<script class="include" type="text/javascript" src="<?php echo base_url('assets/admin'); ?>/js/jquery.dcjqaccordion.2.7.js"></script>
<script src="<?php echo base_url('assets/admin'); ?>/js/jquery.scrollTo.min.js"></script>
<script src="<?php echo base_url('assets/admin'); ?>/js/jquery.nicescroll.js" type="text/javascript"></script>
<script src="<?php echo base_url('assets/admin'); ?>/js/respond.min.js"></script>

<!--custom switch-->
<script src="<?php echo base_url('assets/admin'); ?>/js/bootstrap-switch.js"></script>
<!--custom tagsinput-->
<script src="<?php echo base_url('assets/admin'); ?>/js/jquery.tagsinput.js"></script>
<!--custom checkbox & radio-->
<script type="text/javascript" src="<?php echo base_url('assets/admin'); ?>/js/ga.js"></script>

<!-- form validation script file -->
<script type="text/javascript" src="<?php echo base_url('assets/admin'); ?>/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets/admin'); ?>/js/form-validation-script.js"></script>

<script type="text/javascript"
        src="<?php echo base_url('assets/admin'); ?>/assets/bootstrap-fileupload/bootstrap-fileupload.js"></script>
<script type="text/javascript"
        src="<?php echo base_url('assets/admin'); ?>/assets/bootstrap-wysihtml5/wysihtml5-0.3.0.js"></script>
<script type="text/javascript"
        src="<?php echo base_url('assets/admin'); ?>/assets/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>
<script type="text/javascript"
        src="<?php echo base_url('assets/admin'); ?>/assets/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript"
        src="<?php echo base_url('assets/admin'); ?>/assets/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<script type="text/javascript"
        src="<?php echo base_url('assets/admin'); ?>/assets/bootstrap-daterangepicker/moment.min.js"></script>
<script type="text/javascript"
        src="<?php echo base_url('assets/admin'); ?>/assets/bootstrap-daterangepicker/daterangepicker.js"></script>
<script type="text/javascript"
        src="<?php echo base_url('assets/admin'); ?>/assets/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
<script type="text/javascript"
        src="<?php echo base_url('assets/admin'); ?>/assets/bootstrap-inputmask/bootstrap-inputmask.min.js"></script>
<!--<script src="--><?php //echo base_url('assets/admin'); ?><!--/js/form-component.js"></script>-->
<script type="text/javascript" language="javascript"
        src="<?php echo base_url('assets/admin'); ?>/assets/advanced-datatable/media/js/jquery.dataTables.js"></script>
<script type="text/javascript"
        src="<?php echo base_url('assets/admin'); ?>/assets/data-tables/DT_bootstrap.js"></script>
<!--common script for all pages-->
<script src="<?php echo base_url('assets/admin'); ?>/js/common-scripts.js"></script>

<!-- JS file for multi selection -->
<script type="text/javascript"
        src="<?php echo base_url('assets/admin'); ?>/assets/jquery-multi-select/js/jquery.multi-select.js"></script>
<script type="text/javascript"
        src="<?php echo base_url('assets/admin'); ?>/assets/jquery-multi-select/js/jquery.quicksearch.js"></script>

<!-- JS file for color picker -->
<!--<script type="text/javascript" src="--><?php //echo base_url('assets/admin'); ?><!--/js/chromoselector.min.js"></script>-->

<!-- JS FOR HICHARTS - USER STATISTICS -->
<script src="http://code.highcharts.com/highcharts.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>
<script src="http://code.jquery.com/ui/1.9.1/jquery-ui.js"></script>
<!-- END HERE HICHARTS - USER STATISTICS -->

<script src="//cdn.ckeditor.com/4.5.4/standard/ckeditor.js"></script>

<script>
    if ($('#single-page-editor').length > 0) {
        CKEDITOR.replace('single-page-editor');
    }
</script>

<!-------------------------------------------------------------------------------------->

<script>
    $(function(){
        $('.color-picker').colorpicker();
    });
</script>

<script type="text/javascript" charset="utf-8">
    $(document).ready(function () {

        $('.color-picker').colorpicker();

        $('#admin_manage_listing').dataTable({
            "aaSorting": [[4, "desc"]]
        });

        // JS code to remove other extra html elements
        $('#admin_manage_listing_length').parent('div').css("display", "none");
        $('#admin_manage_listing_filter').parent('div').removeClass('span6');
        $('#admin_manage_listing_filter').parent('div').addClass('col-sm-12');
        $('#admin_manage_listing_filter').parent('div').after('<br>');
        <?php if($this->uri->segment(3) != 'view_payment_summary'){ ?>
            $('.dataTables_paginate.paging_bootstrap.pagination').parent('div').css('display', "none");
        <?php } ?> 

        $('.delete-button').bind('click', function () {
            var c = confirm("Are you sure?");
            if (c) {
                return true;
            }
            else {
                return false;
            }
        });
    });

</script>

<script>
    function delete_object(url) {
        var c = window.confirm("Are you sure, you want to remove it?");
        if (c) {
            window.location = url;
        }
    }
    function isDecimalValue(evt)
    {
        var charCode = (evt.which) ? evt.which : evt.keyCode;

        if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57)){
            return false;
        } else {
            return true;
        }
    }
</script>

</body>
</html>
