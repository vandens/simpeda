<?php $priv = $this->session->all_userdata(); ?>
<div id="sidebar" class="sidebar responsive sidebar-fixed">
				<script type="text/javascript">
					try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
				</script>

				<div class="sidebar-shortcuts" id="sidebar-shortcuts">
					<div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
						<a href="<?php echo base_url('berita/form'); ?>" class="btn btn-success" title='Tambah Berita Baru'>
							<i class="ace-icon fa fa-info-circle"></i>
						</a>

						<a href="<?php echo base_url('surat/form'); ?>" class="btn btn-info" title='Tambah Surat Baru'>
							<i class="ace-icon fa fa-pencil"></i>
						</a>

						<!-- #section:basics/sidebar.layout.shortcuts -->
						<a href="<?php echo base_url('keluarga/form'); ?>" class="btn btn-warning" title='Tambah Kepala Keluarga'>
							<i class="ace-icon fa fa-users" ></i>
						</a>

						<a href="<?php echo base_url('aktifitas'); ?>" class="btn btn-danger" title='Catatan Aktifitas'>
							<i class="ace-icon fa fa-exchange"></i>
						</a>

						<!-- /section:basics/sidebar.layout.shortcuts -->
					</div>

					<div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
						<span class="btn btn-success"></span>

						<span class="btn btn-info"></span>

						<span class="btn btn-warning"></span>

						<span class="btn btn-danger"></span>
					</div>
				</div><!-- /.sidebar-shortcuts -->

				<ul class="nav nav-list">

					<li id='dashboard' class="hover open active">
						<a class="" href="<?php echo base_url('admin'); ?>">
							<i class="menu-icon fa fa-tachometer"></i>
							<span class="menu-text"> Dashboard </span>
						</a>

						<b class="arrow"></b>
					</li>

					<?php if($priv['GENR']){ ?>
					<li id='general' class="hover">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-cogs"></i>
							<span class="menu-text">
								General
							</span>

							<b class="arrow fa fa-angle-down"></b>
						</a>
						<b class="arrow"></b>

						<ul class="submenu">
							<?php if($priv['GENR']){ ?>
							<li class="hover">
								<a href="<?php echo base_url('setting'); ?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Setting
								</a>
								<b class="arrow"></b>
							</li>
							<?php } ?>
						</ul>
					</li>

					<?php } if($priv['FAMR'] || $priv['DESR'] || $priv['PEN']){ ?>
					<li id='master' class="hover">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-hdd-o"></i>
							<span class="menu-text"> Master Data </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<?php if($priv['DESR']){ ?>
							<li class="hover">
								<a href="<?php echo base_url('desa'); ?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Data Desa
								</a>

								<b class="arrow"></b>
							</li>
							<?php } if($priv['FAMR']){ ?>
							<li class="hover">
								<a href="<?php echo base_url('keluarga'); ?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Data Keluarga
								</a>

								<b class="arrow"></b>
							</li>
							<?php } if($priv['PENR']){ ?>
							<li class="hover">
								<a href="<?php echo base_url('penduduk'); ?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Data Penduduk
								</a>

								<b class="arrow"></b>
							</li>
							<?php } ?>
						</ul>
					</li>
					<?php } if($priv['ALBR'] || $priv['INFR'] || $priv['CATR']){ ?>

					<li id='cms' class="hover">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-list-alt"></i>
							<span class="menu-text"> CMS </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<?php if($priv['ALBR']) { ?>
							<li class="hover">
								<a href="<?php echo base_url('album'); ?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Album
								</a>

								<b class="arrow"></b>
							</li>
						<?php } if($priv['CATR']) { ?>
							<li class="hover">
								<a href="<?php echo base_url('kategori'); ?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Kategori
								</a>

								<b class="arrow"></b>
							</li>
							
						<?php } if($priv['INFR']) { ?>
							<li class="hover">
								<a href="<?php echo base_url('berita'); ?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Berita
								</a>

								<b class="arrow"></b>
							</li>
						<?php } ?>

							
						</ul>
					</li>
					<?php } if($priv['SURR'] || $priv['TEMR']){ ?>
					<li id='surat' class="hover">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-list-alt"></i>
							<span class="menu-text"> Surat </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">

							<?php if($priv['TEMR']){ ?>							
							<li class="hover">
								<a href="<?php echo base_url('template'); ?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Template
								</a>

								<b class="arrow"></b>
							</li>

							<?php } if($priv['SURR']){ ?>
							<li class="hover">
								<a href="<?php echo base_url('surat/log'); ?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Log Surat
								</a>

								<b class="arrow"></b>
							</li>							
							<?php } ?>
						</ul>


					</li>

					<?php } if($priv['USER'] || $priv['GROR'] || $priv['MODR'] || $priv['PRIR']){ ?>
					<li id='akses' class="hover">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-unlock"></i>
							<span class="menu-text"> Akses </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>
						<b class="arrow"></b>

						<ul class="submenu">

							<?php if($priv['USER']){ ?>

							<li class="hover">
								<a href="<?php echo base_url('user'); ?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Data Pengguna
								</a>

								<b class="arrow"></b>
							</li>

							<?php } if($priv['GROR']){ ?>
							<li class="hover">
								<a href="<?php echo base_url('grup'); ?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Grup Akses
								</a>

								<b class="arrow"></b>
							</li>

							<?php }if($priv['MODR']){ ?>
							
							<li class="hover">
								<a href="<?php echo base_url('modul'); ?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Modul Akses
								</a>

								<b class="arrow"></b>
							</li>
							
							<?php }if($priv['PRIR']){ ?>	
							<!--
							<li class="hover">
								<a href="<?php echo base_url('akses'); ?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Hak Akses
								</a>

								<b class="arrow"></b>
							</li>
							-->
							<?php } ?>

						</ul>
					</li>
					<?php } if($priv['USER'] || $priv['DESR'] || $priv['PENR'] || $priv['SURR']){ ?>
					<li id='laporan' class="hover">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-file"></i>
							<span class="menu-text"> Laporan </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>
						<b class="arrow"></b>

						<ul class="submenu">
							<?php if($priv['DESR']){ ?>
							<li class="hover">
								<a href="<?php echo base_url('laporan/desa'); ?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Data Desa
								</a>

								<b class="arrow"></b>
							</li>

							<?php }if($priv['PENR']){ ?>
							
							<li class="hover">
								<a href="<?php echo base_url('laporan/penduduk'); ?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Data Penduduk
								</a>

								<b class="arrow"></b>
							</li>
							
							<?php }if($priv['USER']){ ?>	
							<li class="hover">
								<a href="<?php echo base_url('laporan/pengguna'); ?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Data Pengguna
								</a>

								<b class="arrow"></b>
							</li>

							<?php }if($priv['SURR']){ ?>	
							<li class="hover">
								<a href="<?php echo base_url('laporan/surat'); ?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Data Surat
								</a>

								<b class="arrow"></b>
							</li>

							<?php }if($priv['ACTR']){ ?>	
							<li class="hover">
								<a href="<?php echo base_url('aktifitas'); ?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Data Log Aktifitas
								</a>

								<b class="arrow"></b>
							</li>
							<?php } ?>

						</ul>
					</li>
					<?php } ?>

					
				</ul><!-- /.nav-list -->

				<!-- #section:basics/sidebar.layout.minimize -->
				<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
					<i class="ace-icon fa fa-angle-double-left" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
				</div>

				<!-- /section:basics/sidebar.layout.minimize -->
				<script type="text/javascript">
					window.jQuery || document.write("<script src='<?php echo base_url(); ?>media/js/jquery.js'>"+"<"+"/script>");
				</script>
				<script type="text/javascript">
					try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
					var menu = '<?php echo $menu; ?>';
					$('.hover').removeClass('active');
					$('#'+menu).addClass('active');
				</script>
			</div>