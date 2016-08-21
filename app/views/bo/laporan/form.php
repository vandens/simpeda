<form class="form-horizontal" id='form' method='post' action="<?php echo base_url($this->router->fetch_class().'/'.$val); ?>" role="form">										
	<input type='hidden' name='key' value='<?php echo $profil_village_code; ?>'>
	<div class="widget-box transparent">
		<div class="widget-header widget-header-small">
			<div class='pull-right'>	
				<a data-rel='tooltip' href='javascript:history.back()' class='btn btn-success btn-white btn-round btn-sm fa fa-arrow-left'  title='Kembali' data-placement='bottom'></a>
				<?php echo ($this->_priv->DESC || $this->_priv->USEU) ? "<button data-rel='tooltip' type='submit' name='submit' value='".$val."'  class='btn btn-danger btn-white btn-round btn-sm fa ace-icon fa fa-share-square-o'  title='Konfirmasi' data-placement='bottom'></button>" : ''; ?>
			</div>
		</div>
		<div class="widget-body">
			<div class="widget-main">	

				<div class='col-sm-12'>
					<div class="tabbable tabs-top">
						<ul class="nav nav-tabs" id="myTab3">

							<li class="active">
								<a data-toggle="tab" href="#profil">
									<i class="pink ace-icon fa fa-info bigger-110"></i>
									Profil
								</a>
							</li>
							<li>
								<a data-toggle="tab" href="#wilayah">
									<i class="pink ace-icon fa fa-tachometer bigger-110"></i>
									Luas dan Batas Wilayah
								</a>
							</li>
							<li>
								<a data-toggle="tab" href="#pertanahan">
									<i class="blue ace-icon fa fa-road bigger-110"></i>
									Pertanahan
								</a>
							</li>
							<li>
								<a data-toggle="tab" href="#bangunan">
									<i class="ace-icon fa fa-university"></i>
									Pembangunan
								</a>
							</li>
						</ul>

						<div class="tab-content">
							<div id="profil" class="tab-pane in active" style='min-height:400px'>
								<?php echo $tab_profil; ?>		
							</div>
							<div id="wilayah" class="tab-pane" style='min-height:400px'>
								<?php echo $tab_wilayah; ?>
							</div>
							<div id="pertanahan" class="tab-pane" style='min-height:400px'>
								<?php echo $tab_pertanahan; ?>		
							</div>
							<div id="bangunan" class="tab-pane in" style='min-height:400px'>
								<?php echo $tab_bangunan; ?>		
							</div>
						</div>
					</div>
				</div><!-- /.col -->

			</div>
		</div>
	</div>			
</form>