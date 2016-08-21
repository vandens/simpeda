
		<!-- basic scripts -->

		<!--[if !IE]> -->
		<script type="text/javascript">
			window.jQuery || document.write("<script src='<?php echo base_url(); ?>media/js/jquery.js'>"+"<"+"/script>");
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
		<script src="<?php echo base_url(); ?>media/js/jquery.js"></script>
		<script src="<?php echo base_url(); ?>media/js/bootstrap.js"></script>
		<script src="<?php echo base_url(); ?>media/js/date-time/bootstrap-datepicker.js"></script>
		
		<!--
		<script src="<?php echo base_url(); ?>media/js/jquery-ui.custom.js"></script>
		<script src="<?php echo base_url(); ?>media/js/jquery.ui.touch-punch.js"></script>
		<script src="<?php echo base_url(); ?>media/js/chosen.jquery.js"></script>
		<script src="<?php echo base_url(); ?>media/js/fuelux/fuelux.spinner.js"></script>
		<script src="<?php echo base_url(); ?>media/js/date-time/bootstrap-timepicker.js"></script>
		<script src="<?php echo base_url(); ?>media/js/date-time/moment.js"></script>
		<script src="<?php echo base_url(); ?>media/js/date-time/daterangepicker.js"></script>
		<script src="<?php echo base_url(); ?>media/js/date-time/bootstrap-datetimepicker.js"></script>
		<script src="<?php echo base_url(); ?>media/js/bootstrap-colorpicker.js"></script>
		<script src="<?php echo base_url(); ?>media/js/jquery.knob.js"></script>
		<script src="<?php echo base_url(); ?>media/js/jquery.autosize.js"></script>
		<script src="<?php echo base_url(); ?>media/js/jquery.inputlimiter.1.3.1.js"></script>
		<script src="<?php echo base_url(); ?>media/js/jquery.maskedinput.js"></script>
		<script src="<?php echo base_url(); ?>media/js/bootstrap-tag.js"></script>
		-->

		<script src="<?php echo base_url(); ?>media/js/jquery.gritter.js"></script>
		<!-- ace scripts -->
		<script src="<?php echo base_url(); ?>media/js/ace/elements.scroller.js"></script>
		<script src="<?php echo base_url(); ?>media/js/ace/elements.colorpicker.js"></script>
		<script src="<?php echo base_url(); ?>media/js/ace/elements.fileinput.js"></script>
		<script src="<?php echo base_url(); ?>media/js/ace/elements.typeahead.js"></script>
		<script src="<?php echo base_url(); ?>media/js/ace/elements.wysiwyg.js"></script>
		<script src="<?php echo base_url(); ?>media/js/ace/elements.spinner.js"></script>
		<script src="<?php echo base_url(); ?>media/js/ace/elements.treeview.js"></script>
		<script src="<?php echo base_url(); ?>media/js/ace/elements.wizard.js"></script>
		<script src="<?php echo base_url(); ?>media/js/ace/elements.aside.js"></script>
		<script src="<?php echo base_url(); ?>media/js/ace/ace.js"></script>
		<script src="<?php echo base_url(); ?>media/js/ace/ace.ajax-content.js"></script>
		<script src="<?php echo base_url(); ?>media/js/ace/ace.touch-drag.js"></script>
		<script src="<?php echo base_url(); ?>media/js/ace/ace.sidebar.js"></script>
		<script src="<?php echo base_url(); ?>media/js/ace/ace.sidebar-scroll-1.js"></script>
		<script src="<?php echo base_url(); ?>media/js/ace/ace.submenu-hover.js"></script>
		<script src="<?php echo base_url(); ?>media/js/ace/ace.widget-box.js"></script>
		<script src="<?php echo base_url(); ?>media/js/ace/ace.settings.js"></script>
		<script src="<?php echo base_url(); ?>media/js/ace/ace.settings-rtl.js"></script>
		<script src="<?php echo base_url(); ?>media/js/ace/ace.settings-skin.js"></script>
		<script src="<?php echo base_url(); ?>media/js/ace/ace.widget-on-reload.js"></script>
		<script src="<?php echo base_url(); ?>media/js/ace/ace.searchbox-autocomplete.js"></script>
		<script src="<?php echo base_url(); ?>media/js/van_ajax.js"></script>
		<script src="<?php echo base_url(); ?>media/js/fungsi.js"></script>



		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			jQuery(function($) {
				//date picker
				$('.date-picker').datepicker({
					autoclose: true,
					todayHighlight: true
				})
				//show datepicker when clicking on the icon
				.next().on(ace.click_event, function(){
					$(this).prev().focus();
				});

			 var $sidebar = $('.sidebar').eq(0);
			 if( !$sidebar.hasClass('h-sidebar') ) return;
			
			 $(document).on('settings.ace.top_menu' , function(ev, event_name, fixed) {
				if( event_name !== 'sidebar_fixed' ) return;
			
				var sidebar = $sidebar.get(0);
				var $window = $(window);
			
				//return if sidebar is not fixed or in mobile view mode
				var sidebar_vars = $sidebar.ace_sidebar('vars');
				if( !fixed || ( sidebar_vars['mobile_view'] || sidebar_vars['collapsible'] ) ) {
					$sidebar.removeClass('lower-highlight');
					//restore original, default marginTop
					sidebar.style.marginTop = '';
			
					$window.off('scroll.ace.top_menu')
					return;
				}
			
			
				 var done = false;
				 $window.on('scroll.ace.top_menu', function(e) {
			
					var scroll = $window.scrollTop();
					scroll = parseInt(scroll / 4);//move the menu up 1px for every 4px of document scrolling
					if (scroll > 17) scroll = 17;
			
			
					if (scroll > 16) {			
						if(!done) {
							$sidebar.addClass('lower-highlight');
							done = true;
						}
					}
					else {
						if(done) {
							$sidebar.removeClass('lower-highlight');
							done = false;
						}
					}
			
					sidebar.style['marginTop'] = (17-scroll)+'px';
				 }).triggerHandler('scroll.ace.top_menu');
			
			 }).triggerHandler('settings.ace.top_menu', ['sidebar_fixed' , $sidebar.hasClass('sidebar-fixed')]);
			
			 $(window).on('resize.ace.top_menu', function() {
				$(document).triggerHandler('settings.ace.top_menu', ['sidebar_fixed' , $sidebar.hasClass('sidebar-fixed')]);
			 });
			
			
			});
		</script>