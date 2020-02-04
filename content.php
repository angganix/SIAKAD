<div class="content-wrapper">
	<?php
	$pg = isset($_GET['pg']) ? $_GET['pg'] : "dashboard";

	$access_rules = ["View_","Tambah_","Edit_","Hapus_"];
	$arr_acc = array();
	foreach($access_rules as $acc){
		if(array_search($acc.$pg, $_SESSION['akses_role']) !== false){
			array_push($arr_acc, $_SESSION['akses_role'][array_search($acc.$pg, $_SESSION['akses_role'])]);
		}
	}

	if(array_search("View_".$pg, $arr_acc) !== false){
		if($pg == "dashboard" OR $pg == ""){
			require_once "view/dashboard.php";
		}else{
			require_once "view/".$pg.".php";
		}
	}else{
		echo "<section class='content'>";
		echo "<div class='alert alert-info'>";
		echo "<h4>Anda tidak punya akses untuk melihat halaman ini</h4>";
		echo "</div>";
		echo "</section>";
	}
	
	?>
	<script type="text/javascript">
		function access_rules(){
			<?php
			if(array_search("Tambah_".$pg, $arr_acc) == false){
				?>
				$(".btnAdd").remove();
				<?php
			}

			if(array_search("Edit_".$pg, $arr_acc) == false){
				?>
				$(".btnEdit").remove();
				<?php
			}

			if(array_search("Hapus_".$pg, $arr_acc) == false){
				?>
				$(".btnDel").remove();
				<?php
			}
			?>
		}

		setInterval(function(){
			access_rules();
		}, 50);
		
	</script>
</div>