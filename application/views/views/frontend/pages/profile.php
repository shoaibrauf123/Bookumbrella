<?php
    $currentUserData = getUserData(getCurrentUserId());
    $countries = $this->comman_model->get('countries');
?>

<style>
	.importdbookstbl{
	
    padding: 9px !important;
    text-align: left !important;
    text-indent: 4px;
    vertical-align: middle !important;
    width: 180px;	
	}
	.myacuntblock{
	
    margin: 0 2px 10px;
    min-height: 250px;
    padding: 0 0 8px;
	}
	.my-account-tab-btns
	{
		margin-top:20px;
		margin-bottom:20px;
	}
	.my-account-tab-btns ul h2 {
  background:#4B2354;
    color: #ffffff !important;
    font-size: 18px;
    font-weight: 600;
    margin:0 0 2px;
    padding: 20px 0;
    text-align: center;
    text-shadow: 2px 2px 7px #000000;
	}
.my-account-tab-btns ul li {

    padding: 2px 0;
    
}
.my-account-tab-btns ul li a {
 background: #f9f9f9 none repeat scroll 0 0;
    border-radius: 0;
    color: #857d7d !important;
    padding: 20px 15px;
    text-shadow: 2px 3px 3px #b5b5b5;
	 

}
.my-account-tab-btns ul li i {

display: inline-block;
    float: left;
    font-size: 33px;
    text-align: left;
    
}
.my-account-tab-btns ul li h3 {
   display: inline-block;
    font-size: 13px;
    margin: 12px 5px 3px 0;
    text-align: left;
	line-height:20px;
    
}
.box_myaccount1
{
	width:20%;
	float:left;
}
.box_you_order
{
	border-radius:5px;
	border:solid 1px #dddddd;
	padding:10px;
	color:#000;
	font-size:16px;
}
.box_you_order:hover
{	
border:solid 1px #ff5b53;
}
.box_you_order h2
{

	color:#000;
	font-size:24px;
	margin-top:0px;
}

input.btn.btn-warning.profile_mobile {
  background:#bb9870!important;
  color:#fff;
  font-weight:500 !important;
  padding:8px 25px;
  border:none !important;
  border-radius: 3px !important;
}
input.btn.btn-warning.profile_mobile:hover{
  background: #323232 !important; 
}


@media (min-width: 320px) and (max-width: 800px) {
.box_myaccount1
{
	width:100%;
}	
	
}
</style>

<div class="col-xs-12">
    <div class="frontend-dashboard-cont">
        <div class="row no-padding">
            <div class="col-sm-12 col-xs-12">

                <section style="padding-bottom: 50px; padding-top: 50px;">

                    <?php if (isset($errors)) { ?>
                        <div class="alert alert-danger"> <?php print_r($errors); ?></div><?php } ?>
                    <?php if (isset($success)) { ?>
                        <div class="alert alert-success"> <?php print_r($success); ?></div><?php } ?>

                    <!--dashbord start-->
                    <div class="dashbord_inno">
                        <div class="container">                  
                            
                            <div class="row">
                                <div class="col-lg-12 co-md-12 col-sm-12 cashback-block">
                                    <div class="order_table">
                                        

                                        <div class="order_content" style="margin-top: 2px;">

                                            
        <div class="inner-content">
                <div class="col-xs-12 col-sm-12 col-md-12 margin-top-20">
                    <form id="dashboard-update-profile" method="post">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="text-center" id="pic_form">
                                    <div id="profile_picture"><img class="img-rounded img-responsive display-inline" id="profile_img" src="<?php echo get_user_avatar(); ?>" style="height: 209px;margin-bottom: 10px;"></div>
                                        <div id="upload_pic_status"></div>
                                    </div>
                                    
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label title=""><?php echo getlanguage('email');?> *</label>
                                        <input id="dashboard-user-email" type="text" placeholder="User Email" class="form-control" value="<?php echo $currentUserData['email']; ?>" name="email" required>
                                    </div>
                                    <div class="form-group">
                                        <label title=""><?php echo getlanguage('country');?> *</label>
                                        <select id="dashboard-user-country" class="form-control" name="country">
                                            <option value="">Select Country</option>
                                            <?php if($countries){
                                                foreach ($countries as $country) {
                                                    $selected = '';
                                                    if($currentUserData['country'] == $country['country_name'])
                                                        $selected = 'selected="selected"';
                                                    echo '<option '.$selected.' value="'.$country['country_name'].'">'.$country['country_name'].'</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="alert alert-info hide">
                                        <h2 style="margin-top:0px;"><?php echo $this->session->userdata('first_name').' '.$this->session->userdata('last_name');?> </h2>
                                    </div>
                                    <!-- <h3 class="margin0">Set password</h3>
                                    <div class="form-group margin-top-45">
                                        <label>Current Password</label>
                                        <input type="password" name="current_password" class="form-control" required>
                                    </div> -->
                                    <!-- <div class="form-group">
                                        <label>New Password</label>
                                        <input type="password" name="password" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Confirm Password</label>
                                        <input type="password" name="password_confirm" class="form-control" required>
                                    </div> -->
                                </div>
                                <div class="clearfix"></div>
                                <hr class="normal-hr">
                                <div class="col-xs-12 col-sm-12 col-md-12 margin-bottom-10">
                                    <div class="col-xs-12 col-sm-7 col-md-7 pull-left text-left padding0 update-prof-response-cont">
                                        <div class="alert alert-danger custom-side-aligned-alert">
                                            Required fields are missing or have some invalid information
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-3 col-md-3 pull-right text-right padding0">
                                        <img class="profile-update-loader" src="<?php echo base_url('assets/frontend/img/atomic-loader.gif'); ?>">
                                        <input type="submit" class="btn btn-warning profile_mobile" value="Update"/>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <input type="hidden" name="user_id" value="<?php echo $currentUserData['user_id'];?>">
                        </form>
                        <!-- ROW END -->
                    </div>
                </div>
    </div>

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

<script type="application/javascript">
    $('body').on('submit','#dashboard-update-profile',function(e){

        e.preventDefault();

        var actionUrl = '<?php echo base_url('update_user_profile');?>';
        var formData = $(this).serializeArray();
        console.log(formData);
        var loaderObj = $('.profile-update-loader');
        var responseMsgCont = $('.update-prof-response-cont');

        resetProfileUpdateResponse();

        $.ajax({
            url:actionUrl,
            type:'post',
            data:formData,
            success:function(response){
//                console.log(response);return;

                var decodedResponse = $.parseJSON(response);
                var dialogueDisplayTime = 7000;

                loaderObj.hide();
                responseMsgCont.show();

                if(decodedResponse){
                    var respMsg = decodedResponse['msg'];
                    var respStatus = decodedResponse['status'];

                    responseMsgCont.show();
                    responseMsgCont.find('.alert').text(respMsg);

                    if(respStatus){
                        responseMsgCont.find('.alert').addClass('alert-success');
                        $('#dashboard-update-profile').find('input[name="current_password"]').val('');
                        $('#dashboard-update-profile').find('input[name="password"]').val('');
                        $('#dashboard-update-profile').find('input[name="password_confirm"]').val('');
                    } else {
                        responseMsgCont.find('.alert').addClass('alert-danger');
                    }

                    setTimeout(function(){
                        responseMsgCont.hide('medium');
                    }, dialogueDisplayTime);
                }
            }
        });
    });

    function resetProfileUpdateResponse(){
        var responseMsgCont = $('.update-prof-response-cont');
        var loaderObj = $('.profile-update-loader');

        loaderObj.show();
        responseMsgCont.hide();

        responseMsgCont.find('.alert').removeClass('alert-danger alert-success');
    }
</script>