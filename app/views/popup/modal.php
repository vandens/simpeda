<?php echo '<script src="'.base_url('media/js/bootstrap.js').'"></script>'; ?>
<div id="modal-form" class="modal" tabindex="-1" style="" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				
				<div height='75px'>
					<img src="<?php echo base_url('media/img/'.$this->_setting->app_logo); ?>" width='65px' class='pull-left thumbnails'>
					<center>
						<h2 class="blue bigger">
						<i><?php echo $this->_setting->app_acronim;?></i>
						</h2>		
						<?php
						echo '<b class="">'.$this->_setting->app_name.'</b><br> ';
						echo $this->_setting->app_address.', '.$this->_setting->app_email; 
						?>
						
					</center>
				</div>


			</div>
			<div id='modal'>
			</div>	
		
	</div>
</div>
</div>