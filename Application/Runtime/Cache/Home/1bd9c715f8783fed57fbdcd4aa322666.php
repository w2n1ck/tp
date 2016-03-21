<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../favicon.ico">

    <title>Signin Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="/tp/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/tp/css/admin_login.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="../../assets/js/ie-emulation-modes-warning.js"></script>
    <script language="javascript"  type="text/javascript">
    var flag=1;
    function $(id)
    {
      return document.getElementById(id);
    }
      function controldiv()
    {
      if(flag==0)
    {
        $("info").style.display="none";
        flag=1;
    }
    else
    {
        $("info").style.display="";
        flag=0;    
    }
    }
</script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container">

      <form class="form-signin" method="post" action="./login">
        <h2 class="form-signin-heading">User sign in</h2>
        <label for="inputuid" class="sr-only">Uid</label>
        <input type="uid" name="uid" id="inputuid" class="form-control" placeholder="uid" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
        <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> Remember me
          </label>
        <div style="float:right">
        <a href="#" onclick="controldiv()">关于账号的说明</a>
        </div>

        </div>
        <div id="info" class="alert alert-warning" style="display:none" >
        请注意：<br>1.填写的账号为您的学号，填写的密码为校园服务单点登录的密码（也是网络教室、北理在线的密码）
        <br>2.我们不会恶意收集您的密码信息<br>3.在您登录后我们会采集您的基本信息
        </div>
        <button class="btn btn-lg btn-success btn-block" type="submit">Sign in</button>
      </form>

    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>