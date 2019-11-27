<div class="container">
<div id="css_include">
	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/print.css')?>">
</div>

	<table class="table table-bordered">
		<tbody>
			<tr>
				<td>Subsidiary</td>
				<td><?=$sub_name?></td>
			</tr>
			<tr>
				<td>Area</td>
				<td><?=$area_name?></td>
			</tr>
			<tr>
				<td>Year</td>
				<td><?=$year_name?></td>
			</tr>
			<!--<tr>
				<td>Production</td>
				<td><?=$production?></td>
			</tr>-->
		</tbody>
	</table>
	<hr>
	
	<div class="row">
		<div class="col-sm-2 col-md-2">
		<a href="<?php echo site_url()?>" class= "btn btn-success ">Export as Excel Sheet </a>
		</div>

		<!--<div class="col-sm-2 col-md-2">
		<a  href="<?php echo base_url();?>index.php/pages/select_edit_standard_data" class= "btn btn-primary ">Edit Standard Data</a>
		</div>-->

	</div>
	
	<br><br><br>
	
	
	<table class="table table-bordered">

		<thead>
			<th>Cadre</th>
			<th>E1</th>
			<th>E2</th>
			<th>E3</th>
			<th>E4</th>
			<th>E5</th>
			<th>E6</th>
			<th>E7</th>
			<th>E8</th>

			
		</thead>
		<tbody>
			<?php foreach ($values as $key): ?>
				<tr>
					<td><?=$key['cadre']?></td>
					<td><?=$key['e1']?></td>
					<td><?=$key['e2']?></td>
					<td><?=$key['e3']?></td>
					<td><?=$key['e4']?></td>
					<td><?=$key['e5']?></td>
					<td><?=$key['e6']?></td>
					<td><?=$key['e7']?></td>
					<td><?=$key['e8']?></td>
					
				</tr>
			<?php endforeach ?>

		</tbody>
	</table>

	
	<div class="row">
		<div class="col-sm-5"></div>
		<div class="col-sm-2">
			<div class="btn btn-primary" onclick="printer(this)">
				Print
			</div>
		</div>
	</div>


</div>

<script type="text/javascript">
	function printer(){
		$(".btn").hide();
		$('.navbar').hide();
		window.print();
		$(".btn").show();
		$('.navbar').show();
	}
	
</script>
