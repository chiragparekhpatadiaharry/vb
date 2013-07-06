<?php include_once "includes/checksession.php"; ?>
<?php include_once "includes/connection.php"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
<title>Home</title>

<link href="css/main.css" rel="stylesheet" type="text/css" />
<!--<link href="css/pagination.css" rel="stylesheet" type="text/css" />-->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>

<script type="text/javascript" src="js/plugins/spinner/ui.spinner.js"></script>
<script type="text/javascript" src="js/plugins/spinner/jquery.mousewheel.js"></script>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>

<script type="text/javascript" src="js/plugins/charts/excanvas.min.js"></script>
<script type="text/javascript" src="js/plugins/charts/jquery.sparkline.min.js"></script>

<script type="text/javascript" src="js/plugins/forms/uniform.js"></script>
<script type="text/javascript" src="js/plugins/forms/jquery.cleditor.js"></script>
<script type="text/javascript" src="js/plugins/forms/jquery.validationEngine-en.js"></script>
<script type="text/javascript" src="js/plugins/forms/jquery.validationEngine.js"></script>
<script type="text/javascript" src="js/plugins/forms/jquery.tagsinput.min.js"></script>
<script type="text/javascript" src="js/plugins/forms/autogrowtextarea.js"></script>
<script type="text/javascript" src="js/plugins/forms/jquery.maskedinput.min.js"></script>
<script type="text/javascript" src="js/plugins/forms/jquery.dualListBox.js"></script>
<script type="text/javascript" src="js/plugins/forms/jquery.inputlimiter.min.js"></script>
<script type="text/javascript" src="js/plugins/forms/chosen.jquery.min.js"></script>

<script type="text/javascript" src="js/plugins/wizard/jquery.form.js"></script>
<script type="text/javascript" src="js/plugins/wizard/jquery.validate.min.js"></script>
<script type="text/javascript" src="js/plugins/wizard/jquery.form.wizard.js"></script>

<script type="text/javascript" src="js/plugins/uploader/plupload.js"></script>
<script type="text/javascript" src="js/plugins/uploader/plupload.html5.js"></script>
<script type="text/javascript" src="js/plugins/uploader/plupload.html4.js"></script>
<script type="text/javascript" src="js/plugins/uploader/jquery.plupload.queue.js"></script>

<script type="text/javascript" src="js/plugins/tables/datatable.js"></script>
<script type="text/javascript" src="js/plugins/tables/tablesort.min.js"></script>
<script type="text/javascript" src="js/plugins/tables/resizable.min.js"></script>

<script type="text/javascript" src="js/plugins/ui/jquery.tipsy.js"></script>
<script type="text/javascript" src="js/plugins/ui/jquery.collapsible.min.js"></script>
<script type="text/javascript" src="js/plugins/ui/jquery.prettyPhoto.js"></script>
<script type="text/javascript" src="js/plugins/ui/jquery.progress.js"></script>
<script type="text/javascript" src="js/plugins/ui/jquery.timeentry.min.js"></script>
<script type="text/javascript" src="js/plugins/ui/jquery.colorpicker.js"></script>
<script type="text/javascript" src="js/plugins/ui/jquery.jgrowl.js"></script>
<script type="text/javascript" src="js/plugins/ui/jquery.breadcrumbs.js"></script>
<script type="text/javascript" src="js/plugins/ui/jquery.sourcerer.js"></script>

<script type="text/javascript" src="js/plugins/calendar.min.js"></script>
<script type="text/javascript" src="js/plugins/elfinder.min.js"></script>

<script type="text/javascript" src="js/custom.js"></script>





<!-- -->

<!-- Shared on MafiaShare.net  --><!-- Shared on MafiaShare.net  --></head>

<body>

<?php include_once "includes/leftside.php";?>

<?php include_once "includes/rightside.php";?>    
    <!-- Title area -->
    <div class="titleArea">
        <div class="wrapper">
            <div class="pageTitle">
                <h5>Blog Reply</h5>
                <span>Manage Blog Reply</span>
            </div>
            <div class="clear"></div>
        </div>
    </div>
    
    <div class="line"></div>
    
    <!-- Main content wrapper -->
    <div class="wrapper">                             






        <div class="widget">
            <div class="title"><img src="images/icons/dark/pencil.png" alt="" class="titleIcon" /><h6>New Post</h6></div>

            <form id="validate" class="form" method="post" action="<?php echo $_SERVER['PHP_SELF']?>">                  
                    <div class="formRow">                        
                        <div style="margin:10px"><textarea rows="8" name="post_content" class="validate[required]" id="post_content"></textarea></div><div class="clear"></div>
                    </div>           
                
                    <input class="blueB ml10 ui-wizard-content ui-formwizard-button" type="submit" name="submit" value="Post" style="float: right;margin:10px" />
                                            
            </form>
            
            <div style="clear: both;"></div>
        </div>
        <br />
        <div class="line"></div>

<?php    
    //insert current user post
    if(isset($_POST['submit'])){        
        date_default_timezone_set('Asia/Kolkata');
        $user_id=mysql_real_escape_string($_SESSION['user_id']);        
        $post_content=mysql_real_escape_string($_POST['post_content']);
        $date = date('Y-m-d H:i:s');
        $con=new MySQL();
        $query="insert into user_post(user_id,post_content,post_datetime) values($user_id,'$post_content','$date')";
        $affected_row = mysql_query($query);
        //echo "<br />Affected Rows : ".$affected_row."<br />";
        $con->CloseConnection();
    }
?>



<?php
	/*
		Place code to connect to your DB here.
	*/
    //disply all user posts
    $con=new MySQL(); 
	$tbl_name="user_post";		//your table name
	// How many adjacent pages should be shown on each side?
	$adjacents = 3;
	
	/* 
	   First get total number of rows in data table. 
	   If you have a WHERE clause in your query, make sure you mirror it here.
	*/
	$query = "SELECT COUNT(*) as num FROM $tbl_name";
	$total_pages = mysql_fetch_array(mysql_query($query));
    $totalcount=$total_pages;
	$total_pages = $total_pages[num];
	
	/* Setup vars for query. */
	$targetpage = "blog-reply.php"; 	//your file name  (the name of this file)
	$limit = 5; 								//how many items to show per page
	$page = $_GET['page'];
	if($page) 
		$start = ($page - 1) * $limit; 			//first item to display on this page
	else
		$start = 0;								//if no page var is given, set start to 0
	
	/* Get data. */
    $sql="select u.id as post_id,u.user_id as user_id,concat(ur.firstname,' ',ur.lastname) as user_name,u.post_content as post_content,u.post_datetime as post_datetime from $tbl_name u,user_registration ur where u.user_id=ur.id order by u.post_datetime desc LIMIT $start, $limit";    
	//$sql = "SELECT column_name FROM $tbl_name LIMIT $start, $limit";
	$result = mysql_query($sql);
	
	/* Setup page vars for display. */
	if ($page == 0) $page = 1;					//if no page var is given, default to 1.
	$prev = $page - 1;							//previous page is page - 1
	$next = $page + 1;							//next page is page + 1
	$lastpage = ceil($total_pages/$limit);		//lastpage is = total pages / items per page, rounded up.
	$lpm1 = $lastpage - 1;						//last page minus 1
	
	/* 
		Now we apply our rules and draw the pagination object. 
		We're actually saving the code to a variable in case we want to draw it more than once.
	*/
	$pagination = "";
	if($lastpage > 1)
	{	
		$pagination .= "<div class=\"pagination\"><ul class=\"pages\">";
		//previous button
		if ($page > 1)         
			//$pagination.= "<li class=\"prev\"><a href=\"$targetpage?page=$prev\"><</a></li>";
            $pagination.= "<li class=\"prev\"><a href=\"$targetpage?page=$prev\">Previous</a></li>";
		else
			//$pagination.= "<span class=\"disabled\"><< Previous</span>";
            //$pagination.= "<li class=\"prev\"><a href=\"#\"><</a></li>";
            $pagination.= "<li class=\"prev fg-button ui-button ui-state-disabled\">Previous</li>";
            	
		
		//pages	
		if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
		{	
			for ($counter = 1; $counter <= $lastpage; $counter++)
			{
				if ($counter == $page)                
					//$pagination.= "<span class=\"current\">$counter</span>";
                    $pagination.= "<li><a href=\"#\" class=\"active\">$counter</a></li>";
				else
					//$pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";
                    $pagination.= "<li><a href=\"$targetpage?page=$counter\">$counter</a></li>";					
			}
		}
		elseif($lastpage > 5 + ($adjacents * 2))	//enough pages to hide some
		{
			//close to beginning; only hide later pages
			if($page < 1 + ($adjacents * 2))		
			{
				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
				{
					if ($counter == $page)
						//$pagination.= "<span class=\"current\">$counter</span>";
                        $pagination.= "<li><a href=\"#\" class=\"active\">$counter</a></li>";
					else
						//$pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";
                        $pagination.= "<li><a href=\"$targetpage?page=$counter\">$counter</a></li>";					
				}
				$pagination.= "...";
				$pagination.= "<li><a href=\"$targetpage?page=$lpm1\">$lpm1</a></li>";
				$pagination.= "<li><a href=\"$targetpage?page=$lastpage\">$lastpage</a></li>";		
			}
			//in middle; hide some front and some back
			elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
			{
				$pagination.= "<li><a href=\"$targetpage?page=1\">1</a></li>";
				$pagination.= "<li><a href=\"$targetpage?page=2\">2</a></li>";
				$pagination.= "...";
				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
				{
					if ($counter == $page)
						//$pagination.= "<span class=\"current\">$counter</span>";
                        $pagination.= "<li><a href=\"#\" class=\"active\">$counter</a></li>";
					else
						//$pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";
                        $pagination.= "<li><a href=\"$targetpage?page=$counter\">$counter</a></li>";					
				}
				$pagination.= "...";
//				$pagination.= "<a href=\"$targetpage?page=$lpm1\">$lpm1</a>";
//				$pagination.= "<a href=\"$targetpage?page=$lastpage\">$lastpage</a>";
				$pagination.= "<li><a href=\"$targetpage?page=$lpm1\">$lpm1</a></li>";
				$pagination.= "<li><a href=\"$targetpage?page=$lastpage\">$lastpage</a></li>";		
			}
			//close to end; only hide early pages
			else
			{
				//$pagination.= "<a href=\"$targetpage?page=1\">1</a>";
				//$pagination.= "<a href=\"$targetpage?page=2\">2</a>";
				$pagination.= "<li><a href=\"$targetpage?page=1\">1</a></li>";
				$pagination.= "<li><a href=\"$targetpage?page=2\">2</a></li>";                
				$pagination.= "...";
				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
						//$pagination.= "<span class=\"current\">$counter</span>";
                        $pagination.= "<li><a href=\"#\" class=\"active\">$counter</a></li>";
					else
						//$pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";
                        $pagination.= "<li><a href=\"$targetpage?page=$counter\">$counter</a></li>";					
				}
			}
		}
		
		//next button
		if ($page < $counter - 1) 
			//$pagination.= "<a href=\"$targetpage?page=$next\">Next >></a>";
            $pagination.= "<li class=\"next\"><a href=\"$targetpage?page=$next\">Next</a></li>";
		else
			//$pagination.= "<span class=\"disabled\">Next >></span>";
            $pagination.= "<li class=\"next fg-button ui-button ui-state-disabled\">Next</li>";
		$pagination.= "</ul></div>\n";		
	}
?>

	<?php        
        if(mysql_num_rows($result)>0){
		while($r = mysql_fetch_array($result)){
?>          
    <div id="post">
        <div id="content" style="width: 100%;margin: 10px;">
            <div class="widget" style="margin-top: 20px;">
                
                <div class="title"><img src="images/icons/dark/pencil.png" alt="" class="titleIcon" /><h6><a href="#"><?php echo $r["user_name"];?></a></h6></div>
                <div style="margin: 5px;">    
                    <?php echo $r["post_content"];?><br />
                    <div id="postDate" style="margin-left: 30px;">
                        <?php
                        date_default_timezone_set('Asia/Kolkata');
                        $date = date('F d', strtotime($r["post_datetime"]));                        
                        ?>
                        <a href="#"><?php echo $date; ?></a></a> | <a href="delete-post.php?postid=<?php echo $r["post_id"];?>" onclick="return confirm('Are you sure you want to delete this post?')">Delete Post</a>
                    </div>
                </div>
                
            </div>        
        
            
            
        </div>
        <div id="allreply" style="width: 85%;margin-left:40px;">
            <?php   
                //show all previous reply                         
                $queryr="select upr.id as id,upr.post_id as post_id,upr.user_id as user_id,concat(ur.firstname,' ',ur.lastname) as user_name,upr.reply_content as reply_content,upr.reply_datetime as reply_datetime,upr.isapprove as isapprove from user_post_reply upr,user_registration ur where upr.user_id=ur.id and upr.post_id=".$r["post_id"];
                
                $replies=mysql_query($queryr);
                while($reply=mysql_fetch_array($replies)){
                   //print_r($reply);
            ?>
                <!-- Full width -->
                <div class="widget" style="margin-top: 15px;">
                    <div class="title"><h6><a href="#"><?php echo $reply["user_name"];?></a></h6><div class="clear"></div></div>
                        <div style="margin:5px">                
                            <?php echo $reply["reply_content"];?>
                            <div id="replyDate" style="margin-left: 30px;">
                                <?php
                                    //l, F d y h:i:s
                                    $newDate = date('d F  h:i A', strtotime($reply["reply_datetime"]));
                                    $newTime = date('h:i A', strtotime($reply["reply_datetime"]));
                                ?>
                                <a href="#"><?php echo $newDate.' at '.$newTime;?></a> | <a onclick="javascript:return confirm('Are you sure you want to delete reply?')" href="delete-reply.php?rid=<?php echo $reply["id"];?>">Delete Reply</a>
                                
                            </div>
                        </div>
                </div>                    
                       
            <?php 
                }
                //echo $queryr;
            ?>
        </div>
        
        
        <!-- Full width -->
         <div id="reply" style="margin-left:40px;width:85%;">
                <div class="widget" style="margin-top: 15px;">
                    <?php
                        include_once("includes/functions.php");    
                        $fun=new MyFunction();
                        $name=$fun->getUserNameFromId($_SESSION['user_id']);                                        
                    ?>                                    
                    <div class="title"><h6><a href="#"><?php echo $name;?></a></h6><div class="clear"></div></div>                   
                    
                        <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                            <textarea name="reply_content" style="margin:10px;width:80%;height:30px;float:left" placeholder="Write your reply..." rows="1"></textarea>
                            <input type="hidden" name="post_id" value="<?php echo $r["post_id"] ?>" />                                                     
                           <div style="float: right;"> <input style="margin: 10px;" type="submit" class="greenB ui-formwizard-button" name="submitreply<?php echo $r["post_id"];?>" value="Reply" /></div>
                        </form>
                        <div style="clear: both;"></div>
                        <?php
                            //reply
                            if(isset($_POST['submitreply'.$r["post_id"]])){
                                $reply_content=mysql_real_escape_string($_POST['reply_content']);
                                $post_id=mysql_real_escape_string($_POST['post_id']);
                                $user_id=mysql_real_escape_string($_SESSION['user_id']);;
                                $date = date('Y-m-d H:i:s');                    
                                $query="insert into user_post_reply(post_id,user_id,reply_content,reply_datetime) values($post_id,$user_id,'$reply_content','$date')";                                        
                                $affected_row = mysql_query($query);                                        
                            }
                        ?>
                    </div>
         </div>       
    </div>  
    <?php 		  
		}
        }else{
            include_once("includes/message.php");
            $msg = new Message();
            $msg->information("No post found");
        }
	?>
<?=$pagination?>
<?php $con->CloseConnection(); ?>        
  </div>    
    
   
<?php include_once "includes/footer.php";?>   

</body>
</html>