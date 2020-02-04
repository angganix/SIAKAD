<style type="text/css">
#modalForm tr td{
	vertical-align: middle;
}

select.input-sm{
	line-height: 22px !important;
}

#modalForm tr td:first-child{
	font-weight: bold;
	font-size: 12px;
}


</style>
<section class="content-header">
	<h1>
		Data Guru
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-th"></i> Dashboard</a></li>
		<li class="active">Data Pengajar</li>
	</ol>
</section>

<section class="content">
	<div class="box box-widget">
		<div class="box-header with-border">
			<h6 class="box-title">Daftar Guru</h6>
			<div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool bg-green" onclick="exportExcel();"><i class="fa fa-file-excel-o fa-fw"></i> Excel</button>
				<button type="button" class="btn btn-box-tool bg-red" onclick="exportPDF();"><i class="fa fa-file-pdf-o fa-fw"></i> PDF</button>
				<button type="button" class="btn btn-box-tool bg-blue btnAdd" onclick="addNew();"><i class="fa fa-plus fa-fw"></i> Tambah</button>
			</div>
		</div>

		<div class="box-body">
			<div class="table-responsive table-condensed">
				<table class="table table-responsive table-bordered table-hover dataGrid" id="dataGrid">
					<thead>
						<tr>
							<th style="text-align: center;width:14%">NIP</th>
							<th style="text-align: left;">Nama Lengkap</th>
							<th style="text-align: left;width:10%;">Gender</th>
							<th style="text-align: left;width:12%;">No. HP</th>
							<th style="text-align: left;width:15%;">Status Pegawai</th>
							<th style="text-align: center;width: 15%;">Jenis PTK</th>
							<th style="text-align: center;width:12%;"><i class="fa fa-gears fa-fw"></i></th>
						</tr>
					</thead>

					<tbody>

					</tbody>
				</table>
			</div>
		</div>
	</div>
</section>


<form action="" method="post" enctype="multipart/form-data" name="form_data_guru" id="form_data_guru">
	<div class="modal fade" id="modalForm">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><i class="fa fa-times fa-fw"></i></button>
					<h5 class="modal-title" id="modalTitle"></h5>
				</div>

				<div class="modal-body">
					<input type="hidden" id="txtId" name="id" value="0">
					<input type="hidden" id="txtAct" name="act" value="save">

					<div class="row">
						<div class="col-md-6">
							<table class="table table-bordered">
								<tbody>
									<tr>
										<td width="28%">NIP</td>
										<td class="form-group"><input type="number" class="form-control input-sm" id="txtNIP" name="nip"></td>
									</tr>
									<tr>
										<td>NRK</td>
										<td class="form-group"><input type="number" class="form-control input-sm" id="txtNRK" name="nrk"></td>
									</tr>
									<tr>
										<td>NRG</td>
										<td class="form-group"><input type="number" class="form-control input-sm" id="txtNRG" name="nrg"></td>
									</tr>
									<tr>
										<td>NIK</td>
										<td class="form-group"><input type="number" class="form-control input-sm" id="txtNIK" name="nik"></td>
									</tr>
									<tr>
										<td>NUPTK</td>
										<td class="form-group"><input type="number" class="form-control input-sm" id="txtNUPTK" name="nuptk"></td>
									</tr>
									<tr>
										<td>Nama Lengkap</td>
										<td class="form-group"><input type="text" class="form-control input-sm" id="txtNamaLengkap" name="nama"></td>
									</tr>
								</tbody>
							</table>
						</div>

						<div class="col-md-6">
							<table class="table table-bordered">
								<tbody>
									<tr>
										<td width="28%">Jenis Kelamin</td>
										<td class="form-group">
											<div class="row" style="margin-top:2px;">
												<div class="col-xs-6">
													<input type="radio" id="txtLaki" name="jenis_kelamin" value="l"> 
													<label for="txtLaki">Laki-laki</label>
												</div>

												<div class="col-xs-6">
													<input type="radio" id="txtPerempuan" name="jenis_kelamin" value="p"> 
													<label for="txtPerempuan">Perempuan</label>
												</div>
											</div>
										</td>
									</tr>
									<tr>
										<td>Tempat Lahir</td>
										<td class="form-group"><input type="text" class="form-control input-sm" id="txtTempatLahir" name="tempat_lahir"></td>
									</tr>
									<tr>
										<td>Tanggal Lahir</td>
										<td class="form-group"><input type="text" class="form-control input-sm tanggal" id="txtTanggalLahir" name="tanggal_lahir"></td>
									</tr>
									<tr>
										<td>Agama</td>
										<td class="form-group">
											<select class="form-control input-sm" id="txtAgama" name="agama"></select>
										</td>
									</tr>
									<tr>
										<td >No. HP</td>
										<td class="form-group"><input type="number" class="form-control input-sm" id="txtNoHP" name="no_hp"></td>
									</tr>
									<tr>
										<td>Email</td>
										<td class="form-group"><input type="email" class="form-control input-sm" id="txtEmail" name="email"></td>
									</tr>
									
								</tbody>
							</table>
						</div>
					</div>
					<div class="dashed-divider"></div>
					<div class="row">
						<div class="col-md-12">
							<table class="table table-bordered" style="margin-bottom: 0px;">
								<tbody>
									<tr>
										<td width="13.5%">Alamat</td>
										<td class="form-group">
											<input type="text" class="form-control input-sm" id="txtAlamat" name="alamat">
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="col-md-6">
							<table class="table table-bordered">
								<tbody>
									<tr>
										<td width="28%">RT/RW</td>
										<td class="form-group"><input type="text" class="form-control input-sm" id="txtRTRW" name="rt_rw"></td>
									</tr>
									<tr>
										<td>Kelurahan</td>
										<td class="form-group">
											<input type="text" class="form-control input-sm" id="txtKelurahan" name="kelurahan">
										</td>
									</tr>
									<tr>
										<td>Kecamatan</td>
										<td class="form-group"><input type="text" class="form-control input-sm" id="txtKecamatan" name="kecamatan"></td>
									</tr>
								</tbody>
							</table>
						</div>

						<div class="col-md-6">
							<table class="table table-bordered">
								<tbody>
									<tr>
										<td width="28%">Kota/Kabupaten</td>
										<td class="form-group"><input type="text" class="form-control input-sm" id="txtKotaKabupaten" name="kota_kabupaten"></td>
									</tr>
									<tr>
										<td>Provinsi</td>
										<td class="form-group"><input type="text" class="form-control input-sm" id="txtProvinsi" name="provinsi"></td>
									</tr>
									<tr>
										<td>Kode POS</td>
										<td class="form-group"><input type="text" class="form-control input-sm" id="txtKodePOS" name="kode_pos"></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<div class="dashed-divider"></div>
					<div class="dashed-divider"></div>
					<div class="row">
						<div class="col-md-6">
							<table class="table table-bordered">
								<tbody>
									<tr>
										<td width="35%">Pendidikan Terakhir</td>
										<td class="form-group">
											<input type="text" class="form-control input-sm" id="txtPendidikanTerakhir" name="pendidikan_terakhir">
										</td>
									</tr>
									
									<tr>
										<td>Tahun Lulus</td>
										<td class="form-group"><input type="number" class="form-control input-sm" id="txtTahunLulus" name="tahun_lulus"></td>
									</tr>
									<tr>
										<td width="28%">SKCPNS</td>
										<td class="form-group"><input type="text" class="form-control input-sm" id="txtSKCPNS" name="skcpns"></td>
									</tr>
									<tr>
										<td>Tanggal CPNS</td>
										<td class="form-group"><input type="text" class="form-control input-sm tanggal" id="txtTanggalCPNS" name="tanggal_cpns"></td>
									</tr>
									<tr>
										<td>SKPNS</td>
										<td class="form-group"><input type="text" class="form-control input-sm" id="txtSKPNS" name="skpns"></td>
									</tr>
									<tr>
										<td>Tanggal PNS</td>
										<td class="form-group"><input type="text" class="form-control input-sm tanggal" id="txtTanggalPNS" name="tanggal_pns"></td>
									</tr>
								</tbody>
							</table>
						</div>

						<div class="col-md-6">
							<table class="table table-bordered">
								<tbody>
									<tr>
										<td width="35%">Jurusan</td>
										<td class="form-group"><input type="text" class="form-control input-sm" id="txtJurusan" name="jurusan"></td>
									</tr>
									<tr>
										<td >Jenis PTK</td>
										<td class="form-group">
											<select class="form-control input-sm" id="txtJenisPTK" name="jenis_ptk"></select>
										</td>
									</tr>
									<tr>
										<td>Status Kepegawaian</td>
										<td class="form-group">
											<select class="form-control input-sm" id="txtStatusKepegawaian" name="status_kepegawaian"></select>
										</td>
									</tr>
									<tr>
										<td>Status Keaktifan</td>
										<td class="form-group">
											<select class="form-control input-sm" id="txtStatusKeaktifan" name="status_keaktifan"></select>
										</td>
									</tr>
									<tr>
										<td width="45%">Tanggal Golongan Terakhir</td>
										<td class="form-group">
											<input type="text" class="form-control input-sm tanggal" id="txtTanggalGolonganTerakhir" name="tanggal_golongan_terakhir">
										</td>
									</tr>
									<tr>
										<td>Golongan</td>
										<td class="form-group">
											<select class="form-control input-sm" id="txtGolongan" name="golongan"></select>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<div class="dashed-divider"></div>
					<div class="dashed-divider"></div>
					<div class="row">
						<div class="col-md-6">
							<table class="table table-bordered">
								<tbody>
									<tr>
										<td width="40%">Status Nikah</td>
										<td class="form-group">
											<select class="form-control input-sm" id="txtStatusNikah" name="status_nikah"></select>
										</td>
									</tr>
									<tr>
										<td>Nama Suami/Istri</td>
										<td class="form-group"><input type="text" class="form-control input-sm" id="txtNamaSuamiIstri" name="nama_suami_istri"></td>
									</tr>
									<tr>
										<td>Pekerjaan Suami/Istri</td>
										<td class="form-group">
											<input type="text" class="form-control input-sm" id="txtJenisPekerjaanSuamiIstri" name="jenis_pekerjaan_suami_istri">
										</td>
									</tr>
								</tbody>
							</table>
						</div>

						<div class="col-md-6">
							<table class="table table-bordered">
								<tbody>
									<tr>
										<td width="38%">Nama Ayah Kandung</td>
										<td class="form-group">
											<input type="text" class="form-control input-sm" id="txtNamaAyahKandung" name="nama_ayah_kandung">
										</td>
									</tr>
									<tr>
										<td>Nama Ibu Kandung</td>
										<td class="form-group">
											<input type="text" class="form-control input-sm" id="txtNamaIbuKandung" name="nama_ibu_kandung">
										</td>
									</tr>
									<tr>
										<td>NPWP</td>
										<td class="form-group">
											<input type="text" class="form-control input-sm" id="txtNPWP" name="npwp">
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<div id="box-input-foto">
								<label class="small-label" for="txtFoto">Foto</label>
								<input type="file" class="form-control input-sm" id="txtFoto" name="foto" onchange="previewImage(this)"><br>
							</div>
							<img id="thumbnil" class='img-responsive' style='width: 120px;height: 160px;object-fit:contain;object-position:center;margin-top:10px;margin-bottom:10px;box-shadow:0px 0.55px 9px #ccc;border-radius:2px;'/>
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
			url: "controller/data_guru.php",
			type: "post",
			data: {
				act: "getAll",
			}
		},
		columns: [
		{
			className: "centerCol",
			data: "nip"
		},
		{
			data: "nama",
			render: function(data){
				return "<a href='#detail' class='btnDetail'>"+data+"</a>";
			}
		},
		{
			data: "jenis_kelamin",
			className: "centerCol",
			render: function(data, type, full, meta){
				if(data === "l"){
					return "Laki-laki";
				}else{
					return "Perempuan";
				}
			}
		},
		{data: "no_hp"},
		{data: "status_kepegawaian_text"},
		{data: "nama_ptk"},
		{
			data: null,
			className: "centerCol",
			sortable: false,
			defaultContent: "<button type='button' class='btn btn-info btn-xs bg-green btnPDF'><i class='fa fa-file-pdf-o fa-fw'></i></button> <button type='button' class='btn btn-info btn-xs btnEdit'><i class='fa fa-pencil fa-fw'></i></button> <button type='button' class='btn btn-danger btn-xs btnDel'><i class='fa fa-trash fa-fw'></i></button>"
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

	$("#dataGrid tbody").on("click", ".btnDetail", function(){
		var data = tabel.row($(this).parents("tr")).data();
		detail(data[0]);
	});

	$("#dataGrid tbody").on("click", ".btnPDF", function(){
		var data = tabel.row($(this).parents("tr")).data();
		detailPDF(data[0]);
	});

	function resetField(){
		$("#txtId").val("0");
		$("#modalForm .form-control").val("");
		$("#txtNIP").focus();
		$("#txtAgama").val("0");
		$("#txtStatusKepegawaian").val("0");
		$("#txtStatusNikah").val("0");
		$("#txtJenisPTK").val("0");
		$("#txtStatusKeaktifan").val("0");
		$("#txtGolongan").val("0");

		$("#modalForm .form-control").prop("disabled", false);
		$("#modalForm input[type='radio']").prop("disabled", false);
		$("button[type='submit']").show();
		$("#modalTitle").html("<i class='fa fa-eye fa-fw'></i> Preview Data");
		$("#box-input-foto").show();
		$("#thumbnil").prop("src", "upload/notfound.jpg");
	}

	function previewImage(fileInput) {
		var files = fileInput.files;
		for (var i = 0; i < files.length; i++) {
			var file = files[i];
			var imageType = /image.*/;
			if (!file.type.match(imageType)) {
				continue;
			}
			var img=document.getElementById("thumbnil");
			img.file = file;
			var reader = new FileReader();
			reader.onload = (function(aImg) {
				return function(e) {
					aImg.src = e.target.result;
				};
			})(img);
			reader.readAsDataURL(file);
		}
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

		$.post("controller/data_guru.php",{
			act: "getData",
			id: id
		}, function(data){
			var data_guru = data.result[0];

			//Set Detail Data
			$("#txtId").val(data_guru.id_guru);
			$("#txtNIP").val(data_guru.nip);
			$("#txtNRK").val(data_guru.nrk);
			$("#txtNRG").val(data_guru.nrg);
			$("#txtNIK").val(data_guru.nik);
			$("#txtNUPTK").val(data_guru.nuptk);
			$("#txtNamaLengkap").val(data_guru.nama);
			if(data_guru.jenis_kelamin === "l"){
				$("#txtLaki").prop("checked", true);
			}else{
				$("#txtPerempuan").prop("checked", true);
			}
			$("#txtTempatLahir").val(data_guru.tempat_lahir);
			$("#txtTanggalLahir").val(data_guru.tanggal_lahir);
			$("#txtAgama").val(data_guru.agama_id);
			$("#txtNoHP").val(data_guru.no_hp);
			$("#txtEmail").val(data_guru.email);
			$("#txtAlamat").val(data_guru.alamat);
			$("#txtRTRW").val(data_guru.rt_rw);
			$("#txtKelurahan").val(data_guru.kelurahan);
			$("#txtKecamatan").val(data_guru.kecamatan);
			$("#txtKotaKabupaten").val(data_guru.kota_kabupaten);
			$("#txtProvinsi").val(data_guru.provinsi);
			$("#txtKodePOS").val(data_guru.kode_pos);
			$("#txtPendidikanTerakhir").val(data_guru.pendidikan_terakhir);
			$("#txtJurusan").val(data_guru.jurusan);
			$("#txtTahunLulus").val(data_guru.tahun_lulus);
			$("#txtJenisPTK").val(data_guru.jenis_ptk);
			$("#txtStatusKepegawaian").val(data_guru.status_kepegawaian);
			$("#txtStatusKeaktifan").val(data_guru.status_keaktifan);
			$("#txtSKCPNS").val(data_guru.skcpns);
			$("#txtTanggalCPNS").val(data_guru.tanggal_cpns);
			$("#txtSKPNS").val(data_guru.skpns);
			$("#txtTanggalPNS").val(data_guru.tanggal_pns);
			$("#txtTanggalGolonganTerakhir").val(data_guru.tanggal_golongan_terakhir);
			$("#txtGolongan").val(data_guru.golongan);
			$("#txtStatusNikah").val(data_guru.status_nikah);
			$("#txtNamaSuamiIstri").val(data_guru.nama_suami_istri);
			$("#txtJenisPekerjaanSuamiIstri").val(data_guru.jenis_pekerjaan_suami_istri);
			$("#txtNamaAyahKandung").val(data_guru.nama_ayah_kandung);
			$("#txtNamaIbuKandung").val(data_guru.nama_ibu_kandung);
			$("#txtNPWP").val(data_guru.npwp);
			$("#thumbnil").attr("src", "upload/"+data_guru.foto);

			$("#modalTitle").html("<i class='fa fa-pencil fa-fw'></i> Edit Data");
			$("#modalForm").modal({
				backdrop: "static"
			});

		}, "json");
	}

	function detail(id){
		resetField();

		$.post("controller/data_guru.php",{
			act: "getData",
			id: id
		}, function(data){
			var data_guru = data.result[0];

			//Set Detail Data
			$("#txtId").val(data_guru.id_guru);
			$("#txtNIP").val(data_guru.nip);
			$("#txtNRK").val(data_guru.nrk);
			$("#txtNRG").val(data_guru.nrg);
			$("#txtNIK").val(data_guru.nik);
			$("#txtNUPTK").val(data_guru.nuptk);
			$("#txtNamaLengkap").val(data_guru.nama);
			if(data_guru.jenis_kelamin === "l"){
				$("#txtLaki").prop("checked", true);
			}else{
				$("#txtPerempuan").prop("checked", true);
			}
			$("#txtTempatLahir").val(data_guru.tempat_lahir);
			$("#txtTanggalLahir").val(data_guru.tanggal_lahir);
			$("#txtAgama").val(data_guru.agama_id);
			$("#txtNoHP").val(data_guru.no_hp);
			$("#txtEmail").val(data_guru.email);
			$("#txtAlamat").val(data_guru.alamat);
			$("#txtRTRW").val(data_guru.rt_rw);
			$("#txtKelurahan").val(data_guru.kelurahan);
			$("#txtKecamatan").val(data_guru.kecamatan);
			$("#txtKotaKabupaten").val(data_guru.kota_kabupaten);
			$("#txtProvinsi").val(data_guru.provinsi);
			$("#txtKodePOS").val(data_guru.kode_pos);
			$("#txtPendidikanTerakhir").val(data_guru.pendidikan_terakhir);
			$("#txtJurusan").val(data_guru.jurusan);
			$("#txtTahunLulus").val(data_guru.tahun_lulus);
			$("#txtJenisPTK").val(data_guru.jenis_ptk);
			$("#txtStatusKepegawaian").val(data_guru.status_kepegawaian);
			$("#txtStatusKeaktifan").val(data_guru.status_keaktifan);
			$("#txtSKCPNS").val(data_guru.skcpns);
			$("#txtTanggalCPNS").val(data_guru.tanggal_cpns);
			$("#txtSKPNS").val(data_guru.skpns);
			$("#txtTanggalPNS").val(data_guru.tanggal_pns);
			$("#txtTanggalGolonganTerakhir").val(data_guru.tanggal_golongan_terakhir);
			$("#txtGolongan").val(data_guru.golongan);
			$("#txtStatusNikah").val(data_guru.status_nikah);
			$("#txtNamaSuamiIstri").val(data_guru.nama_suami_istri);
			$("#txtJenisPekerjaanSuamiIstri").val(data_guru.jenis_pekerjaan_suami_istri);
			$("#txtNamaAyahKandung").val(data_guru.nama_ayah_kandung);
			$("#txtNamaIbuKandung").val(data_guru.nama_ibu_kandung);
			$("#txtNPWP").val(data_guru.npwp);
			$("#thumbnil").attr("src", "upload/"+data_guru.foto);

			$("#modalForm .form-control").prop("disabled", true);
			$("#modalForm input[type='radio']").prop("disabled", true);
			$("button[type='submit']").hide();
			$("#box-input-foto").hide();
			$("#modal-title").html("<i class='fa fa-pencil fa-fw'></i> Edit Data");
			$("#modalForm").modal({
				backdrop: "static"
			});

		}, "json");
	}

	function del(id){
		var konfirmasi = confirm("Apakah yakin akan menghapus data ini ?");

		if(konfirmasi){
			$.post("controller/data_guru.php",{
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

	function getRelatedData(){
		$.post("controller/data_guru.php",{
			act: "getRelatedData"
		}, function(data){
			var lst_agama = "";
			var lst_ptk = "";
			var lst_status_kepegawaian = "";
			var lst_status_keaktifan = "";
			var lst_golongan = "";
			var lst_status_nikah = "";

			//Set Agama
			lst_agama += "<option value='0'>-Pilih Agama -</option>";
			$(data.lst_agama).each(function(i, val){
				lst_agama += "<option value='"+val.id+"'>"+val.agama+"</option>";
			});

			//Set Jenis PTK
			lst_ptk += "<option value='0'>-Pilih PTK-</option>";
			$(data.lst_ptk).each(function(i, val){
				lst_ptk += "<option value='"+val.id+"'>"+val.nama_ptk+"</option>";
			});

			//Set Status Kepegawaian
			lst_status_kepegawaian += "<option value='0'>-Pilih Status Kepegawaian-</option>";
			$(data.lst_status_kepegawaian).each(function(i, val){
				lst_status_kepegawaian += "<option value='"+val.id+"'>"+val.status_kepegawaian+"</option>";
			});

			//Set Status Keaktifan
			lst_status_keaktifan += "<option value='0'>-Pilih Status Keaktifan-</option>";
			$(data.lst_status_keaktifan).each(function(i, val){
				lst_status_keaktifan += "<option value='"+val+"'>"+toUcFirst(val)+"</option>";
			});

			//Set Golongan
			lst_golongan += "<option value='0'>-Pilih Golongan -</option>";
			$(data.lst_golongan).each(function(i, val){
				lst_golongan += "<option value='"+val.id+"'>"+val.nama_golongan+"</option>";
			});

			//Set Status Nikah
			lst_status_nikah += "<option value='0'>-Pilih Status Nikah-</option>";
			$(data.lst_status_nikah).each(function(i, val){
				lst_status_nikah += "<option value='"+val+"'>"+toUcFirst(val)+"</option>";
			});
			
			$("#txtAgama").html(lst_agama);
			$("#txtJenisPTK").html(lst_ptk);
			$("#txtStatusKepegawaian").html(lst_status_kepegawaian);
			$("#txtStatusKeaktifan").html(lst_status_keaktifan);
			$("#txtGolongan").html(lst_golongan);
			$("#txtStatusNikah").html(lst_status_nikah);

		}, "json");

	}

	getRelatedData();

	$(document).ready(function(){
		$("#form_data_guru").on("submit", function(e){
			e.preventDefault();

			if($("#txtNIP").val().length > 18){
				alert("Maximal NIP 18 Karakter");
			}else if($("#txtNRK").val().length > 7){
				alert("Maximal NRK 7 Karakter");
			}else if($("#txtNIK").val().length > 18){
				alert("Maximal NIK 18 Karakter");
			}else if($("#txtNRG").val().length > 18){
				alert("Maximal NRG 18 Karakter");
			}else if($("#txtNoHP").val().length > 15){
				alert("Maximal No. HP 15 Karakter");
			}else{
				$.ajax({
					type: "post",
					url: "controller/data_guru.php",
					data: new FormData(this),
					contentType: false,
					cache: false,
					processData: false,
					dataType: "json",
					beforeSend: function(){
					  $(".loader").fadeIn(200);  
					},
					success: function(data){

						switch(data.status){
							case "failed_size":
							alert("Maximal File Upload 2Mb");
							break;
							case "failed_extension":
							alert("Extensi foto yang diizinkan (*.jpg, *.jpeg, *.png, *.gif");
							break;
							case "failed_upload":
							alert("Gagal mengunggah foto");
							break;
							case false:
							alert("Gagal menyimpan data ke database");
							break;
							case true:
							alert("Data berhasil di simpan");
							$("#modalForm").modal("hide");
							tabel.ajax.reload();
							break;
						}
						
						$(".loader").fadeOut(200);  
					}
				});
			}

		});
	});

	function exportPDF(){
		window.open("print-form/print_data_guru.php?criteria="+tabel.search(this.value));
	}

	function exportExcel(){
		window.open("print-form/excel_data_guru.php?criteria="+tabel.search(this.value));
	}

	function detailPDF(id){
		window.open("print-form/pdf_guru.php?id="+id);
	}

</script>
