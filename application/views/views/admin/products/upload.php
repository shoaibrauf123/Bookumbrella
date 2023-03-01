<?php
    $uri = 0;
    if($this->uri->segment(3) != ''){
        $uri = $this->uri->segment(3);
    }
?>
<section id="main-content">
    <section class="wrapper site-min-height">
        <section class="panel">
            <header class="panel-heading">
                Upload Books
            </header>
            <?php $this->load->view('errors'); ?>
            
			
            
            
            <h3 class="pull-left">Upload Inventory</h3>  
                            
                            <div class="userinfo col-sm-12 dashbox padding0">
                <div class="control-group">
                    <div class="controls span2">
                        <form id="" action="<?php echo base_url('admin/products/upload'); ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                            <div class="import-form-fields">
                                <div class="form-group">
                                    <label for="name">Select file to import: (*.csv | *.xls)</label>
                                    <input type="file" class="form-control" name="import_pay_file" required>
                                </div>
                            </div>
                            <div>
                                <p class="pull-left"><a href="<?php echo base_url("uploads/files/samples/Demo book upload.xlsx")?>" download="">Download sample file</a></p>
                                <button type="submit" class="btn btn-primary pull-right">Submit</button>
                                <div class="clearfix"></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
            
            
            </section>
    </section>
</section>