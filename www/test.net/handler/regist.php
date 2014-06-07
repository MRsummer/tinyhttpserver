<?php

require_once("../lib/require.php");

$num = isset($_POST["num"]) ? trim($_POST["num"]) : "";
$name = isset($_POST["name"]) ? trim($_POST["name"]) : "";
$pwd = isset($_POST["pwd"]) ? trim($_POST["pwd"]) : "";
$repwd = isset($_POST["repwd"]) ? trim($_POST["repwd"]) : "";
$class = isset($_POST["class"]) ? trim($_POST["class"]) : "";
$teacher = isset($_POST["teacher"]) ? trim($_POST["teacher"]) : "";

//check
if($num == "" || strlen($num) != 10 || strtoupper(substr($num,0,4)) != "U201" )  Uri::goBack("学号不正确");
if($pwd != $repwd) Uri::goBack("密码不一致");
if($name == "") Uri::goBack("姓名不能为空");
if($class == "") Uri::goBack("班级不能为空");

$teachers = Mysql::getDB()->query("select * from teacher where id = ".addslashes($teacher));
if(count($teachers) == 0) Uri::goBack("该老师不存在");

//check db
$sql = "select * from user where num = '".addslashes($num)."'";
$res = Mysql::getDB()->query($sql);
if(count($res) == 0){
    $sql = "insert into user (name, password, num, class, teacher ) values ('"
        .addslashes($name)."', '".addslashes($pwd)."', '".addslashes($num)."', '".addslashes($class)."', ".$teacher.")";
    Mysql::getDB()->exec($sql);
    echo "注册成功，<a href='/view/login.html.php'>登录</a>";
}else{
    Uri::goBack("学号已经被注册了");
}