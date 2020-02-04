<style type="text/css">
    .table-form tr td{
        padding: 4px 8px !important;
        border: none !important;
    }

    .dataGrid tr td{
        font-size: 12px !important;
    }

    .select2-container{
        margin-top: 3px !important;
        margin-bottom: 6px !important;
    }
    .head-tabel tr td{
        padding: 4px 6px !important;
        border: none !important;
    }
</style>
<section class="content-header">
    <h1>
        Rekap Absensi Siswa
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-th"></i> Dashboard</a></li>
        <li class="active">Rekap Absensi</li>
    </ol>
</section>

<section class="content">
    <div class="box box-widget">
        <div class="box-header with-border">
            <div class="row">
                <div class="col-md-2">
                    <select class="form-control input-sm select2" id="txtFilterKelas">

                    </select>
                </div>
                <div class="col-md-1" style="padding-left: 2px;padding-right: 0px;">
                    <input type="text" class="form-control input-sm bulan text-center" id="txtFilterBulan" value="<?= date("Y-m"); ?>" style="padding-bottom: 5px;">
                </div>
                <div class="col-md-1">
                    <button type="button" class="btn btn-info btn-sm bg-blue" id="btnFilter"><i class="fa fa-search fa-fw"></i></button>
                </div>
            </div>
        </div>

        <div class="box-body" id="data-box">
            <div class="row data-component">
                <div class="col-md-4">
                    <table class="table head-tabel" style="margin-bottom: 0px !important;">
                        <tr>
                            <td width="25%" style="vertical-align: middle;"><strong>Kelas</strong></td>
                            <td>: <span id="lblKelas"></span></td>
                        </tr>
                        <tr>
                            <td><strong>Ketunaan</strong></td>
                            <td>: <span id="lblKetunaan"></span></td>
                        </tr>
                        <tr>
                            <td><strong>Wali Kelas</strong></td>
                            <td>: <span id="lblWaliKelas"></span></td>
                        </tr>
                        <tr>
                            <td style="vertical-align: middle;"><strong>Bulan</strong></td>
                            <td style="padding:0px 6px;vertical-align:middle;">: <span id="lblBulan"></span></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="table-responsive data-component">
                <button type="button" class="btn btn-primary btn-xs bg-green pull-right" onclick="printPDF();"><i class="fa fa-file-pdf-o fa-fw"></i> Cetak PDF</button>
                <table class="table table-responsive table-bordered table-hover" id="data_tabel">
                </table>
            </div>
            <div class="col-md-12 data-component" style="padding:0px;text-align: center;">
                <strong style="margin:auto;">Keterangan:</strong><br>
                <table class="table table-bordered" style="margin-top:10px;">
                    <tbody>
                        <tr>
                            <td style="text-align:center;font-size: 11px;width:10%;background: #2ecc71;color:#fff;">
                                <strong><i class="fa fa-check fa-fw"></i></strong>
                            </td>
                            <td style="width:10%;font-size: 11px;"> <strong>Hadir / Masuk</strong></td>
                            <td style="width:10%;text-align:center;font-size: 11px;background: #8e44ad;color:#fff;"> 
                                <strong>A</strong>
                            </td>
                            <td style="width:10%;font-size: 11px;"> <strong>Alpha</strong></td>
                            <td style="width:10%;text-align:center;font-size: 11px;background: #e67e22;color:#fff;"> 
                                <strong>S</strong>
                            </td>
                            <td style="width:10%;font-size: 11px;"> <strong>Sakit</strong></td>
                            <td style="width:10%;text-align:center;font-size: 11px;background: #3498db;color:#fff;"> 
                                <strong>I</strong>
                            </td>
                            <td style="width:10%;font-size: 11px;"> <strong>Izin</strong></td>
                            <td style="width:10%;text-align:center;font-size: 11px;background:#e74c3c;color:#fff;"> 
                                <strong>-</strong>
                            </td>
                            <td style="width:10%;font-size: 11px;"> <strong>Kosong / Libur</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="modal_detail">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body" id="data_detail">

            </div>

            <div class="modal-footer" style="text-align: center;">
                <button type="button" class="btn btn-warning btn-sm bg-yellow" data-dismiss="modal"><i class="fa fa-times fa-fw"></i> Tutup</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    $("#data-box > .data-component").hide();

    function getRelatedData() {
        $.post("controller/rekap_absensi_siswa.php", {
            act: "getRelatedData"
        }, function (data) {
            var lst_kelas = "";

            //Set Kelas
            lst_kelas += "<option value='0'>-Pilih Kelas -</option>";
            $(data.lst_kelas).each(function (i, val) {
                lst_kelas += "<option value='" + val.id + "'>" + val.nama_kelas + "</option>";
            });

            $("#txtFilterKelas").html(lst_kelas);
        }, "json");
    }

    getRelatedData();

    function getProfil() {
        $.post("controller/rekap_absensi_siswa.php", {
            act: "get_profil",
            kelas: $("#txtFilterKelas").val()
        }, function (data) {
            var data_set = data.result[0];

            $("#lblKelas").html(data_set['nama_kelas']);
            $("#lblKetunaan").html("[" + data_set.kode_ketunaan + "] " + data_set.nama_ketunaan);
            $("#lblWaliKelas").html(data_set.nama + " [" + data_set.nrk + "]");
            $("#lblBulan").html($("#txtFilterBulan").val());

        }, "json");
    }

    function refreshGrid() {
        $.ajax({
            type: "post",
            url: "guru/controller/rekap_absensi_siswa.php",
            data: {
                act: "get_rekap",
                bulan: $("#txtFilterBulan").val(),
                kelas: $("#txtFilterKelas").val()
            },
            success: function (data) {
                $("#data_tabel").html(data);
            }
        });
    }

    $("#btnFilter").click(function () {
        if ($("#txtFilterKelas").val() === "0") {
            alert("Kelas wajib di isi");
        } else if ($("#txtFilterBulan").val() === "") {
            alert("Bulan Wajib di isi");
        } else {
            $("#data-box > .data-component").hide();
            getProfil();
            refreshGrid();
            $("#data-box > .data-component").fadeIn(400);
        }
    });

    function detail(id) {
        $.ajax({
            type: "post",
            url: "guru/controller/rekap_absensi_siswa.php",
            data: {
                act: "get_detail",
                bulan: $("#txtFilterBulan").val(),
                kelas: $("#txtFilterKelas").val(),
                id_siswa: id
            },
            success: function (data) {
                $("#data_detail").html(data);
                $("#modal_detail").modal({
                    backdrop: "static"
                });
            }
        });
    }

    function printPDF() {
        var kelas = $("#txtFilterKelas").val();
        var bulan = $("#txtFilterBulan").val();

        window.open("print-form/pdf_rekap_absensi.php?kelas=" + kelas + "&bulan=" + bulan);
    }


</script>
