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
		loadcontent(url, 'post');
	});
}

/**
 * Menjalankan request ke URL lalu meletakkan response ke dalam content
 * 
 * @param {string} url URL yang di targetkan
 * @param {string} method GET|HEAD|POST|PUT|PATCH|DELETE
 */
function loadcontent(url, method) {
	$.ajax({
		url: url,
		method: method,
		async: false,
		success: response => {
			$('#content').html(response);
			initial(); // Dilakukan inisialisasi kembali setelah content di load
		},
		error: error => {
			console.log(error);
		}
	});
}
