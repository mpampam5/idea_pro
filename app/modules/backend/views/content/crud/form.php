<link rel="stylesheet" href="<?=base_url()?>_template/back/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
<script src="<?=base_url()?>_template/back/vendors/datatables.net/jquery.dataTables.js"></script>
<script src="<?=base_url()?>_template/back/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>

<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-light">
    <li class="breadcrumb-item"><a href="<?=site_url("backend/index")?>">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="<?=site_url("backend/".$this->uri->segment(2))?>"><?=$title?></a></li>
    <li class="breadcrumb-item active" aria-current="page"><?=$button?></li>
  </ol>
</nav>


<div class="row">
  <div class="col-12 stretch-card">
    <div class="card" >

      <div class="card-body">
          <h4 class="card-title"><?=$button?> Crud</h4>

          <hr>
          <form action="<?=$action?>" id="form" autocomplete="off">
            <div class="row">
              <div class="col-sm-12">
                <div class="form-group">
                  <label for="">Nama</label>
                  <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama">
                </div>
              </div>

              <div class="col-sm-6">
                <div class="form-group">
                  <label for="">Telepon</label>
                  <input type="text" class="form-control" id="telepon" name="telepon" placeholder="Telepon">
                </div>
              </div>

              <div class="col-sm-6">
                <div class="form-group">
                  <label for="">Email</label>
                  <input type="text" class="form-control" id="email" name="email" placeholder="Email">
                </div>
              </div>

              <div class="col-sm-12">
                <div class="form-group">
                  <label for="">Alamat</label>
                  <textarea class="form-control" name="alamat" id="alamat" rows="8" cols="80" placeholder="Alamat"></textarea>
                </div>
              </div>

              <div class="col-sm-12">
                <a href="<?=site_url("backend/".$this->uri->segment(2))?>" class="btn btn-sm btn-secondary text-white"> Cancel</a>
                <button type="submit" name="button" id="submit" class="btn btn-primary btn-sm"> <?=$button?></button>
              </div>
            </div>

          </form>



      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
$("#form").submit(function(e){
  e.preventDefault();
  var me = $(this);
  $("#submit").prop('disabled',true).html('<div class="spinner-border spinner-border-sm text-white"></div> Memproses...');
  addLoaders(".card");
  $.ajax({
        url             : me.attr('action'),
        type            : 'post',
        data            :  new FormData(this),
        contentType     : false,
        cache           : false,
        dataType        : 'JSON',
        processData     :false,
        success:function(json){
          if (json.success==true) {
              $('.form-group').removeClass('.has-error')
                              .removeClass('.has');
              $.toast({
                text: json.alert,
                showHideTransition: 'slide',
                icon: 'success',
                loaderBg: '#f96868',
                position: 'bottom-right',
                afterHidden: function () {
                    location.href="<?=site_url('backend/'.$this->uri->segment(2))?>";
                }
              });


          }else {
            removeLoaders(".card");
            $("#submit").prop('disabled',false)
                        .html('<?=ucfirst($button)?>');
            $.each(json.alert, function(key, value) {
              var element = $('#' + key);
              $(element)
              .closest('.form-group')
              .find('.text-danger').remove();
              $(element).after(value);
            });
          }
        }
  });
});


function addLoaders(elemet) {
  $(elemet).append(`<div id="loaders-gue">
                      <div class="jumping-dots-loader" id="spinners-gue">
                          <span></span>
                          <span></span>
                          <span></span>
                      </div>
                    </div>`);
}

function removeLoaders(elemet){
  $(elemet).find("#loaders-gue").remove();
}

</script>
