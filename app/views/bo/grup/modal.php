<div id="modal-form" class="modal" tabindex="-1" style="display: none;" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button class="close" data-dismiss="modal" type="button">×</button>
				<h4 class="blue bigger">Form Internal Order</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-xs-12">	
					<form method='post' class='form-horizontal' action='' id='ioform'>				
					<div class='pull-right'>
					<button onclick="alert($('#ioform').serialize())" type='button' name='submit' value='simpan'  class='btn btn-primary btn-white btn-round btn-sm fa fa-save'> Simpan</button>
					</div>
						<div class="profile-info-row">
							<div class="profile-info-name" style='width:100px'> Kode</div>
							<div class="profile-info-value ">
								<input type="text" id="io_code" required name="io_code" value='<?php echo $io_code; ?>' placeholder=" Kode " class="input-small"/>
							</div>				
						</div>	
						<div class="profile-info-row">
							<div class="profile-info-name" style='width:100px'> Deskripsi</div>
							<div class="profile-info-value ">
								<input type="text" id="io_desc" required name="io_desc" value='<?php echo $io_desc; ?>' placeholder=" Deskripsi " class="input-large"/>
							</div>				
						</div>	
					</form>
						<div class="space-4"></div>
					</div>
					
						<div class="col-xs-12">
						<div class="space-4"></div>	
							<div>		
								<table id="content-list" class="display responsive" width="100%" cellspacing="0">	
									<thead>
										<tr role="row">
											<?php 
												foreach($table['label'] as $val)
												echo '<th>'.$val.'</th>';
											?>
										</tr>
									</thead>
								</table>			
							</div>
						</div>		
				</div>
				</div>
			<!-- 
			<div class="modal-footer">
				<button class="btn btn-sm" data-dismiss="modal">
					<i class="ace-icon fa fa-times"></i> Cancel	
				</button>
				<button class="btn btn-sm btn-primary">	
					<i class="ace-icon fa fa-check"></i> Save
				</button>
			</div>	
			-->				
		</div>
	</div>
</div>


<script type="text/javascript" language="javascript" class="init">
$(document).ready(function() {
	
	$('#content-list').DataTable( {
	"ajax": {
			"url": "<?php echo base_url('io/getIO'); ?>",
			"dataSrc": ""
		},
		"columns": <?php echo json_encode($table['fields']); ?>,
    } );

    
} );

</script>