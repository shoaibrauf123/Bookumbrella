<?php
    $cashback_data = $cashbacks;
    $currentUserData = getUserData(getCurrentUserId());
?>
<style type="text/css">
    .sell_item_container{
        border: 1px solid #000;
    }
    .sell_item_header{
        background-color: #eeeeee;
        font-size: 18px;
        font-weight: bold;
        padding: 10px;
    }
    .sell_item_detail{
        padding: 10px;
    }
     a.btn.btn-cart {
    background: #bb9870;
    color: #fff;
    border-radius: 3px;
    }
    a.btn.btn-cart:hover {
    background: #323232;
    color: #fff;

    }
</style>
<div class="col-xs-12">
    <div class="container frontend-dashboard-cont">
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
                            <div class="dashbord_inno_form">
                              <h3 class="pull-left">Add Book</h3>  
                              <div class="clearfix"></div>
                              
                              <div class="form-group">
                                  Enter Book
                                  <input type="text"name="title" id="title" class="form-control" placeholder="Enter book ISBN,title,author or publisher">
                              </div> 
                              <a class="btn btn-cart" type="button" onClick="get_product()" href="javascript:;" title="Search">Search</a>
                            </div>
                            <div class="row">
                                <div id="loadView"></div>
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



function numeric_value(inputtxt)
   {  
   		

            if (inputtxt === parseInt(inputtxt, 10))
    alert("data is integer")
else
    alert("data is not an integer")
			return false;
		
      var numbers = /^[0-9]+$/;  
	  
	  
      if(!inputtxt.value.match(numbers))  
      {   
	  
          //document.getElementById('message').innerHTML= "Only numbers are allowed";
		  alert("Only numbers are allowed");return false;
        
      }  
      else if(inputtxt.value.length < 10  || inputtxt.value.length > 13) 
      {  
         //document.getElementById("message").innerHTML="You can enter numbers for length 10 or 13";
		 alert("You can enter numbers for length 10 or 13");return false;
      }  
      else
      {
         //document.getElementById('message').innerHTML="you put right values";
      }
   }  
    function get_product(){
		var isbn = '';
		var title = jQuery("#title").val();
        var title = title.trim();
		if(title==''){
			
			alert("Please enter some text in the box.");
			return false;
			}
		
		
		
        if(isbn != '' || title != ''){
            $.ajax({
              type: "POST",
              url: '<?php echo base_url('load_sell_item'); ?>',
              data: {isbn:isbn,title:title},
              dataType: 'json',
              /*timeout: 6000,*/
              error: function (request, error) {
                jQuery('#loadView').html('There is an error.Try Again').show();
              },
              success: function (response) {
                  //response = jQuery.parseJSON(response);
					//alert(response.success);return false;
				  
				  if(response.number_check!=''){
					  alert(response.number_check);
					  return false;
					  }
				  if (response.success) {
                    jQuery('#loadView').html(response.view).show();
                  }else{
                    jQuery('#loadView').html(response.view).show();
                  }
              }
            });//End ajax
        }
    }
</script>