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
										<div class="profile-info-name" style='width:175px'> Kode Template</div>
											<div class="profile-info-value ">
												<span class="editable"><?php echo $set_id;?></span>
											</div>				
								
									</div>
									<div class="profile-info-row">
										<div class="profile-info-name" style='width:175px'> Nama Surat</div>
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

											
								</div>
								
						</div>
					</div>
				</div>		


				<div class="widget-box transparent">
					<div class="widget-header widget-header-small">
					<h4 class="widget-title smaller">
						<i class="ace-icon fa fa-file-o bigger-110"></i>
							Template
					</h4>
					</div>
						<div class="widget-body">
						<div class="widget-main">
								<?php echo $temp; ?>							
						</div>
					</div>
				</div>				
				
				
				