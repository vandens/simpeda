<div class="widget-box">
	<div class="widget-header widget-header-flat widget-header-small">
		<h4 class="widget-title blue smaller">
			<i class="ace-icon fa fa-tags orange"></i>
			Data Kategori
		</h4>
	<div class="widget-toolbar action-buttons">	
		<div class='pull-right'>
			<?php //echo isset($S) ? "<a class='btn btn-success btn-white btn-round btn-sm fa fa-search' data-toggle='modal' role='button' href='#modal-form' data-rel='tooltip' title='Cari Data' data-placement='bottom'></a>" : ''; ?>
			<?php echo isset($C) ? "<button onclick='javascript:window.location.href=\"".base_url($this->router->fetch_class().'/action/tambah')."\"' bigger-190 class='btn btn-success  btn-round btn-white  btn-sm fa fa-plus-square' data-rel='tooltip' data-placement='bottom' title='Tambah'></button>" : ''; ?>
			<?php echo isset($I) ? "<button onclick='javascript:window.location.href=\"".base_url($this->router->fetch_class().'/import')."\"' bigger-190 class='btn btn-success  btn-round btn-white  btn-sm fa fa-file-text' data-rel='tooltip' data-placement='bottom' title='Import'></button>" : ''; ?>
			<?php echo isset($L) ? "<button onclick='javascript:window.location.href=\"".base_url($this->router->fetch_class().'/laporan')."\"' bigger-190 class='btn btn-success  btn-round btn-white  btn-sm fa fa-list-alt' data-rel='tooltip' data-placement='bottom' title='Laporan'></button>" : ''; ?>
		</div>
	</div>
	</div>
	<div class="widget-body">
		<div class="widget-main padding-8">				
				
			<table id="content-list" class="display responsive  dataTable" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th>Kategori</th>
						<th>Judul</th>
						<th>Bts Tampil</th>
						<th>Kunjungan</th>
						<th>Status</th>
						<th>Ditambah Oleh</th>
						<th>Waktu</th>
						<?php
						if(isset($U) || isset($D) || isset($T))
							echo "<th width='80px'>Opsi</th>";
						?>				
					</tr>
				</thead>
			</table>
				
			
		</div>
	</div>
</div>