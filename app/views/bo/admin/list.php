<div class="widget-box transparent">
	<div class="widget-header widget-header-flat widget-header-small">
		<h4 class="widget-title orange smaller">
			<i class="ace-icon fa fa-home orange"></i>
			Selamat Datang di <?php echo $this->_setting->app_acronim; ?>
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
		<div id="list1" style='padding-right:25px'>
			<table class='' width='500px'>
				<tr>
					<td>Id Pengguna</td><td>:</td><td><?php echo $this->session->userdata('user_id'); ?></td>
				</tr>
				<tr>
					<td>Nama Pengguna</td><td>:</td><td><?php echo $this->session->userdata('user_fullname'); ?></td>
				</tr>
				<tr>
					<td>Email</td><td>:</td><td><?php echo $this->session->userdata('user_email'); ?></td>
				</tr>
				<tr>
					<td>Desa</td><td>:</td><td><?php echo $this->session->userdata('village_name'); ?></td>
				</tr>
				<tr>
					<td>Alamat</td><td>:</td><td><?php echo $this->session->userdata('village_address'); ?></td>
				</tr>
			</table>
		</div>
	</div>
	</div>
</div>
