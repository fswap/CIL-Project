<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<center><h3> Upload Standard Manpower Data(Dynamic) </h3> </center>
<hr>
<div class="container">
	<div align="center">
		<label>Click here to download Format of CSV file</label>
		<br/>
		<a href="<?php echo site_url('pages/std_data_dynamic_excel_format')?>" class= "btn btn-primary ">Download</a>

	</div>
	<br><br>

	<form method="post" id="import_csv" action="<?php echo base_url();?>index.php/pages/importcsv_dynamic" enctype="multipart/form-data">
   <div class="form-group" >
    <label>Select CSV File</label>
    <input type="file" name="csv_file" id="csv_file" required accept=".csv" />
   
   </div>
   
   <button type="submit" name="import_csv" class="btn btn-info" id="import_csv_btn">Import CSV</button>
  </form>

  
</div>
</body>
</html>>