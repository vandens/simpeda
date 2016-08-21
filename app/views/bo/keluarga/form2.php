

			<div class="col-xs-12">
				<div class="widget-box transparent">
					<div class="widget-header widget-header-small">
					<h4 class="widget-title smaller">
						<i class="ace-icon fa fa-user bigger-110"></i>
							Data Penduduk
					</h4>
					</div>
						<div class="widget-body">
							<div class="widget-main">	

								<div class="space-2"></div>
								<div class="form-group">
									<label class="col-sm-2 control-label" for="form-field-1"> No KTP </label>
									<div class="col-sm-5">	
										<input type='text' class='col-xs-5 col-sm-8' name='resident_no' value='<?php echo $resident_no; ?>' placeholder='No KTP'  required onkeypress='this.value=ignoreSpaces(this.value); return NumOnly(event);' onkeyup='javascript:this.value = this.value.toUpperCase();'>
										<label>
											<input class="ace" type="checkbox" name="is_resident_no">
											<span class="lbl" style='font-size:12px;'> Belum ada No KTP</span>
										</label>
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
											<input id="resident_bday" readonly class="form-control date-picker" name='resident_bday' value='<?php echo $resident_bday; ?>' type="text" required data-date-format="yyyy-mm-dd">
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
									<label class="col-sm-2 control-label" for="form-field-1"> Jenis Kelamin</label>
									<div class="col-sm-9">						
									<?php 
											$checkY = ($resident_sex == 'L') ? 'checked' : 'checked';
											$checkN = ($resident_sex == 'P') ? 'checked' : '';?>
											<label><input type='radio' <?php echo $checkY; ?> name='resident_sex' class='isgrup' value='L' required> Laki-laki</label>
											<label><input type='radio' <?php echo $checkN; ?> name='resident_sex' class='isgrup' value='P' required> Perempuan</label>
										
									</div>
								</div>
								<div class="space-2"></div>
								<div class="form-group">
									<label class="col-sm-2 control-label" for="form-field-1"> Golongan Darah</label>
									<div class="col-sm-3">						
										<select name='resident_bloodtype' class='form-control col-xs-5 col-sm-4'>
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
									<div class="col-sm-3">						
										<select name='resident_religion' class='form-control col-xs-5 col-sm-4' required>
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
										<input type='text' class='col-xs-12 col-sm-7' name='resident_of' value='<?php echo $resident_of; ?>' placeholder='WNI / WNA / DWI-Warganegara'  required onkeypress='return AlfaNum(event);'>
									</div>
								</div>

								<div class="space-2"></div>
								<div class="form-group">
									<label class="col-sm-2 control-label" for="form-field-1"> Status Pernikahan</label>
									<div class="col-sm-3">						
										<select name='resident_marriage' class='form-control col-xs-5 col-sm-4' required>
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
									<label class="col-sm-2 control-label" for="form-field-1"> Pendidikan</label>
									<div class="col-sm-3">						
										<select name='resident_education' class='form-control col-xs-5 col-sm-4'>
											<option value = ''>Pilih Pendidikan Terakhir</option>
											<?php 
												foreach($dlist['EDU'] as $val){
													
													$sel 	= (ucwords($resident_education)	 == $val->set_value) ? 'selected="selected"' : '';
													echo '<option value="'.$val->set_value.'" '.$sel.'>'.ucwords($val->set_value).'</option>';
												}
												?>
										</select>
									</div>
								</div>
								<div class="space-2"></div>
								<div class="form-group">
									<label class="col-sm-2 control-label" for="form-field-1"> Pekerjaan</label>
									<div class="col-sm-5">		
										<select name='resident_job' class='form-control col-xs-5 col-sm-4'>
											<option value = ''>Pilih Pekerjaan</option>
											<?php 
												foreach($dlist['JOB'] as $val){
													
													$sel 	= (ucwords($resident_job)	 == $val->set_value) ? 'selected="selected"' : '';
													echo '<option value="'.$val->set_value.'" '.$sel.'>'.ucwords($val->set_value).'</option>';
												}
												?>
										</select>
									</div>
								</div>
								<div class="space-2"></div>
								<div class="form-group">
									<label class="col-sm-2 control-label" for="form-field-1"> Status Tinggal</label>
									<div class="col-sm-5">		
										<select name='resident_stay_at' required class='form-control col-xs-5 col-sm-4'>
											<option value = ''>Pilih Status Tinggal</option>
											<?php 
												foreach($dlist['STT'] as $val){
													
													$sel 	= (ucwords($resident_stay_at)	 == $val->set_value) ? 'selected="selected"' : '';
													echo '<option value="'.$val->set_value.'" '.$sel.'>'.ucwords($val->set_value).'</option>';
												}
												?>
										</select>
									</div>
								</div>
								<div class="space-2"></div>
								<div class="form-group">
									<label class="col-sm-2 control-label" for="form-field-1"> Alamat</label>
									<div class="col-sm-5">						
										<textarea name='resident_address' class='form-control col-sm-6 col-xs-6'><?php echo $resident_address; ?></textarea>
									</div>
								</div>

								<div class="space-2"></div>
								<div class="form-group">
									<label class="col-sm-2 control-label" for="form-field-1"> Status Penduduk</label>
									<div class="col-sm-5">		
										<select name='resident_status' required class='form-control col-xs-5 col-sm-4'>
											<option value = ''>Pilih Status Penduduk</option>
											<?php 
												foreach($dlist['STP'] as $val){
													
													$sel 	= (ucwords($resident_status)	 == $val->set_value) ? 'selected="selected"' : '';
													echo '<option value="'.$val->set_value.'" '.$sel.'>'.ucwords($val->set_value).'</option>';
												}
												?>
										</select>
									</div>
								</div>


								
							<div class="space-2"></div>
								<div class="form-group">
									<label class="col-sm-2 control-label" for="form-field-1"> </label>
									<div class="col-sm-9">	
										<div class='row'>	
										<div class='col-sm-4 col-xs-6'>	
											Hubungan Keluarga
											<select name='resident_fm_role' required class='form-control col-sm-3'>
												<option value = ''>Pilih Hubungan Keluarga</option>
												<?php
													foreach($dlist['STK'] as $val){													
														$sel 	= ($resident_fm_role	 == $val->set_value) ? 'selected="selected"' : '';
														echo '<option value="'.$val->set_value.'" '.$sel.'>'.ucwords(strtolower($val->set_value)).'</option>';
													}
												
												?>
											</select>	
										</div>

														
										<div class='col-sm-4 col-xs-6'>	
											Nama Ayah
											<input type='text' class='col-xs-12 col-sm-12' name='resident_f_name' value='<?php echo $resident_f_name; ?>' placeholder='Nama Ayah'  required onkeypress='return AlfaNum(event);'>
										</div>					
										<div class='col-sm-4 col-xs-6'>	
											Nama Ibu
											<input type='text' class='col-xs-12 col-sm-12' name='resident_m_name' value='<?php echo $resident_m_name; ?>' placeholder='Nama Ibu'  required onkeypress='return AlfaNum(event);'>
										</div>

										</div>
									</div>
								</div>

								
						</div>
					</div>
				</div>	
				
			</div><!-- /.col -->