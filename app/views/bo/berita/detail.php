<div class='page-content'>

						<div class="row">
							<div class='pull-right'>	
							<a href='javascript:history.back()' class='btn btn-success btn-white btn-round btn-sm fa fa-arrow-left' data-rel='tooltip' data-placement='bottom' title='Kembali'></a>
							</div>
							<div class="col-xs-12 col-sm-12">
											<div class="widget-box transparent">
												<div class="widget-header widget-header-small">
													<h4 class="widget-title blue smaller">
														<i class="ace-icon fa fa-th-large orange"></i>
														<?php echo $sub; ?>
													</h4>
												</div>

												<div class="widget-body ">
													<div class="widget-main padding-8">
														
												<div class="profile-user-info profile-user-info-striped">
													<div class="profile-info-row">
														<div class="profile-info-name"  style='width:150px'> Judul </div>
	
														<div class="profile-info-value">
															<span class="editable" id="buser_id"><?php echo $info_title;?></span>
														</div>
													</div>
													<div class="profile-info-row">
														<div class="profile-info-name"> Kategori </div>
	
														<div class="profile-info-value">
															<span class="editable" id="buser_id"><?php echo $set_value;?></span>
														</div>
													</div>
													<div class="profile-info-row">
														<div class="profile-info-name"> Publis </div>
	
														<div class="profile-info-value">
															<span class="editable" id="buser_id"><?php echo $info_ispublish;?></span>
														</div>
													</div>
													<div class="profile-info-row">
														<div class="profile-info-name"> Dibaca </div>
	
														<div class="profile-info-value">
															<span class="editable" id="buser_id"><?php echo $info_visited;?></span>
														</div>
													</div>
													<div class="profile-info-row">
														<div class="profile-info-name"> Ditampilkan Hingga </div>
	
														<div class="profile-info-value">
															<span class="editable" id="buser_id"><?php echo !empty($info_dateto) ? date('d M Y',strtotime($info_dateto)) : '';?></span>
														</div>
													</div>
													<div class="profile-info-row">
														<div class="profile-info-name"> Ditambah Oleh, Waktu </div>
	
														<div class="profile-info-value">
															<span class="editable" id="buser_id"><?php echo $info_addby; echo (!empty($info_addtime)) ? ', '.date('d M Y H:i:s',strtotime($info_addtime)) : '';?></span>
														</div>
													</div>
													<div class="profile-info-row">
														<div class="profile-info-name"> DiupdateOleh, Waktu </div>
	
														<div class="profile-info-value">
															<span class="editable" id="buser_id"><?php echo $info_updateby; echo (!empty($info_updatetime)) ? ', '.date('d M Y H:i:s',strtotime($info_updatetime)) : '';?></span>
														</div>
													</div>
												</div>
													

													</div>
												</div>
											</div>
									</div>
									
															
									<div class="col-xs-12 col-sm-12">
										<p style='text-align:justify'>
											<?php if(file_exists(FCPATH.'media/info/'.$info_filename) && !empty($info_filename)){?>
											<img src='<?php echo base_url('media/info/'.$info_filename); ?>' class='thumbnail'>
											<?php } echo $info_content;?>
										</p>												
										
									</div>	
										
										
													
								<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->