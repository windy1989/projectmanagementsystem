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
              <li class="breadcrumb-item active">Kas Masuk</li>
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
              <h3 class="card-title">Daftar Penerimaan</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="tabelkasmasuk" class="table table-striped table-bordered display responsive wrap" style="width:100%">
                <thead>
                <tr class="text-center">
                  <th>No</th>
                  <th>Nama Proyek</th>
				  <th>Pembayaran Ke-</th>
                  <th>Nominal</th>
                </tr>
                </thead>
                <tbody>
					<?php 
					$no=1;
					$total = 0;
					while($row = $stmt->fetch(PDO::FETCH_ASSOC)) { 
					
					?>
						<tr data-sim="<?=enkripsi($row['KODE'])?>">
						  <td class="text-right"><?=$no.'.'?></td>
						  <td><?=$row['INFOPROYEK']?></td>
						   <td class="text-center"><?=$row['PEMBAYARAN']?></td>
						   <td class="text-right">Rp <?=number_format($row['TOTAL'],0)?>,-</td>
						</tr>
					<?php 
					$total += $row['TOTAL'];
					$no++;
					}
					?>
                </tbody>
                <tfoot>
                <tr class="text-center">
				  <th colspan="3" class="text-right">Total</th>
                  <th class="text-right">Rp <?=number_format($total,0)?>,-</th>
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