<?php
require_once("../lib/require.php");
$papers = Mysql::getDB()->query("select user.name as username, paper.name as papername, "
    ."difficulty, paper, paper.id as paperid from paper join user on paper.user = user.id order by paper.id desc");
?>


<html>
<?php include("head.html"); ?>
<body>
<div style="width: 70%;margin: 0 auto;">
<?php $location="papers"; include("header.html.php"); ?>

<!--区域-->
<div class="panel panel-default">
    <div class="panel-heading">添加一张试卷</div>
    <div class="panel-body">
        <form role="form"  method="post" action="/handler/paper_add.php">
            <div class="form-group">
                <label for="papername">考题名称&nbsp;&nbsp;&nbsp;&nbsp;：</label>
                <input type="text" name="papername" id="papername" style="width: 800px;">
            </div>
            <div class="form-group">
                <label for="choose">20个选择题：</label>
                <input type="text" name="choose" id="choose" style="width: 800px;"><br>
                (格式：从选择题中查找到合适的题目编号并输入，如 3 5 12 9 2 ,,, 97 共20个数字，用空格分隔开)
            </div>
            <div class="form-group">
                <label for="fill">10个填空题：</label>
                <input type="text" name="fill" id="fill" style="width: 800px;"><br>
                (格式：从填空题中查找到合适的题目编号并输入，如 3 5 12 9 2 ,,, 97 共10个数字，用空格分隔开)
            </div>
            <div class="form-group">
                <label for="program">5个编程题&nbsp;&nbsp;：</label>
                <input type="text" name="program" id="program" style="width: 800px;"><br>
                (格式：从编程题中查找到合适的题目编号并输入，如 3 9 2 ,,, 97 共5个数字，用空格分隔开)
            </div>
            <button type="submit" class="btn btn-default">添加</button>
        </form>
    </div>
</div>

<!--试卷列表-->
<div class="panel panel-default">
    <div class="panel-heading">以前的试卷</div>
    <div class="panel-body">
        <?php foreach($papers as $item){ ?>
        <a class="list-group-item">
            <h4 class="list-group-item-heading">试卷名称：<?=$item["papername"]?></h4>
            <p class="list-group-item-text">命题人：<?=$item["username"]?></p>
            <p class="list-group-item-text">难度系数：<?=$item["difficulty"]?></p>
            <p class="list-group-item-text">
                <span style="color: red;cursor: pointer;" onclick="javascript:location.href='/view/paper.html.php?paper=<?=$item["paperid"]?>'">查看试卷</span>
                <span style="display: inline-block;width: 30px;"></span>
                <span style="color: red;cursor: pointer;" onclick="javascript:location.href='/handler/delete.php?type=paper&id=<?=$item["paperid"]?>'">删除此试卷</span>
            </p>
        </a>
        <?php } ?>
    </div>
</div>

</body>
</html>