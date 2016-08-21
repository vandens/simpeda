<div class="widget-box transparent">
	<div class="widget-header widget-header-flat widget-header-small">
	<div class="widget-toolbar action-buttons">
		<div class='pull-right'>
			<a href='javascript:history.back()' class='btn btn-success btn-white btn-round btn-sm fa fa-arrow-left' data-rel='tooltip' title='Kembali' data-placement='bottom'></a>
		</div>
	</div>
	</div>
	<div class="widget-body">
		<div class="widget-main padding-8">						
			
		<?php if(count($temp) > 0)
				foreach($temp as $tmp)
					echo $tmp; 
		?>		
		</div>
	</div>
</div>