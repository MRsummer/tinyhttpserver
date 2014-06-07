<?php
require_once("../lib/require.php");
require_once("../helper/user.php");

//check privilege
User::CheckTeacher();
User::checkTeacherPrivilege("exam");

$type = $_POST["examtype"];
$beginTime = $_POST["begintime"].":00";
$endTime = $_POST["endtime"].":00";
$paper = $_POST["paper"];

if(! in_array($type, array("0", "1"))) Uri::goBack("类型错误");
if(! Date::checkDatetime($beginTime)) Uri::goBack("开始时间格式错误");
if(! Date::checkDatetime($endTime)) Uri::goBack("结束时间格式错误");

Mysql::getDB()->exec("insert into exam (type, beginTime, endTime, paper) "
    ."values ($type, '$beginTime', '$endTime', '$paper')");

Uri::redirect("/view/exam.html.php");
