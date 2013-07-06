<?php include_once "includes/checksession.php"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
<title>Add New Content</title>

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
                <h5>Add New Content</h5>
                <!--<span>Add new photo album.</span>-->
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
        <?php
             include_once "includes/connection.php";
             include_once "includes/image.php";
             $con=new MySQL();
             if(isset($_POST['btnSubmit']))
             {
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
                include_once("includes/message.php");
                $msg = new Message();
                if($category!="-1" && trim($title)!="" && trim($desc)!="" && $img_name!="" && ($img_type=="image/gif" or $img_type=="image/bmp" or $img_type=="image/jpeg" or $img_type=="image/png"))
                {                                                
                        move_uploaded_file($img_tmp_name,"uploads/about-us/original/".$prod_img_path.$ext);
                        $image = new SimpleImage();
                        $image->load($p);
                        $image->resize(150,150);
                        $image->save('uploads/about-us/thumbs/'.$prod_img_path.$ext);
                        if(mysql_query("insert into about_us_content(category_id,title,image,description) values($category,'$title','".$prod_img_path.$ext."','$desc')"))
                        {
                            $msg->success("Content added successfully.");
                        }
                        else
                        {
                            $msg->error("Oops sorry. We are unable to save content. Please try again.");
                        }
                }
                else
                {
                    $msg->warning("Please provide all of the fields.");
                }
             }
             $con->CloseConnection();
        ?>
        <form enctype="multipart/form-data" style="margin-top:20px;" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" class="form" id="validate">
        	<fieldset>
                <div class="widget" style="margin-top: 20px;">
                    <div class="title">
                        <img class="titleIcon" alt="" src="images/icons/dark/add.png" />
                        <h6>Add Content</h6>
                    </div>
                    <div class="formRow">
                        <label>Select Category:&nbsp;<span class="req">*</span></label>
                        <select name="lstCategory" >
                           <option selected="" value="-1">- - Select - -</option>
                           <?php
                                include_once "includes/connection.php";
                                $con=new MySQL();
                                $rs=mysql_query("select id,name from about_us_category");
                                if(mysql_num_rows($rs)>0)
                                {
                                    while($r=mysql_fetch_array($rs))
                                    {
                                        if($r['id']==$category){
                                        ?>
                                            <option value="<?php echo $r['id']; ?>" selected=""><?php echo $r['name']; ?></option>
                                        <?php        
                                        }else{
                                        ?>
                                            <option value="<?php echo $r['id']; ?>"><?php echo $r['name']; ?></option>
                                        <?php    
                                        }
                           ?>
                                        
                           <?php
                                    }
                                }
                                $con->CloseConnection();
                           ?>
                        </select>
                        <div class="clear"></div>
                    </div>
                    <div class="formRow">
                        <label>Content Title:&nbsp;<span class="req">*</span></label>
                        <div class="formRight">
                            <input type="text" id="txtContentTitle" name="txtContentTitle" class="validate[required]" value="<?php echo (isset($_POST['txtContentTitle'])?$_POST['txtContentTitle']:""); ?>" />
                        </div><div class="clear"></div>
                    </div>
                    <div class="formRow">
                        <label>Select Image:&nbsp;<span class="req">*</span></label>
                        <div class="formRight">
                            <input type="file" id="fileImage" name="fileImage" class="validate[required]"/>
                        </div><div class="clear"></div>
                    </div>
                    <div class="formRow">
                        <label>Description:&nbsp;<span class="req">*</span></label>
                        <div class="formRight">
                            <textarea name="txtDesc" id="txtDesc" class="validate[required]">
                             <?php echo (isset($_POST['txtDesc'])?trim($_POST['txtDesc']):""); ?> 
                            </textarea>
                        </div><div class="clear"></div>
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