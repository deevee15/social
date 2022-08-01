<?
    require('bd.php');
    $result = mysqli_query($mysqli,"SELECT * FROM `users`");
    while($row = mysqli_fetch_assoc($result)) {
        $id=$row['id'];
        $d=$row['b_day'];
        $m=$row['b_month'];
        $montharray = array(
            'January'=>'01',
            'February'=>'02',
            'March'=>'03',
            'April'=>'04',
            'May'=>'05',
            'June'=>'06',
            'July'=>'07',
            'August'=>'08',
            'September'=>'09',
            'October'=>'10',
            'November'=>'11',
            'December'=>'12',
        );
        $cmonth=$montharray[$m];
        $y=$row['b_year'];
        $date=$d.'.'.$cmonth.'.'.$y;
        echo$date;
        $q = "UPDATE users SET birthday='".$date."' WHERE id='".$id."'";
        $re = $mysqli->query($q) or die(mysqli_error());;
    }
?>