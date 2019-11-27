 <?php
$arr = array();

?>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>



<div class="container">

	
	<center><h3> Input data for Area-Wise Existing Manpower </h3> </center>


	<div class="form-container">
		<div class="form-container-form">
			<form class="form-horizontal" method="POST" action="<?=site_url('pages/get_existing_for_area')?>">
				

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

				<div class="form-group"> 
					<div class="col-sm-offset-2 col-sm-10">
						<button name="login" type="submit" class="btn btn-primary">Submit</button>
					</div>
				</div>
			</form>
			
		</div>

	</div>

		
		<!--<form method="post" id="import_csv" action="<?php echo base_url();?>index.php/pages/importcsv" enctype="multipart/form-data">
   <div class="form-group" >
    <label>Select CSV File</label>
    <input type="file" name="csv_file" id="csv_file" required accept=".csv" />
   
   </div>
   
   <button type="submit" name="import_csv" class="btn btn-info" id="import_csv_btn">Import CSV</button>
  </form>

  <div align="center">
		<label>Click here to download Format of CSV file</label>
		<br/>
		<a href="<?php echo site_url('pages/std_data_excel_format')?>" class= "btn btn-primary ">Download</a>

	</div>-->
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
  }
 });

 
});
</script>