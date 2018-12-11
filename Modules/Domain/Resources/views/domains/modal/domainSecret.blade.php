<div class="modal fade modal-fade-in-scale-up" style="display: none;" tabindex="-1" ng-controller="domainSecretController" id="domainSecret" role="dialog" aria-labelledby="modalLabelfade" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title" id="modalLabelfade">Domain Secret</h4>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="domain-secret">Domain Secret</label>
                        <input type="hidden" name="domain_id" value="{{ $id }}" />
                        <input type="text" class="form-control" id="domain-secret" name="domain_secret_key" value="" placeholder="" />
                    </div>
                    <button type="submit" class="btn btn-primary" ng-submit="saveDomainSecret()">Update</button>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn  btn-primary" data-dismiss="modal">Close me!</button>
            </div>
        </div>
    </div>
</div>