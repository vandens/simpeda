<!-- #section:basics/navbar.layout -->
		<div id="navbar" class="navbar navbar-default navbar-fixed-top">
			

			<div class="navbar-container" id="navbar-container">
				
				<!-- /section:basics/sidebar.mobile.toggle -->
				<div class="navbar-header pull-left">
					<!-- #section:basics/navbar.layout.brand -->
					<a href='<?php echo base_url(); ?>' class="navbar-brand">
						<img src='<?php echo base_url('media/img/logo.png');?>' style='width:50px; margin:0px; float:left; position:absolute;'>
						<small style='margin-left:60px'>
							<?php echo $this->_setting->app_acronim; ?>
						</small>
					</a>

					<!-- /section:basics/navbar.layout.brand -->

					<!-- #section:basics/navbar.toggle -->

					<!-- /section:basics/navbar.toggle -->
				</div>

				<!-- #section:basics/navbar.dropdown -->
				<div class="navbar-buttons navbar-header pull-right" role="navigation">
					<ul class="nav ace-nav">
						<li  class='active'>
							<a href="<?php echo base_url(); ?>">
								<i class="ace-icon fa fa-home"></i>
								Beranda
							</a>
						</li>	
						<li>
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="glyphicon glyphicon-icon glyphicon-map-marker"></i>
								Desa
	  							&nbsp;
								<i class="ace-icon fa fa-angle-down bigger-110"></i>
							</a>

							<ul class="dropdown-menu dropdown-light-blue dropdown-caret">
								<?php 
									#$desa = array('Cisoka','Sukatani','Jeungjing','Slapajang','Caringin','Cibugel','Bojongloa','Cempaka','Karangharja','Carenang');
									foreach($desa as $desa){
										echo '
											<li>
												<a href="'.base_url(strtolower('desa-'.str_replace(' ', '', $desa['village_name']))).'">
													<i class="ace-icon fa fa-home bigger-110 blue"></i>
													Desa '.$desa['village_name'].'
												</a>
											</li>
											';
									}
								?>
							</ul>
						</li>
											
						<li>
							<a href="<?php echo base_url('index/statistik'); ?>">
								<i class="ace-icon fa fa-bar-chart-o"></i>
								Statistik
							</a>
						</li>					
						<li>
							<a href="<?php echo base_url('index/kontak'); ?>">
								<i class="ace-icon fa fa-info-circle"></i>
								Kontak
							</a>
						</li>
					</ul>

						<!-- /section:basics/navbar.user_menu -->
					</ul>
				</div>

				<!-- /section:basics/navbar.dropdown -->
			</div><!-- /.navbar-container -->
		</div>