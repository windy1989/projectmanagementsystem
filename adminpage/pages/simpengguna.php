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
            <h1>Pengguna</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Master</a></li>
              <li class="breadcrumb-item active">Pengguna</li>
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
              <h3 class="card-title">Daftar Pengguna</h3>
			  <div class="card-tools">
                  <div class="btn-group">
                    <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                      <i class="fas fa-cog"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" role="menu">
                      <a href="javascript:void(0);" class="dropdown-item" data-toggle="modal" data-target="#modal-tambah-pengguna">Tambah</a>
                      <a href="javascript:void(0);" class="dropdown-item" id="hapuspengguna">Hapus</a>
                    </div>
                  </div>
						</div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="tabelpengguna" class="table table-striped table-bordered display responsive wrap" style="width:100%">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>Username</th>
				  <th>Email</th>
				  <th>Hak Akses</th>
                  <th>Edit</th>
                  <th>Status</th>
                </tr>
                </thead>
                <tbody>
					<?php 
					$no=1;
					while($row = $stmt->fetch(PDO::FETCH_ASSOC)) { 
					?>
						<tr data-sim="<?=$row['ID']?>">
						  <td class="text-right"><?=$no.'.'?></td>
						  <td><?=$row['NAMA_LENGKAP']?></td>
						  <td><?=$row['USERNAME']?></td>
						  <td><?=$row['EMAIL']?></td>
						  <td><?=$row['HAK_AKSES']?></td>
						  <td><button type="button" class="btn btn-block btn-outline-info editpengguna" data-sim="<?=$row['ID']?>"><i class="fa fa-fw fa-edit"></i></button></td>
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
                  <th>Username</th>
				  <th>Email</th>
				  <th>Hak Akses</th>
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
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <div class="modal fade" id="modal-tambah-pengguna">
	<div class="modal-dialog modal-lg">
	  <div class="modal-content">
		<div class="modal-header">
		  <h4 class="modal-title">Tambah/Edit Pengguna</h4>
		  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		  </button>
		</div>
		<div class="modal-body">
			<div class="row">
				<div class="col-sm-4">
				  <!-- text input -->
				  <div class="form-group">
					<label>Nama Lengkap</label>
					<input type="text" class="form-control" placeholder="" name="namalengkap" id="namalengkap" required>
					<input type="hidden" name="tempid" id="tempid">
				  </div>
				</div>
				<div class="col-sm-4">
				  <!-- text input -->
				  <div class="form-group">
					<label>Nama Pengguna</label>
					<input type="text" class="form-control" placeholder="" name="namapengguna" id="namapengguna" required>
				  </div>
				</div>
				<div class="col-sm-4">
				  <!-- text input -->
				  <div class="form-group">
					<label>Password</label>
					<input type="password" class="form-control" placeholder="" name="password" id="password" required>
				  </div>
				</div>
				<div class="col-sm-4">
				  <!-- text input -->
				  <div class="form-group">
					<label>Email</label>
					<input type="text" class="form-control" placeholder="" name="email" id="email" required>
				  </div>
				</div>
				<div class="col-sm-4">
				  <!-- text input -->
				  <div class="form-group">
					<label>Kode Pegawai</label>
					<input type="text" class="form-control" placeholder="" name="kodepegawai" id="kodepegawai" required>
				  </div>
				</div>
				<div class="col-sm-4">
				  <!-- text input -->
				  <div class="form-group">
					<label>Alamat</label>
					<textarea class="form-control" name="alamat" rows="1" id="alamat" required></textarea>
				  </div>
				</div>
				<div class="col-sm-4">
				  <!-- text input -->
				  <div class="form-group">
					<label>Jenis Kelamin</label>
					<select class="form-control" id="jeniskelamin" name="jeniskelamin"> 
						<option value="L" selected>Laki-laki</option>
						<option value="P">Perempuan</option>
					</select>
				  </div>
				</div>
				<div class="col-sm-4">
				  <div class="form-group">
					<label>Hak Akses</label>
					<select class="form-control" id="hakakses" name="hakakses">
						<option value="superadmin">Superadmin</option>
						<option value="admin">Admin</option>
						<option value="survei">Survei</option>
						<option value="teknis">Teknis</option>
					</select>
				  </div>
				</div>
				<div class="col-sm-4">
				  <div class="form-group">
					<label>Hak Akses</label>
					<div class="custom-control custom-checkbox">
					  <input class="custom-control-input" type="checkbox" id="aktif" checked>
					  <label for="aktif" class="custom-control-label">Aktif</label>
					</div>
				  </div>
				</div>
			</div>
		</div>
		<div class="modal-footer justify-content-between">
		  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
		  <button type="button" class="btn btn-primary" id="simpanpengguna">Simpan</button>
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