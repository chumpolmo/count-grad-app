<?php
function displayNumber($a){
    if(isset($a)){ 
        return number_format($a, 2, '.', '');
    }
    return '0.00';
}

function displayText($a){
    if(isset($a)){ 
        return $a; 
    }
    return '-';
}

function displayTime($a){
    if(isset($a)){ 
        return $a; 
    }
    return 'hh:mm:ss';
}

function displayMinute($a){
    if(isset($a)){
        $seconds = gmdate('i:s', $a);
        return $seconds;
    }
    return 'mm:ss';
}

function displayResult($a){
    $tmp = '';
    if($a == 10){ 
        $tmp = '<span class="text-primary"><i class="bi bi-stop-circle"></i> ตามเกณฑ์</span>'; 
    }else if($a == 20){
        $tmp = '<span class="text-success"><i class="bi bi-arrow-up-circle"></i> ดีกว่าเกณฑ์</span>';
    }else if($a == 30){
        $tmp = '<span class="text-danger"><i class="bi bi-arrow-down-circle"></i> ต่ำกว่าเกณฑ์</span>'; 
    }else{
        $tmp = '-';
    }
    return $tmp;
}

function displayResultInPDF($res){
    $tmp = "";
    if($res == 10) $tmp = "ตามเกณฑ์";
    else if($res == 20) $tmp = "ดีกว่าเกณฑ์";
    else if($res == 30) $tmp = "ต่ำกว่าเกณฑ์";
    return $tmp;
}

function calculateTime($ts, $te){
    $timeFirst  = strtotime($ts);
    $timeSecond = strtotime($te);
    $diffInSeconds = $timeSecond - $timeFirst;
    $seconds = number_format($diffInSeconds, 2);
    return $seconds;
}

function displayDate($d){
    $d_tmp = explode('-', $d);
    $m_arr = ['มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม'];
    return (int)$d_tmp[2]." ".$m_arr[$d_tmp[1]-1]." ".($d_tmp[0]+543);
}
?>