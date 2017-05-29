<?php
include_once("conf/loadconfig.inc.php"); 
	extract($_POST);
	extract($_GET);
	$obj_Blog= new Blogmanager();
	$obj_user= new Usermanager();
	$obj_product = new Productmanager();
	
	$blogId;
	$cateId;
	
	$resultBlog=$obj_Blog->get_id_all('finalSlug', $blogId, 'blog');
	while($blogData = $db->fetchNextObject($resultBlog)){
		$blogID=$blogData->blogId;
	}

	$resultBlog = $obj_Blog->getAllBlogDetail($blogID);
	$blogID;
	
	/* views */
	
	$ip=$_SERVER['REMOTE_ADDR'];
	 $checkAlredyview = $obj_Blog->checkAlreadyViewed($ip ,$blogID );
	 $count=$db->numRows($checkAlredyview);

	if($count == 0)
	{

			$dataArray = array('blogId'=>$blogID ,
							   'blogViewDate'=>date('Y-m-d H:i',strtotime('330 min',strtotime(gmdate('Y/m/d h:i:s A')))),
							   'IPVisitors'=>$ip,

				);

			 $obj_Blog->insertViewedblog($dataArray,$obj_Blog->tblvisit);
	
	}
	/* views */
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php if($resultBlog->metaTitle != ""){
			echo "Photo Print Studio | ".$resultBlog->metaTitle;
		}
		else
		{
			echo "Photo Print Studio | ".$resultBlog->title;
		}
   ?></title>
   <meta name="description" content="<?php if($resultBlog->metaDescription != ""){echo $resultBlog->metaDescription;}else{$string = substr(	$resultBlog->shortDes,3,160);
  	$wordlist = array("<em>","</em>","<p>","</p>","<strong>","</strong>","<span>","</span>");
	$string1 = str_replace($wordlist,' ', $string);
   	echo $string1;
   }
   ?>">
    <meta name="keywords" content="<?php if($resultBlog->metaKeyword != ""){
			echo $resultBlog->metaKeyword;
		}
		else
		{
			echo $resultBlog->title;
		}
   ?>">
   
   
<?php 
		include('includes/common_css.php');
		include('includes/header.php');
?>
<div class="cp-inner-banner">
<div class="container">
<div class="cp-inner-banner-outer">
<h2>Print My Snap Blog</h2>
 
<!--<ul class="breadcrumb">
<li><a href="<?=DEFAULT_URL?>">Home</a></li>
<li class="active">Blog</li>
</ul> -->
</div>
</div>
</div>
 
 
<div class="cp-main-content">
 
<section class="cp-blog-section pd-tb60">
<div class="container">
<div class="row">
<div class="col-md-9">
 
<div class="cp-blog-item cp-blog-detail">
 
<figure class="cp-thumb">
<img src="<?=DEFAULT_URL?>/userfiles/blog_img/<?=$resultBlog->blogbigImage?>" alt="">
</figure> 
<div class="cp-text">
<h3><?=$resultBlog->title?></h3>
<ul class="post-meta">
<?php $dateblog = $resultBlog->createdDatetime; ?>
<li><i class="fa fa-calendar"></i> <?=date("d F, Y", strtotime($dateblog))?></li>
<li><i class="fa fa-clock-o"></i><?=date(" h:i A", strtotime($dateblog))?></li>
</ul>
<p><?=$resultBlog->description?></p>
<blockquote class="cp-blockquote">
<p><?=$resultBlog->shortDes?></p>
</blockquote>

</div>
 
<div class="cp-form-box">
<h2>Leave a Comment</h2>
<form action="" method="post">
<div class="row">
<div class="col-md-4 col-sm-4">
<div class="inner-holder">
<input type="text" placeholder="Your Name" name="name1" required pattern="[a-zA-Z ]+">
</div>
</div>
<div class="col-md-4 col-sm-4">
<div class="inner-holder">
<input type="text" placeholder="Your Email" name="email1" required pattern="^[a-zA-Z0-9-\_.]+@[a-zA-Z0-9-\_.]+\.[a-zA-Z0-9.]{2,5}$">
</div>
</div>
<div class="col-md-4 col-sm-4">
<div class="inner-holder">
<input type="text" placeholder="Subject" name="subject1" required pattern="[a-zA-Z ]+">
</div>
</div>
<div class="col-md-12 col-sm-12">
<div class="inner-holder">
<textarea placeholder="Comments" name="comment1" required></textarea>
</div>
</div>
<div class="col-md-12 col-sm-12">
<div class="inner-holder cp-btn-holder">
<button type="submit" class="btn-submit" value="Submit" name="submit1">Submit Comment</button>
</div>
</div>
</div>
</form>
</div> 
</div>
 
</div>

<?php include('includes/blog_sidebar.php'); ?>

</div>
</div>
</section> 
</div>
 
 <?php
	include('includes/footer.php');
	include('includes/common_js.php');
?>