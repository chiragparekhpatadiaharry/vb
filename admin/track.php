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
            if(isset($_POST['btnDelete']))
            {
                $ids=$_POST['checkRow'];
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
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
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
                        if(isset($_POST['lstAlbum']) && $_POST['lstAlbum']!="-1" && $r['id']==$_POST['lstAlbum'])
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
                        <td style="width: 11%;">Actions</td>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <td colspan="5">
                            <div style="float: left;" class="formSubmit">
                                <input onclick="javascript: return confirm('Do you really want to delete selected photo?');" name="btnDelete" class="redB" type="submit" value="Delete Selected" />
                            </div>
                            <!--
                            <div class="itemActions">
                                <label>Apply action:</label>
                                <select>
                                    <option value="">Select action...</option>
                                    <option value="Delete">Delete</option>
                                </select>
                            </div>
                            -->
                            <!--
                                <div class="tPagination">
                                <ul>
                                    <li class="prev"><a title="" href="#"></a></li>
                                    <li><a title="" href="#">1</a></li>
                                    <li><a title="" href="#">2</a></li>
                                    <li><a title="" href="#">3</a></li>
                                    <li><a title="" href="#">4</a></li>
                                    <li><a title="" href="#">5</a></li>
                                    <li><a title="" href="#">6</a></li>
                                    <li>...</li>
                                    <li><a title="" href="#">20</a></li>
                                    <li class="next"><a title="" href="#"></a></li>
                                </ul>
                            </div>
                            -->
                        </td>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                        include_once "includes/connection.php";
                        $con=new MySQL();
                        $q="";
                        if(isset($_POST['btnFilter']) && $_POST['lstAlbum']!="-1")
                        {
                            $aid=$_POST['lstAlbum'];
                            $q="select * from track_media_gallery where album_id=".$aid." order by id";
                        }
                        else
                        {
                            $q="select * from track_media_gallery order by id";
                        }
                        $rs=mysql_query($q);
                        if(mysql_num_rows($rs)>0)
                        {
                            while($r=mysql_fetch_array($rs))
                            {
                    ?>       
                        
                    <tr>
                        <td>
                            <input value="<?php echo $r['id'] ?>" type="checkbox" name="checkRow[]" id="checkRow<?php echo $r['id'] ?>" id="titleCheck2" />
                        </td>
                        <td align="left"><?php echo $r["name"]; ?></td>
                        <td align="center">
                            <div><?php echo $r["path"]; ?></div>
                        </td>
                        <td>
                            <?php echo $r["description"]; ?>
                        </td>                     
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
                        else
                        {
                    ?>
                            <tr>
                                <td colspan="5">
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
            </form>
        </div>
    
    </div>
    
<?php include_once "includes/footer.php";?>   

</body>
</html>