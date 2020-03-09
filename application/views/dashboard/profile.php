<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h4 class="page-title m-0"></h4>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6 offset-lg-3">
        <div class="card">
            <div class="card-body">
                <h4 class="m-t-0 m-b-30">Profile Information</h4>
                <?php
                foreach ($details as $detail):

                    $preset_value = "";
                    if(in_array($detail->id, array_keys($information))){
                        $preset_value = $information[$detail->id]->information;
                    }
                ?>
                <form class="form-horizontal" action="<?=base_url("dashboard/profile_update/" . $detail->id)?>" method="post" enctype="multipart/form-data">
                    <div class="form-group row">
                        <label for="old_password" class="col-sm-3 control-label"><?=$detail->name?></label>
                        <div class="col-sm-6">
                            <?php
                            switch ($detail->type) {
                                
                                case 'text': ?>
                                <input type="text" class="form-control" id="detail_data" name="detail_data" placeholder="<?=$detail->meta?>" value="<?=$preset_value?>">
                                <?php break;
                                
                                case 'textarea': ?>
                                <textarea class="form-control" name="detail_data" id="detail_data" cols="30" rows="5"><?= $preset_value?></textarea>
                                <?php break;
                                
                                case 'image': ?>
                                    <?php if($preset_value != ""):?>
                                    <div class="mb-2">
                                        <img class="img-fluid" src="<?=base_url('uploads/profile/' . auth()->id . '/' . $preset_value)?>" alt="">
                                    </div>
                                    <?php endif; ?>
                                    <input type="file" class="form-control" id="detail_data" name="detail_data">
                                <?php break;

                                case 'file': ?>
                                <input type="file" class="form-control" id="detail_data" name="detail_data">
                                <?php break;

                                case 'link': ?>
                                <input type="text" class="form-control" id="detail_data" name="detail_data" placeholder="<?=$detail->meta?>" value="<?=$preset_value?>">
                                <?php break;
                                
                                case 'email': ?>
                                <input type="email" class="form-control" id="detail_data" name="detail_data" placeholder="<?=$detail->meta?>" value="<?=$preset_value?>">
                                <?php break;
                                
                                case 'password': ?>
                                <input type="password" class="form-control" id="detail_data" name="detail_data" placeholder="<?=$detail->meta?>">
                                <?php break;

                                case 'bool': ?>
                                <input type="text" class="form-control" id="detail_data" name="detail_data" placeholder="<?=$detail->meta?>">
                                <?php break;

                                case 'select': ?>
                                <select name="detail_data" id="detail_data" class="form-control">
                                    <?php
                                        foreach(explode(",", $detail->meta) as $type):
                                    ?>
                                    <option value="<?=$type?>" <?php if($preset_value == $type) echo "selected"?>><?=$type?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?php break;
                                
                                case 'date': ?>
                                <input type="date" class="form-control" id="detail_data" name="detail_data" placeholder="<?=$detail->meta?>"  value="<?=$preset_value?>">
                                <?php break;

                                case 'time': ?>
                                <input type="time" class="form-control" id="detail_data" name="detail_data" placeholder="<?=$detail->meta?>"  value="<?=$preset_value?>">
                                <?php break;
                                
                                default:
                                    echo "This option will be available very soon.";
                                    break;
                            }
                            ?>
                        </div>
                        <div class="col-sm-3">
                            <?php
                                if($detail->type == "file" && $preset_value != ""):
                            ?>
                                <a class="btn btn-sm btn-info btn-block" href="<?=base_url('uploads/profile/' . auth()->id . '/' . $preset_value)?>">Download</a>
                            <?php endif; ?>
                            <?php
                                if($detail->type == "image" && $preset_value != ""):
                            ?>
                                <a download class="btn btn-sm btn-info btn-block" href="<?=base_url('uploads/profile/' . auth()->id . '/' . $preset_value)?>">Download</a>
                            <?php endif; ?>
                            <button type="submit" class="btn btn-primary btn-block waves-effect waves-light">Save</button>
                        </div>
                    </div>
                </form>
                <?php
                endforeach;
                ?>
            </div> <!-- card-body -->
        </div> <!-- card -->
    </div>
</div>
