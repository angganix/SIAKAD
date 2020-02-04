<style type="text/css">
	.table-form tr td {
		padding: 4px 8px !important;
		border: none !important;
	}

	.dataGrid tr td {
		font-size: 12px !important;
	}
</style>
<section class="content-header">
	<h1>
		Data Files
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-th"></i> Dashboard</a></li>
		<li class="active">Data Files</li>
	</ol>
</section>

<section class="content">
	<div class="box box-widget">
		<div class="box-header with-border">
			<h6 class="box-title">List File</h6>
			<div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool btnAdd" onclick="addNew();"><i class="fa fa-plus fa-fw"></i> Tambah</button>
			</div>
		</div>

		<div class="box-body">
			<div class="table-responsive">
				<table class="table table-responsive table-bordered table-hover dataGrid" id="dataGrid">
					<thead>
						<tr>
							<th style="text-align: left;width:16%;">Judul</th>
							<th style="text-align: left;width:22%;">Nama File</th>
							<th>Keterangan</th>
							<th style="text-align: center;width:7%">Aktif?</th>
							<th style="text-align: center;width:12%">Last Update</th>
							<th style="text-align: center;width:9%;">File</th>
							<th style="text-align: center;width:9%;"><i class="fa fa-gears fa-fw"></i></th>
						</tr>
					</thead>

					<tbody>

					</tbody>
				</table>
			</div>
		</div>
	</div>
</section>

<form action="" method="post" enctype="multipart/form-data" id="data_form">
	<div class="modal fade" id="modalForm">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><i class="fa fa-times fa-fw"></i></button>
					<h5 class="modal-title" id="modalTitle"></h5>
				</div>

				<div class="modal-body">
					<input type="hidden" id="act" name="act" value="save">
					<input type="hidden" id="txtId" name="id" value="0">

					<div class="row">
						<div class="col-md-5">
							<div class="form-group">
								<label class="small-label" for="judul">Judul</label>
								<input type="text" class="form-control input-sm" id="judul_file" name="judul_file" />
							</div>

							<div>
								<label class="small-label" for="document" style="margin-bottom: 15px !important;">File</label>
								<input type="file" name="file" id="file" />
							</div>
						</div>

					</div>
					<hr style="margin-top: 4px;margin-bottom: 10px;">
					<div class="row">
						<div class="col-md-12">
							<div style="margin-bottom: 10px;">
								<strong>Keterangan</strong>
							</div>
							<textarea class="document_editor" name="keterangan" id="keterangan"></textarea>
						</div>
					</div>
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-warning btn-sm" data-dismiss="modal"><i class="fa fa-times fa-fw"></i> Tutup</button>
					<button type="submit" class="btn btn-success btn-sm"><i class="fa fa-check fa-fw"></i> Simpan</button>
				</div>
			</div>
		</div>
	</div>
</form>

<script type="text/javascript">
	var tabel = $("#dataGrid").DataTable({
		processing: true,
		serverSide: true,
		paging: true,
		"ajax": {
			url: "controller/data_files.php",
			type: "post",
			data: {
				act: "getAll",
			}
		},
		columns: [{
				className: "strong-text",
				data: {
					judul: "judul_file",
					file_extension: "file_extension"
				},
				render: function(data) {

					if (data.file_extension === "") {
						return data.judul_file;
					} else {
						var color = "";

						if (data.file_extension === "docx" || data.file_extension === "doc") {
							color = "label-info";
						} else if (data.file_extension === "xlsx" || data.file_extension === "xls") {
							color = "label-success";
						} else if (data.file_extension === "pptx" || data.file_extension === "ppt") {
							color = "label-warning";
						} else {
							color = "label-default";
						}

						return data.judul_file + "<span class='pull-right label " + color + "' style='padding-bottom:4px;'>" + data.file_extension + "</span>";
					}


				}
			},
			{
				data: "nama_file"
			},
			{
				data: "keterangan"
			},
			{
				className: "centerCol",
				data: {
					is_active: "is_active",
					id_files: "id_files"
				},
				render: function(data) {
					var btn = "";

					if (data.is_active === "1") {
						btn += "<button type='button' class='btn btn-success btn-xs bg-green' onclick='changeStatus(" + data.id_files + ",0)'><i class='fa fa-check fa-fw'></i></button>";
					} else {
						btn += "<button type='button' class='btn btn-warning btn-xs bg-orange' onclick='changeStatus(" + data.id_files + ",1)'><i class='fa fa-times fa-fw'></i></button>";
					}

					return btn;

				}
			},
			{
				className: "centerCol",
				data: "time_updated"
			},
			{
				className: "centerCol",
				data: {
					file: "file",
					id: "id_files",
					file_id: "file_id",
					file_extension: "file_extension"
				},
				render: function(data) {

					if (data === "" || data === null || data.file_id === "" || data.file_extension === "") {
						return "<a class='btn btn-default btn-xs' style='background:#ddd;color:#444;' href='#'><i class='fa fa-eye fa-fw'></i> Kosong</a>";
					} else {
						var doc_type = "";
						if (data.file_extension === "docx" || data.file_extension === "doc") {
							doc_type = "document";
						} else if (data.file_extension === "xlsx" || data.file_extension === "xls") {
							doc_type = "spreadsheets";
						} else if (data.file_extension === "pptx" || data.file_extension === "ppt") {
							doc_type = "presentation";
						}

						var preview_file = "https://docs.google.com/" + doc_type + "/d/" + data.file_id + "/preview";
						var edit_file = "https://docs.google.com/" + doc_type + "/d/" + data.file_id + "/edit";

						return "<a class='btn btn-success btn-xs bg-green btn-file' href='" + preview_file + "' target='_blank'><i class='fa fa-eye fa-fw'></i></a> " +
							"<a class='btn btn-success btn-xs bg-blue btn-file' href='" + edit_file + "' target='_blank'><i class='fa fa-pencil fa-fw'></i></a> " +
							"<a style='display:none;' class='btn btn-success btn-xs bg-orange btn-file' href='#' onclick='deleteFiles(" + data.id + ",\"" + data.file_id + "\")'><i class='fa fa-times fa-fw'></i></a>";

					}

				}
			},
			{
				data: null,
				className: "centerCol",
				sortable: false,
				defaultContent: "<button type='button' class='btn btn-info btn-xs btnEdit'><i class='fa fa-pencil fa-fw'></i></button> <button type='button' class='btn btn-danger btn-xs btnDel'><i class='fa fa-trash fa-fw'></i></button>"
			}
		]
	});

	$("#dataGrid tbody").on("click", ".btnEdit", function() {
		var data = tabel.row($(this).parents("tr")).data();
		edit(data[0]);
	});

	$("#dataGrid tbody").on("click", ".btnDel", function() {
		var data = tabel.row($(this).parents("tr")).data();
		del(data[0]);
	});

	function changeStatus(id, state) {

		$.post("controller/data_files.php", {
			act: "changeStatus",
			id: id,
			is_active: state
		}, function(data) {
			if (data.status === true) {
				tabel.ajax.reload();
			} else {
				alert("Gagal mengubah status file");
			}
		}, "json");

	}

	function deleteFiles(id, file_id) {
		var confirmation = confirm("Yakin akan menghapus file ini ?");

		if (confirmation === true) {
			$.post("controller/delete_filedrive.php", {
				id: id,
				file_id: file_id
			}, function(data) {
				if (data.status === true) {
					alert("File berhasil di hapus");
					tabel.ajax.reload();
				} else if (data.status === "not_login") {
					window.open(data.callback_uri, "", "width=350,height=450");
				} else if (data.status === "gdrive_false") {
					window.open(data.callback_uri, "", "width=350,height=450");
				} else {
					alert("File Gagal di hapus");
				}
			}, "json");
		}

	}

	function resetField() {
		$("#txtId").val("0");
		$("#modalForm .form-control").val("");
		tinymce.activeEditor.setContent('');
		$("#judul_file").focus();
		$("#file").val("");
	}

	function addNew() {
		resetField();

		$("#modalTitle").html("<i class='fa fa-plus fa-fw'></i> Tambah Data");

		$("#modalForm").modal({
			backdrop: "static"
		});
	}


	function edit(id) {
		resetField();

		$.post("controller/data_files.php", {
			act: "getData",
			id: id
		}, function(data) {
			var dataSet = data.result[0];

			$("#txtId").val(dataSet.id_files);
			$("#judul_file").val(dataSet.judul_file);
			tinymce.activeEditor.setContent(dataSet.keterangan);

			$("#modalTitle").html("<i class='fa fa-pencil fa-fw'></i> Edit Data");

			$("#modalForm").modal({
				backdrop: "static"
			});

		}, "json");
	}

	function del(id) {
		var konfirmasi = confirm("Apakah yakin akan menghapus data ini ?");

		if (konfirmasi) {
			$.post("controller/data_files.php", {
				act: "del",
				id: id
			}, function(data) {
				if (data.status === true) {
					alert("Data berhasil di hapus");
					tabel.ajax.reload();
				} else if (data.status === "not_login") {
					window.open(data.callback_uri, "", "width=350,height=450");
				} else if (data.status === "gdrive_false") {
					window.open(data.callback_uri, "", "width=350,height=450");
				} else {
					alert("Data Gagal di hapus");
				}

			}, "json");
		}
	}

	$(document).ready(function() {
		$("#data_form").on("submit", function(e) {
			e.preventDefault();

			$.ajax({
				type: "post",
				url: "controller/data_files.php",
				cache: false,
				contentType: false,
				processData: false,
				data: new FormData(this),
				dataType: "json",
				beforeSend: function(){
					$(".loader").fadeIn(200);
				},
				success: function(data) {
					if (data.status === false) {
						if (data.error_code === "over_size") {
							alert("Maximal ukuran file yang dapat di upload adalah 5MB !");
						} else if (data.error_code === "invalid_extension") {
							alert("Dokumen yang boleh di upload adalah *.doc, *.docx, *.xls, *.xlsx, *.ppt, *.pptx");
						} else if (data.error_code === "fail_del_old_file") {
							alert("Gagal menghapus file lama");
						} else if (data.error_code === "failed_upload") {
							alert("Gagal melakukan upload file !");
						}
					} else if (data.status === "error_auth") {
						var confirm = window.open(data.callback_uri, "", "width=350,height=450");
						var timers  = setInterval(function(){
							if(confirm.closed){
								clearInterval(timers);
								$("#data_form").submit();
							}
						}, 1000);
					} else if (data.status === "not_login") {
						var confirm = window.open(data.callback_uri, "", "width=350,height=450");
						var timers  = setInterval(function(){
							if(confirm.closed){
								clearInterval(timers);
								$("#data_form").submit();
							}
						}, 1000);
					} else {
						$("#modalForm").modal("hide");
						alert("Data File berhasil di simpan");
						tabel.ajax.reload();
					}
					$(".loader").fadeOut(200);
				}
			});
		});
	});
</script>