<div class="modal fade modal-fade-in-scale-up" tabindex="-1" id="add-tld-modal" role="dialog" aria-labelledby="modalLabelfade" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{ route('tld.store') }}" method="post">
            {!! csrf_field()  !!}
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title" id="modalLabelfade">ADD TLD</h4>
            </div>
            <div class="modal-body">

                    <div class="form-group">
                        <label for="tld-name" class="control-label">Name:</label>
                        <input type="text" class="form-control" placeholder=".com" name="name" id="tld-name" />

                    </div>

                    <div class="form-group">
                        <p>Sale Status:</p>
                        <input type="radio" name="is_active_for_sale" class="line" value="1" checked/>
                        <label>Active For Sale
                        </label>
                        <input type="radio" name="is_active_for_sale" class="line" value="0" />
                        <label>InActive For Sale
                        </label>
                    </div>

                    <div class="form-group">
                        <label for="registrar" class="control-label">Choose Registrar:</label>
                        <select name="registrar" class="form-control" id="registrar">
                            <option value="OpenSRS">Open SRS</option>
                            <option value="ResellerClub">Reseller Club</option>
                            <option value="both">Both</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="feature" class="control-label">Feature:</label>
                        <select name="feature" class="form-control" id="feature">
                            <option value="Popular">Popular</option>
                            <option value="Regular">Regular</option>
                        </select>
                    </div>
                <input type="hidden" name="sequence" value="1" />


            </div>
            <div class="modal-footer">
                {{--<button class="btn  btn-primary" data-dismiss="modal">Save</button>--}}
                <input type="submit" value="Save" class="btn  btn-primary" />
            </div>
        </div>
        </form>
    </div>
</div>