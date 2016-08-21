
							<div class="col-xs-12 col-sm-<?php echo $sm; ?>" id='data1' class='data'>
								<h4 class="header smaller lighter green" id='set1'><?php echo ($title) ? $title : 'Data Penduduk'; ?></h4>
								<div class="profile-user-info profile-user-info-striped">
									<div class="profile-info-row">										
										<div class="profile-info-name"> No KTP</div>
										<div class="profile-info-value ">
											<span id='res_no1'></span>
											<div class='pull-right'>	
												<a class='btn btn-sm btn-success btn-white btn-round fa fa-plus' data-rel='tooltip' data-placement='right' title='Cari Data Penduduk' data-toggle='modal' href='#modal-form' onclick="JTD('<?php echo base_url($this->router->fetch_class().'/popup/resident/1');?>','','modal')"></a>
											</div>
										</div>												
									</div>	
									<div class="profile-info-row">										
										<div class="profile-info-name"> Nama</div>
										<div class="profile-info-value ">
											<span id="resident_name1"></span>
										</div>												
									</div>	
									<div class="profile-info-row">										
										<div class="profile-info-name"> Jenis Kelamin</div>
										<div class="profile-info-value ">
											<span id="resident_sex1"></span>
										</div>												
									</div>	
									<div class="profile-info-row">										
										<div class="profile-info-name"> Tempat, Tgl Lahir</div>
										<div class="profile-info-value ">
											<span id="resident_bday1"></span>
										</div>												
									</div>	
									<div class="profile-info-row">										
										<div class="profile-info-name"> Pekerjaan</div>
										<div class="profile-info-value ">
											<span id="resident_job1"></span>
										</div>												
									</div>	
									<div class="profile-info-row">										
										<div class="profile-info-name"> Alamat</div>
										<div class="profile-info-value ">
											<span id="resident_address1"></span>
										</div>												
									</div>	

								</div>
							</div>	


		<input type='hidden' name='resident_no1' id='resident_no1' value=''>