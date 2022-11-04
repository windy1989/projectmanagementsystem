<?php 
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		session_start();
		require '../conn/conn.php';
		
		function cekPembayaran($kodeproyek){
			global $dbh;
			$statuspembayaran = '';
			foreach($dbh->query('SELECT NO_KWITANSI, PEMBAYARAN_KE, NOMINAL FROM sim_proyekpembayaran WHERE KODE_PROYEK = "'.$kodeproyek.'"') as $row) { 
				if($row['NO_KWITANSI'] != ''){
					$statuspembayaran .= '<span class="badge badge-success">'.$row['PEMBAYARAN_KE'].' : Rp '.number_format($row['NOMINAL'],0).',-</span>';
				}
			}
			
			if($statuspembayaran == ''){
				return '<span class="badge badge-danger">Belum ada pembayaran</span>';
			}else{
				return $statuspembayaran;
			}
		}
		
		$metode = $_POST['metode'];
		if($metode == "tampil"){
			$laporan = $_POST['laporan1'];
			$tampilan = $_POST['tampilan1'];
			$tglawal = $_POST['tglawal1'];
			$tglakhir = $_POST['tglakhir1'];
			
			if($laporan == 'proyek'){
				if($tampilan == 'semua'){
					$stmt = $dbh->prepare("SELECT KODE,NAMA,TGL_PENGAJUAN,LOKASI,KOTA,ID_PELANGGAN,(SELECT CONCAT(NAMA_PEMILIK,NAMA_DIREKTUR) FROM sim_pelanggan WHERE ID = ID_PELANGGAN) AS NAMAPELANGGAN,ID_JENIS,(SELECT NAMA FROM sim_jenis WHERE ID = ID_JENIS) AS JENISPROYEK,ID_PERUNTUKAN,(SELECT NAMA FROM sim_peruntukan WHERE ID = ID_PERUNTUKAN) AS PERUNTUKANPROYEK,KETERANGAN_PERUNTUKAN,LAMA_KERJA,TGL_MULAI_KERJA,TGL_SELESAI_KERJA,SURAT_ANDALALIN,SURAT_KUASA,BIAYA,TERMIN,KETERANGAN,TGL_EDIT,STATUS FROM sim_proyek ORDER BY ID ASC");
					$stmt->execute();
				}else{
					$stmt = $dbh->prepare("SELECT KODE,NAMA,TGL_PENGAJUAN,LOKASI,KOTA,ID_PELANGGAN,(SELECT CONCAT(NAMA_PEMILIK,NAMA_DIREKTUR) FROM sim_pelanggan WHERE ID = ID_PELANGGAN) AS NAMAPELANGGAN,ID_JENIS,(SELECT NAMA FROM sim_jenis WHERE ID = ID_JENIS) AS JENISPROYEK,ID_PERUNTUKAN,(SELECT NAMA FROM sim_peruntukan WHERE ID = ID_PERUNTUKAN) AS PERUNTUKANPROYEK,KETERANGAN_PERUNTUKAN,LAMA_KERJA,TGL_MULAI_KERJA,TGL_SELESAI_KERJA,SURAT_ANDALALIN,SURAT_KUASA,BIAYA,TERMIN,KETERANGAN,TGL_EDIT,STATUS FROM sim_proyek WHERE TGL_PENGAJUAN BETWEEN ? AND ? ORDER BY ID ASC");
					$stmt->execute([$tglawal,$tglakhir]);
				}
				?>
					<table class="table table-striped table-bordered display responsive wrap tabeltampil" style="width:100%;zoom:0.8;">
					<thead>
					<tr>
					  <th>No</th>
					  <th>Nama Proyek</th>
					  <th>Tgl.Pengajuan</th>
					  <th>Lokasi</th>
					  <th>Kota</th>
					  <th>Atas Nama</th>
					  <th>Jenis</th>
					  <th>Peruntukan</th>
					  <th>Keterangan</th>
					  <th>Biaya</th>
					  <th>Tgl.Mulai</th>
					  <th>Estimasi</th>
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
							  <td><?=$row['NAMA']?></td>
							  <td><?=tgl_indo($row['TGL_PENGAJUAN'])?></td>
							  <td><?=$row['LOKASI']?></td>
							  <td><?=$row['KOTA']?></td>
							  <td><?=$row['NAMAPELANGGAN']?></td>
							  <td><?=$row['JENISPROYEK']?></td>
							  <td><?=$row['PERUNTUKANPROYEK']?></td>
							  <td><?=$row['KETERANGAN_PERUNTUKAN']?></td>
							  <td>Rp <?=number_format($row['BIAYA'],0)?>,-</td>
							  <td><?=tgl_indo($row['TGL_MULAI_KERJA'])?></td>
							  <td><?=$row['LAMA_KERJA']?> hari</td>
							  <td><?=$row['STATUS'] == 9 ? '<span class="badge badge-success">Selesai</span>' : '<span class="badge badge-warning">Proses</span>'?></td>
							</tr>
						<?php 
						$no++;
						}
						?>
					</tbody>
				  </table>
				  <script>
					$(".tabeltampil").DataTable({
						"pagingType": "full_numbers",
						"language": {
							"search": "Cari:",
							"lengthMenu": "Tampilkan _MENU_ baris per halaman",
							"zeroRecords": "Data tidak ditemukan.",
							"info": "Menampilkan halaman _PAGE_ dari _PAGES_",
							"infoEmpty": "Tidak ada data, kosong.",
							"infoFiltered": "(disaring dari _MAX_ total data)",
							"paginate": {
							  "previous": "Sebelum",
							  "next": "Sesudah",
							  "first": "Pertama",
							  "last": "Terakhir"
							},
							select: {
								rows: "%d baris dipilih"
							}
						  },
						"lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
						dom: 'lfrtip',
						buttons: [
							'colvis'
						]
					});
				  </script>
				<?php
			}elseif($laporan == 'pembayaran'){
				if($tampilan == 'semua'){
					$stmt = $dbh->prepare("SELECT KODE,NAMA,TGL_PENGAJUAN,LOKASI,KOTA,ID_PELANGGAN,(SELECT CONCAT(NAMA_PEMILIK,NAMA_DIREKTUR) FROM sim_pelanggan WHERE ID = ID_PELANGGAN) AS NAMAPELANGGAN,BIAYA,TERMIN,KETERANGAN,TGL_EDIT,STATUS FROM sim_proyek ORDER BY ID ASC");
					$stmt->execute();
				}else{
					$stmt = $dbh->prepare("SELECT KODE,NAMA,TGL_PENGAJUAN,LOKASI,KOTA,ID_PELANGGAN,(SELECT CONCAT(NAMA_PEMILIK,NAMA_DIREKTUR) FROM sim_pelanggan WHERE ID = ID_PELANGGAN) AS NAMAPELANGGAN,BIAYA,TERMIN,KETERANGAN,TGL_EDIT,STATUS FROM sim_proyek WHERE TGL_PENGAJUAN BETWEEN ? AND ? ORDER BY ID ASC");
					$stmt->execute([$tglawal,$tglakhir]);
				}
				?>
				<table class="table table-striped table-bordered display responsive wrap tabeltampil" style="width:100%;zoom:0.8;">
					<thead>
					<tr>
					  <th>No</th>
					  <th width="20%">Nama Proyek</th>
					  <th>Tgl.Pengajuan</th>
					  <th>Atas Nama</th>
					  <th>Biaya</th>
					  <th>Status</th>
					  <th width="10%">Pembayaran</th>
					</tr>
					</thead>
					<tbody>
						<?php 
						$no=1;
						while($row = $stmt->fetch(PDO::FETCH_ASSOC)) { 
						?>
							<tr>
							  <td class="text-right"><?=$no.'.'?></td>
							  <td><?=$row['NAMA'].' '.$row['LOKASI'].' '.$row['KOTA']?></td>
							  <td><?=tgl_indo($row['TGL_PENGAJUAN'])?></td>
							  <td><?=$row['NAMAPELANGGAN']?></td>
							  <td class="text-right">Rp <?=number_format($row['BIAYA'],0)?>,-</td>
							  <td><?=$row['STATUS'] == 9 ? '<span class="badge badge-success">Selesai</span>' : '<span class="badge badge-warning">Proses</span>'?></td>
							  <td>
								<?php 
									echo cekPembayaran($row['KODE']);
								?>
							  </td>
							</tr>
						<?php 
						$no++;
						}
						?>
					</tbody>
				  </table>
				  <script>
					$(".tabeltampil").DataTable({
						"pagingType": "full_numbers",
						"language": {
							"search": "Cari:",
							"lengthMenu": "Tampilkan _MENU_ baris per halaman",
							"zeroRecords": "Data tidak ditemukan.",
							"info": "Menampilkan halaman _PAGE_ dari _PAGES_",
							"infoEmpty": "Tidak ada data, kosong.",
							"infoFiltered": "(disaring dari _MAX_ total data)",
							"paginate": {
							  "previous": "Sebelum",
							  "next": "Sesudah",
							  "first": "Pertama",
							  "last": "Terakhir"
							},
							select: {
								rows: "%d baris dipilih"
							}
						  },
						"lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
						dom: 'Blfrtip',
						'columnDefs': [{targets: [5], visible: false }],
						buttons: [
						{
							extend: 'colvis',
							text: 'Klik untuk menampilkan kolom tersembunyi'
						}
						]
					});
				  </script>
				<?php
			}elseif($laporan == 'kaskeluar'){
				if($tampilan == 'semua'){
					$stmt = $dbh->prepare("SELECT UNTUK,NOMINAL,TGL_TRANSAKSI,KETERANGAN FROM sim_kaskeluar");
					$stmt->execute();
				}else{
					$stmt = $dbh->prepare("SELECT UNTUK,NOMINAL,TGL_TRANSAKSI,KETERANGAN FROM sim_kaskeluar WHERE TGL_TRANSAKSI BETWEEN ? AND ?");
					$stmt->execute([$tglawal,$tglakhir]);
				}
			?>	
				<table class="table table-striped table-bordered display responsive wrap tabeltampil" style="width:100%;">
					<thead>
					<tr>
					  <th>No</th>
					  <th width="20%">Untuk</th>
					  <th>Tgl.Transaksi</th>
					  <th>Nominal</th>
					  <th>Keterangan</th>
					</tr>
					</thead>
					<tbody>
						<?php 
						$no=1;
						$total=0;
						while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
						$total += $row['NOMINAL'];
						?>
							<tr>
							  <td class="text-right"><?=$no.'.'?></td>
							  <td><?=$row['UNTUK']?></td>
							  <td><?=tgl_indo($row['TGL_TRANSAKSI'])?></td>
							  <td class="text-right">Rp <?=number_format($row['NOMINAL'],0)?>,-</td>
							  <td><?=$row['KETERANGAN']?></td>
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
							<th></th>
						</tr>
					</tfoot>
				  </table>
				  <script>
					$(".tabeltampil").DataTable({
						"pagingType": "full_numbers",
						"language": {
							"search": "Cari:",
							"lengthMenu": "Tampilkan _MENU_ baris per halaman",
							"zeroRecords": "Data tidak ditemukan.",
							"info": "Menampilkan halaman _PAGE_ dari _PAGES_",
							"infoEmpty": "Tidak ada data, kosong.",
							"infoFiltered": "(disaring dari _MAX_ total data)",
							"paginate": {
							  "previous": "Sebelum",
							  "next": "Sesudah",
							  "first": "Pertama",
							  "last": "Terakhir"
							},
							select: {
								rows: "%d baris dipilih"
							}
						  },
						"lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
						dom: 'Blfrtip',
						buttons: [
						{
							extend: 'colvis',
							text: 'Klik untuk menampilkan kolom tersembunyi'
						}
						]
					});
				  </script>
			<?php	
			}elseif($laporan == 'grafik'){
				if($tampilan == 'semua'){
					$stmt = $dbh->prepare("SELECT KOTA,COUNT(*) AS JUMLAH FROM sim_proyek GROUP BY KOTA");
					$stmt->execute();
					$row = $stmt->fetchAll();
					
					$stmtku = $dbh->prepare("SELECT (SELECT COUNT(*) FROM sim_proyek WHERE DATEDIFF(CURDATE(),TGL_SELESAI_KERJA) >= 0 AND STATUS <> 9) AS DANGER, (SELECT COUNT(*) FROM sim_proyek WHERE DATEDIFF(CURDATE(),TGL_SELESAI_KERJA) >= -7 AND DATEDIFF(CURDATE(),TGL_SELESAI_KERJA) < 0 AND STATUS <> 9) AS WARNING, (SELECT COUNT(*) FROM sim_proyek WHERE STATUS = 9) AS DONE");
					$stmtku->execute();
					$rowku = $stmtku->fetchAll();
				}else{
					$stmt = $dbh->prepare("SELECT KOTA,COUNT(*) AS JUMLAH FROM sim_proyek WHERE TGL_PENGAJUAN BETWEEN ? AND ? GROUP BY KOTA");
					$stmt->execute([$tglawal,$tglakhir]);
					$row = $stmt->fetchAll();
					
					$stmtku = $dbh->prepare("SELECT (SELECT COUNT(*) FROM sim_proyek WHERE DATEDIFF(CURDATE(),TGL_SELESAI_KERJA) >= 0 AND STATUS <> 9 AND TGL_PENGAJUAN BETWEEN ? AND ?) AS DANGER, (SELECT COUNT(*) FROM sim_proyek WHERE DATEDIFF(CURDATE(),TGL_SELESAI_KERJA) >= -7 AND DATEDIFF(CURDATE(),TGL_SELESAI_KERJA) < 0 AND STATUS <> 9 AND TGL_PENGAJUAN BETWEEN ? AND ?) AS WARNING, (SELECT COUNT(*) FROM sim_proyek WHERE STATUS = 9 AND TGL_PENGAJUAN BETWEEN ? AND ?) AS DONE");
					$stmtku->execute([$tglawal,$tglakhir,$tglawal,$tglakhir,$tglawal,$tglakhir]);
					$rowku = $stmtku->fetchAll();
				}
			?>
			<div class="row">
				<div class="col-md-6">
					<div class="card card-danger">
					  <div class="card-header">
						<h3 class="card-title">Grafik Jumlah Proyek x Kota</h3>

						<div class="card-tools">
						  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
						  </button>
						  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
						</div>
					  </div>
					  <div class="card-body">
						<canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
					  </div>
					  <!-- /.card-body -->
					</div>
					<!-- /.card -->
				</div>
				<div class="col-md-6">
					<div class="card card-danger">
					  <div class="card-header">
						<h3 class="card-title">Grafik Progres Proyek</h3>

						<div class="card-tools">
						  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
						  </button>
						  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
						</div>
					  </div>
					  <div class="card-body">
						<canvas id="donutChart2" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
					  </div>
					  <!-- /.card-body -->
					</div>
					<!-- /.card -->
				</div>
			</div>
			
			<script>
				function getRandomColor() {
				  var letters = '0123456789ABCDEF';
				  var color = '#';
				  for (var i = 0; i < 6; i++) {
					color += letters[Math.floor(Math.random() * 16)];
				  }
				  return color;
				}
				
				var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
				var donutData        = {
				  labels: [
					  <?php 
					  for($i=0;$i<count($row);$i++){
						echo "'".$row[$i]['KOTA']."',";
					  }
					  ?> 
				  ],
				  datasets: [
					{
					  data: [
						<?php 
						  for($i=0;$i<count($row);$i++){
							echo $row[$i]['JUMLAH'].",";
						  }
						?> 
						],
					  backgroundColor : [
						<?php 
						  for($i=0;$i<count($row);$i++){
							echo 'getRandomColor(),';
						  }
						?> 
					  ],
					}
				  ]
				}
				var donutOptions = {
				  maintainAspectRatio : false,
				  responsive : true,
				}
				//Create pie or douhnut chart
				// You can switch between pie and douhnut using the method below.
				var donutChart = new Chart(donutChartCanvas, {
				  type: 'doughnut',
				  data: donutData,
				  options: donutOptions      
				});
				
				var donutChartCanvas2 = $('#donutChart2').get(0).getContext('2d')
				var donutData2        = {
				  labels: [
					"Lewat Deadline","Hampir Deadline","Selesai"
				  ],
				  datasets: [
					{
					  data: [
						<?php 
							echo $rowku[0]['DANGER'].",".$rowku[0]['WARNING'].",".$rowku[0]['DONE'];
						?> 
						],
					  backgroundColor : [
						 '#ff3333','#ffff00','#00cc00'
					  ],
					}
				  ]
				}
				var donutOptions2 = {
				  maintainAspectRatio : false,
				  responsive : true,
				}
				//Create pie or douhnut chart
				// You can switch between pie and douhnut using the method below.
				var donutChart2 = new Chart(donutChartCanvas2, {
				  type: 'doughnut',
				  data: donutData2,
				  options: donutOptions2      
				});
			</script>
		<?php
			}elseif($laporan == 'kasbesar'){
				if($tampilan == 'semua'){
					$stmt = $dbh->prepare("SELECT ID_BANK,(SELECT NAMA_BANK FROM sim_bank WHERE ID = ID_BANK) AS NAMABANK, SUM(NOMINAL) AS JUMLAHMASUK, (SELECT SUM(NOMINAL) FROM sim_kaskeluar WHERE ID_BANK = sim_proyekpembayaran.ID_BANK) AS JUMLAHKELUAR FROM sim_proyekpembayaran WHERE SUDAH_DIBAYAR = 'SUDAH DIBAYAR' GROUP BY ID_BANK");
					$stmt->execute();
				}else{
					$stmt = $dbh->prepare("SELECT ID_BANK,(SELECT NAMA_BANK FROM sim_bank WHERE ID = ID_BANK) AS NAMABANK, SUM(NOMINAL) AS JUMLAHMASUK, (SELECT SUM(NOMINAL) FROM sim_kaskeluar WHERE ID_BANK = sim_proyekpembayaran.ID_BANK AND TGL_TRANSAKSI BETWEEN ? AND ?) AS JUMLAHKELUAR FROM sim_proyekpembayaran WHERE SUDAH_DIBAYAR = 'SUDAH DIBAYAR' AND TGL_BAYAR BETWEEN ? AND ? GROUP BY ID_BANK");
					$stmt->execute([$tglawal,$tglakhir,$tglawal,$tglakhir]);
				}
			?>
				<?php 
					while($row = $stmt->fetch(PDO::FETCH_ASSOC)) { 
				?>
				<h3><?=$row['NAMABANK']?></h3>
				<div class="row">
				  <div class="col-lg-3 col-6">
					<!-- small box -->
					<div class="small-box bg-success">
					  <div class="inner">
						<h4><sup style="font-size: 15px">Rp</sup><?=number_format($row['JUMLAHMASUK'],0)?></h4>

						<p>Kas Besar Masuk</p>
					  </div>
					  <div class="icon">
						<i class="ion ion-cash"></i>
					  </div>
					  <a href="./kasMasuk" class="small-box-footer">Info lebih <i class="fas fa-arrow-circle-right"></i></a>
					</div>
				  </div>
				  <div class="col-lg-3 col-6">
					<!-- small box -->
					<div class="small-box bg-danger">
					  <div class="inner">
						<h4><sup style="font-size: 15px">Rp</sup><?=number_format($row['JUMLAHKELUAR'],0)?></h4>

						<p>Kas Besar Keluar</p>
					  </div>
					  <div class="icon">
						<i class="ion ion-ios-cart"></i>
					  </div>
					  <a href="./kasKeluar" class="small-box-footer">Info lebih <i class="fas fa-arrow-circle-right"></i></a>
					</div>
				  </div>
				</div>
				<?php } ?>
		<?php
			}elseif($laporan == 'kaskecil'){
				if($tampilan == 'semua'){
					$stmt = $dbh->prepare("SELECT ID_BANK,(SELECT NAMA_BANK FROM sim_bank WHERE ID = ID_BANK) AS NAMABANK, SUM(NOMINAL) AS JUMLAHMASUK, (SELECT SUM(NOMINAL) FROM sim_kaskeluarkecil WHERE ID_BANK = sim_kasmasukkecil.ID_BANK) AS JUMLAHKELUAR FROM sim_kasmasukkecil GROUP BY ID_BANK");
					$stmt->execute();
				}else{
					$stmt = $dbh->prepare("SELECT ID_BANK,(SELECT NAMA_BANK FROM sim_bank WHERE ID = ID_BANK) AS NAMABANK, SUM(NOMINAL) AS JUMLAHMASUK, (SELECT SUM(NOMINAL) FROM sim_kaskeluarkecil WHERE ID_BANK = sim_kasmasukkecil.ID_BANK AND TGL_TRANSAKSI BETWEEN ? AND ?) AS JUMLAHKELUAR FROM sim_kasmasukkecil WHERE TGL_TRANSAKSI BETWEEN ? AND ? GROUP BY ID_BANK");
					$stmt->execute([$tglawal,$tglakhir,$tglawal,$tglakhir]);
				}
				
				while($row = $stmt->fetch(PDO::FETCH_ASSOC)) { 
				?>
				<h3><?=$row['NAMABANK']?></h3>
				<div class="row">
				  <div class="col-lg-3 col-6">
					<!-- small box -->
					<div class="small-box bg-success">
					  <div class="inner">
						<h4><sup style="font-size: 15px">Rp</sup><?=number_format($row['JUMLAHMASUK'],0)?></h4>

						<p>Kas Kecil Masuk</p>
					  </div>
					  <div class="icon">
						<i class="ion ion-cash"></i>
					  </div>
					  <a href="./kasMasuk" class="small-box-footer">Info lebih <i class="fas fa-arrow-circle-right"></i></a>
					</div>
				  </div>
				  <div class="col-lg-3 col-6">
					<!-- small box -->
					<div class="small-box bg-danger">
					  <div class="inner">
						<h4><sup style="font-size: 15px">Rp</sup><?=number_format($row['JUMLAHKELUAR'],0)?></h4>

						<p>Kas Kecil Keluar</p>
					  </div>
					  <div class="icon">
						<i class="ion ion-ios-cart"></i>
					  </div>
					  <a href="./kasKeluar" class="small-box-footer">Info lebih <i class="fas fa-arrow-circle-right"></i></a>
					</div>
				  </div>
				</div>
				<?php } ?>
		<?php
			}
		}elseif($metode == "hapus"){
			
		}elseif($metode == "dapatkan"){
			
			
						
			header('Content-type: application/json');
			echo json_encode($result);
		}
	}else{
		require 'adminpage/pages/simlaporan.php';
	}
?>