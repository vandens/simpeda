
<div class="modal-body" id='modal-body'>
	<div class='row'>
		<table id="popup_list" class="display responsive  dataTable" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th>Kode Surat</th>
					<th>Nama Surat</th>
					<th>Status</th>
					<th>Keterangan</th>
				</tr>
			</thead>
		</table>
	</div>
</div>
<script type="text/javascript" language="javascript" class="init">
$(document).ready(function() {
    var table = $('#popup_list').DataTable({
			"serverSide": true,
			"processing": true,
			"ajax": "<?php echo base_url(strtolower($this->router->fetch_class().'/getdata/template')); ?>",
			//dom: 'T"<clear>"Rfrtip',
			language: {
				"processing": "<img src='<?php echo base_url(); ?>media/images/loading.gif' style='width:35px'>",
				"lengthMenu": "_MENU_ Data per halaman",
				"zeroRecords": "Tidak ada data",
				"info": "Halaman _PAGE_ dari _PAGES_",
				"infoEmpty": "Tidak ada data tersedia",
				"infoFiltered": "(Difilter dari total _MAX_ data)",
				"infoPostFix": "",
				"search": "<i class='fa fa-filter bigger-120'></i> Filter Data  _INPUT_",
				"url": "",
				"paginate": {
					"first":    "Pertama",
					"previous": "Sebelumnya",
					"next":     "Berikutnya",
					"last":     "Terakhir"
				}
			}
	    });
});
</script>