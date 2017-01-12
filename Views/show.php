<!DOCTYPE html>
<html lang="zh">
<head>
    <title>online-statistics</title>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/app.css" rel="stylesheet">
    <script src="/js/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
</head>
<body>
<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-5">
        <h1 class="page-header">阅读: <span class="text-muted"><?php echo $file->name ?></span>
            <a class="btn btn-primary" href="/">返回</a>
        </h1>
    </div>
    <div class="col-md-2"></div>
    <div class="col-md-4">
        <h3><span class="text-center">观看时间: <b id="time">0</b>秒</span></h3>
    </div>
</div>
<div class="container">
    <iframe width="100%" height="500" src="<?php echo $file->src?>"></iframe>
</div>
</body>

<script>
    time = $("#time");
    timer = setInterval(setTime,1000);
    function setTime() {
        time.text(parseInt(time.text())+1);
    }

    window.onbeforeunload = function(){
        $.ajax({
            url: '/read?id=<?php echo $file->id;?>&time='+time.text(),
            type: 'GET',
            async: false,//这里要同步，否则关闭浏览器的时候fiexfox可能无法正常发送请求
        });
        return false;
    }
</script>

</html>