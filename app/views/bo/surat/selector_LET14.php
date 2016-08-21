<div class="col-xs-12 col-sm-6" id='data1' class='data'>
	<h4 class="header smaller lighter green" id='set1'>Data Calon Suami</h4>
	<div class="space-2"></div>
	<div class="form-group">
		<label class="col-sm-4 control-label" for="form-field-1"> No KTP</label>
		<div class="col-sm-5">						
			<input type='text' class='col-xs-12 col-sm-12' name='resident_no1' id='resident_no1' value='' placeholder = 'No KTP' required >
		</div>
		<div class='pull-right'>	
		 <a class='btn btn-sm btn-success btn-white btn-round fa fa-plus' data-rel='tooltip' data-placement='right' title='Cari Data Penduduk' data-toggle='modal' href='#modal-form' onclick="JTD('<?php echo base_url($this->router->fetch_class().'/popup/resident/1');?>','','modal')"></a>
		</div>		
	</div>	
	<div class="space-2"></div>
	<div class="form-group">
		<label class="col-sm-4 control-label" for="form-field-1">Nama Lengkap</label>
		<div class="col-sm-8">						
			<input type='text' class='col-xs-12 col-sm-12' name='resident_name1' id='resident_name1' value='' placeholder='Nama Lengkap'>
		</div>
	</div>	
	<div class="space-2"></div>
	<div class="form-group">
		<label class="col-sm-4 control-label" for="form-field-1"> Tempat, Tgl Lahir</label>
		<div class="col-sm-8">	
			<div class='row'>					
			<div class='col-sm-6 col-xs-6'>	
				<input type='text' class='col-xs-12 col-sm-12' name='resident_bplace1' id='resident_bplace1' placeholder='Tempat Lahir'  required onkeypress='return AlfaNum(event);'>
			</div>
			<div class='col-sm-6 col-xs-6'>	
			<div class="input-group" style='cursor:pointer'>
				<input type='text' class="form-control date-picker" name='resident_bday1' id='resident_bday1' data-date-format="yyyy-mm-dd" placeholder='yyyy-mm-dd'>
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
		<label class="col-sm-4 control-label" for="form-field-1"> Warganegara/Agama</label>
		<div class="col-sm-8">	
			<div class='row'>					
			<div class='col-sm-6 col-xs-6'>	
				<input type='text' class='col-xs-12 col-sm-12' name='resident_of1' id='resident_of1' placeholder='Kewarganegaraan' value='Indonesia'  onkeypress='return AlfaNum(event);'>
			</div>							
			<div class='col-sm-6 col-xs-6'>	
				<input type='text' class='col-xs-12 col-sm-12' name='resident_religion1' id='resident_religion1' placeholder='Agama'  onkeypress='return AlfaNum(event);'>
			</div>
			</div>
		</div>
	</div> 	
	<div class="space-2"></div>
	<div class="form-group">
		<label class="col-sm-4 control-label" for="form-field-1">Nama Lengkap</label>
		<div class="col-sm-8">						
			<input type='text' class='col-xs-12 col-sm-12' name='resident_job1' id='resident_job1' value='' placeholder='Pekerjaan'>
		</div>
	</div>	
	<div class="space-2"></div>
	<div class="form-group">
		<label class="col-sm-4 control-label" for="form-field-1"> Alamat Usaha</label>
		<div class="col-sm-8">						
		<textarea name='resident_address1' class='col-sm-12' id='resident_address1' placeholder='Alamat Usaha'></textarea>
		</div>
	</div>		
</div>	


<div class="col-xs-12 col-sm-6" id='data1' class='data'>
	<h4 class="header smaller lighter green" id='set1'>Data Calon Istri</h4>
	<div class="space-2"></div>
	<div class="form-group">
		<label class="col-sm-4 control-label" for="form-field-1"> No KTP</label>
		<div class="col-sm-5">						
			<input type='text' class='col-xs-12 col-sm-12' name='resident_no2' id='resident_no2' value='' placeholder = 'No KTP' required >
		</div>
		<div class='pull-right'>	
		 <a class='btn btn-sm btn-success btn-white btn-round fa fa-plus' data-rel='tooltip' data-placement='right' title='Cari Data Penduduk' data-toggle='modal' href='#modal-form' onclick="JTD('<?php echo base_url($this->router->fetch_class().'/popup/resident/2');?>','','modal')"></a>
		</div>		
	</div>	
	<div class="space-2"></div>
	<div class="form-group">
		<label class="col-sm-4 control-label" for="form-field-1">Pekerjaan</label>
		<div class="col-sm-8">						
			<input type='text' class='col-xs-12 col-sm-12' name='resident_name2' id='resident_name2' value='' placeholder='Nama Lengkap'>
		</div>
	</div>	
	<div class="space-2"></div>
	<div class="form-group">
		<label class="col-sm-4 control-label" for="form-field-1"> Tempat, Tgl Lahir</label>
		<div class="col-sm-8">	
			<div class='row'>					
			<div class='col-sm-6 col-xs-6'>	
				<input type='text' class='col-xs-12 col-sm-12' name='resident_bplace2' id='resident_bplace2' placeholder='Tempat Lahir'  required onkeypress='return AlfaNum(event);'>
			</div>
			<div class='col-sm-6 col-xs-6'>	
			<div class="input-group" style='cursor:pointer'>
				<input type='text' class="form-control date-picker" name='resident_bday2' id='resident_bday2' data-date-format="yyyy-mm-dd" placeholder='yyyy-mm-dd'>
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
		<label class="col-sm-4 control-label" for="form-field-1"> Warganegara/Agama</label>
		<div class="col-sm-8">	
			<div class='row'>					
			<div class='col-sm-6 col-xs-6'>	
				<input type='text' class='col-xs-12 col-sm-12' name='resident_of2' id='resident_of2' placeholder='Kewarganegaraan' value='Indonesia'  onkeypress='return AlfaNum(event);'>
			</div>							
			<div class='col-sm-6 col-xs-6'>	
				<input type='text' class='col-xs-12 col-sm-12' name='resident_religion2' id='resident_religion2' placeholder='Agama'  onkeypress='return AlfaNum(event);'>
			</div>
			</div>
		</div>
	</div> 	
	<div class="space-2"></div>
	<div class="form-group">
		<label class="col-sm-4 control-label" for="form-field-1">Pekerjaan</label>
		<div class="col-sm-8">						
			<input type='text' class='col-xs-12 col-sm-12' name='resident_job2' id='resident_job2' value='' placeholder='Pekerjaan'>
		</div>
	</div>	
	<div class="space-2"></div>
	<div class="form-group">
		<label class="col-sm-4 control-label" for="form-field-1"> Alamat Usaha</label>
		<div class="col-sm-8">						
		<textarea name='resident_address2' class='col-sm-12' id='resident_address2' placeholder='Alamat Usaha'></textarea>
		</div>
	</div>		
</div>	