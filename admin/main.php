<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title><?php echo "問い合わせ確認"." in ".$SERVICE_NAME ?></title>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="http://fonts.googleapis.com/earlyaccess/notosansjp.css">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="../master.css">
</head>

<?php

	try {
			$dbh = new PDO($dsn, $username, $password);
	} catch (PDOException $e) {
			$msg = $e->getMessage();
	}

	$sql = "SELECT * FROM contact_form WHERE 1=1";
	$stmt = $dbh->prepare($sql);

	$stmt->execute();

?>

<body>
	<div id="main_content">
		<p>ログイン成功しました</p>
	</div>

</body>
</html>
