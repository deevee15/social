<?
    include_once("bd.php");
    $id=$_GET['id'];$lvl=$_GET['lvl'];
    if($id!='' and $lvl!=''){
        $query = "UPDATE users SET support='".$lvl."' WHERE id = '".$id."'";
        $result = mysql_query($query) or die(mysql_error());;
        echo "<meta http-equiv='Refresh' content='0; URL=/admin/index.php?type=3'>";
    }
?>