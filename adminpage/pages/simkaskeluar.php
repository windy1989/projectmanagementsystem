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
            <h1>Kas Keluar</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Keuangan</a></li>
              <li class="breadcrumb-item active">Kas Keluar</li>
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
              <h3 class="card-title">Daftar Pengeluaran</h3>
			   <div class="card-tools">
                  <div class="btn-group">
                    <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                      <i class="fas fa-cog"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" role="menu">
                      <a href="javascript:void(0);" class="dropdown-item" data-toggle="modal" data-target="#modal-tambah-kaskeluar">Tambah</a>
                      <a href="javascript:void(0);" class="dropdown-item" id="hapuskaskeluar">Hapus</a>
                    </div>
                  </div>
				</div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="tabelkaskeluar" class="table table-striped table-bordered display responsive wrap" style="width:100%;zoom:0.8;">
                <thead>
                <tr class="text-center">
                  <th>No</th>
                  <th>Untuk</th>
				  <th>Bank</th>
				  <th>Jumlah</th>
				  <th>Tgl</th>
				  <th>Keterangan</th>
				  <th>Bukti</th>
				  <th>Status</th>
				  <th>Edit</th>
                </tr>
                </thead>
                <tbody>
					<?php 
					$no=1;
					$total = 0;
					while($row = $stmt->fetch(PDO::FETCH_ASSOC)) { 
					$total += $row['NOMINAL'];
					?>
						<tr data-sim="<?=enkripsi($row['KODE'])?>" data-img="<?=$row['BUKTI']?>">
						  <td class="text-right"><?=$no.'.'?></td>
						  <td><?=$row['UNTUK']?></td>
						  <td class="text-center"><?=$row['NAMABANK']?></td>
						  <td class="text-right">Rp <?=number_format($row['NOMINAL'],0)?>,-</td>
						  <td class="text-center"><?=tgl_indo($row['TGL_TRANSAKSI'])?></td>
						  <td><?=$row['KETERANGAN']?></td>
						  <td class="text-center">
							<?php if($row['BUKTI']){?>
							<div class="showImage" data-toggle="modal" data-target="#modal-uye"><?php echo $row['BUKTI']; ?></div>
							<?php } ?>
						  </td>
						  <td class="text-center"><?=$row['STATUS'] == 1 ? '<span class="badge badge-success">Aktif</span>' : '<span class="badge badge-danger">Non-aktif</span>'?></td>
						  <td><button type="button" class="btn btn-block btn-outline-info editduitkeluar" data-sim="<?=enkripsi($row['KODE'])?>"><i class="fa fa-fw fa-edit"></i></button></td>
						</tr>
					<?php 
					$no++;
					}
					?>
                </tbody>
				<tfoot>
					<tr>
						<th colspan="3" class="text-right">Total</th>
						<th class="text-right">Rp <?=number_format($total,0)?>,-</th>
						<th colspan="5"></th>
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
  <div class="modal fade" id="modal-tambah-kaskeluar">
	<div class="modal-dialog modal-lg">
	  <div class="modal-content">
		<div class="modal-header">
		  <h4 class="modal-title">Tambah/Edit Kas Keluar</h4>
		  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		  </button>
		</div>
		<div class="modal-body">
			<div class="row">
				<div class="col-sm-4">
				  <!-- text input -->
				  <div class="form-group">
					<label>Untuk Pembayaran						
						<div class="custom-control custom-checkbox" style="position:absolute;top:0;right:5px;">
						  <input class="custom-control-input" type="checkbox" id="kaskecil">
						  <label for="kaskecil" class="custom-control-label" style="">Kas Kecil</label>
						</div>
					</label>
					<input type="text" class="form-control" placeholder="Untuk pembayaran..." name="untuk" id="untuk" required>
					<input type="hidden" name="tempid" id="tempid" value="">
				  </div>
				</div>
				<div class="col-sm-4">
				  <div class="form-group text-center">
					<label>Dari Bank</label>
					<select class="form-control" id="bank" style="width: 100%;">
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
				<div class="col-sm-4 d-none" id="tujuanbank">
				  <div class="form-group text-center">
					<label>Ke Bank</label>
					<select class="form-control" id="banktujuan" style="width: 100%;">
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
					<label>Tgl.Transaksi</label>
					<input type="text" class="form-control datepicker" id="tgltransaksi" name="tgltransaksi" placeholder="Klik untuk memilih tanggal...">
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
					<label>Bukti Upload</label>
					<input class="form-control" type="file" id="gambar" name="gambar" multiple accept='image/*'>
					<input type="hidden" id="gambar1" name="gambar1">
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
					<button type="button" class="btn btn-primary form-control" id="simpankaskeluar"><i class="far fa-save"></i></button>
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
  <div class="modal fade" id="modal-uye">
	  <div class="modal-dialog modal-lg">
		<div class="modal-content">
		  <div class="modal-header">
			<h4 class="modal-title">Bukti Kas Keluar</h4>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span></button>
		  </div>
		  <div class="modal-body">
			<div id="image-holder"></div>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
		  </div>
		</div>
		<!-- /.modal-content -->
	  </div>
	  <!-- /.modal-dialog -->
	</div>
<?php 
	require 'adminpage/pages/simfooter.php';
?>