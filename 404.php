<?php
include('functions.php');
?>

<html>

<head>
    <title>404 Error</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
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
    <h1>404</h1><br>
    <h3> The page cannot be found. <a href="myprofile.php">Click Here </a>to go back to your profile.</h3>
    <br>
    </div>
	</div>
    <div class="loginphone visible-phone">
    <center>
    <h1>404</h1><br>
    <h3> The page cannot be found. <a href="myprofile.php">Click Here </a>to go back to your profile.</h3>
    <br>
    </center>
    </div>
</body>
</html>