<!doctype html>
<html lang="en">


<head>
    <meta charset="utf-8" />
    <title><?php if(isset($title)) echo $title; else echo "Your Dashboard";?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta content="Expo Dashboard by samlovescoding" name="description" />
    <meta content="samlovescoding" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <link rel="shortcut icon" href="<?=base_url()?>assets/images/favicon.ico">

    <!--Morris Chart CSS -->
    <link rel="stylesheet" href="<?=base_url()?>assets/plugins/morris/morris.css">

    <link href="<?=base_url()?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="<?=base_url()?>assets/css/icons.css" rel="stylesheet" type="text/css">
    <link href="<?=base_url()?>assets/css/style.css" rel="stylesheet" type="text/css">
    <script src="<?=base_url()?>assets/js/jquery.min.js"></script>

</head>

<body>

    <?php $this->load->view("dashboard/components/header"); ?>

    <div class="wrapper">
        <div class="container-fluid">
            <?php $this->load->view("dashboard/components/validation"); ?>
            <?php if(isset($page)) $this->load->view($page);?>
            <!-- end container-fluid -->
        </div>
    </div>
    <!-- end wrapper -->

    <?php $this->load->view("dashboard/components/footer"); ?>

    <!-- jQuery  -->
    <script src="<?=base_url()?>assets/js/popper.min.js"></script>
    <script src="<?=base_url()?>assets/js/bootstrap.min.js"></script>
    <script src="<?=base_url()?>assets/js/modernizr.min.js"></script>
    <script src="<?=base_url()?>assets/js/detect.js"></script>
    <script src="<?=base_url()?>assets/js/fastclick.js"></script>
    <script src="<?=base_url()?>assets/js/jquery.slimscroll.js"></script>
    <script src="<?=base_url()?>assets/js/jquery.blockUI.js"></script>
    <script src="<?=base_url()?>assets/js/waves.js"></script>
    <script src="<?=base_url()?>assets/js/wow.min.js"></script>
    <script src="<?=base_url()?>assets/js/jquery.nicescroll.js"></script>
    <script src="<?=base_url()?>assets/js/jquery.scrollTo.min.js"></script>

    <!--Morris Chart-->
    <script src="<?=base_url()?>assets/plugins/morris/morris.min.js"></script>
    <script src="<?=base_url()?>assets/plugins/raphael/raphael.min.js"></script>

    <!-- KNOB JS -->
    <script src="<?=base_url()?>assets/plugins/jquery-knob/excanvas.js"></script>
    <script src="<?=base_url()?>assets/plugins/jquery-knob/jquery.knob.js"></script>

    <script src="<?=base_url()?>assets/plugins/flot-chart/jquery.flot.min.js"></script>
    <script src="<?=base_url()?>assets/plugins/flot-chart/jquery.flot.tooltip.min.js"></script>
    <script src="<?=base_url()?>assets/plugins/flot-chart/jquery.flot.resize.js"></script>
    <script src="<?=base_url()?>assets/plugins/flot-chart/jquery.flot.pie.js"></script>
    <script src="<?=base_url()?>assets/plugins/flot-chart/jquery.flot.selection.js"></script>
    <script src="<?=base_url()?>assets/plugins/flot-chart/jquery.flot.stack.js"></script>
    <script src="<?=base_url()?>assets/plugins/flot-chart/jquery.flot.crosshair.js"></script>

    <script src="<?=base_url()?>assets/pages/dashboard.js"></script>

    <script src="<?=base_url()?>assets/js/app.js"></script>

</body>

</html>