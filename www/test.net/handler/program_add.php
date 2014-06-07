<?php

require_once("../lib/require.php");
require_once("../helper/user.php");

//check privilege
User::CheckTeacher();
User::checkTeacherPrivilege("paper");

$content = trim($_POST["content"]);
$answer = trim($_POST["answer"]);
$iA = $_POST["testinA"];
$oA = $_POST["testoutA"];
$iB = $_POST["testinB"];
$oB = $_POST["testoutB"];
$iC = $_POST["testinC"];
$oC = $_POST["testoutC"];
$iD = $_POST["testinD"];
$oD = $_POST["testoutD"];

$testdata = json_encode(array(
    "iA"=>$iA, "oA"=>$oA,
    "iB"=>$iB, "oB"=>$oB,
    "iC"=>$iC, "oC"=>$oC,
    "iD"=>$iD, "oD"=>$oD
));

$chapter = trim($_POST["chapter"]);
$tag = trim($_POST["tag"]);
$difficulty = Check::inArray($_POST["difficulty"], array("1","2","3","4","5","6","7","8","9","10"));

Mysql::getDB()->exec("insert into program (content, answer, testdata, chapter, difficulty, tag) "
    ."values ('".addslashes($content)."', '".addslashes($answer)."', '".addslashes($testdata)."', '".
    addslashes($chapter)."', ".$difficulty.", '".addslashes($tag)."' )");

Uri::redirect("/view/program.html.php");
