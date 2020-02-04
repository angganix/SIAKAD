
<style type="text/css">
	#modalForm tr td{
		vertical-align: middle;
	}
</style>
<section class="content-header">
	<h1>
		Data Keterampilan
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-th"></i> Dashboard</a></li>
		<li class="active">Data Keterampilan</li>
	</ol>
</section>

<section class="content">
	<div class="box box-widget">
		<div class="box-header with-border">
			<h6 class="box-title">Daftar Keterampilan</h6>
			<div class="box-tools pull-right">				
				<button type="button" class="btn btn-box-tool btnAdd" onclick="addNew();"><i class="fa fa-plus fa-fw"></i> Tambah</button>
			</div>
		</div>

		<div class="box-body">
			<div class="table-responsive">
				<table class="table table-responsive table-bordered table-hover dataGrid" id="dataGrid">
					<thead>
						<tr>
							<th style="text-align: center;width:8%">Kode</th>
							<th style="text-align: left;">Nama Keterampilan</th>
							<th style="text-align: left;width:14%;">Bidang Keahlian</th>
							<th style="text-align: left;width:25%;">Kompetensi Umum</th>
							<th style="text-align: left;width:18%;">Kompetensi Khusus</th>
							<th style="text-align: center;width: 8%;">Status</th>
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
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><i class="fa fa-times fa-fw"></i></button>
				<h5 class="modal-title" id="modalTitle"></h5>
			</div>

			<div class="modal-body">
				<input type="hidden" id="txtId" value="0">

				<div class="row">
					<div class="col-md-12">
						<table class="table table-bordered">
							<tbody>
								<tr>
									<td width="28%">Kode Keterampilan</td>
									<td class="form-group"><input type="text" class="form-control input-sm" id="txtKodeJurusan"></td>
								</tr>
								<tr>
									<td>Nama Keterampilan</td>
									<td class="form-group"><input type="text" class="form-control input-sm" id="txtNamaJurusan"></td>
								</tr>
								<tr>
									<td>Bidang Keahlian</td>
									<td class="form-group"><input type="text" class="form-control input-sm" id="txtBidangKeahlian"></td>
								</tr>
								<tr>
									<td>Kompetensi Umum</td>
									<td class="form-group"><input type="text" class="form-control input-sm" id="txtKompetensiUmum"></td>
								</tr>
								<tr>
									<td>Kompetensi Khusus</td>
									<td class="form-group"><input type="text" class="form-control input-sm" id="txtKompetensiKhusus"></td>
								</tr>
								<tr>
									<td>Pejabat</td>
									<td class="form-group"><input type="text" class="form-control input-sm" id="txtPejabat"></td>
								</tr>
								<tr>
									<td>Jabatan</td>
									<td class="form-group"><input type="text" class="form-control input-sm" id="txtJabatan"></td>
								</tr>
								<tr>
									<td>Guru Pengajar</td>
									<td>
										<select class="form-control input-sm select2" id="txtIdGuru"></select>
									</td>
								</tr>
								<tr>
									<td>Keterangan</td>
									<td class="form-group"><input type="text" class="form-control input-sm" id="txtKeterangan"></td>
								</tr>
								<tr>
									<td>Status</td>
									<td class="form-group">
										<div class="row" style="margin-top: 10px;">
											<div class="col-xs-3">
												<input type="radio" id="txtStatusAktif" name="status" value="1">
												<label for="txtStatusAktif">Aktif</label>
											</div>

											<div class="col-xs-4" style="text-align: center;">
												<input type="radio" id="txtStatusTidakAktif" name="status" value="0">
												<label for="txtStatusTidakAktif">Tidak Aktif</label>
											</div>
										</div>
									</td>
								</tr>
							</tbody>
						</table>
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
			url: "controller/data_jurusan.php",
			type: "post",
			data: {
				act: "getAll",
			}
		},
		columns: [
		{
			className: "centerCol",
			data: "kode_jurusan"
		},
		{data: "nama_jurusan"},
		{data: "bidang_keahlian"},
		{data: "kompetensi_umum"},
		{data: "kompetensi_khusus"},
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
		$("#txtKodeJurusan").focus();
		$("#txtIdGuru").val("0").trigger("change");
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

		$.post("controller/data_jurusan.php",{
			act: "getData",
			id: id
		}, function(data){
			var dataSet = data.result[0];

			$("#txtId").val(dataSet.id);
			$("#txtKodeJurusan").val(dataSet.kode_jurusan);
			$("#txtNamaJurusan").val(dataSet.nama_jurusan);
			$("#txtBidangKeahlian").val(dataSet.bidang_keahlian);
			$("#txtKompetensiUmum").val(dataSet.kompetensi_umum);
			$("#txtKompetensiKhusus").val(dataSet.kompetensi_khusus);
			$("#txtIdGuru").val(dataSet.id_guru).trigger("change");

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
			$.post("controller/data_jurusan.php",{
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
		var kode_jurusan = $("#txtKodeJurusan").val();
		var nama_jurusan = $("#txtNamaJurusan").val();
		var bidang_keahlian = $("#txtBidangKeahlian").val();
		var kompetensi_umum = $("#txtKompetensiUmum").val();
		var kompetensi_khusus = $("#txtKompetensiKhusus").val();
		var pejabat = $("#txtPejabat").val();
		var jabatan = $("#txtJabatan").val();
		var keterangan = $("#txtKeterangan").val();
		var status = $("#txtStatusAktif").is(":checked") ? 1 : 0;
		var id_guru = $("#txtIdGuru").val();

		$.post("controller/data_jurusan.php",{
			act: "save",
			id: id,
			kode_jurusan: kode_jurusan,
			nama_jurusan: nama_jurusan,
			bidang_keahlian: bidang_keahlian,
			kompetensi_umum: kompetensi_umum,
			kompetensi_khusus: kompetensi_khusus,
			pejabat: pejabat,
			jabatan: jabatan,
			keterangan: keterangan,
			status: status,
			id_guru: id_guru
		}, function(data){

			if(data.status === true){
				$("#modalForm").modal("hide");
				tabel.ajax.reload();
			}else{
				alert("Data gagal di simpan");
			}

		}, "json");		

	}

	function get_guru(){
		$.post("controller/data_jurusan.php",{
			act: "get_guru"
		}, function(data){
			var lst = "";
			lst += "<option value='0'>- Pilih Guru -</option>";

			$(data.result).each(function(i, val){
				lst += "<option value='"+val.id+"'>["+val.nrk+"] "+val.nama+"</option>";
			});

			$("#txtIdGuru").html(lst);
		}, "json");
	}

	get_guru();

</script>