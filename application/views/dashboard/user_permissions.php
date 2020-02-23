<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h4 class="page-title m-0">User Permission Table</h4>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Permission Name</th>
                                        <th scope="col">Control</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $n = 1;
                                    foreach ($permissions as $permission): 
                                    ?>
                                    <tr>
                                        <th scope="row"><?=$n?></th>
                                        <td><?=$permission->name?></td>
                                        <td>
                                            <a class="btn btn-danger btn-sm btn-block" href="<?=base_url("dashboard/user_permission_delete/" . $permission->id . "/")?>">Delete</a>
                                        </td>
                                    </tr>
                                    <?php 
                                    $n++;
                                    endforeach; 
                                    ?>
                                    <form method="post">
                                        <tr>
                                            <th scope="row"><?=$n?></th>
                                            <td><input class="form-control" type="text" name="permission_name" id="permission_name" placeholder="New Permission Name"></td>
                                            <td><button class="btn btn-primary btn-sm btn-block" type="submit">Create</button></td>
                                        </tr>
                                    </form>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>