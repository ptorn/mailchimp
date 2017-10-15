<!-- Modal -->
<div class="modal fade" id="popup-subscribe" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h4 class="modal-title">Subscribe to mailinglist</h4>
      </div>
      <div class="modal-body">
        <p>Subscribe to our newsletter to recieve our latest deals and news.</p>
        <?= $form ?>
      </div>
    </div>

  </div>
</div>
<script>
$(document).ready(function(){
    $("#popup-subscribe").modal({backdrop: "static"});
});
</script>
