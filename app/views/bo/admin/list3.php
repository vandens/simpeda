<div class="widget-box transparent">
	<div class="widget-header widget-header-flat widget-header-small">
		<h4 class="widget-title blue smaller">
			<i class="ace-icon fa fa-signal orange"></i>
			<?php echo $title; ?>
		</h4>
        <!--
		<div class="widget-toolbar action-buttons">													
			<a data-action="collapse" href="#">
				<i class="ace-icon fa fa-chevron-up"></i>
			</a>
		</div>
    -->
	</div>
	<div class="widget-body">
	<div class="widget-main padding-8">
		<div id="list3" style='padding-right:25px'></div>
	</div>
	</div>
</div>


<script type="text/javascript">
$(function () {
    $('#list3').highcharts({
        chart: {
            type: 'areaspline'
        },
        title: {
            text: 'Debet vs Credit <br>Tabungan Siswa'
        },
        legend: {
            layout: 'vertical',
            align: 'left',
            verticalAlign: 'top',
            x: 10000000,
            y: 100,
            floating: true,
            borderWidth: 1,
            backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'
        },
        xAxis: {
            categories: [<?php echo $kategori; ?>],
            plotBands: [{ // visualize the weekend
                from: 4.5,
                to: 6.5,
                color: 'rgba(68, 170, 213, .2)'
            }]
        },
        yAxis: {
            title: {
                text: 'Rupiah'
            }
        },
        tooltip: {
            shared: true,
            valueSuffix: ''
        },
        credits: {
            enabled: true
        },
        plotOptions: {
            areaspline: {
                fillOpacity: 0.5
            }
        },
        series: [{
            name: 'Credit',
            data: [<?php echo $credit; ?>]
        }, {
            name: 'Debet',
            data: [<?php echo $debet; ?>]
        }]
    });
});
</script>