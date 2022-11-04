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
            <h1>Laporan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Laporan</a></li>
              <li class="breadcrumb-item active">Laporan</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Daftar Proyek</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">
				<div class="col-md-3">
					<div class="form-group">
						<label>Pilih Laporan</label>
						<select class="form-control" id="opsilaporan">
							<option value="proyek">Proyek</option>
							<option value="pembayaran">Pembayaran</option>
							<option value="kaskeluar">Kas Keluar</option>
							<option value="grafik">Grafik</option>
							<option value="kasbesar">Kas Besar</option>
							<option value="kaskecil">Kas Kecil</option>
							<!-- <option value="survei">Survei</option>
							<option value="teknis">Teknis</option>
							<option value="sidang">Sidang</option> -->
						</select>
					</div>
					<button type="button" class="btn btn-block btn-outline-success btn-sm" id="tampil">Tampilkan</button>
					
				</div>
				<div class="col-md-3">
				  <div class="form-group">
					<label>Pilih Tampilan</label>
					<div class="custom-control custom-radio">
					  <input class="custom-control-input" type="radio" id="semua" name="tampilan" value="semua" checked>
					  <label for="semua" class="custom-control-label">Semua</label>
					</div>
					<div class="custom-control custom-radio">
					  <input class="custom-control-input" type="radio" id="periode" name="tampilan" value="periode">
					  <label for="periode" class="custom-control-label">Periode</label>
						<div class="row">
							<div class="form-group col-md-6">
								<input type="text" class="form-control datepicker" id="tglawal" name="tglawal">
							</div>
							<div class="form-group col-md-6">
								<input type="text" class="form-control datepicker" id="tglakhir" name="tglakhir">
							</div>
						</div>
					</div>
				  </div>
				</div>
				<div class="col-md-4">
					
				</div>
			  </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

        </div>
        <!-- /.col -->
		<div class="col-12">
			<div class="card card-outline card-success">
              <div class="card-header">
                <h3 class="card-title">Hasil <button type="button" class="btn btn-outline-primary btn-sm" id="cetak"><i class="fas fa-print"></i></button> </h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body" id="laporanhasil">
                
              </div>
              <!-- /.card-body -->
            </div>
		</div>
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
<?php 
	require 'adminpage/pages/simfooter.php';
?>