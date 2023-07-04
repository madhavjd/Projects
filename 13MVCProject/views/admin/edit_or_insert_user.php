

<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Edit Users</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">User Data</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <?php 
                // echo "<pre>";print_r($usersDataById['Data']);
                // exit;
                ?>
                <div class="col-md-6">
                    <form method="post" id="commentForm" enctype="multipart/form-data">
                        <!-- null coalescing -->
                        <div class="row">
                            <div class="col">
                                <input type="text" class="form-control" name="username" placeholder="Enter User Name"
                                    value="<?php echo $usersDataById['Data'][0]->username ?? ""; ?>" required id="">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <input type="text" class="form-control" name="email"
                                    value="<?php echo $usersDataById['Data'][0]->email ?? ""; ?>"
                                    placeholder="Enter Email" id="">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <input type="password" placeholder="Enter Password" class="form-control" name="password"
                                    <?php echo isset($usersDataById) ? "disabled" : ""; ?>
                                    value="<?php echo $usersDataById['Data'][0]->password ?? ""; ?>" id="">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <input type="tel" name="mobile" minlength="10" maxlength="10" placeholder="Enter Mobile Number" class="form-control"
                                    value="<?php echo $usersDataById['Data'][0]->mobile ?? ""; ?>" id="">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <label for="Gender">Gender</label>
                                <input type="radio" name="gender" <?php 
                                if (isset($usersDataById)) { if($usersDataById['Data'][0]->gender == "Male") { echo "checked"; }  }  ?> value="Male" id="Male"> <label for="Male">
                                    Male</label>
                                <input type="radio" name="gender" <?php if (isset($usersDataById)) { if($usersDataById['Data'][0]->gender == "Female") { echo "checked"; }  }  ?>  value="Female" id="Female"> <label for="Female">
                                    Female</label>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                            <?php 
                            // echo "<pre>"; 
                            // print_r($usersDataById['Data'][0]->hobby);
                            if (isset($usersDataById)) {
                            $HobbyData = explode(",",$usersDataById['Data'][0]->hobby);
                            }
                            //     print_r($HobbyData);
                        //    echo "</pre>"; 
                             ?>
                                <label for="Hobbies">Hobbies</label>
                                <input type="checkbox" name="hobbies[]" <?php
                                if (isset($usersDataById)) { if (in_array("Cricekt",$HobbyData)) { echo "checked"; } }
                                ?>  value="Cricekt" id="Cricekt"> <label
                                    for="Cricekt">Cricekt</label>
                                <input type="checkbox" name="hobbies[]" <?php if (isset($usersDataById)) {  if (in_array("Music",$HobbyData)) { echo "checked"; } }?> value="Music" id="Music"> <label
                                    for="Music">Music</label>
                                <input type="checkbox" name="hobbies[]" <?php if (isset($usersDataById)) {  if (in_array("Reading",$HobbyData)) { echo "checked"; } } ?> value="Reading" id="Reading"> <label
                                    for="Reading">Reading</label>
                                <input type="checkbox" name="hobbies[]" <?php if (isset($usersDataById)) {  if (in_array("Travelling",$HobbyData)) { echo "checked"; }}?> value="Travelling" id="Travelling"> <label
                                    for="Travelling">Travelling</label>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <?php if (isset($usersDataById)) { ?> 
                                    <input type="hidden" name="old_prof_pic" value="<?php echo $usersDataById['Data'][0]->prof_pic; ?>" id="old_prof_pic">
                                <?php }  ?>
 
                                <input type="file" name="prof_pic" accept="image/*" id="prof_pic">
                                <!-- <input type="file" name="prof_pic" class="form-control"  id="prof_pic"> -->
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <select name="country" class="form-control" id="country">
                                    <option value="">Select Country</option>
                                    <?php foreach ($CountryData['Data'] as $key => $value) { ?>
                                        <option <?php if (isset($usersDataById)) {  if ($usersDataById['Data'][0]->countryid == $value->country_id) {
                                            echo "selected";
                                        } }?> value="<?php echo $value->country_id; ?>"><?php echo $value->country_name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <select name="state" class="form-control" id="state">
                                    <option value="">Select State</option>
                                    <?php foreach ($StateData['Data'] as $key => $value) { ?>
                                        <option <?php if (isset($usersDataById)) {  if ($usersDataById['Data'][0]->state_id == $value->id) {
                                            echo "selected";
                                        } } ?> value="<?php echo $value->id; ?>"><?php echo $value->name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <select name="city" class="form-control" id="city">
                                    <option value="">Select City</option>
                                    <?php foreach ($CitiesData['Data'] as $key => $value) { ?>
                                        <option <?php  if (isset($usersDataById)) {  if ($usersDataById['Data'][0]->country_id == $value->id) {
                                            echo "selected";
                                        }} ?> value="<?php echo $value->id; ?>"><?php echo $value->name; ?></option>
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
                        </div>
                    </form>
                </div>
            </div>

<!-- <script>

</script> -->
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
				email: {
					required: true,
					email: true
				},
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

	});
	</script>