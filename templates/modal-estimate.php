<?php
/**
 * Description: Estimate modal.
 *
 * @package 
 * @subpackage 
 * @since 
 */
?>

<!-- Review Modal -->
<div class="modal fade" id="estimate">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>Get a Quote</h3>
      </div>
      <div class="modal-body">
        <?php
          $whitelist = array('127.0.0.1', '::1');
          echo do_shortcode('[contact-form-7 id="'.(in_array($_SERVER['REMOTE_ADDR'], $whitelist)?101:66).'" title="Estimate"]');
        ?>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="estimate-sent">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>Get a Quote</h3>
      </div>
      <div class="modal-body">
        Your message was sent successfully. Thanks!
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- / modal -->

