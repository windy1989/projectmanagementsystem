<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Victory App V.20.1</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ekko Lightbox -->
  <link rel="stylesheet" href="plugins/ekko-lightbox/ekko-lightbox.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="plugins/toastr/toastr.min.css?v=3">
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="plugins/datatables-select/css/select.bootstrap4.css">
  <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">
  <link href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css" rel="stylesheet">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <style>
	ul li ul li.nav-item {
		margin-left: 15px !important;
	}
	#mapid { height: 500px; }
	#mapall { height: 500px; }
	.datepicker{
		z-index:999999 !important;
	}
  </style>
  <link rel="stylesheet" href="plugins/pace-progress/themes/blue/pace-theme-corner-indicator.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <script type="text/javascript" src="plugins/instascan/instascan.min.js?v=0"></script>
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
		
      </li>
      <li class="nav-item">
		<a class="nav-link" href="#">
			Status : 
			<?php 
				if($koneksipusat == false){
					echo '<span class="badge badge-danger">Non-Aktif</span>';
				}else{
					echo '<span class="badge badge-success">Aktif</span>';
				}
			?>
		</a>
	  </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
	  <li class="nav-item dropdown user-menu">
        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
          <img src="<?=$_SESSION['userInfo']['JK'] == 'L' ? 'dist/img/avatar5.png' : 'dist/img/avatar2.png' ?>" class="user-image img-circle elevation-2" alt="User Image">
          <span class="d-none d-md-inline"><?=$_SESSION['userInfo']['NAMA_LENGKAP']?></span>
        </a>
        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="margin-right:-25px !important;">
          <!-- User image -->
          <li class="user-header bg-primary">
            <img src="<?=$_SESSION['userInfo']['JK'] == 'L' ? 'dist/img/avatar5.png' : 'dist/img/avatar2.png' ?>" class="img-circle elevation-2" alt="User Image">

            <p>
              <?=$_SESSION['userInfo']['NAMA_LENGKAP'].' - '.strtoupper($_SESSION['userInfo']['HAK_AKSES'])?>
              <!-- <small>Member since Nov. 2012</small> -->
            </p>
          </li>
          <!-- Menu Body -->
          <li class="user-body">
            <div class="row">
              <!-- <div class="col-6 text-center">
                <a href="#" class="btn btn-default btn-flat">Profil</a>
              </div> -->
              <div class="col-12 text-right">
                <a href="./keluar" class="btn btn-default btn-flat">Keluar</a>
              </div>
            </div>
            <!-- /.row -->
          </li>
        </ul>
      </li>
	  
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="./" class="brand-link">
      <img src="dist/images/cropped-logo-192x192.jpeg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3">
      <span class="brand-text font-weight-light">Victory App V.20.1</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="./" class="nav-link <?=$halaman=='' ? 'active' : ''?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
	<?php if($_SESSION['userInfo']['HAK_AKSES']=='admin' or $_SESSION['userInfo']['HAK_AKSES']=='superadmin'){ ?>
		  <li class="nav-item has-treeview <?=in_array($halaman,$arrPage) ? 'menu-open' : ''?>">
            <a href="#" class="nav-link <?=in_array($halaman,$arrPage) ? 'active' : ''?>">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Master
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="font-size:0.9rem !important;">
			  <li class="nav-item">
                <a href="./pengguna" class="nav-link <?=$halaman=='pengguna' ? 'active' : ''?>">
                  <i class="fas fa-user-tie nav-icon"></i>
                  <p>Pegawai</p>
                </a>
              </li>
			  <li class="nav-item">
                <a href="./pelanggan" class="nav-link <?=$halaman=='pelanggan' ? 'active' : ''?>">
                  <i class="fas fa-user-alt nav-icon"></i>
                  <p>Pelanggan</p>
                </a>
              </li>
			  <li class="nav-item">
                <a href="./jenisProyek" class="nav-link <?=$halaman=='jenisProyek' ? 'active' : ''?>">
                  <i class="fas fa-th-large nav-icon"></i>
                  <p>Jenis Proyek</p>
                </a>
              </li>
			  <li class="nav-item">
                <a href="./syarat" class="nav-link <?=$halaman=='syarat' ? 'active' : ''?>">
                  <i class="far fa-window-restore nav-icon"></i>
                  <p>Syarat</p>
                </a>
              </li>
			  <li class="nav-item">
				<a href="./bank" class="nav-link <?=$halaman=='bank' ? 'active' : ''?>">
				  <i class="fas fa-money-check-alt nav-icon"></i>
				  <p>
					Bank
				  </p>
				</a>
			  </li>
            </ul>
          </li>
	<?php } ?>
		  <li class="nav-item has-treeview <?=in_array($halaman,$arrPageProyek) ? 'menu-open' : ''?>">
            <a href="#" class="nav-link <?=in_array($halaman,$arrPageProyek) ? 'active' : ''?>">
              <i class="nav-icon fas fa-business-time"></i>
              <p>
                Proyek
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="font-size:0.9rem !important;">
				<?php if($_SESSION['userInfo']['HAK_AKSES']=='admin' or $_SESSION['userInfo']['HAK_AKSES']=='superadmin'){ ?>
				  <li class="nav-item">
					<a href="./proyek" class="nav-link <?=$halaman=='proyek' ? 'active' : ''?>">
					  <i class="nav-icon fas fa-tasks"></i>
					  <p>
						Proyek
					  </p>
					</a>
				  </li>
				  <li class="nav-item">
					<a href="./pembayaran" class="nav-link <?=$halaman=='pembayaran' ? 'active' : ''?>">
					  <i class="nav-icon fas fa-file-invoice"></i>
					  <p>
						Pembayaran
					  </p>
					</a>
				  </li>
				<?php } ?>
				
				<?php if($_SESSION['userInfo']['HAK_AKSES']=='survei' or $_SESSION['userInfo']['HAK_AKSES']=='superadmin'){ ?>
				  <li class="nav-item">
					<a href="./survei" class="nav-link <?=$halaman=='survei' ? 'active' : ''?>">
					  <i class="nav-icon fas fa-camera-retro"></i>
					  <p>
						Survei
					  </p>
					</a>
				  </li>
				<?php } ?>
				
				<?php if($_SESSION['userInfo']['HAK_AKSES']=='teknis' or $_SESSION['userInfo']['HAK_AKSES']=='superadmin'){ ?>
				  <li class="nav-item">
					<a href="./teknis" class="nav-link <?=$halaman=='teknis' ? 'active' : ''?>">
					  <i class="nav-icon far fa-images"></i>
					  <p>
						Teknis
					  </p>
					</a>
				  </li>
				<?php } ?>
				
				<?php if($_SESSION['userInfo']['HAK_AKSES']=='admin' or $_SESSION['userInfo']['HAK_AKSES']=='superadmin'){ ?>
				  <li class="nav-item">
					<a href="./sidangDishub" class="nav-link <?=$halaman=='sidangDishub' ? 'active' : ''?>">
					 <i class="nav-icon fas fa-university"></i>
					  <p>
						Sidang & Dishub
					  </p>
					</a>
				  </li>
				<?php } ?>
				
				<?php if( $_SESSION['userInfo']['HAK_AKSES']=='superadmin'){ ?>
				  <li class="nav-item">
					<a href="./timeline" class="nav-link <?=$halaman=='timeline' ? 'active' : ''?>">
					  <i class="nav-icon far fa-calendar-check"></i>
					  <p>
						Timeline
					  </p>
					</a>
				  </li>
				<?php } ?>
			</ul>
		  </li>
		  <?php if($_SESSION['userInfo']['HAK_AKSES']=='admin' or $_SESSION['userInfo']['HAK_AKSES']=='superadmin'){ ?>
		  <li class="nav-item has-treeview <?=in_array($halaman,$arrPageKeuangan) ? 'menu-open' : ''?>">
			<a href="#" class="nav-link <?=in_array($halaman,$arrPageKeuangan) ? 'active' : ''?>">
			  <i class="nav-icon fas fa-money-bill"></i>
			  <p>
				Keuangan
				<i class="fas fa-angle-left right"></i>
			  </p>
			</a>
				<ul class="nav nav-treeview" style="font-size:0.9rem !important;">
				  <?php if($_SESSION['userInfo']['HAK_AKSES']=='superadmin'){ ?>
				  <li class="nav-item has-treeview <?=in_array($halaman,$arrPageKasBesar) ? 'menu-open' : ''?>">
					<a href="#" class="nav-link <?=in_array($halaman,$arrPageKasBesar) ? 'active' : ''?>">
					  <i class="nav-icon fas fa-money-bill"></i>
					  <p>
						Kas Besar
						<i class="fas fa-angle-left right"></i>
					  </p>
					</a>
					<ul class="nav nav-treeview" style="font-size:0.9rem !important;">
						<li class="nav-item">
							<a href="./kasMasuk" class="nav-link <?=$halaman=='kasMasuk' ? 'active' : ''?>">
								<i class="nav-icon fas fa-hand-holding-usd"></i>
								<p>
									Masuk
								</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="./kasKeluar" class="nav-link <?=$halaman=='kasKeluar' ? 'active' : ''?>">
								<i class="nav-icon fas fa-shopping-cart"></i>
								<p>
									Keluar
								</p>
							</a>
						</li>
					</ul>
				  </li>
				  <?php } ?>
				  <li class="nav-item has-treeview <?=in_array($halaman,$arrPageKasKecil) ? 'menu-open' : ''?>">
					<a href="#" class="nav-link <?=in_array($halaman,$arrPageKasKecil) ? 'active' : ''?>">
					  <i class="nav-icon fa fa-briefcase"></i>
					  <p>
						Kas Kecil
						<i class="fas fa-angle-left right"></i>
					  </p>
					</a>
					<ul class="nav nav-treeview" style="font-size:0.9rem !important;">
						<li class="nav-item">
							<a href="./kasMasukKecil" class="nav-link <?=$halaman=='kasMasukKecil' ? 'active' : ''?>">
								<i class="nav-icon fas fa-hand-holding-usd"></i>
								<p>
									Masuk
								</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="./kasKeluarKecil" class="nav-link <?=$halaman=='kasKeluarKecil' ? 'active' : ''?>">
								<i class="nav-icon fas fa-shopping-cart"></i>
								<p>
									Keluar
								</p>
							</a>
						</li>
					</ul>
				  </li>
				</ul>
			</li>
		  <li class="nav-item">
			<a href="./laporan" class="nav-link <?=$halaman=='laporan' ? 'active' : ''?>">
			  <i class="nav-icon far fa-file-alt"></i>
			  <p>
				Laporan & Grafik
			  </p>
			</a>
		  </li>
		  <?php } ?>
		  <?php if($_SESSION['userInfo']['HAK_AKSES']=='superadmin'){ ?>
		  <li class="nav-item">
			<a href="./update" class="nav-link <?=$halaman=='update' ? 'active' : ''?>">
			  <i class="nav-icon fas fa-cog"></i>
			  <p>
				Update Aplikasi
			  </p>
			</a>
		  </li>
		  <?php } ?>
		  
		  <li class="nav-item">
			<a href="./panduan" class="nav-link <?=$halaman=='panduan' ? 'active' : ''?>">
			  <i class="nav-icon fas fa-sign"></i>
			  <p>
				Panduan
			  </p>
			</a>
		  </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>