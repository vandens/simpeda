<!DOCTYPE html>
<html lang="en">
	<head>
		<?php echo $this->header; ?>
		<?php echo $this->js; ?>
		<?php echo $this->js_dtable; ?>
	</head>

	<body class="skin-1">
		<?php echo $this->panel; ?>
		<!-- /section:basics/navbar.layout -->
		<div class="main-container container" id="main-container">

			<?php echo isset($this->panel_left) ? $this->panel_left : ''; ?>
			<!-- /section:basics/sidebar.horizontal -->
			<div class="main-content">
				<div class="main-content-inner">

					<!-- #section:basics/content.breadcrumbs -->
					<div class="breadcrumbs breadcrumbs-fixed" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="<?php echo base_url(); ?>">Home</a>
							</li>
							<?php echo (isset($sub)) ? '<li><a href="'.base_url(strtolower($nav)).'">'.$nav.'</a></li>' : '<li class="active">'.$nav.'</li>'; ?>
							<?php echo (isset($sub)) ? '<li class="active">'.$sub.'</a></li>' : ''; ?>
						</ul><!-- /.breadcrumb -->

						<!-- #section:basics/content.searchbox -->
						<div class="nav-search" id="nav-search">
							<form class="form-search">
								<span class="input-icon">
									<input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
									<i class="ace-icon fa fa-search nav-search-icon"></i>
								</span>
							</form>
						</div><!-- /.nav-search -->

						<!-- /section:basics/content.searchbox -->
					</div>

					<div class="page-content">
						<?php //echo $this->load->view('sample/ace-setting'); ?>
						

						<div class="row">
							<div class="col-xs-12">
								<div id='alert' class="alert" style='display:none;'><?php echo validation_errors(); ?><?php echo ($this->session->flashdata('error')) ? $this->session->flashdata('error')['msg'] : ''; ?></div>
								<div class="row">
									<?php echo $contain; ?>
								</div>
							</div>
						</div>

					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->
			<?php echo isset($this->footer) ? $this->footer : ''; ?>
		</div><!-- /.main-container -->
		<?php echo (!$true) ? $this->load->view('popup/modal') : ''; ?>

	</body>
</html>
