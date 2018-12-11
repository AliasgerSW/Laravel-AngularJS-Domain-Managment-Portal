
<div class="modal fade" id="editConfirmModal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit Confirm</h4>
            </div>
            <div class="modal-body">
                <p>You are already editing a row, you must save or cancel that row before editing/deleting a new
                    row</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


<div class="modal fade modal-fade-in-scale-up" tabindex="-1" id="add-tld-group-modal" role="dialog" aria-labelledby="modalLabelfade" aria-hidden="true">
    <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title" id="modalLabelfade">ADD TLD Group</h4>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label for="tld-name" class="control-label">Name:</label>
                        <input type="text" class="form-control" placeholder="gTLD" name="name" id="tld-name" />

                    </div>

                </div>
                <div class="modal-footer">
                    <input type="submit" value="Save" class="btn  btn-primary" id="add-tld-group-btn" />
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="confirm-modal-title">Deletes Item</h4>
            </div>
            <div class="modal-body">
                <p class="confirm-modal-body">Are you sure to  Delete?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger" id="confirm-modal-btn" data-dismiss="modal">Delete
                </button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>