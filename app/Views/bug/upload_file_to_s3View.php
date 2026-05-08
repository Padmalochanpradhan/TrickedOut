<style>
th
{color:#fff!important;}
td, th
{text-align:center;}
#trick_list_view td img, .jsgrid .jsgrid-table td img {
     width: 200px!important;
     height: 200px!important;
     border-radius: unset; 
    }

  .list-view {
      list-style-type: none;
      padding: 0;
  }
  .list-item {
      padding: 10px;
      margin-bottom: 10px;
      border: 1px solid #ccc;
      background-color: #f9f9f9;
  }
  .list-item span {
      font-weight: bold;
  }
 
.dataTables_wrapper .dataTables_length {
    display: none!important;
}

.serchst{
  margin-bottom: 13px!important;
  /*margin-right:5%!important;*/
  margin-top:-37px;
}

.dataTables_wrapper .dataTables_filter input {
    border: 2px solid #aaa !important;
    border-radius: 0px !important;  
    padding: 0px 0px 0px 5px !important;     
    width: 218px !important;
  height:23px!important;
  }

.me-1 {
    margin-right: 0.10rem !important;
} 
table.dataTable tbody th, table.dataTable tbody td {
    padding: 8px 2px!important;
    font-size: 12px!important;
}
.myword {
    word-wrap: break-word;
    white-space: normal;
    text-align: left;
    font-weight: normal;
}

</style>
<link rel="stylesheet" href="<?= base_url('assets/css/uploadtrick.css') ?>">
<div class="main-panel">
  <div class="content-wrapper" style="margin-top:50px;">
    <div class="row">
      <div class="col-md-12 grid-margin">
        <div class="row">
          <div class="col-lg-12 mt-3">
            <div class="row"> 
              <div class="col-lg-12 col-md-12 mt-5">

                <form action="<?= base_url('s3UploadSubmit') ?>" method="post" enctype="multipart/form-data">
    <input type="file" name="userfile" />
    <input type="submit" value="Upload to S3" />
</form>
                  
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- content-wrapper ends -->