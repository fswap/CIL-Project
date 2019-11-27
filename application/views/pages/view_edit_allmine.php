<div class="container">
	<div class="row">
		<div class="col-md-2 col-sm-2">
		</div>
		<div class="col-md-8 col-sm-8">

			<?php echo form_open_multipart('allmines/update_allmine'); ?>

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
								        'name'  => 'mine_id',
								        'id'    => 'mine_id',
								        'value' => $mine['mine_id'],
								        'class' => 'mine_id'
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



			                            	<option <?php if($mine['sub_id']==$value['sub_id']){echo 'selected';} ?> value="<?php echo $value['sub_id'] ?>"><?php echo $value['sub_name'] ?></option>
			                            	
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



			                            	<option <?php if($mine['area_id']==$value['area_id']){echo 'selected';} ?> value="<?php echo $value['area_id'] ?>"><?php echo $value['area_name'] ?></option>
			                            	
			                           <?php } ?>

			                        </select>
			                        </div>
			                    </div>
    						</div>

    						<div class="row">

			                	<div class="col-md-3">
			                        <div class="form-group">
			                            <label for="grade">Subarea<i style="color:red; font-size:14px;" >*</i></label>
			                        </div>
			                    </div>
			                     <div class="col-md-3">
			                        <div class="form-group">
			                            <?php /*echo form_input(array('name' => 'sub_name', 'id' => 'sub_name', 'placeholder' => $area['sub_name'], 'value' => $area['sub_name'], 'required' => 'required', 'class' => 'form-control')) */ ?>

			                            <select class="form-control" name="subarea_id">
			                            

			                            <?php  foreach ($subarea as $value) { echo "value".$value['subarea_id']; ?>



			                            	<option <?php if($mine['subarea_id']==$value['subarea_id']){echo 'selected';} ?> value="<?php echo $value['subarea_id'] ?>"><?php echo $value['subarea_name'] ?></option>
			                            	
			                           <?php } ?>

			                        </select>
			                        </div>
			                    </div>
    						</div>
			                

			                
    						<div class="row">
			                    <div class="col-md-3">
			                        <div class="form-group">
			                            <label for="design">Mine<i style="color:red; font-size:14px;" >*</i></label>
			                        </div>
			                    </div>

			                    <div class="col-md-3">
			                        <div class="form-group">
			                            <?php echo form_input(array('name' => 'mine_name', 'id' => 'mine_name', 'required' => 'required','class' => 'form-control','placeholder' => $mine['mine_name'], 'value' => $mine['mine_name'])) ?>
			                        </div>
			                    </div>

			                    <input type="hidden" name="mine_id" value="<?php echo $mine['mine_id'] ; ?>">

			                  

			                </div>

			                <div class="row">

			                	<div class="col-md-3">
			                        <div class="form-group">
			                            <label for="grade">Mine Type<i style="color:red; font-size:14px;" >*</i></label>
			                        </div>
			                    </div>
			                     <div class="col-md-3">
			                        <div class="form-group">
			                            <?php /*echo form_input(array('name' => 'sub_name', 'id' => 'sub_name', 'placeholder' => $area['sub_name'], 'value' => $area['sub_name'], 'required' => 'required', 'class' => 'form-control')) */ ?>

			                            <select class="form-control" name="mine_type">
			                            

			                            <?php  foreach ($mine_type as $value) { echo "value".$value['mine_id']; ?>



			                            	<option <?php if($mine_type['mine_id']==$value['mine_id']){echo 'selected';} ?> value="<?php echo $value['mine_id'] ?>"><?php echo $value['minecategory'] ?></option>
			                            	
			                           <?php } ?>

			                        </select>
			                        </div>
			                    </div>
    						</div>
			                <div class="row">

			                	<div class="col-md-3">
			                        <div class="form-group">
			                            <label for="grade">Year<i style="color:red; font-size:14px;" >*</i></label>
			                        </div>
			                    </div>
			                     <div class="col-md-3">
			                        <div class="form-group">
			                            <?php /*echo form_input(array('name' => 'sub_name', 'id' => 'sub_name', 'placeholder' => $area['sub_name'], 'value' => $area['sub_name'], 'required' => 'required', 'class' => 'form-control')) */ ?>

			                            <select class="form-control" name="year_id">
			                            

			                            <?php  foreach ($year as $value) { echo "value".$value['year_id']; ?>



			                            	<option <?php if($year['year_id']==$value['year_id']){echo 'selected';} ?> value="<?php echo $value['year_id'] ?>"><?php echo $value['year_name'] ?></option>
			                            	
			                           <?php } ?>

			                        </select>
			                        </div>
			                    </div>
    						</div>

    						<div class="row">
			                    <div class="col-md-3">
			                        <div class="form-group">
			                            <label for="design">SR<i style="color:red; font-size:14px;" ></i></label>
			                        </div>
			                    </div>

			                    <div class="col-md-3">
			                        <div class="form-group">
			                            <?php echo form_input(array('name' => 'SR', 'id' => 'SR','class' => 'form-control','placeholder' => $mine['SR'], 'value' => $mine['SR'])) ?>
			                        </div>
			                    </div>

			                    

			                  

			                </div>

			                <div class="row">
			                    <div class="col-md-3">
			                        <div class="form-group">
			                            <label for="design">Coal<i style="color:red; font-size:14px;" >*</i></label>
			                        </div>
			                    </div>

			                    <div class="col-md-3">
			                        <div class="form-group">
			                            <?php echo form_input(array('name' => 'coal', 'id' => 'coal', 'required' => 'required','class' => 'form-control','placeholder' => $mine['coal'], 'value' => $mine['coal'])) ?>
			                        </div>
			                    </div>

			                    

			                  

			                </div>

			                <div class="row">
			                    <div class="col-md-3">
			                        <div class="form-group">
			                            <label for="design">OBR<i style="color:red; font-size:14px;" ></i></label>
			                        </div>
			                    </div>

			                    <div class="col-md-3">
			                        <div class="form-group">
			                            <?php echo form_input(array('name' => 'OBR', 'id' => 'OBR', 'class' => 'form-control','placeholder' => $mine['OBR'], 'value' => $mine['OBR'])) ?>
			                        </div>
			                    </div>

			                   

			                  

			                </div>

			                <div class="row">
			                    <div class="col-md-3">
			                        <div class="form-group">
			                            <label for="design">Total Excavation<i style="color:red; font-size:14px;" ></i></label>
			                        </div>
			                    </div>

			                    <div class="col-md-3">
			                        <div class="form-group">
			                            <?php echo form_input(array('name' => 'tot_excavation', 'id' => 'tot_excavation', 'class' => 'form-control','placeholder' => $mine['tot_excavation'], 'value' => $mine['tot_excavation'])) ?>
			                        </div>
			                    </div>

			                    <input type="hidden" name="mine_id" value="<?php echo $mine['mine_id'] ; ?>">

			                  

			                </div>

			                <div class="row">
			                    <div class="col-md-3">
			                        <div class="form-group">
			                            <label for="design">Production<i style="color:red; font-size:14px;" >*</i></label>
			                        </div>
			                    </div>

			                    <div class="col-md-3">
			                        <div class="form-group">
			                            <?php echo form_input(array('name' => 'production', 'id' => 'production', 'required' => 'required','class' => 'form-control','placeholder' => $mine['production'], 'value' => $mine['production'])) ?>
			                        </div>
			                    </div>

			                    <input type="hidden" name="mine_id" value="<?php echo $mine['mine_id'] ; ?>">

			                  

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