<?
    include_once("bd.php");
    $text=$_POST['text'];
    $id=$_POST['id'];
    if(!empty($text)){
    $query = "UPDATE wall SET text='".$text."' WHERE id = '".$id."'";
    $result = mysql_query($query) or die(mysql_error());;}
    else{echo'error1';}
?>