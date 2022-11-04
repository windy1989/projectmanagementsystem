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
            <h1>Proyek</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Master</a></li>
              <li class="breadcrumb-item active">Proyek</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Daftar Proyek</h3>
			    <div class="card-tools">
                  <div class="btn-group">
                    <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                      <i class="fas fa-cog"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" role="menu">
                      <a href="javascript:void(0);" class="dropdown-item" data-toggle="modal" data-target="#modal-tambah-proyek">Tambah</a>
                      <a href="javascript:void(0);" class="dropdown-item" id="hapusproyek">Hapus</a>
					  <a href="javascript:void(0);" class="dropdown-item" data-toggle="modal" data-target="#modal-tambah-scanqr">Scan QR</a>
                    </div>
                  </div>
						</div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
			  <div class="card card-info collapsed-card">
				  <div class="card-header" data-card-widget="collapse">
					<h3 class="card-title">Tips!</h3>

					<div class="card-tools">
					  <button type="button" class="btn btn-tool"><i class="fas fa-plus"></i>
					  </button>
					</div>
					<!-- /.card-tools -->
				  </div>
				  <!-- /.card-header -->
				  <div class="card-body">
					<i><strong>
							<ol>
								<li>Proyek berwarna <span class="bg-success">Hijau</span> : proyek telah selesai.</li>
								<li>Proyek berwarna <span class="bg-warning">Kuning</span> : proyek hampir tenggang dengan waktu &le; 7 hari.</li>
								<li>Proyek berwarna <span class="bg-danger">Merah</span> : proyek telah melewati masa tenggang kerja.</li>
						</strong></i>
				  </div>
				  <!-- /.card-body -->
				</div>
              <table id="tabelproyek" class="table table-striped table-bordered display responsive wrap" style="width:100%">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Proyek</th>
                  <th>Tgl.Pengajuan</th>
				  <th>Lokasi</th>
				  <th>Kota</th>
				  <th>Atas Nama</th>
                  <th>Edit</th>
                  <th>Status</th>
				  <th>Jenis</th>
				  <th>Peruntukan</th>
                </tr>
                </thead>
                <tbody>
					<?php 
					$no=1;
					while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
						$bgcolor = "";
						$now = time();
						$your_date = strtotime($row['TGL_SELESAI_KERJA']);
						
						$datediff = round(($now - $your_date) / (60 * 60 * 24));
						
						if($datediff >= 0 && $row['STATUS'] != 10){
							$bgcolor = "bg-danger";
						}elseif($datediff >= -7 && $row['STATUS'] != 10){
							$bgcolor = "bg-warning";
						}elseif($row['STATUS'] == 10){
							$bgcolor = "bg-success";
						}
					?>
						<tr data-sim="<?=enkripsi($row['KODE'])?>" class="<?=$bgcolor?>">
						  <td class="text-right"><?=$no.'.'?></td>
						  <td><?=$row['NAMA'].' '.$row['NO_PROYEK']?></td>
						  <td><?=$row['TGL_PENGAJUAN']?></td>
						  <td><?=$row['LOKASI']?></td>
						  <td><?=$row['KOTA']?></td>
						  <td><?=$row['NAMAPELANGGAN']?></td>
						  <td><button type="button" class="btn btn-info editproyek btn-sm" data-sim="<?=enkripsi($row['KODE'])?>"><i class="fa fa-fw fa-edit"></i></button></td>
						  <td class="text-center"><button type="button" class="btn btn-info ubahstatus btn-sm" data-sim="<?=enkripsi($row['KODE'])?>"><span class="badge" style="background-color:<?=$arrColor[$row['STATUS']]?>;color:white;"><?=$row['STATUS']?></span></button></td>
						  <td><?=$row['JENISPROYEK']?></td>
						  <td><?=$row['PERUNTUKANPROYEK']?></td>
						</tr>
					<?php 
					$no++;
					}
					?>
                </tbody>
                <tfoot>
                <tr>
                  <th>No</th>
                  <th>Nama Proyek</th>
                  <th>Tgl.Pengajuan</th>
				  <th>Lokasi</th>
				  <th>Kota</th>
				  <th>Atas Nama</th>
                  <th>Edit</th>
                  <th>Status</th>
				  <th>Jenis</th>
				  <th>Peruntukan</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <div class="modal fade" id="modal-tambah-proyek">
	<div class="modal-dialog modal-lg">
	  <div class="modal-content">
		<div class="modal-header">
		  <h4 class="modal-title">Tambah/Edit Proyek</h4>
		  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		  </button>
		</div>
		<div class="modal-body">
			<div class="row">
				<div class="col-sm-12 text-center">
					<div class="card card-primary collapsed-card">
					  <div class="card-header" data-card-widget="collapse">
						<h3 class="card-title">Tips!</h3>

						<div class="card-tools">
						  <button type="button" class="btn btn-tool"><i class="fas fa-plus"></i>
						  </button>
						</div>
						<!-- /.card-tools -->
					  </div>
					  <!-- /.card-header -->
					  <div class="card-body">
						<i><strong>Sebelum memasukkan informasi proyek lebih baik anda menyiapkan dokumen syarat yang dibutuhkan.</strong></i>
					  </div>
					  <!-- /.card-body -->
					</div>
					<h4 style="color:blue;">Informasi</h4>
					<hr>
				</div>
				<div class="col-sm-4">
				  <!-- text input -->
				  <div class="form-group">
					<label>Nama Proyek</label>
					<input type="text" class="form-control" placeholder="Nama Proyek..." name="nama" id="nama" required>
					<input type="hidden" name="tempid" id="tempid" value="">
				  </div>
				</div>
				<div class="col-sm-4">
				  <!-- text input -->
				  <div class="form-group">
					<label>No.Proyek/Kontrak</label>
					<input type="text" class="form-control" placeholder="Nomor Proyek/Kontrak..." name="noproyek" id="noproyek" required>
				  </div>
				</div>
				<div class="col-sm-4">
				  <!-- text input -->
				  <div class="form-group">
					<label>Tgl.Pengajuan</label>
					<input type="text" class="form-control datepicker" id="tglpengajuan" name="tglpengajuan">
				  </div>
				</div>
				<div class="col-sm-4">
				  <!-- text input -->
				  <div class="form-group">
					<label>Lokasi</label>
					<textarea class="form-control" name="lokasi" rows="1" id="lokasi" placeholder="Alamat lengkap..." required></textarea>
				  </div>
				</div>
				<div class="col-sm-4">
				  <!-- text input -->
				  <div class="form-group">
					<label>Provinsi</label>
					<select class="form-control form-control-sm select2" id="provinsi" style="width: 100%;">
						<option value="" selected>None</option>
						<?php 
						foreach($dbh->query('SELECT * FROM sim_provinsi ORDER BY id ASC') as $row) {
							?>
							<option value="<?php echo $row["id"]; ?>"><?=ucwords(strtolower($row['name']))?></option>
							<?php
						}
						?>
					</select>
				  </div>
				</div>
				<div class="col-sm-4">
					<!-- text input -->
					<div class="form-group">
						<label>Kota</label>
						<select class="form-control form-control-sm select2" id="kota" style="width: 100%;" name="kota">
							<option value="" selected>None</option>
						</select>
					</div>
				</div>
				<div class="col-sm-4">
				  <!-- text input -->
				  <div class="form-group">
					<label>Pelanggan</label>
					<select class="form-control form-control-sm select2" id="pelanggan" style="width: 100%;">
						<option value="" selected>None</option>
						<?php 
						foreach($dbh->query('SELECT * FROM sim_pelanggan ORDER BY id ASC') as $row) {
							?>
							<option value="<?=$row["ID"]?>"><?=ucwords(strtolower($row['NAMA_PEMILIK'].$row['NAMA_DIREKTUR']))?></option>
							<?php
						}
						?>
					</select>
				  </div>
				</div>
				<div class="col-sm-4">
				  <!-- text input -->
				  <div class="form-group">
					<label>Jenis</label>
					<select class="form-control form-control-sm select2" id="jenis" style="width: 100%;">
						<option value="" selected>None</option>
						<?php 
						foreach($dbh->query('SELECT * FROM sim_jenis ORDER BY id ASC') as $row) {
							?>
							<option value="<?=$row["ID"]?>"><?=ucwords(strtolower($row['NAMA']))?></option>
							<?php
						}
						?>
					</select>
				  </div>
				</div>
				<div class="col-sm-4">
				  <!-- text input -->
				  <div class="form-group">
					<label>Peruntukan</label>
					<select class="form-control form-control-sm select2" id="peruntukan" style="width: 100%;">
						<option value="" selected>None</option>
						<?php 
						foreach($dbh->query('SELECT * FROM sim_peruntukan ORDER BY id ASC') as $row) {
							?>
							<option value="<?=$row["ID"]?>"><?=ucwords(strtolower($row['NAMA']))?></option>
							<?php
						}
						?>
					</select>
				  </div>
				</div>
				<div class="col-sm-4">
				  <!-- text input -->
				  <div class="form-group">
					<label>Keterangan</label>
					<textarea class="form-control" name="keteranganperuntukan" rows="1" id="keteranganperuntukan" placeholder="Peruntukan lainnya..."></textarea>
				  </div>
				</div>
				<div class="col-sm-12 text-center">
					<h4 style="color:blue;">Lama Kerja</h4>
					<hr>
				</div>
				<div class="col-sm-4">
				  <!-- text input -->
				  <div class="form-group">
					<label>Lama Kerja (hari)</label>
					<input type="number" class="form-control" placeholder="Lama kerja..." id="lamakerja" name="lamakerja">
				  </div>
				</div>
				<div class="col-sm-4">
				  <!-- text input -->
				  <div class="form-group">
					<label>Tgl.Mulai Kerja</label>
					<input type="text" class="form-control datepicker" id="tglmulaikerja" name="tglmulaikerja">
				  </div>
				</div>
				<div class="col-sm-4">
				  <!-- text input -->
				  <div class="form-group">
					<label>Tgl.Selesai Kerja</label>
					<input type="text" class="form-control datepicker" id="tglselesaikerja" name="tglselesaikerja">
				  </div>
				</div>
				<div class="col-sm-12 text-center">
					<h4 style="color:blue;">Tambahan</h4>
					<hr>
				</div>
				<div class="col-sm-4">
				  <div class="form-group">
					<label>Surat Andalalin</label>
					<div class="custom-control custom-checkbox">
					  <input class="custom-control-input" type="checkbox" id="suratandalalin" checked>
					  <label for="suratandalalin" class="custom-control-label">Ada/Tidak</label>
					</div>
				  </div>
				</div>
				<div class="col-sm-4">
				  <div class="form-group">
					<label>Surat Kuasa</label>
					<div class="custom-control custom-checkbox">
					  <input class="custom-control-input" type="checkbox" id="suratkuasa" checked>
					  <label for="suratkuasa" class="custom-control-label">Ada/Tidak</label>
					</div>
				  </div>
				</div>
				<div class="col-sm-4">
				  <!-- text input -->
				  <div class="form-group">
					<label>Biaya (Rp)</label>
					<input type="text" class="form-control money" placeholder="Nominal..." id="biaya" name="biaya">
				  </div>
				</div>
				<div class="col-sm-4">
				  <!-- text input -->
				  <div class="form-group">
					<label>Termin Pembayaran</label>
					<input type="number" class="form-control" placeholder="Jumlah termin..." id="termin" name="termin">
				  </div>
				</div>
				<div class="col-sm-4">
				  <!-- text input -->
				  <div class="form-group">
					<label>Keterangan</label>
					<textarea class="form-control" name="keterangan" rows="1" id="keterangan" placeholder="Keterangan..."></textarea>
				  </div>
				</div>
				<div class="col-sm-12 text-center">
					<h4 style="color:blue;">Syarat</h4>
					<hr>
				</div>
				<div class="col-sm-12">
				<?php 
					foreach($dbh->query('SELECT * FROM sim_syarat ORDER BY id ASC') as $row) {
				?>
					<div class="form-group row text-right">
						<label for="" class="col-sm-5 col-form-label"><?=$row['NAMA']?> <i class="far fa-question-circle" data-toggle="tooltip" data-placement="top" title="<?=$row['KETERANGAN']?>"></i></label>
						<div class="col-sm-7">
						  <input type="text" class="form-control syaratnodokumen" data-id="<?=$row['ID']?>" placeholder="No. Dokumen...">
						  <input type="text" class="form-control syaratletakfile mt-2" placeholder="Letak File...">
						  <input type="text" class="form-control syaratketerangan mt-2" placeholder="Keterangan...">
						</div>
					</div>
				<?php
				}
				?>
				</div>
			</div>
		</div>
		<div class="modal-footer justify-content-between">
		  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
		  <button type="button" class="btn btn-primary" id="simpanproyek">Simpan</button>
		</div>
	  </div>
	  <!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
  
   <!-- /.modal -->
  <div class="modal fade" id="modal-tambah-ubahstatus">
	<div class="modal-dialog modal-lg">
	  <div class="modal-content">
		<div class="modal-header">
		  <h4 class="modal-title">Nomor Proyek/Kontrak <b id="nomorproyekubah"></b></h4>
		  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		  </button>
		</div>
		<div class="modal-body">
			<div class="row" id="detailubahproyek">
				<div class="col-sm-12 text-center">
					<div class="card card-primary collapsed-card">
					  <div class="card-header" data-card-widget="collapse">
						<h3 class="card-title">Tips!</h3>

						<div class="card-tools">
						  <button type="button" class="btn btn-tool"><i class="fas fa-plus"></i>
						  </button>
						</div>
						<!-- /.card-tools -->
					  </div>
					  <!-- /.card-header -->
					  <div class="card-body">
						<i><strong>Pastikan anda mengecek syarat terlebih dahulu sebelum mengganti status karena ini akan mempengaruhi menu/form yang lainnya.</strong></i>
					  </div>
					  <!-- /.card-body -->
					</div>
					<h4 style="color:blue;" class="text-center">QR Code <button type="button" class="btn btn-outline-primary btn-sm" id="cetakqr"><i class="fas fa-print"></i></button></h4>
					<img src="" alt="" id="image" />
				</div>
				<div class="col-sm-12">
					<h4 style="color:blue;" class="text-left">Status Proyek</h4>
					<hr>
					<div class="form-group">
						<select class="form-control" id="statusproyek">
							<option value="-1">(-1)-Proyek dibatalkan dengan persetujuan kedua belah pihak.</option>
							<option value="0">(0)-Proyek telah diinput kedalam sistem, menunggu pembayaran DP.</option>
							<option value="1">(1)-Pelanggan telah membayar DP, bagian survei lokasi bisa segera bergerak.</option>
							<option value="2">(2)-Bagian survei telah melaksanakan tugas, selanjutnya owner melakukan pengecekan.</option>
							<option value="3">(3)-File survei telah dicek owner, selanjutnya bagian teknis bisa mulai bekerja.</option>
							<option value="4">(4)-Bagian teknis telah menyelesaikan dokumen andalalin, selanjutnya owner melakukan pengecekan.</option>
							<option value="5">(5)-Dokumen andalalin telah disetujui oleh owner, selanjutnya dokumen bisa mengikuti sidang.</option>
							<option value="6">(6)-No. Antrian sidang telah didapatkan.</option>
							<option value="7">(7)-Pelanggan telah membayar tagihan ke-2 sebagai syarat sidang.</option>
							<option value="8">(8)-Revisi dokumen oleh tim teknis.</option>
							<option value="9">(9)-Dokumen andalalin telah diterima Dishub, surat rekomendasi telah keluar.</option>
							<option value="10">(10)-Pelanggan telah membayar tagihan yang ke-3 dan proyek dinyatakan selesai.</option>
						</select>
					  </div>
				</div>
				<div class="col-sm-12">
					<h4 style="color:blue;" class="text-left">Syarat</h4>
					<hr>
					<div class="row">
						<div class="col-sm-12" id="statussyarat">
							
						</div>
					</div>
				</div>
				<div class="col-sm-12">
					<h4 style="color:blue;" class="text-left">Pembayaran</h4>
					<hr>
					<div class="row">
						<div class="col-sm-12" id="statusbayar">
							
						</div>
					</div>
				</div>
				<div class="col-sm-12">
					<h4 style="color:blue;" class="text-left">Survei</h4>
					<hr>
					<div class="row">
						<div class="col-sm-12" id="statussurvei">
							
						</div>
					</div>
				</div>
				<div class="col-sm-12">
					<h4 style="color:blue;" class="text-left">Sidang</h4>
					<hr>
					<div class="row">
						<div class="col-sm-12" id="statussidang">
							
						</div>
					</div>
				</div>
				<div class="col-sm-12">
					<div class="card card-primary collapsed-card">
					  <div class="card-header" data-card-widget="collapse">
						<h3 class="card-title">Panduan Status Proyek</h3>
						<input type="hidden" id="tempkodeproyek" value="">
						<div class="card-tools">
						  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
						  </button>
						</div>
						<!-- /.card-tools -->
					  </div>
					  <!-- /.card-header -->
					  <div class="card-body">
						<ol>
							<li>Untuk mengubah status cukup ganti opsi diatas sesuai keinginan anda.</li>
							<li>Hati-hati dalam mengganti status karena akan berpengaruh pada menu/halaman lainnya.</li>
						</ol>
					  </div>
					  <!-- /.card-body -->
					</div>
					<!-- /.card -->
				</div>
			</div>
		</div>
		<div class="modal-footer justify-content-between">
		  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
		  
		</div>
	  </div>
	  <!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
  
  <div class="modal fade" id="modal-tambah-scanqr">
	<div class="modal-dialog modal-lg">
	  <div class="modal-content">
		<div class="modal-header">
		  <h4 class="modal-title">Scan QR</h4>
		  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		  </button>
		</div>
		<div class="modal-body">
			<div id="prescan" class="text-center">
				<strong><i>Pastikan anda mengijinkan akses kamera untuk aplikasi ini agar bisa memulai scan QR dokumen anda. <br>Untuk memulai tekan tombol Scan dibawah.</i></strong>
			</div>
			<video id="preview" style="width: 100%;max-height: 100%;"></video>
		</div>
		<div class="modal-footer justify-content-between">
		  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
		  <button type="button" class="btn btn-primary" id="goscan">Scan</button>
		</div>
	</div>
	</div>
  </div>
<?php 
	require 'adminpage/pages/simfooter.php';
?>