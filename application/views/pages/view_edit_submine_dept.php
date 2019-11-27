<?php echo form_open_multipart('mines/edit_submine2'); ?>
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
				<!-- <div class="row">
					<div class="col-md-4 col-sm-4">
						<a href="add_mine"><button class="btn btn-primary" type="button" align="center">Add Mine</button></a>
					</div>
					<div class="col-md-4 col-sm-4">
						<a href=""><button type="button" class="btn btn-primary">Edit Mine</button></a>
					</div>
					<div class="col-md-4 col-sm-4">
						<a href=""><button type="button" class="btn btn-primary">Delete Mine</button></a>
					</div>
				</div> -->
				<div class="row">
					<h2 align="center"><?php echo $header;?></h2>
					<div>
						<?php
							//echo $mine['mine_id'];
							$data = array(
						        'mine_id'	=>	$mine_id,
						        'mcode'		=>	$mcode
							);
							echo form_hidden($data);
						?>
					</div>
				</div>
				<div class="row">

					<div class="col-md-4">
	                    <div class="form-group">
	                        <label for="submine">Submine<i style="color:red; font-size:14px;" >*</i></label>
	                    </div>
	                </div>

	                <div class="col-md-4">
	                    <div class="form-group">
	                       <?php
	                       		$input=array(
	                       			'name'	=>	'submine',
	                       			'id'	=>	'submine',
	                       			'value'	=>	$submine,
	                       			'readonly'	=>	'true',
	                       			'required'	=>	'required',
	                       			'class'	=>	'form-control'
	                       		);
	                            echo form_input($input);
	                        ?>
	                   </div>
	                </div>
	            </div>

	            <div class="row">

					<div class="col-md-4">
	                    <div class="form-group">
	                        <label for="department">Department<i style="color:red; font-size:14px;" >*</i></label>
	                    </div>
	                </div>

	                <div class="col-md-4">
	                    <div class="form-group">
	                       <?php
	                            echo form_dropdown('department', $arr_dept, '', 'class="form-control" id="department",  required="required"');
	                        ?>
	                   </div>
	                </div>

	            </div>
	            <br>
                <div class="row">
                	<div class="col-md-4">
                	</div>

                	<div class="col-md-4">
	                    <?php echo form_submit('submit', 'Submit', ' class="btn btn-primary",  style="padding-left:25px;padding-right:25px;"'); ?>
	                </div>
                </div>
	                
				</div>
			</div>
		</div>
	</div>
</body>
</html>