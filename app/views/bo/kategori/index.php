<div class="widget-box transparent">
	<div class="widget-header widget-header-flat widget-header-small">
	<div class="widget-toolbar action-buttons">
		<div class='pull-right'>
			<?php if($this->session->userdata('CATC')){ ?>
				 <button data-toggle='modal' href='#modal-form' onclick="JTD('<?php echo base_url($this->router->fetch_class().'/form'); ?>','','modal')" bigger-190 class='btn btn-success  btn-round btn-white  btn-sm fa fa-plus-square' data-rel='tooltip' data-placement='bottom' title='Tambah'></button>
			<?php } ?>
												
		</div>
	</div>
	</div>
	<div class="widget-body">
		<div class="widget-main padding-8">											
			<table id="content-list" class="display responsive  dataTable" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th>Kode</th>
						<th>Nama Kategori</th>
						<th>Keterangan</th>
						<th>Status</th>
						<?php
						if(isset($this->_priv->CATU) || isset($this->_priv->CATD) || isset($this->_priv->CATT))
							echo "<th width='90px'>Opsi</th>";
						?>		
					</tr>
				</thead>
			</table>		
		</div>
	</div>
</div>
<?php echo $modal; ?>