<div class="widget-box transparent">
	<div class="widget-header widget-header-flat widget-header-small">
	<div class="widget-toolbar action-buttons">
		<div class='pull-right'>
			<?php echo $this->session->userdata('DESR') ? "<button onclick='javascript:window.location.href=\"".base_url($this->router->fetch_class().'/form')."\"' bigger-190 class='btn btn-success  btn-round btn-white  btn-sm fa fa-plus-square' data-rel='tooltip' data-placement='bottom' title='Tambah'></button>" : ''; ?>
		</div>
	</div>
	</div>
	<div class="widget-body">
		<div class="widget-main padding-8">				
				
			<table id="content-list" class="display responsive  dataTable" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th>Id Pengguna</th>
						<th>Id Modul</th>
						<th>Aktifitas Terakhir</th>
						<th>IP Address</th>
						<th>Browser</th>
						<th>Waktu</th>
						<?php
						if(isset($this->_priv->ACTD) || isset($this->_priv->ACTT))
							echo "<th width='80px'>Opsi</th>";
						?>		
					</tr>
				</thead>
			</table>
				
			
		</div>
	</div>
</div>