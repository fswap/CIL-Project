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
					<h2 align="center"><?php echo $header;?></h2>

					<h3 align="center"><?php echo $minecategory;?>
				</div>
				<div class="row">
					<div class="col-md-3 col-sm-3">
	                    <div class="form-group">
	                        <label for="submine">Submine</label>
	                    </div>
	                </div>

	                <div class="col-md-3 col-sm-3">
	                    <div class="form-group">
	                       <?php
	                            echo $submine;
	                        ?>
	                   </div>
	                </div>

				</div>
				<div class="row">
					<div class="col-md-3 col-sm-3">
	                    <div class="form-group">
	                        <label for="submine">Department with scope of work</label>
	                    </div>
	                </div>

	                <div class="col-md-3 col-sm-3">
	                    <div class="form-group">
	                       <?php
	                            echo $department;
	                            echo '<br>(' . $scopeofwork . ')';
	                        ?>
	                   </div>
	                </div>
	                
				</div>
				
				<div class="row">

					<table class="table table-bordered table-striped">
				        <thead>
				            <tr>
				                <th class="text-center">S. No.</th>
				                <th class="text-center">CIL Cadre</th>
				                <th class="text-center">Grade</th>
				                <th class="text-center">Employees</th>
				                <th class="text-center">Information</th>
				                <th class="text-center">Norm</th>
				            </tr>
				        </thead>

				        <tbody align="center">
				            <?php
				            	//echo $std_data[0]['no_of_emp'];
					            $rn=1;
					            if(isset($std_data)){
					                foreach($std_data as $temp){
					                    echo '
					                        <tr>
					                            <td>'.$rn.'</td>
					                            <td>'.$temp['cadre'].'</td>
					                            <td>'.$temp['grade'].'<br>'.'</td>
					                            <td>'.$temp['no_of_emp'].'<br>'.'</td>
					                            <td>'.$temp['info'].'<br>'.'</td>
					                            <td>'.$temp['norm'].'<br>'.'</td>
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