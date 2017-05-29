<?php

include_once("conf/loadconfig.inc.php"); 

$obj_product = new Photomanager();

$obj_users = new Usermanager();

$currentTimestamp = getCurrentTimestamp();

extract($_GET);
if($_SESSION['userId']==''){
	echo '<script>location.href="'.DEFAULT_URL.'"</script>';
}
$productSlug = $product;

$getProductId = $obj_product->getProductId($product); 

$productId = $getProductId->productId;

  

$premiumorder=$obj_product->getPremiumPhotoOrder($productId,$userId);

//Fetching records from photoManager 

$productDetail = $obj_product->getProductAllDetail($productId);

$productData = $db->fetchNextObject($productDetail);

$interestResource = mysql_query("Select * from interests where status = 1");

$i=0;

while($interestData = mysql_fetch_assoc($interestResource)){

	$interestList[$i]["id"] = $interestData["id"];

	$interestList[$i]["interest"] = $interestData["interest"];

	$i++;

} 

	if($_SESSION['userId']==''){
		echo '<script>location.href="'.DEFAULT_URL.'"</script>';
	}else {
		
?>

<!DOCTYPE html>

<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Printmysnap - Free Photos for Lifetime | Checkout</title>
<?php 

		include('includes/common_css.php');

		include('includes/header.php');

?>
<style>
.copyAddress:hover {
	color: #FFF;
}
.AddNewAddres:hover {
	color: #FFF;
}
</style>

<div class="cp-inner-banner">
  <div class="container">
    <div class="cp-inner-banner-outer">
      <h2>REVIEW & PAY</h2>
      
      <!--<ul class="breadcrumb">

<li><a href="index.html">Home</a></li>

<li class="active">Checkout</li>

</ul> --> 
      
    </div>
  </div>
</div>
<div class="cp-main-content">
  <section class="cp-signup-section pd-tb60">
    <div class="container">
      <div class="col-lg-2"></div>
      <div class="col-lg-8">
        <?php

$userId = $_SESSION['userId'];

$guestUserId = $_SESSION['guestUserId'];

if($userId == "")

{

$userId = $_SESSION['guestUserId'];	

}

$userDetail =  

		$cartResult = $obj_product->getCartItems($userId);

		$count = $db->numRows($cartResult);

		if($db->numRows($cartResult) > 0)

		{   

	   	$cartId;

		$productId2;

			while($cartData = $db->fetchNextObject($cartResult)){

				$cartId.=$cartData->cartId.',';

				$productId2.=$cartData->productId.',';

				$productSizeId.=$cartData->productSizeId.',';

				$freePhotoOrderId.=$cartData->freePhotoOrderId.',';

				$premiumPhotoOrderId.=$cartData->premiumPhotoOrderId.',';

				$uploaded_no_photos.=$cartData->uploaded_no_photos.',';

				$plan.=$cartData->plan.',';

				$printTotalPrice+=$cartData->printPrice;

			}

			$cartId = rtrim($cartId, ','); 

			$productSizeId = rtrim($productSizeId, ','); 

			$productId = rtrim($productId2, ','); 

			$freePhotoOrderId= rtrim($freePhotoOrderId, ','); 

			$premiumPhotoOrderId= rtrim($premiumPhotoOrderId, ','); 

			$uploaded_no_photos= rtrim($uploaded_no_photos, ','); 

			$plan= rtrim($plan, ',');

		}

		?>
        <form id="checkout-form" class="checkout-form">
          <div class="checkout-box">
            <?php



          	//For Permanent Addredd

          	$query = "Select * From user_master left Join city on user_master.city_id = city.id left join state on user_master.state_id = state.id where userId = ".$userId;

          	$resource = mysql_query($query);

          	$userDetail = mysql_fetch_assoc($resource);

          	if(!empty($userDetail)){

          		$houseNo = !empty($userDetail["house_no"]) ? $userDetail["house_no"] : "" ;

          		$street = !empty($userDetail["street"]) ? $userDetail["street"] : "" ;

          		$area = !empty($userDetail["area"]) ? $userDetail["area"] : "" ;

          		$userCity_id = !empty($userDetail["city_id"]) ? $userDetail["city_id"] : "" ;

          		$userState_id = !empty($userDetail["state_id"])? $userDetail["state_id"] : "";

          		$city = !empty($userDetail["city"]) ? $userDetail["city"] : "" ;

          		$state = !empty($userDetail["state_name"]) ? $userDetail["state_name"] : "";

          	}

          	$interestQuery = "Select * From user_interests left join interests on user_interests.interest_id = interests.id where user_id = ". $userId ." Order by interest_id";

          	$interests = mysql_query($interestQuery);

          	while($interestData = mysql_fetch_assoc($interests)){

					$interest_id[] = $interestData["id"];

					$interest[] = $interestData["interest"];

			} 

          	

          	$checkoutData = $obj_product->getCheckoutInfo($userId);

            if($db->numRows($checkoutData) > 0){

            	while($checkoutDataRes = $db->fetchNextObject($checkoutData)){

	                $checkoutOccupation =$checkoutDataRes->checkoutOccupation;

	                $checkoutHouseNo =$checkoutDataRes->checkoutHouseNo;

	                $checkoutStreet =$checkoutDataRes->checkoutStreet;

	                $checkoutArea =$checkoutDataRes->checkoutArea;

	                $checkoutCity_id =$checkoutDataRes->checkoutCity_id;

	                $checkoutState_id =$checkoutDataRes->checkoutState_id;

	                $checkoutPincode =$checkoutDataRes->checkoutPincode;

            	}

		    }

	

	if($_SESSION['userId'] != ""){

		if($plan=="free"){

?>
<?php /*?>            <div class="col-md-4">
              <h3 style="margin-left:-20px;">Occupation *</h3>
            </div>
            <div class="col-md-6">
              <select name="checkoutOccupation" class="checkoutOccupation form-control" id="checkoutOccupation">
                <option value="">Select Occupation</option>
                <option value="Student" <?php if($checkoutOccupation=="Student") { echo "selected='selected'" ;} ?>>Student</option>
                <option value="Self Employed / Business / Profession" <?php if($checkoutOccupation=="Self Employed / Business / Profession") { echo "selected='selected'" ;} ?>>Self Employed / Business / Profession</option>
                <option value="Salaried" <?php if($checkoutOccupation=="Salaried") { echo "selected='selected'" ;} ?>>Salaried</option>
                <option value="Home Maker" <?php if($checkoutOccupation=="Home Maker") { echo "selected='selected'" ;} ?>>Home Maker</option>
                <option value="Others" <?php if($checkoutOccupation=="Others") { echo "selected='selected'" ;} ?>>Others</option>
              </select>
            </div>
            <div class="col-md-2"> </div>
            <div class="clearfix"></div><?php */?>
             <input type="hidden" name="checkoutOccupation" value="Student" class="checkoutOccupation form-control" id="checkoutOccupation">

            <h3>Interests *</h3>
            <p>Select minimum 4</p>
            <br>
            <?php 

		    $k=1;

		    $j=0;

		    foreach($interestList as $interests){

		    ?>
            <div class="col-md-6" style="padding:5px 0">
              <div class="checkbox-info">
              <input type="checkbox" class="interest_id pull-left" required minlength="4" name="interest_id[]" <?php if (isset($interest_id) &&  in_array($interests["id"], $interest_id)) { echo "checked='checked'" ; } ?> value="<?php echo !empty($interests['id']) ? $interests['id'] : '' ?>">
              <div class="pull-left"><?php echo !empty($interests["interest"]) ? "&nbsp;".$interests["interest"] : "" ;?></div>
            </div></div>
            <?php 

			    if($k==2){

			    	echo "<br>";

			    	$k=0;

			    }

			    $k++;

			    $j++;

		    }

		    ?>
            <div class="clearfix">&nbsp;</div>
            <br>
            <?php    

		}

  	} else {

?>
            <a href="<?=DEFAULT_URL?>/login">Login</a><br>
            <br>
            <a href="javascript:void(0)" id="guestUserData" class="true">Checkout as Guest User</a> <br>
            <br>
            <h3>Name</h3>
            <input type="text" name="checkoutName" class="checkoutName" id="checkoutName" placeholder="Name *">
            <br>
            <br>
            <h3>Email Id</h3>
            <input type="text"  name="checkoutEmail" class="checkoutEmail" id="checkoutEmail" placeholder="Email Id *">
            <br>
            <br>
            <h3>Phone Number</h3>
            <input type="text" name="checkoutphone" class="checkoutphone" id="checkoutphone" placeholder="Phone Number *">
            <br>
            <br>
            <?php	

	}

?>
            <div class="clearfix">&nbsp;</div>
            <h3>Permanent Address *</h3>
            <p>Address can be changed only once in 3 months</p>
            <p>(Considered as your shipping address)</p>
            <br>
            <div class="col-md-4">
              <input type="text" <?php if($houseNo != ""){ echo "readonly"; }?> value="<?=$houseNo?>" name="house_no" class="userHouseNo" id="userHouseNo" placeholder="House No. / Office No.">
            </div>
            <div class="col-md-4">
              <input type="text" <?php if($street != ""){ echo "readonly"; }?> value="<?=$street?>" name="street" class="userStreet" id="userStreet" placeholder="Building / Society / Locality">
            </div>
            <div class="col-md-4">
              <input type="text" <?php if($area != ""){ echo "readonly"; }?> value="<?=$area?>" name="area" class="userAre" id="userArea" placeholder="Area / Street Name">
            </div>
            <div class="clearfix">&nbsp;</div>
            <?php

			$stateResource = mysql_query("Select * from state ORDER BY `state_name` ASC"); 

		?>
            <div class="col-md-4">
              <select name="userState_id" id="permanentStateId"  class="permanentStateId form-control"  >
                <option value="">Select State</option>
                <?php 

			while($stateArray = mysql_fetch_assoc($stateResource)){

			?>
                <option value="<?php echo $stateArray['id']; ?>" <?php if($userState_id==$stateArray["id"]){ echo "selected='selected'"; } ?>><?php echo $stateArray["state_name"]; ?></option>
                <?php 

			}

		?>
              </select>
              <div id="permanentStateId-error" class="help-block" style="display: none;">This field is required.</div>
            </div>
            <div class="col-md-4">
              <select name="userCity_id" id="permanentCityId" class="permanentCityId form-control" <?php if($city_id!="") echo "disabled" ;?> >
                <option value="">Select City</option>
                
                <option value="<?php echo !empty($userCity_id) ? $userCity_id : '' ?>" <?php if($userCity_id!=''){ echo 'selected="selected"';}?>><?php echo !empty($city) ? $city : "" ;?></option>
              </select>
              <div id="permanentCityId-error" class="help-block" style="display: none;">This field is required.</div>
            </div>
            
            <div class="col-md-4 123 <?php echo $checkoutPincode; ?>">
            <select name="pincode" id="pincode" class="pincode form-control" required>
                <option value="<?php echo !empty($checkoutPincode) ? $checkoutPincode : '' ?>" <?php if($checkoutPincode!=''){ echo 'selected="selected"';}?>><?php echo !empty($checkoutPincode) ? $checkoutPincode : "" ;?></option>
              </select>
            
              
            </div>
            
            <?php /*?><div class="col-md-4">
              <input type="text" <?php if($checkoutPincode != ""){ echo "readonly"; }?> value="<?=$checkoutPincode?>" name="pincode" class="pincode" id="pincode" placeholder="Pincode">
            </div><?php */?>
            <div class="clearfix">&nbsp;</div>
            <?php

		if($plan!="free"){

		?>
            <tr>
              <td class="text-center"><a href="javascript:void(0);" class="btn-submit copyAddress" style="margin-bottom:10px;">Copy Address</a> <a href="javascript:void(0);" class="btn-submit AddNewAddres">Add New Address</a></td>
              <div class="clearfix">&nbsp;</div>
              <?php 

				$resource = mysql_query("Select * from checkout_address left join city on checkout_address.checkoutCity_id = city.id left join state on checkout_address.checkoutState_id = state.id where userId = ".$_SESSION["userId"]);

				?>
              <td class="text-center"><select class="dropdown form-control" id="addedAddress">
                  <option>Added Shipping Addresses</option>
                  <?php 

							while($addedAddresses = mysql_fetch_assoc($resource)){

								$address = $addedAddresses["checkoutHouseNo"].",".$addedAddresses["checkoutStreet"].",".$addedAddresses["checkoutArea"].",".$addedAddresses["city"].",".$addedAddresses["state_name"].",".$addedAddresses["checkoutPincode"];

						?>
                  <option value="<?php echo !empty($addedAddresses['checkoutAddId']) ? $addedAddresses['checkoutAddId'] : "" ;?>"><?php echo $address; ?></option>
                  <?php		

							}

						?>
                </select></td>
            </tr>
            <br>
            <h3>Shipping Address </h3>
            <input type="text" <?php if($checkoutHouseNo != ""){ echo "readonly"; }?> value="" name="checkoutHouseNo" class="checkoutHouseNo" id="checkoutHouseNo" placeholder="House No">
            <input type="text" <?php if($checkoutStreet != ""){ echo "readonly"; }?> value="" name="checkoutStreet" class="checkoutStreet" id="checkoutStreet" placeholder="Street">
            <input type="text" <?php if($checkoutArea != ""){ echo "readonly"; }?> value="" name="checkoutArea" class="checkoutArea" id="checkoutArea" placeholder="Area">
            <div class="clearfix">&nbsp;</div>
            <?php 

			if($plan=="free"){

			?>
            <select name="checkoutCity_id" id="freeShippingCityId" class="freeShippingCityId form-control">
              <option>Select City</option>
              <option value="14" <?php if($checkoutCity_id==14){ echo "selected='selected'"; } ?>>Delhi</option>
              <option value="15" <?php if($checkoutCity_id==14){ echo "selected='selected'"; } ?>>Kolkata</option>
            </select>
            <div id="freeShippingCityId-error" class="help-block" style="display: none;">This field is required.</div>
            <?php 	

			} else {

				$stateResource = mysql_query("Select * from state");

			?>
            <select name="checkoutState_id" id="shippingStateId" class="shippingStateId form-control">
              <option>Select State</option>
              <?php 

					while($stateArray = mysql_fetch_assoc($stateResource)){

					?>
              <option value="<?php echo $stateArray['id']; ?>" <?php //if($checkoutState_id==$stateArray["id"]){ echo "selected='selected'"; } ?>><?php echo $stateArray["state_name"]; ?></option>
              <?php 

					}

					?>
            </select>
            <div id="shippingStateId-error" class="help-block" style="display: none;">This field is required.</div>
            <div class="clearfix">&nbsp;</div>
            <select name="checkoutCity_id" id="shippingCityId" class="shippingCityId form-control">
              <option>Select City</option>
              <option value="<?php echo !empty($checkoutCity_id) ? $checkoutCity_id : '' ?>" selected="selected"><?php echo !empty($city) ? $city : "" ;?></option>
            </select>
            <div id="shippingCityId-error" class="help-block" style="display: none;">This field is required.</div>
            <?php 	

			}

			?>
            <div class="clearfix">&nbsp;</div>
            <input type="text" <?php if($checkoutPincode != ""){ echo "readonly"; }?> value="" name="checkoutPincode" class="checkoutPincode" id="checkoutPincode" placeholder="Pincode">
            <div class="clearfix">&nbsp;</div>
            <?php 

		}

		?>
            <input type="hidden" name="action" class="action" id="action" value="updatecheckoutinfo">
            <input type="hidden" name="cartId" class="cartId" id="cartId" value="<?=$cartId?>">
            <input type="hidden" name="productId" class="productId" id="productId" value="<?=$productId?>">
            <input type="hidden" name="productType" class="productType" id="productType" value="<?=$plan?>">
            <input type="hidden" name="freePhotoOrderId" class="freePhotoOrderId" id="freePhotoOrderId" value="<?=$freePhotoOrderId?>">
            <input type="hidden" name="premiumPhotoOrderId" class="premiumPhotoOrderId" id="premiumPhotoOrderId" value="<?=$premiumPhotoOrderId?>">
            <input type="hidden" name="productSizeId" class="productSizeId" id="productSizeId" value="<?=$productSizeId?>">
            <input type="hidden" name="uploaded_no_photos" class="uploaded_no_photos" id="uploaded_no_photos" value="<?=$uploaded_no_photos?>">
          </div>
          <div class="checkout-box2">
            <h3>Review & Place Order</h3>
            <table style="width:100%;">
              <tr>
                <td><?=$count?>
                  items</td>
                <td class="text-right"><?php  if($printTotalPrice!='0'){ ?>
                  Rs.
                  <?=$printTotalPrice?>
                  <?php } else { echo "Free";}?></td>
              </tr>
              <tr>
                <td>Shipping <a href="shipping-info.html"><i class="fa fa-question-circle"></i></a></td>
                
                <!--<td class="text-right">Enter address to calculate</td>--> 
                
              </tr>
              <tr>
                <td colspan="2"><hr></td>
              </tr>
              <tr>
                <td><h3>Total</h3></td>
                <td class="text-right"><h3>
                    <?php  if($printTotalPrice!='0'){ ?>
                    Rs.
                    <?=$printTotalPrice?>
                    <?php } else { echo "Free";}?>
                  </h3></td>
              </tr>
              
              <!-- <tr>

                <td>&nbsp;</td>

                <td class="text-right">

                    <select class="form-control">

                        <option>--- Select Currency ---</option>

                        <option>United State Dollor</option>

                        <option>Euro</option>

                        <option>Canada Dollor</option>

                        <option>Austrelia Dollor</option>

                    </select>

                    <div class="clearfix">&nbsp;</div>

                </td>

              </tr>-->
              
              <tr>
                <td colspan="2" class="text-center"><?php

				if($count >0) {

				?>
                  <input type="button" id="updateCheckout" class="btn-submit" value="Place order">
                  <?php

				} else {

				?>
                  <input type="button" style="pointer-events:none;" id="updateCheckout" class="btn-submit" value="Complete your info to place order">
                  <?php

				}

				?></td>
              </tr>
            </table>
          </div>
        </form>
      </div>
      <div class="col-lg-2"></div>
      <div class="clearfix"></div>
    </div>
  </section>
</div>
<?php

	include('includes/footer.php');

	include('includes/common_js.php');

	include('checkout-script.php');

?>
<style>
.checkbox-info span.help-block {
    position: absolute;
    top: -20px;
	left:0px;
	width:200px;
}
.help-block {
    display: inline-block !important;
}
</style>
<?php }?>
