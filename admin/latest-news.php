<?php include_once "includes/checksession.php"; ?>
<?php 
    include_once "includes/message.php";
    $msg=new Message();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
<title>Latest News</title>

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
                <h5>Latest News</h5>
               <!--<span>Manage Photo Album.</span>-->
            </div>
            <div class="clear"></div>
        </div>
    </div>
    
    <div class="line"></div>
    
    <!-- Main content wrapper -->
    <div class="wrapper">
        <br />
        <a style="margin: 5px;" class="button blueB" title="" href="add-new-latest-news.php">
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
                      if(mysql_query("delete from latest_news where id in(".$qid.")")){
                        $msg->success("Selected news deleted successfully");}
                      else{
                        $msg->error("We are unable to delete selected news. Please try again.");}
                      $con->CloseConnection();
                }
                else{
                    $msg->warning("Select at least one news.");}
            }
        ?>
        
        <div class="widget" style="margin-top:20px;">
            <div class="title"><span class="titleIcon"><input type="checkbox" name="titleCheck" id="titleCheck" /></span><h6>Latest News</h6></div>
            <form onsubmit="javascript: return confirm('Do you really want to delete selected news?');" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
            <table width="100%" cellspacing="0" cellpadding="0" id="checkAll" class="sTable withCheck mTable">
                <thead>
                    <tr>
                        <td><img alt="" src="images/icons/tableArrows.png"></td>
                        <td class="sortCol">Date</td>
                        <td>Title</td>
                        <td>Description</td>
                        <td style="width: 11%;">Actions</td>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <td colspan="5">
                            <div style="float: left;" class="formSubmit">
                                <input name="btnDelete" class="redB" type="submit" value="Delete Selected" />
                            </div>
                        </td>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                        include_once "includes/connection.php";
                        $con=new MySQL();
                        
                        //$found=false;
                        $rs=mysql_query("select count(id) from latest_news");
                        $r=mysql_fetch_array($rs);
                        $numRows=intval($r[0]);                       
                        if($numRows>0)
                        {
                            //$found=true;
                            //$records_per_page = 2;
                            //require 'includes/Zebra_Pagination.php';
                            //$pagination = new Zebra_Pagination();
                            //$pagination->reverse(true);                     
                            //$pagination->records($numRows);                        
                            //$pagination->records_per_page($records_per_page);
                            $mySQL = '
                                SELECT
                                    *
                                FROM
                                    latest_news
                                ORDER BY
                                    id desc';
                            /*    LIMIT
                                    ' . (($pagination->get_pages() - $pagination->get_page()) * $records_per_page) . ', ' . $records_per_page . '
                            ';*/
                            if (!($result = @mysql_query($mySQL)))
                                die(mysql_error());
                            
                        ?>       
                            <?php //$index = 0?>
                        
                            <?php while ($r = mysql_fetch_assoc($result)):?>
                            <tr<?php //echo $index++ % 2 ? ' class="even"' : ''?>>
                                <td>
                                    <input value="<?php echo $r['id'] ?>" type="checkbox" name="checkRow[]" id="checkRow<?php echo $r['id'] ?>" id="titleCheck2" />
                                </td>
                                <td align="left"><?php echo $r["news_date"]; ?></td>
                                <td align="left">
                                    <?php echo $r["title"]; ?>
                                </td>
                                <td align="left">
                                    <?php echo $r["description"]; ?>
                                </td>
                                <td class="actBtns">
                                    <a class="tipS" title="Update" href="update-latest-news.php?q=<?php echo $r["id"];?>">
                                        <img alt="" src="images/icons/edit.png" />
                                    </a>
                                    <a onclick="javascript: return confirm('Do you really want to delete this news?');" class="tipS" title="Remove" href="delete-latest-news.php?q=<?php echo $r["id"];?>">
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
                                    <td colspan="5">
                        <?php
                                        $msg->information("No news found.");
                        ?>
                                    </td>
                                </tr>
                        <?php
                            }
                            $con->CloseConnection();
                        ?>        
                </tbody>
            </table>
            <div>
                <?php //($found)?$pagination->render():"";?> 
            </div>
            </form>
        </div>
    </div>
    
<?php include_once "includes/footer.php";?>   

</body>
</html>