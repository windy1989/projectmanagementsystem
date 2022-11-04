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
            <h1>Update Aplikasi</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Maintenance</a></li>
              <li class="breadcrumb-item active">Update Aplikasi</li>
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
              <h3 class="card-title">
				Sinkronisasi File
				<?php 
					if($koneksipusat == false){
						echo '<span class="badge badge-danger">Anda tidak terhubung dengan internet.</span>';
					}else{
						echo '<span class="badge badge-success">Anda siap melakukan sinkronisasi.</span>';
					}
				?>
			  </h3>
				<div class="card-tools">
                  <div class="btn-group">
                    <button class="btn btn-info btn-sm" id="ceksinkronisasi"><i class="fas fa-sync"></i></button>
                  </div>
				</div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="tabelhistoryupdate" class="table table-striped table-bordered display responsive wrap" style="width:100%">
                <thead>
                <tr class="text-center">
                  <th>#</th>
                  <th>Token</th>
				  <th>Waktu</th>
				  <th>Status</th>
                </tr>
                </thead>
                <tbody>
					<?php 
					$no=1;
					while($row = $stmt->fetch(PDO::FETCH_ASSOC)) { 
					?>
						<tr>
						  <td class="text-right"><?=$no.'.'?></td>
						  <td class="text-center"><?=$row['TOKEN']?></td>
						  <td class="text-center"><?=$row['WAKTU']?></td>
						  <td class="text-center"><?=$row['STATUS']?></td>
						</tr>
					<?php 
					$no++;
					}
					?>
                </tbody>
                <tfoot>
                <tr class="text-center">
                  <th>#</th>
                  <th>Token</th>
				  <th>Waktu</th>
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
              <h3 class="card-title">
				Upload Database Offline
			  </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">
				<div class="col-sm-6">
				  <!-- text input -->
				  <div class="form-group">
					<input class="form-control" type="file" id="dbfile" name="dbfile" accept=".sql">
				  </div>
				  <button type="button" class="btn btn-primary btn-block" id="simpandatabase"><i class="fas fa-upload"></i></button>
				</div>
				<div class="col-sm-6">
					  <!-- text input -->
					  <div class="form-group">
						<label>Download Database</label>
					  </div>
					  <button type="button" class="btn btn-success btn-block" id="downloaddatabase"><i class="fas fa-download"></i></button>
				</div>
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