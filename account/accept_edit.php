<?
    include_once("bd.php");
    $name=$_POST['e_name'];
    $sname=$_POST['e_sname'];
    $city=$_POST['e_city'];
    $site=$_POST['e_site'];
    $e_educ=$_POST['e_educ'];
    $e_edu=$_POST['e_edu'];
    $birthday=$_POST['ageDay'];
    $birthmonth=$_POST['ageMonth'];
    $birthyear=$_POST['ageYear'];
    $extra_about=$_POST['extra_about'];
    if($name!=''){
    $query = "UPDATE users SET name='".$name."',surname='".$sname."',city='".$city."',`web-site`='".$site."',`b_year`='".$birthyear."',`b_month`='".$birthmonth."',`b_day`='".$birthday."',`education`='".$e_edu."',`edu_city`='".$e_educ."',`about`='".$extra_about."' WHERE email = '".$_COOKIE['account']."'";
    $result = mysql_query($query) or die(mysql_error());;
    echo'success';}
    //echo "<meta http-equiv='Refresh' content='0; URL=/index.php'>";
?>