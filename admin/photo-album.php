<?php include_once "includes/checksession.php"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
<title>Photo Album</title>

<?php include_once "includes/common-css-js.php";?>

<link rel="stylesheet" href="css/zebra_pagination.css" type="text/css" />
<script type="text/javascript" src="js/zebra_pagination.js">
</script> 

<!-- Shared on MafiaShare.net  --><!-- Shared on MafiaShare.net  --></head>

<body>

<?php include_once "includes/leftside.php";?>



<?php include_once "includes/rightside.php";?>    
    <!-- Title area -->
    <div class="titleArea">
        <div class="wrapper">
            <div class="pageTitle">
                <h5>Photo Album</h5>
               <!--<span>Manage Photo Album.</span>-->
            </div>
            <div class="clear"></div>
        </div>
    </div>
    
    <div class="line"></div>
    
    <!-- Main content wrapper -->
    <div class="wrapper">
        <br />
        <a style="margin: 5px;" class="button blueB" title="" href="add-new-photo-album.php">
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
                      if(mysql_query("delete from album_photo_gallery where id in(".$qid.")"))
                      {
        ?>
                        <div class="nNote nSuccess hideit">
                            <p><strong>SUCCESS: </strong>Selected photo album deleted successfully.</p>
                        </div>
        <?php    
                      }
                      else
                      {
        ?>
                        <div class="nNote nFailure hideit">
                            <p><strong>FAILURE: </strong>Oops sorry. We are unable to delete selected photo album. Please try again.</p>
                        </div>
        <?php  
                      }
                      $con->CloseConnection();
                }
                else
                {
        ?>
                    <div class="nNote nWarning hideit">
                        <p><strong>WARNING: </strong>Select at least one photo album.</p>
                    </div>
        <?php
                }
          }
        ?>
        
        <div class="widget" style="margin-top:20px;">
            <div class="title"><span class="titleIcon"><input type="checkbox" name="titleCheck" id="titleCheck"></span><h6>Photo Album</h6></div>
            <form onsubmit="javascript: return confirm('Do you really want to delete selected photo album?');" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
            <table width="100%" cellspacing="0" cellpadding="0" id="checkAll" class="sTable withCheck mTable">
                <thead>
                    <tr>
                        <td><img alt="" src="images/icons/tableArrows.png"></td>
                        <td class="sortCol">Album Name</td>
                        <td style="width: 11%;">Actions</td>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <td colspan="3">
                            <div style="float: left;" class="formSubmit">
                                <input name="btnDelete" class="redB" type="submit" value="Delete Selected" />
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
                        
                        $found=false;
                        $rs=mysql_query("select count(id) from album_photo_gallery");
                        $r=mysql_fetch_array($rs);
                        $numRows=intval($r[0]);                       
                        if($numRows>0)
                        {
                            $found=true;
                            $records_per_page = 5;
                            require 'includes/Zebra_Pagination.php';
                            $pagination = new Zebra_Pagination();
                            $pagination->reverse(true);                      
                            $pagination->records($numRows);                        
                            $pagination->records_per_page($records_per_page);
                            $mySQL = '
                                SELECT
                                    *
                                FROM
                                    album_photo_gallery
                                ORDER BY
                                    id desc
                                LIMIT
                                    ' . (($pagination->get_pages() - $pagination->get_page()) * $records_per_page) . ', ' . $records_per_page . '
                            ';
                            if (!($result = @mysql_query($mySQL)))
                                die(mysql_error());
                        ?>       
                            <?php $index = 0?>
                        
                            <?php while ($r = mysql_fetch_assoc($result)):?>
                            <tr<?php echo $index++ % 2 ? ' class="even"' : ''?>>
                                <td>
                                    <input value="<?php echo $r['id'] ?>" type="checkbox" name="checkRow[]" id="checkRow<?php echo $r['id'] ?>" id="titleCheck2" />
                                </td>
                                <td align="left"><?php echo $r["name"]; ?></td>                        
                                <td class="actBtns">
                                    <a class="tipS" title="Update" href="update-photo-album.php?q=<?php echo $r["id"];?>">
                                        <img alt="" src="images/icons/edit.png" />
                                    </a>
                                    <a onclick="javascript: return confirm('Do you really want to delete this photo album?');" class="tipS" title="Remove" href="delete-photo-album.php?q=<?php echo $r["id"];?>">
                                        <img alt="" src="images/icons/remove.png" />
                                    </a>
                                </td>
                            </tr>
                            <?php endwhile?>
                        <?php
                            }
                            else
                            {
                        ?>
                               <tr>
                                    <td colspan="3">
                                        <div style="margin-top: 0px;" class="nNote nInformation hideit">
                                            <p><strong>INFORMATION: </strong>No photo album found.</p>
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
                <?php ($found)?$pagination->render():"";?> 
            </div>
            </form>
        </div>
    </div>
    
<?php include_once "includes/footer.php";?>   

</body>
</html>