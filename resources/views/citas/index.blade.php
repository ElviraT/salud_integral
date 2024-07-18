@extends('layouts.admin.base')

@section('content')
    <div class="card p-3">
        <div class="page-header">
            <div class="content-page-header">
                <h5>@lang('Schedule Appointment')</h5>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card-table">
                    <div class="card-body">
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="input-block mb-3">
                                <label>@lang('Medical')</label>
                                <select class="form-control form-small select" name="combo_medical" id="combo_medical">
                                    <option>@lang('Select medical')</option>
                                    @foreach ($medicals as $value)
                                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card p-3" id="cita" hidden>
        <div class="page-header">
            <div class="content-page-header">
                <div class="list-btn">
                    <ul class="filter-list">
                        <li>
                            <a href="#" class="btn btn-primary" data-bs-action="{{ route('citas.store') }}"
                                data-bs-toggle="modal" data-bs-target="#add_event">@lang('Create Event')</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="card-body">
                <div id="calendar"></div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    @include('citas.js')
@endsection
@section('modal')
    @include('modales.cita')
@endsection
