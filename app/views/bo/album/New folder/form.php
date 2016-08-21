<link rel="stylesheet" href="<?php echo base_url()?>media/css/colorbox.css">
<link rel="stylesheet" href="<?php echo base_url()?>media/css/css.css">
<link rel="stylesheet" href="<?php echo base_url()?>media/css/ace.css" id="main-ace-style">
<div class='page-content'>
	<div class="page-header">
		<h1>
		<i class="ace-icon fa fa-home home-icon"></i>
			<a href="#">Home</a> 
		<small>
		<i class="ace-icon fa fa-angle-double-right"></i>
		<?php echo $this->_pghead; ?>
			<i class="ace-icon fa fa-angle-double-right"></i> <?php echo $this->_pgdesc; ?>
		</small>
		</h1>
	</div>
	<div class='row'>		
		<div class="col-xs-12">		
		<div class="alert no-margin" style='display:none'><?php echo ($this->session->flashdata('msg')) ? $this->session->flashdata('msg') : ''; ?></div>
				
			<form class="form-horizontal" id='form' method="post" enctype="multipart/form-data" action="<?php echo base_url($this->router->fetch_class().'/action/simpan'); ?>" role="form">										
			
			<input type='hidden' name='key' value='<?php echo $key; ?>'>
				<div class="widget-box transparent">
					<div class="widget-header widget-header-flat widget-header-small">
						<h4 class="widget-title smaller">
							<i class="ace-icon fa fa-cog orange"></i>
								<?php echo $this->_pghead;?>
						</h4>
							<div class='pull-right'>	
								<a href='javascript:history.back()' class='btn btn-success btn-white btn-round btn-sm fa fa-arrow-left' data-rel='tooltip' title='Kembali' data-placement='bottom'></a>
								<?php echo ($C || $U) ? "<button type='submit' name='submit' value='".$val."' class='btn btn-primary btn-round btn-white  btn-sm fa fa-save' data-rel='tooltip' data-placement='bottom' title='".$val."'></button>" : ''; ?>
							</div>
					</div>	
					<div class="widget-body">
						<div class="widget-main">
						<div class='alert alert-danger' style='display:none'><?php echo validation_errors(); ?></div>
						
							<div class='row'>
								<div class='col-xs-12 col-sm-12'>	
									<div class='row'>										
										<div class="form-group">
											<label class="col-sm-2"> Nama Album</label>
											<div class="col-sm-10">						
												<input type='text' class='col-xs-12 col-sm-10' id='alb_name' name='alb_name' placeholder='Judul' value='<?php echo $alb_name;?>'  required onkeypress='return AlfaNum(event);'>
											</div>
										</div>					
										<div class="form-group">
											<label class="col-sm-2"> Diambil Pada</label>
											<div class="col-sm-2">						
												<div class="input-group">
													<input class="form-control date-picker col-xs-6" name='alb_taken_date' value='<?php echo $alb_taken_date; ?>' type="text" data-date-format="yyyy-mm-dd" onkeypress='this.value=ignoreSpaces(this.value); return DateFormat(event);'>
													<span class="input-group-addon">
														<i class="fa fa-calendar bigger-110"></i>
													</span>
												</div>
											</div>
											<label class="col-sm-1"> Lokasi </label>
											<div class="col-sm-3">
												<div class="">						
													<input class="form-control" name='alb_taken' value='<?php echo $alb_taken; ?>' type="text" onkeypress='return AlfaNum(event);'>
												</div>
											</div>
							
											<label class="col-sm-1"> Publis </label>
											<div class="col-sm-3">
												<div class="">						
													<?php
													$ispub = array('Y'=>'Ya','N'=>'Tidak');
													echo form_dropdown('alb_ispublish', $ispub, $alb_ispublish,'class=""');?>
												</div>
											</div>
											
										</div>
											
													
									
									</div>					
								</div>						
								
								<?php if($val == 'update'){?>
								<ul class="ace-thumbnails clearfix">
								<?php foreach($sql as $row){?>			
									<li>
										<?php 
										$foto 		= base_url('media/album/'.$alb_id.'/'.$row->alb_filename);
									  	$foto 		= (file_exists(FCPATH.'media/album/'.$alb_id.'/'.$row->alb_filename)) ? $foto : base_url('media/images/no-image.jpg');
										
										$file 		= $this->mgeneral->getFileName($row->alb_filename);
									  	$thumb 		= base_url('media/album/'.$alb_id.'/'.$file['thumbnail']);
									  	$thumb 		= (file_exists(FCPATH.'media/album/'.$alb_id.'/'.$file['thumbnail'])) ? $thumb : base_url('media/images/no-image.jpg');
				
									  	?>
										<a class="cboxElement" href="<?php echo $foto; ?>" data-rel="colorbox">
											<img alt="" src="<?php echo $thumb; ?>" height="150" width="150">
											<div class="text">
												<div class="inner"><?php echo $row->alb_desc;?></div>
											</div>
										</a>						
										<div class="tools tools-bottom">
											<a href="#"><i class="ace-icon fa fa-link"></i></a>
											<a href="#"><i class="ace-icon fa fa-paperclip"></i></a>
											<a href="#"><i class="ace-icon fa fa-pencil"></i></a>
											<a href="<?php echo base_url('album/hapus/'.$row->auto);?>"><i class="ace-icon fa fa-times red"></i></a>
										</div>											
									</li>
								<?php } ?>	
								
									<li data-rel='tooltip' title='Upload Foto' data-placement='right' class='btn btn-success' style='cursor:pointer;'>
										<div class='col-sm-3 col-xs-4 center' data-toggle="modal" role="button" href="#modal-form">
											<span class='fa fa-plus bigger-220'></span>					
										</div>
									</li>	
								</ul>
								<?php } ?>
								
							</div>	
						</div>
					</div>
				</div>
			</form>


		</div>
	</div>
</div>
<?php echo $this->load->view('temp/form_foto');?>
<?php echo $this->load->view('album/lightbox');?>
