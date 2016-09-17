<table width='100%' style='text-align:center'>
	<tr>
		<td rowspan='4' width='120px;'><img width='90px' id='logo' src='<?php echo base_url(); ?>media/img/logo.png'></td>
		<td id='kab'>PEMERINTAH KABUPATEN <?php echo strtoupper($this->session->userdata('district')); ?></td>
		<td width='100px'></td>
	</tr>
	<tr>
		<td id='kec'>KECAMATAN <?php echo strtoupper($this->session->userdata('subdistrict')); ?></td> 
		<td></td>
	</tr>
	<tr>
		<td id='desa'>DESA <?php echo strtoupper($this->session->userdata('village_name')); ?></td> 
		<td></td>
	</tr>
	<tr>
		<td id='alamat'><?php echo ucwords(strtolower($this->session->userdata('village_address'))); ?></td> 
		<td></td>
	</tr>
</table>
<div style='border-style:double;'></div>