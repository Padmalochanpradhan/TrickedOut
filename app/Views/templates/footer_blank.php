     <!--  <footer class="footer">
        <div class="d-sm-flex justify-content-center justify-content-sm-between">
          <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2025.  
          All rights reserved.</span>
        </div>
      </footer> -->
      <!-- partial -->
    </div>
    <!-- main-panel ends -->
  </div>
  <!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
<!-- Modal for trick insert ----- -->

<!-- plugins:js -->
<script src="<?= base_url('assets/js/bootstrap-datepicker.min.js') ?>"></script>   
<script src="<?= base_url('assets/js/formpickers.js') ?>"></script>
<script src="<?= base_url('assets/js/vendor.bundle.base.js') ?>"></script>
<script src="<?= base_url('assets/js/hoverable-collapse.js') ?>"></script>
<script src="<?= base_url('assets/js/template.js') ?>"></script>
<script src="<?= base_url('assets/js/off-canvas.js') ?>"></script>
<script src="<?= base_url('assets/js/bootstrap.min.js') ?>"></script>   
<!-- DataTables JS -->
<script src="<?= base_url('assets/js/jquery.dataTables.min.js') ?>"></script>  
  
<script src="<?= base_url('assets/js/jquery.validate.min.js') ?>"></script>   
<script src="<?= base_url('js/common.js') ?>"></script>
<script type="text/javascript">
$(document).ready(function() {
  $('#example').DataTable({
    language: { search: "" },
});
  $('input[type="search"]').attr('placeholder', 'Search...');
  $(".dataTables_filter").addClass("serchst");
     
});
  function cross(id) {
    $('#'+id).modal('hide');
  }


</script>
</body>
</html>