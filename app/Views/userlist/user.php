<style type="text/css">
  .form-control{
    color: #000 !important;
    border: 1px solid #ccc !important;
  }
</style>
<link rel="stylesheet" href="<?= base_url('assets/css/jquery-ui.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/jquery.timepicker.min.css') ?>"> 
<script src="<?= base_url('assets/js/jquery-ui.min.js') ?>"></script>
<script src="<?= base_url('assets/js/jquery.timepicker.min.js') ?>"></script> 
<div class="main-panel">
  <div class="content-wrapper">
    <div class="row" style="margin-top:80px;">
      <div class="col-md-12 grid-margin">
        <div class="row">
          <div class="col-lg-12 mt-3 p-0">
           <h3>User List</h3>
           <div align="right"></div>  
           <div class="col-lg-12 col-md-12">
            <table id="example1" class="display" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>Name</th>
                  <th class="text-center">Phone</th>
                  <th>Email</th>
                  <th class="text-center">Registered On</th>
                  <th class="text-center">Verified?</th>
                  <th class="text-center">Subscription</th>

                  <th class="text-center">Status</th>
                  <!-- <th>Action</th> -->
                </tr>
              </thead>
              <tbody>
                <?php foreach ($userList as $key => $value) { 
                  $added_date = new DateTime($value->added_date, new DateTimeZone("UTC"));
                  //$enddate = new DateTime($value->end_date, new DateTimeZone("UTC"));
                  $periods = "";
                  if($value->for_month){
                    $periods = "/Monthly";
                  }
                  if($value->for_year){
                    $periods = "/Yearly";
                  }
                  ?> 
                  <tr>
                    <td><?php echo $value->first_name." ".$value->last_name; ?></td>
                    <td class="text-center"><?php echo format_phone($value->phone);?></td>
                    <td><?php echo $value->email_id; ?></td>
                    <td class="text-center" data-order="<?= $added_date->format('Y-m-d'); ?>"><?php echo $added_date->format('m/d/Y'); ?></td>
                    <td class="text-center"><?= $value->is_verified == 1 ? 'Yes' : 'No'; ?></td>
                    <td>
                      <?php if (!empty($value->subscription)) {

                          $sub = $value->subscription;

                          $productName = $sub['product_name'] ?? 'N/A';
                          $status      = strtolower($sub['status'] ?? '');
                          $interval    = $sub['interval'] ?? '';

                          echo '<strong>' . esc($productName) . '</strong><br>';

                          if ($status === 'trialing') {

                              $trialEnd = !empty($sub['trial_end'])
                                  ? date('m/d/Y', strtotime($sub['trial_end']))
                                  : '—';

                              echo '<small class="text-warning">';
                              echo 'Trialing / Trial ends on ' . esc($trialEnd);
                              echo '</small>';

                          } elseif ($status === 'active') {

                              $start = !empty($sub['period_start']) && $sub['period_start'] !== '1969-12-31'
                                  ? date('m/d/Y', strtotime($sub['period_start']))
                                  : '—';

                              $end = !empty($sub['period_end']) && $sub['period_end'] !== '1969-12-31'
                                  ? date('m/d/Y', strtotime($sub['period_end']))
                                  : '—';

                              echo '<small class="text-success">';
                              echo 'Active / ' . esc($start) . ' – ' . esc($end);
                              echo '</small>';

                          } else {

                              echo '<small class="text-muted">' . ucfirst($status) . '</small>';
                          }

                      } else { ?>

                          <span class="text-muted">—</span>

                      <?php } ?>
                      </td>

                    <td class="text-center"><?php 
                            if ($value->employee_status == 0) {
                                echo 'Active';
                            } elseif ($value->employee_status == 1) {
                                echo 'Inactive';
                            } elseif ($value->employee_status == -1) {
                                echo 'Default';
                            }

                        ?>                  
                    </td>
                    <!-- <td><a title="Edit" style="cursor: pointer;" onclick="update_plan('<?php echo $value->employee_id; ?>');">Edit</a>
                    </td> -->
                  </tr>
                <?php } ?> 
              </tbody>
            </table> 
          </div>  
        </div>
      </div>
    </div>
  </div>
</div>
<!-- content-wrapper ends -->




<script type="text/javascript">
 // $(document).ready(function() {  
 //   $('#example1').DataTable(); 
 // });
//$('.datepicker').datepicker({ changeMonth: true,changeYear: true });
$(document).ready(function() {
    $('#example1').DataTable({
        order: [[3, 'desc']] // Register On column (latest first)
    });
});

</script>

