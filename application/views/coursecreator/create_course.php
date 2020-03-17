<div class="row m-t-10">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h4 class="m-t-0 m-b-30">Create a Course</h4>

                <form class="form-horizontal" method="post" enctype="multipart/form-data">
                    <div class="form-group row">
                        <label class="col-sm-2 control-label" for="title">Title</label>
                        <div class="col-sm-10">
                            <input name="title" type="text" class="form-control" placeholder="Course Title... Learn Javascript in 30 Days" id="title">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 control-label" for="description">Description</label>
                        <div class="col-sm-10">
                            <textarea name="description" class="form-control" rows="5" id="description"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 control-label" for="screenshot">Screenshot/Preview</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="file" name="screenshot">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 control-label" for="publisher">Publisher</label>
                        <div class="col-sm-10">
                            <select name="publisher" id="publisher" class="form-control">
                                <option value="udemy">Udemy</option>
                                <option value="laracasts">Laracasts</option>
                                <option value="pluralsight">Pluralsight</option>
                                <option value="lynda">Lynda</option>
                                <option value="skillshare">Skillshare</option>
                                <option value="3dmotive">3DMotive</option>
                                <option value="barnstone">Barnstone</option>
                                <option value="blendercloud">Blender Cloud</option>
                                <option value="blender101">Blender 101</option>
                                <option value="blenderguru">Blender Guru</option>
                                <option value="brookesegglestone">Brookes Egglestone</option>
                                <option value="cgcookie">CG Cookie</option>
                                <option value="cgelves">CG Elves</option>
                                <option value="coursetro">Coursetro</option>
                                <option value="ctrlpaint">Ctrl+Paint</option>
                                <option value="cubebrush">Cube Brush</option>
                                <option value="digitaltutors">Digital Tutors</option>
                                <option value="gumroad">GumRoad</option>
                                <option value="oreilly">OReilly</option>
                                <option value="packt">Packt</option>
                                <option value="thegnomonworkshop">The Gnomon Workshop</option>
                                <option value="teachlr">Teachlr</option>
                                <option value="masterclass">Masterclass</option>
                                <option value="other">Not listed here</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 control-label" for="instructor">Instructor</label>
                        <div class="col-sm-10">
                            <input name="instructor" type="text" class="form-control" placeholder="Instructor Names... Gary Simon, Jeffrey Way" id="instructor">
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="offset-sm-2 col-sm-10">
                            <button class="btn btn-primary">Create</button>
                        </div>
                    </div>

                </form>
            </div> <!-- card-body -->
        </div> <!-- card -->
    </div> <!-- col -->
</div>

<link rel="stylesheet" href="<?=base_url()?>assets/plugins/summernote/summernote-bs4.css" />
<script src="<?=base_url()?>assets/plugins/summernote/summernote-bs4.min.js"></script>
<script>

jQuery(document).ready(function(){

    $('.summernote').summernote({
        height: 200,                 // set editor height

        minHeight: null,             // set minimum height of editor
        maxHeight: null,             // set maximum height of editor

        focus: true                 // set focus to editable area after initializing summernote
    });

});
</script>