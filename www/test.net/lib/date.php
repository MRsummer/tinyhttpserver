<?php
class Date{
    public static function checkDatetime($str, $format="Y-m-d H:i:s"){
        $unixTime=strtotime($str);
        $checkDate= date($format, $unixTime);
        if($checkDate==$str)
            return $checkDate;
        else
            return FALSE;
    }
}
