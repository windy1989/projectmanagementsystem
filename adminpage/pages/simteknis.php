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
            <h1>Teknis</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Proyek</a></li>
              <li class="breadcrumb-item active">Teknis</li>
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
              <h3 class="card-title">Daftar Antrian Teknis</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="tabelproyekteknis" class="table table-striped table-bordered display responsive wrap" style="width:100%">
                <thead>
                <tr class="text-center">
                  <th>No</th>
                  <th>Nama Proyek</th>
                  <th>Tgl.Pengajuan</th>
				  <th>Lokasi</th>
				  <th>Kota</th>
				  <th>Atas Nama</th>
                  <th>Teknis</th>
                  <th>Detail</th>
                </tr>
                </thead>
                <tbody>
					<?php 
					$no=1;
					while($row = $stmt->fetch(PDO::FETCH_ASSOC)) { 
					?>
						<tr data-sim="<?=enkripsi($row['KODE'])?>">
						  <td class="text-right"><?=$no.'.'?></td>
						  <td><?=$row['NAMA']?></td>
						  <td><?=$row['TGL_PENGAJUAN']?></td>
						  <td><?=$row['LOKASI']?></td>
						  <td><?=$row['KOTA']?></td>
						  <td><?=$row['NAMAPELANGGAN']?></td>
						  <td><button type="button" class="btn btn-block btn-outline-info editteknis btn-sm" data-sim="<?=enkripsi($row['KODE'])?>"><i class="nav-icon far fa-images"></i></button></td>
						  <td class="text-center"><button type="button" class="btn btn-block btn-outline-success lihatproyek btn-sm" data-sim="<?=enkripsi($row['KODE'])?>"><i class="fas fa-file-invoice-dollar"></i></button></td>
						</tr>
					<?php 
					$no++;
					}
					?>
                </tbody>
                <tfoot>
                <tr class="text-center">
                  <th>No</th>
                  <th>Nama Proyek</th>
                  <th>Tgl.Pengajuan</th>
				  <th>Lokasi</th>
				  <th>Kota</th>
				  <th>Atas Nama</th>
				  <th>Teknis</th>
                  <th>Detail</th>
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
  <div class="modal fade" id="modal-tambah-teknis">
	<div class="modal-dialog modal-lg">
	  <div class="modal-content">
		<div class="modal-header">
		  <h4 class="modal-title">Tambah/Edit Dokumen Teknis</h4>
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
					  <div class="card-body text-left">
						<i><strong>
							Lengkapi form andalalin sesuai data yang ada. Anda bisa mengisi form ini setelah dokumen selesai.
						</strong></i>
					  </div>
					  <!-- /.card-body -->
					</div>
					<h4 style="color:blue;">Informasi</h4>
					<hr>
				</div>
				<div class="col-sm-4">
				  <!-- text input -->
				  <div class="form-group">
					<label>No.Dokumen Andalalin</label>
					<input type="text" class="form-control" placeholder="Nomor Dokumen Andalalin" name="nodokumen" id="nodokumen" required>
					<input type="hidden" name="kodeproyek" id="kodeproyek" value="">
				  </div>
				</div>
				<div class="col-sm-4">
				  <!-- text input -->
				  <div class="form-group">
					<label>Tgl.Mulai Teknis</label>
					<input type="text" class="form-control datepicker" id="tglmulaiteknis" name="tglmulaiteknis" placeholder="Klik untuk memilih tanggal...">
				  </div>
				</div>
				<div class="col-sm-4">
				  <!-- text input -->
				  <div class="form-group">
					<label>Tgl.Selesai Teknis</label>
					<input type="text" class="form-control datepicker" id="tglselesaiteknis" name="tglselesaiteknis" placeholder="Klik untuk memilih tanggal...">
				  </div>
				</div>
				<div class="col-sm-4">
				  <!-- text input -->
				  <div class="form-group">
					<label>Letak File</label>
					<input type="text" class="form-control" placeholder="Letak file/folder andalalin" name="letakfile" id="letakfile" required>
				  </div>
				</div>
				<div class="col-sm-4">
				  <!-- text input -->
				  <div class="form-group">
					<label>Keterangan</label>
					<textarea class="form-control" name="keterangan" rows="1" id="keterangan" placeholder="Keterangan..."></textarea>
				  </div>
				</div>
				<div class="col-sm-12">
					<button type="button" class="btn btn-primary form-control" id="simpanteknis"><i class="far fa-save"></i></button>
				</div>
				<div class="col-sm-12 text-center mt-3">
					<h4 style="color:blue;">Daftar Kegiatan Teknis</h4>
					<hr>
				</div>
				<div class="col-sm-12">
				<table id="tabelteknis" class="table table-striped table-bordered display responsive wrap" style="width:100%">
					<thead>
						<tr class="text-center">
						  <th>No</th>
						  <th>No.Dokumen Andalalin</th>
						  <th>Tgl.Mulai</th>
						  <th>Tgl.Selesai</th>
						  <th>Keterangan</th>
						  <th><i class="far fa-trash-alt"></i></th>
						</tr>
					</thead>
					<tbody>
						
					</tbody>
					<tfoot>
						<tr class="text-center">
						  <th>No</th>
						  <th>No.Dokumen Andalalin</th>
						  <th>Tgl.Mulai</th>
						  <th>Tgl.Selesai</th>
						  <th>Keterangan</th>
						  <th><i class="far fa-trash-alt"></i></th>
						</tr>
					</tfoot>
				</table>
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
  <div class="modal fade" id="modal-tambah-detail">
	<div class="modal-dialog modal-lg">
	  <div class="modal-content">
		<div class="modal-header">
		  <h4 class="modal-title">Detail Proyek</h4>
		  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		  </button>
		</div>
		<div class="modal-body" id="detailproyek">
			
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
<?php 
	require 'adminpage/pages/simfooter.php';
?>