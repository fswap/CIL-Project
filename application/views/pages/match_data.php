<?php
$arr = array();
$arr[-1]= "--Select--";
$i=0;
foreach($mine as $m )
{
	$arr[$m['mine_id']] = $m['minecategory']."(".$m['munit'].")";
}

?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

<body style=" background-image: url('<?php echo  base_url("assets/images/buringCoal.jpg"); ?>') ; background-position: center center;
    background-size: 100% 100%; ">

<div class="container" >
	<center><h1 style="color:#FFFFFF"> Input Mine data  </h1> </center>
	<div class="form-container">
		<div class="form-container-form">
			<form class="form-horizontal" method="POST" action="<?=site_url('pages/entry-data')?>">
				<div class="form-group">
					<label class="control-label col-sm-2" for="submine"  style="color:#FFFFFF">MineType:</label>
					<div class="col-sm-10">
						<?php
						echo form_dropdown('submine', $arr, '', 'class="form-control" name = "mine_type" id="submine"');
						?>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="mine-production" style="color:#FFFFFF">Production Data:</label>
					<div class="col-sm-10"> 
						<input name="mine_production" type="number" class="form-control" id="mine-production" placeholder="Enter the mine production" step="0.01" min="0">
					</div>
				</div>
				<div class="form-group"> 
					<div class="col-sm-offset-2 col-sm-10">
						<button name="login" type="submit" class="btn btn-primary">Submit</button>
					</div>
				</div>
			</form>
			</br></br>
			<form class="form-horizontal" method="POST" action="<?=site_url('pages/department_cadre_excel')?>">
			<div class="row">
			<div class="form-group">
					<label class="control-label col-sm-1" for="sub_name" style="color:white;" required>Subsidiary:</label>
					<div class="col-sm-5">
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
					<label class="control-label col-sm-1" for="area_name" style="color:white;">Area:</label>
					<div class="col-sm-5">
				   <select name="area_name" id="area_name" class="form-control input-lg">
				    <option value="">Select Area</option>
				   </select>
				    </div>
			</div>
			</div>
			<div class="row">
				 <div class="form-group">
					<label class="control-label col-sm-1" for="subarea_name" style="color:white;">Subarea:</label>
					<div class="col-sm-5">
				   <select name="subarea_name" id="subarea_name" class="form-control input-lg">
				    <option value="">Select Subarea</option>
				   </select>
				    </div>
				 </div>


				 <div class="form-group">
					<label class="control-label col-sm-1" for="mine_name" style="color:white;">Mine:</label>
					<div class="col-sm-5">
				   <select name="mine_name" id="mine_name" class="form-control input-lg">
				    <option value="">Select Mine</option>
				   </select>
				    </div>
				 </div>
				 </div>
			<div align="center">
			<label  style="color:white;">Click here to download Format of CSV file</label>
			<br/>
			<button name="login" type="submit" class="btn btn-primary">Download</button>

			</div>
		</form>
		</div>
	</div>
</div>


<style type="text/css">
.form-container{
	display: flex;
	min-height: 80vh;
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
  }
 });
 
});
</script>
<!-- <form  method="POST"  >

	<div class="col-md-7">

		<div class="form-group">
			MineType:

			<?php

			echo form_dropdown('submine', $arr, '', 'class="form-control" name = "mine_type" id="submine"');
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
