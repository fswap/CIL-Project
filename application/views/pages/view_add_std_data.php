<?php echo form_open_multipart('mines/save_std_data'); ?>
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
						        'mcode'		=>	$mcode,
						        'scopeofwork'	=>	$scopeofwork,
						        'department_id'	=>	$department_id,
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
	                <?php
	                	$submine_data=array(
	                		'name'		=>	'submine',
	                		'id'		=>	'submine',
	                		'value'		=>	$submine,
	                		'readonly'	=>	'true',
	                		'required'	=>	'required',
	                		'class'		=>	'form-control'
	                	);
	                ?>

	                <div class="col-md-4">
	                    <div class="form-group">
	                       <?php
	                            echo form_input($submine_data);
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
	                <?php
	                	$dept_data=array(
	                		'name'		=>	'department',
	                		'id'		=>	'department',
	                		'value'		=>	$department,
	                		'readonly'	=>	'true',
	                		'required'	=>	'required',
	                		'class'		=>	'form-control'
	                	);
	                ?>

	                <div class="col-md-4">
	                    <div class="form-group">
	                       <?php
	                            echo form_input($dept_data);
	                        ?>
	                   </div>
	                </div>
	            </div>

	            <div class="row">
					<div class="col-md-4">
	                    <div class="form-group">
	                        <label for="scopeofwork">Scope of Work</label>
	                    </div>
	                </div>
	                <?php
	                   	$sow_data=array(
	                   		'name'	=>	'scopeofwork',
	                   		'id'	=>	'scopeofwork',
	                   		'value'	=>	$scopeofwork,
	                		'class'	=>	'form-control'
	                   	);
                    ?>

	                <div class="col-md-4">
	                    <div class="form-group">
	                       <?php
	                            echo form_input($sow_data);
	                        ?>
	                   </div>
	                </div>
	            </div>

	            <div class="row">
	            	<div class="col-md-12">
                    	<h3 align="center">CIL Cadre and Employees</h3>

                    	<table class="table table-bordered table-striped" id="cadre_emp">
                            <thead>
                                <tr>
                                    <th>CIL Cadre</th>
                                    <th>Grade</th>
                                    <th>Number of<br>Employees</th>
                                    <th>Info</th>
                                    <th>Norm</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="ti">
                                <tr>
                                    <td>
                                        <?php
				                            echo form_dropdown('cadre[]', $arr_cadre, '', 'class="form-control" id="cadre" required="required"');
				                        ?>
                                    </td>
                                    <td>
                                        <?php
				                            echo form_dropdown('grade[]', $arr_grade, '', 'class="form-control" id="grade" required="required"');
				                        ?>
                                    </td>
                                    <td class="col-2">
                                    	<?php
                                    	$data=array(
                                    		'type'	=>	'number',
                                    		'min'	=>	0,
                                    		'name'	=>	'no_of_emp[]',
                                    		'id'	=>	'no_of_emp',
                                    		'style'	=>	'width:90px'
                                    	);
                                    	echo form_input($data);
                                    	?>
                                    </td>
                                    <td>
                                    	<?php
                                    	$data=array(
                                    		'name'	=>	'info[]',
                                    		'id'	=>	'info',
                                    		'size'	=>	'15'
                                    	);
                                    	echo form_input($data);
                                    	?>
                                    </td>
                                    <td>
                                        <?php
				                            echo form_dropdown('norm[]', $arr_norm, '', 'class="form-control" id="norm"');
				                        ?>
                                    </td>
                                    <td>
                                        <div onclick="delItem(this)" class="btn btn-danger">
                                            Remove
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input type="button" class="btn btn-info" style="padding-left:25px;padding-right:25px;  " value="Add Row" onClick="addItem('ti')"/>
                                </div>
                            </div>
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
			<?php echo form_close(); ?>
		</div>
	</div>
</body>
</html>

<script type="text/javascript">
	function addItem(tableID){
        var table = document.getElementById(tableID);
        var rowCount = table.rows.length; 

        var row = table.insertRow(rowCount);
        var colCount = table.rows[0].cells.length;
        for(var i=0; i <colCount; i++) {
            var newcell = row.insertCell(i);
            newcell.innerHTML = table.rows[0].cells[i].innerHTML;
        }
   }
</script>

<script type="text/javascript">
    function delItem(ob){
        console.log($(ob).parent().parent());
        var table =document.getElementById("cadre_emp");
        //var table=$(ob).parent().parent().parent().parent().parent();
        if(table.rows.length<3){
             alert("At least one item is required");
        }else
            $(ob).parent().parent().remove();
    }
</script>