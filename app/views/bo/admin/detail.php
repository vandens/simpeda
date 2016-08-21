<?php echo '<script src="'.base_url('media/js/bootstrap.js').'"></script>'; ?>
<div class='col-sm-9'>
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
<div class='col-sm-3'>
	<h3 class="header smaller lighter red">Berita Lainnya</h3>
	<?php foreach($link_berita as $row){ ?>
			<a href='<?php echo base_url('admin/info/'.$row->info_id); ?>'><?php echo $row->info_title; ?></a></br>
	<?php } ?>
</div>