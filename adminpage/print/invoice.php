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
	.ttd {
		background: url(dist/images/ttd.jpg) center center no-repeat;
		background-size: 80%;
		background-position:
			50px 20px,
			100%,
			20px 20px,
			50%,
			0 90%;
	}
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
  </style>

</head>
<body>
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice" style="padding:1cm;">
    <!-- title row -->
    <div class="row">
      <div class="col-12">
		<table border="0" width="100%">
			<tr>
				<td width="15%">
					<h2 class="page-header">
					  <img src="dist/images/logo.png" width="125px" height="100%" style="margin-left:30px;">
					</h2>
				</td>
				<td width="55%">
					<table border="0" width="100%" id="atas">
						<tr>
							<td colspan=2><b>CV. VICTORY KONSULTAN</b></td>
						</tr>
						<tr>
							<td width="30%">Kantor Pusat</td>
							<td width="70%">: Perum. Graha Kota D 12 No. 20 Suko - Sidoarjo</td>
						</tr>
						<tr>
							<td width="30%">Kantor Operasional</td>
							<td width="70%">: Perum. Graha Kota D 10 No. 07 Suko - Sidoarjo</td>
						</tr>
						<tr>
							<td width="30%">Telp/Fax</td>
							<td width="70%">: 031-51517878</td>
						</tr>
						<tr>
							<td width="30%">Email</td>
							<td width="70%">: victorykonsultan@gmail.com</td>
						</tr>
					</table>
				</td>
				<td width="30%" class="text-center">
					<h3>INVOICE</h3>
					<img src="" alt="" id="image" />
				</td>
			</tr>
		</table>
        
		
      </div>
      <!-- /.col -->
    </div>
	<hr style="border: 2px solid black;margin-bottom:1.5px;margin-top:0px !important;">
	<hr style="margin-top:0;border: 0.5px solid black">
    <!-- info row -->
    <div class="row invoice-info" style="font-size:18px; !important">
      <div class="col-sm-6 invoice-col" style="border:0.5px solid black;">
        Ditujukan Kepada Yth:
        <address>
          <strong><?=explode('^',explode('|',$result['INFOPROYEK'])[1])[0].'</br>'.explode('^',explode('|',$result['INFOPROYEK'])[1])[1].'<br>'.explode('^',explode('|',$result['INFOPROYEK'])[1])[2]?></strong>
        </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-6 invoice-col">
        <table border="0" width="100%">
			<tr>
				<td width="30%">
				No
				</td>
				<td>
					: <?=$result['NO_INVOICE']?>
				</td>
			</tr>
			<tr>
				<td>
				Tanggal
				</td>
				<td>
					: <?=tgl_indo($result['TGL_INVOICE'])?>
				</td>
			</tr>
			<tr>
				<td>
				No.Kontrak
				</td>
				<td>
					: <?=explode('^',explode('|',$result['INFOPROYEK'])[0])[3]?>
				</td>
			</tr>
		</table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Table row -->
    <div class="row mt-4" style="font-size:18px; !important">
      <div class="col-12 table-responsive">
        <table class="table table-bordered">
          <thead>
          <tr class="text-center">
            <th width="5%">No</th>
            <th width="40%">Diskripsi</th>
            <th width="20%">Total Nilai</th>
            <th width="15%">Persentase (%)</th>
            <th width="20%">Jumlah</th>
          </tr>
          </thead>
          <tbody>
          <tr>
            <td class="align-middle text-right">1.</td>
            <td class="align-middle">Pembayaran <?=$result['PEMBAYARAN_KE'] == 1 ? $result['PEMBAYARAN_KE'].'(DP)' : $result['PEMBAYARAN_KE']?> <?=explode('^',explode('|',$result['INFOPROYEK'])[0])[0].' '.explode('^',explode('|',$result['INFOPROYEK'])[0])[1].' '.explode('^',explode('|',$result['INFOPROYEK'])[0])[2]?></td>
            <td class="text-right align-middle">Rp. <?=number_format(explode('^',explode('|',$result['INFOPROYEK'])[0])[4])?>,-</td>
            <td class="text-center align-middle"><?=round(($result['NOMINAL']/explode('^',explode('|',$result['INFOPROYEK'])[0])[4])*100,2)?></td>
            <td class="text-right align-middle">Rp. <?=number_format($result['NOMINAL'],0)?>,-</td>
          </tr>
		  <tr style="font-size:5px;">
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		  </tr>
		   <tr style="font-size:5px;">
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		  </tr>
		  <tr>
			<td colspan="3">&nbsp;</td>
			<td class="text-center align-middle">Total</td>
			<td class="text-right align-middle">Rp. <?=number_format($result['NOMINAL'],0)?>,-</td>
		  </tr>
		  <tr>
			<td colspan="5">Terbilang : <b><i><?=ucwords(terbilang(round($result['NOMINAL'],0)))?> Rupiah</i></b></td>
		  </tr>
          </tbody>
        </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="row" style="font-size:18px; !important">
      <!-- accepted payments column -->
      <div class="col-12">
        <p>Keterangan:</p>
        <p style="margin-top: 10px;">
          Adapun pembayaran mohon di transfer ke nomor rekening berikut :
		  <ol>
			<li><?=$result['INFOBANK']?></li>
			<li>Mohon Bukti Transfer dikirim ke email  victorykonsultan@gmail.com</li>
		  </ol>
        </p>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
	<br><br><br>
	<div class="row" style="font-size:18px; !important">
		<div class="col-4">
		
		</div>
		<div class="col-4">
		</div>
		<div class="col-4 text-center font-weight-bold ttd">
			CV. VICTORY KONSULTAN
			<br><br><br><br><br><br>
			<u>DEDDY CHRISTIANTO.,S.T.</u>
			<br>Direktur
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
