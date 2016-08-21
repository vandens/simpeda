
							<div class="widget-main">	
								<div class="col-xs-12 col-sm-12">
									<h4 class="header smaller lighter green">Template Surat</h4>												
									<div class="form-group">
										<label class="col-sm-3"> Kode Surat</label>
										<div class="col-sm-4">									
											<div class="input-group" style='cursor:pointer'>
											<input id="letter_code" readonly class="form-control" name='letter_code' value='<?php echo $letter_code; ?>' type="text" >
												<span class="input-group-addon">
													<i class="fa fa-search bigger-110" data-rel='tooltip' data-placement='right' title='Cari Data Penduduk' data-toggle='modal' href='#modal-form' onclick="JTD('<?php echo base_url($this->router->fetch_class().'/popup/template'); ?>','','modal')"></i>
												</span>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3"> Nama Surat</label>
										<div class="col-sm-6">		
											<input type='text' readonly class='form-control input-sm col-xs-12 col-sm-12' id='letter_name' name='letter_name' value='<?php echo $letter_name; ?>'>
										</div>
									</div>				
									<div class="form-group">
										<label class="col-sm-3"> Tgl Surat</label>
										<div class="col-sm-2">									
											<div class="input-group" style='cursor:pointer'>
											<input id="letter_date" readonly class="form-control date-picker" name='letter_date' value='<?php echo isset($letter_date) ? $letter_date : date('Y-m-d'); ?>' type="text" data-date-format="yyyy-mm-dd">
												<span class="input-group-addon" date-rel='tooltip' date-placement='right' title='Pilih Tanggal Surat'>
												<i class="fa fa-calendar bigger-110"></i>
												</span>
											</div>
										</div>
									</div>											
									<div class="form-group">
										<label class="col-sm-3"> Valid Hingga</label>
										<div class="col-sm-2">									
											<div class="input-group" style='cursor:pointer'>
											<input id="tgl_limit" readonly class="form-control date-picker" name='tgl_limit' value='<?php echo isset($tgl_limit) ? $tgl_limit : date('Y-m-d'); ?>' type="text" data-date-format="yyyy-mm-dd">
												<span class="input-group-addon" date-rel='tooltip' date-placement='right' title='Pilih Batas Tanggal'>
												<i class="fa fa-calendar bigger-110"></i>
												</span>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3"> Pejabat Penandatangan</label>
										<div class="col-sm-6">		
											<label><input type='radio' name='sign_by' class='' value='1'> Kepala Desa</label>
											<label><input type='radio' name='sign_by' class='' required value='2'> Sekretaris Desa</label>
										</div>
									</div>	
								</div>	
							</div>

		<input type='hidden' name='letter_id'  	 id='letter_id' value='<?php echo $letter_id; ?>'>