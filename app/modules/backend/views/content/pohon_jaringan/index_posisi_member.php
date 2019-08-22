<?php
  if (profile_member($id_member_verif,"paket")!=false) {
    $paket = profile_member($id_member_verif,"paket");
    $pin = paket($paket,'pin');
  }else {
    redirect(site_url("backend/member/menunggu_verifikasi"),'refresh');
  }

 ?>
<?php if ($this->balance->stok_pin(sess('id_member')) >=$pin): ?>

<link rel="stylesheet" href="<?=base_url()?>_template/back/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
<script src="<?=base_url()?>_template/back/vendors/datatables.net/jquery.dataTables.js"></script>
<script src="<?=base_url()?>_template/back/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>

<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-light">
    <li class="breadcrumb-item"><a href="<?=site_url("backend/index")?>">Dashboard</a></li>
    <li class="breadcrumb-item active" aria-current="page"><?=$title?></li>
  </ol>
</nav>


<div class="row">
  <div class="col-sm-12">
    <div class="alert alert-info">Cari posisi yang tepat buat <b><?=strtoupper(profile_member($id_member_verif,"nama"))?></b> sebagai calon mitra baru anda</div>
  </div>
        <hr>



          <div class="col-sm-12 content-root">
            <table id="table-content-pohon">
              <!-- level1 -->
              <tr>
                <td colspan="4">
                  <div id="root" class="root1">
                    <h4><?=$root->nama?></h4>
                    <p class="text-white"><?=profile_member_where(['tb_member.id_member'=>$root->id_member],'username')?></p>
                    <p class="text-white"><?=paket($root->paket,'paket')?></p>
                    <?php if ($root->id_member!=$this->session->userdata('id_member')): ?>
                      <?=ambil_data_parent($root->id_member,$id_member_verif)?>
                    <?php else: ?>
                    <?= '<p class="text-white">Left '.$this->btree->leftcount($root->id_member).' | '.$this->btree->rightcount($root->id_member).' Right</p><p class="text-white">'.$this->btree->allcount($root->id_member).'</p>';?>
                    <?php endif; ?>
                  </div>
                </td>
              </tr>
              <!-- end level 1 -->

              <!-- level 2 -->
              <tr>
                <!-- kiri -->
                <td colspan="2">
                  <div id="root" class="root2">
                    <?=cek_parent($root->id_member,"kiri",$id_member_verif);?>
                    <?php $id_kiri = cek_parent_id($root->id_member,"kiri");?>
                  </div>
                </td>

                <!-- kanan -->
                <td colspan="2">
                  <div id="root" class="root3">
                    <?=cek_parent($root->id_member,"kanan",$id_member_verif);?>
                    <?php $id_kanan = cek_parent_id($root->id_member,"kanan")?>
                  </div>
                </td>

              </tr>
              <!-- end level 2 -->



              <!-- level 3 -->
              <tr>
                <!-- kiri -->
                <td>
                  <div id="root" class="root4">
                    <?php if ($id_kiri!=false): ?>
                      <?php $cucu=cek_id_cucu($id_kiri,"kiri",$id_member_verif);
                      if ($cucu['status'] == true) {
                        echo $cucu['nama'];
                        echo $cucu['username'];
                        echo $cucu['paket'];
                        if (cek_anak_cucu($cucu['id'])==true) {
                          echo '<p class="text-white">Left '.$this->btree->leftcount($cucu['id']).' | '.$this->btree->rightcount($cucu['id']).' Right</p><p class="text-white">'.$this->btree->allcount($cucu['id']).'</p>';
                        echo '<a href="'.base_url("backend/pohon_jaringan/verifikasi_member_show").'/'.$cucu['id'].'/'.$id_member_verif.'" id="show-child" class="btn btn-sm btn-success"> <i class="fa fa-arrow-circle-o-down"></i> Show Child</a>';
                      }else {
                        echo '<p class="text-white">Left '.$this->btree->leftcount($cucu['id']).' | '.$this->btree->rightcount($cucu['id']).' Right</p><p class="text-white">'.$this->btree->allcount($cucu['id']).'</p>';
                        echo '<a href="'.base_url("backend/pohon_jaringan/verifikasi_member_show").'/'.$cucu['id'].'/'.$id_member_verif.'" id="show-child" class="btn btn-sm btn-success"> <i class="fa fa-arrow-circle-o-down"></i> Add Child</a>';
                      }
                      }else {
                        echo $cucu["button"];
                      }
                      ?>
                    <?php endif; ?>
                  </div>
                </td>

                <!-- kanan -->
                <td>
                  <div id="root" class="root5">
                    <?php if ($id_kiri!=false): ?>
                      <?php $cucu=cek_id_cucu($id_kiri,"kanan",$id_member_verif);
                        if ($cucu['status'] == true) {
                          echo $cucu['nama'];
                          echo $cucu['username'];
                          echo $cucu['paket'];
                          if (cek_anak_cucu($cucu['id'])==true) {
                            echo '<p class="text-white">Left '.$this->btree->leftcount($cucu['id']).' | '.$this->btree->rightcount($cucu['id']).' Right</p><p class="text-white">'.$this->btree->allcount($cucu['id']).'</p>';
                          echo '<a href="'.base_url("backend/pohon_jaringan/verifikasi_member_show").'/'.$cucu['id'].'/'.$id_member_verif.'" id="show-child" class="btn btn-sm btn-success"> <i class="fa fa-arrow-circle-o-down"></i> Show Child</a>';
                        }else {
                          echo '<p class="text-white">Left '.$this->btree->leftcount($cucu['id']).' | '.$this->btree->rightcount($cucu['id']).' Right</p><p class="text-white">'.$this->btree->allcount($cucu['id']).'</p>';
                          echo '<a href="'.base_url("backend/pohon_jaringan/verifikasi_member_show").'/'.$cucu['id'].'/'.$id_member_verif.'" id="show-child" class="btn btn-sm btn-success"> <i class="fa fa-arrow-circle-o-down"></i> Add Child</a>';
                        }
                        }else {
                          echo $cucu["button"];
                        }
                      ?>

                    <?php endif; ?>
                  </div>
                </td>


                <!-- kiri -->
                <td>
                  <div id="root" class="root6">
                    <?php if ($id_kanan!=false): ?>
                      <?php
                          $cucu = cek_id_cucu($id_kanan,"kiri",$id_member_verif);
                          if ($cucu['status'] == true) {
                            echo $cucu['nama'];
                            echo $cucu['username'];
                            echo $cucu['paket'];
                            if (cek_anak_cucu($cucu['id'])==true) {
                              echo '<p class="text-white">Left '.$this->btree->leftcount($cucu['id']).' | '.$this->btree->rightcount($cucu['id']).' Right</p><p class="text-white">'.$this->btree->allcount($cucu['id']).'</p>';
                              echo '<a href="'.base_url("backend/pohon_jaringan/verifikasi_member_show").'/'.$cucu['id'].'/'.$id_member_verif.'" id="show-child" class="btn btn-sm btn-success"> <i class="fa fa-arrow-circle-o-down"></i> Show Child</a>';
                            }else {
                              echo '<p class="text-white">Left '.$this->btree->leftcount($cucu['id']).' | '.$this->btree->rightcount($cucu['id']).' Right</p><p class="text-white">'.$this->btree->allcount($cucu['id']).'</p>';
                              echo '<a href="'.base_url("backend/pohon_jaringan/verifikasi_member_show").'/'.$cucu['id'].'/'.$id_member_verif.'" id="show-child" class="btn btn-sm btn-success"> <i class="fa fa-arrow-circle-o-down"></i> Add Child</a>';
                            }
                          }else {
                            echo $cucu["button"];
                          }
                      ?>
                    <?php endif; ?>
                  </div>
                </td>


                <!-- kanan -->
                <td>
                  <div id="root" class="root7">
                    <?php if ($id_kanan!=false): ?>
                      <?php
                          $cucu = cek_id_cucu($id_kanan,"kanan",$id_member_verif);
                          if ($cucu['status'] == true) {
                            echo $cucu['nama'];
                            echo $cucu['username'];
                            echo $cucu['paket'];
                            if (cek_anak_cucu($cucu['id'])==true) {
                              echo '<p class="text-white">Left '.$this->btree->leftcount($cucu['id']).' | '.$this->btree->rightcount($cucu['id']).' Right</p><p class="text-white">'.$this->btree->allcount($cucu['id']).'</p>';
                              echo '<a href="'.base_url("backend/pohon_jaringan/verifikasi_member_show").'/'.$cucu['id'].'/'.$id_member_verif.'" id="show-child" class="btn btn-sm btn-success"> <i class="fa fa-arrow-circle-o-down"></i> Show Child</a>';
                            }else {
                              echo '<p class="text-white">Left '.$this->btree->leftcount($cucu['id']).' | '.$this->btree->rightcount($cucu['id']).' Right</p><p class="text-white">'.$this->btree->allcount($cucu['id']).'</p>';
                              echo '<a href="'.base_url("backend/pohon_jaringan/verifikasi_member_show").'/'.$cucu['id'].'/'.$id_member_verif.'" id="show-child" class="btn btn-sm btn-success"> <i class="fa fa-arrow-circle-o-down"></i> Add Child</a>';
                            }
                          }else {
                            echo $cucu["button"];
                          }
                      ?>
                    <?php endif; ?>
                  </div>
                </td>
              </tr>
              <!-- end level 3 -->

            </table>
          </div>

      </div>



      <script type="text/javascript">
      $(document).on("click","#tambah",function(e){
        e.preventDefault();
        $('.modal-dialog').removeClass('modal-sm')
                          .removeClass('modal-lg')
                          .addClass('modal-md');
        $("#modalTitle").text('Peringatan! Verifikasi Member Baru');
        $('#modalContent').html(`<div class="row">
                                    <div class="col-sm-12">
                                      <p class="text-center">ANDA YAKIN INGIN MENAMBAHKAN <b><?=strtoupper(profile_member($id_member_verif,"nama"))?></b> SEBAGAI MITRA ANDA?</p>
                                      <div class="alert alert-warning">
                                        <b>Peringatan!</b>  Setelah memverifikasi member, anda tidak dapat menghapus nya. silahkan lihat <a href="#">informasi data member lebih dahulu</a>
                                      </div>
                                    </div>
                                  </div>
                                `);
      $('#modalFooter').addClass('modal-footer').html(`<button type='button' class='btn btn-primary btn-sm' id='ya-verifikasi'  data-url=`+$(this).attr('href')+`>Ya, saya yakin</button>
                                                        <button type='button' class='btn btn-light btn-sm' data-dismiss='modal'>Batal</button>`);
        $("#modalGue").modal('show');
      });


      $(document).on('click','#ya-verifikasi',function(e){
        $(this).prop('disabled',true)
                .text('Memproses...');
        $.ajax({
                url:$(this).data('url'),
                type:'post',
                cache:false,
                dataType:'json',
                success:function(json){
                  $('#modalGue').modal('hide');
                  $.toast({
                    text: json.alert,
                    showHideTransition: 'slide',
                    icon: "success",
                    loaderBg: '#f96868',
                    position: 'bottom-right',
                    afterHidden: function () {
                        window.location.href = json.url;
                    }
                  });


                }
              });
      });




      </script>



<?php else: ?>

<h3>Mohon Maaf PIN Anda Tidak Menuckupi, Jangan Memaksa. silahkan deposit</h3>

<?php endif; ?>
