<?
    include_once("bd.php");$id=$_GET['id'];include_once("vars.php");
    if($id!='' and $e_functions==0){
        $query = "UPDATE users SET e_functions=1 WHERE id = '".$id."'";
        $result = mysql_query($query) or die(mysql_error());;
        echo "<meta http-equiv='Refresh' content='0; URL=/account/edit.php?id=".$id."&page=5'>";
    }
?>