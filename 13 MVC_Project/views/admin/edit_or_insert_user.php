<div class="container-fluid">

    <!-- Page Heading -->
    <h2 class="h3 mb-2 text-gray-800">Edit Users</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">User Data</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
					<form method="post" id="commentForm" enctype="multipart/form-data">
						<?php 
						// echo "<pre>";
						// print_r($usersDataById["Data"]);
						// print_r($usersDataById["Data"][0]);
						// print_r($usersDataById["Data"][0]->username);
						// echo "</pre>";
					   
						?>
						<div class="row">
							<div class="col">
								<input type="text" class="form-control" name="username" placeholder="Enter Username" required value="<?php echo $usersDataById['Data'][0]->username ?? ""; ?>" id="">
							</div>
						</div>
						<div class="row mt-3">
							<div class="col">
								<input type="password" class="form-control" name="password" placeholder="Enter Password" required value="<?php echo $usersDataById['Data'][0]->password ?? ""; ?>" id="">
							</div>
						</div>
						<div class="row mt-3">
							<div class="col">
								<input type="email" class="form-control" name="email" required placeholder="Enter Email" value="<?php echo $usersDataById['Data'][0]->email ?? ""; ?>" id="">
							</div>
						</div>
						<div class="row mt-3">
							<div class="col">
								<input type="tel" class="form-control" name="mobile" required placeholder="Enter Mobile Number" value="<?php echo $usersDataById['Data'][0]->mobile ?? ""; ?>" id="">
							</div>
						</div>
						<div class="row mt-3">
							<div class="col">
							<label for="Gender">Gender</label>
                                <input type="radio" name="gender" required <?php if (isset($usersDataById)){if($usersDataById['Data'][0]->gender=="Male"){
									echo "checked";}}?> value="Male" id="Male"> <label for="Male">Male</label>
                                <input type="radio" name="gender" required <?php if (isset($usersDataById)) {if($usersDataById['Data'][0]->gender=="Female"){echo "checked";}} ?> value="Female" id="Female"> 
								<label for="Female">Female</label>
                                    
							</div>
						</div>
						<div class="row mt-3">
							<div class="col">
								<?php if(isset($usersDataById)){?>
								 <input type="hidden" name="old_prof_pic" value="<?php echo $usersDataById['Data'][0]->prof_pic; ?>" id="old_prof_pic"> 
								<?php }?>
								<input type="file" name="prof_pic" accept="image/*" id="prof_pic">
							</div>
						</div>
						<div class="row mt-3">
							<div class="col">
								<select name="country" id="country">
									<option value="">Select State</option>
									<?php foreach ($StateData['Data'] as $key => $value) { ?>
										<option <?php if (isset($usersDataById)) {  if ($usersDataById['Data'][0]->state_id == $value->id) {
                                            echo "selected";
                                        } } ?> value="<?php echo $value->id; ?>"><?php echo $value->state_title; ?></option>
                                    <?php } ?>
								</select>
							</div>
						</div>
						<div class="row mt-3">
							<div class="col">
								<select name="country" id="country">
									<option value="">Select City</option>
									<?php 
									foreach ($CitiesData['Data'] as $key => $value) { ?>
                                        <option <?php if (isset($usersDataById)) {  if ($usersDataById['Data'][0]->state_id == $value->id) {
                                            echo "selected";
                                        } } ?> value="<?php echo $value->id; ?>"><?php echo $value->name; ?></option>
                                    <?php } ?>
								</select>
							</div>
						</div>

						<div class="row mt-3">
                            <div class="col">
                                <?php if (isset($usersDataById)) { ?>
                                    <input type="submit" name="update" value="Upadte" id="">
                                <?php } else { ?>
                                    <input type="submit" name="insert" value="Add" id="">
                                <?php } ?>
                            </div>
					</form>
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
				email: {
					required: true,
					email: true
				},
				mobile: {
					required: true,
					minlength: 10,
					maxlength: 10
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
				email: "Please enter a valid email address",
			}
		});
	})
</script>