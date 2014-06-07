<?php

require_once("../lib/require.php");
require_once("../helper/user.php");

//check privilege
User::CheckTeacher();
User::checkTeacherPrivilege("paper");

$content = $_POST["content"];
$cA = trim($_POST["answerA"]);
$cB = trim($_POST["answerB"]);
$cC = trim($_POST["answerC"]);
$cD = trim($_POST["answerD"]);
$answer = json_encode(array("A"=>$cA,"B"=>$cB,"C"=>$cC,"D"=>$cD));

$chapter = trim($_POST["chapter"]);
$tag = trim($_POST["tag"]);
$difficulty = Check::inArray($_POST["difficulty"], array("1","2","3","4","5","6","7","8","9","10"));

Mysql::getDB()->exec("insert into fill (content, answer, chapter, difficulty, tag) "
    ."values ('".addslashes($content)."', '".addslashes($answer)."', '".
    addslashes($chapter)."', ".$difficulty.", '".addslashes($tag)."' )");

Uri::redirect("/view/fill.html.php");
