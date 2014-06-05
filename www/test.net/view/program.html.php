<?php
require_once("../lib/require.php");
$sql = "select * from program order by id desc";
$res = Mysql::getDB()->query($sql);
?>


<html>
<?php include("head.html"); ?>
<body>
<div style="width: 70%;margin: 0 auto;">
<?php $location="program"; include("header.html.php"); ?>

<!--添加题目区域-->
<div class="panel panel-default">
    <div class="panel-heading">添加编程题</div>
    <div class="panel-body">
        <form role="form"  method="post" action="/handler/program_add.php">
            <div class="form-group">
                <label for="content">题目名称：</label>
                <textarea name="content" id="content" style="width: 800px;max-width: 800px;height: 100px;"></textarea>
            </div>
            <div class="form-group">
                <label for="answer">示例答案：</label>
                <textarea name="answer" id="answer" style="width: 800px;max-width: 800px;height: 100px;"></textarea>
            </div>
            <div class="form-group">
                <label for="testinA">测试组一：</label>
                输入：<input type="text" name="testinA" id="testinA" style="width: 300px;">
                输出：<input type="text" name="testoutA" style="width: 300px;">
            </div>
            <div class="form-group">
                <label for="testinB">测试组一：</label>
                输入：<input type="text" name="testinB" id="testinB" style="width: 300px;">
                输出：<input type="text" name="testoutB" style="width: 300px;">
            </div>
            <div class="form-group">
                <label for="testinC">测试组一：</label>
                输入：<input type="text" name="testinC" id="testinC" style="width: 300px;">
                输出：<input type="text" name="testoutC" style="width: 300px;">
            </div>
            <div class="form-group">
                <label for="testinD">测试组一：</label>
                输入：<input type="text" name="testinD" id="testinD" style="width: 300px;">
                输出：<input type="text" name="testoutD" style="width: 300px;">
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

<?php include("programresult.html.php"); ?>

</div>
</body>
</html>