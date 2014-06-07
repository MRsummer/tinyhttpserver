<?php
date_default_timezone_set("Asia/Shanghai");
session_start();

require_once("mysql.php");
require_once("uri.php");
require_once("date.php");
require_once("check.php");

require_once("../helper/user.php");

header("Content-type:text/html;charset=utf-8");