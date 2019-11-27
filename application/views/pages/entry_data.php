<body style=" background-image: url('<?php echo  base_url("assets/images/polelight1.jpeg"); ?>') ; background-position: center center;
    background-size: 100% 100%; ">
<?php
$department = [];
foreach ($values as $value) {
	$dept_id = $value['department'];
		$department[$dept_id]['data'][] = $value; //store all department in one array
		// $cadre_id = $value['cadre'];
		// $department[$dept_id]['cadre'][] = $value;
	}
	// var_dump($department);

	foreach ($department as $key => &$dep_value) {
		$department_value = $dep_value['data'];
		foreach ($department_value as $key => &$value) {
			$cadre_value = $value['cadre'];
			$dep_value['cadre'][$cadre_value][] = $value;
		}
		// var_dump($cadre_value);
	}
	// var_dump($department);

	?>


	<!-- Uploading the actual data in excel sheet

	<form method ="POST" action ="<?=site_url('pages/finalize_excelsheet')?>">
	  <div class="form-group">
	    <label for="enterCSV">Enter the CSV File if Any</label>
	    <input type="file" class="form-control-file"  name="enterCSV" accept=".csv">
	    <button type="submit" class="btn btn-default">Submit</button>
	  </div>
	</form> -->
	<!-- 
		<form  method="POST"  action="<?=site_url('pages/finalize')?>" onsubmit="return validateForm()">

              <div class="form-group">
				<label for="enterCSV">Enter data through excel Sheet          
					<input  class="form-control-file" type="file"  name="enterCSV" accept=".csv">
				</label>
			 </div>

		</form> -->
	

	<div id="entry-page" class="container" ">

		<ul class="nav nav-tabs" >
			<?php foreach ($department as $key => $value): ?>
				<li ><a  data-toggle="tab" href="#department_<?=$key?>"><?=$value['data'][0]['dept_name']?></a></li>

			<?php endforeach ?>
		</ul>
		<form class="form-horizontal" method="POST" action="<?=site_url('pages/finalize')?>" onsubmit="return validateForm()">

			<div class="tab-content" >
				<?php foreach ($department as $dep_key => $value): ?>
					<div id="department_<?=$dep_key?>" class="tab-pane fade w-100">
						<?php foreach ($value['cadre'] as $cad_key => $cad_value): ?>
							<h3><?=$cad_key?></h3>

							<div class="row center table-top">
								<div class="col-sm-8">
									Value
								</div>
								<div class="col-sm-4">
									Required
								</div>

							</div>
							<hr />

							<?php foreach ($cad_value as $grade_key => $grade_value): ?>
							<!-- <pre>
								<?php
								var_dump($grade_key)
								?>
							</pre>
							<pre>
								<?php
								var_dump($grade_value)
								?>
							</pre> -->
							<div class="form-group">
								<?php
								$id = $dep_key."-".$cad_key."-".$grade_value['grade'];
								?>
								<label class="control-label col-sm-2" for="<?=$id?>"><?=$grade_value['grade']?>:</label>
								<div class="col-sm-6">
									<input name="<?=$id?>-value" type="number" min="0" class="form-control" id="<?=$id?>" placeholder="Enter Number">
								</div>
								<div class="col-sm-4">
									<div class="center">
										<?=$grade_value['no_of_emp']?>
									</div>
								</div>
							</div>
							<hr />
						<?php endforeach ?>

						
					<?php endforeach ?>
					<div class="center">
						<a class="btn btn-success navigation-but" onclick="goToPrev(this)">&lt; Prev</a>
						<a class="btn btn-primary navigation-but" onclick="goToNext(this)">Next &gt;</a>
					</div>
				</div>
			<?php endforeach ?>
		</div>
		<div class="row">
			<div class="center">
				<button type="submit" name="submit_data" class="btn btn-primary" >Submit Form</button>
			</div>
		</div>
	</form>

</div>
<style type="text/css">
#entry-page .tab-content{
	display: flex;
	min-height: 80vh;
	justify-content: center;
	align-items: center;
	color:black;
}

#entry-page #login{
	width: 100%;
}

#entry-page #register{
	width: 100%;
}
.center{
	text-align: center;
}
.w-100{
	width: 100%;
}
.table-top{
	padding: 10px 8px;
	font-size: 2rem;
}
</style>

<script type="text/javascript">
	function goToNext(ele) {
		var parent = $(ele).parent().parent();
		var id = parent.attr('id');
		var link = $(".nav-tabs li [href='#"+id+"']");
		var next_link = link.parent().next().find('a');
		next_link.click();
		console.log(next_link);
	}
	function goToPrev(ele) {
		var parent = $(ele).parent().parent();
		var id = parent.attr('id');
		var link = $(".nav-tabs li [href='#"+id+"']");
		var next_link = link.parent().prev().find('a');
		next_link.click();
		console.log(next_link);
	}
	function setColor(){
		var contents = $('.tab-content').children();
		// console.log(contents);
		for(var i = 0; i < contents.length; i++){
			var content_obj = $(contents[i]);
			var inputs = content_obj.find('input');
			var count = 0;
			for(var input = 0; input<inputs.length;input++){
				if($(inputs[input]).val()==''){
					count++;
				}
			}
			var id = content_obj.attr('id');
			var li = $(".nav-tabs li [href='#"+id+"']").parent();
			li.removeClass("bg-warning bg-success");
			if(count == 0){
				li.addClass("bg-success")
			}
			else if(count > 0 && count < inputs.length ){
				li.addClass("bg-warning");
			}
		}
	}
	function validateForm() {
		var inputs = $("input");
		for(var input = 0; input<inputs.length;input++){
			if($(inputs[input]).val()==''){
				alert("Please Fill all the values. Check which tabs are not green in color");
				return false;
			}
		}
		return true;
	}

	$(".nav-tabs li").on('click',function(){
		setColor();
	});
	$(".navigation-but").on('click',function(){
		setColor();
	});
</script>