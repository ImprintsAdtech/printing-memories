<?php

include_once("conf/loadconfig.inc.php"); 

	session_start();
	extract($_POST);
	extract($_GET);
	$obj_product = new Photomanager();
	$currentTimestamp = getCurrentTimestamp();

	if(isset($_SESSION['userId']) && $_SESSION['userId']== ""){
		header('Location: '.DEFAULT_URL); 
	}else {


?>

<!DOCTYPE html>

<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Printmysnap - Free Photos for Lifetime | My Orders</title>
<?php 

		include('includes/common_css.php');

		include('includes/header.php');

?>

<div class="cp-inner-banner">
  <div class="container">
    <div class="cp-inner-banner-outer">
      <h2>My Orders</h2>
      
      <!--<ul class="breadcrumb">

<li><a href="index.html">Home</a></li>

<li class="active">My Orders</li>

</ul> --> 
      
    </div>
  </div>
</div>
<div class="cp-main-content">
  <section class="cp-signup-section pd-tb60">
    <div class="container">
    
     <?php
	
		$order_check="SELECT * FROM `myOrdersManager` WHERE userId='".$_SESSION['userId']."' AND DATE(orderDate )='".date('y-m-d')."'";
		$order_check_result=mysql_query($order_check);
		if(mysql_num_rows($order_check_result)<1){
		}
		else{
	?>
        
      <div class="bg-success text-center" style="padding:5px; margin-bottom:30px">Thanks for ordering prints. Your prints shall be dispatched within 15 business days.</div>
    <?php }?>
      
      <div class="table-responsive">
        <table class="table">
          <tr>
            <th>S.no.</th>
            <th>Order no.</th>
            <th>Product Name</th>
            <th>Number of Photos Uploaded</th>
            <th>Product Type</th>
            <th>Date</th>
          </tr>
          <?php 

$orderResult = $obj_product->getMyOrderInfo($_SESSION['userId']);

if($db->numRows($orderResult) > 0)

	{

		$i=1;

		while($orderData = $db->fetchNextObject($orderResult)){

			$orderDate = $orderData->orderDate;

			$createDate = new DateTime($orderDate);

			$strip = $createDate->format('d-m-Y');

			?>
          <tr>
            <td><?=$i?>
              .</td>
            <td><a href="<?=DEFAULT_URL?>/order-detail/<?=$orderData->orderId;?>">#
              <?=$orderData->final_order_id;?>
              </a></td>
            <td><h4>
                <?=$orderData->productTitle?>
              </h4>
              <br>
              <img src="<?=DEFAULT_URL?>/userfiles/product_img/<?=$orderData->productImage?>" alt="" width="100"></td>
            <td><p>
                <?=$orderData->upload_no_photo?>
                Photos</p></td>
            <td><p>
                <?=$orderData->productType?>
              </p></td>
            <td><p>
                <?=$strip?>
              </p></td>
            <td></td>
          </tr>
          <?php

			$i++;

		}

		?>
          <?php

		

	}

	else

	{

		?>
          <tr>
            <td colspan="12"><center>
                <h3>No Item Found</h3>
              </center></td>
          </tr>
          <?php

	}

 ?>
        </table>
      </div>
      <?php /*?><div class="table-responsive">

<table class="table">

   <tr>

  	<td colspan="4"><h3>SHOP PRODUCTS YOU MAY LIKE:</h3></td>

  </tr>

  <tr>

    <td colspan="4">

    	<ul class="peoplelikeproduct">

        	<li class="col-lg-3">

            	<img src="<?=DEFAULT_URL?>/images/ex5.jpg" alt="" class="img-responsive"><p>Brass geo stands <br>$60 - <a href="#">info</a></p>

            </li>

            <li class="col-lg-3">

            	<img src="<?=DEFAULT_URL?>/images/ex2.jpg" alt="" class="img-responsive"><p>Brass geo stands <br>$60 - <a href="#">info</a></p>

            </li>

            <li class="col-lg-3">

            	<img src="<?=DEFAULT_URL?>/images/ex3.jpg" alt="" class="img-responsive"><p>Brass geo stands <br>$60 - <a href="#">info</a></p>

            </li>

            <li class="col-lg-3">

            	<img src="<?=DEFAULT_URL?>/images/ex4.jpg" alt="" class="img-responsive"><p>Brass geo stands <br>$60 - <a href="#">info</a></p>

            </li>

        </ul>

    </td>

    

  </tr>

  

</table>

</div><?php */?>
    </div>
  </section>
</div>
<?php
	}
	include('includes/footer.php');

	include('includes/common_js.php');

?>
