<div class='page-content'>
	<div class="row">
		<div class="col-xs-12">
			<div class="widget-box transparent">
				<div class="widget-header widget-header-small">
					<h4 class="widget-title blue smaller">
						<i class="ace-icon fa fa-exchange orange"></i>
						<?php echo $sub; ?>
					</h4>
					<div class='pull-right'>	
						<a data-rel='tooltip' href='javascript:history.back()' class='btn btn-success btn-white btn-round btn-sm fa fa-arrow-left'  title='Kembali' data-placement='bottom'></a>
						
					</div>
				</div>

			<div class="widget-body ">
				<div class="widget-main padding-8">

				<div id="user-profile-1" class="user-profile row">
				<div class="col-xs-12 col-sm-12">
					<div class="profile-user-info profile-user-info-striped">
						<div class="profile-info-row">
							<div class="profile-info-name" style='width:175px'> User Id </div>
								<div class="profile-info-value">
									<span class="editable"><?php echo $user_id;?></span>
								</div>
						</div>
						<div class="profile-info-row">
							<div class="profile-info-name"> Modul Id </div>
								<div class="profile-info-value">
									<span class="editable"><?php echo $modul_id;?></span>
								</div>
						</div>
						<div class="profile-info-row">
							<div class="profile-info-name"> Aktifitas Terakhir </div>
								<div class="profile-info-value">
									<span class="editable"><?php echo $act_last;?></span>
								</div>
						</div>
						<div class="profile-info-row">
							<div class="profile-info-name"> Waktu </div>
								<div class="profile-info-value">
									<span class="editable"><?php echo empty($act_addtime) ? '' : date('d M Y H:i:s',strtotime($act_addtime));?></span>
								</div>
						</div>						
						<div class="profile-info-row">
							<div class="profile-info-name"> IP / Browser </div>
								<div class="profile-info-value">
									<span class="editable"><?php echo $act_ip.' / '.$act_agent;?></span>
								</div>
						</div>
					</div>
					<div class="hr hr16 dotted"></div>
				</div>
			
				<?php if(!empty($act_rawdata)){
                                        $raws    = json_decode($act_rawdata);
                                        if(is_object($raws)) $xraw[] = $raws;
                                        else $xraw   = $raws;
                                        
					foreach($xraw as $raw){ 
				?>
				<div class="col-xs-12 col-sm-4">
					<div class="profile-user-info profile-user-info-striped" style='padding:10px; margin:5px;'>
					<b>
					<i class="ace-icon fa fa-angle-double-right"></i>
					Raw Data
					</b><br>					
					<?php echo '<pre>'; 
						foreach($raw as $key => $val){
							if($key == 'ps_amount')
								echo $key.' : '.number_format($val,2,'.',',').'<br>';
							else
								echo $key.' : '.$val.'<br>';
						}	
                                            echo '</pre>';
                                            ?>						
					</div>
				</div>
				<?php } } ?>
				
				
			</div>
		</div>
	</div>
	
		</div><!-- col-xs-12 -->
	</div><!-- /.row -->
</div><!-- /.page content -->