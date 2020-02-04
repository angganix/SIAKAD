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
</style>
<section class="content-header">
    <h1>
        Data Siswa
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-th"></i> Dashboard</a></li>
        <li class="active">Data Siswa</li>
    </ol>
</section>

<section class="content">
    <div class="box box-widget">
        <div class="box-header with-border">


            <div class="row">
                <div class="col-md-6">
                    <button type="button" class="btn btn-primary btn-xs bg-green btnAdd" onclick="addNew();"><i class="fa fa-plus fa-fw"></i> Tambah</button>
                    <button type="button" class="btn btn-primary btn-xs bg-aqua" onclick="printKelasToggle();"><i class="fa fa-print fa-fw"></i> Cetak Semua Kelas</button>
                    <button type="button" class="btn btn-primary btn-xs bg-aqua" onclick="printSiswa();"><i class="fa fa-file-pdf-o fa-fw"></i> PDF</button>
                    <button type="button" class="btn btn-primary btn-xs bg-aqua" onclick="excelSiswa();"><i class="fa fa-file-excel-o fa-fw"></i> Excel</button>
                    <button type="button" class="btn btn-primary btn-xs bg-orange" onclick="filterToggle()"><i class="fa fa-filter fa-fw"></i> Filter</button>
                </div>

                <div class="col-md-5">
                </div>

                <div class="col-md-1" style="text-align: right;">
                    <button type="button" class="btn btn-primary btn-sm bg-blue" onclick="setupConfig();"><i class="fa fa-gear fa-fw"></i></button>
                </div>
            </div>
        </div>
        <div class="box-header with-border" id="box-filter" style="border-top: 1px solid #eee;display: none;">
            <div class="row">
                <div class="col-md-3">
                    <select class="form-control input-sm select2" style="display: inline-block;" id="txtCariStatus">
                    </select>
                </div>
                <div class="col-md-3">
                    <select class="form-control input-sm select2" id="txtCariTahun">
                    </select>
                </div>
                <div class="col-md-3">
                    <select class="form-control input-sm select2" style="display: inline-block;" id="txtCariKelas">
                    </select>
                </div>
                <div class="col-md-3">
                    <button type="button" class="btn btn-primary btn-sm bg-green" onclick="applyFilter();"><i class="fa fa-search fa-fw"></i> Apply Filter</button>
                    <button type="button" class="btn btn-primary btn-sm bg-orange" onclick="resetFilter();"><i class="fa fa-refresh fa-fw"></i> Reset Filter</button>
                </div>
            </div>
        </div>

        <div class="box-body">
            <div class="row" id="box-search" hidden>
                <div class="col-md-4">
                    <div class="form-group">
                        <input type="text" class="form-control input-sm" id="txtSearch" placeholder="Cari NISN, Nama Siswa, Kode Ketunaan">
                    </div>
                </div>
                <div class="col-md-3"></div>
                <div class="col-md-5" style="text-align: right">
                    <ul class="pagination" style="padding-top: 5px;">
                        <li><a href="#first" id="btnFirst"><i class="fa fa-angle-double-left fa-fw"></i> </a></li>
                        <li><a href="#prev" id="btnPrev"><i class="fa fa-angle-left fa-fw"></i> </a></li>
                        <li><a href="#prev" class="bg-blue">Page <span id="cur_page">0</span> of <span id="max_page">0</span></a></li>
                        <li><a href="#next" id="btnNext"> <i class="fa fa-angle-right fa-fw"></i></a></li>
                        <li><a href="#last" id="btnLast"> <i class="fa fa-angle-double-right fa-fw"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-responsive table-bordered table-hover">
                    <thead>
                        <tr>
                            <th style="text-align: center;width:12%">NISN</th>
                            <th style="text-align: left;">Nama Siswa</th>
                            <th style="text-align: center;width:12%">Angkatan</th>
                            <th style="text-align: center;width:12%">Ketunaan</th>
                            <th style="text-align: center;width:12%">Kelas</th>
                            <th style="text-align: center;width:15%;"><i class="fa fa-gears fa-fw"></i></th>
                        </tr>
                    </thead>

                    <tbody id="tabel-data">
                        <tr>
                            <td colspan="6">
                                <div class="jumbotron">
                                    <h4 style="text-align: center;vertical-align: middle;">Silahkan gunakan <b>Filter</b> untuk melihat atau mencari data...</h4>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</section>

<form action="" method="post" enctype="multipart/form-data" name="form_data_siswa" id="form_data_siswa">
    <div class="modal fade" id="modalForm">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times fa-fw"></i></button>
                    <h5 class="modal-title" id="modalTitle"></h5>
                </div>

                <div class="modal-body">
                    <input type="hidden" id="txtId" name="id" value="0">
                    <input type="hidden" name="act" value="save">

                    <div>
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active">
                                <a href="#siswa" aria-controls="home" role="tab" data-toggle="tab">Siswa</a>
                            </li>
                            <li role="presentation">
                                <a href="#ortu" aria-controls="profile" role="tab" data-toggle="tab" onclick="setKeadaan();">Orang Tua / Wali</a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade in active" id="siswa">
                                <div class="row">
                                    <div class="col-md-6 col-xs-12">
                                        <table class="form-table table table-bordered">
                                            <tr>
                                                <td width="28%">NIS</td>
                                                <td><input type="number" class="form-control input-sm" name="nis" id="txtNIS"></td>
                                            </tr>
                                            <tr>
                                                <td>NISN</td>
                                                <td><input type="number" class="form-control input-sm" name="nisn" id="txtNISN"></td>
                                            </tr>
                                            <tr>
                                                <td>NIK</td>
                                                <td><input type="number" class="form-control input-sm" name="nik" id="txtNIK"></td>
                                            </tr>
                                            <tr>
                                                <td>Nama Siswa</td>
                                                <td><input type="text" class="form-control input-sm" name="nama_siswa" id="txtNamaSiswa"></td>
                                            </tr>
                                            <tr>
                                                <td>Kelas</td>
                                                <td>
                                                    <select class="form-control input-sm select2" name="kelas" id="txtKelas"></select>
                                                </td>
                                            </tr>
                                        </table>

                                    </div>
                                    <div class="col-md-6 col-xs-12">
                                        <table class="form-table table table-bordered">
                                            <tr>
                                                <td width="35%">Status Awal</td>
                                                <td>
                                                    <select class="form-control input-sm select2" name="status_awal" id="txtStatusAwal" onchange="checkStatusAwal();"></select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Asal Sekolah</td>
                                                <td>
                                                    <input type="text" class="form-control input-sm" name="asal_sekolah" id="txtAsalSekolah">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Tahun Akademik</td>
                                                <td>
                                                    <select class="form-control input-sm select2" name="tahun_akademik" id="txtTahunAkademik"></select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Ketunaan</td>
                                                <td>
                                                    <select class="form-control input-sm select2" name="ketunaan" id="txtKetunaan"></select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Keterampilan</td>
                                                <td>
                                                    <select class="form-control input-sm select2" name="jurusan" id="txtJurusan"></select>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="dashed-divider"></div>
                                <div class="row">
                                    <div class="col-md-12 col-xs-12">
                                        <table class="form-table table table-bordered" style="margin-bottom: 0px;">
                                            <tr>
                                                <td width="13.5%">Alamat</td>
                                                <td><input type="text" class="form-control input-sm" name="alamat" id="txtAlamat"></td>
                                            </tr>
                                        </table>
                                    </div>

                                    <div class="col-md-6 col-xs-12">
                                        <table class="form-table table table-bordered">
                                            <tr>
                                                <td width="28%">RT/RW</td>
                                                <td><input type="text" class="form-control input-sm" name="rt_rw" id="txtRtRw"></td>
                                            </tr>
                                            <tr>
                                                <td>Kelurahan</td>
                                                <td><input type="text" class="form-control input-sm" name="kelurahan" id="txtKelurahan"></td>
                                            </tr>
                                            <tr>
                                                <td>Kecamatan</td>
                                                <td><input type="text" class="form-control input-sm" name="kecamatan" id="txtKecamatan"></td>
                                            </tr>
                                        </table>

                                    </div>
                                    <div class="col-md-6 col-xs-12">
                                        <table class="form-table table table-bordered">
                                            <tr>
                                                <td width="35%">Kota</td>
                                                <td><input type="text" class="form-control input-sm" name="kota" id="txtKota"></td>
                                            </tr>
                                            <tr>
                                                <td>Provinsi</td>
                                                <td><input type="text" class="form-control input-sm" name="provinsi" id="txtProvinsi"></td>
                                            </tr>
                                            <tr>
                                                <td>Kode POS</td>
                                                <td><input type="text" class="form-control input-sm" name="kode_pos" id="txtKodePOS"></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="dashed-divider"></div>
                                <div class="dashed-divider"></div>
                                <div class="row">
                                    <div class="col-md-6 col-xs-12">
                                        <table class="form-table table table-bordered">
                                            <tr>
                                                <td width="28%">Tempat Lahir</td>
                                                <td><input type="text" class="form-control input-sm" name="tempat_lahir" id="txtTempatLahir"></td>
                                            </tr>
                                            <tr>
                                                <td>Tanggal Lahir</td>
                                                <td><input type="text" class="form-control input-sm tanggal" name="tanggal_lahir" id="txtTanggalLahir"></td>
                                            </tr>
                                            <tr>
                                                <td>Jenis Kelamin</td>
                                                <td>
                                                    <div class="row" style="margin-top: 10px;">
                                                        <div class="col-xs-6">
                                                            <input type="radio" id="txtJenisL" name="jenis_kelamin" value="l">
                                                            <label for="txtJenisL">Laki-laki</label>
                                                        </div>

                                                        <div class="col-xs-6" style="text-align: center;">
                                                            <input type="radio" id="txtJenisP" name="jenis_kelamin" value="p">
                                                            <label for="txtJenisP">Perempuan</label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Agama</td>
                                                <td>
                                                    <select class="form-control input-sm" id="txtAgama" name="agama"></select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Foto</td>
                                                <td>
                                                    <input type="file" class="form-control input-sm" id="txtFoto" name="foto" onchange="previewImage(this)">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>
                                                    <img id="thumbnil" class='img-responsive' style='width: 120px;height: 160px;object-fit:contain;object-position:center;margin-top:10px;margin-bottom:10px;box-shadow:0px 0.55px 9px #ccc;border-radius:2px;'/>
                                                </td>
                                            </tr>
                                        </table>

                                    </div>
                                    <div class="col-md-6 col-xs-12">
                                        <table class="form-table table table-bordered">
                                            <tr>
                                                <td width="35%">Jenis Tinggal</td>
                                                <td>
                                                    <input type="text" class="form-control input-sm" id="txtJenisTinggal" name="jenis_tinggal">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>No. Telpon</td>
                                                <td><input type="number" class="form-control input-sm" name="no_telpon" id="txtNoTelpon" maxlength="15"></td>
                                            </tr>
                                            <tr>
                                                <td>No. HP</td>
                                                <td><input type="number" class="form-control input-sm" name="no_hp" id="txtNoHP" maxlength="15"></td>
                                            </tr>
                                            <tr>
                                                <td>Email</td>
                                                <td>
                                                    <input type="text" class="form-control input-sm" name="email" id="txtEmail">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Status</td>
                                                <td>
                                                    <select class="form-control input-sm" id="txtStatus" name="status">
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    <label class="small-label">Keterangan Status</label>
                                                    <textarea class="form-control" rows="1" style="resize: none;" name="keterangan_status" id="txtKeteranganStatus"></textarea>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Jumlah Saudara</td>
                                                <td>
                                                    <input type="number" class="form-control input-sm" id="txtJumlahSaudara" name="jumlah_saudara" placeholder="Masukan angka">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Anak Ke</td>
                                                <td>
                                                    <input type="number" class="form-control input-sm" id="txtAnakKe" name="anak_ke" placeholder="Masukan angka">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Hobi</td>
                                                <td>
                                                    <input type="text" class="form-control input-sm" id="txtHobi" name="hobi">
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="ortu">
                                <div class="row">
                                    <div class="col-md-12 col-xs-12">
                                        <table class="form-table table table-bordered">
                                            <tr>
                                                <td width="25%">Nama Ayah</td>
                                                <td>
                                                    <input type="text" class="form-control input-sm" id="txtNamaAyah" name="nama_ayah">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Tempat Lahir Ayah</td>
                                                <td><input type="text" class="form-control input-sm" name="tempat_lahir_ayah" id="txtTempatLahirAyah"></td>
                                            </tr>
                                            <tr>
                                                <td>Tanggal Lahir Ayah</td>
                                                <td>
                                                    <input type="text" class="form-control input-sm tanggal" name="tanggal_lahir_ayah" id="txtTanggalLahirAyah" value="0000-00-00">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Pendidikan Ayah</td>
                                                <td><input type="text" class="form-control input-sm" name="pendidikan_ayah" id="txtPendidikanAyah"></td>
                                            </tr>
                                            <tr>
                                                <td>Pekerjaan Ayah</td>
                                                <td><input type="text" class="form-control input-sm" name="pekerjaan_ayah" id="txtPekerjaanAyah"></td>
                                            </tr>
                                            <tr>
                                                <td>Penghasilan Ayah</td>
                                                <td><input type="number" class="form-control input-sm" name="penghasilan_ayah" id="txtPenghasilanAyah"></td>
                                            </tr>
                                            <tr>
                                                <td>No. Telpon Ayah</td>
                                                <td><input type="number" class="form-control input-sm" name="no_telpon_ayah" id="txtNoTelponAyah" maxlength="15"></td>
                                            </tr>
                                            <tr>
                                                <td>Keadaan Ayah</td>
                                                <td>
                                                    <select class="form-control input-sm" name="keadaan_ayah" id="txtKeadaanAyah">
                                                    </select>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="dashed-divider"></div>
                                <div class="row">
                                    <div class="col-md-12 col-xs-12">
                                        <table class="form-table table table-bordered">
                                            <tr>
                                                <td width="25%">Nama ibu</td>
                                                <td>
                                                    <input type="text" class="form-control input-sm" id="txtNamaibu" name="nama_ibu">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Tempat Lahir ibu</td>
                                                <td><input type="text" class="form-control input-sm" name="tempat_lahir_ibu" id="txtTempatLahiribu"></td>
                                            </tr>
                                            <tr>
                                                <td>Tanggal Lahir ibu</td>
                                                <td>
                                                    <input type="text" class="form-control input-sm tanggal" name="tanggal_lahir_ibu" id="txtTanggalLahiribu" value="0000-00-00">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Pendidikan ibu</td>
                                                <td><input type="text" class="form-control input-sm" name="pendidikan_ibu" id="txtPendidikanibu"></td>
                                            </tr>
                                            <tr>
                                                <td>Pekerjaan ibu</td>
                                                <td><input type="text" class="form-control input-sm" name="pekerjaan_ibu" id="txtPekerjaanibu"></td>
                                            </tr>
                                            <tr>
                                                <td>Penghasilan ibu</td>
                                                <td><input type="number" class="form-control input-sm" name="penghasilan_ibu" id="txtPenghasilanibu"></td>
                                            </tr>
                                            <tr>
                                                <td>No. Telpon ibu</td>
                                                <td><input type="number" class="form-control input-sm" name="no_telpon_ibu" id="txtNoTelponibu" maxlength="15"></td>
                                            </tr>
                                            <tr>
                                                <td>Keadaan ibu</td>
                                                <td>
                                                    <select class="form-control input-sm" name="keadaan_ibu" id="txtKeadaanibu">
                                                    </select>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>

                                <div class="dashed-divider"></div>
                                <div class="dashed-divider"></div>
                                <div class="row">
                                    <div class="col-md-12 col-xs-12">
                                        <table class="form-table table table-bordered">
                                            <tr>
                                                <td width="25%">Nama wali</td>
                                                <td>
                                                    <input type="text" class="form-control input-sm" id="txtNamawali" name="nama_wali">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Tempat Lahir wali</td>
                                                <td><input type="text" class="form-control input-sm" name="tempat_lahir_wali" id="txtTempatLahirwali"></td>
                                            </tr>
                                            <tr>
                                                <td>Tanggal Lahir wali</td>
                                                <td>
                                                    <input type="text" class="form-control input-sm tanggal" name="tanggal_lahir_wali" id="txtTanggalLahirwali" value="0000-00-00">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Pendidikan wali</td>
                                                <td><input type="text" class="form-control input-sm" name="pendidikan_wali" id="txtPendidikanwali"></td>
                                            </tr>
                                            <tr>
                                                <td>Pekerjaan wali</td>
                                                <td><input type="text" class="form-control input-sm" name="pekerjaan_wali" id="txtPekerjaanwali"></td>
                                            </tr>
                                            <tr>
                                                <td>Penghasilan wali</td>
                                                <td><input type="number" class="form-control input-sm" name="penghasilan_wali" id="txtPenghasilanwali"></td>
                                            </tr>
                                            <tr>
                                                <td>No. Telpon wali</td>
                                                <td><input type="number" class="form-control input-sm" name="no_telpon_wali" id="txtNoTelponwali" maxlength="15"></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- END TAB -->

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-warning btn-sm" data-dismiss="modal"><i class="fa fa-times fa-fw"></i> Tutup</button>
                    <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-check fa-fw"></i> Simpan</button>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- Modal Detail -->
<div class="modal fade" id="modalDetail">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times fa-fw"></i></button>
                <h5 class="modal-title" id="modalTitleDetail"></h5>
            </div>

            <div class="modal-body">
                <div>
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#siswa_detail" aria-controls="home" role="tab" data-toggle="tab">Siswa</a>
                        </li>
                        <li role="presentation">
                            <a href="#ortu_detail" aria-controls="profile" role="tab" data-toggle="tab">Orang Tua / Wali</a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane fade in active" id="siswa_detail">
                            <div class="row">
                                <div class="col-md-2 col-xs-12">
                                    <div id="dtlFoto"></div>
                                </div>
                                <div class="col-md-5 col-xs-12">
                                    <table class="form-table table table-bordered">
                                        <tr>
                                            <td width="28%">NIS</td>
                                            <td><input type="number" class="form-control input-sm" id="dtlNIS" maxlength="8"></td>
                                        </tr>
                                        <tr>
                                            <td>NISN</td>
                                            <td><input type="number" class="form-control input-sm" id="dtlNISN" maxlength="16"></td>
                                        </tr>
                                        <tr>
                                            <td>NIK</td>
                                            <td><input type="number" class="form-control input-sm" id="dtlNIK" maxlength="8"></td>
                                        </tr>
                                        <tr>
                                            <td>Nama</td>
                                            <td><input type="text" class="form-control input-sm" id="dtlNamaSiswa"></td>
                                        </tr>
                                        <tr>
                                            <td>Kelas</td>
                                            <td>
                                                <input type="text" class="form-control input-sm" id="dtlKelas">
                                            </td>
                                        </tr>
                                    </table>

                                </div>
                                <div class="col-md-5 col-xs-12">
                                    <table class="form-table table table-bordered">
                                        <tr>
                                            <td width="35%">Status Awal</td>
                                            <td>
                                                <input type="text" class="form-control input-sm" id="dtlStatusAwal">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Asal Sekolah</td>
                                            <td>
                                                <input type="text" class="form-control input-sm" id="dtlAsalSekolah">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Th. Akademik</td>
                                            <td>
                                                <input type="text" class="form-control input-sm" id="dtlTahunAkademik">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Ketunaan</td>
                                            <td>
                                                <input type="text" class="form-control input-sm" id="dtlKetunaan">
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>Jurusan</td>
                                            <td><input type="text" class="form-control input-sm" id="dtlJurusan"></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="dashed-divider"></div>
                            <div class="row">
                                <div class="col-md-12 col-xs-12">
                                    <table class="form-table table table-bordered" style="margin-bottom: 0px;">
                                        <tr>
                                            <td width="17%">Alamat</td>
                                            <td><input type="text" class="form-control input-sm" id="dtlAlamat"></td>
                                        </tr>
                                    </table>
                                </div>

                                <div class="col-md-6 col-xs-12">
                                    <table class="form-table table table-bordered">
                                        <tr>
                                            <td width="35%">RT/RW</td>
                                            <td><input type="text" class="form-control input-sm" id="dtlRtRw"></td>
                                        </tr>
                                        <tr>
                                            <td>Kelurahan</td>
                                            <td><input type="text" class="form-control input-sm" id="dtlKelurahan"></td>
                                        </tr>
                                        <tr>
                                            <td>Kecamatan</td>
                                            <td><input type="text" class="form-control input-sm" id="dtlKecamatan"></td>
                                        </tr>
                                    </table>

                                </div>
                                <div class="col-md-6 col-xs-12">
                                    <table class="form-table table table-bordered">
                                        <tr>
                                            <td width="28.5%">Kota</td>
                                            <td><input type="text" class="form-control input-sm" id="dtlKota"></td>
                                        </tr>
                                        <tr>
                                            <td>Provinsi</td>
                                            <td><input type="text" class="form-control input-sm" id="dtlProvinsi"></td>
                                        </tr>
                                        <tr>
                                            <td>Kode POS</td>
                                            <td><input type="text" class="form-control input-sm" id="dtlKodePOS"></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="dashed-divider"></div>
                            <div class="dashed-divider"></div>
                            <div class="row">
                                <div class="col-md-6 col-xs-12">
                                    <table class="form-table table table-bordered">
                                        <tr>
                                            <td width="28%">Tempat Lahir</td>
                                            <td><input type="text" class="form-control input-sm" id="dtlTempatLahir"></td>
                                        </tr>
                                        <tr>
                                            <td>Tanggal Lahir</td>
                                            <td><input type="text" class="form-control input-sm" id="dtlTanggalLahir"></td>
                                        </tr>
                                        <tr>
                                            <td>Jenis Kelamin</td>
                                            <td>
                                                <input type="text" class="form-control input-sm" id="dtlJenisKelamin">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Agama</td>
                                            <td>
                                                <input type="text" class="form-control input-sm" id="dtlAgama">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="35%">Jenis Tinggal</td>
                                            <td>
                                                <input type="text" class="form-control input-sm" id="dtlJenisTinggal">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Hobi</td>
                                            <td>
                                                <input type="text" class="form-control input-sm" id="dtlHobi">
                                            </td>
                                        </tr>
                                    </table>

                                </div>
                                <div class="col-md-6 col-xs-12">
                                    <table class="form-table table table-bordered">

                                        <tr>
                                            <td>No. Telpon</td>
                                            <td><input type="number" class="form-control input-sm" id="dtlNoTelpon" maxlength="15"></td>
                                        </tr>
                                        <tr>
                                            <td>No. HP</td>
                                            <td><input type="number" class="form-control input-sm" id="dtlNoHP" maxlength="15"></td>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td>
                                                <input type="email" class="form-control input-sm" id="dtlEmail">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Status</td>
                                            <td>
                                                <input type="text" class="form-control input-sm" id="dtlStatus">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <label class="small-label">Keterangan Status</label>
                                                <div id="dtlKeteranganStatus"></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Jumlah Saudara</td>
                                            <td>
                                                <input type="text" class="form-control input-sm" id="dtlJumlahSaudara">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Anak Ke</td>
                                            <td>
                                                <input type="text" class="form-control input-sm" id="dtlAnakKe">
                                            </td>
                                        </tr>

                                    </table>
                                </div>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="ortu_detail">
                            <div class="row">
                                <div class="col-md-12 col-xs-12">
                                    <table class="form-table table table-bordered">
                                        <tr>
                                            <td width="25%">Nama Ayah</td>
                                            <td>
                                                <input type="text" class="form-control input-sm" id="dtlNamaAyah">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Tempat Lahir Ayah</td>
                                            <td><input type="text" class="form-control input-sm" id="dtlTempatLahirAyah"></td>
                                        </tr>
                                        <tr>
                                            <td>Tanggal Lahir Ayah</td>
                                            <td>
                                                <input type="text" class="form-control input-sm" id="dtlTanggalLahirAyah">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Pendidikan Ayah</td>
                                            <td><input type="text" class="form-control input-sm" id="dtlPendidikanAyah"></td>
                                        </tr>
                                        <tr>
                                            <td>Pekerjaan Ayah</td>
                                            <td><input type="text" class="form-control input-sm" id="dtlPekerjaanAyah"></td>
                                        </tr>
                                        <tr>
                                            <td>Penghasilan Ayah</td>
                                            <td><input type="text" class="form-control input-sm" id="dtlPenghasilanAyah"></td>
                                        </tr>
                                        <tr>
                                            <td>No. Telpon Ayah</td>
                                            <td><input type="number" class="form-control input-sm" id="dtlNoTelponAyah" maxlength="15"></td>
                                        </tr>
                                        <tr>
                                            <td>Keadaan Ayah</td>
                                            <td><input type="text" class="form-control input-sm" id="dtlKeadaanAyah"></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="dashed-divider"></div>
                            <div class="row">
                                <div class="col-md-12 col-xs-12">
                                    <table class="form-table table table-bordered">
                                        <tr>
                                            <td width="25%">Nama ibu</td>
                                            <td>
                                                <input type="text" class="form-control input-sm" id="dtlNamaibu">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Tempat Lahir ibu</td>
                                            <td><input type="text" class="form-control input-sm" id="dtlTempatLahiribu"></td>
                                        </tr>
                                        <tr>
                                            <td>Tanggal Lahir ibu</td>
                                            <td>
                                                <input type="text" class="form-control input-sm tanggal" id="dtlTanggalLahiribu">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Pendidikan ibu</td>
                                            <td><input type="text" class="form-control input-sm" id="dtlPendidikanibu"></td>
                                        </tr>
                                        <tr>
                                            <td>Pekerjaan ibu</td>
                                            <td><input type="text" class="form-control input-sm" id="dtlPekerjaanibu"></td>
                                        </tr>
                                        <tr>
                                            <td>Penghasilan ibu</td>
                                            <td><input type="text" class="form-control input-sm" id="dtlPenghasilanibu"></td>
                                        </tr>
                                        <tr>
                                            <td>No. Telpon ibu</td>
                                            <td><input type="number" class="form-control input-sm" id="dtlNoTelponibu" maxlength="15"></td>
                                        </tr>
                                        <tr>
                                            <td>Keadaan ibu</td>
                                            <td><input type="text" class="form-control input-sm" id="dtlKeadaanibu"></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                            <div class="dashed-divider"></div>
                            <div class="dashed-divider"></div>
                            <div class="row">
                                <div class="col-md-12 col-xs-12">
                                    <table class="form-table table table-bordered">
                                        <tr>
                                            <td width="25%">Nama wali</td>
                                            <td>
                                                <input type="text" class="form-control input-sm" id="dtlNamawali">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Tempat Lahir wali</td>
                                            <td><input type="text" class="form-control input-sm" id="dtlTempatLahirwali"></td>
                                        </tr>
                                        <tr>
                                            <td>Tanggal Lahir wali</td>
                                            <td>
                                                <input type="text" class="form-control input-sm" id="dtlTanggalLahirwali">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Pendidikan wali</td>
                                            <td><input type="text" class="form-control input-sm" id="dtlPendidikanwali"></td>
                                        </tr>
                                        <tr>
                                            <td>Pekerjaan wali</td>
                                            <td><input type="text" class="form-control input-sm" id="dtlPekerjaanwali"></td>
                                        </tr>
                                        <tr>
                                            <td>Penghasilan wali</td>
                                            <td><input type="text" class="form-control input-sm" id="dtlPenghasilanwali"></td>
                                        </tr>
                                        <tr>
                                            <td>No. Telpon wali</td>
                                            <td><input type="number" class="form-control input-sm" id="dtlNoTelponwali" maxlength="15"></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- END TAB -->

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-warning btn-sm" data-dismiss="modal"><i class="fa fa-times fa-fw"></i> Tutup</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalPrintAll">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times fa-fw"></i></button>
                <div class="modal-title">
                    <i class="fa fa-file-pdf-o fa-fw"></i> Cetak Data Semua Kelas
                </div>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <label class="small-label">Tahun</label>
                    <input type="number" class="form-control input-sm" id="txtAllTahun" placeholder="Contoh: <?= date("Y"); ?>">
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-warning btn-sm bg-orange" data-dismiss="modal"><i class="fa fa-times fa-fw"></i>Tutup</button>
                <button type="button" class="btn btn-success btn-sm bg-green" onclick="printAllKelas();"><i class="fa fa-print fa-fw"></i> Cetak</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalConfig">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times fa-fw"></i></button>
                <h4 class="modal-title"><i class="fa fa-gears fa-fw"></i> Config Tanda Tangan</h4>
            </div>

            <div class="modal-body">
                <label class="small-label">Tanggal</label>
                <input type="text" class="form-control input-sm tanggal" id="txtTtdTanggal" placeholder="Opsional, boleh di isi / tidak" >
                <br>
                <label class="small-label">Nama Kep. Sekolah</label>
                <input type="text" class="form-control input-sm" id="txtTtdKepalaSekolah" placeholder="Nama Kepala Sekolah">
                <br>
                <label class="small-label">NIP</label>
                <input type="text" class="form-control input-sm" id="txtTtdNIP" placeholder="NIP.">
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-warning btn-sm bg-orange" data-dismiss="modal"><i class="fa fa-times fa-fw"></i> Tutup</button>
                <button type="button" class="btn btn-success btn-sm bg-green" onclick="saveConfig();"><i class="fa fa-check fa-fw"></i> Simpan</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    var cur_page = 1;
    var max_page = 0;
    var criteria = "1=1";

    function resetField() {
        $("ul.nav-tabs li:first-child a").trigger("click");
        // $("#siswa").tab("show");
        $("#txtId").val("0");
        $("#modalForm .form-control").val("");
        $("#txtNIS").focus();
        $("#txtAgama").val("0").trigger("change");
        $("#txtStatus").val("0").trigger("change");
        $("#txtAsalSekolah").prop("disabled", true);
        $("#txtKeadaanAyah").val("0").trigger("change");
        $("#txtKeadaanibu").val("0").trigger("change");
        $("#thumbnil").prop("src", "upload/notfound.jpg");
    }

    function checkStatusAwal() {
        var stt_awal = $("#txtStatusAwal").val();
        if (stt_awal === "pindahan") {
            $("#txtAsalSekolah").prop("disabled", false);
        } else {
            $("#txtAsalSekolah").prop("disabled", true);
            $("#txtAsalSekolah").val("");
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

    function addNew() {
        resetField();

        $("#modalTitle").html("<i class='fa fa-plus fa-fw'></i> Tambah Data");

        $("#modalForm").modal({
            backdrop: "static"
        });
    }


    function edit(id) {
        resetField();

        $.post("controller/data_siswa.php", {
            act: "getData",
            id: id
        }, function (data) {
            var data_siswa = data.result[0];
            var data_ortu = data.result_ortu[0];

            //Set Detail Data Siswa
            $("#txtId").val(data_siswa.id);
            $("#txtNIS").val(data_siswa.nis);
            $("#txtNISN").val(data_siswa.nisn);
            $("#txtNIK").val(data_siswa.nik);
            $("#txtNamaSiswa").val(data_siswa.nama_siswa);
            $("#txtKelas").val(data_siswa.kelas).trigger("change");
            $("#txtTahunAkademik").val(data_siswa.tahun_akademik).trigger("change");
            $("#txtKetunaan").val(data_siswa.ketunaan).trigger("change");
            $("#txtJurusan").val(data_siswa.jurusan).trigger("change");
            $("#txtStatusAwal").val(data_siswa.status_awal).trigger("change");
            $("#txtAsalSekolah").val(data_siswa.asal_sekolah);
            $("#txtAlamat").val(data_siswa.alamat);
            $("#txtRtRw").val(data_siswa.rt_rw);
            $("#txtKelurahan").val(data_siswa.kelurahan);
            $("#txtKecamatan").val(data_siswa.kecamatan);
            $("#txtKota").val(data_siswa.kota);
            $("#txtProvinsi").val(data_siswa.provinsi);
            $("#txtKodePOS").val(data_siswa.kode_pos);
            $("#txtTempatLahir").val(data_siswa.tempat_lahir);
            $("#txtTanggalLahir").val(data_siswa.tanggal_lahir);
            if (data_siswa.jenis_kelamin === "l") {
                $("#txtJenisL").prop("checked", true);
            } else {
                $("#txtJenisP").prop("checked", true);
            }
            $("#txtAgama").val(data_siswa.agama_id);
            $("#txtJenisTinggal").val(data_siswa.jenis_tinggal);
            $("#txtNoTelpon").val(data_siswa.no_telpon);
            $("#txtNoHP").val(data_siswa.no_hp);
            $("#txtEmail").val(data_siswa.email);
            $("#txtStatus").val(data_siswa.status);
            $("#txtKeteranganStatus").val(data_siswa.keterangan_status);
            $("#txtJumlahSaudara").val(data_siswa.jumlah_saudara);
            $("#txtAnakKe").val(data_siswa.anak_ke);
            $("#txtHobi").val(data_siswa.hobi);

            $("#thumbnil").attr("src", "upload/" + data_siswa.foto);

            //Set Detail Data Ortu
            if (data.result_ortu !== "kosong") {
                $("#txtNamaAyah").val(data_ortu.nama_ayah);
                $("#txtTempatLahirAyah").val(data_ortu.tempat_lahir_ayah);
                $("#txtTanggalLahirAyah").val(data_ortu.tanggal_lahir_ayah);
                $("#txtPendidikanAyah").val(data_ortu.pendidikan_ayah);
                $("#txtPekerjaanAyah").val(data_ortu.pekerjaan_ayah);
                $("#txtPenghasilanAyah").val(data_ortu.penghasilan_ayah);
                $("#txtNoTelponAyah").val(data_ortu.no_telpon_ayah);
                $("#txtKeadaanAyah").val(data_ortu.keadaan_ayah);
                $("#txtNamaibu").val(data_ortu.nama_ibu);
                $("#txtTempatLahiribu").val(data_ortu.tempat_lahir_ibu);
                $("#txtTanggalLahiribu").val(data_ortu.tanggal_lahir_ibu);
                $("#txtPendidikanibu").val(data_ortu.pendidikan_ibu);
                $("#txtPekerjaanibu").val(data_ortu.pekerjaan_ibu);
                $("#txtPenghasilanibu").val(data_ortu.penghasilan_ibu);
                $("#txtNoTelponibu").val(data_ortu.no_telpon_ibu);
                $("#txtKeadaanibu").val(data_ortu.keadaan_ibu);
                $("#txtNamawali").val(data_ortu.nama_wali);
                $("#txtTempatLahirwali").val(data_ortu.tempat_lahir_wali);
                $("#txtTanggalLahirwali").val(data_ortu.tanggal_lahir_wali);
                $("#txtPendidikanwali").val(data_ortu.pendidikan_wali);
                $("#txtPekerjaanwali").val(data_ortu.pekerjaan_wali);
                $("#txtPenghasilanwali").val(data_ortu.penghasilan_wali);
                $("#txtNoTelponwali").val(data_ortu.no_telpon_wali);
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
            $.post("controller/data_siswa.php", {
                act: "del",
                id: id
            }, function (data) {
                if (data.status === true) {
                    refreshGrid();
                } else {
                    alert("Data gagal di hapus");
                }

            }, "json");
        }
    }

    function applyFilter() {
        criteria = "1=1";
        var status = $("#txtCariStatus").val();
        var kelas = $("#txtCariKelas").val();
        var tahun = $("#txtCariTahun").val();

        if (status !== "0" || kelas !== "0" || tahun !== "0") {
            refreshGrid();
            $("#box-search").show();
        } else {
            $("#box-search").hide();
            var empty_data = "";
            empty_data += "<tr>"
                    + "<td colspan='6'>"
                    + "<div class='jumbotron'>"
                    + "<h4 style='text-align: center;vertical-align:middle;'>Silahkan gunakan <b>Filter</b> untuk melihat atau mencari data...</h4>"
                    + "</div>"
                    + "</td>"
                    + "</tr>";
            $("#tabel-data").html(empty_data);
        }

    }

    function resetFilter() {
        $("#txtCariStatus").val("0").trigger("change");
        $("#txtCariTahun").val("0").trigger("change");
        $("#txtCariKelas").val("0").trigger("change");

        var status = $("#txtCariStatus").val();
        var kelas = $("#txtCariKelas").val();
        var tahun = $("#txtCariTahun").val();

        if (status !== "0" || kelas !== "0" || tahun !== "0") {
            refreshGrid();
        } else {
            var empty_data = "";
            empty_data += "<tr>"
                    + "<td colspan='6'>"
                    + "<div class='jumbotron'>"
                    + "<h4 style='text-align: center;vertical-align:middle;'>Silahkan gunakan <b>Filter</b> untuk melihat atau mencari data...</h4>"
                    + "</div>"
                    + "</td>"
                    + "</tr>";
            $("#tabel-data").html(empty_data);
        }

    }

    function refreshGrid() {

        $.post("controller/data_siswa.php", {
            act: "getAll",
            tahun_akademik: $("#txtCariTahun").val(),
            kelas: $("#txtCariKelas").val(),
            status: $("#txtCariStatus").val(),
            cur_page: cur_page,
            criteria: criteria
        }, function (data) {

            var lst = "";

            $(data.result).each(function (i, val) {
                lst += "<tr>"
                        + "<td align='center'>" + val.nisn + "</td>"
                        + "<td><a href='#' onclick='detail(" + val.id_siswa + ")'>" + val.nama_siswa + "</a></td>"
                        + "<td align='center'>" + val.tahun_ajaran + "</td>"
                        + "<td align='center'>" + val.kode_ketunaan + "</td>"
                        + "<td align='center'>" + val.nama_kelas + "</td>"
                        + "<td>"
                        + "<button type='button' class='btn btn-primary btn-xs bg-aqua' onclick='pdfSiswa(" + val.id_siswa + ")' style='margin-right: 4px !important;'><i class='fa fa-file-pdf-o fa-fw'></i></button>"
                        + "<button type='button' class='btn btn-primary btn-xs bg-blue btnEdit' onclick='edit(" + val.id_siswa + ")' style='margin-right: 4px !important;'><i class='fa fa-pencil fa-fw'></i></button>"
                        + "<button type='button' class='btn btn-primary btn-xs bg-red btnDel' onclick='del(" + val.id_siswa + ")'><i class='fa fa-trash fa-fw'></i></button>"
                        + "</td>"
                        + "</tr>";
            });

            $("#tabel-data").hide();
            if ($.isEmptyObject(data.result) === true) {
                $("#box-search").hide();
                $("#tabel-data").html("<tr><td colspan='6' align='center'>Data tidak ditemukan</td></tr>");
            } else {
                $("#box-search").show();
                $("#tabel-data").html(lst);

                cur_page = data.cur_page;
                max_page = data.max_page;
                $("#cur_page").html(cur_page);
                $("#max_page").html(max_page);
            }

            $("#tabel-data").fadeIn(200);

        }, "json");

    }

    function detail(id) {
        $("#modalDetail input").prop("disabled", true);

        $.post("controller/data_siswa.php", {
            act: "getData",
            id: id
        }, function (data) {

            var data_siswa = data.result[0];
            var data_ortu = data.result_ortu[0];

            //Set Detail Data Siswa
            $("#dtlFoto").html("<img src='upload/" + data_siswa.foto + "' class='img-responsive' style='width: 120px;height: 160px;object-fit:contain;object-position:center;margin-top:10px;margin-bottom:10px;box-shadow:0px 0.55px 9px #ccc;border-radius:2px;' />");
            $("#dtlNIS").val(data_siswa.nis);
            $("#dtlNISN").val(data_siswa.nisn);
            $("#dtlNIK").val(data_siswa.nik);
            $("#dtlNamaSiswa").val(data_siswa.nama_siswa);
            $("#dtlKelas").val(data_siswa.nama_kelas);
            $("#dtlTahunAkademik").val(data_siswa.semester);
            $("#dtlKetunaan").val("[" + data_siswa.kode_ketunaan + "] " + data_siswa.nama_ketunaan);
            $("#dtlJurusan").val(data_siswa.nama_jurusan);
            $("#dtlStatusAwal").val("Siswa " + toUcFirst(data_siswa.status_awal));
            $("#dtlAsalSekolah").val(data_siswa.asal_sekolah);
            $("#dtlAlamat").val(data_siswa.alamat);
            $("#dtlRtRw").val(data_siswa.rt_rw);
            $("#dtlKelurahan").val(data_siswa.kelurahan);
            $("#dtlKecamatan").val(data_siswa.kecamatan);
            $("#dtlKota").val(data_siswa.kota);
            $("#dtlProvinsi").val(data_siswa.provinsi);
            $("#dtlKodePOS").val(data_siswa.kode_pos);
            $("#dtlTempatLahir").val(data_siswa.tempat_lahir);
            $("#dtlTanggalLahir").val(data_siswa.tanggal_lahir);
            if (data_siswa.jenis_kelamin === "l") {
                $("#dtlJenisKelamin").val("Laki-laki");
            } else {
                $("#dtlJenisKelamin").val("Perempuan");
            }
            $("#dtlAgama").val(data_siswa.agama);
            $("#dtlJenisTinggal").val(data_siswa.jenis_tinggal);
            $("#dtlNoTelpon").val(data_siswa.no_telpon);
            $("#dtlNoHP").val(data_siswa.no_hp);
            $("#dtlEmail").val(data_siswa.email);
            $("#dtlStatus").val(data_siswa.status);
            $("#dtlKeteranganStatus").html(toUcFirst(data_siswa.keterangan_status));
            $("#dtlJumlahSaudara").val(data_siswa.jumlah_saudara);
            $("#dtlAnakKe").val(data_siswa.anak_ke);
            $("#dtlHobi").val(data_siswa.hobi);

            //Set Detail Data Ortu
            if (data.result_ortu !== "kosong") {
                $("#dtlNamaAyah").val(data_ortu.nama_ayah);
                $("#dtlTempatLahirAyah").val(data_ortu.tempat_lahir_ayah);
                $("#dtlTanggalLahirAyah").val(data_ortu.tanggal_lahir_ayah);
                $("#dtlPendidikanAyah").val(data_ortu.pendidikan_ayah);
                $("#dtlPekerjaanAyah").val(data_ortu.pekerjaan_ayah);
                $("#dtlPenghasilanAyah").val(rupiah(data_ortu.penghasilan_ayah));
                $("#dtlNoTelponAyah").val(data_ortu.no_telpon_ayah);
                $("#dtlKeadaanAyah").val(data_ortu.keadaan_ayah);
                $("#dtlNamaibu").val(data_ortu.nama_ibu);
                $("#dtlTempatLahiribu").val(data_ortu.tempat_lahir_ibu);
                $("#dtlTanggalLahiribu").val(data_ortu.tanggal_lahir_ibu);
                $("#dtlPendidikanibu").val(data_ortu.pendidikan_ibu);
                $("#dtlPekerjaanibu").val(data_ortu.pekerjaan_ibu);
                $("#dtlPenghasilanibu").val(rupiah(data_ortu.penghasilan_ibu));
                $("#dtlNoTelponibu").val(data_ortu.no_telpon_ibu);
                $("#dtlKeadaanibu").val(data_ortu.keadaan_ibu);
                $("#dtlNamawali").val(data_ortu.nama_wali);
                $("#dtlTempatLahirwali").val(data_ortu.tempat_lahir_wali);
                $("#dtlTanggalLahirwali").val(data_ortu.tanggal_lahir_wali);
                $("#dtlPendidikanwali").val(data_ortu.pendidikan_wali);
                $("#dtlPekerjaanwali").val(data_ortu.pekerjaan_wali);
                $("#dtlPenghasilanwali").val(rupiah(data_ortu.penghasilan_wali));
                $("#dtlNoTelponwali").val(data_ortu.no_telpon_wali);
            }


            $("#modalTitleDetail").html("<i class='fa fa-file fa-fw'></i> Detail " + data_siswa.nama_siswa);
            $("#modalDetail").modal("show");

        }, "json");
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
            lst_kelas += "<option value='0'>-Pilih Kelas -</option>";
            $(data.lst_kelas).each(function (i, val) {
                lst_kelas += "<option value='" + val.id + "'>" + val.nama_kelas + "</option>";
            });

            //Set tahun akademik
            lst_tahun_akademik += "<option value='0'>-Pilih Tahun Akademik-</option>";
            $(data.lst_tahun_akademik).each(function (i, val) {
                lst_tahun_akademik += "<option value='" + val.id + "'> " + val.semester + "</option>";
            });

            //Set Ketunaan
            lst_ketunaan += "<option value='0'>-Pilih Ketunaan-</option>";
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

            //Set Status Awal
            lst_agama += "<option value='0'>-Pilih Agama -</option>";
            $(data.lst_agama).each(function (i, val) {
                lst_agama += "<option value='" + val.id + "'>" + val.agama + "</option>";
            });

            //Set Jurusan
            lst_jurusan += "<option value='0'>-Pilih Keterampilan -</option>";
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
            $("#txtStatusAwal").html(lst_status_awal);
            $("#txtStatus").html(lst_status);
            $("#txtAgama").html(lst_agama);
            $("#txtCariTahunAkademik").html(lst_tahun_akademik);
            $("#txtCariKelas").html(lst_kelas);
            $("#txtJurusan").html(lst_jurusan)
            $("#txtCariStatus").html(lst_status);
            $("#txtCariTahun").html(lst_semester_filter);
            $("#txtKeadaanAyah").html(lst_keadaan_ayah);
            $("#txtKeadaanibu").html(lst_keadaan_ibu);

        }, "json");

    }

    getRelatedData();

    $(document).ready(function () {
        $("#form_data_siswa").on("submit", function (e) {
            e.preventDefault();

            if ($("#txtNIS").val().length > 15) {
                alert("Maximal NIS 15 Karakter");
            } else if ($("#txtNISN").val().length > 15) {
                alert("Maximal NISN 15 Karakter");
            } else if ($("#txtNIK").val().length > 16) {
                alert("Maximal NIK 16 Karakter");
            } else if ($("#txtNoTelpon").val().length > 15) {
                alert("Maximal No. Telpon 15 Karakter");
            } else if ($("#txtNoHP").val().length > 15) {
                alert("Maximal No. HP 15 Karakter");
            } else {
                $.ajax({
                    type: "post",
                    url: "controller/data_siswa.php",
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
                            case true:
                                alert("Data berhasil di simpan");
                                $("#modalForm").modal("hide");
                                refreshGrid();
                                break;
                        }
                    }
                });
            }

        });
    });

    function filterToggle() {
        $("#box-filter").slideToggle(200);
    }

    function printKelasToggle() {
        $("#modalPrintAll").modal("show");
    }

    function printSiswa() {
        var stt = $("#txtCariStatus").val();
        var thn = $("#txtCariTahun").val();
        var kls = $("#txtCariKelas").val();

        window.open("print-form/print_data_siswa.php?status=" + stt + "&tahun=" + thn + "&kelas=" + kls, "_blank");
    }

    function printAllKelas() {
        if ($("#txtAllTahun").val() === "") {
            alert("Tahun harus di isi!");
        } else {
            window.open("print-form/print_all_siswa.php?tahun_ajaran=" + $("#txtAllTahun").val(), "_blank");
        }
    }

    function excelSiswa() {
        var stt = $("#txtCariStatus").val();
        var thn = $("#txtCariTahun").val();
        var kls = $("#txtCariKelas").val();

        window.open("print-form/excel_data_siswa.php?status=" + stt + "&tahun=" + thn + "&kelas=" + kls, "_blank");
    }

    function pdfSiswa(id) {
        window.open("print-form/pdf_siswa.php?id=" + id, "_blank");
    }


    //Pagination
    $("#btnFirst").click(function () {
        cur_page = 1;

        refreshGrid();
    });

    $("#btnLast").click(function () {
        cur_page = max_page;

        refreshGrid();
    });

    $("#btnPrev").click(function () {
        if (cur_page > 1) {
            cur_page -= 1;
        }


        refreshGrid();
    });

    $("#btnNext").click(function () {
        if (cur_page < max_page) {
            cur_page += 1;
        }

        refreshGrid();
    });


    //Searching
    $("#txtSearch").on("change", function () {
        criteria = $("#txtSearch").val();
        refreshGrid();
    });


    //Modal Config
    function setupConfig() {

        $.post("controller/data_siswa.php", {
            act: "get_config"
        }, function (data) {
            var data_set = data.result[0];
            var arr_data = data_set['array_value'].split("|");

            $("#txtTtdTanggal").val(arr_data[0] === "null" ? "" : arr_data[0]);
            $("#txtTtdKepalaSekolah").val(arr_data[1]);
            $("#txtTtdNIP").val(arr_data[2]);

        }, "json");

        $("#modalConfig").modal({
            backdrop: "static"
        });
    }

    function saveConfig() {
        var ttd_tanggal = $("#txtTtdTanggal").val();
        var ttd_nama = $("#txtTtdKepalaSekolah").val();
        var ttd_nip = $("#txtTtdNIP").val();

        $.post("controller/data_siswa.php", {
            act: "save_config_ttd",
            ttd_tanggal: ttd_tanggal,
            ttd_nama: ttd_nama,
            ttd_nip: ttd_nip
        }, function (data) {
            if (data.status === true) {
                alert("Konfigurasi berhasil di simpan");
                $("#modalConfig").modal("hide");
            } else {
                alert("Konfigurasi gagal di simpan");
            }
        }, "json");
    }


    function setKeadaan() {
        $("#txtKeadaanAyah").val("0").trigger("change");
        $("#txtKeadaanibu").val("0").trigger("change");
    }
</script>
