<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h4 class="page-title m-0">Modules of <a href="<?=base_url("coursecreator/all")?>"><?=$course->title?></a></h4>
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
                                        <th scope="col">Title</th>
                                        <th scope="col">Control</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($modules as $module): 
                                    ?>
                                    <tr>
                                        <th scope="row"><?=$module->id?></th>
                                        <td><?=$module->title?></td> 
                                        <td>
                                        <a class="btn btn-primary btn-sm" href="<?=base_url("coursecreator/articles/" . $course->id . "/" . $module->id)?>">Articles</a>
                                        <a class="btn btn-danger btn-sm" href="<?=base_url("coursecreator/module_delete/" . $module->id . "/")?>">Delete</a>
                                        </td>
                                    </tr>
                                    <?php 
                                    endforeach; 
                                    ?>
                                    <form method="post">
                                        <tr>
                                            <td></td>
                                            <td><input type="text" name="title" class="form-control" placeholder="Title"></td>
                                            <td><button class="btn btn-primary" type="submit">Create</button></td>
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
                                        <th scope="col" width="20%">Key</th>
                                        <th scope="col">Value</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach (["title", "description", "publisher", "instructors"] as $key): 
                                    ?>
                                    <form action="<?=base_url("coursecreator/update_course/{$course->id}/$key")?>" method="post">
                                        <tr>
                                            <th scope="row"><?=ucfirst(str_replace("_", " ", $key))?></th>
                                            <td>
                                                <div class="form-inline">
                                                    <input class="form-control" type="text" name="<?=$key?>" value="<?=$course->$key?>">
                                                    <button class="btn btn-primary m-l-10">Save</button>
                                                </div>
                                            </td>
                                        </tr>
                                    </form>
                                    <?php 
                                    endforeach; 
                                    ?>
                                    <form enctype="multipart/form-data" action="<?=base_url("coursecreator/update_course/{$course->id}/preview")?>" method="post">
                                        <tr>
                                            <th scope="row"><?=ucfirst(str_replace("_", " ", "Preview"))?></th>
                                            <td>
                                                <div class="form-inline">
                                                    <input class="form-control" type="file" name="preview">
                                                    <button class="btn btn-primary m-l-10">Save</button>
                                                    <small>Current : <?=base_url() . "data/course_previews/" . $course->preview?>.jpg</small>
                                                </div>
                                            </td>
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