<style type="text/css">
.table-form tr td{
	padding: 4px 8px !important;
	border: none !important;
}

.dataGrid tr td{
	font-size: 12px !important;
}
</style>
<section class="content-header">
	<h1>
		Data Pembelajaran Kelas
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-th"></i> Dashboard</a></li>
		<li class="active">Data Pembelajaran Kelas</li>
	</ol>
</section>

<section class="content">
	<div class="box box-widget">
		<div class="box-header with-border">
			<h6 class="box-title">List Pembelajaran Kelas</h6>
			<div class="box-tools pull-right">
				<button type="button" class="btn btn-primary btn-xs bg-orange" onclick="filterToggle()"><i class="fa fa-filter fa-fw"></i> Filter</button>
				<button type="button" class="btn btn-box-tool btnAdd" onclick="addNew();"><i class="fa fa-plus fa-fw"></i> Tambah</button>
			</div>
		</div>
		<div class="box-header with-border" id="box-filter" style="border-top: 1px solid #eee;display: none;">
				<div class="row">
						<div class="col-md-3">
								<select class="form-control input-sm select2" style="display: inline-block;" id="txtFilterKelas">
								</select>
						</div>
						<div class="col-md-3">
								<select class="form-control input-sm select2" id="txtFilterTelaah">
									<option value="-">- Pilih Status Telaah -</option>
									<option value="1">Sudah</option>
									<option value="0">Belum</option>
								</select>
						</div>
						<div class="col-md-3">
								<select class="form-control input-sm select2" style="display: inline-block;" id="txtFilterStatus">
									<option value="-">- Pilih Status -</option>
									<option value="cetak">Cetak</option>
									<option value="revisi">Revisi</option>
								</select>
						</div>
						<div class="col-md-3">
								<button type="button" class="btn btn-primary btn-sm bg-green" onclick="applyFilter();"><i class="fa fa-search fa-fw"></i> Apply Filter</button>
								<button type="button" class="btn btn-primary btn-sm bg-orange" onclick="resetFilter();"><i class="fa fa-refresh fa-fw"></i> Reset Filter</button>
						</div>
				</div>
		</div>

		<div class="box-body">
			<div class="table-responsive">
				<table class="table table-responsive table-bordered table-hover dataGrid" id="dataGrid">
					<thead>
						<tr>
							<th style="text-align: left;">Judul</th>
							<th style="text-align: center;width:9%">Th. Ajaran</th>
							<th style="text-align: center;width:16%">Wali Kelas</th>
							<th style="text-align: center;width:9%">Kelas</th>
							<th style="text-align: center;width:9%">Last Update</th>
							<th style="text-align: center;width:10%;">File</th>
							<th style="text-align: center;width:8%;">Telaah</th>
							<th style="text-align: center;width:8%;">Status</th>
							<th style="text-align: center;width:10%;"><i class="fa fa-gears fa-fw"></i></th>
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
								<select class="form-control input-sm select2" id="id_format" name="id_format" onchange="changeType();">
								</select>
							</div>

							<div class="form-group">
								<div id="type_opsi" hidden>
									<select class="form-control input-sm" name="format_value_opsi" id="format_value_opsi">
									</select>
								</div>

								<div id="type_text" hidden>
									<input type="text" class="form-control input-sm" name="format_value_text" id="format_value_text">
								</div>
							</div>

							<div class="form-group">
								<label class="small-label" for="kelas">Kelas</label>
								<select class="form-control input-sm select2" id="kelas" name="kelas"></select>
							</div>



						</div>

						<div class="col-md-5 pull-right">
							<div class="form-group">
								<label class="small-label" for="tahun_ajaran">Tahun Ajaran</label>
								<select class="form-control input-sm select2" id="tahun_ajaran" name="tahun_ajaran"></select>
							</div>
							<div class="form-group" style='display:none'>
								<input type="hidden" name="kurikulum" id="kurikulum" />
								<label class="small-label" for="kurikulum">Bidang Studi <strong>(Di isi untuk mapel bidang studi / Keterampilan)</strong></label>
								<select class="form-control input-sm select2" id="id_jurusan" name="id_jurusan"></select>
							</div>
							<div>
								<label class="small-label" for="document" style="margin-bottom: 15px !important;">File</label>
								<input type="file" name="document" id="document" />
							</div>
						</div>

					</div>
					<hr style="margin-top: 4px;margin-bottom: 10px;">
					<div class="row">
						<div class="col-md-12">
							<div style="margin-bottom: 10px;">
								<strong>Catatan Penelaah</strong>
							</div>
							<textarea class="document_editor" name="text_materi" id="text_materi"></textarea>
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

<!-- Modal Change Status -->
<div class="modal fade" id="modal-status">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modalt-title"><i class="fa fa-check fa-fw"></i> Status Pembelajaran</h4>
			</div>

			<div class="modal-body">
				<input type="hidden" id="txtId_status" value="0">
				<label>Status Pembelajaran</label>
				<select class="form-control input-sm" id="txtStatus">
					<option value="-">-</option>
					<option value="cetak">Cetak</option>
					<option value="revisi">Revisi</option>
				</select>
			</div>

			<div class="modal-footer">
				<button onclick="changeStatusPembelajaran()" type="button" class="btn btn-xs btn-success bg-green"><i class="fa fa-check fa-fw"></i> Simpan</button>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">

function applyFilter(){
	tabel.ajax.reload();
	filterToggle();
}

function resetFilter(){
	$("#txtFilterKelas").val("0").trigger("change");
	$("#txtFilterTelaah").val("-").trigger("change");
	$("#txtFilterStatus").val("-").trigger("change");
	filterToggle();
	tabel.ajax.reload();
}

function filterToggle() {
		$("#box-filter").slideToggle(200);
}

var tabel = $("#dataGrid").DataTable({
	processing: true,
	serverSide: true,
	paging: true,
	"ajax": {
		url: "controller/data_materi.php",
		type: "post",
		data: function(req){
			req.act = "getAll";
			req.kelas = $("#txtFilterKelas").val();
			req.is_ok = $("#txtFilterTelaah").val();
			req.status = $("#txtFilterStatus").val();
		}
	},
	columns: [
	{
		className: "strong-text",
		data: {
			judul: "judul",
			file_extension: "file_extension"
		},
		render: function(data){

			if(data.file_extension === ""){
				return data.judul;
			}else{
				var color = "";
				var ext   = data.file_extension === null ? "" : data.file_extension;

				if(data.file_extension === "docx" || data.file_extension === "doc"){
					color = "label-info";
				}else if(data.file_extension === "xlsx" || data.file_extension === "xls"){
					color = "label-success";
				}else if(data.file_extension === "pptx" || data.file_extension === "ppt"){
					color = "label-warning";
				}else{
					color = "label-default";
				}

				return data.judul+"<span class='pull-right label "+color+"' style='padding-bottom:4px;'>"+ext+"</span>";
			}


		}
	},
	{
		className: "centerCol",
		data: "tahun_ajaran"
	},
	{data: "wali_kelas"},
	{
		className: "centerCol",
		data: "nama_kelas"
	},
	{data: "last_edit"},
	{
		className: "centerCol",
		data: {
													file: "file",
													id: "id",
													file_id: "file_id",
													file_extension: "file_extension"
											},
											sortable: false,
		render: function(data){

			if(data.file === "" || data.file === null || data.file_id === "" || data.file_extension === ""){
				return "<a class='btn btn-default btn-xs' style='background:#ddd;color:#444;' href='#'><i class='fa fa-eye fa-fw'></i> Kosong</a>";
			}else{
				var doc_type = "";
				if(data.file_extension === "docx" || data.file_extension === "doc"){
					doc_type = "document";
				}else if(data.file_extension === "xlsx" || data.file_extension === "xls"){
					doc_type = "spreadsheets";
				}else if(data.file_extension === "pptx" || data.file_extension === "ppt"){
					doc_type = "presentation";
				}

				var preview_file = "https://docs.google.com/"+doc_type+"/d/"+data.file_id+"/preview";
				var edit_file = "https://docs.google.com/"+doc_type+"/d/"+data.file_id+"/edit";

				return "<a class='btn btn-success btn-xs bg-green btn-file' href='"+preview_file+"' target='_blank'><i class='fa fa-eye fa-fw'></i></a> "
							+"<a class='btn btn-success btn-xs bg-blue btn-file' href='"+edit_file+"' target='_blank'><i class='fa fa-pencil fa-fw'></i></a> "
							+"<a style='display:none;' class='btn btn-success btn-xs bg-orange btn-file' href='#' onclick='deleteFiles("+data.id+",\""+data.file_id+"\")'><i class='fa fa-times fa-fw'></i></a>";

			}

		}
	},
	{
		className: "centerCol",
		data: {
			is_ok: "is_ok",
			id: "id"
		},
		render: function(data){
			var states = "";

			if(data.is_ok === "1"){
				states += "<button type='button' class='btn btn-success btn-xs bg-green' onclick='changeState("+data.id+",0)'><i class='fa fa-check fa-fw'></i> Sudah</button>";
			}else{
				states += "<button type='button' class='btn btn-warning btn-xs bg-orange' onclick='changeState("+data.id+",1)'><i class='fa fa-times fa-fw'></i> Belum</button>";
			}

			return states;

		}
	},
	{
		className: "centerCol",
		data: "status",
		sortable: false,
		render: function(data){
			var stt = "";

			if(data === "-" || data === null){
				stt += "<button type='button' class='btn btn-default btn-xs bg-gray'>-</button>";
			}else if(data === "cetak"){
				stt += "<button type='button' class='btn btn-default btn-xs bg-green'>"+data+"</button>";
			}else if(data === "revisi"){
				stt += "<button type='button' class='btn btn-default btn-xs bg-orange'>"+data+"</button>";
			}

			return stt;

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

	$("#dataGrid tbody").on("click", ".btnEdit", function(){
		var data = tabel.row($(this).parents("tr")).data();
		edit(data[1]);
	});

	$("#dataGrid tbody").on("click", ".btnDel", function(){
		var data = tabel.row($(this).parents("tr")).data();
		del(data[1]);
	});

	function changeType(){
		var id = $("#id_format").val();

		if(id !== "0"){
			$.post("controller/format_materi.php",{
				act: "getData",
				id: id
			}, function(data){
				var dataSet = data.result[0];

				if(dataSet.tipe === "pilihan"){
					$("#type_opsi").show();
					$("#type_text").hide();
					var opsi_list = (dataSet.format_value).split(",");
					var lists = "";

					$(opsi_list).each(function(i, val){
						lists += "<option value='"+val+"'>"+val+"</option>";
					});

					$("#format_value_opsi").html(lists);
				}else if(dataSet.tipe === "text"){
					$("#type_opsi").hide();
					$("#type_text").show();
					$("#format_value_text").prop("placeholder", dataSet.format_value);
				}

			}, "json");
		}else{
			$("#type_opsi").hide();
			$("#type_text").hide();
		}


	}

	function deleteFiles(id, file_id){
		var confirmation = confirm("Yakin akan menghapus file ini ?");

		if(confirmation === true){
			$.post("controller/delete_filedrive.php",{
				id: id,
				file_id: file_id
			}, function(data){
					if(data.status === true){
						alert("File berhasil di hapus");
						tabel.ajax.reload();
					}else if(data.status === "not_login"){
						window.open(data.callback_uri, "", "width=350,height=450");
					}else if(data.status === "gdrive_false"){
						window.open(data.callback_uri, "", "width=350,height=450");
					}else{
						alert("File Gagal di hapus");
					}
			}, "json");
		}

	}

	function changeStatusPembelajaran(){
		var id = $("#txtId_status").val();
		var status = $("#txtStatus").val();

		$.post("controller/data_materi.php",{
			act: "changeStatus",
			id: id,
			status: status
		}, function(data){
			if(data.status === true){
				tabel.ajax.reload();
				$("#modal-status").modal("hide");
			}else{
				alert("Status gagal di simpan");
			}
		}, "json");

	}


	function changeState(id, state){

		$.post("controller/data_materi.php",{
			act: "changeState",
			id: id,
			is_ok: state
		},function(data){
			if(data.status === true){
				$("#txtId_status").val(id);
				$("#modal-status").modal({
					backdrop: "static"
				});

			}else{
				alert("Gagal melakukan Tela'ah");
			}
		}, "json");

	}

	function resetField(){
		$("#txtId").val("0");
		$("#id_format").val("0").trigger("change");
		$("#modalForm .form-control").val("");
		$("#judul").val("0").trigger("change");
		$("#type_opsi").hide();
		$("#type_text").hide();
		$("#kelas").val("0").trigger("change");
		$("#tahun_ajaran").val("0").trigger("change");
		$("#id_jurusan").val("0").trigger("change");
		$("#document").val("");
		tinymce.activeEditor.setContent('');
		$("#judul").focus();
	}

	function addNew(){
		resetField();

		$("#modalTitle").html("<i class='fa fa-plus fa-fw'></i> Tambah Data");

		$("#modalForm").modal({
			backdrop: "static"
		});
	}


	function edit(id){
		resetField();

		$.post("controller/data_materi.php",{
			act: "getData",
			id: id
		}, function(data){
			var dataSet = data.result[0];

			$("#txtId").val(dataSet.id);
			$("#id_format").val(dataSet.id_format).trigger("change");
			$("#kelas").val(dataSet.kelas).trigger("change");
			$("#tahun_ajaran").val(dataSet.tahun_ajaran).trigger("change");
			$("#id_jurusan").val(dataSet.id_jurusan).trigger("change");
			tinymce.activeEditor.setContent(dataSet.text_materi);

			$("#format_value_opsi").val(dataSet.format_value);
			$("#format_value_text").val(dataSet.format_value);

			$("#modalTitle").html("<i class='fa fa-pencil fa-fw'></i> Edit Data");

			$("#modalForm").modal({
				backdrop: "static"
			});

		}, "json");
	}

	function del(id){
		var konfirmasi = confirm("Apakah yakin akan menghapus data ini ?");

		if(konfirmasi){
			$.post("controller/data_materi.php",{
				act: "del",
				id: id
			}, function(data){
				if(data.status === true){
					alert("Data berhasil di hapus");
					tabel.ajax.reload();
				}else if(data.status === "not_login"){
					window.open(data.callback_uri, "", "width=350,height=450");
				}else if(data.status === "gdrive_false"){
					window.open(data.callback_uri, "", "width=350,height=450");
				}else{
					alert("Data Gagal di hapus");
				}

			}, "json");
		}
	}

	function set_option(){
		$.post("controller/data_materi.php",{
			act: "set_option"
		}, function(data){

			var opt_format = "";
			opt_format += "<option value='0'>- Pilih Format Judul -</option>";

			var opt_jurusan = "";
			opt_jurusan += "<option value='0'>- Pilih Bidang Studi -</option>";

			var opt_tahun_ajaran = "";
			opt_tahun_ajaran += "<option value='0'>- Pilih Tahun Ajaran -</option>";

			var opt_kelas = "";
			opt_kelas += "<option value='0'>- Pilih Kelas -</option>";

			$(data.format_judul).each(function(i, val){
				opt_format += "<option value='"+val.id_format+"'>"+val.nama_format+"</option>";
			});

			$(data.jurusan).each(function(i, val){
				opt_jurusan += "<option value='"+val.id+"'>["+val.kode_jurusan+"] "+val.nama_jurusan+"</option>";
			});

			$(data.tahun_ajaran).each(function(i, val){
				opt_tahun_ajaran += "<option value='"+val.id+"'>"+val.tahun_ajaran+"</option>";
			});




			$(data.kelas).each(function(i, val){
				opt_kelas += "<option value='"+val.id+"'>"+val.nama_kelas+"</option>";
			});

			$("#tahun_ajaran").html(opt_tahun_ajaran);
			$("#id_format").html(opt_format);
			$("#id_jurusan").html(opt_jurusan);
			$("#kelas").html(opt_kelas);
			$("#txtFilterKelas").html(opt_kelas);

		}, "json");
	}

	set_option();

	$(document).ready(function(){
		$("#data_form").on("submit", function(e){
			e.preventDefault();

			$.ajax({
				type: "post",
				url: "controller/data_materi.php",
				cache: false,
				contentType: false,
				processData: false,
				data: new FormData(this),
				dataType: "json",
				beforeSend: function(){
					$(".loader").fadeIn(200);
				},
				success: function(data){
					if(data.status === false){
						if(data.error_code === "over_size"){
							alert("Maximal ukuran file yang dapat di upload adalah 2MB !");
						}else if(data.error_code === "invalid_extension"){
							alert("Dokumen yang boleh di upload adalah *.doc, *.docx, *.xls, *.xlsx, *.ppt, *.pptx");
						}else if(data.error_code === "fail_del_old_file"){
							alert("Gagal menghapus file lama");
						}else if(data.error_code === "failed_upload"){
							alert("Gagal melakukan upload file !");
						}
					}else if(data.status === "not_login"){
						var confirm = window.open(data.callback_uri,"","width=350,height=450");
						var timers  = setInterval(function(){
							if(confirm.closed){
								clearInterval(timers);
								$("#data_form").submit();
							}
						}, 1000);
					}else{
						$("#modalForm").modal("hide");
						alert("Data pembelajaran berhasil di simpan");
						tabel.ajax.reload();

					}
					$(".loader").fadeOut(200);
				}
			});
		});
	});

</script>
