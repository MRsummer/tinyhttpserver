<?php
//找到本场考试的全部试卷，然后一个一个的判断
require_once("../lib/require.php");
require_once("../helper/user.php");
require_once("../helper/paper.php");
require_once("../conf/appconf.php");

//权限验证
User::checkTeacher();

//url验证
if(! (isset($_GET["exam"]) && is_numeric($_GET["exam"])) ) Uri::goBack("访问出错");
$results = Mysql::getDB()->query("select * from result where score = 0 and exam = ".$_GET["exam"]);
if(count($results) == 0) Uri::goBack("阅卷完毕");

$paper = Paper::getExamPaper($_GET["exam"]);

//验证答案
foreach($results as $result){

    //取出学生作答
    $resultAnswer = json_decode($result["answer"], true);
    $resultChoose = $resultAnswer["choose"];
    $resultFill = $resultAnswer["fill"];
    $resultProgram = $resultAnswer["program"];

    //进行打分
    $totalScore = 0;
    foreach($resultChoose as $index=>$item){
        //选择题验证，直接比较即可
        $resultChoose[$index."s"] = ($item == $paper["choose"]["".$index]["answer"]
            ? AppConf::getConf()["PAPER"]["CHOOSE_SCORE"] : 0);
        $totalScore += $resultChoose[$index."s"];
    }
    foreach($resultFill as $index=>$item){
        //填空题验证，判断在答案数组中即可
        if( in_array( trim($item), json_decode($paper["fill"]["".$index]["answer"], true) ) ) {
            $resultFill[$index."s"] = AppConf::getConf()["PAPER"]["FILL_SCORE"];
        }else{
            $resultFill[$index."s"] = 0;
        }
        $totalScore += $resultFill[$index."s"];
    }
    foreach($resultProgram as $index=>$item){
        //TODO 编程题验证，需要调用本地脚本，编译程序并根据测试数据来验证答案的正确性
        $resultProgram[$index."s"] = 0;
        $totalScore += $resultProgram[$index."s"];
    }
    if($totalScore == 0) $totalScore = -1;//标志已经打过分了

    //将打分结果写入数据库
    $resultAnswer["choose"] = $resultChoose;
    $resultAnswer["fill"] = $resultFill;
    $resultAnswer["program"] = $resultProgram;
    Mysql::getDB()->exec("update result set score = ".$totalScore.", answer = '"
        .json_encode($resultAnswer)."' where id = ".$result["id"]);

}

Uri::goBack("阅卷完毕");
