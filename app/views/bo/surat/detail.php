				<div class="widget-box transparent">
					<div class="widget-header widget-header-small">
					<h4 class="widget-title smaller">
					<div class='pull-right'>	
						<a data-rel='tooltip' href='javascript:history.back()' class='btn btn-success btn-white btn-round btn-sm fa fa-arrow-left'  title='Kembali' data-placement='bottom'></a>
						<a data-rel='tooltip' onclick="window.open('<?php echo base_url('surat/cetak/'.$detail->letter_no); ?>','Cetak Surat','width=<?php echo in_array($detail->letter_code,array('LET09','LET10','LET11')) ? '500' : '950'; ?>,height=500,resizable=yes,scrollbars=yes,status=yes').focus()" class='btn btn-success btn-white btn-round btn-sm fa fa-print'  title='Cetak' data-placement='bottom'></a>
					</div>
					</h4>
					</div>
						<div class="widget-box transparent"> 
						<div class="widget-body">
						<div class="widget-main">
								<?php echo  str_replace('bootstrap', 'nothing', $detail->letter_body); ?>								
						</div>
						</div>
						</div>
					</div>		


								
				
				
				