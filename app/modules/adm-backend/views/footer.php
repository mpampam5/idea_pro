
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2018 <a href="#" target="_blank">Urbanui</a>. All rights reserved.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Author @<?=config_item('author')?></span>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <div class="modal fade" id="modalGue" tabindex="-1" role="dialog"  aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalTitle"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
          </div>
          <div class="modal-body" id="modalContent" style="max-height: 487px; overflow-y: auto;"></div>
          <div  id="modalFooter"></div>
        </div>
      </div>
  </div>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="<?=base_url()?>_template/back/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
  <script src="<?=base_url()?>_template/back/vendors/chart.js/Chart.min.js"></script>
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="<?=base_url()?>_template/back/js/off-canvas.js"></script>
  <script src="<?=base_url()?>_template/back/js/hoverable-collapse.js"></script>
  <script src="<?=base_url()?>_template/back/js/template.js"></script>
  <script src="<?=base_url()?>_template/back/js/settings.js"></script>
  <script src="<?=base_url()?>_template/back/js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="<?=base_url()?>_template/back/js/dashboard.js"></script>
  <!-- End custom js for this page-->

  <script type="text/javascript">
    $(document).ready(function(){
      $('[data-toggle="tooltip"]').tooltip();
    });

    $('#modalGue').on('hide.bs.modal', function () {
			setTimeout(function(){
					$('#modalTitle, #modalContent').html('');
				}, 500);
	   });

     $(document).on("click","#reset_pwd", function(e){
       e.preventDefault();
       $('.modal-dialog').removeClass('modal-lg')
                         .removeClass('modal-md')
                         .addClass('modal-sm');
       $("#modalTitle").text('Reset password');
       $('#modalContent').load($(this).attr('href'));
       $("#modalGue").modal('show');
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
</body>



</html>
