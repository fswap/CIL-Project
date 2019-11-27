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
				<h2 align="center">Mine Type & Mcode</h2>
				<br>
				<div class="row">

					<!--<div class="col-sm-4 col-md-4">
						<?php echo '<a href="'.site_url("subarea/add_subarea").'"<button class="btn btn-primary">Add Subarea</button></a>'; ?>
					</div>
					<div class="col-sm-4 col-md-4">
						<?php echo '<a href="'.site_url("subarea/select_delete_subarea").'"<button class="btn btn-primary">Delete Subarea</button></a>'; ?>
					</div>-->

				</div>
				<br>

				<table class="table table-bordered table-striped">
			        <thead>
			            <tr>
			                <th class="text-center">Mcode</th>
			                <th class="text-center">Mine Type</th>
			                <th class="text-center">Production Unit</th>
			                <th class="text-center">Lower Limit</th>
			                <th class="text-center">Upper Limit</th>
			                <th class="text-center">With Effective From</th>
			                <th class="text-center">Status</th>
			            </tr>
			        </thead>

			        <tbody align="center">
			            <?php
			            if(isset($values)){
			                foreach($values as $row){
			                    echo '
			                        <tr>
			                            <td>'.$row['mcode'].'</td>
			                            <td>'.$row['minecategory'].'</td>
			                            <td>'.$row['munit'].'</td>
			                            <td>'.$row['plower_lim'].'</td>
			                            <td>'.$row['pupper_lim'].'</td>
			                            <td>'.$row['wef'].'</td>
			                            <td>'.$row['status'].'</td>
			                        </tr>';
			                    
			                }
			            }
			            ?>
			        </tbody>
			    </table>

			    	<!--<form method="post" id="import_csv" action="<?php echo base_url();?>index.php/pages/import_subarea_csv" enctype="multipart/form-data">
   <div class="form-group" >
    <label style="color: white">Select CSV File</label>
    <input type="file" name="csv_file" id="csv_file" required accept=".csv" />
   
   </div>
   
   <button type="submit" name="import_csv" class="btn btn-info" id="import_csv_btn">Import CSV</button>
  </form>

  <div align="center">
		<label style="color: white">Click here to download Format of CSV file</label>
		<br/>
		<a href="<?php echo site_url('pages/subarea_excel_format')?>" class= "btn btn-primary ">Download</a>

	</div>-->
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