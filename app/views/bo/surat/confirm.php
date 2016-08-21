<form class="form-horizontal" id='form' method='post' action="<?php echo base_url($this->router->fetch_class().'/simpan'); ?>" role="form">										
		<div class="row">
			<div class="col-xs-12">
			<div class='alert alert-danger' style='display:none'><?php echo validation_errors(); ?></div>
				<div class="widget-box transparent">
					<div class="widget-header widget-header-small">
					<h4 class="widget-title smaller">
						<i class="ace-icon fa fa-check-square-o bigger-110"></i>
							<?php echo $sub; ?>
					</h4>
					<div class='pull-right'>	
						<a data-rel='tooltip' href='javascript:history.back()' class='btn btn-success btn-white btn-round btn-sm fa fa-arrow-left'  title='Kembali' data-placement='bottom'></a>
						<?php echo ($this->_priv->USEC || $this->_priv->USEU) ? "<button data-rel='tooltip' type='submit' name='submit' value='".$val."'  class='btn btn-primary btn-white btn-round btn-sm fa ace-icon fa fa-print'  title='Simpan dan Cetak' data-placement='left'></button>" : ''; ?>
					</div>
					</div>
						<div class="widget-body">
							<div class="widget-main">		
									
							<?php echo $temp; ?>
								
						</div>
					</div>
				</div>						
				
			</div><!-- /.col -->

		</div><!-- /.row -->
	</form>