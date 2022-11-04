if (typeof(Storage) !== "undefined") {
  // Code for localStorage/sessionStorage.
} else {
  // Sorry! No Web Storage support..
  alert('Sorry! No Web Storage support..');
}

$(function () {
	$('#form-login').on('submit', function(e){
        e.preventDefault();
        $.ajax({
			type: 'post',
			url: 'process/doLogin.php',
			data: $(this).serialize(),
			success: function (anu) {
				if(anu == '1'){
					toastr.success('Berhasil login! Tunggu sebentar..')
					setTimeout(function(){ location.reload(); }, 2000);
				}else if(anu == '0'){
					toastr.error('Password yang anda masukkan salah!')
				}else if(anu == '-1'){
					$.notify("", "error");
					toastr.error('Username tidak ditemukan!')
				}
			}
		});
    });
});