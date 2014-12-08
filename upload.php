<html>
<head>
<link href="css/bootstrap.css" rel="stylesheet">
<link href="css/bootstrap-responsive.css" rel="stylesheet">
</head>
<body>
<form action="upload_file.php" method="post"
enctype="multipart/form-data">
<label for="file"><strong>Filename:</strong></label>
<input type="file" name="file" id="file" /> 
<br />
<input type="submit" class="btn" name="submit" value="Submit" />
</form>
</body>
</html>