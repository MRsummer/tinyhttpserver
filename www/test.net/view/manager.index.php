<?php
require_once("../conf/appconf.php");
require_once("../lib/require.php");
require_once("../helper/user.php");

User::checkManager();
$users = Mysql::getDB()->query("select user.name, user.num, user.class, teacher.name as teacher from user join teacher on user.teacher = teacher.id order by user.id desc");
$teachers = Mysql::getDB()->query("select * from teacher order by id desc");
?>

<!--管理员界面-->
<html>
<?php include("head.html"); ?>
<body>
<div style="width: 70%;margin: 0 auto;">
<?php include("header.html.php"); ?>
    <!--修改老师信息-->
    <div class="panel panel-default">
        <div class="panel-heading">添加老师：</div>
        <div class="panel-body">
            <form role="form"  method="post" action="/handler/teacher_add.php">
                <div class="form-group">
                    <label for="num">教师编号：</label>
                    <input type="text" name="num" id="num">
                </div>
                <div class="form-group">
                    <label for="num">教师姓名：</label>
                    <input type="text" name="name" id="name">
                </div>
                <div class="form-group">
                    <label for="pwd">密码：</label>
                    <input type="password" name="pwd" id="pwd">
                </div>
                <div class="form-group">
                    <label for="repwd">重复密码：</label>
                    <input type="password" name="repwd" id="repwd">
                </div>
                <div class="form-group">
                    <label for="exam">权限：</label><br>
                    发起考试的权限：<input type="checkbox" name="exam" id="exam"><br>
                    出题的权限（题库和试卷）：<input type="checkbox" name="paper" id="paper"><br>
                    查看自己学生成绩的权限：<input type="checkbox" name="result" id="result"><br>
                    查看所有学生成绩的权限：<input type="checkbox" name="allresult" id="allresult"><br>
                </div>
                <button type="submit" class="btn btn-default">添加</button>
            </form>
        </div>
    </div>

    <div class="panel panel-default">
    <div class="panel-heading">教师列表</div>
    <div class="list-group">
        <?php foreach($teachers as $teacher){ $privilege = json_decode($teacher["privilege"], true); ?>
            <a class="list-group-item">
                <h4 class="list-group-item-heading">姓名：<?php echo $teacher["name"]; ?></h4>
                <p class="list-group-item-text">教工号：<?php echo $teacher["num"]; ?></p>
                <p class="list-group-item-text">权限：<br>
                    发起考试的权限：<?php echo $privilege["exam"] == "1" ? "有" : "没有" ?><br>
                    出题的权限（题库和试卷）：<?php echo $privilege["paper"] == "1" ? "有" : "没有" ?><br>
                    查看自己学生成绩的权限：<?php echo $privilege["result"] == "1" ? "有" : "没有" ?><br>
                    查看所有学生成绩的权限：<?php echo $privilege["allresult"] == "1" ? "有" : "没有" ?><br>
                </p>
            </a>
        <?php } ?>
    </div>
    </div>

    <div class="panel panel-default">
    <div class="panel-heading">学生列表</div>
    <div class="list-group">
        <?php foreach($users as $user){ ?>
            <a class="list-group-item">
                <h4 class="list-group-item-heading">姓名：<?php echo $user["name"]; ?></h4>
                <p class="list-group-item-text">学号：<?php echo $user["num"]; ?></p>
                <p class="list-group-item-text">班级：<?php echo $user["class"]; ?></p>
                <p class="list-group-item-text">老师：<?php echo $user["teacher"]; ?></p>
            </a>
        <?php } ?>
    </div>
    </div>

</div>
</body>
</html>