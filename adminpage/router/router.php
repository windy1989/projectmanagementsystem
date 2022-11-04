<?php 
	require 'adminpage/conn/conn.php';
	$request = filter_var($_SERVER['REQUEST_URI'], FILTER_SANITIZE_STRING);
	$arrUrl = explode('/',$request);
	$halaman = explode('?',$arrUrl[2])[0];
	if(count(explode('?',$arrUrl[2])) > 1){
		$param = explode('?',$arrUrl[2])[1];
	}
	$arrPage = array("pelanggan","jenisProyek","pengguna","syarat","bank");
	$arrPageProyek = array("proyek","pembayaran","survei","teknis","sidangDishub","timeline");
	$arrPageKeuangan = array("kasMasuk","kasKeluar","kasMasukKecil","kasKeluarKecil");
	$arrPageKasBesar = array("kasMasuk","kasKeluar");
	$arrPageKasKecil = array("kasMasukKecil","kasKeluarKecil");
	switch ($halaman) {
		case '' :
			require 'adminpage/control/home.php';
			break;
		case 'pengguna' :
			if($_SESSION['userInfo']['HAK_AKSES']=='admin' or $_SESSION['userInfo']['HAK_AKSES']=='superadmin'){
				require 'adminpage/control/pengguna.php';
				break;
			}else{
				http_response_code(404);
				die();
			}
		case 'pelanggan' :
			if($_SESSION['userInfo']['HAK_AKSES']=='admin' or $_SESSION['userInfo']['HAK_AKSES']=='superadmin'){
				require 'adminpage/control/pelanggan.php';
				break;
			}else{
				http_response_code(404);
				die();
			}
		case 'jenisProyek' :
			if($_SESSION['userInfo']['HAK_AKSES']=='admin' or $_SESSION['userInfo']['HAK_AKSES']=='superadmin'){
				require 'adminpage/control/jenis.php';
				break;
			}else{
				http_response_code(404);
				die();
			}
		case 'syarat' :
			if($_SESSION['userInfo']['HAK_AKSES']=='admin' or $_SESSION['userInfo']['HAK_AKSES']=='superadmin'){
				require 'adminpage/control/syarat.php';
				break;
			}else{
				http_response_code(404);
				die();
			}
		case 'keluar' :
			require 'adminpage/control/logout.php';
			break;
		case 'proyek' :
			if($_SESSION['userInfo']['HAK_AKSES']=='admin' or $_SESSION['userInfo']['HAK_AKSES']=='superadmin'){
				require 'adminpage/control/proyek.php';
				break;
			}else{
				http_response_code(404);
				die();
			}
		case 'bank' :
			if($_SESSION['userInfo']['HAK_AKSES']=='admin' or $_SESSION['userInfo']['HAK_AKSES']=='superadmin'){
				require 'adminpage/control/bank.php';
				break;
			}else{
				http_response_code(404);
				die();
			}
		case 'pembayaran' :
			if($_SESSION['userInfo']['HAK_AKSES']=='admin' or $_SESSION['userInfo']['HAK_AKSES']=='superadmin'){
				require 'adminpage/control/pembayaran.php';
				break;
			}else{
				http_response_code(404);
				die();
			}
		case 'survei' :
			if($_SESSION['userInfo']['HAK_AKSES']=='survei' or $_SESSION['userInfo']['HAK_AKSES']=='superadmin'){
				require 'adminpage/control/survei.php';
				break;
			}else{
				http_response_code(404);
				die();
			}
		case 'teknis' :
			if($_SESSION['userInfo']['HAK_AKSES']=='teknis' or $_SESSION['userInfo']['HAK_AKSES']=='superadmin'){
				require 'adminpage/control/teknis.php';
				break;
			}else{
				http_response_code(404);
				die();
			}
		case 'sidangDishub' :
			if($_SESSION['userInfo']['HAK_AKSES']=='admin' or $_SESSION['userInfo']['HAK_AKSES']=='superadmin'){
				require 'adminpage/control/sidangdishub.php';
				break;
			}else{
				http_response_code(404);
				die();
			}
		case 'timeline' :
			if( $_SESSION['userInfo']['HAK_AKSES']=='superadmin'){
				require 'adminpage/control/timeline.php';
				break;
			}else{
				http_response_code(404);
				die();
			}
		case 'laporan' :
			if($_SESSION['userInfo']['HAK_AKSES']=='admin' or $_SESSION['userInfo']['HAK_AKSES']=='superadmin'){
				require 'adminpage/control/laporan.php';
				break;
			}else{
				http_response_code(404);
				die();
			}
		case 'kasMasuk' :
			if($_SESSION['userInfo']['HAK_AKSES']=='superadmin'){
				require 'adminpage/control/kasmasuk.php';
				break;
			}else{
				http_response_code(404);
				die();
			}
		case 'kasKeluar' :
			if($_SESSION['userInfo']['HAK_AKSES']=='superadmin'){
				require 'adminpage/control/kaskeluar.php';
				break;
			}else{
				http_response_code(404);
				die();
			}
		case 'kasMasukKecil' :
			if($_SESSION['userInfo']['HAK_AKSES']=='admin' or $_SESSION['userInfo']['HAK_AKSES']=='superadmin'){
				require 'adminpage/control/kasmasukkecil.php';
				break;
			}else{
				http_response_code(404);
				die();
			}
		case 'kasKeluarKecil' :
			if($_SESSION['userInfo']['HAK_AKSES']=='admin' or $_SESSION['userInfo']['HAK_AKSES']=='superadmin'){
				require 'adminpage/control/kaskeluarkecil.php';
				break;
			}else{
				http_response_code(404);
				die();
			}
		case 'update' :
			if($_SESSION['userInfo']['HAK_AKSES']=='superadmin'){
				
				require 'adminpage/control/update.php';
				break;
			}else{
				http_response_code(404);
				die();
			}
		case 'panduan' :
			require 'adminpage/control/panduan.php';
			break;
		default:
			http_response_code(404);
			die();
	}
?>