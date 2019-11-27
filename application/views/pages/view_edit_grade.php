<div class="container">
	<div class="row">
		<div class="col-md-2 col-sm-2">
		</div>
		<div class="col-md-8 col-sm-8">

			<div class="row">

				<div class="col-sm-2 col-md-2">
					<?php echo '<a href="'.site_url("Pages/add_grade").'"<button class="btn btn-primary">Add Grade</button></a>'; ?>
				</div>

				<div class="col-sm-2 col-md-2">
					<?php echo '<a href="'.site_url("Pages/select_edit_grade").'"<button class="btn btn-primary">Edit Grade</button></a>'; ?>
				</div>

				<!-- Option to delete grade
				<div class="col-sm-4 col-md-4">
					<?php echo '<a href="'.site_url("Pages/select_delete_grade").'"<button class="btn btn-primary">Delete Grade</button></a>'; ?>
				</div> -->

			</div>

			<?php echo form_open_multipart('Pages/update_grade'); ?>

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
			                        <div class="form-group">
			                            <label for="grade">Grade<i style="color:red; font-size:14px;" >*</i></label>
			                        </div>
			                    </div>

			                    <div class="col-md-3">
			                        <div class="form-group">
			                            <?php echo form_input(array('name' => 'grade', 'id' => 'grade', 'placeholder' => $prev['grade'], 'value' => $prev['grade'], 'required' => 'required', 'class' => 'form-control')) ?>
			                        </div>
			                    </div>

			                    <div class="col-md-3">
			                        <div class="form-group">
			                            <label for="design">Designation<i style="color:red; font-size:14px;" >*</i></label>
			                        </div>
			                    </div>

			                    <div class="col-md-3">
			                        <div class="form-group">
			                            <?php echo form_input(array('name' => 'design', 'id' => 'design', 'required' => 'required','class' => 'form-control','placeholder' => $prev['design'], 'value' => $prev['design'])) ?>
			                        </div>
			                    </div>

			                    <div class="col-md-3">
			                        <div class="form-group">
			                            <label for="remark">Remark(if any)</label>
			                        </div>
			                    </div>

			                    <div class="col-md-3">
			                        <div class="form-group">
			                            <?php echo form_input(array('name' => 'remark', 'id' => 'remark', 'placeholder' => $prev['remark'], 'value' => $prev['remark'], 'class' => 'form-control')) ?>
			                        </div>
			                    </div>

			                    <div class="col-md-3">
			                        <div class="form-group">
			                            <label for="discipline">Discipline<i style="color:red; font-size:14px;" >*</i></label>
			                        </div>
			                    </div>

			                    <div class="col-md-3">
			                        <div class="form-group">
			                           <?php
			                               $options = array(
			                                    '' => 'Select Option',
			                                    'a' => 'All Discipline (except Medical)',
			                                    'm' => 'Medical'
			                                );
			                                echo form_dropdown('discipline', $options, $prev['discipline'], 'class="form-control" id="discipline" required="required"');
			                            ?>
			                       </div>
			                    </div>
			                    <!-- Script to retain the value of discipline -->
			                    <script type="text/javascript">
			                        document.getElementById('discipline').value = "<?php echo $_POST['discipline'];?>";
			                    </script>

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