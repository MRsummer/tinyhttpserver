<?php

require_once("../lib/require.php");
require_once("../helper/user.php");

//check privilege
User::CheckTeacher();
User::checkTeacherPrivilege("paper");

$paperName = $_POST["papername"];
$choose = $_POST["choose"];
$fill = $_POST["fill"];
$program = $_POST["program"];

$choose = array_diff(explode(" ",$choose), array(""));
$fill = array_diff(explode(" ",$fill), array(""));
$program = array_diff(explode(" ",$program), array(""));
if(count($choose)!=20) Uri::goBack("选择题数量不是20个".print_r($choose));
if(count($fill)!=10) Uri::goBack("填空题数量不是10个".print_r($fill));
if(count($program)!=5) Uri::goBack("编程题数量不是5个".print_r($program));
$paper = json_encode(array(
    "choose"=>implode(",",$choose),
    "fill"=>implode(",",$fill),
    "program"=>implode(",",$program)
));

Mysql::getDB()->exec("insert into paper (user, name, difficulty, paper) "
    ."values ('".$_SESSION["uid"]."', '".addslashes($paperName)."', 0, '".addslashes($paper)."')");

Uri::redirect("/view/papers.html.php");
