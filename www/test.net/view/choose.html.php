<?php
require_once("../lib/require.php");
$res = Mysql::getDB()->query("select * from choose order by id desc");
?>


<html>
<head>
    <?php include("head.html"); ?>
</head>
<body>
<div style="width: 70%;margin: 0 auto;">
<?php $location="choose"; include("header.html.php"); ?>

<div class="panel panel-default">
    <div class="panel-heading">添加一道选择题</div>
    <div class="panel-body">
        <form role="form"  method="post" action="/handler/choose_add.php">
            <div class="form-group">
                <label for="content">题目名称&nbsp;&nbsp;：</label>
                <textarea name="content" id="content" style="width: 800px;height:100px;" ></textarea>
            </div>
            <div class="form-group">
                <label for="choiceA">题目选项A：</label>
                <input type="text" name="choiceA" id="choiceA" style="width:800px;">
            </div>
            <div class="form-group">
                <label for="choiceB">题目选项B：</label>
                <input type="text" name="choiceB" id="choiceB" style="width:800px;">
            </div>
            <div class="form-group">
                <label for="choiceC">题目选项C：</label>
                <input type="text" name="choiceC" id="choiceC" style="width:800px;">
            </div>
            <div class="form-group">
                <label for="choiceD">题目选项D：</label>
                <input type="text" name="choiceD" id="choiceD" style="width:800px;">
            </div>
            <div class="form-group">
                <label for="answer">正确答案&nbsp;&nbsp;：</label>
                <select name="answer" id="answer">
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                    <option value="D">D</option>
                </select>
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

<?php include("chooseresult.html.php"); ?>

</div>
</body>
</html>