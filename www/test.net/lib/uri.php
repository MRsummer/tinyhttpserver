<?php
class Uri{
    public static function redirect($url){
        header("location:".$url);
        die();
    }

    public static function goBack($msg, $url = NULL){
        if($url == NULL) $url = $_SERVER["HTTP_REFERER"];
        die($msg.", <a href='".$url."'>返回</a>");
    }

}