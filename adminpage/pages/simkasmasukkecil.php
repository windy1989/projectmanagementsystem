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
            <h1>Kas Masuk</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Keuangan</a></li>
              <li class="breadcrumb-item active">Kas Kecil</li>
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
              <h3 class="card-title">Daftar Kas Masuk</h3>
			   <!-- <div class="card-tools">
                  <div class="btn-group">
                    <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                      <i class="fas fa-cog"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" role="menu">
                      <a href="javascript:void(0);" class="dropdown-item" data-toggle="modal" data-target="#modal-tambah-kaskeluar">Tambah</a>
                      <a href="javascript:void(0);" class="dropdown-item" id="hapuskaskeluar">Hapus</a>
                    </div>
                  </div>
				</div> -->
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="tabelkaskeluar" class="table table-striped table-bordered display responsive wrap" style="width:100%;zoom:0.8;">
                <thead>
                <tr class="text-center">
                  <th>No</th>
                  <th>Untuk</th>
				  <th>Masuk ke Bank</th>
				  <th>Jumlah</th>
				  <th>Tgl</th>
				  <th>Keterangan</th>
				  <th>Bukti</th>
				  <th>Status</th>
                </tr>
                </thead>
                <tbody>
					<?php 
					$no=1;
					$total = 0;
					while($row = $stmt->fetch(PDO::FETCH_ASSOC)) { 
					$total += $row['NOMINAL'];
					?>
						<tr data-sim="<?=enkripsi($row['KODE'])?>">
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
						<th colspan="4"></th>
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