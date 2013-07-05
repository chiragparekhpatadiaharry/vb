<?php
class MyFunction{
    private $con;
    public function __construct(){
        $con=new MySQL();
    }  
    public function getUserNameFromId($id){            
        $sql = "select concat(firstname,' ',lastname) as user_name from user_registration where id=".$id;
        $nameresult=mysql_query($sql);
        $name=mysql_fetch_array($nameresult);        
        return $name["user_name"];
        //return $sql;                
    }
}
?>