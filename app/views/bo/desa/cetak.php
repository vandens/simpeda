
<style>
@media print{
	table tr .warna{ bgcolor: lightgray;}
}
@media screen{
	.warna{ bgcolor: lightgray;}
}
</style>
<body onload='window.print()'>
<?php echo $header;?>
<table width="100%" border="0">
  <tr>
    <td colspan="3" class='warna' bgcolor="#CCCCCC">REGIONAL</td>
  </tr>
  <tr>
  	<td width="29%">Propinsi</td>
  	<td width="2%">:</td>
  	<td width="69%"><?php echo $data['province']['province']; ?></td>
  </tr>
  <tr>
  	<td width="29%">Kabupaten</td>
  	<td width="2%">:</td>
  	<td width="69%"><?php echo $data['district']['district']; ?></td>
  </tr>
  <tr>
  	<td width="29%">Kecamatan</td>
  	<td width="2%">:</td>
  	<td width="69%"><?php echo $data['subdistrict']['subdistrict']; ?></td>
  </tr>
</table>
<br>  		
<table width="100%" border="0">
  <tr>
    <td colspan="3" bgcolor="#CCCCCC">Profil</td>
  </tr>
  <?php 
  foreach($data['profil'] as $key => $val){
  echo '<tr>
    		<td width="29%">'.$key.'</td>
    		<td width="2%">:</td>
    		<td width="69%">'.$val.'</td>
  		</tr>';	
  } ?>
</table>
<br>
<table width="100%" border="0">
  <tr>
    <td colspan="3" bgcolor="#CCCCCC">GEOGRAFIS</td>
  </tr>
  <tr>
  	<td width="29%">Luas wilayah</td>
  	<td width="2%">:</td>
  	<td width="69%"><?php echo $data['luas']['luas_area']; ?></td>
  </tr>
  <?php 
  foreach($data['geografis'] as $key => $val){
  echo '<tr>
    		<td width="29%">'.$key.'</td>
    		<td width="2%">:</td>
    		<td width="69%">'.$val.'</td>
  		</tr>';	
  } ?>
  <?php 
  foreach($data['batas'] as $key => $val){
  echo '<tr>
    		<td width="29%">'.$key.'</td>
    		<td width="2%">:</td>
    		<td width="69%">'.$val.'</td>
  		</tr>';	
  } ?>
</table>

<br>  		
<table width="100%" border="0">
  <tr>
    <td colspan="3" bgcolor="#CCCCCC">PERTANAHAN</td>
  </tr>
  <?php 
  foreach($data['status'] as $key => $val){
  echo '<tr>
    		<td width="29%">'.$key.'</td>
    		<td width="2%">:</td>
    		<td width="69%">'.$val.'</td>
  		</tr>';	
  } ?>
  
  <?php 
  foreach($data['peruntukkan'] as $key => $val){
  echo '<tr>
    		<td width="29%">'.$key.'</td>
    		<td width="2%">:</td>
    		<td width="69%">'.$val.'</td>
  		</tr>';	
  } ?>
  <?php 
  foreach($data['penggunaan'] as $key => $val){
  echo '<tr>
    		<td width="29%">'.$key.'</td>
    		<td width="2%">:</td>
    		<td width="69%">'.$val.'</td>
  		</tr>';	
  } ?>
</table>

<br>  		
<table width="100%" border="0">
  <tr>
    <td colspan="3" bgcolor="#CCCCCC">BANGUNAN</td>
  </tr>
  <?php 
  foreach($data['keagamaan'] as $key => $val){
  echo '<tr>
    		<td width="29%">'.$key.'</td>
    		<td width="2%">:</td>
    		<td width="69%">'.$val.'</td>
  		</tr>';	
  } ?>
  
  <?php 
  foreach($data['pendidikan'] as $key => $val){
  echo '<tr>
    		<td width="29%">'.$key.'</td>
    		<td width="2%">:</td>
    		<td width="69%">'.$val.'</td>
  		</tr>';	
  } ?>
</table>
</body>