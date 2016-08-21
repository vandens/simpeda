<form class="form-horizontal" id='form' action="<?php echo base_url($this->router->fetch_class().'/simpan'); ?>" class='form' method='post' role="form">	
<div style='padding:20px'>
		<div class="row">
			<div class="col-xs-12">
				<div class="widget-box transparent">
					<div class="widget-header widget-header-small">
						<h4 class="widget-title smaller">
							<i class="ace-icon fa fa-pic orange"></i>
								<?php echo $sub;?>
						</h4>
					<div class='pull-right'>	
						<a data-rel='tooltip' href='javascript:history.back()' class='btn btn-success btn-white btn-round btn-sm fa fa-arrow-left'  title='Kembali' data-placement='bottom'></a>
						<?php if($this->_priv->ALBC || $this->_priv->ALBU){ ?>
							 <button data-rel='tooltip' onclick="simpan()" type='submit' name='submit' value='<?php echo $val; ?>'  class='btn btn-danger btn-white btn-round btn-sm fa ace-icon fa fa-share-square-o'  title='Konfirmasi' data-placement='bottom'></button>
						<?php } ?>
					</div>
					</div>
						<div class="widget-body">
							<div class="widget-main" id='widget-main'>	
																	
									<input type='hidden' name='key' value='<?php echo $key; ?>'>
										<div class='row'>						
												<div class="form-group">
													<label class="col-sm-3"> Nama Kategori</label>
													<div class="col-sm-6">						
														<input type='text' class='col-xs-12 col-sm-10' name='set_value' placeholder='Nama Kategori' value='<?php echo $set_value;?>'  required onkeypress='return AlfaNum(event);'>
													</div>
												</div>						
												<div class="form-group">
													<label class="col-sm-3"> Keterangan</label>
													<div class="col-sm-6">						
														<textarea class='col-xs-12 col-sm-10' name='set_desc' placeholder='Keterangan' required ><?php echo $set_desc; ?></textarea>
													</div>
												</div>		
											</div>	
						
						</div>
					</div>
				</div>	
				
			</div><!-- /.col -->
		</div><!-- /.row -->		
</div>
</form>