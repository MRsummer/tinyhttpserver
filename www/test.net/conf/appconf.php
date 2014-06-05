<?php
class AppConf{
    private static $appConf = array(

        //角色配置
        "ROLE_STUDENT"=>0,
        "ROLE_TEACHER"=>1,
        "ROLE_TEACHER_MUM"=>array(),
        "ROLE_ADMIN"=>2,
        "ROLE_MANAGER_MUM"=>array('U201013044'),

        //数量和分数配置
        "PAPER"=>array(
            "CHOOSE_NUM"=>20,
            "FILL_NUM"=>10,
            "PROGRAM_NUM"=>5,
            "CHOOSE_SCORE"=>1,//选择题每题1分
            "FILL_SCORE"=>3,//填空题每题3分
            "PROGRAM_SCORE"=>10//编程题每题10分
        ),

        //章节配置
        "CHAPTER"=>array(
        "1"=>"变量",
        "2"=>"分支",
        "3"=>"字符串",
        "4"=>"数组",
        "5"=>"函数",
        "6"=>"指针",
        "7"=>"结构体，共用体",
        "8"=>"文件"
        ),

    );

    public static function getConf(){
        return self::$appConf;
    }
}


