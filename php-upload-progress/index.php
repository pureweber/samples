<?php session_start(); ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="utf-8">
	<title>Demo : PHP(5.4) Upload Progress via Session</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<meta name="author" content="">
	<meta name="robots" content="INDEX,FOLLOW" />

	<link rel="shortcut icon" href="/favicon.ico">
	<link href="../assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="../assets/css/pureweber.css" rel="stylesheet">

<style type="text/css">
.progress{
	width:100%;
	border:1px solid #4da8fe;
	border-radius:40px;
	height:20px;
	position:relative;
}
.progress .label{
	position:relative;
	text-align:center;
}
.progress .bar{
	position:absolute;
	left:0;top:0;
	background:#4D90FE;
	height:20px;
	border-radius:40px;
	min-width:20px;
}
</style>

</head>
<body>
	<div id="nav" class="container">
		<div class="inner">
			<a href="/" class="logo">PureWeber</a>
		<ul>
			<li><a id="to-top" href="#nav">&laquo; 回到文章</a></li>
		</ul>
		</div>
	</div>
	<div id="wrap" class="container">

<div id="header">
	<h1>Demo : PHP(5.4) Upload Progress via Session</h1>
</div>
<div id="article">

<form id="upload-form" action="upload.php" method="POST" enctype="multipart/form-data" style="margin:15px 0" target="hidden_iframe">
	<input type="hidden" name="<?php echo ini_get("session.upload_progress.name"); ?>" value="test" />
	<p><input type="file" name="file1" /></p>
	<p><input type="submit" value="Upload" /></p>
</form>


<div id="progress" class="progress" style="margin-bottom:15px;display:none;">
	<div class="bar" style="width:0%;"></div>
	<div class="label">0%</div>
</div>

</div> <!-- #article -->

	<div id="footer">
		<p>Copyright &copy; 2012 PureWeber.com</p>
	</div>
</div><!-- #wrap -->


<iframe id="hidden_iframe" name="hidden_iframe" src="about:blank" style="display:none;"></iframe>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script type="text/javascript">
var upload_done = false;
var timerID = null;

function fetch_progress(){
	$.get('progress.php',{ '<?php echo ini_get("session.upload_progress.name"); ?>' : 'test'}, function(data){
		var progress = parseInt(data);

		$('#progress .label').html(progress + '%');
		$('#progress .bar').css('width', progress + '%');

		if(progress >= 100){
			clearInterval(timerID);
		}
	}, 'html');
}

$('#upload-form').submit(function(){
	$('#progress').show();
	timerID = setInterval('fetch_progress()', 1000);
});
</script>
</body>
</html>
