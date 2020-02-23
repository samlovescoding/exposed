<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h4 class="page-title m-0">User Roles Table</h4>
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
                                        <th scope="col">Role Name</th>
                                        <th scope="col">Permissions</th>
                                        <?php /* ?>
                                        <th scope="col">Parent</th>
                                        <?php */ ?>
                                        <th scope="col">Control</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $n = 1;
                                    foreach ($roles as $role): 
                                    ?>
                                    <tr>
                                        <th scope="row"><?=$n?></th>
                                        <td>
                                            <?=$role->name?>
                                            <?php
                                                if($role->id == AUTH_DEFAULT_ROLE){
                                                    echo "<b>(default role)</b>";
                                                }
                                            ?>
                                        </td> 
                                        <td>
                                            <form method="post" action="<?=base_url('dashboard/user_role_permissions/' . $role->id)?>">
                                                <?php 
                                                foreach ($permissions as $permission):
                                                    $has_permission = false;
                                                    if(in_array($permission->id, $role->permissions)){
                                                        $has_permission = true;
                                                    }
                                                ?>
                                                <div class="checkbox checkbox-primary">
                                                    <input id="permission_<?=$permission->id?>_for_<?=$role->id?>" name="permissions[]" value="<?=$permission->id?>" type="checkbox" <?php if($has_permission) echo "checked='checked'"; ?>>
                                                    <label for="permission_<?=$permission->id?>_for_<?=$role->id?>">
                                                        <?=$permission->name?>
                                                    </label>
                                                </div>
                                                <?php endforeach; ?>
                                                <button class="btn btn-primary btn-sm" type="submit">Save Permissions</button>
                                            </form>
                                        </td>
                                        <?php /* ?>
                                        <td><?php if(in_array($role->parent, array_keys($roles))) echo $roles[$role->parent]->name; elseif($role->parent == 0) echo "None"; else echo "No Role found at position {$role->parent}";?></td>
                                        <?php */ ?>
                                        <td>
                                            <a class="btn btn-secondary btn-sm btn-block" href="<?=base_url("dashboard/user_role_default/" . $role->id . "/")?>">Default</a>
                                            <a class="btn btn-danger btn-sm btn-block" href="<?=base_url("dashboard/user_role_delete/" . $role->id . "/")?>">Delete</a>
                                        </td>
                                    </tr>
                                    <?php 
                                    $n++;
                                    endforeach; 
                                    ?>
                                    <form method="post">
                                        <tr>
                                            <th scope="row"><?=$n?></th>
                                            <td><input class="form-control" type="text" name="role_name" id="role_name" placeholder="New Role Name"></td>
                                            <td></td>
                                            <input type="hidden" name="role_parent" value="0">
                                            <?php /* ?>
                                            <td>
                                                <select class="form-control" name="role_parent" id="role_parent">
                                                    <option value="0">None</option>
                                                    <?php
                                                        foreach ($roles as $role):
                                                    ?>
                                                    <option value="<?=$role->id?>"><?=$role->name?></option>
                                                    <?php
                                                        endforeach;
                                                    ?>
                                                </select>
                                            </td>
                                            <?php */ ?>
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