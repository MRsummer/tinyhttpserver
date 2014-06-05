<?php
require_once("../lib/require.php");
require_once("../helper/judge.php");

$code = $_POST["code"];
$testArr = array(
    "code"=>$code,
    "testDataArr"=>array(
        array("in"=>"11 2","out"=>"13"),
        array("in"=>"3 4","out"=>"7")
    )
);

$resArr = Judge::getCodeResult($testArr);

Uri::goBack($resArr["msg"]);

if($resArr["code"] == 0){
    Uri::goBack("测试通过");
}else{
    Uri::goBack("测试没有通过，错误信息：".$resArr["msg"]);
}
