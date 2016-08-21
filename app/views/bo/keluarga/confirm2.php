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