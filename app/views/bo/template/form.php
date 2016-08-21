<form class="form-horizontal" id='form' method='post' action="<?php echo base_url($this->router->fetch_class().'/'.$val); ?>" role="form">										
	<input type='hidden' name='key' value='<?php echo $resident_no; ?>'>
		<div class="row">
			<div class="col-xs-12">
				<div class="widget-box transparent">
					<div class="widget-header widget-header-small">

					<div class='pull-right'>	
						<a data-rel='tooltip' href='javascript:history.back()' class='btn btn-success btn-white btn-round btn-sm fa fa-arrow-left'  title='Kembali' data-placement='bottom'></a>
						<?php echo ($this->_priv->PENC || $this->_priv->PENU) ? "<button data-rel='tooltip' type='submit' name='submit' value='".$val."'  class='btn btn-danger btn-white btn-round btn-sm fa ace-icon fa fa-share-square-o'  title='Konfirmasi' data-placement='bottom'></button>" : ''; ?>
					</div>
					</div>
						<div class="widget-body">
							<div class="widget-main">	
							<div class="space-2"></div>
								<div class="form-group">
									<label class="col-sm-2 control-label" for="form-field-1"> Desa</label>
									<div class="col-sm-10">											
										<select name='village_code' class='input-sm'>
											<option value = ''>Pilih Desa</option>
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
									<label class="col-sm-2 control-label" for="form-field-1"> No KTP</label>
									<div class="col-sm-9">						
										<input type='text' class='input-sm col-xs-5 col-sm-4' name = 'resident_no' <?php echo ($resident_no) ? 'disabled' : ''; ?> value='<?php echo $resident_no; ?>' placeholder='No KTP'  required onkeypress='this.value=ignoreSpaces(this.value); return NumOnly(event);' onkeyup='javascript:this.value = this.value.toUpperCase();'>
									</div>
								</div>
								<div class="space-2"></div>
								<div class="form-group">
									<label class="col-sm-2 control-label" for="form-field-1"> Nama Penduduk</label>
									<div class="col-sm-9">						
										<input type='text' class='col-xs-12 col-sm-6' name='resident_name' value='<?php echo $resident_name; ?>' placeholder='Nama Penduduk'  required onkeypress='return AlfaNum(event);'>
									</div>
								</div>
								
								<div class="space-2"></div>
								<div class="form-group">
									<label class="col-sm-2 control-label" for="form-field-1"> Tempat, Tgl Lahir</label>
									<div class="col-sm-9">	
										<div class='row'>					
										<div class='col-sm-4 col-xs-6'>	
											<input type='text' class='col-xs-12 col-sm-12' name='resident_bplace' value='<?php echo $resident_bplace; ?>' placeholder='Tempat Lahir'  required onkeypress='return AlfaNum(event);'>
										</div>
										<div class='col-sm-3 col-xs-6'>	
										<div class="input-group" style='cursor:pointer'>
											<input id="resident_bday" readonly class="form-control date-picker" name='resident_bday' value='<?php echo $resident_bday; ?>' type="text" data-date-format="yyyy-mm-dd">
												<span class="input-group-addon" date-rel='tooltip' date-placement='bottom' title='Pilih Tanggal Lahir'>
												<i class="fa fa-calendar bigger-110"></i>
												</span>
											</div>

										</div>

										</div>
									</div>
								</div>

								<div class="space-2"></div>
								<div class="form-group">
									<label class="col-sm-2 control-label" for="form-field-1"> No KK / Sebagai</label>
									<div class="col-sm-9">	
										<div class='row'>					
										<div class='col-sm-4 col-xs-6'>	
											<input type='text' class='col-xs-12 col-sm-12' name='resident_headno' value='<?php echo $resident_headno; ?>' placeholder='No Kartu Keluarga'  required onkeypress='return AlfaNum(event);'>
										</div>
										<div class='col-sm-6 col-xs-6'>	
											<select name='resident_fm_status' class='input-sm col-xs-5 col-sm-4'>
												<option value = ''>Pilih Peran dalam Keluarga</option>
												<?php 
												foreach($dlist['STK'] as $val){
													
													$sel 	= (ucwords($resident_fm_status)	 == $val->set_value) ? 'selected="selected"' : '';
													echo '<option value="'.$val->set_value.'" '.$sel.'>'.ucwords(strtolower($val->set_value)).'</option>';
												}
												?>
											</select>	
										</div>

										</div>
									</div>
								</div>

								<div class="space-2"></div>
								<div class="form-group">
									<label class="col-sm-2 control-label" for="form-field-1"> Jenis Kelamin</label>
									<div class="col-sm-9">						
									<?php 
											$checkY = ($resident_sex == 'L') ? 'checked' : 'checked';
											$checkN = ($resident_sex == 'P') ? 'checked' : '';?>
											<label><input type='radio' <?php echo $checkY; ?> name='resident_sex' class='isgrup' value='L'> Laki-laki</label>
											<label><input type='radio' <?php echo $checkN; ?> name='resident_sex' class='isgrup' value='P'> Perempuan</label>
										
									</div>
								</div>
								<div class="space-2"></div>
								<div class="form-group">
									<label class="col-sm-2 control-label" for="form-field-1"> Golongan Darah</label>
									<div class="col-sm-5">						
										<select name='resident_bloodtype' class='input-sm col-xs-5 col-sm-4'>
											<option value = ''>Pilih Gol Darah</option>
												<?php 
												foreach($dlist['GOL'] as $val){
													
													$sel 	= (ucwords($resident_bloodtype)	 == $val->set_value) ? 'selected="selected"' : '';
													echo '<option value="'.$val->set_value.'" '.$sel.'>'.ucwords(strtolower($val->set_value)).'</option>';
												}
												?>
										</select>
									</div>
								</div>
								<div class="space-2"></div>
								<div class="form-group">
									<label class="col-sm-2 control-label" for="form-field-1"> Agama</label>
									<div class="col-sm-5">						
										<select name='resident_religion' class='input-sm col-xs-5 col-sm-4'>
											<option value = ''>Pilih Agama</option>
												<?php 
												foreach($dlist['REL'] as $val){
													
													$sel 	= (ucwords($resident_religion)	 == $val->set_value) ? 'selected="selected"' : '';
													echo '<option value="'.$val->set_value.'" '.$sel.'>'.ucwords(strtolower($val->set_value)).'</option>';
												}
												?>
										</select>
									</div>
								</div>

								<div class="space-2"></div>
								<div class="form-group">
									<label class="col-sm-2 control-label" for="form-field-1"> Kewarganegaraan</label>
									<div class="col-sm-5">						
										<input type='text' class='col-xs-12 col-sm-7' name='resident_of' value='<?php echo $resident_of; ?>' placeholder='Kewarganegaraan'  required onkeypress='return AlfaNum(event);'>
									</div>
								</div>

								<div class="space-2"></div>
								<div class="form-group">
									<label class="col-sm-2 control-label" for="form-field-1"> Status Pernikahan</label>
									<div class="col-sm-5">						
										<select name='resident_marriage' class='input-sm col-xs-5 col-sm-4'>
											<option value = ''>Pilih Status Pernikahan</option>
												<?php 
												foreach($dlist['PER'] as $val){
													
													$sel 	= (ucwords($resident_marriage)	 == $val->set_value) ? 'selected="selected"' : '';
													echo '<option value="'.$val->set_value.'" '.$sel.'>'.ucwords(strtolower($val->set_value)).'</option>';
												}
												?>
										</select>
									</div>
								</div>
								<div class="space-2"></div>
								<div class="form-group">
									<label class="col-sm-2 control-label" for="form-field-1"> Pendidikan Terakhir</label>
									<div class="col-sm-5">						
										<select name='resident_education' class='input-sm col-xs-5 col-sm-4'>
											<option value = ''>Pilih Pendidikan Terakhir</option>
											<?php 
												foreach($dlist['EDU'] as $val){
													
													$sel 	= (ucwords($resident_education)	 == $val->set_value) ? 'selected="selected"' : '';
													echo '<option value="'.$val->set_value.'" '.$sel.'>'.ucwords(strtolower($val->set_value)).'</option>';
												}
												?>
										</select>
									</div>
								</div>
								<div class="space-2"></div>
								<div class="form-group">
									<label class="col-sm-2 control-label" for="form-field-1"> Pekerjaan</label>
									<div class="col-sm-5">						
										<input type='text' class='col-xs-12 col-sm-7' name='resident_job' value='<?php echo $resident_job; ?>' placeholder='Pekerjaan'  required onkeypress='return AlfaNum(event);'>
									</div>
								</div>
								<div class="space-2"></div>
								<div class="form-group">
									<label class="col-sm-2 control-label" for="form-field-1"> Alamat</label>
									<div class="col-sm-5">						
										<textarea name='resident_address' class='form-control col-sm-6 col-xs-6'><?php echo $resident_address; ?></textarea>
									</div>
								</div>
						
						</div>
					</div>
				</div>	
				
			</div><!-- /.col -->
		</div><!-- /.row -->		
	</form>