<section class="content-header">
	<h1>
		Data Kelas
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-th"></i> Dashboard</a></li>
		<li class="active">Data Kelas</li>
	</ol>
</section>

<section class="content">
	<div class="box box-widget">
		<div class="box-header with-border">
			<h6 class="box-title">List Kelas</h6>
			<div class="box-tools pull-right">				
				<button type="button" class="btn btn-box-tool btnAdd" onclick="addNew();"><i class="fa fa-plus fa-fw"></i> Tambah</button>
			</div>
		</div>

		<div class="box-body">
			<div class="table-responsive">
				<table class="table table-responsive table-bordered table-hover dataGrid" id="dataGrid">
					<thead>
						<tr>
							<th style="text-align: center;width: 15%;">Nama Kelas</th>
							<th style="text-align: left;">Wali Kelas</th>
							<th style="text-align: center;width: 15%;">Ketunaan</th>
							<th style="text-align: center;width: 15%;">Status</th>
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
						<label class="small-label">Nama Kelas</label>
						<input type="text" class="form-control input-sm" id="txtNamaKelas">
						<br>
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-12 form-group">
						<label class="small-label">Wali Kelas</label>
						<select class="form-control input-sm select2" id="txtWaliKelas">
						</select>
						<br>
					</div>
				</div>

				<div class="row">
					<div class="col-md-12 form-group">
						<label class="small-label">Ketunaan</label>
						<select class="form-control input-sm select2" id="txtKetunaan">
						</select>
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
			url: "controller/data_kelas.php",
			type: "post",
			data: {
				act: "getAll",
			}
		},
		columns: [
		{
			className: "centerCol",
			data: "nama_kelas"
		},
		{data: "nama_wali_kelas"},
		{
			className: "centerCol",
			data: "kode_ketunaan"
		},
		{
			className: "centerCol",
			data: "status",
			render: function(data, type, full, meta){
				if(data === "1"){
					return "<span class='label label-success'>Aktif</span>";
				}else{
					return "<span class='label label-warning'>Tidak AKtif</span>";
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


	function getWaliKelas(){
		$.post("controller/data_kelas.php",{
			act: "getWaliKelas",
			criteria: "1=1"
		}, function(data){
			var lst = "";
			lst += "<option value='0'>-Pilih Wali Kelas-</option>";

			$(data.result).each(function(i, val){
				lst += "<option value='"+val.id+"'>"+val.nama+"</option>";
			});

			$("#txtWaliKelas").html(lst);
		}, "json");
	}

	getWaliKelas();

	function getKetunaan(){
		$.post("controller/data_kelas.php",{
			act: "getKetunaan",
			criteria: "1=1"
		}, function(data){
			var lst = "";
			lst += "<option value='0'>-Pilih Ketunaan-</option>";

			$(data.result).each(function(i, val){
				lst += "<option value='"+val.id+"'>["+val.kode_ketunaan+"] "+val.nama_ketunaan+"</option>";
			});

			$("#txtKetunaan").html(lst);
		}, "json");
	}

	getKetunaan();

	function resetField(){
		$("#txtId").val("0");
		$("#modalForm .form-control").val("");
		$("#txtNamaKelas").focus();
		$("#txtWaliKelas").val("0").trigger("change");
		$("#txtKetunaan").val("0").trigger("change");
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

		$.post("controller/data_kelas.php",{
			act: "getData",
			id: id
		}, function(data){
			var dataSet = data.result[0];

			$("#txtId").val(dataSet.id);
			$("#txtNamaKelas").val(dataSet.nama_kelas);
			$("#txtWaliKelas").val(dataSet.wali_kelas).trigger("change");
			$("#txtKetunaan").val(dataSet.ketunaan).trigger("change");
			
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
			$.post("controller/data_kelas.php",{
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
		var nama_kelas = $("#txtNamaKelas").val();
		var wali_kelas = $("#txtWaliKelas").val();
		var ketunaan = $("#txtKetunaan").val();
		var status = $("#txtStatusAktif").is(":checked") === true ? 1 : 0;


		$.post("controller/data_kelas.php",{
			act: "save",
			id: id,
			nama_kelas: nama_kelas,
			wali_kelas: wali_kelas,
			ketunaan: ketunaan,
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