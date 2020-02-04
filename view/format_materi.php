<section class="content-header">
	<h1>
		Format Materi
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-th"></i> Dashboard</a></li>
		<li class="active">Format Materi</li>
	</ol>
</section>

<section class="content">
	<div class="box box-widget">
		<div class="box-header with-border">
			<h6 class="box-title">List Format</h6>
			<div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool btnAdd" onclick="addNew();"><i class="fa fa-plus fa-fw"></i> Tambah</button>
			</div>
		</div>

		<div class="box-body">
			<div class="table-responsive">
				<table class="table table-responsive table-bordered table-hover dataGrid" id="dataGrid">
					<thead>
						<tr>
							<th style="text-align: center;width: 15%;">Tipe</th>
							<th style="text-align: left;">Nama Format</th>
							<th style="text-align: left;">Format Value</th>
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
					<div class="col-md-6 form-group">
						<label class="small-label">Nama Format</label>
						<input type="text" class="form-control input-sm" id="txtNamaFormat" placeholder="Contoh: Program Tahunan">
						<br>
					</div>
          <div class="col-md-6 form-group">
						<label class="small-label">Tipe Format</label>
						<select class="form-control input-sm select2" id="txtTipeFormat">
              <option value="pilihan">Opsi / Pilihan</option>
              <option value="text">Input Teks</option>
            </select>
						<br>
					</div>
				</div>

				<div class="row">
					<div class="col-md-12 form-group">
						<label class="small-label">Isi Format (Format Value)</label>
						<input type="text" class="form-control input-sm" id="txtFormatValue" />
						<br>
            <div class="alert alert-info">
              <p><i class="fa fa-chevron-right fa-fw"></i> Untuk tipe opsi / pilihan. pisahkan value dengan koma ",".<br><i class="fa fa-chevron-right fa-fw"></i> contoh: <strong>Semester 1, Semester 2</strong></p>
              <p><i class="fa fa-chevron-right fa-fw"></i> Untuk tipe teks. ketik keterangan untuk catatan.<br><i class="fa fa-chevron-right fa-fw"></i> contoh: <strong>RPP 1 | RPP 2 dsb.</strong></p>
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
			url: "controller/format_materi.php",
			type: "post",
			data: {
				act: "getAll",
			}
		},
		columns: [
		{
			className: "centerCol",
			data: {
        tipe: "pilihan"
      },
      render: function(data){
        var lbl = "";
        if(data.tipe === "pilihan"){
          lbl += "<span class='label label-success'>Opsi / Pilihan</span>";
        }else{
          lbl += "<span class='label label-info'>Teks</span>";
        }

        return lbl;
      }
		},
		{data: "nama_format"},
		{
			data: "format_value"
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
		$("#txtNamaFormat").focus();
		$("#txtTipeFormat").val("text").trigger("change");
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

		$.post("controller/format_materi.php",{
			act: "getData",
			id: id
		}, function(data){
			var dataSet = data.result[0];

			$("#txtId").val(dataSet.id_format);
      $("#txtNamaFormat").val(dataSet.nama_format);
      $("#txtTipeFormat").val(dataSet.tipe);
      $("#txtFormatValue").val(dataSet.format_value);

			$("#modalTitle").html("<i class='fa fa-pencil fa-fw'></i> Edit Data");

			$("#modalForm").modal({
				backdrop: "static"
			});

		}, "json");
	}

	function del(id){
		var konfirmasi = confirm("Apakah yakin akan menghapus data ini ?");

		if(konfirmasi){
			$.post("controller/format_materi.php",{
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
		var nama_format = $("#txtNamaFormat").val();
    var type = $("#txtTipeFormat").val();
    var format_value = $("#txtFormatValue").val();


		$.post("controller/format_materi.php",{
			act: "save",
			id: id,
			nama_format: nama_format,
      type: type,
      format_value: format_value
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
