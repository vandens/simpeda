

	<!--[if !IE]> -->
		<script type="text/javascript">
			window.jQuery || document.write("<script src='<?php echo base_url(); ?>media/js2/jquery_002.js'>"+"<"+"/script>");
		</script>

		<!-- <![endif]-->

		<!--[if IE]>
		<script type="text/javascript">
		 window.jQuery || document.write("<script src='<?php echo base_url(); ?>media/js/jquery1x.js'>"+"<"+"/script>");
		</script>
		<![endif]-->
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='<?php echo base_url(); ?>media/js/jquery.mobile.custom.js'>"+"<"+"/script>");
		</script>

		<script src="<?php echo base_url(); ?>media/js2/bootstrap.js"></script>


		<!-- page specific plugin scripts -->
		<script src="<?php echo base_url(); ?>media/js2/jquery.dataTables.js"></script>
		<script src="<?php echo base_url(); ?>media/js2/dataTables.colReorder.js"></script>
		<script src="<?php echo base_url(); ?>media/js2/dataTables.colVis.js"></script>
		<script src="<?php echo base_url(); ?>media/js2/dataTables.tableTools.js"></script>

		<link rel="stylesheet" href="<?php echo base_url(); ?>media/css2/font-awesome.css" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>media/css2/font-awesome.css" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>media/css2/dataTables.responsive.css" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>media/css2/dataTables.tableTools.css" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>media/css2/jquery.dataTables.css" />




	<script type="text/javascript" language="javascript" class="init">
	$(document).ready(function() {
		<?php $uri 	= ($_uri) ? $_uri : strtolower($this->router->fetch_class()).'/getdata'; ?>

		var table = $('#content-list').DataTable({
				"serverSide": true,
				"processing": true,
				"ajax": "<?php echo base_url($uri); ?>",
				dom: 'T"<clear>"Rfrtip',	
				columnDefs: [{
					"bSortable": false, 
					"aTargets": [ -1 ],
					targets: -1,
					className: 'opsi'
				  }],
				sorting: [[ 0, 'asc' ]],
				 tableTools: {
				 "aButtons": [
					//	{
					//		"sExtends": "copy",
					//		"sToolTip": "Copy to clipboard",
					//		"sButtonClass": "btn btn-white btn-primary btn-bold",
					//		"sButtonText": "<i class='fa fa-copy bigger-110 pink'></i>",
					//		"fnComplete": function() {
					//			this.fnInfo( '<h3 class="no-margin-top smaller">Table copied</h3>\
					//				<p>Copied '+(oTable1.fnSettings().fnRecordsTotal())+' row(s) to the clipboard.</p>',
					//				1500
					//			);
					//		}
					//	},
						
						{
							"sExtends": "csv",
							"sToolTip": "Export to CSV",
					//		"sButtonClass": "btn btn-white btn-primary  btn-bold",
							"sButtonText": "<i class='fa fa-file-excel-o bigger-110 green'></i>"
						},
						
					//	{
					//		"sExtends": "pdf",
					//		"sToolTip": "Export to PDF",
					//		"sButtonClass": "btn btn-white btn-primary  btn-bold",
					//		"sButtonText": "<i class='fa fa-file-pdf-o bigger-110 red'></i>"
					//	},
						
						{
							"sExtends": "print",
							"sToolTip": "Print view",
					//		"sButtonClass": "btn btn-white btn-primary  btn-bold",
							"sButtonText": "<i class='fa fa-print bigger-110 grey'></i>",
							
					//		"sMessage": "<div class='navbar navbar-default'><div class='navbar-header pull-left'><a class='navbar-brand' href='#'><small>Optional Navbar &amp; Text</small></a></div></div>",
							
							"sInfo": "<h3 class='no-margin-top'>Print view</h3>\
									  <p>Silahkan tekan tombol Ctrl+P untuk \
									  mencetak halaman ini.\
									  <br />Tekan <b>escape</b> jika selesai.</p>",
						}
			        ]},
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

		    $('.DTTT_button').addClass('btn btn-xs btn-info btn-white btn-round');
		    $('.ColVis_Button').addClass('btn btn-xs btn-info btn-white btn-round');
		    
		    $('[data-rel=tooltip]').tooltip();

		    $('#ToolTables_content-list_1').on('click',function(){
			$('#sidebar').removeClass();
			 
			var column = table.column( [-1] );
			 	column.visible( ! column.visible() );
			$('#header_print').show()

		 });
		 

		 var x = $('#alert').html();
		 
		           if(x !=''){
					<?php 
					if($this->session->flashdata('error')){
						$er 	= $this->session->flashdata('error');
						$er_flag = (!$er['error']) ? 'success' : 'danger';
					?>

				     var flag = '<?php echo $er_flag; ?>';
		   		 	 show_alert('.alert',flag,x);
		   		 	 <?php 
					}else{ ?>
						show_alert('.alert','danger',x);
					<?php } ?>
		           }
		           

	});
	</script>