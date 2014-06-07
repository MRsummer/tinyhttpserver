<?php
require_once("../lib/require.php");
require_once("../helper/user.php");

//check privilege
User::CheckTeacher();
User::checkTeacherPrivilege("paper");

$content = $_POST["content"];
$cA = trim($_POST["choiceA"]);
$cB = trim($_POST["choiceB"]);
$cC = trim($_POST["choiceC"]);
$cD = trim($_POST["choiceD"]);
$answer = Check::inArray($_POST["answer"], array("A","B","C","D"));
$choice = json_encode(array("A"=>$cA,"B"=>$cB,"C"=>$cC,"D"=>$cD));

$chapter = trim($_POST["chapter"]);
$tag = trim($_POST["tag"]);
$difficulty = Check::inArray($_POST["difficulty"], array("1","2","3","4","5","6","7","8","9","10"));

Mysql::getDB()->exec("insert into choose (content, choice, answer, chapter, difficulty, tag) "
    ."values ('".addslashes($content)."', '".addslashes($choice)."', '".addslashes($answer)."', '"
    .addslashes($chapter)."', ".$difficulty.", '".addslashes($tag)."' )");

Uri::redirect("/view/choose.html.php");
