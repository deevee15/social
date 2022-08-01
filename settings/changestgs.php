<?
    include_once('bd.php');
    include_once('vars.php');
    $id=$_GET['id'];
    $type=$_POST['type'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    if($type==1){echo'none';}
    else if($type==2){
        if($pass==$password){echo'error1';}
        else{
            $query = "UPDATE users SET email='".$email."', password='".$password."' WHERE id = '".$id."'";
            $result = mysql_query($query) or die(mysql_error());;
        }
    }
?>