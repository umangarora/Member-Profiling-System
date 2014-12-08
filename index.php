<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-45384942-1', 'aiesecdelhiuniversity.in');
  ga('send', 'pageview');

</script>

<?php
include('functions.php');
if(isset($_SESSION['id'])){
	header('Location: myprofile.php') ;
}
else{
	if(isset($_POST['user'])){
		$user = $_POST['user'];
		$pass= md5($_POST['pass']);
		$user_id=login($user,$pass);
		if($user_id>=1){
			if(isset($_GET['continue'])){
				header('Location:'.$_GET['continue']);
			}
			else{
			header('Location: myprofile.php') ;
			}
		}
		if($user_id==0)
			$err='<center><div class="alert alert-error">
			Incorrect Usename/Password
</div></center>';
	}
}
?>

<html>

<head>
    <title>AIESEC in Delhi University</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/bootstrap-responsive.css" rel="stylesheet">
    <style type="text/css">
	.container{
		background-image:url(img/background.png);
		background:url(img/background.png);
		background-position:center;
		background-repeat:no-repeat;
		background-size:contain;
		background-attachment:fixed;
		margin:0 auto;
		padding: 0 auto;
		height:100%;
		width:100%;
		overflow:hidden;
		position:absolute;
		min-width:800px;
	}
    .login{
		position:absolute;
		width:25%;
		height:300px;
		top:50%;
		margin:-150px 0 0 10%;
	}
	.loginphone{
		position:absolute;
		height:300px;
		left:50%;
		width:300px;
		top:50%;
		margin:-150px 0 0 -150px;
	}
    </style>
</head>
<body>
    <div class="container hidden-phone">
    <div class="login">
    <form action="index.php<?php if(isset($_GET['continue'])) echo '?continue='.$_GET['continue']; ?>" method="post">
    <fieldset>
    <legend>Login to Continue</legend>
    <label>Username</label>
    <input type="text" class="span4" name="user">
    <label>Password</label>
    <input type="password" class="span4" name="pass"><br />
    <button type="submit" class="btn btn-primary">Login</button>
  	</fieldset>
	</form><br>
    <?php if(isset($err))
echo $err; ?>
    </div>
	</div>
    <div class="loginphone visible-phone">
    <center>
    <form action="index.php" method="post">
    <fieldset>
    <legend>Login to Continue</legend>
    <label>Username</label>
    <input type="text" name="user">
    <label>Password</label>
    <input type="password" name="pass"><br />
    <button type="submit" class="btn btn-primary">Login</button>
  	</fieldset>
	</form>
    
    <br>
    <?php if(isset($err))
echo $err; ?>
    </center>
    </div>
</body>
</html>

<?php  ?>