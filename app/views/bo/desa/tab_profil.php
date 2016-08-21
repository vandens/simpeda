<div class="row">
	<?php echo isset($data['profil_kode_desa']) ? '<input type="hidden" name="profil_kode_desa" value="'.$data['profil_kode_desa'].'">' : ''; ?>
	<div class="col-sm-12">
		<div class="widget-box transparent">
			<div class="widget-body">
				<div class="widget-main">	

					<h4 class="header smaller lighter red">Profil Desa</h4>
					<div class="space-2"></div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="form-field-1"> Kode Desa</label>
						<div class="col-sm-6">						
							<input type='text' name='profil_kode_desa' class='col-xs-6 col-sm-6' <?php echo isset($data['profil_kode_desa']) ? 'disabled' : ''; ?> value='<?php echo $data['profil_kode_desa']; ?>' required onkeypress='this.value=ignoreSpaces(this.value); return AlfaNum(event);' onkeyup='javascript:this.value = this.value.toLowerCase();'>
						</div>
					</div>	
					<div class="space-2"></div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="form-field-1"> Nama Desa</label>
						<div class="col-sm-6">						
							<input type='text' name='profil_nama_desa' class='col-xs-12 col-sm-12' placeholder='Nama Desa' value='<?php echo $data['profil_nama_desa']; ?>' required onkeypress='return AlfaOnly(event);'>
						</div>
					</div>
					<div class="space-2"></div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="form-field-1"> Kepala Desa</label>
						<div class="col-sm-6">						
							<input type='text' name='profil_kepala_desa' class='col-xs-12 col-sm-12' placeholder='Kepala Desa' value='<?php echo $data['profil_kepala_desa']; ?>' required onkeypress='return AlfaOnly(event);'>
						</div>
					</div>

					<div class="space-2"></div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="form-field-1"> Nama/NIP Sekdes</label>
						<div class="col-sm-9">	
							<div class='row'>					
							<div class='col-sm-4 col-xs-6'>	
								<input type='text' class='col-xs-12 col-sm-12' name='profil_nama_sekdes' placeholder='Nama Sekdes' value='<?php echo $data['profil_nama_sekdes']; ?>' required onkeypress='return AlfaNum(event);'>
							</div>
							<div class='col-sm-4 col-xs-6'>	
								<input type='text' class='col-xs-12 col-sm-12' name='profil_nip_sekdes' placeholder='NIP Sekdes' value='<?php echo $data['profil_nip_sekdes']; ?>' required onkeypress='return AlfaNum(event);'>
							</div>
							</div>
						</div>
					</div>

					<div class="space-2"></div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="form-field-1"> No Telepon</label>
						<div class="col-sm-6">						
							<input type='text' name='profil_no_register' class='col-xs-12 col-sm-12' placeholder='No Telp' value='<?php echo $data['profil_no_register']; ?>' onkeypress='this.value=ignoreSpaces(this.value); return AlfaOnly(event);' onkeyup='javascript:this.value = this.value.toLowerCase();'>
						</div>
					</div>
					<div class="space-2"></div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="form-field-1"> Alamat</label>
						<div class="col-sm-6">						
							<textarea name='profil_alamat' class='col-xs-12 col-sm-12'><?php echo $data['profil_alamat']; ?></textarea>
						</div>
					</div>
				</div>
			</div>
		</div>	
				
	</div><!-- /.col -->
</div><!-- /.row -->		