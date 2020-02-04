
<style type="text/css">
	.table tr td{
		vertical-align: middle !important;
	}
</style>
<section class="content-header">
	<h1>
		Data Identitas Sekolah
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-th"></i> Dashboard</a></li>
		<li class="active">Data Identitas Sekolah</li>
	</ol>
</section>

<section class="content">
	<div class="box box-widget">
		<div class="box-header with-border">
			<h6 class="box-title">Identitas Sekolah</h6>
		</div>

		<div class="box-body">
			<input type="hidden" id="txtId" value="1">
			<div class="table-responsive">
				<table class="table">
					<tr>
						<td width="12%">Nama Sekolah</td>
						<td><input type="text" class="form-control input-sm" id="txtNamaSekolah" placeholder="Nama Sekolah"></td>
					</tr>
					<tr>
						<td>NPSN</td>
						<td><input type="text" class="form-control input-sm" id="txtNPSN" placeholder="NPSN"></td>
					</tr>
					<tr>
						<td>Alamat</td>
						<td><input type="text" class="form-control input-sm" id="txtAlamat" placeholder="Alamat Lengkap"></td>
					</tr>
					<tr>
						<td>Kelurahan</td>
						<td><input type="text" class="form-control input-sm" id="txtKelurahan" placeholder="Kelurahan"></td>
					</tr>
					<tr>
						<td>Kecamatan</td>
						<td><input type="text" class="form-control input-sm" id="txtKecamatan" placeholder="Kecamatan"></td>
					</tr>
					<tr>
						<td>Kabupaten/Kota</td>
						<td><input type="text" class="form-control input-sm" id="txtKabupatenKota" placeholder="Kabupaten / Kota"></td>
					</tr>
					<tr>
						<td>Provinsi</td>
						<td><input type="text" class="form-control input-sm" id="txtProvinsi" placeholder="Provinsi"></td>
					</tr>
					<tr>
						<td>Kode POS</td>
						<td><input type="text" class="form-control input-sm" id="txtKodePos" placeholder="Kode POS"></td>
					</tr>
					<tr>
						<td>No. Telpon</td>
						<td><input type="text" class="form-control input-sm" id="txtNoTelpon" placeholder="No. Telpon"></td>
					</tr>
					<tr>
						<td>Website</td>
						<td><input type="text" class="form-control input-sm" id="txtWebsite" placeholder="Website"></td>
					</tr>
					<tr>
						<td>Email</td>
						<td><input type="email" class="form-control input-sm" id="txtEmail" placeholder="Email"></td>
					</tr>
					<tr>
						<td></td>
						<td>
							<button type="button" class="btn btn-success btn-sm bg-green btnEdit" onclick="save();">
								<i class="fa fa-check fa-fw"></i> Simpan
							</button>
						</td>
					</tr>
				</table>
			</div>

		</div>
	</div>
</section>

<script type="text/javascript">

	function edit(){
		$.post("controller/data_identitas_sekolah.php",{
			act: "getData",
			id: 1
		}, function(data){
			var dataSet = data.result[0];

			$("#txtId").val(dataSet.id);
			$("#txtNamaSekolah").val(dataSet.nama_sekolah);
			$("#txtNPSN").val(dataSet.npsn);
			$("#txtAlamat").val(dataSet.alamat);
			$("#txtKelurahan").val(dataSet.kelurahan);
			$("#txtKecamatan").val(dataSet.kecamatan);
			$("#txtKabupatenKota").val(dataSet.kabupaten_kota);
			$("#txtProvinsi").val(dataSet.provinsi);
			$("#txtKodePos").val(dataSet.kode_pos);
			$("#txtNoTelpon").val(dataSet.no_telpon);
			$("#txtWebsite").val(dataSet.website);
			$("#txtEmail").val(dataSet.email);
			

		}, "json");
	}

	edit();

	function save(){
		var id = $("#txtId").val();
		var nama_sekolah = $("#txtNamaSekolah").val();
		var npsn = $("#txtNPSN").val();
		var alamat = $("#txtAlamat").val();
		var kelurahan = $("#txtKelurahan").val();
		var kecamatan = $("#txtKecamatan").val();
		var kabupaten_kota = $("#txtKabupatenKota").val();
		var provinsi = $("#txtProvinsi").val();
		var kode_pos = $("#txtKodePos").val();
		var no_telpon = $("#txtNoTelpon").val();
		var website = $("#txtWebsite").val();
		var email = $("#txtEmail").val();


		$.post("controller/data_identitas_sekolah.php",{
			act: "save",
			id: id,
			nama_sekolah: nama_sekolah,
			npsn: npsn,
			alamat: alamat,
			kelurahan: kelurahan,
			kecamatan: kecamatan,
			kabupaten_kota: kabupaten_kota,
			provinsi: provinsi,
			kode_pos: kode_pos,
			no_telpon: no_telpon,
			website: website,
			email: email
		}, function(data){

			if(data.status === true){
				alert("Identitas sekolah berhasil di simpan");
				edit();
			}else{
				alert("Data gagal di simpan");
			}

		}, "json");		

	}

</script>