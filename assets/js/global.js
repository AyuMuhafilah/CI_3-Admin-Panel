$(document).ready(function () {
	initial();
});

/**
 * Inisialisasi event untuk tag <a class="load-to-content>"
 */
function initial() {
	$('.load-to-content').off('click');
	$('.load-to-content').on('click', function (event) {
		event.preventDefault();
		let url = $(this).attr('href');
		loadContent(url, 'get');
	});

	// Ketika form di submit
	$('form.form-load-to-content').on('submit', function (event) {
		event.preventDefault();
		let url = $(this).attr('action');
		loadContent(url, 'post', new FormData(this));
	});
}

/**
 * Menjalankan request ke URL lalu meletakkan response ke dalam content
 * 
 * @param {string} url URL yang di targetkan
 * @param {string} method GET|HEAD|POST|PUT|PATCH|DELETE
 */
function loadContent(url, method, data = {}) {
	var xhr = new XMLHttpRequest(); // Ajax
	xhr.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) { // Ketika status 200 (success)
			$('#content').html(this.responseText);
			initial();
		} else { // Ketika gagal (error)
			console.log(this);
		}
	};
	xhr.open(method, url, false);
	xhr.setRequestHeader("X-Requested-With", 'XMLHttpRequest'); // Memberitahu server bahwa request di kirim melalui Ajax
	xhr.send(data);
}
