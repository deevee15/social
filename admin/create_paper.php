<?
    include_once("bd.php");
    $pttl=$_POST['paper_title'];
    $ptxt=$_POST['paper_text'];
    $pscr=$_POST['paper_screen'];
    $query = "INSERT INTO news (title, text, screens, date)
    VALUES ('$pttl','$ptxt','$pscr','18 апреля 2017')";
    $result = mysql_query($query) or die(mysql_error());;
    echo "<meta http-equiv='Refresh' content='0; URL=/admin/news.php'>"; 
?>