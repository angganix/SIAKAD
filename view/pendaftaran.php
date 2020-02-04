<style type="text/css">
    .form-table > tbody tr td{
        border-top: 0px !important;
        padding: 2px 10px !important;
        vertical-align: middle !important;
    }

    .form-table > tbody tr td:first-child{
        font-weight: bold;
    }

    .select2-container{
        margin-top: 0px !important;
        margin-bottom: 6px !important;
    }

    .p-0{
        padding: 0px !important;
    }

    #box-filter .select2-container .select2-selection--single{
        height: 33px !important;
    }
</style>
<section class="content-header">
    <h1>
        Pendaftaran Siswa Baru
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-th"></i> Dashboard</a></li>
        <li class="active">Pendaftaran</li>
    </ol>
</section>

<section class="content">
    <div class="box box-widget">
        <div class="box-header">
            <h6 class="box-title">Calon Siswa Baru</h6>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool btnExport bg-green" onclick="exportExcel();"><i class="fa fa-file-excel-o fa-fw"></i> Excel</button>  			
                <button type="button" class="btn btn-box-tool btnExport bg-red" onclick="exportPDF();"><i class="fa fa-file-pdf-o fa-fw"></i> PDF</button>	
                <button type="button" class="btn btn-box-tool btnFilter bg-orange" onclick="toggleFilter()"><i class="fa fa-filter fa-fw"></i> Filter</button>
                <button type="button" class="btn btn-box-tool btnAdd" onclick="addNew();"><i class="fa fa-plus fa-fw"></i> Tambah</button>
            </div>
        </div>
        <div class="box-header with-border" style="border-top:1px solid #ddd;display:none;" id="box-filter">
            <div class="row">
                <div class="col-md-3">
                    <select class="form-control input-sm select2" id="txtFilterKelas">
                    <option value="0">- Pilih Kelas -</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <select class="form-control input-sm select2" id="txtFilterKetunaan">
                    <option value="0">- Pilih Ketunaan -</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <select class="form-control input-sm" id="txtFilterStatus">
                        <option value="-">- Pilih Status -</option>
                        <option value="2">Pendaftaran</option>
                        <option value="1">Diterima</option>
                        <option value="0">Tidak Diterima</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <input type="text" class="form-control input-sm tahun" id="txtFilterTahun" value="<?=date("Y");?>">
                </div>
                <div class="col-md-1">
                    <button type="button" class="btn btn-primary btn-sm bg-aqua" onclick="apply_filter();"><i class="fa fa-arrow-right"></i></button>
                </div>
            </div>
        </div>

        <div class="box-body">
            <div class="table-responsive">
                <table class="table table-condensed table-responsive table-bordered table-hover dataGrid" id="dataGrid">
                    <thead>
                        <tr>
                            <th style="text-align: center;width:10%;">No. Daftar</th>
                            <th style="text-align: center;width:10%;">Tahun</th>
                            <th style="text-align: left">Nama</th>
                            <th style="text-align: center">Ketunaan</th>
                            <th style="text-align: center">Kelas</th>
                            <th style="text-align: center;width:12%;">Status</th>
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

<form action="" method="post" enctype="multipart/form-data" id="form-pendaftaran">
    <div class="modal fade" id="modalForm">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times fa-fw"></i></button>
                    <h5 class="modal-title" id="modalTitle"></h5>
                </div>

                <div class="modal-body">
                    <input type="hidden" id="txtId" name="id" value="0">
                    <input type="hidden" id="act" name="act" value="save">
                    <div class="row">
                        <div class="col-md-12">
                            <h4 style="text-align: center;font-weight: bold;">
                                FORMULIR PENERIMAAN PESERTA DIDIK BARU<br>
                                SLB NEGERI 5 JAKARTA TAHUN PELAJARAN <?= date("Y"); ?>/<?= date("Y", strtotime("+1 years")); ?>
                            </h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table form-table table-bordered">
                                <tr class="info">
                                    <td colspan="2" style="font-weigh:bold;padding: 8px !important;">A. KETERANGAN CALON PESERTA DIDIK</td>
                                </tr>
                                <tr class="form-group">
                                    <td width="22%">NIK</td>
                                    <td>
                                        <div class="col-sm-6 p-0">
                                            <input type="text" class="form-control input-sm" name="nik" id="txtNIK" required>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="form-group">
                                    <td>Tanggal Daftar</td>
                                    <td>
                                        <div class="col-sm-2 p-0">
                                            <input type="text" class="form-control input-sm tanggal" name="tanggal_daftar" id="txtTanggalDaftar" value="<?= date("Y-m-d"); ?>">
                                        </div>
                                    </td>
                                </tr>
                                <tr class="form-group">
                                    <td>Nama Lengkap</td>
                                    <td>
                                        <div class="col-sm-12 p-0">
                                            <input type="text" class="form-control input-sm" name="nama_lengkap" id="txtNamaLengkap">
                                        </div>
                                    </td>
                                </tr>
                                <tr class="form-group">
                                    <td>Nama Panggilan</td>
                                    <td>
                                        <div class="col-sm-6 p-0">
                                            <input type="text" class="form-control input-sm" name="nama_panggilan" id="txtPanggilan">
                                        </div>
                                    </td>
                                </tr>
                                <tr class="form-group">
                                    <td>Jenis Kelamin</td>
                                    <td>
                                        <div class="col-sm-4 p-0" style="padding-top: 8px !important;padding-bottom: 0px !important;">
                                            <div class="col-xs-6 p-0">
                                                <input type="radio" id="txtGenderL" name="jenis_kelamin" value="l"> <label for="txtGenderL">Laki-laki</label>
                                            </div>
                                            <div class="col-xs-6 p-0">
                                                <input type="radio" id="txtGenderP" name="jenis_kelamin" value="p"> <label for="txtGenderP">Perempuan</label>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="form-group">
                                    <td>Tempat Lahir</td>
                                    <td>
                                        <div class="col-sm-8 p-0">
                                            <input type="text" class="form-control input-sm" name="tempat_lahir" id="txtTempatLahir">
                                        </div>
                                    </td>
                                </tr>
                                <tr class="form-group">
                                    <td>Tanggal Lahir</td>
                                    <td>
                                        <div class="col-sm-2 p-0">
                                            <input type="text" class="form-control input-sm" name="tanggal_lahir" id="txtTanggalLahir">
                                        </div>
                                    </td>
                                </tr>
                                <tr class="form-group">
                                    <td>Agama</td>
                                    <td>
                                        <div class="col-sm-3 p-0">
                                            <select class="form-control input-sm" name="agama" id="txtAgama">

                                            </select>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="form-group">
                                    <td>Status Dalam Keluarga</td>
                                    <td>
                                        <div class="col-sm-4 p-0">
                                            <select class="form-control input-sm" name="status_dalam_keluarga" id="txtStatusDalamKeluarga">
                                                <option value="Anak Kandung">Anak Kandung</option>
                                                <option value="Anak Tiri">Anak Tiri</option>
                                                <option value="Anak Angkat">Anak Angkat</option>
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="form-group">
                                    <td>Jumlah Saudara</td>
                                    <td>
                                        <div class="col-sm-1 p-0">
                                            <input type="number" class="form-control input-sm" name="jumlah_saudara" id="txtJumlahSaudara">
                                        </div>
                                    </td>
                                </tr>
                                <tr class="form-group">
                                    <td>Anak Ke</td>
                                    <td>
                                        <div class="col-sm-1 p-0">
                                            <input type="number" class="form-control input-sm" name="anak_ke" id="txtAnakKe">
                                        </div>
                                    </td>
                                </tr>
                                <tr class="form-group">
                                    <td>Alamat</td>
                                    <td>
                                        <div class="col-sm-12 p-0">
                                            <input type="text" class="form-control input-sm" name="alamat" id="txtAlamat">
                                        </div>
                                    </td>
                                </tr>
                                <tr class="form-group">
                                    <td>RT/RW</td>
                                    <td>
                                        <div class="col-sm-2 p-0">
                                            <input type="text" class="form-control input-sm" name="rt_rw" id="txtRTRW">
                                        </div>
                                    </td>
                                </tr>
                                <tr class="form-group">
                                    <td>Kelurahan</td>
                                    <td>
                                        <div class="col-sm-6 p-0">
                                            <input type="text" class="form-control input-sm" name="kelurahan" id="txtKelurahan">
                                        </div>
                                    </td>
                                </tr>
                                <tr class="form-group">
                                    <td>Kecamatan</td>
                                    <td>
                                        <div class="col-sm-6 p-0">
                                            <input type="text" class="form-control input-sm" name="kecamatan" id="txtKecamatan">
                                        </div>
                                    </td>
                                </tr>
                                <tr class="form-group">
                                    <td>Kota</td>
                                    <td>
                                        <div class="col-sm-6 p-0">
                                            <input type="text" class="form-control input-sm" name="kota" id="txtKota">
                                        </div>
                                    </td>
                                </tr>
                                <tr class="form-group">
                                    <td>Provinsi</td>
                                    <td>
                                        <div class="col-sm-6 p-0">
                                            <input type="text" class="form-control input-sm" name="provinsi" id="txtProvinsi">
                                        </div>
                                    </td>
                                </tr>
                                <tr class="form-group">
                                    <td>Kode POS</td>
                                    <td>
                                        <div class="col-sm-3 p-0">
                                            <input type="text" class="form-control input-sm" name="kode_pos" id="txtKodePOS">
                                        </div>
                                    </td>
                                </tr>
                                <tr class="form-group">
                                    <td>Nomor HP/Telpon</td>
                                    <td>
                                        <div class="col-sm-6 p-0">
                                            <input type="text" class="form-control input-sm" name="no_telpon" id="txtNoTelpon" placeholder="nomor yang bisa dihubungi">
                                        </div>
                                    </td>
                                </tr>
                                <tr class="info">
                                    <td colspan="2" style="font-weigh:bold;padding: 8px !important;">B. JENIS KETUNAAN / KETERAMPILAN / BAKAT</td>
                                </tr>
                                <tr class="form-group">
                                    <td>Kelas</td>
                                    <td>
                                        <div class="col-sm-4 p-0">
                                            <select class="form-control input-sm select2" name="kelas" id="txtKelas"></select>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="form-group">
                                    <td>Jenis Ketunaan</td>
                                    <td>
                                        <div class="col-sm-4 p-0">
                                            <select class="form-control input-sm" name="ketunaan" id="txtKetunaan"></select>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="form-group">
                                    <td>Hobi</td>
                                    <td>
                                        <div class="col-sm-12 p-0">
                                            <input type="text" class="form-control input-sm" name="hobi" id="txtHobi" placeholder="">
                                        </div>
                                    </td>
                                </tr>
                                <tr class="form-group">
                                    <td>Olahraga yang digemari</td>
                                    <td>
                                        <div class="col-sm-12 p-0">
                                            <input type="text" class="form-control input-sm" name="olahraga_yang_digemari" id="txtOlahragaYangDigemari" placeholder="">
                                        </div>
                                    </td>
                                </tr>
                                <tr class="info">
                                    <td colspan="2" style="font-weigh:bold;padding: 8px !important;">C. KETERANGAN ORANG TUA KANDUNG</td>
                                </tr>
                                <tr class="success">
                                    <td colspan="2" style="padding:8px !important;font-weight:bold;">1. Nama Lengkap</td>
                                </tr>
                                <tr class="form-group">
                                    <td>a. Ayah</td>
                                    <td>
                                        <div class="col-sm-12 p-0">
                                            <input type="text" class="form-control input-sm" name="nama_ayah" id="txtNamaAyah" placeholder="">
                                        </div>
                                    </td>
                                </tr>
                                <tr class="form-group">
                                    <td>b. Ibu</td>
                                    <td>
                                        <div class="col-sm-12 p-0">
                                            <input type="text" class="form-control input-sm" name="nama_ibu" id="txtNamaIbu" placeholder="">
                                        </div>
                                    </td>
                                </tr>
                                <tr class="success">
                                    <td colspan="2" style="padding:8px !important;font-weight:bold;">2. Tempat, Tanggal Lahir</td>
                                </tr>
                                <tr class="form-group">
                                    <td>a. Ayah</td>
                                    <td>
                                        <div class="col-sm-9 p-0">
                                            <input type="text" class="form-control input-sm" name="tempat_lahir_ayah" id="txtTempatLahirAyah" placeholder="Tempat Lahir Ayah">
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control input-sm tanggal" name="tanggal_lahir_ayah" id="txtTanggalLahirAyah" placeholder="Tanggal Lahir">
                                        </div>
                                    </td>
                                </tr>
                                <tr class="form-group">
                                    <td>b. Ibu</td>
                                    <td>
                                        <div class="col-sm-9 p-0">
                                            <input type="text" class="form-control input-sm" name="tempat_lahir_ibu" id="txtTempatLahirIbu" placeholder="Tempat Lahir Ibu">
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control input-sm tanggal" name="tanggal_lahir_ibu" id="txtTanggalLahirIbu" placeholder="Tanggal Lahir">
                                        </div>
                                    </td>
                                </tr>
                                <tr class="success">
                                    <td colspan="2" style="padding:8px !important;font-weight:bold;">3. Pekerjaan</td>
                                </tr>
                                <tr class="form-group">
                                    <td>a. Ayah</td>
                                    <td>
                                        <div class="col-sm-12 p-0">
                                            <input type="text" class="form-control input-sm" name="pekerjaan_ayah" id="txtPekerjaanAyah" placeholder="Pekerjaan Ayah">
                                        </div>
                                    </td>
                                </tr>
                                <tr class="form-group">
                                    <td>b. Ibu</td>
                                    <td>
                                        <div class="col-sm-12 p-0">
                                            <input type="text" class="form-control input-sm" name="pekerjaan_ibu" id="txtPekerjaanIbu" placeholder="Pekerjaan Ibu">
                                        </div>
                                    </td>
                                </tr>
                                <tr class="success">
                                    <td colspan="2" style="padding:8px !important;font-weight:bold;">4. Penghasilan rata-rata perbulan</td>
                                </tr>
                                <tr class="form-group">
                                    <td>a. Ayah</td>
                                    <td>
                                        <div class="col-sm-12 p-0">
                                            <input type="text" class="form-control input-sm" name="penghasilan_ayah" id="txtPenghasilanAyah" placeholder="Penghasilan rata-rata">
                                        </div>
                                    </td>
                                </tr>
                                <tr class="form-group">
                                    <td>b. Ibu</td>
                                    <td>
                                        <div class="col-sm-12 p-0">
                                            <input type="text" class="form-control input-sm" name="penghasilan_ibu" id="txtPenghasilanIbu" placeholder="Penghasilan rata-rata">
                                        </div>
                                    </td>
                                </tr>
                                <tr class="success">
                                    <td colspan="2" style="padding:8px !important;font-weight:bold;">5. Keterangan</td>
                                </tr>
                                <tr class="form-group">
                                    <td>a. Ayah</td>
                                    <td>
                                        <div class="col-sm-4 p-0">
                                            <select class="form-control input-sm" name="keadaan_ayah" id="txtKeadaanAyah"></select>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="form-group">
                                    <td>b. Ibu</td>
                                    <td>
                                        <div class="col-sm-4 p-0">
                                            <select class="form-control input-sm" name="keadaan_ibu" id="txtKeadaanIbu"></select>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="form-group">
                                    <td>6. Alamat Ayah Ibu</td>
                                    <td>
                                        <div class="col-sm-12 p-0">
                                            <input type="text" class="form-control input-sm" name="alamat_ayah_ibu" id="txtAlamatAyahIbu">
                                        </div>
                                    </td>
                                </tr>
                                <tr class="info">
                                    <td colspan="2" style="font-weigh:bold;padding: 8px !important;">D. KETERANGAN WALI</td>
                                </tr>
                                <tr class="form-group">
                                    <td>1. Nama Lengkap</td>
                                    <td>
                                        <div class="col-sm-12 p-0">
                                            <input type="text" class="form-control input-sm" name="nama_wali" id="txtNamaWali">
                                        </div>
                                    </td>
                                </tr>
                                <tr class="form-group">
                                    <td>2. Jenis Kelamin</td>
                                    <td>
                                        <div class="col-sm-4 p-0" style="padding-top: 8px !important;padding-bottom: 0px !important;">
                                            <div class="col-xs-6 p-0">
                                                <input type="radio" id="txtGenderWaliL" name="jenis_kelamin_wali" value="l"> <label for="txtGenderWaliL">Laki-laki</label>
                                            </div>
                                            <div class="col-xs-6 p-0">
                                                <input type="radio" id="txtGenderWaliP" name="jenis_kelamin_wali" value="p"> <label for="txtGenderWaliP">Perempuan</label>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="form-group">
                                    <td>3. Tempat, Tanggal Lahir</td>
                                    <td>
                                        <div class="col-sm-9 p-0">
                                            <input type="text" class="form-control input-sm" name="tempat_lahir_wali" id="txtTempatLahirWali" placeholder="Tempat Lahir Wali">
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control input-sm tanggal" name="tanggal_lahir_wali" id="txtTanggalLahirWali" placeholder="Tanggal Lahir">
                                        </div>
                                    </td>
                                </tr>
                                <tr class="form-group">
                                    <td>4. Agama</td>
                                    <td>
                                        <div class="col-sm-3 p-0">
                                            <select class="form-control input-sm" name="agama_wali" id="txtAgamaWali">

                                            </select>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="form-group">
                                    <td>5. Pekerjaan</td>
                                    <td>
                                        <div class="col-sm-12 p-0">
                                            <input type="text" class="form-control input-sm" name="pekerjaan_wali" id="txtPekerjaanWali" placeholder="Pekerjaan Wali">
                                        </div>
                                    </td>
                                </tr>
                                <tr class="form-group">
                                    <td>6. Penghasilan</td>
                                    <td>
                                        <div class="col-sm-12 p-0">
                                            <input type="text" class="form-control input-sm" name="penghasilan_wali" id="txtPenghasilanWali">
                                        </div>
                                    </td>
                                </tr>
                                <tr class="form-group">
                                    <td>7. Alamat</td>
                                    <td>
                                        <div class="col-sm-12 p-0">
                                            <input type="text" class="form-control input-sm" name="alamat_wali" id="txtAlamatWali">
                                        </div>
                                    </td>
                                </tr>
                                <tr class="info">
                                    <td colspan="2" style="font-weigh:bold;padding: 8px !important;">E. PAS FOTO SISWA</td>
                                </tr>
                                <tr>
                                    <td>Pas Foto</td>
                                    <td>
                                        <div class="col-sm-6 p-0">
                                            <input type="file" class="form-control input-sm" id="txtFoto" name="foto" onchange="previewImage(this)">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>
                                        <div class="col-sm-4 p-0">
                                            <img id="thumbnil" class='img-responsive' style='width: 120px;height: 160px;object-fit:contain;object-position:center;margin-top:10px;margin-bottom:10px;box-shadow:0px 0.55px 9px #ccc;border-radius:2px;'/>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-warning btn-sm" data-dismiss="modal"><i class="fa fa-times fa-fw"></i> Tutup</button>
                    <button type="submit" class="btn btn-success btn-sm" ><i class="fa fa-check fa-fw"></i> Simpan</button>
                </div>
            </div>
        </div>
    </div>
</form>


<!-- Modal Export Excel -->
<div class="modal fade" id="modalExportExcel">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body">
                <label><i class="fa fa-calendar fa-fw"></i> Masukan Tahun</label>
                <input type="text" class="form-control input-sm tahun" id="txtTahunExportExcel" value="<?=date("Y");?>">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-warning bg-orange" data-dismiss="modal"><i class="fa fa-times fa-fw"></i> Tutup</button>
                <button type="button" class="btn btn-sm btn-success bg-green" onclick="export_excel_pendaftaran();"><i class="fa fa-print fa-fw"></i> Export</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    function toggleFilter(){
        $("#box-filter").slideToggle();
    }

    

    var tabel = $("#dataGrid").DataTable({
        iDisplayLength: 100,
        processing: true,
        serverSide: true,
        paging: true,
        "ajax": {
            url: "controller/pendaftaran.php",
            type: "post",
            data: function(req){
                req.act = "getAll";
                req.filter_kelas = $("#txtFilterKelas").val();
                req.filter_ketunaan = $("#txtFilterKetunaan").val();
                req.filter_status = $("#txtFilterStatus").val();
                req.filter_tahun = $("#txtFilterTahun").val();
            }
        },
        columns: [
            {
                className: "centerCol",
                data: "nomor_pendaftaran"
            },
            {
                data: "tahun_daftar",
                className: "centerCol"
            },
            {data: "nama_siswa"},
            {
                data: {
                    "kode_ketunaan": "kode_ketunaan",
                    "nama_ketunaan": "nama_ketunaan"
                },
                render: function(data){
                    return "["+data.kode_ketunaan+"] "+data.nama_ketunaan;
                }
            },
            {
                data: "nama_kelas",
                className: "centerCol"
            },
            {
                data: {
                    "status_pendaftaran": "status_pendaftaran",
                    "id_daftar": "id_daftar"
                },
                render: function(data){
                    var status_daftar = "";
                    status_daftar += "<select class='form-control input-sm' id='option_status_"+data.id_daftar+"' onchange='update_status("+data.id_daftar+")'>";
                    status_daftar += "<option value='2' "+(data.status_pendaftaran === "2" ? "selected" : "" )+">Pendaftaran</option>";
                    status_daftar += "<option value='1' "+(data.status_pendaftaran === "1" ? "selected" : "" )+">Diterima</option>";
                    status_daftar += "<option value='0' "+(data.status_pendaftaran === "0" ? "selected" : "" )+">Tidak Diterima</option>";
                    status_daftar += "</select>";
                    return status_daftar;
                }
            },
            {
                data: null,
                className: "centerCol",
                sortable: false,
                defaultContent: "<button type='button' class='btn btn-info bg-red btn-xs btnPersonPDF'><i class='fa fa-file-pdf-o fa-fw'></i></button> <button type='button' class='btn btn-info btn-xs btnEdit'><i class='fa fa-pencil fa-fw'></i></button> <button type='button' class='btn btn-danger btn-xs btnDel'><i class='fa fa-trash fa-fw'></i></button>"
            }
        ]
    });

    function apply_filter(){
        tabel.ajax.reload();
    }

    

    function update_status(id_daftar){
        var status_daftar = $("#option_status_"+id_daftar).val();

        $.post("controller/pendaftaran.php",{
            act: "update_status",
            id: id_daftar,
            status_daftar: status_daftar
        }, function(data){
            if(data.status === true){
                tabel.ajax.reload();
            }else{
                alert("Failed while save data");
            }
        }, "json");
    }

    $("#dataGrid tbody").on("click", ".btnEdit", function () {
        var data = tabel.row($(this).parents("tr")).data();
        edit(data[0]);
    });

    $("#dataGrid tbody").on("click", ".btnDel", function () {
        var data = tabel.row($(this).parents("tr")).data();
        del(data[0]);
    });

    $("#dataGrid tbody").on("click", ".btnPersonPDF", function(){
        var data = tabel.row($(this).parents("tr")).data();
        personPDF(data[0]);
    });

    function resetField() {
        $("#txtId").val("0");
        $("#modalForm .form-control").val("");
        $("#modalForm select").val("0");
        $("#txtNIK").focus();
        $("#thumbnil").prop("src", "upload/notfound.jpg");
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

        $.post("controller/pendaftaran.php", {
            act: "getData",
            id: id
        }, function (data) {
            var data_siswa = data.result[0];
            var data_ortu = data.result_ortu[0];

            //Set Detail Data Siswa
            $("#txtId").val(data_siswa.id);
            $("#txtTanggalDaftar").val(data_siswa.tanggal_daftar);
            $("#txtNIK").val(data_siswa.nik);
            $("#txtNamaLengkap").val(data_siswa.nama_siswa);
            $("#txtPanggilan").val(data_siswa.nama_panggilan);
            $("#txtKelas").val(data_siswa.kelas).trigger("change");
            $("#txtKetunaan").val(data_siswa.ketunaan).trigger("change");
            $("#txtAlamat").val(data_siswa.alamat);
            $("#txtRTRW").val(data_siswa.rt_rw);
            $("#txtKelurahan").val(data_siswa.kelurahan);
            $("#txtKecamatan").val(data_siswa.kecamatan);
            $("#txtKota").val(data_siswa.kota);
            $("#txtProvinsi").val(data_siswa.provinsi);
            $("#txtKodePOS").val(data_siswa.kode_pos);
            $("#txtTempatLahir").val(data_siswa.tempat_lahir);
            $("#txtTanggalLahir").val(data_siswa.tanggal_lahir);
            if (data_siswa.jenis_kelamin === "l") {
                $("#txtGenderL").prop("checked", true);
            } else {
                $("#txtGenderP").prop("checked", true);
            }
            $("#txtAgama").val(data_siswa.agama);
            $("#txtNoTelpon").val(data_siswa.no_dihubungi);
            $("#txtJumlahSaudara").val(data_siswa.jumlah_saudara);
            $("#txtAnakKe").val(data_siswa.anak_ke);
            $("#txtHobi").val(data_siswa.hobi);
            $("#txtStatusDalamKeluarga").val(data_siswa.status_dalam_keluarga);

            $("#thumbnil").attr("src", "upload/" + data_siswa.foto);

            //Set Detail Data Ortu
            if (data.result_ortu !== "kosong") {
                $("#txtNamaAyah").val(data_ortu.nama_ayah);
                $("#txtTempatLahirAyah").val(data_ortu.tempat_lahir_ayah);
                $("#txtTanggalLahirAyah").val(data_ortu.tanggal_lahir_ayah);
                $("#txtPekerjaanAyah").val(data_ortu.pekerjaan_ayah);
                $("#txtPenghasilanAyah").val(data_ortu.penghasilan_ayah);
                $("#txtKeadaanAyah").val(data_ortu.keadaan_ayah);
                $("#txtNamaIbu").val(data_ortu.nama_ibu);
                $("#txtTempatLahirIbu").val(data_ortu.tempat_lahir_ibu);
                $("#txtTanggalLahirIbu").val(data_ortu.tanggal_lahir_ibu);
                $("#txtPekerjaanIbu").val(data_ortu.pekerjaan_ibu);
                $("#txtPenghasilanIbu").val(data_ortu.penghasilan_ibu);
                $("#txtKeadaanIbu").val(data_ortu.keadaan_ibu);
                $("#txtNamaWali").val(data_ortu.nama_wali);
                $("#txtTempatLahirWali").val(data_ortu.tempat_lahir_wali);
                $("#txtTanggalLahirWali").val(data_ortu.tanggal_lahir_wali);
                $("#txtPekerjaanWali").val(data_ortu.pekerjaan_wali);
                $("#txtPenghasilanWali").val(data_ortu.penghasilan_wali);
            }

                $("#txtOlahragaYangDigemari").val(data_siswa.olahraga_yang_digemari);
                $("#txtAlamatAyahIbu").val(data_siswa.alamat_ayah_ibu);
                $("#txtAlamatWali").val(data_siswa.alamat_wali);
                $("#txtAgamaWali").val(data_siswa.agama_wali);
                if (data_siswa.gender_wali === "l") {
                    $("#txtGenderWaliL").prop("checked", true);
                } else {
                    $("#txtGenderWaliP").prop("checked", true);
                }

            $("#modalTitle").html("<i class='fa fa-pencil fa-fw'></i> Edit Data");

            $("#modalForm").modal({
                backdrop: "static"
            });

        }, "json");
    }

    function del(id) {
        var konfirmasi = confirm("Apakah yakin akan menghapus data ini ?");

        if (konfirmasi) {
            $.post("controller/pendaftaran.php", {
                act: "del",
                id: id
            }, function (data) {
                if (data.status === true) {
                    tabel.ajax.reload();
                } else {
                    alert("Data gagal di hapus");
                }

            }, "json");
        }
    }

    function previewImage(fileInput) {
        var files = fileInput.files;
        for (var i = 0; i < files.length; i++) {
            var file = files[i];
            var imageType = /image.*/;
            if (!file.type.match(imageType)) {
                continue;
            }
            var img = document.getElementById("thumbnil");
            img.file = file;
            var reader = new FileReader();
            reader.onload = (function (aImg) {
                return function (e) {
                    aImg.src = e.target.result;
                };
            })(img);
            reader.readAsDataURL(file);
        }
    }
    
    
    function getRelatedData() {
        $.post("controller/data_siswa.php", {
            act: "getRelatedData"
        }, function (data) {
            var lst_kelas = "";
            var lst_tahun_akademik = "";
            var lst_ketunaan = "";
            var lst_status_awal = "";
            var lst_agama = "";
            var lst_status = "";
            var lst_jurusan = "";
            var lst_semester_filter = "";
            var lst_keadaan_ayah = "";
            var lst_keadaan_ibu = "";

            //Set Kelas
            lst_kelas += "<option value='0' selected>-Pilih Kelas -</option>";
            $(data.lst_kelas).each(function (i, val) {
                lst_kelas += "<option value='" + val.id + "'>" + val.nama_kelas + "</option>";
            });

            //Set tahun akademik
            lst_tahun_akademik += "<option value='0'>-Pilih Tahun Akademik-</option>";
            $(data.lst_tahun_akademik).each(function (i, val) {
                lst_tahun_akademik += "<option value='" + val.id + "'> " + val.semester + "</option>";
            });

            //Set Ketunaan
            lst_ketunaan += "<option value='0' selected>-Pilih Ketunaan-</option>";
            $(data.lst_ketunaan).each(function (i, val) {
                lst_ketunaan += "<option value='" + val.id + "'>[" + val.kode_ketunaan + "] " + val.nama_ketunaan + "</option>";
            });

            //Set Status Awal
            lst_status_awal += "<option value='0'>-Pilih Status Awal -</option>";
            $(data.lst_status_awal).each(function (i, val) {
                lst_status_awal += "<option value='" + val + "'>Siswa " + toUcFirst(val) + "</option>";
            });

            //Set Status
            lst_status += "<option value='0'>-Pilih Status -</option>";
            $(data.lst_status).each(function (i, val) {
                lst_status += "<option value='" + val + "'>" + toUcFirst(val) + "</option>";
            });

            //Set Agama
            lst_agama += "<option value='0'>-Pilih Agama -</option>";
            $(data.lst_agama).each(function (i, val) {
                lst_agama += "<option value='" + val.id + "'>" + val.agama + "</option>";
            });


            //Set Jurusan
            lst_jurusan += "<option value='0'>-Pilih Jurusan -</option>";
            $(data.lst_jurusan).each(function (i, val) {
                lst_jurusan += "<option value='" + val.id + "'>[" + val.kode_jurusan + "] " + val.nama_jurusan + "</option>";
            });

            //Set Tahun Semester Filter
            lst_semester_filter += "<option value='0'>- Pilih Tahun -</option>";
            $(data.lst_semester).each(function (i, val) {
                lst_semester_filter += "<option value='" + val.semester + "'>" + val.semester + "</option>";
            });

            //Set Keadaan Ayah
            lst_keadaan_ayah += "<option value='0'>- Pilih Keadaan Ayah -</option>";
            $(data.lst_keadaan_ayah).each(function (i, val) {
                lst_keadaan_ayah += "<option value='" + val + "'>" + toUcFirst(val) + "</option>";
            });

            //Set Keadaan ibu
            lst_keadaan_ibu += "<option value='0'>- Pilih Keadaan ibu -</option>";
            $(data.lst_keadaan_ibu).each(function (i, val) {
                lst_keadaan_ibu += "<option value='" + val + "'>" + toUcFirst(val) + "</option>";
            });


            $("#txtKelas").html(lst_kelas);
            $("#txtTahunAkademik").html(lst_tahun_akademik);
            $("#txtKetunaan").html(lst_ketunaan);
            $("#txtFilterKetunaan").html(lst_ketunaan);
            $("#txtKelas").html(lst_kelas);
            $("#txtFilterKelas").html(lst_kelas);
            $("#txtStatusAwal").html(lst_status_awal);
            $("#txtStatus").html(lst_status);
            $("#txtAgama").html(lst_agama);
            $("#txtAgamaWali").html(lst_agama);
            $("#txtCariTahunAkademik").html(lst_tahun_akademik);
            $("#txtCariKelas").html(lst_kelas);
            $("#txtJurusan").html(lst_jurusan);
            $("#txtCariStatus").html(lst_status);
            $("#txtCariTahun").html(lst_semester_filter);
            $("#txtKeadaanAyah").html(lst_keadaan_ayah);
            $("#txtKeadaanIbu").html(lst_keadaan_ibu);


        }, "json");

    }

    getRelatedData();
    
    
    $(document).ready(function () {
        $("#txtTanggalLahir").datepicker({
            format: "yyyy-mm-dd",
            startView: 2,
            autoclose: true
        });


        $("#form-pendaftaran").on("submit", function (e) {
            e.preventDefault();

            if ($("#txtNIK").val().length > 16) {
                alert("Maximal NIK 16 Karakter");
            } else {
                $.ajax({
                    type: "post",
                    url: "controller/pendaftaran.php",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: "json",
                    success: function (data) {

                        switch (data.status) {
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
                            case "exists":
                                alert("NIK sudah terdaftar");
                                break;
                            case true:
                                alert("Data berhasil di simpan");
                                $("#modalForm").modal("hide");
                                tabel.ajax.reload();
                                break;
                        }
                    }
                });
            }

        });
    });


    function exportPDF(){
        var filter_kelas = $("#txtFilterKelas").val();
        var filter_ketunaan = $("#txtFilterKetunaan").val();
        var filter_status = $("#txtFilterStatus").val();
        var filter_tahun = $("#txtFilterTahun").val();

        window.open("print-form/print_all_pendaftaran.php?filter_kelas="+filter_kelas+"&filter_ketunaan="+filter_ketunaan+"&filter_status="+filter_status+"&filter_tahun="+filter_tahun);

    }

    function personPDF(id){
        window.open("print-form/print_siswa_pendaftaran.php?id="+id);
    }


    function exportExcel(){
        $("#modalExportExcel").modal({
            backdrop: "static"
        });
    }

    function export_excel_pendaftaran(){
        var tahun = $("#txtTahunExportExcel").val();
        if(tahun === ""){
            alert("Tahun tidak boleh kosong");
        }else{
            window.open("print-form/excel_pendaftaran_siswa.php?tahun="+tahun,"_blank");
        }
    }

</script>