<div class="modal fade modal-fade-in-scale-up" ng-controller="editDomainForwardingController" tabindex="-1" id="modal-edit-df" role="dialog" aria-labelledby="modalLabelfade" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title" id="modalLabelfade">Child Name Server</h4>
            </div>
            <div class="modal-body">
                <form method="post" ng-submit="addForwardDomainSecret()" name="addDomainForwardingForm">
                    {{--<label for="domain-secret">Domain Secret</label>--}}
                    <input type="text" ng-show="false" ng-model="domain_id" name="domain_id" value="{{ $id }}" />
                    <div class="form-group">
                        <label>Destination Protocol</label>
                        <select name="destination_protocol" ng-model="destination_protocol" class="form-control">
                            <option value="http">http</option>
                            <option value="https">https</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Destination URL</label>
                        <input type="text" class="form-control"  ng-model="destination_url" ng-required="true" ng-pattern="destination_url_regex" name="destination_url" placeholder="Destination Url" />
                        <div class="has-error" ng-show="domainForwardingForm.destination_url.$invalid"><span class="help-block"> @lang('admin.domain.domainforwarding.destination_url.error') </span></div>
                    </div>
                    <div class="form-group">
                        <label>Source</label>
                        <input type="text" class="form-control" ng-model="source" ng-required="true" name="source" ng-pattern="source_regex" placeholder="Source" />
                        <div class="has-error" ng-show="domainForwardingForm.source.$invalid"><span class="help-block"> @lang('admin.domain.domainforwarding.source.error') </span></div>
                    </div>
                    <div class="form-group">
                        <label>URL Masking</label>
                        <select name="url_masking" ng-model="url_masking" class="form-control">
                            <option value="0">0</option>
                            <option value="1">1</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary" ng-disabled="domainForwardingForm.$invalid">Submit</button>
                    <div class="alert alert-success" ng-show="success_message != ''"><% success_message %></div>
                    <div class="alert alert-danger" ng-show="error_message != ''"><% error_message %></div>
                </form>
            </div>
        </div>
    </div>
</div>