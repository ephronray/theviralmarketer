function btc_send() {
	alert("Loading form...");
}


function btc_generate_qr_code(address) {
	var url = $("#url").val();
	var data_url = url + "requests/btc_forms.php?type=qr_code&address="+address;
	$.ajax({
		type: "POST",
		url: data_url,
		data: $("#btc_generate_qr_code").serialize(),
		dataType: "html",
		success: function (data) {
			$("#btc_qr_code").html(data);
		}
	});
}

function btc_new_address() {
	btc_create_modal("new_address");
	var url = $("#url").val();
	var data_url = url + "requests/btc_forms.php?type=new_address";
	$.ajax({
		type: "GET",
		url: data_url,
		dataType: "html",
		success: function (data) {
			$("#html_new_address_form").html(data);
			$("#modal_new_address").modal("show");
		}
	});
}

function btc_send_from_address(address_id) {
	btc_create_modal("send_from_address");
	var url = $("#url").val();
	var data_url = url + "requests/btc_forms.php?type=send_from_address&address_id="+address_id;
	$.ajax({
		type: "GET",
		url: data_url,
		dataType: "html",
		success: function (data) {
			$("#html_send_from_address").html(data);
			$("#modal_send_from_address").modal("show");
		}
	});
}

function btc_send_bitcoins(address) {
	var url = $("#url").val();
	var data_url = url + "requests/btc_submit_form.php?type=send_bitcoins&from_address="+address;
	$.ajax({
		type: "POST",
		url: data_url,
		data: $("#btc_from_send_bitcoins").serialize(),
		dataType: "json",
		success: function (data) {
			if(data.status == "success") {
				btc_refresh_addresses();
				$("#btc_send_from_address_results").html(data.msg);
				$("#btc_total").html(data.btc_total);
			} else {
				$("#btc_send_from_address_results").html(data.msg);
			}
		}
	});
}

function btc_receive_to_address(address_id) {
	btc_create_modal("receive_to_address");
	var url = $("#url").val();
	var data_url = url + "requests/btc_forms.php?type=receive_to_address&address_id="+address_id;
	$.ajax({
		type: "GET",
		url: data_url,
		dataType: "html",
		success: function (data) {
			$("#html_receive_to_address").html(data);
			$("#modal_receive_to_address").modal("show");
		}
	});
}

function btc_archive_address(address_id) {
	var url = $("#url").val();
	var data_url = url + "requests/btc_submit_form.php?type=archive_address&address_id="+address_id;
	$.ajax({
		type: "GET",
		url: data_url,
		dataType: "html",
		success: function (data) {
			$.notify({
				message: data
			});
			btc_refresh_addresses();
		}
	});
}

function btc_unarchive_address(address_id) {
	var url = $("#url").val();
	var data_url = url + "requests/btc_submit_form.php?type=unarchive_address&address_id="+address_id;
	$.ajax({
		type: "GET",
		url: data_url,
		dataType: "html",
		success: function (data) {
			$.notify({
				message: data
			});
			btc_refresh_all_addresses();
		}
	});
}

function btc_submit_new_address() {
	var url = $("#url").val();
	var data_url = url + "requests/btc_submit_form.php?type=new_address";
	$.ajax({
		type: "POST",
		url: data_url,
		data: $("#form_new_address").serialize(),
		dataType: "json",
		success: function (data) {
			if(data.status == "success") {
				btc_refresh_addresses();
				$("#html_new_address_results").html(data.msg);
				$("#modal_new_address").delay(5000).modal("hide");
			} else {
				$("#html_new_address_results").html(data.msg);
			}
		}
	});
}

function btc_create_modal(type) {
	var url = $("#url").val();
	var data_url = url + "requests/btc_create_modal.php?type="+type;
	$.ajax({
		type: "GET",
		url: data_url,
		dataType: "html",
		success: function (data) {
			$("#btc_modals").html(data);
		}
	});
}

function btc_refresh_addresses() {
	var url = $("#url").val();
	var data_url = url + "requests/btc_refresh_addresses.php";
	$.ajax({
		type: "GET",
		url: data_url,
		dataType: "html",
		success: function (data) {
			$("#btc_addresses").html(data);
		}
	});
}

function btc_refresh_all_addresses() {
	var url = $("#url").val();
	var data_url = url + "requests/btc_refresh_all_addresses.php";
	$.ajax({
		type: "GET",
		url: data_url,
		dataType: "html",
		success: function (data) {
			$("#btc_addresses").html(data);
		}
	});
}