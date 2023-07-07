<form method="post">
 <input type="text" name ="search" required placeholder ="Search text">
 <button type="submit">Search</button>
</form>

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
                        <th>Password</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Gender</th>
                    </tr>
                </thead>
                <tfoot>
                <tr>
                        <th>ID</th>
                        <th>username</th>
                        <th>Password</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Gender</th>
                    </tr>
                </tfoot>
                <tbody>
                <?php if (isset($_POST['search'])) {
                if ($searchtext['Code']==1) {
                    foreach ($searchtext['Data'] as $key => $value) { ?>
                        <tr>
                            <td><?php echo $value->id ?></td>
                            <td><?php echo $value->username ?></td>
                            <td><?php echo $value->password ?></td>
                            <td><?php echo $value->email ?></td>
                            <td><?php echo $value->mobile ?></td>
                            <td><?php echo $value->gender ?></td>     
                        </tr>
                    <?php }                    
                    } 
                    else { ?>
                        <tr>
                        <td colspan="6">No Record Found</td>
                    </tr>
                 <?php }
                  }  ?>
                </tbody>
            </table>
        </div>
    </div>
</div>