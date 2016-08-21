<div class="widget-box transparent">
	<div class="widget-header widget-header-flat widget-header-small">
	<div class="widget-toolbar action-buttons">
		<div class='pull-right'>
			<?php echo $this->session->userdata('GROC') ? "<button onclick='javascript:window.location.href=\"".base_url($this->router->fetch_class().'/form')."\"' bigger-190 class='btn btn-success  btn-round btn-white  btn-sm fa fa-plus-square' data-rel='tooltip' data-placement='bottom' title='Tambah'></button>" : ''; ?>
		</div>
	</div>
	</div>
	<div class="widget-body">
		<div class="widget-main padding-8">						
			<table id="content-list" class="display responsive  dataTable" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th>Kode</th>
						<th>Nama Grup</th>
						<th>Status</th>
						<th>Ditambah Oleh</th>
						<th>Waktu</th>
						<?php
						if(isset($this->_priv->GROU) || isset($this->_priv->GROD) || isset($this->_priv->GROT))
							echo "<th width='80px'>Opsi</th>";
						?>		
					</tr>
				</thead>
			</table>	
		</div>
	</div>
</div>