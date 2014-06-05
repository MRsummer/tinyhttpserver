<?php
class SystemConf{

    private static $systemConf = array(

        "SERVER_ROOT"=>"/Users/zhuguangwen/Work/php/exam",

        "MYSQL_HOST"=>"127.0.0.1",
        "MYSQL_PORT"=>3306,
        "MYSQL_PWD"=>"123456",

    );

    public function getConf(){
        return self::$systemConf;
    }
}

