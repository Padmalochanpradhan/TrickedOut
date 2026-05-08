   <footer class="footer">
     <div class="d-sm-flex justify-content-center justify-content-sm-between me-4">
           <div>
    <a class="nav-link d-flex justify-content-center" href="#/" >
          <span class="menu-title text-center" ><?= date('Y')?> © Tricked Out Magic Vault. All rights reserved</span>
           </a>
  </div>
    </div>
      </footer>   
      <!-- partial -->
    </div>
    <!-- main-panel ends -->
  </div>
  <!-- page-body-wrapper ends -->
</div>

<!-- container-scroller -->

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