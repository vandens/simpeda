<style>
.container{ font-family: arial;margin:10px;}
.kk{ font-size: 30px;  text-align: center;}
table{ font-size: 10px;  border-collapse: collapse; padding:0;}
</style>
<body onload='window.print().focus()'>
<div class='container'>
	<div class='logo'>
		<img src='<?php echo base_url('media/img/garuda.png'); ?>' style='width:100px;float:left;margin-bottom:-50px;'>		
	</div>
	<table width='100%'>
		<tr>
			<td></td><td width='200px;'></td><td></td><td colspan='2' class='kk'><center><b>KARTU KELUARGA</b></center></td><td></td><td></td><td></td>
		</tr>
		<tr>
			<td></td><td></td><td></td><td colspan='2' style='font-size:18px;'><center><b>No. 234567856789</b></center></td><td></td><td></td><td></td>
		</tr>
		<tr>
			<td></td><td>Nama Kepala Keluarga</td>	<td>:</td><td><b><?php echo strtoupper($resident_name); ?></b></td>	<td  width='125px'>Kecamatan</td><td>:</td><td><b><?php echo strtoupper($this->_setting->app_region); ?></b></td><td></td>
		</tr>
		<tr>
			<td></td><td>Alamat</td>				<td>:</td><td><?php echo strtoupper($resident_address); ?></td>				<td>Kabupaten / Kota</td><td>:</td><td><?php echo strtoupper($this->_setting->app_city); ?></td><td></td>
		</tr>
		<tr>
			<td></td><td>RT / RW</td>				<td>:</td><td>-</td>				<td>Kode Pos</td><td>:</td><td><?php echo $this->_setting->app_postal; ?></td><td></td>
		</tr>
		<tr>
			<td></td><td>Desa / Kelurahan</td>		<td>:</td><td><?php echo strtoupper($card[0]->village_name); ?></td>			<td>Provinsi</td><td>:</td><td><?php echo $this->_setting->app_province; ?></td><td></td>
		</tr>
	</table>

	<table width='100%' border='1px;' style='margin-bottom:5px;'>

		<tr style='text-align:center; height:50px;'>
			<td width='20px;'>No</td>
			<td width='250px;'>Nama Lengkap</td>
			<td width='100px;'>NIK</td>
			<td width='75px;'>Jenis Kelamin</td>
			<td>Tempat Lahir</td>
			<td width='55px;'>Tanggal Lahir</td>
			<td>Agama</td>
			<td>Pendidikan</td>
			<td>Jenis Pekerjaan</td>
		</tr>
		<tr style='text-align:center; background-color:lightgray;'>
			<td></td>
			<td>(1)</td>
			<td>(2)</td>
			<td>(3)</td>
			<td>(4)</td>
			<td>(5)</td>
			<td>(6)</td>
			<td>(7)</td>
			<td>(8)</td>
		</tr>
		<?php 
		for ($i=0; $i < 10; $i++) { 
			$sex = array('L'=>'laki-laki','P'=>'perempuan');
		 ?>		
		<tr>
			<td><?php echo bcadd($i,1); ?></td>
			<td><?php echo ($card[$i]->resident_name) ? strtoupper($card[$i]->resident_name) 					: '-'; ?></td>
			<td><?php echo ($card[$i]->resident_no) ? strtoupper($card[$i]->resident_no) 						: '-'; ?></td>
			<td><?php echo ($card[$i]->resident_sex) ? strtoupper($sex[$card[$i]->resident_sex]) 				: '-'; ?></td>
			<td><?php echo ($card[$i]->resident_bplace) ? strtoupper($card[$i]->resident_bplace) 				: '-'; ?></td>
			<td><?php echo ($card[$i]->resident_bday) ? date('d-m-Y',strtotime($card[$i]->resident_bday)) 		: '-'; ?></td>
			<td><?php echo ($card[$i]->resident_religion) ? strtoupper($card[$i]->resident_religion) 			: '-'; ?></td>
			<td><?php echo ($card[$i]->resident_education) ? strtoupper($card[$i]->resident_education) 			: '-'; ?></td>
			<td><?php echo ($card[$i]->resident_job) ? strtoupper($card[$i]->resident_job) 						: '-'; ?></td>
		</tr>
		<?php } ?>
	</table>

	<table width='100%' border='1px;' style='margin-bottom:5px;'>
		<tr style='text-align:center; height:50px;'>
			<td width='20px;' rowspan='2'>No</td>
			<td width='100px;' rowspan='2'>Status Perkawinan</td>
			<td width='100px;' rowspan='2'>Status Hubungan dalam Keluarga</td>
			<td width='75px;' rowspan='2'>Kewarganegaraan</td>
			<td colspan='2'>Dokumentasi Imigrasi</td>
			<td colspan='2'>Nama Orang Tua</td>
		</tr>
		<tr style='text-align:center;'>
			<td>No. Passpor</td>
			<td>No. KITAS/KITAP</td>
			<td>Ayah</td>
			<td>Ibu</td>
		</tr>
		<tr style='text-align:center; background-color:lightgray;'>
			<td></td>
			<td>(9)</td>
			<td>(10)</td>
			<td>(11)</td>
			<td>(12)</td>
			<td>(13)</td>
			<td>(14)</td>
			<td>(15)</td>
		</tr>
		<?php 
		for ($i=0; $i < 10; $i++) { 
			$wni['Indonesia']	= 'WNI';
		 ?>		
		<tr>
			<td><?php echo bcadd($i,1); ?></td>
			<td><?php echo ($card[$i]->resident_marriage) ? strtoupper($card[$i]->resident_marriage) 	: '-'; ?></td>
			<td><?php echo ($card[$i]->resident_fm_role) ? strtoupper($card[$i]->resident_fm_role) 		: '-'; ?></td>
			<td><?php echo ($wni[$card[$i]->resident_of]) ? strtoupper($wni[$card[$i]->resident_of]) 	: '-'; ?></td>
			<td><?php echo '-'; ?></td>
			<td><?php echo '-'; ?></td>
			<td><?php echo ($card[$i]->resident_f_name) ? strtoupper($card[$i]->resident_f_name) 		: '-'; ?></td>
			<td><?php echo ($card[$i]->resident_m_name) ? strtoupper($card[$i]->resident_m_name) 		: '-'; ?></td>
		</tr>
		<?php } ?>
	</table>


	<table width='100%'>
		<tr>
			<td></td><td width='150px;'>Dikeluarkan Tanggal</td><td width='20px;'>:</td><td  width='120px;'><b><?php echo date('d-m-Y'); ?></b></td><td></td><td></td><td></td><td><center><?php echo $this->session->userdata('village_name').', '.date('d M Y'); ?></center></td><td></td>
		</tr>
		<tr>
			<td></td><td width='150px;'>LEMBAR</td>				<td width='20px;'>: I.</td><td> Kepala Keluarga</td><td></td><td width='150px'><center>KEPALA KELUARGA</center></td><td></td><td width='200px;'><center>Camat / Lurah / Kepala Desa</center></td><td></td>
		</tr>
		<tr>

			<td></td><td width='150px;'></td>				<td width='20px;'>: II.</td><td>RT</td><td></td><td></td><td></td><td></td><td></td>
		</tr>
		<tr>

			<td></td><td width='150px;'></td>				<td width='20px;'>: III.</td><td>Desa/Kelurahan</td><td></td><td></td><td></td><td></td><td></td>
		</tr>
		<tr>
			<td></td><td width='150px;'></td>				<td width='20px;'>: IV.</td><td>Kecamatan</td><td></td><td><b><center><u><?php echo $resident_name; ?></u></center></b></td><td></td><td><b><center><u>.........................................</u></center></b></td><td></td>
		</tr>
		<tr>
			<td></td><td width='150px;'></td>				<td width='20px;'></td><td></td><td></td><td><center>Tanda Tangan/Cap Jempol</center></td><td></td><td><b><center>NIP. 123456789998865434567</center></b></td><td></td>
		</tr>
	</table>


</div>
</body>