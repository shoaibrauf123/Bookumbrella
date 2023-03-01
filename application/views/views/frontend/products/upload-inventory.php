<style>
  .btn-primary{
     background: #bb9870 !important;
	color: rgb(255, 255, 255) !important;
  border:none !important;
  border-radius:2px !important;
  transition: all 0.5s;
  }

  .btn-primary:hover{
     background: #323232 !important ;
  color:#fff !important;
  }
</style>

<?php
    $currentUserData = getUserData(getCurrentUserId());
?>

<div class="col-xs-12">
    <div class="frontend-dashboard-cont">
        <div class="row no-padding">
            <div class="col-sm-5 col-xs-12 col-sm-offset-3">

                <section style="padding-bottom: 50px; padding-top: 50px;">

                    <?php if (isset($errors)) { ?>
                        <div class="alert alert-danger"> <?php print_r($errors); ?></div><?php } ?>
                    <?php if (isset($success)) { ?>
                        <div class="alert alert-success"> <?php print_r($success); ?></div><?php } ?>

                    <!--dashbord start-->
                    <div class="dashbord_inno ">
                        <div class="container">
                            
                            
                          <h3 class="pull-left">Upload Inventory</h3>  
                            
                            <div class="userinfo col-sm-12 dashbox padding0">
                <div class="control-group">
                    <div class="controls span2">
                        <form id="" action="<?php echo base_url("upload_inventory")?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                        <input type="hidden" name="do_upload" value="yes" />
                            <div class="import-form-fields">
                   
                                    
                                    <div style="margin-bottom:3px; color:#000;"><strong>Select file import (*.csv | *xls)</strong></div>
                                    <div class="form-group">
    <input type="file" name="img[]" class="file">
    <div class="input-group col-xs-12">
      
      <input type="text" class="form-control input-lg" style="padding-left:90px;" disabled placeholder="Upload File">
      <span class="input-group-btn pull-left" style="margin-top:-46px; border-radius:0px !important;">
        <button class="browse btn btn-primary input-lg btn_browse" type="button" style="border-radius:0px !important;"> Browse</button>
      </span>
    </div>
  </div>
                                    
                                    
                                    
                              
                            </div>
                            <div>
                                <p class="pull-left" style="color:#000;font-weight:bold;margin-bottom:0px;">
                                    <a href="<?php echo base_url("uploads/files/seller/samples/Demo book upload.xlsx")?>" style="color:#000;" download="">Sample File(Click here to download the sample file)</a>
                                </p>
                                <br /><br />
                                <p class="pull-left" style="color:#000;font-weight:bold;margin-bottom:0px;">
                                    Mandatory Columns in Sample File to be filled:
                                </p>

                                <br>
                                <div style="clear:both; height:10px;"></div>

                                <p style="margin-bottom:0px;">
                                 <div style="clear:both; height:10px;"></div>
								                 <strong style="color: #000; font-size:16px;">1) Add/Modify/Delete: </strong>
                                <div style="clear:both; height:10px;"></div>

                                <strong>A -</strong> <strong style="color: #000 !important;">Add a new product.</strong> <div style="clear:both; height:10px;"></div>

                                <strong>M -</strong> <strong style="color: #000 !important;;">Update your product.</strong> <div style="clear:both; height:10px;"></div>

                                <strong>D -</strong> <strong style="color: #000 !important;">Delete your product. </strong> <div style="clear:both; height:10px;"></div>
                                
                                
                                
                                <strong style="color: #000;font-size:16px;">2) Product Code Type: </strong> <div style="clear:both; height:10px;"></div>

                                <strong style="color: #000 !important;">1 - Use for UPC CODE.</strong> <div style="clear:both; height:10px;"></div>

                                <strong style=" color: #000 !important;">2 - Use for ISBN NUMBER. </strong><div style="clear:both; height:10px;"></div>

                                
								</p>
                                <button type="submit" class="btn btn-primary pull-left">Submit</button>
                                 <div style="clear:both; height:30px;"></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
                            
                            
                            
                            

                            <div class="clearfix"></div>

                            

                        </div>
                    </div>
                    <!--dashbord end-->
                </section>
            </div>
        </div>
    </div>
</div>



<style>
.file {
  visibility: hidden;
  position: absolute;
}































/*
 * Styles for demo only
 */


.btn.btn-primary {
  background-color: $purple;
  border-color: $purple;
  outline: none;
  &:hover {
    background-color: darken($purple, 10%);
    border-color: darken($purple, 10%);
  }
  &:active, &:focus {
    background-color: lighten($purple, 5%);
    border-color: lighten($purple, 5%);
  }
.btn_browse{
	border-radius:0px !important;
}
.input-group .form-control:last-child, .input-group-addon:last-child, .input-group-btn:first-child > .btn-group:not(:first-child) > .btn, .input-group-btn:first-child > .btn:not(:first-child), .input-group-btn:last-child > .btn, .input-group-btn:last-child > .btn-group > .btn, .input-group-btn:last-child > .dropdown-toggle
{
		border-radius:0px !important;
}
</style>
<script>
$(document).on('click', '.browse', function(){
  var file = $(this).parent().parent().parent().find('.file');
  file.trigger('click');
});
$(document).on('change', '.file', function(){
  $(this).parent().find('.form-control').val($(this).val().replace(/C:\\fakepath\\/i, ''));
});
</script>