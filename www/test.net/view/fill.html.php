<?php
require_once("../lib/require.php");
$sql = "select * from fill order by id desc";
$res = Mysql::getDB()->query($sql);
?>

<html>
<?php include("head.html"); ?>
<body>
<div style="width: 70%;margin: 0 auto;">

<?php $location="fill"; include("header.html.php"); ?>

<!--添加题目区域-->
<div class="panel panel-default">
    <div class="panel-heading">添加一道填空题</div>
    <div class="panel-body">
        <form role="form"  method="post" action="/handler/fill_add.php">
            <div class="form-group">
                <label for="begintime">题目名称：</label>
                <textarea name="content" id="content" style="width: 800px;height:100px;" ></textarea>
            </div>
            <div class="form-group">
                <label for="answerA">答案1&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;：</label>
                <input type="text" name="answerA" id="answerA" style="width: 800px;">
            </div>
            <div class="form-group">
                <label for="answerB">答案2&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;：</label>
                <input type="text" name="answerB" id="answerB" style="width: 800px;">
            </div>
            <div class="form-group">
                <label for="answerC">答案3&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;：</label>
                <input type="text" name="answerC" id="answerC" style="width: 800px;">
            </div>
            <div class="form-group">
                <label for="answerD">答案3&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;：</label>
                <input type="text" name="answerD" id="answerD" style="width: 800px;">
            </div>

            <div class="form-group">
                <label for="chapter">章节&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;：</label>
                <select name="chapter" id="chapter">
                    <?php require_once("../conf/appconf.php"); foreach(AppConf::getConf()["CHAPTER"] as $index=>$name){ ?>
                        <option value="<?=$name?>"><?=$name?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="tag">标签&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;：</label>
                <input type="text" name="tag" id="tag" style="width:700px;">（标签以空格分开）
            </div>
            <div class="form-group">
                <label for="difficulty">难读系数&nbsp;&nbsp;：</label>
                <select name="difficulty" id="difficulty">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                </select>
            </div>

            <button type="submit" class="btn btn-default">添加</button>
        </form>
    </div>
</div>

<?php include("fillresult.html.php"); ?>

</div>
</body>
</html>