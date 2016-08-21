				<div class="widget-box transparent">
					<div class="widget-header widget-header-small">
					<h4 class="widget-title smaller">
						<i class="ace-icon fa fa-check-square-o bigger-110"></i>
							<?php echo ucwords($sub);?>

					<div class='pull-right'>	
						<a data-rel='tooltip' href='javascript:history.back()' class='btn btn-success btn-white btn-round btn-sm fa fa-arrow-left'  title='Kembali' data-placement='bottom'></a>
					</div>
					</h4>
					</div>
						<div class="widget-body">
							<div class="widget-main">		
									
								<div class="profile-user-info profile-user-info-striped">
									<div class="profile-info-row">
										<div class="profile-info-name" style='width:175px'> Kode</div>
											<div class="profile-info-value ">
												<span class="editable"><?php echo $set_id;?></span>
											</div>												
									</div>
									<div class="profile-info-row">
										<div class="profile-info-name" style='width:175px'> Nama Kategori</div>
											<div class="profile-info-value ">
												<span class="editable"><?php echo $set_value;?></span>
											</div>				
								
									</div>		
									<div class="profile-info-row">
										<div class="profile-info-name"> Keterangan</div>
											<div class="profile-info-value ">
												<span class="editable"><?php echo $set_desc;?></span>
											</div>	
									</div>
												
									<div class="profile-info-row">
										<div class="profile-info-name"> Status</div>
											<div class="profile-info-value ">
												<span class="editable"><?php echo $this->config->item('user_'.$set_status);?></span>
											</div>	
									</div>
					
											
								</div>

								
						</div>
					</div>
				</div>				
				
				
				

				<div class="widget-box transparent">
					<div class="widget-header widget-header-small">
					<h4 class="widget-title smaller">
						<i class="ace-icon fa fa-file bigger-110"></i>
							Data Posting
					</h4>
					</div>
					<div class="widget-body">
						<div class="widget-main">		
							<table class="table display responsive " cellspacing="0" width="100%">
								<thead>
									<tr>
										<th>Desa</th>
										<th>Judul</th>
										<th>Tampil Hingga</th>
										<th>Kunjungan</th>
										<th>Status</th>	
										<th>Ditambahkan Oleh</th>	
									</tr>
									<?php 
									if(count($sql) > 0){
										foreach($sql as $row){ ?>
										<tr>
											<td><?php echo $row->village_code; ?></td>
											<td><?php echo $row->info_title; ?></td>
											<td><?php echo !empty($row->info_dateto) ? date('d M Y',strtotime($row->info_dateto)) : '-'; ?></td>
											<td><?php echo $row->info_visited; ?></td>
											<td><?php echo $this->config->item('user_'.$row->info_status);?></td>	
											<td><?php echo $row->info_addby; empty($row->info_addtime) ? '' : ', '.date('d M Y H:i:s',strtotime($row->info_addtime));?></td>	
										</tr>
										<?php } 
									}else{
										echo '<tr><td colspan="6"><center>No Data</center></td></tr>';
									}?>
								</thead>
							</table>		
								
						</div>
					</div>
				</div>				
				
				
				