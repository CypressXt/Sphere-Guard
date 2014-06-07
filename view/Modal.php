<!-- modal window -->
<div class="modal fade" id="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><?php echo $modalTitle; ?></h4>
            </div>
            <div class="modal-body">
                <p id="modalNotifArea" style="display: none;"></p>
                <p><?php echo $modalBody; ?></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" id="modalRightButton" class="btn btn-primary" onclick="<?php echo $modalRightButtonOnclick; ?>"><?php echo $modalRightButtonText; ?></button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->