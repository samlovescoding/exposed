<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h4 class="page-title m-0">Articles of <a href="<?=base_url("coursecreator/modules/" . $course->id)?>"><?=$module->title?></a> of <a href="<?=base_url("coursecreator/all")?>"><?=$course->title?></a></h4>
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
                                        <th scope="col">Video</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Resource</th>
                                        <th scope="col">Control</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($articles as $article): 
                                    ?>
                                    <tr>
                                        <th scope="row"><?=$article->id?></th>
                                        <td><?=$article->title?></td> 
                                        <td>
                                            <form action="<?=base_url("coursecreator/edit_article_video/" . $article->id)?>" method="post">
                                                <input name="video" class="form-control" type="text" value="<?=$article->video?>">
                                                    <button class="btn btn-info btn-block m-t-5" type="submit">
                                                        <i class="fa fa-check"></i> Save
                                                    </button>
                                            </form>
                                        </td>
                                        <td><?=$article->description?></td> 
                                        <td>
                                            <form action="<?=base_url("coursecreator/edit_article_resource/" . $article->id)?>" method="post">
                                                <input name="resource" class="form-control" type="text" value="<?=$article->video?>">
                                                <button class="btn btn-info btn-block m-t-5" type="submit">
                                                    <i class="fa fa-check"></i> Save
                                                </button>
                                            </form>
                                        </td> 
                                        <td>
                                            <a class="btn btn-danger btn-sm" href="<?=base_url("coursecreator/article_delete/" . $article->id . "/")?>">Delete</a>
                                        </td>
                                    </tr>
                                    <?php 
                                    endforeach; 
                                    ?>
                                    <form method="post">
                                        <tr>
                                            <td></td>
                                            <td><input type="text" name="title" class="form-control" placeholder="Title"></td>
                                            <td><input type="text" name="video" class="form-control" placeholder="Video URL"></td>
                                            <td><input type="text" name="description" class="form-control" placeholder="Description"></td>
                                            <td><input type="text" name="resource" class="form-control" placeholder="Resource URL"></td>
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
