<?php !isset($jenis_alat) ? "<div class='col-xs-12 col-sm-".$sm." id='data1' class='data'>" : ''; ?>
<?php !isset($jenis_alat) ? "<h4 class='header smaller lighter blue' id='set3'>".$title."</h4>" : ''; ?>
	<table <?php echo !isset($jenis_alat) ? "class='table'" : "class='table center' border='1px'"; ?>>
		<tr>
			<td>No</td>
			<td>Jenis Alat</td>
			<td>Jumlah Alat</td>
			<td>Fungsi Alat</td>
			<td>BBM Jenis Tertentu</td>
			<td>Kebutuhan BBM</td>
			<td>Waktu Operasi</td>
			<td>Jumlah Konsumsi/hari</td>
		</tr>
		<?php
			$x 	= 0;
		foreach($jenis_alat as $key => $val)
			if(!empty($val)) $x = bcadd($x,1);
		
		$x = ($jenis_alat) ? $x : 3;
		
		for($i = 0; $i < $x; $i++){
			?>
		<tr>
			<td><?php echo bcadd($i,1); ?></td>
			<td width='100px'><?php echo isset($jenis_alat[$i]) ? $jenis_alat[$i] : "<input type='text' class='' name='jenis_alat[]'>"; ?></td>
			<td id='jumlah_alat<?php echo $i; ?>'><?php echo isset($jumlah_alat[$i]) ? $jumlah_alat[$i] : "<input type='text' class='col-sm-6' name='jumlah_alat[]'>"; ?></td>
			<td id='fungsi_alat<?php echo $i; ?>'><?php echo isset($fungsi_alat[$i]) ? $fungsi_alat[$i] : "<input type='text' class='col-sm-6' name='fungsi_alat[]' placeholder='BBM'>"; ?></td>
			<td id='bbm_tertentu<?php echo $i; ?>'><?php echo isset($bbm_tertentu[$i]) ? $bbm_tertentu[$i] : "<input type='text' class='col-sm-8' name='bbm_tertentu[]'>"; ?></td>
			<td id='kebutuhan_bbm<?php echo $i; ?>'><?php echo isset($kebutuhan_bbm[$i]) ? $kebutuhan_bbm[$i] : "<input type='text' class='col-sm-8' name='kebutuhan_bbm[]'>"; ?></td>
			<td id='waktu_operasi<?php echo $i; ?>'><?php echo isset($waktu_operasi[$i]) ? $waktu_operasi[$i] : "<input type='text' class='col-sm-8' name='waktu_operasi[]'>"; ?></td>
			<td id='konsumsi_bbm<?php echo $i; ?>'><?php echo isset($konsumsi_bbm[$i]) ? $konsumsi_bbm[$i] : "<input type='text' class='col-sm-6' name='konsumsi_bbm[]'>"; ?></td>
		</tr>
	<?php } ?>
</table>
<?php !isset($jenis_alat) ? '</div>' : ''; ?>