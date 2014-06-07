<?php
require_once("../lib/require.php");
require_once("../conf/appconf.php");

$num = isset($_POST["num"]) ? $_POST["num"] : "";
$pwd = isset($_POST["pwd"]) ? $_POST["pwd"] : "";

//检查是否管理员
if(strpos($num,"G") === 0 && $num == AppConf::getConf()["MANAGER"]["NAME"] && $pwd == AppConf::getConf()["MANAGER"]["PASS"]){
    $_SESSION["login"] = "true";
    $_SESSION["gid"] = 0;
    $_SESSION["name"] = "管理员";
    $_SESSION["num"] = $num;
    Uri::redirect("/view/index.html.php");

//检查是否是老师
}else if(strpos($num, "T") === 0){
    $sql = "select * from teacher where num = '".addslashes($num)."' and password = '".addslashes($pwd)."'";
    $res = Mysql::getDB()->query($sql);
    if(count($res) == 1){
        $_SESSION["login"] = "true";
        $_SESSION["tid"] = $res[0]["id"];
        $_SESSION["name"] = $res[0]["name"];
        $_SESSION["num"] = $res[0]["num"];
        $_SESSION["privilege"] = json_decode($res[0]["privilege"], true);
        Uri::redirect("/view/index.html.php");
    }else{
        Uri::goBack("用户名或密码错误", "/view/login.html.php");
    }

//检查是否是学生
}else if(strpos($num, "U") === 0){
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

}else{
    Uri::goBack("用户名或密码错误", "/view/login.html.php");
}


