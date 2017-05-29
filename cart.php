<?php

include_once("conf/loadconfig.inc.php"); 

session_start();

	extract($_POST);

	extract($_GET);

	$obj_product = new Photomanager();

$currentTimestamp = getCurrentTimestamp();
if($_SESSION['userId']==''){
	echo '<script>location.href="'.DEFAULT_URL.'"</script>';
}
?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="utf-8">

<meta http-equiv="X-UA-Compatible" content="IE=edge">

<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Printmysnap - Free Photos for Lifetime | Cart</title>

<?php 

		include('includes/common_css.php');

		include('includes/header.php');

?>

 

<div class="cp-inner-banner">

<div class="container">

<div class="cp-inner-banner-outer">

<h2>Shopping  Cart</h2>

</div>

</div>

</div>

 

 

<div class="cp-main-content">

 

<section class="cp-signup-section pd-tb60">

<div class="container">



<div class="table-responsive">

<table class="table table_baseline">



<thead>

	<tr>

    	<th class="text-center">S.No.</th>

        <th class="text-center"></th>

        <th class="text-center">Product</th>

        <th class="text-center">Size</th>

        <th class="text-center">Set of photos</th>

        <th class="text-center">Uploaded Photos</th>

        <th colspan="2" class="text-center">Action</th>

        <th class="text-center">Total Price</th>

    </tr>

</thead>



<?php 

$userId = $_SESSION['userId'];

$guestUserId = $_SESSION['guestUserId'];

if($userId == "")

{

$userId = $_SESSION['guestUserId'];	

}

$cartResult = $obj_product->getCartItems($userId);

if($db->numRows($cartResult) > 0)

	{

		$i = 1;

		while($cartData = $db->fetchNextObject($cartResult)){

			

			$productId = $cartData->productId;

			$printPrice = $cartData->printPrice;

			$printTotalPrice += $cartData->printPrice;

			$productSizeId = $cartData->productSizeId;

			

			$productDetail = $obj_product->getProductDetail($productId);

			

			$productSizes = $obj_product->getProductSizeDetail($productSizeId);

			$productSize = $productSizes->productSize;

			

			$productType = $productDetail->productType;

			if($productType == "free"){

				$orderId = $cartData->freePhotoOrderId;

			} else {

				$orderId = $cartData->premiumPhotoOrderId;

			}

			?>

          	<tr>

			    <td class="text-center"><p><?=$i?>.</p></td>

			    <td class="text-center"><img src="<?=DEFAULT_URL?>/userfiles/product_img/<?=$productDetail->productImage?>" alt="" width="70"></td>

                <td class="text-center"><p><?=$productDetail->productTitle?></p></td>

			    <td class="text-center"><?=$productSize?></td>

			    <td class="text-center"><p><?=$cartData->no_of_photos?></p></td>

			    

			    <td class="text-center"><p><?=$cartData->uploaded_no_photos?></p></td>

			    

			    <td class="text-center"><a href="javascript:void(0)" data-id="<?=$cartData->cartId?>" data-protype="<?=$productType?>" data-probuyid="<?=$orderId?>"  class="cp-btn-style1 deleteCart"><i class="fa fa-close"></i> Delete</a></td>

			    <?php 

			    if($productType == "free"){

				?>

<td class="text-center"><a href="<?=DEFAULT_URL?>/freeupload-photos/<?=$productDetail->finalSlug?>" class="cp-btn-style1 editCart"><i class="fa fa-pencil"></i> Edit</a></td>

			    <?php

				} else {

					if($productDetail->finalSlug == "photobooks") {

				?>

    					<td class="text-center"><a href="<?=DEFAULT_URL?>/photobook_upload/<?=$productDetail->finalSlug?>" class="cp-btn-style1 editCart"><i class="fa fa-pencil"></i> Edit</a></td>

    			<?php	

					} else if($productDetail->finalSlug == "photostrips") {

				?>

					    <td class="text-center"><a href="<?=DEFAULT_URL?>/photostrip_upload/<?=$productDetail->finalSlug?>" class="cp-btn-style1 editCart"><i class="fa fa-pencil"></i> Edit</a></td>

    			<?php	

					} else {

				?>

					    <td class="text-center"><a href="<?=DEFAULT_URL?>/premiumUpload/<?=$productDetail->finalSlug?>" class="cp-btn-style1 editCart"><i class="fa fa-pencil"></i> Edit</a></td>

				<?php		

					}

				}

				?>

				

			    <?php

				if($productType == "free") {

				?>

					<td class="text-center"><p>Free</p></td>

			    <?php

				} else {

				?>

				<td class="text-center"><p>Rs.</p><p> <?=$printPrice?></p></td>

			    <?php

				}

				?>

  			</tr>  

            

            <?php

			$i++;

		}

		?>

	   		<?php 

		  	if($productType == "free") {

		  	?>

	  		<tr>

			  	<td><h5>Note:</h5></td>

			    <td colspan="9"><h5>Your free product is ready to be ordered. No changes shall be saved to the cart until you complete or delete the order of your free prints.</h5></td>

			</tr>    

		    <?php 

			} else {

		    ?>

		    <tr>	

				<td ><h5>Total:</h5></td>

				<td colspan="9"><h5>Rs. <?=$printTotalPrice?></h5></td>

			</tr>

			<tr>	

				<td><h5>Note:</h5></td>

			    <td colspan="9"><h5>Your prints are ready to be ordered. Free prints can't be added to the cart until you finish the current order process or delete the paid products from the cart.</h5></td>

			</tr>    

		    <?php	

		    } ?>

	  	<tr>

		  	<td class="text-center" colspan="9" >

		  	<?php 

		  	if($productType != "free") {

		  	?>	

			  	<br><a href="<?=DEFAULT_URL?>/product" class="cp-btn-style1 margnbot20">Keep Shopping</a>&nbsp;&nbsp;

			<?php

		  	}

		  	?>

		  	<br><a href="<?=DEFAULT_URL?>/checkout.php" class="cp-btn-style2">Checkout</a></td>

	  	</tr>

    <?php

	} else {

	?>

	<tr>

  		<td colspan="12"><center><h3>No Item Found</h3></center></td>

	</tr>	

  	<?php

	}

 	?>





  

  

  

  

  

  

  

 

 

  </table>

</div>

  

<!-- <div class="table-responsive">

<table class="table">

   <tr>

  	<td colspan="4"><h3>SHOP PRODUCTS YOU MAY LIKE:</h3></td>

  </tr>

  <tr>

    <td colspan="4">

    	<ul class="peoplelikeproduct">

        	<li class="col-lg-3">

            	<img src="images/ex5.jpg" alt="" class="img-responsive"><p>Brass geo stands <br>$60 - <a href="#">info</a></p>

            </li>

            <li class="col-lg-3">

            	<img src="images/ex2.jpg" alt="" class="img-responsive"><p>Brass geo stands <br>$60 - <a href="#">info</a></p>

            </li>

            <li class="col-lg-3">

            	<img src="images/ex3.jpg" alt="" class="img-responsive"><p>Brass geo stands <br>$60 - <a href="#">info</a></p>

            </li>

            <li class="col-lg-3">

            	<img src="images/ex4.jpg" alt="" class="img-responsive"><p>Brass geo stands <br>$60 - <a href="#">info</a></p>

            </li>

        </ul>

    </td>

    

  </tr>

  

</table>

</div> -->



<!-- <div class="col-lg-12 alert-warning pd-tb30 text-center">

	Please note that shipping will be calculated at checkout.

</div> -->



</div>

</section> 

</div>



<div class="modal-delete-photo modal-effect-blur" id="modal-cart">

	<div class="modal-content">

		<h3>Are you sure you want to delete?</h3>

		<div>

			<button data-id="" data-probuyid="" data-protype="" class="modal-delete btn-submit">Delete</button>

			<button class="modal-delete-cancel btn-submit">Cancel</button>

		</div>

	</div>

</div>

<div class="modal-delete-photo modal-effect-blur" id="message-popup">

	<div class="modal-content">

		<?php 

		if($productType == "free"){

		?>

			<h3>Your free product is ready to be ordered. No changes shall be saved to the cart until you finish the order process or delete the free  product from the cart.</h3>

		<?php 

		} else {

		?>

			<h3>Your prints are ready to be ordered. Free prints can't be added to the cart until you finish the current order process or delete the paid products from the cart.</h3>

		<?php

		} 

		?>

		<div>

			<button class="modal-delete-cancel btn-submit">OK</button>

		</div>

	</div>

</div>

<div class="modal-overlay"></div>

 

 <?php

	include('includes/footer.php');

	include('includes/common_js.php');

	include('cart-script.php');

if($db->numRows($cartResult) > 0){

?>

	<script>

		jQuery(document).ready(function(){

			jQuery("#message-popup").addClass('modal-show');

		});

	</script>

<?php 

} 

?>