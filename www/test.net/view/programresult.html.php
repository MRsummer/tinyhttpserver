<?php if(isset($res)){ ?>

<div class="panel panel-default">
    <div class="panel-heading">编程题</div>
    <div class="panel-body">
        <?php foreach($res as $item){ ?>
            <a class="list-group-item">
                <h4 class="list-group-item-heading">题目：<?=$item["content"]?></h4>
                <p class="list-group-item-text">题目编号：<?=$item["id"]?></p>
                <p class="list-group-item-text">答案：
                    <textarea readonly="readonly" style="width: 800px;max-width:800px;height: 100px;">
                        <?php echo trim($item["answer"])?>
                    </textarea>
                </p>
                <p class="list-group-item-text">所属章节：<?=$item["chapter"]?></p>
                <p class="list-group-item-text">标签：<?=$item["tag"]?></p>
                <p class="list-group-item-text">难读系数：<?=$item["difficulty"]?></p>
                <p class="list-group-item-text">
                    <span style="color: red;cursor: pointer;" onclick="javascript:location.href='/handler/delete.php?type=program&id=<?=$item["id"]?>'">删除此题</span>
                </p>
            </a>
        <?php } ?>
    </div>
</div>

<?php } ?>