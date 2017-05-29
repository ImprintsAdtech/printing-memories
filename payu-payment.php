
<?php
// Merchant key here as provided by Payu
$MERCHANT_KEY = "JBZaLc";

// Merchant Salt as provided by Payu
$SALT = "GQs7yium";

// End point - change to https://secure.payu.in for LIVE mode
$PAYU_BASE_URL = "https://test.payu.in";

$action = '';

$posted = array();
if(!empty($_POST)) {
    //print_r($_POST);
  foreach($_POST as $key => $value) {    
    $posted[$key] = $value; 
	
  }
}

$formError = 0;

if(empty($posted['txnid'])) {
  // Generate random transaction id
  $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
} else {
  $txnid = $posted['txnid'];
}
$hash = '';
// Hash Sequence
$hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
if(empty($posted['hash']) && sizeof($posted) > 0) {
  if(
          empty($posted['key'])
          || empty($posted['txnid'])
          || empty($posted['amount'])
          || empty($posted['firstname'])
          || empty($posted['email'])
          || empty($posted['phone'])
          || empty($posted['productinfo'])
          || empty($posted['surl'])
          || empty($posted['furl'])
		  || empty($posted['service_provider'])
  ) {
    $formError = 1;
  } else {
    //$posted['productinfo'] = json_encode(json_decode('[{"name":"tutionfee","description":"","value":"500","isRequired":"false"},{"name":"developmentfee","description":"monthly tution fee","value":"1500","isRequired":"false"}]'));
	$hashVarsSeq = explode('|', $hashSequence);
    $hash_string = '';	
	foreach($hashVarsSeq as $hash_var) {
      $hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
      $hash_string .= '|';
    }

    $hash_string .= $SALT;


    $hash = strtolower(hash('sha512', $hash_string));
    $action = $PAYU_BASE_URL . '/_payment';
  }
} elseif(!empty($posted['hash'])) {
  $hash = $posted['hash'];
  $action = $PAYU_BASE_URL . '/_payment';
}
?>
<?php
include_once("conf/loadconfig.inc.php"); 

	//extract($_POST);
	//extract($_GET);
	

	 $get_order="SELECT pm.productTitle AS productTitle, um.userFname, um.userLname, um.userEmail, um.userPhone, ph.printTotalPrice  FROM `myOrdersManager` AS mo 
	 			 INNER JOIN productManager AS pm ON pm.productId=mo.productId
				 INNER JOIN `user_master` AS um ON um.userId=mo.userId 
				 INNER JOIN `premiumPhotoOrder` AS ph ON ph.premiumPhotoOrderId=mo.productPreOrderId
				 WHERE orderId='10' AND um.userId='145'"
;
	  $result=mysql_query($get_order);
	  $result_data=mysql_fetch_assoc($result);
	  $productTitle=$result_data['productTitle'];
	  $userFullname=$result_data['userFname'].' '.$result_data['userLname'];
	  $userEmail=$result_data['userEmail'];
	  $userPhone=$result_data['userPhone'];
	  $printTotalPrice=$result_data['printTotalPrice'];
	  
	  $payment_sql="INSERT INTO `payment_info` SET order_id='10' AND userId='145'";
	  mysql_query($payment_sql); 
	  $payment_id=mysql_insert_id();
	  
// print_r($_SESSION); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Photo Print Studio | Checkout</title>
<?php 
		include('includes/common_css.php');
		include('includes/header.php');
?>
  <script>
    var hash = '<?php echo $hash ?>';
    function submitPayuForm() {
      if(hash == '') {
        return;
      }
      var payuForm = document.forms.payuForm;
      payuForm.submit();
    }
  </script>
  </head>
  <body onLoad="submitPayuForm()" >
<div class="cp-inner-banner">
<div class="container">
<div class="cp-inner-banner-outer">
<h2>REVIEW & Confirm</h2>
<ul class="breadcrumb">
<li><a href="index.html">Home</a></li>
<li class="active">Payment</li>
</ul> 
</div>
</div>
</div>
<div class="cp-main-content">
<section class="cp-signup-section pd-tb60">
<div class="container">
	<div class="col-lg-2"></div>
    <div class="col-lg-8">
    <?php if($formError) { ?>
	
      <span style="color:red">Please fill all mandatory fields.</span>
      <br/>
      <br/>
    <?php } ?>
    <form action="<?php echo $action; ?>" method="post" name="payuForm">
      <input type="hidden" name="key" value="<?php echo $MERCHANT_KEY ?>" />
      <input type="hidden" name="hash" value="<?php echo $hash ?>"/>
      <input type="hidden" name="txnid" value="<?php echo $txnid ?>" />
      	<div class="col-sm-2">Amount:</div>
      	<div class="col-sm-10"> <input name="amount" value="<?php echo round($printTotalPrice) ?>" class="form-control styles" />
        
       </div> 
        <div class="clearfix">&nbsp;</div>
      	<div class="col-sm-2">Name:</div>
      	<div class="col-sm-10"><input name="firstname" id="firstname" value="<?php echo $userFullname; ?>" class="form-control styles" /></div>
        <div class="clearfix">&nbsp;</div>
        
      	<div class="col-sm-2">Email:</div>
      	<div class="col-sm-10">
        
        <input name="email" id="email" value="<?php echo $userEmail; ?>" class="styles form-control"  />
		
		</div>
        <div class="clearfix">&nbsp;</div>
        <div class="col-sm-2">Phone:</div>
      	<div class="col-sm-10"><input name="phone" value="<?php echo $userPhone; ?>" class="form-control styles" /></div>
      

		<div class="clearfix">&nbsp;</div>
        <div class="col-sm-2">Product Info:</div>
      	<div class="col-sm-10"><textarea name="productinfo" class="form-control styles" ><?php echo $productTitle; ?></textarea></div>
            
		<input type="hidden" name="service_provider" value="payu_paisa" size="64" /></div>

    
         <div class="clearfix">&nbsp;</div>
            
            
        <div class="clearfix">&nbsp;</div>
       <!-- <div class="col-sm-2">Success URI:</div>-->
      	<div class="col-sm-10"><input type="hidden" name="surl" value="<?php echo DEFAULT_URL ?>/success.php" size="64" class="form-control"/></div>
      
     
      <!--  <div class="col-sm-2">Failure URI:</div>-->
      	<div class="col-sm-10"><input type="hidden" name="furl" value="<?php echo DEFAULT_URL ?>/failure.php" size="64" class="form-control"/></div>

		<input type="hidden" name="udf1" value="1" />
        <input type="hidden" name="udf2" value="2" />
        <input type="hidden" name="udf3" value="3" />
        <input type="hidden" name="udf4" value="4" />
        <input type="hidden" name="udf5" value="5" />
        <input name="pg" value="pg" type="hidden" />
               <?php if(!$hash) { ?>
            <td><input type="submit" value="Make Payment" name="submit" class="submit tg-theme-btn"/></td>
            
          <?php } ?>
        </tr>
      </table>
    </form>
        </div>
    <div class="col-lg-2"></div>

</div>
</section> 
</div>
 <?php
	include('includes/footer.php');
	include('includes/common_js.php');
	
?>
  </body>
</html>
