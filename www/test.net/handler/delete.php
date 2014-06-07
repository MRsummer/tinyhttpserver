<?php
require_once("../lib/require.php");
require_once("../helper/user.php");

//check privilege
User::CheckTeacher();
User::checkTeacherPrivilege("paper");

$id = $_GET["id"];
$type = $_GET["type"];
if($type != "choose" && $type != "fill" && $type != "program" && $type != "paper") die("访问出错");
if(! is_numeric($id)) Uri::goBack("该页面不存在");

Mysql::getDB()->exec("delete from $type where id = ".addslashes($id));

if($type == "paper") $type = "papers";
Uri::goBack("删除成功！");