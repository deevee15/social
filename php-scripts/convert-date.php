<?
    function convert($d){
        $cd=explode('/', $d);
        $dmy=explode('.', $cd[0]);
        $day=$dmy[0];$month=$dmy[1];$year=$dmy[2];
        $hms=explode(':', $cd[1]);
        $hour=$hms[0];$min=$hms[1];$sec=$hms[2];
        $montharray = array(
            '01'=>'January',
            '02'=>'February',
            '03'=>'March',
            '04'=>'April',
            '05'=>'May',
            '06'=>'June',
            '07'=>'July',
            '08'=>'August',
            '09'=>'September',
            '10'=>'October',
            '11'=>'November',
            '12'=>'December',
        );
        $cmonth=$montharray[$month];
        $converted_date=$day.' '.$cmonth.', 20'.$year.' at '.$hour.':'.$min;
        echo $converted_date;
    }
?>