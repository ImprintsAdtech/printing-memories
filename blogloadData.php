<?php
include_once("conf/loadconfig.inc.php"); 

	extract($_POST);
	extract($_GET);
	$blogId;
	$obj_Blog= new Blogmanager();
	$obj_user= new Usermanager();

	$recentBlogSidebar = $obj_Blog->getAllBlogRecent();
	$recentBlogData = $obj_Blog->getAllBlogActive();


$count  = $db->numRows($recentBlogData);
$page = (int) (!isset($pageId) ? 1 :$pageId);
$page = ($page == 0 ? 1 : $page);
$recordsPerPage = 2;
$start = ($page-1) * $recordsPerPage;
$adjacents = "2";
    
$prev = $page - 1;
$next = $page + 1;
$lastpage = ceil($count/$recordsPerPage);
$lpm1 = $lastpage - 1;   
$pagination = "";
if($lastpage > 1)
    {   
        $pagination .= "<div class='pagination-box'><nav><ul class='pagination'>";
        if ($page > 1)
            $pagination.= "<li><a href=\"#Page=".($prev)."\" aria-label='Previous' onClick='changePagination(".($prev).");'><span aria-hidden='true'>Previous</span></a></li>";
        else
            $pagination.= "<li><a href='javascript:void(0)' style='pointer-events:none;'><span aria-hidden='true'>Previous</span></a></li>";   
        if ($lastpage < 7 + ($adjacents * 2))
        {   
            for ($counter = 1; $counter <= $lastpage; $counter++)
            {
                if ($counter == $page)
                    $pagination.= "<li class='active'><a href='javascript:void(0)'>$counter</a></li>";
                else
                    $pagination.= "<li><a href=\"#Page=".($counter)."\" onClick='changePagination(".($counter).");'>$counter</a></li>";     
                         
            }
        }
        elseif($lastpage > 5 + ($adjacents * 2))
        {
            if($page < 1 + ($adjacents * 2))
            {
                for($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
                {
                    if($counter == $page)
                        $pagination.= "<li class='active'><a href='javascript:void(0)'>$counter</a></li>";
                    else
                        $pagination.= "<li><a href=\"#Page=".($counter)."\" onClick='changePagination(".($counter).");'>$counter</a></li>";     
                }
                $pagination.= "...";
                $pagination.= "<a href=\"#Page=".($lpm1)."\" onClick='changePagination(".($lpm1).");'>$lpm1</a>";
                $pagination.= "<a href=\"#Page=".($lastpage)."\" onClick='changePagination(".($lastpage).");'>$lastpage</a>";   
           
           }
           elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
           {
               $pagination.= "<a href=\"#Page=\"1\"\" onClick='changePagination(1);'>1</a>";
               $pagination.= "<a href=\"#Page=\"2\"\" onClick='changePagination(2);'>2</a>";
               $pagination.= "...";
               for($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
               {
                   if($counter == $page)
                       $pagination.= "<li class='active'><a href='javascript:void(0)'>$counter</a></li>";
                   else
                       $pagination.= "<li><a href=\"#Page=".($counter)."\" onClick='changePagination(".($counter).");'>$counter</a></li>";     
               }
               $pagination.= "..";
               $pagination.= "<a href=\"#Page=".($lpm1)."\" onClick='changePagination(".($lpm1).");'>$lpm1</a>";
               $pagination.= "<a href=\"#Page=".($lastpage)."\" onClick='changePagination(".($lastpage).");'>$lastpage</a>";   
           }
           else
           {
               $pagination.= "<a href=\"#Page=\"1\"\" onClick='changePagination(1);'>1</a>";
               $pagination.= "<a href=\"#Page=\"2\"\" onClick='changePagination(2);'>2</a>";
               $pagination.= "..";
               for($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
               {
                   if($counter == $page)
                        $pagination.= "<li class='active'><a href='javascript:void(0)'>$counter</a></li>";
                   else
                        $pagination.= "<li><a href=\"#Page=".($counter)."\" onClick='changePagination(".($counter).");'>$counter</a></li>";     
               }
           }
        }
        if($page < $counter - 1)
            $pagination.= "<li><a href=\"#Page=".($next)."\" aria-label='Next' onClick='changePagination(".($next).");'> <span aria-hidden='true'>Next</span></a></li>";
        else
            $pagination.= "<li><a href='javascript:void(0)' style='pointer-events:none;'> <span aria-hidden='true'>Next</span></a></li>";
        
        $pagination.= "</div>";       
    }
    
if(isset($_POST['pageId']) && !empty($_POST['pageId']))
{
    $id=$_POST['pageId'];
}
else
{
    $id='0';
}
$query="select * from blog order by blogId DESC
limit ".mysql_real_escape_string($start).",$recordsPerPage";
//echo $query;
$res    =   mysql_query($query);
$count  =   mysql_num_rows($res);
$HTML='';
if($count > 0)
{
    while($row=mysql_fetch_array($res))
    {
		
		$date = $row['createdDatetime'];
		
		$blogCateId = $row['blogCateId'];
		
		$blogCate = $obj_Blog->getAllBlogcateDetail($blogCateId);
		  

        $HTML.='<div class="cp-blog-item">
 
<figure class="cp-thumb">
<img src="'.DEFAULT_URL.'/userfiles/blog_img/'.$row['blogbigImage'].'" alt="blog">
<figcaption class="cp-caption">
<a href="'.DEFAULT_URL.'/blog/'.$blogCate->finalSlug.'/'.$row['finalSlug'].'"><i class="fa fa-link"></i></a>
</figcaption>
</figure> 
<div class="cp-text">
<h3><a href="'.DEFAULT_URL.'/blog/'.$blogCate->finalSlug.'/'.$row['finalSlug'].'">'.$row['title'].'</a> </h3>

<ul class="post-meta">
<li><i class="fa fa-calendar"></i> '.date("d F, Y", strtotime($date)).'</li>
<li><i class="fa fa-clock-o"></i>'.date(" h:i A", strtotime($date)).'</li>
</ul>
<p>'.$row['shortDes'].'</p>
<a href="'.DEFAULT_URL.'/blog/'.$blogCate->finalSlug.'/'.$row['finalSlug'].'" class="read-btn">Read More</a>
</div>
</div> ';
    }
}
else
{
    $HTML='No Data Found';
}
echo $HTML;
echo $pagination;
?>