<?php

require_once("../lib/require.php");

User::checkManager();

$num = isset($_POST["num"]) ? trim($_POST["num"]) : "";
$name = isset($_POST["name"]) ? trim($_POST["name"]) : "";
$pwd = isset($_POST["pwd"]) ? trim($_POST["pwd"]) : "";
$repwd = isset($_POST["repwd"]) ? trim($_POST["repwd"]) : "";
$privilege = json_encode(array(
    "exam"=>isset($_POST["exam"]) ? 1 : 0,
    "paper"=>isset($_POST["paper"]) ? 1 : 0,
    "result"=>isset($_POST["result"]) ? 1 : 0,
    "allresult"=>isset($_POST["allresult"]) ? 1 : 0
));

//check
if($num == "" || strlen($num) != 10 || strtoupper(substr($num,0,1)) != "T" )  Uri::goBack("教工号输入不正确，请确保以T字母开头");
if($pwd != $repwd) Uri::goBack("密码不一致");
if($name == "") Uri::goBack("姓名不能为空");

//check db
$sql = "select * from teacher where num = '".addslashes($num)."'";
$res = Mysql::getDB()->query($sql);
if(count($res) == 0){
    $sql = "insert into teacher (name, password, num, privilege) values ('".$name."', '".$pwd."', '".$num."', '".$privilege."')";
    Mysql::getDB()->exec($sql);
    echo "添加成功，<a href='/view/login.html.php'>登录</a>";
}else{
    Uri::goBack("教工号已经被注册了");
}