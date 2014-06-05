<?php
require_once("../lib/require.php");
require_once("../helper/user.php");
User::checkLogin();
?>

<?php
if(User::isManager()){
    include("manager.index.php");
}else if(User::isTeacher()){
    include("teacher.index.php");
}else{
    include("student.index.php");
}
?>
