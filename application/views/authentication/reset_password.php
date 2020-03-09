
<div class="accountbg"></div>
<div class="wrapper-page">
    <div class="card card-pages">

        <div class="card-body">
            <div class="text-center m-t-20 m-b-30">
                    <a href="<?=base_url();?>" class="logo logo-admin"><img src="<?=base_url();?>assets/images/logo-dark.png" alt="" height="34"></a>
            </div>

            <h4 class="text-muted text-center m-t-0"><b>Reset Password</b></h4>

            <form class="form-horizontal m-t-20" method="post">

                <?php 
                    if(isset($success)):
                ?>
                <div class="alert alert-primary"><?=$success?> <a href="<?=base_url('authentication/login')?>">Click me to go to login page.</a></div>
                <?php
                    endif;
                ?>

                <?php 
                    if(isset($error)):
                ?>
                <div class="alert alert-danger"><?=$error?></div>
                <?php
                    endif;
                ?>

                <?=validation_errors("<div class='alert alert-danger'>", "</div>");?>

                <div class="form-group">
                    <div class="col-12">
                        <input class="form-control" name="password" type="password" required="" placeholder="Password" value="<?=set_value('password')?>">
                    </div>
                </div>

                <div class="form-group text-center m-t-40">
                    <div class="col-12">
                        <button class="btn btn-primary btn-block btn-lg waves-effect waves-light" type="submit">Change Password</button>
                    </div>
                </div>

                <div class="form-group row m-t-30 m-b-0">
                    <div class="col-sm-7">
                        <a href="<?=base_url("authentication/login/")?>" class="text-muted"><i class="fa fa-lock m-r-5"></i> Login Instead</a>
                    </div>
                    <div class="col-sm-5 text-right">
                        <a href="<?=base_url("authentication/register/")?>" class="text-muted">Create an account</a>
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>


