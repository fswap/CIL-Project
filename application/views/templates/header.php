<html>
<head>
	<title>Coal India Limited</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>CSS/homeStyle.css">

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
	
	<!-- Correct it -->
	<script type="text/javascript">
		// Javascript to enable link to tab
		var hash = document.location.hash;
		var prefix = "tab_";
		if (hash) {
			$('.nav-tabs a[href="'+hash.replace(prefix,"")+'"]').tab('show');
		} 

		// Change hash for page-reload
		$('.nav-tabs a').on('shown.bs.tab', function (e) {
			window.location.hash = e.target.hash.replace("#", "#" + prefix);
		});


		function site_url(val){
			return "<?=site_url()?>/" + val;
		}
		function base_url(val){
			return "<?=base_url()?>/" + val;
		}
		
	</script>

</head>

<body >

	<nav class="navbar navbar-inverse">
		<div class="container">

			<!-- cil logo link -->
			<div class="navbar-header">
				<a href="<?=site_url()?>" class="navbar-brand">
					<!-- <img height='40px' width='40px' src="<?php echo base_url(); ?>assets/images/cil_logo.jpeg" class='img-responsive'> -->
					<span>CIL</span>
				</a>
			</div>

			<!-- bootstrap menu -->
			<div>
				<ul class="nav navbar-nav">

					<li>
						<a href="<?=site_url('pages/match_data')?>">Home</a>
					</li>

					<li class="dropdown">
						<a href="" class="dropdown-toggle" data-toggle="dropdown">Existing Manpower<span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="<?=site_url('pages/upload_existing_data')?>">Upload Existing Manpower</a></li>
							<li><a href="<?=site_url('')?>">CIL Headquarter</a></li>
							<li><a href="<?=site_url('')?>">Subsidiary Headquarter</a></li>
							<li><a href="<?=site_url('pages/existing_area_office')?>">Area Office</a></li>
							<li><a href="<?=site_url('pages/existing_subarea_office')?>">Subarea Office</a></li>
							<li><a href="<?=site_url('pages/existing_subsidiary_wise')?>">Subsidiary-Wise (Mines)</a></li>
							<li><a href="<?=site_url('pages/existing_area_wise')?>">Area-Wise (Mines)</a></li>
							<li><a href="<?=site_url('pages/existing_subarea_wise')?>">Subarea-Wise (Mines)</a></li>
							<li><a href="<?=site_url('pages/existing_particular_mine')?>">Particular Mine</a></li>
							
						</ul>
					</li>
					<li class="dropdown">
						<a href="" class="dropdown-toggle" data-toggle="dropdown">Standard Manpower<span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="<?=site_url('pages/upload_standard_data')?>">Upload Standard Manpower</a></li>
							<li><a href="<?=site_url('pages/upload_standard_dynamic_data')?>">Upload Standard Manpower(Dynamic)</a></li>
							<li><a href="<?=site_url('')?>">CIL Headquarter</a></li>
							<li><a href="<?=site_url('')?>">Subsidiary Headquarter</a></li>
							<li><a href="<?=site_url('pages/area_office_standard_data')?>">Area Office</a></li>
							<li><a href="<?=site_url('pages/subarea_office_standard_data')?>">Subarea Office</a></li>
							<li><a href="<?=site_url('pages/subsidiary_wise_standard_data')?>">Subsidiary-Wise (Mines)</a></li>
							<li><a href="<?=site_url('pages/area_wise_standard_data')?>">Area-Wise (Mines)</a></li>
							<li><a href="<?=site_url('pages/subarea_wise_standard_data')?>">Subarea-Wise (Mines)</a></li>
							<li><a href="<?=site_url('pages/standard_data')?>">Particular Mine</a></li>
							
						</ul>
					</li>
					<li class="dropdown">
						<a href="" class="dropdown-toggle" data-toggle="dropdown">Compare Manpowers<span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="<?=site_url('')?>">CIL Headquarter</a></li>
							<li><a href="<?=site_url('')?>">Subsidiary Headquarter</a></li>
							<li><a href="<?=site_url('pages/area_office_compare_data')?>">Area Office</a></li>
							<li><a href="<?=site_url('pages/subarea_office_compare_data')?>">Subarea Office</a></li>
							<li><a href="<?=site_url('pages/subsidiary_wise_compare_data')?>">Subsidiary-Wise (Mines)</a></li>
							<li><a href="<?=site_url('pages/area_wise_compare_data')?>">Area-Wise (Mines)</a></li>
							<li><a href="<?=site_url('pages/subarea_wise_compare_data')?>">Subarea-Wise (Mines)</a></li>
							<li><a href="<?=site_url('pages/mine_wise_compare_data')?>">Particular Mine</a></li>
						</ul>
					</li>

					<li class="dropdown">
						<a href="" class="dropdown-toggle" data-toggle="dropdown">Menu<span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="<?=site_url('pages/designation')?>">Designation</a></li>
							<li><a href="<?=site_url('mines')?>">Mine Type</a></li>
							<li><a href="<?=site_url('pages/mine_mcode')?>">Mine Type & Mcode</a></li>
							<li><a href="<?php echo base_url(); ?>index.php/departments">Departments</a></li>

							<li><a href="<?php echo base_url(); ?>index.php/cadre">Cadre</a></li>
							<li><a href="<?php echo base_url(); ?>index.php/subsidiary">Subsidiary</a></li>
							<li><a href="<?php echo base_url(); ?>index.php/area">Area</a></li>
							<li><a href="<?php echo base_url(); ?>index.php/subarea">Subarea</a></li>
							<li><a href="<?php echo base_url(); ?>index.php/allmines">Mines</a></li>
						</ul>
					</li>

					<li><a href="<?php echo base_url();?>index.php/Pages/about_us">About</a></li>
					<?php if (isset($isLogged)&&$isLogged): ?>
						<li><a href="<?=site_url('pages/logout')?>">Logout</a></li>
					<?php endif ?>

				</ul>
			</div>

		</div>
	</nav>

	



</body>
</html>