<?
    require("bd.php");
    $text=$_POST['text'];
    $id=$_POST['id'];
    if(!empty($text)){
    $query = "UPDATE wall SET text='".$text."' WHERE id = '".$id."'";
    $result = $mysqli->query($query) or die(mysqli_error());;}
    else{echo'error1';}
?>