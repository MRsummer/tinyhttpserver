<?php
require_once("../conf/appconf.php");
require_once("../lib/require.php");
require_once("../helper/user.php");

User::checkTeacher();
$users = Mysql::getDB()->query("select * from user order by id desc");
?>

<!--教师页面-->
<html>
<?php include("head.html"); ?>
<body>
<div style="width: 70%;margin: 0 auto;">
<?php $location="user"; include("header.html.php"); ?>

<div class="list-group">
<?php foreach($users as $user){
    $role = in_array($user["num"],AppConf::getConf()["ROLE_MANAGER_MUM"]) ? "管理员"
        : (in_array($user["num"],AppConf::getConf()["ROLE_TEACHER_MUM"]) ? "老师" : "学生");
?>
    <a class="list-group-item">
        <h4 class="list-group-item-heading">姓名：<?php echo $user["name"]; ?></h4>
        <p class="list-group-item-text">学号：<?php echo $user["num"]; ?></p>
        <p class="list-group-item-text">身份：<?=$role?></p>
    </a>
<?php } ?>
</div>

</div>
</body>
</html>