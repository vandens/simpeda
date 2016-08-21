<div class="widget-box transparent">
	<div class="widget-header widget-header-flat widget-header-small">
		<h4 class="widget-title blue smaller">
			<i class="ace-icon fa fa-users blue"></i>
			Data Penduduk Desa <?php echo $this->session->userdata('village_name'); ?>
		</h4>
	</div>
	<div class="widget-body">
		<div class="widget-main padding-8">
													
			<div class="center">
			<!--
				<span class="btn btn-app btn-sm btn-light no-hover">
					<span class="line-height-1 bigger-170 blue"> 1,411 </span>
					<br>
					<span class="line-height-1 smaller-90"> Views </span>
				</span>
				<span class="btn btn-app btn-sm btn-yellow no-hover">
					<span class="line-height-1 bigger-170"> 32 </span>
					<br>
					<span class="line-height-1 smaller-90"> Followers </span>
				</span>
			-->
				<span class="btn btn-app btn-sm  btn-pink no-hover">
					<span class="line-height-1 bigger-230"> <?php echo $data->total_kk; ?> </span>
					<br>
					<span class="line-height-1 smaller-90"> Keluarga </span>
				</span>
				<span class="btn btn-app btn-sm btn-danger no-hover">
					<span class="line-height-1 bigger-230"> <?php echo $data->total_penduduk; ?> </span>
					<br>
					<span class="line-height-1 smaller-90"> Penduduk </span>
				</span>
				<span class="btn btn-app btn-sm btn-success no-hover">
					<span class="line-height-1 bigger-230"> <?php echo $data->L; ?> </span>
					<br>
					<span class="line-height-1 smaller-90"> Laki-laki </span>
				</span>
				<span class="btn btn-app btn-sm btn-primary no-hover">
					<span class="line-height-1 bigger-230"> <?php echo $data->P; ?> </span>
					<br>
					<span class="line-height-1 smaller-90"> Perempuan </span>
				</span>
			</div>

		</div>
	</div>
</div>
