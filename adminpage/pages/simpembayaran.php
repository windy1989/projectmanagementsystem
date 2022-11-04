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
            <h1>Pembayaran</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Proyek</a></li>
              <li class="breadcrumb-item active">Pembayaran</li>
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
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="tabelproyekpembayaran" class="table table-striped table-bordered display responsive wrap" style="width:100%">
                <thead>
                <tr class="text-center">
                  <th>No</th>
                  <th>Nama Proyek</th>
                  <th>Tgl.Pengajuan</th>
				  <th>Lokasi</th>
				  <th>Kota</th>
				  <th>Atas Nama</th>
                  <th>Inv.</th><th>Kwi.</th>
                  <th>Det.</th>
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
						 <td><button type="button" class="btn btn-block btn-outline-info editinvoice btn-sm" data-sim="<?=enkripsi($row['KODE'])?>"><i class="fas fa-file-upload"></i></button></td><td><button type="button" class="btn btn-block btn-outline-primary editkwitansi btn-sm" data-sim="<?=enkripsi($row['KODE'])?>"><i class="fas fa-file-download"></i></button></td>
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
                  <th>Inv.</th><th>Kwi.</th>
                  <th>Det.</th>
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
  <div class="modal fade" id="modal-tambah-invoice">
	<div class="modal-dialog modal-lg">
	  <div class="modal-content">
		<div class="modal-header">
		  <h4 class="modal-title">Tambah/Edit Invoice</h4>
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
						<i><strong>Data invoice yang telah masuk dan tersimpan akan ditampilkan di tabel Daftar Invoice.</strong></i>
					  </div>
					  <!-- /.card-body -->
					</div>
					<h4 style="color:blue;">Informasi</h4>
					<hr>
				</div>
				<div class="col-sm-4">
				  <!-- text input -->
				  <div class="form-group">
					<label>No. Invoice</label>
					<input type="text" class="form-control" placeholder="No.Invoice..." name="noinvoice" id="noinvoice" required>
					<input type="hidden" name="kodeproyek" id="kodeproyek" value="">
				  </div>
				</div>
				<div class="col-sm-4">
				  <!-- text input -->
				  <div class="form-group">
					<label>Bank</label>
					<select class="form-control form-control-sm select2" id="bank" style="width: 100%;">
						<option value="" selected>None</option>
						<?php 
						foreach($dbh->query("SELECT * FROM sim_bank") as $row) {
							?>
							<option value="<?=$row["ID"]?>"><?=$row['NAMA_BANK'].' - '.$row['NAMA_PEMILIK'].' - '.$row['NO_REKENING']?></option>
							<?php
						}
						?>
					</select>
				  </div>
				</div>
				<div class="col-sm-4">
				  <!-- text input -->
				  <div class="form-group">
					<label>Tgl.Keluar Invoice</label>
					<input type="text" class="form-control datepicker" id="tglinvoice" name="tglinvoice" placeholder="Klik untuk memilih tanggal...">
				  </div>
				</div>
				<div class="col-sm-4">
				  <!-- text input -->
				  <div class="form-group">
					<label>Nominal</label>
					<input type="text" class="form-control money" placeholder="Nominal..." id="nominal" name="nominal">
				  </div>
				</div>
				<div class="col-sm-4">
				  <!-- text input -->
				  <div class="form-group">
					<label>Pembayaran Ke-</label>
					<input type="number" class="form-control" placeholder="" id="bayarke" name="bayarke" value="1" min="1" step="1">
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
					<button type="button" class="btn btn-primary form-control" id="simpaninvoice"><i class="far fa-save"></i></button>
				</div>
				<div class="col-sm-12 text-center mt-3">
					<h4 style="color:blue;">Daftar Invoice</h4>
					<hr>
				</div>
				<div class="col-sm-12">
				<table id="tabelinvoice" class="table table-striped table-bordered display responsive wrap" style="width:100%">
					<thead>
						<tr class="text-center">
						  <th>No</th>
						  <th>Invoice</th>
						  <th>Tgl.Invoice</th>
						  <th>Persen</th>
						  <th>Nominal</th>
						  <th><i class="fas fa-print"></i></th>
						  <th><i class="far fa-trash-alt"></i></th>
						</tr>
					</thead>
					<tbody>
						
					</tbody>
					<tfoot>
						<tr>
						  <th>No</th>
						  <th>Invoice</th>
						  <th>Tgl.Invoice</th>
						  <th>Persen</th>
						  <th>Nominal</th>
						  <th><i class="fas fa-print"></i></th>
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
  <div class="modal fade" id="modal-tambah-kwitansi">
	<div class="modal-dialog modal-lg">
	  <div class="modal-content">
		<div class="modal-header">
		  <h4 class="modal-title">Tambah/Edit Kwitansi</h4>
		  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		  </button>
		</div>
		<div class="modal-body">
			<div class="row">
				<div class="col-sm-12 text-center mt-3">
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
						<i><strong>Untuk menambahkan kwitansi, tekan tombol <button class="btn btn-info btn-sm""><i class="fas fa-plus-circle"></i></button> pada invoice yang diinginkan. Data kwitansi yang telah masuk dan tersimpan akan ditampilkan di tabel Daftar Kwitansi.</strong></i>
					  </div>
					  <!-- /.card-body -->
					</div>
					<h4 style="color:blue;">Daftar Kwitansi</h4>
					<hr>
				</div>
				<div class="col-sm-12">
				<table id="tabelkwitansi" class="table table-striped table-bordered display responsive wrap" style="width:100%">
					<thead>
						<tr class="text-center">
						  <th>No</th>
						  <th>Invoice</th>
						  <th>Tgl.Invoice</th>
						  <th>Kwitansi</th>
						  <th>Tgl.Bayar</th>
						  <th><i class="fas fa-plus-circle"></i></th>
						  <th><i class="fas fa-print"></i></th>
						</tr>
					</thead>
					<tbody>
						
					</tbody>
					<tfoot>
						<tr class="text-center">
						  <th>No</th>
						  <th>Invoice</th>
						  <th>Tgl.Invoice</th>
						  <th>Persen</th>
						  <th>Nominal</th>
						  <th><i class="fas fa-plus-circle"></i></th>
						  <th><i class="fas fa-print"></i></th>
						</tr>
					</tfoot>
				</table>
				</div>
			
				<div class="col-sm-12 text-center">
					<h4 style="color:blue;">Informasi Invoice#<b id="bayarinvoice"></b></h4>
					<hr>
				</div>
				<div class="col-sm-4">
				  <!-- text input -->
				  <div class="form-group">
					<label>No. Kwitansi</label>
					<input type="text" class="form-control" placeholder="No. Kwitansi..." name="nokwitansi" id="nokwitansi" required>
					<input type="hidden" name="kodeproyekku" id="kodeproyekku" value="">
				  </div>
				</div>
				<div class="col-sm-4">
				  <!-- text input -->
				  <div class="form-group">
					<label>Terima Dari</label>
					<input type="text" class="form-control" placeholder="Terima dari..." name="terimadari" id="terimadari" required>
				  </div>
				</div>
				<div class="col-sm-4">
				  <!-- text input -->
				  <div class="form-group">
					<label>Tgl.Bayar/Keluar Kwitansi</label>
					<input type="text" class="form-control datepicker" id="tglkwitansi" name="tglkwitansi" placeholder="Klik untuk memilih tanggal...">
				  </div>
				</div>
				<div class="col-sm-12">
					<button type="button" class="btn btn-primary form-control" id="simpankwitansi"><i class="far fa-save"></i></button>
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