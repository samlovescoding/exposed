<script src="<?=base_url()?>assets/plugins/plupload/plupload.full.min.js"></script>

<div class="row m-t-10">
    <div class="offset-sm-3 col-sm-6">
        <div class="card">
            
            <div class="card-body">
                <div id="ccontainer">
                    <button id="cpickfiles" class="btn btn-primary">Upload Files</button>
                </div>
                <div id="cfilelist">Your browser doesn't have Flash, Silverlight or HTML5 support.</div>
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
            mime_types: [{title: "Image files", extensions: "jpg,gif,png"}]
          },
          init: {
            PostInit: function () {
              document.getElementById('cfilelist').innerHTML = '';
            },
            FilesAdded: function (up, files) {
              plupload.each(files, function (file) {
                document.getElementById('cfilelist').innerHTML += 
                '<div id="' + file.id + '">' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b></div>';
              });
              uploader.start();
            },
            UploadProgress: function (up, file) {
              document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
            },
            Error: function (up, err) {
              // DO YOUR ERROR HANDLING!
              console.log(err);
            }
          }
        });
        uploader.init();
      });
    </script>