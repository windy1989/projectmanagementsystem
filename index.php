<?php 
	ini_set('session.cookie_lifetime', 60 * 60 * 24 * 100);
	ini_set('session.gc_maxlifetime', 60 * 60 * 24 * 100);
	session_start();
	if(isset($_SESSION['isLogin'])){
		require 'adminpage/router/router.php';
	}else{
		require 'pages/login.php';
	}
?>