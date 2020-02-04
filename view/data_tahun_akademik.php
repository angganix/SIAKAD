
<section class="content-header">
	<h1>
		Data Tahun Akademik
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-th"></i> Dashboard</a></li>
		<li class="active">Data Tahun Akademik</li>
	</ol>
</section>

<section class="content">
	<div class="box box-widget">
		<div class="box-header with-border">
			<h6 class="box-title">Daftar Tahun Akademik</h6>
			<div class="box-tools pull-right">				
				<button type="button" class="btn btn-box-tool btnAdd" onclick="addNew();"><i class="fa fa-plus fa-fw"></i> Tambah</button>
			</div>
		</div>

		<div class="box-body">
			<div class="table-responsive">
				<table class="table table-responsive table-bordered table-hover dataGrid" id="dataGrid">
					<thead>
						<tr>
							<th style="text-align: center;width:12%;">Kode Tahun</th>
							<th style="text-align: center;width: 20%;">Semester</th>
							<th style="text-align: center;width: 16%;">Tahun Ajaran</th>
							<th style="text-align: center;width: 12%;">Status</th>
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

<div class="modal fade" id="modalForm">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><i class="fa fa-times fa-fw"></i></button>
				<h5 class="modal-title" id="modalTitle"></h5>
			</div>

			<div class="modal-body">
				<input type="hidden" id="txtId" value="0">

				<div class="row">
					<div class="col-md-12 form-group">
						<label class="small-label">Kode Tahun</label>
						<input type="text" class="form-control input-sm" id="txtKodeTahun">
						<br>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 form-group">
						<label class="small-label">Semester</label>
						<input type="text" class="form-control input-sm" id="txtSemester">
						<br>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 form-group">
						<label class="small-label">Tahun Ajaran</label>
						<input type="text" class="form-control input-sm" id="txtTahunAjaran">
						<br>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 form-group">
						<label class="small-label" style="display: block;">Status</label>
						<div class="row" style="margin-top: 10px;">
							<div class="col-xs-6">
								<input type="radio" id="txtStatusAktif" name="status" value="1">
								<label for="txtStatusAktif">Aktif</label>
							</div>

							<div class="col-xs-6" style="text-align: center;">
								<input type="radio" id="txtStatusTidakAktif" name="status" value="0">
								<label for="txtStatusTidakAktif">Tidak Aktif</label>
							</div>
						</div>
						<br>
					</div>
				</div>
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-warning btn-sm" data-dismiss="modal"><i class="fa fa-times fa-fw"></i> Tutup</button>
				<button type="button" class="btn btn-success btn-sm" onclick="save();"><i class="fa fa-check fa-fw"></i> Simpan</button>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">


	var tabel = $("#dataGrid").DataTable({
		processing: true,
		serverSide: true,
		paging: true,
		"ajax": {
			url: "controller/data_tahun_akademik.php",
			type: "post",
			data: {
				act: "getAll",
			}
		},
		columns: [
		{
			className: "centerCol",
			data: "kode_tahun"
		},
		{
			className: "centerCol",
			data: "semester"
		},
		{
			className: "centerCol",
			data: "tahun_ajaran"
		},
		{
			className: "centerCol",
			data: "status",
			render: function(data, type, full, meta){
				if(data === "1"){
					return "<span class='label label-success'>Aktif</span>";
				}else{
					return "<span class='label label-warning'>Tidak Aktif</span>";
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

	$("#dataGrid tbody").on("click", ".btnEdit", function(){
		var data = tabel.row($(this).parents("tr")).data();
		edit(data[0]);
	});

	$("#dataGrid tbody").on("click", ".btnDel", function(){
		var data = tabel.row($(this).parents("tr")).data();
		del(data[0]);
	});

	function resetField(){
		$("#txtId").val("0");
		$("#modalForm .form-control").val("");
		$("#txtKodeTahun").focus();
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

		$.post("controller/data_tahun_akademik.php",{
			act: "getData",
			id: id
		}, function(data){
			var dataSet = data.result[0];

			$("#txtId").val(dataSet.id);
			$("#txtKodeTahun").val(dataSet.kode_tahun);
			$("#txtSemester").val(dataSet.semester);
			$("#txtTahunAjaran").val(dataSet.tahun_ajaran);
			
			if(dataSet.status === "1"){
				$("#txtStatusAktif").prop("checked", true);
			}else{
				$("#txtStatusTidakAktif").prop("checked", true);
			}

			$("#modalTitle").html("<i class='fa fa-pencil fa-fw'></i> Edit Data");

			$("#modalForm").modal({
				backdrop: "static"
			});

		}, "json");
	}

	function del(id){
		var konfirmasi = confirm("Apakah yakin akan menghapus data ini ?");

		if(konfirmasi){
			$.post("controller/data_tahun_akademik.php",{
				act: "del",
				id: id
			}, function(data){
				if(data.status === true){
					tabel.ajax.reload();
				}else{
					alert("Data gagal di hapus");
				}

			}, "json");
		}
	}

	function save(){
		var id = $("#txtId").val();
		var kode_tahun = $("#txtKodeTahun").val();
		var semester = $("#txtSemester").val();
		var tahun_ajaran = $("#txtTahunAjaran").val();
		var status = $("#txtStatusAktif").is(":checked") ? 1 : 0;

		$.post("controller/data_tahun_akademik.php",{
			act: "save",
			id: id,
			kode_tahun: kode_tahun,
			semester: semester,
			tahun_ajaran: tahun_ajaran,
			status: status
		}, function(data){

			if(data.status === true){
				$("#modalForm").modal("hide");
				tabel.ajax.reload();
			}else{
				alert("Data gagal di simpan");
			}

		}, "json");		

	}

</script>