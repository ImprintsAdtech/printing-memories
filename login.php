<?php

session_start();

include_once("conf/loadconfig.inc.php");

include_once("facebook_login/config.php");

include_once("googleplus_login/config.php");

include_once("facebook_login/includes/functions.php");

extract($_POST);

extract($_GET);

if($code != ""){

	header('Location: '.DEFAULT_URL.'/');

}

if(!isset($_SESSION['userId']) && $_SESSION['userId'] == ""){

?>

<!DOCTYPE html>

<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Printmysnap - Free Photos for Lifetime | Login</title>
<?php 
		include('includes/common_css.php');
		include('includes/header.php');
?>

<?php /*?><script>
  // This is called with the results from from FB.getLoginStatus().
  function statusChangeCallback(response) {
    console.log('statusChangeCallback');
    console.log(response);
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
      // Logged into your app and Facebook.
      testAPI();
    } else {
      // The person is not logged into your app or we are unable to tell.
    }
  }

  // This function is called when someone finishes with the Login
  // Button.  See the onlogin handler attached to it in the sample
  // code below.
  function checkLoginState() {
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });
  }

  window.fbAsyncInit = function() {
  FB.init({
    appId      : '195127497568686',
    cookie     : true,  // enable cookies to allow the server to access 
                        // the session
    xfbml      : true,  // parse social plugins on this page
    version    : 'v2.8' // use graph api version 2.8
  });

  FB.getLoginStatus(function(response) {
    statusChangeCallback(response);
  });

  };

  // Load the SDK asynchronously
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));

  // Here we run a very simple test of the Graph API after login is
  // successful.  See statusChangeCallback() for when this call is made.
  function testAPI() {
   // console.log('Welcome!  Fetching your information.... ');
    //FB.api('/me', function(response) {
		
	FB.api('/me', {fields: 'name, first_name, last_name, email, gender, picture'}, function(response) {
		
		var name=response.first_name;
		var email=response.email;
		var outh_id=response.id;
		var last_name=response.last_name;
		var gender=response.gender;
		var picture=response.picture;
		var image=response.image;
		
		$.ajax({
              type: "POST",
              url: "<?php echo DEFAULT_URL ?>/fb_login_ajax.php",
              data: {loginwith:"facebook", name:name, email:email, outh_id:outh_id, last_name:last_name, gender:gender, picture:picture, image:image}, 
			  success: function(responseText) {
				if(responseText !='' && responseText == 'fblogin_first'){
				   location.href='https://www.printmysnap.com/'; 	
				}else if(responseText !='' && responseText == 'fblogin'){
					
					location.href='https://www.printmysnap.com/'; 
					
				}
	
			  }
        
            });
			
		//console.log('Successful login for: ' + response.name );
		
    });
  }
  

</script>

<?php */?>
<div class="cp-inner-banner">
  <div class="container">
    <div class="cp-inner-banner-outer">
      <h2>Login to Your Account</h2>
      
      <!--<ul class="breadcrumb">

                <li><a href="<?=DEFAULT_URL?>">Home</a></li>

                <li class="active">Login</li>

            </ul>--> 
      
    </div>
  </div>
</div>
<div class="cp-main-content">
  <section class="cp-signup-section pd-tb60">
    <div class="container">
      <div class="cp-signup-form cp-login-form">
        <form id="login-form" class="login-form">
          <?php 

                    $ref = "";

                    if(isset($_GET["ref"]) && !empty($_GET["ref"])){

                        $ref = $_GET["ref"];

                    ?>
          <input type="hidden" value="<?php echo $ref; ?>" name="ref" id="ref">
          <?php    

                    }

                    ?>
          <div class=" col-lg-6 col-md-6 col-sm-12">
            <div class="input-field">
              <ul class="cp-social-links2">
              
              <input type="hidden" id="checkClick" name="checkClick" value="not_redirect">
              <li class="fb-btn">
                                                    <a id="loginBtn" href="#" class="loginfacebook 222">
                                                    <i class="fa fa-facebook"></i>
                                                    <span>Facebook Login</span>
                                                    </a>
                                                    </li>
                                                    
			  <?php /*?><img id="loginBtn" src="https://www.printmysnap.com/images/facebook_login.png" height="35" width="220" style="margin-bottom:4px; cursor:pointer;" /><?php */?>

             <?php /*?> <fb:login-button scope="public_profile,email" onlogin="checkLoginState();"></fb:login-button><?php */?>
              
                <?php 

/*                                    $a=0; 
                                    if(!$fbuser){

                                        $fbuser = null;

                                        $loginUrl = $facebook->getLoginUrl(array('redirect_uri'=>$homeurl,'scope'=>$fbPermissions));

                                        $output = '<li class="fb-btn">
                                                    <a href="'.$loginUrl.'" class="loginfacebook 111">
                                                    <i class="fa fa-facebook"></i>
                                                    <span>Facebook Login</span>
                                                    </a>
                                                    </li>';

                                    } else {
										
										//echo "hello";
										
										//exit;

                                        $fbuser = null;

                                        $loginUrl = $facebook->getLoginUrl(array('redirect_uri'=>$homeurl,'scope'=>$fbPermissions));

                                        $output = '<li class="fb-btn">
                                                    <a href="'.$loginUrl.'" class="loginfacebook 222">
                                                    <i class="fa fa-facebook"></i>
                                                    <span>Facebook Login</span>
                                                    </a>
                                                    </li>';

                                        $a++;

                                        $user_profile = $facebook->api('/me?fields=id,first_name,last_name,email,gender,locale,picture');

                                        $user = new Users();

                                        $user_data = $user->checkUser('facebook',$user_profile['id'],$user_profile['email'],$user_profile['first_name'],$user_profile['last_name'],$user_profile['gender'],$user_profile['picture']['data']['url'], $a);
										
										mysql_query("INSERT INTO `check_login` (`login_via`, `created_datetime`) VALUES ('fb', '2017-03-29 00:00:00')");
                                    }

                                    echo $output;*/

                                    if(isset($_REQUEST['code'])){

                                        $gClient->authenticate();

                                        $_SESSION['token'] = $gClient->getAccessToken();

                                        //header('Location: ' . filter_var($redirect_url, FILTER_SANITIZE_URL));

                                    }

                                    if (isset($_SESSION['token'])) {

                                        $gClient->setAccessToken($_SESSION['token']);

                                    }

                                    if ($gClient->getAccessToken()) {

                                        $userProfile = $google_oauthV2->userinfo->get();

                                        //DB Insert

                                        $gUser = new Users();

                                        $gUser->checkUser('google',$userProfile['id'],$userProfile['email'],$userProfile['given_name'],$userProfile['family_name'],$userProfile['gender'],$userProfile['picture']);

                                        $_SESSION['token'] = $gClient->getAccessToken();
										
										mysql_query("INSERT INTO `check_login` (`login_via`, `extra_data`) VALUES ('google', '".print_r($_POST['gUser'])."')");

                                        $authUrl = $gClient->createAuthUrl();

                                    } else {

                                        $authUrl = $gClient->createAuthUrl();

                                    }



                                    if(isset($authUrl)) {

                                        echo ' <li class="google-btn">

                                                <a href="'.$authUrl.'">

                                                    <i class="fa fa-google-plus"></i>

                                                    <span>Google Plus Login</span>

                                                    </a>

                                                    </li>';

                                    }

                                    ?>
              </ul>
              <p class="text-center">Or</p>
              <p class="text-center" style="margin-bottom:10px">Create a Printmysnap account</p>
              <p class="text-center"><a href="<?php echo DEFAULT_URL ?>/signup" class="btn-submit hwite" style="width:70%; background:#3b5998;">SignUp</a></p>
            </div>
          </div>
          <div class=" col-lg-6 col-md-6 col-sm-12">
            <div class="clearfix"></div>
            <div class="col-md-12">
              <div class="input-field"> <i class="fa fa-user prefix"></i>
                <input id="login_phone" tabindex="1"  name="login_phone" type="text" required class="validate">
                <label>Phone Number</label>
              </div>
            </div>
            <div class="col-md-12">
              <div class="input-field"> <i class="fa fa-unlock prefix"></i>
                <input id="login_password" tabindex="2" name="login_password" type="password" class="validate" required>
                <label>Password</label>
              </div>
            </div>
            <div class="col-md-12">
              <div class="login_message error_msg displaynone" id="login_message">Invalid Phone Number or password</div>
              <div class="login_err error_msg displaynone" id="login_err">Your account is deactivated.</div>
              <div class="login_err error_msg displaynone" id="login_err_invalid">Invalid Account.</div>
            </div>
            <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
              <div class="input-field checkbox" style="margin-bottom:10px !important;">
                <label>
                  <input type="checkbox">
                  keep me logged in </label>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
              <div class="input-field btn-holder">
                <input type="hidden" name="action" value="check_login" />
                <button  id="btn_login" tabindex="3" type="button" class="btn-submit btn_login" value="Submit">Login</button>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-12 col-sm-12"> <strong class="login-btn"> <a href="<?=DEFAULT_URL?>/forgot-password">Forgot Password</a></strong>
              <?php /*?><strong class="login-btn">Don't have an Account? <a href="<?=DEFAULT_URL?>/signup">Signup NOW</a></strong><?php */?>
              <br>
            </div>
          </div>
          <div class="col-md-12 col-sm-12">
            <?php /*?><strong class="login-btn">Don't have an Account? <a href="<?=DEFAULT_URL?>/signup">Signup NOW</a></strong><?php */?>
          </div>
        </form>
      </div>
    </div>
  </section>
</div>
<a style="display:none;" id="viewmodal_login" data-toggle="modal" data-target="#otp-popup-login" href="javascript:void(0)">otp</a>
<div class="modal fade" id="otp-popup-login" role="dialog">
  <div class="modal-dialog"> 
    
    <!-- Modal content-->
    
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Please enter otp</h4>
      </div>
      <div class="modal-body">
        <form id="otp-form">
          <div class="form-group">
            <div class="col-md-12">
              <div class="input-field"> <i class="fa fa-phone-square prefix"></i>
                <input type="text" placeholder="OTP" id="userOTP-login" name="userOTP-login" class="validate" required>
                <label>Enter OTP</label>
              </div>
            </div>
            <input type="hidden" id="userId-login" name="userId-login" class="form-control">
          </div>
          <div class="col-sm-12 controls" style="padding-left:0px !important; margin-top:10px;">
            <div class="login_message error_msg" id="otp_errors_login"></div>
            <button class="btn-submit" href="javascript:void(0)" id="btn_register_otp_login" type="button"><i class="glyphicon glyphicon-log-in"></i> Submit</button>
          </div>
        </form>
        <div class="clearfix"></div>
      </div>
      
      <!-- <div class="modal-footer">

            <button type="button" class="btn-submit" data-dismiss="modal">Close</button>

            </div>--> 
      
    </div>
  </div>
</div>
<?php
	include('includes/footer.php');
	include('includes/common_js.php');
	include('includes/home_script.php');
?>
<script>
$(document).ready(function(){
/*facebook login code*/

	$(document).on('click', '#loginBtn', function(e){
		document.getElementById("checkClick").value='redirect';	
	});

	

	 function testAPI() {
    	console.log('Welcome!  Fetching your information.... ');
    	FB.api('/me?fields=id,first_name,last_name,email,gender,locale,picture', function(response) {

      	response['loginwith'] = 'facebook';
		
		var name=response.first_name;
		var email=response.email;
		var outh_id=response.id;
		var last_name=response.last_name;
		var gender=response.gender;
		var picture=response.picture;
		var image=response.image;


      	var responseJson = JSON.stringify(response);

    	var dd = document.getElementById("checkClick").value;

		if(dd != '' && dd =='redirect'){

		$.ajax({

			type: "POST",

			url: "<?php echo DEFAULT_URL ?>/fb_login_ajax.php",

			data: {loginwith:"facebook", name:name, email:email, outh_id:outh_id, last_name:last_name, gender:gender, picture:picture, image:image}, 

			success: function(responseData) {

				if(responseData != '' && responseData == 'fblogin'){
					window.location = 'https://www.printmysnap.com/';	

				}
			}

		  });

		}

	});

  }

	
	function statusChangeCallback(response) {

		console.log('statusChangeCallback');
		console.log(response);

		if (response.status === 'connected') {
			testAPI();

		} else if (response.status === 'not_authorized') {
			document.getElementById('status').innerHTML = 'Please log into this app.';
		} else {
			document.getElementById('status').innerHTML = 'Please log into Facebook.';
		}
	}

	window.fbAsyncInit = function() {

		FB.init({
		appId      : '195127497568686',
		cookie     : true,   
		xfbml      : true,  
		version    : 'v2.5' 

		});
		FB.getLoginStatus(function(response) {
			statusChangeCallback(response);
		});

	};


	(function(d, s, id) {

		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) return;
		js = d.createElement(s); js.id = id;

		js.src = "https://connect.facebook.net/en_US/sdk.js";
		fjs.parentNode.insertBefore(js, fjs);
	  }(document, 'script', 'facebook-jssdk'));

	  
	$('#loginBtn').click(function(){
		FB.login(function(response) {
        if (response.authResponse) {
            testAPI();
        }
      }, {scope: 'email,user_friends', return_scopes: true});

	});

	/*end facebook login code*/

});

</script>
<?php

} else {
	header('Location: '.DEFAULT_URL);	
}
?>
