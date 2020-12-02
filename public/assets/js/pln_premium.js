$("#icon-show-password").click(function () {
	$("#icon").toggleClass("fa-eye-slash");
	const input = $("#password");
	if (input.attr("type") === "password") {
		input.attr("type", "text");
		$(this).attr('data-original-title', 'Hide Password')
		$(this).attr('title', 'Hide Password')
	} else {
		input.attr("type", "password");
		$(this).attr('data-original-title', 'Show Password')
		$(this).attr('title', 'Show Password')
	}
})

$(document).ready(function () {
	$(".input-group > input").focus(function (e) {
		$(this).parent().addClass("input-group-focus");
	}).blur(function (e) {
		$(this).parent().removeClass("input-group-focus");
	});
});


$('.btn-confirm-construct').on('click', function (e) {

	const href = $(this).attr('href');
	e.preventDefault();

	Swal.fire({
		title: 'Are you sure?',
		text: "You won't be able to revert this!",
		type: 'warning',
		padding: '1em',
		width: 300,
		showCancelButton: true,
		confirmButtonText: 'Yes, Go Construct!',
		cancelButtonText: `No, I'm not sure`,
		animation: false,
		buttonsStyling: false,
		customClass: {
			confirmButton: 'btn btn-primary btn-sm font-small',
			cancelButton: 'btn btn-secondary btn-sm ml-3 font-small',
			popup: 'animated tada'
		}
	}).then((result) => {
		if (result.value) {
			document.location.href = href;
		}
	});
});

$('.btn-confirm-energize').on('click', function (e) {

	const href = $(this).attr('href');
	e.preventDefault();

	Swal.fire({
		title: 'Are you sure?',
		text: "You won't be able to revert this!",
		type: 'warning',
		padding: '1em',
		width: 300,
		showCancelButton: true,
		confirmButtonText: 'Yes, Go Energize!',
		cancelButtonText: `No, I'm not sure`,
		animation: false,
		buttonsStyling: false,
		customClass: {
			confirmButton: 'btn btn-success btn-sm font-small',
			cancelButton: 'btn btn-secondary btn-sm ml-3 font-small',
			popup: 'animated tada'
		}
	}).then((result) => {
		if (result.value) {
			document.location.href = href;
		}
	});
});

$('.btn-delete-role').on('click', function (e) {

	const href = $(this).attr('href');
	e.preventDefault();

	Swal.fire({
		title: 'Are you sure?',
		text: "You won't be able to revert this!",
		type: 'warning',
		padding: '1em',
		width: 300,
		showCancelButton: true,
		confirmButtonText: 'Delete Role',
		cancelButtonText: `Cancel`,
		animation: false,
		buttonsStyling: false,
		customClass: {
			confirmButton: 'btn btn-primary btn-sm font-small',
			cancelButton: 'btn btn-secondary btn-sm ml-3 font-small',
			popup: 'animated tada'
		}
	}).then((result) => {
		if (result.value) {
			document.location.href = href;
		}
	});
});

$('.custom-file-input').on('change', function (e) {
	let fileName = $(this).val().split('\\').pop();
	let numFiles = e.target.files.length;

	if (numFiles > 1) {
		$(this).next('.custom-file-label').addClass("selected alert-info").removeClass("alert-danger").html(numFiles + " Files selected");
	} else if (numFiles == 1) {
		$(this).next('.custom-file-label').addClass("selected alert-info").removeClass("alert-danger").html(fileName);
	} else {
		$(this).next('.custom-file-label').addClass("selected alert-danger").html('No File Selected');
	}

});

function localizedDate(date) {
	return moment(date).locale('id').format('DD MMMM YYYY');
}

$('.btn-view-report').on('click', function (e) {
	e.preventDefault();
	let id_report = $(this).data('id');
	const url = $(this).data('url');
	const base_url = $(this).data('baseurl');
	$.ajax({
		type: "POST",
		url: `${url}/${id_report}`,
		// data: "data",
		dataType: "JSON",
		success: function (data) {
			$("td#data-date").text(localizedDate(data.data.date_report));
			$("td#data-time").text((data.data.start_time) + " - " + (data.data.end_time));
			$("td#data-user").text(data.data.name_customer);
			$("td#data-status").html(
				`<span class='badge ` + data.data.badge + `'>` + data.data.approval_status + `</span>`
			);
			$("td#data-description").html(
				`<p>` + data.data.description + `</p>`
			);

			$.each(data.images, function (k, v) {
				// console.log(v);
				let active_item = (k == 0) ? 'active' : '';
				let source = `${base_url}/${v.file_path}`;
				$('#carousel-item-image').append(
					`<div class="carousel-item ${active_item}"><img src="${source}" style="width: 100%; height: auto; aspect-ratio: 16/9;}" alt="item${k+1}">
                        </div>`
				);
				$('ol.carousel-indicators').append(
					`<li class="${active_item}" data-slide-to="${k}" data-target="#projectAsel">
                            <img alt="" src="${source}">
                        </li>`
				);
			});
		}
	});
});

$("#modalReport").on("hidden.bs.modal", function () {
	$("#carousel-item-image").html("");
	$("ol.carousel-indicators").html("");
});