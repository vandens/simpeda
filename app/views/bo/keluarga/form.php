<div class='page-content'>
	<form class="form-horizontal" id='form' method='post' action="<?php echo base_url($this->router->fetch_class().'/'.$val); ?>" role="form">										
	<input type='hidden' name='key' value='<?php echo $key; ?>'>
	<input type='hidden' name='edit' value='<?php echo $this->uri->segment(2); ?>'>
		<div class="row">
			<div class="col-xs-12">
				<div class="widget-box transparent">
					<div class="widget-header widget-header-small">
					<h4 class="widget-title smaller">
						<i class="ace-icon fa fa-users bigger-110"></i>
							Data Kartu Keluarga
					</h4>
					<div class='pull-right'>	
						<a data-rel='tooltip' href='javascript:history.back()' class='btn btn-success btn-white btn-round btn-sm fa fa-arrow-left'  title='Kembali' data-placement='bottom'></a>
						<?php echo ($this->_priv->FAMC || $this->_priv->FAMU) ? "<button data-rel='tooltip' type='submit' name='submit' value='".$val."'  class='btn btn-danger btn-white btn-round btn-sm fa ace-icon fa fa-share-square-o'  title='Konfirmasi' data-placement='bottom'></button>" : ''; ?>
					</div>
					</div>
						<div class="widget-body">
							<div class="widget-main">	
								<div class="space-2"></div>
								<div class="form-group">
									<label class="col-sm-2 control-label" for="form-field-1"> Desa</label>
									<div class="col-sm-3">											
										<select name='village_id' <?php echo $disabled; ?> class='form-control col-sm-4' >
											<option value = ''>Pilih Desa</option>
											<?php	
											foreach($this->_droplist->list_village as $v)
											{	
												#$sel 	= in_array(strtoupper($v->shop_id),$user_shop) ? 'selected="selected"' : '';
												$sel 	= ($v->village_id == $village_id) ? 'selected="selected"' : '';
												echo '<option value="'.$v->village_id.'_'.$v->village_name.'" '.$sel.'>'.ucwords(strtolower($v->village_name)).'</option>';
											}
											?>
											<!--<option value='all'>Semua Toko</option>-->
										</select>
									</div>
								</div>


								<div class="space-2"></div>
								<div class="form-group">
									<label class="col-sm-2 control-label" for="form-field-1"> Dusun & RT/RW</label>
									<div class="col-sm-9">	
										<div class='row'>

										<div class='col-sm-4 col-xs-6'>	
											<input type='text' class='col-xs-12 col-sm-12' <?php echo $disabled; ?>  name='resident_card_village' value='<?php echo $resident_card_village; ?>' placeholder='Nama Dusun / Kampung'  required onkeypress='return AlfaNum(event);'>
										</div>					
										<div class='col-sm-4 col-xs-6'>
											<input type='text' class='col-xs-12 col-sm-12' <?php echo $disabled; ?>  name='resident_card_village_no' value='<?php echo $resident_card_village_no; ?>' placeholder='RT / RW'  required onkeypress='return Num1(event);'>
										</div>

										</div>
									</div>
								</div>

								<div class="space-2"></div>
								<div class="form-group">
									<label class="col-sm-2 control-label" for="form-field-1"> No Kartu Keluarga</label>
									<div class="col-sm-9">	
										<div class='row'>					
										<div class='col-sm-5 col-xs-6'>	
											<input type='text' class='col-xs-12 col-sm-12' <?php echo $$disabled; ?>  name='resident_card_no' value='<?php echo !empty($key) ? $key : $resident_card_no; ?>' placeholder='No Kartu Keluarga'  required onkeypress='return AlfaNum(event);'>
										<?php if($this->uri->segment(2) != 'edit'){ ?>
										<label>
											<input class="ace" type="checkbox" <?php echo $disabled; ?> name="is_card_no">
											<span class="lbl" style='font-size:12px;'> Belum ada No Kartu Keluarga</span>
										</label>
										<?php } ?>
										</div>
										</div>
									</div>
								</div>

						
						</div>
					</div>
				</div>	
				
			</div><!-- /.col -->

			<?php echo $form2; ?>
		</div><!-- /.row -->		
	</form>
</div>