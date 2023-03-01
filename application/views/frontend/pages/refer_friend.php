<div class="col-xs-12">
    <div class="container">
    <div class="row no-padding  col-lg-offset-3">
      <h2>친구추천</h2>
      <div class="clear30"></div>
       <div class="col-md-8 col-xs-12">
             <?php if(isset($errors)){?><div class="alert alert-danger" style="font-size:16px; margin-top:10px;"> <?php print_r($errors); ?></div><?php }?>
                    <?php if(isset($success)){?><div class="alert alert-success" style="font-size:16px; margin-top:10px;"> <?php print_r($success); ?></div><?php }?>

           <form action="<?php echo base_url('refer_friend');?>" method="post">
                    <label>Email Address</label>
                    <input type="text" placeholder="Enter Email Address" name="email" class="form-control" value="<?php echo set_value('email');?>">
                    <div class="clear20"></div>
                    <label>메시지</label>
                    <textarea name="message" cols="" placeholder="메시지" class="form-control" rows="8"><?php echo set_value('message');?></textarea>
                     <br>
                    <input type="submit" class="btn btn-success pull-left" value="추천">
                    <div class="clear35"></div>
                  <a class=" col-xs-6 pull-left no-padding" href="<?php echo base_url('reffered_friend');?>">추천된친구</a>
                    <br><br>
           </form>    
                </div>
        
    </div> </div>
</div>