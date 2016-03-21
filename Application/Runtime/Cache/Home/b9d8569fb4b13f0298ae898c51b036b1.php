<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>BIT素颜女神</title>

		<!-- Bootstrap CSS -->
		<link href="/tp/css/bootstrap.min.css" rel="stylesheet">

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
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
					<form class="navbar-form navbar-left" role="search">
						<div class="form-group">
							<input type="text" class="form-control" placeholder="Search">
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
						<th>排名</th>
						<th>照片</th>
						<th>总票数</th>
					</tr>
				</thead>
				<tbody>
					<tr onclick="jump('<?php echo U('Home/User/Info/uid/'.$no_1['uid']);?>')">
						<td><?php echo ($no_1["username"]); ?></td>
						<td>1</td>
						<td><img src="<?php echo ($no_1["img_url"]); ?>"  width="50" height="50"></td>
						<td><?php echo ($no_1["vote_number"]); ?></td>
						<td><button class="btn btn-primary btn-block" onclick="document.location.href='<?php echo U('Home/Index/vote/uid/'.$no_1['uid']);?>';">VOTE</button></td>
					</tr>

					<tr onclick="jump('<?php echo U('Home/User/Info/uid/'.$no_2['uid']);?>')">
						<td><?php echo ($no_2["username"]); ?></td>
						<td>2</td>
						<td><img src="<?php echo ($no_2["img_url"]); ?>"  width="50" height="50"></td>
						<td><?php echo ($no_2["vote_number"]); ?></td>
						<td><button class="btn btn-primary btn-block" onclick="document.location.href='<?php echo U('Home/Index/vote/uid/'.$no_2['uid']);?>';">VOTE</button></td>
						</tr>

					<tr onclick="jump('<?php echo U('Home/User/Info/uid/'.$no_3['uid']);?>')" onclick="jump('<?php echo U('Home/User/Info/uid/'.$no_1['uid']);?>')">
						<td><?php echo ($no_3["username"]); ?></td>
						<td>3</td>
						<td><img src="<?php echo ($no_3["img_url"]); ?>"  width="50" height="50"></td>
						<td><?php echo ($no_3["vote_number"]); ?></td>
						<td><button class="btn btn-primary btn-block" onclick="document.location.href='<?php echo U('Home/Index/vote/uid/'.$no_3['uid']);?>';">VOTE</button></td>
					</tr>

					<tr onclick="jump('<?php echo U('Home/User/Info/uid/'.$no_4['uid']);?>')">
						<td><?php echo ($no_4["username"]); ?></td>
						<td>4</td>
						<td><img src="<?php echo ($no_4["img_url"]); ?>"  width="50" height="50"></td>
						<td><?php echo ($no_4["vote_number"]); ?></td>
						<td><button class="btn btn-primary btn-block" onclick="document.location.href='<?php echo U('Home/Index/vote/uid/'.$no_4['uid']);?>';">VOTE</button></td>
					</tr>

					<tr onclick="jump('<?php echo U('Home/User/Info/uid/'.$no_5['uid']);?>')">
						<td><?php echo ($no5["username"]); ?></td>
						<td>5</td>
						<td><img src="<?php echo ($no5["img_url"]); ?>"  width="50" height="50"></td>
						<td><?php echo ($no5["vote_number"]); ?></td>
						<td><button class="btn btn-primary btn-block" onclick="document.location.href='<?php echo U('Home/Index/vote/uid/'.$no_5['uid']);?>';">VOTE</button></td>
					</tr>

					<tr onclick="jump('<?php echo U('Home/User/Info/uid/'.$no_6['uid']);?>')">
						<td><?php echo ($no_6["username"]); ?></td>
						<td>6</td>
						<td><img src="<?php echo ($no_6["img_url"]); ?>"  width="50" height="50"></td>
						<td><?php echo ($no_6["vote_number"]); ?></td>
						<td><button class="btn btn-primary btn-block" onclick="document.location.href='<?php echo U('Home/Index/vote/uid/'.$no_6['uid']);?>';">VOTE</button></td>
					</tr>

					<tr onclick="jump('<?php echo U('Home/User/Info/uid/'.$no_7['uid']);?>')">
						<td><?php echo ($no_7["username"]); ?></td>
						<td>7</td>
						<td><img src="<?php echo ($no_7["img_url"]); ?>"  width="50" height="50"></td>
						<td><?php echo ($no_7["vote_number"]); ?></td>
						<td><button class="btn btn-primary btn-block" onclick="document.location.href='<?php echo U('Home/Index/vote/uid/'.$no_7['uid']);?>';">VOTE</button></td>
					</tr>

					<tr onclick="jump('<?php echo U('Home/User/Info/uid/'.$no_8['uid']);?>')">
						<td><?php echo ($no_8["username"]); ?></td>
						<td>8</td>
						<td><img src="<?php echo ($no_8["img_url"]); ?>"  width="50" height="50"></td>
						<td><?php echo ($no_8["vote_number"]); ?></td>
						<td><button class="btn btn-primary btn-block" onclick="document.location.href='<?php echo U('Home/Index/vote/uid/'.$no_8['uid']);?>';">VOTE</button></td>
					</tr>

					<tr onclick="jump('<?php echo U('Home/User/Info/uid/'.$no_9['uid']);?>')">
						<td><?php echo ($no_9["username"]); ?></td>
						<td>9</td>
						<td><img src="<?php echo ($no_9["img_url"]); ?>"  width="50" height="50"></td>
						<td><?php echo ($no_9["vote_number"]); ?></td>
						<td><button class="btn btn-primary btn-block" onclick="document.location.href='<?php echo U('Home/Index/vote/uid/'.$no_9['uid']);?>';">VOTE</button></td>
					</tr>

					<tr onclick="jump('<?php echo U('Home/User/Info/uid/'.$no_10['uid']);?>')">
						<td><?php echo ($no_10["username"]); ?></td>
						<td>10</td>
						<td><img src="<?php echo ($no_10["img_url"]); ?>"  width="50" height="50"></td>
						<td><?php echo ($no_10["vote_number"]); ?></td>
						<td><button class="btn btn-primary btn-block" onclick="document.location.href='<?php echo U('Home/Index/vote/uid/'.$no_10['uid']);?>';">VOTE</button></td>
					</tr>
				</tbody>
			</table>
		</div>
		<!-- jQuery -->
		<script src="//code.jquery.com/jquery.js"></script>
		<script>
		function jump(url){
			//通过设置延迟来解决onclick的冲突
			window.setTimeout("document.location.href='"+url+"'",400);
		}
		</script>
		<!-- Bootstrap JavaScript -->
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	</body>
</html>