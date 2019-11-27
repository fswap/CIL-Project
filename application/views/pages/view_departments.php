<!DOCTYPE html>
<html>
<head>
	<title><?php echo $title;?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>CSS/homeStyle.css">

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/pages/mines.css">

</head>
<body style=" background-image: url('<?php echo  base_url("assets/images/cilOffice.jpg"); ?>') ; background-position: center center;
    background-size: 100%;">
	<div class="container">
		<div class="row">

			<div class="col-sm-2 col-md-2">
			</div>
			<div class="col-sm-8 col-md-8">
				<h2 align="center"><?php echo $header;?></h2>
				<br>
				<div class="row">

					<div class="col-sm-4 col-md-3">
						<?php echo '<a href="'.site_url("departments/add_dept").'"<button class="btn btn-primary">Add Department</button></a>'; ?>
					</div>

					<div class="col-sm-4 col-md-4">
						<?php echo '<a href="'.site_url("departments/select_delete_dept").'"<button class="btn btn-primary">Delete Department</button></a>'; ?>
					</div>

				</div>
				<br>

				<table class="table table-bordered table-striped">
			        <thead>
			            <tr>
			                <th class="text-center">S. No.</th>
			                <th class="text-center">Department</th>
			                <th class="text-center">Action</th>
			            </tr>
			        </thead>

			        <tbody align="center">
			            <?php
			            $rn=1;
			            if(isset($departments)){
			                foreach($departments as $dept){
			                    echo '
			                        <tr>
			                            <td>'.$rn.'</td>
			                            <td>'.$dept['department'].'</td>
			                            <td><a href="'.site_url("departments/edit_dept/".$dept['sno']).'"<button class="btn btn-primary">Edit</button></a>
			                            </td>
			                        </tr>';
			                    $rn++;
			                }
			            }
			            ?>
			        </tbody>
			    </table>
			</div>
			
		</div>
		<center>
		<div class="row">
		<div class="col-sm-5"></div>
		<div class="col-sm-2">
			<div class="btn btn-primary" onclick="printer(this)">
				Print
			</div>
		</div>
	</div>
	</center>




<script type="text/javascript">
	function printer(){
		$(".btn").hide();
		$('.navbar').hide();
		window.print();
		$(".btn").show();
		$('.navbar').show();
	}
	
</script>
	</div>
</body>
</html>