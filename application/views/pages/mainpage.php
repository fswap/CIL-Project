<style type="text/css">
	#login .panel{
		width: 60%;
		margin: 0px auto;
	}
</style>
<body style=" background-image: url('<?php echo  base_url("assets/images/coal.jpg"); ?>')  ;; background-position: center center;
    background-size: 100% 100%;">

<div id="main-page" class="container"  >

	<ul class="nav nav-tabs">
		<li class="active" ><a data-toggle="tab" href="#login">Login</a></li>
		<li><a data-toggle="tab" href="#register">Register</a></li>
	</ul>

	<div class="tab-content">



		<div id="login" class="tab-pane fade in active">
			<div class="container">
				<div class="panel panel-primary">
					<div class="panel-heading">Login</div>
					<div class="panel-body">

						<form class="form-horizontal" method="POST">
							<div class="form-group">
								<label class="control-label col-sm-2" for="username">Username:</label>
								<div class="col-sm-10">
									<input name="username" type="text" class="form-control" id="username" placeholder="Enter Username" required/>
									<span style="color:red" class="text_danger"><?php echo form_error("username"); ?></span>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-2" for="password">Password:</label>
								<div class="col-sm-10"> 
									<input name="password" type="password"  class="form-control" id="password" placeholder="Enter password" required/>
									<span style="color:red" class="text_danger"><?php echo form_error("password"); ?></span>
								</div>
							</div>

							<div class="form-group"> 
								<div class="col-sm-offset-2 col-sm-10">
									<button name="login" type="submit" class="btn btn-primary">Submit</button>
									<?php
									echo '<label class="text-danger">'.$this->session->flashdata("error").'</label>';  
                     				?> 
								</div>
							</div>
							<center><a>Forgot your password? </a></center>
						</form>
					</div>
				</div>
			</div>
			
			
		</div>
		<div id="register" class="tab-pane fade">
			<div class="container">
				<br>
				<div class="panel panel-primary">

					<div class="panel-heading">Register</div>
					<div class="panel-body">
						<form class="form-horizontal" method="POST">
							<div class="form-group">
								<label class="control-label col-sm-2" for="name">Name:<span style="color:red" class="required">*</span></label>
								<div class="col-sm-10">
									<input name="name" type="text" class="form-control" id="name" placeholder="Enter Name" >
									<span style="color:red" class="text_danger"><?php echo form_error("name"); ?></span>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-2" for="company-name">Company Name:<span style="color:red" class="required">*</span></label>
								<div class="col-sm-10">
									<input name="company-name" type="text" class="form-control" id="company-name" placeholder="Enter Company Name">
									<span style="color:red" class="text_danger"><?php echo form_error("company-name"); ?></span>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-2" for="employee-id">Employee ID:<span style="color:red" class="required">*</span></label>
								<div class="col-sm-10">
									<input name="employee-id" type="text" class="form-control" id="employee-id" placeholder="Enter Employee ID">
									<span style="color:red" class="text_danger"><?php echo form_error("employee-id"); ?></span>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-2" for="mine-name">Mine Name:<span style="color:red" class="required">*</span></label>
								<div class="col-sm-10">
									<input name="mine-name" type="text" class="form-control" id="mine-name" placeholder="Enter Mine Name">
									<span style="color:red" class="text_danger"><?php echo form_error("mine-name"); ?></span>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-2" for="mine-address">Mine Address:<span style="color:red" class="required">*</span></label>
								<div class="col-sm-10">
									<textarea name="mine-address" class="form-control" id="mine-address" placeholder="Enter Mine Address"></textarea>
									<span style="color:red" class="text_danger"><?php echo form_error("mine-address"); ?></span>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-2" for="email">Email ID:<span style="color:red" class="required">*</span></label>
								<div class="col-sm-10">
									<input name="email" type="email" class="form-control" id="email" placeholder="Enter Email ID">
									<span style="color:red" class="text_danger"><?php echo form_error("email"); ?></span>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-2" for="reg-username">Username:<span style="color:red" class="required">*</span></label>
								<div class="col-sm-10">
									<input name="reg-username" type="text" class="form-control" id="reg-username" placeholder="Enter Username">
									<span style="color:red" class="text_danger"><?php echo form_error("reg-username"); ?></span>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-2" for="reg-password">Password:<span style="color:red" class="required">*</span></label>
								<div class="col-sm-10"> 
									<input name="reg-password" type="password" class="form-control" id="reg-password" placeholder="Enter password">
									<span style="color:red" class="text_danger"><?php echo form_error("reg-password"); ?></span>
								</div>
							</div>

							<div class="form-group"> 
								<div class="col-sm-offset-2 col-sm-10">
									<button name="register" type="submit" class="btn btn-default">Submit</button>
								</div>
							</div>
							<p><span style="color:red" class="required">*</span>Required field</p>
                            
                           
						</form>
					</div>

				</div>
			</div>
		</div>	

</div>
</body>
<style type="text/css">
#main-page .tab-content{
	display: flex;
	min-height: 80vh;
	justify-content: center;
	align-items: center;
}

#main-page #login{
	width: 100%;
}

#main-page #register{
	width: 100%;
}
</style>