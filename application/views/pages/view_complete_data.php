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
<body style=" background-image: url('<?php echo  base_url("assets/images/minemachine.jpeg"); ?>') ; background-position: center center;
    background-size: 100%; ">
	<div class="container">
		<div class="row">
			<div class="col-sm-2 col-md-2">
			</div>

			<div class="col-md-8 col-sm-8">
				<?php if($i==0): ?>

					<div class="row">
						<h2 align="center" style="background-color: #DDDDDD"><?php echo $header;?></h2>

						<h1 align="center"><?php echo $minecategory;?></h1>
					</div>

				<?php endif ?>
				<div class="row" align='center'>
					<h2>Submine : <?php echo $submine ?></h2>
				</div>		
				<div class="row">

					<table class="table table-bordered table-striped">
				        <thead>
				            <tr>
				                <th class="text-center">S. No.</th>
				                <th class="text-center">Department with scope of work</th>
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
					            if(count($sm)>0){
					                foreach($sm as $temp){
					                    echo '
					                        <tr>
					                            <td>'.$rn.'</td>
					                            <td>'.$temp['department'].'<br>'.$temp['scopeofwork'].'</td>
					                            <td>'.$temp['cil_cadre'].'</td>
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
				        <?php if(count($sm)==0) echo "<div id='no_data' align='center'> No Data.</div>";?>

				</div>
			</div>
			<div class="col-sm-2 col-md-2">				
			</div>
		</div>
	</div>
	<br><br>
	
</body>

</html>
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