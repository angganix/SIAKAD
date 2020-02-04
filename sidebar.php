<?php
require_once "config/init.php";
$pg = isset($_GET['pg']) ? $_GET['pg'] : "";
?>

<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
	<!-- sidebar: style can be found in sidebar.less -->
	<section class="sidebar">
		<!-- Sidebar user panel -->
		<div class="user-panel">
			<div class="pull-left image">
				<img src="asset/dist/img/user-icon.jpg" class="img-circle" alt="User Image">
			</div>
			<div class="pull-left info">
				<p><?= $_SESSION['fullname']; ?></p>
				<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
			</div>
		</div>

		<!-- sidebar menu: : style can be found in sidebar.less -->
		<ul class="sidebar-menu" data-widget="tree">
			<li <?= checkMenu("dashboard", $pg); ?>>
				<a href="?pg=dashboard">
					<i class="fa fa-th"></i> <span>Dashboard</span>
				</a>
			</li>
			<li class="treeview <?= checkParentMenu($pg, 'master'); ?>">
				<a href="#">
					<i class="fa fa-tags"></i>
					<span>Data Master</span>
					<span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
				</a>
				<ul class="treeview-menu">
					<li <?= checkMenu("data_identitas_sekolah", $pg); ?>>
						<a href="?pg=data_identitas_sekolah"><i class="fa fa-circle-o fa-fw"></i> <span>Data Identitas Sekolah</span></a>
					</li>
					<li <?= checkMenu("data_kurikulum", $pg); ?>>
						<a href="?pg=data_kurikulum"><i class="fa fa-circle-o fa-fw"></i> <span>Data Kurikulum</span></a>
					</li>
					<li <?= checkMenu("data_tahun_akademik", $pg); ?>>
						<a href="?pg=data_tahun_akademik"><i class="fa fa-circle-o fa-fw"></i> <span>Data Tahun Akademik</span></a>
					</li>
					<li <?= checkMenu("data_golongan", $pg); ?>>
						<a href="?pg=data_golongan"><i class="fa fa-circle-o fa-fw"></i> <span>Data Golongan</span></a>
					</li>
					<li <?= checkMenu("data_ketunaan", $pg); ?>>
						<a href="?pg=data_ketunaan"><i class="fa fa-circle-o fa-fw"></i> <span>Data Ketunaan</span></a>
					</li>
					<li <?= checkMenu("data_jurusan", $pg); ?>>
						<a href="?pg=data_jurusan"><i class="fa fa-circle-o fa-fw"></i> <span>Data Keterampilan</span></a>
					</li>
					<li <?= checkMenu("data_jenis_ptk", $pg); ?>>
						<a href="?pg=data_jenis_ptk"><i class="fa fa-circle-o fa-fw"></i> <span>Data Jenis PTK</span></a>
					</li>
					<li <?= checkMenu("data_kelas", $pg); ?>>
						<a href="?pg=data_kelas"><i class="fa fa-circle-o fa-fw"></i> <span>Data Kelas</span></a>
					</li>
					<li <?= checkMenu("data_status_kepegawaian", $pg); ?>>
						<a href="?pg=data_status_kepegawaian"><i class="fa fa-circle-o fa-fw"></i> <span>Data Status Kepegawaian</span></a>
					</li>
					<li <?= checkMenu("data_agama", $pg); ?>>
						<a href="?pg=data_agama"><i class="fa fa-circle-o fa-fw"></i> <span>Data Agama</span></a>
					</li>
				</ul>
			</li>
			<li class="treeview <?= checkParentMenu($pg, 'pengguna'); ?>">
				<a href="#">
					<i class="fa fa-users"></i>
					<span>Data Pengguna</span>
					<span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
				</a>
				<ul class="treeview-menu">
					<li <?= checkMenu("data_siswa", $pg); ?>>
						<a href="?pg=data_siswa"><i class="fa fa-circle-o fa-fw"></i> <span>Data Siswa</span></a>
					</li>
					<li <?= checkMenu("data_guru", $pg); ?>>
						<a href="?pg=data_guru"><i class="fa fa-circle-o fa-fw"></i> <span>Data Guru</span></a>
					</li>
					<li <?= checkMenu("data_administrator", $pg); ?>>
						<a href="?pg=data_administrator"><i class="fa fa-circle-o fa-fw"></i> <span>Data Administrator</span></a>
					</li>
					<li <?= checkMenu("data_role_access", $pg); ?>>
						<a href="?pg=data_role_access"><i class="fa fa-circle-o fa-fw"></i> <span>Data Akses Role</span></a>
					</li>
				</ul>
			</li>
			<li class="treeview <?= checkParentMenu($pg, 'ruang_guru'); ?>">
				<a href="#">
					<i class="fa fa-user"></i> <span>Ruang Guru</span>
					<span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
				</a>
				<ul class="treeview-menu">
					<li <?= checkMenu("format_materi", $pg); ?>>
						<a href="?pg=format_materi"><i class="fa fa-circle-o fa-fw"></i> <span>Format Materi</span></a>
					</li>
					<li <?= checkMenu("data_materi", $pg); ?>>
						<a href="?pg=data_materi"><i class="fa fa-circle-o fa-fw"></i> <span>Materi Kelas</span></a>
					</li>
					<li <?= checkMenu("data_materi_keterampilan", $pg); ?>>
						<a href="?pg=data_materi_keterampilan"><i class="fa fa-circle-o fa-fw"></i> <span>Materi Bidang Studi</span></a>
					</li>
					<li <?= checkMenu("data_files", $pg); ?>>
						<a href="?pg=data_files"><i class="fa fa-circle-o fa-fw"></i> <span>Data File</span></a>
					</li>
					<li <?= checkMenu("rekap_absensi_siswa", $pg); ?>>
						<a href="?pg=rekap_absensi_siswa"><i class="fa fa-circle-o fa-fw"></i> <span>Rekap Absensi </span></a>
					</li>
					<!-- <li <?= checkMenu("aktivitas_guru", $pg); ?>>
						<a href="?pg=aktivitas_guru"><i class="fa fa-circle-o fa-fw"></i> <span>Aktivitas Guru</span></a>
					</li> -->
				</ul>
			</li>
            <li <?= checkMenu("pendaftaran", $pg); ?>>
				<a href="?pg=pendaftaran">
					<i class="fa fa-user-plus"></i> Pendaftaran</span>
				</a>
			</li>
		</ul>
	</section>
	<!-- /.sidebar -->
</aside>
