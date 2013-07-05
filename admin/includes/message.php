<?php
    class Message{
        function success($msg){
        ?>
            <div class="nNote nSuccess hideit">
                <p><strong>SUCCESS: </strong><?php echo $msg?></p>
            </div>
        <?php            
        }
        function error($msg){
        ?>
            <div class="nNote nFailure hideit">
                <p><strong>FAILURE: </strong>Oops sorry.<?php echo $msg;?></p>
            </div>
        <?php            
        }  
        function warning($msg){
            ?>
            <div class="nNote nWarning hideit">
                <p><strong>WARNING: </strong><?php echo $msg?></p>
            </div>
            <?php
        }   
        function information($msg){
        ?>
            <div class="nNote nInformation hideit">
                <p><strong>INFORMATION: </strong><?php echo $msg?></p>
            </div>
        <?php            
        }           
    }
?>