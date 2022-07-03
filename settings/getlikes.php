<?
/*
type= 1 - avatar
2 - photo
3 - post
4 - comment
*/
    include_once("bd.php");
    //$liker=$_GET['liker'];
    $owner=$_GET['owner'];
    $object_id=$_POST['object_id'];
    $type=$_POST['type'];
    $res = mysql_query('SELECT COUNT(1) FROM `likes` WHERE `owner` = '.$owner.' AND type= '.$type.' AND object_id = '.$object_id.'');
    if($res)
    $row = mysql_fetch_array($res, MYSQL_NUM);
    $answer = !empty($row[0]) ? $row[0] : 0;
    $process_ans=str_split($answer);
    if($answer<1000){echo $answer;}
    elseif($answer<10000){echo $process_ans[0].'K';}
    elseif($answer<100000){echo $process_ans[0].$process_ans[1].'K';}
    elseif($answer<1000000){echo $process_ans[0].$process_ans[1].$process_ans[2].'K';}
    elseif($answer<10000000){echo $process_ans[0].'KK';}
?>