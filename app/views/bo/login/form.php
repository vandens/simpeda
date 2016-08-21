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
						<button data-rel='tooltip' onclick="JSimpan('<?php echo base_url('login/reset'); ?>',$('#form').serialize(),'0','clear')" type='submit' name='submit' value='<?php echo $val; ?>'  class='btn btn-success btn-white btn-round btn-sm fa ace-icon fa fa-save'  title='Simpan' data-placement='bottom'></button>
					</div>
					</div>
						<div class="widget-body">
							<div class="widget-main" id='widget-main'>
							<div id='AlertModal' class="alert" style='display:none;'></div>
							<form class="form-horizontal" id='form' action="<?php echo base_url($this->router->fetch_class().'/simpan'); ?>" class='form' method='post' role="form">	
								<div class='row'>						
									<div class="form-group">
										<label class="col-sm-5"> Sandi Lama</label>
										<div class="col-sm-6">						
											<input type='password' class='col-xs-12 col-sm-10 input-sm' name='pass1'  id='pass1' placeholder='Sandi Lama' value=''  required >
										</div>
									</div>							
									<div class="form-group">
										<label class="col-sm-5"> Sandi Baru</label>
										<div class="col-sm-6">						
											<input type='password' class='col-xs-12 col-sm-10 input-sm' name='pass2'  id='pass1' placeholder='Sandi Baru' value=''  required >
										</div>
									</div>						
									<div class="form-group">
										<label class="col-sm-5"> Konfirmasi Sandi Baru</label>
										<div class="col-sm-6">						
											<input type='password' class='col-xs-12 col-sm-10 input-sm' name='pass3'  id='pass1' placeholder='Konfirmasi Sandi Baru' value=''  required >
										</div>
									</div>		
								</div>	

							</form>						
						</div>
					</div>
				</div>	
				
			</div><!-- /.col -->
		</div><!-- /.row -->		
</div>