<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>BIT素颜女神</title>

	<!-- Bootstrap CSS -->
	<link href="/tp/css/bootstrap.min.css" rel="stylesheet">

	
</head>
<script>
		function jump(url){
			//通过设置延迟来解决onclick的冲突
			window.setTimeout("document.location.href='"+url+"'",400);
		}
</script>
<body>
		<nav class="navbar navbar-default" role="navigation">
			<div class="container-fluid">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="#">Title</a>
				</div>
		
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse navbar-ex1-collapse">
					<ul class="nav navbar-nav">
						<li class="active"><a href="#">Link</a></li>
						<li><a href="#">Link</a></li>
					</ul>
					<form class="navbar-form navbar-left" role="search" method="post" action="/tp/home/index/search">
						<div class="form-group">
							<input type="text" class="form-control" name="query" placeholder="Search">
						</div>
						<button type="submit" class="btn btn-default">Submit</button>
					</form>
					<ul class="nav navbar-nav navbar-right">
						<li><a href="#">Link</a></li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><a href="#">Action</a></li>
								<li><a href="#">Another action</a></li>
								<li><a href="#">Something else here</a></li>
								<li><a href="#">Separated link</a></li>
							</ul>
						</li>
					</ul>
				</div><!-- /.navbar-collapse -->
			</div>
		</nav>
		<div class="container-fluid">
			<table class="table table-hover">
				<thead>
					<tr>
						<th>姓名</th>
						<th>专业</th>
						<th>照片</th>
						<th>总票数</th>
					</tr>
				</thead>
				<tbody>
				 <?php if(is_array($info)): $i = 0; $__LIST__ = $info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr onclick="jump('<?php echo U('Home/User/Info/uid/'.$vo['uid']);?>')">
						<td><?php echo ($vo["username"]); ?></td>
						<td><?php echo ((isset($vo["major_class"]) && ($vo["major_class"] !== ""))?($vo["major_class"]):"null"); ?></td>
						<td><img src="<?php echo ($vo["img_url"]); ?>"  width="50" height="50"></td>
						<td><?php echo ($vo["vote_number"]); ?></td>
						<td><button class="btn btn-primary btn-block" onclick="document.location.href='<?php echo U('Home/Index/vote/uid/'.$vo['uid']);?>';">VOTE</button></td>
					</tr><?php endforeach; endif; else: echo "" ;endif; ?>

<ul class="pagination">
  <li ><a href="<?php echo U('Home/Index/search?'.$info2['query_previous']);?>">&laquo;</a></li>
  <li ><a href="<?php echo U('Home/Index/search?'.$info2['query_next']);?>">&raquo;</a></li>
</ul>
				</tbody>
			</table>
		</div>

<style type="text/css">
	.pagination {display:inline;}
	.pagination>li:last-child>a{float:right;}
</style>


</body>
</html>