<?php
require_once("../lib/require.php");

$num = isset($_POST["num"]) ? $_POST["num"] : "";
$pwd = isset($_POST["pwd"]) ? $_POST["pwd"] : "";

$sql = "select * from user where num = '".addslashes($num)."' and password = '".addslashes($pwd)."'";
$res = Mysql::getDB()->query($sql);

if(count($res) == 1){
	$_SESSION["login"] = "true";
	$_SESSION["uid"] = $res[0]["id"];
	$_SESSION["name"] = $res[0]["name"];
	$_SESSION["num"] = $res[0]["num"];
	Uri::redirect("/view/index.html.php");
}else{
    Uri::goBack("用户名或密码错误", "/view/login.html.php");
}
