<?php
require_once("../conf/appconf.php");
require_once("../lib/require.php");
require_once("../helper/user.php");

User::checkLogin();
$date = date("Y-m-d H:i:s");
$results = Mysql::getDB()->query("select id, user, score, exam from result where score != 0 and user =".$_SESSION["uid"]." order by id desc");
$currentExams = Mysql::getDB()->query("select * from exam where begintime < '".$date."' and endtime > '".$date."' ");
?>

<!--学生页面-->
<html>
<?php include("head.html"); ?>
<body>
<div style="width: 70%;margin: 0 auto;">
<?php $location="user"; include("header.html.php"); ?>

<div class="panel panel-default">
    <div class="panel-heading"><h1>以前的考试</h1></div>
    <div class="panel-body">
        <?php foreach($results as $item){
            $exam = Mysql::getDB()->query("select * from exam where id = ".$item["exam"])[0];
            $paper = Mysql::getDB()->query("select * from paper where id = ".$exam["paper"])[0]; ?>
            <a class="list-group-item">
                <h4 class="list-group-item-heading"><?=$paper["name"]?></h4>
                <p class="list-group-item-text">类型：<?php echo $exam["type"] == 0 ? "统一试卷" : "随机试卷"; ?></p>
                <p class="list-group-item-text">开始时间：<?=$exam["begintime"]?></p>
                <p class="list-group-item-text">结束时间：<?=$exam["endtime"]?></p>
                <p class="list-group-item-text">我的分数：<?=$item["score"]?></p>
                <p class="list-group-item-text">我的答题情况以及参考答案：
                    <span style="color: red;cursor: pointer;" onclick="javascript:location.href='/view/testresult.html.php?result=<?=$item["id"]?>'">查看</span>
                </p>
            </a>
        <?php } ?>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading"><h1>正在进行的考试</h1></div>
    <div class="panel-body">
        <?php foreach($currentExams as $exam){?>
        <a class="list-group-item">
            <h4 class="list-group-item-heading">考试时间：
                <?=$exam["begintime"]?> - <?=$exam["endtime"]?>
            </h4>
            <p class="list-group-item-text">
                <span style="color: red;cursor: pointer;" onclick="javascript:location.href='/view/test.html.php?exam=<?=$exam["id"]?>'">进入考试</span>
            </p>
        </a>
        <?php } ?>
    </div>
</div>

</div>
</body>
</html>