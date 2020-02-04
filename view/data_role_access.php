<style type="text/css">
table.table-detail tr td{
	vertical-align: middle !important;
	padding: 8px 5px !important;
}
</style>
<section class="content-header">
	<h1>
		Data Akses Role
		<small>Akses admin</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-th"></i> Dashboard</a></li>
		<li class="active">Akses Role</li>
	</ol>
</section>

<section class="content">
	<div class="box box-widget">
		<div class="box-header with-border">
			<h6 class="box-title">Data Role Akses</h6>
			<div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool btnAdd" onclick="addNew();"><i class="fa fa-plus fa-fw"></i> Tambah</button>
			</div>
		</div>

		<div class="box-body">
			<div class="table-responsive">
				<table class="table table-responsive table-bordered table-hover dataGrid" id="dataGrid">
					<thead>
						<tr>
							<th style="text-align: left;">Nama Role</th>
							<th style="width:10%;text-align:center;"><i class="fa fa-gears fa-fw"></i></th>
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
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><i class="fa fa-times fa-fw"></i></button>
				<h5 class="modal-title" id="modalTitle"></h5>
			</div>

			<div class="modal-body" style="max-height: 480px;overflow: auto;">
				<input type="hidden" id="txtId" value="0">

				<div class="row">
					<div class="col-md-6 form-group">
						<label class="small-label">Nama Akses Role</label>
						<input type="text" class="form-control input-sm" id="txtNamaRole">
					</div>

					<div class="col-md-6" style="text-align: right;">
						<label class="small-label" style="display: block;">Check / Uncheck Semua</label>
						<button type="button" class="btn btn-primary btn-sm bg-blue pull-right" onclick="checkAllGroup();" style="display:block;margin-top: 10px !important;">Check</button>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-md-12">
						<div class="table-responsive">
							<table class="table table-bordered table-detail">
								<tbody>
									<tr class="info">
										<td colspan="5">
											<b class="label-check"><i class="fa fa-tag fa-fw"></i> Dashboard</b>
										</td>
									</tr>
									<tr>
										<td>
											<label class="label-check" onclick="checkAll(this);">
												Dashboard Page
											</label>
										</td>
										<td align="center">
											<input type="checkbox" class="role_akses" id="View_dashboard" name="role_akses" value="View_dashboard">
											<label for="View_dashboard"  class="label-check">Lihat</label>
										</td>
										<td align="center">
										</td>
										<td align="center">
										</td>
										<td align="center">
										</td>
									</tr>
									<tr class="info">
										<td colspan="5">
											<b class="label-check"><i class="fa fa-tag fa-fw"></i> Data Master</b>
										</td>
									</tr>
									<tr>
										<td>
											<label class="label-check" onclick="checkAll(this);">
												Data Identitas Sekolah
											</label>
										</td>
										<td align="center">
											<input type="checkbox" class="role_akses" id="View_data_identitas_sekolah" name="role_akses" value="View_data_identitas_sekolah">
											<label for="View_data_identitas_sekolah"  class="label-check">Lihat</label>
										</td>
										<td align="center">
										</td>
										<td align="center">
											<input type="checkbox" class="role_akses" id="Edit_data_identitas_sekolah" name="role_akses" value="Edit_data_identitas_sekolah">
											<label for="Edit_data_identitas_sekolah" class="label-check">Edit</label>
										</td>
										<td align="center">
										</td>
									</tr>
									<tr>
										<td>
											<label class="label-check" onclick="checkAll(this);">
												Data Kurikulum
											</label>
										</td>
										<td align="center">
											<input type="checkbox" class="role_akses" id="View_data_kurikulum" name="role_akses" value="View_data_kurikulum">
											<label for="View_data_kurikulum"  class="label-check">Lihat</label>
										</td>
										<td align="center">
											<input type="checkbox" class="role_akses" id="Tambah_data_kurikulum" name="role_akses" value="Tambah_data_kurikulum">
											<label for="Tambah_data_kurikulum" class="label-check">Tambah</label>
										</td>
										<td align="center">
											<input type="checkbox" class="role_akses" id="Edit_data_kurikulum" name="role_akses" value="Edit_data_kurikulum">
											<label for="Edit_data_kurikulum" class="label-check">Edit</label>
										</td>
										<td align="center">
											<input type="checkbox" class="role_akses" id="Hapus_data_kurikulum" name="role_akses" value="Hapus_data_kurikulum">
											<label for="Hapus_data_kurikulum" class="label-check">Hapus</label>
										</td>
									</tr>
									<tr>
										<td>
											<label class="label-check" onclick="checkAll(this);">
												Data Tahun Akademik
											</label>
										</td>
										<td align="center">
											<input type="checkbox" class="role_akses" id="View_data_tahun_akademik" name="role_akses" value="View_data_tahun_akademik">
											<label for="View_data_tahun_akademik"  class="label-check">Lihat</label>
										</td>
										<td align="center">
											<input type="checkbox" class="role_akses" id="Tambah_data_tahun_akademik" name="role_akses" value="Tambah_data_tahun_akademik">
											<label for="Tambah_data_tahun_akademik" class="label-check">Tambah</label>
										</td>
										<td align="center">
											<input type="checkbox" class="role_akses" id="Edit_data_tahun_akademik" name="role_akses" value="Edit_data_tahun_akademik">
											<label for="Edit_data_tahun_akademik" class="label-check">Edit</label>
										</td>
										<td align="center">
											<input type="checkbox" class="role_akses" id="Hapus_data_tahun_akademik" name="role_akses" value="Hapus_data_tahun_akademik">
											<label for="Hapus_data_tahun_akademik" class="label-check">Hapus</label>
										</td>
									</tr>
									<tr>
										<td>
											<label class="label-check" onclick="checkAll(this);">
												Data Golongan
											</label>
										</td>
										<td align="center">
											<input type="checkbox" class="role_akses" id="View_data_golongan" name="role_akses" value="View_data_golongan">
											<label for="View_data_golongan"  class="label-check">Lihat</label>
										</td>
										<td align="center">
											<input type="checkbox" class="role_akses" id="Tambah_data_golongan" name="role_akses" value="Tambah_data_golongan">
											<label for="Tambah_data_golongan" class="label-check">Tambah</label>
										</td>
										<td align="center">
											<input type="checkbox" class="role_akses" id="Edit_data_golongan" name="role_akses" value="Edit_data_golongan">
											<label for="Edit_data_golongan" class="label-check">Edit</label>
										</td>
										<td align="center">
											<input type="checkbox" class="role_akses" id="Hapus_data_golongan" name="role_akses" value="Hapus_data_golongan">
											<label for="Hapus_data_golongan" class="label-check">Hapus</label>
										</td>
									</tr>
									<tr>
										<td>
											<label class="label-check" onclick="checkAll(this);">
												Data Ketunaan
											</label>
										</td>
										<td align="center">
											<input type="checkbox" class="role_akses" id="View_data_ketunaan" name="role_akses" value="View_data_ketunaan">
											<label for="View_data_ketunaan"  class="label-check">Lihat</label>
										</td>
										<td align="center">
											<input type="checkbox" class="role_akses" id="Tambah_data_ketunaan" name="role_akses" value="Tambah_data_ketunaan">
											<label for="Tambah_data_ketunaan" class="label-check">Tambah</label>
										</td>
										<td align="center">
											<input type="checkbox" class="role_akses" id="Edit_data_ketunaan" name="role_akses" value="Edit_data_ketunaan">
											<label for="Edit_data_ketunaan" class="label-check">Edit</label>
										</td>
										<td align="center">
											<input type="checkbox" class="role_akses" id="Hapus_data_ketunaan" name="role_akses" value="Hapus_data_ketunaan">
											<label for="Hapus_data_ketunaan" class="label-check">Hapus</label>
										</td>
									</tr>
									<tr>
										<td>
											<label class="label-check" onclick="checkAll(this);">
												Data Keterampilan
											</label>
										</td>
										<td align="center">
											<input type="checkbox" class="role_akses" id="View_data_jurusan" name="role_akses" value="View_data_jurusan">
											<label for="View_data_jurusan"  class="label-check">Lihat</label>
										</td>
										<td align="center">
											<input type="checkbox" class="role_akses" id="Tambah_data_jurusan" name="role_akses" value="Tambah_data_jurusan">
											<label for="Tambah_data_jurusan" class="label-check">Tambah</label>
										</td>
										<td align="center">
											<input type="checkbox" class="role_akses" id="Edit_data_jurusan" name="role_akses" value="Edit_data_jurusan">
											<label for="Edit_data_jurusan" class="label-check">Edit</label>
										</td>
										<td align="center">
											<input type="checkbox" class="role_akses" id="Hapus_data_jurusan" name="role_akses" value="Hapus_data_jurusan">
											<label for="Hapus_data_jurusan" class="label-check">Hapus</label>
										</td>
									</tr>
									<tr>
										<td>
											<label class="label-check" onclick="checkAll(this);">
												Data Jenis PTK
											</label>
										</td>
										<td align="center">
											<input type="checkbox" class="role_akses" id="View_data_jenis_ptk" name="role_akses" value="View_data_jenis_ptk">
											<label for="View_data_jenis_ptk"  class="label-check">Lihat</label>
										</td>
										<td align="center">
											<input type="checkbox" class="role_akses" id="Tambah_data_jenis_ptk" name="role_akses" value="Tambah_data_jenis_ptk">
											<label for="Tambah_data_jenis_ptk" class="label-check">Tambah</label>
										</td>
										<td align="center">
											<input type="checkbox" class="role_akses" id="Edit_data_jenis_ptk" name="role_akses" value="Edit_data_jenis_ptk">
											<label for="Edit_data_jenis_ptk" class="label-check">Edit</label>
										</td>
										<td align="center">
											<input type="checkbox" class="role_akses" id="Hapus_data_jenis_ptk" name="role_akses" value="Hapus_data_jenis_ptk">
											<label for="Hapus_data_jenis_ptk" class="label-check">Hapus</label>
										</td>
									</tr>
									<tr>
										<td>
											<label class="label-check" onclick="checkAll(this);">
												Data Kelas
											</label>
										</td>
										<td align="center">
											<input type="checkbox" class="role_akses" id="View_data_kelas" name="role_akses" value="View_data_kelas">
											<label for="View_data_kelas"  class="label-check">Lihat</label>
										</td>
										<td align="center">
											<input type="checkbox" class="role_akses" id="Tambah_data_kelas" name="role_akses" value="Tambah_data_kelas">
											<label for="Tambah_data_kelas" class="label-check">Tambah</label>
										</td>
										<td align="center">
											<input type="checkbox" class="role_akses" id="Edit_data_kelas" name="role_akses" value="Edit_data_kelas">
											<label for="Edit_data_kelas" class="label-check">Edit</label>
										</td>
										<td align="center">
											<input type="checkbox" class="role_akses" id="Hapus_data_kelas" name="role_akses" value="Hapus_data_kelas">
											<label for="Hapus_data_kelas" class="label-check">Hapus</label>
										</td>
									</tr>
									<tr>
										<td>
											<label class="label-check" onclick="checkAll(this);">
												Data Status Kepegawaian
											</label>
										</td>
										<td align="center">
											<input type="checkbox" class="role_akses" id="View_data_status_kepegawaian" name="role_akses" value="View_data_status_kepegawaian">
											<label for="View_data_status_kepegawaian"  class="label-check">Lihat</label>
										</td>
										<td align="center">
											<input type="checkbox" class="role_akses" id="Tambah_data_status_kepegawaian" name="role_akses" value="Tambah_data_status_kepegawaian">
											<label for="Tambah_data_status_kepegawaian" class="label-check">Tambah</label>
										</td>
										<td align="center">
											<input type="checkbox" class="role_akses" id="Edit_data_status_kepegawaian" name="role_akses" value="Edit_data_status_kepegawaian">
											<label for="Edit_data_status_kepegawaian" class="label-check">Edit</label>
										</td>
										<td align="center">
											<input type="checkbox" class="role_akses" id="Hapus_data_status_kepegawaian" name="role_akses" value="Hapus_data_status_kepegawaian">
											<label for="Hapus_data_status_kepegawaian" class="label-check">Hapus</label>
										</td>
									</tr>
									<tr>
										<td>
											<label class="label-check" onclick="checkAll(this);">
												Data Agama
											</label>
										</td>
										<td align="center">
											<input type="checkbox" class="role_akses" id="View_data_agama" name="role_akses" value="View_data_agama">
											<label for="View_data_agama"  class="label-check">Lihat</label>
										</td>
										<td align="center">
											<input type="checkbox" class="role_akses" id="Tambah_data_agama" name="role_akses" value="Tambah_data_agama">
											<label for="Tambah_data_agama" class="label-check">Tambah</label>
										</td>
										<td align="center">
											<input type="checkbox" class="role_akses" id="Edit_data_agama" name="role_akses" value="Edit_data_agama">
											<label for="Edit_data_agama" class="label-check">Edit</label>
										</td>
										<td align="center">
											<input type="checkbox" class="role_akses" id="Hapus_data_agama" name="role_akses" value="Hapus_data_agama">
											<label for="Hapus_data_agama" class="label-check">Hapus</label>
										</td>
									</tr>
									<tr>
										<td>
											<label class="label-check" onclick="checkAll(this);">
												Data Files
											</label>
										</td>
										<td align="center">
											<input type="checkbox" class="role_akses" id="View_data_files" name="role_akses" value="View_data_files">
											<label for="View_data_files"  class="label-check">Lihat</label>
										</td>
										<td align="center">
											<input type="checkbox" class="role_akses" id="Tambah_data_files" name="role_akses" value="Tambah_data_files">
											<label for="Tambah_data_files" class="label-check">Tambah</label>
										</td>
										<td align="center">
											<input type="checkbox" class="role_akses" id="Edit_data_files" name="role_akses" value="Edit_data_files">
											<label for="Edit_data_files" class="label-check">Edit</label>
										</td>
										<td align="center">
											<input type="checkbox" class="role_akses" id="Hapus_data_files" name="role_akses" value="Hapus_data_files">
											<label for="Hapus_data_files" class="label-check">Hapus</label>
										</td>
									</tr>
									<tr class="info">
										<td colspan="5"><b><i class="fa fa-users fa-fw"></i> Data Pengguna</b></td>
									</tr>
									<tr>
										<td>
											<label class="label-check" onclick="checkAll(this);">
												Data Siswa
											</label>
										</td>
										<td align="center">
											<input type="checkbox" class="role_akses" id="View_data_siswa" name="role_akses" value="View_data_siswa">
											<label for="View_data_siswa"  class="label-check">Lihat</label>
										</td>
										<td align="center">
											<input type="checkbox" class="role_akses" id="Tambah_data_siswa" name="role_akses" value="Tambah_data_siswa">
											<label for="Tambah_data_siswa" class="label-check">Tambah</label>
										</td>
										<td align="center">
											<input type="checkbox" class="role_akses" id="Edit_data_siswa" name="role_akses" value="Edit_data_siswa">
											<label for="Edit_data_siswa" class="label-check">Edit</label>
										</td>
										<td align="center">
											<input type="checkbox" class="role_akses" id="Hapus_data_siswa" name="role_akses" value="Hapus_data_siswa">
											<label for="Hapus_data_siswa" class="label-check">Hapus</label>
										</td>
									</tr>
									<tr>
										<td>
											<label class="label-check" onclick="checkAll(this);">
												Data Guru
											</label>
										</td>
										<td align="center">
											<input type="checkbox" class="role_akses" id="View_data_guru" name="role_akses" value="View_data_guru">
											<label for="View_data_guru"  class="label-check">Lihat</label>
										</td>
										<td align="center">
											<input type="checkbox" class="role_akses" id="Tambah_data_guru" name="role_akses" value="Tambah_data_guru">
											<label for="Tambah_data_guru" class="label-check">Tambah</label>
										</td>
										<td align="center">
											<input type="checkbox" class="role_akses" id="Edit_data_guru" name="role_akses" value="Edit_data_guru">
											<label for="Edit_data_guru" class="label-check">Edit</label>
										</td>
										<td align="center">
											<input type="checkbox" class="role_akses" id="Hapus_data_guru" name="role_akses" value="Hapus_data_guru">
											<label for="Hapus_data_guru" class="label-check">Hapus</label>
										</td>
									</tr>
									<tr>
										<td>
											<label class="label-check" onclick="checkAll(this);">
												Data Administrator
											</label>
										</td>
										<td align="center">
											<input type="checkbox" class="role_akses" id="View_data_administrator" name="role_akses" value="View_data_administrator">
											<label for="View_data_administrator"  class="label-check">Lihat</label>
										</td>
										<td align="center">
											<input type="checkbox" class="role_akses" id="Tambah_data_administrator" name="role_akses" value="Tambah_data_administrator">
											<label for="Tambah_data_administrator" class="label-check">Tambah</label>
										</td>
										<td align="center">
											<input type="checkbox" class="role_akses" id="Edit_data_administrator" name="role_akses" value="Edit_data_administrator">
											<label for="Edit_data_administrator" class="label-check">Edit</label>
										</td>
										<td align="center">
											<input type="checkbox" class="role_akses" id="Hapus_data_administrator" name="role_akses" value="Hapus_data_administrator">
											<label for="Hapus_data_administrator" class="label-check">Hapus</label>
										</td>
									</tr>
									<tr>
										<td>
											<label class="label-check" onclick="checkAll(this);">
												Data Akses Role
											</label>
										</td>
										<td align="center">
											<input type="checkbox" class="role_akses" id="View_data_role_access" name="role_akses" value="View_data_role_access">
											<label for="View_data_role_access"  class="label-check">Lihat</label>
										</td>
										<td align="center">
											<input type="checkbox" class="role_akses" id="Tambah_data_role_access" name="role_akses" value="Tambah_data_role_access">
											<label for="Tambah_data_role_access" class="label-check">Tambah</label>
										</td>
										<td align="center">
											<input type="checkbox" class="role_akses" id="Edit_data_role_access" name="role_akses" value="Edit_data_role_access">
											<label for="Edit_data_role_access" class="label-check">Edit</label>
										</td>
										<td align="center">
											<input type="checkbox" class="role_akses" id="Hapus_data_role_access" name="role_akses" value="Hapus_data_role_access">
											<label for="Hapus_data_role_access" class="label-check">Hapus</label>
										</td>
									</tr>
									<tr class="info">
										<td colspan="5"><b><i class="fa fa-calendar fa-fw"></i> Ruang Guru</b></td>
									</tr>
									<tr>
										<td>
											<label class="label-check" onclick="checkAll(this);">
												Format Materi
											</label>
										</td>
										<td align="center">
											<input type="checkbox" class="role_akses" id="View_format_materi" name="role_akses" value="View_format_materi">
											<label for="View_format_materi"  class="label-check">Lihat</label>
										</td>
										<td align="center">
											<input type="checkbox" class="role_akses" id="Tambah_format_materi" name="role_akses" value="Tambah_format_materi">
											<label for="Tambah_format_materi" class="label-check">Tambah</label>
										</td>
										<td align="center">
											<input type="checkbox" class="role_akses" id="Edit_format_materi" name="role_akses" value="Edit_format_materi">
											<label for="Edit_format_materi" class="label-check">Edit</label>
										</td>
										<td align="center">
											<input type="checkbox" class="role_akses" id="Hapus_format_materi" name="role_akses" value="Hapus_format_materi">
											<label for="Hapus_format_materi" class="label-check">Hapus</label>
										</td>
									</tr>
									<tr>
										<td>
											<label class="label-check" onclick="checkAll(this);">
												Materi Kelas
											</label>
										</td>
										<td align="center">
											<input type="checkbox" class="role_akses" id="View_data_materi" name="role_akses" value="View_data_materi">
											<label for="View_data_materi"  class="label-check">Lihat</label>
										</td>
										<td align="center">
											<input type="checkbox" class="role_akses" id="Tambah_data_materi" name="role_akses" value="Tambah_data_materi">
											<label for="Tambah_data_materi" class="label-check">Tambah</label>
										</td>
										<td align="center">
											<input type="checkbox" class="role_akses" id="Edit_data_materi" name="role_akses" value="Edit_data_materi">
											<label for="Edit_data_materi" class="label-check">Edit</label>
										</td>
										<td align="center">
											<input type="checkbox" class="role_akses" id="Hapus_data_materi" name="role_akses" value="Hapus_data_materi">
											<label for="Hapus_data_materi" class="label-check">Hapus</label>
										</td>
									</tr>
									<tr>
										<td>
											<label class="label-check" onclick="checkAll(this);">
												Materi Bidang Studi
											</label>
										</td>
										<td align="center">
											<input type="checkbox" class="role_akses" id="View_data_materi_keterampilan" name="role_akses" value="View_data_materi_keterampilan">
											<label for="View_data_materi_keterampilan"  class="label-check">Lihat</label>
										</td>
										<td align="center">
											<input type="checkbox" class="role_akses" id="Tambah_data_materi_keterampilan" name="role_akses" value="Tambah_data_materi_keterampilan">
											<label for="Tambah_data_materi_keterampilan" class="label-check">Tambah</label>
										</td>
										<td align="center">
											<input type="checkbox" class="role_akses" id="Edit_data_materi_keterampilan" name="role_akses" value="Edit_data_materi_keterampilan">
											<label for="Edit_data_materi_keterampilan" class="label-check">Edit</label>
										</td>
										<td align="center">
											<input type="checkbox" class="role_akses" id="Hapus_data_materi_keterampilan" name="role_akses" value="Hapus_data_materi_keterampilan">
											<label for="Hapus_data_materi_keterampilan" class="label-check">Hapus</label>
										</td>
									</tr>
									<tr>
										<td>
											<label class="label-check" onclick="checkAll(this);">
												Rekap Absensi
											</label>
										</td>
										<td align="center">
											<input type="checkbox" class="role_akses" id="View_rekap_absensi_siswa" name="role_akses" value="View_rekap_absensi_siswa">
											<label for="View_rekap_absensi_siswa"  class="label-check">Lihat</label>
										</td>
										<td align="center">
										</td>
										<td align="center">
										</td>
										<td align="center">
										</td>
									</tr>
									<tr class="info">
										<td colspan="5"><b><i class="fa fa-user-plus fa-fw"></i> Pendaftaran</b></td>
									</tr>
									<tr>
										<td>
											<label class="label-check" onclick="checkAll(this);">
												Pendaftaran Siswa Baru
											</label>
										</td>
										<td align="center">
											<input type="checkbox" class="role_akses" id="View_pendaftaran" name="role_akses" value="View_pendaftaran">
											<label for="View_pendaftaran"  class="label-check">Lihat</label>
										</td>
										<td align="center">
											<input type="checkbox" class="role_akses" id="Tambah_pendaftaran" name="role_akses" value="Tambah_pendaftaran">
											<label for="Tambah_pendaftaran" class="label-check">Tambah</label>
										</td>
										<td align="center">
											<input type="checkbox" class="role_akses" id="Edit_pendaftaran" name="role_akses" value="Edit_pendaftaran">
											<label for="Edit_pendaftaran" class="label-check">Edit</label>
										</td>
										<td align="center">
											<input type="checkbox" class="role_akses" id="Hapus_pendaftaran" name="role_akses" value="Hapus_pendaftaran">
											<label for="Hapus_pendaftaran" class="label-check">Hapus</label>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
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
			url: "controller/role_access.php",
			type: "post",
			data: {
				act: "getAll",
			}
		},
		columns: [
		{data: "nama_role"},
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


	//Check Akses Role
	function checkAll(str){
		var get_checkbox = $(str).parents("tr").find("input[type='checkbox']");
		var stt = get_checkbox.prop("checked") === true ? false : true;

		$(str).parents("tr").find("input[type='checkbox']").prop("checked", stt);
	}


	function checkAllGroup(str){
		var get_checkbox = $("input[type='checkbox']");
		var stt = get_checkbox.prop("checked") === true ? false : true;

		$("input[type='checkbox']").prop("checked", stt);
	}

	function resetField(){
		$("#txtNamaRole").prop("disabled", false);
		$("#txtId").val("0");
		$("#modalForm .form-control").val("");
		$("#txtNamaRole").focus();
		$(".role_akses").prop("checked", false);
	}

	function addNew(){
		resetField();

		$("#modalTitle").html("<i class='fa fa-plus fa-fw'></i> Tambah Baru");

		$("#modalForm").modal({
			backdrop: "static"
		});
	}

	function edit(id){
		resetField();

		$("#txtNamaRole").prop("disabled", true);

		$.post("controller/role_access.php",{
			act: "getData",
			id: id
		}, function(data){
			var dataSet = data.result[0];

			$("#txtId").val(dataSet.id);
			$("#txtNamaRole").val(dataSet.nama_role);

			$(data.detail_role).each(function(i, val){
				$("#"+val.role_akses).prop("checked", true);
			});

			$("#modalTitle").html("<i class='fa fa-pencil fa-fw'></i> Edit Data");

			$("#modalForm").modal({
				backdrop: "static"
			});

		}, "json");
	}

	function del(id){
		var konfirmasi = confirm("Apakah yakin akan menghapus data ini ?");

		if(konfirmasi){
			$.post("controller/role_access.php",{
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
		var nama_role = $("#txtNamaRole").val();
		var role_akses = $(".role_akses:checked").serializeArray();

		$.post("controller/role_access.php",{
			act: "save",
			id: id,
			nama_role: nama_role,
			role_akses: role_akses
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
