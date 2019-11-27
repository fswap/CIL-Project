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


</body>
</html>