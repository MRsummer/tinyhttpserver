<?php
class Paper{
    public static function getPaper($paperModel){
        //数据库查询结果
        $content = json_decode($paperModel["paper"], true);
        $choose = Mysql::getDB()->query("select * from choose where id in ( ".$content["choose"]." )");
        $fill = Mysql::getDB()->query("select * from fill where id in ( ".$content["fill"]." )");
        $program = Mysql::getDB()->query("select * from program where id in ( ".$content["program"]." )");

        //提取出结果到结果集中
        $answerChoose = array();
        $answerFill = array();
        $answerProgram = array();
        foreach($choose as $item) $answerChoose[$item["id"]+""] = $item;
        foreach($fill as $item) $answerFill[$item["id"]+""] = $item;
        foreach($program as $item) $answerProgram[$item["id"]+""] = $item;

        //获取结果的key，用于查找答案
        $chooseKey = explode(",",$content["choose"]);
        $fillKey = explode(",",$content["fill"]);
        $programKey = explode(",",$content["program"]);

        //按照key重新排序
        $paper = array( "choose"=>array(),"fill"=>array(),"program"=>array(),
            "name"=>$paperModel["name"], "user"=>$paperModel["user"], "difficulty"=>$paperModel["difficulty"]);
        foreach($chooseKey as $chooseId) array_push($paper["choose"], $answerChoose[$chooseId]);
        foreach($fillKey as $fillId) array_push($paper["fill"], $answerFill[$fillId]);
        foreach($programKey as $programId) array_push($paper["program"], $answerProgram[$programId]);

        return $paper;
    }

    public static function getExamPaper($examId){
        $exam = Mysql::getDB()->query("select * from exam where id = ".$examId);
        $paper = Mysql::getDB()->query("select * from paper where id = ".$exam[0]["paper"])[0];
        return self::getPaper($paper);
    }
}