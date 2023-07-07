<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->

<div class="login">
	
  <div class="main-agileits">
	 <div class="form-w3agile">
		<h3>Register</h3>
			<form action="#" id="commentForm" method="post">
				<div class="key">
					<i class="fa fa-user" aria-hidden="true"></i>
					  <input  type="text"  name="username" required placeholder="Username">
						<div class="clearfix"></div>
						</div>
						<div class="key">
							<i class="fa fa-envelope" aria-hidden="true"></i>
							<input  type="text"  name="email"  required  placeholder="Email">
							<div class="clearfix"></div>
						</div>
						<div class="key">
							<i class="fa fa-envelope" aria-hidden="true"></i>
							<input  type="text"  name="mobile"  required  placeholder="Mobile">
							<div class="clearfix"></div>
						</div>
						<div class="key">
							<i class="fa fa-lock" aria-hidden="true"></i>
							<input  type="password"  name="password"  required placeholder="Password">
							<div class="clearfix"></div>
						</div>
						<div class="key">
							<i class="fa fa-lock" aria-hidden="true"></i>
							<input  type="password" name="Confirm Password" required placeholder="Confirm Password">
							<div class="clearfix"></div>
						</div>
						<div class="key">
							<i class="fa fa-lock" aria-hidden="true"></i>
							<input  type="radio" name="gender" value="Male" id="Male" required placeholder="Male"><label for="Male">Male</label>
							<input  type="radio" name="gender" value="Female" id="Female"  required placeholder="Female"><label for="Female">Female</label>
							<input  type="radio" name="gender" value="Other" id="Other" required placeholder="Other"><label for="Other">Other</label>
							<div class="clearfix"></div>
						</div>
						<input type="submit" name="register" value="Register">
					</form>
				</div>
			</div>
		</div>
		<script>
	$().ready(function() {
		// validate the comment form when it is submitted
		$("#commentForm").validate({
			rules: {
				username: {
					required: true,
					minlength: 2
				},
				password: {
					required: true,
					minlength: 5
				},
				confirm_password: {
					required: true,
					minlength: 5,
					equalTo: "#password"
				},
				email: {
					required: true,
					email: true
				},
				mobile: {
					required: true,
					minlegth: 10,
					maxlength: 10,
					pattern = /^([0-9])+$/
				}
			},
			messages: {
				username: {
					required: "Please enter a username",
					minlength: "Your username must consist of at least 2 characters"
				},
				password: {
					required: "Please provide a password",
					minlength: "Your password must be at least 5 characters long"
				},
				confirm_password: {
					required: "Please provide a password",
					minlength: "Your password must be at least 5 characters long",
					equalTo: "Please enter the same password as above"
				},
				email: "Please enter a valid email address",
			}
		});
	})
</script>