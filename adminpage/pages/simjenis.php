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
            <h1>Jenis Proyek</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Master</a></li>
              <li class="breadcrumb-item active">Jenis Proyek</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-6">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Daftar Jenis</h3>
			  <div class="card-tools">
                  <div class="btn-group">
                    <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                      <i class="fas fa-cog"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" role="menu">
                      <a href="javascript:void(0);" class="dropdown-item" data-toggle="modal" data-target="#modal-tambah-jenis">Tambah</a>
                      <a href="javascript:void(0);" class="dropdown-item" id="hapusjenis">Hapus</a>
                    </div>
                  </div>
						</div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="tabeljenis" class="table table-striped table-bordered display responsive wrap" style="width:100%">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>Keterangan</th>
                  <th>Edit</th>
                  <th>Status</th>
                </tr>
                </thead>
                <tbody>
					<?php 
					$no=1;
					while($row = $stmtjenis->fetch(PDO::FETCH_ASSOC)) { 
					?>
						<tr data-sim="<?=enkripsi($row['KODE'])?>">
						  <td class="text-right"><?=$no.'.'?></td>
						  <td><?=$row['NAMA']?></td>
						  <td><?=$row['KETERANGAN']?></td>
						  <td><button type="button" class="btn btn-block btn-outline-info editjenis" data-sim="<?=enkripsi($row['KODE'])?>"><i class="fa fa-fw fa-edit"></i></button></td>
						  <td class="text-center"><?=$row['STATUS']==1 ? '<span class="badge bg-success">Aktif</span>' : '<span class="badge bg-danger">Non-aktif</span>' ?></td>
						</tr>
					<?php 
					$no++;
					}
					?>
                </tbody>
                <tfoot>
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>Keterangan</th>
                  <th>Edit</th>
                  <th>Status</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

        </div>
        <!-- /.col -->
		
		<div class="col-md-6">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Daftar Peruntukan</h3>
			 <div class="card-tools">
                  <div class="btn-group">
                    <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                      <i class="fas fa-cog"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" role="menu">
                      <a href="javascript:void(0);" class="dropdown-item" data-toggle="modal" data-target="#modal-tambah-peruntukan">Tambah</a>
                      <a href="javascript:void(0);" class="dropdown-item" id="hapusperuntukan">Hapus</a>
                    </div>
                  </div>
						</div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="tabelperuntukan" class="table table-striped table-bordered display responsive wrap" style="width:100%">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>Keterangan</th>
                 <th>Edit</th>
                  <th>Status</th>
                </tr>
                </thead>
                <tbody>
					<?php 
					$no=1;
					while($row = $stmtuntuk->fetch(PDO::FETCH_ASSOC)) { 
					?>
						<tr data-sim="<?=enkripsi($row['KODE'])?>">
						  <td class="text-right"><?=$no.'.'?></td>
						  <td><?=$row['NAMA']?></td>
						  <td><?=$row['KETERANGAN']?></td>
						  <td><button type="button" class="btn btn-block btn-outline-info editperuntukan" data-sim="<?=enkripsi($row['KODE'])?>"><i class="fa fa-fw fa-edit"></i></button></td>
						  <td class="text-center"><?=$row['STATUS']==1 ? '<span class="badge bg-success">Aktif</span>' : '<span class="badge bg-danger">Non-aktif</span>' ?></td>
						</tr>
					<?php 
					$no++;
					}
					?>
                </tbody>
                <tfoot>
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>Keterangan</th>
                  <th>Edit</th>
                  <th>Status</th>
                </tr>
                </tfoot>
              </table>
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
  <!-- /.content-wrapper -->
  <div class="modal fade" id="modal-tambah-jenis">
	<div class="modal-dialog modal-lg">
	  <div class="modal-content">
		<div class="modal-header">
		  <h4 class="modal-title">Tambah/Edit Jenis</h4>
		  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		  </button>
		</div>
		<div class="modal-body">
			<div class="row">
				<div class="col-sm-4">
				  <!-- text input -->
				  <div class="form-group">
					<label>Nama</label>
					<input type="text" class="form-control" placeholder="" name="namajenis" id="namajenis" required>
					<input type="hidden" name="tempidjenis" id="tempidjenis" value="">
				  </div>
				</div>
				<div class="col-sm-8">
				  <!-- text input -->
				  <div class="form-group">
					<label>Keterangan</label>
					<input type="text" class="form-control" placeholder="" name="keteranganjenis" id="keteranganjenis" required>
				  </div>
				</div>
			</div>
		</div>
		<div class="modal-footer justify-content-between">
		  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
		  <button type="button" class="btn btn-primary" id="simpanjenis">Simpan</button>
		</div>
	  </div>
	  <!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
  <div class="modal fade" id="modal-tambah-peruntukan">
	<div class="modal-dialog modal-lg">
	  <div class="modal-content">
		<div class="modal-header">
		  <h4 class="modal-title">Tambah/Edit Peruntukan</h4>
		  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		  </button>
		</div>
		<div class="modal-body">
			<div class="row">
				<div class="col-sm-4">
				  <!-- text input -->
				  <div class="form-group">
					<label>Nama</label>
					<input type="text" class="form-control" placeholder="" name="namaperuntukan" id="namaperuntukan" required>
					<input type="hidden" name="tempidperuntukan" id="tempidperuntukan" value="">
				  </div>
				</div>
				<div class="col-sm-8">
				  <!-- text input -->
				  <div class="form-group">
					<label>Keterangan</label>
					<input type="text" class="form-control" placeholder="" name="keteranganperuntukan" id="keteranganperuntukan" required>
				  </div>
				</div>
			</div>
		</div>
		<div class="modal-footer justify-content-between">
		  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
		  <button type="button" class="btn btn-primary" id="simpanperuntukan">Simpan</button>
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