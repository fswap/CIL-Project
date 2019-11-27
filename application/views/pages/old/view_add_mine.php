<div class="container">
	<div class="row">
		<div class="col-sm-2 col-md-2">
		</div>

		<div class="col-md-8 col-sm-8">
			<div class="row">
				<div class="col-md-4 col-sm-4">
					<a href="add_mine"><button class="btn btn-primary" type="button" align="center">Add Mine</button></a>
				</div>
				<div class="col-md-4 col-sm-4">
					<a href=""><button type="button" class="btn btn-primary">Edit Mine</button></a>
				</div>
				<div class="col-md-4 col-sm-4">
					<a href=""><button type="button" class="btn btn-primary">Delete Mine</button></a>
				</div>
			</div>
			<div class="row">
				<?php echo form_open_multipart('mines/save_mine'); ?>
				<div class="col-md-12  ">

			        <!-- Error Form-->
			        <?php if ($error):?>
			            <div class="alert alert-danger alert-dismissible">
			                <?php echo $error; ?>
			            </div>
			        <?php endif; ?>


			        <div class="box box-solid box-primary">
			            <div class="box-header">
			                <h3 class="text-center"><?php echo "$header";?></h3>
			                <br>
			            </div>

			            <div class="box-body">
			                <div class="row">

			                    <div class="col-md-3">
			                        <div class="form-group">
			                            <label for="minecategory">Mine Category<i style="color:red; font-size:14px;" >*</i></label>
			                        </div>
			                    </div>

			                    <div class="col-md-3">
			                        <div class="form-group">
			                            <?php echo form_input(array('name' => 'minecategory', 'id' => 'minecategory', 'placeholder' => 'Type of Mine', 'class' => 'form-control')) ?>
			                        </div>
			                    </div>

			                    <div class="col-md-3">
			                        <div class="form-group">
			                            <label for="munit">Measuring Unit<i style="color:red; font-size:14px;" >*</i></label>
			                        </div>
			                    </div>

			                    <div class="col-md-3">
			                        <div class="form-group">
			                            <?php echo form_input(array('name' => 'munit', 'id' => 'munit','class' => 'form-control')) ?>
			                        </div>
			                    </div>

			                    <div class="col-md-12">
			                    	<h3 align="center">Mine Subtypes</h3>

			                    	<table class="table table-bordered table-striped" id="submine">
	                                    <thead>
	                                        <tr>
	                                            <th>Lower Limit</th>
	                                            <th>Upper Limit</th>
	                                            <th>Action</th>
	                                        </tr>
	                                    </thead>
	                                    <tbody id="ti">
	                                        <tr>
	                                            <td>
	                                                <input type="text" name="plower_lim[]" id="plower_lim" class="form-control" required='required'>
	                                            </td>
	                                            <td>
	                                                <input type="text" name="pupper_lim[]" id="pupper_lim" class="form-control" required='required'>
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

			            </div>
			        </div>

			        <div class="box-footer">
			            <div class="row">
			                <div class="col-md-5">
			                </div>
			                <div class="col-md-2">
			                    <?php echo form_submit('submit', 'Submit', ' class="btn btn-primary",  style="padding-left:25px;padding-right:25px;"'); ?>
			                </div>
			            </div>
			        </div>
			    </div>
			</div>
			<?php echo form_close(); ?>
		</div>
	</div>
</div>

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
        var table =document.getElementById("submine");
        //var table=$(ob).parent().parent().parent().parent().parent();
        if(table.rows.length<3){
             alert("At least one item is required");
        }else
            $(ob).parent().parent().remove();
    }
</script>