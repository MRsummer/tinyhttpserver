<?php
//提交试卷
require_once("../lib/require.php");
require_once("../helper/user.php");

if(! (isset($_POST["exam"])&&is_numeric($_POST["exam"])) ) Uri::goBack("访问出错");
$exam = Mysql::getDB()->query("select * from exam where id = ".$_POST["exam"]);
if(count($exam) != 1) Uri::goBack("访问出错");
$time = date("Y-m-d H:i:s");
if(strtotime($time) < strtotime($exam[0]["begintime"])) Uri::goBack("访问出错");
if(strtotime($time) > strtotime($exam[0]["endtime"])) Uri::goBack("考试已结束，现在不能提交试卷");

$data = array(
    "choose"=>array(),
    "fill"=>array(),
    "program"=>array()
);
for($i=0;$i<20;$i++){
    $data["choose"]["".$i] = isset($_POST["choose_".$i]) ? $_POST["choose_".$i] : "";
}
for($i=0;$i<10;$i++){
    $data["fill"]["".$i] = $_POST["fill_".$i];
}
for($i=0;$i<5;$i++){
    $data["program"]["".$i] = $_POST["program_".$i];
}

$res = Mysql::getDB()->query("select id from result where exam = ".$_POST["exam"]." and user =".$_SESSION["uid"]);
if(count($res) > 0){
    Mysql::getDB()->exec("update result set answer = '".addslashes(json_encode($data))
        ."' where exam = ".$_POST["exam"]." and user =".$_SESSION["uid"]);
}else{
    Mysql::getDB()->exec("insert into result (user, answer, score, exam) "
        ."values (".$_SESSION["uid"].",'".addslashes(json_encode($data))."', 0, ".$_POST["exam"].")");
}

Uri::goBack("提交成功！","/view/test.html.php?exam=".$_POST["exam"]);
