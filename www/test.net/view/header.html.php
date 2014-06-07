<?php
require_once("../lib/require.php");
require_once("../conf/appconf.php");
require_once("../helper/user.php");
?>

<div style="width:100%;height:80px;background-color: #edf4ed;overflow: hidden;">
    <img src="../res/img/c.jpeg" style="height: 80px;">
    <h1 style="margin-left: 40px;vertical-align: middle;display: inline;">C语言在线考试系统</h1>
    <span style="display: inline-block;float: right;margin-right: 30px;margin-top: 40px;">
        <h4 style="display: inline;font-size: 13px;">
            姓名：<span style="color:forestgreen;"><?=$_SESSION["name"]?></span> &nbsp;&nbsp;
            编号：<span style="color:forestgreen;"><?=$_SESSION["num"]?></span> &nbsp;&nbsp;
            <?php
                require_once("../helper/user.php");
                echo User::isTeacher() ? "（老师）" : (User::isManager() ? "（管理员）" : "（学生）");
            ?>
            <a href="/handler/logout.php"  style="color:forestgreen;">退出登录</a>
        </h4>
    </span>
</div>

<?php if(User::isTeacher()){ ?>
<div>
    <ul class="nav nav-tabs">
        <li class="<?php echo $location == "user" ? "active" : ""; ?>"><a href="/view/index.html.php">学生列表</a></li>
        <?php if(User::hasTeacherPrivilege("exam")){ ?>
        <li class="<?php echo $location == "exam" ? "active" : ""; ?>"><a href="/view/exam.html.php">考试管理</a></li>
        <?php } ?>
        <?php if(User::hasTeacherPrivilege("paper")){ ?>
        <li class="<?php echo $location == "choose" ? "active" : ""; ?>"><a href="/view/choose.html.php">选择题库</a></li>
        <li class="<?php echo $location == "fill" ? "active" : ""; ?>"><a href="/view/fill.html.php">填空题库</a></li>
        <li class="<?php echo $location == "program" ? "active" : ""; ?>"><a href="/view/program.html.php">编程题库</a></li>
        <li class="<?php echo $location == "search" ? "active" : ""; ?>"><a href="/view/search.html.php">查找题目</a></li>
        <li class="<?php echo $location == "papers" ? "active" : ""; ?>"><a href="/view/papers.html.php">试卷管理</a></li>
        <li class="<?php echo $location == "chapter" ? "active" : ""; ?>"><a href="/view/chapter.html.php">查看章节</a></li>
        <?php } ?>
        <li class="<?php echo $location == "judge" ? "active" : ""; ?>"><a href="/view/judge.html.php">在线测试代码</a></li>
    </ul>
</div>
<?php } ?>
