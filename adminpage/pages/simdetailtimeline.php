<?php 
	require 'adminpage/pages/simheader.php';	
?>
	<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Detail Timeline</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="timeline">Timeline</a></li>
              <li class="breadcrumb-item active">Detail</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
		<div class="col-md-4">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Info Proyek</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">
				  <div class="col-12 col-sm-12 col-md-12">
					<div class="info-box">
					  <span class="info-box-icon bg-info elevation-1"><i class="nav-icon fas fa-tasks"></i></span>

					  <div class="info-box-content">
						<span class="info-box-text">Nama Proyek</span>
						<span class="info-box-number">
						  <?=$rowproyek['NAMA']?>
						</span>
					  </div>
					  <!-- /.info-box-content -->
					</div>
					<!-- /.info-box -->
				  </div>
				  <!-- /.col -->
				  <div class="col-12 col-sm-12 col-md-12">
					<div class="info-box mb-3">
					  <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-map-marked-alt"></i></span>

					  <div class="info-box-content">
						<span class="info-box-text">Lokasi</span>
						<span class="info-box-number"><?=$rowproyek['LOKASI'].' '.$rowproyek['KOTA']?></span>
					  </div>
					  <!-- /.info-box-content -->
					</div>
					<!-- /.info-box -->
				  </div>
				  <!-- /.col -->

				  <!-- fix for small devices only -->
				  <div class="clearfix hidden-md-up"></div>

				  <div class="col-12 col-sm-12 col-md-12">
					<div class="info-box mb-3">
					  <span class="info-box-icon bg-success elevation-1"><i class="far fa-address-book"></i></span>

					  <div class="info-box-content">
						<span class="info-box-text">Customer</span>
						<span class="info-box-number"><?=$rowproyek['NAMAPELANGGAN']?></span>
					  </div>
					  <!-- /.info-box-content -->
					</div>
					<!-- /.info-box -->
				  </div>
				  <!-- /.col -->
				</div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

        </div>
        <!-- /.col -->
		
		<div class="col-md-8">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Info Timeline</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">
				  <div class="col-md-12">
					<!-- The time line -->
					<div class="timeline">
					  <!-- timeline time label -->
					  <div class="time-label">
						<span class="bg-red"><?=tgl_indo(date('Y-m-d'))?></span>
					  </div>
					  <!-- /.timeline-label -->
					  <?php 
						while($row = $stmt->fetch(PDO::FETCH_ASSOC)) { 
							$icon = '<i class="fas fa-bullhorn bg-red"></i>';
							if(strpos($row['ISI'], 'Pembayaran') !== false){
								$icon = '<i class="fas fa-receipt bg-blue"></i>';
							}elseif(strpos($row['ISI'], 'Invoice') !== false){
								$icon = '<i class="fas fa-file-invoice bg-green"></i>';
							}elseif(strpos($row['ISI'], 'Survei') !== false){
								$icon = '<i class="fas fa-camera-retro bg-yellow"></i>';
							}elseif(strpos($row['ISI'], 'teknis') !== false){
								$icon = '<i class="far fa-images bg-indigo"></i>';
							}
					  ?>
					  <!-- timeline item -->
					  <div>
						<?=$icon?>
						<div class="timeline-item">
						  <span class="time"><i class="fas fa-clock"></i> <?=time_elapsed_string($row['TGL_INPUT'])?> - <?=$row['TGL_INPUT']?></span>
						  <h3 class="timeline-header no-border"><?=$row['ISI']?></h3>
						</div>
					  </div>
					  <!-- END timeline item -->
					  <?php } ?>
					  <div>
						<i class="fas fa-clock bg-gray"></i>
					  </div>
					</div>
				  </div>
				  <!-- /.col -->
				</div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        
		
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
<?php 
	require 'adminpage/pages/simfooter.php';
?>