<?php
	require '../adminpage/conn/conn.php';
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
		$password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
		
		$stmt = $dbh->prepare("SELECT ID,NAMA_LENGKAP,EMAIL,USERNAME,PASSWORD,JK,HAK_AKSES FROM sim_pengguna WHERE USERNAME = ? AND STATUS = 1");
		$stmt->execute([$username]);
		$jumlah = $stmt->rowCount();
		$user = $stmt->fetch(PDO::FETCH_ASSOC);
		
		if($jumlah > 0){
			if(password_verify($password, $user['PASSWORD'])) {
				echo "1";
				session_start();
				$_SESSION['isLogin'] = "1";
				$_SESSION['userInfo'] = $user;
			}else{
				echo "0";
			}
		}else{
			echo "-1";
		}
	}
?>