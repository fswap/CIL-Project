 <?php
$arr = array();
?>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>



<div class="container">

	
	<center><h3> Input data for comparision of Mine-Wise Manpower </h3> </center>
	<br>

	<div class="form-container">
		<div class="form-container-form">
			<form class="form-horizontal" method="POST" action="<?=site_url('pages/get_compare_for_mine')?>">
				<!--<div class="form-group">
					<label class="control-label col-sm-2" for="minename">Mine Name:</label>
					<div class="col-sm-10"> 
						<input name="minename" type="text" class="form-control" id="minename" placeholder="Enter the name of mine ">
					</div>
				</div>-->

				<div class="form-group">
					<label class="control-label col-sm-2" for="sub_name">Subsidiary:</label>
					<div class="col-sm-10">
					 <select name="sub_name" id="sub_name" class="form-control input-lg" >
				     <option value="">Select Subsidiary</option>
					  <?php
					  foreach($sub_name as $row)
					  {
					     echo '<option value="'.$row->sub_id.'">'.$row->sub_name.'</option>';
					  }
					  ?>
					 </select>
					 </div>
				</div>


				<div class="form-group">
					<label class="control-label col-sm-2" for="area_name">Area:</label>
					<div class="col-sm-10">
				   <select name="area_name" id="area_name" class="form-control input-lg">
				    <option value="">Select Area</option>
				   </select>
				    </div>
				 </div>


				 <div class="form-group">
					<label class="control-label col-sm-2" for="subarea_name">Subarea:</label>
					<div class="col-sm-10">
				   <select name="subarea_name" id="subarea_name" class="form-control input-lg">
				    <option value="">Select Subarea</option>
				   </select>
				    </div>
				 </div>


				 <div class="form-group">
					<label class="control-label col-sm-2" for="mine_name">Mine:</label>
					<div class="col-sm-10">
				   <select name="mine_name" id="mine_name" class="form-control input-lg">
				    <option value="">Select Mine</option>
				   </select>
				    </div>
				 </div>


				<div class="form-group">
					<label class="control-label col-sm-2" for="minecategory">Mine Type:</label>
					<div class="col-sm-10">
				   <select name="minecategory" id="minecategory" class="form-control input-lg">
				    <option value="">Select Mine Type</option>
				    <!--<?php
					  foreach($minecategory as $row)
					  {
					     echo '<option value="'.$row->mine_id.'">'.$row->minecategory.'('.$row->munit.')</option>';
					  }
					  ?>-->
				   </select>
				    </div>
				 </div>
				 <div class="form-group">
					<label class="control-label col-sm-2" for="year_name">Year:</label>
					<div class="col-sm-10">
					 <select name="year_name" id="year_name" class="form-control input-lg" >
				     <option value="">Select Year</option>
					  <?php
					  foreach($year_name as $row)
					  {
					     echo '<option value="'.$row->year_id.'">'.$row->year_name.'</option>';
					  }
					  ?>
					 </select>
					 </div>
				</div>

				<!-- <div class="form-group">
					<label class="control-label col-sm-2" for="mine-production">Production Data:</label>
					<div class="col-sm-10"> 
						<input name="mine_production" type="number" class="form-control" id="mine-production" placeholder="Enter the mine production" step="0.01" min="0" required>
					</div>
				</div>-->

								<!--<div class="form-group">
					<label class="control-label col-sm-2" for="mine-production">Production Data:</label>
					<div class="col-sm-10"> 
						<input name="mine_production" type="number" class="form-control" id="mine-production" placeholder="Enter the mine production" step="0.01" min="0" required>
					</div>
				</div>-->
				<div class="form-group"> 
					<div class="col-sm-offset-2 col-sm-10">
						<button name="login" type="submit" class="btn btn-primary">Submit</button>
					</div>
				</div>
			</form>
			
		</div>

	</div>

 </div>
</body>
</html>





<style type="text/css">
.form-container{
	display: flex;
	min-height: 60vh;
	justify-content: center;
	align-items: center;
}

.form-container-form{
	width: 100%;
}
</style>




<script>
$(document).ready(function(){
 $('#sub_name').change(function(){
  var sub_id = $('#sub_name').val();
  if(sub_id != '')
  {
   $.ajax({
    url:"<?php echo base_url(); ?>index.php/pages/fetch_area",
    method:"POST",
    data:{sub_id:sub_id},
    success:function(data)
    {
     $('#area_name').html(data);
     $('#subarea_name').html('<option value="">Select Subarea</option>');
    }
   });
  }
  else
  {
   $('#area_name').html('<option value="">Select Area</option>');
   $('#subarea_name').html('<option value="">Select Subarea</option>');
   $('#mine_name').html('<option value="">Select Mine</option>');
   $('#minecategory').html('<option value="">Select Mine Type</option>');
  }
 });

 $('#area_name').change(function(){
  var area_id = $('#area_name').val();
  if(area_id != '')
  {
   $.ajax({
    url:"<?php echo base_url(); ?>index.php/pages/fetch_subarea",
    method:"POST",
    data:{area_id:area_id},
    success:function(data)
    {
     $('#subarea_name').html(data);
    }
   });
  }
  else
  {
   $('#subarea_name').html('<option value="">Select Subarea</option>');
   $('#mine_name').html('<option value="">Select Mine</option>');
   $('#minecategory').html('<option value="">Select Mine Type</option>');
  }
 });

 $('#subarea_name').change(function(){
  var subarea_id = $('#subarea_name').val();
  if(subarea_id != '')
  {
   $.ajax({
    url:"<?php echo base_url(); ?>index.php/pages/fetch_mines",
    method:"POST",
    data:{subarea_id:subarea_id},
    success:function(data)
    {
     $('#mine_name').html(data);
    }
   });
  }
  else
  {
   $('#mine_name').html('<option value="">Select Mine</option>');
   $('#minecategory').html('<option value="">Select Mine Type</option>');
  }
 });
 
 $('#mine_name').change(function(){
  var mine_id = $('#mine_name').val();
  if(mine_id != '')
  {
   $.ajax({
    url:"<?php echo base_url(); ?>index.php/pages/fetch_minetype",
    method:"POST",
    data:{mine_id:mine_id},
    success:function(data)
    {
     $('#minecategory').html(data);
    }
   });
  }
  else
  {
   $('#minecategory').html('<option value="">Select Mine Type</option>');
  }
 });
 
});
</script>
<!-- <form  method="POST"  >

	<div class="col-md-7">

		<div class="form-group">
			MineType:

			<?php

			//echo form_dropdown('submine', $arr, '', 'class="form-control" name = "mine_type" id="submine"');
			?>
			Name Of Mine :
			<input type="text" class="form-control" name = "mine_name" id="mine_name">

			Location : 
			<input type="text" class="form-control" name = "mine_location" id="mine_location">
			Production Quantity :
			<input type="number" class="form-control" name = "mine_production" id="mine_production" step="0.1">

			<input type="submit" value="Submit"  id="mine_submit">

		</div>
	</form> -->
