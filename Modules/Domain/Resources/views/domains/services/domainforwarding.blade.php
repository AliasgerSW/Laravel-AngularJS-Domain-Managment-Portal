<div ng-controllre="domainForwardingController">
    <table class="table table-striped table-hover">
        <caption class="primary-color text-center">
            Manage A Record
            <a class="pull-right table-btn open-modal" data-open="#dns_a_record_add">Add</a>
        </caption>
        <thead>
        <tr>
            <th>Source</th>
            <th>Destination Protocol</th>
            <th>Destination URL</th>
            <th>URL Masking</th>
            <th>Action</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
            @if($dfs->count())
                @foreach($dfs as $df)
                    <tr>
                        <td>{{ $df->source }}</td>
                        <td>{{ $df->destination_protocol }}</td>
                        <td>{{ $df->destination_url }}</td>
                        <td>{{ $df->url_masking }}</td>
                        <td><button ng-click="openModel({{ json_encode($df) }})">Edit</button></td>
                        <td>
                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse-df-{{ $df->id }}" aria-expanded="true" aria-controls="collapseOne">
                                <i class="fa fa-fw fa-angle-down"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>