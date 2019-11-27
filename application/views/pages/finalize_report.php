<div class="container">
<div id="css_include">
	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/print.css')?>">
</div>

	<table class="table table-bordered">
		<tbody>
			<tr>
				<td>Mine Type</td>
				<td><?=$mine_type?></td>
			</tr>
			<tr>
				<td>Production</td>
				<td><?=$production?></td>
			</tr>
		</tbody>

	</table>
	<hr>
	<div class="col-sm-2">
		
		<a href="<?php echo site_url()?>" class= "btn btn-success ">Export as Excel Sheet </a>

	</div>
	<br></br>
	<h3>Result  :</h3>
	<table class="table table-bordered">
		<thead>
			<th>Department</th>
			<th>Cadre</th>
			<th>Grade</th>
			<th>Req. No. of emp.</th>
			<th>Curr. No. of emp.</th>
			<th>Status </th>
		</thead>
		<tbody>
			<?php $temp =0;$status ="Normal"; $color="#FFFFFF"?>
			<?php foreach ($combine as $key): ?>
				<?php 
					if((int )$key[4]>(int )$key[3])
					 {	$temp = ((int)$key[4] - (int)$key[3]);
					 	$status = "Surplus".' = '.$temp;
					 	$color = "#d9ffcc";
					 }
					 elseif((int )$key[4]<(int )$key[3])
					 {
					 	$temp=((int)$key[3] - (int)$key[4]);
					 	$status = "Deficient".' = '.$temp;
                        $color = "#ffe6e6";
					 }
					 else 
					 {
					 		$temp= 0;
					 		$status = "Normal"; 
					 		$color="#FFFFFF";
					 }


				?>
				<tr bgcolor= <?php echo $color; ?>>
					<td><?=$key[0]?></td>
					<td><?=$key[1]?></td>
					<td><?=$key[2]?></td>
					<td><?=$key[3]?></td>
					<td><?=$key[4]?></td>


					<td><?=$status ?></td>
				</tr>
			<?php endforeach ?>

		</tbody>
	</table>
<!-- 
	<hr>
	<h3>Deficient  :</h3>
	<table class="table table-bordered">
		<thead>
			<th>Department</th>
			<th>Cadre</th>
			<th>Grade</th>
			<th>Actual</th>
			<th>Current</th>
			<th>deficent</th>
		</thead>
		<tbody>
			<?php //foreach ($deficent as $key): ?>
				<tr>
					<td><?=$key[0]?></td>
					<td><?=$key[1]?></td>
					<td><?=$key[2]?></td>
					<td><?=$key[3]?></td>
					<td><?=$key[4]?></td>
					<td><?=((int)$key[3] - (int)$key[4])?></td>
				</tr>
			<?php //endforeach ?>
	
		</tbody>
	</table> -->
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