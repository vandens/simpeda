<div class="col-xs-12 col-sm-6" id='data1' class='data'>
	<h4 class="header smaller lighter green" id='set1'>Data Calon Mempelai</h4>
	<div class="space-2"></div>
	<div class="form-group">
		<label class="col-sm-4 control-label" for="form-field-1"> No KTP</label>
		<div class="col-sm-5">						
			<input type='text' class='col-xs-12 col-sm-12' name='resident_no4' id='resident_no4' value='' placeholder = 'No KTP' required >
		</div>	
	</div>	
	<div class="space-2"></div>
	<div class="form-group">
		<label class="col-sm-4 control-label" for="form-field-1">Nama Lengkap</label>
		<div class="col-sm-8">						
			<input type='text' class='col-xs-12 col-sm-12' name='resident_name4' id='resident_name4' value='' placeholder='Nama Lengkap'>
		</div>
	</div>	
	<div class="space-2"></div>
	<div class="form-group">
		<label class="col-sm-4 control-label" for="form-field-1"> Tempat, Tgl Lahir</label>
		<div class="col-sm-8">	
			<div class='row'>					
			<div class='col-sm-6 col-xs-6'>	
				<input type='text' class='col-xs-12 col-sm-12' name='resident_bplace4' id='resident_bplace4' placeholder='Tempat Lahir'  required onkeypress='return AlfaNum(event);'>
			</div>
			<div class='col-sm-6 col-xs-6'>	
			<div class="input-group" style='cursor:pointer'>
				<input type='text' class="form-control date-picker" name='resident_bday4' id='resident_bday4' data-date-format="yyyy-mm-dd" placeholder='yyyy-mm-dd'>
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
				<input type='text' class='col-xs-12 col-sm-12' name='resident_of4' id='resident_of4' placeholder='Kewarganegaraan' value='Indonesia'  onkeypress='return AlfaNum(event);'>
			</div>							
			<div class='col-sm-6 col-xs-6'>	
				<input type='text' class='col-xs-12 col-sm-12' name='resident_religion4' id='resident_religion4' placeholder='Agama'  onkeypress='return AlfaNum(event);'>
			</div>
			</div>
		</div>
	</div> 	
	<div class="space-2"></div>
	<div class="form-group">
		<label class="col-sm-4 control-label" for="form-field-1">Nama Lengkap</label>
		<div class="col-sm-8">						
			<input type='text' class='col-xs-12 col-sm-12' name='resident_job4' id='resident_job4' value='' placeholder='Pekerjaan'>
		</div>
	</div>	
	<div class="space-2"></div>
	<div class="form-group">
		<label class="col-sm-4 control-label" for="form-field-1"> Alamat Usaha</label>
		<div class="col-sm-8">						
		<textarea name='resident_address4' class='col-sm-12' id='resident_address4' placeholder='Alamat Usaha'></textarea>
		</div>
	</div>		
</div>