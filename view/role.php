<section class="content-header">
	<h1>
		Master customer
		<small>Daftar customer</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-th"></i> Dashboard</a></li>
		<li class="active">Master customer</li>
	</ol>
</section>

<section class="content">
	<div class="box box-widget">
		<div class="box-header with-border">
			<h6 class="box-title">Master customer</h6>
			<div class="box-tools pull-right">				
				<button type="button" class="btn btn-box-tool" onclick="addNew();"><i class="fa fa-plus fa-fw"></i> Tambah</button>
			</div>
		</div>

		<div class="box-body">
			<div class="table-responsive">
				<table class="table table-responsive table-bordered table-hover dataGrid" id="dataGrid">
					<thead>
						<tr>
							<th style="text-align:center">Kode</th>
							<th>Nama customer</th>
							<th>Alamat</th>
							<th style="text-align:center">Telpon</th>
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
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><i class="fa fa-times fa-fw"></i></button>
				<h5 class="modal-title" id="modalTitle"></h5>
			</div>

			<div class="modal-body">
				<input type="hidden" id="txtId" value="0">

				<div class="row">
					<div class="col-md-6">
						<label class="small-label">Nama customer</label>
						<input type="text" class="form-control input-sm" id="txtNama">
					</div>

					<div class="col-md-6">
						<label class="small-label">Telpon</label>
						<input type="number" class="form-control input-sm" id="txtTelpon">
					</div>
				</div>

				<div class="row">
					<div class="col-md-12">
						<label class="small-label">Alamat</label>
						<textarea class="form-control" rows="3" style="resize: none;" id="txtAlamat"></textarea>
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
			url: "controller/master_customer.php",
			type: "post",
			data: {
				act: "getAll",
			}
		},
		columns: [
		{
			className: "centerCol",
			data: "kode_customer"
		},
		{data: "nama"},
		{data: "alamat"},
		{data: "telpon"},
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
		$("#txtNama").focus();
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

		$.post("controller/master_customer.php",{
			act: "getData",
			id: id
		}, function(data){
			var dataSet = data.result[0];

			$("#txtId").val(dataSet.id_customer);
			$("#txtNama").val(dataSet.nama);
			$("#txtTelpon").val(dataSet.telpon);
			$("#txtAlamat").val(dataSet.alamat);

			$("#modalTitle").html("<i class='fa fa-pencil fa-fw'></i> Edit Data");

			$("#modalForm").modal({
				backdrop: "static"
			});

		}, "json");
	}

	function del(id){
		var konfirmasi = confirm("Apakah yakin akan menghapus data ini ?");

		if(konfirmasi){
			$.post("controller/master_customer.php",{
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
		var nama = $("#txtNama").val();
		var telpon = $("#txtTelpon").val();
		var alamat = $("#txtAlamat").val();

		$.post("controller/master_customer.php",{
			act: "save",
			id: id,
			nama: nama,
			telpon: telpon,
			alamat: alamat
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