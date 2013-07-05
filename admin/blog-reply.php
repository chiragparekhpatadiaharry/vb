<?php include_once "includes/checksession.php"; ?>
<?php include_once "includes/connection.php"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
<title>Home</title>

<link href="css/main.css" rel="stylesheet" type="text/css" />

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
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']?>">                  
                <textarea rows="5" name="post_content" style="margin:5px;width: 98%;" placeholder="Whats on your mind"></textarea>
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
    //disply all user posts
    $con=new MySQL();
        
    $query="select u.id as post_id,u.user_id as user_id,concat(ur.firstname,' ',ur.lastname) as user_name,u.post_content as post_content,u.post_datetime as post_datetime from user_post u,user_registration ur where u.user_id=ur.id order by u.post_datetime desc";

    $result = mysql_query($query);  
    //echo $query;
    //echo "<pre>";
    //print_r(mysql_fetch_array($result));
    //echo "</pre>";  
    
    if(mysql_num_rows($result)>0)
    {
        while($r=mysql_fetch_array($result)){
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
                        <a href="#"><?php echo $date; ?></a>
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
                                <a href="#"><?php echo $newDate.' at '.$newTime;?></a>
                                
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
                            <input type="text" name="reply_content" style="margin:10px;width:80%;height:30px" placeholder="Write your reply..." />
                            <input type="hidden" name="post_id" value="<?php echo $r["post_id"] ?>" />
                            <input type="submit" class="greenB ui-formwizard-button" name="submitreply<?php echo $r["post_id"];?>" value="Reply" />
                        </form>
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
        echo "No post found";    
    }           
    $con->CloseConnection();
            
?>    
    </div>    
    
    
    
    
    
    
<?php include_once "includes/footer.php";?>   

</body>
</html>