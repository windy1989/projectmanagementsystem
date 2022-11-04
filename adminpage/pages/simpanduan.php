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
            <h1>Panduan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Panduan</a></li>
              <li class="breadcrumb-item active">Panduan</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

   <!-- Main content -->
    <section class="content">
      <div class="row">
		<div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Alur Panduan</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">
				  <div class="col-md-12">
					<!-- The time line -->
						<div class="timeline">
						  <!-- timeline time label -->
						  <div class="time-label">
							<span class="bg-red">Mulai</span>
						  </div>
						  <!-- /.timeline-label -->
						  <div>
							  <i class="fas fa-user-alt" style="background-color:brown;color:white;"></i>
							  <div class="timeline-item">
								<span class="time"><b>Menu Master - Pelanggan</b></span>
								<h3 class="timeline-header no-border">Bagian admin menambahkan data pelanggan jika belum ada di sistem ini</h3>
							  </div>
						  </div>
						  <div>
							  <i class="fas fa-tasks bg-blue"></i>
							  <div class="timeline-item">
								<span class="time"><b>Menu Proyek - Proyek</b></span>
								<h3 class="timeline-header no-border">Bagian admin menambahkan proyek baru dengan melampirkan bukti syarat yang diperlukan</h3>
							  </div>
						  </div>
						  <div>
							  <i class="fas fa-file-invoice bg-green"></i>
							  <div class="timeline-item">
								<span class="time"><b>Menu Proyek - Pembayaran</b></span>
								<h3 class="timeline-header no-border">Bagian admin membuat invoice baru untuk DP</h3>
							  </div>
						  </div>
						  <div>
							  <i class="fas fa-file-invoice bg-green"></i>
							  <div class="timeline-item">
								<span class="time"><b>Menu Proyek - Pembayaran</b></span>
								<h3 class="timeline-header no-border">Bagian admin membuat kwitansi sesuai invoice DP setelah pelanggan membayar sesuai tagihan</h3>
							  </div>
						  </div>
						  <div>
							  <i class="fas fa-camera-retro bg-red"></i>
							  <div class="timeline-item">
								<span class="time"><b>Menu Proyek - Survei</b></span>
								<h3 class="timeline-header no-border">Bagian survei melakukan pengecekan lokasi sesuai dengan tanggal yang ditentukan di informasi proyek</h3>
							  </div>
						  </div>
						  <div>
							  <i class="fas fa-tasks bg-blue"></i>
							  <div class="timeline-item">
								<span class="time"><b>Menu Proyek - Proyek</b></span>
								<h3 class="timeline-header no-border">Owner mengecek file gambar/bukti survei dari pihak surveyor</h3>
							  </div>
						  </div>
						  <div>
							  <i class="far fa-images bg-yellow"></i>
							  <div class="timeline-item">
								<span class="time"><b>Menu Proyek - Teknis</b></span>
								<h3 class="timeline-header no-border">Bagian teknis memulai menyusun dokumen andalalin sesuai dengan file gambar yang ada</h3>
							  </div>
						  </div>
						  <div>
							  <i class="fas fa-tasks bg-blue"></i>
							  <div class="timeline-item">
								<span class="time"><b>Menu Proyek - Proyek</b></span>
								<h3 class="timeline-header no-border">Owner mengecek file andalalin yang telah diselesaikan</h3>
							  </div>
						  </div>
						  <div>
							  <i class="fas fa-university bg-info"></i>
							  <div class="timeline-item">
								<span class="time"><b>Menu Proyek - Sidang & Dishub</b></span>
								<h3 class="timeline-header no-border">Bagian admin mengisi form antrian sidang sesuai informasi yang ada</h3>
							  </div>
						  </div>
						  <div>
							  <i class="fas fa-file-invoice bg-green"></i>
							  <div class="timeline-item">
								<span class="time"><b>Menu Proyek - Pembayaran</b></span>
								<h3 class="timeline-header no-border">Bagian admin membuat invoice untuk pembayaran selanjutnya</h3>
							  </div>
						  </div>
						  <div>
							  <i class="fas fa-file-invoice bg-green"></i>
							  <div class="timeline-item">
								<span class="time"><b>Menu Proyek - Pembayaran</b></span>
								<h3 class="timeline-header no-border">Bagian admin membuat kwitansi sesuai invoice tagihan selanjutnya setelah pelanggan membayar sesuai tagihan</h3>
							  </div>
						  </div>
						  <div>
							  <i class="fas fa-tasks bg-blue"></i>
							  <div class="timeline-item">
								<span class="time"><b>Menu Proyek - Proyek</b></span>
								<h3 class="timeline-header no-border">Bagian admin mengganti status proyek menjadi 7 (Pelanggan telah membayar tagihan ke-2)</h3>
							  </div>
						  </div>
						  <div>
							  <i class="fas fa-university bg-info"></i>
							  <div class="timeline-item">
								<span class="time"><b>Menu Proyek - Sidang & Dishub</b></span>
								<h3 class="timeline-header no-border">Bagian admin mengisi form antrian dan melengkapi nomor surat rekomendasi yang telah keluar</h3>
							  </div>
						  </div>
						  <div>
							  <i class="fas fa-file-invoice bg-green"></i>
							  <div class="timeline-item">
								<span class="time"><b>Menu Proyek - Pembayaran</b></span>
								<h3 class="timeline-header no-border">Bagian admin membuat invoice untuk pembayaran terakhir</h3>
							  </div>
						  </div>
						  <div>
							  <i class="fas fa-file-invoice bg-green"></i>
							  <div class="timeline-item">
								<span class="time"><b>Menu Proyek - Pembayaran</b></span>
								<h3 class="timeline-header no-border">Bagian admin membuat kwitansi sesuai invoice pembayaran terakhir setelah pelanggan membayar sesuai tagihan</h3>
							  </div>
						  </div>
						  <div>
							  <i class="fas fa-bullseye bg-dark"></i>
							  <div class="timeline-item">
								<span class="time"><b>Selesai</b></span>
								<h3 class="timeline-header no-border">Pembayaran terakhir telah diterima dan status proyek telah selesai</h3>
							  </div>
						  </div>
						  <!-- END timeline item -->
						  <div class="time-label">
							<span class="bg-green">Selesai</span>
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