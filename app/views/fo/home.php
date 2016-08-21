<!DOCTYPE html>
<html lang="en">
	<head>
		<?php echo $this->header; ?>
	</head>

	<body class="skin-1">
		<?php echo $this->panel; ?>

		<!-- /section:basics/navbar.layout -->
		<div class="main-container container" id="main-container">
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
							<?php echo (isset($sub)) ? '<li><a href="'.base_url($nav).'">'.$nav.'</a></li>' : '<li class="active">'.$nav.'</li>'; ?>
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
						<!--
						<div class="page-header">
							<h1>
								<?php echo $menu; ?>
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									<?php echo $nav; ?>
									<?php if(isset($sub)){
										echo '<i class="ace-icon fa fa-angle-double-right"></i> ';
										echo $sub;
									} ?>
								</small>
							</h1>
						</div>
					-->

						<div class="row">
							<div class="col-xs-12">
								<div class="row">
									<?php echo isset($this->panel_left) ? $this->panel_left : ''; ?>
									<?php echo $contain; ?>
									<?php echo isset($this->panel_right) ? $this->panel_right : ''; ?>
								</div>
							</div>
						</div>

					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->
			<?php echo $this->footer; ?>
		</div><!-- /.main-container -->

			<?php echo $this->js; ?>

	</body>
</html>
