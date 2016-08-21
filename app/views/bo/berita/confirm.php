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
						<?php echo ($this->_priv->USEC || $this->_priv->USEU) ? "<button data-rel='tooltip' type='submit' name='submit' value='".$val."'  class='btn btn-primary btn-white btn-round btn-sm fa ace-icon fa fa-save'  title='simpan' data-placement='bottom'></button>" : ''; ?>
					</div>
					</div>
						<div class="widget-body">
							<div class="widget-main">		
									
							<div class="profile-user-info profile-user-info-striped">
									<div class="profile-info-row">
										<div class="profile-info-name" style='width:175px'> Kode / Nama Desa</div>
											<div class="profile-info-value ">
												<span class="editable"><?php echo current(explode('_',$village_code)).' / '.end(explode('_',$village_code));?></span>
											</div>				
								
									</div>
									<div class="profile-info-row">
										<div class="profile-info-name" style='width:175px'> No KTP / NO KK</div>
											<div class="profile-info-value ">
												<span class="editable"><?php echo !empty($key) ? $key : $resident_no; echo ' / '.$resident_card_no;?></span>
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
										<div class="profile-info-name"> Alamat</div>
											<div class="profile-info-value ">
												<span class="editable"><?php echo $resident_address;?></span>
											</div>	
									</div>						
											
								</div>
								
						</div>
					</div>
				</div>						
				
			</div><!-- /.col -->

		</div><!-- /.row -->
	</form>