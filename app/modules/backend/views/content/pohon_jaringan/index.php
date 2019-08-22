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

  <?php if ($root->id_member!=sess('id_member')): ?>
  <div class="col-md-12 mb-4 text-center">
    <a href="<?=site_url("backend/pohon_jaringan")?>" class="btn btn-info btn-sm text-white">Back To Top Parent</a>
  </div>
  <?php endif; ?>



          <div class="col-sm-12 content-root mt-2 mb-5">
            <table id="table-content-pohon">
              <!-- level1 -->
              <tr>
                <td colspan="4">
                  <div id="root" class="root1">
                    <h4><?=$root->nama?></h4>
                    <p class="text-white"><?=profile_member_where(['tb_member.id_member'=>$root->id_member],'username')?></p>
                    <p class="text-white"><?=paket($root->paket,'paket')?></p>
                    <?php if ($root->id_member!=$this->session->userdata('id_member')): ?>
                      <?=ambil_data_parent($root->id_member)?>
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
                    <?=cek_parent($root->id_member,"kiri");?>
                    <?php $id_kiri = cek_parent_id($root->id_member,"kiri");?>
                  </div>
                </td>

                <!-- kanan -->
                <td colspan="2">
                  <div id="root" class="root3">
                    <?=cek_parent($root->id_member,"kanan");?>
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
                      <?php $cucu=cek_id_cucu($id_kiri,"kiri");
                      if ($cucu['status'] == true) {
                        echo $cucu['nama'];
                        echo $cucu['username'];
                        echo $cucu['paket'];
                        if (cek_anak_cucu($cucu['id'])==true) {
                          echo '<p class="text-white">Left '.$this->btree->leftcount($cucu['id']).' | '.$this->btree->rightcount($cucu['id']).' Right</p><p class="text-white">'.$this->btree->allcount($cucu['id']).'</p>';
                        echo '<a href="'.base_url("backend/pohon_jaringan/show").'/'.$cucu['id'].'" id="show-child" class="btn btn-sm btn-success"> <i class="fa fa-arrow-circle-o-down"></i> Show Child</a>';
                      }else {
                        echo '<p class="text-white">Left '.$this->btree->leftcount($cucu['id']).' | '.$this->btree->rightcount($cucu['id']).' Right</p><p class="text-white">'.$this->btree->allcount($cucu['id']).'</p>';
                        echo '<a href="'.base_url("backend/pohon_jaringan/show").'/'.$cucu['id'].'" id="show-child" class="btn btn-sm btn-success"> <i class="fa fa-arrow-circle-o-down"></i> Add Child</a>';
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
                      <?php $cucu=cek_id_cucu($id_kiri,"kanan");
                        if ($cucu['status'] == true) {
                          echo $cucu['nama'];
                          echo $cucu['username'];
                          echo $cucu['paket'];
                          if (cek_anak_cucu($cucu['id'])==true) {
                            echo '<p class="text-white">Left '.$this->btree->leftcount($cucu['id']).' | '.$this->btree->rightcount($cucu['id']).' Right</p><p class="text-white">'.$this->btree->allcount($cucu['id']).'</p>';
                          echo '<a href="'.base_url("backend/pohon_jaringan/show").'/'.$cucu['id'].'" id="show-child" class="btn btn-sm btn-success"> <i class="fa fa-arrow-circle-o-down"></i> Show Child</a>';
                        }else {
                          echo '<p class="text-white">Left '.$this->btree->leftcount($cucu['id']).' | '.$this->btree->rightcount($cucu['id']).' Right</p><p class="text-white">'.$this->btree->allcount($cucu['id']).'</p>';
                          echo '<a href="'.base_url("backend/pohon_jaringan/show").'/'.$cucu['id'].'" id="show-child" class="btn btn-sm btn-success"> <i class="fa fa-arrow-circle-o-down"></i> Add Child</a>';
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
                          $cucu = cek_id_cucu($id_kanan,"kiri");
                          if ($cucu['status'] == true) {
                            echo $cucu['nama'];
                            echo $cucu['username'];
                            echo $cucu['paket'];
                            if (cek_anak_cucu($cucu['id'])==true) {
                              echo '<p class="text-white">Left '.$this->btree->leftcount($cucu['id']).' | '.$this->btree->rightcount($cucu['id']).' Right</p><p class="text-white">'.$this->btree->allcount($cucu['id']).'</p>';
                              echo '<a href="'.base_url("backend/pohon_jaringan/show").'/'.$cucu['id'].'" id="show-child" class="btn btn-sm btn-success"> <i class="fa fa-arrow-circle-o-down"></i> Show Child</a>';
                            }else {
                              echo '<p class="text-white">Left '.$this->btree->leftcount($cucu['id']).' | '.$this->btree->rightcount($cucu['id']).' Right</p><p class="text-white">'.$this->btree->allcount($cucu['id']).'</p>';
                              echo '<a href="'.base_url("backend/pohon_jaringan/show").'/'.$cucu['id'].'" id="show-child" class="btn btn-sm btn-success"> <i class="fa fa-arrow-circle-o-down"></i> Add Child</a>';
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
                          $cucu = cek_id_cucu($id_kanan,"kanan");
                          if ($cucu['status'] == true) {
                            echo $cucu['nama'];
                            echo $cucu['username'];
                            echo $cucu['paket'];
                            if (cek_anak_cucu($cucu['id'])==true) {
                              echo '<p class="text-white">Left '.$this->btree->leftcount($cucu['id']).' | '.$this->btree->rightcount($cucu['id']).' Right</p><p class="text-white">'.$this->btree->allcount($cucu['id']).'</p>';
                              echo '<a href="'.base_url("backend/pohon_jaringan/show").'/'.$cucu['id'].'" id="show-child" class="btn btn-sm btn-success"> <i class="fa fa-arrow-circle-o-down"></i> Show Child</a>';
                            }else {
                              echo '<p class="text-white">Left '.$this->btree->leftcount($cucu['id']).' | '.$this->btree->rightcount($cucu['id']).' Right</p><p class="text-white">'.$this->btree->allcount($cucu['id']).'</p>';
                              echo '<a href="'.base_url("backend/pohon_jaringan/show").'/'.$cucu['id'].'" id="show-child" class="btn btn-sm btn-success"> <i class="fa fa-arrow-circle-o-down"></i> Add Child</a>';
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



      <!-- <script type="text/javascript">
      $(document).on("click","#tambah",function(e){
        e.preventDefault();
        $('.modal-dialog').removeClass('modal-sm')
                          .removeClass('modal-lg')
                          .addClass('modal-md');
        $("#modalTitle").text('Tambah Member');
        $('#modalContent').load($(this).attr('href'));
        $("#modalGue").modal('show');
      });
      </script> -->
