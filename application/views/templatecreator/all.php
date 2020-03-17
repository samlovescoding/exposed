<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h4 class="page-title m-0">Template List</h4>
                </div>
                <div class="col-md-4"><a class="btn btn-primary btn-block" href="<?=base_url("templatecreator/create")?>">Create</a></div>
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
                            <table id="datatable" class="table mb-0">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Links</th>
                                        <th scope="col">Source</th>
                                        <th scope="col">Screenshot</th>
                                        <th scope="col">File</th>
                                        <th scope="col">Control</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($templates as $template): 
                                    ?>
                                    <tr>
                                        <th scope="row"><?=$template->id?></th>
                                        <td><?=$template->name?></td> 
                                        <td>
                                            <?=implode("<br>", array_slice(explode("\n", $template->links), 0, 3))?>
                                        </td>
                                        <td>
                                            <a href="<?=$template->source?>" class="btn btn-primary" target="_blank">Open</a>
                                        </td>
                                        <td>
                                            <a href="http://samlovescoding.com/data/template_screenshots/<?=$template->screenshot?>" class="btn btn-primary" target="_blank">View</a>
                                        </td>
                                        <td>
                                            <a class="btn btn-primary" href="<?=$template->file?>" target="_blank" rel="noopener noreferrer">Download</a>
                                        </td>
                                        <td>
                                            <a class="btn btn-danger btn-sm btn-block" href="<?=base_url("templatecreator/delete/" . $template->id . "/")?>">Delete</a>
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


<!-- DataTables -->
<link href="<?=base_url()?>assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="<?=base_url()?>assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="<?=base_url()?>assets/plugins/datatables/fixedHeader.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="<?=base_url()?>assets/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="<?=base_url()?>assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css"/>
<link href="<?=base_url()?>assets/plugins/datatables/scroller.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<!-- Required datatable js-->
<script src="<?=base_url()?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?=base_url()?>assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
<!-- Buttons examples -->
<script src="<?=base_url()?>assets/plugins/datatables/dataTables.buttons.min.js"></script>
<script src="<?=base_url()?>assets/plugins/datatables/buttons.bootstrap4.min.js"></script>

<script src="<?=base_url()?>assets/plugins/datatables/jszip.min.js"></script>
<script src="<?=base_url()?>assets/plugins/datatables/pdfmake.min.js"></script>
<script src="<?=base_url()?>assets/plugins/datatables/vfs_fonts.js"></script>
<script src="<?=base_url()?>assets/plugins/datatables/buttons.html5.min.js"></script>
<script src="<?=base_url()?>assets/plugins/datatables/buttons.print.min.js"></script>
<script src="<?=base_url()?>assets/plugins/datatables/dataTables.fixedHeader.min.js"></script>
<script src="<?=base_url()?>assets/plugins/datatables/dataTables.keyTable.min.js"></script>
<script src="<?=base_url()?>assets/plugins/datatables/dataTables.scroller.min.js"></script>

<!-- Responsive examples -->
<script src="<?=base_url()?>assets/plugins/datatables/dataTables.responsive.min.js"></script>
<script src="<?=base_url()?>assets/plugins/datatables/responsive.bootstrap4.min.js"></script>
<script>
  !function($) {
      "use strict";

      var DataTable = function() {
          this.$dataTableButtons = $("#datatable-buttons")
      };
      DataTable.prototype.createDataTableButtons = function() {
          0 !== this.$dataTableButtons.length && this.$dataTableButtons.DataTable({
              dom: "Bfrtip",
              buttons: [{
                  extend: "copy",
                  className: "btn-success"
              }, {
                  extend: "csv"
              }, {
                  extend: "excel"
              }, {
                  extend: "pdf"
              }, {
                  extend: "print"
              }],
              responsive: !0
          });
      },
      DataTable.prototype.init = function() {
          //creating demo tabels
          $('#datatable').dataTable();
          
          var table = $('#datatable-fixed-header').DataTable({fixedHeader: true});

          //creating table with button
          this.createDataTableButtons();
      },
      //init
      $.DataTable = new DataTable, $.DataTable.Constructor = DataTable
  }(window.jQuery),

  //initializing
  function ($) {
      "use strict";
      $.DataTable.init();
  }(window.jQuery);
</script>
