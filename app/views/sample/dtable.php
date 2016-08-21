
<table id="content-list" class="display responsive  dataTable" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th>User Id</th>
						<th>Nama Lengkap</th>
						<th>Email</th>
						<th>Member Grup</th>
						<th>Status</th>
						<th>Kunjungan</th>
						<th>Login</th>
						<th>Logout</th>
						<?php
						if(isset($this->_priv->U) || isset($this->_priv->D) || isset($this->_priv->T))
							echo "<th width='80px'>Opsi</th>";
						?>		
					</tr>
				</thead>
			</table>

		<link rel="stylesheet" href="<?php echo base_url(); ?>media/css2/jquery.dataTables.css" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>media/css2/bootstrap.csss" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>media/css2/jquery.dataTables" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>media/css2/jquery.dataTables" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>media/css2/jquery.dataTables" />

		<script src="<?php echo base_url(); ?>media/js2/ace.js"></script>
		<script src="<?php echo base_url(); ?>media/js2/ace-elements.js"></script>
		<script src="<?php echo base_url(); ?>media/js2/ace-extra.js"></script>
		<script src="<?php echo base_url(); ?>media/js2/jquery_002.js"></script>
		<script src="<?php echo base_url(); ?>media/js2/jquery_003.js"></script>
		<script src="<?php echo base_url(); ?>media/js2/jquery_004.js"></script>
		<script src="<?php echo base_url(); ?>media/js2/jquery_005.js"></script>
		<script src="<?php echo base_url(); ?>media/js2/jquery_007.js"></script>
		<script src="<?php echo base_url(); ?>media/js2/jquery.js"></script>
		<script src="<?php echo base_url(); ?>media/js2/jquery.dataTables.js"></script>
		<script src="<?php echo base_url(); ?>media/js2/dataTables.responsive.js"></script>





	<script type="text/javascript" language="javascript" class="init">
	$(document).ready(function() {
		var lastIdx = null;
		<?php $uri 	= ($_uri) ? $_uri : strtolower($this->router->fetch_class()).'/getdata'; ?>

		var table = $('#content-list').DataTable({
				"serverSide": true,
				"processing": true,
				"ajax": "<?php echo base_url($uri); ?>",
				dom: 'T"<clear>"Rfrtip',

				language: {
					"processing": "<img src='<?php echo base_url(); ?>/media/images/loading.gif' style='width:35px'>",
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


		 $('#ToolTables_content-list_1').on('click',function(){
			 $('#sidebar').removeClass();
			 
			 var column = table.column( [-1] );
			 column.visible( ! column.visible() );
			 $('#header_print').show();
		 });
		 
		$('#content-list tbody').on( 'click', 'tr', function () {
			if ( $(this).hasClass('selected') ) {
				$(this).removeClass('selected');
			}
			else {
				table.$('tr.selected').removeClass('selected');
				$(this).addClass('selected');
			}
		} );
	});
	</script>