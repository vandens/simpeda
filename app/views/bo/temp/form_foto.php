<div id="modal-form" class="modal" tabindex="-1" style="display: none;" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-content">
				<div class="modal-header">
					<button class="close" data-dismiss="modal" type="button"><span class='fa fa-times'></span></button>
					<h4 class="blue bigger">Upload Foto</h4>
				</div>
					
				<div class="modal-body">
					<div class='row'>
						<?php echo form_open_multipart(base_url($this->router->fetch_class().'/simpanfoto'));?>
							<div class='col-xs-12 col-sm-12'>
								<input type='hidden' name='alb_id'	value='<?php echo $alb_id;?>'>
								<input type='hidden' name='alb_name' value='<?php echo $alb_name; ?>'>
								<input type='file' class='image' name='alb_filename'>						
							</div>
							<div class='col-xs-12 col-sm-12'>
								<textarea name='alb_desc' class='col-sm-12 col-xs-12' placeholder='Keterangan'></textarea>					
							</div>
							<div class='col-xs-12 col-sm-12'>
								<br><button type='submit' name='simpan' value='true' class='btn btn-sm btn-success pull-right'><span class='fa fa-save'></span>Simpan</button>						
							</div>
						</form>
					</div>
				</div>
				
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
			jQuery(function($) {		
				$('.image').ace_file_input({
					style:'well',
					btn_choose:'Upload Foto',
					btn_change:null,
					no_icon:'ace-icon fa fa-cloud-upload',
					droppable:true,
					thumbnail:'fit',//large | fit
					icon_remove:null,//set null, to hide remove/reset button
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