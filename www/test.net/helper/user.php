<?php
require_once("../lib/require.php");
require_once("../conf/appconf.php");

class User{

	public static function checkTeacher(){
		self::checkLogin();
		if(! in_array($_SESSION["num"], AppConf::getConf()["ROLE_TEACHER_MUM"]) ){
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
        if(! in_array($_SESSION["num"], AppConf::getConf()["ROLE_MANAGER_MUM"]) ){
            Uri::redirect("/view/login.html.php");
        }
    }

    public static function isTeacher(){
        return in_array($_SESSION["num"], AppConf::getConf()["ROLE_TEACHER_MUM"]);
    }

    public static function isManager(){
        return in_array($_SESSION["num"], AppConf::getConf()["ROLE_MANAGER_MUM"]);
    }
}

