    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">All Users</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Gender</th>
                            <th>Hobbies</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Gender</th>
                            <th>Hobbies</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php foreach ($allUsersData['Data'] as $key => $value) {
                            // echo "<pre>";
                            // print_r( $value);
                            ?>
                            <tr>
                                <td>
                                    <?php echo $value->username ?>
                                </td>
                                <td>
                                    <?php echo $value->email ?>
                                </td>
                                <td>
                                    <?php echo $value->mobile ?>
                                </td>
                                <td>
                                    <?php echo $value->gender ?>
                                </td>
                                <td>
                                    <?php echo $value->hobby ?>
                                </td>
                                <td>
                                    <img width="50px" src="uploads/<?php echo $value->prof_pic ?>" alt="">
                                    
                                </td>
                                <td>
                                    <a href="edit?userid=<?php echo $value->userid ?>">Edit</a>
                                    <a href="delete?userid=<?php echo $value->userid ?>">Delete</a>
                                </td>
                            </tr>
                        <?php } //echo "<pre>";print_r($allUsersData); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
