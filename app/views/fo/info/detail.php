<div class='col-sm-8'>
	<h3 class="header smaller lighter red"><?php echo $info_title; ?></h3>
	<div style='font-size:10px;'>
		<span class='pull-right'><i class="ace-icon fa fa-user"></i> Dibaca: <?php echo $info_visited.' kali'; ?></span>
		<span><i class="ace-icon fa fa-user"></i> Ditambahkan Oleh : <?php echo 'Admin '.$village_name.' ('.$user_fullname.')'; ?></span><br>
		<span><i class="ace-icon glyphicon glyphicon-time"></i> Waktu : <?php echo date('d M Y H:i:s',strtotime($info_addtime)); ?></span><br>
	</div>
	<br>
	
	<div style='text-align:justify'>
	<?php echo $info_content; ?>
	</div>
</div>