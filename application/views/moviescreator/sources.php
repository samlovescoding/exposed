
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h4 class="page-title m-0">Sources of <?=$movie->title?></h4>
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
                                        <th scope="col">Resolution</th>
                                        <th scope="col">URL</th>
                                        <th scope="col">Original Filename</th>
                                        <th scope="col">Control</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($sources as $source): 
                                    ?>
                                    <tr>
                                        <th scope="row"><?=$source->id?></th>
                                        <td><?=$source->resolution?></td>
                                        <td><?=$source->filename?></td>
                                        <td><?=$source->original_filename?></td>
                                        <td>
                                            <a class="btn btn-success btn-sm btn-block" target="_blank" href="<?=base_url("cloud/movie/" . $source->filename)?>">Open</a>
                                            <a class="btn btn-danger btn-sm btn-block" href="<?=base_url("moviescreator/delete_source/" . $source->id . "/" . $movie->id)?>">Delete</a>
                                        </td>
                                    </tr>
                                    <?php 
                                    endforeach; 
                                    ?>
                                    <form method="post">
                                    <tr>
                                        <th scope="row"></th>
                                        <td>
                                            <select name="resolution" class="form-control">
                                                <option value="1080">1080p</option>
                                                <option value="720">720p</option>
                                                <option value="480">480p</option>
                                                <option value="360">360p</option>
                                                <option value="0">Other</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input name="filename" value="<?=md5(time() . rand(0, 100000))?>" type="text" class="form-control" />
                                        </td>
                                        <td>
                                            <input name="original_filename" type="text" class="form-control" />
                                        </td>
                                        <td>
                                            <button class="btn btn-primary btn-sm btn-block" type="submit">Create</button>
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
                                    foreach (["title", "overview", "popularity", "vote_average", "budget", "revenue", "runtime", "release_date"] as $key): 
                                    ?>
                                    <tr>
                                        <th scope="row"><?=ucfirst(str_replace("_", " ", $key))?></th>
                                        <td><?=$movie->$key?></td>
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