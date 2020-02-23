<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h4 class="page-title m-0">User Management</h4>
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
                    <div class="col-md-3">
                        <form method="post">
                            <input class="form-control" type="search" name="user_search_by_username" id="user_search_by_username" placeholder="Search users by username">
                        </form>
                    </div>
                    <div class="col-md-3">
                        <form method="post">
                            <input class="form-control" type="search" name="user_search_by_email" id="user_search_by_email" placeholder="Search users by Email">
                        </form>
                    </div>
                    <div class="col-md-3">
                        <form method="post">
                            <input class="form-control" type="search" name="user_search_by_name" id="user_search_by_name" placeholder="Search users by name">
                        </form>
                    </div>
                    <div class="col-md-3">
                        <form method="post">
                            <button class="btn btn-block btn-primary" name="user_search_all" value="user_search_all" type="submit">List all users</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if($has_search): ?>
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
                                        <th scope="col">Name</th>
                                        <th scope="col">Username</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Role</th>
                                        <th scope="col">Control</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if(count($users) > 0):
                                        $n = 1;
                                        foreach ($users as $user): 
                                    ?>
                                        <tr>
                                            <th scope="row"><?=$n?></th>
                                            <td><?=$user->name?></td>
                                            <td><?=$user->username?></td>
                                            <td><?=$user->email?></td>
                                            <!-- <td><?php if($user->role == 0) echo "None"; elseif(isset($roles[$user->role])) echo $roles[$user->role]->name; else echo "Unassigned";?></td> -->
                                            <td>
                                                <form class="form-inline" action="<?=base_url("dashboard/user_role_update/" . $user->id)?>" method="post">
                                                    <div class="form-group">
                                                        <select class="form-control" name="user_role" id="user_role">
                                                            <option value="0" <?php if($user->role == "0") echo "selected='selected'"; ?>>None</option>
                                                            <option value="-1" <?php if($user->role != "0" && !in_array($user->role, array_keys($roles))) echo "selected='selected'"; ?>>Unassigned</option>
                                                            <?php
                                                                foreach ($roles as $role):
                                                            ?>
                                                            <option value="<?=$role->id?>" <?php if($user->role == $role->id) echo "selected='selected'"; ?>><?=$role->name?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group m-l-10">
                                                        <button class="btn btn-info waves-effect btn-block" type="submit">
                                                            <i class="fa fa-check"></i>
                                                        </button>
                                                    </div>
                                                </form>
                                            </td>
                                            <td>
                                                <a class="btn btn-warning btn-sm btn-block" style="color:black !important;" href="<?=base_url("dashboard/user_logs/" . $user->id . "/")?>">Logs</a>
                                                <a class="btn btn-danger btn-sm btn-block" href="<?=base_url("dashboard/user_delete/" . $user->id . "/")?>">Delete</a>
                                            </td>
                                        </tr>
                                    <?php 
                                        $n++;
                                        endforeach; 
                                    else:
                                    ?>
                                        <tr>
                                            <th></th>
                                            <td>No Users Found</td>
                                        </tr>
                                    <?php
                                    endif;
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>