<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h4 class="page-title m-0">User Details Table</h4>
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
                                        <th scope="col">Detail Name</th>
                                        <th scope="col">Detail Type</th>
                                        <th scope="col">Detail Meta</th>
                                        <th scope="col">Control</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $n = 1;
                                    foreach ($details as $detail): 
                                    ?>
                                    <tr>
                                        <th scope="row"><?=$n?></th>
                                        <td><?=$detail->name?></td>
                                        <td><?=$detail->type?></td>
                                        <td><?=$detail->meta?></td>
                                        <td>
                                            <a class="btn btn-danger btn-sm btn-block" href="<?=base_url("dashboard/user_detail_delete/" . $detail->id . "/")?>">Delete</a>
                                        </td>
                                    </tr>
                                    <?php 
                                    $n++;
                                    endforeach; 
                                    ?>
                                    <form method="post">
                                        <tr>
                                            <th scope="row"><?=$n?></th>
                                            <td><input class="form-control" type="text" name="detail_name" id="detail_name" placeholder="New Detail Name"></td>
                                            <td>
                                                <select class="form-control" name="detail_type" id="detail_type">
                                                    <option value="text">Text Field</option>
                                                    <option value="textarea">Textarea Field</option>
                                                    <option value="image">Image Field</option>
                                                    <option value="file">File Field</option>
                                                    <option value="link">Link Field</option>
                                                    <option value="email">Email Field</option>
                                                    <option value="password">Password Field</option>
                                                    <!-- <option value="bool">Boolean Field</option> -->
                                                    <option value="select">Select Field (separate meta with comma)</option>
                                                    <option value="date">Date Field</option>
                                                    <option value="time">Time Field</option>
                                                </select>
                                            </td>
                                            <td>
                                                <input class="form-control" type="text" name="detail_meta" id="detail_meta" placeholder="New Detail Meta">
                                            </td>
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