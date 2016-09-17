<div class='page-content'>
				<div class="widget-box transparent">
					<div class="widget-header widget-header-small">
					<h4 class="widget-title smaller">
						<i class="ace-icon fa fa-check-square-o bigger-110"></i>
							<?php echo ucwords($sub);?>

					</h4>
					<div class='pull-right'>	
						<a data-rel='tooltip' href='javascript:history.back()' class='btn btn-success btn-white btn-round btn-sm fa fa-arrow-left'  title='Kembali' data-placement='bottom'></a>
						<a data-rel='tooltip' href='<?php echo base_url('penduduk/cetak/'.$resident_no); ?>' target='_blanks' class='btn btn-success btn-white btn-round btn-sm fa fa-print'  title='Cetak Personal Data Penduduk' data-placement='left'></a>
					</div>
					</div>
						<div class="widget-body">
							<div class="widget-main">		
									
								<div class="profile-user-info profile-user-info-striped">
									<div class="profile-info-row">
										<div class="profile-info-name" style='width:175px'> Kode / Nama Desa</div>
											<div class="profile-info-value ">
												<span class="editable"><?php echo $village_id.' / '.$village_name;?></span>
											</div>				
								
									</div>
									<div class="profile-info-row">
										<div class="profile-info-name" style='width:175px'> No KTP / NO KK</div>
											<div class="profile-info-value ">
												<span class="editable"><?php echo $resident_no.' / '.$resident_card_no;?></span>
											</div>				
								
									</div>		
									<div class="profile-info-row">
										<div class="profile-info-name"> Nama Penduduk</div>
											<div class="profile-info-value ">
												<span class="editable"><?php echo $resident_name;?></span>
											</div>	
									</div>
												
									<div class="profile-info-row">
										<div class="profile-info-name"> Tempat, Tgl Lahir</div>
											<div class="profile-info-value ">
												<span class="editable"><?php echo $resident_bplace.', '.date('d M Y',strtotime($resident_bday));?></span>
											</div>	
									</div>

									<div class="profile-info-row">
										<div class="profile-info-name"> Jenis Kelamin / Gol Darah</div>
											<div class="profile-info-value ">
												<span class="editable"><?php echo $resident_sex.' / '.$resident_bloodtype;?></span>
											</div>	
									</div>		
									<div class="profile-info-row">
										<div class="profile-info-name"> Peran Keluarga</div>
											<div class="profile-info-value ">
												<span class="editable"><?php echo $resident_fm_role;?></span>
											</div>	
									</div>		
									<div class="profile-info-row">
										<div class="profile-info-name"> Agama</div>
											<div class="profile-info-value ">
												<span class="editable"><?php echo $resident_religion;?></span>
											</div>	
									</div>			
									<div class="profile-info-row">
										<div class="profile-info-name"> Kebangsaan</div>
											<div class="profile-info-value ">
												<span class="editable"><?php echo $resident_of;?></span>
											</div>	
									</div>	
									<div class="profile-info-row">
										<div class="profile-info-name"> Status Pernikahan</div>
											<div class="profile-info-value ">
												<span class="editable"><?php echo $resident_marriage;?></span>
											</div>	
									</div>	
									<div class="profile-info-row">
										<div class="profile-info-name"> Pendidikan Terakhir</div>
											<div class="profile-info-value ">
												<span class="editable"><?php echo $resident_education;?></span>
											</div>	
									</div>
									<div class="profile-info-row">
										<div class="profile-info-name"> Pekerjaan</div>
											<div class="profile-info-value ">
												<span class="editable"><?php echo $resident_job;?></span>
											</div>	
									</div>		
									<div class="profile-info-row">
										<div class="profile-info-name"> Status Tinggal</div>
											<div class="profile-info-value ">
												<span class="editable"><?php echo $resident_stay_at;?></span>
											</div>	
									</div>		
									<div class="profile-info-row">
										<div class="profile-info-name"> Alamat</div>
											<div class="profile-info-value ">
												<span class="editable"><?php echo 'RT/RW '.$resident_vill_no.' '.$resident_address;?></span>
											</div>	
									</div>			
									<div class="profile-info-row">
										<div class="profile-info-name"> Status Kependudukan</div>
											<div class="profile-info-value ">
												<span class="editable"><?php echo $this->config->item('native_'.$resident_status);?></span>
											</div>	
									</div>
									<div class="profile-info-row">
										<div class="profile-info-name"> Ditambahkan Oleh, Waktu</div>
											<div class="profile-info-value ">
												<span class="editable"><?php echo $resident_addby; echo ($resident_addtime) ? ', '.date('d M Y H:i:s',strtotime($resident_addtime)) : '';?></span>
											</div>	
									</div>
									<div class="profile-info-row">
										<div class="profile-info-name"> Diupdate Oleh, Waktu</div>
											<div class="profile-info-value ">
												<span class="editable"><?php echo $resident_updatetime; echo ($resident_updatetime) ? ', '.date('d M Y H:i:s',strtotime($resident_updatetime)) : '';?></span>
											</div>	
									</div>						
											
								</div>

								
						</div>
					</div>
				</div>				
				
				
				

				<div class="widget-box transparent">
					<div class="widget-header widget-header-small">
					<h4 class="widget-title smaller">
						<i class="ace-icon fa fa-users bigger-110"></i>
							Susunan Keluarga
					</h4>

					<div class='pull-right'>	
						<a data-rel='tooltip' href='<?php echo base_url('keluarga/cetak/'.$resident_card_no); ?>' target='_blanks' class='btn btn-success btn-white btn-round btn-sm fa fa-print'  title='Cetak Kartu Keluarga Sementara' data-placement='left'></a>
					</div>
					</div>
					<div class="widget-body">
						<div class="widget-main">		
							<table class="table display responsive " cellspacing="0" width="100%">
								<thead>
									<tr>
										<th>Nama Lengkap</th>
										<th>No KTP</th>
										<th>L/P</th>
										<th>Peran</th>
										<th>Tempat, Tgl Lahir</th>
										<th>Agama</th>
										<th>Pendidikan</th>	
										<th>Pekerjaan </th>	
									</tr>
									<?php 
									if(count($card) > 0){
										foreach($card as $row){ ?>
										<tr>
											<td><?php echo $row->resident_name; ?></td>
											<td><?php echo $row->resident_no; ?></td>
											<td><?php echo $row->resident_sex; ?></td>
											<td><?php echo $row->resident_fm_role; ?></td>
											<td><?php echo $row->resident_bplace.', '.date('d M Y',strtotime($row->resident_bday)); ?></td>
											<td><?php echo $row->resident_religion; ?></td>
											<td><?php echo $row->resident_education; ?></td>	
											<td><?php echo $row->resident_job; ?></td>	
										</tr>
										<?php } 
									}else{
										echo '<tr><td colspan="7">No Data</td></tr>';
									}?>
								</thead>
							</table>		
								
						</div>
					</div>
				</div>				
</div>		