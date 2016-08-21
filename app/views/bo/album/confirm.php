<form style='padding:20px;' class="form-horizontal" id='form' method='post' action="<?php echo base_url($this->router->fetch_class().'/simpan'); ?>" role="form">										
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
						<?php echo ($this->_priv->ALBC || $this->_priv->ALBU) ? "<button data-rel='tooltip' type='submit' name='submit' value='".$val."'  class='btn btn-primary btn-white btn-round btn-sm fa ace-icon fa fa-save'  title='simpan' data-placement='bottom'></button>" : ''; ?>
					</div>
					</div>
						<div class="widget-body">
							<div class="widget-main">		
									
							<div class="profile-user-info profile-user-info-striped">
									<div class="profile-info-row">
										<div class="profile-info-name" style='width:175px'> Nama Desa</div>
											<div class="profile-info-value ">
												<span class="editable"><?php echo current(explode('_',$village_code)).' / '.end(explode('_',$village_code));?></span>
											</div>				
								
									</div>
									<div class="profile-info-row">
										<div class="profile-info-name"> Nama Album</div>
											<div class="profile-info-value style='width:275px'">
												<span class="editable"><?php echo $alb_name;?></span>
											</div>				
								
									</div>		
									<div class="profile-info-row">
										<div class="profile-info-name"> Diambil pada Waktu</div>
											<div class="profile-info-value ">
												<span class="editable"><?php echo date('d M Y',strtotime($alb_taken_date));?></span>
											</div>	
									</div>
												
									<div class="profile-info-row">
										<div class="profile-info-name"> Lokasi </div>
											<div class="profile-info-value ">
												<span class="editable"><?php echo $alb_taken;?></span>
											</div>	
									</div>
		
									<div class="profile-info-row">
										<div class="profile-info-name"> Publikasikan </div>
											<div class="profile-info-value ">
												<span class="editable"><?php echo $alb_ispublish;?></span>
											</div>	
									</div>
		
											
								</div>
								
						</div>
					</div>
				</div>						
				
			</div><!-- /.col -->

		</div><!-- /.row -->
	</form>