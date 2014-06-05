<?php
//此处做权限验证，还没有开始的考试试卷只能由老师查看，考过的试卷可以由学生查看
require_once("../lib/require.php");
require_once("../helper/user.php");
require_once("../helper/paper.php");

if(! (isset($_GET["paper"]) && is_numeric($_GET["paper"])) ) Uri::goBack("该页面不存在");
$paper = Mysql::getDB()->query("select * from paper where id = ".addslashes($_GET["paper"]));
count($paper) == 0 ? Uri::goBack("该页面不存在") : $paper = $paper[0];
$paper = Paper::getPaper($paper);
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
            </a>
        <?php } ?>
    </div>
</div>

</div>
</body>
</html>