<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Invoice#<?=$result['KODE']?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap 4 -->

  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <script type="text/javascript" src="plugins/jquery/jquery.min.js"></script>
  <!-- QRcode JS -->
  <script src="plugins/qrcode-with-logos-master/dist/QRcode-with-logo.js"></script>
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <style media="print" type="text/css">
	table > tr > td {
		padding:0px !important;
	}
	table.table-bordered{
		border:1px solid black !important;
		margin-top:20px;
	  }
	table.table-bordered > thead > tr > th{
		border:1px solid black !important;
	}
	table.table-bordered > tbody > tr > td{
		border:1px solid black !important;
	}
  </style>
  <style>
	#atas tr td {
		padding:0px !important;
	}
	table.table-bordered{
		border:1px solid black;
		margin-top:20px;
	  }
	table.table-bordered > thead > tr > th{
		border:1px solid black;
	}
	table.table-bordered > tbody > tr > td{
		border:1px solid black;
	}
	.bg {
		position: absolute;
		z-index: 99;
		top: -50px;
		bottom: 0;
		left: 0;
		right: 0;
		background: url(dist/images/logo.png) center center no-repeat;
		opacity: .15;
		width: 100%;
		height: 100%;
	}
	.ttd {
		background: url(dist/images/ttd.jpg) center center no-repeat;
		background-size: 80%;
		background-position:
			-20px 20px,
			100%,
			20px 20px,
			50%,
			0 90%;
	}
	.kwitansi {
		position: absolute;
		z-index: 99;
		top: -350px;
		bottom: 0;
		left: 0;
		right: 0;
		width: 100%;
		height: 100%;
		writing-mode: tb-rl;
        transform: rotate(-180deg);
		font-size:50px;
		background: -webkit-linear-gradient(#eee, #333);
		-webkit-background-clip: text;
		-webkit-text-fill-color: transparent;
		-webkit-text-stroke: 1px black;
		//text-shadow: -3px -3px black;
		letter-spacing: 5px;
	}
	.borderless td, .borderless th {
		border: none;
	}
  </style>

</head>
<body>
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice" style="padding:1cm;">
	<div class="bg"></div>
	<div class="kwitansi"><i>KWITANSI</i></div>
    <!-- title row -->
    <div class="row">
      <div class="col-12">
		<table border="0" width="100%">
			<tr>
				<td width="15%">
					<h2 class="page-header">
					  <img src="dist/images/logo.png" width="100px" height="100%" style="margin-left:30px;">
					</h2>
				</td>
				<td width="40%" style="font-size:13px !important;">
					<table border="0" width="100%" id="atas">
						<tr>
							<td colspan=2><b><u>CV. VICTORY KONSULTAN</u></b></td>
						</tr>
						<tr>
							<td colspan=2><b>STUDY KELAYAKAN, REKAYASA, EVALUASI, DAN MANAJEMEN</b></td>
						</tr>
						<tr>
							<td width="20%">Alamat</td>
							<td width="80%">: Perum. Graha Kota D 12 No. 20 Suko - Sidoarjo</td>
						</tr>
						<tr>
							<td width="20%">Telp/Fax</td>
							<td width="80%">: 031-51517878</td>
						</tr>
						<tr>
							<td width="20%">Email</td>
							<td width="80%">: victorykonsultan@gmail.com</td>
						</tr>
						<tr>
							<td width="20%">Web</td>
							<td width="80%">: victorykonsultan.co.id</td>
						</tr>
					</table>
				</td>
				<td width="45%">
					<table border="0" width="100%">
						<tr>
							<td width="20%" style="padding:0px !important;">
							Tanggal
							</td>
							<td width="50%" style="padding:0px !important;">
								: <?=tgl_indo($result['TGL_BAYAR'])?>
							</td>
							<td rowspan="2" width="30%" class="text-center" style="padding:0px !important;">
								<img src="" alt="" id="image" />
							</td>
						</tr>
						<tr>
							<td width="20%" style="padding:0px !important;">
							Invoice No
							</td>
							<td width="50%" style="padding:0px !important;">
								: <?=$result['NO_INVOICE']?>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
        
		
      </div>
      <!-- /.col -->
    </div>
	<hr style="border: 2px solid black;margin-bottom:1.5px;margin-top:10px !important;">
	<hr style="margin-top:0;border: 0.5px solid black">
    <!-- Table row -->
    <div class="row mt-4" style="font-size:18px; !important;padding-left:50px;">
      <div class="col-12 table-responsive">
        <table class="table borderless">
          <tbody>
			  <tr>
				<td width="25%">KWITANSI</td>
				<td width="1%">:</td>
				<td width="74%"><?=$result['NO_KWITANSI']?></td>
			  </tr>
			  <tr>
				<td>TELAH DITERIMA DARI</td>
				<td>:</td>
				<td><?=$result['TERIMA_DARI']?></td>
			  </tr>
			  <tr>
				<td>UNTUK PEMBAYARAN</td>
				<td>:</td>
				<td>Pembayaran <?=$result['PEMBAYARAN_KE'] == 1 ? $result['PEMBAYARAN_KE'].'(DP)' : $result['PEMBAYARAN_KE']?> <?=explode('^',explode('|',$result['INFOPROYEK'])[0])[0].' '.explode('^',explode('|',$result['INFOPROYEK'])[0])[1].' '.explode('^',explode('|',$result['INFOPROYEK'])[0])[2]?></td>
			  </tr>
			  <tr>
				<td>JUMLAH UANG</td>
				<td>:</td>
				<td>Rp. <?=number_format($result['NOMINAL'],0)?>,-</td>
			  </tr>
			  <tr>
				<td>TERBILANG</td>
				<td>:</td>
				<td style="border: 1px solid black;"><b><i><?=ucwords(terbilang(round($result['NOMINAL'],0)))?> Rupiah</i></b></td>
			  </tr>
          </tbody>
        </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
	<br><br>
	<div class="row" style="font-size:18px; !important">
		<div class="col-4">
		
		</div>
		<div class="col-4">
		</div>
		<div class="col-4 ttd">
			CV. Victory Konsultan,
			<br><br><br><br><br><br>
			<u class="font-weight-bold">DEDDY CHRISTIANTO.,S.T.</u>
			<br><span class="font-weight-bold">Direktur</span>
		</div>
	</div>
  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
<script>
	$("#image"). attr("src", "");
			
	var qrcode = new QrCodeWithLogo({
		image: document.getElementById("image"),
		content: "<?=explode('^',explode('|',$result['INFOPROYEK'])[0])[3]?>",
		width: 75,
		//   download: true,
		logo: {
		  src: "dist/images/cropped-logo-192x192.jpeg"
		}
	});

	qrcode.toImage();
	$('#image').on('load', function(event) {
		window.print();
	});
</script>
</body>
</html>
