@extends('adminTheme.default')

@section('title', __('admin.general.show').' '.__('admin.staff.title'))

@section('content-header')
    <h1>Show Staff</h1>
    <ol class="breadcrumb">
        <li>
            <a href="#">
                <i class="livicon" data-name="home" data-size="14" data-color="#333" data-hovercolor="#333"></i> @lang('admin.general.dashboard')
            </a>
        </li>
        <li>
            <a href="{{ route('staffs.index') }}"> @lang('admin.staff.title')</a>
        </li>
        <li class="active"> @lang('admin.general.show') @lang('admin.staff.title')</li>
    </ol>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet box primary">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="livicon" data-name="camera" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i> @lang('admin.general.show') @lang('admin.staff.title')
                    </div>
                </div>
                <div class="portlet-body">
                    <!--main content-->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-primary">
                                <div class="panel-body">
                                    <div class="bs-example">
                                        <ul class="nav nav-tabs" style="margin-bottom: 15px;">
                                            <li class="active">
                                                <a href="#userInformation" data-toggle="tab">@lang('admin.staff.userInformation')</a>
                                            </li>
                                            <li>
                                                <a href="#contactInformation" data-toggle="tab">@lang('admin.staff.contactInformation')</a>
                                            </li>
                                            <li>
                                                <a href="#personalInformation" data-toggle="tab">@lang('admin.staff.personalInformation')</a>
                                            </li>
                                        </ul>
                                        <div id="myTabContent" class="tab-content">
                                            <div class="tab-pane fade active in" id="userInformation">
                                                <!-- image Field -->
                                                <div class="form-group col-sm-12">
                                                    <strong >@lang('admin.staff.profileImage'):</strong>
                                                    <p><img src="{{ $staff->profile_image }}" width="120px" alt="" style="margin-bottom:10px;margin-top: 10px;"></p>
                                                </div>

                                                <!-- First Name Field -->
                                                <div class="form-group col-sm-12">
                                                    <strong >@lang('admin.staff.firstName'):</strong>
                                                    <p>{{ $staff->first_name }}</p>
                                                </div>

                                                <!-- Middle Name Field -->
                                                <div class="form-group col-sm-12">
                                                    <strong >@lang('admin.staff.middleName'):</strong>
                                                    <p>{{ $staff->middle_name }}</p>
                                                </div>

                                                <!-- Last Name Field -->
                                                <div class="form-group col-sm-12">
                                                    <strong >@lang('admin.staff.lastName'):</strong>
                                                    <p>{{ $staff->last_name }}</p>
                                                </div>

                                                <!-- Gender Field -->
                                                <div class="form-group col-sm-12">
                                                    <strong >@lang('admin.staff.gender'):</strong>
                                                    <p>
                                                        @if($staff->gender == 'M')
                                                            Male
                                                        @elseif($staff->gender == 'F')
                                                            Female
                                                        @else
                                                            Other
                                                        @endif
                                                    </p>
                                                </div>

                                                <!-- Email Field -->
                                                <div class="form-group col-sm-12">
                                                    <strong >@lang('admin.staff.email'):</strong>
                                                    <p>{{ $staff->email }}</p>
                                                </div>

                                                <!-- p_email Field -->
                                                <div class="form-group col-sm-12">
                                                    <strong >@lang('admin.staff.personalEmail'):</strong>
                                                    <p>{{ $staff->p_email }}</p>
                                                </div>

                                                <!-- p_email Field -->
                                                <div class="form-group col-sm-12">
                                                    <strong >@lang('admin.staff.staffLevel'):</strong>
                                                    <p>
                                                        @if($staff->user_level == '1')
                                                            Super Administrator
                                                        @elseif($staff->user_level == '2')
                                                            Administrator
                                                        @elseif($staff->user_level == '3')
                                                            Manager
                                                        @elseif($staff->user_level == '4')
                                                            Accountant
                                                        @elseif($staff->user_level == '5')
                                                            General Staff
                                                        @elseif($staff->user_level == '6')
                                                            Supporter
                                                        @else
                                                            Other
                                                        @endif
                                                    </p>
                                                </div>

                                                <!-- Position Field -->
                                                <div class="form-group col-sm-12">
                                                    <strong >@lang('admin.staff.position'):</strong>
                                                </div>

                                                <!-- Username Field -->
                                                <div class="form-group col-sm-12">
                                                    <strong >@lang('admin.staff.username'):</strong>
                                                    <p>{{ $staff->username }}</p>
                                                </div>

                                            </div>
                                            <div class="tab-pane fade" id="contactInformation">

                                                <!-- Country Field -->
                                                <div class="form-group col-sm-12">
                                                    <strong >@lang('admin.staff.country'):</strong>
                                                    <p>{{ $staff->country->name }}</p>
                                                </div>

                                                <!-- State Field -->
                                                <div class="form-group col-sm-12">
                                                    <strong >@lang('admin.staff.state'):</strong>
                                                    <p>{{ $staff->state->name }}</p>
                                                </div>

                                                <!-- City Field -->
                                                <div class="form-group col-sm-12">
                                                    <strong >@lang('admin.staff.city'):</strong>
                                                    <p>{{ $staff->city->name }}</p>
                                                </div>

                                                <!-- Zipcode Field -->
                                                <div class="form-group col-sm-12">
                                                    <strong >@lang('admin.staff.zipCode'):</strong>
                                                    <p>{{ $staff->zipcode }}</p>
                                                </div>

                                                <!-- address1 Field -->
                                                <div class="form-group col-sm-12">
                                                    <strong >@lang('admin.staff.address1'):</strong>
                                                    <p>{{ $staff->address1 }}</p>
                                                </div>

                                                <!-- address2 Field -->
                                                <div class="form-group col-sm-12">
                                                    <strong >@lang('admin.staff.address2'):</strong>
                                                    <p>{{ $staff->address2 }}</p>
                                                </div>

                                                <!-- address2 Field -->
                                                <div class="form-group col-sm-12">
                                                    <strong >@lang('admin.staff.address3'):</strong>
                                                    <p>{{ $staff->address3 }}</p>
                                                </div>

                                                <!-- phone1 Field -->
                                                <div class="form-group col-sm-12">
                                                    <strong >@lang('admin.staff.mobileNumber'):</strong>
                                                    <p>{{ $staff->phone1 }}</p>
                                                </div>

                                                <!-- phone2 Field -->
                                                <div class="form-group col-sm-12">
                                                    <strong >@lang('admin.staff.phoneNumber'):</strong>
                                                    <p>{{ $staff->phone2 }}</p>
                                                </div>

                                                <!-- address_proof_number Field -->
                                                <div class="form-group col-sm-12">
                                                    <strong >@lang('admin.staff.addressProofType'):</strong>
                                                    <p>{{ $staff->addressProofType->proof_name }}</p>
                                                </div>

                                                <!-- address_proof_number Field -->
                                                <div class="form-group col-sm-12">
                                                    <strong >@lang('admin.staff.addressProofNumber'):</strong>
                                                    <p>{{ $staff->address_proof_number }}</p>
                                                </div>

                                                <!-- Document Field -->
                                                <div class="form-group col-sm-12">
                                                    <strong >@lang('admin.staff.document'):</strong>
                                                    <p><img src="https://dummyimage.com/110x110/000/fff&text=+Document" alt="" style="margin-bottom:10px;"></p>
                                                </div>

                                            </div>
                                            <div class="tab-pane fade" id="personalInformation">

                                                <!-- display_name Field -->
                                                <div class="form-group col-sm-12">
                                                    <strong >@lang('admin.staff.displayName'):</strong>
                                                    <p>{{ $staff->display_name }}</p>
                                                </div>

                                                <!-- interest Field -->
                                                <div class="form-group col-sm-12">
                                                    <strong >@lang('admin.staff.interest'):</strong>
                                                    <p>{{ $staff->interest }}</p>
                                                </div>

                                                <!-- skills Field -->
                                                <div class="form-group col-sm-12">
                                                    <strong >@lang('admin.staff.skills'):</strong>
                                                    <p>{{ $staff->skills }}</p>
                                                </div>

                                                <!-- language Field -->
                                                <div class="form-group col-sm-12">
                                                    <strong >@lang('admin.staff.languages'):</strong>
                                                    <p>{{ $staff->language }}</p>
                                                </div>

                                                <!-- aboutme Field -->
                                                <div class="form-group col-sm-12">
                                                    <strong >@lang('admin.staff.aboutMe'):</strong>
                                                    <p>{{ $staff->aboutme }}</p>
                                                </div>

                                                <!-- status Field -->
                                                <div class="form-group col-sm-12">
                                                    <strong >@lang('admin.staff.status'):</strong>
                                                    <p>
                                                        @if($staff->status == 'active')
                                                            Active
                                                        @elseif($staff->status == 'inactive')
                                                            Inactive
                                                        @endif
                                                    </p>
                                                </div>

                                            </div>
                                            <div class="tab-pane fade" id="dropdown1">
                                                <p>
                                                    Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack lo-fi farm-to-table readymade. Messenger bag gentrify pitchfork tattooed craft beer, iphone skateboard locavore carles etsy salvia banksy hoodie helvetica. DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork.Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi qui.Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi qui.
                                                </p>
                                            </div>
                                            <div class="tab-pane fade" id="dropdown2">
                                                <p>
                                                    Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--main content ends-->
                </div>
            </div>

        </div>
    </div>
@stop
