<?php require("includes/settings.php"); ?>

<?php
function IS_LOGGED_IN() {
	global $dsn, $username, $password;
	
	//DB接続
	try {
		$dbh = new PDO($dsn, $username, $password);
	} catch (PDOException $e) {
		$msg = $e->getMessage();
	}

	//ログイン認証
	$sql = "SELECT * FROM users WHERE user_id = :user_id AND user_pwd = :user_pwd";
	$stmt = $dbh->prepare($sql);

	$params = array(':user_id' => $_COOKIE["uid"], ':user_pwd' => $_COOKIE["pwd"]);
	$stmt->execute($params);
	$status = $stmt -> rowCount(); //検索に一致した件数をそのままフラグにする
	
	return $status;
}
?>

<?php
$src = $_GET['src'];

if (IS_LOGGED_IN()) {
	//下で読み込むファイルがあるかどうか
	if (file_exists("admin/".$src.".php")) {
		//適切なファイルを表示
    	include("admin/".$src.".php");
	} else {
		echo "file not exists";
	}
} else {
    //ログインフォームの表示
	include("admin/login.php");
}
?>