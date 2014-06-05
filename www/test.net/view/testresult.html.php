<?php
require_once("../lib/require.php");
require_once("../helper/user.php");
require_once("../helper/paper.php");

User::checkLogin();

//教师可以查看所有结果，个人只能查看自己的结果
if(! (isset($_GET["result"]) && is_numeric($_GET["result"])) ) Uri::goBack("访问出错");
$result = Mysql::getDB()->query("select * from result where id = ".$_GET["result"]);
count($result) == 0 ? Uri::goBack("访问出错") : ($result = $result[0]);
if(! User::isTeacher() && $_SESSION["uid"] != $result["user"]) Uri::goBack("访问出错");

$paper = Paper::getExamPaper($result["exam"]);

//取出学生作答
$resultAnswer = json_decode($result["answer"], true);
$resultChoose = $resultAnswer["choose"];
$resultFill = $resultAnswer["fill"];
$resultProgram = $resultAnswer["program"];
?>

<html>
<?php include("head.html"); ?>
<body>
<div style="width: 70%;margin: 0 auto;">
<?php include("header.html.php"); ?>

<p><h1><?=$paper["name"]?> <a href="<?=$_SERVER["HTTP_REFERER"]?>">返回</a></h1></p>

<div class="panel panel-default">
    <div class="panel-heading"><h2>一，选择题</h2></div>
    <div class="panel-body">
    <?php foreach($paper["choose"] as $index=>$item){ $choices = json_decode($item["choice"]); ?>
        <a class="list-group-item">
            <h4 class="list-group-item-heading">题目：<?=$index+1?>：<?=$item["content"]?></h4>
            <p class="list-group-item-text">选项：<?php foreach($choices as $key=>$value) echo $key.",".$value."   "; ?></p>
            <p class="list-group-item-text">题目编号：<?=$item["id"]?></p>
            <p class="list-group-item-text">参考答案：<?=$item["answer"]?></p>
            <p class="list-group-item-text">我的答案：<?=$resultChoose[$index.""]?></p>
            <p class="list-group-item-text">我的得分：<?=isset($resultChoose[$index."s"]) ? $resultChoose[$index."s"] : "还未打分"?></p>
        </a>
    <?php } ?>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading"><h2>二，填空题</h2></div>
    <div class="panel-body">
    <?php foreach($paper["fill"] as $index=>$item){ $choices = json_decode($item["answer"]); ?>
        <a class="list-group-item">
            <h4 class="list-group-item-heading">题目：<?=$index+1?>：<?=$item["content"]?></h4>
            <p class="list-group-item-text">题目编号：<?=$item["id"]?></p>
            <p class="list-group-item-text">参考答案：<?php foreach($choices as $key=>$value) echo $key.",".$value."   "; ?></p>
            <p class="list-group-item-text">我的答案：<?=$resultFill[$index.""]?></p>
            <p class="list-group-item-text">我的得分：<?=isset($resultFill[$index."s"]) ? $resultFill[$index."s"] : "还未打分"?></p>
        </a>
    <?php } ?>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading"><h2>三，编程题</h2></div>
    <div class="panel-body">
        <?php foreach($paper["program"] as $index=>$item){ ?>
            <a class="list-group-item">
                <h4 class="list-group-item-heading">题目：<?=$index+1?>：<?=$item["content"]?></h4>
                <p class="list-group-item-text">题目编号：<?=$item["id"]?></p>
                <p class="list-group-item-text">参考答案：
                    <textarea style="width:800px;max-width: 800px;height: 100px;" readonly="readonly"><?=$item["answer"]?></textarea>
                </p>
                <p class="list-group-item-text">我的答案：
                    <textarea style="width:800px;max-width: 800px;height: 100px;margin-top: 20px;" readonly="readonly"><?=$resultProgram[$index.""]?></textarea>
                </p>
                <p class="list-group-item-text">我的得分：<?=isset($resultProgram[$index."s"]) ? $resultProgram[$index."s"] : "还未打分"?></p>
            </a>
        <?php } ?>
    </div>
</div>

</div>
</body>
</html>



