<div class="container">
	<div class="row">
		<div class="col-md-2 col-sm-2">
		</div>
		<div class="col-md-8 col-sm-8">

			<!--<div class="row">

				<div class="col-sm-2 col-md-2">
					<?php echo '<a href="'.site_url("Pages/add_grade").'"<button class="btn btn-primary">Add Grade</button></a>'; ?>
				</div>

				<div class="col-sm-2 col-md-2">
					<?php echo '<a href="'.site_url("Pages/select_edit_grade").'"<button class="btn btn-primary">Edit Grade</button></a>'; ?>
				</div>

				 Option to delete grade
				<div class="col-sm-4 col-md-4">
					<?php echo '<a href="'.site_url("Pages/select_delete_grade").'"<button class="btn btn-primary">Delete Grade</button></a>'; ?>
				</div> 

			</div>-->

			<?php echo form_open_multipart('Pages/update_standard_data'); ?>

			<div class="row">
			    <div class="col-md-12  ">

			        <!-- Error Form-->
			        <?php if ($error):?>
			            <div class="alert alert-danger alert-dismissible">
			                <?php echo $error; ?>
			            </div>
			        <?php endif; ?>


			        <div class="box box-solid box-primary">
			            <div class="box-header">
			                <h3 class="box-title"><?php echo $header;?></h3>
			            </div>
			            <br><br>
			            <div class="box-body">
			            	<div class="row">
			            		<?php
			            		$data = array(
								        'type'  => 'hidden',
								        'name'  => 'sno',
								        'id'    => 'sno',
								        'value' => $prev['sno'],
								        'class' => 'sno'
								);

								echo form_input($data);
			            		?>
			            	</div>

			                <div class="row">

			                    
			                          
			                     	<div class="col-md-3">
			                     	<div>
			                     		<label for="sel1">Department<i style="color:red; font-size:14px;" >*</i></label>
			                     	</div>
  								 </div>

  								 <div class="col-md-3">
  								 <div class="form-group">	
 						 			<select class="form-control" id="sel2" name="department" required>
									 <option value="">--select--</option>
  									<?php $data = $this->session->userdata('getdepartmentdata'); 


										foreach ($data as $value) {
	# code...						?>
    								<option value=<?php echo $value['sno'] ?>><?php echo $value['department'] ?></option>
 									<?php } ?>   
  									</select>
								</div>
								</div>


			                     <div class="col-md-3">
			                     	<div>
			                     		<label for="sel1">Cadre<i style="color:red; font-size:14px;" >*</i></label>
			                     	</div>
  								 </div>

  								 <div class="col-md-3">
  								 <div class="form-group">	
 						 			<select class="form-control" id="sel1" name="cadre" required>
									 <option value="">--select--</option>
  									<?php $data = $this->session->userdata('getcadredata'); 


										foreach ($data as $value) {
	# code...						?>
    								<option value=<?php echo $value['sno'] ?>><?php echo $value['cil_cadre'] ?></option>
 									<?php } ?>   
  									</select>
								</div>
								</div>


								<div class="col-md-3">
			                     	<div>
			                     		<label for="sel1">Grade<i style="color:red; font-size:14px;" >*</i></label>
			                     	</div>
  								 </div>

  								 <div class="col-md-3">
  								 <div class="form-group">	
 						 			<select class="form-control" id="sel3" name="grade" required >
									 <option value="">--select--</option>
  									<?php $data = $this->session->userdata('getgradedata'); 

										foreach ($data as $value) {
	# code...						?>
    								<option value=<?php echo $value['sno'] ?>><?php echo $value['grade'] ?> (<?php echo $value['design'] ?>)
    								</option>
 									<?php } ?>   
  									</select>
								</div>
								</div>

								 <div class="col-md-3">
			                        <div class="form-group">
			                            <label for="grade">Req .of emp.<i style="color:red; font-size:14px;" >*</i></label>
			                        </div>
			                    </div>

			                    <div class="col-md-3">
			                        <div class="form-group">
			                            <?php echo form_input(array('name' => 'no_of_emp', 'id' => 'no_of_emp', 'placeholder' => $prev['no_of_emp'], 'value' => $prev['no_of_emp'], 'required' => 'required', 'class' => 'form-control')) ?>
			                        </div>
			                     </div> 

			                     <div class="col-md-3">
			                        <div class="form-group">
			                            <label for="info">Info.</label>
			                        </div>
			                    </div>

			                    <div class="col-md-3">
			                        <div class="form-group">
			                            <?php echo form_input(array('name' => 'info', 'id' => 'info', 'placeholder' => $prev['info'], 'value' => $prev['info'], 'class' => 'form-control')) ?>
			                        </div>
			                    </div>
 

							    </div>

			                 </div>
			                    

			                    

			                </div>

			            </div>
			        </div>
			        <br>
			        <div class="box-footer">
			            <div class="row">
			                <div class="col-md-5">
			                </div>
			                <div class="col-md-2">
			                    <?php echo form_submit('submit', 'Submit', ' class="btn btn-primary",  style="padding-left:25px;padding-right:25px;"'); ?>
			                </div>
			            </div>
			        </div>
			           <br><br>
			        	<p><span style="color:red" class="required">*</span>Required field</p>
			    </div>
			</div>
			<?php echo form_close(); ?>


		</div>

	</div>
</div>