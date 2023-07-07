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
                        <th>ID</th>
                        <th>username</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Gender</th>
                        <th>image</th>
                        <th>Action</th>

                    </tr>
                </thead>
                <tfoot>
                <tr>
                        <th>ID</th>
                        <th>username</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Gender</th>
                        <th>image</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
           <!-- <?php echo "<pre>"; echo  print_r($allusersdata); ?> -->
                <?php foreach ($allusersdata['Data'] as $key => $value) {?>
                    <tr>
                        <td><?php echo $value->id ?></td>
                        <td><?php echo $value->username ?></td>
                        <td><?php echo $value->email ?></td>
                        <td><?php echo $value->mobile ?></td>
                        <td><?php echo $value->gender ?></td>
                        <td><?php echo $value->prof_pic ?></td>
                        <td>
                        <a href="edit?userid=<?php echo $value->id ?>">Edit</a>
                        <a href="delete?userid=<?php echo $value->id ?>">Delete</a>
                        </td>       <!-- query string -->
                    </tr>
               <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>