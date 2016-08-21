<div height='75px'>
	<img src='<?php echo base_url('media/'.$this->session->userdata('shop_logo'));?>' width='65px' class='pull-left thumbnails'>
	<center>
		<h3 class="blue bigger">
		<i><?php echo $this->session->userdata('app_name');?></i>
		</h3>
		<?php echo $this->session->userdata('shop_address').', '.
				   $this->session->userdata('shop_phone').', '.
				   $this->session->userdata('shop_email'); ?>
	</center>
</div>
<hr>