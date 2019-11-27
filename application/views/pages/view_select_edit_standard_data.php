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
		

	
	<br><br>
	
	
	<table class="table table-bordered">

		<thead>
			<th>S.No.</th>
			<th>Department</th>
			<th>Cadre</th>
			<th>Grade</th>
			<th>Req. of emp.</th>
			<th>Info.</th>
			<th>Update</th>
			
		</thead>
		<tbody>
			<?php 
			$rn=1;
				foreach ($values as $key){
					echo '
				<tr>
				
					<td>'.$rn.'</td>
					
					<td>'.$key['dept_name'].'</td>
										
					<td>'.$key['cadre'].'</td>
					<td>'.$key['grade'].'</td>
					<td>'.$key['no_of_emp'].'</td>
					<td>'.$key['info'].'</td>
					 <td>
                               
                               <a href="'.site_url("Pages/edit_standard_data/".$key['sno']).'"><button class="btn btn-primary">Edit</button></a>
                       </td>
					
				</tr>';
				$rn++;
			}
			?>

		</tbody>
	</table>