
<div class="row">
	<div class="col-sm-12">
		<div class="widget-box transparent">
			<div class="widget-body">
				<div class="widget-main">	

					<?php 
					$mix 	= array('green'=>'keagamaan','purple'=>'pendidikan');
					foreach ($mix as $m => $x) {
					?>
					
						<h4 class="header smaller lighter <?php echo $m; ?>"><?php echo ucwords($x); ?></h4>
						<div class="space-2"></div>
						<?php 
						foreach($temp[$x] as $keys => $val){ 
							?>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="form-field-1"> <?php echo ucwords(end(explode('_',$keys))); ?></label>
							<div class="col-sm-6">						
								<input type='text' name='<?php echo $keys; ?>' class='col-xs-12 col-sm-12' value='<?php echo  $data[$keys]; ?>'>
							</div>
						</div>
						<?php } ?>

					<?php }	?>	
						

				</div>
			</div>
		</div>	
				
	</div><!-- /.col -->
</div><!-- /.row -->		