<?
    include_once('bd.php');
    $result = mysql_query("SELECT * FROM `wall`");
    while($row = mysql_fetch_array($result)) {
        $d=$row['w_date'];
        $d=str_split($d);
        $day=$d[0].$d[1];
        $month=$d[3].$d[4];
        $year=$d[8].$d[9];
        $h=$d[11].$d[12];
        $min=$d[14].$d[15];
        $sec=$d[17].$d[18];
        $date=$day.'.'.$month.'.'.$year.'/'.$h.':'.$min.':'.$sec;
        $q = "UPDATE wall SET w_date='".$date."' WHERE w_date='".$row['w_date']."'";
        $re = mysql_query($q) or die(mysql_error());;
    }
?>