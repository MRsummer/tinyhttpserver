<?php
//检查时间和权限
require_once("../lib/require.php");
require_once("../helper/user.php");
require_once("../helper/paper.php");

if(! is_numeric($_GET["exam"])) Uri::goBack("访问出错");
if(! User::isTeacher()){
    $exam = Mysql::getDB()->query("select * from exam where id = ".$_GET["exam"]);
    $date = date("Y-m-d H:i:s");
    if(count($exam) == 0) Uri::goBack("访问出错");
    if($date < $exam[0]["begintime"]) Uri::goBack("该考试还没开始，将于".$exam[0]["begintime"]."开始");//还没开始
    if($date > $exam[0]["endtime"]) Uri::goBack("该考试已结束");//已结束

    //区分是统一考试还是随机考试
    if($exam[0]["type"] == "0"){
        //统一试卷
        $paper = Paper::getExamPaper($_GET["exam"]);
        $choose = $paper["choose"];
        $fill = $paper["fill"];
        $program = $paper["program"];

        $testResult = Mysql::getDB()->query("select * from result where exam = ".$_GET["exam"]." and user = ".$_SESSION["uid"]);
        if(count($testResult) > 0){
            $result = json_decode($testResult[0]["answer"], true);
            $chooseResult = $result["choose"];
            $fillResult = $result["fill"];
            $programResult = $result["program"];
        }
    }else{
        //随机试卷
        die("暂不支持随机试卷!!!");
    }
}
?>

<html>
<?php include("head.html"); ?>
<body>
<div style="width: 70%;margin: 0 auto;">
<?php include("header.html.php"); ?>

<p><h1><?=$paper["name"]?> <a href="/view/index.html.php">返回</a></h1></p>
<h4>注意：请在填写过程中注意点击提交以保存你填写的内容，考试时间结束前可以重复提交</h4>
<p>
<form method="post" action="/handler/test_submit.php">
<p>
    <input type="submit" value="提交试卷" style="width:100px;">
    <input type="hidden" name="exam" value="<?=$_GET['exam']?>" />
</p>

<div class="panel panel-default">
    <div class="panel-heading"><h2>一，选择题</h2></div>
    <div class="panel-body">
        <?php foreach($choose as $index=>$item){
            $choices = json_decode($item["choice"], true);
            if(count($choices) == 0) $choices = array(); ?>
        <a class="list-group-item">
            <h4 class="list-group-item-heading">
                <?=$index+1?>：<?=$item["content"]?>
            </h4>
            <p class="list-group-item-text">
            <?php foreach($choices as $key=>$value){ ?>
                <?php if( isset($chooseResult) && $key == $chooseResult["".$index]){ ?>
                    <br><input type='radio' name='choose_<?=$index?>' value='<?=$key?>' checked='checked'>
                    &nbsp;&nbsp;&nbsp;&nbsp;<?=$key?>，<?=$value?>
                <?php }else{ ?>
                    <br><input type='radio' name='choose_<?=$index?>' value='<?=$key?>'>
                    &nbsp;&nbsp;&nbsp;&nbsp;<?=$key?>，<?=$value?>
                <?php } ?>
            <?php } ?>
            </p>
        </a>
        <?php } ?>
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading"><h2>二，填空题</h2></div>
    <div class="panel-body">
        <?php foreach($fill as $index=>$item){ ?>
            <a class="list-group-item">
                <h4 class="list-group-item-heading">
                    <?=$index+1?>：<?=$item["content"]?>
                </h4>
                <p class="list-group-item-text">
                <br>
                <?php if(isset($fillResult)){ ?>
                    填写答案：<input type='text' name='fill_<?=$index?>' value='<?=$fillResult["".$index]?>' style="width:800px;">
                <?php }else{ ?>
                    填写答案：<input type='text' name='fill_<?=$index?>' style="width:800px;">
                <?php } ?>
                </p>
            </a>
        <?php } ?>
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading"><h2>三，编程题（建议代码编写测试完成后再将代码复制粘贴到此框中）</h2></div>
    <div class="panel-body">
        <?php foreach($program as $index=>$item){ ?>
            <a class="list-group-item">
                <h4 class="list-group-item-heading">
                    <?=$index+1?>：<?=$item["content"]?>
                </h4>
                <p class="list-group-item-text">
                    <br>
                    <?php if(isset($programResult)){ ?>
                        填写答案：<textarea name='program_<?=$index?>' style="width:800px;max-width: 800px;height: 300px;">
                            <?=$fillResult["".$index]?>
                        </textarea>
                    <?php }else{ ?>
                        填写答案：<textarea name='program_<?=$index?>' style="width:800px;max-width: 800px;height: 300px;">
                        </textarea>
                    <?php } ?>
                </p>
            </a>
        <?php } ?>
    </div>
</div>

</form>
</p>

</div>
</body>
</html>