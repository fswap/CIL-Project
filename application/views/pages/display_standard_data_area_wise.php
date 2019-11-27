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
		</tbody>
	</table>
	<hr>
	
	<div class="row">
		<div class="col-sm-2 col-md-2">
		<a class= "btn btn-success ">Export as Excel Sheet </a>
		</div>
		
	</div>
	
	<br><br><br>
	
	
	<table class="table table-bordered">

		<thead>
			
			<th>Cadre</th>
			<th>Grade</th>
			<th>Total Req. of emp.</th>
			<!--<th>Info.</th>-->
			
		</thead>
		<tbody>
			<?php foreach ($values as $key): ?>
				<tr>
					<!--<?php if (!is_null($key['scopeofwork'])):?>
						<td><?=$key['dept_name']?></td>
					<?php else: ?>
						<td><?=$key['dept_name'].' ('.$key['scopeofwork'].')'?></td>
					<?php endif;?>-->
					<td><?=$key['cadre']?></td>
					<td><?=$key['grade']?></td>
					<td><?=$key['no_of_emp']?></td>
					<!--<td><?=$key['info']?></td>-->
					
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
