<?
    include_once("bd.php");
    $educ=$_POST['e_educ'];
    $edu=$_POST['e_edu'];
    $query = "UPDATE users SET education='".$edu."',edu_city='".$educ."' WHERE email = '".$_COOKIE['account']."'";
    $result = mysql_query($query) or die(mysql_error());;
    echo "<meta http-equiv='Refresh' content='0; URL=/index.php'>";
?>