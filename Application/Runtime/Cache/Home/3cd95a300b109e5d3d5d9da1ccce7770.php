<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
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
<link href="/tp/css/jumbotron-narrow.css" rel="stylesheet">

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
					<a class="navbar-brand" href="<?php echo U('/home/index');?>">主页</a>
				</div>
		
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse navbar-ex1-collapse">
					<ul class="nav navbar-nav">
						<li ><a href="<?php echo U('/home/index/info');?>">活动信息</a></li>
						<li ><a href="<?php echo U('/home/index/love_wall');?>">表白墙</a></li>
						<li><a href="<?php echo U('/home/user');?>">个人信息</a></li>
						<li><a href="<?php echo U('/pay');?>">捐助我们</a></li>
					</ul>
					<form class="navbar-form navbar-left" role="search" method="post" action="<?php echo U('/home/index/search');?>">
						<div class="form-group">
							<input type="text" class="form-control" name="query" placeholder="Search">
						</div>
						<button type="submit" class="btn btn-default">GO</button>
					</form>
					<ul class="nav navbar-nav navbar-right">
						<li><a href="<?php echo U('/home/user/level');?>"><?php if(isset($_SESSION['uid'])){echo query_user_exist($_SESSION['uid']);}else{echo "游客";} ?></a></li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">消息和通知 <b class="caret"></b></a>
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
    <div class="container">

      <div class="jumbotron">
        <h1>Jumbotron heading</h1>
        <p class="lead">Cras justo odio, dapibus ac facilisis in, egestas eget quam. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
        <p><a class="btn btn-lg btn-success" href="#" role="button">Sign up today</a></p>
      </div>

      <div class="row marketing">
        <div class="col-lg-6">
          <h4>Subheading</h4>
          <p>Donec id elit non mi porta gravida at eget metus. Maecenas faucibus mollis interdum.</p>

          <h4>Subheading</h4>
          <p>Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Cras mattis consectetur purus sit amet fermentum.</p>

          <h4>Subheading</h4>
          <p>Maecenas sed diam eget risus varius blandit sit amet non magna.</p>
        </div>

        <div class="col-lg-6">
          <h4>Subheading</h4>
          <p>Donec id elit non mi porta gravida at eget metus. Maecenas faucibus mollis interdum.</p>

          <h4>Subheading</h4>
          <p>Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Cras mattis consectetur purus sit amet fermentum.</p>

          <h4>Subheading</h4>
          <p>Maecenas sed diam eget risus varius blandit sit amet non magna.</p>
        </div>
      </div>

      <footer class="footer">
        <p>&copy; Company 2014</p>
      </footer>

    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    
  </body>
</html>