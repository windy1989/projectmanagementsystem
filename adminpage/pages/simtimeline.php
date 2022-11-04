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
            <h1>Timeline</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Proyek</a></li>
              <li class="breadcrumb-item active">Timeline</li>
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
              <table id="tabelproyektimeline" class="table table-striped table-bordered display responsive wrap" style="width:100%">
                <thead>
                <tr class="text-center">
                  <th width="5%">#</th>
                  <th width="30%">Nama Proyek</th>
				  <th width="25%">Lokasi</th>
				  <th width="35%">Progress</th>
                  <th width="5%">Detail</th>
                </tr>
                </thead>
                <tbody>
					<?php 
					$no=1;
					while($row = $stmt->fetch(PDO::FETCH_ASSOC)) { 
						$prosentase = round((($row['STATUS']+1)/11)*100,0);
					?>
						<tr data-sim="<?=enkripsi($row['KODE'])?>">
						  <td class="text-right"><?=$no.'.'?></td>
						  <td><?=$row['NAMA']?></td>
						  <td><?=$row['LOKASI'].' '.$row['KOTA']?></td>
						  <td class="project_progress">
							  <div class="progress progress-sm">
								  <div class="progress-bar" role="progressbar" aria-volumenow="<?=$prosentase?>" aria-volumemin="0" aria-volumemax="100" style="width: <?=$prosentase?>%;background-color:<?=$arrColor[$row['STATUS']]?>;">
								  </div>
							  </div>
							  <small>
								<?=$prosentase?>% Complete
							  </small>
						  </td>
						  <td class="text-center"><a href="timeline?dt=<?=enkripsi($row['KODE'])?>">Lihat</a></td>
						</tr>
					<?php 
					$no++;
					}
					?>
                </tbody>
                <tfoot>
                <tr class="text-center">
                  <th>#</th>
                  <th>Nama Proyek</th>
				  <th>Lokasi</th>
				  <th>Progress</th>
                  <th>Timeline</th>
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
<?php 
	require 'adminpage/pages/simfooter.php';
?>