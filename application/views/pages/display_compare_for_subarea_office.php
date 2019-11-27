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
				<td>Subarea Office</td>
				<td><?=$subarea_name?></td>
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
					<td <?php $x1 = $key['newe1']; 
					if (preg_match("/-/", $x1))
					{
						echo "style="."background-color:"."LightPink;";
					}
					else if($x1==0)
					{
						echo "style="."background-color:"."LightGray;";
					}
					else
					{
						echo "style="."background-color:"."LightGreen;";
					}  
					?>><?= $key['newe1'];?></td>
					<td <?php $x2 = $key['newe2']; 
					 if (preg_match("/-/", $x2))
					{
						echo "style="."background-color:"."LightPink;";
					}
					else if($x2==0)
					{
						echo "style="."background-color:"."LightGray;";
					}
					else
					{
						echo "style="."background-color:"."LightGreen;";
					}
					?>><?= $key['newe2']; ?></td>
					<td <?php $x3 = $key['newe3']; 
					 if (preg_match("/-/", $x3))
					{
						echo "style="."background-color:"."LightPink;";
					}
					else if($x3==0)
					{
						echo "style="."background-color:"."LightGray;";
					}
					else
					{
						echo "style="."background-color:"."LightGreen;";
					}
					?>><?=$key['newe3']?></td>
					<td <?php $x4 = $key['newe4']; 
					 if (preg_match("/-/", $x4))
					{
						echo "style="."background-color:"."LightPink;";
					}
					else if($x4==0)
					{
						echo "style="."background-color:"."LightGray;";
					}
					else
					{
						echo "style="."background-color:"."LightGreen;";
					}
					?>><?=$key['newe4']?></td>
					<td <?php $x5 = $key['newe5']; 
					 if (preg_match("/-/", $x5))
					{
						echo "style="."background-color:"."LightPink;";
					}
					else if($x5==0)
					{
						echo "style="."background-color:"."LightGray;";
					}
					else
					{
						echo "style="."background-color:"."LightGreen;";
					}
					?>><?=$key['newe5']?></td>
					<td <?php $x6 = $key['newe6']; 
					 if (preg_match("/-/", $x6))
					{
						echo "style="."background-color:"."LightPink;";
					}
					else if($x6==0)
					{
						echo "style="."background-color:"."LightGray;";
					}
					else
					{
						echo "style="."background-color:"."LightGreen;";
					}
					?>><?=$key['newe6']?></td>
					<td <?php $x7 = $key['newe7']; 
					 if (preg_match("/-/", $x7))
					{
						echo "style="."background-color:"."LightPink;";
					}
					else if($x7==0)
					{
						echo "style="."background-color:"."LightGray;";
					}
					else
					{
						echo "style="."background-color:"."LightGreen;";
					}
					?>><?=$key['newe7']?></td>
					<td <?php $x8 = $key['newe8']; 
					 if (preg_match("/-/", $x8))
					{
						echo "style="."background-color:"."LightPink;";
					}
					else if($x8==0)
					{
						echo "style="."background-color:"."LightGray;";
					}
					else
					{
						echo "style="."background-color:"."LightGreen;";
					}
					?>><?=$key['newe8']?></td>
					
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
