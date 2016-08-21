<div class='page-content'>
		<div class="row">

			<div class="col-xs-12">
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
									
							<div class="col-xs-12 col-sm-12">
								<div class="profile-user-info profile-user-info-striped">
									<div class="profile-info-row">
										<div class="profile-info-name" style='width:175px'> Nama Grup</div>
											<div class="profile-info-value ">
												<span class="editable"><?php echo $group_name;?></span>
											</div>				
								
									</div>		
									<div class="profile-info-row">
										<div class="profile-info-name"> Status</div>
											<div class="profile-info-value ">
												<span class="editable"><?php echo $group_status;?></span>
											</div>	
									</div>	
									<div class="profile-info-row">
										<div class="profile-info-name"> Deskripsi</div>
											<div class="profile-info-value ">
												<span class="editable"><?php echo $group_desc;?></span>
											</div>	
									</div>					
											
								</div>
							</div>

								
						</div>
					</div>
				</div>						
				
				<div class="widget-box transparent">
					<div class="widget-header widget-header-small">
						<h4 class="widget-title smaller">
							<i class="fa fa-unlock bigger-110"></i> Hak Akses
						</h4>
					</div>
					<div class="widget-body">
						<div class="widget-main" id='content-detail'>	
							<?php 
							$no = 1;
							if(count($confirm_priv) > 0){
								foreach($confirm_priv as $row => $vals){
									echo '<br><b>'.$no++.'. '.$row.'</b><br>';
									foreach($vals as $rows){
										echo '<label style="width:200px; font-size:12px;">'.$rows->priv_desc.'</label>';
									}
									echo '</br>';
								}
							}else{
								echo 'Tidak ada hak akses';
							}
							?>	
						</div>
					</div>
				</div>							
				
				
				

				
			</div><!-- /.col -->

		</div><!-- /.row -->
	</form>
</div>