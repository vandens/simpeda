<div class='row'>
	<div class="col-xs-12 col-sm-6" style='margin-bottom:25px'>
		<div class="widget-box transparent">
			<div class="widget-header widget-header-flat widget-header-small">
				<h4 class="widget-title blue smaller">
					<i class="ace-icon fa fa-users orange"></i>
					Data Statistik Desa
				</h4>
			</div>
			<div class="widget-body">
			<div class="widget-main">	
					<table id="<?php echo $_id; ?>" class="display responsive dataTable table-striped table-hover  no-footer" width="100%" cellspacing="0">	
							<thead>
								<tr>
								<?php foreach($_label as $label => $l)
									echo '<th>'.$l.'</th>';
								?>
								</tr>
							</thead>
							<tbody>
								<?php 
								$vi = array();
								foreach($_sql as $key => $k){

									echo '<tr>';
										foreach($k as $val => $v){
												echo '<td>'.$v.'</td>';
										}					
									echo '</tr>';	
					
									$vi[] = $k->village_code;
								#	$kk[] = $k->user_total;
								#	$pen[] = $k->user_current;
									$lk[] = $k->posting_total;
									$pr[] = $k->letter_total;
								}
								?>
							</tbody>
						</table>
						</div>
				
			</div>
		</div>				
	</div>
	
	<div class="col-xs-12 col-sm-6" style='margin-bottom:25px;'>
		<div class="widget-box">
			<div class="widget-header widget-header-flat widget-header-small">
				<h4 class="widget-title blue smaller">
					<i class="ace-icon fa fa-signal orange"></i>
					Grafik Statistik Desa
				</h4>
				<div class="widget-toolbar action-buttons">													
					<a data-action="collapse" href="#">
						<i class="ace-icon fa fa-chevron-up"></i>
					</a>
				</div>
			</div>
			<div class="widget-body">
			<div class="widget-main">	
				<div id='grafik'></div>
			</div>
			</div>
		</div>				
	</div>
</div>



		
<script type="text/javascript" src="<?php echo base_url();?>media/js/jquery-1.9.1.min.js"></script>
<script src="<?php echo base_url();?>media/js/highcharts.js"></script>
<script type="text/javascript">
$(function () {
    $('#grafik').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Grafik Statistik Desa'
        },
        subtitle: {
            text: 'Sumber: <?php echo $this->_setting->app_name; ?>'
        },
        xAxis: {
            categories: <?php echo str_replace('"',"'",json_encode($vi)); ?>,
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Jumlah (Org)'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y}</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        }, 
        series: [{
  //          name: 'Jumlah Pengguna',
  //          data: <?php echo str_replace('"',"",json_encode($kk)); ?>,
  //      }, {
  //          name: 'Pengguna Login',
  //          data: <?php echo str_replace('"',"",json_encode($pen)); ?>,
  //      }, {
            name: 'Jumlah Posting',
            data: <?php echo str_replace('"',"",json_encode($lk)); ?>,
        }, {
            name: 'Jumlah Surat',
            data: <?php echo str_replace('"',"",json_encode($pr)); ?>,
        }]
    });    
});
</script>
<script>
$(document).ready(function() {
	    $('#<?php echo $_id; ?>').DataTable( {
	    	dom: 'T"<clear>"Rfrtip',
		tableTools: {
	        "aButtons": [ 
	        "copy"
	        
	     ]},
		 language: {
            "lengthMenu": "Tampilkan _MENU_ data per halaman",
            "zeroRecords": "Tidak ada data",
            "info": "Tampilkan halaman _PAGE_ dari _PAGES_",
            "infoEmpty": "Tidak ada data tersedia",
            "infoFiltered": "(Difilter dari total _MAX_ data)",
			"search": "<i class='fa fa-filter bigger-120'></i> Filter Data  _INPUT_ ",
			"paginate": {
							"previous": "Sebelumnya",
				            "next": "Berikutnya",
							"last": "Terakhir",
							"first": "Pertama"
				        },
			"lengthMenu": 'Tampilkan <select>'+
			             '<option value="10">10</option>'+
			             '<option value="20">20</option>'+
			             '<option value="30">30</option>'+
			             '<option value="40">40</option>'+
			             '<option value="50">50</option>'+
			             '<option value="-1">All</option>'+
			             '</select> Data',
			"loadingRecords": "Harap Menunggu - loading..."
			}
	    } );
} );
</script>

		