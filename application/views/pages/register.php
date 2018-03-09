<div class="container-fluid">
	<div class="row">
		<div class="col-sm-12 col-md-4 col-md-offset-4 col-lg-offset-4 col-lg-4">
			<h2 class="text-center">Item Finder</h2>
			<div class="panel panel-primary">
				<div class="panel-heading">Register</div>
				<div class="panel-body">
					<form class="form-horizontal" method="post" action="register/register">
						<div class="form-group">
							<div class="col-sm-12">
								<div class='input-group'>
									<span class="input-group-addon">
										<span class="glyphicon glyphicon-envelope"></span>
									</span>
									<input type="email" class="form-control" name="emailId" placeholder="Email"  required="required"/> 
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-12">
								<div class='input-group'>
									<span class="input-group-addon">
										<span class="glyphicon glyphicon-pencil"></span>
									</span>
									<input type="text" class="form-control" name="password" placeholder="Password"  required="required"/> 
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-12">
								<div class='input-group'>
									<span class="input-group-addon">
										<span class="glyphicon glyphicon-pencil"></span>
									</span>
									<input type="text" class="form-control" name="confirmPassword" placeholder="Confirm Password"  required="required"/> 
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-12">
								<select class="form-control" name="userType"  required="required">
									<option value="0">User Type</option>
									<option value="1">Admin</option>
									<option value="2">User</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-12">
								<div class='input-group'>
									<span class="input-group-addon">
										<span class="glyphicon glyphicon-object-align-bottom"></span>
									</span>
									<input type="text" class="form-control" name="houseId" placeholder="House Id"  required="required"/> 
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-12">
								<div class='input-group'>
									<span class="input-group-addon">
										<span class="glyphicon glyphicon-lock"></span>
									</span>
									<input type="text" class="form-control" name="houseKey" placeholder="House Key"  required="required"/> 
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-8">
								<a href="login">Return to Login</a>
							</div>
							<div class="col-sm-4 text-right">
								<button type="submit" class="btn btn-primary">Register</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>