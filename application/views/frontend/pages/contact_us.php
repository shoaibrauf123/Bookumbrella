<div class="col-sm-8 col-sm-offset-3">
    <div class="container">
        <div class="row no-padding  col-lg-offset-3 contact_body">
            <h2>Contact Us</h2>

            <div class="clear10"></div>
            <div class="col-md-8 col-xs-12 no-padding">
                <?php if (isset($errors)) { ?>
                    <div class="alert alert-danger"
                         style="font-size:16px; margin-top:10px;"> <?php print_r($errors); ?></div><?php } ?>
                <?php if (isset($success)) { ?>
                    <div class="alert alert-success"
                         style="font-size:16px; margin-top:10px;"> <?php print_r($success); ?></div><?php } ?>

                <div class="list-group-item">
                <form action="<?php echo base_url('contact_us'); ?>" method="post">
                   <label>Email Address</label>
                    <input type="text" placeholder="Enter Email Address" name="email" class="form-control"
                           value="<?php echo set_value('email'); ?>">

                    <div class="clear20"></div>
                    <label>Subject</label>
                    <input type="text" placeholder="Subject" name="subject" class="form-control"
                           value="<?php echo set_value('subject'); ?>">


                    <div class="clear20"></div>
                    <label>Message</label>
                    <textarea name="message" cols="" placeholder="Message" class="form-control"
                              rows="6"><?php echo set_value('message'); ?></textarea>
                    <br>
                    
                    
                </div>
                <footer class="panel-footer footer_contact">
                    <input type="submit" class="btn btn-success pull-right" value="Send"/>
</form>
                    </footer></div>
            

        </div>
    </div>
</div>
 <div class="clear20"></div>