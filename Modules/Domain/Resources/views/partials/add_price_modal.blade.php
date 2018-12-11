<div class="modal fade modal-fade-in-scale-up" tabindex="-1" id="add-price-modal" role="dialog" aria-labelledby="modalLabelfade" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title" id="modalLabelfade">ADD Promo Price</h4>
            </div>
            <div class="modal-body">
                <form id="promo-price-form">
                    <input type="hidden" name="tld_id" value="{{ $tld->id }}" />
                    <div class="form-group">
                        <label for="tld-name" class="control-label">Year:</label>
                        <input type="text" class="form-control" placeholder="1" name="year" id="promo-year" />

                    </div>
                    <div class="form-group">
                        <label for="tld-name" class="control-label">Regular Price:</label>
                        <input type="text" class="form-control" placeholder="10,00" name="regular_price" id="regular_price" />

                    </div>

                    <div class="form-group">
                        <label for="tld-name" class="control-label">Promo Price:</label>
                        <input type="text" class="form-control" placeholder="8,00" name="promo_price" id="promo_price" />

                    </div>

                    <div class="form-group">
                        <label>
                            Promo Price Range:
                        </label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="livicon" data-name="phone" data-size="14" data-loop="true"></i>
                            </div>
                            <input type="text" class="form-control" id="promo_date_range"  name="promo_date_range" />
                        </div>
                        <!-- /.input group -->
                    </div>

                    <div class="form-group">
                        <label for="tld-name" class="control-label">Bulk Price:</label>
                        <input type="text" class="form-control" placeholder="5,00" name="bulk_price" id="bulk_price" />

                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <input type="submit" value="Save" class="btn  btn-primary" id="add-promo-price-btn" />
            </div>
        </div>
        </form>
    </div>
</div>

<div class="modal fade modal-fade-in-scale-up" tabindex="-1" id="add-renewal-modal" role="dialog" aria-labelledby="modalLabelfade" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title" id="modalLabelfade">ADD Renewal Price</h4>
            </div>
            <div class="modal-body">
                <form id="renewal-price-form">
                    <input type="hidden" name="tld_id" value="{{ $tld->id }}" />
                    <div class="form-group">
                        <label for="tld-name" class="control-label">Year:</label>
                        <input type="text" class="form-control" placeholder="1" name="year" id="renewal_year" />

                    </div>
                    <div class="form-group">
                        <label for="tld-name" class="control-label">Renewal Price:</label>
                        <input type="text" class="form-control" placeholder="10,00" name="renewal_price" id="renewal_regular_price" />

                    </div>

                    <div class="form-group">
                        <label for="tld-name" class="control-label">Promo Price:</label>
                        <input type="text" class="form-control" placeholder="8,00" name="promo_price" id="renewal_promo_price" />

                    </div>

                    <div class="form-group">
                        <label>
                            Promo Price Range:
                        </label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="livicon" data-name="phone" data-size="14" data-loop="true"></i>
                            </div>
                            <input type="text" class="form-control" id="renewal_date_range"  name="renewal_date_range" />
                        </div>
                        <!-- /.input group -->
                    </div>
                </form>


            </div>
            <div class="modal-footer">
                <input type="submit" value="Save" class="btn  btn-primary" id="add-renewal-price-btn" />
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