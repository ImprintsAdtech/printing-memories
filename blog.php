<?php

include_once("conf/loadconfig.inc.php"); 



	extract($_POST);

	extract($_GET);

	$blogId;

	$obj_Blog= new Blogmanager();

	$obj_user= new Usermanager();

	$obj_product = new Productmanager();



	$recentBlogSidebar = $obj_Blog->getAllBlogRecent();

	$recentBlogData = $obj_Blog->getAllBlogActive();

?>

<!DOCTYPE html>

<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Printmysnap - Free Photos for Lifetime | Blog</title>
<?php 

		include('includes/common_css.php');

		include('includes/header.php');

?>

<div class="cp-inner-banner">
  <div class="container">
    <div class="cp-inner-banner-outer">
      <h2>Printmysnap Blog</h2>
      
      <!--<ul class="breadcrumb">

<li><a href="index.html">Home</a></li>

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
          <div id="pageData"></div>
          <center>
            <span class="flash"></span>
          </center>
        </div>
        <?php //include('includes/blog_sidebar.php'); ?>
      </div>
    </div>
  </section>
</div>
<?php

	include('includes/footer.php');

	include('includes/common_js.php');

	include('blog_script.php');

?>
