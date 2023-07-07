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
                        <th>Name</th>
                        <th>Price</th>
                        <th>Weight</th>
                        <th>image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Weight</th>
                        <th>image</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                <?php foreach ($allproducts['Data'] as $key => $value) {?>
                    <tr>
                        <td><?php echo $value->pid ?></td>
                        <td><?php echo $value->name ?></td>
                        <td><?php echo $value->price ?></td>
                        <td><?php echo $value->weight ?></td>
                        <td><?php echo $value->pic ?></td>
                        <td>
                        <a href="addoreditprod?pid=<?php echo $value->pid ?>">Edit</a>
                        <a href="deleteprod?pid=<?php echo $value->pid ?>">Delete</a>
                        </td>       <!-- query string -->
                    </tr>
               <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>