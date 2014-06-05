<?php
require_once("../lib/require.php");
require_once("../helper/user.php");
require_once("../helper/paper.php");

if( isset($_GET["type"]) && isset($_GET["chapter"]) && isset($_GET["difficulty"]) && isset($_GET["tag"]) ){
    $type = Check::inArray($_GET["type"], array("1", "2", "3"));
    $typeName = ($type == "1" ? "choose" : ($type == "2" ? "fill" : "program"));
    $chapter = $_GET["chapter"];
    $difficulty = $_GET["difficulty"];
    $tag = trim($_GET["tag"]);

    $sql = "select * from $typeName ";
    $whereChapter = $chapter == "" ? "" : " chapter = '".$chapter."' ";
    $whereDifficulty = $difficulty == "" ? "" : " difficulty = $difficulty ";
    $whereTag = $tag == "" ? "" : " tag like '%".$tag."%' ";
    $where = ($whereChapter == "" ? "" : " and ".$whereChapter).($whereDifficulty == "" ? "" : " and ".$whereDifficulty).($whereTag == "" ? "" : " and ".$whereTag);
    $sql .= $where == "" ? "" : " where ".substr($where, 4);
    $sql .= " order by id desc ";

    $res = Mysql::getDB()->query($sql);
}
?>

<!--查找题目页面-->
<html>
<?php include("head.html"); ?>
<body>
<div style="width: 70%;margin: 0 auto;">
    <?php $location="search"; include("header.html.php"); ?>

    <div class="panel panel-default">
        <div class="panel-body">
            <form role="form"  method="get" action="/view/search.html.php">
                <div class="form-group">
                    <label for="type">类型：</label>
                    <select name="type" id="type">
                        <option value="1" <?php if(isset($type) && $type == "1") echo "selected='selected'";?>>选择题</option>
                        <option value="2" <?php if(isset($type) && $type == "2") echo "selected='selected'";?>>填空题</option>
                        <option value="3" <?php if(isset($type) && $type == "3") echo "selected='selected'";?>>编程题</option>
                    </select>

                    <label for="chapter" style="margin-left: 20px;">章节：</label>
                    <select name="chapter" id="chapter">
                            <option value="">不选择</option>
                        <?php require_once("../conf/appconf.php"); foreach(AppConf::getConf()["CHAPTER"] as $index=>$name){ ?>
                            <option value="<?=$name?>"  <?php if(isset($chapter) && $chapter == $name) echo "selected='selected'";?>><?=$name?></option>
                        <?php } ?>
                    </select>

                    <label for="difficulty" style="margin-left: 20px;">难读系数：</label>
                    <select name="difficulty" id="difficulty">
                        <option value="">不选择</option>
                        <option value="1" <?php if(isset($difficulty) && $difficulty == "1") echo "selected='selected'";?> >1</option>
                        <option value="2" <?php if(isset($difficulty) && $difficulty == "2") echo "selected='selected'";?> >2</option>
                        <option value="3" <?php if(isset($difficulty) && $difficulty == "3") echo "selected='selected'";?> >3</option>
                        <option value="4" <?php if(isset($difficulty) && $difficulty == "4") echo "selected='selected'";?> >4</option>
                        <option value="5" <?php if(isset($difficulty) && $difficulty == "5") echo "selected='selected'";?> >5</option>
                        <option value="6" <?php if(isset($difficulty) && $difficulty == "6") echo "selected='selected'";?> >6</option>
                        <option value="7" <?php if(isset($difficulty) && $difficulty == "7") echo "selected='selected'";?> >7</option>
                        <option value="8" <?php if(isset($difficulty) && $difficulty == "8") echo "selected='selected'";?> >8</option>
                        <option value="9" <?php if(isset($difficulty) && $difficulty == "9") echo "selected='selected'";?> >9</option>
                        <option value="10" <?php if(isset($difficulty) && $difficulty == "10") echo "selected='selected'";?> >10</option>
                    </select>

                    <label for="tag" style="margin-left: 20px;">标签：</label>
                    <input type="text" name="tag" id="tag" style="width:300px;"  <?php if(isset($tag) && $tag != "") echo "value='".$tag."'";?> >

                    <button type="submit" class="btn btn-default" style="margin-left: 20px;">查找</button>
                </div>
            </form>
        </div>
    </div>

    <?php if(isset($res)) include($typeName."result.html.php"); ?>

</div>
</body>
</html>