<div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
    	<div class="modal-content">
      		<div class="modal-header login_modal_header">
        		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        		<h2 class="modal-title" id="myModalLabel">
        		<span class="glyphicon glyphicon-plus"></span> Login to Your Account
        		</h2>
      		</div>
      		<div class="modal-body login-modal">
			<div id="login-flip" class="">
      			<br/>
      			<div class="clearfix"></div>
      			<div id='social-icons-conatainer'>
	        		<div class='modal-body-left'>
					<form action="#" id="login-form">
	        			<div class="form-group">
		              	<input type="email" id="username" name="username" placeholder="Enter Email Id" value="" class="form-control login-field" required>
		            	</div>
		            	<div class="form-group">
			            	<input type="password" id="password" name="password" placeholder="Password" value="" class="form-control login-field" required>
		            	</div>
		
		            	<button type="submit" href="#" class="btn btn-success modal-login-btn" id="login-btn">Login</button>
						<div id="login-form-error" class="text-center"></div>
					</form>
					<a href="#" class="pull-right" id="lost">Lost your password?</a>
          <form action="#" id="lostform" class="none">
          <input type="email" id="lostpassword" name="lostpassword" placeholder="Enter email id" class="form-control login-field" required>
          <br>
            <button class="btn btn-xs btn-success" id="lostpasswordbtn">Send email</button>
            <span id="resetres" class="h5"></span>
          </form>
	     </div>
	        <!--
	        		<div class='modal-body-right'>
	        			<div class="modal-social-icons">
	        				<a href='#' class="btn btn-default facebook"> <i class="fa fa-facebook modal-icons"></i> FB Login </a>
	        				<a href='#' class="btn btn-default google"> <i class="fa fa-google-plus modal-icons"></i> G+ Login </a>
							<div class="recover" id="recover">
							<form action="#" method="post" id="rec">
							<input type="email" name="email" class="form-control form-control-cust margin-top-5" placeholder="Recovery Email Address" required id="emailbox"/>
							<input type="submit" value="Send Recovery mail" class="btn btn-primary btn-block" />
							</form>
							</div>
							<span id="recres"></span>
	        			</div> 
	        		</div>
	        		<div id='center-line'> OR </div>-->
	        	</div>
        		<div class="clearfix"></div>
        		</div>
		
				<div id="reg-flip" class="hide">
					
          <form action="#" id="register-form">
    				<div class="form-group">
              <input type="email" id="email" name="email" placeholder="Enter Email Id" value="" class="form-control login-field" />
    		    </div>
						<div class="form-group">
		         	<input type="text" id="reg-first-name" name="reg-first-name" placeholder="First Name (only a-z characters)" value="" class="form-control login-field" pattern="^[a-zA-Z ]*$" data-validation="required" data-validation-length="5-15" />
		        </div>
						<div class="form-group">
          	  	<input type="text" id="reg-last-name" name="reg-last-name" placeholder="Last Name (only a-z characters)" value="" class="form-control login-field" pattern="^[a-zA-Z ]*$" data-validation="required" data-validation-length="5-15" />
          	</div>
          	<div class="form-group">
          	  	<input type="password" id="reg-password" name="reg-password" placeholder="Password" value="" class="form-control login-field" data-validation="required" data-validation-length="5-15" />
          	</div>
						<button type="submit" href="#" class="btn btn-success" id="signup-btn">Sign Up</button>
            <button type="reset" href="#" class="btn btn-warning">Reset form</button>
            <!-- modal-login-btn -->
						<div id="reg-form-error" class="text-center"></div>
            </form>
				</div>
				
        		<div class="form-group modal-register-btn">
        			<button class="btn btn-default"  id="flipper">New User Please Register</button>
        		</div>
      		</div>
      		<div class="clearfix"></div>
      		<div class="modal-footer login_modal_footer">
      		</div>
    	</div>
  	</div>
</div>
<!--
<div id="vote" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
         	   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            	<h4 class="modal-title text-center">Vote For Your Team</h4>
        	</div>
			<div class="modal-body">
				<div class="progress">
					<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:65%">
					    65% Votes
					  </div>
					</div>
			</div>
            <div class="modal-footer">
				<span class="pull-left">Refresh this page to view voting</span>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
$('#login-form').submit(function(e){
  $('#login-btn').attr('disabled','true');
	$('#login-form-error').html('<img src="<?=site_url()?>public/img/fb_load.gif" class="text-center" />');
    $.post('<?=site_url()?>user/login',{username:$('#username').val(),password:$('#password').val()},function(data){
      if(data=="1"){
      	$('#login-form-error').html('<span class="text-center text-success">Login Success</span>');
      	window.open("<?=site_url()?>user/welcome",'_self');
      }else{
      	$('#login-form-error').html('<span class="text-danger">Wrong Username / Password</span>');
      }
      $('#login-btn').removeAttr('disabled');
    });
    e.preventDefault();
  });
  
  $('#lost').click(function(){
    $('#lostform').toggleClass('none');
  });

  $('#lostform').submit(function(e){
    $('#lostpasswordbtn').attr('disabled','true');
    $.ajax({
      url:'<?=site_url()?>welcome/recover',
      data:$(this).serializeArray(),
      method:"POST",
      success :function(data){
        //alert(data);
        $('#resetres').html(data);
        $('#lostpasswordbtn').removeAttr('disabled');
        document.getElementById("lostform").reset();
      }
    });
    e.preventDefault();
  });

  $('#register-form').validate({
    rules:{
      "email":{
        required:true,
        email:true,
      },
      "reg-first-name":{
        required:true,
        lettersonly:true,
        minlength: 5
      },
      "reg-last-name":{
        required:true,
        lettersonly:true,
        minlength: 5
      },
      "reg-password":{
        required:true,
        minlength: 7
      }
    },
    messages:{
      "email":{
        required : "20overs.com need a email address to verify your account",
        email : "Please enter a valid email address"
      },
      "reg-first-name":{
        lettersonly:"You entered unwanted characters. Please remove"
      },
      "reg-last-name":{
        lettersonly:"You entered unwanted characters. Please remove"
      },
      "reg-password":{
        minlength:"Password should be atleast 7 characters long"
      }
    },
    submitHandler: function (form) {
      $.ajax({
      url:'<?=site_url()?>welcome/register',
      data:$("#register-form").serializeArray(),
      method:"POST",
      success :function(data){
        if(data.error == 1){
          $('#signup-btn').removeAttr('disabled');
          $('#reg-form-error').html(data.message);
          $('#register-form').reset();
        }else{
          $('#reg-form-error').html(data.message);
          $('#signup-btn').removeAttr('disabled');
        }
      },
      error: function(){
        $('#reg-form-error').html("<font color='red'>Confirmation mail already sent.</font>");
        $('#signup-btn').removeAttr('disabled');
      }
      });
      return false;
    }
  });
  /*$('#register-form').submit(function(e){
     var charReg = "^[a-zA-Z ]*$";
    if($('#email').val().trim()=="" || $('#email').val().trim().length < 10){
      $('#reg-form-error').html("<span class='text text-danger h4'>Email should be more than 10 characters.</span>");
    }else if($('#reg-first-name').val().trim() == "" || $('#reg-first-name').val().trim().length < 5){
      $('#reg-form-error').html("<span class='text text-danger h4'>First name should 5 characters long and only characters allowed.</span>");
    }else if($('#reg-last-name').val().trim() == "" || $('#reg-last-name').val().trim().length < 5 ){
      $('#reg-form-error').html("<span class='text text-danger h4'>Last name should 5 characters long and only characters allowed.</span>");
    }else if($('#reg-password').val().trim() == "" || $('#reg-password').val().trim().length < 8 ){
      $('#reg-form-error').html("<span class='text text-danger h4'>Password should atleast 8 characters long.</span>");
    }
    else
    {
    $('#signup-btn').attr('disabled','true');
    $('#reg-form-error').html('<img src="<?=site_url()?>public/img/fb_load.gif" class="text-center" />');
      $.ajax({
      url:'<?=site_url()?>welcome/register',
      data:$("#register-form").serializeArray(),
      method:"POST",
      success :function(data){
        if(data.error == 1){
          $('#signup-btn').removeAttr('disabled');
          $('#reg-form-error').html(data.message);
          $('#register-form').reset();
        }else{
          $('#reg-form-error').html(data.message);
          $('#signup-btn').removeAttr('disabled');
        }
      },
      error: function(){
        $('#reg-form-error').html("<font color='red'>Confirmation mail already sent.</font>");
        $('#signup-btn').removeAttr('disabled');
      }
      });
    }
    e.preventDefault();
  });

	$('#scountry').change(function(e){
    var id = $(this).val();
    var opt="<option value=''>Select state</option>";
    $.post('<?=site_url()?>user/get_states/',{id:id},function(data){
        var obj = jQuery.parseJSON(data);
        $.each( obj, function( key, value ) {
            opt += "<option value='"+value.stateid+"'>"+value.name+"</option>";
        });
        $('#sstate').html(opt);
        $('#scity').html("<option value=''>Select city</option>");
    });
    e.preventDefault();
  });
*/
  $('#sstate').change(function(){
    var opt="<option value=''>Select city</option>";
    $.post('<?=site_url()?>user/get_cities/',{country:$('#scountry').val(),state:$(this).val()},function(data){
        var obj = jQuery.parseJSON(data);
        $.each( obj, function( key, value ) {
            opt += "<option value='"+value.id+"'>"+value.city_name+"</option>";
        });
        $('#scity').html(opt);
    });

  });
</script>

-->