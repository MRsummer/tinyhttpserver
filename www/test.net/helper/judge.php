<?php
class Judge{
    public static function getCodeResult($testArr){

        if(!is_array($testArr)){
            throw new Exception("testArr type err, array required");
        }

        //获取输入数据
        $code = $testArr["code"];//需要测试的代码
        $testDataArr = $testArr["testDataArr"];//测试数据组
        if(!is_array($testDataArr)){
            throw new Exception("test data type err, array required");
        }

        $resArr = array();

        //将code写入一个c文件，注意权限
        $pid = getmypid();
        $cwd = getcwd();
        $lastIndex = strlen($cwd) - strlen(strrchr($cwd, "/"));
        $pwd = substr($cwd, 0, $lastIndex);
        $dir = $pwd."/run/$pid/";
        $cFile = "test.c";
        mkdir("../run/".$pid);
        file_put_contents($dir.$cFile, $code);

        //将测试数据写入测试文件
        foreach($testDataArr as $item){
            file_put_contents($dir."testin.data", $item["in"]."\n", FILE_APPEND);
            file_put_contents($dir."testout.data", $item["out"]."\n", FILE_APPEND);
        }

        //这里注意安全问题：目前的解决方案是切换用户身份

        //测试脚本编译程序，如果成功，运行测试数据，如果失败，返回
        system("../script/judge_c_program.sh ".$dir." test.c testin.data testout.data", $retVal);

        //判断脚本的返回值，设置返回值
        if($retVal == 0){
            $resArr["code"] = 0;
            $resArr["msg"] = "测试成功";
        }

        //返回失败，判断temp文件是否存在，存在则编译正确，不存在则返回编译错误
        else if($retVal == 1){
            $resArr["code"] = 1;
            $resArr["msg"] = "编译错误：".file_get_contents($dir."compile_err");
        }

        //判断运行错误文件是否存在，存在返回则运行错误
        else if($retVal == 2){
            $resArr["code"] = 2;
            $resArr["msg"] = "运行错误：".file_get_contents($dir."run_err");
        }

        else if($retVal == 3){
            $resArr["code"] = 3;
            $resArr["msg"] = "程序逻辑错误：".file_get_contents($dir."logic_err");
        }

        else if($retVal == 4){
            throw new Exception("脚本参数错误");
        }

        else{
            die("返回值-->".$retVal);
        }

        //清除程序产生的文件
        system("rm -rf ".$dir);

        return $resArr;
    }
}