
<!-- basic scripts -->
<!--[if !IE]> -->
<script src="<?php echo base_url()?>media/js/jquery_002.js"></script>
<!-- <![endif]-->

<!--[if IE]>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<![endif]-->

<!--[if !IE]> -->
<script type="text/javascript">
	window.jQuery || document.write("<script src='media/js/jquery.min.js'>"+"<"+"/script>");
</script>
<!-- <![endif]-->

<!--[if IE]>
<script type="text/javascript">
 window.jQuery || document.write("<script src='media/js/jquery1x.min.js'>"+"<"+"/script>");
</script>
<![endif]-->
<script type="text/javascript">
	if('ontouchstart' in document.documentElement) document.write("<script src='media/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
</script>

<!-- page specific plugin scripts -->
<script src="<?php echo base_url()?>media/js/jquery_lightbox.js"></script>
<!-- inline scripts related to this page -->
<script type="text/javascript">
jQuery(function($) {
	var $overflow = '';
	var colorbox_params = {
		rel: 'colorbox',
		reposition:true,
		scalePhotos:true,
		scrolling:false,
		previous:'<i class="ace-icon fa fa-arrow-left"></i>',
		next:'<i class="ace-icon fa fa-arrow-right"></i>',
		close:'&times;',
		current:'{current} of {total}',
		maxWidth:'100%',
		maxHeight:'100%',
		onOpen:function(){
			$overflow = document.body.style.overflow;
			document.body.style.overflow = 'hidden';
		},
		onClosed:function(){
			document.body.style.overflow = $overflow;
		},
		onComplete:function(){
			$.colorbox.resize();
		}
	};

	$('.ace-thumbnails [data-rel="colorbox"]').colorbox(colorbox_params);
	$("#cboxLoadingGraphic").html("<i class='ace-icon fa fa-spinner orange'></i>");//let's add a custom loading icon
})
</script>
	

<div style="display: none;" id="cboxOverlay"></div>
<div style="display: none;" tabindex="-1" role="dialog" class="" id="colorbox">
	<div id="cboxWrapper">
		<div>
			<div style="float: left;" id="cboxTopLeft"></div>
			<div style="float: left;" id="cboxTopCenter"></div>
			<div style="float: left;" id="cboxTopRight"></div>
		</div>
		<div style="clear: left;">
			<div style="float: left;" id="cboxMiddleLeft"></div>
				<div style="float: left;" id="cboxContent">
					<div class='thumbnails'>
						<div style="float: left;" id="cboxTitle"></div>
						<div style="float: left;" id="cboxCurrent"></div>
							<button id="cboxPrevious" type="button"></button>
							<button id="cboxNext" type="button"></button>
							<button id="cboxSlideshow"></button>
						<div style="float: left;" id="cboxLoadingOverlay"></div>
						<div style="float: left;" id="cboxLoadingGraphic">
							<i class="ace-icon fa fa-spinner orange"></i>
						</div>
					
					</div>
				</div>
			<div style="float: left;" id="cboxMiddleRight"></div>
		</div>
		<div style="clear: left;">
			<div style="float: left;" id="cboxBottomLeft"></div>
			<div style="float: left;" id="cboxBottomCenter"></div>
			<div style="float: left;" id="cboxBottomRight"></div>
		</div>
	</div>
	<div style="position: absolute; width: 9999px; visibility: hidden; display: none; max-width: none;"></div>
</div>