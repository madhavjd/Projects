<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Edit Users</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">User Data</h6>
        </div>
        <div class="card-body">
            <?php //echo "<pre>"; print_r($usersDataById); ?>
        <form  method="post">
            <input type="text" name="username" value="<?php echo $usersDataById['Data'][0]->username?>" id="">
            <input type="text" name="email" value="<?php echo $usersDataById['Data'][0]->email?>" id="">
        <input type="submit" name="update" id="">
        </form>
        </div>
    </div>

</div>