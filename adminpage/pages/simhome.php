<?php 
	require 'adminpage/pages/simheader.php';	
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h4><?=$jumproyek?></h4>

                <p>Jumlah Proyek</p>
              </div>
              <div class="icon">
                <i class="ion ion-android-warning"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
		  <?php if($_SESSION['userInfo']['HAK_AKSES']=='admin' or $_SESSION['userInfo']['HAK_AKSES']=='superadmin'){ ?>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h4>Rp <?=number_format($rowpemasukan['TOTAL'],0)?>,-</h4>

                <p>Total Nilai Proyek</p>
              </div>
              <div class="icon">
                <i class="ion ion-arrow-graph-up-right"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h4>Rp <?=number_format($rowpemasukan['TOTALI'],0)?>,-</h4>

                <p>Proyek Terbayar</p>
              </div>
              <div class="icon">
                <i class="ion ion-android-add"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
		  <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h4><?=$jumuser?></h4>

                <p>Pelanggan</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
		  <?php } ?>
        </div>
        <!-- /.row -->
        <!-- Main row -->
		<div class="row">
			<section class="col-lg-6 connectedSortable">
				<div class="card">
				  <div class="card-header">
					<h3 class="card-title">
					  Selamat datang di aplikasi AMaProKe CV.Victory Konsultan!
					</h3>
				  </div><!-- /.card-header -->
				  <div class="card-body">
					<div class="tab-content p-0">
						<!--<div class="alert alert-info alert-dismissible">
						  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						  <h4><i class="icon fas fa-info"></i> Info!</h4>
						</div> -->
						<p>
							<b>AMaProKe</b> adalah singkatan dari Aplikasi Manajemen Proyek dan Keuangan.  
						</p>
						<p>
							Manajemen Proyek yang artinya aplikasi ini menjadi wadah utama pengelolaan data proyek mulai dari informasi pelanggan, lokasi proyek, survei, pembayaran tagihan, dokumen andalalin, hingga sidang untuk mendapatkan surat rekomendasi.
						</p>
						<p>
							Manajemen Keuangan yang artinya aplikasi ini juga mencatat informasi penerimaan dan pengeluaran perusahaan secara keseluruhan.
						</p>
					</div>
				  </div><!-- /.card-body -->
				</div>
				<!-- /.card -->
			</section>
			<!-- right col (We are only adding the ID to make the widgets sortable)-->
          <section class="col-lg-6 connectedSortable">

            <!-- Calendar -->
            <div class="card bg-gradient-success">
              <div class="card-header border-0">

                <h3 class="card-title">
                  <i class="far fa-calendar-alt"></i>
                  Calendar
                </h3>
                <!-- tools card -->
                <div class="card-tools">
                  <!-- button with a dropdown -->
                  <div class="btn-group">
                    <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown">
                      <i class="fas fa-bars"></i></button>
                    <div class="dropdown-menu float-right" role="menu">
                      <a href="#" class="dropdown-item">Add new event</a>
                      <a href="#" class="dropdown-item">Clear events</a>
                      <div class="dropdown-divider"></div>
                      <a href="#" class="dropdown-item">View calendar</a>
                    </div>
                  </div>
                  <button type="button" class="btn btn-success btn-sm" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-success btn-sm" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
                <!-- /. tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body pt-0">
                <!--The calendar -->
                <div id="calendar" style="width: 100%"></div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </section>
          <!-- right col -->
		</div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php 
	require 'adminpage/pages/simfooter.php';
?>