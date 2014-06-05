<?php if(isset($res)){ ?>

<div class="panel panel-default">
    <div class="panel-heading">填空题</div>
    <div class="panel-body">
        <?php foreach($res as $item){  $choices = json_decode($item["answer"]); ?>
            <a class="list-group-item">
                <h4 class="list-group-item-heading">题目：<?=$item["content"]?></h4>
                <p class="list-group-item-text">题目编号：<?=$item["id"]?></p>
                <p class="list-group-item-text">答案：
                    <?php foreach($choices as $key=>$c){ echo "<p>".$key."，".$c."</p>"; }?>
                </p>
                <p class="list-group-item-text">所属章节：<?=$item["chapter"]?></p>
                <p class="list-group-item-text">标签：<?=$item["tag"]?></p>
                <p class="list-group-item-text">难读系数：<?=$item["difficulty"]?></p>
                <p class="list-group-item-text">
                    <span style="color: red;cursor: pointer;" onclick="javascript:location.href='/handler/delete.php?type=fill&id=<?=$item["id"]?>'">删除此题</span>
                </p>
            </a>
        <?php } ?>
    </div>
</div>

<?php } ?>