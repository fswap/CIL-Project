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
	<?php echo form_open_multipart('mines/edit_submine2'); ?>
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
	                            echo form_dropdown('department', $arr_dept, '', 'required="required", class="form-control" id="department"');
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
	<?php echo form_close(); ?>

	<?php echo form_open_multipart('mines/update_submines'); ?>
	<div class="container">
		<div class="row">
			<div class="col-sm-2 col-md-2">
			</div>

			<div class="col-md-8 col-sm-8">
				<div class="row">
					<div class="col-md-3 col-sm-3">
	                    <div class="form-group">
	                        <label for="submine">Submine</label>
	                    </div>
	                </div>

	                <div class="col-md-3 col-sm-3">
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
					<div class="col-md-3 col-sm-3">
	                    <div class="form-group">
	                        <label for="submine">Department</label>
	                    </div>
	                </div>

	                <div class="col-md-3 col-sm-3">
	                    <div class="form-group">
	                       <?php
	                            $input=array(
	                       			'name'	=>	'department',
	                       			'id'	=>	'department',
	                       			'value'	=>	$department,
	                       			'readonly'	=>	'true',
	                       			'required'	=>	'required',
	                       			'class'	=>	'form-control'
	                       		);
	                            echo form_input($input);
	                        ?>
	                   </div>
	                </div>
	                <?php if ($n>0): ?>
		                <div class="col-md-3 col-sm-3">
		                    <div class="form-group">
		                        <label for="scopeofwork">Scope of Work</label>
		                    </div>
		                </div>
		                
	                	<div class="col-md-3 col-sm-3">
		                    <div class="form-group">
		                       <?php
		                            $input=array(
		                       			'name'	=>	'scopeofwork',
		                       			'id'	=>	'scopeofwork',
		                       			'value'	=>	$scopeofwork,
		                       			'readonly'	=> 'true',
		                       			'class'	=>	'form-control'
		                       		);
		                            echo form_input($input);
		                        ?>
		                   </div>
	                	</div>
	                <?php endif ?>
	                
	                
				</div>
				<?php 
					$data=array('mcode'	=> $mcode,
								'department'	=>	$department_id,
								);
					echo form_hidden($data);
				?>
				<div class="row">

					<table class="table table-bordered table-striped">
				        <thead>
				            <tr>
				                <th class="text-center">CIL Cadre</th>
				                <th class="text-center">Grade</th>
				                <th class="text-center">Employees</th>
				                <th class="text-center">Information</th>
				                <th class="text-center">Norm</th>
				                <th class="text-center">Action</th>
				            </tr>
				        </thead>

				        <tbody align="center">
				            <?php
				            	$num_emp_data=array(
                                    		'name'	=>	'no_of_emp[]',
				            				'type'	=>	'number',
                                    		'id'	=>	'no_of_emp',
                                    		'style'	=>	"width: 80px",
                                    		'required'	=>	'required',
                                    		'min'	=>	0
                                    	);
				            	$info_data=array(
                                    		'name'	=>	'info[]',
                                    		'id'	=>	'info'
                                    	);
				            	//echo $std_data[0]['no_of_emp'];
					            if(isset($std_data)){
					                foreach($std_data as $temp){
					                	$num_emp_data['value']=$temp['no_of_emp'];
					                	$info_data['value']=$temp['info'];

					                	$data = array(
									        'std_data_id[]'	=>	$temp['sno']
										);
										echo form_hidden($data);

					                    echo '
					                        <tr>
					                            <td>'.form_dropdown('cadre[]', $arr_cadre, $temp['cadre_id'], 'class="form-control" id="cadre", required="required"').'</td>
					                            <td>'.form_dropdown('grade[]', $arr_grade, $temp['grade_id'], 'class="form-control" id="grade", required="required"').'<br>'.'</td>
					                            <td>'.form_input($num_emp_data).'<br>'.'</td>
					                            <td>'.form_input($info_data).'<br>'.'</td>
					                            <td>'.form_dropdown('norm[]', $arr_norm, $temp['norm_id'], 'class="form-control" id="norm"').'<br>'.'</td>
					                            <td>
		                                            <a href="'.site_url("mines/delete_grade_data/".$temp['sno']."/".$mcode."/".$department_id."/".$mine_id).'"<button class="btn btn-danger">Delete</button></a>
		                                        </td>
					                        </tr>';

					                }
					            }
				            ?>
				        </tbody>
				    </table>

				</div>
				<?php if ($n>0): ?>
					<div class="row">
	                	<div class="col-md-4">
	                	</div>

	                	<div class="col-md-4">
		                    <?php echo form_submit('save', 'Save', ' class="btn btn-primary",  style="padding-left:25px;padding-right:25px;"'); ?>
		                </div>
	                </div>
            	<?php endif ?>
            	<?php echo form_close(); ?>
            	<?php 
            		echo form_open_multipart("mines/add_std_data");
	            	$data=array(
	            		'mine_id'	=>	$mine_id,
	            		'mcode'		=>	$mcode,
	            		'department_id'	=>	$department_id,
	            		'scopeofwork'	=>	$scopeofwork
	            	);
	            	//var_dump($data);
	            	echo form_hidden($data);
            	?>
            	<br><br>
                <div class="row">
                	<div class="col-md-4">
                	</div>

                	<div class="col-md-4">
	                    <?php
	      //               	var_dump($mine_id);
	      //               	var_dump($mcode);
							// var_dump($scopeofwork);		
	      //               	var_dump($department_id);
	                    echo form_submit('add_row', 'Add Std Data', ' class="btn btn-primary",  style="padding-left:25px;padding-right:25px;"'); ?>
	                </div>
                </div>
			</div>
		</div>
	</div>
	<?php echo form_close(); ?>
</body>
</html>