@extends('layouts.admin.base')

@section('content')
    <div class="row">
        @include('settings.menu')
        <div class="col-xl-9 col-md-8">
            <div class="card">
                <div class="card-body w-100">
                    <div class="content-page-header">
                        <h5 class="setting-menu">@lang('Account Settings')</h5>
                    </div>
                    <form action="{{ route('users.update', $user->id) }}" method="post" id="account_edit_form">
                        <div class="row">
                            @method('PUT')
                            {{ csrf_field() }}
                            <input type="hidden" name="id" value="{{ $user->id }}" />
                            <div class="profile-picture">
                                <div class="upload-profile me-2">
                                    @php
                                        $avatar = isset(auth()->user()->avatar)
                                            ? asset(Storage::url('avatar/' . auth()->user()->avatar))
                                            : asset('assets/img/avatar.png');
                                    @endphp
                                    <div class="profile-img">
                                        <img id="blah" class="avatar" src="{{ $avatar }}" alt="profile-img">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-title">
                                    <h5>@lang('General Information')</h5>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="input-block mb-3">
                                    <label>@lang('First Name')</label>
                                    <input type="text" name="name" value="{{ $user->name }}" class="form-control"
                                        placeholder="Enter First Name">
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="input-block mb-3">
                                    <label>@lang('Last Name')</label>
                                    <input type="text" name="last_name" value="{{ $user->last_name }}"
                                        class="form-control" placeholder="Enter Last Name">
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="input-block mb-3">
                                    <label>@lang('Email')</label>
                                    <input type="text" name="email" value="{{ $user->email }}" class="form-control"
                                        placeholder="Enter Email Address">
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="input-block mb-3">
                                    <label>@lang('Mobile Number')</label>
                                    <input type="text" name="movil" value="{{ $user->movil }}" class="form-control"
                                        placeholder="Enter Mobile Number">
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="input-block mb-0">
                                    <label>@lang('Gender')</label>
                                    <input type="hidden" name="gender" id="gender" value="{{ $user->gender_id }}">
                                    <select class="form-control form-small select" name="gender_id" id="gender_id">
                                        <option>@lang('Select Gender')</option>
                                        @foreach ($genders as $value)
                                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="input-block mb-3">
                                    <label>@lang('Date of Birth')</label>
                                    <div class="cal-icon cal-icon-info">
                                        <input type="text" name="brithday" value="{{ $user->brithday }}"
                                            class="datetimepicker form-control" placeholder="Select Date">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-title">
                                    <h5>@lang('Address Information')</h5>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="input-block mb-3">
                                    <label>@lang('Address')</label>
                                    <input type="text" name="address" value="{{ $user->address }}" class="form-control"
                                        placeholder="Enter your Address">
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="input-block mb-3">
                                    <label>@lang('Country')</label>
                                    <input type="hidden" name="country" value="{{ $user->country_id }}" id="country">
                                    <input type="hidden" name="state" value="{{ $user->state_id }}" id="state">
                                    <input type="hidden" name="city" value="{{ $user->city_id }}" id="city">
                                    <select class="form-control form-small select" name="country_id" id="country_id">
                                        <option>@lang('Select')</option>
                                        @foreach ($countries as $value)
                                            <option value="{{ $value->id }}">
                                                {{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="input-block mb-3">
                                    <label>@lang('State')</label>
                                    <select class="form-control form-small select" name="state_id" id="state_id">
                                        <option>@lang('Select')</option>
                                        @foreach ($states as $value)
                                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="input-block mb-3">
                                    <label>@lang('City')</label>
                                    <select class="form-control form-small select" name="city_id" id="city_id">
                                        <option>@lang('Select')</option>
                                        @foreach ($cities as $value)
                                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="btn-path text-end">
                                    <a href="{{ route('settings') }}"
                                        class="btn btn-cancel bg-primary-light me-3">@lang('Cancel')</a>
                                    @can('users.update')
                                        <button type="submit" class="btn btn-primary">@lang('Save Changes')</button>
                                    @endcan
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    @include('settings.js')
@endsection
