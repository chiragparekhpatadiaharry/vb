<?php include_once "includes/checksession.php"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
<title>Add New News</title>

<?php include_once "includes/common-css-js.php";?>
<!-- Shared on MafiaShare.net  --><!-- Shared on MafiaShare.net  --></head>

<body>

<?php include_once "includes/leftside.php";?>



<?php include_once "includes/rightside.php";?>    
    <!-- Title area -->
    <div class="titleArea">
        <div class="wrapper">
            <div class="pageTitle">
                <h5>Add New News</h5>
                <!--<span>Add new photo album.</span>-->
            </div>
            <div class="clear"></div>
        </div>
    </div>
    
    <div class="line"></div>
    
    <!-- Main content wrapper -->
    <div class="wrapper">
        <br />
        <a style="margin: 5px;" class="button blueB" title="" href="latest-news.php">
            <img class="icon" alt="" src="images/icons/light/view.png" />
            <span>View</span>
        </a>
        <?php
             include_once "includes/connection.php";
             $con=new MySQL();
             if(isset($_POST['btnSubmit']))
             {
                $alubmName=$_POST['txtPhotoAlbumName'];
                if(trim($alubmName)!="")
                {
                    $rs=mysql_query("select id from latest_news where name like '".$alubmName."'");
                    if(mysql_num_rows($rs)>0)
                    {
        ?>
                        <div class="nNote nWarning hideit">
                            <p><strong>WARNING: </strong>Photo album with this name already exists. Specify different name.</p>
                        </div>
        <?php
                    }
                    else
                    {
                        if(mysql_query("insert into latest_news(name) values('".$alubmName."')"))
                        {
        ?>
                                <div class="nNote nSuccess hideit">
                                    <p><strong>SUCCESS: </strong>New photo album saved successfully.</p>
                                </div>
        <?php
                        }
                        else
                        {
        ?>
                            <div class="nNote nFailure hideit">
                                <p><strong>FAILURE: </strong>Oops sorry. We are unable to save photo album. Please try again.</p>
                            </div>
        <?php
                        }
                    }
                }
             }
             $con->CloseConnection();
        ?>
        <form  style="margin-top:20px;" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" class="form" id="validate">
        	<fieldset>
                <div class="widget" style="margin-top: 20px;">
                    <div class="title">
                        <img class="titleIcon" alt="" src="images/icons/dark/add.png" />
                        <h6>Add News</h6>
                    </div>
                    <div class="formRow">
                        <label>Date picker:</label>
                        <div class="formRight">
                            <input type="text" class="datepicker hasDatepicker" id="dp1373195539505" size="10" />
                            <span class="ui-datepicker-append">(dd-mm-yyyy)</span>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="formSubmit">
                        <input type="submit" class="redB" name="btnSubmit" value="save" />
                    </div>
                    <div class="clear"></div>
                </div>
            </fieldset>
        </form>
    </div>
    
<?php include_once "includes/footer.php";?>   

</body>
</html>