<?php

//function checkDatetime($str, $format="Y-m-d H:i:s"){
//    $unixTime=strtotime($str);
//    echo "unix time : ".$unixTime;
//    echo "\n";
//    $checkDate= date($format, $unixTime);
//    echo "date:".$checkDate;
//    echo "\n";
//    echo "str :".$str;
//    if($checkDate==$str)
//        return true;
//    else
//        return false;
//}

//$arr = array("1"=>"aaa");
//foreach($arr as $key=>$value){
//    $arr["_".$key] = "_".$value;
//}
//print_r($arr);

$cwd = getcwd();
$lastIndex = strlen($cwd) - strlen(strrchr($cwd, "/"));
$pwd = substr($cwd, 0, $lastIndex);
echo $pwd;


//echo in_array("aaa", array("a"=>"aaa", "b"=>"bbb")) ? "in" : "not";

//echo date("Y-m-d H:i:s");

//date_default_timezone_set("Asia/Shanghai");
//echo checkDatetime("2014-05-23 10:00:00") ? "hehe" : "hoho";

//echo is_int(1);
//echo is_integer(1);

//$str = "1 1 1 1 1 1 1 1 1 1";
//print_r (array_diff(explode(" ",$str), array("")));