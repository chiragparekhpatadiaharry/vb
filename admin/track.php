<?php include_once "includes/checksession.php"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
<title>Track</title>

<?php include_once "includes/common-css-js.php";?>

<!-- Shared on MafiaShare.net  --><!-- Shared on MafiaShare.net  --></head>

<body>

<?php include_once "includes/leftside.php";?>



<?php include_once "includes/rightside.php";?>    
    <!-- Title area -->
    <div class="titleArea">
        <div class="wrapper">
            <div class="pageTitle">
                <h5>Track</h5>
               <!--<span>Manage Photo Album.</span>-->
            </div>
            <div class="clear"></div>
        </div>
    </div>
    
    <div class="line"></div>
    
    <!-- Main content wrapper -->
    <div class="wrapper">
        <br />
        <a style="margin: 5px;" class="button blueB" title="" href="add-new-track.php">
            <img class="icon" alt="" src="images/icons/light/add.png" />
            <span>Add New</span>
        </a>
        <?php
            include_once("includes/checksession.php");
            if(isset($_GET['btnDelete']))
            {
                $ids=$_GET['checkRow'];
                if(count($ids)>0)
                {
                      include_once("includes/connection.php");         
                      $qid="";
                      foreach($ids as $id) 
                      {
             	        $qid.=$id.",";
                      }
                      $qid=substr($qid,0,strlen($qid)-1);
                      $con=new MySQL();
                      $rs=mysql_query("select path from track_media_gallery where id in(".$qid.")");
                      while($r=mysql_fetch_array($rs))
                      {
                        unlink("uploads/track/".$r['path']);
                      }
                      if(mysql_query("delete from track_media_gallery where id in(".$qid.")"))
                      {
        ?>
                        <div class="nNote nSuccess hideit">
                            <p><strong>SUCCESS: </strong>Selected track deleted successfully.</p>
                        </div>
        <?php
                        echo "<script type=\"text/javascript\">location.href='track.php';</script>";    
                      }
                      else
                      {
        ?>
                        <div class="nNote nFailure hideit">
                            <p><strong>FAILURE: </strong>Oops sorry. We are unable to delete selected track. Please try again.</p>
                        </div>
        <?php  
                      }
                      $con->CloseConnection();
                }
                else
                {
        ?>
                    <div class="nNote nWarning hideit">
                        <p><strong>WARNING: </strong>Select at least one track.</p>
                    </div>
        <?php
                }
          }
        ?>
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="get">
        <br />
        <select name="lstAlbum">
           <option selected="" value="-1">- - Select Album - -</option>
           <?php
                include_once "includes/connection.php";
                $con=new MySQL();
                $rs=mysql_query("select id,name from album_media_gallery");
                $s="";
                if(mysql_num_rows($rs)>0)
                {
                    while($r=mysql_fetch_array($rs))
                    {
                        if(isset($_GET['lstAlbum']) && $_GET['lstAlbum']!="-1" && $r['id']==$_GET['lstAlbum'])
                            $s="selected=\"\"";
                        else
                            $s="";
           ?>
                        <option <?php echo $s;?> value="<?php echo $r['id']; ?>"><?php echo $r['name']; ?></option>
           <?php
                    }
                }
                $con->CloseConnection();
           ?>
        </select>
        <div style="float: left;margin: 0px;margin-left:10px" class="formSubmit">
            <input name="btnFilter" class="greenB" type="submit" value="Filter" />
        </div>      
        <div class="clear"></div>
        
        <div class="widget" style="margin-top:5px;">
            <div class="title"><span class="titleIcon"><input type="checkbox" name="titleCheck" id="titleCheck" /></span><h6>Photo</h6></div>
            
            <table width="100%" cellspacing="0" cellpadding="0" id="checkAll" class="sTable withCheck mTable">
                <thead>
                    <tr>
                        <td><img alt="" src="images/icons/tableArrows.png" /></td>
                        <td class="sortCol">Photo Name</td>
                        <td>Media File</td>
                        <td>Description</td>
                        <td>Security</td>
                        <td style="width: 11%;">Actions</td>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <td colspan="6">
                            <div style="float: left;" class="formSubmit">
                                <input onclick="javascript: return confirm('Do you really want to delete selected photo?');" name="btnDelete" class="redB" type="submit" value="Delete Selected" />
                            </div>
                        </td>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                        include_once "includes/connection.php";
                        $con=new MySQL();
                        
                        $q="";
                        $found=false;
                        $numRows=0;
                        $rs=null;
                        $all=false;
                        $albumId=-1;
                        if(isset($_GET['lstAlbum']) && $_GET['lstAlbum']!="-1")
                        {
                            $all=false;
                            $albumId=$_GET['lstAlbum'];
                            $rs=mysql_query("select count(id) from track_media_gallery where album_id=".$albumId."");
                            $r=mysql_fetch_array($rs);
                            $numRows=intval($r[0]); 
                            if($numRows>0)
                            {
                                $found=true;
                                $q="select * from track_media_gallery where album_id=".$albumId." order by id";
                            }
                        }
                        else
                        {
                            $all=true;
                            $rs=mysql_query("select count(id) from track_media_gallery");
                            $r=mysql_fetch_array($rs);
                            $numRows=intval($r[0]); 
                            if($numRows>0)
                            {
                                $found=true;
                                $q="select * from track_media_gallery order by id";
                            }
                        }
                        
                       	$tbl_name="track_media_gallery";
                    	$adjacents = 3;
                        if($all)
                    	   $query = "SELECT COUNT(*) as num FROM $tbl_name";
                        else
                            $query = "SELECT COUNT(*) as num FROM $tbl_name where album_id=".$albumId;
                    	$total_pages = mysql_fetch_array(mysql_query($query));
                        $totalcount=$total_pages;
                    	$total_pages = $total_pages['num'];
                    	
                    	$targetpage = "track.php";
                    	$limit = 2; 								//how many items to show per page
                    	$page = isset($_GET['page'])?$_GET['page']:null;
                    	if($page) 
                    		$start = ($page - 1) * $limit; 			//first item to display on this page
                    	else
                    		$start = 0;
                            
                        $sql=$q." LIMIT $start, $limit";    
                    	$result = mysql_query($sql);
                    	
                    	if ($page == 0) $page = 1;					//if no page var is given, default to 1.
                    	$prev = $page - 1;							//previous page is page - 1
                    	$next = $page + 1;							//next page is page + 1
                    	$lastpage = ceil($total_pages/$limit);		//lastpage is = total pages / items per page, rounded up.
                    	$lpm1 = $lastpage - 1;						//last page minus 1
                    	
                    	$pagination = "";
                    	if($lastpage > 1)
                    	{	
                    		$pagination .= "<div style=\"margin-top:0px\" class=\"pagination\"><ul class=\"pages\">";
                    		if ($page > 1)         
                                $pagination.= "<li class=\"prev\"><a href=\"$targetpage?page=$prev&lstAlbum=$albumId\">Previous</a></li>";
                    		else
                                $pagination.= "<li class=\"prev fg-button ui-button ui-state-disabled\">Previous</li>";
                                	
                    		//pages	
                    		if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
                    		{	
                    			for ($counter = 1; $counter <= $lastpage; $counter++)
                    			{
                    				if ($counter == $page)                
                                        $pagination.= "<li><a href=\"#\" class=\"active\">$counter</a></li>";
                    				else
                                        $pagination.= "<li><a href=\"$targetpage?page=$counter&lstAlbum=$albumId\">$counter</a></li>";					
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
                                            $pagination.= "<li><a href=\"#\" class=\"active\">$counter</a></li>";
                    					else
                                            $pagination.= "<li><a href=\"$targetpage?page=$counter&lstAlbum=$albumId\">$counter</a></li>";					
                    				}
                    				$pagination.= "...";
                    				$pagination.= "<li><a href=\"$targetpage?page=$lpm1&lstAlbum=$albumId\">$lpm1</a></li>";
                    				$pagination.= "<li><a href=\"$targetpage?page=$lastpage&lstAlbum=$albumId\">$lastpage</a></li>";		
                    			}
                    			//in middle; hide some front and some back
                    			elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
                    			{
                    				$pagination.= "<li><a href=\"$targetpage?page=1&lstAlbum=$albumId\">1</a></li>";
                    				$pagination.= "<li><a href=\"$targetpage?page=2&lstAlbum=$albumId\">2</a></li>";
                    				$pagination.= "...";
                    				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
                    				{
                    					if ($counter == $page)
                                            $pagination.= "<li><a href=\"#\" class=\"active\">$counter</a></li>";
                    					else
                                            $pagination.= "<li><a href=\"$targetpage?page=$counter&lstAlbum=$albumId\">$counter</a></li>";					
                    				}
                    				$pagination.= "...";
                    				$pagination.= "<li><a href=\"$targetpage?page=$lpm1&lstAlbum=$albumId\">$lpm1</a></li>";
                    				$pagination.= "<li><a href=\"$targetpage?page=$lastpage&lstAlbum=$albumId\">$lastpage</a></li>";		
                    			}
                    			//close to end; only hide early pages
                    			else
                    			{
                    				$pagination.= "<li><a href=\"$targetpage?page=1&lstAlbum=$albumId\">1</a></li>";
                    				$pagination.= "<li><a href=\"$targetpage?page=2&lstAlbum=$albumId\">2</a></li>";                
                    				$pagination.= "...";
                    				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
                    				{
                    					if ($counter == $page)
                                            $pagination.= "<li><a href=\"#\" class=\"active\">$counter</a></li>";
                    					else
                                            $pagination.= "<li><a href=\"$targetpage?page=$counter&lstAlbum=$albumId\">$counter</a></li>";					
                    				}
                    			}
                    		}
                    		
                    		//next button
                    		if ($page < $counter - 1) 
                                $pagination.= "<li class=\"next\"><a href=\"$targetpage?page=$next&lstAlbum=$albumId\">Next</a></li>";
                    		else
                                $pagination.= "<li class=\"next fg-button ui-button ui-state-disabled\">Next</li>";
                    		$pagination.= "</ul></div>\n";
                        }
                        if($found)
                        {      
                            if(mysql_num_rows($result)>0){
                        		while($r = mysql_fetch_array($result))
                                {
                    ?>       
                        
                    <tr>
                        <td>
                            <input value="<?php echo $r['id'] ?>" type="checkbox" name="checkRow[]" id="checkRow<?php echo $r['id'] ?>" id="titleCheck2" />
                        </td>
                        <td align="left"><?php echo $r["name"]; ?></td>
                        <td align="left">
                            <div><?php echo $r["path"]; ?></div>
                        </td>
                        <td>
                            <?php echo $r["description"]; ?>
                        </td>
                        <td align="left"><?php echo $r["secure"]=="0"?"Allow Download":"Restrict Download"; ?></td>                     
                        <td class="actBtns">
                            <a class="tipS" title="Update" href="update-track.php?q=<?php echo $r["id"];?>">
                                <img alt="" src="images/icons/edit.png" />
                            </a>
                            <a onclick="javascript: return confirm('Do you really want to delete this track?');" class="tipS" title="Remove" href="delete-track.php?q=<?php echo $r["id"];?>">
                                <img alt="" src="images/icons/remove.png" />
                            </a>
                        </td>
                    </tr>
                    
                    <?php
                            }
                          }
                        }
                        else
                        {
                    ?>
                            <tr>
                                <td colspan="6">
                                    <div style="margin-top: 0px;" class="nNote nInformation hideit">
                                        <p><strong>INFORMATION: </strong>No track found.</p>
                                    </div>
                                </td>
                            </tr>
                    <?php
                        }
                        $con->CloseConnection();
                    ?>        
                </tbody>
            </table>
            <div>
                <?php echo $pagination;?>
            </div>
            </form>
        </div>
    
    </div>
    
<?php include_once "includes/footer.php";?>   

</body>
</html>