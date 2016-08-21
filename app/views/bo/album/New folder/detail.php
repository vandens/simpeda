<link rel="stylesheet" href="<?php echo base_url()?>media/css/colorbox.css">
<link rel="stylesheet" href="<?php echo base_url()?>media/css/css.css">
<link rel="stylesheet" href="<?php echo base_url()?>media/css/ace.css" id="main-ace-style">
<div class='page-content'>
	<div class="page-header">
		<div class='pull-right'>	
			<a href='javascript:history.back()' class='btn btn-success btn-white btn-round btn-sm fa fa-arrow-left' data-rel='tooltip' data-placement='bottom' title='Kembali'></a>
		</div>
		<h1>
			<i class="ace-icon fa fa-home home-icon"></i>
			<a href="<?php echo base_url();?>">Home</a> 
				<small>
					<i class="ace-icon fa fa-angle-double-right"></i>
					<?php echo $this->_pghead; ?>
					<i class="ace-icon fa fa-angle-double-right"></i> <?php echo $this->_pgdesc; ?>
				</small>
		</h1>
	</div><!-- /.page-header -->
	<div class="row">
		<div class="col-xs-12 col-sm-12">
			<div class="widget-box transparent">
				<div class="widget-header widget-header-small">
					<h4 class="widget-title blue smaller">
						<i class="ace-icon fa fa-image orange"></i>
						<?php echo $this->_pgdesc; ?>
					</h4>
				</div>

			<div class="widget-body ">
				<div class="widget-main padding-8">
					<div class="profile-user-info profile-user-info-striped">
						<div class="profile-info-row">
							<div class="profile-info-name"  style='width:150px'> Judul Album </div>
							<div class="profile-info-value">
								<span class="editable" id="buser_id"><?php echo $alb_name;?></span>
							</div>
						</div>
						<div class="profile-info-row">
							<div class="profile-info-name"  style='width:150px'> Tempat, Waktu </div>
							<div class="profile-info-value">
								<span class="editable" id="buser_id"><?php echo $alb_taken.' '.date('d M Y',strtotime($alb_taken_date));?></span>
							</div>
						</div>
						<div class="profile-info-row">
							<div class="profile-info-name"  style='width:150px'> Publis </div>
							<div class="profile-info-value">
								<span class="editable" id="buser_id"><?php echo $alb_ispublish;?></span>
							</div>
						</div>
						<div class="profile-info-row">
							<div class="profile-info-name"  style='width:150px'> Status </div>
							<div class="profile-info-value">
								<span class="editable" id="buser_id"><?php echo $this->config->item('user_'.$alb_status);?></span>
							</div>
						</div>
				
					</div>
				</div>					
				<ul class="ace-thumbnails clearfix">
				<?php foreach($sql as $row){?>			
					<li>
						<a class="cboxElement" href="<?php echo base_url('media/album/'.$alb_id.'/'.$row->alb_filename)?>" data-rel="colorbox">
							<img alt="150x150" src="<?php echo base_url('media/album/'.$alb_id.'/'.$row->alb_filename)?>" height="150" width="150">
							<div class="text">
								<div class="inner"><?php echo $row->alb_desc;?></div>
							</div>
						</a>											
					</li>
				<?php } ?>		
				</ul>			
										
			</div>
		</div>
	</div><!-- /.col -->
</div><!-- /.row -->
</div>
<?php echo $this->load->view('album/lightbox');?>