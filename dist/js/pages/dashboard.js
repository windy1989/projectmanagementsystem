$(function () {

  'use strict'

  // Make the dashboard widgets sortable Using jquery UI
  $('.connectedSortable').sortable({
    placeholder         : 'sort-highlight',
    connectWith         : '.connectedSortable',
    handle              : '.card-header, .nav-tabs',
    forcePlaceholderSize: true,
    zIndex              : 999999
  })
  $('.connectedSortable .card-header, .connectedSortable .nav-tabs-custom').css('cursor', 'move')

  // jQuery UI sortable for the todo list
  $('.todo-list').sortable({
    placeholder         : 'sort-highlight',
    handle              : '.handle',
    forcePlaceholderSize: true,
    zIndex              : 999999
  })

  // bootstrap WYSIHTML5 - text editor
  $('.textarea').summernote()

  $('.daterange').daterangepicker({
    ranges   : {
      'Today'       : [moment(), moment()],
      'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
      'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
      'Last 30 Days': [moment().subtract(29, 'days'), moment()],
      'This Month'  : [moment().startOf('month'), moment().endOf('month')],
      'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    },
    startDate: moment().subtract(29, 'days'),
    endDate  : moment()
  }, function (start, end) {
    window.alert('You chose: ' + start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
  })

  /* jQueryKnob */
  $('.knob').knob()

  // The Calender
  $('#calendar').datetimepicker({
    format: 'L',
    inline: true
  })

  // SLIMSCROLL FOR CHAT WIDGET
  $('#chat-box').overlayScrollbars({
    height: '250px'
  })

if(document.getElementById('revenue-chart-canvas')){
  /* Chart.js Charts */
  // Sales chart
  var salesChartCanvas = document.getElementById('revenue-chart-canvas').getContext('2d');
  //$('#revenue-chart').get(0).getContext('2d');

  var salesChartData = {
    labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
    datasets: [
      {
        label               : 'Digital Goods',
        backgroundColor     : 'rgba(60,141,188,0.9)',
        borderColor         : 'rgba(60,141,188,0.8)',
        pointRadius          : false,
        pointColor          : '#3b8bba',
        pointStrokeColor    : 'rgba(60,141,188,1)',
        pointHighlightFill  : '#fff',
        pointHighlightStroke: 'rgba(60,141,188,1)',
        data                : [28, 48, 40, 19, 86, 27, 90]
      },
      {
        label               : 'Electronics',
        backgroundColor     : 'rgba(210, 214, 222, 1)',
        borderColor         : 'rgba(210, 214, 222, 1)',
        pointRadius         : false,
        pointColor          : 'rgba(210, 214, 222, 1)',
        pointStrokeColor    : '#c1c7d1',
        pointHighlightFill  : '#fff',
        pointHighlightStroke: 'rgba(220,220,220,1)',
        data                : [65, 59, 80, 81, 56, 55, 40]
      },
    ]
  }

  var salesChartOptions = {
    maintainAspectRatio : false,
    responsive : true,
    legend: {
      display: false
    },
    scales: {
      xAxes: [{
        gridLines : {
          display : false,
        }
      }],
      yAxes: [{
        gridLines : {
          display : false,
        }
      }]
    }
  }

  // This will get the first returned node in the jQuery collection.
  var salesChart = new Chart(salesChartCanvas, { 
      type: 'line', 
      data: salesChartData, 
      options: salesChartOptions
    }
  )

  // Donut Chart
  var pieChartCanvas = $('#sales-chart-canvas').get(0).getContext('2d')
  var pieData        = {
    labels: [
        'Instore Sales', 
        'Download Sales',
        'Mail-Order Sales', 
    ],
    datasets: [
      {
        data: [30,12,20],
        backgroundColor : ['#f56954', '#00a65a', '#f39c12'],
      }
    ]
  }
  var pieOptions = {
    legend: {
      display: false
    },
    maintainAspectRatio : false,
    responsive : true,
  }
  //Create pie or douhnut chart
  // You can switch between pie and douhnut using the method below.
  var pieChart = new Chart(pieChartCanvas, {
    type: 'doughnut',
    data: pieData,
    options: pieOptions      
  });
}
	
	$('#tabelpengguna').DataTable({
		"pagingType": "full_numbers",
		select: {
            style: 'multi'
        },
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
	
	$('#tabelproyek').DataTable({
		"pagingType": "full_numbers",
		select: {
            style: 'multi'
        },
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
	
	$('#tabelproyektimeline').DataTable({
		"pagingType": "full_numbers",
		select: {
            style: 'multi'
        },
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
	
	$("#tabelkaskeluar").DataTable({
		"pagingType": "full_numbers",
		select: {
            style: 'multi'
        },
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
		'columnDefs': [{targets: [5,6,7], visible: false }],
		buttons: [
		{
			extend: 'colvis',
			text: 'Klik untuk menampilkan kolom tersembunyi'
		}
		]
	});
	
	$("#tabelkaskeluarkecil").DataTable({
		"pagingType": "full_numbers",
		select: {
            style: 'multi'
        },
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
		'columnDefs': [{targets: [5,6,7], visible: false }],
		buttons: [
		{
			extend: 'colvis',
			text: 'Klik untuk menampilkan kolom tersembunyi'
		}
		]
	});
	
	$("#hapuspengguna").on('click',function() {
		toastr.warning("<div align='center'><br><button type='button' id='confirmationRevertYes' class='btn btn-info'>Ya</button> <button type='button' id='confirmationRevertNo' class='btn btn-danger'>Tidak</button></div>",'Apakah anda yakin ingin menghapus data?',
		{
			closeButton: false,
			allowHtml: true,
			onShown: function (toast) {
				$("#confirmationRevertYes").click(function(){
					var arr = [];
					var table = $('#tabelpengguna').DataTable();
					var terpilih = $(table.rows('.selected').nodes());
					$.each(terpilih, function (idx, value) {
						arr.push($(value).data('sim'));
					});
					
					if(arr.length > 0){
						$.post("adminpage/control/pengguna.php", {
							arrID : arr,
							metode : 'hapus'
						}, function(data){
							toastr.success('Pengguna berhasil dihapus. Halaman akan direfresh.');
							setTimeout(function(){ location.reload(); }, 2000);
						});
					}else{
						toastr.warning('Anda belum memilih baris yang ingin dihapus!')
					}
				});
				$("#confirmationRevertNo").click(function(){
					//
				});
			}
		});
		
		
	});
	
	$("#hapuspelanggan").on('click',function() {
		toastr.warning("<div align='center'><br><button type='button' id='confirmationRevertYes' class='btn btn-info'>Ya</button> <button type='button' id='confirmationRevertNo' class='btn btn-danger'>Tidak</button></div>",'Apakah anda yakin ingin menghapus data?',
		{
			closeButton: false,
			allowHtml: true,
			onShown: function (toast) {
				$("#confirmationRevertYes").click(function(){
					var arr = [];
					var table = $('#tabelpelanggan').DataTable();
					var terpilih = $(table.rows('.selected').nodes());
					$.each(terpilih, function (idx, value) {
						arr.push($(value).data('sim'));
					});
					
					if(arr.length > 0){
						$.post("adminpage/control/pelanggan.php", {
							arrID : arr,
							metode : 'hapus'
						}, function(data){
							toastr.success('Pelanggan berhasil dihapus. Halaman akan direfresh.');
							setTimeout(function(){ location.reload(); }, 2000);
						});
					}else{
						toastr.warning('Anda belum memilih baris yang ingin dihapus!')
					}
				});
				$("#confirmationRevertNo").click(function(){
					//
				});
			}
		});
		
		
	});
	
	$("#hapusjenis").on('click',function() {
		toastr.warning("<div align='center'><br><button type='button' id='confirmationRevertYes' class='btn btn-info'>Ya</button> <button type='button' id='confirmationRevertNo' class='btn btn-danger'>Tidak</button></div>",'Apakah anda yakin ingin menghapus data?',
		{
			closeButton: false,
			allowHtml: true,
			onShown: function (toast) {
				$("#confirmationRevertYes").click(function(){
					var arr = [];
					var table = $('#tabeljenis').DataTable();
					var terpilih = $(table.rows('.selected').nodes());
					$.each(terpilih, function (idx, value) {
						arr.push($(value).data('sim'));
					});
					
					if(arr.length > 0){
						$.post("adminpage/control/jenis.php", {
							arrID : arr,
							metode : 'hapusjenis'
						}, function(data){
							toastr.success('Data berhasil dihapus. Halaman akan direfresh.');
							setTimeout(function(){ location.reload(); }, 2000);
						});
					}else{
						toastr.warning('Anda belum memilih baris yang ingin dihapus!')
					}
				});
				$("#confirmationRevertNo").click(function(){
					//
				});
			}
		});
		
		
	});
	
	$("#hapusperuntukan").on('click',function() {
		toastr.warning("<div align='center'><br><button type='button' id='confirmationRevertYes' class='btn btn-info'>Ya</button> <button type='button' id='confirmationRevertNo' class='btn btn-danger'>Tidak</button></div>",'Apakah anda yakin ingin menghapus data?',
		{
			closeButton: false,
			allowHtml: true,
			onShown: function (toast) {
				$("#confirmationRevertYes").click(function(){
					var arr = [];
					var table = $('#tabelperuntukan').DataTable();
					var terpilih = $(table.rows('.selected').nodes());
					$.each(terpilih, function (idx, value) {
						arr.push($(value).data('sim'));
					});
					
					if(arr.length > 0){
						$.post("adminpage/control/jenis.php", {
							arrID : arr,
							metode : 'hapusperuntukan'
						}, function(data){
							toastr.success('Data berhasil dihapus. Halaman akan direfresh.');
							setTimeout(function(){ location.reload(); }, 2000);
						});
					}else{
						toastr.warning('Anda belum memilih baris yang ingin dihapus!')
					}
				});
				$("#confirmationRevertNo").click(function(){
					//
				});
			}
		});
		
		
	});
	
	$("#hapussyarat").on('click',function() {
		toastr.warning("<div align='center'><br><button type='button' id='confirmationRevertYes' class='btn btn-info'>Ya</button> <button type='button' id='confirmationRevertNo' class='btn btn-danger'>Tidak</button></div>",'Apakah anda yakin ingin menghapus data?',
		{
			closeButton: false,
			allowHtml: true,
			onShown: function (toast) {
				$("#confirmationRevertYes").click(function(){
					var arr = [];
					var table = $('#tabelsyarat').DataTable();
					var terpilih = $(table.rows('.selected').nodes());
					$.each(terpilih, function (idx, value) {
						arr.push($(value).data('sim'));
					});
					
					if(arr.length > 0){
						$.post("adminpage/control/syarat.php", {
							arrID : arr,
							metode : 'hapus'
						}, function(data){
							toastr.success('Data berhasil dihapus. Halaman akan direfresh.');
							setTimeout(function(){ location.reload(); }, 2000);
						});
					}else{
						toastr.warning('Anda belum memilih baris yang ingin dihapus!')
					}
				});
				$("#confirmationRevertNo").click(function(){
					//
				});
			}
		});
		
		
	});
	
	$("#hapusbank").on('click',function() {
		toastr.warning("<div align='center'><br><button type='button' id='confirmationRevertYes' class='btn btn-info'>Ya</button> <button type='button' id='confirmationRevertNo' class='btn btn-danger'>Tidak</button></div>",'Apakah anda yakin ingin menghapus data?',
		{
			closeButton: false,
			allowHtml: true,
			onShown: function (toast) {
				$("#confirmationRevertYes").click(function(){
					var arr = [];
					var table = $('#tabelbank').DataTable();
					var terpilih = $(table.rows('.selected').nodes());
					$.each(terpilih, function (idx, value) {
						arr.push($(value).data('sim'));
					});
					
					if(arr.length > 0){
						$.post("adminpage/control/bank.php", {
							arrID : arr,
							metode : 'hapus'
						}, function(data){
							toastr.success('Data berhasil dihapus. Halaman akan direfresh.');
							setTimeout(function(){ location.reload(); }, 2000);
						});
					}else{
						toastr.warning('Anda belum memilih baris yang ingin dihapus!')
					}
				});
				$("#confirmationRevertNo").click(function(){
					//
				});
			}
		});
		
		
	});
	
	$("#hapusproyek").on('click',function() {
		toastr.warning("<div align='center'><br><button type='button' id='confirmationRevertYes' class='btn btn-info'>Ya</button> <button type='button' id='confirmationRevertNo' class='btn btn-danger'>Tidak</button></div>",'Apakah anda yakin ingin menghapus data?',
		{
			closeButton: false,
			allowHtml: true,
			onShown: function (toast) {
				$("#confirmationRevertYes").click(function(){
					var arr = [];
					var table = $('#tabelproyek').DataTable();
					var terpilih = $(table.rows('.selected').nodes());
					$.each(terpilih, function (idx, value) {
						arr.push($(value).data('sim'));
					});
					
					if(arr.length > 0){
						$.post("adminpage/control/proyek.php", {
							arrID : arr,
							metode : 'hapus'
						}, function(data){
							toastr.success('Data berhasil dihapus. Halaman akan direfresh.');
							setTimeout(function(){ location.reload(); }, 2000);
						});
					}else{
						toastr.warning('Anda belum memilih baris yang ingin dihapus!')
					}
				});
				$("#confirmationRevertNo").click(function(){
					//
				});
			}
		});
		
		
	});
})

$(document).on('click', '[data-toggle="lightbox"]', function(event) {
  event.preventDefault();
  $(this).ekkoLightbox({
	alwaysShowClose: true
  });
});

$("#simpanpengguna").on('click',function() {
	var aktif = 0;
	if ($('#aktif').is(":checked"))
	{
		aktif = 1;
	}
	var namalengkap = $("#namalengkap").val(), 
	namapengguna = $("#namapengguna").val(), 
	password = $("#password").val(), 
	email = $("#email").val(),
	kodepegawai = $("#kodepegawai").val(),
	alamat = $("#alamat").val(),
	jk = $("#jeniskelamin").val(),
	hakakses = $("#hakakses").val(),
	tempid = $("#tempid").val();
	if(namalengkap != '' && namapengguna != '' && email != '' && jk != '' && hakakses != ''){
		$.post("./adminpage/control/pengguna.php", {
			namalengkap1 : namalengkap,
			namapengguna1 : namapengguna,
			password1 : password,
			email1 : email,
			kodepegawai1 : kodepegawai,
			alamat1 : alamat,
			jk1 : jk,
			hakakses1 : hakakses, 
			tempid1 : tempid,
			aktif1 : aktif,
			metode : 'simpan'
		}, function(data){
			if(data=='1'){
				toastr.success('Akun pengguna berhasil disimpan. Halaman akan direfresh.');
				setTimeout(function(){ location.reload(); }, 2000);
			}else if(data=='0'){
				toastr.error('Mohon maaf nama pengguna telah terpakai, silahkan gunakan yang lainnya.');
			}
		});
	}else{
		$('#modal-tambah-pengguna').animate({ scrollTop: 0 }, 'slow');
		toastr.warning('Isian dan pilihan tidak boleh kosong.');
	}
});

$("#tabelpengguna").on( "click", 'tbody tr .editpengguna', function() {
	var identitas = $(this).data('sim');
	$('#tempid').val(identitas);
	$.post("adminpage/control/pengguna.php", {
		id : identitas,
		metode : 'dapatkan'
	}, function(data){
		$('#namalengkap').val(data[0].namalengkap);
		$('#namapengguna').val(data[0].namapengguna);
		$('#email').val(data[0].email);
		$('#kodepegawai').val(data[0].kodepegawai);
		$('#alamat').val(data[0].alamat);
		$('#jeniskelamin').val(data[0].jk);
		$('#hakakses').val(data[0].hakakses);
		$('#modal-tambah-pengguna').modal('toggle');
		if(data[0].aktif=='1'){
			$("#aktif").prop('checked', true);
		}else if(data[0].aktif=='0'){
			$("#aktif").prop('checked', false);
		}
	});
});

function segarkanForm(iki){
    iki.find('input:text').val('');
	iki.find('input:hidden').val('');
	iki.find('input:password').val('');
	iki.find('select').val('');
	iki.find('textarea').val('');
}

$("#modal-tambah-pengguna").on("hidden.bs.modal", function () {
	segarkanForm($(this));
});

$('#tabelpelanggan').DataTable({
	"pagingType": "full_numbers",
	select: {
		style: 'multi'
	},
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

$('#tabeljenis').DataTable({
	"pagingType": "full_numbers",
	select: {
		style: 'multi'
	},
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

$('#tabelperuntukan').DataTable({
	"pagingType": "full_numbers",
	select: {
		style: 'multi'
	},
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

$('#tabelsyarat').DataTable({
	"pagingType": "full_numbers",
	select: {
		style: 'multi'
	},
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

$('#tabelbank').DataTable({
	"pagingType": "full_numbers",
	select: {
		style: 'multi'
	},
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

$('#tabelproyekpembayaran').DataTable({
	"pagingType": "full_numbers",
	select: {
		style: 'multi'
	},
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

$('#tabelkasmasuk').DataTable({
	"pagingType": "full_numbers",
	select: {
		style: 'multi'
	},
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

$('#tabelproyeksurvei').DataTable({
	"pagingType": "full_numbers",
	select: {
		style: 'multi'
	},
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

$('#tabelproyekteknis').DataTable({
	"pagingType": "full_numbers",
	select: {
		style: 'multi'
	},
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

$('#tabelproyeksidang').DataTable({
	"pagingType": "full_numbers",
	select: {
		style: 'multi'
	},
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

$('#tabelhistoryupdate').DataTable({
	"pagingType": "full_numbers",
	select: {
		style: 'multi'
	},
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

function makeResponsiveInvoice(){
	
	$('#tabelinvoice').DataTable({
		"pagingType": "full_numbers",
		select: {
			style: 'multi'
		},
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
}

function makeResponsiveKwitansi(){
	
	$('#tabelkwitansi').DataTable({
		"pagingType": "full_numbers",
		select: {
			style: 'multi'
		},
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
}

$("#provinsi").change(function() {
	$("#kota").empty();
	$("#kota").append('<option value="" selected>None</option>');
	var prov = $(this).val();
	Pace.restart();
	Pace.track(function () {
		$.post("adminpage/control/pelanggan.php", {
			prov1 : prov,
			metode : 'getkota'
		}, function(data) {
			$.each(data, function(){
				$("#kota").append('<option value="'+ this.nama +'">'+ this.nama +'</option>');
			});
			Pace.stop();
		});
	});
});

$("#provinsiku").change(function() {
	$("#kotaku").empty();
	$("#kotaku").append('<option value="" selected>None</option>');
	var prov = $(this).val();
	Pace.restart();
	Pace.track(function () {
		$.post("adminpage/control/pelanggan.php", {
			prov1 : prov,
			metode : 'getkota'
		}, function(data) {
			$.each(data, function(){
				$("#kotaku").append('<option value="'+ this.nama +'">'+ this.nama +'</option>');
			});
			Pace.stop();
		});
	});
});

$("#simpanpelanggan").on('click',function() {
	var nilaiopsi = '';
	$('.opsipelanggan').each(function(){
		if($(this).hasClass('active')){
			nilaiopsi = $(this).data('nilai');
		}
	});
	
	if(nilaiopsi == '1'){
		var data = $("#form-perorangan").serializeArray();
	}else if(nilaiopsi == '0'){
		var data = $("#form-nonperorangan").serializeArray();
	}
	
	data.push({name: "opsi", value: nilaiopsi});
	data.push({name: "metode", value: 'simpan'});
	
	Pace.restart();
	Pace.track(function () {
		$.post("adminpage/control/pelanggan.php", data, function(data) {
			if(data == '0'){
				toastr.error('Sori! Username / Email / NIK sudah terpakai gan.','Waduh!');
			}else if(data == '1'){
				toastr.success('Hore! Berhasil disimpan. Halaman akan direfresh.','Yay!');
				setTimeout(function(){ location.reload(); }, 2000);
			}
			Pace.stop();
		});
	});
});

$("#tabelpelanggan").on( "click", 'tbody tr .editpelanggan', function() {
	var identitas = $(this).data('sim');
	Pace.restart();
	Pace.track(function () {
		$.post("adminpage/control/pelanggan.php", {
			id : identitas,
			metode : 'dapatkan'
		}, function(data){
			if(data['perorangan'] == '1'){
				$('#tempid').val(data['kode']);
				$('#namapemilik').val(data['namapemilik']);
				$('#username').val(data['username']);
				$('#mail').val(data['email']);
				$('#nik').val(data['nik']);
				$('#alamat').val(data['alamat']);
				$("#kota").empty();
				$("#kota").append('<option value="">None</option>');
				$("#kota").append('<option value="' + data['kota'] + '" selected>' + data['kota'] + '</option>');
				$('#jeniskelamin').val(data['jk']);
				$('#hp').val(data['hp']);
				$('#keterangan').val(data['keterangan']);
			}else if(data['perorangan'] == '0'){
				$('#tempidku').val(data['kode']);
				$('#namadirektur').val(data['namadirektur']);
				$('#namauser').val(data['username']);
				$('#email').val(data['email']);
				$('#namaperusahaan').val(data['namaperusahaan']);
				$('#noakta').val(data['noakta']);
				$('#alamatku').val(data['alamat']);
				$("#kotaku").empty();
				$("#kotaku").append('<option value="">None</option>');
				$("#kotaku").append('<option value="' + data['kota'] + '" selected>' + data['kota'] + '</option>');
				$('#jeniskelaminku').val(data['jk']);
				$('#hpku').val(data['hp']);
				$('#keteranganku').val(data['keterangan']);
			}
			
			$('.opsipelanggan').each(function(){
				if($(this).data('nilai') == data['perorangan']){
					$(this).click();
				}
			});
			
			$('#modal-tambah-pelanggan').modal('toggle');
			Pace.stop();
		});
	});
});

$("#simpanjenis").on('click',function() {
	var nama = $('#namajenis').val(), ket = $('#keteranganjenis').val(),temp = $('#tempidjenis').val();
	Pace.restart();
	Pace.track(function () {
		$.post("adminpage/control/jenis.php", {
			temp1 : temp,
			nama1 : nama,
			ket1 : ket,
			metode : 'simpanjenis'
		}, function(data){
			if(data == '1'){
				toastr.success('Hore! Berhasil disimpan. Halaman akan direfresh.','Yay!');
				setTimeout(function(){ location.reload(); }, 2000);
				Pace.stop();
			}
		});
	});
});

$("#tabeljenis").on( "click", 'tbody tr .editjenis', function() {
	var identitas = $(this).data('sim');
	Pace.restart();
	Pace.track(function () {
		$.post("adminpage/control/jenis.php", {
			id : identitas,
			metode : 'dapatkanjenis'
		}, function(data){
			$('#tempidjenis').val(data['kode']);
			$('#namajenis').val(data['nama']);
			$('#keteranganjenis').val(data['keterangan']);
			Pace.stop();
			$('#modal-tambah-jenis').modal('toggle');
		});
	});
});

$("#simpanperuntukan").on('click',function() {
	var nama = $('#namaperuntukan').val(), ket = $('#keteranganperuntukan').val(),temp = $('#tempidperuntukan').val();
	Pace.restart();
	Pace.track(function () {
		$.post("adminpage/control/jenis.php", {
			temp1 : temp,
			nama1 : nama,
			ket1 : ket,
			metode : 'simpanperuntukan'
		}, function(data){
			if(data == '1'){
				toastr.success('Hore! Berhasil disimpan. Halaman akan direfresh.','Yay!');
				setTimeout(function(){ location.reload(); }, 2000);
				Pace.stop();
			}
		});
	});
});

$("#tabelperuntukan").on( "click", 'tbody tr .editperuntukan', function() {
	var identitas = $(this).data('sim');
	Pace.restart();
	Pace.track(function () {
		$.post("adminpage/control/jenis.php", {
			id : identitas,
			metode : 'dapatkanperuntukan'
		}, function(data){
			$('#tempidperuntukan').val(data['kode']);
			$('#namaperuntukan').val(data['nama']);
			$('#keteranganperuntukan').val(data['keterangan']);
			Pace.stop();
			$('#modal-tambah-peruntukan').modal('toggle');
		});
	});
});

$("#simpansyarat").on('click',function() {
	var nama = $('#nama').val(), ket = $('#keterangan').val(),temp = $('#tempid').val();
	Pace.restart();
	Pace.track(function () {
		$.post("adminpage/control/syarat.php", {
			temp1 : temp,
			nama1 : nama,
			ket1 : ket,
			metode : 'simpan'
		}, function(data){
			if(data == '1'){
				toastr.success('Hore! Berhasil disimpan. Halaman akan direfresh.','Yay!');
				setTimeout(function(){ location.reload(); }, 2000);
				Pace.stop();
			}
		});
	});
});

$("#tabelsyarat").on( "click", 'tbody tr .editsyarat', function() {
	var identitas = $(this).data('sim');
	Pace.restart();
	Pace.track(function () {
		$.post("adminpage/control/syarat.php", {
			id : identitas,
			metode : 'dapatkan'
		}, function(data){
			$('#tempid').val(data['kode']);
			$('#nama').val(data['nama']);
			$('#keterangan').val(data['keterangan']);
			Pace.stop();
			$('#modal-tambah-syarat').modal('toggle');
		});
	});
});

$("#simpanbank").on('click',function() {
	var namapemilik = $('#namapemilik').val(), norek = $('#norek').val(),temp = $('#tempid').val(), namabank = $('#namabank').val(), cabang = $('#cabang').val();
	Pace.restart();
	Pace.track(function () {
		$.post("adminpage/control/bank.php", {
			temp1 : temp,
			namapemilik1 : namapemilik,
			norek1 : norek,
			namabank1 : namabank,
			cabang1 : cabang,
			saldo : $("#saldo").val().replace(/,/g, ''),
			metode : 'simpan'
		}, function(data){
			if(data == '1'){
				toastr.success('Hore! Berhasil disimpan. Halaman akan direfresh.','Yay!');
				setTimeout(function(){ location.reload(); }, 2000);
				Pace.stop();
			}
		});
	});
});

$("#tabelbank").on( "click", 'tbody tr .editbank', function() {
	var identitas = $(this).data('sim');
	Pace.restart();
	Pace.track(function () {
		$.post("adminpage/control/bank.php", {
			id : identitas,
			metode : 'dapatkan'
		}, function(data){
			$('#tempid').val(data['kode']);
			$('#namapemilik').val(data['namapemilik']);
			$('#norek').val(data['norek']);
			$('#namabank').val(data['namabank']);
			$('#cabang').val(data['cabang']);
			$('#saldo').val(data['saldo']);
			Pace.stop();
			$('#modal-tambah-bank').modal('toggle');
		});
	});
});

function segarkanForm(){
    $('.modal').find('input:text').val('');
	$('.modal').find('input:hidden').val('');
	$('.modal').find('textarea').val('');
	$('.opsipelanggan').each(function(){
		if($(this).data('nilai') == '1'){
			$(this).click();
		}
	});
	$('.modal').find('tabel tbody').empty();
	$('.modal').find('.datepicker').datepicker({
		autoclose: true,
		format: 'yyyy-mm-dd'
	});
	$('.modal').find('.datepicker').datepicker('setDate', 'today');
}

$("#simpanproyek").on('click',function() {
	toastr.success("<div align='center'><br><button type='button' id='confirmationRevertYes' class='btn btn-info'>Ya</button> <button type='button' id='confirmationRevertNo' class='btn btn-danger'>Tidak</button></div>",'Apakah anda yakin ingin menyimpan data?',
	{
		closeButton: false,
		allowHtml: true,
		onShown: function (toast) {
			$("#confirmationRevertYes").click(function(){
				var nama = $('#nama').val(),noproyek = $('#noproyek').val(),tglpengajuan = $('#tglpengajuan').val(),lokasi = $('#lokasi').val(),kota = $('#kota').val(),pelanggan = $('#pelanggan').val(),jenis = $('#jenis').val(),peruntukan = $('#peruntukan').val(),ketperuntukan = $('#keteranganperuntukan').val(),lamakerja = $('#lamakerja').val(),tglmulaikerja = $('#tglmulaikerja').val(),tglselesaikerja = $('#tglselesaikerja').val(),biaya = $('#biaya').val().replace(/,/g, ''),termin = $('#termin').val(),ket = $('#keterangan').val(),tempid = $('#tempid').val();
				/* var itemsurvei = 'Tidak Ada';
				if ($('#itemsurvei').is(":checked"))
				{
					itemsurvei = 'Ada';
				} */
				var suratandalalin = 'Tidak Ada';
				if ($('#suratandalalin').is(":checked"))
				{
					suratandalalin = 'Ada';
				}
				var suratkuasa = 'Tidak Ada';
				if ($('#suratkuasa').is(":checked"))
				{
					suratkuasa = 'Ada';
				}
				
				var arrIdSyarat = [];
				var arrSyaratNoDokumen = [];
				var arrSyaratLetakFile = [];
				var arrSyaratKeterangan = [];
				var passed = true;
				
				$('.syaratnodokumen').each (function() {
					arrIdSyarat.push($(this).data('id'));
				});
				
				$('.syaratnodokumen').each (function() {
					arrSyaratNoDokumen.push($(this).val());
					if($(this).val() == ''){
						passed = false;
					}
				});
				
				$('.syaratletakfile').each (function() {
					arrSyaratLetakFile.push($(this).val());
				});
				
				$('.syaratketerangan').each (function() {
					arrSyaratKeterangan.push($(this).val());
				});
				
				if(passed == true){
					Pace.restart();
					Pace.track(function () {
						$.post("adminpage/control/proyek.php", {
							tempid1 : tempid,
							nama1 : nama,
							noproyek1 : noproyek,
							tglpengajuan1 : tglpengajuan,
							lokasi1 : lokasi,
							kota1 : kota,
							pelanggan1 : pelanggan,
							jenis1 : jenis,
							peruntukan1 : peruntukan,
							ketperuntukan1 : ketperuntukan,
							lamakerja1 : lamakerja,
							tglmulaikerja1 : tglmulaikerja,
							tglselesaikerja1 : tglselesaikerja,
							biaya1 : biaya,
							termin1 : termin,
							ket1 : ket,
							suratandalalin1 : suratandalalin,
							suratkuasa1 : suratkuasa,
							arrIdSyarat1 : arrIdSyarat,
							arrSyaratNoDokumen1 : arrSyaratNoDokumen,
							arrSyaratLetakFile1 : arrSyaratLetakFile,
							arrSyaratKeterangan1 : arrSyaratKeterangan,
							metode : 'simpan'
						}, function(data){
							if(data == '1'){
								toastr.success('Hore! Berhasil disimpan. Halaman akan direfresh.','Yay!');
								setTimeout(function(){ location.reload(); }, 2000);
								Pace.stop();
							}
						});
					});
				}else{
					toastr.error('Mohon maaf! Nomor dokumen syarat ada yang belum diisi.');
				}
			});
			$("#confirmationRevertNo").click(function(){
				//
			});
		}
	});
	
	
});

$("#tabelproyek").on( "click", 'tbody tr .ubahstatus', function() {
	var identitas = $(this).data('sim');
	$('#tempkodeproyek').val(identitas);
	Pace.restart();
	Pace.track(function () {
		$.post("adminpage/control/proyek.php", {
			id : identitas,
			metode : 'ubahstatus'
		}, function(data){
			$("#image"). attr("src", "");
			
			var qrcode = new QrCodeWithLogo({
				image: document.getElementById("image"),
				content: data['noproyek'],
				width: 150,
				//   download: true,
				logo: {
				  src: "dist/images/cropped-logo-192x192.jpeg"
				}
			});

			qrcode.toImage();
			
			$('#nomorproyekubah').html('#'+data['noproyek']);
			$('#statusproyek').val(data['status']);
			$('#statussyarat').html(data['syarat']);
			$('#statusbayar').html(data['bayar']);
			$('#statussurvei').html(data['survei']);
			$('#statussidang').html(data['sidang']);
			Pace.stop();
			$('#modal-tambah-ubahstatus').modal('toggle');
		});
	});
});

$("#tabelproyek").on( "click", 'tbody tr .editproyek', function() {
	var identitas = $(this).data('sim');
	Pace.restart();
	Pace.track(function () {
		$.post("adminpage/control/proyek.php", {
			id : identitas,
			metode : 'dapatkan'
		}, function(data){
			$('#nama').val(data['nama']);
			$('#noproyek').val(data['noproyek']);
			$('#tglpengajuan').val(data['tglpengajuan']);
			$('#lokasi').val(data['lokasi']);
			$("#kota").empty();
			$("#kota").append('<option value="">None</option>');
			$("#kota").append('<option value="' + data['kota'] + '" selected>'+ data['kota'] +'</option>');
			$('#pelanggan').val(data['pelanggan']).trigger("change");
			$('#jenis').val(data['jenis']).trigger("change");
			$('#peruntukan').val(data['peruntukan']).trigger("change");
			$('#keteranganperuntukan').val(data['keteranganperuntukan']);
			$('#lamakerja').val(data['lamakerja']);
			$('#tglmulaikerja').val(data['tglmulaikerja']);
			$('#tglselesaikerja').val(data['tglselesaikerja']);
			$('#biaya').val(data['biaya']);
			$('#termin').val(data['termin']);
			$('#keterangan').val(data['keterangan']);
			$('#tempid').val(data['kode']);
			
			var i = 0;
			$('.syaratnodokumen').each (function() {
				$(this).val(data['arrSyarat'][i]['NO_DOKUMEN']);
				i++;
			});
			
			i = 0;
			$('.syaratletakfile').each (function() {
				$(this).val(data['arrSyarat'][i]['LETAK_FILE']);
				i++;
			});
			
			i = 0;
			$('.syaratketerangan').each (function() {
				$(this).val(data['arrSyarat'][i]['KETERANGAN']);
				i++;
			});
			
			Pace.stop();
			$('#modal-tambah-proyek').modal('toggle');
		});
	});
});

$("#tabelproyekpembayaran").on( "click", 'tbody tr .editinvoice', function() {
	var identitas = $(this).data('sim');
	$('#kodeproyek').val(identitas);
	Pace.restart();
	Pace.track(function () {
		$.post("adminpage/control/pembayaran.php", {
			id : identitas,
			metode : 'dapatkan-invoice'
		}, function(data){
			$('#tabelinvoice').DataTable().clear().destroy();
			
			if(data.length > 0){
				$('#tabelinvoice tbody').empty();
				for(var i=0;i < data.length;i++){
					$('#tabelinvoice tbody').append('<tr><td class="text-right">' + parseInt(i+1)+'.' + '</td><td>' + data[i]['NO_INVOICE'] + '</td><td>' + data[i]['TGL_INVOICE'] + '</td><td class="text-center">' + Math.round((parseInt(data[i]['NOMINAL'])/parseInt(data[i]['TOTAL']))*100) + '%</td><td>' + Math.round(data[i]['NOMINAL']).toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.") + '</td><td><button class="btn btn-warning btn-sm cetakinvoice" data-sim="' + data[i]['KODE'] + '"><i class="fas fa-print"></i></button></td><td><button class="btn btn-danger btn-sm hapusinvoice" data-sim="' + data[i]['KODE'] + '"><i class="far fa-trash-alt"></i></button></td></tr>');
				}
			}
			
			makeResponsiveInvoice();
			Pace.stop();
			$('#modal-tambah-invoice').modal('toggle');
		});
	});
});

$("#tabelproyekpembayaran").on( "click", 'tbody tr .editkwitansi', function() {
	var identitas = $(this).data('sim');
	Pace.restart();
	Pace.track(function () {
		$.post("adminpage/control/pembayaran.php", {
			id : identitas,
			metode : 'dapatkan-kwitansi'
		}, function(data){
			
			$('#tabelkwitansi').DataTable().clear().destroy();
			
			if(data.length > 0){
				$('#tabelkwitansi tbody').empty();
				for(var i=0;i < data.length;i++){
					$('#tabelkwitansi tbody').append('<tr><td class="text-right">' + parseInt(i+1)+'.' + '</td><td>' + data[i]['NO_INVOICE'] + '</td><td>' + data[i]['TGL_INVOICE'] + '</td><td>' + data[i]['NO_KWITANSI'] + '</td><td>' + data[i]['TGL_BAYAR'] + '</td><td class="text-center"><button class="btn btn-info btn-sm tambahkwitansi" data-sim="' + data[i]['KODE'] + '" data-inv="' + data[i]['NO_INVOICE'] + '"><i class="fas fa-plus-circle"></i></button></td><td class="text-center"><button class="btn btn-primary btn-sm cetakkwitansi" data-sim="' + data[i]['KODE'] + '"><i class="fas fa-print"></i></button></td></tr>');
				}
			}
			
			makeResponsiveKwitansi();
			Pace.stop();
			$('#modal-tambah-kwitansi').modal('toggle');
		});
	});
});

$("#tabelproyekpembayaran").on( "click", 'tbody tr .lihatproyek', function() {
	var identitas = $(this).data('sim');
	Pace.restart();
	Pace.track(function () {
		$.post("adminpage/control/pembayaran.php", {
			id : identitas,
			metode : 'lihatproyek'
		}, function(data){
			$('#detailproyek').html(data);
			Pace.stop();
			$('#modal-tambah-detail').modal('toggle');
		});
	});
});

$("#tabelproyeksurvei").on( "click", 'tbody tr .lihatproyek', function() {
	var identitas = $(this).data('sim');
	Pace.restart();
	Pace.track(function () {
		$.post("adminpage/control/pembayaran.php", {
			id : identitas,
			metode : 'lihatproyek'
		}, function(data){
			$('#detailproyek').html(data);
			Pace.stop();
			$('#modal-tambah-detail').modal('toggle');
		});
	});
});

$("#tabelproyeksidang").on( "click", 'tbody tr .lihatproyek', function() {
	var identitas = $(this).data('sim');
	Pace.restart();
	Pace.track(function () {
		$.post("adminpage/control/pembayaran.php", {
			id : identitas,
			metode : 'lihatproyek'
		}, function(data){
			$('#detailproyek').html(data);
			Pace.stop();
			$('#modal-tambah-detail').modal('toggle');
		});
	});
});

$("#tabelproyekteknis").on( "click", 'tbody tr .lihatproyek', function() {
	var identitas = $(this).data('sim');
	Pace.restart();
	Pace.track(function () {
		$.post("adminpage/control/pembayaran.php", {
			id : identitas,
			metode : 'lihatproyek'
		}, function(data){
			$('#detailproyek').html(data);
			Pace.stop();
			$('#modal-tambah-detail').modal('toggle');
		});
	});
});

$("#tabelkwitansi").on( "click", 'tbody tr .tambahkwitansi', function() {
	var kd = $(this).data('sim');
	$('#kodeproyekku').val(kd);
	$('#bayarinvoice').text($(this).data('inv'));
});

$("#simpankwitansi").on('click',function() {
	var kd = $('#kodeproyekku').val(),nokwitansi = $('#nokwitansi').val(),terimadari = $('#terimadari').val(),tglbayar = $('#tglkwitansi').val();
	if(nokwitansi != ''){
		Pace.restart();
		Pace.track(function () {
			$.post("adminpage/control/pembayaran.php", {
				kd1 : kd,
				nokwitansi1 : nokwitansi,
				terimadari1 : terimadari,
				tglbayar1 : tglbayar,
				metode : 'simpankwitansi'
			}, function(data){
				toastr.success('Hore! Berhasil disimpan. Halaman akan direfresh.','Yay!');
				$.post("adminpage/control/cetak.php", {
					kd1 : kd,
					metode : 'cetakkwitansi'
				}, function (dt) {
					var w = window.open('about:blank');
					w.document.open();
					w.document.write(dt);
					w.document.close();
				});
				setTimeout(function(){ location.reload(); }, 2000);
			});
		});
	}
});

$("#simpaninvoice").on('click',function() {
	var kd = $('#kodeproyek').val(), noinvoice = $('#noinvoice').val(), bank = $('#bank').val(), tglinvoice = $('#tglinvoice').val(), nominal = $('#nominal').val().replace(/,/g, ''), bayarke = $('#bayarke').val(), keterangan = $('#keterangan').val();
	if(noinvoice != ''){
		Pace.restart();
		Pace.track(function () {
			$.post("adminpage/control/pembayaran.php", {
				kd1 : kd,
				noinvoice1 : noinvoice,
				bank1 : bank,
				tglinvoice1 : tglinvoice,
				nominal1 : nominal,
				bayarke1 : bayarke,
				keterangan1 : keterangan,
				metode : 'simpaninvoice'
			}, function(data){
				toastr.success('Hore! Berhasil disimpan. Halaman akan direfresh.','Yay!');
				$.post("adminpage/control/cetak.php", {
					kd1 : data,
					metode : 'cetakinvoice'
				}, function (dt) {
					var w = window.open('about:blank');
					w.document.open();
					w.document.write(dt);
					w.document.close();
				});
				setTimeout(function(){ location.reload(); }, 2000);
			});
		});
	}
});

$("#tabelinvoice").on( "click", 'tbody tr .cetakinvoice', function() {
	var kd = $(this).data('sim');
	$.post("adminpage/control/cetak.php", {
		kd1 : kd,
		metode : 'cetakinvoice'
	}, function (data) {
		var w = window.open('about:blank');
		w.document.open();
		w.document.write(data);
		w.document.close();
	});
});

$("#tabelkwitansi").on( "click", 'tbody tr .cetakkwitansi', function() {
	var kd = $(this).data('sim');
	$.post("adminpage/control/cetak.php", {
		kd1 : kd,
		metode : 'cetakkwitansi'
	}, function (data) {
		var w = window.open('about:blank');
		w.document.open();
		w.document.write(data);
		w.document.close();
	});
});

$("#tabelinvoice").on( "click", 'tbody tr .hapusinvoice', function() {
	var kd = $(this).data('sim');
	toastr.error("<div align='center'><br><button type='button' id='confirmationRevertYes' class='btn btn-info'>Ya</button> <button type='button' id='confirmationRevertNo' class='btn btn-danger'>Tidak</button></div>",'Apakah anda yakin ingin menghapus data?',
	{
		closeButton: false,
		allowHtml: true,
		onShown: function (toast) {
			$("#confirmationRevertYes").click(function(){
				Pace.restart();
				Pace.track(function () {
					$.post("adminpage/control/pembayaran.php", {
						kd1 : kd,
						metode : 'hapusinvoice'
					}, function (data) {
						Pace.stop();
						toastr.success('Invoice berhasil dihapus. Halaman akan direfresh.');
						setTimeout(function(){ location.reload(); }, 2000);
					});
				});
			});
			
			$("#confirmationRevertNo").click(function(){
				//
			});
		}
	});
});

$("#tabelsurvei").on( "click", 'tbody tr .hapussurvei', function() {
	var kd = $(this).data('sim');
	toastr.error("<div align='center'><br><button type='button' id='confirmationRevertYes' class='btn btn-info'>Ya</button> <button type='button' id='confirmationRevertNo' class='btn btn-danger'>Tidak</button></div>",'Apakah anda yakin ingin menghapus data?',
	{
		closeButton: false,
		allowHtml: true,
		onShown: function (toast) {
			$("#confirmationRevertYes").click(function(){
				Pace.restart();
				Pace.track(function () {
					$.post("adminpage/control/survei.php", {
						kd1 : kd,
						metode : 'hapus'
					}, function (data) {
						Pace.stop();
						toastr.success('Survei berhasil dihapus. Halaman akan direfresh.');
						setTimeout(function(){ location.reload(); }, 2000);
					});
				});
			});
			
			$("#confirmationRevertNo").click(function(){
				//
			});
		}
	});
});

$("#tabelteknis").on( "click", 'tbody tr .hapusteknis', function() {
	var kd = $(this).data('sim');
	toastr.error("<div align='center'><br><button type='button' id='confirmationRevertYes' class='btn btn-info'>Ya</button> <button type='button' id='confirmationRevertNo' class='btn btn-danger'>Tidak</button></div>",'Apakah anda yakin ingin menghapus data?',
	{
		closeButton: false,
		allowHtml: true,
		onShown: function (toast) {
			$("#confirmationRevertYes").click(function(){
				Pace.restart();
				Pace.track(function () {
					$.post("adminpage/control/teknis.php", {
						kd1 : kd,
						metode : 'hapus'
					}, function (data) {
						Pace.stop();
						toastr.success('Data berhasil dihapus. Halaman akan direfresh.');
						setTimeout(function(){ location.reload(); }, 2000);
					});
				});
			});
			
			$("#confirmationRevertNo").click(function(){
				//
			});
		}
	});
});

$("#tabelproyeksurvei").on( "click", 'tbody tr .editsurvei', function() {
	var identitas = $(this).data('sim');
	$('#kodeproyek').val(identitas);
	Pace.restart();
	Pace.track(function () {
		$.post("adminpage/control/survei.php", {
			id : identitas,
			metode : 'dapatkan'
		}, function(data){
			
			if(data.length > 0){
				$('#tabelsurvei tbody').empty();
				for(var i=0;i < data.length;i++){
					$('#tabelsurvei tbody').append('<tr><td class="text-right">' + parseInt(i+1)+'.' + '</td><td>' + data[i]['SURVEYOR'] + '</td><td>' + data[i]['TGL_MULAI'] + '</td><td>' + data[i]['TGL_SELESAI'] + '</td><td>' + data[i]['KETERANGAN'] + '</td><td class="text-center"><button class="btn btn-danger btn-sm hapussurvei" data-sim="' + data[i]['KODE'] + '"><i class="far fa-trash-alt"></i></button></td></tr>');
				}
			}
			
			Pace.stop();
			$('#modal-tambah-survei').modal('toggle');
		});
	});
});

$("#tabelproyekteknis").on( "click", 'tbody tr .editteknis', function() {
	var identitas = $(this).data('sim');
	$('#kodeproyek').val(identitas);
	Pace.restart();
	Pace.track(function () {
		$.post("adminpage/control/teknis.php", {
			id : identitas,
			metode : 'dapatkan'
		}, function(data){
			
			if(data.length > 0){
				$('#tabelteknis tbody').empty();
				for(var i=0;i < data.length;i++){
					$('#tabelteknis tbody').append('<tr><td class="text-right">' + parseInt(i+1)+'.' + '</td><td>' + data[i]['NO_DOKUMEN'] + '</td><td>' + data[i]['TGL_MULAI'] + '</td><td>' + data[i]['TGL_SELESAI'] + '</td><td>' + data[i]['KETERANGAN'] + '</td><td class="text-center"><button class="btn btn-danger btn-sm hapusteknis" data-sim="' + data[i]['KODE'] + '"><i class="far fa-trash-alt"></i></button></td></tr>');
				}
			}
			
			Pace.stop();
			$('#modal-tambah-teknis').modal('toggle');
		});
	});
});

$("#simpansurvei").on('click',function() {
	var kd = $('#kodeproyek').val(),surveyor = $('#surveyor').val(),tglmulai = $('#tglmulaisurvei').val(), tglselesai = $('#tglselesaisurvei').val(), keterangan = $('#keterangan').val(),letakfile = $('#letakfile').val();
	var itemsurvei = 'Tidak Ada';
	if ($('#itemsurvei').is(":checked"))
	{
		itemsurvei = 'Ada';
	}
	if(surveyor != ''){
		Pace.restart();
		Pace.track(function () {
			$.post("adminpage/control/survei.php", {
				kd1 : kd,
				surveyor1 : surveyor,
				tglmulai1 : tglmulai,
				tglselesai1 : tglselesai,
				letakfile1 : letakfile,
				itemsurvei1 : itemsurvei,
				keterangan1 : keterangan,
				metode : 'simpan'
			}, function(data){
				toastr.success('Hore! Berhasil disimpan. Halaman akan direfresh.','Yay!');
				Pace.stop();
				setTimeout(function(){ location.reload(); }, 2000);
			});
		});
	}
});

$("#simpanteknis").on('click',function() {
	var kd = $('#kodeproyek').val(),nodokumen = $('#nodokumen').val(),tglmulai = $('#tglmulaiteknis').val(), tglselesai = $('#tglselesaiteknis').val(), keterangan = $('#keterangan').val(),letakfile = $('#letakfile').val();
	if(nodokumen != ''){
		Pace.restart();
		Pace.track(function () {
			$.post("adminpage/control/teknis.php", {
				kd1 : kd,
				nodokumen1 : nodokumen,
				tglmulai1 : tglmulai,
				tglselesai1 : tglselesai,
				letakfile1 : letakfile,
				keterangan1 : keterangan,
				metode : 'simpan'
			}, function(data){
				toastr.success('Hore! Berhasil disimpan. Halaman akan direfresh.','Yay!');
				Pace.stop();
				setTimeout(function(){ location.reload(); }, 2000);
			});
		});
	}
});

$("#statusproyek").change(function() {
	var nilai = $(this).val(), kode = $('#tempkodeproyek').val();
	Pace.restart();
	Pace.track(function () {
		$.post("adminpage/control/proyek.php", {
			nilai1 : nilai,
			kode1 : kode,
			metode : 'ubahstatusproyek'
		}, function(data) {
			toastr.success('Hore! Berhasil diubah. Halaman akan direfresh.','Yay!');
			Pace.stop();
			setTimeout(function(){ location.reload(); }, 2000);
		});
	});
});

$("#tabelproyeksidang").on( "click", 'tbody tr .editsidang', function() {
	var identitas = $(this).data('sim');
	$('#kodeproyek').val(identitas);
	Pace.restart();
	Pace.track(function () {
		$.post("adminpage/control/sidangdishub.php", {
			id : identitas,
			metode : 'dapatkan'
		}, function(data){
			
			if(data.length > 0){
				$('#tabelsidang tbody').empty();
				for(var i=0;i < data.length;i++){
					$('#noantri').val(data[i]['NO_PENDAFTARAN_SIDANG']);
					$('#nosurat').val(data[i]['NO_SURAT_REKOMENDASI']);
					$('#tglmulaisidang').val(data[i]['TGL_MULAI']);
					$('#tglselesaisidang').val(data[i]['TGL_SELESAI']);
					$('#letakfile').val(data[i]['LETAK_FILE']);
					$('#keterangan').val(data[i]['KETERANGAN']);
					$('#tabelsidang tbody').append('<tr><td class="text-right">' + parseInt(i+1)+'.' + '</td><td>' + data[i]['NO_PENDAFTARAN_SIDANG'] + '</td><td>' + data[i]['NO_SURAT_REKOMENDASI'] + '</td><td>' + data[i]['TGL_MULAI'] + '</td><td>' + data[i]['TGL_SELESAI'] + '</td><td>' + data[i]['KETERANGAN'] + '</td><td class="text-center"><button class="btn btn-danger btn-sm hapussidang" data-sim="' + data[i]['KODE'] + '"><i class="far fa-trash-alt"></i></button></td></tr>');
				}
			}
			
			Pace.stop();
			$('#modal-tambah-sidang').modal('toggle');
		});
	});
});

$("#simpansidang").on('click',function() {
	var kd = $('#kodeproyek').val(),noantri = $('#noantri').val(),nosurat = $('#nosurat').val(),tglmulai = $('#tglmulaisidang').val(), tglselesai = $('#tglselesaisidang').val(), keterangan = $('#keterangan').val(),letakfile = $('#letakfile').val();
	if(kd != ''){
		Pace.restart();
		Pace.track(function () {
			$.post("adminpage/control/sidangdishub.php", {
				kd1 : kd,
				noantri1 : noantri,
				nosurat1 : nosurat,
				tglmulaiku : tglmulai,
				tglselesaiku : tglselesai,
				letakfile1 : letakfile,
				keterangan1 : keterangan,
				metode : 'simpan'
			}, function(data){
				toastr.success('Hore! Berhasil disimpan. Halaman akan direfresh.','Yay!');
				Pace.stop();
				setTimeout(function(){ location.reload(); }, 2000);
			});
		});
	}
});

$("#tampil").on('click',function() {
	var laporan = $('#opsilaporan').val(),tampilan = $("input[name='tampilan']:checked").val(), tglawal = $('#tglawal').val(), tglakhir = $('#tglakhir').val();
	Pace.restart();
	Pace.track(function () {
		$.post("adminpage/control/laporan.php", {
			laporan1 : laporan,
			tampilan1 : tampilan,
			tglawal1 : tglawal,
			tglakhir1 : tglakhir,
			metode : 'tampil'
		}, function(data){
			$('#laporanhasil').html(data);
			Pace.stop();
			/* $('html, body').animate({
				scrollTop: $('#laporanhasil').offset().top,
			},1000,'linear'); */
		});
	});
});

$('#cetak').on("click", function () {
  $('#laporanhasil').printThis({
	base: "/victoryapp/"
  });
});

$('#cetakqr').on("click", function () {
  $('#detailubahproyek').printThis({
	base: "/victoryapp/"
  });
});

$("#simpandatabase").on('click',function() {
	toastr.warning("<div align='center'><br><button type='button' id='confirmationRevertYes' class='btn btn-info'>Ya</button> <button type='button' id='confirmationRevertNo' class='btn btn-danger'>Tidak</button></div>",'Apakah anda yakin ingin mengupload database? Data lama akan dihapus.',
	{
		closeButton: false,
		allowHtml: true,
		onShown: function (toast) {
			$("#confirmationRevertYes").click(function(){
				var input = document.getElementById("dbfile");
				file = input.files[0];
				//if(file != undefined){
				formData= new FormData();
				//if(!!file.type.match(/image.*/)){
				formData.append("sqlfile", file);
				formData.append("metode", "dbupload");
				
				Pace.restart();
				Pace.track(function () {
					$.ajax({
					url: "adminpage/control/update.php",
					type: "POST",
					data: formData,
					processData: false,
					contentType: false,
					success: function(data){
						if(data == '1'){
							toastr.success('Hore! Database berhasil diupload. Halaman akan direfresh.','Yay!');
							setTimeout(function(){ location.reload(); }, 2000);
						}else{
							toastr.error('Upload gagal, silahkan coba beberapa saat lagi.','Maaf!');
						}
						Pace.stop();
					}
					});
				});
			});
			$("#confirmationRevertNo").click(function(){
				//
			});
		}
	});
});

$("#downloaddatabase").on('click',function() {
	Pace.restart();
	Pace.track(function () {
		$.post("adminpage/control/update.php", {
			metode : 'download'
		}, function(data){
			var w = window.open('about:blank');
			w.document.open();
			w.document.write(data);
			w.document.close();
			Pace.stop();
		});
	});
});

$("#simpankaskeluar").on('click',function() {
	var kaskecil = 0;
	if ($('#kaskecil').is(':checked')){
		kaskecil = 1;
	}
	
	var input = document.getElementById("gambar");
	file = input.files[0];
	//if(file != undefined){
	formData= new FormData();
	//if(!!file.type.match(/image.*/)){
	formData.append("image", file);
	formData.append("tempid", $("#tempid").val());
	formData.append("untuk", $("#untuk").val());
	formData.append("kaskecil", kaskecil);
	formData.append("tgl", $("#tgltransaksi").val());
	formData.append("bank", $("#bank").val());
	formData.append("banktujuan", $("#banktujuan").val());
	formData.append("nominal", $("#nominal").val().replace(/,/g, ''));
	formData.append("keterangan", $("#keterangan").val());
	formData.append("gambarold", $("#gambar1").val());
	formData.append("metode", "simpan");
	
	Pace.restart();
	Pace.track(function () {
		$.ajax({
		url: "adminpage/control/kaskeluar.php",
		type: "POST",
		data: formData,
		processData: false,
		contentType: false,
		success: function(data){
			toastr.success('Hore! Berhasil disimpan. Halaman akan direfresh.','Yay!');
			Pace.stop();
			setTimeout(function(){ location.reload(); }, 2000);
		}
		});
	});
});

$("#simpankaskeluarkecil").on('click',function() {
	
	var input = document.getElementById("gambar");
	file = input.files[0];
	//if(file != undefined){
	formData= new FormData();
	//if(!!file.type.match(/image.*/)){
	formData.append("image", file);
	formData.append("tempid", $("#tempid").val());
	formData.append("untuk", $("#untuk").val());
	formData.append("tgl", $("#tgltransaksi").val());
	formData.append("bank", $("#bank").val());
	formData.append("nominal", $("#nominal").val().replace(/,/g, ''));
	formData.append("keterangan", $("#keterangan").val());
	formData.append("gambarold", $("#gambar1").val());
	formData.append("metode", "simpan");
	
	Pace.restart();
	Pace.track(function () {
		$.ajax({
		url: "adminpage/control/kaskeluarkecil.php",
		type: "POST",
		data: formData,
		processData: false,
		contentType: false,
		success: function(data){
			toastr.success('Hore! Berhasil disimpan. Halaman akan direfresh.','Yay!');
			Pace.stop();
			setTimeout(function(){ location.reload(); }, 2000);
		}
		});
	});
});

$("#tabelkaskeluar").on( "click", 'tbody tr .editduitkeluar', function() {
	var id = $(this).data('sim');
	$('#tempid').val(id);
	
	Pace.restart();
	Pace.track(function () {
		$.post("adminpage/control/kaskeluar.php", {
			id1 : id,
			metode : 'tampil'
		}, function(data){
			$('#untuk').val(data[0]['untuk']);
			$('#bank').val(data[0]['bank']);
			$('#tgltransaksi').val(data[0]['tgl']);
			$('#nominal').val(data[0]['nominal']);
			$('#gambar1').val(data[0]['bukti']);
			$('#keterangan').val(data[0]['keterangan']); 
			$('#modal-tambah-kaskeluar').modal('toggle');
			Pace.stop();
		});
	});
});

$("#tabelkaskeluarkecil").on( "click", 'tbody tr .editduitkeluar', function() {
	var id = $(this).data('sim');
	$('#tempid').val(id);
	
	Pace.restart();
	Pace.track(function () {
		$.post("adminpage/control/kaskeluarkecil.php", {
			id1 : id,
			metode : 'tampil'
		}, function(data){
			$('#untuk').val(data[0]['untuk']);
			$('#bank').val(data[0]['bank']);
			$('#tgltransaksi').val(data[0]['tgl']);
			$('#nominal').val(data[0]['nominal']);
			$('#gambar1').val(data[0]['bukti']);
			$('#keterangan').val(data[0]['keterangan']); 
			$('#modal-tambah-kaskeluar').modal('toggle');
			Pace.stop();
		});
	});
});

$("#tabelkaskeluar").on( "click", 'tbody tr .showImage', function() {
	var url = 'dist/images/kaskeluar/' + $(this).text(),
	image = new Image();
	image.src = url;
	image.onload = function () {
		$('#image-holder').empty().append(image);
	};
	image.onerror = function () {
		$('#image-holder').empty().html('That image is not available.');
	}

	$('#image-holder').empty().html('Loading...');
});

$("#tabelkaskeluarkecil").on( "click", 'tbody tr .showImage', function() {
	var url = 'dist/images/kaskeluarkecil/' + $(this).text(),
	image = new Image();
	image.src = url;
	image.onload = function () {
		$('#image-holder').empty().append(image);
	};
	image.onerror = function () {
		$('#image-holder').empty().html('That image is not available.');
	}

	$('#image-holder').empty().html('Loading...');
});

	$("#hapuskaskeluar").on('click',function() {
		toastr.warning("<div align='center'><br><button type='button' id='confirmationRevertYes' class='btn btn-info'>Ya</button> <button type='button' id='confirmationRevertNo' class='btn btn-danger'>Tidak</button></div>",'Apakah anda yakin ingin menghapus data?',
		{
			closeButton: false,
			allowHtml: true,
			onShown: function (toast) {
				$("#confirmationRevertYes").click(function(){
					var arr = [];
					var arrImg = [];
					var table = $('#tabelkaskeluar').DataTable();
					var terpilih = $(table.rows('.selected').nodes());
					$.each(terpilih, function (idx, value) {
						arr.push($(value).data('sim'));
						arrImg.push($(value).data('img'));
					});
					
					if(arr.length > 0){
						$.post("adminpage/control/kaskeluar.php", {
							arrID : arr,
							arrImg1 : arrImg,
							metode : 'hapus'
						}, function(data){
							toastr.success('Data berhasil dihapus. Halaman akan direfresh.');
							setTimeout(function(){ location.reload(); }, 2000);
						});
					}else{
						toastr.warning('Anda belum memilih baris yang ingin dihapus!')
					}
				});
				$("#confirmationRevertNo").click(function(){
					//
				});
			}
		});
	});
	
	$("#hapuskaskeluarkecil").on('click',function() {
		toastr.warning("<div align='center'><br><button type='button' id='confirmationRevertYes' class='btn btn-info'>Ya</button> <button type='button' id='confirmationRevertNo' class='btn btn-danger'>Tidak</button></div>",'Apakah anda yakin ingin menghapus data?',
		{
			closeButton: false,
			allowHtml: true,
			onShown: function (toast) {
				$("#confirmationRevertYes").click(function(){
					var arr = [];
					var arrImg = [];
					var table = $('#tabelkaskeluarkecil').DataTable();
					var terpilih = $(table.rows('.selected').nodes());
					$.each(terpilih, function (idx, value) {
						arr.push($(value).data('sim'));
						arrImg.push($(value).data('img'));
					});
					
					if(arr.length > 0){
						$.post("adminpage/control/kaskeluarkecil.php", {
							arrID : arr,
							arrImg1 : arrImg,
							metode : 'hapus'
						}, function(data){
							toastr.success('Data berhasil dihapus. Halaman akan direfresh.');
							setTimeout(function(){ location.reload(); }, 2000);
						});
					}else{
						toastr.warning('Anda belum memilih baris yang ingin dihapus!')
					}
				});
				$("#confirmationRevertNo").click(function(){
					//
				});
			}
		});
	});

$("#goscan").on('click',function() {
	let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
	scanner.addListener('scan', function (content) {
		//console.log(content);
		setTimeout(function() {
			$('#tabelproyek_wrapper').find('input[type="search"]').val(content).trigger("keyup");
			$('#modal-tambah-scanqr').modal('toggle');
		}, 500);
	});
	Instascan.Camera.getCameras().then(function (cameras) {
		if (cameras.length > 0) {
		  scanner.start(cameras[0]);
		} else {
		  toastr.error('Sori! Kamera tidak ditemukan.','Waduh!');
		}
	}).catch(function (e) {
		 toastr.error(e,'Waduh!');
	});
});

$("#ceksinkronisasi").on('click',function() {
	Pace.restart();
	Pace.track(function () {
		toastr.warning("Sinkronisasi sedang berjalan. Harap menunggu.","Mohon tunggu!",{timeOut: 0,extendedTimeOut: 0});
		$.post("sync.php", {
			metode : 'update'
		}, function(data){
			$('.card-body').html(data);
			toastr.remove();
			toastr.success('Sinkronisasi berhasil, halaman akan direfresh.');
			setTimeout(function(){ location.reload(); }, 3000);
			Pace.stop();
		});
	});
});

$('.datepicker').datepicker({
	autoclose: true,
	format: 'yyyy-mm-dd'
});
$('.datepicker').datepicker('setDate', 'today');

$(".modal").on("hidden.bs.modal", function () {
    // put your default event here
    segarkanForm();
});

$("#modal-tambah-scanqr").on("hidden.bs.modal", function () {
    /* if (typeof scanner !== 'undefined') {
		scanner.stop();
	} */
	let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
	scanner.stop();
});


var refreshTime = 600000; // every 10 minutes in milliseconds
window.setInterval( function() {
	$.ajax({
		cache: false,
		type: "GET",
		url: "adminpage/control/refreshsession.php",
		success: function(data) {
		}
	});
}, refreshTime );

$("#kaskecil").change(function() {
	if ($(this).is(":checked"))
	{
		$('#untuk').val('Isi kas kecil dari kas besar');
		$('#tujuanbank').removeClass('d-none');
	}else{
		$('#untuk').val('');
		$('#tujuanbank').addClass('d-none');
	}
});