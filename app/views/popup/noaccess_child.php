<html>
	<head>
		<title>
		Form Pendaftaran Pasien
		</title>
		<?php foreach($this->config->config['css'] as $css => $c)
				echo '<link rel="stylesheet" href="'.base_url().'media/css/'.$c.'">';
			  foreach($this->config->config['js'] as $js => $j)
				echo '<script type="text/JavaScript" src="'.base_url().'media/js/'.$j.'"></script>';
		?>
		<script>
			function closeIt(){
				close();
			}
		</script>
	</head>
	<body>
		<div class="page-content">
							<p></p>
							<div class="page-content-area">
								<div class="row">
									<div class="col-xs-12">
										<!-- PAGE CONTENT BEGINS -->

										<div class="error-container">
											<div class="well">
												<h1 class="grey lighter smaller">
													<span class="blue bigger-125">
														<i class="ace-icon fa fa-sitemap"></i>
														403
													</span>
													Tidak ada hak akses!
												</h1>

												<hr />
												<h3 class="lighter smaller">Anda tidak memiliki hak akses menu ini!</h3>

												<div>
													<div class="space"></div>
													<h4 class="smaller">Coba beberapa tips berikut ini :</h4>

													<ul class="list-unstyled spaced inline bigger-110 margin-15">
														<li>
															<i class="ace-icon fa fa-hand-o-right blue"></i>
															Baca User Manual
														</li>

														<li>
															<i class="ace-icon fa fa-hand-o-right blue"></i>
															Hubungi Administrator Anda
														</li>

														<li>
															<i class="ace-icon fa fa-hand-o-right blue"></i>
															Kontak Email Pengembang
														</li>
													</ul>
												</div>

												<hr />
												<div class="space"></div>

												<div class="center">
													<a href="#" onclick="window.close()" class="btn btn-success btn-round btn-white">
														<i class="ace-icon fa fa-times"></i>
														Tutup
													</a>
												</div>
											</div>
										</div>

										<!-- PAGE CONTENT ENDS -->
									</div><!-- /.col -->
								</div><!-- /.row -->
							</div><!-- /.page-content-area -->
						</div><!-- /.page-content -->
	</body>
</html>