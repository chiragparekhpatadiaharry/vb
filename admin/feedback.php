<?php include_once "includes/checksession.php"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
<title>User Feedback</title>
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
                <h5>User Feedback</h5>
               <!--<span>Manage Photo Album.</span>-->
            </div>
            <div class="clear"></div>
        </div>
    </div>
    
    <div class="line"></div>
    
    <!-- Main content wrapper -->
    <div class="wrapper">
        <br />               
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
                      if(mysql_query("delete from feedback where id in(".$qid.")"))
                      {
        ?>
                        <div class="nNote nSuccess hideit">
                            <p><strong>SUCCESS: </strong>Selected feedback deleted successfully.</p>
                        </div>
        <?php    
                      }
                      else
                      {
        ?>
                        <div class="nNote nFailure hideit">
                            <p><strong>FAILURE: </strong>Oops sorry. We are unable to delete selected feedback. Please try again.</p>
                        </div>
        <?php  
                      }
                      $con->CloseConnection();
                }
                else
                {
        ?>
                    <div class="nNote nWarning hideit">
                        <p><strong>WARNING: </strong>Select at least one feedback.</p>
                    </div>
        <?php
                }
          }
          
          
            if(isset($_POST['btnTestimonial']))
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
                      if(mysql_query("update feedback set is_testimonial=1 where id in(".$qid.")"))
                      {
        ?>
                        <div class="nNote nSuccess hideit">
                            <p><strong>SUCCESS: </strong>Selected feedback set as testimonial.</p>
                        </div>
        <?php    
                      }
                      else
                      {
        ?>
                        <div class="nNote nFailure hideit">
                            <p><strong>FAILURE: </strong>Oops sorry. We are unable to set selected feedback as testimonial. Please try again.</p>
                        </div>
        <?php  
                      }
                      $con->CloseConnection();
                }
                else
                {
        ?>
                    <div class="nNote nWarning hideit">
                        <p><strong>WARNING: </strong>Select at least one feedback.</p>
                    </div>
        <?php
                }
          }
                    
            if(isset($_POST['btnResetTestimonial']))
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
                      if(mysql_query("update feedback set is_testimonial=0 where id in(".$qid.")"))
                      {
        ?>
                        <div class="nNote nSuccess hideit">
                            <p><strong>SUCCESS: </strong>Selected feedback reset from testimonial.</p>
                        </div>
        <?php    
                      }
                      else
                      {
        ?>
                        <div class="nNote nFailure hideit">
                            <p><strong>FAILURE: </strong>Oops sorry. We are unable to reset selected feedback from testimonial. Please try again.</p>
                        </div>
        <?php  
                      }
                      $con->CloseConnection();
                }
                else
                {
        ?>
                    <div class="nNote nWarning hideit">
                        <p><strong>WARNING: </strong>Select at least one feedback.</p>
                    </div>
        <?php
                }
          }
                    
        ?>         
        
        <?php
            if(!isset($_POST["btnReply"])){
                getTable();
        ?>
        
        
        <?php
        }else{
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
                      $result = mysql_query("select email from feedback where id in(".$qid.")");                      
                      $con->CloseConnection();
?>
            <form method="post" action="feedback-reply.php" class="form">
            <fieldset>
                <div class="widget">
                    <div class="title"><img src="images/icons/dark/list.png" alt="" class="titleIcon"><h6>Reply</h6></div>
                    <div class="formRow">
                        <label>Selected emails:</label>
                        <div style="border: 1px solid blue;height:150px;overflow:scroll;">
                        <?php
                        while($r=mysql_fetch_assoc($result)){
                            echo $r["email"]."<br />";
                        }
                        ?>
                        </div>
                    </div>                                                                          
                    <div class="formRow">
                        <label>Write your reply:</label>
                        <div class="formRight"><textarea name="reply_content" rows="8" cols="" name="textarea"></textarea></div>
                        <div class="clear"></div>
                    </div>  
                    <div class="formRow">
                         <div class="formSubmit">
                                    <input name="btnReply" class="blueB" type="submit" value="Reply" />
                        </div>
                        <div class="clear"></div>
                    </div> 
                    <input type="hidden" name="ids" value="<?php echo $qid;?>" />                   
                                      
                </div>
            </fieldset>
                       
        </form>  
<?php                      
                }
                else
                {
        ?>
                    <div class="nNote nWarning hideit">
                        <p><strong>WARNING: </strong>Select at least one feedback.</p>
                    </div>
        <?php
                    getTable();
                }            
        }
        ?>
    
    </div>
<?php
    function getTable(){
?>
<div class="widget" style="margin-top:20px;">
            <div class="title"><span class="titleIcon"><input type="checkbox" name="titleCheck" id="titleCheck"></span><h6>Feedback</h6></div>
            <form id="frm" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
            <table width="100%" cellspacing="0" cellpadding="0" id="checkAll" class="sTable withCheck mTable">
                <thead>
                    <tr>
                        <td><img alt="" src="images/icons/tableArrows.png"/></td>
                        <td class="sortCol">Name</td>
                        <td>Email</td>
                        <td>Mobile</td>
                        <td>Content</td>
                        <td>Testimonial</td>
                        <td style="width: 11%;">Actions</td>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <td colspan="7">
                            <div style="float: left;margin-left: 5px; margin-right: 5px;" class="formSubmit">
                                <input  onclick="javascript: return confirm('Do you really want to delete selected photo?');" name="btnDelete" class="redB" type="submit" value="Delete Selected" />
                            </div>                            
                            <div style="float: left;margin-left: 5px; margin-right: 5px;" class="formSubmit">
                                <input name="btnReply" class="blueB" type="submit" value="Reply" />
                            </div>                                                        
                            <div style="float: left;margin-left: 5px; margin-right: 5px;" class="formSubmit">
                                <input  onclick="javascript: return confirm('Do you really want to set selected feedback as testimonial?');" name="btnTestimonial" class="blueB" type="submit" value="Testimonial Selected" />
                            </div>
                            
                            <div style="float: left;margin-left: 5px; margin-right: 5px;" class="formSubmit">
                                <input  onclick="javascript: return confirm('Do you really want to reset selected feedback from testimonial?');" name="btnResetTestimonial" class="button brownB" type="submit" value="Reset Testimonial Selected" />
                            </div>                       
                        </td>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                                                            
                        include_once "includes/connection.php";
                        $con=new MySQL();
                        $rs=mysql_query("select * from feedback order by id");
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
                        <td align="left"><?php echo $r["email"]; ?></td>
                        <td align="left"><?php echo $r["mobile"]; ?></td>
                        <td align="left"><?php echo $r["content"]; ?></td>
                        <td align="left"><?php echo (trim($r["is_testimonial"])==0)?"No":"Yes"; ?></td>                         
                        <td class="actBtns" style="padding: 5px;">
                            <a onclick="javascript: return confirm('Do you really want to delete this feedback?');" class="tipS" title="Remove" href="delete-feedback.php?q=<?php echo $r["id"];?>">
                                <img alt="" src="images/icons/dark/close.png" />
                            </a>
                            <a onclick="javascript: return confirm('Do you really want to set as testimonial this feedback?');" class="tipS" title="Testimonial" href="feedback-testimonial.php?q=<?php echo $r["id"];?>">
                                <img alt="" src="images/icons/dark/arrowRight.png" />
                            </a>
                            <a onclick="javascript: return confirm('Do you really want to reset feedback from testimonial?');" class="tipS" title="Reset Testimonial" href="feedback-reset-testimonial.php?q=<?php echo $r["id"];?>">
                                <img alt="" src="images/icons/dark/arrowLeft.png" />
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
                                <td colspan="7">
                                    <div style="margin-top: 0px;" class="nNote nInformation hideit">
                                        <p><strong>INFORMATION: </strong>No feedback found.</p>
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
<?php        
    }
?>    
<?php include_once "includes/footer.php";?>   

</body>
</html>