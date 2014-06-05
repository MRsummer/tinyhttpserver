<?php
class Mysql{

    private static $instance = null;

    private $conn = null;

    public function __construct(){
        $this->conn = mysql_connect("127.0.0.1", "root", "");
        if(!$this->conn) die("mysql connect error".mysql_error());
        mysql_select_db("exam", $this->conn);
    }

    public static function getDB(){
        if(self::$instance == NULL)  self::$instance = new Mysql();
        return self::$instance;
    }

    public function exec($sql){
        mysql_query($sql, $this->conn) or die("sql error".mysql_error());
    }

    public function query($sql){
        $ret = array();
        $result = mysql_query($sql, $this->conn) or die("sql error".mysql_error());
        while($data = mysql_fetch_array($result, MYSQL_ASSOC)){
            array_push($ret, $data);
        }
        return $ret;
    }

    public function __destruct(){
        mysql_close($this->conn);
    }

}
