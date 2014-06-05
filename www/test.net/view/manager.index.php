<?php
require_once("../conf/appconf.php");
require_once("../lib/require.php");
require_once("../helper/user.php");

User::checkManager();
$users = Mysql::getDB()->query("select * from user order by id desc");
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
            <form role="form"  method="post" action="/handler/user_privilege.php">
                <div class="form-group">
                    <label for="num">学号：</label>
                    <input type="text" name="num" id="num">（注意，修改之后，该学号的用户将成为老师）
                </div>
                <div class="form-group">
                    <label for="exam">权限：</label><br>
                    发起考试的权限：<input type="checkbox" name="exam" id="exam"><br>
                    出题的权限（题库和试卷）：<input type="checkbox" name="paper" id="paper"><br>
                    查看自己学生成绩的权限：<input type="checkbox" name="result" id="result"><br>
                    查看所有学生成绩的权限：<input type="checkbox" name="allresult" id="allresult"><br>
                </div>
                <button type="submit" class="btn btn-default">修改</button>
            </form>
        </div>
    </div>

    <div class="list-group">
        <?php foreach($users as $user){ ?>
            <a class="list-group-item">
                <h4 class="list-group-item-heading">姓名：<?php echo $user["name"]; ?></h4>
                <p class="list-group-item-text">学号：<?php echo $user["num"]; ?></p>
                <p class="list-group-item-text">身份：<?php echo $user["role"] == "0" ? "学生" : "老师"; ?></p>
                <p class="list-group-item-text">删除</p>
            </a>
        <?php } ?>
    </div>

</div>
</body>
</html>