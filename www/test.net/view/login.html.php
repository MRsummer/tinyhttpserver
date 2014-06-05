<html>
<?php include("head.html"); ?>
<body>
<div style="width: 70%;margin: 0 auto;">
<?php include("header.nosession.html"); ?>

<form class="form-horizontal" role="form" method="post" action="/handler/login.php"
      style="width: 600px;margin: 0 auto;margin-top: 50px;border: solid 1px;
      padding: 50px 50px;border-radius: 20px;">
    <div class="form-group">
        <label for="num" class="col-sm-2 control-label">学号：</label>
        <div class="col-sm-10">
            <input type="text" name="num" class="form-control" id="num" placeholder="学号">
        </div>
    </div>
    <div class="form-group">
        <label for="pwd" class="col-sm-2 control-label">密码：</label>
        <div class="col-sm-10">
            <input type="password" name="pwd" class="form-control" id="pwd" placeholder="密码">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <a href="/view/register.html.php">没有账号？</a>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">登录</button>
        </div>
    </div>
</form>

</div>
</body>
</html>