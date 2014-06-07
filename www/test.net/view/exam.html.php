
<?php
require_once("../lib/require.php");
require_once("../conf/appconf.php");
require_once("../helper/user.php");

User::checkTeacherPrivilege("exam");
?>

<html>
<?php include("head.html"); ?>
<body>
<div style="width: 70%;margin: 0 auto;">
<?php $location="exam"; include("header.html.php"); ?>

<!--添加考试-->
<div class="panel panel-default">
    <div class="panel-heading">发起一场考试</div>
    <div class="panel-body">
        <form role="form"  method="post" action="/handler/exam_add.php">
            <div class="form-group">
                <label for="examtype">考试类型：</label>
                <select name="examtype" id="examtype">
                    <option value="0">统一试卷</option>
                    <option value="1">随机试卷</option>
                </select>
            </div>
            <div class="form-group">
                <label for="begintime">开始时间：</label>
                <input type="text" name="begintime" id="begintime">（格式：2013-11-23 11:00）
            </div>
            <div class="form-group">
                <label for="exampleInputFile">结束时间：</label>
                <input type="text" name="endtime">（格式：2013-11-23 11:00）
            </div>
            <div class="form-group">
                <label for="exampleInputFile">选择考卷：</label>
                <select name="paper">
                    <?php
                    require_once("../lib/require.php");
                    $res = Mysql::getDB()->query("select * from paper order by id desc");
                    foreach($res as $item){
                        echo "<option value='".$item["id"]."'>".$item["name"]."</option>";
                    }
                    ?>
                </select>
                (仅统一考卷需要选择)
            </div>
            <button type="submit" class="btn btn-default">添加</button>
        </form>
    </div>
</div>

<!--历史考试列表-->
<div class="panel panel-default">
    <div class="panel-heading">以前的考试</div>
    <div class="panel-body">
        <?php
        $res = Mysql::getDB()->query("select * from exam order by id desc");
        foreach($res as $item){
            $paper = Mysql::getDB()->query("select * from paper where id = ".$item["paper"])[0];
        ?>
            <a class="list-group-item">
                <h4 class="list-group-item-heading">试卷名称：<?=$paper["name"]?></h4>
                <p class="list-group-item-text">考试考试时间：<?=$item["begintime"]?></p>
                <p class="list-group-item-text">考试结束时间：<?=$item["endtime"]?></p>
                <p class="list-group-item-text">试卷名称：<?=$paper["name"]?></p>
                <p class="list-group-item-text">参加考试的学生和答题情况：
                    <span style="color: red;cursor: pointer;" onclick="javascript:location.href='/view/examlist.html.php?exam=<?=$item["id"]?>'">查看</span>
                </p>
                <p class="list-group-item-text">自动评卷：
                    <span style="color: red;cursor: pointer;" onclick="javascript:location.href='/handler/test_score.php?exam=<?=$item["id"]?>'">开始</span>
                </p>
                <p class="list-group-item-text">自动查找作弊：
                    <span style="color: red;cursor: pointer;" onclick="javascript:location.href='/handler/test_cheat.php?exam=<?=$item["id"]?>'">开始</span>
                </p>
            </a>
        <?php } ?>
    </div>
</div>

</div>
</body>
</html>