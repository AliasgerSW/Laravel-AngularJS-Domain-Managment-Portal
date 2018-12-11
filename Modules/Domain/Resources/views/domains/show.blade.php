@extends('adminTheme.default')

@section('title','Manage Domain')

@section('style')
    <link href="{{ asset('adminTheme/vendors/modal/css/component.css') }}" rel="stylesheet" />
@endsection

@section('content-header')
    <h1>Manage: {{ $domain->domain_name }}</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ url('admin') }}">
                <i class="livicon" data-name="home" data-size="14" data-loop="true"></i> Dashboard
            </a>
        </li>
        <li>
            <a href="{{ route('domain.index') }}">Domain</a>
        </li>
        <li class="active">View</li>
    </ol>
    @include('errors.list')
@endsection

@section('content')
 <div class="row">
     <div class="col-md-4">
         <a href="" data-toggle="modal" data-target="#contactDetail"><h4>Contact Details</h4></a>
         <p>Manage contacts associated with this Domain Name</p>
     </div>
     <div class="col-md-4">
         <a href="" data-toggle="modal" data-target="#privacyProtection"><h4>Privacy Protection</h4></a>
         <p>Manage contacts associated with this Domain Name</p>
     </div>
     <div class="col-md-4">
         <a href="" data-toggle="modal" data-target="#nameServer"><h4>Name Servers</h4></a>
         <p>Manage contacts associated with this Domain Name</p>
     </div>
     <div class="col-md-4">
         <a href="" data-toggle="modal" data-target="#childNameServer"><h4>Child Name Servers</h4></a>
         <p>Manage contacts associated with this Domain Name</p>
     </div>
     <div class="col-md-4">
         <a href="" data-toggle="modal" data-target="#domainSecret"><h4>Domain Secret</h4></a>
         <p>Manage contacts associated with this Domain Name</p>
     </div>
     <div class="col-md-4">
         <a href="" data-toggle="modal" data-target="#theftProtection"><h4>Theft Protection</h4></a>
         <p>Manage contacts associated with this Domain Name</p>
     </div>
     <div class="col-md-4">
         <a href="" data-toggle="modal" data-target="#dnssec"><h4>DNSSEC</h4></a>
         <p>Manage contacts associated with this Domain Name</p>
     </div>
     <div class="col-md-4">
         <a href="" data-toggle="modal" data-target="#getOnePageWebsite"><h4>Get Instant One Page Website</h4></a>
         <p>Manage contacts associated with this Domain Name</p>
     </div>
 </div>

 @include('domain::domains.modal.contactDetail')
 @include('domain::domains.modal.privacyProtection')
 @include('domain::domains.modal.nameServer')
 @include('domain::domains.modal.childNameServer')
 @include('domain::domains.modal.domainSecret')
 @include('domain::domains.modal.theftProtection')
 @include('domain::domains.modal.dnssec')
 @include('domain::domains.modal.getOnePageWebsite')

@endsection

@section('script')

@endsection