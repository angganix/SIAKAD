<section class="content-header">
	<h1>
		Data Administrator
		<small>Daftar User Admin</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-th"></i> Dashboard</a></li>
		<li class="active">Data Administrator</li>
	</ol>
</section>

<section class="content">
	<div class="box box-widget">
		<div class="box-header with-border">
			<h6 class="box-title">List Administrator</h6>
			<div class="box-tools pull-right">				
				<button type="button" class="btn btn-box-tool btnAdd" onclick="addNew();"><i class="fa fa-plus fa-fw"></i> Tambah</button>
			</div>
		</div>

		<div class="box-body">
			<div class="table-responsive">
				<table class="table table-responsive table-bordered table-hover dataGrid" id="dataGrid">
					<thead>
						<tr>
							<th style="text-align:center">Username</th>
							<th>Nama</th>
							<th>Email</th>
							<th style="text-align:center">Telpon</th>
							<th style="text-align:center">Akses</th>
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
						<label class="small-label">Username</label>
						<input type="text" class="form-control input-sm" id="txtUsername">
						<br>
					</div>
					<div class="col-md-6 form-group">
						<label class="small-label">Nama Lengkap</label>
						<input type="text" class="form-control input-sm" id="txtNama">
						<br>
					</div>
				</div>

				<div class="row">
					<div class="col-md-6 form-group">
						<label class="small-label">Password</label>
						<input type="password" class="form-control input-sm" id="txtPassword">
						<br>
					</div>

					<div class="col-md-6 form-group">
						<label class="small-label">Ulangi Password</label>
						<input type="password" class="form-control input-sm" id="txtRePassword">
						<br>
					</div>
				</div>

				<div class="row">
					<div class="col-md-6 form-group">
						<label class="small-label">Email</label>
						<input type="email" class="form-control input-sm" id="txtEmail">
						<br>
					</div>

					<div class="col-md-6 form-group">
						<label class="small-label">No. Telpon</label>
						<input type="number" class="form-control input-sm" id="txtNoTelpon">
						<br>
					</div>
				</div>

				<div class="row">
					<div class="col-md-6 form-group">
						<label class="small-label">Akses</label>
						<select class="form-control input-sm" id="txtAkses">
						</select>
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
			url: "controller/data_administrator.php",
			type: "post",
			data: {
				act: "getAll",
			}
		},
		columns: [
		{
			className: "centerCol",
			data: "username"
		},
		{data: "nama"},
		{data: "email"},
		{
			className: "centerCol",
			data: "no_telpon"
		},
		{
			className: "centerCol",
			data: "str_akses"
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
		$("#txtUsername").prop("disabled", false);
		$("#txtUsername").focus();
		$("#txtAkses").val("0").trigger("change");

	}

	function addNew(){
		resetField();

		$("#modalTitle").html("<i class='fa fa-plus fa-fw'></i> Tambah Admin");

		$("#modalForm").modal({
			backdrop: "static"
		});
	}


	function getAkses(){
		$.post("controller/data_administrator.php",{
			act: "get_akses"
		}, function(data){

			var lst = "";
			lst += "<option value='0'>- Pilih Akses -</option>";

			$(data.result).each(function(i, val){
				lst += "<option value='"+val.id+"'>"+val.nama_role+"</option>";
			});

			$("#txtAkses").html(lst);

		}, "json");
	}

	getAkses();

	function edit(id){
		resetField();

		$.post("controller/data_administrator.php",{
			act: "getData",
			id: id
		}, function(data){
			var dataSet = data.result[0];

			$("#txtId").val(dataSet.id);
			$("#txtUsername").val(dataSet.username);
			$("#txtUsername").prop("disabled", true);
			$("#txtNama").val(dataSet.nama);
			$("#txtEmail").val(dataSet.email);
			$("#txtNoTelpon").val(dataSet.no_telpon);
			$("#txtAkses").val(dataSet.akses);

			$("#modalTitle").html("<i class='fa fa-pencil fa-fw'></i> Edit Admin");

			$("#modalForm").modal({
				backdrop: "static"
			});

		}, "json");
	}

	function del(id){
		var konfirmasi = confirm("Apakah yakin akan menghapus data ini ?");

		if(konfirmasi){
			$.post("controller/data_administrator.php",{
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
		var username = $("#txtUsername").val();
		var password = $("#txtPassword").val();
		var re_password = $("#txtRePassword").val();
		var nama = $("#txtNama").val();
		var email = $("#txtEmail").val();
		var no_telpon = $("#txtNoTelpon").val();
		var akses = $("#txtAkses").val();

		if(password !== re_password){
			alert("Password tidak sama...");
			$("#txtRePassword").focus();
		}else{
			$.post("controller/data_administrator.php",{
				act: "save",
				id: id,
				username: username,
				password: password,
				re_password: re_password,
				nama: nama,
				email: email,
				no_telpon: no_telpon,
				akses: akses
			}, function(data){

				if(data.status === true){
					$("#modalForm").modal("hide");
					tabel.ajax.reload();
				}else{
					if(data.cek === "exists"){
						alert("User "+username+" sudah ada, ganti dengan yang lain!");
					}else{
						alert("Data gagal di simpan");
					}					
				}

			}, "json");
		}
		

	}

</script>