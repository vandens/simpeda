<div class='col-sm-12'>
	<h3 class="header smaller lighter red">Data Monografi <?php echo $sub; ?></h3>
	<div class="tabbable tabs-left">
		<ul class="nav nav-tabs" id="myTab3">
				<div class='row'>
					<div class="col-sm-12 center">
						<span class="profile-picture">
						<img id="avatar" src="<?php echo base_url(); ?>media/avatars/profile-pic.jpg" alt="Alex's Avatar"></img>
						</span>
						<div class="width-80 label label-info label-xlg arrowed-in arrowed-in-right"><?php echo $data->profil->nama_kades; ?></div>
					</div><!-- /.col -->
				</div>
				<span class='spaced6'></span>
			</br>


			<li class="active">
				<a data-toggle="tab" href="#profil">
					<i class="pink ace-icon fa fa-info bigger-110"></i>
					Profil
				</a>
			</li>
			<li>
				<a data-toggle="tab" href="#wilayah">
					<i class="pink ace-icon fa fa-tachometer bigger-110"></i>
					Luas dan Batas Wilayah
				</a>
			</li>
			<li>
				<a data-toggle="tab" href="#pertanahan">
					<i class="blue ace-icon fa fa-road bigger-110"></i>
					Pertanahan
				</a>
			</li>
			<li>
				<a data-toggle="tab" href="#bangunan">
					<i class="ace-icon fa fa-university"></i>
					Pembangunan
				</a>
			</li>
			<li>
				<a data-toggle="tab" href="#kependudukan">
					<i class="purple ace-icon fa fa-users"></i>
					Kependudukan
				</a>
			</li>
		</ul>

		<div class="tab-content">

			<?php 
			$no = 1; 
			if(count($data) > 0){
			foreach($data as $key => $val){ ?>
			<div id="<?php echo $key; ?>" class="tab-pane in <?php echo ($key == 'profil') ? 'active' : ''; ?>" style='min-height:400px'>
			<h4 class="header smaller lighter red"><?php echo ucwords($key); ?></h4>
				
				<?php 
					if($key == 'profil'){
						echo get_li($data->profil,'check-square-o purple','ol');
					}elseif($key == 'wilayah'){

						echo '<ol class="spaced6">
								<li>'.$data->wilayah->luas.'</li>
								<li>Batas'.get_li($data->wilayah->batas,'share red').'</li>
								<li>Geografis'.get_li($data->geografis,'globe green').'</li>';
					    echo '</ol>';

					}elseif($key == 'bangunan'){

						echo '<ol class="spaced6">
								<li>Keagamaan'.get_li($data->bangunan->keagamaan,'home red').'</li>
								<li>Pendidikan'.get_li($data->bangunan->pendidikan,'university grey').'</li>';
					    echo '</ol>';

					}elseif($key == 'pertanahan'){

						echo '<ol class="spaced6">
								<li>Status'.get_li($data->pertanahan->status,'check red').'</li>
								<li>Peruntukan'.get_li($data->pertanahan->peruntukan,'leaf green').'</li>
								<li>Penggunaan'.get_li($data->pertanahan->penggunaan,'info-circle green').'</li>';
					    echo '</ol>';
					}

				?>			
			</div>
			<? }
			}else{
				echo '<div id="profil" class="tab-pane in active" style="min-height:400px"><h3 class="header smaller lighter red">Tidak Ada Data<h3></div>';
			} ?>
		</div>
	</div>
</div><!-- /.col -->

<?php function get_li($array,$icon){
	$li = '';
	$li .= '<ul class="list-unstyled" >';
	foreach($array as $ar => $ray){
		$li .= '<li><i class="ace-icon fa fa-'.$icon.'"></i> '.ucwords(str_replace('_', ' ',$ar)).' = '.$ray.'</li>';
	}
	$li .= '</ul>';
	return $li;
}?>