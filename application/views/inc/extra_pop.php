<!-- Modal -->
<div class="modal fade" id="forgot" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" 
               aria-hidden="true">x
            </button>
            <h4 class="modal-title" id="forgot">
               This Modal title
            </h4>
         </div>
         <div class="modal-body">
            <div class="container-fluid">
                <div class="col-lg-6">
                  <form action="#" id="recover_mail">
                    <div class="form-group">
                        <label class="form-label-cust">Enter your recover email ID :</label>
                        <input type="email" class="form-control  form-control-cust" name="recover_mail" placeholder="Enter your email ID">
                        <input type="submit" value="Send Email" class="btn btn-xs btn-default">
                        <div id="recover_email_res"></div>
                    </div>
                  </form>
                </div>
                <div class="col-lg-6">
                  <form action="do_upload/" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="form-label-cust">Select a picture :</label>
                        <input type="file" class="form-control  form-control-cust" name="userfile">
                        <input type="submit" value="UPDATE PROFILE PIC" class="btn btn-xs btn-default">
                    </div>
                  </form>
                </div>
            </div>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default" 
               data-dismiss="modal">Close
            </button>
         </div>
      </div><!-- /.modal-content -->
   </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script>
$(function () {
  $('#forgot-popup,#forgot-popup1').click(function(e){
        $('#forgot').modal('show');
        e.preventDefault();
  });
});



</script>