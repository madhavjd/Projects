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
                        <th>title</th>
                        <th>country_id</th>
                        <th>action</th>
                    </tr>
                </thead>
                <tfoot>
                <tr>
                        <th>title</th>
                        <th>country_id</th>
                        <th>action</th>
                    </tr>
                </tfoot>
                <tbody>
                    <!-- <?php echo "<pre>"; print_r($states);?>  -->
                    <?php foreach ($states['Data'] as $key => $value) {?>
                <tr>
                    <td><?php echo $value->title ?></td>
                    <td><?php echo $value->country_id ?></td>
                    <td>
                        <a href="edit?userid=<?php echo $value->country_id ?>">Edit</a>
                        <a href="delete?userid=?<?php echo $value->country_id ?>">Delete</a>
                    </td>
                </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>