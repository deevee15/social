<?
    require("bd.php");
    $name=$_POST['name'];
    $surname=$_POST['surname'];
    $mail=$_POST['email'];
    $pass=$_POST['password'];
    $gender=$_POST['gender'];
    $q = "SELECT * FROM users WHERE email ='.$mail.'";
    $get = $mysqli->query($q) or die(mysqli_error());;
    if(mysqli_num_rows($get)==0){
        $data = date('d.m.y/H:i:s');
        $query = "INSERT INTO users (name, surname, email, password,gender,regdate)
        VALUES ('$name','$surname','$mail','$pass','$gender','$data')";
        $result = $mysqli->query($query) or die(mysqli_error());;
        echo'success';
    }
    else {echo'error5';}
?>