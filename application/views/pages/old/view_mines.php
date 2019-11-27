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

</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-sm-2 col-md-2">
			</div>

			<div class="col-md-8 col-sm-8">
				<div class="row">
					<div class="col-md-4 col-sm-4">
						<a href="mines/add_mine"><button class="btn btn-primary" type="button" align="center">Add Mine</button></a>
					</div>
					<div class="col-md-4 col-sm-4">
						<a href=""><button type="button" class="btn btn-primary">Edit Mine</button></a>
					</div>
					<div class="col-md-4 col-sm-4">
						<a href=""><button type="button" class="btn btn-primary">Delete Mine</button></a>
					</div>
				</div>
				<div class="row">

					<h2 align="center"><?php echo $header;?></h2>

					<table class="table table-bordered table-striped">
				        <thead>
				            <tr>
				                <th class="text-center">S. No.</th>
				                <th class="text-center">Mine Type</th>
				                <th class="text-center">Measuring Unit</th>
				                <th class="text-center">Action</th>
				            </tr>
				        </thead>

				        <tbody align="center">
				            <?php
				            $rn=1;
				            if(isset($mines)){
				                foreach($mines as $mine){
				                    echo '
				                        <tr>
				                            <td>'.$rn.'</td>
				                            <td>'.$mine['minecategory'].'</td>
				                            <td>'.$mine['munit'].'<br>'.'</td>
				                            <td>
	                                            <a href="'.site_url("mines/submines/".$mine['mine_id']).'"<button class="btn btn-primary">View Submines</button></a>
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
			<div class="col-sm-2 col-md-2">				
			</div>
		</div>
	</div>
</body>
</html>