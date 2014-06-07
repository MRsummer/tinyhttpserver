<?php
require_once("../lib/require.php");
require_once("../helper/user.php");
User::checkTeacher();
if(! is_numeric($_GET["exam"])) Uri::goBack("访问出错");
$sql = "select result.id, user.name, user.num, result.score from result join user on user.id = result.user where exam = ".$_GET["exam"];
if(! User::hasTeacherPrivilege("allresult")){
    $sql .= "  and user.teacher = ".$_SESSION["tid"];
}
if(! User::hasTeacherPrivilege("result")){
    Uri::goBack("您暂时没有权限访问此页面");
}
$results = Mysql::getDB()->query($sql);
?>
<html>
    <?php include("head.html"); ?>
<body>
<div style="width: 70%;margin: 0 auto;">
<?php include("header.html.php"); ?>

<h1>参加过本场考试的学生
    <?php echo User::hasTeacherPrivilege("allresult") ? "（全部学生）" : "（我的学生）" ?>
    <a href="/view/exam.html.php">返回</a>
</h1>

<div class="panel panel-default">
    <div class="panel-body">
        <?php foreach($results as $item){ ?>
        <a class="list-group-item">
            <h4 class="list-group-item-heading">姓名：<?=$item["name"]?></h4>
            <p class="list-group-item-text">学号：<?=$item["num"]?></p>
            <p class="list-group-item-text">分数：<?=$item["score"]?></p>
            <p class="list-group-item-text">答题细节：
                <span style="color: red;cursor: pointer;" onclick="javascript:location.href='/view/testresult.html.php?result=<?=$item["id"]?>'">查看</span>
            </p>
        </a>
        <?php } ?>
    </div>
</div>

</div>
</body>
</html>