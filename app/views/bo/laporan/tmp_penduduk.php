<div class='row'>
	<div class="col-xs-12 col-sm-7" style='margin-bottom:25px'>
		<div class="widget-box transparent">
			<div class="widget-header widget-header-flat widget-header-small">
				<h4 class="widget-title blue smaller">
					<i class="ace-icon fa fa-users orange"></i>
					Data Statistik Penduduk Per Desa
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
									$kk[] = $k->total_kk;
									$pen[] = $k->total_penduduk;
									$lk[] = $k->L;
									$pr[] = $k->P;
								}
								?>
							</tbody>
						</table>
						</div>
				
			</div>
		</div>				
	</div>
	
	<div class="col-xs-12 col-sm-5" style='margin-bottom:25px;'>
		<div class="widget-box">
			<div class="widget-header widget-header-flat widget-header-small">
				<h4 class="widget-title blue smaller">
					<i class="ace-icon fa fa-signal orange"></i>
					Grafik Statistik Penduduk per Desa
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

<div class="col-xs-12 col-sm-6" style='margin-bottom:25px;'>
		<div class="widget-box">
			<div class="widget-header widget-header-flat widget-header-small">
				<h4 class="widget-title blue smaller">
					<i class="ace-icon fa fa-signal orange"></i>
					Grafik Penduduk Berdasarkan Jenis Pekerjaan
				</h4>
				<div class="widget-toolbar action-buttons">													
					<a data-action="collapse" href="#">
						<i class="ace-icon fa fa-chevron-up"></i>
					</a>
				</div>
			</div>
			<div class="widget-body">
			<div class="widget-main">	
				<div id='job'></div>
			</div>
			</div>
		</div>				
</div>

<div class="col-xs-12 col-sm-6" style='margin-bottom:25px;'>
		<div class="widget-box">
			<div class="widget-header widget-header-flat widget-header-small">
				<h4 class="widget-title blue smaller">
					<i class="ace-icon fa fa-signal orange"></i>
					Grafik Pemeluk Agama
				</h4>
				<div class="widget-toolbar action-buttons">													
					<a data-action="collapse" href="#">
						<i class="ace-icon fa fa-chevron-up"></i>
					</a>
				</div>
			</div>
			<div class="widget-body">
			<div class="widget-main">	
				<div id='agama'></div>
			</div>
			</div>
		</div>				
</div>

<div class="col-xs-12 col-sm-12" style='margin-bottom:25px;'>
		<div class="widget-box">
			<div class="widget-header widget-header-flat widget-header-small">
				<h4 class="widget-title blue smaller">
					<i class="ace-icon fa fa-signal orange"></i>
					Grafik Angka Kelahiran dan Kematian
				</h4>
				<div class="widget-toolbar action-buttons">													
					<a data-action="collapse" href="#">
						<i class="ace-icon fa fa-chevron-up"></i>
					</a>
				</div>
			</div>
			<div class="widget-body">
			<div class="widget-main">	
				<div id='kelahiran'></div>
			</div>
			</div>
		</div>				
</div>



<!--
<div class="col-xs-12 col-sm-6" style='margin-bottom:25px;'>
		<div class="widget-box">
			<div class="widget-header widget-header-flat widget-header-small">
				<h4 class="widget-title blue smaller">
					<i class="ace-icon fa fa-signal orange"></i>
					Grafik Status Penduduk
				</h4>
				<div class="widget-toolbar action-buttons">													
					<a data-action="collapse" href="#">
						<i class="ace-icon fa fa-chevron-up"></i>
					</a>
				</div>
			</div>
			<div class="widget-body">
			<div class="widget-main">	
				<div id='status_penduduk'></div>
			</div>
			</div>
		</div>				
</div>
-->
		
<script type="text/javascript" src="<?php echo base_url();?>media/js/jquery-1.9.1.min.js"></script>
<script src="<?php echo base_url();?>media/js/highcharts.js"></script>
<script src="<?php echo base_url();?>media/js/highcharts-more.js"></script>
<script type="text/javascript">
 $(function () {
    $('#grafik').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Grafik Statistik Penduduk per Desa'
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
            name: 'Jumlah Kepala Keluarga',
            data: <?php echo str_replace('"',"",json_encode($kk)); ?>,
        }, {
            name: 'Jumlah Penduduk',
            data: <?php echo str_replace('"',"",json_encode($pen)); ?>,
        }, {
            name: 'Laki-laki',
            data: <?php echo str_replace('"',"",json_encode($lk)); ?>,
        }, {
            name: 'Perempuan',
            data: <?php echo str_replace('"',"",json_encode($pr)); ?>,
        }]
    });    
});
</script>

<script type="text/javascript">
	$(function () {
	    $('#job').highcharts({
	        chart: {
	            type: 'column'
	        },
	        title: {
	            text: 'Grafik Penduduk Berdasarkan Jenis Pekerjaan di Desa <?php echo $this->session->userdata("village_name"); ?>'
	        },
	        subtitle: {
	            text: 'Sumber: <?php echo $this->_setting->app_name; ?>'
	        },
	        xAxis: {
	            categories: <?php echo str_replace('"',"'",json_encode($resident_job)); ?>,
	            crosshair: true
	        },
	        yAxis: {
	            min: 0,
	            title: {
	                text: 'Jumlah Orang'
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
	            name: 'Jumlah Orang',
	            data: <?php echo str_replace('"',"",json_encode($total)); ?>,
	        }]
	    });    
	});
	</script>
			<script type="text/javascript">
			$(function () {
			    $('#kelahiran').highcharts({
			        chart: {
			            type: 'area'
			        },
			        title: {
			            text: 'Grafik Angka Kelahiran dan Kematian di Desa <?php echo $this->session->userdata("village_name"); ?>'
			        },
			        subtitle: {
			            text: 'Sumber: <?php echo $this->_setting->app_name; ?>'
			        },
			        xAxis: {
			            allowDecimals: false,
			            labels: {
			                formatter: function () {
			                    return this.value; // clean, unformatted number for year
			                }
			            }
			        },
			        yAxis: {
			            title: {
			                text: 'Jumlah Jiwa'
			            },
			            labels: {
			                formatter: function () {
			                    //return this.value / 1000 + 'k';
			                    return this.value;
			                }
			            }
			        },
			        tooltip: {
			            pointFormat: 'Angka {series.name} <b>{point.y:,.0f}</b><br/>di Tahun {point.x}'
			        },
			        plotOptions: {
			            area: {
			                pointStart: 1990,
			                marker: {
			                    enabled: false,
			                    symbol: 'circle',
			                    radius: 2,
			                    states: {
			                        hover: {
			                            enabled: true
			                        }
			                    }
			                }
			            }
			        },
			        series: [{
			            name: 'Kelahiran',
			            data: <?php echo $kelahiran; ?>
			        }, {
			            name: 'Kematian',
			            data: [5,2,8,1,2,2,4,2,1,15,14,6,8,15,9,7,12,2,18,2,1,2,1,45,22,20,40]
			        }]
			    });
			});
		</script>
		<script type="text/javascript">
		$(function () {
		    $('#agama').highcharts({
		        chart: {
		            plotBackgroundColor: null,
		            plotBorderWidth: null,
		            plotShadow: false,
		            type: 'pie'
		        },
		        title: {
		            text: 'Grafik Pemeluk Agama di Desa <?php echo $this->session->userdata("village_name"); ?>, Total Penduduk 1232 Jiwa'
		        },
		        tooltip: {
		            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
		        },
		        plotOptions: {
		            pie: {
		                allowPointSelect: true,
		                cursor: 'pointer',
		                dataLabels: {
		                    enabled: true,
		                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
		                    style: {
		                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
		                    }
		                }
		            }
		        },
		        series: [{
		            name: 'Persentase',
		            colorByPoint: true,
		            data: [{
		                name: 'Islam',
		                y: <?php echo $agama['Islam']; ?>
		            }, {
		                name: 'Katolik',
		                y: <?php echo $agama['Katolik']; ?>,
		                sliced: true,
		                selected: true
		            }, {
		                name: 'Protestan',
		                y: <?php echo $agama['Protestan']; ?>
		            }, {
		                name: 'Hindu',
		                y: <?php echo $agama['Hindu']; ?>
		            }, {
		                name: 'Budha',
		                y: <?php echo $agama['Budha']; ?>
		            }, {
		                name: 'Konghucu',
		                y: <?php echo $agama['Konghucu']; ?>
		            }]
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
