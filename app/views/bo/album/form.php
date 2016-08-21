<?php echo '<script src="'.base_url('media/js/bootstrap.js').'"></script>'; ?>
<form class="form-horizontal" id='form' action="<?php echo base_url($this->router->fetch_class().'/simpan'); ?>" class='form' method='post' role="form">	
<link rel="stylesheet" href="<?php echo base_url()?>media/css/colorbox.css">
<link rel="stylesheet" href="<?php echo base_url()?>media/css/css.css">
<link rel="stylesheet" href="<?php echo base_url()?>media/css/ace.css" id="main-ace-style">
<div style='padding:20px'>
		<div class="row">
			<div class="col-xs-12">
				<div class="widget-box transparent">
					<div class="widget-header widget-header-small">
						<h4 class="widget-title smaller">
							<i class="ace-icon fa fa-pic orange"></i>
								<?php echo $sub;?>
						</h4>
					<div class='pull-right'>	
						<a data-rel='tooltip' href='javascript:history.back()' class='btn btn-success btn-white btn-round btn-sm fa fa-arrow-left'  title='Kembali' data-placement='bottom'></a>
						<?php if($this->_priv->ALBC || $this->_priv->ALBU){ ?>
							 <button data-rel='tooltip' onclick="simpan()" type='submit' name='submit' value='<?php echo $val; ?>'  class='btn btn-danger btn-white btn-round btn-sm fa ace-icon fa fa-share-square-o'  title='Konfirmasi' data-placement='bottom'></button>
						<?php } ?>
					</div>
					</div>
						<div class="widget-body">
							<div class="widget-main" id='widget-main'>	
																	
									<input type='hidden' name='key' value='<?php echo $key; ?>'>
										<div class='row'>	
																
												<div class="form-group">
													<label class="col-sm-4"> Desa</label>
													<div class="col-sm-8">						
															<select name='village_code'>
																<?php										
																foreach($this->_droplist->list_village as $v)
																{
																	#$sel 	= in_array(strtoupper($v->shop_id),$user_shop) ? 'selected="selected"' : '';
																	$sel 	= ($v->village_code == $village_code) ? 'selected="selected"' : '';
																	echo '<option value="'.$v->village_code.'_'.$v->village_name.'" '.$sel.'>'.ucwords(strtolower($v->village_name)).'</option>';
																}
																?>
																<!--<option value='all'>Semua Toko</option>-->
															</select>
													</div>
												</div>	
																				
												<div class="form-group">
													<label class="col-sm-4"> Nama Album</label>
													<div class="col-sm-8">						
														<input type='text' class='col-xs-12 col-sm-10' id='alb_name' name='alb_name' placeholder='Judul' value='<?php echo $alb_name;?>'  required onkeypress='return AlfaNum(event);'>
													</div>
												</div>	
																				
												<div class="form-group">
													<label class="col-sm-4"> Diambil pada Waktu</label>
													<div class="col-sm-4">																
														<div class="input-group">
															<input class="form-control date-picker col-xs-6" name='alb_taken_date' value='<?php echo $alb_taken_date; ?>' type="text" placeholder="yyyy-mm-dd" data-date-format="yyyy-mm-dd" onkeypress='this.value=ignoreSpaces(this.value); return DateFormat(event);'>
															<span class="input-group-addon">
																<i class="fa fa-calendar bigger-110"></i>
															</span>
														</div>
													</div>
												</div>	
																					
												<div class="form-group">
													<label class="col-sm-4"> Lokasi</label>
													<div class="col-sm-4">						
														<input class="form-control" placeholder='Lokasi' name='alb_taken' value='<?php echo $alb_taken; ?>' type="text" onkeypress='return AlfaNum(event);'>
													</div>
												</div>	
												
														
												<div class="form-group">
													<label class="col-sm-4"> Publikasikan</label>
													<div class="col-sm-8">													
														<div class="">						
															<?php
															$ispub = array('Y'=>'Ya','N'=>'Tidak');
															echo form_dropdown('alb_ispublish', $ispub, $alb_ispublish,'class=""');?>
														</div>
														</div>
												</div>	
											</div>	



											<?php if($val == 'update'){?>
											<ul class="ace-thumbnails clearfix">
											<?php  foreach($sql as $row){ ?>			
												<li>
													<?php 
													$foto 		= base_url('media/album/'.$alb_id.'/'.$row->alb_filename);
												  	$foto 		= (file_exists(FCPATH.'media/album/'.$alb_id.'/'.$row->alb_filename)) ? $foto : base_url('media/images/no-image.jpg');
													
													$file 		= $this->general_model->getFileName($row->alb_filename);
												  	$thumb 		= base_url('media/album/'.$alb_id.'/'.$file['thumbnail']);
												  	$thumb 		= (file_exists(FCPATH.'media/album/'.$alb_id.'/'.$file['thumbnail'])) ? $thumb : base_url('media/images/no-image.jpg');
							
												  	?>
													<a class="cboxElement" href="<?php echo $foto; ?>" data-rel="colorbox">
														<img alt="" src="<?php echo $thumb; ?>" height="150" width="150">
														<div class="text">
															<div class="inner"><?php echo $row->alb_desc;?></div>
														</div>
													</a>						
													<div class="tools tools-bottom">
													<!--
														<a href="#"><i class="ace-icon fa fa-link"></i></a>
														<a href="#"><i class="ace-icon fa fa-paperclip"></i></a>
														<a href="#"><i class="ace-icon fa fa-pencil"></i></a>
													-->
														<a href="<?php echo base_url('album/deletefoto/'.$row->auto);?>"><i class="ace-icon fa fa-times red"></i></a>
													</div>											
												</li>
											<?php } ?>	
											
												<li data-rel='tooltip' title='Upload Foto' data-placement='right' class='btn btn-success' style='cursor:pointer;'>
													<div class='col-sm-3 col-xs-4 center' data-toggle="modal" role="button" href="#modal-form">
														<span class='fa fa-plus bigger-220'></span>					
													</div>
												</li>	
											</ul>
											<?php } ?>

						
						</div>
					</div>
				</div>	
				
			</div><!-- /.col -->
		</div><!-- /.row -->		
</div>
</form>
<?php #echo $this->js; ?>
<?php echo $this->load->view('bo/temp/form_foto');?>
<?php echo $this->load->view('bo/album/lightbox');?>

<script>
jQuery(function($) {
				//date picker
				$('.date-picker').datepicker({
					autoclose: true,
					todayHighlight: true
				})
				//show datepicker when clicking on the icon
				.next().on(ace.click_event, function(){
					$(this).prev().focus();
				});
			});
</script>