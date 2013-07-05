<html>
    <head>
        <title>
            Blog
        </title>           
    </head>
    <body>
    <div id="content" style="width: 500px;margin:0px auto">
<?php
    include_once("admin/includes/connection.php");
?>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
    <input type="text" name="user_id" />
    <br />
    <textarea id="post_content" name="post_content" style="width: 100%;" placeholder="Whats on your mind"></textarea>
    <input type="submit" name="submit" value="Post" />
</form>
<?php    
    //insert current user post
    if(isset($_POST['submit'])){        
        date_default_timezone_set('Asia/Kolkata');
        $user_id=mysql_real_escape_string($_POST['user_id']);        
        $post_content=mysql_real_escape_string($_POST['post_content']);
        $date = date('Y-m-d H:i:s');
        $con=new MySQL();
        $query="insert into user_post(user_id,post_content,post_datetime) values($user_id,'$post_content','$date')";
        $affected_row = mysql_query($query);
        echo "<br />Affected Rows : ".$affected_row."<br />";
        $con->CloseConnection();
    }
?>
<?php    
    //disply all user posts
    $con=new MySQL();
    
    $query="SELECT ";
    $query.="u.id as post_id";
    $query.=",u.user_id as user_id";
    $query.=",concat(ur.firstname,' ',ur.lastname) as user_name";
    $query.=",u.post_content as post_content";
    $query.=",u.post_datetime as post_datetime";
    $query.="FROM `user_post` u,user_registration ur where u.user_id=ur.id";
    
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
        <div id="content" style="width: 100%;margin: 10px;background-color:#53C2FE ;">
            <a href="#"><?php echo $r["user_name"];?></a>
            <?php echo $r["post_content"];?><br />
            <div id="postDate" style="margin-left: 30px;">
                <?php
                date_default_timezone_set('Asia/Kolkata');
                $date = date('F d', strtotime($r["post_datetime"]));
                echo $date;
                ?>
            </div>
        </div>
        <div id="allreply" style="width: 85%;margin-left:30px;background-color:#AADAF4 ;">
            <?php   
                //show all previous reply                         
                $queryr="select upr.id as id,upr.post_id as post_id,upr.user_id as user_id,concat(ur.firstname,' ',ur.lastname) as user_name,upr.reply_content as reply_content,upr.reply_datetime as reply_datetime,upr.isapprove as isapprove from user_post_reply upr,user_registration ur where upr.user_id=ur.id and upr.post_id=".$r["post_id"];                
                $replies=mysql_query($queryr);
                while($reply=mysql_fetch_array($replies)){
                   //print_r($reply);
            ?>
                    
                       <br /><a href="#"><?php echo $reply["user_name"];?></a>
                        <?php echo $reply["reply_content"];?>
                        <div id="replyDate" style="margin-left: 30px;">
                            <?php
                                //l, F d y h:i:s
                                $newDate = date('d F  h:i A', strtotime($reply["reply_datetime"]));
                                $newTime = date('h:i A', strtotime($reply["reply_datetime"]));
                            ?>
                            <?php echo $newDate.' at '.$newTime;?>
                        </div>
            <?php 
                }
                //echo $queryr;
            ?>
        </div>
        <div id="reply" style="margin-left:30px">
            <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                <input type="text" name="reply_content" style="width:80%" placeholder="Write your reply..." />
                <input type="hidden" name="post_id" value="<?php echo $r["post_id"] ?>" />
                <input type="submit" name="submitreply<?php echo $r["post_id"];?>" value="Reply" />
            </form>
            <?php
                //reply
                if(isset($_POST['submitreply'.$r["post_id"]])){
                    $reply_content=mysql_real_escape_string($_POST['reply_content']);
                    $post_id=mysql_real_escape_string($_POST['post_id']);
                    $user_id=2;
                    $date = date('Y-m-d H:i:s');                    
                    $query="insert into user_post_reply(post_id,user_id,reply_content,reply_datetime) values($post_id,$user_id,'$reply_content','$date')";                                        
                    $affected_row = mysql_query($query);                                        
                }
            ?>
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
    </body>    
</html>