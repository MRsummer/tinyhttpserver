<?php
require_once("judge.php");

$code ='
#include <stdio.h>
int main(){
	int c = 0;
	scanf("%1", &c);
	int i = 0;
	for(;i < c;i ++){
		printf("%d",i);
	}
	return 0;
}
';

$resArr = array();
Judge::getCodeResult(array(
    "code"=>$code,
    "testDataArr"=>array(
        array("in"=>"3", "out"=>"012"),
        array("in"=>"4", "out"=>"0123")
    )
), $resArr);
print_r($resArr);