<div class="widget-box">
	<div class="widget-header widget-header-flat widget-header-small">
		<h4 class="widget-title blue smaller">
			<i class="ace-icon fa fa-signal orange"></i>
			<?php echo $title; ?>
		</h4>
		<div class="widget-toolbar action-buttons">													
			<a data-action="collapse" href="#">
				<i class="ace-icon fa fa-chevron-up"></i>
			</a>
		</div>
	</div>
	<div class="widget-body">
	<div class="widget-main padding-8">
		<div id="list4" style='padding-right:25px'></div>
		
	</div>
	</div>
</div>


<script type="text/javascript">
$(function () {
    $('#list4').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: '<?php echo $title; ?>'
        },
        subtitle: {
            text: 'Source: <?php echo $this->session->userdata('instansi'); ?>'
        },
        xAxis: {
            type: 'category',
            labels: {
                rotation: -45,
                style: {
                    fontSize: '10px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Jumlah Credit (Rp)'
            }
        },
        legend: {
            enabled: false
        },
        tooltip: {
            pointFormat: 'Total Transaksi : <b>Rp {point.y:.2f}</b>'
        },
        series: [{
            name: 'Population',
            data: [ <?php echo $data; ?> ],
            dataLabels: {
                enabled: false,
                rotation: -90,
                color: '#FFFFFF',
                align: 'right',
                format: '{point.y:.1f}', // one decimal
                y: 10, // 10 pixels down from the top
                style: {
                    fontSize: '12px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        }]
    });
});
</script>