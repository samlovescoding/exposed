<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h4 class="page-title m-0">Taxonomy</h4>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="offset-lg-3 col-lg-6">
        <div id="accordion-test-2" class="card-box">
            <?php foreach ($taxonomy as $label): ?>
            <div class="card">
                <div class="card-header bg-primary">
                    <h5 class="m-0 card-title">
                    <a href="" class="collapsed" data-toggle="collapse" data-target="#collapse<?=$label->id?>">
                        (<?=$label->id?>) <?=$label->name?>
                    </a>
                    </h5>
                </div>

                <div id="collapse<?=$label->id?>" class="collapse" data-parent="#accordion-test-2">
                    <div class="card-body">
                        <div class="list-group m-b-10">
                            <?php foreach ($label->categories as $category): ?>
                            <div href="#" class="list-group-item">
                                <?=$category->name?>

                                <div class="float-right">
                                    <form method="post">
                                        <button type="SU" name="category_delete" value="<?=$category->id?>" class="btn waves-effect btn-secondary"> <i class="fa fa-trash"></i> </button>
                                    </form>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                        
                        <form class="form-inline m-b-10" method="post">
                            <div class="form-group">
                                <input name="category_name" type="text" class="form-control" placeholder="Category Name">
                                <input name="category_parent" value="<?=$label->id?>" type="hidden" class="form-control" >
                            </div>
                            <button type="submit" class="btn btn-secondary waves-effect waves-light m-l-10">Create</button>
                        </form>
                        
                        <form method="post">
                            <button name="delete" type="submit" value="<?=$label->id?>" class="btn btn-danger">
                                Delete The Category
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>

            <div class="card">
                <div class="card-header bg-info">
                    <h5 class="m-0 card-title">
                    <a href="" class="collapsed" data-toggle="collapse" data-target="#create-new-category">
                        Create New Category Type
                    </a>
                    </h5>
                </div>
                <div id="create-new-category" class="collapse" data-parent="#accordion-test-2">
                    <div class="card-body">
                        <form class="form-inline" method="post">
                            <div class="form-group">
                                <input name="category_label" type="text" class="form-control" placeholder="Category Label">
                            </div>
                            <button type="submit" class="btn btn-secondary waves-effect waves-light m-l-10">Create</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>