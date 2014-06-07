<?php
require_once("../conf/appconf.php");
require_once("../lib/require.php");
require_once("../helper/user.php");

User::checkTeacher();
$users = Mysql::getDB()->query("select user.name, user.num, user.class, teacher.name as teacher from user join teacher on user.teacher = teacher.id order by user.id desc");
?>

<!--教师页面-->
<html>
<?php include("head.html"); ?>
<body>
<div style="width: 70%;margin: 0 auto;">
<?php $location="user"; include("header.html.php"); ?>

<div class="panel panel-default">
<div class="panel-heading">学生列表</div>
<div class="list-group">
<?php foreach($users as $user){ ?>
    <a class="list-group-item">
        <h4 class="list-group-item-heading">姓名：<?php echo $user["name"]; ?></h4>
        <p class="list-group-item-text">学号：<?php echo $user["num"]; ?></p>
        <p class="list-group-item-text">班级：<?=$user["class"]?></p>
        <p class="list-group-item-text">老师：<?=$user["teacher"]?></p>
    </a>
<?php } ?>
</div>
</div>

</div>
</body>
</html>