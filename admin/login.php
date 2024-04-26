<?php
if($_SERVER['REQUEST_METHOD'] == "POST") {
	//ここでログイン処理をする

	//DB接続
	require("../includes/settings.php");
	try {
		$dbh = new PDO($dsn, $username, $password);
	} catch (PDOException $e) {
		$msg = $e->getMessage();
	}

	//ログイン認証
	$sql = "SELECT * FROM users WHERE user_id = :user_id AND user_pwd = :user_pwd";

	$stmt = $dbh->prepare($sql);
	$params = array(':user_id' => $_POST["user_id"], ':user_pwd' => $_POST["user_pwd"]);
	$stmt->execute($params);
	$status = $stmt -> rowCount(); //検索に一致した件数をそのままフラグにする

	
	if ($status == 1) {
		//成功
		//クッキー書き込み

		//ハッシュを作成してクッキーに書き込む。
		setcookie("uid", $_POST["user_id"],-1,"/");
		setcookie("pwd", $_POST["user_pwd"],-1,"/");
		setcookie("session", $_POST["user_pwd"],-1,"/");
	} else {
		//IDかパスワードが違う。
		http_response_code(202);
	}
} else {
	//POSTではない場合。
	//何もしない(ログイン画面だけ表示。)s
}
?>

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
	<link rel="stylesheet" href="./admin/login.css">
</head>

<body>
<?php include("../html-includes/topmenu.php"); ?>

	<div id="main_content">
		<img src="logo.png">
		<form id="form" action="/expert/admin/login.php">
			<input type="text" name="user_id" class="input_box form-control" placeholder="ユーザーID">
			<input type="password" name="user_pwd" class="input_box form-control" placeholder="パスワード">
			<hr>
			<button id="submit" type="button" class="input_box form-control">ログイン</button>
		</form>
	</div>

	<script src="./admin/login.js" async></script>
</body>
</html>
