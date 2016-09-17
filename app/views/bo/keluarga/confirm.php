<div class='page-content'>
<form class="form-horizontal" id='form' method='post' action="<?php echo base_url($this->router->fetch_class().'/simpan'); ?>" role="form">										
		<div class="row">
			<div class="col-xs-12">
			<div class='alert alert-danger' style='display:none'><?php echo validation_errors(); ?></div>
				<div class="widget-box transparent">
					<div class="widget-header widget-header-small">
					<h4 class="widget-title smaller">
						<i class="ace-icon fa fa-users bigger-110"></i>
							<?php echo $sub; ?>
					</h4>
					<div class='pull-right'>	
						<a data-rel='tooltip' href='javascript:history.back()' class='btn btn-success btn-white btn-round btn-sm fa fa-arrow-left'  title='Kembali' data-placement='bottom'></a>
						<?php echo ($this->_priv->FAMC || $this->_priv->FAMU) ? "<button data-rel='tooltip' type='submit' name='submit' value='".$val."'  class='btn btn-primary btn-white btn-round btn-sm fa ace-icon fa fa-save'  title='simpan' data-placement='bottom'></button>" : ''; ?>
					</div>
					</div>
						<div class="widget-body">
							<div class="widget-main">		
									
							<div class="profile-user-info profile-user-info-striped">
									<div class="profile-info-row">
										<div class="profile-info-name" style='width:175px'> No Kartu Keluarga</div>
											<div class="profile-info-value ">
												<span class="editable"><?php echo $resident_card_no;?></span>
											</div>				
								
									</div>
									<div class="profile-info-row">
										<div class="profile-info-name" style='width:175px'> Desa</div>
											<div class="profile-info-value ">
												<span class="editable"><?php echo end(explode('_', $village_id));?></span>
											</div>				
								
									</div>	
									<div class="profile-info-row">
										<div class="profile-info-name" style='width:175px'> Dusun / Kampung (RT/RW)</div>
											<div class="profile-info-value ">
												<span class="editable"><?php echo $resident_card_village.' ('.$resident_card_village_no.')';?></span>
											</div>				
								
									</div>						
											
								</div>
								
						</div>
					</div>
				</div>						
				
			</div><!-- /.col -->

			<?php if($edit != 'edit'){ ?>
			<div class="col-xs-12">
				<div class="widget-box transparent">
					<div class="widget-header widget-header-small">
					<h4 class="widget-title smaller">
						<i class="ace-icon fa fa-user bigger-110"></i>
							Data Penduduk
					</h4>
					</div>
						<div class="widget-body">
							<div class="widget-main">		
									
							<div class="profile-user-info profile-user-info-striped">
									<div class="profile-info-row">
										<div class="profile-info-name" style='width:175px'> No KTP</div>
											<div class="profile-info-value ">
												<span class="editable"><?php echo $resident_no;?></span>
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
												<span class="editable"><?php echo ($resident_sex == 'L') ? 'Laki-laki' : 'Perempuan'; echo ' / '.$resident_bloodtype;?></span>
											</div>	
									</div>		
									<div class="profile-info-row">
										<div class="profile-info-name"> Agama</div>
											<div class="profile-info-value ">
												<span class="editable"><?php echo $resident_religion;?></span>
											</div>	
									</div>		
									<div class="profile-info-row">
										<div class="profile-info-name"> Nama Orang Tua</div>
											<div class="profile-info-value ">
												<span class="editable"><?php echo $resident_f_name.' (Ayah) / '.$resident_m_name.' (Ibu)';?></span>
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
												<span class="editable"><?php echo $resident_address;?></span>
											</div>	
									</div>										
									<div class="profile-info-row">
										<div class="profile-info-name"> Status Penduduk</div>
											<div class="profile-info-value ">
												<span class="editable"><?php echo $resident_status;?></span>
											</div>	
									</div>						
											
								</div>
								
						</div>
					</div>
				</div>						
				
			</div><!-- /.col -->


		</div><!-- /.row -->
		<?php } ?>
	</form>
</div>