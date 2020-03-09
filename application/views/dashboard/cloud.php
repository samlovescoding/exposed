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

<!-- Datatable init js -->
<script src="<?=base_url()?>assets/plugins/plupload/plupload.full.min.js"></script>

<div class="row m-t-10">
    <div class="offset-sm-4 col-sm-4">
        <div class="card">
            <div class="card-body">
                <div id="ccontainer">
                    <button id="cpickfiles" class="btn btn-block btn-primary">Upload Files</button>
                </div>
                <div id="cfilelist">Your browser doesn't have Flash, Silverlight or HTML5 support.</div>
            </div>
        </div>
    </div>
</div>


<div class="row">
	<div class="col-sm-12">
		<div class="card">
			<div class="card-body">
				<h4 class="m-b-30 m-t-0">User Directory</h4>
				<div class="row">
					<div class="col-lg-12 col-sm-12 col-12">
						<table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; width: 100%;">
							<thead>
								<tr>
									<th>Name</th>
									<th>Size</th>
									<th>MIME</th>
									<th>Date Modified</th>
									<th>Options</th>
								</tr>
							</thead>


							<tbody>
								<?php foreach($files as $file): ?>
								<tr>
									<td><?=$file["name"]?></td>
									<td><?=$file["size"]?></td>
									<td><?=$file["mime"]?></td>
									<td><?=$file["date_modified"]?></td>
									<td>
										<a href="<?=base_url("cloud/shared/" . auth()->username . "/" . $file["name"])?>" class="btn btn-primary">Public Link</a>
										<a href="<?=base_url("dashboard/cloud_download/" . $file["name"])?>" download class="btn btn-primary">Download</a>
										<a href="<?=base_url("dashboard/cloud_delete/" . $file["name"])?>" class="btn btn-danger">Delete</a>
									</td>
								</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<script>
      window.addEventListener("load", function () {
        var path = "vendor/moxiecode/plupload/js/`";
        var uploader = new plupload.Uploader({
          runtimes: 'html5,flash,silverlight,html4',
          flash_swf_url: path + 'Moxie.swf',
          silverlight_xap_url: path + '/Moxie.xap',
          browse_button: 'cpickfiles',
          container: document.getElementById('ccontainer'),
          url: '<?=base_url("dashboard/cloud_upload")?>',
          chunk_size: '200kb',
          max_retries: 2,
          filters: {
            max_file_size: '10mb',
            mime_types: [{title: "Image files", extensions: "jpg,gif,png,*"}]
          },
          init: {
            PostInit: function () {
              $("#cfilelist").html(`Refresh Page after files are uploaded.`);
            },
            FilesAdded: function (up, files) {
              plupload.each(files, function (file) {
                $("#cfilelist").append(`<div class="progress progress-lg m-t-10 m-b-10" id="${file.id}">
                      <div class="progress-bar progress-bar-purple progress-bar-striped  progress-bar-animated" role="progressbar" style="width:0%;">
                        ${file.name} (${file.size})
                      </div>
                  </div>`);
              });
              uploader.start();
            },
            UploadProgress: function (up, file) {
              $("#" + file.id + " .progress-bar").css("width", file.percent + "%")
            },
            Error: function (up, err) {
              //console.log(err);
              $("#cfilelist").html(`<div class="progress progress-lg m-t-10 m-b-10" id="file-error">
                      <div class="progress-bar progress-bar-danger" role="progressbar" style="width:100%;">
                        ${err.message}
                      </div>
                  </div>`);
            }
          }
        });
        uploader.init();
      });
</script>

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

