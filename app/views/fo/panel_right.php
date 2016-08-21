									<div class="col-sm-4">
											<h3 class="header smaller lighter purple">Berita Terkini</h3>
										<div class='row'>
											<div class="col-sm-12">
													<?php foreach($link_berita as $row){ ?>

													<a href='<?php echo base_url('kabar-berita/'.str_replace(' ', '-', $row->info_title)); ?>'><?php echo $row->info_title; ?></a></br>

													<?php } ?>
											</div><!-- /.col -->
											<div class="col-sm-12">
												<h3 class="header smaller lighter green">Kategori</h3>
												<p>
													<?php 
													$form = array('btn-minier btn-yellow','btn-xs btn-pink','btn-sm btn-primary','btn-xs btn-danger','btn-minier btn-purple','btn-xs','btn-sm btn-primary');
													$i = 0;
													foreach ($category as $cat => $gory) {
														foreach ($gory as $kategori) {
															echo "<a href='#' class='btn ".$form[$i++]."'>".$kategori->set_value."</a> ";
														}
													}
													?>
												</p>

											</div><!-- /.col -->
											<div class="col-sm-12">
												<h3 class="header smaller lighter blue">Hit Counter</h3>
												<ol>
													<li>Hit hari ini : <?php echo $visitor->today_hits; ?></li>
													<li class="text-primary">Total hits : <?php echo $visitor->total_hits; ?></li>
													<li class="text-danger">Pengunjung hari ini : <?php echo $visitor->today_visitor; ?></li>
													<li class="text-success">Total pengunjung : <?php echo $visitor->total_visitor; ?></li>
													<li class="text-warning">Pengguna Online : <?php echo $visitor->user_online; ?></li>
													<li class="text-muted">Alamat ip Anda : <?php echo $this->input->ip_address(); ?></li>
													<li class="text-muted">Browser Anda : <?php echo $this->agent->browser().' '.$this->agent->version(); ?></li>
												</ol>

											</div><!-- /.col -->
										</div>
									</div>