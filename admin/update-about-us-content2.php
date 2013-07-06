<?php include_once "includes/checksession.php"; ?>
<?php
    if(!isset($_POST['btnSubmit']))
        header("location: about-us-content.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
<title>Update Content</title>

<link href="css/main.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>

<script type="text/javascript" src="js/plugins/spinner/ui.spinner.js"></script>
<script type="text/javascript" src="js/plugins/spinner/jquery.mousewheel.js"></script>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>

<script type="text/javascript" src="js/plugins/charts/excanvas.min.js"></script>
<script type="text/javascript" src="js/plugins/charts/jquery.flot.js"></script>
<script type="text/javascript" src="js/plugins/charts/jquery.flot.orderBars.js"></script>
<script type="text/javascript" src="js/plugins/charts/jquery.flot.pie.js"></script>
<script type="text/javascript" src="js/plugins/charts/jquery.flot.resize.js"></script>
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

<script type="text/javascript" src="js/charts/chart.js"></script>

<!-- Shared on MafiaShare.net  --><!-- Shared on MafiaShare.net  --></head>

<body>

<?php include_once "includes/leftside.php";?>



<?php include_once "includes/rightside.php";?>    
    <!-- Title area -->
    <div class="titleArea">
        <div class="wrapper">
            <div class="pageTitle">
                <h5>Update About us Content</h5>
                <!-- <span>Update photo album.</span> -->
            </div>
            <div class="clear"></div>
        </div>
    </div>
    
    <div class="line"></div>
    
    <!-- Main content wrapper -->
    <div class="wrapper">
        <br />
        <a style="margin: 5px;" class="button blueB" title="" href="about-us-content.php">
            <img class="icon" alt="" src="images/icons/light/view.png" />
            <span>View</span>
        </a>
        <a style="margin: 5px;" class="button blueB" title="" href="add-new-about-us-content.php">
            <img class="icon" alt="" src="images/icons/light/add.png" />
            <span>Add New</span>
        </a>
        <?php
             if(isset($_POST['btnSubmit']))
             {
                include_once "includes/connection.php";
                include_once "includes/image.php";
                    $con=new MySQL();
                    $id=$_POST['hidId'];
                    $path=$_POST['hidPath'];
                    $category=$_POST['lstCategory'];
                    $title=$_POST['txtContentTitle'];
                    $desc=$_POST['txtDesc'];
                    
                    if(!is_dir("uploads/about-us"))
                	{
                        mkdir("uploads/about-us");
                	}
                    if(!is_dir("uploads/about-us/thumbs"))
                	{
                        mkdir("uploads/about-us/thumbs");
                	}
                    if(!is_dir("uploads/about-us/original"))
                	{
                        mkdir("uploads/about-us/original");
                	}
                    
                    $img_name=$_FILES['fileImage']['name'];
                    $img_tmp_name=$_FILES['fileImage']['tmp_name'];
                    $img_type=$_FILES['fileImage']['type'];
                    $rs=mysql_query("select name from about_us_category where id=".$category);
                    $r=mysql_fetch_array($rs);
                    date_default_timezone_set('Asia/Calcutta');
                    $prod_img_path=str_replace(' ','',$r['name']).'_'.str_replace(' ','',$title).'_'.date('dmYHis');
                    $ext="";
                    switch($img_type)
                    {
                        case "image/gif":
                            $ext=".gif";
                            break;
                        case "image/bmp":
                            $ext=".bmp";
                            break;
                        case "image/jpeg":
                            $ext=".jpg";
                            break;
                        case "image/png":
                            $ext=".png";
                            break;
                    }
                    
                    $p="uploads/about-us/original/".$prod_img_path.$ext;
                    
                    if($category!="-1" && trim($title)!="" && trim($desc)!="")
                    {
                        $q="";
                        if($img_name!="" && ($img_type=="image/gif" or $img_type=="image/bmp" or $img_type=="image/jpeg" or $img_type=="image/png"))
                        {
                            unlink("uploads/about-us/original/".$path);
                            unlink("uploads/about-us/thumbs/".$path);
                            move_uploaded_file($img_tmp_name,"uploads/about-us/original/".$prod_img_path.$ext);
                            $image = new SimpleImage();
                            $image->load($p);
                            $image->resize(150,150);
                            $image->save('uploads/about-us/thumbs/'.$prod_img_path.$ext);
                            $q="update about_us_content set category_id=".$category.", title='".$title."', image='".$prod_img_path.$ext."', description='".$desc."' where id=".$id;
                        }
                        else
                        {
                            $ext= end(explode('.',$path));
                            $ext='.'.$ext;
                            $newpath=$r['name'].'_'.str_replace(' ','',$title).'_'.date('dmYHis');
                            rename("uploads/about-us/original/".$path,"uploads/about-us/original/".$newpath.$ext);
                            rename("uploads/about-us/thumbs/".$path,"uploads/about-us/thumbs/".$newpath.$ext);
                            $q="update about_us_content set category_id=".$category.", title='".$title."', image='".$newpath.$ext."', description='".$desc."' where id=".$id;
                        }
                        if(mysql_query($q))
                        {
        ?>
                         <div class="nNote nSuccess hideit">
                            <p><strong>SUCCESS: </strong>Content updated successfully.</p>
                         </div>
        <?php
                        }
                        else
                        {
        ?>
                        <div class="nNote nFailure hideit">
                            <p><strong>FAILURE: </strong>Oops sorry. We are unable to update content. Please try again.</p>
                        </div>
        <?php
                        }
                    }
                    $con->CloseConnection();
            }
        ?>
    </div>
    
<?php include_once "includes/footer.php";?>   

</body>
</html>