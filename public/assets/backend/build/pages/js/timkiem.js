var app = app || {};

app.init = function () {
	$(document).on('shown.bs.tab', 'a[data-toggle="tab"]', function (e) {
    	$.fn.dataTable.tables({ visible: true, api: true }).columns.adjust();
	});
   
    $(document).on('click', '.searchKhoa', function(e) {
        //var makhoa = $(this).val();
       
    
    });

    

    $("#searchKhoa").select2({
        placeholder: "Chọn Khoa",
        allowClear: true,
        delay: 250,
        ajax: {
            url: "http://localhost:8080/quanlysinhvien/public/testmodel",
            dataType: 'json',
            type: "GET",
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            text: item.TenKhoa,
                            value: item.MaKhoa,
                            id: item.MaKhoa
                        }
                    })
                };
            }
        }
    });


    // $(document).ready(function() {
    //     $('#searchKhoa').change(function(){
    //         alert($('#searchKhoa').select2());
    //     });
    // });
    $("#searchLop").select2({
        placeholder: "Chọn Lớp",
        allowClear: true,
        delay: 250,
        ajax: {
            url: "http://localhost:8080/quanlysinhvien/public/testmodel1",
            dataType: 'json',
            type: "GET",
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            text: item.TenLop,
                            value: item.MaLop,
                            id: item.MaLop
                        }
                    })
                };
            }
        }
    });
    
    // $("option[value='a000']").attr("disabled","disabled");
    // $("#a000").attr("disabled","disabled");
    // $("option[value='cntt']").attr("disabled","disabled");
    $(document).on('change', '#searchKhoa', function(e) {
        var makhoa = $("#searchKhoa").val();
        console.log("Hello world!2222 val: " + makhoa);
        $("#searchLop").select2({
            placeholder: "Chọn Lớp",
            allowClear: true,
            delay: 250,
            ajax: {
                url: "http://localhost:8080/quanlysinhvien/public/getloptheokhoa?id=" + makhoa,
                dataType: 'json',
                type: "GET",
                processResults: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                text: item.TenLop,
                                value: item.MaLop,
                                id: item.MaLop
                            }
                        })
                    };
                }
            }
        });
    });

    

    $(document).on('change', '#searchLop', function(e) {
        var malop = $("#searchLop").val();
        console.log("Hello world!2222 val: " + malop);
        //var u =$('.table-dynamic-level').remove();
        var table = $('.table-dynamic-level').DataTable();
        table.destroy();
        table_dynamic_level = $('.table-dynamic-level').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": "http://localhost:8080/quanlysinhvien/public/getsinhvientheolop?id=" + malop,
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
                {"data": "MaSV"},
                {"data": "HoTen"},
                {"data": "NgaySinh"},
                {"data": "GioiTinh"},
                {"data": "DiaChi"},
                {"data": "MaLop"},
                {"data": "action"}
            ],
            'columnDefs': [
                {
                    targets: [1],
                    class: 'text-ellipsis'
                },
                {
                    targets: [2,3,4,5],
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
    });
    
    
	

	$('#LevelForm').validator().on('submit', function (e) {
		$('#LevelBtn').button('loading');
		$('.alert').addClass('no-display');
		if (!e.isDefaultPrevented()) {
			e.preventDefault();
            app.LevelFormSubmit(table_dynamic_level);
            // table_dynamic_level.ajax.reload(null, true);
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
        app.LoadSinhVien(id);
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

app.ClearFormLevel = function( type) {
	// $('#modal-level #addMaSV').val("");
    // $('#modal-level #addTenSV').val("");
	// $('#modal-level #id').val("");
	// $('#modal-level #addNgaySinh').val("");
    // $('#modal-level #addGioiTinh').iCheck('uncheck');
	// $('#modal-level #addDiaChi').val("");
    // $('#modal-level #addMaLop').val("");
	$('#LevelForm')[0].reset();
    if (type == "add") {
        $('#modal-level .nav-tabs').hide();
        $('#modal-level #ttlModal').html('Thêm Sinh viên mới');
        $('#modal-level #action').val('insert');
    } else {
        $('#modal-level .nav-tabs').show();
        $('#modal-level #ttlModal').html('Cập nhật sinh viên');
        $('#modal-level #action').val('update');
    }
    $('#modal-level ul > li').removeClass('active');
    $('#modal-level #name').val('');
}

app.LevelFormSubmit = function(table) {
    $.ajax({
        url: "http://localhost:8080/quanlysinhvien/public/ajax/sinhvien",
        type: "post",
        data: $('#LevelForm').serialize(),
        success: function(response) {
			$('#LevelBtn').button('reset');
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
                    msg: response.msg
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
                msg: 'Có lỗi trong quá trình xử lý'
			});
			$('#LevelBtn').button('reset');
			
        }
    });
}

app.LoadSinhVien = function(id) {
    $.ajax({
        url: "http://localhost:8080/quanlysinhvien/public/ajax/getsinhvien?id=" + id,
        type: "get",
        success: function(response) {
            if (response.code == '200') {
                $('#modal-level #id').val(response.data.MaSV);
                $('#modal-level .tab_edit_level').attr('data-id', response.data.MaSV);
                $('#modal-level #addMaSV').val(response.data.MaSV);
				$('#modal-level #addTenSV').val(response.data.HoTen);
				$('#modal-level #addNgaySinh').val(response.data.NgaySinh);
				if(response.data.GioiTinh == 1)
					$('#modal-level #sexMale').iCheck('check');
				else
                	$('#modal-level #sexFemale').iCheck('check');
                $('#modal-level #addDiaChi').val(response.data.DiaChi);
				$('#modal-level #addMaLop').val(response.data.MaLop).trigger('change');
				

				
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
        url: "http://localhost:8080/quanlysinhvien/public/ajax/sinhvien?action=delete&id=" + id,
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