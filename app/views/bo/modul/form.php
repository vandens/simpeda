<div class='page-content'>
<form class="form-horizontal" id='form' method='post' action="<?php echo base_url($this->router->fetch_class().'/'.$val); ?>" role="form">										
	<input type='hidden' name='user_id' value='<?php echo $user_id; ?>'>
		<div class="row">
			<div class="col-xs-12">
				<div class="widget-box transparent">
					<div class="widget-header widget-header-small">

					<div class='pull-right'>	
						<a data-rel='tooltip' href='javascript:history.back()' class='btn btn-success btn-white btn-round btn-sm fa fa-arrow-left'  title='Kembali' data-placement='bottom'></a>
						<?php echo ($this->_priv->USEC || $this->_priv->USEU) ? "<button data-rel='tooltip' type='submit' name='submit' value='".$val."'  class='btn btn-danger btn-white btn-round btn-sm fa ace-icon fa fa-share-square-o'  title='Konfirmasi' data-placement='bottom'></button>" : ''; ?>
					</div>
					</div>
						<div class="widget-body">
							<div class="widget-main">	
							<div class="space-2"></div>
								<div class="form-group">
									<label class="col-sm-2 control-label" for="form-field-1"> Desa</label>
									<div class="col-sm-10">											
										<select name='village_code'>
											<?php										
											foreach($this->_droplist->list_village as $v)
											{
												#$sel 	= in_array(strtoupper($v->shop_id),$user_shop) ? 'selected="selected"' : '';
												$sel 	= (strtoupper($v->village_code) == $village_code) ? 'selected="selected"' : '';
												echo '<option value="'.$v->village_code.'_'.$v->village_name.'" '.$sel.'>'.ucwords(strtolower($v->village_name)).'</option>';
											}
											?>
											<!--<option value='all'>Semua Toko</option>-->
										</select>
									</div>
								</div>														
								<div class="space-2"></div>
								<div class="form-group">
									<label class="col-sm-2 control-label" for="form-field-1"> User ID</label>
									<div class="col-sm-9">						
										<input type='text' class='col-xs-5 col-sm-2' readonly value='<?php echo ($user_id) ? $user_id : 'Auto Generate'; ?>' placeholder='Kode Supplier'  required onkeypress='this.value=ignoreSpaces(this.value); return AlfaOnly(event);' onkeyup='javascript:this.value = this.value.toUpperCase();'>
									</div>
								</div>
								<div class="space-2"></div>
								<div class="form-group">
									<label class="col-sm-2 control-label" for="form-field-1"> Nama Pengguna</label>
									<div class="col-sm-9">						
										<input type='text' class='col-xs-12 col-sm-6' name='user_fullname' value='<?php echo $user_fullname; ?>' placeholder='Nama Pengguna'  required onkeypress='return AlfaNum(event);'>
									</div>
								</div>
								
								<div class="space-2"></div>
								<div class="form-group">
									<label class="col-sm-2 control-label" for="form-field-1"> Set Group</label>
									<div class="col-sm-9">	
										<div class='row'>					
										<div class='col-sm-2 col-xs-6'>	
											<?php 
											$checkY = ($user_isgroup == 'Yes') ? 'checked' : 'checked';
											$checkN = ($user_isgroup == 'No') ? 'checked' : '';?>
											<label><input type='radio' <?php echo $checkY; ?> name='user_isgroup' class='isgrup' value='Yes'> Yes</label>
											<label><input type='radio' <?php echo $checkN; ?> name='user_isgroup' class='isgrup' value='No'> No</label>
										
										</div>
										
										<div id='group' class='col-sm-9 col-xs-6 <?php echo ($user_isgroup == 'No') ? 'hide' : '';?>'>
											<div class='col-sm-8'>	
												<select name='group_id' class='col-xs-5 col-sm-4'>
													<option value = ''>Pilih Group Akses</option>
													<?php 
													foreach($this->_droplist->list_group as $val){												
														$sel 	= ($group_id == $val->group_id) ? 'selected="selected"' : '';
														echo '<option value="'.$val->group_id.'" '.$sel.'>'.ucwords(strtolower($val->group_name)).'</option>';
													}
													?>
												</select>
											</div>
										</div>
										</div>
									</div>
								</div>
								
								<div class="space-2"></div>
								<div class="form-group">
									<label class="col-sm-2 control-label" for="form-field-1"> Set Super User</label>
									<div class="col-sm-9">						
										<?php 
											$adminN = ($user_isadmin == 'No') ? 'checked' : '';
											$adminY = ($user_isadmin == 'Yes') ? 'checked' : '';?>
											<label><input type='radio' <?php echo $adminY; ?> name='user_isadmin' value='Yes' > Yes</label>
											<label><input type='radio' <?php echo $adminN; ?> name='user_isadmin' value='No' > No</label>
										
									</div>
								</div>
								<div class="space-2"></div>
								<div class="form-group">
									<label class="col-sm-2 control-label" for="form-field-1"> Kirim Password Via ?</label>
									<div class="col-sm-9">						
										<label><input type='radio'  name='pass_ismail' checked value='0'> Tidak Kirim Apapun</label><br>
										<label><input type='radio'  name='pass_ismail' value='1'> Postal Mail</label><br>
										<label><input type='radio'  name='pass_ismail' value='2'> Email</label>
										
									</div>
								</div>
								<div class="space-2"></div>
								<div class="form-group">
									<label class="col-sm-2 control-label" for="form-field-1"> Email</label>
									<div class="col-sm-9">						
										<input type='text' class='col-xs-5 col-sm-2' name='user_email' value='<?php echo $user_email; ?>' placeholder='Email'>
									</div>
								</div>
								<div class="space-2"></div>
								<div class="form-group">
									<label class="col-sm-2 control-label" for="form-field-1"> No Telepon</label>
									<div class="col-sm-9">						
										<input type='text' class='col-xs-5 col-sm-2' name='user_phone' value='<?php echo $user_phone; ?>' placeholder='No Telepon'>
									</div>
								</div>
														
								<div class="space-2"></div>
								<div class="form-group">
									<label class="col-sm-2 control-label" for="form-field-1"> Status</label>
									<div class="col-sm-9">	
										<select name='user_status'>
											<?php 
											foreach($dlist['STA'] as $val){
												
												$sel 	= (ucwords($user_status)	 == $val->set_value) ? 'selected="selected"' : '';
												echo '<option value="'.$val->set_value.'" '.$sel.'>'.ucwords(strtolower($val->set_value)).'</option>';
											}
											?>
										</select>
									</div>
								</div>								
						</div>
					</div>
				</div>	
				
				
				<div id='privlist' class="widget-box transparent <?php echo ($user_isgroup == 'No') ? '' : 'hide';?>">
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
<script>
$(document).ready(function(){
	var x = $('.isgrup:checked').val();
	$('.isgrup').change(function(e){
		cek($('.isgrup:checked').val());
	});	
	cek(x);
});

function cek (val){
	if(val == 'Yes'){
		$('#privlist').addClass('hide');
		$('#group').removeClass('hide');
	}else{
		$('#privlist').removeClass('hide');
		$('#group').addClass('hide');
	}
}
</script>