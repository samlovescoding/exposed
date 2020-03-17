<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h4 class="page-title m-0">Courses List</h4>
                </div>
                <div class="col-md-4"><a class="btn btn-primary btn-block" href="<?=base_url("coursecreator/create")?>">Create</a></div>
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
                                        <th scope="col">Publisher</th>
                                        <th scope="col">Instructor</th>
                                        <th scope="col">Control</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($courses as $course): 
                                    ?>
                                    <tr>
                                        <th scope="row"><?=$course->id?></th>
                                        <td><?=$course->title?></td> 
                                        <td><?=$course->publisher?></td>
                                        <td><?=$course->instructors?></td>
                                        <td>
                                            <a class="btn btn-primary btn-sm btn-block" href="<?=base_url("coursecreator/modules/" . $course->id . "/")?>">Modules</a>
                                            <a class="btn btn-danger btn-sm btn-block" href="<?=base_url("coursecreator/delete/" . $course->id . "/")?>">Delete</a>
                                        </td>
                                    </tr>
                                    <?php 
                                    endforeach; 
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