<?php
    $currentUserData = getUserData(getCurrentUserId());
    $countries = $this->comman_model->get('countries');
?>
<script>
function SendReply(){
	
	if($('#message').val()==''){
		alert("Please enter some message");return false;
		}
	$.ajax({
            url:'<?php echo base_url('frontend/users/SendReply'); ?>',
            type:'post',
            data:   {   
					'message': $('#message').val(),
					'user_id_to': $('#user_id_to').val(),
					'id': $('#parent_message_id').val()
                    },
			success:function(response){
				
			if(response == 'success'){
				
				alert("Message sent successfully.");
				location.reload();
				return false;
				}else{
					alert("There is some error.");
				}
				
				}
        });
		
    
}

</script>
<style>
	.importdbookstbl{
	
    padding: 9px !important;
    text-align: left !important;
    text-indent: 4px;
    vertical-align: middle !important;
    width: 180px;	
	}
	
</style>

<div class="col-xs-12">
    <div class="frontend-dashboard-cont">
        <div class="row no-padding">
            <div class="col-sm-12 col-xs-12">

                <section style="padding-bottom: 50px; padding-top: 50px;">

                   

                    <!--dashbord start-->
                    <div class="dashbord_inno">
                        <div class="container">
                           

                            
                          
                            
                            
                            <div style="clear:both; height:30px;"></div>
                            

                            <div class="clearfix"></div>
          	
            
                            <div class="row">
                                <div class="col-lg-12 co-md-12 col-sm-12">
                                    <div class="order_table">
                                        <h2>Chat
										
										<?php //echo getlanguage('cash_outs'); ?></h2>
                                        <div class="order_content">
                                            <div class="col-lg-12 co-md-12 col-sm-12">
  
                                            <strong>Order Id: </strong><?php echo $parent_message_details['unique_order_id'];?><br>

                                            <strong>Category: </strong><?php echo $parent_message_details['category'];?>
<br>
                                            <strong>Subject: </strong><?php echo $parent_message_details['title'];?>
<br>
                                            <strong>Message: </strong><?php echo $parent_message_details['message'];?>
                                            
                                                
                                                <?php if($my_replies) {
													?>
													  <ol class="chat">
  <?php
  foreach($my_replies as $row){
	  $user_to = $this->comman_model->get("user",array("user_id"=>$row['user_id_to']));
	  $user_from = $this->comman_model->get("user",array("user_id"=>$row['user_id_from']));
	  if($row['user_id_from']==getCurrentUserId()){
	  ?>
	    <li class="other">
        <div class="avatar"><img src="http://i.imgur.com/DY6gND0.png" draggable="false"/></div>
      <div class="msg">
        <p><?php echo $row["message"];?></p>
        
        <time><?php echo $row['created_on'];?></time>
      </div>
      
    </li>
    <?php }else{ ?>
        <li class="self">
            <div class="avatar"><img src="http://i.imgur.com/HYcn9xO.png" draggable="false"/></div>
          <div class="msg">
            <p><?php echo $row["message"];?></p>
            
            <time><?php echo $row["created_on"];?></time>
          </div>
        </li>
  
	  <?php
	}
	  }
  ?>
  </ol>
													<?php												
													} else { ?>
                                                    <?php echo adminRecordNotFoundMsg(); ?>
                                                <?php } ?>
                                                
                                                 <div style="clear:both; height:30px;"></div>
                                                
                                                
    
  <input type="hidden" name="id" id="parent_message_id" value="<?php echo $parent_message_details['id'];?>" />
  <input type="hidden" name="user_id_to" id="user_id_to" value="<?php echo $parent_message_details['user_id_to'];?>" />
    
    <input class="textarea" id="message" name="message" type="text" placeholder="Type here!"/>  
  <button type="button" onClick="SendReply()" id="send_reply" class="btn btn-primary pull-right" style="margin-bottom:20px; padding-left:20px; padding-right:20px; border-radius:50px;">Send</button>
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                
                                
                                </div>
                            </div>
          		
                        </div>
                    </div>
                    <!--dashbord end-->
                </section>
            </div>
        </div>
    </div>
</div>


<style>
@import url(http://fonts.googleapis.com/css?family=Lato:100,300,400,700);
@import url(http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css);

html, body {
    font-family: 'Lato', sans-serif;
    margin: 0px auto;
}
::selection{
  background: rgba(82,179,217,0.3);
  color: inherit;
}
a{
  color: rgba(82,179,217,0.9);
}

/* M E N U */

.order_table {
    border: 1px solid #ddd;
    box-shadow: 0 2px 8px #555;
    padding: 10px 20px;
    margin-bottom: 20px;
}
.order_content strong{
    padding:0px 7px 0px 20px !important;
}

.menu {
    position: fixed;
    top: 0px;
    left: 0px;
    right: 0px;
    width: 100%;
    height: 50px;
    background: rgba(82,179,217,0.9);
    z-index: 100;
    -webkit-touch-callout: none;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
}

.back {
    position: absolute;
    width: 90px;
    height: 50px;
    top: 0px;
    left: 0px;
    color: #fff;
    line-height: 50px;
    font-size: 30px;
    padding-left: 10px;
    cursor: pointer;
}
.back img {
    position: absolute;
    top: 5px;
    left: 30px;
    width: 40px;
    height: 40px;
    background-color: rgba(255,255,255,0.98);
    border-radius: 100%;
    -webkit-border-radius: 100%;
    -moz-border-radius: 100%;
    -ms-border-radius: 100%;
    margin-left: 15px;
    }
.back:active {
    background: rgba(255,255,255,0.2);
}
.name{
    position: absolute;
    top: 3px;
    left: 110px;
    font-family: 'Lato';
    font-size: 25px;
    font-weight: 300;
    color: rgba(255,255,255,0.98);
    cursor: default;
}
.last{
    position: absolute;
    top: 30px;
    left: 115px;
    font-family: 'Lato';
    font-size: 11px;
    font-weight: 400;
    color: rgba(255,255,255,0.6);
    cursor: default;
}

/* M E S S A G E S */

.chat {
    list-style: none;
    background: none;
    margin: 0;
    padding: 20px 0 50px 0;
    margin-top: 0px;
    margin-bottom: 10px;
}
.chat li {
    padding: 0.5rem;
    overflow: hidden;
    display: flex;
}
.chat .avatar {
    width: 40px;
    height: 40px;
    position: relative;
    display: block;
    z-index: 2;
    border-radius: 100%;
    -webkit-border-radius: 100%;
    -moz-border-radius: 100%;
    -ms-border-radius: 100%;
    background-color: rgba(255,255,255,0.9);
}
.chat .avatar img {
    width: 40px;
    height: 40px;
    border-radius: 100%;
    -webkit-border-radius: 100%;
    -moz-border-radius: 100%;
    -ms-border-radius: 100%;
    background-color: rgba(255,255,255,0.9);
    -webkit-touch-callout: none;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
}
.chat .day {
    position: relative;
    display: block;
    text-align: center;
    color: #c0c0c0;
    height: 20px;
    text-shadow: 7px 0px 0px #e5e5e5, 6px 0px 0px #e5e5e5, 5px 0px 0px #e5e5e5, 4px 0px 0px #e5e5e5, 3px 0px 0px #e5e5e5, 2px 0px 0px #e5e5e5, 1px 0px 0px #e5e5e5, 1px 0px 0px #e5e5e5, 0px 0px 0px #e5e5e5, -1px 0px 0px #e5e5e5, -2px 0px 0px #e5e5e5, -3px 0px 0px #e5e5e5, -4px 0px 0px #e5e5e5, -5px 0px 0px #e5e5e5, -6px 0px 0px #e5e5e5, -7px 0px 0px #e5e5e5;
    box-shadow: inset 20px 0px 0px #e5e5e5, inset -20px 0px 0px #e5e5e5, inset 0px -2px 0px #d7d7d7;
    line-height: 38px;
    margin-top: 5px;
    margin-bottom: 20px;
    cursor: default;
    -webkit-touch-callout: none;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
}

.other .msg {
    background: #e5e5e5;
    margin: 10px 10px 10px 10px;
    order: 1;
    border-top-left-radius: 0px;
    box-shadow: -1px 2px 0px #D4D4D4;
}
.other:before {
    content: "";
    
    position: relative;
    top: 10px;
    right: 0px;
    left: 50px;
    width: 0px;
    height: 0px;
    border: 5px solid #e5e5e5;
    border-left-color: transparent;
    border-bottom-color: transparent;
}

.self {
    justify-content: flex-end;
    align-items: flex-end;
}
.self .msg {
    order: 1;
    border-bottom-right-radius: 0px;
    box-shadow: 1px 2px 0px #D4D4D4;
}
.self .avatar {
    order: 2;
}
.self .avatar:after {
    content: "";
    position: relative;
    display: inline-block;
    bottom: 19px;
    right: 0px;
    width: 0px;
    height: 0px;
    border: 5px solid #fff;
    border-right-color: transparent;
    border-top-color: transparent;
    box-shadow: 0px 2px 0px #D4D4D4;
}

.msg {
    background: white;
    min-width: 50%;
    padding: 10px;
    border-radius: 2px;
    box-shadow: 0px 2px 0px rgba(0, 0, 0, 0.07);
}
.msg p {
    font-size: 18px;
    margin: 0 0 0.2rem 0;
    color: #777;
}
.msg img {
    position: relative;
    display: block;
    width: 450px;
    border-radius: 5px;
    box-shadow: 0px 0px 3px #eee;
    transition: all .4s cubic-bezier(0.565, -0.260, 0.255, 1.410);
    cursor: default;
    -webkit-touch-callout: none;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
}
@media screen and (max-width: 800px) {
    .msg img {
    width: 300px;
}
}
@media screen and (max-width: 550px) {
    .msg img {
    width: 200px;
}
}

.msg time {
    font-size: 0.7rem;
    color: #ccc;
    margin-top: 3px;
    float: right;
    cursor: default;
    -webkit-touch-callout: none;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
}
.msg time:before{
    content:"\f017";
    color: #ddd;
    font-family: FontAwesome;
    display: inline-block;
    margin-right: 4px;
}

emoji{
    display: inline-block;
    height: 18px;
    width: 18px;
    background-size: cover;
    background-repeat: no-repeat;
    margin-top: -7px;
    margin-right: 2px;
    transform: translate3d(0px, 3px, 0px);
}
emoji.please{background-image: url(http://imgur.com/ftowh0s.png);}
emoji.lmao{background-image: url(http://i.imgur.com/MllSy5N.png);}
emoji.happy{background-image: url(http://imgur.com/5WUpcPZ.png);}
emoji.pizza{background-image: url(http://imgur.com/voEvJld.png);}
emoji.cryalot{background-image: url(http://i.imgur.com/UUrRRo6.png);}
emoji.books{background-image: url(http://i.imgur.com/UjZLf1R.png);}
emoji.moai{background-image: url(http://imgur.com/uSpaYy8.png);}
emoji.suffocated{background-image: url(http://i.imgur.com/jfTyB5F.png);}
emoji.scream{background-image: url(http://i.imgur.com/tOLNJgg.png);}
emoji.hearth_blue{background-image: url(http://i.imgur.com/gR9juts.png);}
emoji.funny{background-image: url(http://i.imgur.com/qKia58V.png);}

@-webikt-keyframes pulse {
  from { opacity: 0; }
  to { opacity: 0.5; }
}

::-webkit-scrollbar {
    min-width: 12px;
    width: 12px;
    max-width: 12px;
    min-height: 12px;
    height: 12px;
    max-height: 12px;
    background: #e5e5e5;
    box-shadow: inset 0px 50px 0px rgba(82,179,217,0.9), inset 0px -52px 0px #fafafa;
}

::-webkit-scrollbar-thumb {
    background: #bbb;
    border: none;
    border-radius: 100px;
    border: solid 3px #e5e5e5;
    box-shadow: inset 0px 0px 3px #999;
}

::-webkit-scrollbar-thumb:hover {
    background: #b0b0b0;
  box-shadow: inset 0px 0px 3px #888;
}

::-webkit-scrollbar-thumb:active {
    background: #aaa;
  box-shadow: inset 0px 0px 3px #7f7f7f;
}

::-webkit-scrollbar-button {
    display: block;
    height: 26px;
}

/* T Y P E */

input.textarea {
    bottom: 0px;
    left: 0px;
    right: 0px;
    width: 100%;
    height: 50px;
    z-index: 99;
    background: #fafafa;
    border: none;
    outline: none;
    padding-left: 55px;
    padding-right: 55px;
    color: #666;
    font-weight: 400;
	border-radius:20px;
	margin-bottom:20px;
}

.emojis:active {
    opacity: 0.9;
}            
</style>