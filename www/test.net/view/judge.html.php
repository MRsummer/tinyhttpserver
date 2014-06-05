<html>
<?php include("head.html"); ?>
<body>
<div style="width: 70%;margin: 0 auto;">
<?php $location="judge"; include("header.html.php"); ?>

<div style="width: 100%;margin: 0 auto;">
    <h2>在下边的框中放入你的代码：</h2>
    <form method="post" action="../handler/program_judge.php">
    <input type="submit" value="提交">
    <textarea  style="width:100%;max-width:100%;height:500px;" name="code"></textarea>
    </form>
</div>

</div>
</body>
</html>