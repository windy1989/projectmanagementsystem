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
            <h1>Pelanggan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Master</a></li>
              <li class="breadcrumb-item active">Pelanggan</li>
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
              <h3 class="card-title">Daftar Pelanggan</h3>
			  <div class="card-tools">
                  <div class="btn-group">
                    <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                      <i class="fas fa-cog"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" role="menu">
                      <a href="javascript:void(0);" class="dropdown-item" data-toggle="modal" data-target="#modal-tambah-pelanggan">Tambah</a>
                      <a href="javascript:void(0);" class="dropdown-item" id="hapuspelanggan">Hapus</a>
                    </div>
                  </div>
						</div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="tabelpelanggan" class="table table-striped table-bordered display responsive wrap" style="width:100%">
                <thead>
					<tr>
					  <th>No</th>
					  <th>Nama</th>
					  <th>Username</th>
					  <th>Info 1</th>
					  <th>Email</th>
					  <th>Info 2</th>
					  <th>Edit</th>
					  <th>Perorangan</th>
					</tr>
                </thead>
                <tbody>
					<?php 
					$no=1;
					while($row = $stmt->fetch(PDO::FETCH_ASSOC)) { 
						if($row['PERORANGAN']==1){
					?>
						<tr data-sim="<?=enkripsi($row['KODE_PELANGGAN'])?>">
						  <td class="text-right"><?=$no.'.'?></td>
						  <td><?=$row['NAMA_PEMILIK']?></td>
						  <td><?=$row['USERNAME']?></td>
						  <td><?=$row['NIK_PEMILIK']?></td>
						  <td><?=$row['EMAIL']?></td>
						  <td><?=$row['KOTA']?></td>
						  <td><button type="button" class="btn btn-block btn-outline-info editpelanggan" data-sim="<?=enkripsi($row['KODE_PELANGGAN'])?>"><i class="fa fa-fw fa-edit"></i></button></td>
						  <td class="text-center"><?=$row['PERORANGAN']==1 ? '<span class="badge bg-success">Ya</span>' : '<span class="badge bg-danger">Tidak</span>' ?></td>
						</tr>
					<?php 
						}else{
						?>
							<tr data-sim="<?=enkripsi($row['KODE_PELANGGAN'])?>">
							  <td class="text-right"><?=$no.'.'?></td>
							  <td><?=$row['NAMA_DIREKTUR']?></td>
							  <td><?=$row['USERNAME']?></td>
							  <td><?=$row['NAMA_PERUSAHAAN']?></td>
							  <td><?=$row['EMAIL']?></td>
							  <td><?=$row['KOTA']?></td>
							  <td><button type="button" class="btn btn-block btn-outline-info editpelanggan" data-sim="<?=enkripsi($row['KODE_PELANGGAN'])?>"><i class="fa fa-fw fa-edit"></i></button></td>
							  <td class="text-center"><?=$row['PERORANGAN']==1 ? '<span class="badge bg-success">Ya</span>' : '<span class="badge bg-danger">Tidak</span>' ?></td>
							</tr>
						<?php 
						}
						$no++;
					}
					?>
                </tbody>
                <tfoot>
                <tr>
                  <th>No</th>
				  <th>Nama</th>
				  <th>Username</th>
				  <th>Info 1</th>
				  <th>Email</th>
				  <th>Info 2</th>
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
  <div class="modal fade" id="modal-tambah-pelanggan">
	<div class="modal-dialog modal-lg">
	  <div class="modal-content">
		<div class="modal-header">
		  <h4 class="modal-title">Tambah/Edit Pelanggan</h4>
		  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		  </button>
		</div>
		<div class="modal-body">
			<div class="card card-primary card-tabs">
              <div class="card-header p-0 pt-1">
                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link opsipelanggan active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true" data-nilai="1">Perorangan</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link opsipelanggan" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false" data-nilai="0">Non-Perorangan</a>
                  </li>
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-one-tabContent">
                  <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
					<form id="form-perorangan">
                     <div class="row">
						<div class="col-sm-4">
						  <!-- text input -->
						  <div class="form-group">
							<label>Nama Pemilik</label>
							<input type="text" class="form-control" placeholder="" name="namapemilik" id="namapemilik" required>
							<input type="hidden" name="tempid" id="tempid">
						  </div>
						</div>
						<div class="col-sm-4">
						  <!-- text input -->
						  <div class="form-group">
							<label>Nama User</label>
							<input type="text" class="form-control" placeholder="" name="username" id="username" required>
						  </div>
						</div>
						<div class="col-sm-4">
						  <!-- text input -->
						  <div class="form-group">
							<label>Password</label>
							<input type="password" class="form-control" placeholder="" name="pass" id="pass" required>
						  </div>
						</div>
						<div class="col-sm-4">
						  <!-- text input -->
						  <div class="form-group">
							<label>Email</label>
							<input type="text" class="form-control" placeholder="" name="mail" id="mail" required>
						  </div>
						</div>
						<div class="col-sm-4">
						  <!-- text input -->
						  <div class="form-group">
							<label>NIK Pemilik</label>
							<input type="text" class="form-control" placeholder="" name="nik" id="nik" required>
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
							<label>Gender</label>
							<select class="form-control" id="jeniskelamin" name="jeniskelamin">
								<option value="L" selected>Laki-laki</option>
								<option value="P">Perempuan</option>
							</select>
						  </div>
						</div>
						<div class="col-sm-4">
						  <div class="form-group">
							<label>Telp/HP</label>
							<input type="text" class="form-control" placeholder="" name="hp" id="hp" required>
						  </div>
						</div>
						<div class="col-sm-4">
						  <!-- text input -->
						  <div class="form-group">
							<label>Keterangan</label>
							<textarea class="form-control" name="keterangan" rows="1" id="keterangan" required></textarea>
						  </div>
						</div>
					</div>
					</form>
                  </div>
                  <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
					<form id="form-nonperorangan">
					<div class="row">
						<div class="col-sm-4">
						  <!-- text input -->
						  <div class="form-group">
							<label>Nama C.P.</label>
							<input type="text" class="form-control" placeholder="" name="namadirektur" id="namadirektur" required>
							<input type="hidden" name="tempidku" id="tempidku">
						  </div>
						</div>
						<div class="col-sm-4">
						  <!-- text input -->
						  <div class="form-group">
							<label>Nama User</label>
							<input type="text" class="form-control" placeholder="" name="namauser" id="namauser" required>
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
							<label>Nama Perusahaan</label>
							<input type="text" class="form-control" placeholder="" name="namaperusahaan" id="namaperusahaan" required>
						  </div>
						</div>
						<div class="col-sm-4">
						  <!-- text input -->
						  <div class="form-group">
							<label>No.Akta Pendirian</label>
							<input type="text" class="form-control" placeholder="" name="noakta" id="noakta" required>
						  </div>
						</div>
						<div class="col-sm-4">
						  <!-- text input -->
						  <div class="form-group">
							<label>Alamat</label>
							<textarea class="form-control" name="alamatku" rows="1" id="alamatku" required></textarea>
						  </div>
						</div>
						<div class="col-sm-4">
						  <!-- text input -->
						  <div class="form-group">
							<label>Provinsi</label>
							<select class="form-control form-control-sm select2" id="provinsiku" style="width: 100%;">
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
								<select class="form-control form-control-sm select2" id="kotaku" name="kotaku" style="width: 100%;">
									<option value="" selected>None</option>
								</select>
							</div>
						</div>
						<div class="col-sm-4">
						  <!-- text input -->
						  <div class="form-group">
							<label>Gender</label>
							<select class="form-control" id="jeniskelaminku" name="jeniskelaminku">
								<option value="L" selected>Laki-laki</option>
								<option value="P">Perempuan</option>
							</select>
						  </div>
						</div>
						<div class="col-sm-4">
						  <div class="form-group">
							<label>Telp/HP</label>
							<input type="text" class="form-control" placeholder="" name="hpku" id="hpku" required>
						  </div>
						</div>
						<div class="col-sm-4">
						  <!-- text input -->
						  <div class="form-group">
							<label>Keterangan</label>
							<textarea class="form-control" name="keteranganku" rows="1" id="keteranganku" required></textarea>
						  </div>
						</div>
					</div>
					</form>
                  </div>
                </div>
              </div>
            </div>
			  
			
		</div>
		<div class="modal-footer justify-content-between">
		  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
		  <button type="button" class="btn btn-primary" id="simpanpelanggan">Simpan</button>
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