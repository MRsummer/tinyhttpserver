<?php
class Check{
    public static function inArray($needle, $array){
        if(!in_array($needle, $array)){
            return $array[0];
        }
        return $needle;
    }
}