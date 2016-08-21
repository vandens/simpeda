<div class="widget-box transparent">
	<div class="widget-header widget-header-flat widget-header-small">
	<div class="widget-toolbar action-buttons">
		<div class='pull-right'>
			<?php echo $this->session->userdata('TEMC') ? "<button onclick='javascript:window.location.href=\"".base_url($this->router->fetch_class().'/form')."\"' bigger-190 class='btn btn-success  btn-round btn-white  btn-sm fa fa-plus-square' data-rel='tooltip' data-placement='bottom' title='Tambah'></button>" : ''; ?>
		</div>
	</div>
	</div>
	<div class="widget-body">
		<div class="widget-main padding-8">						
			<table id="content-list" class="display responsive  dataTable" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th>Kode Template</th>
						<th>Nama Surat</th>
						<th>Keterangan</th>
						<th>Status</th>
						<?php
						if(isset($this->_priv->PENU) || isset($this->_priv->PEND) || isset($this->_priv->PENT))
							echo "<th width='90px'>Opsi</th>";
						?>		
					</tr>
				</thead>
			</table>		
		</div>
	</div>
</div>