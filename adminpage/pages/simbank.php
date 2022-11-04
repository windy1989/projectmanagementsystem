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
            <h1>Bank</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Master</a></li>
              <li class="breadcrumb-item active">Bank</li>
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
              <h3 class="card-title">Daftar Bank</h3>
				<div class="card-tools">
                  <div class="btn-group">
                    <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                      <i class="fas fa-cog"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" role="menu">
                      <a href="javascript:void(0);" class="dropdown-item" data-toggle="modal" data-target="#modal-tambah-bank">Tambah</a>
                      <a href="javascript:void(0);" class="dropdown-item" id="hapusbank">Hapus</a>
                    </div>
                  </div>
				</div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="tabelbank" class="table table-striped table-bordered display responsive wrap" style="width:100%">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Pemilik</th>
                  <th>No.Rekening</th>
				  <th>Nama Bank</th>
				  <th>Cabang</th>
				  <th>Saldo</th>
				  <th>Edit</th>
                </tr>
                </thead>
                <tbody>
					<?php 
					$no=1;
					while($row = $stmt->fetch(PDO::FETCH_ASSOC)) { 
					?>
						<tr data-sim="<?=enkripsi($row['KODE'])?>">
						  <td class="text-right"><?=$no.'.'?></td>
						  <td><?=$row['NAMA_PEMILIK']?></td>
						  <td><?=$row['NO_REKENING']?></td>
						  <td><?=$row['NAMA_BANK']?></td>
						  <td><?=$row['CABANG']?></td>
						  <td class="text-right">Rp <?=number_format($row['SALDO'],0)?></td>
						  <td><button type="button" class="btn btn-block btn-outline-info editbank" data-sim="<?=enkripsi($row['KODE'])?>"><i class="fa fa-fw fa-edit"></i></button></td>
						</tr>
					<?php 
					$no++;
					}
					?>
                </tbody>
                <tfoot>
                <tr>
                  <th>No</th>
                  <th>Nama Pemilik</th>
                  <th>No.Rekening</th>
				  <th>Nama Bank</th>
				  <th>Cabang</th>
				  <th>Saldo</th>
				  <th>Edit</th>
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
  <div class="modal fade" id="modal-tambah-bank">
	<div class="modal-dialog modal-lg">
	  <div class="modal-content">
		<div class="modal-header">
		  <h4 class="modal-title">Tambah/Edit Bank</h4>
		  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		  </button>
		</div>
		<div class="modal-body">
			<div class="row">
				<div class="col-sm-4">
				  <!-- text input -->
				  <div class="form-group">
					<label>Nama Pemilik</label>
					<input type="text" class="form-control" placeholder="" name="namapemilik" id="namapemilik" required>
					<input type="hidden" name="tempid" id="tempid" value="">
				  </div>
				</div>
				<div class="col-sm-4">
				  <!-- text input -->
				  <div class="form-group">
					<label>No. Rekening</label>
					<input type="text" class="form-control" placeholder="" name="norek" id="norek" required>
				  </div>
				</div>
				<div class="col-sm-4">
				  <!-- text input -->
				  <div class="form-group">
					<label>Nama Bank</label>
					<input type="text" class="form-control" placeholder="" name="namabank" id="namabank" required>
				  </div>
				</div>
				<div class="col-sm-4">
				  <!-- text input -->
				  <div class="form-group">
					<label>Cabang</label>
					<input type="text" class="form-control" placeholder="" name="cabang" id="cabang" required>
				  </div>
				</div>
				<div class="col-sm-4">
				  <!-- text input -->
				  <div class="form-group">
					<label>Saldo</label>
					<input type="text" class="form-control money" placeholder="" name="saldo" id="saldo" value="0" required>
				  </div>
				</div>
			</div>
		</div>
		<div class="modal-footer justify-content-between">
		  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
		  <button type="button" class="btn btn-primary" id="simpanbank">Simpan</button>
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