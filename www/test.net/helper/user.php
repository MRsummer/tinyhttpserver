<?php
require_once("../lib/require.php");
require_once("../conf/appconf.php");

class User{

	public static function checkTeacher(){
		self::checkLogin();
		if(strpos($_SESSION["num"], "T") != 0){
            Uri::redirect("/view/login.html.php");
		}
	}

	public static function checkLogin(){
		if(! (isset($_SESSION["login"]) && $_SESSION["login"] == "true") ){
			Uri::redirect("/view/login.html.php");
		}
	}

    public static function checkManager(){
        self::checkLogin();
        if(strpos($_SESSION["num"], "G") != 0){
            Uri::redirect("/view/login.html.php");
        }
    }

    public static function isTeacher(){
        return strpos($_SESSION["num"], "T") === 0 ;
    }

    public static function isManager(){
        return strpos($_SESSION["num"], "G") === 0 ;
    }

    public static function hasTeacherPrivilege($item){
        if(! self::isTeacher()) return false;
        if(! isset($_SESSION["privilege"])) return false;
        return isset($_SESSION["privilege"][$item]) && $_SESSION["privilege"][$item] == 1;
    }

    public static function checkTeacherPrivilege($item){
        if(! self::hasTeacherPrivilege($item)){
            Uri::goBack("您暂时没有权限访问此页面");
        }
    }
}

