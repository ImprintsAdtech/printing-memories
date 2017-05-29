<?php

include_once("conf/loadconfig.inc.php");
$currentTimestamp = getCurrentTimestamp();
	session_start();
	extract($_POST);
	extract($_GET);
	$obj_users = new Usermanager();
	$obj_product = new Productmanager();

if(isset($action) && $action == 'productPlan'){

	if($printPlan != "" && $productId != "" && $productcatId != ""){
		
		$productAlready = $obj_product->checkProductbuyAlready($productId ,$_SESSION['userId'] );
			if($db->numRows($productAlready) > 0)
				{
					echo "already";
				}
				else
				{

				$dataArray = array('productId'=>$productId,

					'productCatId'=>$productcatId,

					'userId'=>$_SESSION['userId'],

					'plan'=>$printPlan,
					
					'status'=>0,
					
					'buyStatus'=>0,

					'createDatetime'=>date("Y-m-d H:i",strtotime('330 min',strtotime(gmdate("Y/m/d h:i:s A")))),

				);

				$last_inserted = $obj_product->insertproductBuy($dataArray,$obj_product->tblproduct_detail);
				
				echo $last_inserted;
				}

				

			}

	else{

		echo 'blank'; exit;

	}
}

?>
