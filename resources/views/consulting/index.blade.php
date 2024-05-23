@extends('layouts.admin.base')

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body w-100">
                    <div class="content-page-header p-0">
                        <h5>@lang('Consulting Room')</h5>
                        @can('consultings.store')
                            <div class="list-btn">
                                <a class="btn btn-primary" href="#" data-bs-toggle="modal"
                                    data-bs-action="{{ route('consultings.store') }}" data-bs-target="#add_consulting"><i
                                        class="fa fa-plus-circle me-2" aria-hidden="true"></i>@lang('Add Consulting')</a>

                            </div>
                        @endcan
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-table">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-center table-hover datatable" width="100%">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>@lang('Name')</th>
                                                    <th>@lang('Phone')</th>
                                                    <th>@lang('Maximo Patient')</th>
                                                    <th class="no-sort">@lang('Action')</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($consulting as $item)
                                                    <tr>
                                                        <td>{{ $item->name }}</td>
                                                        <td>{{ $item->phone }}</td>
                                                        <td>{{ $item->max_patient }}</td>
                                                        <td class="d-flex align-items-center">
                                                            <div class="dropdown dropdown-action">
                                                                <a href="#" class=" btn-action-icon "
                                                                    data-bs-toggle="dropdown" aria-expanded="false"><i
                                                                        class="fas fa-ellipsis-v"></i></a>
                                                                <div class="dropdown-menu dropdown-menu-end">
                                                                    <ul>
                                                                        @can('consultings.edit')
                                                                            <li>
                                                                                <a href="#" type="button"
                                                                                    data-bs-toggle="modal"
                                                                                    data-bs-target="#add_consulting"
                                                                                    class="btn btn-greys me-2"
                                                                                    data-bs-record-id="{{ $item->id }}"
                                                                                    data-bs-action="{{ route('consultings.update', $item) }}">
                                                                                    <i class="fa fa-edit me-1"></i>
                                                                                    {{ __('Edit Consulting') }}
                                                                                </a>
                                                                            </li>
                                                                        @endcan
                                                                        @can('consultings.destroy')
                                                                            <li>
                                                                                <a class="btn btn-greys me-2"
                                                                                    data-bs-toggle="modal"
                                                                                    data-bs-target="#confirm-delete"
                                                                                    data-bs-record-id="{{ $item->id }}"
                                                                                    data-bs-record-title="{{ 'El Consultorio ' }}{{ $item->name }}"
                                                                                    data-bs-action="{{ route('consultings.destroy', $item) }}"
                                                                                    title="{{ __('Delete consultings') }}"><i
                                                                                        class="far fa-trash-alt me-2"></i>@lang('Delete')</a>
                                                                            </li>
                                                                        @endcan
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('modal')
    @include('modales.consulting')
    @include('modales.eliminar')
@endsection
@section('js')
    @include('consulting.js')
@endsection
