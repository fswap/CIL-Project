<div class="container">
	<div class="row">
		<div class="col-md-2 col-sm-2">
		</div>
		<div class="col-md-8 col-sm-8">
			<?php echo form_open_multipart('allmines/save_allmine'); ?>

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
			                <h3 class="box-title" align="center"><?php echo $header.'<br><br>';?></h3>
			            </div>

			            <div class="box-body">

			                <div class="row">
			                	<div class="col-md-2">
			                	</div>

			                    <div class="col-md-3">
			                        <div class="form-group">
			                            <label for="sub_name">Subsidiary<i style="color:red; font-size:14px;" >*</i></label>
			                        </div>
			                    </div>

			                    <div class="col-md-3">
			                        <div class="form-group">
			                            <?php /* echo form_input(array('name' => 'sub_name', 'id' => 'sub_name', 'placeholder' => 'Subsidiary', 'class' => 'form-control')) */ ?>
                                        <select class="form-control" name="sub_id">
			                            <option>select</option>

			                            <?php foreach ($subsidiary as $value) { ?>

			                            	<option value="<?php echo $value['sub_id'] ?>"><?php echo $value['sub_name'] ?></option>
			                            	
			                           <?php } ?>

			                        </select>
			                        </div>
			                    </div>
			                </div>
			                <div class="row">
			                	<div class="col-md-2">
			                	</div>

			                    <div class="col-md-3">
			                        <div class="form-group">
			                            <label for="area_name">Area<i style="color:red; font-size:14px;" >*</i></label>
			                        </div>
			                    </div>

			                    <div class="col-md-3">
			                        <div class="form-group">
			                            <?php /* echo form_input(array('name' => 'sub_name', 'id' => 'sub_name', 'placeholder' => 'Subsidiary', 'class' => 'form-control')) */ ?>
                                        <select class="form-control" name="area_id">
			                            <option>select</option>

			                            <?php foreach ($area as $value) { ?>

			                            	<option value="<?php echo $value['area_id'] ?>"><?php echo $value['area_name'] ?></option>
			                            	
			                           <?php } ?>

			                        </select>
			                        </div>
			                    </div>
			                </div>

			                <div class="row">
			                	<div class="col-md-2">
			                	</div>

			                    <div class="col-md-3">
			                        <div class="form-group">
			                            <label for="subarea_name">Subrea<i style="color:red; font-size:14px;" >*</i></label>
			                        </div>
			                    </div>

			                    <div class="col-md-3">
			                        <div class="form-group">
			                            <?php /* echo form_input(array('name' => 'sub_name', 'id' => 'sub_name', 'placeholder' => 'Subsidiary', 'class' => 'form-control')) */ ?>
                                        <select class="form-control" name="subarea_id">
			                            <option>select</option>

			                            <?php foreach ($subarea as $value) { ?>

			                            	<option value="<?php echo $value['subarea_id'] ?>"><?php echo $value['subarea_name'] ?></option>
			                            	
			                           <?php } ?>

			                        </select>
			                        </div>
			                    </div>
			                </div>
			                <div class="row">
			                    <div class="col-md-2">
			                	</div>
			                    <div class="col-md-3">
			                        <div class="form-group">
			                            <label for="mine_name">Mine<i style="color:red; font-size:14px;" >*</i></label>
			                        </div>
			                    </div>

			                    <div class="col-md-3">
			                        <div class="form-group">
			                            <?php echo form_input(array('name' => 'mine_name', 'id' => 'mine_name', 'placeholder' => 'Mine', 'class' => 'form-control')) ?>
			                        </div>
			                    </div>

			                </div>

			                <div class="row">
			                	<div class="col-md-2">
			                	</div>

			                    <div class="col-md-3">
			                        <div class="form-group">
			                            <label for="mine_type">Mine Type<i style="color:red; font-size:14px;" >*</i></label>
			                        </div>
			                    </div>

			                    <div class="col-md-3">
			                        <div class="form-group">
			                            <?php /* echo form_input(array('name' => 'sub_name', 'id' => 'sub_name', 'placeholder' => 'Subsidiary', 'class' => 'form-control')) */ ?>
                                        <select class="form-control" name="mine_id">
			                            <option>select</option>

			                            <?php foreach ($mine_type as $value) { ?>

			                            	<option value="<?php echo $value['mine_id'] ?>"><?php echo $value['minecategory'] ?></option>
			                            	
			                           <?php } ?>

			                        </select>
			                        </div>
			                    </div>
			                </div>

			                <div class="row">
			                	<div class="col-md-2">
			                	</div>

			                    <div class="col-md-3">
			                        <div class="form-group">
			                            <label for="year_name">Year<i style="color:red; font-size:14px;" >*</i></label>
			                        </div>
			                    </div>

			                    <div class="col-md-3">
			                        <div class="form-group">
			                            <?php /* echo form_input(array('name' => 'sub_name', 'id' => 'sub_name', 'placeholder' => 'Subsidiary', 'class' => 'form-control')) */ ?>
                                        <select class="form-control" name="year_id">
			                            <option>select</option>

			                            <?php foreach ($year as $value) { ?>

			                            	<option value="<?php echo $value['year_id'] ?>"><?php echo $value['year_name'] ?></option>
			                            	
			                           <?php } ?>

			                        </select>
			                        </div>
			                    </div>
			                </div>

			                <div class="row">
			                    <div class="col-md-2">
			                	</div>
			                    <div class="col-md-3">
			                        <div class="form-group">
			                            <label for="SR">SR<i style="color:red; font-size:14px;" ></i></label>
			                        </div>
			                    </div>

			                    <div class="col-md-3">
			                        <div class="form-group">
			                            <?php echo form_input(array('name' => 'SR', 'id' => 'SR', 'placeholder' => 'SR', 'class' => 'form-control')) ?>
			                        </div>
			                    </div>

			                </div>

			                <div class="row">
			                    <div class="col-md-2">
			                	</div>
			                    <div class="col-md-3">
			                        <div class="form-group">
			                            <label for="coal">Coal<i style="color:red; font-size:14px;" >*</i></label>
			                        </div>
			                    </div>

			                    <div class="col-md-3">
			                        <div class="form-group">
			                            <?php echo form_input(array('name' => 'coal', 'id' => 'coal', 'placeholder' => 'Coal', 'class' => 'form-control')) ?>
			                        </div>
			                    </div>

			                </div>

			                <div class="row">
			                    <div class="col-md-2">
			                	</div>
			                    <div class="col-md-3">
			                        <div class="form-group">
			                            <label for="OBR">OBR<i style="color:red; font-size:14px;" ></i></label>
			                        </div>
			                    </div>

			                    <div class="col-md-3">
			                        <div class="form-group">
			                            <?php echo form_input(array('name' => 'OBR', 'id' => 'OBR', 'placeholder' => 'OBR', 'class' => 'form-control')) ?>
			                        </div>
			                    </div>

			                </div>

			                <div class="row">
			                    <div class="col-md-2">
			                	</div>
			                    <div class="col-md-3">
			                        <div class="form-group">
			                            <label for="tot_excavation">Total Excavation<i style="color:red; font-size:14px;" ></i></label>
			                        </div>
			                    </div>

			                    <div class="col-md-3">
			                        <div class="form-group">
			                            <?php echo form_input(array('name' => 'tot_excavation', 'id' => 'tot_excavation', 'placeholder' => 'Total Excavation', 'class' => 'form-control')) ?>
			                        </div>
			                    </div>

			                </div>
			                <div class="row">
			                    <div class="col-md-2">
			                	</div>
			                    <div class="col-md-3">
			                        <div class="form-group">
			                            <label for="production">Departmental Production<i style="color:red; font-size:14px;" >*</i></label>
			                        </div>
			                    </div>

			                    <div class="col-md-3">
			                        <div class="form-group">
			                            <?php echo form_input(array('name' => 'production', 'id' => 'production', 'placeholder' => 'Departmental Production', 'class' => 'form-control')) ?>
			                        </div>
			                    </div>

			                </div>

			                <div class="row">
			                    <div class="col-md-2">
			                	</div>
			                    <div class="col-md-3">
			                        <div class="form-group">
			                            <label for="production">Total Production<i style="color:red; font-size:14px;" >*</i></label>
			                        </div>
			                    </div>

			                    <div class="col-md-3">
			                        <div class="form-group">
			                            <?php echo form_input(array('name' => 'total production', 'id' => 'tot_production', 'placeholder' => 'Total Production', 'class' => 'form-control')) ?>
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