<?php
require_once("../lib/require.php");
require_once("../helper/user.php");

User::checkLogin();

unset($_SESSION["login"]);
unset($_SESSION["uid"]);
unset($_SESSION["name"]);
unset($_SESSION["num"]);
unset($_SESSION["tid"]);
unset($_SESSION["gid"]);
unset($_SESSION["privilege"]);

Uri::redirect("/view/login.html.php");