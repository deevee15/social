<?
    require("bd.php");
    $name=$_POST['e_name'];
    $sname=$_POST['e_sname'];
    $city=$_POST['e_city'];
    $site=$_POST['e_site'];
    $e_educ=$_POST['e_educ'];
    $e_edu=$_POST['e_edu'];
    $b_day=$_POST['ageDay'];
    $b_month=$_POST['ageMonth'];
    $b_year=$_POST['ageYear'];
    $extra_about=$_POST['extra_about'];
    $birthday=$b_day.'.'.$b_month.'.'.$b_year;
    if($name!=''){
    $query = "UPDATE users SET name='".$name."',surname='".$sname."',city='".$city."',`web-site`='".$site."',`birthday`='".$birthday."',`education`='".$e_edu."',`edu_city`='".$e_educ."',`about`='".$extra_about."' WHERE email = '".$_COOKIE['account']."'";
    $result = $mysqli->query($query) or die(mysqli_error());;
    echo'success';}
?>