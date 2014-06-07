<?php
require_once("../lib/require.php");
$teachers = Mysql::getDB()->query("select * from teacher order by id asc");
?>

<html>
<?php include("head.html"); ?>
<body>
<div style="width: 70%;margin: 0 auto;">
<?php include("header.nosession.html"); ?>

<form class="form-horizontal" role="form" method="post" action="/handler/regist.php"
      style="width: 600px;margin: 0 auto;margin-top: 50px;border: solid 1px;
  padding: 50px 50px;border-radius: 20px;">
    <div class="form-group">
        <label for="num" class="col-sm-2 control-label">学号：</label>
        <div class="col-sm-10">
            <input type="text" name="num" class="form-control" id="num" placeholder="学号">
        </div>
    </div>
    <div class="form-group">
        <label for="name" class="col-sm-2 control-label">姓名：</label>
        <div class="col-sm-10">
            <input type="text" name="name" class="form-control" id="name" placeholder="姓名">
        </div>
    </div>
    <div class="form-group">
        <label for="pwd" class="col-sm-2 control-label">密码：</label>
        <div class="col-sm-10">
            <input type="password" name="pwd" class="form-control" id="pwd" placeholder="密码">
        </div>
    </div>
    <div class="form-group">
        <label for="repwd" class="col-sm-2 control-label">重复：</label>
        <div class="col-sm-10">
            <input type="password" name="repwd" class="form-control" id="repwd" placeholder="重复密码">
        </div>
    </div>
    <div class="form-group">
        <label for="class" class="col-sm-2 control-label">班级：</label>
        <div class="col-sm-10">
            <input type="text" name="class" class="form-control" id="class" placeholder="班级">（例如：通信1002，电信1002）
        </div>
    </div>
    <div class="form-group">
        <label for="teacher" class="col-sm-2 control-label">老师：</label>
        <div class="col-sm-10">
            <select name="teacher" id="teacher">
                <?php foreach($teachers as $teacher){ ?>
                <option value="<?=$teacher["id"]?>"><?=$teacher["name"]?></option>
                <?php } ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <a href="/view/login.html.php">去登陆</a>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">注册</button>
        </div>
    </div>
</form>

</div>
</body>
</html>