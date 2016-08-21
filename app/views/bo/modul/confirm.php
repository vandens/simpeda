<div class='page-content'>
<form class="form-horizontal" id='form' method='post' action="<?php echo base_url($this->router->fetch_class().'/simpan'); ?>" role="form">										
		<div class="row">
			<div class="col-xs-12">
			<div class='alert alert-danger' style='display:none'><?php echo validation_errors(); ?></div>
				<div class="widget-box transparent">
					<div class="widget-header widget-header-small">
					<h4 class="widget-title smaller">
						<i class="ace-icon fa fa-check-square-o bigger-110"></i>
							<?php echo $sub; ?>
					</h4>
					<div class='pull-right'>	
						<a data-rel='tooltip' href='javascript:history.back()' class='btn btn-success btn-white btn-round btn-sm fa fa-arrow-left'  title='Kembali' data-placement='bottom'></a>
						<?php echo ($this->_priv->USEC || $this->_priv->USEU) ? "<button data-rel='tooltip' type='submit' name='submit' value='".$val."'  class='btn btn-danger btn-white btn-round btn-sm fa ace-icon fa fa-share-square-o'  title='Konfirmasi' data-placement='bottom'></button>" : ''; ?>
					</div>
					</div>
						<div class="widget-body">
							<div class="widget-main">		
									
							<div class="col-xs-12 col-sm-12">
								<div class="profile-user-info profile-user-info-striped">
									<div class="profile-info-row">
										<div class="profile-info-name" style='width:175px'> Desa</div>
											<div class="profile-info-value ">
												<span class="editable"><?php echo end(explode('_', $village_code)); ?></span>
											</div>				
								
									</div>		
									<div class="profile-info-row">
										<div class="profile-info-name"> User ID</div>
											<div class="profile-info-value ">
												<span class="editable"><?php echo empty($user_id) ? $new_id : $user_id;?></span>
											</div>	
									</div>	
									<div class="profile-info-row">
										<div class="profile-info-name"> Set Group, (Group ID)</div>
											<div class="profile-info-value ">
												<span class="editable"><?php echo ($user_isgroup == 'No') ? $user_isgroup : $user_isgroup.' ('.$group_id.')';?></span>
											</div>	
									</div>		
									<div class="profile-info-row">
										<div class="profile-info-name"> Super User</div>
											<div class="profile-info-value ">
												<span class="editable"><?php echo ($user_isadmin) ? $user_isadmin : 'No';?></span>
											</div>	
									</div>		
									<div class="profile-info-row">
										<div class="profile-info-name"> Email</div>
											<div class="profile-info-value ">
												<span class="editable"><?php echo $user_email;?></span>
											</div>	
									</div>		
									<div class="profile-info-row">
										<div class="profile-info-name"> No Telepon</div>
											<div class="profile-info-value ">
												<span class="editable"><?php echo $user_phone;?></span>
											</div>	
									</div>			
									<div class="profile-info-row">
										<div class="profile-info-name"> Status</div>
											<div class="profile-info-value ">
												<span class="editable"><?php echo $user_status;?></span>
											</div>	
									</div>					
											
								</div>
							</div>

								
						</div>
					</div>
				</div>						
				
				<?php if($user_isgroup == 'No' && isset($privlist)){?>
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
				<?php } ?>			

				
			</div><!-- /.col -->

		</div><!-- /.row -->
	</form>
</div>