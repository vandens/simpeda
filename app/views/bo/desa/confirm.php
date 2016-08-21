<form class="form-horizontal" id='form' method='post' action="<?php echo base_url($this->router->fetch_class().'/'.$val); ?>" role="form">										
				<div class="widget-box transparent">
					<div class="widget-header widget-header-small">
					<h4 class="widget-title smaller">
						<i class="ace-icon fa fa-check-square-o bigger-110"></i>
							<?php echo $sub; ?>
					</h4>
					<div class='pull-right'>	
						<a data-rel='tooltip' href='javascript:history.back()' class='btn btn-success btn-white btn-round btn-sm fa fa-arrow-left'  title='Kembali' data-placement='bottom'></a>
						<?php if(isset($val)) echo ($this->_priv->DESC || $this->_priv->DESU) ? "<button data-rel='tooltip' type='submit' name='submit' value='".$val."'  class='btn btn-danger btn-white btn-round btn-sm fa ace-icon fa fa-share-square-o'  title='Konfirmasi' data-placement='bottom'></button>" : ''; ?>
					</div>
					</div>
						<div class="widget-body">
							<div class="widget-main">		
							

							<div class="col-xs-12 col-sm-12">
							<h4 class="header smaller lighter green">Profil Desa</h4>
								<div class="profile-user-info profile-user-info-striped">
									<?php 
									foreach($confirm['profil'] as $key => $val ){ ?>
									<div class="profile-info-row">										
										<div class="profile-info-name" style='width:100px'> <?php echo ucwords(str_replace('_',' ',substr($key,7))); ?></div>
										<div class="profile-info-value ">
											<span class="editable"><?php echo $val; ?></span>
										</div>												
									</div>					
									<?php } ?>		
								</div>
							</div>



							<!-- wilayah -->
							<div class="col-xs-12 col-sm-6">
							<h4 class="header smaller lighter red">Luas,Batas Wilayah dan Geografis</h4>
								<div class="profile-user-info profile-user-info-striped">

								<?php 
									$mix = array('luas','batas','geografis');
									foreach ($mix as $m => $x) {
								?>
									<div class="profile-info-row">										
										<b  style='margin-left:10px;' class=""><?php echo ucwords($x); ?></b>											
									</div>	

									<?php foreach ($confirm[$x] as $key => $val) {	?>
											<div class="profile-info-row">										
												<div class="profile-info-name" style='width:200px'> <?php echo ucwords(str_replace('_',' ',substr($key,bcadd(strlen($x),1)))); ?></div>
												<div class="profile-info-value ">
													<span class="editable"><?php echo $val; ?></span>
												</div>												
											</div>	
									<?php } ?>

									<div class="profile-info-row">							
										<div class="profile-info-name" style='width:200px'></div>
										<div class="profile-info-value ">
										<span class="editable"></span>
										</div>												
									</div>	

								<?php } ?>
								</div>								
							</div>


							<!-- bangunan -->
							<div class="col-xs-12 col-sm-6">
							<h4 class="header smaller lighter purple">Bangunan</h4>
								<div class="profile-user-info profile-user-info-striped">

								<?php 
									$mix = array('keagamaan','pendidikan');
									foreach ($mix as $m => $x) {
								?>
									<div class="profile-info-row">										
										<b  style='margin-left:10px;' class=""><?php echo ucwords($x); ?></b>											
									</div>	

									<?php foreach ($confirm[$x] as $key => $val) {	?>
											<div class="profile-info-row">										
												<div class="profile-info-name" style='width:200px'> <?php echo ucwords(str_replace('_',' ',substr($key,bcadd(strlen($x),1)))); ?></div>
												<div class="profile-info-value ">
													<span class="editable"><?php echo $val; ?></span>
												</div>												
											</div>	
									<?php } ?>

									<div class="profile-info-row">							
										<div class="profile-info-name" style='width:200px'></div>
										<div class="profile-info-value ">
										<span class="editable"></span>
										</div>												
									</div>	

								<?php } ?>
							</div>								
						</div>


						<!-- pertanahan -->
							<div class="col-xs-12 col-sm-12">
							<h4 class="header smaller lighter purple">Pertanahan</h4>
								<div class='row'>
									<?php 
										$mix = array('status','peruntukkan','penggunaan');
										foreach ($mix as $m => $x) {
									?>
									<div class="col-xs-12 col-sm-6">
										<div class="profile-user-info profile-user-info-striped">
											<div class="profile-info-row">										
												<b  style='margin-left:10px;' class=""><?php echo ucwords($x); ?></b>											
											</div>	

											<?php foreach ($confirm[$x] as $key => $val) {	?>
													<div class="profile-info-row">										
														<div class="profile-info-name" style='width:200px'> <?php echo ucwords(str_replace('_',' ',substr($key,bcadd(strlen($x),1)))); ?></div>
														<div class="profile-info-value ">
															<span class="editable"><?php echo $val; ?></span>
														</div>												
													</div>	
											<?php } ?>

											<div class="profile-info-row">							
												<div class="profile-info-name" style='width:200px'></div>
												<div class="profile-info-value ">
												<span class="editable"></span>
												</div>												
											</div>	

										</div>
									</div>		
									<?php } ?>	
								</div>					
							</div>



					</div>
				</div>					
	</form>