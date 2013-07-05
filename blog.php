<html>
    <head>
        <title>
            Blog
        </title> 
        <link href="css/pagination.css" rel="stylesheet" type="text/css" />          
    </head>
    <body>
    <div id="content" style="width: 500px;margin:0px auto">
<?php
    include_once("admin/includes/connection.php");
?>
<form method="post" action="<?php echo $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']?>">
    <input type="text" name="user_id" />
    <br />
    <textarea id="post_content" name="post_content" style="width: 100%;" placeholder="Whats on your mind"></textarea>
    <input type="submit" name="submit" value="Post" />
</form>
<?php    
    //insert current user post
    if(isset($_POST['submit'])){        
        date_default_timezone_set('Asia/Kolkata');
        $user_id=mysql_real_escape_string($_POST['user_id']);        
        $post_content=mysql_real_escape_string($_POST['post_content']);
        $date = date('Y-m-d H:i:s');
        $con=new MySQL();
        $query="insert into user_post(user_id,post_content,post_datetime) values($user_id,'$post_content','$date')";
        $affected_row = mysql_query($query);
        echo "<br />Affected Rows : ".$affected_row."<br />";
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
	$total_pages = $total_pages[num];
	
	/* Setup vars for query. */
	$targetpage = "blog.php"; 	//your file name  (the name of this file)
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
		$pagination .= "<div class=\"pagination\">";
		//previous button
		if ($page > 1) 
			$pagination.= "<a href=\"$targetpage?page=$prev\"><< Previous</a>";
		else
			$pagination.= "<span class=\"disabled\"><< Previous</span>";	
		
		//pages	
		if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
		{	
			for ($counter = 1; $counter <= $lastpage; $counter++)
			{
				if ($counter == $page)
					$pagination.= "<span class=\"current\">$counter</span>";
				else
					$pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";					
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
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";					
				}
				$pagination.= "...";
				$pagination.= "<a href=\"$targetpage?page=$lpm1\">$lpm1</a>";
				$pagination.= "<a href=\"$targetpage?page=$lastpage\">$lastpage</a>";		
			}
			//in middle; hide some front and some back
			elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
			{
				$pagination.= "<a href=\"$targetpage?page=1\">1</a>";
				$pagination.= "<a href=\"$targetpage?page=2\">2</a>";
				$pagination.= "...";
				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";					
				}
				$pagination.= "...";
				$pagination.= "<a href=\"$targetpage?page=$lpm1\">$lpm1</a>";
				$pagination.= "<a href=\"$targetpage?page=$lastpage\">$lastpage</a>";		
			}
			//close to end; only hide early pages
			else
			{
				$pagination.= "<a href=\"$targetpage?page=1\">1</a>";
				$pagination.= "<a href=\"$targetpage?page=2\">2</a>";
				$pagination.= "...";
				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";					
				}
			}
		}
		
		//next button
		if ($page < $counter - 1) 
			$pagination.= "<a href=\"$targetpage?page=$next\">Next >></a>";
		else
			$pagination.= "<span class=\"disabled\">Next >></span>";
		$pagination.= "</div>\n";		
	}
?>

	<?php
		while($r = mysql_fetch_array($result)){
?>          
    <div id="post">
        <div id="content" style="width: 100%;margin: 10px;background-color:#53C2FE ;">
            <a href="#"><?php echo $r["user_name"];?></a>
            <?php echo $r["post_content"];?><br />
            <div id="postDate" style="margin-left: 30px;">
                <?php
                date_default_timezone_set('Asia/Kolkata');
                $date = date('F d', strtotime($r["post_datetime"]));
                echo $date;
                ?>
            </div>
        </div>
        <div id="allreply" style="width: 85%;margin-left:30px;background-color:#AADAF4 ;">
            <?php   
                //show all previous reply                         
                $queryr="select upr.id as id,upr.post_id as post_id,upr.user_id as user_id,concat(ur.firstname,' ',ur.lastname) as user_name,upr.reply_content as reply_content,upr.reply_datetime as reply_datetime,upr.isapprove as isapprove from user_post_reply upr,user_registration ur where upr.user_id=ur.id and upr.post_id=".$r["post_id"];                
                $replies=mysql_query($queryr);
                while($reply=mysql_fetch_array($replies)){
                   //print_r($reply);
            ?>
                    
                       <br /><a href="#"><?php echo $reply["user_name"];?></a>
                        <?php echo $reply["reply_content"];?>
                        <div id="replyDate" style="margin-left: 30px;">
                            <?php
                                //l, F d y h:i:s
                                $newDate = date('d F  h:i A', strtotime($reply["reply_datetime"]));
                                $newTime = date('h:i A', strtotime($reply["reply_datetime"]));
                            ?>
                            <?php echo $newDate.' at '.$newTime;?>
                        </div>
            <?php 
                }
                //echo $queryr;
            ?>
        </div>
        <div id="reply" style="margin-left:30px">
            <form method="post" action="<?php echo $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']?>">
                <input type="text" name="reply_content" style="width:80%" placeholder="Write your reply..." />
                <input type="hidden" name="post_id" value="<?php echo $r["post_id"] ?>" />
                <input type="submit" name="submitreply<?php echo $r["post_id"];?>" value="Reply" />
            </form>
            <?php
                //reply
                if(isset($_POST['submitreply'.$r["post_id"]])){
                    $reply_content=mysql_real_escape_string($_POST['reply_content']);
                    $post_id=mysql_real_escape_string($_POST['post_id']);
                    $user_id=2;
                    $date = date('Y-m-d H:i:s');                    
                    $query="insert into user_post_reply(post_id,user_id,reply_content,reply_datetime) values($post_id,$user_id,'$reply_content','$date')";                                        
                    $affected_row = mysql_query($query);                                        
                }
            ?>
        </div>
    </div>  
<?php    
		}
	?>

<?=$pagination?>
	    <?php $con->CloseConnection(); ?>
    </div>
    </body>    
</html>