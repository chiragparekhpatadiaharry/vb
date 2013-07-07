<?php include_once "includes/checksession.php"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
<title>About us Category</title>
<?php include_once "includes/common-css-js.php";?>
<link href="css/main.css" rel="stylesheet" type="text/css" />
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
                <h5>About us Category</h5>
               <!--<span>Manage Photo Album.</span>-->
            </div>
            <div class="clear"></div>
        </div>
    </div>
    
    <div class="line"></div>
    
    <!-- Main content wrapper -->
    <div class="wrapper">
        <br />
        <a style="margin: 5px;" class="button blueB" title="" href="add-new-about-us-category.php">
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
                      if(mysql_query("delete from about_us_category where id in(".$qid.")"))
                      {
        ?>
                        <div class="nNote nSuccess hideit">
                            <p><strong>SUCCESS: </strong>Selected category deleted successfully.</p>
                        </div>
        <?php    
                      }
                      else
                      {
        ?>
                        <div class="nNote nFailure hideit">
                            <p><strong>FAILURE: </strong>Oops sorry. We are unable to delete selected category. Please try again.</p>
                        </div>
        <?php  
                      }
                      $con->CloseConnection();
                }
                else
                {
        ?>
                    <div class="nNote nWarning hideit">
                        <p><strong>WARNING: </strong>Select at least one category.</p>
                    </div>
        <?php
                }
          }
        ?>
        
        <div class="widget" style="margin-top:20px;">
            <div class="title"><span class="titleIcon"><input type="checkbox" name="titleCheck" id="titleCheck"></span><h6>Category</h6></div>
            <form onsubmit="javascript: return confirm('Do you really want to delete selected category?');" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
            <table width="100%" cellspacing="0" cellpadding="0" id="checkAll" class="sTable withCheck mTable">
                <thead>
                    <tr>
                        <td><img alt="" src="images/icons/tableArrows.png"></td>
                        <td class="sortCol">Category Name</td>
                        <td style="width: 11%;">Actions</td>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <td colspan="3">
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
                        $rs=mysql_query("select * from about_us_category order by id");
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
                        <td class="actBtns">
                            <a class="tipS" title="Update" href="update-about-us-category.php?q=<?php echo $r["id"];?>">
                                <img alt="" src="images/icons/edit.png" />
                            </a>
                            <a onclick="javascript: return confirm('Do you really want to delete this category?');" class="tipS" title="Remove" href="delete-about-us-category.php?q=<?php echo $r["id"];?>">
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
                                <td colspan="3">
                                    <div style="margin-top: 0px;" class="nNote nInformation hideit">
                                        <p><strong>INFORMATION: </strong>No category found.</p>
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