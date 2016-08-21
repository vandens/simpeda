<style>
.container{ font-family: arial; }
.kk{ font-size: 30px;  text-align: center;}
table{ font-size: 10px;  border-collapse: collapse; padding:0;}
</style>
<link rel="stylesheet" href="<?php echo base_url(); ?>media/css/bootstrap.css" />
<body onload='window.print()'>
<div class='container center'>

	<table width='100%' style='margin-bottom:5px;'>
		<tr>
			<td colspan='6'><center><img src='<?php echo base_url('media/img/garuda.png'); ?>' style='width:100px;'></center></td>
		</tr>
		<tr>
				<td colspan='6'><center><b><h4>BIODATA PENDUDUK <?php echo ($list->warganegara == 'WNI') ? 'WARGA NEGARA INDONESIA' : 'WARGA NEGARA ASING'; unset($list->warganegara);?><h4></center></td>
		</tr>
		<tr>
				<td colspan='6'><center><b><h5>NIK : <?php echo $list->NIK; unset($list->NIK); ?><h5></center></td>
		</tr>
		<tr>
			<td colspan='6'><br><br></td>
		</tr>
		<tr>
			<td colspan='6'><b>DATA PERSONAL</b></td>
		</tr>
		<?php $no =1; 
		foreach($list as $key => $val){ ?>
		<tr>
			<td width='20px;'><?php echo ($no < 14) ? $no++ : ''; ?></td><td width='200px;'><?php echo $key; ?></td><td width='10px;'>: </td><td width='300px;'><?php echo $val; ?></td><td width='400px;'></td><td></td>
		</tr>
		<?php } ?>
		<tr>
			<td colspan='6'><br></td>
		</tr>
		<tr>
			<td colspan='6'><b>DATA KEPEMILIKAN DOKUMEN</b></td>
		</tr>
		<?php $no =14; 
		foreach($doc as $doc){ ?>
		<tr>
			<td width='20px;'><?php echo $no++; ?></td><td width='200px;'><?php echo $doc->doc_name; ?></td><td width='10px;'>: </td><td><?php echo $doc->doc_no; echo !empty($doc->doc_valid_date) ? ' <span class="pull-right">Berlaku Hingga : '.date('d M Y',strtotime($doc->doc_valid_date)).'</span>' : ''; ?></td><td></td><td></td>
		</tr>
		<?php } ?>
		<tr>
			<td colspan='6'><br><br></td>
		</tr>
		<tr>
			<td></td><td></td><td></td><td></td><td><center><?php echo ucwords($this->session->userdata('village_name')).', '.date('d M Y'); ?></center></td><td></td>
		</tr>
		<tr>
			<td></td><td></td><td></td><td><center>Yang bersangkutan,</center></td><td><center>Kepala Desa / Sekretaris Desa</center></td><td></td>
		</tr>
		<tr>
			<td colspan='6'><br><br><br><br></td>
		</tr>
		<tr>
			<td></td><td></td><td></td><td><center><u>......................................................<u></center></td><td><center><u>......................................................<u></center></td><td></td>
		</tr>
	</table>


</div>
</body>