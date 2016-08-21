<div class='page-content'>
<form class="form-horizontal" id='form' method='post' action="<?php echo base_url($this->router->fetch_class().'/'.$val); ?>" role="form">										
	
		<div class="row">
			<div class="col-xs-12">
				<div class='alert alert-danger' style='display:none'><?php echo validation_errors(); ?></div>
				<div class="widget-box transparent">
					<div class="widget-header widget-header-small">
					<div class='pull-right'>	
						<a data-rel='tooltip' href='javascript:history.back()' class='btn btn-success btn-white btn-round btn-sm fa fa-arrow-left'  title='Kembali' data-placement='bottom'></a>
						<?php echo ($this->_priv->GROC || $this->_priv->GROU) ? "<button data-rel='tooltip' type='submit' name='submit' value='".$val."'  class='btn btn-danger btn-white btn-round btn-sm fa ace-icon fa fa-share-square-o'  title='Konfirmasi' data-placement='bottom'></button>" : ''; ?>
					</div>
					</div>
						<div class="widget-body">
							<div class="widget-main">		
								<input type='hidden' name='key' value='<?php echo $group_id; ?>'>												
								<div class="space-2"></div>
								<div class="form-group">
									<label class="col-sm-2 control-label" for="form-field-1"> Kode Grup</label>
									<div class="col-sm-9">						
										<input type='text' class='col-xs-5 col-sm-2' id='group_id'  name='group_id' value='<?php echo $group_id; ?>' placeholder='Kode Grup'  required onkeypress='this.value=ignoreSpaces(this.value); return AlfaNum(event);' onkeyup='javascript:this.value = this.value.toUpperCase();'>
									</div>
								</div>
								<div class="space-2"></div>
								<div class="form-group">
									<label class="col-sm-2 control-label" for="form-field-1"> Nama Grup</label>
									<div class="col-sm-9">						
										<input type='text' class='col-xs-5 col-sm-2' id='group_name'  name='group_name' value='<?php echo $group_name; ?>' placeholder='Nama Grup'  required onkeypress='return AlfaOnly(event);'>
									</div>
								</div>
								<div class="space-2"></div>
								<div class="form-group">
									<label class="col-sm-2 control-label" for="form-field-1"> Deskripsi </label>
									<div class="col-sm-9">						
										<textarea name='group_desc' id='group_desc' class='col-xs-5 col-sm-6' placeholder='Deskripsi'><?php echo $group_desc; ?></textarea>
									</div>
								</div>
								<div class="space-2"></div>
								<div class="form-group">
									<label class="col-sm-2 control-label" for="form-field-1"> Status</label>
									<div class="col-sm-9">						
										<select name='group_status'>
											<?php 
											foreach($dlist['STA'] as $val){												
												$sel 	= (ucwords($group_status)	 == $val->set_value) ? 'selected="selected"' : '';
												echo '<option value="'.$val->set_value.'" '.$sel.'>'.ucwords(strtolower($val->set_value)).'</option>';
											}
											?>
										</select>
									</div>
								</div>								
						</div>
					</div>
				</div>				

				<div class="widget-box transparent">
					<div class="widget-header widget-header-small">
						<h4 class="widget-title smaller">
							<i class="fa fa-unlock orange "></i> Hak Akses
						</h4>
					</div>
					<div class="widget-body">
						<div class="widget-main" id='content-detail'>	
							<?php					
							foreach($this->_master_priv as $row => $vals){
								echo '<br></br><b>'.$row.'</b><br>';
								foreach($vals as $rows){
									$checked = in_array($rows->priv_code,$privlist) ? 'checked' : '';
									echo '<label style="width:200px; font-size:12px;"><input type="checkbox" name="priv['.$rows->priv_code.']" '.$checked.' > '.$rows->priv_desc.'</label>';
								}
							}
							?>						
						</div>
					</div>
				</div>
			</div><!-- /.col -->
		</div><!-- /.row -->		
	</form>
</div>
<?php echo $modal;?>

<script>
$(document).ready(function() {
	$('#selecAll').click(function(event) {
		if(this.checked) {
			$(':checkbox').each(function() {
			this.checked = true;
			});
		}else{
			$(':checkbox').each(function() {
			this.checked = false;
			});
		}
	});
			
})
</script>