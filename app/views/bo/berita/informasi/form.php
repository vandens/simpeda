<script type="text/javascript" src="<?php echo base_url().'media/editor'?>/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
tinymce.init({
    selector: "textarea",
    theme: "modern",
    plugins: [
        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen",
        "insertdatetime media nonbreaking save table contextmenu directionality",
        "emoticons template paste textcolor colorpicker textpattern"
    ],
    toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
    toolbar2: "print preview media | forecolor backcolor emoticons",
    image_advtab: true,
    templates: [
        {title: 'Test template 1', content: 'Test 1'},
        {title: 'Test template 2', content: 'Test 2'}
    ]
});
</script>
<div class='page-content'>
	<input type='hidden' name='key' value='<?php echo $key; ?>'>
	<div class="page-header">
		<h1>
		<i class="ace-icon fa fa-home home-icon"></i>
			<a href="#">Home</a> 
		<small>
		<i class="ace-icon fa fa-angle-double-right"></i>
		<?php echo $this->_pghead; ?>
			<i class="ace-icon fa fa-angle-double-right"></i> <?php echo $this->_pgdesc; ?>
		</small>
		</h1>
	</div>
	<div class='row'>		
		<div class="col-xs-12">
		
			
			<form class="form-horizontal" id='form' method="post" enctype="multipart/form-data" action="<?php echo base_url($this->router->fetch_class().'/action/simpan'); ?>" role="form">										
				<div class="widget-box transparent">
					<div class="widget-header widget-header-flat widget-header-small">
						<h4 class="widget-title smaller">
							<i class="ace-icon fa fa-cog orange"></i>
								<?php echo $this->_pghead;?>
						</h4>
							<div class='pull-right'>	
								<a href='javascript:history.back()' class='btn btn-success btn-white btn-round btn-sm fa fa-arrow-left' data-rel='tooltip' title='Kembali' data-placement='bottom'></a>
								<?php echo ($C || $U) ? "<button type='submit' name='submit' value='".$val."' class='btn btn-primary btn-round btn-white  btn-sm fa fa-save' data-rel='tooltip' data-placement='bottom' title='".$val."'></button>" : ''; ?>
							</div>
					</div>	
					<div class="widget-body">
						<div class="widget-main">
						<div class='alert alert-danger' style='display:none'><?php echo validation_errors(); ?></div>
						
							<div class='row'>
								<div class='col-xs-12 col-sm-8'>	
									<div class='row'>						
									<div class='col-xs-12 col-sm-12'>						
										<div class="form-group">
											<label class="col-sm-1 control-label" for="form-field-1"  style='margin-right:8px'> Judul</label>
											<div class="col-sm-10">						
												<input type='text' class='col-xs-12 col-sm-12' id='info_title' name='info_title' placeholder='Judul' value='<?php echo $info_title;?>'  required onkeypress='return AlfaNum(event);'>
											</div>
										</div>
									</div>					
									<div class='col-xs-6 col-sm-7'>						
										<div class="form-group">
											<label class="col-xs-3  col-sm-2 control-label" for="form-field-1"> Kategori </label>
											<div class="col-xs-6  col-sm-10">						
												<?php echo form_dropdown('cat_code', $cat, $cat_code,'class="col-sm-10"');?>
											</div>
										</div>
									</div>
									<div class='col-xs-6 col-sm-5' style='margin-left:-50px'>
										<div class="form-group">								
												<label class=" col-xs-5 col-sm-5 control-label" for="form-field-1"> Tampil Hingga</label>
												<div class="col-xs-6  col-sm-7">						
														<div class="input-group">
															<input id="id-date-picker-1" class="form-control date-picker" name='info_dateto' value='<?php echo $info_dateto; ?>' type="text" data-date-format="yyyy-mm-dd" onkeypress='this.value=ignoreSpaces(this.value); return DateFormat(event);'>
															<span class="input-group-addon">
																	<i class="fa fa-calendar bigger-110"></i>
															</span>
														</div>
												</div>
										</div>							
									</div>					
									<div class='col-xs-6 col-sm-7'>						
										<div class="form-group">
											<label class="col-xs-3  col-sm-2 control-label" for="form-field-1"> Publis </label>
											<div class="col-xs-6  col-sm-10">						
												<?php
												$ispub = array('Y'=>'Ya','N'=>'Tidak');
												echo form_dropdown('info_ispublish', $ispub, $info_ispublish,'class="col-sm-6"');?>
											</div>
										</div>
									</div>					
									<div class='col-xs-6 col-sm-5'>						
										<div class="form-group">
											<label class="col-xs-3  col-sm-2 control-label" for="form-field-1"> Status </label>
											<div class="col-xs-6  col-sm-10">						
												<?php
												$act = array('1'=>'Aktif','0'=>'Tidak Aktif');
												echo form_dropdown('info_status', $act, $info_status,'class="col-sm-6"');?>
											</div>
										</div>
									</div>
			
									
									
									</div>					
								</div>
								<div class='col-xs-12 col-sm-4'>
								
								
									<div class="form-group">
										<div class="col-sm-6 col-xs-12">				
											<img src='<?php echo base_url('media/info/'.$info_filename);?>' style='width:150px;'>							
										</div>
										<div class="col-sm-6 col-xs-5">				
											<input  type="file" name='info_filename' id='info_filename' value=''/>
											<input type='hidden' name='img' value='<?php echo $info_filename; ?>'>	
											<input type='hidden' name='key' value='<?php echo $info_id; ?>'>										
										</div>
									</div>
									
								</div>
								<div class='col-sm-12 col-xs-12'>
									<textarea style='height:400px' class='col-xs-12 col-sm-12' name='info_content' id="editor1" contenteditable="true"><?php echo $info_content; ?></textarea>
								
								</div>
							</div>	
						</div>
					</div>
				</div>
			</form>


		</div>
	</div>
</div>


<script type="text/javascript">
			jQuery(function($) {		
				$('#info_filename').ace_file_input({
					style:'well',
					btn_choose:'Ganti Image',
					btn_change:null,
					no_icon:'ace-icon fa fa-cloud-upload',
					droppable:true,
					thumbnail:'large',//large | fit
					//,icon_remove:null//set null, to hide remove/reset button
					/**,before_change:function(files, dropped) {
						//Check an example below
						//or examples/file-upload.html
						return true;
					}*/
					/**,before_remove : function() {
						return true;
					}*/
					preview_error : function(filename, error_code) {
						//name of the file that failed
						//error_code values
						//1 = 'FILE_LOAD_FAILED',
						//2 = 'IMAGE_LOAD_FAILED',
						//3 = 'THUMBNAIL_FAILED'
						//alert(error_code);
					}
			
				}).on('change', function(){
					//console.log($(this).data('ace_input_files'));
					//console.log($(this).data('ace_input_method'));
				});
			
			});
		</script>