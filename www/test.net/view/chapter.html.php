<?php
require_once("../lib/require.php");
require_once("../conf/appconf.php");
require_once("../helper/user.php");

User::checkTeacher();
$chapters = AppConf::getConf()["CHAPTER"];
?>

<!--教师页面-->
<html>
<?php include("head.html"); ?>
<body>
<div style="width: 70%;margin: 0 auto;">
    <?php $location="chapter"; include("header.html.php"); ?>

    <div class="list-group">
        <?php foreach($chapters as $key=>$chapterName){ ?>
            <a class="list-group-item">
                <h4 class="list-group-item-heading">章节号：<?=$key?></h4>
                <p class="list-group-item-text">章节名称：<?=$chapterName?></p>
            </a>
        <?php } ?>
    </div>

</div>
</body>
</html>