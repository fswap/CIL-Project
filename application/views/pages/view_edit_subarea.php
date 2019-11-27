<div class="container">
	<div class="row">
		<div class="col-md-2 col-sm-2">
		</div>
		<div class="col-md-8 col-sm-8">

			<?php echo form_open_multipart('subarea/update_subarea'); ?>

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

			            <div class="box-body">
			            	<div class="row">
			            		<?php
			            		$data = array(
								        'type'  => 'hidden',
								        'name'  => 'subarea_id',
								        'id'    => 'subarea_id',
								        'value' => $subarea['subarea_id'],
								        'class' => 'subarea_id'
								);

								echo form_input($data);
			            		?>
			            	</div>

			                <div class="row">

			                    <div class="col-md-3">
			                        <div class="form-group">
			                            <label for="grade">Subsidiary<i style="color:red; font-size:14px;" >*</i></label>
			                        </div>
			                    </div>

			                    <div class="col-md-3">
			                        <div class="form-group">
			                            <?php /*echo form_input(array('name' => 'sub_name', 'id' => 'sub_name', 'placeholder' => $area['sub_name'], 'value' => $area['sub_name'], 'required' => 'required', 'class' => 'form-control')) */ ?>

			                            <select class="form-control" name="sub_id">
			                            

			                            <?php  foreach ($subsidiary as $value) { echo "value".$value['sub_id']; ?>



			                            	<option <?php if($subarea['sub_id']==$value['sub_id']){echo 'selected';} ?> value="<?php echo $value['sub_id'] ?>"><?php echo $value['sub_name'] ?></option>
			                            	
			                           <?php } ?>

			                        </select>
			                        </div>
			                    </div>
			                </div>

			                <div class="row">

			                	<div class="col-md-3">
			                        <div class="form-group">
			                            <label for="grade">Area<i style="color:red; font-size:14px;" >*</i></label>
			                        </div>
			                    </div>
			                     <div class="col-md-3">
			                        <div class="form-group">
			                            <?php /*echo form_input(array('name' => 'sub_name', 'id' => 'sub_name', 'placeholder' => $area['sub_name'], 'value' => $area['sub_name'], 'required' => 'required', 'class' => 'form-control')) */ ?>

			                            <select class="form-control" name="area_id">
			                            

			                            <?php  foreach ($area as $value) { echo "value".$value['area_id']; ?>



			                            	<option <?php if($subarea['area_id']==$value['area_id']){echo 'selected';} ?> value="<?php echo $value['area_id'] ?>"><?php echo $value['area_name'] ?></option>
			                            	
			                           <?php } ?>

			                        </select>
			                        </div>
			                    </div>
    						</div>
    						<div class="row">
			                    <div class="col-md-3">
			                        <div class="form-group">
			                            <label for="design">Subrea<i style="color:red; font-size:14px;" >*</i></label>
			                        </div>
			                    </div>

			                    <div class="col-md-3">
			                        <div class="form-group">
			                            <?php echo form_input(array('name' => 'subarea_name', 'id' => 'subarea_name', 'required' => 'required','class' => 'form-control','placeholder' => $subarea['subarea_name'], 'value' => $subarea['subarea_name'])) ?>
			                        </div>
			                    </div>

			                    <input type="hidden" name="subarea_id" value="<?php echo $subarea['subarea_id'] ; ?>">

			                  

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