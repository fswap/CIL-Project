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

					<div class="col-sm-4 col-md-4">
						<?php echo '<a href="'.site_url("subsidiary/add_subsidiary").'"<button class="btn btn-primary">Add Subsidiary</button></a>'; ?>
					</div>

					<div class="col-sm-4 col-md-4">
						<?php echo '<a href="'.site_url("subsidiary/select_delete_sub").'"<button class="btn btn-primary">Delete Subsidiary</button></a>'; ?>
					</div>

				</div>
				<br>

				<table class="table table-bordered table-striped">
			        <thead>
			            <tr>
			                <th class="text-center">S. No.</th>
			                <th class="text-center">Subsidiary</th>
			                <th class="text-center">Action</th>
			            </tr>
			        </thead>

			        <tbody align="center">
			            <?php
			            $rn=1;
			            if(isset($subsidiary)){
			                foreach($subsidiary as $row){
			                    echo '
			                        <tr>
			                            <td>'.$rn.'</td>
			                            <td>'.$row['sub_name'].'</td>
			                            <td><a href="'.site_url("subsidiary/edit_subsidiary/".$row['sub_id']).'"<button class="btn btn-primary">Edit</button></a>
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
	</div>
</body>
</html>