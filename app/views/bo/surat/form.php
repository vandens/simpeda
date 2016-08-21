
<form class="form-horizontal" id='form' method='post' action="<?php echo base_url($this->router->fetch_class().'/'.$val); ?>" role="form">										
				<div class="widget-box transparent">
					<div class="widget-header widget-header-small">
					<h4 class="widget-title smaller">
						<i class="ace-icon fa fa-check-square-o bigger-110"></i>
							<?php echo $sub; ?>
					</h4>
					<div class='pull-right'>	
						<a data-rel='tooltip' href='javascript:history.back()' class='btn btn-success btn-white btn-round btn-sm fa fa-arrow-left'  title='Kembali' data-placement='bottom'></a>
						<?php echo ($this->_priv->SURC || $this->_priv->SURU) ? "<button data-rel='tooltip' type='submit' name='submit' value='".$val."'  class='btn btn-danger btn-white btn-round btn-sm fa ace-icon fa fa-share-square-o'  title='Konfirmasi' data-placement='bottom'></button>" : ''; ?>
					</div>
					</div>
						<div class="widget-body" id='template'>
							<?php echo $template; ?>	
							<?php if($letter_code == 'LET12'){
										echo $resident2;
										echo $resident3;
										echo $resident1;
										echo $resident4;
							}else{
										echo $resident1;
										echo $resident2;
										echo $resident3;
										echo $resident4;						
							}	
							?>
						</div>


					
					</div>
				</div>	
		<input type='hidden' name='key' value='<?php echo $resident_no; ?>'>
	</form>
	<?php echo $modal; ?>

	<script>
	function set_template(key){
		$.ajax({ 
	        url     : '<?php echo base_url($this->router->fetch_class().'/popdata/template');?>',
	        type    : 'post',
	        data    : 'key='+key,
	        success : function(param){
	        	$('#form').html(param);
	        },
	        error   : function(param){
				show_alert('.alert','danger','Exception : Maaf, terjadi kesalahan!');
	        }
    	});
	}

	function set_template_backup(key){
		$.ajax({ 
	        url     : '<?php echo base_url($this->router->fetch_class().'/popdata/template');?>',
	        type    : 'post',
	        data    : 'key='+key,
	        success : function(param){
	        	var obj = eval('('+param+')');
	        	$("#letter_code").val(obj.set_id);
	        	$("#letter_name").val(obj.set_value);
	        	$("#letter_id").val(obj.set_order);

				$('#data2').css('display','none');				
				$('#data3').css('display','none');	

				$('#set1').html(obj.header_set1);
				$('#set2').html(obj.header_set2);
				$('#set3').html(obj.header_set3);

	        	if(obj.tampil == 2){
	        		$('#data'+obj.tampil).css('display','inline');	        	
	        	}else if(obj.tampil == 3){
	        		$('#data2').css('display','inline');	        		
	        		$('#data3').css('display','inline');
	        	}

	        },
	        error   : function(param){
				show_alert('.alert','danger','Exception : Maaf, terjadi kesalahan!');
	        }
    	});
	}

	function set_resident(key,pos){
		
		$.ajax({ 
	        url     : '<?php echo base_url($this->router->fetch_class().'/popdata/resident');?>',
	        type    : 'post',
	        data    : 'key='+key+'&letter_code='+$('#letter_code').val(),
	        success : function(param){
	        	if($('#letter_code').val() == 'LET16')
		        	set_16(param);
		        else if($('#letter_code').val() == 'LET14')
		        	set_14(param,pos);
		        else
	        		set_global(param,pos);
	        	
	        	
	        },
	        error   : function(param){
				show_alert('.alert','danger','Exception : Maaf, terjadi kesalahan!');
	        }
    	});
	}

	function set_global(param,pos){
	    var obj = eval('('+param+')');
		$("#resident_no"+pos).val(obj.resident_no);
	    $("#res_no"+pos).html(obj.resident_no);
	    $("#resident_name"+pos).html(obj.resident_name);
	   	$("#resident_sex"+pos).html(obj.resident_sex);
	   	$("#resident_bday"+pos).html(obj.resident_bplace+', '+obj.resident_bday);
	   	$("#resident_job"+pos).html(obj.resident_job);
	   	$("#resident_address"+pos).html(obj.resident_address);
	   	$("#alamat_usaha").val(obj.resident_address); // buat temp 20
	}
	function set_16(param){
	    var obj = eval('('+param+')');
		$(".resident_no").val(obj.resident_no);
	    $(".resident_name").val(obj.resident_name);
	   	$(".resident_sex").val(obj.resident_sex);
	   	$(".resident_bday").val(obj.resident_bplace+', '+obj.resident_bday);
	   	$(".resident_of").val(obj.resident_of);
	   	$(".resident_religion").val(obj.resident_religion);
	   	$(".resident_job").val(obj.resident_job);
	   	$(".resident_address").val(obj.resident_address);
	}
	
	function set_14(param,pos){
	    var obj = eval('('+param+')');
			$("#resident_no"+pos).val(obj.resident_no);
	    $("#resident_name"+pos).val(obj.resident_name);
	   	$("#resident_bplace"+pos).val(obj.resident_bplace);
	   	$("#resident_bday"+pos).val(obj.resident_bday);
	   	$("#resident_of"+pos).val(obj.resident_of);
	   	$("#resident_religion"+pos).val(obj.resident_religion);
	   	$("#resident_job"+pos).val(obj.resident_job);
	   	$("#resident_address"+pos).val(obj.resident_address);
	}

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
			});

	</script>