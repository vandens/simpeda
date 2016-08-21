
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
											<span class="editable"><?php echo $modul_id;?></span>
										</div>								
									</div>
									<div class="profile-info-row">
										<div class="profile-info-name" style='width:175px'> Nama Modul</div>
										<div class="profile-info-value ">
											<span class="editable"><?php echo $modul_name;?></span>
										</div>								
									</div>

											
								</div>
							</div>

								
					</div>
				</div>				
				
				<div class="widget-box transparent">
					<div class="widget-header widget-header-small">
						<h4 class="widget-title smaller">
							<i class="fa fa-users bigger-110"></i> Pengguna Modul
						</h4>
					</div>
					<div class="widget-body">
						<div class="widget-main" id='content-detail'>								
							<table class="table display responsive " cellspacing="0" width="100%">
								<thead>
									<tr>
										<th>ID</th>
										<th>Nama Grup / User</th>
										<th>Jenis Pengguna</th>
										<th>Hak Akses</th>
									</tr>
									<?php 
									if(count($detail) > 0){
										foreach($detail as $row){ ?>
										<tr>
											<td><?php echo $row->id; ?></td>
											<td><?php echo $row->name; ?></td>
											<td><?php echo $row->type; ?></td>
											<td><?php echo $row->priv_desc; ?></td>
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
				
