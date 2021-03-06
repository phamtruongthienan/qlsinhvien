var app = app || {};

app.init = function () {

	$(document).on('shown.bs.tab', 'a[data-toggle="tab"]', function (e) {
    	$.fn.dataTable.tables({ visible: true, api: true }).columns.adjust();
	});

	var table_dynamic_level = $('.table-dynamic-level').DataTable({
		"processing": true, 
        "serverSide": true,
		"ajax": "http://localhost:8080/quanlysinhvien/public/ajax/khoa",
		'responsive': true,
		'paging': true,
		'lengthChange': true,
		'searching': true,
		'ordering': true,
		'info': true,
		'autoWidth': true,
		'scrollX': true,
		'scrollCollapse': true,
		"columns": [
			{"data": "MaKhoa"},
			{"data": "TenKhoa"},
			{"data": "action"}
		],
		'columnDefs': [
			{
				targets: [1],
				class: 'text-ellipsis'
			},
			{
				width: '100px',
				targets: [0],
				class: 'text-center'
			},
			{
				width: '200px',
				targets: [-1],
                orderable: false,
				class: 'text-center'
			}
		]		
	});

	$('#LevelForm').validator().on('submit', function (e) {
		$('#LevelBtn').button('loading');
		$('.alert').addClass('no-display');
		if (!e.isDefaultPrevented()) {
			e.preventDefault();
            app.LevelFormSubmit(table_dynamic_level);
		} else {
			$('#LevelBtn').button('reset');
		}
	});

	$(document).on('click', '.table-action-delete', function (e) {
		e.preventDefault();
        var id = $(this).data('id');
        $('#confirm-delete-modal #id').val(id);
		$('#confirm-delete-modal').modal({
				backdrop: 'static',
				keyboard: false
		});
	});

    $('#confirm-delete-modal').on('click', '#confirm-delete', function (e) {
        $('#confirm-delete-modal #confirm-delete').button('loading');
        var id = $('#confirm-delete-modal #id').val();
        app.DeleteLevel(id, table_dynamic_level);
    });

	$(document).on('click', '.table-action-edit, #modal-level .tab_edit_level', function (e) {
		e.preventDefault();
        // $('#LevelForm #name').prop('required',false);
        // $('#LevelForm').validator('validate');
        // $('#LevelForm #name').prop('required',true);
        // $('#modal-level').modal('show');
        app.ClearFormLevel('update');
        var id = $(this).attr('data-id');
        app.LoadKhoa(id);
	});

	$(document).on('click', '#addLevel', function (e) {
		e.preventDefault();
        // $('#LevelForm')[0].reset();
        // var lang = $(this).attr('data-lang');
        app.ClearFormLevel('add');
		$('#modal-level .tab_edit_course').attr('data-id', 'null')
		$('#modal-level').modal('show');
	});

	$(document).on('click', '#LevelBtn', function (e) {
		e.preventDefault();
		$('#LevelForm').submit();
	});
}

app.ClearFormLevel = function(type) {
    $('#modal-level #addMaKhoa').val("");
    $('#modal-level #addTenKhoa').val("");
    $('#modal-level #id').val("");
    if (type == "add") {
        $('#modal-level .nav-tabs').hide();
        $('#modal-level #ttlModal').html('Thêm khoa mới');
        $('#modal-level #action').val('insert');
    } else {
        $('#modal-level .nav-tabs').show();
        $('#modal-level #ttlModal').html('Cập nhật khoa');
        $('#modal-level #action').val('update');
    }
    $('#modal-level ul > li').removeClass('active');
    $('#modal-level #name').val('');
}

app.LevelFormSubmit = function(table) {
    $.ajax({
        url: "http://localhost:8080/quanlysinhvien/public/ajax/khoa",
        type: "post",
        data: $('#LevelForm').serialize(),
        success: function(response) {
			if (response.code == '200') {
                Lobibox.notify("success", {
                    title: 'Thông báo',
                    pauseDelayOnHover: true,
                    continueDelayOnInactiveTab: false,
                    icon: false,
                    sound: false,
                    msg: response.msg
                });
                table.ajax.reload(null, true);
                $('#modal-level').modal('hide');
            } else {
                Lobibox.notify("warning", {
                    title: 'Thông báo',
                    pauseDelayOnHover: true,
                    continueDelayOnInactiveTab: false,
                    icon: false,
                    sound: false,
                    msg: "Thất bại"
                });
            }
            $('#LevelBtn').button('reset');
        },
        error: function(jqXHR, textStatus, errorThrown) {
            Lobibox.notify("warning", {
                title: 'Thông báo',
                pauseDelayOnHover: true,
                continueDelayOnInactiveTab: false,
                icon: false,
                sound: false,
                msg: 'Có lỗi trong quá trình xử lý'
            });
            $('#LevelBtn').button('reset');
        }
    });
}

app.LoadKhoa = function(id) {
    $.ajax({
        url: "http://localhost:8080/quanlysinhvien/public/ajax/getkhoa?id=" + id,
        type: "get",
        success: function(response) {
            if (response.code == '200') {
                $('#modal-level #id').val(response.data.MaKhoa);
                $('#modal-level .tab_edit_level').attr('data-id', response.data.MaKhoa);
                $('#modal-level #addMaKhoa').val(response.data.MaKhoa);
                $('#modal-level #addTenKhoa').val(response.data.TenKhoa);
                $('#modal-level').modal('show');
            } else {
                Lobibox.notify("warning", {
                    title: 'Thông báo',
                    pauseDelayOnHover: true,
                    continueDelayOnInactiveTab: false,
                    icon: false,
                    sound: false,
                    msg: "response.msg"
                });
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            Lobibox.notify("warning", {
                title: 'Thông báo',
                pauseDelayOnHover: true,
                continueDelayOnInactiveTab: false,
                icon: false,
                sound: false,
                msg: response.msg
            });
        }
    });
};

app.DeleteLevel = function(id, table) {
    $.ajax({
        url: "http://localhost:8080/quanlysinhvien/public/ajax/khoa?action=delete&id=" + id,
        type: "post",
        success: function(response) {
            if (response.code == '200') {
                Lobibox.notify("success", {
                    title: 'Thông báo',
                    pauseDelayOnHover: true,
                    continueDelayOnInactiveTab: false,
                    icon: false,
                    sound: false,
                    msg: response.msg
                });
                table.ajax.reload(null, true);
            } else {
                Lobibox.notify("warning", {
                    title: 'Thông báo',
                    pauseDelayOnHover: true,
                    continueDelayOnInactiveTab: false,
                    icon: false,
                    sound: false,
                    msg: response.msg
                });
            }
            $('#confirm-delete-modal #confirm-delete').button('reset');
            $('#confirm-delete-modal').modal('hide');
        },
        error: function(jqXHR, textStatus, errorThrown) {
            Lobibox.notify("warning", {
                title: 'Thông báo',
                pauseDelayOnHover: true,
                continueDelayOnInactiveTab: false,
                icon: false,
                sound: false,
                msg: 'Có lỗi trong quá trình xử lý'
            });
            $('#confirm-delete-modal #confirm-delete').button('reset');
            $('#confirm-delete-modal').modal('hide');
        }
    });
}

$(function() {
	app.init();
});